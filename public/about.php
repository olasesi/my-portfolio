<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About — Ahmed Olusesi</title>
  <meta name="description" content="Ahmed Olusesi — 6+ years building full-stack web and mobile products in Lagos. Background in React, Vue, Node.js, PHP/Laravel, Python, React Native, Docker, AWS." />
  <link rel="stylesheet" href="./assets/styles/style.css" />
  <style>

    /* ─── PAGE HERO ─── */
    .page-hero {
      padding: 5rem 0 5rem;
      border-bottom: 1px solid var(--border);
      position: relative;
      overflow: hidden;
    }
    .page-hero::before {
      content: "";
      position: absolute; top: -100px; right: -100px;
      width: 500px; height: 500px; border-radius: 50%;
      background: radial-gradient(circle, rgba(0,201,174,0.05) 0%, transparent 70%);
      pointer-events: none;
    }
    .page-hero-inner {
      display: grid;
      grid-template-columns: 380px 1fr;
      gap: 5rem;
      align-items: start;
    }

    /* ─── AVATAR CARD ─── */
    .about-card {
      background: var(--navy-2);
      border: 1px solid var(--border-light);
      border-radius: 20px;
      overflow: hidden;
      position: sticky;
      top: 110px;
    }
    .about-avatar {
      aspect-ratio: 1 / 1;
      background: linear-gradient(135deg, #071628 0%, #0d2a44 50%, #091e38 100%);
      display: flex; align-items: center; justify-content: center;
      font-family: var(--display); font-size: 7rem; font-weight: 800;
      color: rgba(0,201,174,0.25);
      position: relative;
      letter-spacing: -0.05em;
      border-bottom: 1px solid var(--border);
    }
    .about-avatar::after {
      content: "";
      position: absolute; inset: 0;
      background: radial-gradient(ellipse 60% 60% at 50% 50%, rgba(0,201,174,0.07) 0%, transparent 70%);
    }
    .about-card-body { padding: 1.75rem; }
    .about-name {
      font-family: var(--body);
      font-size: 1.15rem; font-weight: 800;
      color: var(--white); margin-bottom: 0.25rem;
    }
    .about-title-tag {
      font-size: 0.78rem; color: var(--teal);
      font-weight: 600; margin-bottom: 1.25rem;
    }
    .about-meta { display: flex; flex-direction: column; gap: 0.7rem; margin-bottom: 1.5rem; }
    .about-meta-row {
      display: flex; align-items: center; gap: 0.65rem;
      font-size: 0.8rem; color: var(--slate-light);
    }
    .about-meta-icon { font-size: 0.9rem; flex-shrink: 0; opacity: 0.7; }
    .about-avail {
      display: flex; align-items: center; gap: 0.6rem;
      background: rgba(0,201,174,0.06);
      border: 1px solid rgba(0,201,174,0.2);
      border-radius: 8px; padding: 0.65rem 0.9rem;
      font-size: 0.78rem; color: var(--teal); font-weight: 600;
      margin-bottom: 1.5rem;
    }
    .avail-dot {
      width: 7px; height: 7px; border-radius: 50%; background: var(--teal);
      box-shadow: 0 0 0 2px rgba(0,201,174,0.2);
      animation: blink 2.5s ease-in-out infinite;
      flex-shrink: 0;
    }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }
    .about-social { display: flex; flex-direction: column; gap: 0.5rem; }
    .social-btn {
      display: flex; align-items: center; gap: 0.6rem;
      font-size: 0.8rem; font-weight: 600;
      padding: 0.6rem 0.9rem; border-radius: 8px;
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--border-light);
      color: var(--slate-light); text-decoration: none;
      transition: all var(--transition);
    }
    .social-btn:hover { border-color: var(--teal); color: var(--teal); background: rgba(0,201,174,0.06); }
    .social-btn-icon { font-size: 1rem; }

    /* ─── RIGHT COLUMN ─── */
    .about-right { padding-top: 0.5rem; }
    .about-bio {
      font-size: 1.05rem; color: var(--slate-light);
      line-height: 1.85; margin-bottom: 1.4rem;
    }
    .about-bio strong { color: var(--white); font-weight: 700; }

    /* ─── TIMELINE ─── */
    .section-label {
      font-size: 0.67rem; font-weight: 700; letter-spacing: 0.2em;
      text-transform: uppercase; color: var(--teal);
      display: flex; align-items: center; gap: 0.75rem;
      margin-bottom: 2rem;
    }
    .section-label::before { content: ''; width: 24px; height: 2px; background: var(--teal); flex-shrink: 0; }

    .timeline { position: relative; padding-left: 1.75rem; }
    .timeline::before {
      content: ''; position: absolute; left: 0; top: 10px; bottom: 0;
      width: 1px; background: var(--border-light);
    }
    .tl-item { position: relative; margin-bottom: 2.75rem; }
    .tl-item:last-child { margin-bottom: 0; }
    .tl-dot {
      position: absolute; left: -1.75rem; top: 7px;
      width: 9px; height: 9px; border-radius: 50%;
      background: var(--teal); border: 2px solid var(--navy);
      transform: translateX(-4px);
      box-shadow: 0 0 0 3px rgba(0,201,174,0.15);
    }
    .tl-year {
      font-size: 0.7rem; font-weight: 700; color: var(--teal);
      letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 0.3rem;
    }
    .tl-title {
      font-family: var(--body); font-size: 1.0rem; font-weight: 700;
      color: var(--white); margin-bottom: 0.2rem;
    }
    .tl-company { font-size: 0.82rem; color: var(--slate); margin-bottom: 0.65rem; }
    .tl-desc { font-size: 0.84rem; color: var(--slate-light); line-height: 1.75; }

    /* ─── TWO-COL LAYOUT ─── */
    .about-cols {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 5rem;
      align-items: start;
    }

    /* ─── VALUES GRID ─── */
    .values-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .value-card {
      background: var(--card-bg); border: 1px solid var(--border);
      border-radius: var(--radius-lg); padding: 1.75rem;
      transition: all var(--transition); position: relative; overflow: hidden;
    }
    .value-card::after {
      content: ""; position: absolute; top: 0; left: 0; right: 0; height: 2px;
      background: var(--teal); transform: scaleX(0); transform-origin: left;
      transition: transform var(--transition);
    }
    .value-card:hover { background: var(--card-hover); border-color: var(--border-light); transform: translateY(-3px); }
    .value-card:hover::after { transform: scaleX(1); }
    .value-num {
      font-family: var(--display); font-size: 2.5rem; font-weight: 800;
      color: var(--border-light); line-height: 1; margin-bottom: 1rem;
    }
    .value-title { font-size: 0.9rem; font-weight: 700; color: var(--white); margin-bottom: 0.45rem; }
    .value-text { font-size: 0.82rem; color: var(--slate); line-height: 1.7; }

    /* ─── SKILLS ─── */
    .skills-section {
      background: linear-gradient(180deg, transparent 0%, var(--navy-2) 30%, var(--navy-2) 70%, transparent 100%);
    }
    .skill-cols { display: grid; grid-template-columns: repeat(3,1fr); gap: 3rem; }
    .skill-group { }
    .skill-group-title {
      font-size: 0.67rem; font-weight: 700; letter-spacing: 0.15em;
      text-transform: uppercase; color: var(--slate);
      margin-bottom: 1.25rem; padding-bottom: 0.75rem;
      border-bottom: 1px solid var(--border-light);
    }
    .skill-bars { display: flex; flex-direction: column; gap: 1.1rem; }
    .skill-row { display: flex; flex-direction: column; gap: 0.4rem; }
    .skill-row-top { display: flex; justify-content: space-between; font-size: 0.82rem; }
    .skill-row-label { font-weight: 600; color: var(--slate-light); }
    .skill-row-pct { color: var(--teal); font-weight: 700; font-size: 0.78rem; }
    .skill-track { height: 3px; background: var(--border-light); border-radius: 100px; overflow: hidden; }
    .skill-bar-fill {
      height: 100%;
      background: linear-gradient(to right, var(--teal-dark), var(--teal));
      border-radius: 100px; width: 0;
      transition: width 1.2s cubic-bezier(0.25,0.46,0.45,0.94);
    }
    .skill-bar-fill.anim { width: var(--w); }

    /* ─── TOOLS STRIP ─── */
    .tools-strip {
      display: flex; flex-wrap: wrap; gap: 0.5rem;
      margin-top: 3.5rem; padding-top: 3rem;
      border-top: 1px solid var(--border);
    }
    .tool-tag {
      font-size: 0.73rem; font-weight: 600;
      padding: 0.3rem 0.8rem; border-radius: 100px;
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--border-light);
      color: var(--slate-light);
      transition: all var(--transition);
    }
    .tool-tag:hover { border-color: var(--teal); color: var(--teal); background: rgba(0,201,174,0.06); }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 1100px) {
      .page-hero-inner { grid-template-columns: 300px 1fr; gap: 3rem; }
    }
    @media (max-width: 900px) {
      .page-hero-inner { grid-template-columns: 1fr; }
      .about-card { position: static; max-width: 380px; }
      .about-cols { grid-template-columns: 1fr; gap: 3rem; }
      .skill-cols { grid-template-columns: 1fr; gap: 2rem; }
      .values-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <?php include './includes/nav.php'; ?>

  <div class="page-wrap">

    <!-- ════════════════════════════════
         PAGE HERO
    ═════════════════════════════════ -->
    <section class="page-hero">
      <div class="container">
        <div class="page-hero-inner">

          <!-- Sticky profile card -->
          <div class="about-card reveal">
            <div class="about-avatar">AO</div>
            <div class="about-card-body">
              <div class="about-name">Ahmed Olusesi</div>
              <div class="about-title-tag">Full-Stack Software Developer</div>
              <div class="about-meta">
                <div class="about-meta-row">
                  <span class="about-meta-icon">📍</span>
                  Ikeja, Lagos — Nigeria
                </div>
                <div class="about-meta-row">
                  <span class="about-meta-icon">🎓</span>
                  B.Sc. Electronic &amp; Electrical Eng.
                </div>
                <div class="about-meta-row">
                  <span class="about-meta-icon">💼</span>
                  6+ years professional experience
                </div>
                <div class="about-meta-row">
                  <span class="about-meta-icon">🌍</span>
                  Open to remote — worldwide
                </div>
              </div>
              <div class="about-avail">
                <div class="avail-dot"></div>
                Available for new projects
              </div>
              <div class="about-social">
                <a href="https://linkedin.com/in/ahmedolusesi" target="_blank" rel="noopener" class="social-btn">
                  <span class="social-btn-icon">🔗</span> LinkedIn
                </a>
                <a href="https://github.com/olasesi" target="_blank" rel="noopener" class="social-btn">
                  <span class="social-btn-icon">⌥</span> GitHub — olasesi
                </a>
                <a href="mailto:olusesia@gmail.com" class="social-btn">
                  <span class="social-btn-icon">✉</span> olusesia@gmail.com
                </a>
              </div>
            </div>
          </div>

          <!-- Bio -->
          <div class="about-right">
            <div class="eyebrow reveal" style="margin-bottom:1.5rem;">About Me</div>
            <h1 class="display-lg reveal reveal-d1" style="margin-bottom:2rem;">
              Developer.<br /><span class="teal">Problem solver.</span>
            </h1>
            <p class="about-bio reveal reveal-d2">
              I'm Ahmed — a full-stack software developer based in Lagos who has
              been shipping production software since 2018. I started out writing
              <strong>PHP and jQuery</strong>, and over six years I've grown into
              a developer who thinks in systems: how the frontend talks to the
              API, how the API protects the database, how the whole thing gets
              deployed without breaking in the middle of the night.
            </p>
            <p class="about-bio reveal reveal-d2">
              Today I build across the full stack — <strong>React, Vue, Next.js,
              React Native</strong> on the frontend; <strong>Laravel, Node.js,
              Django</strong> on the backend; <strong>Docker, Kubernetes, AWS</strong>
              in infrastructure. I care about clean architecture, readable
              codebases, and user experiences that feel effortless even when
              there's a lot happening under the hood.
            </p>
            <p class="about-bio reveal reveal-d2">
              My engineering philosophy is simple: <strong>build it properly the
              first time.</strong> That means security you don't have to bolt on
              later, performance you don't have to apologise for, and code the
              next developer can actually read. I don't hand off half-finished
              work — if I've built it, I've thought about how it behaves in
              production.
            </p>
            <p class="about-bio reveal reveal-d2">
              Outside of code, I stay close to the craft — following what's
              happening in the JavaScript and PHP ecosystems, experimenting with
              new tooling, and occasionally helping other developers get past
              blockers. Good software is a team sport, and I take that seriously.
            </p>
          </div>

        </div>
      </div>
    </section>

    <!-- ════════════════════════════════
         EXPERIENCE + VALUES
    ═════════════════════════════════ -->
    <section class="section">
      <div class="container">
        <div class="about-cols">

          <!-- Work timeline -->
          <div>
            <div class="section-label reveal">Work History</div>
            <h2 class="display-md reveal reveal-d1" style="margin-bottom:2.5rem;">
              Where I've shipped
            </h2>
            <div class="timeline">

              <div class="tl-item reveal reveal-d1">
                <div class="tl-dot"></div>
                <div class="tl-year">Sep 2022 – Jan 2024</div>
                <div class="tl-title">Software Developer</div>
                <div class="tl-company">Essentials Limited &nbsp;·&nbsp; Ikeja, Lagos</div>
                <p class="tl-desc">
                  Owned the full development cycle — UI/UX translation to
                  production frontend, backend engineering, and deployment.
                  Integrated third-party APIs, optimised database queries,
                  and hardened API security; reduced average response times
                  and eliminated critical vulnerabilities across the product suite.
                </p>
              </div>

              <div class="tl-item reveal reveal-d2">
                <div class="tl-dot"></div>
                <div class="tl-year">May 2021 – Aug 2022</div>
                <div class="tl-title">Software Developer</div>
                <div class="tl-company">Supreme Web &nbsp;·&nbsp; Lekki, Lagos</div>
                <p class="tl-desc">
                  Led web application customisation and troubleshooting across
                  client projects. Built and maintained production web apps,
                  produced clear installation and handoff documentation, and
                  managed deployments and ongoing maintenance independently.
                </p>
              </div>

              <div class="tl-item reveal reveal-d3">
                <div class="tl-dot"></div>
                <div class="tl-year">Apr 2020 – Feb 2021</div>
                <div class="tl-title">Web Developer</div>
                <div class="tl-company">Duromedia &nbsp;·&nbsp; Ogba, Lagos</div>
                <p class="tl-desc">
                  Spearheaded end-to-end web development — translating designs
                  into responsive applications using React, Vue, and Bootstrap.
                  Handled PHP/Laravel backend development, deployment,
                  troubleshooting, SEO strategy, bespoke WordPress builds,
                  and digital marketing. Also tutored junior team members.
                </p>
              </div>

              <div class="tl-item reveal reveal-d4">
                <div class="tl-dot"></div>
                <div class="tl-year">Sep 2018 – Aug 2019</div>
                <div class="tl-title">Programmer</div>
                <div class="tl-company">Obejor &nbsp;·&nbsp; Ikeja, Lagos</div>
                <p class="tl-desc">
                  Successfully migrated the company's CMS from OpenCart to
                  WordPress/WooCommerce with full data continuity. Managed
                  control panel, Google Analytics, backend and frontend
                  maintenance, SEO strategies, script minification, and
                  digital marketing execution.
                </p>
              </div>

            </div>
          </div>

          <!-- Education + values -->
          <div>
            <div class="section-label reveal">Education</div>
            <h2 class="display-md reveal reveal-d1" style="margin-bottom:2.5rem;">
              Academic background
            </h2>
            <div class="timeline" style="margin-bottom:3.5rem;">
              <div class="tl-item reveal reveal-d1">
                <div class="tl-dot"></div>
                <div class="tl-year">2008 – 2015</div>
                <div class="tl-title">B.Sc. Electronic &amp; Electrical Engineering</div>
                <div class="tl-company">Obafemi Awolowo University &nbsp;·&nbsp; Ile-Ife, Osun State</div>
                <p class="tl-desc">
                  Built a strong foundation in systems thinking, logic, and
                  analytical problem-solving. These principles translate directly
                  into how I approach software architecture, debugging, and
                  technical decision-making — I reason from first principles,
                  not convention alone.
                </p>
              </div>
            </div>

            <div class="section-label reveal">How I Work</div>
            <h2 class="display-md reveal reveal-d1" style="margin-bottom:1.75rem;">
              Core principles
            </h2>
            <div class="values-grid reveal reveal-d1">
              <div class="value-card">
                <div class="value-num">01</div>
                <div class="value-title">Quality before speed</div>
                <p class="value-text">Shortcuts create technical debt. I build things correctly once rather than patching them repeatedly.</p>
              </div>
              <div class="value-card">
                <div class="value-num">02</div>
                <div class="value-title">Own the outcome</div>
                <p class="value-text">If I've built it, I've thought about how it performs in production — not just how it looks on localhost.</p>
              </div>
              <div class="value-card">
                <div class="value-num">03</div>
                <div class="value-title">Communicate clearly</div>
                <p class="value-text">Technical complexity isn't an excuse for vague updates. I keep stakeholders informed and in control.</p>
              </div>
              <div class="value-card">
                <div class="value-num">04</div>
                <div class="value-title">Stay self-directed</div>
                <p class="value-text">I identify blockers early, ask the right questions, and keep the work moving without hand-holding.</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ════════════════════════════════
         SKILLS
    ═════════════════════════════════ -->
    <section class="section skills-section">
      <div class="container">
        <div class="sh">
          <div>
            <div class="eyebrow reveal">Technical Proficiency</div>
            <h2 class="display-md reveal reveal-d1">Across the full stack</h2>
          </div>
          <p class="section-sub reveal reveal-d2">
            Six years across frontend, backend, mobile, and DevOps builds an
            instinct for where complexity lives — and how to manage it cleanly.
          </p>
        </div>

        <div class="skill-cols">

          <div class="skill-group reveal">
            <div class="skill-group-title">Frontend</div>
            <div class="skill-bars">
              <?php
              $frontend = [
                'React / Next.js'             => 95,
                'Vue / Nuxt.js'               => 90,
                'TypeScript'                  => 88,
                'TailwindCSS / Bootstrap / MUI' => 96,
                'SASS / CSS Architecture'     => 92,
              ];
              foreach ($frontend as $name => $pct): ?>
                <div class="skill-row">
                  <div class="skill-row-top">
                    <span class="skill-row-label"><?= htmlspecialchars($name) ?></span>
                    <span class="skill-row-pct"><?= $pct ?>%</span>
                  </div>
                  <div class="skill-track">
                    <div class="skill-bar-fill" style="--w:<?= $pct ?>%"></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="skill-group reveal reveal-d1">
            <div class="skill-group-title">Backend &amp; APIs</div>
            <div class="skill-bars">
              <?php
              $backend = [
                'PHP / Laravel'   => 93,
                'Node.js / Express' => 90,
                'Python / Django' => 82,
                'REST API Design' => 92,
                'GraphQL'         => 85,
              ];
              foreach ($backend as $name => $pct): ?>
                <div class="skill-row">
                  <div class="skill-row-top">
                    <span class="skill-row-label"><?= htmlspecialchars($name) ?></span>
                    <span class="skill-row-pct"><?= $pct ?>%</span>
                  </div>
                  <div class="skill-track">
                    <div class="skill-bar-fill" style="--w:<?= $pct ?>%"></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="skill-group reveal reveal-d2">
            <div class="skill-group-title">Mobile, Data &amp; DevOps</div>
            <div class="skill-bars">
              <?php
              $infra = [
                'React Native / Expo' => 88,
                'MySQL / MongoDB'     => 90,
                'Docker / Kubernetes' => 80,
                'AWS / Heroku / cPanel' => 78,
                'Jenkins / CI/CD'     => 76,
              ];
              foreach ($infra as $name => $pct): ?>
                <div class="skill-row">
                  <div class="skill-row-top">
                    <span class="skill-row-label"><?= htmlspecialchars($name) ?></span>
                    <span class="skill-row-pct"><?= $pct ?>%</span>
                  </div>
                  <div class="skill-track">
                    <div class="skill-bar-fill" style="--w:<?= $pct ?>%"></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

        </div>

        <!-- Tools pill strip -->
        <?php
        $tools = [
          'HTML/CSS','JavaScript','TypeScript',
          'React','Vue','Next.js','Nuxt.js',
          'React Native','Expo',
          'Node.js','Express','PHP','Laravel',
          'Python','Django',
          'REST API','GraphQL',
          'MySQL','MongoDB',
          'Docker','Kubernetes','Jenkins','GitHub Actions',
          'AWS','Heroku','cPanel',
          'Figma','Adobe XD','Photoshop',
          'WordPress','OpenCart',
          'Bootstrap','TailwindCSS','MUI','Ant Design','SASS',
          'Agile / Jira','SEO','Digital Marketing',
        ];
        ?>
        <div class="tools-strip reveal reveal-d2">
          <?php foreach ($tools as $t): ?>
            <span class="tool-tag"><?= htmlspecialchars($t) ?></span>
          <?php endforeach; ?>
        </div>

      </div>
    </section>

  </div><!-- /page-wrap -->

  <?php include './includes/footer.php'; ?>

  <script src="./assets/js/main.js"></script>
  <script>
    // Animate skill bars when each group enters viewport
    const skillObserver = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.querySelectorAll('.skill-bar-fill').forEach(b => b.classList.add('anim'));
          skillObserver.unobserve(e.target);
        }
      });
    }, { threshold: 0.3 });
    document.querySelectorAll('.skill-group').forEach(g => skillObserver.observe(g));
  </script>

</body>
</html>