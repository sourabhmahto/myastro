<?php
/**
 * Poojas & Variations API Endpoint
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
            $stmt = $pdo->prepare("SELECT p.*, c.name_en AS category_name_en, c.name_hi AS category_name_hi, c.slug AS category_slug 
                FROM `poojas` p 
                LEFT JOIN `categories` c ON p.category_id = c.id 
                WHERE p.id = :id LIMIT 1");
            $stmt->execute(['id' => $id]);
            $pooja = $stmt->fetch();
            if (!$pooja) jsonError('Pooja not found.', 404);

            // Fetch variations
            $varStmt = $pdo->prepare("SELECT * FROM `pooja_variations` WHERE `pooja_id` = :id ORDER BY `display_order` ASC, `price` ASC");
            $varStmt->execute(['id' => $id]);
            $pooja['variations'] = $varStmt->fetchAll();

            jsonSuccess($pooja);
        } else {
            $categorySlug = trim($_GET['category'] ?? '');
            $categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
            $includeInactive = isset($_GET['all']) && $_GET['all'] === '1';

            $sql = "SELECT p.*, c.name_en AS category_name_en, c.name_hi AS category_name_hi, c.slug AS category_slug 
                    FROM `poojas` p 
                    LEFT JOIN `categories` c ON p.category_id = c.id 
                    WHERE 1=1";
            $params = [];

            if (!$includeInactive) {
                $sql .= " AND p.is_active = 1";
            }

            if ($categoryId) {
                $sql .= " AND p.category_id = :cat_id";
                $params['cat_id'] = $categoryId;
            } elseif (!empty($categorySlug) && $categorySlug !== 'all') {
                $sql .= " AND c.slug = :cat_slug";
                $params['cat_slug'] = $categorySlug;
            }

            $sql .= " ORDER BY p.display_order ASC, p.id ASC";

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $poojas = $stmt->fetchAll();

            // Fetch all variations indexed by pooja_id
            $poojaIds = array_column($poojas, 'id');
            $variationsMap = [];
            if (!empty($poojaIds)) {
                $inQuery = implode(',', array_fill(0, count($poojaIds), '?'));
                $varStmt = $pdo->prepare("SELECT * FROM `pooja_variations` WHERE `pooja_id` IN ($inQuery) ORDER BY `display_order` ASC, `price` ASC");
                $varStmt->execute($poojaIds);
                while ($var = $varStmt->fetch()) {
                    $variationsMap[$var['pooja_id']][] = $var;
                }
            }

            foreach ($poojas as &$p) {
                $p['variations'] = $variationsMap[$p['id']] ?? [];
                // Calculate starting price
                $prices = array_column($p['variations'], 'price');
                $p['starting_price'] = !empty($prices) ? min($prices) : 0;
            }

            jsonSuccess($poojas);
        }
        break;

    case 'POST':
        requireAdminAuth();
        $data = getJsonInput();

        $nameEn = trim($data['name_en'] ?? '');
        $nameHi = trim($data['name_hi'] ?? '') ?: $nameEn;
        $descEn = trim($data['description_en'] ?? '');
        $descHi = trim($data['description_hi'] ?? '') ?: $descEn;
        $categoryId = !empty($data['category_id']) ? (int)$data['category_id'] : null;
        $imageUrl = trim($data['image_url'] ?? '');
        $displayOrder = (int)($data['display_order'] ?? 0);
        $isActive = isset($data['is_active']) ? (int)$data['is_active'] : 1;

        if (empty($nameEn)) {
            jsonError('English Pooja name is required.');
        }

        $stmt = $pdo->prepare("INSERT INTO `poojas` 
            (`category_id`, `name_en`, `name_hi`, `description_en`, `description_hi`, `image_url`, `display_order`, `is_active`, `created_at`) 
            VALUES (:category_id, :name_en, :name_hi, :description_en, :description_hi, :image_url, :display_order, :is_active, NOW())");
        $stmt->execute([
            'category_id'    => $categoryId,
            'name_en'        => $nameEn,
            'name_hi'        => $nameHi,
            'description_en' => $descEn,
            'description_hi' => $descHi,
            'image_url'      => $imageUrl,
            'display_order'  => $displayOrder,
            'is_active'      => $isActive
        ]);

        $newPoojaId = (int)$pdo->lastInsertId();

        // Insert variations if provided
        if (isset($data['variations']) && is_array($data['variations'])) {
            $vStmt = $pdo->prepare("INSERT INTO `pooja_variations` (`pooja_id`, `title_en`, `title_hi`, `price`, `display_order`) 
                VALUES (:pooja_id, :title_en, :title_hi, :price, :display_order)");
            $vOrder = 1;
            foreach ($data['variations'] as $v) {
                $vTitleEn = trim($v['title_en'] ?? '');
                if (empty($vTitleEn)) continue;
                $vStmt->execute([
                    'pooja_id'      => $newPoojaId,
                    'title_en'      => $vTitleEn,
                    'title_hi'      => trim($v['title_hi'] ?? '') ?: $vTitleEn,
                    'price'         => (float)($v['price'] ?? 0),
                    'display_order' => (int)($v['display_order'] ?? $vOrder++)
                ]);
            }
        }

        jsonSuccess(['id' => $newPoojaId], 'Pooja created successfully.');
        break;

    case 'PUT':
        requireAdminAuth();
        $data = getJsonInput();
        $poojaId = $id ?: (int)($data['id'] ?? 0);
        if (!$poojaId) jsonError('Pooja ID is required.');

        // Batch reordering
        if (isset($data['order_batch']) && is_array($data['order_batch'])) {
            $upStmt = $pdo->prepare("UPDATE `poojas` SET `display_order` = :order WHERE `id` = :id");
            foreach ($data['order_batch'] as $item) {
                $upStmt->execute(['order' => (int)$item['display_order'], 'id' => (int)$item['id']]);
            }
            jsonSuccess(null, 'Pooja ordering updated.');
        }

        $stmt = $pdo->prepare("UPDATE `poojas` SET 
            `category_id`    = :category_id,
            `name_en`        = :name_en,
            `name_hi`        = :name_hi,
            `description_en` = :description_en,
            `description_hi` = :description_hi,
            `image_url`      = :image_url,
            `display_order`  = :display_order,
            `is_active`      = :is_active
            WHERE `id` = :id");
        $stmt->execute([
            'category_id'    => !empty($data['category_id']) ? (int)$data['category_id'] : null,
            'name_en'        => trim($data['name_en'] ?? ''),
            'name_hi'        => trim($data['name_hi'] ?? ''),
            'description_en' => trim($data['description_en'] ?? ''),
            'description_hi' => trim($data['description_hi'] ?? ''),
            'image_url'      => trim($data['image_url'] ?? ''),
            'display_order'  => (int)($data['display_order'] ?? 0),
            'is_active'      => (int)($data['is_active'] ?? 1),
            'id'             => $poojaId
        ]);

        // Replace variations
        if (isset($data['variations']) && is_array($data['variations'])) {
            $pdo->prepare("DELETE FROM `pooja_variations` WHERE `pooja_id` = :id")->execute(['id' => $poojaId]);
            $vStmt = $pdo->prepare("INSERT INTO `pooja_variations` (`pooja_id`, `title_en`, `title_hi`, `price`, `display_order`) 
                VALUES (:pooja_id, :title_en, :title_hi, :price, :display_order)");
            $vOrder = 1;
            foreach ($data['variations'] as $v) {
                $vTitleEn = trim($v['title_en'] ?? '');
                if (empty($vTitleEn)) continue;
                $vStmt->execute([
                    'pooja_id'      => $poojaId,
                    'title_en'      => $vTitleEn,
                    'title_hi'      => trim($v['title_hi'] ?? '') ?: $vTitleEn,
                    'price'         => (float)($v['price'] ?? 0),
                    'display_order' => (int)($v['display_order'] ?? $vOrder++)
                ]);
            }
        }

        jsonSuccess(null, 'Pooja updated successfully.');
        break;

    case 'DELETE':
        requireAdminAuth();
        if (!$id) jsonError('Pooja ID is required.');
        $stmt = $pdo->prepare("DELETE FROM `poojas` WHERE `id` = :id");
        $stmt->execute(['id' => $id]);
        jsonSuccess(null, 'Pooja deleted successfully.');
        break;

    default:
        jsonError('Method not allowed.', 405);
        break;
}
