<?php

namespace App\Core;

class Session
{
    public static function iniciar(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function destroy(): void
    {
        self::iniciar();
        session_unset();
        session_destroy();
    }

    public static function Logado(): bool
    {
        return isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] === true;
    }
}
