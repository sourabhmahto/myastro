<?php
/**
 * Vidwan Pandits & Shastri Ji Management API
 * Supports CRUD, dynamic star ratings, experience, and image associations
 */

require_once __DIR__ . '/config.php';

$pdo = ApiDB::get();
if (!$pdo) jsonError('Database connection unavailable.', 500);

// Self-healing pandits table creation
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS `pandits` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name_hi` VARCHAR(150) NOT NULL,
        `name_en` VARCHAR(150) NOT NULL,
        `title_hi` VARCHAR(100) DEFAULT 'तीर्थ पुरोहित',
        `title_en` VARCHAR(100) DEFAULT 'Tirth Purohit',
        `specialization_hi` VARCHAR(255) DEFAULT 'रुद्राभिषेक, महामृत्युंजय जाप, कालसर्प शांति',
        `specialization_en` VARCHAR(255) DEFAULT 'Rudrabhishek, Mahamrityunjaya Jaap, Kaal Sarp Shanti',
        `experience_years` INT DEFAULT 12,
        `rating` DECIMAL(2,1) DEFAULT 4.9,
        `reviews_count` INT DEFAULT 150,
        `image_url` VARCHAR(500) NULL,
        `phone` VARCHAR(25) DEFAULT '9977557063',
        `whatsapp_number` VARCHAR(25) DEFAULT '919977557063',
        `bio_hi` TEXT NULL,
        `bio_en` TEXT NULL,
        `display_order` INT DEFAULT 0,
        `is_active` TINYINT(1) DEFAULT 1,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX (`is_active`),
        INDEX (`display_order`),
        INDEX (`rating`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    // Check if empty and seed initial verified Pandits
    $pCount = (int)$pdo->query("SELECT COUNT(*) FROM `pandits`")->fetchColumn();
    if ($pCount === 0) {
        $pdo->exec("INSERT INTO `pandits` 
            (`name_hi`, `name_en`, `title_hi`, `title_en`, `specialization_hi`, `specialization_en`, `experience_years`, `rating`, `reviews_count`, `image_url`, `phone`, `whatsapp_number`, `bio_hi`, `bio_en`, `display_order`, `is_active`) 
            VALUES 
            ('पंडित श्याम गीते', 'Pandit Shyam Geete', 'मुख्य तीर्थ पुरोहित एवं ज्योतिषाचार्य', 'Head Priest & Jyotishacharya', 'रुद्राभिषेक, कालसर्प दोष शांति, नर्मदा महाआरती, महामृत्युंजय अनुष्ठान', 'Rudrabhishek, Kaalsarp Dosh Shanti, Narmada Maha Aarti, Mahamrityunjay Anushthan', 18, 5.0, 380, 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=500&auto=format&fit=crop&q=80', '9977557063', '919977557063', 'ओंकारेश्वर ज्योतिर्लिंग के प्रतिष्ठित तीर्थ पुरोहित। १८ वर्षों से शास्त्रोक्त वैदिक अनुष्ठान एवं व्यक्तिगत गोत्र संकल्प सेवा।', 'Renowned head priest at Omkareshwar Jyotirlinga with 18+ years of authentic Vedic Anushthan and Gotra Sankalp experience.', 1, 1),
            ('पंडित देवकीनंदन शास्त्री', 'Pandit Devkinandan Shastri', 'वेदमूर्ति एवं कर्मकाण्ड विशेषज्ञ', 'Veda Murti & Karmakand Expert', 'नवग्रह शांति, महालक्ष्मी यज्ञ, पितृदोष निवारण', 'Navgrah Shanti, Mahalakshmi Yagya, Pitra Dosh Nivaran', 14, 4.9, 210, 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=500&auto=format&fit=crop&q=80', '9977557063', '919977557063', 'शुक्ल यजुर्वेद पारायण एवं ग्रह दोष शांति के सिद्ध विद्वान।', 'Specialist in Shukla Yajurveda and celestial Graha Shanti rituals.', 2, 1),
            ('पंडित ओंकारेश्वर जोशी', 'Pandit Omkareshwar Joshi', 'संस्कृत विद्यापीठ आचार्य', 'Sanskrit Vidya Peeth Acharya', 'लघुरुद्र, रुद्राष्टाध्यायी पाठ, वास्तु दोष निवारण', 'Laghurudra, Rudrashtadhyayi Paath, Vastu Dosh Shanti', 12, 4.8, 165, 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&auto=format&fit=crop&q=80', '9977557063', '919977557063', 'शास्त्रोक्त वास्तु शांति एवं नर्मदा अभिषेक के निष्णात आचार्य।', 'Expert in traditional Vastu Shanti and holy Narmada Abhishek.', 3, 1)");
    }
} catch (Throwable $e) {
    error_log("Pandits init error: " . $e->getMessage());
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($method) {
    case 'GET':
        $showAll = isset($_GET['admin']) && $_GET['admin'] == '1';
        $sql = "SELECT * FROM `pandits`";
        if (!$showAll) {
            $sql .= " WHERE `is_active` = 1";
        }
        $sql .= " ORDER BY `display_order` ASC, `rating` DESC, `id` ASC";
        
        $stmt = $pdo->query($sql);
        $pandits = $stmt->fetchAll();

        // Add formatted WhatsApp url
        foreach ($pandits as &$p) {
            $cleanWa = preg_replace('/[^0-9]/', '', $p['whatsapp_number'] ?: '919977557063');
            if (strlen($cleanWa) === 10) $cleanWa = '91' . $cleanWa;
            $msg = sprintf(
                "हर हर महादेव %s जी! 🙏\nमुझे ओंकारेश्वर तीर्थ पर पूजा संकल्प एवं मार्गदर्शन के संबंध में आपसे परामर्श करना है।",
                $p['name_hi'] ?: $p['name_en']
            );
            $p['whatsapp_direct_url'] = 'https://wa.me/' . $cleanWa . '?text=' . urlencode($msg);
            $p['call_tel_url'] = 'tel:' . ($p['phone'] ?: '9977557063');
        }

        jsonSuccess($pandits);
        break;

    case 'POST':
        requireAdminAuth();
        $data = getJsonInput();

        $nameHi = trim($data['name_hi'] ?? '');
        $nameEn = trim($data['name_en'] ?? '') ?: $nameHi;
        $titleHi = trim($data['title_hi'] ?? 'तीर्थ पुरोहित');
        $titleEn = trim($data['title_en'] ?? 'Tirth Purohit');
        $specHi = trim($data['specialization_hi'] ?? 'रुद्राभिषेक, महामृत्युंजय जाप');
        $specEn = trim($data['specialization_en'] ?? 'Rudrabhishek, Mahamrityunjay');
        $experience = max(1, (int)($data['experience_years'] ?? 5));
        $rating = min(5.0, max(1.0, (float)($data['rating'] ?? 4.9)));
        $reviewsCount = max(0, (int)($data['reviews_count'] ?? 100));
        $imageUrl = trim($data['image_url'] ?? '') ?: 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=500&auto=format&fit=crop&q=80';
        $phone = trim($data['phone'] ?? '9977557063');
        $whatsapp = trim($data['whatsapp_number'] ?? '919977557063');
        $bioHi = trim($data['bio_hi'] ?? '');
        $bioEn = trim($data['bio_en'] ?? '');
        $displayOrder = (int)($data['display_order'] ?? 0);
        $isActive = isset($data['is_active']) ? (int)$data['is_active'] : 1;

        if (empty($nameHi)) {
            jsonError('Pandit name in Hindi is required (पंडित जी का नाम अनिवार्य है).', 400);
        }

        $stmt = $pdo->prepare("INSERT INTO `pandits` 
            (`name_hi`, `name_en`, `title_hi`, `title_en`, `specialization_hi`, `specialization_en`, `experience_years`, `rating`, `reviews_count`, `image_url`, `phone`, `whatsapp_number`, `bio_hi`, `bio_en`, `display_order`, `is_active`) 
            VALUES (:name_hi, :name_en, :title_hi, :title_en, :spec_hi, :spec_en, :exp, :rating, :rev, :img, :phone, :wa, :bio_hi, :bio_en, :order, :active)");

        $stmt->execute([
            'name_hi'  => $nameHi,
            'name_en'  => $nameEn,
            'title_hi' => $titleHi,
            'title_en' => $titleEn,
            'spec_hi'  => $specHi,
            'spec_en'  => $specEn,
            'exp'      => $experience,
            'rating'   => $rating,
            'rev'      => $reviewsCount,
            'img'      => $imageUrl,
            'phone'    => $phone,
            'wa'       => $whatsapp,
            'bio_hi'   => $bioHi,
            'bio_en'   => $bioEn,
            'order'    => $displayOrder,
            'active'   => $isActive
        ]);

        $newId = (int)$pdo->lastInsertId();
        jsonSuccess(['id' => $newId], 'Pandit profile created successfully (पंडित जी का प्रोफाइल सफलतापूर्वक जोड़ा गया).');
        break;

    case 'PUT':
        requireAdminAuth();
        $data = getJsonInput();
        $panditId = $id ?: (int)($data['id'] ?? 0);

        if (!$panditId) jsonError('Pandit ID is required for update.', 400);

        $nameHi = trim($data['name_hi'] ?? '');
        $nameEn = trim($data['name_en'] ?? '') ?: $nameHi;
        $titleHi = trim($data['title_hi'] ?? 'तीर्थ पुरोहित');
        $titleEn = trim($data['title_en'] ?? 'Tirth Purohit');
        $specHi = trim($data['specialization_hi'] ?? '');
        $specEn = trim($data['specialization_en'] ?? '');
        $experience = (int)($data['experience_years'] ?? 10);
        $rating = min(5.0, max(1.0, (float)($data['rating'] ?? 4.9)));
        $reviewsCount = (int)($data['reviews_count'] ?? 100);
        $imageUrl = trim($data['image_url'] ?? '');
        $phone = trim($data['phone'] ?? '9977557063');
        $whatsapp = trim($data['whatsapp_number'] ?? '919977557063');
        $bioHi = trim($data['bio_hi'] ?? '');
        $bioEn = trim($data['bio_en'] ?? '');
        $displayOrder = (int)($data['display_order'] ?? 0);
        $isActive = isset($data['is_active']) ? (int)$data['is_active'] : 1;

        if (empty($nameHi)) {
            jsonError('Pandit name in Hindi is required.', 400);
        }

        $stmt = $pdo->prepare("UPDATE `pandits` SET 
            `name_hi` = :name_hi,
            `name_en` = :name_en,
            `title_hi` = :title_hi,
            `title_en` = :title_en,
            `specialization_hi` = :spec_hi,
            `specialization_en` = :spec_en,
            `experience_years` = :exp,
            `rating` = :rating,
            `reviews_count` = :rev,
            `image_url` = :img,
            `phone` = :phone,
            `whatsapp_number` = :wa,
            `bio_hi` = :bio_hi,
            `bio_en` = :bio_en,
            `display_order` = :order,
            `is_active` = :active
            WHERE `id` = :id");

        $stmt->execute([
            'name_hi'  => $nameHi,
            'name_en'  => $nameEn,
            'title_hi' => $titleHi,
            'title_en' => $titleEn,
            'spec_hi'  => $specHi,
            'spec_en'  => $specEn,
            'exp'      => $experience,
            'rating'   => $rating,
            'rev'      => $reviewsCount,
            'img'      => $imageUrl,
            'phone'    => $phone,
            'wa'       => $whatsapp,
            'bio_hi'   => $bioHi,
            'bio_en'   => $bioEn,
            'order'    => $displayOrder,
            'active'   => $isActive,
            'id'       => $panditId
        ]);

        jsonSuccess(null, 'Pandit profile and rating updated successfully (प्रोफाइल एवं रेटिंग अपडेट हो गई).');
        break;

    case 'DELETE':
        requireAdminAuth();
        if (!$id) jsonError('Pandit ID is required.');
        $stmt = $pdo->prepare("DELETE FROM `pandits` WHERE `id` = :id");
        $stmt->execute(['id' => $id]);
        jsonSuccess(null, 'Pandit profile removed successfully.');
        break;

    default:
        jsonError('Method not allowed.', 405);
        break;
}
