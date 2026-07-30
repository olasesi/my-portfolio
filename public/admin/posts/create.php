<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../includes/db.php';
require_once __DIR__ . '/../../../includes/auth.php';
require_once __DIR__ . '/../../../includes/helpers.php';
require_once __DIR__ . '/../layout.php';

require_login();
$pdo = db();

$errors = [];
$input  = ['title'=>'','slug'=>'','excerpt'=>'','body'=>'','category_id'=>'','status'=>'draft','meta_title'=>'','meta_description'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $input['title']            = trim($_POST['title']            ?? '');
    $input['slug']             = trim($_POST['slug']             ?? '');
    $input['excerpt']          = trim($_POST['excerpt']          ?? '');
    $input['body']             = $_POST['body']                  ?? '';
    $input['category_id']      = (int)($_POST['category_id'] ?? 0) ?: null;
    $input['status']           = $_POST['status'] === 'published' ? 'published' : 'draft';
    $input['meta_title']       = trim($_POST['meta_title']       ?? '');
    $input['meta_description'] = trim($_POST['meta_description'] ?? '');
    $tag_ids                   = array_map('intval', $_POST['tags'] ?? []);

    if (!$input['title'])  $errors[] = 'Title is required.';
    if (!$input['body'])   $errors[] = 'Post body is required.';
    if (!$input['slug'])   $input['slug'] = make_slug($input['title']);

    $input['slug'] = unique_slug($input['slug'], 'posts');

    $featured_image = null;
    try {
        $featured_image = handle_upload('featured_image');
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }

    if (!$errors) {
        $st = $pdo->prepare("
            INSERT INTO posts (admin_id, category_id, title, slug, excerpt, body, featured_image, status, meta_title, meta_description)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
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
            $input['meta_title'] ?: $input['title'],
            $input['meta_description'] ?: $input['excerpt'],
        ]);
        $postId = $pdo->lastInsertId();

        // Attach tags
        if ($tag_ids) {
            $ptSt = $pdo->prepare('INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)');
            foreach ($tag_ids as $tagId) {
                $ptSt->execute([$postId, $tagId]);
            }
        }

        flash('success', 'Post created successfully.');
        redirect(ADMIN_URL . '/posts/index.php');
    }
}

$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
$allTags    = $pdo->query("SELECT * FROM tags ORDER BY name")->fetchAll();

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
              <div class="form-hint">Leave blank to auto-generate. URL: <code><?= SITE_URL ?>/post/<em>slug</em></code></div>
            </div>
            <div class="fg">
              <label class="fl">Excerpt</label>
              <textarea name="excerpt" class="fc" rows="3"
                        placeholder="Short summary shown on listing pages…"><?= e($input['excerpt']) ?></textarea>
            </div>
          </div>
        </div>

        <!-- TinyMCE Editor -->
        <div class="card" style="margin-bottom:1.5rem;">
          <div class="card-header"><div class="card-title">Content *</div></div>
          <div class="card-body">
            <textarea name="body" id="body"><?= e($input['body']) ?></textarea>
          </div>
        </div>

        <!-- SEO -->
        <div class="card">
          <div class="card-header"><div class="card-title">SEO Settings</div></div>
          <div class="card-body">
            <div class="fg">
              <label class="fl">Meta Title</label>
              <input type="text" name="meta_title" class="fc" placeholder="Leave blank to use post title"
                     value="<?= e($input['meta_title']) ?>" />
              <div class="form-hint">Recommended: 50-60 characters. Used for search engine results.</div>
            </div>
            <div class="fg">
              <label class="fl">Meta Description</label>
              <textarea name="meta_description" class="fc" rows="3"
                        placeholder="Leave blank to use excerpt…"><?= e($input['meta_description']) ?></textarea>
              <div class="form-hint">Recommended: 150-160 characters. Shown below the title in search results.</div>
            </div>
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

        <!-- Tags -->
        <div class="card">
          <div class="card-header"><div class="card-title">Tags</div></div>
          <div class="card-body">
            <?php if ($allTags): ?>
              <div style="display:flex;flex-wrap:wrap;gap:0.5rem;max-height:180px;overflow-y:auto;">
                <?php foreach ($allTags as $tag): ?>
                  <label style="display:inline-flex;align-items:center;gap:0.3rem;padding:0.3rem 0.65rem;border-radius:100px;border:1px solid var(--borderl);font-size:0.75rem;color:var(--slatel);cursor:pointer;transition:all 0.2s;background:rgba(255,255,255,0.03);">
                    <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>" style="accent-color:var(--teal);width:14px;height:14px;" />
                    <?= e($tag['name']) ?>
                  </label>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <div class="form-hint">No tags created yet.</div>
            <?php endif; ?>
            <div class="form-hint" style="margin-top:0.5rem;">
              <a href="<?= ADMIN_URL ?>/tags/index.php" style="color:var(--teal);">+ Manage tags</a>
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

<!-- TinyMCE 8 -->
<script src="https://cdn.tiny.cloud/1/6z7qm82fwc83gmvflic3a05avjor8k6ve06k1ynqjs2r6aoy/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
tinymce.init({
  selector: '#body',
  height: 520,
  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | codesample | fullscreen',
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
  promotion: false,
  branding: false,
  content_style: `
    body { font-family: 'Segoe UI', sans-serif; font-size: 16px; color: #cdd6f4; background: #1e1e2e; line-height: 1.8; padding: 1rem; }
    pre[class*=language-] { background: #0d1117; border-radius: 8px; font-size: 0.88rem; }
  `,
});

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
