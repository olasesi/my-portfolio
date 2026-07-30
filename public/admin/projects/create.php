<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../includes/db.php';
require_once __DIR__ . '/../../../includes/auth.php';
require_once __DIR__ . '/../../../includes/helpers.php';
require_login();

$pdo = db();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title           = trim($_POST['title'] ?? '');
    $category        = trim($_POST['category'] ?? '');
    $description     = trim($_POST['description'] ?? '');
    $challenge       = trim($_POST['challenge'] ?? '');
    $solution        = trim($_POST['solution'] ?? '');
    $tech_stack      = trim($_POST['tech_stack'] ?? '');
    $metrics         = trim($_POST['metrics'] ?? '');
    $live_url        = trim($_POST['live_url'] ?? '');
    $featured        = isset($_POST['featured']) ? 1 : 0;
    $sort_order      = (int)($_POST['sort_order'] ?? 0);
    $status          = $_POST['status'] ?? 'draft';
    $meta_title      = trim($_POST['meta_title'] ?? '');
    $meta_description = trim($_POST['meta_description'] ?? '');

    if (!$title) $errors[] = 'Title is required.';
    if ($status !== 'published') $status = 'draft';

    if (empty($errors)) {
        $slug = create_slug($title, $pdo, 'projects');

        // Handle image upload
        $image = null;
        if (!empty($_FILES['image']['tmp_name'])) {
            $image = upload_image($_FILES['image'], 'projects');
        }

        $pdo->prepare("
            INSERT INTO projects (title, slug, category, description, challenge, solution, tech_stack, metrics, image, live_url, featured, sort_order, status, meta_title, meta_description)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ")->execute([$title, $slug, $category, $description, $challenge, $solution, $tech_stack, $metrics, $image, $live_url ?: null, $featured, $sort_order, $status, $meta_title, $meta_description]);

        header('Location: ' . ADMIN_URL . '/projects/index.php');
        exit;
    }
}

$page_title = 'Create Project';
require_once __DIR__ . '/../layout.php';
layout_head($page_title);
?>

<div class="topbar">
  <div class="topbar-title">New Project</div>
  <div class="topbar-right">
    <a href="index.php" class="tb-btn tb-btn-ghost">← Back</a>
  </div>
</div>

<div class="content">
  <?php if ($errors): ?>
    <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:8px;padding:1rem;margin-bottom:1.5rem;">
      <?php foreach ($errors as $e): ?>
        <div style="font-size:0.85rem;color:#FCA5A5;">• <?= e($e) ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="card">
      <div class="card-header"><div class="card-title">Project Details</div></div>
      <div class="card-body">
        <div class="form-row">
          <div class="fg">
            <label class="fl">Title *</label>
            <input type="text" name="title" class="fc" required value="<?= e($_POST['title'] ?? '') ?>" placeholder="e.g. NexaERP — Enterprise Resource Planning">
          </div>
          <div class="fg">
            <label class="fl">Category</label>
            <input type="text" name="category" class="fc" value="<?= e($_POST['category'] ?? '') ?>" placeholder="e.g. fullstack, backend (comma-separated)">
          </div>
        </div>

        <div class="fg">
          <label class="fl">Short Description</label>
          <textarea name="description" class="fc" rows="2" placeholder="Brief overview shown in the project list"><?= e($_POST['description'] ?? '') ?></textarea>
        </div>

        <div class="fg">
          <label class="fl">Challenge</label>
          <textarea name="challenge" class="fc" rows="3" placeholder="The problem the client faced"><?= e($_POST['challenge'] ?? '') ?></textarea>
        </div>

        <div class="fg">
          <label class="fl">Solution / Approach</label>
          <textarea name="solution" class="fc" rows="3" placeholder="How you solved it"><?= e($_POST['solution'] ?? '') ?></textarea>
        </div>

        <div class="form-row">
          <div class="fg">
            <label class="fl">Tech Stack</label>
            <input type="text" name="tech_stack" class="fc" value="<?= e($_POST['tech_stack'] ?? '') ?>" placeholder="Comma-separated, e.g. React,Laravel,MySQL">
          </div>
          <div class="fg">
            <label class="fl">Live URL</label>
            <input type="url" name="live_url" class="fc" value="<?= e($_POST['live_url'] ?? '') ?>" placeholder="https://...">
          </div>
        </div>

        <div class="fg">
          <label class="fl">Metrics (JSON)</label>
          <textarea name="metrics" class="fc" rows="2" placeholder='[{"v":"5","l":"Permission Levels"}]'><?= e($_POST['metrics'] ?? '') ?></textarea>
          <div class="form-hint">JSON array of objects with "v" (value) and "l" (label) keys.</div>
        </div>

        <div class="fg">
          <label class="fl">Featured Image</label>
          <input type="file" name="image" accept="image/*" class="fc">
        </div>

        <div class="form-row">
          <div class="fg">
            <label class="fl">Sort Order</label>
            <input type="number" name="sort_order" class="fc" value="<?= (int)($_POST['sort_order'] ?? 0) ?>">
          </div>
          <div class="fg">
            <label class="fl">Status</label>
            <select name="status" class="fc">
              <option value="draft" <?= ($_POST['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
              <option value="published" <?= ($_POST['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
            </select>
          </div>
        </div>

        <div class="fg">
          <label class="fl" style="display:inline-flex;align-items:center;gap:0.5rem;">
            <input type="checkbox" name="featured" value="1" <?= !empty($_POST['featured']) ? 'checked' : '' ?>>
            Featured project
          </label>
        </div>
      </div>
    </div>

    <div class="card" style="margin-top:1.25rem;">
      <div class="card-header"><div class="card-title">SEO</div></div>
      <div class="card-body">
        <div class="fg">
          <label class="fl">Meta Title</label>
          <input type="text" name="meta_title" class="fc" value="<?= e($_POST['meta_title'] ?? '') ?>" placeholder="Override project title for SEO">
        </div>
        <div class="fg">
          <label class="fl">Meta Description</label>
          <textarea name="meta_description" class="fc" rows="2" placeholder="Override description for search results"><?= e($_POST['meta_description'] ?? '') ?></textarea>
        </div>
      </div>
    </div>

    <div style="margin-top:1.5rem;display:flex;gap:0.75rem;">
      <button type="submit" class="btn-submit">Create Project</button>
      <a href="index.php" class="btn-cancel">Cancel</a>
    </div>
  </form>
</div>

<?php layout_foot(); ?>
