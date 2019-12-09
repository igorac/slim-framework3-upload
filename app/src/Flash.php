<?php

namespace App\src;

class Flash
{
    public static function add(string $index, string $message): void
    {
        if (!isset($_SESSION[$index])) {
            $_SESSION[$index] = $message;
        }
    }

    public static function get(string $index): string
    {
        if (isset($_SESSION[$index])) {
            $message = $_SESSION[$index];
        }

        unset($_SESSION[$index]);

        return $message ?? '';
    }
}