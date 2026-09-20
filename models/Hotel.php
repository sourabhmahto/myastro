<?php
/**
 * Hotel Model (Accommodations, Ashrams, Dharamshalas)
 */

require_once __DIR__ . '/../config/database.php';

class Hotel {
    public static function getAll(bool $activeOnly = true): array {
        $db = Database::getInstance();
        if (!$db) return [];

        $sql = "SELECT * FROM `hotels`";
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

        $stmt = $db->prepare("SELECT * FROM `hotels` WHERE `slug` = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function getById(int $id): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT * FROM `hotels` WHERE `id` = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $data): int {
        $db = Database::getInstance();
        if (!$db) return 0;

        $stmt = $db->prepare("INSERT INTO `hotels` 
            (`name`, `slug`, `description`, `address`, `phone`, `price_range`, `image`, `amenities`, `status`, `created_at`) 
            VALUES (:name, :slug, :description, :address, :phone, :price_range, :image, :amenities, :status, NOW())");

        $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'price_range' => $data['price_range'] ?? '₹800 - ₹2,500 / night',
            'image' => $data['image'] ?? null,
            'amenities' => $data['amenities'] ?? null,
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
            'address = :address',
            'phone = :phone',
            'price_range = :price_range',
            'amenities = :amenities',
            'status = :status'
        ];

        $params = [
            'id' => $id,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'price_range' => $data['price_range'],
            'amenities' => $data['amenities'] ?? null,
            'status' => $data['status']
        ];

        if (array_key_exists('image', $data) && $data['image'] !== null) {
            $fields[] = 'image = :image';
            $params['image'] = $data['image'];
        }

        $sql = "UPDATE `hotels` SET " . implode(', ', $fields) . " WHERE `id` = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    public static function delete(int $id): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $stmt = $db->prepare("DELETE FROM `hotels` WHERE `id` = :id");
        return $stmt->execute(['id' => $id]);
    }
}
