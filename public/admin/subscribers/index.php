<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../includes/db.php';
require_once __DIR__ . '/../../../includes/auth.php';
require_once __DIR__ . '/../../../includes/helpers.php';
require_login();

$pdo = db();
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 20;
$offset = ($page - 1) * $perPage;

$total = $pdo->query("SELECT COUNT(*) FROM subscribers WHERE active = 1")->fetchColumn();
$pages = max(1, ceil($total / $perPage));

$subs = $pdo->prepare("SELECT * FROM subscribers WHERE active = 1 ORDER BY created_at DESC LIMIT ? OFFSET ?");
$subs->execute([$perPage, $offset]);
$subs = $subs->fetchAll();

$page_title = 'Subscribers';
require_once __DIR__ . '/../layout.php';
layout_head($page_title);
?>

<div class="topbar">
  <div class="topbar-title">Subscribers</div>
  <div class="topbar-right">
    <span style="font-size:0.82rem;color:var(--slate);"><?= $total ?> active</span>
  </div>
</div>

<div class="content">
  <?php if (empty($subs)): ?>
    <div class="empty">
      <div class="empty-icon">📭</div>
      <div class="empty-title">No subscribers yet</div>
      <p>Newsletter sign-ups will appear here.</p>
    </div>
  <?php else: ?>
    <div class="card">
      <div class="card-body" style="padding:0;overflow-x:auto;">
        <table class="tbl">
          <thead>
            <tr>
              <th>Email</th>
              <th>Subscribed</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($subs as $s): ?>
              <tr>
                <td style="font-weight:600;color:var(--white);"><a href="mailto:<?= e($s['email']) ?>" style="color:var(--teal);text-decoration:none;"><?= e($s['email']) ?></a></td>
                <td><?= date('M d, Y', strtotime($s['created_at'])) ?></td>
                <td>
                  <div class="actions">
                    <form method="POST" action="unsubscribe.php" class="confirm-form" onsubmit="return confirm('Unsubscribe this user?')">
                      <input type="hidden" name="id" value="<?= $s['id'] ?>">
                      <button type="submit" class="act-btn act-btn-danger">Unsubscribe</button>
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
