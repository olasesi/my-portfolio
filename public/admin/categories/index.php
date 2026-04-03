<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../layout.php';

require_login();
$pdo = db();

$errors = [];

// Handle create
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' && isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] === 'create' ) {
    verify_csrf();
    $name = trim( $_POST[ 'name' ] ?? '' );
    if ( !$name ) {
        $errors[] = 'Category name is required.';
    } else {
        $slug = unique_slug( $name, 'categories' );
        $pdo->prepare( 'INSERT INTO categories (name, slug) VALUES (?, ?)' )->execute( [ $name, $slug ] );
        flash( 'success', 'Category \'$name\' created.' );
        redirect( ADMIN_URL . '/categories/index.php' );
    }
}

$categories = $pdo->query( "
    SELECT c.*, COUNT(p.id) AS post_count
    FROM categories c
    LEFT JOIN posts p ON p.category_id = c.id
    GROUP BY c.id
    ORDER BY c.name
" )->fetchAll();

layout_head( 'Categories' );
?>
<div class = 'topbar'>
<div class = 'topbar-title'>Categories</div>
</div>

<div class = 'content'>
<?php render_flash();
?>

<div style = 'display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start;'>

<!-- Category list -->
<div class = 'card'>
<div class = 'card-header'><div class = 'card-title'>< ?= count( $categories ) ?> categor< ?= count( $categories ) !== 1?'ies':'y' ?></div></div>
<?php if ( $categories ): ?>
<table class = 'tbl'>
<thead>
<tr><th>Name</th><th>Slug</th><th>Posts</th><th>Created</th><th></th></tr>
</thead>
<tbody>
<?php foreach ( $categories as $cat ): ?>
<tr>
<td style = 'font-weight:600;color:var(--white);'>< ?= e( $cat[ 'name' ] ) ?></td>
<td style = 'font-family:monospace;font-size:0.8rem;color:var(--slate);'>< ?= e( $cat[ 'slug' ] ) ?></td>
<td>< ?= $cat[ 'post_count' ] ?></td>
<td>< ?= fmt_date( $cat[ 'created_at' ] ) ?></td>
<td>
<div class = 'actions'>
<a class = 'act-btn' href = "<?= ADMIN_URL ?>/categories/edit.php?id=<?= $cat['id'] ?>">Rename</a>
<?php if ( $cat[ 'post_count' ] == 0 ): ?>
<form class = 'confirm-form' method = 'POST' action = '<?= ADMIN_URL ?>/categories/delete.php'
onsubmit = "return confirm('Delete category «<?= e(addslashes($cat['name'])) ?>»?')">
<input type = 'hidden' name = 'csrf_token' value = '<?= csrf_token() ?>'>
<input type = 'hidden' name = 'id' value = "<?= $cat['id'] ?>">
<button type = 'submit' class = 'act-btn act-btn-danger' style = 'border:none;cursor:pointer;'>Delete</button>
</form>
<?php else: ?>
<span class = 'act-btn' style = 'opacity:0.4;cursor:not-allowed;' title = 'Remove posts first'>Delete</span>
<?php endif;
?>
</div>
</td>
</tr>
<?php endforeach;
?>
</tbody>
</table>
<?php else: ?>
<div class = 'empty'><div class = 'empty-icon'>🏷️</div><div class = 'empty-title'>No categories yet</div></div>
<?php endif;
?>
</div>

<!-- Create form -->
<div class = 'card'>
<div class = 'card-header'><div class = 'card-title'>Add Category</div></div>
<div class = 'card-body'>
<?php foreach ( $errors as $err ): ?>
<div style = 'background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:8px;padding:0.75rem 1rem;margin-bottom:1rem;font-size:0.84rem;color:#FCA5A5;'>< ?= e( $err ) ?></div>
<?php endforeach;
?>
<form method = 'POST'>
< ?= csrf_field() ?>
<input type = 'hidden' name = 'action' value = 'create'>
<div class = 'fg'>
<label class = 'fl'>Category Name *</label>
<input type = 'text' name = 'name' class = 'fc' placeholder = 'e.g. React, Laravel, DevOps…'
value = "<?= e($_POST['name'] ?? '') ?>" required />
<div class = 'form-hint'>Slug will be auto-generated.</div>
</div>
<button type = 'submit' class = 'btn-submit' style = 'width:100%;'>Create Category</button>
</form>
</div>
</div>

</div>
</div>

<?php layout_foot();
?>
