<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$slug = trim($_GET['slug'] ?? '');
if (!$slug) {
    header('Location: ' . SITE_URL . '/blog');
    exit;
}

$pdo = db();

$st = $pdo->prepare("
    SELECT p.*, c.name AS cat_name, c.slug AS cat_slug, a.name AS author_name
    FROM posts p
    LEFT JOIN categories c ON c.id = p.category_id
    LEFT JOIN admins a ON a.id = p.admin_id
    WHERE p.slug = ? AND p.status = 'published'
    LIMIT 1
");
$st->execute([$slug]);
$post = $st->fetch();

if (!$post) {
    header('Location: ' . SITE_URL . '/blog');
    exit;
}

// Increment view count
$pdo->prepare('UPDATE posts SET views = views + 1 WHERE id = ?')->execute([$post['id']]);

// Get tags
$tagSt = $pdo->prepare("
    SELECT t.name, t.slug
    FROM tags t
    INNER JOIN post_tags pt ON pt.tag_id = t.id
    WHERE pt.post_id = ?
    ORDER BY t.name
");
$tagSt->execute([$post['id']]);
$tags = $tagSt->fetchAll();

// Get related posts (same category, excluding current)
$relatedSt = $pdo->prepare("
    SELECT p.id, p.title, p.slug, p.excerpt, p.featured_image, p.created_at, c.name AS cat_name
    FROM posts p
    LEFT JOIN categories c ON c.id = p.category_id
    WHERE p.category_id = ? AND p.id != ? AND p.status = 'published'
    ORDER BY p.created_at DESC
    LIMIT 3
");
$relatedSt->execute([$post['category_id'], $post['id']]);
$related = $relatedSt->fetchAll();

// SEO
$pageTitle = $post['meta_title'] ?: $post['title'];
$pageDesc  = $post['meta_description'] ?: truncate(strip_tags($post['body']), 30);
$pageUrl   = SITE_URL . '/post/' . $post['slug'];
$ogImage   = $post['og_image'] ?: ($post['featured_image'] ? UPLOAD_URL . '/' . $post['featured_image'] : '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($pageTitle) ?> — Ahmed Olusesi</title>
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>" />
  <link rel="canonical" href="<?= $pageUrl ?>" />

  <!-- Open Graph -->
  <meta property="og:type" content="article" />
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($pageDesc) ?>" />
  <meta property="og:url" content="<?= $pageUrl ?>" />
  <?php if ($ogImage): ?>
    <meta property="og:image" content="<?= $ogImage ?>" />
  <?php endif; ?>

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($pageDesc) ?>" />
  <?php if ($ogImage): ?>
    <meta name="twitter:image" content="<?= $ogImage ?>" />
  <?php endif; ?>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300&family=Playfair+Display:wght@700;800&display=swap" />
  <link rel="stylesheet" href="<?= SITE_URL ?>/assets/styles/style.css" />
  <link rel="stylesheet" href="<?= SITE_URL ?>/assets/styles/blog.css" />

  <!-- Prism.js for code syntax highlighting -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.css" />

  <style>
    .share-bar { display: flex; gap: 0.6rem; align-items: center; flex-wrap: wrap; }
    .share-label { font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--slate); }
    .share-btn {
      display: inline-flex; align-items: center; gap: 0.4rem;
      padding: 0.45rem 0.9rem; border-radius: 7px; font-size: 0.78rem; font-weight: 600;
      text-decoration: none; transition: all 0.2s; border: 1px solid var(--borderl);
      color: var(--slatel);
    }
    .share-btn:hover { border-color: var(--teal); color: var(--teal); background: rgba(0,201,174,0.06); }
    .share-btn.tw { border-color: rgba(29,155,240,0.3); color: #1d9bf0; }
    .share-btn.tw:hover { background: rgba(29,155,240,0.1); border-color: rgba(29,155,240,0.5); }
    .share-btn.fb { border-color: rgba(24,119,242,0.3); color: #1877f2; }
    .share-btn.fb:hover { background: rgba(24,119,242,0.1); border-color: rgba(24,119,242,0.5); }
    .share-btn.li { border-color: rgba(10,102,194,0.3); color: #0a66c2; }
    .share-btn.li:hover { background: rgba(10,102,194,0.1); border-color: rgba(10,102,194,0.5); }
    .share-btn.wa { border-color: rgba(37,211,102,0.3); color: #25d366; }
    .share-btn.wa:hover { background: rgba(37,211,102,0.1); border-color: rgba(37,211,102,0.5); }
    .share-btn.cp { border-color: rgba(0,201,174,0.3); color: var(--teal); }
    .share-btn.cp:hover { background: rgba(0,201,174,0.1); }
    .tag-pill {
      display: inline-flex; align-items: center;
      padding: 0.2rem 0.65rem; border-radius: 100px; font-size: 0.7rem; font-weight: 600;
      border: 1px solid rgba(0,201,174,0.25); color: var(--teal);
      background: rgba(0,201,174,0.08); text-decoration: none; transition: all 0.2s;
    }
    .tag-pill:hover { background: rgba(0,201,174,0.15); }
    .post-tags { display: flex; gap: 0.4rem; flex-wrap: wrap; margin-top: 1rem; }

    /* Better code block styling */
    .post-content pre {
      background: #0d1117 !important;
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 10px;
      padding: 1.25rem;
      overflow-x: auto;
      margin: 1.75rem 0;
      position: relative;
    }
    .post-content pre code {
      font-family: 'Fira Code', 'Cascadia Code', 'JetBrains Mono', monospace;
      font-size: 0.875rem;
      line-height: 1.7;
      color: #c9d1d9;
    }
    .copy-code-btn {
      position: absolute; top: 0.5rem; right: 0.5rem;
      background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);
      border-radius: 6px; padding: 0.3rem 0.6rem; font-size: 0.7rem;
      color: var(--slate); cursor: pointer; transition: all 0.2s; font-weight: 600;
    }
    .copy-code-btn:hover { background: var(--teal); color: var(--navy); border-color: var(--teal); }

    @media (max-width: 600px) {
      .share-btn span.share-text { display: none; }
    }
  </style>
</head>
<body>

  <?php include __DIR__ . '/partials/nav.php'; ?>

  <div class="page-wrap">
    <article class="single-post">
      <div class="container-narrow">

        <!-- Breadcrumb -->
        <a href="<?= SITE_URL ?>/blog" class="breadcrumb-link">← Back to Blog</a>

        <!-- Header -->
        <div class="post-header">
          <div class="post-meta" style="margin-top:1.5rem;">
            <?php if ($post['cat_name']): ?>
              <span class="post-cat"><?= e($post['cat_name']) ?></span>
            <?php endif; ?>
            <span class="post-date"><?= fmt_date($post['created_at']) ?></span>
            <span class="post-read"><?= reading_time($post['body']) ?></span>
          </div>
          <h1 class="post-headline"><?= e($post['title']) ?></h1>

          <!-- Byline -->
          <div class="post-byline">
            <div class="byline-avatar">AO</div>
            <div>
              <div class="byline-name"><?= e($post['author_name'] ?? 'Ahmed Olusesi') ?></div>
              <div class="byline-meta"><?= fmt_date($post['created_at'], 'F j, Y') ?></div>
            </div>
          </div>
        </div>

        <!-- Featured Image -->
        <?php if ($post['featured_image']): ?>
          <div class="post-featured-img">
            <img src="<?= UPLOAD_URL ?>/<?= e($post['featured_image']) ?>" alt="<?= e($post['title']) ?>" />
          </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="post-content">
          <?= $post['body'] ?>
        </div>

        <!-- Tags -->
        <?php if ($tags): ?>
          <div class="post-tags">
            <?php foreach ($tags as $tag): ?>
              <a href="<?= SITE_URL ?>/blog?tag=<?= e($tag['slug']) ?>" class="tag-pill"><?= e($tag['name']) ?></a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <!-- Share -->
        <div class="share-bar" style="margin-top:2rem;">
          <span class="share-label">Share:</span>
          <a class="share-btn tw" href="https://twitter.com/intent/tweet?url=<?= urlencode($pageUrl) ?>&text=<?= urlencode($post['title']) ?>" target="_blank" rel="noopener">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            <span class="share-text">Tweet</span>
          </a>
          <a class="share-btn fb" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($pageUrl) ?>" target="_blank" rel="noopener">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            <span class="share-text">Share</span>
          </a>
          <a class="share-btn li" href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode($pageUrl) ?>" target="_blank" rel="noopener">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            <span class="share-text">LinkedIn</span>
          </a>
          <a class="share-btn wa" href="https://wa.me/?text=<?= urlencode($post['title'] . ' ' . $pageUrl) ?>" target="_blank" rel="noopener">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            <span class="share-text">WhatsApp</span>
          </a>
          <button class="share-btn cp" onclick="copyLink(this)" data-url="<?= $pageUrl ?>">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
            <span class="share-text">Copy Link</span>
          </button>
        </div>

        <!-- Post Footer -->
        <div class="post-foot">
          <a href="<?= SITE_URL ?>/blog" class="back-link">← Back to Blog</a>
          <?php if ($post['cat_name']): ?>
            <span class="badge-cat">Filed under <a href="<?= SITE_URL ?>/blog?cat=<?= e($post['cat_slug']) ?>"><?= e($post['cat_name']) ?></a></span>
          <?php endif; ?>
        </div>

      </div>
    </article>

    <!-- Related Posts -->
    <?php if ($related): ?>
      <section class="related-posts">
        <div class="container">
          <div class="eyebrow">Related Articles</div>
          <div class="related-grid">
            <?php foreach ($related as $r): ?>
              <a href="<?= SITE_URL ?>/post/<?= e($r['slug']) ?>" class="related-card">
                <?php if ($r['featured_image']): ?>
                  <img src="<?= UPLOAD_URL ?>/<?= e($r['featured_image']) ?>" alt="<?= e($r['title']) ?>" />
                <?php else: ?>
                  <div class="related-placeholder"><?= strtoupper(substr($r['title'], 0, 4)) ?></div>
                <?php endif; ?>
                <div class="related-body">
                  <div class="post-meta">
                    <?php if ($r['cat_name']): ?>
                      <span class="post-cat"><?= e($r['cat_name']) ?></span>
                    <?php endif; ?>
                    <span class="post-date"><?= fmt_date($r['created_at']) ?></span>
                  </div>
                  <div class="related-title"><?= e($r['title']) ?></div>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

  </div>

  <?php include __DIR__ . '/partials/footer.php'; ?>

  <script src="<?= SITE_URL ?>/assets/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-typescript.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-python.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-bash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-sql.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-json.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-css.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-docker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.js"></script>
  <script>
    // Add copy buttons to all code blocks
    document.querySelectorAll('.post-content pre').forEach(pre => {
      const btn = document.createElement('button');
      btn.className = 'copy-code-btn';
      btn.textContent = 'Copy';
      btn.onclick = function() {
        const code = pre.querySelector('code');
        navigator.clipboard.writeText(code.textContent).then(() => {
          btn.textContent = 'Copied!';
          setTimeout(() => { btn.textContent = 'Copy'; }, 2000);
        });
      };
      pre.style.position = 'relative';
      pre.appendChild(btn);
    });

    function copyLink(btn) {
      navigator.clipboard.writeText(btn.dataset.url).then(() => {
        const text = btn.querySelector('.share-text');
        text.textContent = 'Copied!';
        setTimeout(() => { text.textContent = 'Copy Link'; }, 2000);
      });
    }
  </script>

</body>
</html>
