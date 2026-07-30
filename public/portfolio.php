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
  <title>Portfolio — Ahmed Olusesi</title>
  <meta name="description" content="Full-stack portfolio — web apps, mobile apps, APIs, ERP, CRM, and e-commerce projects by Ahmed Olusesi." />
  <link rel="stylesheet" href="./assets/styles/style.css" />
  <style>

    /* ─── HERO ─── */
    .port-hero {
      padding: 5rem 0 4rem;
      border-bottom: 1px solid var(--border);
      position: relative; overflow: hidden;
    }
    .port-hero::before {
      content: "";
      position: absolute; top: -80px; right: -80px;
      width: 400px; height: 400px; border-radius: 50%;
      background: radial-gradient(circle, rgba(0,201,174,0.06) 0%, transparent 70%);
      pointer-events: none;
    }
    .port-hero-inner {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 4rem; align-items: end;
    }
    .ph-stats {
      display: grid; grid-template-columns: repeat(3,1fr);
      gap: 1px; background: var(--border);
      border: 1px solid var(--border-light);
      border-radius: 16px; overflow: hidden;
    }
    .ph-stat { padding: 1.5rem; background: var(--navy-2); text-align: center; }
    .ph-stat-num {
      font-family: var(--display); font-size: 2rem; font-weight: 800;
      color: var(--teal); line-height: 1;
    }
    .ph-stat-label {
      font-size: 0.65rem; color: var(--slate);
      text-transform: uppercase; letter-spacing: 0.08em; margin-top: 0.3rem;
    }

    /* ─── FILTER BAR ─── */
    .filter-bar {
      display: flex; gap: 0.5rem; flex-wrap: wrap;
      margin: 3rem 0 2.5rem; padding-bottom: 2rem;
      border-bottom: 1px solid var(--border);
    }
    .fb {
      font-size: 0.72rem; font-weight: 600; letter-spacing: 0.08em;
      text-transform: uppercase; padding: 0.45rem 1.1rem;
      border-radius: 6px; border: 1px solid var(--border-light);
      background: transparent; color: var(--slate-light);
      cursor: pointer; transition: all var(--transition);
    }
    .fb:hover { border-color: var(--teal); color: var(--teal); background: rgba(0,201,174,0.05); }
    .fb.active { background: var(--teal); color: var(--navy); border-color: var(--teal); font-weight: 700; }

    /* ─── PROJECT LIST ─── */
    .proj-list {
      display: flex; flex-direction: column;
      gap: 1px; background: var(--border);
      border: 1px solid var(--border-light);
      border-radius: var(--radius-lg); overflow: hidden;
    }
    .proj-row {
      display: grid; grid-template-columns: 72px 1fr auto;
      align-items: center; gap: 2rem;
      background: var(--navy); padding: 1.75rem 2rem;
      transition: all var(--transition); cursor: pointer;
      position: relative;
    }
    .proj-row::before {
      content: ""; position: absolute; left: 0; top: 0; bottom: 0;
      width: 2px; background: var(--teal);
      transform: scaleY(0); transform-origin: top;
      transition: transform var(--transition);
    }
    .proj-row:hover { background: var(--navy-2); }
    .proj-row:hover::before { transform: scaleY(1); }
    .proj-row.hide { display: none; }
    .proj-num {
      font-family: var(--display); font-size: 2rem; font-weight: 800;
      color: var(--border-light); letter-spacing: -0.04em; text-align: center;
    }
    .proj-meta { display: flex; align-items: center; gap: 1rem; margin-bottom: 0.4rem; }
    .proj-cat {
      font-size: 0.63rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase; color: var(--teal);
    }
    .proj-year-sm { font-size: 0.72rem; color: var(--slate); }
    .proj-name-row {
      font-family: var(--body); font-size: 1.05rem; font-weight: 700;
      color: var(--white); margin-bottom: 0.35rem;
    }
    .proj-tags-row { display: flex; gap: 0.4rem; flex-wrap: wrap; }
    .proj-ptag {
      font-size: 0.63rem; font-weight: 600;
      padding: 0.18rem 0.5rem; border-radius: 4px;
      background: rgba(255,255,255,0.05);
      border: 1px solid var(--border-light);
      color: var(--slate-light);
      text-transform: uppercase; letter-spacing: 0.04em;
    }
    .proj-right {
      display: flex; flex-direction: column;
      align-items: flex-end; gap: 0.5rem; min-width: 160px;
    }
    .proj-result {
      font-size: 0.78rem; font-weight: 700;
      color: var(--teal); text-align: right;
    }
    .proj-cta {
      font-size: 0.7rem; font-weight: 700; letter-spacing: 0.07em;
      text-transform: uppercase; color: var(--slate-light);
      text-decoration: none; display: flex; align-items: center; gap: 4px;
      background: rgba(255,255,255,0.05);
      border: 1px solid var(--border-light);
      padding: 0.4rem 0.85rem; border-radius: 6px;
      transition: all var(--transition); white-space: nowrap;
    }
    .proj-cta:hover { background: var(--teal); color: var(--navy); border-color: var(--teal); }

    /* ─── SIDE PANEL ─── */
    .panel-overlay {
      display: none; position: fixed; inset: 0; z-index: 800;
      background: rgba(4,10,18,0.7); backdrop-filter: blur(6px);
    }
    .panel-overlay.open { display: block; }
    .side-panel {
      position: fixed; top: 0; right: -560px; width: 560px; height: 100vh;
      background: var(--navy-2); z-index: 900; overflow-y: auto;
      transition: right 0.4s cubic-bezier(0.25,0.46,0.45,0.94);
      box-shadow: -20px 0 80px rgba(0,0,0,0.6);
      border-left: 1px solid var(--border-light);
    }
    .side-panel.open { right: 0; }
    .sp-header {
      background: var(--navy-3); padding: 2rem;
      position: sticky; top: 0; z-index: 10;
      border-bottom: 1px solid var(--border-light);
    }
    .sp-close {
      position: absolute; top: 1.5rem; right: 1.5rem;
      width: 34px; height: 34px; border-radius: 50%;
      background: rgba(255,255,255,0.07); border: 1px solid var(--border-light);
      cursor: pointer; color: var(--slate-light); font-size: 1rem;
      display: flex; align-items: center; justify-content: center;
      transition: all var(--transition);
    }
    .sp-close:hover { background: rgba(255,255,255,0.14); color: var(--white); }
    .sp-cat {
      font-size: 0.63rem; font-weight: 700; letter-spacing: 0.12em;
      text-transform: uppercase; color: var(--teal); margin-bottom: 0.75rem;
    }
    .sp-title {
      font-family: var(--display); font-size: 1.6rem; font-weight: 800;
      color: var(--white); line-height: 1.1;
    }
    .sp-body { padding: 2rem; }
    .sp-section { margin-bottom: 2rem; }
    .sp-section-title {
      font-size: 0.63rem; font-weight: 700; letter-spacing: 0.12em;
      text-transform: uppercase; color: var(--slate);
      margin-bottom: 0.75rem; padding-bottom: 0.5rem;
      border-bottom: 1px solid var(--border-light);
    }
    .sp-text { font-size: 0.88rem; color: var(--slate-light); line-height: 1.85; }
    .sp-metrics {
      display: grid; grid-template-columns: repeat(3,1fr);
      gap: 1rem; margin-top: 1.5rem;
    }
    .sp-metric {
      background: var(--navy-3); border: 1px solid var(--border-light);
      border-radius: 10px; padding: 1.25rem; text-align: center;
    }
    .sp-metric-val {
      font-family: var(--display); font-size: 1.5rem; font-weight: 800;
      color: var(--teal); line-height: 1;
    }
    .sp-metric-label {
      font-size: 0.63rem; color: var(--slate);
      margin-top: 0.3rem; text-transform: uppercase; letter-spacing: 0.06em;
    }
    .sp-tech-list { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .sp-tech {
      font-size: 0.73rem; font-weight: 600;
      padding: 0.3rem 0.75rem; border-radius: 6px;
      background: rgba(0,201,174,0.08);
      border: 1px solid rgba(0,201,174,0.2);
      color: var(--teal);
    }
    .sp-link {
      display: inline-flex; align-items: center; gap: 0.4rem;
      font-size: 0.82rem; font-weight: 600;
      color: var(--teal); text-decoration: none;
      margin-top: 0.5rem;
      transition: gap var(--transition);
    }
    .sp-link:hover { gap: 0.7rem; }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 960px) {
      .port-hero-inner { grid-template-columns: 1fr; }
      .proj-row { grid-template-columns: 56px 1fr; }
      .proj-right { display: none; }
      .side-panel { width: 100%; right: -100%; }
    }
  </style>
</head>
<body>

  <?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$pdo = db();
$projects = $pdo->query("SELECT * FROM projects WHERE status = 'published' ORDER BY sort_order ASC, created_at DESC")->fetchAll();
$projectCount = count($projects);
?>

  <?php include './partials/nav.php'; ?>

  <div class="page-wrap">

    <!-- ════════════════════════════════
         HERO
    ═════════════════════════════════ -->
    <section class="port-hero">
      <div class="container">
        <div class="port-hero-inner">
          <div>
            <div class="eyebrow reveal">Portfolio</div>
            <h1 class="display-lg reveal reveal-d1">
              Selected<br /><span class="teal">Work</span>
            </h1>
            <p class="section-sub reveal reveal-d2" style="margin-top:1rem;">
              <?= $projectCount ?> projects across enterprise systems, full-stack web apps,
              mobile, e-commerce, and CMS — each one shipped and in use.
            </p>
          </div>
            <div class="ph-stats reveal reveal-d2">
            <div class="ph-stat">
              <div class="ph-stat-num"><?= $projectCount ?></div>
              <div class="ph-stat-label">Projects</div>
            </div>
            <div class="ph-stat">
              <div class="ph-stat-num">6+</div>
              <div class="ph-stat-label">Years</div>
            </div>
            <div class="ph-stat">
              <div class="ph-stat-num">5</div>
              <div class="ph-stat-label">Industries</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ════════════════════════════════
         PROJECT LIST
    ═════════════════════════════════ -->
    <section class="section">
      <div class="container">

        <div class="filter-bar reveal">
          <button class="fb active" data-f="all">All Projects</button>
          <button class="fb" data-f="fullstack">Full-Stack</button>
          <button class="fb" data-f="frontend">Frontend</button>
          <button class="fb" data-f="backend">Backend / API</button>
          <button class="fb" data-f="mobile">Mobile</button>
          <button class="fb" data-f="ecommerce">E-Commerce</button>
        </div>

        <div class="proj-list reveal reveal-d1">
          <?php if ($projects): ?>
            <?php foreach ($projects as $i => $p): ?>
              <?php
                $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                $techArr = array_filter(array_map('trim', explode(',', $p['tech_stack'] ?? '')));
                $catLabel = ucwords(str_replace(',', ' · ', $p['category'] ?? ''));
                $metricsData = json_decode($p['metrics'] ?? '[]', true);
                $resultText = !empty($metricsData) ? $metricsData[0]['v'] . ' · ' . $metricsData[0]['l'] : '';
              ?>
              <div class="proj-row" data-cat="<?= e($p['category'] ?? '') ?>" onclick="openPanel(<?= $p['id'] ?>)">
                <div class="proj-num"><?= $num ?></div>
                <div class="proj-info">
                  <div class="proj-meta">
                    <span class="proj-cat"><?= e($catLabel) ?></span>
                  </div>
                  <div class="proj-name-row"><?= e($p['title']) ?></div>
                  <div class="proj-tags-row">
                    <?php foreach (array_slice($techArr, 0, 5) as $t): ?>
                      <span class="proj-ptag"><?= e($t) ?></span>
                    <?php endforeach; ?>
                  </div>
                </div>
                <div class="proj-right">
                  <?php if ($resultText): ?>
                    <div class="proj-result"><?= e($resultText) ?></div>
                  <?php endif; ?>
                  <span class="proj-cta">Case Study →</span>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div style="text-align:center;padding:4rem;color:var(--slate);">No projects yet.</div>
          <?php endif; ?>
        </div>
      </div>
    </section>

  </div><!-- /page-wrap -->

  <!-- ── SIDE PANEL ── -->
  <div class="panel-overlay" id="overlay" onclick="closePanel()"></div>
  <div class="side-panel" id="sidePanel">
    <div class="sp-header">
      <button class="sp-close" onclick="closePanel()">✕</button>
      <div class="sp-cat" id="sp-cat"></div>
      <div class="sp-title" id="sp-title"></div>
    </div>
    <div class="sp-body" id="sp-body"></div>
  </div>

  <?php include './partials/footer.php'; ?>

  <script src="./assets/js/main.js"></script>
  <script>
  const projectsData = <?= json_encode($projects) ?>;

  function openPanel(id) {
    const d = projectsData.find(p => p.id == id);
    if (!d) return;
    const metrics = JSON.parse(d.metrics || '[]');
    const tech = (d.tech_stack || '').split(',').map(t => t.trim()).filter(Boolean);
    document.getElementById('sp-cat').textContent = (d.category || '').split(',').map(s => s.trim()).map(s => s.charAt(0).toUpperCase() + s.slice(1)).join(' · ');
    document.getElementById('sp-title').textContent = d.title;
    document.getElementById('sp-body').innerHTML = `
      ${d.description ? `<div class="sp-section"><div class="sp-section-title">Project Overview</div><p class="sp-text">${d.description}</p></div>` : ''}
      ${d.challenge ? `<div class="sp-section"><div class="sp-section-title">The Challenge</div><p class="sp-text">${d.challenge}</p></div>` : ''}
      ${d.solution ? `<div class="sp-section"><div class="sp-section-title">The Approach</div><p class="sp-text">${d.solution}</p></div>` : ''}
      ${metrics.length ? `<div class="sp-metrics">${metrics.map(m => `<div class="sp-metric"><div class="sp-metric-val">${m.v}</div><div class="sp-metric-label">${m.l}</div></div>`).join('')}</div>` : ''}
      ${tech.length ? `<div class="sp-section" style="margin-top:1.75rem;"><div class="sp-section-title">Tech Stack</div><div class="sp-tech-list">${tech.map(t => `<span class="sp-tech">${t}</span>`).join('')}</div></div>` : ''}
      ${d.live_url ? `<div class="sp-section"><div class="sp-section-title">Live Project</div><a href="${d.live_url}" target="_blank" rel="noopener" class="sp-link">Visit Site →</a></div>` : ''}
    `;
    document.getElementById('overlay').classList.add('open');
    document.getElementById('sidePanel').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closePanel() {
    document.getElementById('overlay').classList.remove('open');
    document.getElementById('sidePanel').classList.remove('open');
    document.body.style.overflow = '';
  }

  document.addEventListener('keydown', e => { if (e.key === 'Escape') closePanel(); });

  // Filter
  document.querySelectorAll('.fb').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.fb').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const f = btn.dataset.f;
      document.querySelectorAll('.proj-row').forEach(r => {
        r.classList.toggle('hide', f !== 'all' && !(r.dataset.cat || '').includes(f));
      });
    });
  });
  </script>

</body>
</html>