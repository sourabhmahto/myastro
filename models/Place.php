<?php
/**
 * Place Model (Attractions & Sightseeing)
 */

require_once __DIR__ . '/../config/database.php';

class Place {
    public static function getAll(bool $activeOnly = true): array {
        $db = Database::getInstance();
        if (!$db) return [];

        $sql = "SELECT * FROM `places`";
        if ($activeOnly) {
            $sql .= " WHERE `status` = 'active'";
        }
        $sql .= " ORDER BY `id` ASC";

        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }

    public static function getBySlug(string $slug): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT * FROM `places` WHERE `slug` = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function getById(int $id): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT * FROM `places` WHERE `id` = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $data): int {
        $db = Database::getInstance();
        if (!$db) return 0;

        $stmt = $db->prepare("INSERT INTO `places` 
            (`name`, `slug`, `description`, `location`, `distance_from_temple`, `image`, `status`, `created_at`) 
            VALUES (:name, :slug, :description, :location, :distance_from_temple, :image, :status, NOW())");

        $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'location' => $data['location'],
            'distance_from_temple' => $data['distance_from_temple'] ?? 'Nearby',
            'image' => $data['image'] ?? null,
            'status' => $data['status'] ?? 'active'
        ]);

        return (int)$db->lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $fields = [
            'name = :name',
            'slug = :slug',
            'description = :description',
            'location = :location',
            'distance_from_temple = :distance_from_temple',
            'status = :status'
        ];

        $params = [
            'id' => $id,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'location' => $data['location'],
            'distance_from_temple' => $data['distance_from_temple'],
            'status' => $data['status']
        ];

        if (array_key_exists('image', $data) && $data['image'] !== null) {
            $fields[] = 'image = :image';
            $params['image'] = $data['image'];
        }

        $sql = "UPDATE `places` SET " . implode(', ', $fields) . " WHERE `id` = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    public static function delete(int $id): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $stmt = $db->prepare("DELETE FROM `places` WHERE `id` = :id");
        return $stmt->execute(['id' => $id]);
    }
}
