<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../includes/db.php';
require_once __DIR__ . '/../../../includes/auth.php';
require_once __DIR__ . '/../../../includes/helpers.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(ADMIN_URL . '/posts/index.php');
}

verify_csrf();

$id  = (int)($_POST['id'] ?? 0);
$pdo = db();

$st = $pdo->prepare("SELECT featured_image FROM posts WHERE id = ?");
$st->execute([$id]);
$post = $st->fetch();

if ($post) {
    delete_upload($post['featured_image']);
    // post_tags are deleted via CASCADE, but let's be explicit
    $pdo->prepare("DELETE FROM post_tags WHERE post_id = ?")->execute([$id]);
    $pdo->prepare("DELETE FROM posts WHERE id = ?")->execute([$id]);
    flash('success', 'Post deleted.');
} else {
    flash('error', 'Post not found.');
}

redirect(ADMIN_URL . '/posts/index.php');
