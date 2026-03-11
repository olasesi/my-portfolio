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

  <?php include './includes/nav.php'; ?>

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
              Eight projects across enterprise systems, full-stack web apps,
              mobile, e-commerce, and CMS — each one shipped and in use.
            </p>
          </div>
          <div class="ph-stats reveal reveal-d2">
            <div class="ph-stat">
              <div class="ph-stat-num">8</div>
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

          <div class="proj-row" data-cat="fullstack backend" onclick="openPanel('nexaerp')">
            <div class="proj-num">01</div>
            <div class="proj-info">
              <div class="proj-meta">
                <span class="proj-cat">Full-Stack · Enterprise</span>
                <span class="proj-year-sm">2024</span>
              </div>
              <div class="proj-name-row">NexaERP — Enterprise Resource Planning Platform</div>
              <div class="proj-tags-row">
                <span class="proj-ptag">React</span><span class="proj-ptag">Laravel</span>
                <span class="proj-ptag">MySQL</span><span class="proj-ptag">Docker</span>
                <span class="proj-ptag">AWS</span>
              </div>
            </div>
            <div class="proj-right">
              <div class="proj-result">Multi-tenant · 5 permission levels</div>
              <span class="proj-cta">Case Study →</span>
            </div>
          </div>

          <div class="proj-row" data-cat="fullstack backend" onclick="openPanel('pulsecrm')">
            <div class="proj-num">02</div>
            <div class="proj-info">
              <div class="proj-meta">
                <span class="proj-cat">Full-Stack · SaaS CRM</span>
                <span class="proj-year-sm">2023</span>
              </div>
              <div class="proj-name-row">PulseCRM — Sales &amp; Customer Management Platform</div>
              <div class="proj-tags-row">
                <span class="proj-ptag">Vue</span><span class="proj-ptag">Node.js</span>
                <span class="proj-ptag">MongoDB</span><span class="proj-ptag">GraphQL</span>
              </div>
            </div>
            <div class="proj-right">
              <div class="proj-result">40-person sales team · Daily use</div>
              <span class="proj-cta">Case Study →</span>
            </div>
          </div>

          <div class="proj-row" data-cat="mobile backend" onclick="openPanel('trackr')">
            <div class="proj-num">03</div>
            <div class="proj-info">
              <div class="proj-meta">
                <span class="proj-cat">Mobile · Field Ops</span>
                <span class="proj-year-sm">2023</span>
              </div>
              <div class="proj-name-row">Trackr — Field Operations Mobile App</div>
              <div class="proj-tags-row">
                <span class="proj-ptag">React Native</span><span class="proj-ptag">Expo</span>
                <span class="proj-ptag">Node.js</span><span class="proj-ptag">MySQL</span>
              </div>
            </div>
            <div class="proj-right">
              <div class="proj-result">iOS &amp; Android · Offline-first</div>
              <span class="proj-cta">Case Study →</span>
            </div>
          </div>

          <div class="proj-row" data-cat="fullstack" onclick="openPanel('victruth')">
            <div class="proj-num">04</div>
            <div class="proj-info">
              <div class="proj-meta">
                <span class="proj-cat">Full-Stack · Services Platform</span>
                <span class="proj-year-sm">2023</span>
              </div>
              <div class="proj-name-row">Victruth — Limousine, Events &amp; Vendor Services</div>
              <div class="proj-tags-row">
                <span class="proj-ptag">React</span><span class="proj-ptag">Laravel</span>
                <span class="proj-ptag">Sanctum API</span><span class="proj-ptag">MySQL</span>
              </div>
            </div>
            <div class="proj-right">
              <div class="proj-result">victruth.com · Live</div>
              <span class="proj-cta">Case Study →</span>
            </div>
          </div>

          <div class="proj-row" data-cat="fullstack backend" onclick="openPanel('schoolportal')">
            <div class="proj-num">05</div>
            <div class="proj-info">
              <div class="proj-meta">
                <span class="proj-cat">Full-Stack · Education</span>
                <span class="proj-year-sm">2022</span>
              </div>
              <div class="proj-name-row">School Portal — Combined Primary &amp; Secondary School System</div>
              <div class="proj-tags-row">
                <span class="proj-ptag">PHP</span><span class="proj-ptag">MySQL</span>
                <span class="proj-ptag">Bootstrap</span><span class="proj-ptag">jQuery</span>
              </div>
            </div>
            <div class="proj-right">
              <div class="proj-result">4 user roles · Admission to results</div>
              <span class="proj-cta">Case Study →</span>
            </div>
          </div>

          <div class="proj-row" data-cat="frontend" onclick="openPanel('socialmedia')">
            <div class="proj-num">06</div>
            <div class="proj-info">
              <div class="proj-meta">
                <span class="proj-cat">Frontend · Social</span>
                <span class="proj-year-sm">2022</span>
              </div>
              <div class="proj-name-row">Social Media UI — Full Frontend Implementation</div>
              <div class="proj-tags-row">
                <span class="proj-ptag">React</span><span class="proj-ptag">TailwindCSS</span>
                <span class="proj-ptag">TypeScript</span>
              </div>
            </div>
            <div class="proj-right">
              <div class="proj-result">Pixel-perfect · Fully responsive</div>
              <span class="proj-cta">Case Study →</span>
            </div>
          </div>

          <div class="proj-row" data-cat="ecommerce backend" onclick="openPanel('businesslisting')">
            <div class="proj-num">07</div>
            <div class="proj-info">
              <div class="proj-meta">
                <span class="proj-cat">Backend · Business Listing</span>
                <span class="proj-year-sm">2021</span>
              </div>
              <div class="proj-name-row">Business Listing — Search &amp; Discovery Platform</div>
              <div class="proj-tags-row">
                <span class="proj-ptag">PHP</span><span class="proj-ptag">MySQL</span>
                <span class="proj-ptag">AJAX/jQuery</span><span class="proj-ptag">Bootstrap</span>
              </div>
            </div>
            <div class="proj-right">
              <div class="proj-result">Live search · Rating system</div>
              <span class="proj-cta">Case Study →</span>
            </div>
          </div>

          <div class="proj-row" data-cat="ecommerce" onclick="openPanel('ecommerce')">
            <div class="proj-num">08</div>
            <div class="proj-info">
              <div class="proj-meta">
                <span class="proj-cat">E-Commerce · PHP</span>
                <span class="proj-year-sm">2019–2021</span>
              </div>
              <div class="proj-name-row">E-Commerce Suite — 3 Variants with Dashboard &amp; Payments</div>
              <div class="proj-tags-row">
                <span class="proj-ptag">PHP</span><span class="proj-ptag">MySQL</span>
                <span class="proj-ptag">Payment API</span><span class="proj-ptag">WordPress</span>
              </div>
            </div>
            <div class="proj-right">
              <div class="proj-result">3 live stores · Upsell &amp; cross-sell</div>
              <span class="proj-cta">Case Study →</span>
            </div>
          </div>

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

  <?php include './includes/footer.php'; ?>

  <script src="./assets/js/main.js"></script>
  <script>
  const data = {
    nexaerp: {
      cat: 'Full-Stack · Enterprise · 2024',
      title: 'NexaERP — Enterprise Resource Planning',
      overview: 'A multi-tenant ERP system built for mid-size businesses to manage inventory, procurement, HR, payroll, and financial reporting in one platform. Five granular permission levels with separate dashboards per role.',
      challenge: 'The client was running five disconnected spreadsheet-based systems with no single source of truth. HR, inventory, and finance had no shared data layer, leading to hours of manual reconciliation every week.',
      solution: 'Built a Laravel REST API backend with MySQL and a React frontend using a component library. Docker containerisation with a Jenkins CI/CD pipeline deploying to AWS EC2. Role-based access control (RBAC) with Laravel Sanctum. A React Native mobile companion app consumes the same API.',
      tech: ['React', 'Laravel', 'MySQL', 'Docker', 'AWS EC2', 'Jenkins', 'Laravel Sanctum', 'React Native'],
      metrics: [{v:'5',l:'Permission Levels'},{v:'Multi-tenant',l:'Architecture'},{v:'REST API',l:'Mobile-ready'}],
      link: null
    },
    pulsecrm: {
      cat: 'Full-Stack · SaaS CRM · 2023',
      title: 'PulseCRM — Sales & Customer Platform',
      overview: 'A full CRM platform for a 40-person sales team covering pipeline management, contact tracking, automated follow-up sequences, activity logging, and analytics dashboards.',
      challenge: 'The sales team was managing deals in a mix of spreadsheets and WhatsApp threads. No visibility on pipeline health, no way to automate follow-ups, and no reporting for management.',
      solution: 'Vue 3 frontend consuming a Node/Express GraphQL API backed by MongoDB. Real-time activity feeds via GraphQL subscriptions. Automated email follow-up sequences with configurable delay triggers. Dashboard analytics with chart.js. Deployed on AWS with PM2.',
      tech: ['Vue 3', 'Node.js', 'Express', 'MongoDB', 'GraphQL', 'AWS', 'PM2'],
      metrics: [{v:'40',l:'Sales Users'},{v:'GraphQL',l:'Real-time API'},{v:'Automated',l:'Follow-ups'}],
      link: null
    },
    trackr: {
      cat: 'Mobile · Field Operations · 2023',
      title: 'Trackr — Field Operations App',
      overview: 'A cross-platform iOS and Android app for managing field teams — task assignment, GPS check-ins, photo uploads, status updates, and offline-first report submission synced when connectivity returns.',
      challenge: 'Field teams were operating in areas with unreliable internet. Reports were being lost, GPS check-ins were impossible mid-task, and managers had no real-time visibility.',
      solution: 'React Native with Expo for the cross-platform client. Offline-first architecture using AsyncStorage with a background sync queue that pushes to a Node.js/MySQL REST API when connectivity returns. Push notifications via Expo Notifications. Published to both App Store and Google Play.',
      tech: ['React Native', 'Expo', 'Node.js', 'MySQL', 'AsyncStorage', 'Expo Notifications'],
      metrics: [{v:'iOS+Android',l:'Both Stores'},{v:'Offline-first',l:'Architecture'},{v:'GPS+Photo',l:'Check-ins'}],
      link: null
    },
    victruth: {
      cat: 'Full-Stack · Services Platform · 2023',
      title: 'Victruth — Limousine, Events & Vendor Services',
      overview: 'A full-service booking and vendor management platform for limousine hire, event planning, and vendor services. Multi-role system with customer, vendor, and admin portals.',
      challenge: 'The business was managing bookings via phone and WhatsApp, with no way for vendors to self-manage their listings, no payment collection, and no visibility on booking status.',
      solution: 'React frontend backed by a Laravel API secured with Laravel Sanctum. Payment gateway integration, lazy loading, email notifications, and SEO implementation. Vendor and admin dashboards with booking management, analytics, and content controls.',
      tech: ['React', 'Laravel', 'Laravel Sanctum', 'MySQL', 'Payment Gateway', 'SEO'],
      metrics: [{v:'3 Roles',l:'Customer/Vendor/Admin'},{v:'Live',l:'victruth.com'},{v:'Payments',l:'Integrated'}],
      link: 'https://victruth.com'
    },
    schoolportal: {
      cat: 'Full-Stack · Education · 2022',
      title: 'School Portal — Combined School Management',
      overview: 'A comprehensive school management system for combined primary and secondary schools — handling admissions, fee management, assignments, results, timetabling, and secure login for all user roles.',
      challenge: 'All school records were paper-based. Admission processes were manual, fees were tracked in ledgers, and parents had no visibility on their children\'s academic progress.',
      solution: 'Custom PHP application with a MySQL database. Four distinct role portals: school owner, administrator, teacher, and student. Admission workflow, fee collection tracking, assignment submission, and result generation. Hosted on cPanel with optimised queries for concurrent access.',
      tech: ['PHP', 'MySQL', 'Bootstrap', 'jQuery', 'cPanel'],
      metrics: [{v:'4 Roles',l:'Owner/Admin/Teacher/Student'},{v:'Live',l:'schoolportal.victruth.com'},{v:'Full',l:'Admission to Results'}],
      link: 'https://schoolportal.victruth.com'
    },
    socialmedia: {
      cat: 'Frontend · Social Platform · 2022',
      title: 'Social Media UI — Full Frontend Implementation',
      overview: 'Complete frontend implementation of a social media platform — feed, profiles, stories, messaging UI, notifications, and explore pages. Pixel-perfect, responsive, and animated throughout.',
      challenge: 'Translating a complex, multi-page Figma design into production React code while maintaining design fidelity, responsive behaviour across all breakpoints, and smooth interactions.',
      solution: 'React with TailwindCSS for styling, TypeScript for type safety, and a component architecture that mirrors the Figma component library. Custom hooks for feed and notification state. Smooth transitions using CSS and Framer-style patterns.',
      tech: ['React', 'TypeScript', 'TailwindCSS'],
      metrics: [{v:'Pixel-perfect',l:'Figma to code'},{v:'Fully',l:'Responsive'},{v:'Live',l:'socialmedia.victruth.com'}],
      link: 'https://socialmedia.victruth.com'
    },
    businesslisting: {
      cat: 'Backend · Business Directory · 2021',
      title: 'Business Listing — Search & Discovery Platform',
      overview: 'A business directory platform allowing businesses to list products and services, and users to search, rate, and share listings. AJAX-powered live search with no page reloads.',
      challenge: 'Needed fast, accurate search across thousands of listings without full page reloads, plus a rating and social sharing system that worked across devices.',
      solution: 'PHP backend with MySQL and optimised full-text search indexes. AJAX/jQuery for real-time search-as-you-type. Star rating system with vote aggregation. Product/service repost and share functionality integrated with social platforms.',
      tech: ['PHP', 'MySQL', 'AJAX', 'jQuery', 'Bootstrap'],
      metrics: [{v:'Live search',l:'AJAX-powered'},{v:'Star ratings',l:'Aggregated'},{v:'Live',l:'businesslisting.victruth.com'}],
      link: 'https://businesslisting.victruth.com'
    },
    ecommerce: {
      cat: 'E-Commerce · PHP · 2019–2021',
      title: 'E-Commerce Suite — 3 Variants',
      overview: 'Three distinct PHP e-commerce stores, each with a custom admin dashboard, product management, stock tracking, payment API integration, and automated social sharing on new listings.',
      challenge: 'Needed three independent storefronts with different product catalogues and branding but shared infrastructure — with upsell/cross-sell logic and automatic Facebook sharing to drive organic reach.',
      solution: 'Custom PHP with MySQL, shared codebase with per-store configuration. Payment gateway API integration with webhook handling. Automatic Facebook Graph API posting on new product publish. Upsell and cross-sell product relationship engine. Also handled an OpenCart to WooCommerce data migration for a client, preserving all SEO, Google Analytics, and Facebook Pixel continuity.',
      tech: ['PHP', 'MySQL', 'Payment API', 'WordPress', 'WooCommerce', 'OpenCart', 'Facebook API'],
      metrics: [{v:'3',l:'Live Stores'},{v:'Upsell/X-sell',l:'Engine'},{v:'Auto FB',l:'Sharing'}],
      link: 'https://basicecommerce1.victruth.com'
    }
  };

  function openPanel(id) {
    const d = data[id];
    if (!d) return;
    document.getElementById('sp-cat').textContent = d.cat;
    document.getElementById('sp-title').textContent = d.title;
    document.getElementById('sp-body').innerHTML = `
      <div class="sp-section">
        <div class="sp-section-title">Project Overview</div>
        <p class="sp-text">${d.overview}</p>
      </div>
      <div class="sp-section">
        <div class="sp-section-title">The Challenge</div>
        <p class="sp-text">${d.challenge}</p>
      </div>
      <div class="sp-section">
        <div class="sp-section-title">The Approach</div>
        <p class="sp-text">${d.solution}</p>
      </div>
      <div class="sp-metrics">
        ${d.metrics.map(m => `<div class="sp-metric"><div class="sp-metric-val">${m.v}</div><div class="sp-metric-label">${m.l}</div></div>`).join('')}
      </div>
      <div class="sp-section" style="margin-top:1.75rem;">
        <div class="sp-section-title">Tech Stack</div>
        <div class="sp-tech-list">${d.tech.map(t => `<span class="sp-tech">${t}</span>`).join('')}</div>
      </div>
      ${d.link ? `<div class="sp-section"><div class="sp-section-title">Live Project</div><a href="${d.link}" target="_blank" rel="noopener" class="sp-link">Visit Site →</a></div>` : ''}
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