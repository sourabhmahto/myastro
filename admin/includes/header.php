<?php
/**
 * Admin Shared Header Include
 */

require_once __DIR__ . '/../../includes/auth.php';
$adminUser = Auth::user();
$unreadCount = ContactMessage::getUnreadCount();

$pageTitle = $pageTitle ?? 'Administrator Dashboard | Omkareshwar Portal';
$currentAdminAction = trim($_GET['action'] ?? 'dashboard');

function isAdminActive(string $act): string {
    global $currentAdminAction;
    return ($currentAdminAction === $act || str_starts_with($currentAdminAction, $act)) ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= e(SITE_URL) ?>/assets/images/favicon.svg">

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Noto+Sans+Devanagari:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Admin CSS -->
    <link rel="stylesheet" href="<?= e(SITE_URL) ?>/assets/css/admin.css">
</head>
<body class="admin-body">

<div class="admin-sidebar-overlay"></div>

<!-- Left Sidebar Navigation -->
<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <div class="brand-om">ॐ</div>
        <div class="brand-title">Omkareshwar Seva</div>
        <div class="brand-sub">Administration Panel</div>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section-label">Main</div>
        <a href="<?= url('admin?action=dashboard') ?>" class="sidebar-nav-link <?= isAdminActive('dashboard') ?>">
            <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
        </a>
        <a href="<?= url('admin?action=bookings') ?>" class="sidebar-nav-link <?= (isAdminActive('bookings') || isAdminActive('booking_view')) ?>">
            <i class="bi bi-calendar-check-fill"></i> <span>Manage Bookings</span>
        </a>

        <div class="sidebar-section-label">Temple Services</div>
        <a href="<?= url('admin?action=poojas') ?>" class="sidebar-nav-link <?= (isAdminActive('poojas') || isAdminActive('pooja_form')) ?>">
            <i class="bi bi-flower1"></i> <span>Pooja Services</span>
        </a>
        <a href="<?= url('admin?action=temples') ?>" class="sidebar-nav-link <?= (isAdminActive('temples') || isAdminActive('temple_form')) ?>">
            <i class="bi bi-bank2"></i> <span>Temples &amp; Shrines</span>
        </a>

        <div class="sidebar-section-label">Tourism &amp; Content</div>
        <a href="<?= url('admin?action=places') ?>" class="sidebar-nav-link <?= (isAdminActive('places') || isAdminActive('place_form')) ?>">
            <i class="bi bi-geo-alt-fill"></i> <span>Places to Visit</span>
        </a>
        <a href="<?= url('admin?action=hotels') ?>" class="sidebar-nav-link <?= (isAdminActive('hotels') || isAdminActive('hotel_form')) ?>">
            <i class="bi bi-building"></i> <span>Hotels &amp; Ashrams</span>
        </a>
        <a href="<?= url('admin?action=gallery') ?>" class="sidebar-nav-link <?= (isAdminActive('gallery') || isAdminActive('gallery_form')) ?>">
            <i class="bi bi-images"></i> <span>Photo Gallery</span>
        </a>
        <a href="<?= url('admin?action=blogs') ?>" class="sidebar-nav-link <?= (isAdminActive('blogs') || isAdminActive('blog_form')) ?>">
            <i class="bi bi-journal-richtext"></i> <span>Yatra Blog</span>
        </a>

        <div class="sidebar-section-label">Communication &amp; Users</div>
        <a href="<?= url('admin?action=messages') ?>" class="sidebar-nav-link <?= isAdminActive('messages') ?>">
            <i class="bi bi-chat-left-text-fill"></i> <span>Inquiries</span>
            <?php if ($unreadCount > 0): ?>
            <span class="badge-count"><?= $unreadCount ?></span>
            <?php endif; ?>
        </a>
        <a href="<?= url('admin?action=users') ?>" class="sidebar-nav-link <?= isAdminActive('users') ?>">
            <i class="bi bi-people-fill"></i> <span>Devotees &amp; Admins</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="user-avatar">
                <?= strtoupper(substr($adminUser['name'] ?? 'A', 0, 1)) ?>
            </div>
            <div class="user-info">
                <div class="user-name"><?= e($adminUser['name'] ?? 'Admin') ?></div>
                <div class="user-role"><?= e($adminUser['role'] ?? 'Administrator') ?></div>
            </div>
            <a href="<?= url('admin?action=logout') ?>" class="sidebar-logout-btn" title="Sign Out">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </div>
</aside>

<!-- Main Content Area -->
<div class="admin-main">
    <!-- Top Nav Bar -->
    <header class="admin-topnav">
        <div class="d-flex align-items-center gap-2">
            <button type="button" class="menu-toggle-btn" aria-label="Toggle Menu">
                <i class="bi bi-list"></i>
            </button>
            <div class="topnav-title">Omkareshwar Seva Portal</div>
        </div>
        <div class="topnav-right">
            <a href="<?= url() ?>" target="_blank" class="topnav-site-btn">
                <i class="bi bi-box-arrow-up-right"></i> View Public Website
            </a>
        </div>
    </header>

    <!-- Page Content Container -->
    <main class="admin-content">
        <!-- Flash Alert Message -->
        <?php $flash = get_flash(); if ($flash): ?>
        <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show shadow-sm alert-auto-dismiss" role="alert">
            <?= $flash['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
