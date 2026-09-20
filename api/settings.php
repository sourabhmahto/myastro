<?php
/**
 * Site Settings & Contact Configuration API
 */

require_once __DIR__ . '/config.php';

$pdo = ApiDB::get();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $settings = [
        'pandit_name_hi'    => 'पंडित श्याम गीते (शास्त्री जी)',
        'pandit_name_en'    => 'Pandit Shyam Geete (Shastri Ji)',
        'phone_number'      => '+91 99775 57063',
        'whatsapp_number'   => '919977557063',
        'temple_address_hi' => 'स्थान: बामनगांव, खंडवा रोड, ओंकारेश्वर तीर्थ (म.प्र.)',
        'temple_address_en' => 'Location: Bamangaon, Khandwa Road, Omkareshwar (M.P.)',
        'google_maps_url'   => 'https://maps.google.com/?q=Bamangaon,+Khandwa+Road,+Omkareshwar',
        'aarti_timings_hi'  => 'दैनिक आरती समय: मंगल 05:00 AM | भोग 12:00 PM | शयन 09:00 PM',
        'aarti_timings_en'  => 'Daily Aarti: Mangal 05:00 AM | Bhog 12:00 PM | Shayan 09:00 PM'
    ];

    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT `setting_key`, `setting_value` FROM `site_settings`");
            while ($row = $stmt->fetch()) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        } catch (Exception $e) {
            // fallback to default array
        }
    }

    jsonSuccess($settings);
}

if ($method === 'POST') {
    requireAdminAuth();
    $data = getJsonInput();
    if (!$pdo) jsonError('Database unavailable.', 500);

    $upStmt = $pdo->prepare("INSERT INTO `site_settings` (`setting_key`, `setting_value`) 
        VALUES (:k, :v) ON DUPLICATE KEY UPDATE `setting_value` = :v");

    foreach ($data as $key => $val) {
        $upStmt->execute(['k' => $key, 'v' => is_string($val) ? $val : json_encode($val)]);
    }

    jsonSuccess(null, 'Settings updated successfully.');
}

jsonError('Method not allowed.', 405);
