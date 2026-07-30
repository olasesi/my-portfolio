<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../includes/db.php';
require_once __DIR__ . '/../../../includes/auth.php';
require_once __DIR__ . '/../../../includes/helpers.php';
require_once __DIR__ . '/../layout.php';

require_login();
$pdo = db();

$search = trim($_GET['q'] ?? '');
$page   = max(1, (int)($_GET['page'] ?? 1));
$perPage = 15;

if ($search) {
    $sql  = "SELECT COUNT(*) FROM posts WHERE title LIKE ? OR excerpt LIKE ?";
    $like = "%{$search}%";
    $total = $pdo->prepare($sql);
    $total->execute([$like, $like]);
    $total = $total->fetchColumn();

    $posts = $pdo->prepare("
        SELECT p.*, c.name AS cat_name
        FROM posts p
        LEFT JOIN categories c ON c.id = p.category_id
        WHERE p.title LIKE ? OR p.excerpt LIKE ?
        ORDER BY p.created_at DESC
        LIMIT ? OFFSET ?
    ");
    $posts->execute([$like, $like, $perPage, ($page - 1) * $perPage]);
    $posts = $posts->fetchAll();
} else {
    $total = $pdo->query('SELECT COUNT(*) FROM posts')->fetchColumn();

    $posts = $pdo->prepare("
        SELECT p.*, c.name AS cat_name
        FROM posts p
        LEFT JOIN categories c ON c.id = p.category_id
        ORDER BY p.created_at DESC
        LIMIT ? OFFSET ?
    ");
    $posts->execute([$perPage, ($page - 1) * $perPage]);
    $posts = $posts->fetchAll();
}

$pagination = paginate($total, $perPage, $page);

layout_head('Posts');
?>

<style>
  .search-bar { display: flex; gap: 0.75rem; align-items: center; }
  .search-bar .fc { max-width: 320px; }
  .search-bar .btn-submit { padding: 0.75rem 1.25rem; font-size: 0.82rem; }
  .status-filter { display: flex; gap: 0.4rem; margin-left: auto; }
  .sf-btn {
    padding: 0.4rem 0.9rem; border-radius: 6px; border: 1px solid var(--borderl);
    background: transparent; color: var(--slate); font-size: 0.78rem; font-weight: 600;
    cursor: pointer; transition: all 0.2s; text-decoration: none;
  }
  .sf-btn:hover { border-color: var(--teal); color: var(--teal); }
  .sf-btn.active { background: var(--teal); color: var(--navy); border-color: var(--teal); }
  .post-title-cell { max-width: 300px; }
  .post-title-cell a { color: var(--white); font-weight: 600; text-decoration: none; transition: color 0.2s; }
  .post-title-cell a:hover { color: var(--teal); }
  .thumb-sm { width: 48px; height: 48px; border-radius: 8px; object-fit: cover; border: 1px solid var(--borderl); }
  .thumb-placeholder {
    width: 48px; height: 48px; border-radius: 8px; background: var(--navy3);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem; font-weight: 700; color: var(--slate); border: 1px solid var(--borderl);
  }
</style>

<div class="topbar">
  <div class="topbar-title">Posts (<?= $total ?>)</div>
  <div class="topbar-right">
    <a class="tb-btn tb-btn-primary" href="<?= ADMIN_URL ?>/posts/create.php">+ New Post</a>
  </div>
</div>

<div class="content">
  <?php render_flash(); ?>

  <form class="search-bar" method="GET" style="margin-bottom:1.5rem;">
    <input type="text" name="q" class="fc" placeholder="Search posts..." value="<?= e($search) ?>" />
    <button type="submit" class="btn-submit">Search</button>
    <?php if ($search): ?>
      <a href="<?= ADMIN_URL ?>/posts/index.php" class="sf-btn">Clear</a>
    <?php endif; ?>
  </form>

  <?php if ($posts): ?>
    <div class="card">
      <table class="tbl">
        <thead>
          <tr>
            <th></th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Views</th>
            <th>Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($posts as $p): ?>
            <tr>
              <td>
                <?php if ($p['featured_image']): ?>
                  <img class="thumb-sm" src="<?= UPLOAD_URL ?>/<?= e($p['featured_image']) ?>" alt="" />
                <?php else: ?>
                  <div class="thumb-placeholder">IMG</div>
                <?php endif; ?>
              </td>
              <td class="post-title-cell">
                <a href="<?= ADMIN_URL ?>/posts/edit.php?id=<?= $p['id'] ?>"><?= e($p['title']) ?></a>
              </td>
              <td><?= e($p['cat_name'] ?? '—') ?></td>
              <td>
                <span class="badge badge-<?= $p['status'] ?>">
                  <?= $p['status'] === 'published' ? '● Published' : '○ Draft' ?>
                </span>
              </td>
              <td><?= (int)$p['views'] ?></td>
              <td><?= fmt_date($p['created_at']) ?></td>
              <td>
                <div class="actions">
                  <a class="act-btn" href="<?= ADMIN_URL ?>/posts/edit.php?id=<?= $p['id'] ?>">Edit</a>
                  <?php if ($p['status'] === 'published'): ?>
                    <a class="act-btn" href="<?= SITE_URL ?>/post/<?= e($p['slug']) ?>" target="_blank">View</a>
                  <?php endif; ?>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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

  <?php else: ?>
    <div class="empty">
      <div class="empty-icon">📝</div>
      <div class="empty-title"><?= $search ? 'No posts match your search' : 'No posts yet' ?></div>
      <p style="margin-top:0.5rem;font-size:0.84rem;">
        <?php if ($search): ?>
          <a href="<?= ADMIN_URL ?>/posts/index.php" style="color:var(--teal);">Clear search</a>
        <?php else: ?>
          <a href="<?= ADMIN_URL ?>/posts/create.php" style="color:var(--teal);">Create your first post →</a>
        <?php endif; ?>
      </p>
    </div>
  <?php endif; ?>
</div>

<?php layout_foot(); ?>
