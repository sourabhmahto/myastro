<?php
/**
 * Omkareshwar Jyotirlinga Pilgrimage & Temple Tourism Portal
 * Global Application Configuration
 * Compatible with PHP 8.2+ and GoDaddy Linux / cPanel Shared Hosting
 */

// Error reporting: development display can be toggled via ENVIRONMENT
define('ENVIRONMENT', 'production'); // Set to 'development' or 'production'

if (ENVIRONMENT === 'development') {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
}

// --------------------------------------------------------------------------
// Database Credentials
// Update these values to match your GoDaddy cPanel MySQL database details
// --------------------------------------------------------------------------
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'omkareshwar_db');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB_CHARSET', 'utf8mb4');

// --------------------------------------------------------------------------
// Site URL & Base Paths
// Dynamically auto-detects current protocol, host, and subfolder
// --------------------------------------------------------------------------
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$baseFolder = trim($scriptDir, '/');
$siteUrl = rtrim($protocol . $host . ($baseFolder ? '/' . $baseFolder : ''), '/');

// Allow override via environment or static define if needed
define('SITE_URL', getenv('SITE_URL') ?: $siteUrl);
define('BASE_PATH', dirname(__DIR__));
define('UPLOADS_PATH', BASE_PATH . '/uploads');
define('UPLOADS_URL', SITE_URL . '/uploads');

// --------------------------------------------------------------------------
// Site Meta & Contact Details
// --------------------------------------------------------------------------
define('SITE_NAME', 'श्री ओंकारेश्वर ज्योतिर्लिंग - पंडित श्याम गीते');
define('SITE_TAGLINE', 'वैदिक पूजा, अनुष्ठान एवं ज्योतिष सेवा');
define('CONTACT_PHONE', '+91 99775 57063');
define('CONTACT_PHONE_SECONDARY', '+91 99775 57063');
define('CONTACT_EMAIL', 'shyamgeete@omkareshwar.local');
define('OFFICE_ADDRESS', 'बामनगांव, खंडवा रोड, ओंकारेश्वर तीर्थ (म.प्र.) - 450554');
define('CURRENCY_SYMBOL', '₹');
define('DEFAULT_TIMEZONE', 'Asia/Kolkata');

// Set application timezone
date_default_timezone_set(DEFAULT_TIMEZONE);

// --------------------------------------------------------------------------
// Google Maps Configuration
// Configurable without requiring paid API key; embed URL provided as fallback
// --------------------------------------------------------------------------
define('GOOGLE_MAPS_API_KEY', getenv('GOOGLE_MAPS_API_KEY') ?: '');
define('GOOGLE_MAPS_EMBED_URL', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3698.8094622064115!2d76.14841131542618!3d22.246419985352055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396262fe5e3b6ea9%3A0x7d6a506bf1a88b50!2sShri%20Omkareshwar%20Jyotirlinga%20Temple!5e0!3m2!1sen!2sin!4v1680000000000!5m2!1sen!2sin');

// --------------------------------------------------------------------------
// Mail / SMTP Settings (Optional for notifications)
// --------------------------------------------------------------------------
define('MAIL_HOST', getenv('MAIL_HOST') ?: 'smtp.example.com');
define('MAIL_PORT', (int)(getenv('MAIL_PORT') ?: 587));
define('MAIL_USERNAME', getenv('MAIL_USERNAME') ?: '');
define('MAIL_PASSWORD', getenv('MAIL_PASSWORD') ?: '');
define('MAIL_FROM_ADDRESS', getenv('MAIL_FROM_ADDRESS') ?: 'noreply@omkareshwarjyotirlinga.org');
define('MAIL_FROM_NAME', getenv('MAIL_FROM_NAME') ?: SITE_NAME);

// --------------------------------------------------------------------------
// Session Security Settings
// --------------------------------------------------------------------------
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_samesite', 'Lax');
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        ini_set('session.cookie_secure', '1');
    }
    session_start();
}
