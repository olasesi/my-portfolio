<?php
// ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===
//  Blog Configuration
//  Edit these values to match your environment.
// ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===

// ── Database ──────────────────────────────────────────────
define( 'DB_HOST', 'localhost' );
define( 'DB_NAME', 'ahmed_blog' );
define( 'DB_USER', 'root' );
define( 'DB_PASS', '' );
define( 'DB_CHARSET', 'utf8mb4' );

// ── Site URLs ─────────────────────────────────────────────
define( 'SITE_URL',  'http://localhost/ahmed-olusesi/public' );
define( 'ADMIN_URL', 'http://localhost/ahmed-olusesi/public/admin' );
define( 'UPLOAD_URL', SITE_URL . '/uploads' );

// ── File Uploads ──────────────────────────────────────────
define( 'UPLOAD_DIR', __DIR__ . '/public/uploads/' );
define( 'MAX_FILE_SIZE', 5 * 1024 * 1024 );
// 5 MB
define( 'ALLOWED_TYPES', [ 'image/jpeg', 'image/png', 'image/webp', 'image/gif' ] );

// ── Site Meta ─────────────────────────────────────────────
define( 'SITE_NAME',  'Ahmed Olusesi — Blog' );
define( 'SITE_DESC',  'Engineering and Software development insights on full-stack development, React, Laravel, Node.js, and mobile.' );
define( 'POSTS_PER_PAGE', 9 );

// ── Session name ( avoids conflicts with other PHP apps ) ──
define( 'SESSION_NAME', 'ahmed_blog_session' );

// ── TinyMCE API Key ───────────────────────────────────────
// Get a free key at https://www.tiny.cloud ( free tier allows local + 1 domain )
define( 'TINYMCE_API_KEY', 'no-api-key' );

// ── SMTP ( PHPMailer ) ───────────────────────────────────
define( 'SMTP_HOST',     'mail.ahmed-olusesi.com' );
define( 'SMTP_PORT',     587 );
define( 'SMTP_USERNAME', 'hello@ahmed-olusesi.com' );
define( 'SMTP_PASSWORD', 'YOUR_SMTP_PASSWORD_HERE' );
define( 'SMTP_FROM',     'hello@ahmed-olusesi.com' );
define( 'SMTP_FROM_NAME', 'Ahmed Olusesi — Portfolio' );
define( 'SMTP_ENCRYPTION', 'tls' );
