<?php
/**
 * Shared Header Include
 * Renders HTML head, SEO meta tags, navigation, and announcement bar
 */

// $pageTitle and $pageDescription must be set by the controller before including this file
$pageTitle = $pageTitle ?? (SITE_NAME . ' | ' . SITE_TAGLINE);
$pageDescription = $pageDescription ?? 'Plan your sacred pilgrimage to Shree Omkareshwar Jyotirlinga. Book Vedic Pooja, Narmada Aarti Seva, and priority Darshan assistance.';
$canonicalUrl = SITE_URL . '/' . ltrim($_SERVER['REQUEST_URI'] ?? '', '/');
$ogImage = SITE_URL . '/assets/images/default-temple.svg';

// Active page detection helper
$currentRoute = trim($_GET['route'] ?? '', '/');
function isActiveLink(string $linkRoute): string {
    global $currentRoute;
    return ($currentRoute === trim($linkRoute, '/') || str_starts_with($currentRoute, trim($linkRoute, '/'))) ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <meta name="theme-color" content="#7A1C1C">
    <link rel="canonical" href="<?= e($canonicalUrl) ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e($canonicalUrl) ?>">
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($pageDescription) ?>">
    <meta property="og:image" content="<?= e($ogImage) ?>">
    <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($pageTitle) ?>">
    <meta name="twitter:description" content="<?= e($pageDescription) ?>">
    <meta name="twitter:image" content="<?= e($ogImage) ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= e(SITE_URL) ?>/assets/images/favicon.svg">

    <!-- Bootstrap 5 CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Poppins:wght@300;400;500;600;700&family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= e(SITE_URL) ?>/assets/css/style.css">

    <!-- Schema.org JSON-LD: Temple Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "TouristAttraction",
        "name": "Shree Omkareshwar Jyotirlinga Temple",
        "description": "The 4th Jyotirlinga of Lord Shiva, situated on the sacred Om-shaped Mandhata island surrounded by holy river Narmada.",
        "url": "<?= e(SITE_URL) ?>",
        "telephone": "<?= e(CONTACT_PHONE) ?>",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Mandhata Island",
            "addressLocality": "Omkareshwar",
            "addressRegion": "Madhya Pradesh",
            "postalCode": "450554",
            "addressCountry": "IN"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": 22.2464199,
            "longitude": 76.1506000
        },
        "openingHoursSpecification": [
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
                "opens": "05:00",
                "closes": "21:30"
            }
        ],
        "hasMap": "<?= e(GOOGLE_MAPS_EMBED_URL) ?>",
        "image": "<?= e($ogImage) ?>"
    }
    </script>
</head>
<body>

<!-- Announcement Bar -->
<div class="announcement-bar" role="banner">
    <div class="container-fluid px-3">
        <div class="d-flex align-items-center justify-content-between gap-2">
            <div class="overflow-hidden flex-grow-1" style="max-width: calc(100% - 220px);">
                <span class="ticker-text">
                    🕉️ &nbsp;
                    Mangal Aarti: 05:00 AM &nbsp;|&nbsp;
                    Darshan: 05:30 AM – 12:00 PM, 01:15 PM – 03:30 PM, 04:30 PM – 09:30 PM &nbsp;|&nbsp;
                    Shravan Maas Special Pooja bookings now open! &nbsp;|&nbsp;
                    Har Har Mahadev! 🙏 &nbsp;&nbsp;&nbsp;
                </span>
            </div>
            <div class="d-flex align-items-center gap-2 flex-shrink-0">
                <a href="tel:<?= e(CONTACT_PHONE) ?>" class="helpline-pill text-white text-decoration-none">
                    <i class="bi bi-telephone-fill me-1"></i><?= e(CONTACT_PHONE) ?>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Navigation -->
<nav class="navbar navbar-main navbar-expand-lg" role="navigation" aria-label="Main Navigation">
    <div class="container">
        <!-- Brand Logo -->
        <a class="navbar-brand" href="<?= url() ?>" aria-label="Shree Omkareshwar Jyotirlinga Home">
            <img src="<?= e(SITE_URL) ?>/assets/images/logo.svg" alt="Shree Omkareshwar Jyotirlinga Darshan Logo" height="56">
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link <?= isActiveLink('') ?>" href="<?= url() ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link <?= isActiveLink('about') ?>" href="<?= url('about') ?>">About</a></li>
                <li class="nav-item"><a class="nav-link <?= isActiveLink('temples') ?>" href="<?= url('temples') ?>">Temples</a></li>
                <li class="nav-item"><a class="nav-link <?= isActiveLink('pooja-services') ?>" href="<?= url('pooja-services') ?>">Pooja Services</a></li>
                <li class="nav-item"><a class="nav-link <?= isActiveLink('places') ?>" href="<?= url('places') ?>">Places to Visit</a></li>
                <li class="nav-item"><a class="nav-link <?= isActiveLink('hotels') ?>" href="<?= url('hotels') ?>">Hotels</a></li>
                <li class="nav-item"><a class="nav-link <?= isActiveLink('gallery') ?>" href="<?= url('gallery') ?>">Gallery</a></li>
                <li class="nav-item"><a class="nav-link <?= isActiveLink('blog') ?>" href="<?= url('blog') ?>">Blog</a></li>
                <li class="nav-item"><a class="nav-link <?= isActiveLink('contact') ?>" href="<?= url('contact') ?>">Contact</a></li>
                <li class="nav-item">
                    <a class="nav-link nav-cta-btn ms-1" href="<?= url('booking') ?>">
                        <i class="bi bi-calendar-check me-1"></i>Book Pooja
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
<?php $flash = get_flash(); if ($flash): ?>
<div class="container mt-3">
    <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show shadow-sm alert-auto-dismiss" role="alert">
        <?= $flash['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<?php endif; ?>
