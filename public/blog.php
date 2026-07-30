<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$pdo = db();

// Get URL params
$search = trim($_GET['q'] ?? '');
$catFilter = trim($_GET['cat'] ?? '');
$tagFilter = trim($_GET['tag'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 9;

// Build query
$where = ["p.status = 'published'"];
$params = [];

if ($search) {
    $where[] = "(p.title LIKE ? OR p.excerpt LIKE ? OR p.body LIKE ?)";
    $like = "%{$search}%";
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
}
if ($catFilter) {
    $where[] = "c.slug = ?";
    $params[] = $catFilter;
}
if ($tagFilter) {
    $where[] = "EXISTS (SELECT 1 FROM post_tags pt2 INNER JOIN tags t2 ON t2.id = pt2.tag_id WHERE pt2.post_id = p.id AND t2.slug = ?)";
    $params[] = $tagFilter;
}

$whereSQL = implode(' AND ', $where);

// Count total
$countSql = "SELECT COUNT(*) FROM posts p LEFT JOIN categories c ON c.id = p.category_id WHERE {$whereSQL}";
$countSt = $pdo->prepare($countSql);
$countSt->execute($params);
$total = $countSt->fetchColumn();
$pagination = paginate($total, $perPage, $page);

// Fetch posts
$sql = "
    SELECT p.id, p.title, p.slug, p.excerpt, p.featured_image, p.created_at,
           c.name AS cat_name, c.slug AS cat_slug,
           a.name AS author_name
    FROM posts p
    LEFT JOIN categories c ON c.id = p.category_id
    LEFT JOIN admins a ON a.id = p.admin_id
    WHERE {$whereSQL}
    ORDER BY p.created_at DESC
    LIMIT ? OFFSET ?
";
$params[] = $perPage;
$params[] = ($page - 1) * $perPage;
$postsSt = $pdo->prepare($sql);
$postsSt->execute($params);
$posts = $postsSt->fetchAll();

// Get featured post (first published with image)
$featSt = $pdo->prepare("
    SELECT p.id, p.title, p.slug, p.excerpt, p.featured_image, p.created_at,
           c.name AS cat_name, c.slug AS cat_slug
    FROM posts p
    LEFT JOIN categories c ON c.id = p.category_id
    WHERE p.status = 'published'
    ORDER BY p.created_at DESC
    LIMIT 1
");
$featSt->execute();
$featured = $featSt->fetch();

// Get all categories for sidebar/filter
$cats = $pdo->query("
    SELECT c.*, COUNT(p.id) AS post_count
    FROM categories c
    LEFT JOIN posts p ON p.category_id = c.id AND p.status = 'published'
    GROUP BY c.id
    ORDER BY c.name
")->fetchAll();

// Get all tags for filter
$allTags = $pdo->query("
    SELECT t.*, COUNT(pt.post_id) AS post_count
    FROM tags t
    INNER JOIN post_tags pt ON pt.tag_id = t.id
    INNER JOIN posts p ON p.id = pt.post_id AND p.status = 'published'
    GROUP BY t.id
    HAVING post_count > 0
    ORDER BY t.name
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="google-site-verification" content="C6yGsC9a7EQRTRrT_WX92ZLntEpQ7_XDZ99Y9klBxMI" />
  <meta content="Software Developer, Full Stack Developer, Web Developer, React Developer, Node.js, Python, AWS, DevOps, PHP, Javascript, Vue, Laravel, Node express, Django, Nextjs" name="keywords">
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-FD24VJ5LY0"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-FD24VJ5LY0');
  </script>
  <title>Insights — Ahmed Olusesi</title>
  <meta name="description" content="Engineering insights on React, Laravel, Node.js, mobile development, Docker, and the practical craft of full-stack development by Ahmed Olusesi." />
  <link rel="stylesheet" href="./assets/styles/style.css" />
  <style>
    .blog-banner { padding: 5rem 0; border-bottom: 1px solid var(--border); }
    .blog-banner-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: end; }
    .search-box { position: relative; }
    .search-box svg { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--slate); pointer-events: none; }
    .search-input {
      width: 100%; padding: 0.75rem 1rem 0.75rem 2.75rem;
      background: var(--card-bg); border: 1px solid var(--border-light);
      border-radius: var(--radius); color: var(--white);
      font-family: var(--body); font-size: 0.875rem;
      outline: none; transition: border-color var(--transition);
    }
    .search-input:focus { border-color: var(--teal); background: rgba(255,255,255,0.04); }
    .search-input::placeholder { color: var(--slate); }
    .cat-row { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 1rem; }
    .cat-btn {
      font-size: 0.73rem; font-weight: 600; padding: 0.35rem 0.9rem; border-radius: 6px;
      border: 1px solid var(--border-light); background: transparent; color: var(--slate-light);
      cursor: pointer; transition: all var(--transition); text-decoration: none;
    }
    .cat-btn:hover { border-color: var(--teal); color: var(--teal); }
    .cat-btn.active { background: var(--teal); color: var(--navy); border-color: var(--teal); font-weight: 700; }
    .feat-post {
      display: grid; grid-template-columns: 1fr 1fr;
      min-height: 360px; border: 1px solid var(--border);
      border-radius: var(--radius-lg); overflow: hidden;
      transition: all var(--transition); margin-bottom: 2rem; text-decoration: none;
    }
    .feat-post:hover { border-color: var(--border-light); box-shadow: 0 24px 70px rgba(0,0,0,0.5); }
    .feat-thumb {
      background: linear-gradient(135deg,#07111F 0%,#0D2444 60%,#072236 100%);
      display: flex; align-items: center; justify-content: center;
      overflow: hidden;
    }
    .feat-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .feat-thumb-placeholder {
      font-family: var(--display); font-size: 5rem; font-weight: 800;
      color: rgba(0,201,174,0.25); letter-spacing: -0.05em;
    }
    .feat-body { background: var(--card-bg); padding: 3rem; display: flex; flex-direction: column; justify-content: center; border-left: 1px solid var(--border); }
    .feat-meta { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem; }
    .post-cat { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--teal); }
    .post-date { font-size: 0.75rem; color: var(--slate); }
    .feat-title { font-family: var(--display); font-size: 1.65rem; font-weight: 800; letter-spacing: -0.025em; line-height: 1.15; margin-bottom: 1rem; color: var(--white); }
    .feat-excerpt { font-size: 0.875rem; color: var(--slate-light); line-height: 1.8; margin-bottom: 1.75rem; }
    .read-link { font-size: 0.8rem; font-weight: 700; color: var(--teal); display: inline-flex; align-items: center; gap: 5px; transition: gap var(--transition); }
    .read-link:hover { gap: 10px; }
    .read-time-tag { font-size: 0.7rem; color: var(--slate); margin-top: 0.75rem; }
    .blog-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; }
    .blog-card {
      border-radius: var(--radius-lg); overflow: hidden; transition: all var(--transition);
      display: flex; flex-direction: column; border: 1px solid var(--border);
      text-decoration: none;
    }
    .blog-card:hover { transform: translateY(-5px); box-shadow: 0 24px 70px rgba(0,0,0,0.5); border-color: var(--border-light); }
    .blog-thumb {
      height: 160px; display: flex; align-items: center; justify-content: center;
      overflow: hidden; background: var(--navy-2);
    }
    .blog-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .blog-thumb-placeholder {
      font-family: var(--display); font-weight: 800; font-size: 2rem;
      letter-spacing: -0.04em; color: rgba(0,201,174,0.3);
    }
    .blog-body { padding: 1.5rem; flex: 1; background: var(--card-bg); }
    .blog-meta { display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.75rem; }
    .blog-title { font-size: 0.98rem; font-weight: 700; color: var(--white); line-height: 1.35; margin-bottom: 0.5rem; }
    .blog-excerpt { font-size: 0.8rem; color: var(--slate); line-height: 1.65; }
    .blog-footer-card { padding: 0.9rem 1.5rem; border-top: 1px solid var(--border); background: var(--card-bg); display: flex; justify-content: space-between; align-items: center; }
    .read-time { font-size: 0.7rem; color: var(--slate); }
    .newsletter-band {
      background: linear-gradient(135deg, var(--navy-2) 0%, var(--navy-3) 100%);
      border: 1px solid var(--border-light); border-radius: 20px;
      padding: 4rem; display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;
      position: relative; overflow: hidden;
    }
    .newsletter-band::before {
      content: ''; position: absolute; top: -60px; right: -60px;
      width: 200px; height: 200px; border-radius: 50%;
      background: radial-gradient(circle, rgba(0,201,174,0.08), transparent 70%);
    }
    .nl-title { font-family: var(--display); font-size: 1.8rem; font-weight: 800; letter-spacing: -0.025em; line-height: 1.2; color: var(--white); }
    .nl-sub { font-size: 0.875rem; color: var(--slate-light); line-height: 1.7; margin-top: 0.5rem; }
    .nl-form { display: flex; gap: 0.75rem; position: relative; z-index: 1; }
    .nl-input { flex: 1; padding: 0.8rem 1.2rem; background: var(--navy); border: 1px solid var(--border-light); border-radius: var(--radius); color: var(--white); font-family: var(--body); font-size: 0.875rem; outline: none; transition: border-color var(--transition); }
    .nl-input:focus { border-color: var(--teal); }
    .nl-input::placeholder { color: var(--slate); }
    .pagination { display: flex; gap: 0.4rem; align-items: center; margin-top: 2rem; justify-content: center; }
    .page-btn { padding: 0.45rem 0.85rem; border-radius: 7px; border: 1px solid var(--border-light); color: var(--slate-light); text-decoration: none; font-size: 0.82rem; transition: all 0.2s; }
    .page-btn:hover, .page-btn.active { background: var(--teal); color: var(--navy); border-color: var(--teal); font-weight: 700; }
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-state h3 { font-size: 1.1rem; color: var(--slate-light); margin-bottom: 0.5rem; }
    .empty-state p { font-size: 0.88rem; color: var(--slate); }
    @media (max-width: 960px) {
      .blog-banner-grid { grid-template-columns: 1fr; }
      .feat-post { grid-template-columns: 1fr; }
      .feat-thumb { height: 180px; }
      .feat-thumb .feat-placeholder-text { font-size: 3rem; }
      .blog-grid { grid-template-columns: 1fr 1fr; }
      .newsletter-band { grid-template-columns: 1fr; }
      .nl-form { flex-direction: column; }
    }
    @media (max-width: 600px) { .blog-grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>

  <?php include './partials/nav.php'; ?>

  <div class="page-wrap">

    <!-- BANNER -->
    <section class="blog-banner">
      <div class="container">
        <div class="blog-banner-grid">
          <div>
            <div class="eyebrow reveal">Engineering Insights</div>
            <h1 class="display-lg reveal reveal-d1">
              Thinking out<br />loud on <span class="teal">craft.</span>
            </h1>
            <p class="section-sub reveal reveal-d2" style="margin-top:1rem;">
              Practical deep-dives on React, Laravel, Node.js, mobile development,
              Docker, and the day-to-day decisions that separate good software from great software.
            </p>
          </div>
          <div class="reveal reveal-d2">
            <form class="search-box" method="GET" action="">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
              </svg>
              <input type="text" class="search-input" placeholder="Search articles..." name="q" value="<?= e($search) ?>" />
            </form>
            <div class="cat-row">
              <a href="<?= SITE_URL ?>/blog" class="cat-btn <?= !$catFilter && !$tagFilter ? 'active' : '' ?>">All</a>
              <?php foreach ($cats as $c): ?>
                <a href="<?= SITE_URL ?>/blog?cat=<?= e($c['slug']) ?>" class="cat-btn <?= $catFilter === $c['slug'] ? 'active' : '' ?>"><?= e($c['name']) ?></a>
              <?php endforeach; ?>
              <?php foreach ($allTags as $t): ?>
                <a href="<?= SITE_URL ?>/blog?tag=<?= e($t['slug']) ?>" class="cat-btn <?= $tagFilter === $t['slug'] ? 'active' : '' ?>"><?= e($t['name']) ?></a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURED + GRID -->
    <section class="section">
      <div class="container">

        <?php if ($featured && !$search && !$catFilter && !$tagFilter): ?>
          <div class="eyebrow reveal" style="margin-bottom:1.25rem;">Featured</div>
          <a href="<?= SITE_URL ?>/post/<?= e($featured['slug']) ?>" class="feat-post reveal reveal-d1">
            <div class="feat-thumb">
              <?php if ($featured['featured_image']): ?>
                <img src="<?= UPLOAD_URL ?>/<?= e($featured['featured_image']) ?>" alt="<?= e($featured['title']) ?>" />
              <?php else: ?>
                <div class="feat-thumb-placeholder feat-placeholder-text"><?= strtoupper(substr($featured['title'], 0, 6)) ?></div>
              <?php endif; ?>
            </div>
            <div class="feat-body">
              <div class="feat-meta">
                <?php if ($featured['cat_name']): ?>
                  <span class="post-cat"><?= e($featured['cat_name']) ?></span>
                <?php endif; ?>
                <span class="post-date"><?= fmt_date($featured['created_at']) ?></span>
              </div>
              <h2 class="feat-title"><?= e($featured['title']) ?></h2>
              <p class="feat-excerpt"><?= e($featured['excerpt'] ?: truncate(strip_tags($featured['body'] ?? ''), 30)) ?></p>
              <span class="read-link">Read Full Article →</span>
              <div class="read-time-tag"><?= reading_time($featured['body'] ?? '') ?></div>
            </div>
          </a>
        <?php endif; ?>

        <h2 class="display-sm reveal" style="margin-bottom:1.75rem;font-family:var(--display);font-size:1.3rem;font-weight:700;">
          <?= ($search || $catFilter || $tagFilter) ? 'Search Results' : 'All Articles' ?>
          <?php if ($total > 0): ?>
            <span style="font-weight:400;font-size:0.85rem;color:var(--slate);font-family:var(--body);">(<?= $total ?>)</span>
          <?php endif; ?>
        </h2>

        <?php if ($posts): ?>
          <div class="blog-grid" id="blogGrid">
            <?php foreach ($posts as $i => $p):
              $delay = $i % 3 === 1 ? ' reveal-d1' : ($i % 3 === 2 ? ' reveal-d2' : '');
              $gradientIndex = ($i % 6) + 1;
            ?>
              <a href="<?= SITE_URL ?>/post/<?= e($p['slug']) ?>" class="blog-card reveal<?= $delay ?>">
                <div class="blog-thumb">
                  <?php if ($p['featured_image']): ?>
                    <img src="<?= UPLOAD_URL ?>/<?= e($p['featured_image']) ?>" alt="<?= e($p['title']) ?>" />
                  <?php else: ?>
                    <div class="blog-thumb-placeholder"><?= strtoupper(substr($p['title'], 0, 4)) ?></div>
                  <?php endif; ?>
                </div>
                <div class="blog-body">
                  <div class="blog-meta">
                    <?php if ($p['cat_name']): ?>
                      <span class="post-cat"><?= e($p['cat_name']) ?></span>
                    <?php endif; ?>
                    <span class="post-date"><?= fmt_date($p['created_at']) ?></span>
                  </div>
                  <h3 class="blog-title"><?= e($p['title']) ?></h3>
                  <p class="blog-excerpt"><?= e(truncate($p['excerpt'] ?: strip_tags($p['body']), 20)) ?></p>
                </div>
                <div class="blog-footer-card">
                  <span class="read-time"><?= reading_time($p['body'] ?? '') ?></span>
                  <span class="read-link" style="font-size:0.75rem;">Read →</span>
                </div>
              </a>
            <?php endforeach; ?>
          </div>

          <?php if ($pagination['pages'] > 1): ?>
            <div class="pagination">
              <?php if ($pagination['prev']): ?>
                <a class="page-btn" href="?page=<?= $pagination['prev'] ?>&q=<?= e($search) ?>&cat=<?= e($catFilter) ?>&tag=<?= e($tagFilter) ?>">← Prev</a>
              <?php endif; ?>
              <?php for ($i = 1; $i <= $pagination['pages']; $i++): ?>
                <a class="page-btn <?= $i === $page ? 'active' : '' ?>" href="?page=<?= $i ?>&q=<?= e($search) ?>&cat=<?= e($catFilter) ?>&tag=<?= e($tagFilter) ?>"><?= $i ?></a>
              <?php endfor; ?>
              <?php if ($pagination['next']): ?>
                <a class="page-btn" href="?page=<?= $pagination['next'] ?>&q=<?= e($search) ?>&cat=<?= e($catFilter) ?>&tag=<?= e($tagFilter) ?>">Next →</a>
              <?php endif; ?>
            </div>
          <?php endif; ?>

        <?php else: ?>
          <div class="empty-state">
            <h3><?= $search ? 'No articles found' : 'No articles yet' ?></h3>
            <p><?= $search ? 'Try a different search term or browse all articles.' : 'Check back soon for new content.' ?></p>
            <?php if ($search || $catFilter || $tagFilter): ?>
              <a href="<?= SITE_URL ?>/blog" class="btn btn-ghost" style="margin-top:1rem;">View All Articles</a>
            <?php endif; ?>
          </div>
        <?php endif; ?>

      </div>
    </section>

    <!-- NEWSLETTER -->
    <section class="section-sm">
      <div class="container">
        <?php
        $nlSuccess = false;
        $nlError = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nl_email'])) {
            $nlEmail = filter_var(trim($_POST['nl_email'] ?? ''), FILTER_VALIDATE_EMAIL);
            if ($nlEmail) {
                $existing = $pdo->prepare("SELECT id FROM subscribers WHERE email = ?");
                $existing->execute([$nlEmail]);
                if (!$existing->fetch()) {
                    $pdo->prepare("INSERT INTO subscribers (email) VALUES (?)")->execute([$nlEmail]);
                }
                $nlSuccess = true;
            } else {
                $nlError = true;
            }
        }
        ?>
        <div class="newsletter-band reveal">
          <div>
            <div class="nl-title">
              Get it<br /><span class="teal">in your inbox</span>
            </div>
            <p class="nl-sub">
              Practical articles on full-stack development, mobile, and engineering craft.
              No filler — just useful content when there's something worth sharing.
            </p>
            <?php if ($nlSuccess): ?>
              <p style="color:var(--teal);font-size:0.88rem;margin-top:0.75rem;font-weight:600;">✓ You're subscribed! Watch your inbox.</p>
            <?php elseif ($nlError): ?>
              <p style="color:#FCA5A5;font-size:0.88rem;margin-top:0.75rem;">Please enter a valid email address.</p>
            <?php endif; ?>
          </div>
          <div class="nl-form">
            <form method="POST" style="display:flex;gap:0.75rem;width:100%;position:relative;z-index:1;">
              <input type="email" name="nl_email" class="nl-input" placeholder="your@email.com" required value="<?= e($_POST['nl_email'] ?? '') ?>" />
              <button type="submit" class="btn btn-primary">Subscribe →</button>
            </form>
          </div>
        </div>
      </div>
    </section>

  </div>

  <?php include './partials/footer.php'; ?>
  <script src="./assets/js/main.js"></script>

</body>
</html>
