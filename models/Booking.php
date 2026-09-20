<?php
/**
 * Booking Model
 */

require_once __DIR__ . '/../config/database.php';

class Booking {
    /**
     * Generate unique booking reference number (e.g. OMK-2026-7842)
     */
    public static function generateBookingNumber(): string {
        $year = date('Y');
        $random = strtoupper(bin2hex(random_bytes(2)));
        $num = mt_rand(1000, 9999);
        return sprintf('OMK-%s-%04d', $year, $num);
    }

    /**
     * Check for duplicate bookings to prevent spam or double-booking
     */
    public static function isDuplicate(int $poojaServiceId, string $date, string $time, string $email, string $phone): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        $stmt = $db->prepare("SELECT `id` FROM `bookings` 
            WHERE `pooja_service_id` = :pooja_id 
              AND `booking_date` = :bdate 
              AND `booking_time` = :btime 
              AND (`customer_email` = :email OR `customer_phone` = :phone)
              AND `booking_status` != 'cancelled'
            LIMIT 1");

        $stmt->execute([
            'pooja_id' => $poojaServiceId,
            'bdate' => $date,
            'btime' => $time,
            'email' => $email,
            'phone' => $phone
        ]);

        return (bool)$stmt->fetch();
    }

    /**
     * Create a new booking
     */
    public static function create(array $data): array {
        $db = Database::getInstance();
        if (!$db) {
            return ['success' => false, 'error' => 'Database connection failed.'];
        }

        // Validate duplicate
        if (self::isDuplicate(
            (int)$data['pooja_service_id'],
            $data['booking_date'],
            $data['booking_time'],
            $data['customer_email'],
            $data['customer_phone']
        )) {
            return [
                'success' => false,
                'error' => 'A booking with this contact detail for the selected Pooja date and time slot already exists. Please check your existing booking or select a different time.'
            ];
        }

        // Ensure unique booking number
        do {
            $bookingNumber = self::generateBookingNumber();
            $checkStmt = $db->prepare("SELECT `id` FROM `bookings` WHERE `booking_number` = :bnum LIMIT 1");
            $checkStmt->execute(['bnum' => $bookingNumber]);
        } while ($checkStmt->fetch());

        $stmt = $db->prepare("INSERT INTO `bookings` 
            (`booking_number`, `user_id`, `pooja_service_id`, `booking_date`, `booking_time`, `customer_name`, `customer_phone`, `customer_email`, `amount`, `payment_status`, `booking_status`, `special_requests`, `created_at`) 
            VALUES (:booking_number, :user_id, :pooja_service_id, :booking_date, :booking_time, :customer_name, :customer_phone, :customer_email, :amount, :payment_status, :booking_status, :special_requests, NOW())");

        $success = $stmt->execute([
            'booking_number' => $bookingNumber,
            'user_id' => $data['user_id'] ?? null,
            'pooja_service_id' => (int)$data['pooja_service_id'],
            'booking_date' => $data['booking_date'],
            'booking_time' => $data['booking_time'],
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'customer_email' => $data['customer_email'],
            'amount' => (float)$data['amount'],
            'payment_status' => $data['payment_status'] ?? 'pending',
            'booking_status' => $data['booking_status'] ?? 'pending',
            'special_requests' => $data['special_requests'] ?? null
        ]);

        if ($success) {
            return [
                'success' => true,
                'booking_id' => (int)$db->lastInsertId(),
                'booking_number' => $bookingNumber
            ];
        }

        return ['success' => false, 'error' => 'Failed to save booking. Please try again.'];
    }

    /**
     * Get booking details by ID with Pooja service information
     */
    public static function getById(int $id): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT b.*, p.name AS pooja_name, p.duration AS pooja_duration, p.samagri_included 
            FROM `bookings` b 
            LEFT JOIN `pooja_services` p ON b.pooja_service_id = p.id 
            WHERE b.id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Get booking details by booking number
     */
    public static function getByBookingNumber(string $bookingNumber): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT b.*, p.name AS pooja_name, p.duration AS pooja_duration, p.samagri_included 
            FROM `bookings` b 
            LEFT JOIN `pooja_services` p ON b.pooja_service_id = p.id 
            WHERE b.booking_number = :bnum LIMIT 1");
        $stmt->execute(['bnum' => trim($bookingNumber)]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Find booking by booking number and phone or email (for tracking portal)
     */
    public static function findByNumberAndContact(string $bookingNumber, string $contact): ?array {
        $db = Database::getInstance();
        if (!$db) return null;

        $contact = trim(strtolower($contact));
        $cleanPhone = preg_replace('/[^\d]/', '', $contact);

        $stmt = $db->prepare("SELECT b.*, p.name AS pooja_name, p.duration AS pooja_duration, p.samagri_included 
            FROM `bookings` b 
            LEFT JOIN `pooja_services` p ON b.pooja_service_id = p.id 
            WHERE b.booking_number = :bnum 
              AND (LOWER(b.customer_email) = :contact OR REPLACE(REPLACE(b.customer_phone, ' ', ''), '-', '') LIKE :phone)
            LIMIT 1");

        $stmt->execute([
            'bnum' => trim($bookingNumber),
            'contact' => $contact,
            'phone' => '%' . ($cleanPhone ?: 'nomatch') . '%'
        ]);

        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Get all bookings with optional filters
     */
    public static function getAll(array $filters = []): array {
        $db = Database::getInstance();
        if (!$db) return [];

        $sql = "SELECT b.*, p.name AS pooja_name 
                FROM `bookings` b 
                LEFT JOIN `pooja_services` p ON b.pooja_service_id = p.id 
                WHERE 1=1";
        $params = [];

        if (!empty($filters['status'])) {
            $sql .= " AND b.booking_status = :status";
            $params['status'] = $filters['status'];
        }

        if (!empty($filters['date'])) {
            $sql .= " AND b.booking_date = :bdate";
            $params['bdate'] = $filters['date'];
        }

        if (!empty($filters['search'])) {
            $sql .= " AND (b.booking_number LIKE :search OR b.customer_name LIKE :search OR b.customer_phone LIKE :search OR b.customer_email LIKE :search)";
            $params['search'] = '%' . $filters['search'] . '%';
        }

        $sql .= " ORDER BY b.id DESC";

        if (!empty($filters['limit'])) {
            $sql .= " LIMIT " . (int)$filters['limit'];
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Update booking status and payment status
     */
    public static function updateStatus(int $id, string $bookingStatus, ?string $paymentStatus = null): bool {
        $db = Database::getInstance();
        if (!$db) return false;

        if ($paymentStatus !== null) {
            $stmt = $db->prepare("UPDATE `bookings` SET `booking_status` = :b_status, `payment_status` = :p_status WHERE `id` = :id");
            return $stmt->execute([
                'b_status' => $bookingStatus,
                'p_status' => $paymentStatus,
                'id' => $id
            ]);
        }

        $stmt = $db->prepare("UPDATE `bookings` SET `booking_status` = :b_status WHERE `id` = :id");
        return $stmt->execute([
            'b_status' => $bookingStatus,
            'id' => $id
        ]);
    }

    /**
     * Retrieve aggregated statistics for dashboard
     */
    public static function getStats(): array {
        $db = Database::getInstance();
        if (!$db) {
            return [
                'total' => 0,
                'confirmed' => 0,
                'pending' => 0,
                'completed' => 0,
                'revenue' => 0.0
            ];
        }

        $stats = [
            'total' => 0,
            'confirmed' => 0,
            'pending' => 0,
            'completed' => 0,
            'revenue' => 0.0
        ];

        $stmt = $db->query("SELECT `booking_status`, COUNT(*) AS count, SUM(CASE WHEN `payment_status` = 'paid' THEN `amount` ELSE 0 END) as paid_sum FROM `bookings` GROUP BY `booking_status`");
        while ($row = $stmt->fetch()) {
            $status = $row['booking_status'];
            $stats['total'] += (int)$row['count'];
            if (isset($stats[$status])) {
                $stats[$status] = (int)$row['count'];
            }
            $stats['revenue'] += (float)$row['paid_sum'];
        }

        return $stats;
    }
}
