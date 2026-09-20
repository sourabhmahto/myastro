<?php
/**
 * Global Utility & Security Helper Functions
 */

require_once __DIR__ . '/../config/config.php';

/**
 * Sanitize and escape string for safe HTML output (XSS defense)
 */
function e(?string $string): string {
    return htmlspecialchars((string)$string, ENT_QUOTES, 'UTF-8');
}

/**
 * Generate or retrieve CSRF token
 */
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Output hidden CSRF input field
 */
function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

/**
 * Verify CSRF token from request
 */
function csrf_verify(?string $token = null): bool {
    $token = $token ?? ($_POST['csrf_token'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? ''));
    if (empty($token) || empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Generate full application URL
 * Supports clean URLs and handles subfolder deployments
 */
function url(string $path = ''): string {
    $path = ltrim($path, '/');
    if ($path === '' || $path === '/') {
        return SITE_URL . '/';
    }
    return SITE_URL . '/' . $path;
}

/**
 * Generate asset URL
 */
function asset(string $path): string {
    return SITE_URL . '/assets/' . ltrim($path, '/');
}

/**
 * Generate upload URL with fallback to default placeholder
 */
function upload_url(?string $filename, string $fallback = 'default-temple.svg'): string {
    if (!empty($filename)) {
        $localPath = UPLOADS_PATH . '/' . $filename;
        if (file_exists($localPath)) {
            return UPLOADS_URL . '/' . $filename;
        }
    }
    return asset('images/' . $fallback);
}

/**
 * Format currency with Indian Rupee symbol
 */
function format_currency(float|int|string $amount): string {
    $num = (float)$amount;
    return CURRENCY_SYMBOL . ' ' . number_format($num, 0, '.', ',');
}

/**
 * Format date nicely
 */
function format_date(?string $date, string $format = 'd M Y'): string {
    if (empty($date) || $date === '0000-00-00' || $date === '0000-00-00 00:00:00') {
        return 'N/A';
    }
    $timestamp = strtotime($date);
    return $timestamp ? date($format, $timestamp) : 'N/A';
}

/**
 * Format time (e.g. 05:00:00 -> 05:00 AM)
 */
function format_time(?string $time): string {
    if (empty($time)) {
        return 'N/A';
    }
    $timestamp = strtotime($time);
    return $timestamp ? date('h:i A', $timestamp) : $time;
}

/**
 * Set flash message
 */
function set_flash(string $type, string $message): void {
    $_SESSION['flash'] = [
        'type' => $type, // 'success', 'danger', 'warning', 'info'
        'message' => $message
    ];
}

/**
 * Get and clear flash message
 */
function get_flash(): ?array {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

/**
 * Render flash message as Bootstrap alert
 */
function render_flash(): string {
    $flash = get_flash();
    if (!$flash) {
        return '';
    }
    $type = e($flash['type']);
    $msg = e($flash['message']);
    return '<div class="alert alert-' . $type . ' alert-dismissible fade show shadow-sm" role="alert">
        ' . $msg . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

/**
 * Create URL-friendly slug
 */
function slugify(string $text): string {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'item-' . time() : $text;
}

/**
 * Sanitize user input
 */
function sanitize_input(mixed $data): mixed {
    if (is_array($data)) {
        return array_map('sanitize_input', $data);
    }
    return trim(strip_tags((string)$data));
}

/**
 * Handle secure file upload for images
 */
function handle_file_upload(array $file, string $targetDir = UPLOADS_PATH): array {
    if (!isset($file['error']) || is_array($file['error'])) {
        return ['success' => false, 'error' => 'Invalid upload parameters.'];
    }

    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return ['success' => true, 'filename' => null];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'error' => 'File upload error code: ' . $file['error']];
    }

    // Maximum 5MB
    if ($file['size'] > 5 * 1024 * 1024) {
        return ['success' => false, 'error' => 'Uploaded image must be under 5MB.'];
    }

    // Allowed mime types & extensions
    $allowedMimes = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
        'image/svg+xml' => 'svg'
    ];

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);

    if (!array_key_exists($mime, $allowedMimes)) {
        return ['success' => false, 'error' => 'Invalid file format. Allowed: JPG, PNG, WEBP, SVG.'];
    }

    $ext = $allowedMimes[$mime];
    $filename = 'omkar_' . time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $destination = $targetDir . '/' . $filename;
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return ['success' => false, 'error' => 'Failed to save uploaded file.'];
    }

    return ['success' => true, 'filename' => $filename];
}
