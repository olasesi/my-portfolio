<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../includes/db.php';
require_once __DIR__ . '/../../../includes/auth.php';
require_once __DIR__ . '/../../../includes/helpers.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $pdo = db();
    $pdo->prepare("DELETE FROM projects WHERE id = ?")->execute([$id]);
}
header('Location: ' . ADMIN_URL . '/projects/index.php');
exit;
