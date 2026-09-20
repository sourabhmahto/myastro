<?php
/**
 * Devotees Bookings & Direct CRM API
 * Handles devotee booking submissions and admin CRM queries with Date and Status filtering
 */

require_once __DIR__ . '/config.php';

$pdo = ApiDB::get();
if (!$pdo) jsonError('Database connection unavailable. Please ensure database is imported.', 500);

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($method) {
    case 'GET':
        requireAdminAuth();
        $status = trim($_GET['status'] ?? '');
        $search = trim($_GET['search'] ?? '');
        $date = trim($_GET['date'] ?? '');
        $dateFrom = trim($_GET['date_from'] ?? '');
        $dateTo = trim($_GET['date_to'] ?? '');
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 200;

        $sql = "SELECT b.*, 
                       p.name_en AS pooja_name_en, p.name_hi AS pooja_name_hi,
                       v.title_en AS variation_title_en, v.title_hi AS variation_title_hi, v.price AS variation_price
                FROM `devotees_bookings` b 
                LEFT JOIN `poojas` p ON b.pooja_id = p.id 
                LEFT JOIN `pooja_variations` v ON b.variation_id = v.id 
                WHERE 1=1";
        $params = [];

        if (!empty($status) && $status !== 'all') {
            $sql .= " AND b.status = :status";
            $params['status'] = $status;
        }

        if (!empty($date)) {
            $sql .= " AND b.preferred_date = :pref_date";
            $params['pref_date'] = $date;
        } elseif (!empty($dateFrom) && !empty($dateTo)) {
            $sql .= " AND b.preferred_date BETWEEN :date_from AND :date_to";
            $params['date_from'] = $dateFrom;
            $params['date_to'] = $dateTo;
        }

        if (!empty($search)) {
            $sql .= " AND (b.full_name LIKE :search OR b.phone LIKE :search OR b.whatsapp_number LIKE :search OR b.gotra LIKE :search OR b.special_wishes LIKE :search)";
            $params['search'] = '%' . $search . '%';
        }

        $sql .= " ORDER BY b.preferred_date DESC, b.id DESC LIMIT " . $limit;

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $bookings = $stmt->fetchAll();

        // Attach pre-generated WhatsApp chat URLs for admin 1-click interaction
        foreach ($bookings as &$b) {
            $poojaName = $b['pooja_name_hi'] ?: ($b['pooja_name_en'] ?? 'विशेष पूजा');
            $cleanWa = preg_replace('/[^0-9]/', '', $b['whatsapp_number'] ?: $b['phone']);
            if (strlen($cleanWa) === 10) $cleanWa = '91' . $cleanWa;
            
            $msg = sprintf(
                "हर हर महादेव %s जी! 🙏\nश्री ओंकारेश्वर ज्योतिर्लिंग पर आपकी '%s' पूजा की बुकिंग के संबंध में पंडित श्याम गीते (शास्त्री जी) आपका संकल्प तैयार कर रहे हैं। कृपया अपना गोत्र एवं परिजनों के नाम साझा करें।",
                $b['full_name'],
                $poojaName
            );
            $b['whatsapp_direct_url'] = 'https://wa.me/' . $cleanWa . '?text=' . urlencode($msg);
            $b['call_tel_url'] = 'tel:' . ($b['phone'] ?: $b['whatsapp_number']);
        }

        jsonSuccess($bookings);
        break;

    case 'POST':
        $data = getJsonInput();

        $fullName = trim($data['full_name'] ?? ($data['devotee_name'] ?? ''));
        $phone = trim($data['phone'] ?? '');
        $whatsapp = trim($data['whatsapp_number'] ?? '') ?: $phone;
        $gotra = trim($data['gotra'] ?? '') ?: 'कश्यप';
        $nakshatra = trim($data['nakshatra'] ?? '');
        $poojaId = !empty($data['pooja_id']) ? (int)$data['pooja_id'] : null;
        $variationId = !empty($data['variation_id']) ? (int)$data['variation_id'] : null;
        $preferredDate = trim($data['preferred_date'] ?? ($data['pooja_date'] ?? '')) ?: date('Y-m-d');
        $specialWishes = trim($data['special_wishes'] ?? '');

        if (empty($fullName)) {
            jsonError('Please provide your full name (श्रद्धालु का नाम अनिवार्य है).', 400);
        }

        // Clean phone digits for storage
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($cleanPhone) < 10) {
            jsonError('Please provide a valid 10-digit mobile number (१० अंकों का वैध मोबाइल नंबर दर्ज करें).', 400);
        }

        try {
            // Self-healing table check
            $pdo->exec("CREATE TABLE IF NOT EXISTS `devotees_bookings` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `full_name` VARCHAR(150) NOT NULL,
                `phone` VARCHAR(25) NOT NULL,
                `whatsapp_number` VARCHAR(25) NULL,
                `gotra` VARCHAR(100) DEFAULT 'कश्यप',
                `nakshatra` VARCHAR(100) NULL,
                `pooja_id` INT NULL,
                `variation_id` INT NULL,
                `preferred_date` DATE NOT NULL,
                `special_wishes` TEXT NULL,
                `status` ENUM('Pending', 'Sankalp Done', 'Prasad Sent', 'Completed') DEFAULT 'Pending',
                `admin_notes` TEXT NULL,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX (`preferred_date`),
                INDEX (`status`),
                INDEX (`phone`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

            $stmt = $pdo->prepare("INSERT INTO `devotees_bookings` 
                (`full_name`, `phone`, `whatsapp_number`, `gotra`, `nakshatra`, `pooja_id`, `variation_id`, `preferred_date`, `special_wishes`, `status`, `created_at`) 
                VALUES (:full_name, :phone, :whatsapp, :gotra, :nakshatra, :pooja_id, :variation_id, :preferred_date, :special_wishes, 'Pending', NOW())");
            
            $stmt->execute([
                'full_name'      => $fullName,
                'phone'          => $phone,
                'whatsapp'       => $whatsapp,
                'gotra'          => $gotra,
                'nakshatra'      => $nakshatra,
                'pooja_id'       => $poojaId,
                'variation_id'   => $variationId,
                'preferred_date' => $preferredDate,
                'special_wishes' => $specialWishes
            ]);

            $bookingId = (int)$pdo->lastInsertId();
        } catch (Throwable $e) {
            error_log("Booking Insert Error: " . $e->getMessage());
            jsonError('Database error while saving booking: ' . $e->getMessage(), 500);
        }

        // Fetch Pooja details for WhatsApp redirect
        $poojaTitle = 'श्री ओंकारेश्वर ज्योतिर्लिंग पूजा संकल्प';
        $variationTitle = '';
        $price = '';
        if ($poojaId) {
            try {
                $pStmt = $pdo->prepare("SELECT `name_hi`, `name_en` FROM `poojas` WHERE `id` = :id LIMIT 1");
                $pStmt->execute(['id' => $poojaId]);
                if ($pRow = $pStmt->fetch()) {
                    $poojaTitle = $pRow['name_hi'] ?: $pRow['name_en'];
                }
            } catch (Throwable $e) {}
        }
        if ($variationId) {
            try {
                $vStmt = $pdo->prepare("SELECT `title_hi`, `title_en`, `price` FROM `pooja_variations` WHERE `id` = :id LIMIT 1");
                $vStmt->execute(['id' => $variationId]);
                if ($vRow = $vStmt->fetch()) {
                    $variationTitle = $vRow['title_hi'] ?: $vRow['title_en'];
                    $price = '₹' . number_format($vRow['price'], 0);
                }
            } catch (Throwable $e) {}
        }

        $adminWa = preg_replace('/[^0-9]/', '', ADMIN_WHATSAPP_PHONE);
        $waMessage = sprintf(
            "🕉️ *हर हर महादेव - ओंकारेश्वर ज्योतिर्लिंग पूजा संकल्प*\n\n" .
            "👤 *श्रद्धालु का नाम:* %s\n" .
            "📞 *मोबाइल:* %s\n" .
            "🌿 *गोत्र:* %s\n" .
            "⭐ *नक्षत्र:* %s\n" .
            "🪔 *पूजा:* %s\n" .
            "%s" .
            "📅 *संकल्प तिथि:* %s\n" .
            "%s" .
            "\nपंडित श्याम गीते जी, कृपया पूजा संकल्प एवं मुहूर्त की पुष्टि करें। 🙏",
            $fullName,
            $phone,
            $gotra,
            $nakshatra ?: 'ज्ञात नहीं',
            $poojaTitle,
            $variationTitle ? "✨ *पैकेज:* {$variationTitle} ({$price})\n" : "",
            $preferredDate,
            $specialWishes ? "📝 *विशेष मनोकामना:* {$specialWishes}\n" : ""
        );

        $whatsappRedirectUrl = 'https://wa.me/' . $adminWa . '?text=' . urlencode($waMessage);

        jsonSuccess([
            'booking_id'            => $bookingId,
            'whatsapp_redirect_url' => $whatsappRedirectUrl,
            'message'               => 'Sankalp booking recorded successfully!'
        ], 'हर हर महादेव! आपका पूजा संकल्प सफलतापूर्वक दर्ज कर लिया गया है।');
        break;

    case 'PUT':
        requireAdminAuth();
        $data = getJsonInput();
        $bookingId = $id ?: (int)($data['id'] ?? 0);
        if (!$bookingId) jsonError('Booking ID is required.');

        $status = trim($data['status'] ?? '');
        $adminNotes = trim($data['admin_notes'] ?? '');

        $allowedStatuses = ['Pending', 'Sankalp Done', 'Prasad Sent', 'Completed'];
        if (!in_array($status, $allowedStatuses)) {
            $status = 'Pending';
        }

        $stmt = $pdo->prepare("UPDATE `devotees_bookings` SET `status` = :status, `admin_notes` = :admin_notes WHERE `id` = :id");
        $stmt->execute([
            'status'      => $status,
            'admin_notes' => $adminNotes,
            'id'          => $bookingId
        ]);

        jsonSuccess(null, 'Booking status updated successfully.');
        break;

    case 'DELETE':
        requireAdminAuth();
        if (!$id) jsonError('Booking ID is required.');
        $stmt = $pdo->prepare("DELETE FROM `devotees_bookings` WHERE `id` = :id");
        $stmt->execute(['id' => $id]);
        jsonSuccess(null, 'Booking record removed.');
        break;

    default:
        jsonError('Method not allowed.', 405);
        break;
}
