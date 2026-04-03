<?php
// ── Start session with custom name ───────────────────────────
function session_start_safe(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_name(SESSION_NAME);
        session_start();
    }
}

// ── Require admin to be logged in ────────────────────────────
function require_login(): void {
    session_start_safe();
    if (empty($_SESSION['admin_id'])) {
        header('Location: ' . ADMIN_URL . '/login.php');
        exit;
    }
}

// ── Check if admin is logged in ──────────────────────────────
function is_logged_in(): bool {
    session_start_safe();
    return !empty($_SESSION['admin_id']);
}

// ── Log admin in ─────────────────────────────────────────────
function login_admin(array $admin): void {
    session_start_safe();
    session_regenerate_id(true);
    $_SESSION['admin_id']   = $admin['id'];
    $_SESSION['admin_name'] = $admin['name'];
    $_SESSION['admin_email']= $admin['email'];
}

// ── Log admin out ────────────────────────────────────────────
function logout_admin(): void {
    session_start_safe();
    $_SESSION = [];
    session_destroy();
}

// ── Current admin name ───────────────────────────────────────
function current_admin_name(): string {
    session_start_safe();
    return $_SESSION['admin_name'] ?? 'Admin';
}

// ── CSRF token ───────────────────────────────────────────────
function csrf_token(): string {
    session_start_safe();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

function verify_csrf(): void {
    if (
        empty($_POST['csrf_token']) ||
        !hash_equals(csrf_token(), $_POST['csrf_token'])
    ) {
        http_response_code(403);
        die('Invalid CSRF token. Go back and try again.');
    }
}
