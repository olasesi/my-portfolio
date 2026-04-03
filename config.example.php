<?php
// ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===
//  Blog Configuration
//  Edit these values to match your environment.
// ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===

// ── Database local────────────────────────────────────────────────
define( 'DB_HOST', 'localhost' );
//define( 'DB_NAME', 'ahmed_blog' );
// create this database in phpMyAdmin
//define( 'DB_USER', 'root' );
//define( 'DB_PASS', '' );
// XAMPP default ( empty )
define( 'DB_CHARSET', 'utf8mb4' );

// ── Database live────────────────────────────────────────────────
define( 'DB_NAME', '' );
define( 'DB_USER', '' );
define( 'DB_PASS', '' );
// ── Site URLs ────────────────────────────────────────────────
// XAMPP local development:
//define( 'SITE_URL',  'http://localhost:8000/ahmed-olusesi/' );
//define( 'ADMIN_URL', 'http://localhost:8000/ahmed-olusesi/admin' );
//define( 'UPLOAD_URL', SITE_URL . '/uploads' );

// Live subdomain ( uncomment when deployed ):
define( 'SITE_URL',  'https://blog.ahmed-olusesi.com' );
define( 'ADMIN_URL', 'https://blog.ahmed-olusesi.com/admin' );
define( 'UPLOAD_URL', SITE_URL . '/uploads' );

// ── File Uploads ─────────────────────────────────────────────
define( 'UPLOAD_DIR', __DIR__ . '/public/uploads/' );
define( 'MAX_FILE_SIZE', 5 * 1024 * 1024 );
// 5 MB
define( 'ALLOWED_TYPES', [ 'image/jpeg', 'image/png', 'image/webp', 'image/gif' ] );

// ── Site Meta ────────────────────────────────────────────────
define( 'SITE_NAME',  'Ahmed Olusesi — Blog' );
define( 'SITE_DESC',  'Engineering and Software development insights on full-stack development, React, Laravel, Node.js, and mobile.' );
define( 'POSTS_PER_PAGE', 9 );

// ── Session name ( avoids conflicts with other PHP apps ) ──────
define( 'SESSION_NAME', 'ahmed_blog_session' );

// ── TinyMCE API Key ──────────────────────────────────────────
// Get a free key at https://www.tiny.cloud ( free tier allows local + 1 domain )
define( 'TINYMCE_API_KEY', 'no-api-key' );
// replace with your key
