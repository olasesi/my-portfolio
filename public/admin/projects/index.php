<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../includes/db.php';
require_once __DIR__ . '/../../../includes/auth.php';
require_once __DIR__ . '/../../../includes/helpers.php';
require_login();

$pdo = db();
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 15;
$offset = ($page - 1) * $perPage;

$total = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
$pages = max(1, ceil($total / $perPage));

$projects = $pdo->prepare("SELECT * FROM projects ORDER BY sort_order ASC, created_at DESC LIMIT ? OFFSET ?");
$projects->execute([$perPage, $offset]);
$projects = $projects->fetchAll();

$page_title = 'Projects';
require_once __DIR__ . '/../layout.php';
layout_head($page_title);
?>

<div class="topbar">
  <div class="topbar-title">Projects</div>
  <div class="topbar-right">
    <a href="create.php" class="tb-btn tb-btn-primary">+ New Project</a>
  </div>
</div>

<div class="content">
  <?php if (empty($projects)): ?>
    <div class="empty">
      <div class="empty-icon">📁</div>
      <div class="empty-title">No projects yet</div>
      <p>Add your first portfolio project to get started.</p>
    </div>
  <?php else: ?>
    <div class="card">
      <div class="card-body" style="padding:0;overflow-x:auto;">
        <table class="tbl">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Category</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($projects as $p): ?>
              <tr>
                <td style="font-weight:700;color:var(--borderl);"><?= sprintf('%02d', $p['sort_order']) ?></td>
                <td style="font-weight:600;color:var(--white);"><?= e($p['title']) ?></td>
                <td><span style="font-size:0.78rem;color:var(--teal);"><?= e($p['category'] ?: '—') ?></span></td>
                <td>
                  <span class="badge badge-<?= $p['status'] === 'published' ? 'published' : 'draft' ?>">
                    <?= $p['status'] === 'published' ? 'Published' : 'Draft' ?>
                  </span>
                </td>
                <td>
                  <div class="actions">
                    <a href="edit.php?id=<?= $p['id'] ?>" class="act-btn">Edit</a>
                    <form method="POST" action="delete.php" class="confirm-form" onsubmit="return confirm('Delete this project?')">
                      <input type="hidden" name="id" value="<?= $p['id'] ?>">
                      <button type="submit" class="act-btn act-btn-danger">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <?php if ($pages > 1): ?>
      <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
          <a class="page-btn <?= $i === $page ? 'active' : '' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>

<?php layout_foot(); ?>
