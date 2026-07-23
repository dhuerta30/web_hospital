<?php

namespace App\core;

/**
 * Gestor de sesión.
 *
 * Endurecido según el informe INF-CIBER-2026-10 (hallazgo 4.7 / remediación 6.5):
 *   - cookie Secure / HttpOnly / SameSite
 *   - session.use_strict_mode y use_only_cookies
 *   - regeneración del ID tras autenticar (previene fijación de sesión)
 *   - expiración por inactividad y rotación periódica
 *
 * La API pública (startSession / set / get / delete / destroy) se mantiene
 * idéntica para no romper el código existente.
 */
class SessionManager
{
    /**
     * Inicia la sesión aplicando los atributos seguros de cookie.
     * Si la sesión expiró por inactividad, se cierra y se inicia una nueva vacía.
     */
    public static function startSession()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            Security::vigilarSesion();
            return;
        }

        // Fija los atributos de cookie ANTES de arrancar la sesión.
        Security::configurarCookieSesion();

        @session_start();

        if (!Security::vigilarSesion()) {
            // La sesión caducó: arrancamos una limpia para que la app siga
            // funcionando y el usuario sea redirigido al login por el flujo normal.
            @session_start();
            $_SESSION['_expirada'] = true;
        }
    }

    /**
     * Regenera el ID de sesión. Debe llamarse INMEDIATAMENTE después de
     * validar credenciales correctas.
     */
    public static function regenerar()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            self::startSession();
        }

        session_regenerate_id(true);
        $_SESSION['_creada'] = time();
        $_SESSION['_ultima_actividad'] = time();
    }

    /**
     * ¿La sesión anterior se cerró por inactividad?
     * Útil para mostrar el aviso con SweetAlert2 en el login.
     */
    public static function expiroPorInactividad(): bool
    {
        $expirada = !empty($_SESSION['_expirada']);
        unset($_SESSION['_expirada']);
        return $expirada;
    }

    // Método estático para establecer un valor en la sesión
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // Método estático para obtener un valor de la sesión
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Método estático para eliminar un valor de la sesión
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Destruye la sesión por completo: datos, cookie y almacenamiento.
     * Antes sólo se llamaba a session_destroy(), lo que dejaba viva la
     * cookie en el navegador.
     */
    public static function destroy()
    {
        Security::cerrarSesion();
    }
}
