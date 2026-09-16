<?php

namespace App\Helpers;

class Url
{
    public static function base(): string
    {
        $scheme = (($_SERVER['HTTPS'] ?? '') !== '' && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? '') === '443'
            ? 'https'
            : 'http';

        $host = $_SERVER['HTTP_HOST'] ?? 'bmcs.ae';

        return $scheme . '://' . $host;
    }

    public static function full(string $path): string
    {
        return self::base() . '/' . ltrim($path, '/');
    }
}
