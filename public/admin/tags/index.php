<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../includes/db.php';
require_once __DIR__ . '/../../../includes/auth.php';
require_once __DIR__ . '/../../../includes/helpers.php';
require_once __DIR__ . '/../layout.php';

require_login();
$pdo = db();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'create') {
    verify_csrf();
    $name = trim($_POST['name'] ?? '');
    if (!$name) {
        $errors[] = 'Tag name is required.';
    } else {
        $slug = unique_slug($name, 'tags');
        $pdo->prepare('INSERT INTO tags (name, slug) VALUES (?, ?)')->execute([$name, $slug]);
        flash('success', 'Tag "' . $name . '" created.');
        redirect(ADMIN_URL . '/tags/index.php');
    }
}

$search = trim($_GET['q'] ?? '');
$page   = max(1, (int)($_GET['page'] ?? 1));
$perPage = 20;

if ($search) {
    $like = "%{$search}%";
    $total = $pdo->prepare('SELECT COUNT(*) FROM tags WHERE name LIKE ?');
    $total->execute([$like]);
    $total = $total->fetchColumn();
    $tags = $pdo->prepare("
        SELECT t.*, COUNT(pt.post_id) AS post_count
        FROM tags t
        LEFT JOIN post_tags pt ON pt.tag_id = t.id
        WHERE t.name LIKE ?
        GROUP BY t.id
        ORDER BY t.name
        LIMIT ? OFFSET ?
    ");
    $tags->execute([$like, $perPage, ($page - 1) * $perPage]);
    $tags = $tags->fetchAll();
} else {
    $total = $pdo->query('SELECT COUNT(*) FROM tags')->fetchColumn();
    $tags = $pdo->prepare("
        SELECT t.*, COUNT(pt.post_id) AS post_count
        FROM tags t
        LEFT JOIN post_tags pt ON pt.tag_id = t.id
        GROUP BY t.id
        ORDER BY t.name
        LIMIT ? OFFSET ?
    ");
    $tags->execute([$perPage, ($page - 1) * $perPage]);
    $tags = $tags->fetchAll();
}

$pagination = paginate($total, $perPage, $page);

layout_head('Tags');
?>

<style>
  .tag-chip {
    display: inline-flex; align-items: center; gap: 0.3rem;
    padding: 0.22rem 0.7rem; border-radius: 100px; font-size: 0.72rem; font-weight: 600;
    border: 1px solid rgba(0,201,174,0.25); color: var(--teal);
    background: rgba(0,201,174,0.08);
  }
  .search-bar { display: flex; gap: 0.75rem; align-items: center; }
  .search-bar .fc { max-width: 320px; }
  .search-bar .btn-submit { padding: 0.75rem 1.25rem; font-size: 0.82rem; }
</style>

<div class="topbar">
  <div class="topbar-title">Tags (<?= $total ?>)</div>
</div>

<div class="content">
  <?php render_flash(); ?>

  <div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start;">

    <!-- Tags list -->
    <div>
      <form class="search-bar" method="GET" style="margin-bottom:1.25rem;">
        <input type="text" name="q" class="fc" placeholder="Search tags..." value="<?= e($search) ?>" />
        <button type="submit" class="btn-submit">Search</button>
        <?php if ($search): ?>
          <a href="<?= ADMIN_URL ?>/tags/index.php" class="sf-btn">Clear</a>
        <?php endif; ?>
      </form>

      <div class="card">
        <div class="card-header"><div class="card-title"><?= $total ?> tag<?= $total !== 1 ? 's' : '' ?></div></div>
        <?php if ($tags): ?>
          <table class="tbl">
            <thead>
              <tr><th>Tag</th><th>Slug</th><th>Posts</th><th></th></tr>
            </thead>
            <tbody>
              <?php foreach ($tags as $tag): ?>
                <tr>
                  <td><span class="tag-chip"><?= e($tag['name']) ?></span></td>
                  <td style="font-family:monospace;font-size:0.8rem;color:var(--slate);"><?= e($tag['slug']) ?></td>
                  <td><?= $tag['post_count'] ?></td>
                  <td>
                    <div class="actions">
                      <?php if ($tag['post_count'] == 0): ?>
                        <form class="confirm-form" method="POST" action="<?= ADMIN_URL ?>/tags/delete.php"
                              onsubmit="return confirm('Delete tag «<?= e(addslashes($tag['name'])) ?>»?')">
                          <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                          <input type="hidden" name="id" value="<?= $tag['id'] ?>">
                          <button type="submit" class="act-btn act-btn-danger" style="border:none;cursor:pointer;">Delete</button>
                        </form>
                      <?php else: ?>
                        <span class="act-btn" style="opacity:0.4;cursor:not-allowed;" title="Remove from posts first">Delete</span>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="empty">
            <div class="empty-icon">🏷️</div>
            <div class="empty-title"><?= $search ? 'No tags match your search' : 'No tags yet' ?></div>
          </div>
        <?php endif; ?>
      </div>

      <?php if ($pagination['pages'] > 1): ?>
        <div class="pagination">
          <?php if ($pagination['prev']): ?>
            <a class="page-btn" href="?page=<?= $pagination['prev'] ?>&q=<?= e($search) ?>">← Prev</a>
          <?php endif; ?>
          <?php for ($i = 1; $i <= $pagination['pages']; $i++): ?>
            <a class="page-btn <?= $i === $page ? 'active' : '' ?>" href="?page=<?= $i ?>&q=<?= e($search) ?>"><?= $i ?></a>
          <?php endfor; ?>
          <?php if ($pagination['next']): ?>
            <a class="page-btn" href="?page=<?= $pagination['next'] ?>&q=<?= e($search) ?>">Next →</a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>

    <!-- Create form -->
    <div class="card">
      <div class="card-header"><div class="card-title">Add Tag</div></div>
      <div class="card-body">
        <?php foreach ($errors as $err): ?>
          <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:8px;padding:0.75rem 1rem;margin-bottom:1rem;font-size:0.84rem;color:#FCA5A5;"><?= e($err) ?></div>
        <?php endforeach; ?>
        <form method="POST">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="create">
          <div class="fg">
            <label class="fl">Tag Name *</label>
            <input type="text" name="name" class="fc" placeholder="e.g. GraphQL, Testing…"
                   value="<?= e($_POST['name'] ?? '') ?>" required />
            <div class="form-hint">Slug will be auto-generated.</div>
          </div>
          <button type="submit" class="btn-submit" style="width:100%;">Create Tag</button>
        </form>
      </div>
    </div>

  </div>
</div>

<?php layout_foot(); ?>
