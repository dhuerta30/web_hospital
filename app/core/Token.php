<?php

namespace App\core;

class Token
{
    public static function generateFormToken($form)
    {
        return Security::tokenCsrf((string) $form);
    }

    public static function verifyFormToken($form, $token)
    {
        $form = (string) $form;

        if (Security::verificarCsrf($form, $token)) {
            return true;
        }

        if (self::verificarTokenLegado($form, $token)) {
            Security::registrar('CSRF: token del esquema anterior aceptado en el formulario "' . $form . '"');
            return true;
        }

        Security::registrar('CSRF: token inválido o ausente en el formulario "' . $form . '"');
        return false;
    }

    public static function campo($form = 'default')
    {
        return Security::campoCsrf((string) $form);
    }

    public static function consumir($form = 'default')
    {
        unset($_SESSION['_csrf'][(string) $form]);
    }

    private static function verificarTokenLegado($form, $token)
    {
        if (!is_string($token) || $token === '' || empty($_ENV['CSRF_SECRET'])) {
            return false;
        }

        if (strncmp($token, '$2', 2) !== 0) {
            return false;
        }

        $secret = $_ENV['CSRF_SECRET'];
        $sid    = session_id();

        return password_verify($secret . $sid . $form, $token);
    }
}
