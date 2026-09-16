<?php

namespace App\Models;

use PDO;

class Post extends Model
{
    protected static string $table = 'posts';

    private const PUBLISHED_JOIN = 'FROM posts p
        LEFT JOIN categories c ON c.id = p.category_id
        LEFT JOIN users u ON u.id = p.author_id';

    /**
     * Single entry point for the public blog listing, category page, tag
     * page and search — all just differ by which optional filter is set.
     *
     * @param array{category?:string,tag?:string,search?:string} $filters
     * @return array{items:array,total:int,page:int,perPage:int,totalPages:int}
     */
    public static function paginate(array $filters = [], int $page = 1, int $perPage = 9): array
    {
        // "scheduled" posts become publicly visible automatically once their
        // published_at time passes — no cron job needed to flip the status.
        $where = ['p.status IN ("published", "scheduled")', 'p.published_at <= NOW()'];
        $params = [];
        $joins = '';

        if (!empty($filters['category'])) {
            $where[] = 'c.slug = :category';
            $params['category'] = $filters['category'];
        }

        if (!empty($filters['tag'])) {
            $joins .= ' INNER JOIN post_tags pt ON pt.post_id = p.id INNER JOIN tags t ON t.id = pt.tag_id';
            $where[] = 't.slug = :tag';
            $params['tag'] = $filters['tag'];
        }

        if (!empty($filters['search'])) {
            $where[] = '(p.title LIKE :search1 OR p.excerpt LIKE :search2 OR p.content LIKE :search3)';
            $needle = '%' . $filters['search'] . '%';
            $params['search1'] = $needle;
            $params['search2'] = $needle;
            $params['search3'] = $needle;
        }

        $whereSql = implode(' AND ', $where);
        $page = max(1, $page);
        $offset = ($page - 1) * $perPage;

        $countStmt = static::db()->prepare(
            'SELECT COUNT(DISTINCT p.id) ' . self::PUBLISHED_JOIN . $joins . ' WHERE ' . $whereSql
        );
        $countStmt->execute($params);
        $total = (int) $countStmt->fetchColumn();

        $stmt = static::db()->prepare(
            'SELECT DISTINCT p.*, c.name AS category_name, c.slug AS category_slug, u.name AS author_name '
            . self::PUBLISHED_JOIN . $joins . ' WHERE ' . $whereSql
            . ' ORDER BY p.published_at DESC LIMIT :limit OFFSET :offset'
        );
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return [
            'items' => $stmt->fetchAll(),
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
            'totalPages' => max(1, (int) ceil($total / $perPage)),
        ];
    }

    public static function published(int $limit = 20, int $offset = 0): array
    {
        $stmt = static::db()->prepare(
            'SELECT p.*, c.name AS category_name, c.slug AS category_slug ' . self::PUBLISHED_JOIN . '
             WHERE p.status IN ("published", "scheduled") AND p.published_at <= NOW()
             ORDER BY p.published_at DESC LIMIT :limit OFFSET :offset'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function publishedBySlug(string $slug): ?array
    {
        $stmt = static::db()->prepare(
            'SELECT p.*, c.name AS category_name, c.slug AS category_slug, u.name AS author_name '
            . self::PUBLISHED_JOIN . '
             WHERE p.slug = :slug AND p.status IN ("published", "scheduled") AND p.published_at <= NOW() LIMIT 1'
        );
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch();

        if ($row === false) {
            return null;
        }

        $row['tags'] = self::tagsForPost((int) $row['id']);

        return $row;
    }

    /**
     * Other published posts, preferring the same category, for the
     * "Related Posts" block and internal linking.
     */
    public static function relatedTo(?int $categoryId, int $excludeId, int $limit = 3): array
    {
        $rows = [];

        if ($categoryId !== null) {
            $stmt = static::db()->prepare(
                'SELECT * FROM posts WHERE category_id = :category_id AND id != :exclude_id
                 AND status IN ("published", "scheduled") AND published_at <= NOW()
                 ORDER BY published_at DESC LIMIT :limit'
            );
            $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
            $stmt->bindValue(':exclude_id', $excludeId, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
        }

        $needed = $limit - count($rows);
        if ($needed <= 0) {
            return $rows;
        }

        $excludeIds = array_merge([$excludeId], array_column($rows, 'id'));
        $placeholders = implode(',', array_fill(0, count($excludeIds), '?'));

        $stmt = static::db()->prepare(
            "SELECT * FROM posts WHERE id NOT IN ($placeholders) AND status IN ('published', 'scheduled') AND published_at <= NOW()
             ORDER BY published_at DESC LIMIT {$needed}"
        );
        $stmt->execute($excludeIds);

        return array_merge($rows, $stmt->fetchAll());
    }

    public static function search(string $term, int $limit = 20): array
    {
        return static::paginate(['search' => $term], 1, $limit)['items'];
    }

    /** All posts regardless of status, for the admin listing. */
    public static function adminAll(): array
    {
        return static::db()->query(
            'SELECT p.*, c.name AS category_name, u.name AS author_name ' . self::PUBLISHED_JOIN . '
             ORDER BY p.created_at DESC'
        )->fetchAll();
    }

    public static function tagsForPost(int $postId): array
    {
        $stmt = static::db()->prepare(
            'SELECT t.* FROM tags t INNER JOIN post_tags pt ON pt.tag_id = t.id WHERE pt.post_id = :post_id ORDER BY t.name'
        );
        $stmt->execute(['post_id' => $postId]);
        return $stmt->fetchAll();
    }

    /** Replaces a post's tag assignments with the given set of tag IDs. */
    public static function syncTags(int $postId, array $tagIds): void
    {
        $db = static::db();
        $delete = $db->prepare('DELETE FROM post_tags WHERE post_id = :post_id');
        $delete->execute(['post_id' => $postId]);

        if (empty($tagIds)) {
            return;
        }

        $insert = $db->prepare('INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)');
        foreach (array_unique(array_map('intval', $tagIds)) as $tagId) {
            $insert->execute(['post_id' => $postId, 'tag_id' => $tagId]);
        }
    }
}
