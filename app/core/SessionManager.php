<?php

namespace App\core;

class SessionManager
{
    public static function startSession()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            Security::vigilarSesion();
            return;
        }

        Security::configurarCookieSesion();

        @session_start();

        if (!Security::vigilarSesion()) {
            @session_start();
            $_SESSION['_expirada'] = true;
        }
    }

    public static function regenerar()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            self::startSession();
        }

        session_regenerate_id(true);
        $_SESSION['_creada'] = time();
        $_SESSION['_ultima_actividad'] = time();
    }

    public static function expiroPorInactividad(): bool
    {
        $expirada = !empty($_SESSION['_expirada']);
        unset($_SESSION['_expirada']);
        return $expirada;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        Security::cerrarSesion();
    }
}
