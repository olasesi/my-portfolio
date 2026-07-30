-- Add missing columns to existing database
-- Run this in phpMyAdmin SQL tab

ALTER TABLE `posts`
  ADD COLUMN `meta_title` VARCHAR(255) NULL AFTER `status`,
  ADD COLUMN `meta_description` TEXT NULL AFTER `meta_title`,
  ADD COLUMN `og_image` VARCHAR(255) NULL AFTER `meta_description`,
  ADD COLUMN `views` INT UNSIGNED DEFAULT 0 AFTER `og_image`;

CREATE TABLE IF NOT EXISTS `tags` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `post_tags` (
  `post_id` INT UNSIGNED NOT NULL,
  `tag_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`post_id`, `tag_id`),
  FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`tag_id`) REFERENCES `tags`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `active` TINYINT(1) DEFAULT 1,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed default tags
INSERT IGNORE INTO `tags` (`name`, `slug`) VALUES
('JavaScript', 'javascript'),
('TypeScript', 'typescript'),
('PHP', 'php'),
('Laravel', 'laravel'),
('Node.js', 'nodejs'),
('React', 'react'),
('React Native', 'react-native'),
('Docker', 'docker'),
('MySQL', 'mysql'),
('REST API', 'rest-api'),
('GraphQL', 'graphql'),
('Testing', 'testing'),
('Performance', 'performance'),
('Security', 'security'),
('DevOps', 'devops');
