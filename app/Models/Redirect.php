<?php

namespace App\Models;

class Redirect extends Model
{
    protected static string $table = 'redirects';

    public static function findByOldPath(string $path): ?array
    {
        $stmt = static::db()->prepare('SELECT * FROM redirects WHERE old_path = :path LIMIT 1');
        $stmt->execute(['path' => $path]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
