-- ==========================================================
-- Omkareshwar Jyotirlinga Pilgrimage & Temple Tourism Portal
-- Database Schema (MySQL 8.0 / MariaDB compatible)
-- Suitable for GoDaddy cPanel phpMyAdmin import
-- ==========================================================

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `contact_messages`;
DROP TABLE IF EXISTS `blog_posts`;
DROP TABLE IF EXISTS `galleries`;
DROP TABLE IF EXISTS `hotels`;
DROP TABLE IF EXISTS `places`;
DROP TABLE IF EXISTS `bookings`;
DROP TABLE IF EXISTS `pooja_services`;
DROP TABLE IF EXISTS `temples`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `admins`;
DROP TABLE IF EXISTS `settings`;
SET FOREIGN_KEY_CHECKS = 1;

-- 1. Admins Table
CREATE TABLE `admins` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `role` ENUM('superadmin', 'manager', 'pandit_coordinator') DEFAULT 'superadmin',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_admin_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Users / Devotees Table
CREATE TABLE `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(120) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `phone` VARCHAR(25) NOT NULL,
    `password_hash` VARCHAR(255) NULL,
    `status` ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_user_email` (`email`),
    INDEX `idx_user_phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Temples Table
CREATE TABLE `temples` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(150) NOT NULL,
    `slug` VARCHAR(160) NOT NULL UNIQUE,
    `short_description` VARCHAR(300) NOT NULL,
    `description` LONGTEXT NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `latitude` DECIMAL(10, 7) NULL,
    `longitude` DECIMAL(10, 7) NULL,
    `opening_time` TIME NOT NULL DEFAULT '05:00:00',
    `closing_time` TIME NOT NULL DEFAULT '21:30:00',
    `featured_image` VARCHAR(255) NULL,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_temple_slug` (`slug`),
    INDEX `idx_temple_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Pooja Services Table
CREATE TABLE `pooja_services` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(160) NOT NULL,
    `slug` VARCHAR(170) NOT NULL UNIQUE,
    `description` LONGTEXT NOT NULL,
    `benefits` TEXT NULL,
    `samagri_included` TEXT NULL,
    `price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    `duration` VARCHAR(80) NOT NULL DEFAULT '45 mins',
    `image` VARCHAR(255) NULL,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_pooja_slug` (`slug`),
    INDEX `idx_pooja_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Bookings Table
CREATE TABLE `bookings` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `booking_number` VARCHAR(50) NOT NULL UNIQUE,
    `user_id` INT UNSIGNED NULL,
    `pooja_service_id` INT UNSIGNED NOT NULL,
    `booking_date` DATE NOT NULL,
    `booking_time` VARCHAR(30) NOT NULL,
    `customer_name` VARCHAR(120) NOT NULL,
    `customer_phone` VARCHAR(25) NOT NULL,
    `customer_email` VARCHAR(150) NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    `payment_status` ENUM('pending', 'paid', 'cash_at_temple', 'failed') DEFAULT 'pending',
    `booking_status` ENUM('confirmed', 'pending', 'completed', 'cancelled') DEFAULT 'pending',
    `special_requests` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_booking_number` (`booking_number`),
    INDEX `idx_booking_date` (`booking_date`),
    INDEX `idx_booking_status` (`booking_status`),
    INDEX `idx_booking_email` (`customer_email`),
    INDEX `idx_booking_phone` (`customer_phone`),
    CONSTRAINT `fk_booking_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk_booking_pooja` FOREIGN KEY (`pooja_service_id`) REFERENCES `pooja_services` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Places (Attractions & Sightseeing) Table
CREATE TABLE `places` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(150) NOT NULL,
    `slug` VARCHAR(160) NOT NULL UNIQUE,
    `description` LONGTEXT NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `distance_from_temple` VARCHAR(60) NOT NULL DEFAULT 'Nearby',
    `image` VARCHAR(255) NULL,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_place_slug` (`slug`),
    INDEX `idx_place_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Hotels / Accommodations Table
CREATE TABLE `hotels` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(150) NOT NULL,
    `slug` VARCHAR(160) NOT NULL UNIQUE,
    `description` LONGTEXT NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(40) NOT NULL,
    `price_range` VARCHAR(80) NOT NULL DEFAULT '₹800 - ₹2,500 / night',
    `image` VARCHAR(255) NULL,
    `amenities` TEXT NULL,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_hotel_slug` (`slug`),
    INDEX `idx_hotel_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Photo Gallery Table
CREATE TABLE `galleries` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(180) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `alt_text` VARCHAR(255) NOT NULL,
    `category` ENUM('temples', 'aarti', 'river_narmada', 'parikrama', 'rituals') DEFAULT 'temples',
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_gallery_category` (`category`),
    INDEX `idx_gallery_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. Blog Posts Table
CREATE TABLE `blog_posts` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(220) NOT NULL,
    `slug` VARCHAR(230) NOT NULL UNIQUE,
    `excerpt` TEXT NOT NULL,
    `content` LONGTEXT NOT NULL,
    `featured_image` VARCHAR(255) NULL,
    `author_id` INT UNSIGNED NULL,
    `status` ENUM('published', 'draft') DEFAULT 'published',
    `published_at` DATETIME NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_blog_slug` (`slug`),
    INDEX `idx_blog_status` (`status`),
    CONSTRAINT `fk_blog_author` FOREIGN KEY (`author_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10. Contact Messages Table
CREATE TABLE `contact_messages` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(120) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `phone` VARCHAR(25) NOT NULL,
    `message` TEXT NOT NULL,
    `status` ENUM('unread', 'read', 'replied') DEFAULT 'unread',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_contact_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 11. Configuration Settings Table
CREATE TABLE `settings` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `setting_key` VARCHAR(80) NOT NULL UNIQUE,
    `setting_value` TEXT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
