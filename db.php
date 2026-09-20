<?php
/**
 * Direct Database Connection Handler (Root Helper)
 */
require_once __DIR__ . '/api/config.php';
$pdo = ApiDB::get();
if (!$pdo) {
    http_response_code(500);
    die(json_encode(['success' => false, 'message' => 'Database connection unavailable']));
}
