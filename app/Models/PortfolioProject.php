<?php

namespace App\Models;

class PortfolioProject extends Model
{
    protected static string $table = 'portfolio_projects';

    /**
     * Published, non-demo projects (sample/demo rows are never shown as real work) with their category slug/name joined in,
     * so the index page can render filter pills without N+1 queries.
     */
    public static function published(): array
    {
        return static::db()->query(
            'SELECT p.*, c.slug AS category_slug, c.name AS category_name
             FROM portfolio_projects p
             LEFT JOIN service_categories c ON c.id = p.category_id
             WHERE p.status = "published" AND p.is_demo = 0
             ORDER BY p.sort_order ASC, p.id DESC'
        )->fetchAll();
    }

    public static function publishedBySlug(string $slug): ?array
    {
        $stmt = static::db()->prepare(
            'SELECT p.*, c.slug AS category_slug, c.name AS category_name
             FROM portfolio_projects p
             LEFT JOIN service_categories c ON c.id = p.category_id
             WHERE p.slug = :slug AND p.status = "published" AND p.is_demo = 0 LIMIT 1'
        );
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch();

        return $row ? static::decodeJsonFields($row, ['gallery']) : null;
    }

    /**
     * Other published projects, preferring the same category, to power
     * the "Related Projects" block and internal linking.
     */
    public static function relatedTo(?int $categoryId, int $excludeId, int $limit = 3): array
    {
        if ($categoryId !== null) {
            $stmt = static::db()->prepare(
                'SELECT * FROM portfolio_projects WHERE category_id = :category_id AND id != :exclude_id
                 AND status = "published" AND is_demo = 0 ORDER BY sort_order ASC LIMIT :limit'
            );
            $stmt->bindValue(':category_id', $categoryId, \PDO::PARAM_INT);
            $stmt->bindValue(':exclude_id', $excludeId, \PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();

            if (count($rows) >= $limit) {
                return $rows;
            }
        } else {
            $rows = [];
        }

        // Top up with other published projects if the same category doesn't have enough.
        $needed = $limit - count($rows);
        $excludeIds = array_merge([$excludeId], array_column($rows, 'id'));
        $placeholders = implode(',', array_fill(0, count($excludeIds), '?'));

        $stmt = static::db()->prepare(
            "SELECT * FROM portfolio_projects WHERE id NOT IN ($placeholders) AND status = \"published\" AND is_demo = 0
             ORDER BY sort_order ASC LIMIT {$needed}"
        );
        $stmt->execute($excludeIds);

        return array_merge($rows, $stmt->fetchAll());
    }

    public static function search(string $term): array
    {
        $stmt = static::db()->prepare(
            'SELECT * FROM portfolio_projects WHERE status = "published" AND is_demo = 0
             AND (title LIKE :term1 OR summary LIKE :term2)
             ORDER BY id DESC'
        );
        $needle = '%' . $term . '%';
        $stmt->execute(['term1' => $needle, 'term2' => $needle]);
        return $stmt->fetchAll();
    }
}
