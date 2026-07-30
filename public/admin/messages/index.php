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

$total = $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();
$pages = max(1, ceil($total / $perPage));

$messages = $pdo->prepare("SELECT * FROM messages ORDER BY created_at DESC LIMIT ? OFFSET ?");
$messages->execute([$perPage, $offset]);
$messages = $messages->fetchAll();

$page_title = 'Messages';
require_once __DIR__ . '/../layout.php';
layout_head($page_title);
?>

<div class="topbar">
  <div class="topbar-title">Messages</div>
  <div class="topbar-right">
    <span style="font-size:0.82rem;color:var(--slate);"><?= $total ?> total</span>
  </div>
</div>

<div class="content">
  <?php if (empty($messages)): ?>
    <div class="empty">
      <div class="empty-icon">📭</div>
      <div class="empty-title">No messages yet</div>
      <p>Contact form submissions will appear here.</p>
    </div>
  <?php else: ?>
    <div class="card">
      <div class="card-body" style="padding:0;overflow-x:auto;">
        <table class="tbl">
          <thead>
            <tr>
              <th></th>
              <th>From</th>
              <th>Email</th>
              <th>Budget</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($messages as $m): ?>
              <tr style="<?= !$m['is_read'] ? 'background:rgba(0,201,174,0.03);' : '' ?>">
                <td style="width:36px;">
                  <?php if (!$m['is_read']): ?>
                    <span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--teal);"></span>
                  <?php endif; ?>
                </td>
                <td style="font-weight:600;color:var(--white);"><?= e($m['name']) ?></td>
                <td><a href="mailto:<?= e($m['email']) ?>" style="color:var(--teal);text-decoration:none;"><?= e($m['email']) ?></a></td>
                <td><?= e($m['budget'] ?: '—') ?></td>
                <td style="white-space:nowrap;"><?= date('M d, Y', strtotime($m['created_at'])) ?></td>
                <td>
                  <div class="actions">
                    <a href="?view=<?= $m['id'] ?>" class="act-btn">View</a>
                    <form method="POST" action="delete.php" class="confirm-form" onsubmit="return confirm('Delete this message?')">
                      <input type="hidden" name="id" value="<?= $m['id'] ?>">
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

<?php
// View single message
if (isset($_GET['view'])) {
  $id = (int)$_GET['view'];
  $msg = $pdo->prepare("SELECT * FROM messages WHERE id = ?");
  $msg->execute([$id]);
  $msg = $msg->fetch();
  if ($msg) {
    // Mark as read
    $pdo->prepare("UPDATE messages SET is_read = 1 WHERE id = ?")->execute([$id]);
    echo '<div style="position:fixed;inset:0;z-index:200;background:rgba(4,10,18,0.85);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;" onclick="if(event.target===this)this.remove()">';
    echo '<div style="background:var(--navy2);border:1px solid var(--borderl);border-radius:12px;max-width:640px;width:95%;max-height:85vh;overflow-y:auto;padding:2.5rem;">';
    echo '<div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:1.5rem;">';
    echo '<div><h2 style="font-size:1.1rem;font-weight:700;color:var(--white);margin-bottom:0.3rem;">' . e($msg['name']) . '</h2>';
    echo '<a href="mailto:' . e($msg['email']) . '" style="color:var(--teal);font-size:0.85rem;text-decoration:none;">' . e($msg['email']) . '</a></div>';
    echo '<span style="font-size:0.78rem;color:var(--slate);white-space:nowrap;">' . date('M d, Y — H:i', strtotime($msg['created_at'])) . '</span>';
    echo '</div>';
    if ($msg['company']) echo '<p style="font-size:0.82rem;color:var(--slate);margin-bottom:0.5rem;"><strong>Company:</strong> ' . e($msg['company']) . '</p>';
    if ($msg['budget']) echo '<p style="font-size:0.82rem;color:var(--slate);margin-bottom:1rem;"><strong>Budget:</strong> ' . e($msg['budget']) . '</p>';
    echo '<div style="border-top:1px solid var(--border);padding-top:1.25rem;">';
    echo '<p style="font-size:0.88rem;color:var(--slatel);line-height:1.8;white-space:pre-wrap;">' . e($msg['body']) . '</p>';
    echo '</div>';
    echo '<div style="margin-top:1.5rem;display:flex;gap:0.75rem;">';
    echo '<a href="mailto:' . e($msg['email']) . '?subject=Re: ' . e($msg['subject'] ?: 'Your message') . '" style="padding:0.6rem 1.25rem;background:var(--teal);color:var(--navy);border:none;border-radius:7px;font-size:0.82rem;font-weight:700;text-decoration:none;">Reply via Email</a>';
    echo '<button onclick="this.closest(\'div[style]\').remove()" style="padding:0.6rem 1.25rem;background:transparent;border:1px solid var(--borderl);color:var(--slatel);border-radius:7px;font-size:0.82rem;font-weight:600;cursor:pointer;">Close</button>';
    echo '</div>';
    echo '</div></div>';
  }
}

layout_foot();
?>
