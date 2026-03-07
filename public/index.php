<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ahmed Olusesi — Software Developer</title>
  <meta name="description" content="Full-stack software developer based in Lagos — building production-grade web apps, mobile products, and APIs with React, Vue, Next.js, Laravel, Node.js, Python, React Native, Docker and more." />
  <link rel="stylesheet" href="./assets/styles/style.css" />
  <style>

    /* ─── HERO ─── */
    .hero {
      min-height: calc(100vh - 90px);
      display: grid;
      grid-template-columns: 1fr 1fr;
      align-items: center;
      gap: 4rem;
      padding: 4rem 0 5rem;
      position: relative;
    }
    .hero::after {
      content: "";
      position: absolute; top: 0; right: -3rem; bottom: 0; width: 50vw;
      background: radial-gradient(ellipse 70% 80% at 70% 50%, rgba(0,201,174,0.06) 0%, transparent 70%);
      pointer-events: none;
    }
    .hero-overline { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem; }
    .status-dot {
      width: 8px; height: 8px; border-radius: 50%; background: var(--teal);
      box-shadow: 0 0 0 3px rgba(0,201,174,0.2);
      animation: blink 2.5s ease-in-out infinite;
    }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.4} }
    .status-text { font-size: 0.72rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--teal); }
    .hero-title { margin-bottom: 1.5rem; }
    .hero-title .line-2 { color: var(--slate-light); font-style: italic; }
    .hero-desc { font-size: 1.05rem; color: var(--slate-light); line-height: 1.8; max-width: 480px; margin-bottom: 2.5rem; }
    .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; align-items: center; }
    .hero-divider { height: 24px; width: 1px; background: var(--border-light); }

    /* ─── HERO RIGHT CARD ─── */
    .hero-right { position: relative; }
    .hero-main-card {
      background: var(--navy-2); border: 1px solid var(--border-light);
      border-radius: 20px; overflow: hidden; box-shadow: 0 30px 80px rgba(0,0,0,0.5);
    }
    .hc-header {
      background: var(--navy-3); padding: 1rem 1.5rem;
      display: flex; align-items: center; gap: 0.75rem;
      border-bottom: 1px solid var(--border);
    }
    .hc-dots { display: flex; gap: 6px; }
    .hc-dot { width: 10px; height: 10px; border-radius: 50%; }
    .hc-dot-r { background: #ff5f56; } .hc-dot-y { background: #febc2e; } .hc-dot-g { background: #27c93f; }
    .hc-title { font-size: 0.72rem; color: var(--slate); font-weight: 500; letter-spacing: 0.05em; margin-left: auto; }
    .hc-body { padding: 1.75rem; }
    .hc-metric-row {
      display: grid; grid-template-columns: repeat(3,1fr);
      gap: 1px; background: var(--border); border-radius: 10px; overflow: hidden; margin-bottom: 1.5rem;
    }
    .hc-metric { background: var(--navy-3); padding: 1rem; text-align: center; }
    .hc-metric-num { font-family: var(--display); font-size: 1.6rem; font-weight: 800; color: var(--teal); line-height: 1; }
    .hc-metric-label { font-size: 0.65rem; color: var(--slate); margin-top: 0.25rem; letter-spacing: 0.05em; text-transform: uppercase; }
    .hc-skill-row { display: flex; flex-direction: column; gap: 0.75rem; }
    .hc-skill { display: flex; flex-direction: column; gap: 0.4rem; }
    .hc-skill-top { display: flex; justify-content: space-between; font-size: 0.75rem; }
    .hc-skill-name { color: var(--slate-light); font-weight: 500; }
    .hc-skill-pct { color: var(--teal); font-weight: 700; }
    .hc-bar { height: 3px; background: var(--border-light); border-radius: 100px; overflow: hidden; }
    .hc-fill {
      height: 100%; background: linear-gradient(90deg, var(--teal-dark), var(--teal));
      width: 0; transition: width 1.4s cubic-bezier(0.25,0.46,0.45,0.94) 0.5s;
    }
    .hc-fill.go { width: var(--w); }

    /* ─── FLOATING BADGES ─── */
    .hero-float {
      position: absolute; background: var(--navy-3); border: 1px solid var(--border-light);
      border-radius: 12px; padding: 0.85rem 1.1rem;
      box-shadow: 0 16px 40px rgba(0,0,0,0.4);
      display: flex; align-items: center; gap: 0.7rem; font-size: 0.78rem;
    }
    .hero-float-1 { top: -18px; right: 30px; animation: hf1 4s ease-in-out infinite; }
    .hero-float-2 { bottom: -16px; left: 20px; animation: hf2 5s ease-in-out infinite; }
    @keyframes hf1 { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-7px)} }
    @keyframes hf2 { 0%,100%{transform:translateY(0)} 50%{transform:translateY(6px)} }
    .hf-icon { font-size: 1.1rem; }
    .hf-label { font-weight: 700; color: var(--white); }
    .hf-sub { font-size: 0.68rem; color: var(--slate); }

    /* ─── STATS BAND ─── */
    .stats-band { border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); padding: 3rem 0; }
    .stats-inner { display: grid; grid-template-columns: repeat(4,1fr); gap: 2px; }
    .stat-item { padding: 1.5rem 2rem; border-right: 1px solid var(--border); }
    .stat-item:last-child { border-right: none; }
    .stat-num { font-family: var(--display); font-size: 2.8rem; font-weight: 800; line-height: 1; color: var(--white); }
    .stat-num .teal { font-size: inherit; }
    .stat-label { font-size: 0.78rem; color: var(--slate); margin-top: 0.4rem; letter-spacing: 0.04em; }

    /* ─── EXPERTISE ─── */
    .expertise-grid {
      display: grid; grid-template-columns: repeat(3,1fr);
      gap: 1px; background: var(--border);
      border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden;
    }
    .expertise-item {
      background: var(--navy); padding: 2.5rem 2rem;
      transition: background var(--transition); position: relative;
    }
    .expertise-item:hover { background: var(--navy-2); }
    .expertise-item::after {
      content: ""; position: absolute; top: 0; left: 0; right: 0; height: 2px;
      background: var(--teal); transform: scaleX(0); transform-origin: left;
      transition: transform var(--transition);
    }
    .expertise-item:hover::after { transform: scaleX(1); }
    .exp-number { font-family: var(--display); font-size: 3rem; font-weight: 800; color: var(--border-light); line-height: 1; margin-bottom: 1.25rem; }
    .exp-title { font-size: 1rem; font-weight: 700; margin-bottom: 0.6rem; color: var(--white); }
    .exp-desc { font-size: 0.83rem; color: var(--slate); line-height: 1.7; }
    .exp-tags { display: flex; flex-wrap: wrap; gap: 0.4rem; margin-top: 1.25rem; }

    /* ─── TECH TICKER ─── */
    .tech-strip {
      overflow: hidden; position: relative;
      padding: 2.5rem 0;
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
    }
    .tech-strip::before,
    .tech-strip::after {
      content: ""; position: absolute; top: 0; bottom: 0; width: 120px; z-index: 2;
    }
    .tech-strip::before { left: 0; background: linear-gradient(to right, var(--navy), transparent); }
    .tech-strip::after  { right: 0; background: linear-gradient(to left,  var(--navy), transparent); }
    .tech-track {
      display: flex; gap: 0.75rem;
      width: max-content;
      animation: ticker 50s linear infinite;
    }
    .tech-track:hover { animation-play-state: paused; }
    @keyframes ticker { from{transform:translateX(0)} to{transform:translateX(-50%)} }
    .tech-pill {
      display: inline-flex; align-items: center; gap: 0.45rem;
      border: 1px solid var(--border-light); border-radius: 100px;
      padding: 0.35rem 1rem; font-size: 0.75rem; font-weight: 600;
      color: var(--slate-light); white-space: nowrap;
      background: rgba(255,255,255,0.03);
    }
    .tech-pill .dot-sm { width: 6px; height: 6px; border-radius: 50%; background: var(--teal); opacity: 0.7; }

    /* ─── FEATURED PROJECTS ─── */
    .proj-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; }
    .proj-grid-right { display: flex; flex-direction: column; gap: 1.5rem; }
    .proj-card {
      background: var(--card-bg); border: 1px solid var(--border);
      border-radius: var(--radius-lg); overflow: hidden;
      transition: all var(--transition); position: relative;
    }
    .proj-card:hover {
      background: var(--card-hover); border-color: var(--border-light);
      transform: translateY(-4px); box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }
    .proj-card::before {
      content: ""; position: absolute; top: 0; left: 0; right: 0; height: 1px;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.07), transparent);
    }
    .proj-visual {
      height: 180px; display: flex; align-items: center; justify-content: center;
      font-family: var(--display); font-weight: 800; font-size: 3.5rem;
      letter-spacing: -0.05em; position: relative;
    }
    .proj-visual-sm { height: 110px; font-size: 2rem; }
    .pv-1 { background: linear-gradient(135deg,#071628 0%,#0d2444 50%,#0a2238 100%); color: rgba(0,201,174,0.4); }
    .pv-2 { background: linear-gradient(135deg,#0d1228 0%,#1a1240 100%); color: rgba(130,100,255,0.4); }
    .pv-3 { background: linear-gradient(135deg,#0a1820 0%,#0d2830 100%); color: rgba(0,180,200,0.4); }
    .pv-4 { background: linear-gradient(135deg,#1a0d14 0%,#280d20 100%); color: rgba(220,80,140,0.3); }
    .proj-body { padding: 1.75rem; }
    .proj-body-sm { padding: 1.25rem; }
    .proj-chips { display: flex; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 0.75rem; }
    .proj-name { font-family: var(--body); font-size: 1.05rem; font-weight: 700; margin-bottom: 0.4rem; }
    .proj-name-sm { font-size: 0.9rem; }
    .proj-desc { font-size: 0.83rem; color: var(--slate); line-height: 1.65; }
    .proj-footer {
      display: flex; justify-content: space-between; align-items: center;
      padding: 1rem 1.75rem; border-top: 1px solid var(--border);
    }
    .proj-footer-sm { padding: 0.75rem 1.25rem; }
    .proj-link {
      font-size: 0.78rem; font-weight: 600; color: var(--teal); text-decoration: none;
      display: flex; align-items: center; gap: 4px; transition: gap var(--transition);
    }
    .proj-link:hover { gap: 8px; }
    .proj-year { font-size: 0.72rem; color: var(--slate); }

    /* ─── TESTIMONIALS ─── */
    .t-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; }
    .t-card { padding: 2rem; }
    .t-quote { font-size: 2rem; color: var(--teal); opacity: 0.5; line-height: 1; margin-bottom: 1rem; }
    .t-text { font-size: 0.875rem; color: var(--slate-light); line-height: 1.8; font-style: italic; margin-bottom: 1.5rem; }
    .t-author { display: flex; align-items: center; gap: 0.75rem; }
    .t-av { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem; }
    .t-name { font-size: 0.85rem; font-weight: 700; }
    .t-role { font-size: 0.72rem; color: var(--slate); }
    .t-stars { color: var(--teal); font-size: 0.75rem; margin-bottom: 0.75rem; letter-spacing: 2px; }

    /* ─── CTA ─── */
    .cta-section {
      background: linear-gradient(135deg, var(--navy-2) 0%, var(--navy-3) 100%);
      border: 1px solid var(--border-light); border-radius: 20px;
      padding: 5rem 4rem;
      display: flex; justify-content: space-between; align-items: center;
      gap: 3rem; position: relative; overflow: hidden;
    }
    .cta-section::before {
      content: ""; position: absolute; top: -80px; right: -80px; width: 300px; height: 300px;
      border-radius: 50%; background: radial-gradient(circle, rgba(0,201,174,0.08) 0%, transparent 70%);
    }
    .cta-section::after {
      content: ""; position: absolute; bottom: -60px; left: -60px; width: 200px; height: 200px;
      border-radius: 50%; background: radial-gradient(circle, rgba(0,201,174,0.05) 0%, transparent 70%);
    }
    .cta-left { position: relative; z-index: 1; }
    .cta-title { margin-bottom: 0.75rem; }
    .cta-sub { font-size: 0.95rem; color: var(--slate-light); line-height: 1.7; max-width: 400px; }
    .cta-right { display: flex; gap: 1rem; flex-shrink: 0; position: relative; z-index: 1; }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 960px) {
      .hero { grid-template-columns: 1fr; min-height: auto; padding: 3rem 0 4rem; }
      .hero-right { display: none; }
      .stats-inner { grid-template-columns: 1fr 1fr; }
      .stat-item { border-right: none; border-bottom: 1px solid var(--border); }
      .stat-item:nth-child(odd) { border-right: 1px solid var(--border); }
      .expertise-grid { grid-template-columns: 1fr; }
      .proj-grid { grid-template-columns: 1fr; }
      .t-grid { grid-template-columns: 1fr; }
      .cta-section { flex-direction: column; text-align: center; }
      .cta-sub { max-width: 100%; }
      .cta-right { flex-wrap: wrap; justify-content: center; }
    }
  </style>
</head>
<body>

  <?php include './includes/nav.php'; ?>

  <div class="page-wrap">

    <!-- ════════════════════════════════
         HERO
    ═════════════════════════════════ -->
    <section class="section">
      <div class="container">
        <div class="hero">

          <div>
            <div class="hero-overline">
              <div class="status-dot"></div>
              <span class="status-text">Open to new roles &amp; freelance projects</span>
            </div>
            <h1 class="display-xl hero-title reveal">
              Building<br />
              <span class="line-2">products</span><br />
              that ship.
            </h1>
            <p class="hero-desc reveal reveal-d1">
              I'm Ahmed — a full-stack software developer based in Lagos.
              I design and build complete digital products: responsive web apps,
              cross-platform mobile apps, secure APIs, and the infrastructure
              that keeps them running. Six years across agencies and product
              companies, shipping things people actually use.
            </p>
            <div class="hero-actions reveal reveal-d2">
              <a href="portfolio.php" class="btn btn-primary btn-lg">
                View My Work
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
              </a>
              <div class="hero-divider"></div>
              <a href="about.php" class="btn btn-ghost btn-lg">About Me</a>
            </div>
          </div>

          <!-- Dashboard card -->
          <div class="hero-right reveal reveal-d2">
            <div class="hero-float hero-float-1">
              <div class="hf-icon">🚀</div>
              <div>
                <div class="hf-label">Latest: NexaERP v2.0</div>
                <div class="hf-sub">React · Laravel · Docker</div>
              </div>
            </div>
            <div class="hero-main-card">
              <div class="hc-header">
                <div class="hc-dots">
                  <div class="hc-dot hc-dot-r"></div>
                  <div class="hc-dot hc-dot-y"></div>
                  <div class="hc-dot hc-dot-g"></div>
                </div>
                <div class="hc-title">developer.profile</div>
              </div>
              <div class="hc-body">
                <div class="hc-metric-row">
                  <div class="hc-metric">
                    <div class="hc-metric-num">6+</div>
                    <div class="hc-metric-label">Years</div>
                  </div>
                  <div class="hc-metric">
                    <div class="hc-metric-num">20+</div>
                    <div class="hc-metric-label">Products</div>
                  </div>
                  <div class="hc-metric">
                    <div class="hc-metric-num">15+</div>
                    <div class="hc-metric-label">Technologies</div>
                  </div>
                </div>
                <div class="hc-skill-row">
                  <div class="hc-skill">
                    <div class="hc-skill-top">
                      <span class="hc-skill-name">Frontend Engineering</span>
                      <span class="hc-skill-pct">95%</span>
                    </div>
                    <div class="hc-bar"><div class="hc-fill" style="--w:95%"></div></div>
                  </div>
                  <div class="hc-skill">
                    <div class="hc-skill-top">
                      <span class="hc-skill-name">Backend &amp; API</span>
                      <span class="hc-skill-pct">92%</span>
                    </div>
                    <div class="hc-bar"><div class="hc-fill" style="--w:92%"></div></div>
                  </div>
                  <div class="hc-skill">
                    <div class="hc-skill-top">
                      <span class="hc-skill-name">Mobile Development</span>
                      <span class="hc-skill-pct">88%</span>
                    </div>
                    <div class="hc-bar"><div class="hc-fill" style="--w:88%"></div></div>
                  </div>
                  <div class="hc-skill">
                    <div class="hc-skill-top">
                      <span class="hc-skill-name">DevOps &amp; Infrastructure</span>
                      <span class="hc-skill-pct">80%</span>
                    </div>
                    <div class="hc-bar"><div class="hc-fill" style="--w:80%"></div></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="hero-float hero-float-2">
              <div class="hf-icon">⚡</div>
              <div>
                <div class="hf-label">Full-stack &amp; mobile</div>
                <div class="hf-sub">Web · API · iOS · Android</div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ════════════════════════════════
         STATS BAND
    ═════════════════════════════════ -->
    <div class="stats-band">
      <div class="container">
        <div class="stats-inner">
          <div class="stat-item reveal">
            <div class="stat-num">
              <span class="teal" data-target="6" data-suffix="+">0+</span>
            </div>
            <div class="stat-label">Years building production software</div>
          </div>
          <div class="stat-item reveal reveal-d1">
            <div class="stat-num">
              <span class="teal" data-target="20" data-suffix="+">0+</span>
            </div>
            <div class="stat-label">Web &amp; mobile products shipped</div>
          </div>
          <div class="stat-item reveal reveal-d2">
            <div class="stat-num">
              <span class="teal" data-target="15" data-suffix="+">0+</span>
            </div>
            <div class="stat-label">Technologies across the full stack</div>
          </div>
          <div class="stat-item reveal reveal-d3">
            <div class="stat-num">
              <span class="teal" data-target="4" data-suffix="">0</span>
            </div>
            <div class="stat-label">Companies &amp; agencies served</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ════════════════════════════════
         EXPERTISE
    ═════════════════════════════════ -->
    <section class="section">
      <div class="container">
        <div class="sh">
          <div>
            <div class="eyebrow reveal">What I Build</div>
            <h2 class="display-md reveal reveal-d1">End-to-end, across the stack</h2>
          </div>
          <p class="section-sub reveal reveal-d2">
            I don't build one layer and hand off the rest. I own the product
            from interface to infrastructure — and every decision in between.
          </p>
        </div>
        <div class="expertise-grid">

          <div class="expertise-item reveal">
            <div class="exp-number">01</div>
            <div class="exp-title">Frontend Product Engineering</div>
            <p class="exp-desc">
              Component-driven UIs in React, Vue, Next.js, and Nuxt — from
              Figma and Adobe XD designs to pixel-perfect, responsive, accessible
              production code. Design systems with TailwindCSS, Bootstrap,
              MUI, Ant Design, and SASS.
            </p>
            <div class="exp-tags">
              <span class="chip">React</span><span class="chip">Vue</span>
              <span class="chip">Next.js</span><span class="chip">TypeScript</span>
              <span class="chip">TailwindCSS</span>
            </div>
          </div>

          <div class="expertise-item reveal reveal-d1">
            <div class="exp-number">02</div>
            <div class="exp-title">Backend &amp; API Development</div>
            <p class="exp-desc">
              Structured, secure REST and GraphQL APIs with Node/Express,
              PHP/Laravel, and Python/Django. Multi-role auth, payment
              integrations, optimised queries, and security hardened
              from the ground up — not bolted on after.
            </p>
            <div class="exp-tags">
              <span class="chip">Laravel</span><span class="chip">Node.js</span>
              <span class="chip">Django</span><span class="chip">GraphQL</span>
              <span class="chip">REST</span>
            </div>
          </div>

          <div class="expertise-item reveal reveal-d2">
            <div class="exp-number">03</div>
            <div class="exp-title">Mobile App Development</div>
            <p class="exp-desc">
              Cross-platform iOS and Android apps with React Native and Expo.
              Native-feel interactions, offline support, push notifications,
              and a single codebase published to both stores — without the
              usual compromises.
            </p>
            <div class="exp-tags">
              <span class="chip">React Native</span><span class="chip">Expo</span>
              <span class="chip">iOS</span><span class="chip">Android</span>
            </div>
          </div>

          <div class="expertise-item reveal">
            <div class="exp-number">04</div>
            <div class="exp-title">Enterprise Systems — ERP &amp; CRM</div>
            <p class="exp-desc">
              Full-featured ERP and CRM platforms with multi-tenant architecture,
              role-based access control, workflow automation, reporting dashboards,
              and third-party integrations — built to handle real business complexity
              without falling over.
            </p>
            <div class="exp-tags">
              <span class="chip">Multi-tenant</span><span class="chip">RBAC</span>
              <span class="chip">MySQL</span><span class="chip">MongoDB</span>
            </div>
          </div>

          <div class="expertise-item reveal reveal-d1">
            <div class="exp-number">05</div>
            <div class="exp-title">DevOps &amp; Deployment</div>
            <p class="exp-desc">
              Containerised workloads with Docker and Kubernetes, CI/CD
              pipelines via Jenkins and GitHub Actions, cloud deployments
              on AWS, Heroku, and cPanel. Zero-surprise production releases —
              every time.
            </p>
            <div class="exp-tags">
              <span class="chip">Docker</span><span class="chip">Kubernetes</span>
              <span class="chip">Jenkins</span><span class="chip">AWS</span>
            </div>
          </div>

          <div class="expertise-item reveal reveal-d2">
            <div class="exp-number">06</div>
            <div class="exp-title">UI/UX Design &amp; CMS</div>
            <p class="exp-desc">
              Design-to-code fidelity using Figma, Adobe XD, and Photoshop.
              Bespoke WordPress and OpenCart builds, SEO strategy, SASS
              architecture, and digital marketing execution for complete,
              launch-ready product delivery.
            </p>
            <div class="exp-tags">
              <span class="chip">Figma</span><span class="chip">Adobe XD</span>
              <span class="chip">WordPress</span><span class="chip">SASS</span>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ════════════════════════════════
         TECH TICKER
    ═════════════════════════════════ -->
    <div class="tech-strip">
      <?php
      $techs = [
        'React','Vue','Next.js','Nuxt.js','TypeScript','JavaScript',
        'React Native','Expo','TailwindCSS','Bootstrap','SASS','MUI','Ant Design',
        'Node.js','Express','PHP','Laravel','Python','Django',
        'REST API','GraphQL','MySQL','MongoDB',
        'Docker','Kubernetes','Jenkins','AWS','GitHub Actions',
        'Figma','Adobe XD','Photoshop','WordPress','OpenCart',
      ];
      // Double up for seamless infinite loop
      $all = array_merge($techs, $techs);
      ?>
      <div class="tech-track">
        <?php foreach ($all as $t): ?>
          <span class="tech-pill"><span class="dot-sm"></span><?= htmlspecialchars($t) ?></span>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- ════════════════════════════════
         FEATURED PROJECTS
    ═════════════════════════════════ -->
    <section class="section">
      <div class="container">
        <div class="sh">
          <div>
            <div class="eyebrow reveal">Selected Work</div>
            <h2 class="display-md reveal reveal-d1">Featured projects</h2>
          </div>
          <a href="portfolio.php" class="btn btn-ghost reveal reveal-d2">Full Portfolio →</a>
        </div>
        <div class="proj-grid">

          <div class="proj-card reveal">
            <div class="proj-visual pv-1">NEXAERP</div>
            <div class="proj-body">
              <div class="proj-chips">
                <span class="chip">React</span><span class="chip">Laravel</span>
                <span class="chip">MySQL</span><span class="chip">Docker</span>
                <span class="chip">REST API</span>
              </div>
              <div class="proj-name">NexaERP — Enterprise Resource Planning Platform</div>
              <p class="proj-desc">
                Multi-tenant ERP built for mid-size businesses covering inventory,
                procurement, HR, payroll, and financial reporting. Five permission
                levels, real-time dashboard, PDF report generation, and a full REST
                API consumed by a React Native mobile companion. Deployed on AWS
                via Docker with a Jenkins CI/CD pipeline.
              </p>
            </div>
            <div class="proj-footer">
              <span class="proj-year">2024 · Full-Stack · Enterprise</span>
              <a href="portfolio.php" class="proj-link">Case Study →</a>
            </div>
          </div>

          <div class="proj-grid-right">
            <div class="proj-card reveal reveal-d1">
              <div class="proj-visual pv-2 proj-visual-sm">PULSECRM</div>
              <div class="proj-body proj-body-sm">
                <div class="proj-chips">
                  <span class="chip">Vue</span><span class="chip">Node.js</span>
                  <span class="chip">MongoDB</span><span class="chip">GraphQL</span>
                </div>
                <div class="proj-name proj-name-sm">PulseCRM — Sales &amp; Customer Platform</div>
                <p class="proj-desc" style="font-size:0.78rem">
                  Pipeline management, contact tracking, automated follow-up
                  sequences, and analytics — in daily use by a 40-person sales team.
                </p>
              </div>
              <div class="proj-footer proj-footer-sm">
                <span class="proj-year">2023 · Full-Stack</span>
                <a href="portfolio.php" class="proj-link">View →</a>
              </div>
            </div>
            <div class="proj-card reveal reveal-d2">
              <div class="proj-visual pv-3 proj-visual-sm">TRACKR</div>
              <div class="proj-body proj-body-sm">
                <div class="proj-chips">
                  <span class="chip">React Native</span><span class="chip">Expo</span>
                  <span class="chip">Node.js</span><span class="chip">MySQL</span>
                </div>
                <div class="proj-name proj-name-sm">Trackr — Field Operations Mobile App</div>
                <p class="proj-desc" style="font-size:0.78rem">
                  iOS &amp; Android app for field team task management, GPS check-ins,
                  and offline-first report submission synced on reconnect.
                </p>
              </div>
              <div class="proj-footer proj-footer-sm">
                <span class="proj-year">2023 · Mobile</span>
                <a href="portfolio.php" class="proj-link">View →</a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ════════════════════════════════
         TESTIMONIALS
    ═════════════════════════════════ -->
    <section class="section" style="background:linear-gradient(180deg,transparent 0%,var(--navy-2) 50%,transparent 100%);padding-top:0;">
      <div class="container">
        <div class="sh">
          <div>
            <div class="eyebrow reveal">Testimonials</div>
            <h2 class="display-md reveal reveal-d1">What clients say</h2>
          </div>
        </div>
        <div class="t-grid">

          <div class="glass-card t-card reveal">
            <div class="t-stars">★★★★★</div>
            <div class="t-quote">"</div>
            <p class="t-text">
              Ahmed built our entire ERP from scratch — inventory, HR, payroll,
              the works. He asked the right questions upfront, flagged issues before
              they became problems, and delivered something our team actually
              wants to use. Rare quality.
            </p>
            <div class="t-author">
              <div class="t-av" style="background:linear-gradient(135deg,#00c9ae,#0082b0)">TA</div>
              <div>
                <div class="t-name">Tunde Adeyemi</div>
                <div class="t-role">CEO · Manufacturing SME, Lagos</div>
              </div>
            </div>
          </div>

          <div class="glass-card t-card reveal reveal-d1">
            <div class="t-stars">★★★★★</div>
            <div class="t-quote">"</div>
            <p class="t-text">
              We needed a React Native app on iOS and Android, fast, without
              sacrificing quality. Ahmed delivered on time, the codebase was
              clean enough for our in-house team to maintain, and the UX was
              exactly what we'd designed. Very impressive.
            </p>
            <div class="t-author">
              <div class="t-av" style="background:linear-gradient(135deg,#6b21a8,#1e40af)">FC</div>
              <div>
                <div class="t-name">Fatima Chukwu</div>
                <div class="t-role">Product Manager · Logistics Startup</div>
              </div>
            </div>
          </div>

          <div class="glass-card t-card reveal reveal-d2">
            <div class="t-stars">★★★★★</div>
            <div class="t-quote">"</div>
            <p class="t-text">
              Ahmed migrated our entire platform to a new stack without a single
              day of downtime. He documented everything, trained the team, and left
              us with a system we understand and can grow. That level of ownership
              is genuinely hard to find.
            </p>
            <div class="t-author">
              <div class="t-av" style="background:linear-gradient(135deg,#065f46,#0f766e)">BO</div>
              <div>
                <div class="t-name">Biodun Okonkwo</div>
                <div class="t-role">CTO · SaaS Platform, Abuja</div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ════════════════════════════════
         CTA
    ═════════════════════════════════ -->
    <section class="section-sm">
      <div class="container">
        <div class="cta-section reveal">
          <div class="cta-left">
            <div class="eyebrow" style="margin-bottom:1rem">Ready to build?</div>
            <h2 class="display-md cta-title">
              Let's ship a product<br />worth using.
            </h2>
            <p class="cta-sub">
              Open to freelance projects, contract engagements, and full-time
              roles. Based in Lagos — fully available for remote work worldwide.
            </p>
          </div>
          <div class="cta-right">
            <a href="contact.php" class="btn btn-primary btn-lg">Start a Conversation →</a>
            <a href="portfolio.php" class="btn btn-ghost btn-lg">View My Work</a>
          </div>
        </div>
      </div>
    </section>

  </div><!-- /page-wrap -->

  <?php include './includes/footer.php'; ?>

  <script src="./assets/js/main.js"></script>
  <script>
    // Animate skill bars when hero card scrolls into view
    const hcObserver = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.querySelectorAll('.hc-fill').forEach(f => f.classList.add('go'));
          hcObserver.unobserve(e.target);
        }
      });
    }, { threshold: 0.5 });
    const heroCard = document.querySelector('.hero-main-card');
    if (heroCard) hcObserver.observe(heroCard);
  </script>

</body>
</html>