<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../includes/db.php';
require_once __DIR__ . '/../../../includes/auth.php';
require_once __DIR__ . '/../../../includes/helpers.php';
require_once __DIR__ . '/../layout.php';

require_login();
$pdo = db();

$id = (int)($_GET['id'] ?? 0);
$st = $pdo->prepare('SELECT * FROM categories WHERE id = ?');
$st->execute([$id]);
$category = $st->fetch();

if (!$category) {
    flash('error', 'Category not found.');
    redirect(ADMIN_URL . '/categories/index.php');
}

$errors = [];
$input  = $category;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $input['name'] = trim($_POST['name'] ?? '');

    if (!$input['name']) {
        $errors[] = 'Category name is required.';
    } else {
        $slug = unique_slug($input['name'], 'categories', $id);
        $pdo->prepare('UPDATE categories SET name=?, slug=? WHERE id=?')
            ->execute([$input['name'], $slug, $id]);
        flash('success', 'Category updated.');
        redirect(ADMIN_URL . '/categories/index.php');
    }
}

layout_head('Edit Category');
?>

<div class="topbar">
  <div class="topbar-title">Edit Category</div>
  <div class="topbar-right">
    <a class="tb-btn tb-btn-ghost" href="<?= ADMIN_URL ?>/categories/index.php">← Back</a>
  </div>
</div>

<div class="content">
  <?php foreach ($errors as $err): ?>
    <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:8px;padding:0.85rem 1rem;margin-bottom:1rem;font-size:0.84rem;color:#FCA5A5;"><?= e($err) ?></div>
  <?php endforeach; ?>

  <div class="card" style="max-width:560px;">
    <div class="card-header"><div class="card-title">Rename Category</div></div>
    <div class="card-body">
      <form method="POST">
        <?= csrf_field() ?>
        <div class="fg">
          <label class="fl">Category Name *</label>
          <input type="text" name="name" class="fc" value="<?= e($input['name']) ?>" required autofocus />
          <div class="form-hint">Current slug: <code><?= e($category['slug']) ?></code> — will be regenerated.</div>
        </div>
        <div style="display:flex;gap:0.75rem;">
          <button type="submit" class="btn-submit">Save Changes</button>
          <a class="btn-cancel" href="<?= ADMIN_URL ?>/categories/index.php">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php layout_foot(); ?>
