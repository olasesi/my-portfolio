-- Migration 2: messages, projects tables

USE `ahmed_blog`;

-- ── Contact Messages ────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `messages` (
  `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(255) NOT NULL,
  `email`      VARCHAR(255) NOT NULL,
  `company`    VARCHAR(255) NULL,
  `budget`     VARCHAR(100) NULL,
  `subject`    VARCHAR(255) NULL,
  `body`       TEXT NOT NULL,
  `is_read`    TINYINT(1) DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Portfolio Projects ──────────────────────────────────────
CREATE TABLE IF NOT EXISTS `projects` (
  `id`              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title`           VARCHAR(255) NOT NULL,
  `slug`            VARCHAR(255) NOT NULL UNIQUE,
  `category`        VARCHAR(100) NULL,
  `description`     TEXT NULL,
  `challenge`       TEXT NULL,
  `solution`        TEXT NULL,
  `tech_stack`      VARCHAR(500) NULL,
  `metrics`         TEXT NULL,
  `image`           VARCHAR(255) NULL,
  `live_url`        VARCHAR(500) NULL,
  `featured`        TINYINT(1) DEFAULT 0,
  `sort_order`      INT DEFAULT 0,
  `status`          ENUM('draft','published') DEFAULT 'published',
  `meta_title`      VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `created_at`      DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at`      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed existing projects
INSERT INTO `projects` (`title`, `slug`, `category`, `description`, `challenge`, `solution`, `tech_stack`, `metrics`, `live_url`, `featured`, `sort_order`, `status`) VALUES
('NexaERP — Enterprise Resource Planning Platform', 'nexaerp', 'fullstack,backend', 'A multi-tenant ERP system built for mid-size businesses to manage inventory, procurement, HR, payroll, and financial reporting in one platform. Five granular permission levels with separate dashboards per role.', 'The client was running five disconnected spreadsheet-based systems with no single source of truth. HR, inventory, and finance had no shared data layer, leading to hours of manual reconciliation every week.', 'Built a Laravel REST API backend with MySQL and a React frontend using a component library. Docker containerisation with a Jenkins CI/CD pipeline deploying to AWS EC2. Role-based access control (RBAC) with Laravel Sanctum. A React Native mobile companion app consumes the same API.', 'React,Laravel,MySQL,Docker,AWS EC2,Jenkins,Laravel Sanctum,React Native', '[{"v":"5","l":"Permission Levels"},{"v":"Multi-tenant","l":"Architecture"},{"v":"REST API","l":"Mobile-ready"}]', NULL, 1, 1, 'published'),

('PulseCRM — Sales & Customer Management Platform', 'pulsecrm', 'fullstack,backend', 'A full CRM platform for a 40-person sales team covering pipeline management, contact tracking, automated follow-up sequences, activity logging, and analytics dashboards.', 'The sales team was managing deals in a mix of spreadsheets and WhatsApp threads. No visibility on pipeline health, no way to automate follow-ups, and no reporting for management.', 'Vue 3 frontend consuming a Node/Express GraphQL API backed by MongoDB. Real-time activity feeds via GraphQL subscriptions. Automated email follow-up sequences with configurable delay triggers. Dashboard analytics with chart.js. Deployed on AWS with PM2.', 'Vue 3,Node.js,Express,MongoDB,GraphQL,AWS,PM2', '[{"v":"40","l":"Sales Users"},{"v":"GraphQL","l":"Real-time API"},{"v":"Automated","l":"Follow-ups"}]', NULL, 1, 2, 'published'),

('Trackr — Field Operations Mobile App', 'trackr', 'mobile,backend', 'A cross-platform iOS and Android app for managing field teams — task assignment, GPS check-ins, photo uploads, status updates, and offline-first report submission synced when connectivity returns.', 'Field teams were operating in areas with unreliable internet. Reports were being lost, GPS check-ins were impossible mid-task, and managers had no real-time visibility.', 'React Native with Expo for the cross-platform client. Offline-first architecture using AsyncStorage with a background sync queue that pushes to a Node.js/MySQL REST API when connectivity returns. Push notifications via Expo Notifications. Published to both App Store and Google Play.', 'React Native,Expo,Node.js,MySQL,AsyncStorage,Expo Notifications', '[{"v":"iOS+Android","l":"Both Stores"},{"v":"Offline-first","l":"Architecture"},{"v":"GPS+Photo","l":"Check-ins"}]', NULL, 0, 3, 'published'),

('Victruth — Limousine, Events & Vendor Services', 'victruth', 'fullstack', 'A full-service booking and vendor management platform for limousine hire, event planning, and vendor services. Multi-role system with customer, vendor, and admin portals.', 'The business was managing bookings via phone and WhatsApp, with no way for vendors to self-manage their listings, no payment collection, and no visibility on booking status.', 'React frontend backed by a Laravel API secured with Laravel Sanctum. Payment gateway integration, lazy loading, email notifications, and SEO implementation. Vendor and admin dashboards with booking management, analytics, and content controls.', 'React,Laravel,Laravel Sanctum,MySQL,Payment Gateway,SEO', '[{"v":"3 Roles","l":"Customer/Vendor/Admin"},{"v":"Live","l":"victruth.com"},{"v":"Payments","l":"Integrated"}]', 'https://victruth.com', 1, 4, 'published'),

('School Portal — Combined Primary & Secondary School System', 'schoolportal', 'fullstack,backend', 'A comprehensive school management system for combined primary and secondary schools — handling admissions, fee management, assignments, results, timetabling, and secure login for all user roles.', 'All school records were paper-based. Admission processes were manual, fees were tracked in ledgers, and parents had no visibility on their children''s academic progress.', 'Custom PHP application with a MySQL database. Four distinct role portals: school owner, administrator, teacher, and student. Admission workflow, fee collection tracking, assignment submission, and result generation. Hosted on cPanel with optimised queries for concurrent access.', 'PHP,MySQL,Bootstrap,jQuery,cPanel', '[{"v":"4 Roles","l":"Owner/Admin/Teacher/Student"},{"v":"Live","l":"schoolportal.victruth.com"},{"v":"Full","l":"Admission to Results"}]', 'https://schoolportal.victruth.com', 0, 5, 'published'),

('Social Media UI — Full Frontend Implementation', 'socialmedia', 'frontend', 'Complete frontend implementation of a social media platform — feed, profiles, stories, messaging UI, notifications, and explore pages. Pixel-perfect, responsive, and animated throughout.', 'Translating a complex, multi-page Figma design into production React code while maintaining design fidelity, responsive behaviour across all breakpoints, and smooth interactions.', 'React with TailwindCSS for styling, TypeScript for type safety, and a component architecture that mirrors the Figma component library. Custom hooks for feed and notification state. Smooth transitions using CSS and Framer-style patterns.', 'React,TypeScript,TailwindCSS', '[{"v":"Pixel-perfect","l":"Figma to code"},{"v":"Fully","l":"Responsive"},{"v":"Live","l":"socialmedia.victruth.com"}]', 'https://socialmedia.victruth.com', 0, 6, 'published'),

('Business Listing — Search & Discovery Platform', 'businesslisting', 'ecommerce,backend', 'A business directory platform allowing businesses to list products and services, and users to search, rate, and share listings. AJAX-powered live search with no page reloads.', 'Needed fast, accurate search across thousands of listings without full page reloads, plus a rating and social sharing system that worked across devices.', 'PHP backend with MySQL and optimised full-text search indexes. AJAX/jQuery for real-time search-as-you-type. Star rating system with vote aggregation. Product/service repost and share functionality integrated with social platforms.', 'PHP,MySQL,Ajax,jQuery,Bootstrap', '[{"v":"Live search","l":"AJAX-powered"},{"v":"Star ratings","l":"Aggregated"},{"v":"Live","l":"businesslisting.victruth.com"}]', 'https://businesslisting.victruth.com', 0, 7, 'published'),

('E-Commerce Suite — 3 Variants with Dashboard & Payments', 'ecommerce', 'ecommerce', 'Three distinct PHP e-commerce stores, each with a custom admin dashboard, product management, stock tracking, payment API integration, and automated social sharing on new listings.', 'Needed three independent storefronts with different product catalogues and branding but shared infrastructure — with upsell/cross-sell logic and automatic Facebook sharing to drive organic reach.', 'Custom PHP with MySQL, shared codebase with per-store configuration. Payment gateway API integration with webhook handling. Automatic Facebook Graph API posting on new product publish. Upsell and cross-sell product relationship engine. Also handled an OpenCart to WooCommerce data migration for a client, preserving all SEO, Google Analytics, and Facebook Pixel continuity.', 'PHP,MySQL,Payment API,WordPress,WooCommerce,OpenCart,Facebook API', '[{"v":"3","l":"Live Stores"},{"v":"Upsell/X-sell","l":"Engine"},{"v":"Auto FB","l":"Sharing"}]', 'https://basicecommerce1.victruth.com', 0, 8, 'published');
