<?php
/**
 * ContactMessage Model
 */

require_once __DIR__ . '/../config/database.php';

class ContactMessage {
    public static function create(array $data): int {
        $db = Database::getInstance();
        if (!$db) return 0;

        $stmt = $db->prepare("INSERT INTO `contact_messages` 
            (`name`, `email`, `phone`, `message`, `status`, `created_at`) 
            VALUES (:name, :email, :phone, :message, 'unread', NOW())");

        $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'message' => $data['message']
        ]);

        return (int)$db->lastInsertId();
    }

    public static function getAll(string $status = 'all'): array {
        $db = Database::getInstance();
        if (!$db) return [];

        $sql = "SELECT * FROM `contact_messages` WHERE 1=1";
        $params = [];

        if ($status !== 'all') {
            $sql .= " AND `status` = :status";
            $params['status'] = $status;
        }

        $sql .= " ORDER BY `id` DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function getById(int $id): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT * FROM `contact_messages` WHERE `id` = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function updateStatus(int $id, string $status): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $stmt = $db->prepare("UPDATE `contact_messages` SET `status` = :status WHERE `id` = :id");
        return $stmt->execute([
            'status' => $status,
            'id' => $id
        ]);
    }

    public static function delete(int $id): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $stmt = $db->prepare("DELETE FROM `contact_messages` WHERE `id` = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function getUnreadCount(): int {
        $db = Database::getInstance();
        if (!$db) return 0;

        $stmt = $db->query("SELECT COUNT(*) FROM `contact_messages` WHERE `status` = 'unread'");
        return (int)$stmt->fetchColumn();
    }
}
