<?php
/**
 * Temple Model
 */

require_once __DIR__ . '/../config/database.php';

class Temple {
    public static function getAll(bool $activeOnly = true): array {
        $db = Database::getInstance();
        if (!$db) return [];

        $sql = "SELECT * FROM `temples`";
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

        $stmt = $db->prepare("SELECT * FROM `temples` WHERE `slug` = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function getById(int $id): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT * FROM `temples` WHERE `id` = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $data): int {
        $db = Database::getInstance();
        if (!$db) return 0;

        $stmt = $db->prepare("INSERT INTO `temples` 
            (`name`, `slug`, `short_description`, `description`, `address`, `latitude`, `longitude`, `opening_time`, `closing_time`, `featured_image`, `status`, `created_at`) 
            VALUES (:name, :slug, :short_description, :description, :address, :latitude, :longitude, :opening_time, :closing_time, :featured_image, :status, NOW())");

        $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],
            'address' => $data['address'],
            'latitude' => !empty($data['latitude']) ? (float)$data['latitude'] : null,
            'longitude' => !empty($data['longitude']) ? (float)$data['longitude'] : null,
            'opening_time' => $data['opening_time'] ?? '05:00:00',
            'closing_time' => $data['closing_time'] ?? '21:30:00',
            'featured_image' => $data['featured_image'] ?? null,
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
            'short_description = :short_description',
            'description = :description',
            'address = :address',
            'latitude = :latitude',
            'longitude = :longitude',
            'opening_time = :opening_time',
            'closing_time = :closing_time',
            'status = :status'
        ];

        $params = [
            'id' => $id,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],
            'address' => $data['address'],
            'latitude' => !empty($data['latitude']) ? (float)$data['latitude'] : null,
            'longitude' => !empty($data['longitude']) ? (float)$data['longitude'] : null,
            'opening_time' => $data['opening_time'],
            'closing_time' => $data['closing_time'],
            'status' => $data['status']
        ];

        if (array_key_exists('featured_image', $data) && $data['featured_image'] !== null) {
            $fields[] = 'featured_image = :featured_image';
            $params['featured_image'] = $data['featured_image'];
        }

        $sql = "UPDATE `temples` SET " . implode(', ', $fields) . " WHERE `id` = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    public static function delete(int $id): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $stmt = $db->prepare("DELETE FROM `temples` WHERE `id` = :id");
        return $stmt->execute(['id' => $id]);
    }
}
