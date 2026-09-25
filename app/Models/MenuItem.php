<?php

namespace App\Models;

class MenuItem extends Model
{
    protected static string $table = 'menu_items';

    public static function forLocation(string $location): array
    {
        $stmt = static::db()->prepare(
            'SELECT *, url AS href FROM menu_items WHERE location = :location ORDER BY sort_order ASC, id ASC'
        );
        $stmt->execute(['location' => $location]);
        return $stmt->fetchAll();
    }

    public static function allOrdered(): array
    {
        return static::db()
            ->query('SELECT * FROM menu_items ORDER BY location ASC, sort_order ASC, id ASC')
            ->fetchAll();
    }
}
