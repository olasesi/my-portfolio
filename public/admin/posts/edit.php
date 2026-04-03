<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../layout.php';

require_login();
$pdo = db();

$id = (int)($_GET['id'] ?? 0);
$st = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$st->execute([$id]);
$post = $st->fetch();
if (!$post) { flash('error', 'Post not found.'); redirect(ADMIN_URL . '/posts/index.php'); }

$errors = [];
$input  = $post; // pre-fill form with existing values

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $input['title']       = trim($_POST['title']       ?? '');
    $input['slug']        = trim($_POST['slug']        ?? '');
    $input['excerpt']     = trim($_POST['excerpt']     ?? '');
    $input['body']        = $_POST['body']             ?? '';
    $input['category_id'] = (int)($_POST['category_id'] ?? 0) ?: null;
    $input['status']      = $_POST['status'] === 'published' ? 'published' : 'draft';

    if (!$input['title']) $errors[] = 'Title is required.';
    if (!$input['body'])  $errors[] = 'Post body is required.';
    if (!$input['slug'])  $input['slug'] = make_slug($input['title']);

    $input['slug'] = unique_slug($input['slug'], 'posts', $id);

    // Handle new featured image upload
    $new_image = null;
    try {
        $new_image = handle_upload('featured_image');
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }

    // Handle "remove image" checkbox
    $remove_image = isset($_POST['remove_image']) && !$new_image;

    if (!$errors) {
        // If replacing or removing, delete old file
        if ($new_image || $remove_image) {
            delete_upload($post['featured_image']);
        }
        $final_image = $new_image ?? ($remove_image ? null : $post['featured_image']);

        $st = $pdo->prepare("
            UPDATE posts
            SET title=?, slug=?, excerpt=?, body=?, category_id=?, featured_image=?, status=?, updated_at=NOW()
            WHERE id=?
        ");
        $st->execute([
            $input['title'], $input['slug'], $input['excerpt'], $input['body'],
            $input['category_id'], $final_image, $input['status'], $id,
        ]);
        flash('success', 'Post updated successfully.');
        redirect(ADMIN_URL . '/posts/edit.php?id=' . $id);
    }
}

$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
layout_head('Edit Post');
?>
<div class="topbar">
  <div class="topbar-title">Edit Post</div>
  <div class="topbar-right">
    <a class="tb-btn tb-btn-ghost" href="<?= SITE_URL ?>/post/<?= e($post['slug']) ?>" target="_blank">View Live ↗</a>
    <a class="tb-btn tb-btn-ghost" href="<?= ADMIN_URL ?>/posts/index.php">← Back</a>
  </div>
</div>

<div class="content">
  <?php render_flash(); ?>
  <?php foreach ($errors as $err): ?>
    <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:8px;padding:0.85rem 1rem;margin-bottom:1rem;font-size:0.84rem;color:#FCA5A5;"><?= e($err) ?></div>
  <?php endforeach; ?>

  <form method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div style="display:grid;grid-template-columns:1fr 300px;gap:1.5rem;align-items:start;">

      <div>
        <div class="card" style="margin-bottom:1.5rem;">
          <div class="card-body">
            <div class="fg">
              <label class="fl">Post Title *</label>
              <input type="text" name="title" id="title" class="fc" value="<?= e($input['title']) ?>" required />
            </div>
            <div class="fg">
              <label class="fl">Slug</label>
              <input type="text" name="slug" id="slug" class="fc" value="<?= e($input['slug']) ?>" />
              <div class="form-hint">URL: <code><?= SITE_URL ?>/post/<?= e($input['slug']) ?></code></div>
            </div>
            <div class="fg">
              <label class="fl">Excerpt</label>
              <textarea name="excerpt" class="fc" rows="3"><?= e($input['excerpt'] ?? '') ?></textarea>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header"><div class="card-title">Content *</div></div>
          <div class="card-body">
            <textarea name="body" id="body"><?= e($input['body']) ?></textarea>
          </div>
        </div>
      </div>

      <div style="display:flex;flex-direction:column;gap:1.5rem;">
        <div class="card">
          <div class="card-header"><div class="card-title">Publish</div></div>
          <div class="card-body">
            <div class="fg">
              <label class="fl">Status</label>
              <select name="status" class="fc">
                <option value="draft"     <?= $input['status']==='draft'     ? 'selected':'' ?>>Draft</option>
                <option value="published" <?= $input['status']==='published' ? 'selected':'' ?>>Published</option>
              </select>
            </div>
            <div style="font-size:0.75rem;color:var(--slate);margin-bottom:1rem;">
              Last updated: <?= fmt_date($post['updated_at'], 'M j, Y g:ia') ?>
            </div>
            <button type="submit" class="btn-submit" style="width:100%;">Update Post</button>
            <a class="btn-cancel" href="<?= ADMIN_URL ?>/posts/index.php"
               style="display:block;text-align:center;margin-top:0.6rem;">Cancel</a>
          </div>
        </div>

        <div class="card">
          <div class="card-header"><div class="card-title">Category</div></div>
          <div class="card-body">
            <select name="category_id" class="fc">
              <option value="">— None —</option>
              <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $input['category_id']==$cat['id'] ? 'selected':'' ?>>
                  <?= e($cat['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="card">
          <div class="card-header"><div class="card-title">Featured Image</div></div>
          <div class="card-body">
            <?php if ($post['featured_image']): ?>
              <img src="<?= UPLOAD_URL ?>/<?= e($post['featured_image']) ?>"
                   style="width:100%;border-radius:8px;margin-bottom:0.75rem;border:1px solid var(--borderl);" />
              <label style="display:flex;align-items:center;gap:0.5rem;font-size:0.82rem;color:var(--slatel);cursor:pointer;margin-bottom:0.75rem;">
                <input type="checkbox" name="remove_image" value="1" /> Remove current image
              </label>
              <div class="form-hint" style="margin-bottom:0.75rem;">Or upload a new image to replace it:</div>
            <?php endif; ?>
            <input type="file" name="featured_image" class="fc"
                   accept="image/jpeg,image/png,image/webp,image/gif"
                   onchange="previewImage(this)" />
            <div class="form-hint">JPEG, PNG, WebP, GIF — max 5 MB</div>
            <img id="img-preview" class="file-preview" src="" style="display:none;" />
          </div>
        </div>

        <div class="card" style="border-color:rgba(239,68,68,0.2);">
          <div class="card-header"><div class="card-title" style="color:#FCA5A5;">Danger Zone</div></div>
          <div class="card-body">
            <form method="POST" action="<?= ADMIN_URL ?>/posts/delete.php"
                  onsubmit="return confirm('Delete this post permanently? This cannot be undone.')">
              <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
              <input type="hidden" name="id" value="<?= $id ?>">
              <button type="submit"
                      style="width:100%;padding:0.7rem;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:8px;color:#FCA5A5;font-size:0.84rem;font-weight:700;cursor:pointer;">
                Delete This Post
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<script src="https://cdn.tiny.cloud/1/<?= TINYMCE_API_KEY ?>/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '#body',
  height: 520,
  skin: 'oxide-dark',
  content_css: 'dark',
  plugins: ['advlist','autolink','lists','link','image','charmap','preview','searchreplace','fullscreen','insertdatetime','media','table','codesample','emoticons','wordcount'],
  toolbar: 'undo redo | blocks | bold italic underline | forecolor | alignleft aligncenter alignright | bullist numlist | link image media | codesample | fullscreen',
  codesample_languages: [
    {text:'HTML/XML',value:'markup'},{text:'JavaScript',value:'javascript'},
    {text:'TypeScript',value:'typescript'},{text:'CSS',value:'css'},
    {text:'PHP',value:'php'},{text:'Python',value:'python'},
    {text:'Bash/Shell',value:'bash'},{text:'SQL',value:'sql'},
    {text:'JSON',value:'json'},{text:'Docker',value:'docker'},
  ],
  codesample_global_prismjs: true,
  promotion: false, branding: false,
  content_style: `body { font-family:'Segoe UI',sans-serif; font-size:16px; color:#cdd6f4; background:#1e1e2e; line-height:1.8; padding:1rem; } pre[class*=language-] { background:#0d1117; border-radius:8px; }`,
});
document.getElementById('slug').addEventListener('input', function() { this._userEdited = true; });
function previewImage(input) {
  const prev = document.getElementById('img-preview');
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => { prev.src = e.target.result; prev.style.display = 'block'; };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?php layout_foot(); ?>
