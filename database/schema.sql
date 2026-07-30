-- ============================================================
-- Ahmed Olusesi Blog — Full Database Schema
-- Run this in phpMyAdmin to set up the database
-- ============================================================

CREATE DATABASE IF NOT EXISTS `ahmed_blog`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `ahmed_blog`;

-- ── Admins ────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `admins` (
  `id`        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name`      VARCHAR(255) NOT NULL,
  `email`     VARCHAR(255) NOT NULL UNIQUE,
  `password`  VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Categories ────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `categories` (
  `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(255) NOT NULL,
  `slug`       VARCHAR(255) NOT NULL UNIQUE,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Tags ──────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `tags` (
  `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(100) NOT NULL,
  `slug`       VARCHAR(100) NOT NULL UNIQUE,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Posts ─────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `posts` (
  `id`              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `admin_id`        INT UNSIGNED NOT NULL,
  `category_id`     INT UNSIGNED NULL,
  `title`           VARCHAR(255) NOT NULL,
  `slug`            VARCHAR(255) NOT NULL UNIQUE,
  `excerpt`         TEXT NULL,
  `body`            LONGTEXT NOT NULL,
  `featured_image`  VARCHAR(255) NULL,
  `status`          ENUM('draft','published') DEFAULT 'draft',
  `meta_title`      VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `og_image`        VARCHAR(255) NULL,
  `views`           INT UNSIGNED DEFAULT 0,
  `created_at`      DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at`      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`admin_id`)    REFERENCES `admins`(`id`)    ON DELETE CASCADE,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Post–Tag pivot ────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `post_tags` (
  `post_id` INT UNSIGNED NOT NULL,
  `tag_id`  INT UNSIGNED NOT NULL,
  PRIMARY KEY (`post_id`, `tag_id`),
  FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`)  ON DELETE CASCADE,
  FOREIGN KEY (`tag_id`)  REFERENCES `tags`(`id`)   ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Newsletter subscribers ────────────────────────────────
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `email`      VARCHAR(255) NOT NULL UNIQUE,
  `active`     TINYINT(1) DEFAULT 1,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- SEED DATA
-- ============================================================

-- Default admin (password: admin123 — change immediately!)
INSERT INTO `admins` (`name`, `email`, `password`) VALUES
('Ahmed Olusesi', 'admin@ahmed-olusesi.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Default categories
INSERT INTO `categories` (`name`, `slug`) VALUES
('React',       'react'),
('Backend',     'backend'),
('Mobile',      'mobile'),
('DevOps',      'devops'),
('Career',      'career'),
('Frontend',    'frontend'),
('Architecture','architecture');

-- Default tags
INSERT INTO `tags` (`name`, `slug`) VALUES
('JavaScript',   'javascript'),
('TypeScript',   'typescript'),
('PHP',          'php'),
('Laravel',      'laravel'),
('Node.js',      'nodejs'),
('React',        'react'),
('React Native', 'react-native'),
('Docker',       'docker'),
('MySQL',        'mysql'),
('REST API',     'rest-api'),
('GraphQL',      'graphql'),
('Testing',      'testing'),
('Performance',  'performance'),
('Security',     'security'),
('DevOps',       'devops');
