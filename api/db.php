<?php
/**
 * Direct Database Connection Handler (Azure Environment Variables + Local Fallback)
 */
require_once __DIR__ . '/config.php';
$pdo = ApiDB::get();
if (!$pdo) {
    http_response_code(500);
    die(json_encode(['success' => false, 'message' => 'Database connection unavailable']));
}
