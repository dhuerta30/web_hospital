<?php

namespace App\core;

/**
 * Tokens anti-CSRF.
 *
 * Antes: el token era un hash bcrypt de (secreto + id_sesion + formulario).
 * Problemas de ese diseño:
 *   - password_hash/password_verify es deliberadamente lento; ejecutarlo en
 *     cada envío de formulario es un coste alto y un vector de DoS barato.
 *   - bcrypt trunca la entrada a 72 bytes.
 *   - verifyFormToken() devolvía el token (string) o null en vez de un
 *     booleano, y una comparación laxa podía interpretarse mal.
 *   - Al rotar el ID de sesión, todos los tokens vigentes se invalidaban.
 *
 * Ahora: nonce aleatorio de 256 bits por formulario, guardado en la sesión y
 * comparado con hash_equals() en tiempo constante. La API pública se mantiene
 * para no tocar los controladores existentes.
 */
class Token
{
    /**
     * Genera (o reutiliza) el token del formulario indicado.
     *
     * @param  string $form  identificador lógico del formulario
     * @return string
     */
    public static function generateFormToken($form)
    {
        return Security::tokenCsrf((string) $form);
    }

    /**
     * Verifica el token recibido.
     *
     * @param  string $form   identificador lógico del formulario
     * @param  string $token  valor recibido del cliente
     * @return bool           true si el token es válido
     */
    public static function verifyFormToken($form, $token)
    {
        $form = (string) $form;

        if (Security::verificarCsrf($form, $token)) {
            return true;
        }

        // --- Compatibilidad transitoria -----------------------------------
        // Acepta los tokens del esquema anterior para que las sesiones y
        // pestañas abiertas durante el despliegue no fallen. Eliminar este
        // bloque una vez confirmado el funcionamiento en producción.
        if (self::verificarTokenLegado($form, $token)) {
            Security::registrar('CSRF: token del esquema anterior aceptado en el formulario "' . $form . '"');
            return true;
        }
        // ------------------------------------------------------------------

        Security::registrar('CSRF: token inválido o ausente en el formulario "' . $form . '"');
        return false;
    }

    /**
     * Devuelve el campo oculto listo para el HTML del formulario.
     */
    public static function campo($form = 'default')
    {
        return Security::campoCsrf((string) $form);
    }

    /**
     * Invalida el token de un formulario (por ejemplo tras un envío exitoso).
     */
    public static function consumir($form = 'default')
    {
        unset($_SESSION['_csrf'][(string) $form]);
    }

    /**
     * Esquema anterior: bcrypt de (CSRF_SECRET + session_id + formulario).
     */
    private static function verificarTokenLegado($form, $token)
    {
        if (!is_string($token) || $token === '' || empty($_ENV['CSRF_SECRET'])) {
            return false;
        }

        // Los hash bcrypt siempre empiezan con $2y$ / $2a$ / $2b$
        if (strncmp($token, '$2', 2) !== 0) {
            return false;
        }

        $secret = $_ENV['CSRF_SECRET'];
        $sid    = session_id();

        return password_verify($secret . $sid . $form, $token);
    }
}
