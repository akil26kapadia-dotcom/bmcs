<?php

namespace App\Models;

class ServiceCategory extends Model
{
    protected static string $table = 'service_categories';

    private const JSON_FIELDS = ['capabilities', 'benefits', 'applications', 'faq'];

    public static function allOrdered(): array
    {
        return static::db()
            ->query('SELECT * FROM service_categories ORDER BY sort_order ASC, name ASC')
            ->fetchAll();
    }

    public static function findBySlug(string $slug): ?array
    {
        $stmt = static::db()->prepare('SELECT * FROM service_categories WHERE slug = :slug LIMIT 1');
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch();

        return $row ? static::decodeJsonFields($row, self::JSON_FIELDS) : null;
    }

    public static function find(int $id): ?array
    {
        $stmt = static::db()->prepare('SELECT * FROM service_categories WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ? static::decodeJsonFields($row, self::JSON_FIELDS) : null;
    }
}
