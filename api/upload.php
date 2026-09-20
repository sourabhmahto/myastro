<?php
/**
 * Image Upload API Endpoint (< 2MB Strict Limit)
 */

require_once __DIR__ . '/config.php';
requireAdminAuth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_FILES['file'])) {
    jsonError('No image file uploaded.');
}

$file = $_FILES['file'];
if ($file['error'] !== UPLOAD_ERR_OK) {
    if ($file['error'] === UPLOAD_ERR_INI_SIZE || $file['error'] === UPLOAD_ERR_FORM_SIZE) {
        jsonError('File size exceeds server limit. Please upload an image smaller than 2MB.', 400);
    }
    jsonError('File upload error code: ' . $file['error'], 400);
}

// 2MB STRICT MAXIMUM SIZE CHECK (2,097,152 bytes)
$maxSizeBytes = 2 * 1024 * 1024;
if ($file['size'] > $maxSizeBytes) {
    jsonError('Image file is too large (' . round($file['size'] / 1024 / 1024, 2) . 'MB). Maximum allowed size is 2MB.', 400);
}

// Robust MIME Detection using getimagesize() or extension inspection
$mime = '';
if (function_exists('getimagesize')) {
    $imgInfo = @getimagesize($file['tmp_name']);
    if ($imgInfo && !empty($imgInfo['mime'])) {
        $mime = $imgInfo['mime'];
    }
}

if (empty($mime) && function_exists('mime_content_type')) {
    $mime = @mime_content_type($file['tmp_name']);
}

// Fallback using original extension if functions unavailable
$origExt = strtolower(pathinfo($file['name'] ?? '', PATHINFO_EXTENSION));
$allowedExts = ['jpg', 'jpeg', 'png', 'webp'];

if (empty($mime)) {
    if (in_array($origExt, $allowedExts)) {
        $mime = ($origExt === 'png') ? 'image/png' : (($origExt === 'webp') ? 'image/webp' : 'image/jpeg');
    }
}

$allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
if (!in_array($mime, $allowedMimes) && !in_array($origExt, $allowedExts)) {
    jsonError('Invalid image format. Allowed formats: JPG, PNG, WEBP (Maximum 2MB).', 400);
}

$extMap = [
    'image/jpeg' => 'jpg',
    'image/jpg'  => 'jpg',
    'image/png'  => 'png',
    'image/webp' => 'webp'
];

$ext = $extMap[$mime] ?? 'jpg';
$folder = preg_replace('/[^a-z0-9_-]/i', '', $_POST['folder'] ?? 'pandits');
if (empty($folder)) $folder = 'pandits';

$filename = $folder . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
$targetDir = dirname(__DIR__) . '/uploads/' . $folder;

if (!is_dir($targetDir)) {
    @mkdir($targetDir, 0777, true);
}

$destination = $targetDir . '/' . $filename;
if (!move_uploaded_file($file['tmp_name'], $destination)) {
    jsonError('Failed to save uploaded image. Please check directory write permissions.', 500);
}

$relativeUrl = 'uploads/' . $folder . '/' . $filename;

jsonSuccess([
    'filename'     => $filename,
    'relative_url' => $relativeUrl,
    'url'          => $relativeUrl,
    'size_kb'      => round($file['size'] / 1024, 1)
], 'Image uploaded successfully (< 2MB).');

