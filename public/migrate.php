<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/db.php';

$pdo = db();
$results = [];

$statements = [
    "ALTER TABLE `posts` ADD COLUMN `meta_title` VARCHAR(255) NULL AFTER `status`",
    "ALTER TABLE `posts` ADD COLUMN `meta_description` TEXT NULL AFTER `meta_title`",
    "ALTER TABLE `posts` ADD COLUMN `og_image` VARCHAR(255) NULL AFTER `meta_description`",
    "ALTER TABLE `posts` ADD COLUMN `views` INT UNSIGNED DEFAULT 0 AFTER `og_image`",
    "CREATE TABLE IF NOT EXISTS `tags` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(100) NOT NULL,
        `slug` VARCHAR(100) NOT NULL UNIQUE,
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "CREATE TABLE IF NOT EXISTS `post_tags` (
        `post_id` INT UNSIGNED NOT NULL,
        `tag_id` INT UNSIGNED NOT NULL,
        PRIMARY KEY (`post_id`, `tag_id`),
        FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`tag_id`) REFERENCES `tags`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "CREATE TABLE IF NOT EXISTS `subscribers` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `email` VARCHAR(255) NOT NULL UNIQUE,
        `active` TINYINT(1) DEFAULT 1,
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "CREATE TABLE IF NOT EXISTS `messages` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL,
        `company` VARCHAR(255) NULL,
        `budget` VARCHAR(100) NULL,
        `subject` VARCHAR(255) NULL,
        `body` TEXT NOT NULL,
        `is_read` TINYINT(1) DEFAULT 0,
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "CREATE TABLE IF NOT EXISTS `projects` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(255) NOT NULL,
        `slug` VARCHAR(255) NOT NULL UNIQUE,
        `category` VARCHAR(100) NULL,
        `description` TEXT NULL,
        `challenge` TEXT NULL,
        `solution` TEXT NULL,
        `tech_stack` VARCHAR(500) NULL,
        `metrics` TEXT NULL,
        `image` VARCHAR(255) NULL,
        `live_url` VARCHAR(500) NULL,
        `featured` TINYINT(1) DEFAULT 0,
        `sort_order` INT DEFAULT 0,
        `status` ENUM('draft','published') DEFAULT 'published',
        `meta_title` VARCHAR(255) NULL,
        `meta_description` TEXT NULL,
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "INSERT IGNORE INTO `tags` (`name`, `slug`) VALUES
        ('JavaScript','javascript'),('TypeScript','typescript'),('PHP','php'),
        ('Laravel','laravel'),('Node.js','nodejs'),('React','react'),
        ('React Native','react-native'),('Docker','docker'),('MySQL','mysql'),
        ('REST API','rest-api'),('GraphQL','graphql'),('Testing','testing'),
        ('Performance','performance'),('Security','security'),('DevOps','devops')",
    "INSERT IGNORE INTO `projects` (`title`, `slug`, `category`, `description`, `challenge`, `solution`, `tech_stack`, `metrics`, `live_url`, `featured`, `sort_order`, `status`) VALUES
        ('NexaERP — Enterprise Resource Planning Platform','nexaerp','fullstack,backend','A multi-tenant ERP system built for mid-size businesses to manage inventory, procurement, HR, payroll, and financial reporting in one platform.','The client was running five disconnected spreadsheet-based systems with no single source of truth.','Built a Laravel REST API backend with MySQL and a React frontend. Docker containerisation with Jenkins CI/CD deploying to AWS EC2. RBAC with Laravel Sanctum.','React,Laravel,MySQL,Docker,AWS EC2,Jenkins,Laravel Sanctum,React Native','[{\"v\":\"5\",\"l\":\"Permission Levels\"},{\"v\":\"Multi-tenant\",\"l\":\"Architecture\"},{\"v\":\"REST API\",\"l\":\"Mobile-ready\"}]',NULL,1,1,'published'),
        ('PulseCRM — Sales & Customer Management Platform','pulsecrm','fullstack,backend','A full CRM platform for a 40-person sales team covering pipeline management, contact tracking, automated follow-up sequences, activity logging, and analytics dashboards.','The sales team was managing deals in spreadsheets and WhatsApp threads. No visibility on pipeline health.','Vue 3 frontend consuming a Node/Express GraphQL API backed by MongoDB. Real-time activity feeds via GraphQL subscriptions. Automated email follow-up sequences.','Vue 3,Node.js,Express,MongoDB,GraphQL,AWS,PM2','[{\"v\":\"40\",\"l\":\"Sales Users\"},{\"v\":\"GraphQL\",\"l\":\"Real-time API\"},{\"v\":\"Automated\",\"l\":\"Follow-ups\"}]',NULL,1,2,'published'),
        ('Trackr — Field Operations Mobile App','trackr','mobile,backend','A cross-platform iOS and Android app for managing field teams — task assignment, GPS check-ins, photo uploads, and offline-first report submission.','Field teams were operating in areas with unreliable internet. Reports were being lost.','React Native with Expo. Offline-first architecture using AsyncStorage with background sync queue. Push notifications via Expo Notifications.','React Native,Expo,Node.js,MySQL,AsyncStorage,Expo Notifications','[{\"v\":\"iOS+Android\",\"l\":\"Both Stores\"},{\"v\":\"Offline-first\",\"l\":\"Architecture\"},{\"v\":\"GPS+Photo\",\"l\":\"Check-ins\"}]',NULL,0,3,'published'),
        ('Victruth — Limousine, Events & Vendor Services','victruth','fullstack','A full-service booking and vendor management platform for limousine hire, event planning, and vendor services. Multi-role system.','The business was managing bookings via phone and WhatsApp, with no way for vendors to self-manage.','React frontend backed by a Laravel API secured with Laravel Sanctum. Payment gateway integration, lazy loading, email notifications, and SEO implementation.','React,Laravel,Laravel Sanctum,MySQL,Payment Gateway,SEO','[{\"v\":\"3 Roles\",\"l\":\"Customer/Vendor/Admin\"},{\"v\":\"Live\",\"l\":\"victruth.com\"},{\"v\":\"Payments\",\"l\":\"Integrated\"}]','https://victruth.com',1,4,'published'),
        ('School Portal — Combined Primary & Secondary School System','schoolportal','fullstack,backend','A comprehensive school management system handling admissions, fee management, assignments, results, timetabling, and secure login for all user roles.','All school records were paper-based. Admission processes were manual, fees were tracked in ledgers.','Custom PHP application with MySQL. Four distinct role portals: school owner, administrator, teacher, and student.','PHP,MySQL,Bootstrap,jQuery,cPanel','[{\"v\":\"4 Roles\",\"l\":\"Owner/Admin/Teacher/Student\"},{\"v\":\"Live\",\"l\":\"schoolportal.victruth.com\"},{\"v\":\"Full\",\"l\":\"Admission to Results\"}]','https://schoolportal.victruth.com',0,5,'published'),
        ('Social Media UI — Full Frontend Implementation','socialmedia','frontend','Complete frontend implementation of a social media platform — feed, profiles, stories, messaging UI, notifications, and explore pages.','Translating a complex, multi-page Figma design into production React code.','React with TailwindCSS for styling, TypeScript for type safety. Custom hooks for feed and notification state.','React,TypeScript,TailwindCSS','[{\"v\":\"Pixel-perfect\",\"l\":\"Figma to code\"},{\"v\":\"Fully\",\"l\":\"Responsive\"},{\"v\":\"Live\",\"l\":\"socialmedia.victruth.com\"}]','https://socialmedia.victruth.com',0,6,'published'),
        ('Business Listing — Search & Discovery Platform','businesslisting','ecommerce,backend','A business directory platform allowing businesses to list products and services, with AJAX-powered live search.','Needed fast, accurate search across thousands of listings without full page reloads.','PHP backend with MySQL and optimised full-text search indexes. AJAX/jQuery for real-time search-as-you-type.','PHP,MySQL,Ajax,jQuery,Bootstrap','[{\"v\":\"Live search\",\"l\":\"AJAX-powered\"},{\"v\":\"Star ratings\",\"l\":\"Aggregated\"},{\"v\":\"Live\",\"l\":\"businesslisting.victruth.com\"}]','https://businesslisting.victruth.com',0,7,'published'),
        ('E-Commerce Suite — 3 Variants with Dashboard & Payments','ecommerce','ecommerce','Three distinct PHP e-commerce stores, each with a custom admin dashboard, product management, stock tracking, payment API integration.','Needed three independent storefronts with different product catalogues and branding but shared infrastructure.','Custom PHP with MySQL, shared codebase with per-store configuration. Payment gateway API integration with webhook handling.','PHP,MySQL,Payment API,WordPress,WooCommerce,OpenCart,Facebook API','[{\"v\":\"3\",\"l\":\"Live Stores\"},{\"v\":\"Upsell/X-sell\",\"l\":\"Engine\"},{\"v\":\"Auto FB\",\"l\":\"Sharing\"}]','https://basicecommerce1.victruth.com',0,8,'published')"
];

foreach ($statements as $sql) {
    try {
        $pdo->exec($sql);
        $short = substr($sql, 0, 60) . '...';
        $results[] = ['ok', $short];
    } catch (PDOException $e) {
        // 1060 = column already exists, 1050 = table already exists — those are fine
        $code = $e->getCode();
        if ($code == '42S21' || $code == '42S01' || $code == '1050') {
            $short = substr($sql, 0, 60) . '...';
            $results[] = ['skip', $short . ' (already exists)'];
        } else {
            $short = substr($sql, 0, 60) . '...';
            $results[] = ['err', $short . ' — ' . $e->getMessage()];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Migration</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #07111F; color: #AAC0D6; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .card { background: #0C1A2E; border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 600px; }
        h1 { font-size: 1.2rem; font-weight: 800; color: #fff; margin-bottom: 1.5rem; }
        .row { padding: 0.6rem 0; border-bottom: 1px solid rgba(255,255,255,0.06); font-size: 0.82rem; font-family: monospace; }
        .row:last-child { border-bottom: none; }
        .ok { color: #00C9AE; }
        .skip { color: #7A91AA; }
        .err { color: #FCA5A5; }
        .icon { display: inline-block; width: 1.5rem; }
        .done { margin-top: 1.5rem; padding: 1rem; background: rgba(0,201,174,0.1); border: 1px solid rgba(0,201,174,0.25); border-radius: 8px; color: #00C9AE; font-size: 0.88rem; font-weight: 600; text-align: center; }
        .done a { color: #fff; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Database Migration</h1>
        <?php foreach ($results as $r): ?>
            <div class="row">
                <span class="icon <?= $r[0] === 'ok' ? 'ok' : ($r[0] === 'skip' ? 'skip' : 'err') ?>">
                    <?= $r[0] === 'ok' ? '✓' : ($r[0] === 'skip' ? '–' : '✗') ?>
                </span>
                <?= htmlspecialchars($r[1]) ?>
            </div>
        <?php endforeach; ?>
        <div class="done">
            Migration complete. <a href="<?= ADMIN_URL ?>/posts/create.php">→ Create a post</a>
        </div>
    </div>
</body>
</html>
