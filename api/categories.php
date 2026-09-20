<?php
/**
 * Categories API Endpoint
 */

require_once __DIR__ . '/config.php';

$pdo = ApiDB::get();
if (!$pdo) {
    jsonError('Database connection unavailable.', 500);
}

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($method) {
    case 'GET':
        if ($id) {
            $stmt = $pdo->prepare("SELECT * FROM `categories` WHERE `id` = :id LIMIT 1");
            $stmt->execute(['id' => $id]);
            $cat = $stmt->fetch();
            if (!$cat) jsonError('Category not found.', 404);
            jsonSuccess($cat);
        } else {
            $includeInactive = isset($_GET['all']) && $_GET['all'] === '1';
            $sql = "SELECT * FROM `categories`";
            if (!$includeInactive) {
                $sql .= " WHERE `is_active` = 1";
            }
            $sql .= " ORDER BY `display_order` ASC, `id` ASC";
            $stmt = $pdo->query($sql);
            $categories = $stmt->fetchAll();
            jsonSuccess($categories);
        }
        break;

    case 'POST':
        requireAdminAuth();
        $data = getJsonInput();
        
        $nameEn = trim($data['name_en'] ?? '');
        $nameHi = trim($data['name_hi'] ?? '') ?: $nameEn;
        $slug = trim($data['slug'] ?? '') ?: strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nameEn));
        $displayOrder = (int)($data['display_order'] ?? 0);
        $isActive = isset($data['is_active']) ? (int)$data['is_active'] : 1;

        if (empty($nameEn)) {
            jsonError('English category name is required.');
        }

        $stmt = $pdo->prepare("INSERT INTO `categories` (`slug`, `name_en`, `name_hi`, `display_order`, `is_active`, `created_at`) 
            VALUES (:slug, :name_en, :name_hi, :display_order, :is_active, NOW())");
        $stmt->execute([
            'slug' => $slug,
            'name_en' => $nameEn,
            'name_hi' => $nameHi,
            'display_order' => $displayOrder,
            'is_active' => $isActive
        ]);

        $newId = (int)$pdo->lastInsertId();
        jsonSuccess(['id' => $newId], 'Category created successfully.');
        break;

    case 'PUT':
        requireAdminAuth();
        $data = getJsonInput();
        $catId = $id ?: (int)($data['id'] ?? 0);
        if (!$catId) jsonError('Category ID is required.');

        // Reordering batch support
        if (isset($data['order_batch']) && is_array($data['order_batch'])) {
            $upStmt = $pdo->prepare("UPDATE `categories` SET `display_order` = :order WHERE `id` = :id");
            foreach ($data['order_batch'] as $item) {
                $upStmt->execute(['order' => (int)$item['display_order'], 'id' => (int)$item['id']]);
            }
            jsonSuccess(null, 'Category order updated successfully.');
        }

        $stmt = $pdo->prepare("UPDATE `categories` SET 
            `name_en` = :name_en,
            `name_hi` = :name_hi,
            `slug` = :slug,
            `display_order` = :display_order,
            `is_active` = :is_active
            WHERE `id` = :id");
        $stmt->execute([
            'name_en' => trim($data['name_en'] ?? ''),
            'name_hi' => trim($data['name_hi'] ?? ''),
            'slug' => trim($data['slug'] ?? ''),
            'display_order' => (int)($data['display_order'] ?? 0),
            'is_active' => (int)($data['is_active'] ?? 1),
            'id' => $catId
        ]);

        jsonSuccess(null, 'Category updated successfully.');
        break;

    case 'DELETE':
        requireAdminAuth();
        if (!$id) jsonError('Category ID is required.');
        $stmt = $pdo->prepare("DELETE FROM `categories` WHERE `id` = :id");
        $stmt->execute(['id' => $id]);
        jsonSuccess(null, 'Category deleted successfully.');
        break;

    default:
        jsonError('Method not allowed.', 405);
        break;
}
