<?php

namespace App\Models;

class Service extends Model
{
    protected static string $table = 'services';

    public static function published(): array
    {
        return static::db()
            ->query('SELECT * FROM services WHERE status = "published" ORDER BY sort_order ASC, name ASC')
            ->fetchAll();
    }

    public static function publishedBySlug(string $slug): ?array
    {
        $stmt = static::db()->prepare('SELECT * FROM services WHERE slug = :slug AND status = "published" LIMIT 1');
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch();

        return $row ? static::decodeJsonFields($row, ['capabilities', 'benefits', 'applications', 'faq']) : null;
    }

    /**
     * Other published services in the same category, excluding the given one —
     * used to power the "Related Services" block and internal linking.
     */
    public static function relatedTo(int $categoryId, int $excludeId, int $limit = 3): array
    {
        $stmt = static::db()->prepare(
            'SELECT * FROM services WHERE category_id = :category_id AND id != :exclude_id AND status = "published"
             ORDER BY sort_order ASC LIMIT :limit'
        );
        $stmt->bindValue(':category_id', $categoryId, \PDO::PARAM_INT);
        $stmt->bindValue(':exclude_id', $excludeId, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function byCategorySlug(string $categorySlug): array
    {
        $stmt = static::db()->prepare(
            'SELECT s.* FROM services s
             INNER JOIN service_categories c ON c.id = s.category_id
             WHERE c.slug = :slug AND s.status = "published"
             ORDER BY s.sort_order ASC, s.name ASC'
        );
        $stmt->execute(['slug' => $categorySlug]);
        return $stmt->fetchAll();
    }

    public static function search(string $term): array
    {
        $stmt = static::db()->prepare(
            'SELECT * FROM services WHERE status = "published"
             AND (name LIKE :term1 OR short_description LIKE :term2)
             ORDER BY name ASC'
        );
        $needle = '%' . $term . '%';
        $stmt->execute(['term1' => $needle, 'term2' => $needle]);
        return $stmt->fetchAll();
    }
}
