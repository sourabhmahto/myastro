-- =========================================================================
-- Omkareshwar Jyotirlinga Pooja & Astro Seva - Non-Destructive Schema Upgrade
-- MySQL 8.0 / MariaDB Compatible
-- =========================================================================

SET FOREIGN_KEY_CHECKS = 0;

-- 1. Categories Table (Pooja, Astro, Vastu, Sanskar, etc.)
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `name_en` VARCHAR(150) NOT NULL,
    `name_hi` VARCHAR(150) NOT NULL,
    `display_order` INT NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_cat_order` (`display_order`),
    INDEX `idx_cat_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Poojas Table (Bilingual with category association and display_order)
CREATE TABLE IF NOT EXISTS `poojas` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `category_id` INT UNSIGNED NULL,
    `name_en` VARCHAR(200) NOT NULL,
    `name_hi` VARCHAR(200) NOT NULL,
    `description_en` LONGTEXT NOT NULL,
    `description_hi` LONGTEXT NOT NULL,
    `image_url` VARCHAR(255) NULL,
    `display_order` INT NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_pooja_cat` (`category_id`),
    INDEX `idx_pooja_order` (`display_order`),
    INDEX `idx_pooja_active` (`is_active`),
    CONSTRAINT `fk_pooja_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Pooja Variations Table (Pricing tiers, priest configurations)
CREATE TABLE IF NOT EXISTS `pooja_variations` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `pooja_id` INT UNSIGNED NOT NULL,
    `title_en` VARCHAR(180) NOT NULL,
    `title_hi` VARCHAR(180) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    `display_order` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_var_pooja` (`pooja_id`),
    INDEX `idx_var_order` (`display_order`),
    CONSTRAINT `fk_variation_pooja` FOREIGN KEY (`pooja_id`) REFERENCES `poojas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Blogs Table (Bilingual spiritual updates, Panchang notes)
CREATE TABLE IF NOT EXISTS `blogs` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title_en` VARCHAR(255) NOT NULL,
    `title_hi` VARCHAR(255) NOT NULL,
    `content_en` LONGTEXT NOT NULL,
    `content_hi` LONGTEXT NOT NULL,
    `image_url` VARCHAR(255) NULL,
    `is_published` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_blog_pub` (`is_published`),
    INDEX `idx_blog_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Devotees Bookings & CRM Table
CREATE TABLE IF NOT EXISTS `devotees_bookings` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NULL,
    `full_name` VARCHAR(150) NOT NULL,
    `phone` VARCHAR(25) NOT NULL,
    `whatsapp_number` VARCHAR(25) NOT NULL,
    `gotra` VARCHAR(100) NULL DEFAULT 'Kashyap',
    `nakshatra` VARCHAR(100) NULL,
    `pooja_id` INT UNSIGNED NULL,
    `variation_id` INT UNSIGNED NULL,
    `preferred_date` DATE NOT NULL,
    `special_wishes` TEXT NULL,
    `status` ENUM('Pending', 'Sankalp Done', 'Prasad Sent', 'Completed') NOT NULL DEFAULT 'Pending',
    `admin_notes` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_devotee_phone` (`phone`),
    INDEX `idx_devotee_whatsapp` (`whatsapp_number`),
    INDEX `idx_devotee_status` (`status`),
    INDEX `idx_devotee_date` (`preferred_date`),
    CONSTRAINT `fk_devotee_pooja` FOREIGN KEY (`pooja_id`) REFERENCES `poojas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk_devotee_variation` FOREIGN KEY (`variation_id`) REFERENCES `pooja_variations` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Users / Admins Table (Ensuring phone and role support)
CREATE TABLE IF NOT EXISTS `users_v2` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(120) NOT NULL,
    `phone` VARCHAR(25) NOT NULL UNIQUE,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `role` ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_user_phone` (`phone`),
    INDEX `idx_user_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
