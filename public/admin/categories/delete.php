<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../includes/db.php';
require_once __DIR__ . '/../../../includes/auth.php';
require_once __DIR__ . '/../../../includes/helpers.php';

require_login();
if ( $_SERVER[ 'REQUEST_METHOD' ] !== 'POST' ) redirect( ADMIN_URL . '/categories/index.php' );
verify_csrf();

$id  = ( int )( $_POST[ 'id' ] ?? 0 );
$pdo = db();

// Safety: only allow deletion if no posts assigned
$count = $pdo->prepare( 'SELECT COUNT(*) FROM posts WHERE category_id = ?' );
$count->execute( [ $id ] );
if ( $count->fetchColumn() > 0 ) {
    flash( 'error', 'Cannot delete a category that has posts assigned to it.' );
} else {
    $pdo->prepare( 'DELETE FROM categories WHERE id = ?' )->execute( [ $id ] );
    flash( 'success', 'Category deleted.' );
}
redirect( ADMIN_URL . '/categories/index.php' );
