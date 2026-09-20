<?php
/**
 * Omkareshwar Jyotirlinga Pooja & Astro Seva
 * Unified Router & API Gateway (Vue 3 + PHP PDO Backend)
 * Compatible with PHP 8.2+ and GoDaddy Linux / cPanel Shared Hosting
 */

// --------------------------------------------------------------------------
// Resolve Route
// --------------------------------------------------------------------------
$route = '';

if (isset($_GET['route'])) {
    $route = trim($_GET['route'], '/');
} else {
    $requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    $basePath = trim($scriptDir, '/');

    if ($basePath && str_starts_with(trim($requestUri, '/'), $basePath)) {
        $route = substr(trim($requestUri, '/'), strlen($basePath));
    } else {
        $route = trim($requestUri, '/');
    }
    $route = trim($route, '/');
}

$segments = explode('/', $route);
$segment1 = $segments[0] ?? '';
$segment2 = $segments[1] ?? '';

// 1. API Direct Routing (/api/...)
if ($segment1 === 'api') {
    $apiFile = __DIR__ . '/api/' . ($segment2 ? basename($segment2) . '.php' : 'poojas.php');
    if (file_exists($apiFile)) {
        require_once $apiFile;
        exit;
    } else {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'API endpoint not found.']);
        exit;
    }
}

// 2. Serve Vue 3 SPA Application for all web routes
if (file_exists(__DIR__ . '/index.html')) {
    include __DIR__ . '/index.html';
    exit;
}

// Fallback error
http_response_code(500);
echo "Omkareshwar Seva Portal is initializing...";
