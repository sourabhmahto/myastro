<?php
/**
 * Gallery Model
 */

require_once __DIR__ . '/../config/database.php';

class Gallery {
    public static function getAll(string $category = 'all', bool $activeOnly = true): array {
        $db = Database::getInstance();
        if (!$db) return [];

        $sql = "SELECT * FROM `galleries` WHERE 1=1";
        $params = [];

        if ($activeOnly) {
            $sql .= " AND `status` = 'active'";
        }

        if ($category !== 'all' && !empty($category)) {
            $sql .= " AND `category` = :cat";
            $params['cat'] = $category;
        }

        $sql .= " ORDER BY `id` DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function getById(int $id): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT * FROM `galleries` WHERE `id` = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $data): int {
        $db = Database::getInstance();
        if (!$db) return 0;

        $stmt = $db->prepare("INSERT INTO `galleries` 
            (`title`, `image`, `alt_text`, `category`, `status`, `created_at`) 
            VALUES (:title, :image, :alt_text, :category, :status, NOW())");

        $stmt->execute([
            'title' => $data['title'],
            'image' => $data['image'],
            'alt_text' => $data['alt_text'] ?? $data['title'],
            'category' => $data['category'] ?? 'temples',
            'status' => $data['status'] ?? 'active'
        ]);

        return (int)$db->lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $fields = [
            'title = :title',
            'alt_text = :alt_text',
            'category = :category',
            'status = :status'
        ];

        $params = [
            'id' => $id,
            'title' => $data['title'],
            'alt_text' => $data['alt_text'],
            'category' => $data['category'],
            'status' => $data['status']
        ];

        if (array_key_exists('image', $data) && !empty($data['image'])) {
            $fields[] = 'image = :image';
            $params['image'] = $data['image'];
        }

        $sql = "UPDATE `galleries` SET " . implode(', ', $fields) . " WHERE `id` = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    public static function delete(int $id): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $stmt = $db->prepare("DELETE FROM `galleries` WHERE `id` = :id");
        return $stmt->execute(['id' => $id]);
    }
}
