<?php
/**
 * Admin Dashboard KPI Stats API
 */

require_once __DIR__ . '/config.php';

requireAdminAuth();
$pdo = ApiDB::get();
if (!$pdo) jsonError('Database connection unavailable.', 500);

// Fetch stats
$totalBookings = (int)$pdo->query("SELECT COUNT(*) FROM `devotees_bookings`")->fetchColumn();
$pendingBookings = (int)$pdo->query("SELECT COUNT(*) FROM `devotees_bookings` WHERE `status` = 'Pending'")->fetchColumn();
$completedBookings = (int)$pdo->query("SELECT COUNT(*) FROM `devotees_bookings` WHERE `status` = 'Completed'")->fetchColumn();
$sankalpDoneBookings = (int)$pdo->query("SELECT COUNT(*) FROM `devotees_bookings` WHERE `status` = 'Sankalp Done'")->fetchColumn();

$totalPoojas = (int)$pdo->query("SELECT COUNT(*) FROM `poojas` WHERE `is_active` = 1")->fetchColumn();
$totalCategories = (int)$pdo->query("SELECT COUNT(*) FROM `categories` WHERE `is_active` = 1")->fetchColumn();
$totalBlogs = (int)$pdo->query("SELECT COUNT(*) FROM `blogs` WHERE `is_published` = 1")->fetchColumn();

jsonSuccess([
    'total_bookings'        => $totalBookings,
    'pending_bookings'      => $pendingBookings,
    'sankalp_done_bookings' => $sankalpDoneBookings,
    'completed_bookings'    => $completedBookings,
    'total_poojas'          => $totalPoojas,
    'total_categories'      => $totalCategories,
    'total_blogs'           => $totalBlogs
]);
