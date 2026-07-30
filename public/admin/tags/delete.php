<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../includes/db.php';
require_once __DIR__ . '/../../../includes/auth.php';
require_once __DIR__ . '/../../../includes/helpers.php';

require_login();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect(ADMIN_URL . '/tags/index.php');
verify_csrf();

$id  = (int)($_POST['id'] ?? 0);
$pdo = db();

$pdo->prepare('DELETE FROM tags WHERE id = ?')->execute([$id]);
flash('success', 'Tag deleted.');
redirect(ADMIN_URL . '/tags/index.php');
