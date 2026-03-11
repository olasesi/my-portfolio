<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="google-site-verification" content="C6yGsC9a7EQRTRrT_WX92ZLntEpQ7_XDZ99Y9klBxMI" />
  <meta content="Software Developer, Full Stack Developer, Web Developer, React Developer, Node.js, Python, AWS, DevOps, PHP, Javascript, Vue, Laravel, Node express, Django, Nextjs" name="keywords">
    <!-- Google tag (gtag.js) -->
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

    /* ─── BANNER ─── */
    .blog-banner { padding: 5rem 0; border-bottom: 1px solid var(--border); }
    .blog-banner-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: end; }

    /* ─── SEARCH ─── */
    .search-box { position: relative; }
    .search-box svg {
      position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
      color: var(--slate); pointer-events: none;
    }
    .search-input {
      width: 100%; padding: 0.75rem 1rem 0.75rem 2.75rem;
      background: var(--card-bg);
      border: 1px solid var(--border-light);
      border-radius: var(--radius); color: var(--white);
      font-family: var(--body); font-size: 0.875rem;
      outline: none; transition: border-color var(--transition);
    }
    .search-input:focus { border-color: var(--teal); background: rgba(255,255,255,0.04); }
    .search-input::placeholder { color: var(--slate); }

    /* ─── CATEGORY FILTER ─── */
    .cat-row { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 1rem; }
    .cat-btn {
      font-size: 0.73rem; font-weight: 600;
      padding: 0.35rem 0.9rem; border-radius: 6px;
      border: 1px solid var(--border-light);
      background: transparent; color: var(--slate-light);
      cursor: pointer; transition: all var(--transition);
    }
    .cat-btn:hover { border-color: var(--teal); color: var(--teal); }
    .cat-btn.active { background: var(--teal); color: var(--navy); border-color: var(--teal); font-weight: 700; }

    /* ─── FEATURED POST ─── */
    .feat-post {
      display: grid; grid-template-columns: 1fr 1fr;
      min-height: 360px; border: 1px solid var(--border);
      border-radius: var(--radius-lg); overflow: hidden;
      transition: all var(--transition); margin-bottom: 2rem;
    }
    .feat-post:hover { border-color: var(--border-light); box-shadow: 0 24px 70px rgba(0,0,0,0.5); }
    .feat-thumb {
      background: linear-gradient(135deg,#07111F 0%,#0D2444 60%,#072236 100%);
      display: flex; align-items: center; justify-content: center;
      font-family: var(--display); font-size: 5rem; font-weight: 800;
      color: rgba(0,201,174,0.25); letter-spacing: -0.05em;
    }
    .feat-body {
      background: var(--card-bg); padding: 3rem;
      display: flex; flex-direction: column; justify-content: center;
      border-left: 1px solid var(--border);
    }
    .feat-meta { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem; }
    .post-cat {
      font-size: 0.65rem; font-weight: 700; letter-spacing: 0.12em;
      text-transform: uppercase; color: var(--teal);
    }
    .post-date { font-size: 0.75rem; color: var(--slate); }
    .feat-title {
      font-family: var(--display); font-size: 1.65rem; font-weight: 800;
      letter-spacing: -0.025em; line-height: 1.15; margin-bottom: 1rem;
      color: var(--white);
    }
    .feat-excerpt {
      font-size: 0.875rem; color: var(--slate-light);
      line-height: 1.8; margin-bottom: 1.75rem;
    }
    .read-link {
      font-size: 0.8rem; font-weight: 700; color: var(--teal);
      text-decoration: none; display: inline-flex; align-items: center; gap: 5px;
      transition: gap var(--transition);
    }
    .read-link:hover { gap: 10px; }
    .read-time-tag { font-size: 0.7rem; color: var(--slate); margin-top: 0.75rem; }

    /* ─── BLOG GRID ─── */
    .blog-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; }
    .blog-card {
      border-radius: var(--radius-lg); overflow: hidden;
      transition: all var(--transition); display: flex; flex-direction: column;
      border: 1px solid var(--border);
    }
    .blog-card:hover { transform: translateY(-5px); box-shadow: 0 24px 70px rgba(0,0,0,0.5); border-color: var(--border-light); }
    .blog-card.hide { display: none; }
    .blog-thumb {
      height: 140px; display: flex; align-items: center; justify-content: center;
      font-family: var(--display); font-weight: 800; font-size: 2rem;
      letter-spacing: -0.04em;
    }
    .bt-1 { background: linear-gradient(135deg,#071828,#0A2830); color: rgba(0,180,200,0.4); }
    .bt-2 { background: linear-gradient(135deg,#0F0818,#1A1038); color: rgba(140,80,220,0.4); }
    .bt-3 { background: linear-gradient(135deg,#16080A,#260D10); color: rgba(220,60,80,0.4); }
    .bt-4 { background: linear-gradient(135deg,#07111F,#0D2040); color: rgba(0,120,220,0.4); }
    .bt-5 { background: linear-gradient(135deg,#101408,#182010); color: rgba(80,200,80,0.4); }
    .bt-6 { background: linear-gradient(135deg,#181208,#281C0A); color: rgba(220,160,0,0.4); }
    .blog-body {
      padding: 1.5rem; flex: 1;
      background: var(--card-bg);
    }
    .blog-meta { display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.75rem; }
    .blog-title {
      font-size: 0.98rem; font-weight: 700;
      color: var(--white); line-height: 1.35; margin-bottom: 0.5rem;
    }
    .blog-excerpt { font-size: 0.8rem; color: var(--slate); line-height: 1.65; }
    .blog-footer {
      padding: 0.9rem 1.5rem; border-top: 1px solid var(--border);
      background: var(--card-bg);
      display: flex; justify-content: space-between; align-items: center;
    }
    .read-time { font-size: 0.7rem; color: var(--slate); }

    /* ─── NEWSLETTER ─── */
    .newsletter-band {
      background: linear-gradient(135deg, var(--navy-2) 0%, var(--navy-3) 100%);
      border: 1px solid var(--border-light); border-radius: 20px;
      padding: 4rem; display: grid;
      grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;
      position: relative; overflow: hidden;
    }
    .newsletter-band::before {
      content: ''; position: absolute; top: -60px; right: -60px;
      width: 200px; height: 200px; border-radius: 50%;
      background: radial-gradient(circle, rgba(0,201,174,0.08), transparent 70%);
    }
    .nl-title {
      font-family: var(--display); font-size: 1.8rem; font-weight: 800;
      letter-spacing: -0.025em; line-height: 1.2; color: var(--white);
    }
    .nl-sub { font-size: 0.875rem; color: var(--slate-light); line-height: 1.7; margin-top: 0.5rem; }
    .nl-form { display: flex; gap: 0.75rem; position: relative; z-index: 1; }
    .nl-input {
      flex: 1; padding: 0.8rem 1.2rem;
      background: var(--navy); border: 1px solid var(--border-light);
      border-radius: var(--radius); color: var(--white);
      font-family: var(--body); font-size: 0.875rem;
      outline: none; transition: border-color var(--transition);
    }
    .nl-input:focus { border-color: var(--teal); }
    .nl-input::placeholder { color: var(--slate); }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 960px) {
      .blog-banner-grid { grid-template-columns: 1fr; }
      .feat-post { grid-template-columns: 1fr; }
      .feat-thumb { height: 180px; font-size: 3rem; }
      .blog-grid { grid-template-columns: 1fr 1fr; }
      .newsletter-band { grid-template-columns: 1fr; }
      .nl-form { flex-direction: column; }
    }
    @media (max-width: 600px) { .blog-grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>

  <?php include './includes/nav.php'; ?>

  <div class="page-wrap">

    <!-- ════════════════════════════════
         BANNER
    ═════════════════════════════════ -->
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
            <div class="search-box">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
              </svg>
              <input type="text" class="search-input" placeholder="Search articles..." id="searchInput" />
            </div>
            <div class="cat-row">
              <button class="cat-btn active" data-cat="all">All</button>
              <button class="cat-btn" data-cat="react">React</button>
              <button class="cat-btn" data-cat="backend">Backend</button>
              <button class="cat-btn" data-cat="mobile">Mobile</button>
              <button class="cat-btn" data-cat="devops">DevOps</button>
              <button class="cat-btn" data-cat="career">Career</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ════════════════════════════════
         FEATURED + GRID
    ═════════════════════════════════ -->
    <section class="section">
      <div class="container">

        <div class="eyebrow reveal" style="margin-bottom:1.25rem;">Featured</div>
        <div class="feat-post reveal reveal-d1" data-cat="backend">
          <div class="feat-thumb">API</div>
          <div class="feat-body">
            <div class="feat-meta">
              <span class="post-cat">Backend</span>
              <span class="post-date">Feb 14, 2026</span>
            </div>
            <h2 class="feat-title">The API Design Decisions That Haunt You Later</h2>
            <p class="feat-excerpt">
              After building dozens of REST and GraphQL APIs, I've learned that the decisions
              you make at 2am on day one are the ones you're still explaining to new developers
              two years later. Here's what I'd do differently — and what I always do now.
            </p>
            <a href="#" class="read-link">Read Full Article →</a>
            <div class="read-time-tag">11 min read</div>
          </div>
        </div>

        <h2 class="display-sm reveal" style="margin-bottom:1.75rem;font-family:var(--display);font-size:1.3rem;font-weight:700;">All Articles</h2>
        <div class="blog-grid" id="blogGrid">

          <?php
          $posts = [
            [
              'slug'    => 'react-state',
              'thumb'   => 'bt-1',
              'abbr'    => 'STATE',
              'cat'     => 'react',
              'cat_label' => 'React',
              'date'    => 'Jan 28, 2026',
              'title'   => 'React State Management in 2026: Context, Zustand, or Jotai?',
              'excerpt' => 'A practical breakdown of when global state management is actually necessary — and which tool fits which situation without overengineering.',
              'mins'    => 9,
            ],
            [
              'slug'    => 'laravel-auth',
              'thumb'   => 'bt-2',
              'abbr'    => 'AUTH',
              'cat'     => 'backend',
              'cat_label' => 'Backend',
              'date'    => 'Jan 15, 2026',
              'title'   => 'Laravel Sanctum vs Passport: Picking the Right Auth for Your API',
              'excerpt' => 'The wrong choice here creates real security risks and awkward token flows. My decision framework after using both in production.',
              'mins'    => 8,
            ],
            [
              'slug'    => 'expo-workflow',
              'thumb'   => 'bt-3',
              'abbr'    => 'EXPO',
              'cat'     => 'mobile',
              'cat_label' => 'Mobile',
              'date'    => 'Jan 5, 2026',
              'title'   => 'The Expo Workflow That Actually Gets Apps Shipped',
              'excerpt' => 'EAS Build, OTA updates, and the config setup that lets me maintain two store releases without losing my mind.',
              'mins'    => 12,
            ],
            [
              'slug'    => 'docker-laravel',
              'thumb'   => 'bt-4',
              'abbr'    => 'DOCK',
              'cat'     => 'devops',
              'cat_label' => 'DevOps',
              'date'    => 'Dec 18, 2025',
              'title'   => 'Dockerising a Laravel + React App the Right Way',
              'excerpt' => 'Multi-stage builds, environment parity, and the nginx + php-fpm setup that makes your local environment match production exactly.',
              'mins'    => 14,
            ],
            [
              'slug'    => 'mysql-performance',
              'thumb'   => 'bt-5',
              'abbr'    => 'SQL',
              'cat'     => 'backend',
              'cat_label' => 'Backend',
              'date'    => 'Dec 5, 2025',
              'title'   => 'Fixing MySQL N+1 Queries in Laravel Before They Kill Your App',
              'excerpt' => 'The N+1 problem is sneaky. I didn\'t notice it until the app went under load — here\'s how to catch it early and fix it cleanly with eager loading.',
              'mins'    => 7,
            ],
            [
              'slug'    => 'fullstack-mindset',
              'thumb'   => 'bt-6',
              'abbr'    => 'FULL',
              'cat'     => 'career',
              'cat_label' => 'Career',
              'date'    => 'Nov 22, 2025',
              'title'   => 'What Nobody Tells You About Going Full-Stack',
              'excerpt' => 'Being "full-stack" isn\'t a stack of skills — it\'s a different mental model for product ownership. The shift that changed how I work.',
              'mins'    => 6,
            ],
          ];
          foreach ($posts as $i => $p):
            $delay = $i % 3 === 1 ? ' reveal-d1' : ($i % 3 === 2 ? ' reveal-d2' : '');
          ?>
          <div class="blog-card reveal<?= $delay ?>" data-cat="<?= $p['cat'] ?>">
            <div class="blog-thumb <?= $p['thumb'] ?>"><?= $p['abbr'] ?></div>
            <div class="blog-body">
              <div class="blog-meta">
                <span class="post-cat"><?= $p['cat_label'] ?></span>
                <span class="post-date"><?= $p['date'] ?></span>
              </div>
              <h3 class="blog-title"><?= htmlspecialchars($p['title']) ?></h3>
              <p class="blog-excerpt"><?= htmlspecialchars($p['excerpt']) ?></p>
            </div>
            <div class="blog-footer">
              <span class="read-time"><?= $p['mins'] ?> min read</span>
              <a href="#" class="read-link" style="font-size:0.75rem;">Read →</a>
            </div>
          </div>
          <?php endforeach; ?>

        </div>
      </div>
    </section>

    <!-- ════════════════════════════════
         NEWSLETTER
    ═════════════════════════════════ -->
    <section class="section-sm">
      <div class="container">
        <div class="newsletter-band reveal">
          <div>
            <div class="nl-title">
              Get it<br /><span class="teal">in your inbox</span>
            </div>
            <p class="nl-sub">
              Practical articles on full-stack development, mobile, and engineering craft.
              No filler — just useful content when there's something worth sharing.
            </p>
          </div>
          <div class="nl-form">
            <input type="email" class="nl-input" placeholder="your@email.com" />
            <button class="btn btn-primary">Subscribe →</button>
          </div>
        </div>
      </div>
    </section>

  </div><!-- /page-wrap -->

  <?php include './includes/footer.php'; ?>

  <script src="./assets/js/main.js"></script>
  <script>
    // Category filter
    document.querySelectorAll('.cat-btn').forEach(b => {
      b.addEventListener('click', () => {
        document.querySelectorAll('.cat-btn').forEach(x => x.classList.remove('active'));
        b.classList.add('active');
        filter();
      });
    });
    document.getElementById('searchInput').addEventListener('input', filter);

    function filter() {
      const cat = document.querySelector('.cat-btn.active').dataset.cat;
      const q   = document.getElementById('searchInput').value.toLowerCase();
      document.querySelectorAll('.blog-card').forEach(c => {
        const catMatch   = cat === 'all' || (c.dataset.cat || '').includes(cat);
        const titleMatch = !q || c.querySelector('.blog-title').textContent.toLowerCase().includes(q);
        const excMatch   = !q || c.querySelector('.blog-excerpt').textContent.toLowerCase().includes(q);
        c.classList.toggle('hide', !catMatch || (!titleMatch && !excMatch));
      });
    }
  </script>

</body>
</html>