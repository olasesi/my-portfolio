<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../layout.php';

require_login();
$pdo = db();

$errors = [];
$input  = ['title'=>'','slug'=>'','excerpt'=>'','body'=>'','category_id'=>'','status'=>'draft'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $input['title']       = trim($_POST['title']       ?? '');
    $input['slug']        = trim($_POST['slug']        ?? '');
    $input['excerpt']     = trim($_POST['excerpt']     ?? '');
    $input['body']        = $_POST['body']             ?? '';
    $input['category_id'] = (int)($_POST['category_id'] ?? 0) ?: null;
    $input['status']      = $_POST['status'] === 'published' ? 'published' : 'draft';

    if (!$input['title'])  $errors[] = 'Title is required.';
    if (!$input['body'])   $errors[] = 'Post body is required.';
    if (!$input['slug'])   $input['slug'] = make_slug($input['title']);

    // Ensure slug is unique
    $input['slug'] = unique_slug($input['slug'], 'posts');

    // Handle featured image
    $featured_image = null;
    try {
        $featured_image = handle_upload('featured_image');
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }

    if (!$errors) {
        $st = $pdo->prepare("
            INSERT INTO posts (admin_id, category_id, title, slug, excerpt, body, featured_image, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $st->execute([
            $_SESSION['admin_id'],
            $input['category_id'],
            $input['title'],
            $input['slug'],
            $input['excerpt'],
            $input['body'],
            $featured_image,
            $input['status'],
        ]);
        flash('success', 'Post created successfully.');
        redirect(ADMIN_URL . '/posts/index.php');
    }
}

$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();

layout_head('New Post');
?>
<div class="topbar">
  <div class="topbar-title">New Post</div>
  <div class="topbar-right">
    <a class="tb-btn tb-btn-ghost" href="<?= ADMIN_URL ?>/posts/index.php">← Back</a>
  </div>
</div>

<div class="content">
  <?php foreach ($errors as $err): ?>
    <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:8px;padding:0.85rem 1rem;margin-bottom:1rem;font-size:0.84rem;color:#FCA5A5;"><?= e($err) ?></div>
  <?php endforeach; ?>

  <form method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div style="display:grid;grid-template-columns:1fr 300px;gap:1.5rem;align-items:start;">

      <!-- Main column -->
      <div>
        <div class="card" style="margin-bottom:1.5rem;">
          <div class="card-body">
            <div class="fg">
              <label class="fl">Post Title *</label>
              <input type="text" name="title" id="title" class="fc" placeholder="Enter post title…"
                     value="<?= e($input['title']) ?>" required />
            </div>
            <div class="fg">
              <label class="fl">Slug</label>
              <input type="text" name="slug" id="slug" class="fc"
                     placeholder="auto-generated-from-title"
                     value="<?= e($input['slug']) ?>" />
              <div class="form-hint">Leave blank to auto-generate from title. URL: <code><?= SITE_URL ?>/post/<em>slug</em></code></div>
            </div>
            <div class="fg">
              <label class="fl">Excerpt</label>
              <textarea name="excerpt" class="fc" rows="3"
                        placeholder="Short summary shown on listing pages…"><?= e($input['excerpt']) ?></textarea>
            </div>
          </div>
        </div>

        <!-- TinyMCE Editor -->
        <div class="card">
          <div class="card-header"><div class="card-title">Content *</div></div>
          <div class="card-body">
            <textarea name="body" id="body"><?= e($input['body']) ?></textarea>
          </div>
        </div>
      </div>

      <!-- Sidebar column -->
      <div style="display:flex;flex-direction:column;gap:1.5rem;">

        <!-- Publish settings -->
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
            <div style="display:flex;gap:0.75rem;margin-top:0.5rem;">
              <button type="submit" class="btn-submit" style="flex:1;">Save Post</button>
            </div>
            <a class="btn-cancel" href="<?= ADMIN_URL ?>/posts/index.php"
               style="display:block;text-align:center;margin-top:0.6rem;">Cancel</a>
          </div>
        </div>

        <!-- Category -->
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
            <div class="form-hint" style="margin-top:0.5rem;">
              <a href="<?= ADMIN_URL ?>/categories/create.php" style="color:var(--teal);">+ Add new category</a>
            </div>
          </div>
        </div>

        <!-- Featured Image -->
        <div class="card">
          <div class="card-header"><div class="card-title">Featured Image</div></div>
          <div class="card-body">
            <input type="file" name="featured_image" id="featured_image" class="fc"
                   accept="image/jpeg,image/png,image/webp,image/gif"
                   onchange="previewImage(this)" />
            <div class="form-hint">JPEG, PNG, WebP, GIF — max 5 MB</div>
            <img id="img-preview" class="file-preview" src="" style="display:none;" />
          </div>
        </div>

      </div>
    </div><!-- /grid -->
  </form>
</div>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/<?= TINYMCE_API_KEY ?>/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '#body',
  height: 520,
  skin: 'oxide-dark',
  content_css: 'dark',
  plugins: [
    'advlist','autolink','lists','link','image','charmap','preview',
    'searchreplace','fullscreen','insertdatetime','media','table',
    'codesample','emoticons','wordcount'
  ],
  toolbar: [
    'undo redo | blocks | bold italic underline strikethrough',
    'forecolor backcolor | alignleft aligncenter alignright alignjustify',
    'bullist numlist outdent indent | link image media | codesample | fullscreen'
  ].join(' | '),
  codesample_languages: [
    {text:'HTML/XML', value:'markup'},
    {text:'JavaScript', value:'javascript'},
    {text:'TypeScript', value:'typescript'},
    {text:'CSS', value:'css'},
    {text:'PHP', value:'php'},
    {text:'Python', value:'python'},
    {text:'Bash/Shell', value:'bash'},
    {text:'SQL', value:'sql'},
    {text:'JSON', value:'json'},
    {text:'Docker', value:'docker'},
  ],
  codesample_global_prismjs: true,
  promotion: false,
  branding: false,
  menubar: 'file edit view insert format tools table',
  content_style: `
    body { font-family: 'Segoe UI', sans-serif; font-size: 16px; color: #cdd6f4; background: #1e1e2e; line-height: 1.8; padding: 1rem; }
    pre[class*=language-] { background: #0d1117; border-radius: 8px; font-size: 0.88rem; }
  `,
});

// Auto-generate slug from title
document.getElementById('title').addEventListener('input', function() {
  const slugEl = document.getElementById('slug');
  if (!slugEl._userEdited) {
    slugEl.value = this.value
      .toLowerCase()
      .trim()
      .replace(/[^a-z0-9\s-]/g, '')
      .replace(/[\s-]+/g, '-')
      .replace(/^-+|-+$/g, '');
  }
});
document.getElementById('slug').addEventListener('input', function() {
  this._userEdited = this.value.length > 0;
});

// Image preview
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
