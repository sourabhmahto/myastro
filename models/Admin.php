<?php
/**
 * Admin Model
 */

require_once __DIR__ . '/../config/database.php';

class Admin {
    public static function getAll(): array {
        $db = Database::getInstance();
        if (!$db) return [];

        $stmt = $db->query("SELECT `id`, `name`, `email`, `role`, `created_at` FROM `admins` ORDER BY `id` ASC");
        return $stmt->fetchAll();
    }

    public static function getById(int $id): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT `id`, `name`, `email`, `role`, `created_at` FROM `admins` WHERE `id` = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $data): int {
        $db = Database::getInstance();
        if (!$db) return 0;

        $hash = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO `admins` (`name`, `email`, `password_hash`, `role`, `created_at`) 
            VALUES (:name, :email, :hash, :role, NOW())");

        $stmt->execute([
            'name' => $data['name'],
            'email' => strtolower(trim($data['email'])),
            'hash' => $hash,
            'role' => $data['role'] ?? 'superadmin'
        ]);

        return (int)$db->lastInsertId();
    }

    public static function updatePassword(int $id, string $newPassword): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE `admins` SET `password_hash` = :hash WHERE `id` = :id");
        return $stmt->execute(['hash' => $hash, 'id' => $id]);
    }
}
