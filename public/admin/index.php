<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/layout.php';

require_login();

$pdo = db();

$totalPosts      = $pdo->query('SELECT COUNT(*) FROM posts')->fetchColumn();
$publishedPosts  = $pdo->query("SELECT COUNT(*) FROM posts WHERE status='published'")->fetchColumn();
$draftPosts      = $pdo->query("SELECT COUNT(*) FROM posts WHERE status='draft'")->fetchColumn();
$totalCategories = $pdo->query('SELECT COUNT(*) FROM categories')->fetchColumn();
$totalTags       = $pdo->query('SELECT COUNT(*) FROM tags')->fetchColumn();

$recent = $pdo->query("
    SELECT p.id, p.title, p.slug, p.status, p.created_at, c.name AS cat_name
    FROM posts p
    LEFT JOIN categories c ON c.id = p.category_id
    ORDER BY p.created_at DESC
    LIMIT 8
")->fetchAll();

layout_head('Dashboard');
?>
<div class="topbar">
  <div class="topbar-title">Dashboard</div>
  <div class="topbar-right">
    <a class="tb-btn tb-btn-primary" href="<?= ADMIN_URL ?>/posts/create.php">+ New Post</a>
  </div>
</div>

<div class="content">
  <?php render_flash(); ?>

  <div class="stats-row" style="grid-template-columns:repeat(5,1fr);">
    <div class="stat-card">
      <div class="stat-num"><?= $totalPosts ?></div>
      <div class="stat-label">Total Posts</div>
    </div>
    <div class="stat-card">
      <div class="stat-num"><?= $publishedPosts ?></div>
      <div class="stat-label">Published</div>
    </div>
    <div class="stat-card">
      <div class="stat-num"><?= $draftPosts ?></div>
      <div class="stat-label">Drafts</div>
    </div>
    <div class="stat-card">
      <div class="stat-num"><?= $totalCategories ?></div>
      <div class="stat-label">Categories</div>
    </div>
    <div class="stat-card">
      <div class="stat-num"><?= $totalTags ?></div>
      <div class="stat-label">Tags</div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">Recent Posts</div>
      <a class="tb-btn tb-btn-ghost" href="<?= ADMIN_URL ?>/posts/index.php">View All</a>
    </div>
    <?php if ($recent): ?>
      <table class="tbl">
        <thead>
          <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recent as $p): ?>
            <tr>
              <td style="color:var(--white);font-weight:600;max-width:280px;">
                <?= e($p['title']) ?>
              </td>
              <td><?= e($p['cat_name'] ?? '—') ?></td>
              <td>
                <span class="badge badge-<?= $p['status'] ?>">
                  <?= $p['status'] === 'published' ? '● Published' : '○ Draft' ?>
                </span>
              </td>
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
    <?php else: ?>
      <div class="empty">
        <div class="empty-icon">📝</div>
        <div class="empty-title">No posts yet</div>
        <p style="margin-top:0.5rem;font-size:0.84rem;">
          <a href="<?= ADMIN_URL ?>/posts/create.php" style="color:var(--teal);">Create your first post →</a>
        </p>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php layout_foot(); ?>
