<?php
/**
 * User / Devotee Model
 */

require_once __DIR__ . '/../config/database.php';

class User {
    public static function getAll(): array {
        $db = Database::getInstance();
        if (!$db) return [];

        $stmt = $db->query("SELECT `id`, `name`, `email`, `phone`, `status`, `created_at` FROM `users` ORDER BY `id` DESC");
        return $stmt->fetchAll();
    }

    public static function getById(int $id): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT `id`, `name`, `email`, `phone`, `status`, `created_at` FROM `users` WHERE `id` = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function findOrCreateByContact(string $name, string $email, string $phone): int {
        $db = Database::getInstance();
        if (!$db) return 0;

        $email = strtolower(trim($email));
        $stmt = $db->prepare("SELECT `id` FROM `users` WHERE `email` = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            return (int)$user['id'];
        }

        $ins = $db->prepare("INSERT INTO `users` (`name`, `email`, `phone`, `status`, `created_at`) 
            VALUES (:name, :email, :phone, 'active', NOW())");
        $ins->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ]);

        return (int)$db->lastInsertId();
    }
}
