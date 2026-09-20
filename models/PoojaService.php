<?php
/**
 * PoojaService Model
 */

require_once __DIR__ . '/../config/database.php';

class PoojaService {
    public static function getAll(bool $activeOnly = true): array {
        $db = Database::getInstance();
        if (!$db) return [];

        $sql = "SELECT * FROM `pooja_services`";
        if ($activeOnly) {
            $sql .= " WHERE `status` = 'active'";
        }
        $sql .= " ORDER BY `price` ASC";

        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }

    public static function getBySlug(string $slug): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT * FROM `pooja_services` WHERE `slug` = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function getById(int $id): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT * FROM `pooja_services` WHERE `id` = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $data): int {
        $db = Database::getInstance();
        if (!$db) return 0;

        $stmt = $db->prepare("INSERT INTO `pooja_services` 
            (`name`, `slug`, `description`, `benefits`, `samagri_included`, `price`, `duration`, `image`, `status`, `created_at`) 
            VALUES (:name, :slug, :description, :benefits, :samagri_included, :price, :duration, :image, :status, NOW())");

        $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'benefits' => $data['benefits'] ?? null,
            'samagri_included' => $data['samagri_included'] ?? null,
            'price' => (float)$data['price'],
            'duration' => $data['duration'] ?? '45 mins',
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
            'benefits = :benefits',
            'samagri_included = :samagri_included',
            'price = :price',
            'duration = :duration',
            'status = :status'
        ];

        $params = [
            'id' => $id,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'benefits' => $data['benefits'] ?? null,
            'samagri_included' => $data['samagri_included'] ?? null,
            'price' => (float)$data['price'],
            'duration' => $data['duration'],
            'status' => $data['status']
        ];

        if (array_key_exists('image', $data) && $data['image'] !== null) {
            $fields[] = 'image = :image';
            $params['image'] = $data['image'];
        }

        $sql = "UPDATE `pooja_services` SET " . implode(', ', $fields) . " WHERE `id` = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    public static function delete(int $id): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $stmt = $db->prepare("DELETE FROM `pooja_services` WHERE `id` = :id");
        return $stmt->execute(['id' => $id]);
    }
}
