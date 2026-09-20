<?php
/**
 * BlogPost Model
 */

require_once __DIR__ . '/../config/database.php';

class BlogPost {
    public static function getAll(bool $publishedOnly = true, int $limit = 0): array {
        $db = Database::getInstance();
        if (!$db) return [];

        $sql = "SELECT b.*, a.name AS author_name 
                FROM `blog_posts` b 
                LEFT JOIN `admins` a ON b.author_id = a.id";
        
        if ($publishedOnly) {
            $sql .= " WHERE b.status = 'published'";
        }
        
        $sql .= " ORDER BY b.published_at DESC, b.id DESC";

        if ($limit > 0) {
            $sql .= " LIMIT " . (int)$limit;
        }

        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }

    public static function getRecent(int $limit = 3): array {
        return self::getAll(true, $limit);
    }

    public static function getBySlug(string $slug): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT b.*, a.name AS author_name 
            FROM `blog_posts` b 
            LEFT JOIN `admins` a ON b.author_id = a.id 
            WHERE b.slug = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function getById(int $id): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT b.*, a.name AS author_name 
            FROM `blog_posts` b 
            LEFT JOIN `admins` a ON b.author_id = a.id 
            WHERE b.id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $data): int {
        $db = Database::getInstance();
        if (!$db) return 0;

        $stmt = $db->prepare("INSERT INTO `blog_posts` 
            (`title`, `slug`, `excerpt`, `content`, `featured_image`, `author_id`, `status`, `published_at`, `created_at`) 
            VALUES (:title, :slug, :excerpt, :content, :featured_image, :author_id, :status, :published_at, NOW())");

        $publishedAt = ($data['status'] === 'published') ? date('Y-m-d H:i:s') : null;

        $stmt->execute([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'featured_image' => $data['featured_image'] ?? null,
            'author_id' => $data['author_id'] ?? null,
            'status' => $data['status'] ?? 'published',
            'published_at' => $publishedAt
        ]);

        return (int)$db->lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $fields = [
            'title = :title',
            'slug = :slug',
            'excerpt = :excerpt',
            'content = :content',
            'status = :status'
        ];

        $params = [
            'id' => $id,
            'title' => $data['title'],
            'slug' => $data['slug'],
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'status' => $data['status']
        ];

        if (array_key_exists('featured_image', $data) && $data['featured_image'] !== null) {
            $fields[] = 'featured_image = :featured_image';
            $params['featured_image'] = $data['featured_image'];
        }

        if ($data['status'] === 'published') {
            $fields[] = 'published_at = IFNULL(published_at, NOW())';
        }

        $sql = "UPDATE `blog_posts` SET " . implode(', ', $fields) . " WHERE `id` = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    public static function delete(int $id): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $stmt = $db->prepare("DELETE FROM `blog_posts` WHERE `id` = :id");
        return $stmt->execute(['id' => $id]);
    }
}
