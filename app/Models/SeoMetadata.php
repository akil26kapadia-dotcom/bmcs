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
}
