<?php

namespace App\Models;

use App\Core\Database;
use PDO;

abstract class Model
{
    protected static string $table;

    protected static function db(): PDO
    {
        return Database::connection();
    }

    public static function find(int $id): ?array
    {
        $stmt = static::db()->prepare('SELECT * FROM ' . static::$table . ' WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function findBySlug(string $slug): ?array
    {
        $stmt = static::db()->prepare('SELECT * FROM ' . static::$table . ' WHERE slug = :slug LIMIT 1');
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function all(string $orderBy = 'id DESC'): array
    {
        $orderBy = self::sanitizeOrderBy($orderBy);
        return static::db()->query('SELECT * FROM ' . static::$table . ' ORDER BY ' . $orderBy)->fetchAll();
    }

    public static function create(array $data): int
    {
        $columns = array_keys($data);
        $placeholders = array_map(fn ($c) => ':' . $c, $columns);

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            static::$table,
            implode(', ', $columns),
            implode(', ', $placeholders)
        );

        $stmt = static::db()->prepare($sql);
        $stmt->execute($data);

        return (int) static::db()->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $assignments = implode(', ', array_map(fn ($c) => "{$c} = :{$c}", array_keys($data)));

        $sql = sprintf('UPDATE %s SET %s WHERE id = :id', static::$table, $assignments);

        $stmt = static::db()->prepare($sql);
        return $stmt->execute([...$data, 'id' => $id]);
    }

    public static function delete(int $id): bool
    {
        $stmt = static::db()->prepare('DELETE FROM ' . static::$table . ' WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Decodes the given JSON-column fields on a row in place, defaulting
     * to an empty array for null/invalid values so views never need to
     * null-check before iterating.
     */
    protected static function decodeJsonFields(array $row, array $fields): array
    {
        foreach ($fields as $field) {
            $row[$field] = isset($row[$field]) ? (json_decode($row[$field], true) ?: []) : [];
        }

        return $row;
    }

    /**
     * Only allows a whitelisted "column direction" shape to prevent SQL
     * injection through a dynamic ORDER BY clause.
     */
    private static function sanitizeOrderBy(string $orderBy): string
    {
        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*\s+(ASC|DESC)$/i', trim($orderBy))) {
            return 'id DESC';
        }

        return $orderBy;
    }
}
