<?php

namespace App\Helpers;

class Str
{
    public static function slug(string $value): string
    {
        $value = strtolower(trim($value));
        $value = preg_replace('/[^a-z0-9]+/', '-', $value);
        return trim($value, '-');
    }

    public static function excerpt(string $text, int $length = 160): string
    {
        $plain = trim(strip_tags($text));

        if (mb_strlen($plain) <= $length) {
            return $plain;
        }

        return rtrim(mb_substr($plain, 0, $length)) . '…';
    }

    public static function readingTime(string $html): int
    {
        $words = str_word_count(strip_tags($html));
        return max(1, (int) ceil($words / 200));
    }
}
