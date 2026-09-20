<?php
/**
 * Adhyatmik Blogs & Daily Spiritual Updates API
 */

require_once __DIR__ . '/config.php';

$pdo = ApiDB::get();
if (!$pdo) jsonError('Database connection unavailable.', 500);

// Self-healing table check
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS `blogs` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title_en` VARCHAR(255) NOT NULL,
        `title_hi` VARCHAR(255) NOT NULL,
        `content_en` LONGTEXT NOT NULL,
        `content_hi` LONGTEXT NOT NULL,
        `image_url` VARCHAR(500) NULL,
        `is_published` TINYINT(1) DEFAULT 1,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX (`is_published`),
        INDEX (`created_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
} catch (Throwable $e) {}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($method) {
    case 'GET':
        if ($id) {
            $stmt = $pdo->prepare("SELECT * FROM `blogs` WHERE `id` = :id LIMIT 1");
            $stmt->execute(['id' => $id]);
            $blog = $stmt->fetch();
            if (!$blog) jsonError('Article not found.', 404);
            jsonSuccess($blog);
        } else {
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 0;
            $all = isset($_GET['all']) && $_GET['all'] === '1';

            $sql = "SELECT * FROM `blogs`";
            if (!$all) {
                $sql .= " WHERE `is_published` = 1";
            }
            $sql .= " ORDER BY `created_at` DESC, `id` DESC";
            if ($limit > 0) {
                $sql .= " LIMIT " . $limit;
            }

            $stmt = $pdo->query($sql);
            $blogs = $stmt->fetchAll();
            jsonSuccess($blogs);
        }
        break;

    case 'POST':
        requireAdminAuth();
        $data = getJsonInput();

        $titleHi = trim($data['title_hi'] ?? '');
        $titleEn = trim($data['title_en'] ?? '') ?: $titleHi;
        $contentHi = trim($data['content_hi'] ?? '');
        $contentEn = trim($data['content_en'] ?? '') ?: $contentHi;
        $imageUrl = trim($data['image_url'] ?? '') ?: 'https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80';
        $isPublished = isset($data['is_published']) ? (int)$data['is_published'] : 1;

        if (empty($titleHi) && empty($titleEn)) {
            jsonError('Blog title is required (ब्लॉग शीर्षक अनिवार्य है).', 400);
        }
        if (empty($contentHi) && empty($contentEn)) {
            jsonError('Blog content is required (ब्लॉग सामग्री अनिवार्य है).', 400);
        }

        $stmt = $pdo->prepare("INSERT INTO `blogs` (`title_en`, `title_hi`, `content_en`, `content_hi`, `image_url`, `is_published`, `created_at`) 
            VALUES (:title_en, :title_hi, :content_en, :content_hi, :image_url, :is_published, NOW())");
        $stmt->execute([
            'title_en'     => $titleEn ?: $titleHi,
            'title_hi'     => $titleHi ?: $titleEn,
            'content_en'   => $contentEn ?: $contentHi,
            'content_hi'   => $contentHi ?: $contentEn,
            'image_url'    => $imageUrl,
            'is_published' => $isPublished
        ]);

        jsonSuccess(['id' => (int)$pdo->lastInsertId()], 'Article published successfully (ब्लॉग सफलतापूर्वक प्रकाशित हुआ).');
        break;

    case 'PUT':
        requireAdminAuth();
        $data = getJsonInput();
        $blogId = $id ?: (int)($data['id'] ?? 0);
        if (!$blogId) jsonError('Blog ID is required.', 400);

        $titleHi = trim($data['title_hi'] ?? '');
        $titleEn = trim($data['title_en'] ?? '') ?: $titleHi;
        $contentHi = trim($data['content_hi'] ?? '');
        $contentEn = trim($data['content_en'] ?? '') ?: $contentHi;
        $imageUrl = trim($data['image_url'] ?? '');
        $isPublished = isset($data['is_published']) ? (int)$data['is_published'] : 1;

        $stmt = $pdo->prepare("UPDATE `blogs` SET 
            `title_en`     = :title_en,
            `title_hi`     = :title_hi,
            `content_en`   = :content_en,
            `content_hi`   = :content_hi,
            `image_url`    = :image_url,
            `is_published` = :is_published
            WHERE `id` = :id");
        $stmt->execute([
            'title_en'     => $titleEn ?: $titleHi,
            'title_hi'     => $titleHi ?: $titleEn,
            'content_en'   => $contentEn ?: $contentHi,
            'content_hi'   => $contentHi ?: $contentEn,
            'image_url'    => $imageUrl,
            'is_published' => $isPublished,
            'id'           => $blogId
        ]);

        jsonSuccess(null, 'Article updated successfully (ब्लॉग अपडेट हो गया).');
        break;

    case 'DELETE':
        requireAdminAuth();
        if (!$id) jsonError('Blog ID is required.', 400);
        $stmt = $pdo->prepare("DELETE FROM `blogs` WHERE `id` = :id");
        $stmt->execute(['id' => $id]);
        jsonSuccess(null, 'Article deleted successfully.');
        break;

    default:
        jsonError('Method not allowed.', 405);
        break;
}
