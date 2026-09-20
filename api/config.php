<?php
/**
 * =========================================================================
 * OM KARESHWAR JYOTIRLINGA API - BACKEND CONFIGURATION
 * =========================================================================
 * Configured specifically for: Pandit Shyam Geete (पंडित श्याम गीते)
 * Location: Bamangaon, Khandwa Road, Omkareshwar
 * WhatsApp / Phone: 9977557063
 * =========================================================================
 */

// Start session before headers if possible
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    @ini_set('session.cookie_httponly', '1');
    @ini_set('session.cookie_samesite', 'Lax');
    @session_start();
}

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Handle preflight OPTIONS request
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Global Error Reporting
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', '0');

// =========================================================================
// 1. DATABASE CONFIGURATION
// =========================================================================
define('API_DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('API_DB_NAME', getenv('DB_NAME') ?: 'omkareshwar_db');
define('API_DB_USER', getenv('DB_USER') ?: 'root');
define('API_DB_PASS', getenv('DB_PASSWORD') ?: '');
define('API_DB_CHARSET', 'utf8mb4');

// =========================================================================
// 2. PANDIT SHYAM GEETE CONTACT & WHATSAPP
// =========================================================================
define('ADMIN_WHATSAPP_PHONE', '919977557063');
define('ADMIN_CALL_PHONE', '+919977557063');
define('ADMIN_NAME', 'Pandit Shyam Geete (Shastri Ji)');
define('ADMIN_ADDRESS', 'Bamangaon, Khandwa Road, Omkareshwar (M.P.)');

// =========================================================================
// DATABASE SINGLETON
// =========================================================================
class ApiDB {
    private static ?PDO $pdo = null;

    public static function get(): ?PDO {
        if (self::$pdo === null) {
            try {
                $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', API_DB_HOST, API_DB_NAME, API_DB_CHARSET);
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . API_DB_CHARSET
                ];
                self::$pdo = new PDO($dsn, API_DB_USER, API_DB_PASS, $options);
            } catch (PDOException $e) {
                // Try creating database if it doesn't exist
                try {
                    $rootDsn = sprintf('mysql:host=%s;charset=%s', API_DB_HOST, API_DB_CHARSET);
                    $rootPdo = new PDO($rootDsn, API_DB_USER, API_DB_PASS);
                    $rootPdo->exec("CREATE DATABASE IF NOT EXISTS `" . API_DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                    
                    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', API_DB_HOST, API_DB_NAME, API_DB_CHARSET);
                    self::$pdo = new PDO($dsn, API_DB_USER, API_DB_PASS, [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]);
                } catch (Exception $ex) {
                    error_log("Database connection error: " . $e->getMessage());
                    self::$pdo = null;
                }
            }
        }
        return self::$pdo;
    }
}

// JSON Output Helpers
function jsonResponse(mixed $data, int $status = 200): void {
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

function jsonSuccess(mixed $data = null, string $message = 'Success'): void {
    jsonResponse([
        'success' => true,
        'message' => $message,
        'data'    => $data
    ], 200);
}

function jsonError(string $message = 'An error occurred', int $status = 400, mixed $errors = null): void {
    jsonResponse([
        'success' => false,
        'message' => $message,
        'errors'  => $errors
    ], $status);
}

function getJsonInput(): array {
    $raw = file_get_contents('php://input');
    if (!empty($raw)) {
        // Strip UTF-8 BOM if present
        $raw = preg_replace('/^\xEF\xBB\xBF/', '', trim($raw));
        $decoded = json_decode($raw, true);
        if (is_array($decoded)) {
            return $decoded;
        }
    }
    return !empty($_POST) ? $_POST : [];
}

function requireAdminAuth(): array {
    $headers = function_exists('getallheaders') ? getallheaders() : [];
    $authHeader = $headers['Authorization'] ?? ($headers['authorization'] ?? ($_SERVER['HTTP_AUTHORIZATION'] ?? ''));
    
    // 1. Check Session
    if (isset($_SESSION['admin_user']) && is_array($_SESSION['admin_user'])) {
        return $_SESSION['admin_user'];
    }

    // 2. Check Bearer Token (Strict hex cryptographic token)
    $token = '';
    if (!empty($authHeader) && preg_match('/Bearer\s+([a-f0-9]{32,128})/i', $authHeader, $matches)) {
        $token = trim($matches[1]);
    } elseif (!empty($_POST['token']) && preg_match('/^[a-f0-9]{32,128}$/i', $_POST['token'])) {
        $token = trim($_POST['token']);
    } elseif (!empty($_GET['token']) && preg_match('/^[a-f0-9]{32,128}$/i', $_GET['token'])) {
        $token = trim($_GET['token']);
    } elseif (!empty($_COOKIE['admin_token']) && preg_match('/^[a-f0-9]{32,128}$/i', $_COOKIE['admin_token'])) {
        $token = trim($_COOKIE['admin_token']);
    }

    if (!empty($token)) {
        // Match with session token
        if (!empty($_SESSION['admin_token']) && hash_equals($_SESSION['admin_token'], $token)) {
            return $_SESSION['admin_user'] ?? ['id' => 1, 'role' => 'admin', 'name' => ADMIN_NAME];
        }

        // Match with DB token in users_v2
        $pdo = ApiDB::get();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("SELECT `id`, `name`, `email`, `role` FROM `users_v2` WHERE `api_token` = :token AND `role` = 'admin' LIMIT 1");
                $stmt->execute(['token' => $token]);
                $user = $stmt->fetch();
                if ($user) {
                    $_SESSION['admin_user'] = $user;
                    $_SESSION['admin_token'] = $token;
                    return $user;
                }
            } catch (Throwable $e) {}
        }
    }

    jsonError('Unauthorized access. Please login with your administrator credentials.', 401);
    exit;
}
