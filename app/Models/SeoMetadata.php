<?php

namespace App\Models;

class SeoMetadata extends Model
{
    protected static string $table = 'seo_metadata';

    public static function findByRouteKey(string $routeKey): ?array
    {
        $stmt = static::db()->prepare('SELECT * FROM seo_metadata WHERE route_key = :key LIMIT 1');
        $stmt->execute(['key' => $routeKey]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function allAsMap(): array
    {
        $rows = static::db()->query('SELECT * FROM seo_metadata ORDER BY route_key ASC')->fetchAll();
        $map = [];
        foreach ($rows as $row) {
            $map[$row['route_key']] = $row;
        }
        return $map;
    }

    /** Insert or update the row for a route_key in one call (admin form save). */
    public static function upsert(string $routeKey, array $data): void
    {
        $data['route_key'] = $routeKey;
        $columns = array_keys($data);
        $placeholders = array_map(fn ($c) => ':' . $c, $columns);
        $updates = implode(', ', array_map(fn ($c) => "{$c} = VALUES({$c})", array_filter($columns, fn ($c) => $c !== 'route_key')));

        $sql = sprintf(
            'INSERT INTO seo_metadata (%s) VALUES (%s) ON DUPLICATE KEY UPDATE %s',
            implode(', ', $columns),
            implode(', ', $placeholders),
            $updates
        );

        static::db()->prepare($sql)->execute($data);
    }
}
