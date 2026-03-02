<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ahmed Olusesi — Software Developer</title>
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
        position: absolute;
        top: 0;
        right: -3rem;
        bottom: 0;
        width: 50vw;
        background: radial-gradient(
          ellipse 70% 80% at 70% 50%,
          rgba(0, 201, 174, 0.06) 0%,
          transparent 70%
        );
        pointer-events: none;
      }
      .hero-overline {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 2rem;
      }
      .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--teal);
        box-shadow: 0 0 0 3px rgba(0, 201, 174, 0.2);
        animation: blink 2.5s ease-in-out infinite;
      }
      @keyframes blink {
        0%,
        100% {
          opacity: 1;
        }
        50% {
          opacity: 0.4;
        }
      }
      .status-text {
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--teal);
      }
      .hero-title {
        margin-bottom: 1.5rem;
      }
      .hero-title .line-2 {
        color: var(--slate-light);
        font-style: italic;
      }
      .hero-desc {
        font-size: 1.05rem;
        color: var(--slate-light);
        line-height: 1.8;
        max-width: 480px;
        margin-bottom: 2.5rem;
      }
      .hero-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
      }
      .hero-divider {
        height: 24px;
        width: 1px;
        background: var(--border-light);
      }

      /* Hero right: geometric data card */
      .hero-right {
        position: relative;
      }
      .hero-main-card {
        background: var(--navy-2);
        border: 1px solid var(--border-light);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
      }
      .hc-header {
        background: var(--navy-3);
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border-bottom: 1px solid var(--border);
      }
      .hc-dots {
        display: flex;
        gap: 6px;
      }
      .hc-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
      }
      .hc-dot-r {
        background: #ff5f56;
      }
      .hc-dot-y {
        background: #febc2e;
      }
      .hc-dot-g {
        background: #27c93f;
      }
      .hc-title {
        font-size: 0.72rem;
        color: var(--slate);
        font-weight: 500;
        letter-spacing: 0.05em;
        margin-left: auto;
      }
      .hc-body {
        padding: 1.75rem;
      }
      .hc-metric-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1px;
        background: var(--border);
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 1.5rem;
      }
      .hc-metric {
        background: var(--navy-3);
        padding: 1rem;
        text-align: center;
      }
      .hc-metric-num {
        font-family: var(--display);
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--teal);
        line-height: 1;
      }
      .hc-metric-label {
        font-size: 0.65rem;
        color: var(--slate);
        margin-top: 0.25rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
      }
      .hc-skill-row {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
      }
      .hc-skill {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
      }
      .hc-skill-top {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
      }
      .hc-skill-name {
        color: var(--slate-light);
        font-weight: 500;
      }
      .hc-skill-pct {
        color: var(--teal);
        font-weight: 700;
      }
      .hc-bar {
        height: 3px;
        background: var(--border-light);
        border-radius: 100px;
        overflow: hidden;
      }
      .hc-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--teal-dark), var(--teal));
        width: 0;
        transition: width 1.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.5s;
      }
      .hc-fill.go {
        width: var(--w);
      }

      .hero-float {
        position: absolute;
        background: var(--navy-3);
        border: 1px solid var(--border-light);
        border-radius: 12px;
        padding: 0.85rem 1.1rem;
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        gap: 0.7rem;
        font-size: 0.78rem;
      }
      .hero-float-1 {
        top: -18px;
        right: 30px;
        animation: hf1 4s ease-in-out infinite;
      }
      .hero-float-2 {
        bottom: -16px;
        left: 20px;
        animation: hf2 5s ease-in-out infinite;
      }
      @keyframes hf1 {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-7px);
        }
      }
      @keyframes hf2 {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(6px);
        }
      }
      .hf-icon {
        font-size: 1.1rem;
      }
      .hf-label {
        font-weight: 700;
        color: var(--white);
      }
      .hf-sub {
        font-size: 0.68rem;
        color: var(--slate);
      }

      /* STATS BAND */
      .stats-band {
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: 3rem 0;
      }
      .stats-inner {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2px;
      }
      .stat-item {
        padding: 1.5rem 2rem;
        border-right: 1px solid var(--border);
      }
      .stat-item:last-child {
        border-right: none;
      }
      .stat-num {
        font-family: var(--display);
        font-size: 2.8rem;
        font-weight: 800;
        line-height: 1;
        color: var(--white);
      }
      .stat-num .teal {
        font-size: inherit;
      }
      .stat-label {
        font-size: 0.78rem;
        color: var(--slate);
        margin-top: 0.4rem;
        letter-spacing: 0.04em;
      }

      /* EXPERTISE SECTION */
      .expertise-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1px;
        background: var(--border);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
      }
      .expertise-item {
        background: var(--navy);
        padding: 2.5rem 2rem;
        transition: background var(--transition);
        position: relative;
      }
      .expertise-item:hover {
        background: var(--navy-2);
      }
      .expertise-item::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--teal);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform var(--transition);
      }
      .expertise-item:hover::after {
        transform: scaleX(1);
      }
      .exp-number {
        font-family: var(--display);
        font-size: 3rem;
        font-weight: 800;
        color: var(--border-light);
        line-height: 1;
        margin-bottom: 1.25rem;
      }
      .exp-title {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.6rem;
        color: var(--white);
      }
      .exp-desc {
        font-size: 0.83rem;
        color: var(--slate);
        line-height: 1.7;
      }
      .exp-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        margin-top: 1.25rem;
      }

      /* FEATURED PROJECTS */
      .proj-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
      }
      .proj-grid-right {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
      }
      .proj-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: all var(--transition);
        position: relative;
      }
      .proj-card:hover {
        background: var(--card-hover);
        border-color: var(--border-light);
        transform: translateY(-4px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
      }
      .proj-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(
          90deg,
          transparent,
          rgba(255, 255, 255, 0.07),
          transparent
        );
      }
      .proj-visual {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--display);
        font-weight: 800;
        font-size: 3.5rem;
        letter-spacing: -0.05em;
        position: relative;
      }
      .proj-visual-sm {
        height: 110px;
        font-size: 2rem;
      }
      .pv-1 {
        background: linear-gradient(
          135deg,
          #071628 0%,
          #0d2444 50%,
          #0a2238 100%
        );
        color: rgba(0, 201, 174, 0.4);
      }
      .pv-2 {
        background: linear-gradient(135deg, #0d1228 0%, #1a1240 100%);
        color: rgba(130, 100, 255, 0.4);
      }
      .pv-3 {
        background: linear-gradient(135deg, #0a1820 0%, #0d2830 100%);
        color: rgba(0, 180, 200, 0.4);
      }
      .pv-4 {
        background: linear-gradient(135deg, #1a0d14 0%, #280d20 100%);
        color: rgba(220, 80, 140, 0.3);
      }
      .proj-body {
        padding: 1.75rem;
      }
      .proj-body-sm {
        padding: 1.25rem;
      }
      .proj-chips {
        display: flex;
        gap: 0.4rem;
        flex-wrap: wrap;
        margin-bottom: 0.75rem;
      }
      .proj-name {
        font-family: var(--body);
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
      }
      .proj-name-sm {
        font-size: 0.9rem;
      }
      .proj-desc {
        font-size: 0.83rem;
        color: var(--slate);
        line-height: 1.65;
      }
      .proj-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.75rem;
        border-top: 1px solid var(--border);
      }
      .proj-footer-sm {
        padding: 0.75rem 1.25rem;
      }
      .proj-link {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--teal);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: gap var(--transition);
      }
      .proj-link:hover {
        gap: 8px;
      }
      .proj-year {
        font-size: 0.72rem;
        color: var(--slate);
      }

      /* TESTIMONIALS */
      .t-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
      }
      .t-card {
        padding: 2rem;
      }
      .t-quote {
        font-size: 2rem;
        color: var(--teal);
        opacity: 0.5;
        line-height: 1;
        margin-bottom: 1rem;
      }
      .t-text {
        font-size: 0.875rem;
        color: var(--slate-light);
        line-height: 1.8;
        font-style: italic;
        margin-bottom: 1.5rem;
      }
      .t-author {
        display: flex;
        align-items: center;
        gap: 0.75rem;
      }
      .t-av {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.8rem;
      }
      .t-name {
        font-size: 0.85rem;
        font-weight: 700;
      }
      .t-role {
        font-size: 0.72rem;
        color: var(--slate);
      }
      .t-stars {
        color: var(--teal);
        font-size: 0.75rem;
        margin-bottom: 0.75rem;
        letter-spacing: 2px;
      }

      /* CTA SECTION */
      .cta-section {
        background: linear-gradient(
          135deg,
          var(--navy-2) 0%,
          var(--navy-3) 100%
        );
        border: 1px solid var(--border-light);
        border-radius: 20px;
        padding: 5rem 4rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 3rem;
        position: relative;
        overflow: hidden;
      }
      .cta-section::before {
        content: "";
        position: absolute;
        top: -80px;
        right: -80px;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: radial-gradient(
          circle,
          rgba(0, 201, 174, 0.08) 0%,
          transparent 70%
        );
      }
      .cta-section::after {
        content: "";
        position: absolute;
        bottom: -60px;
        left: -60px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: radial-gradient(
          circle,
          rgba(0, 201, 174, 0.05) 0%,
          transparent 70%
        );
      }
      .cta-left {
        position: relative;
        z-index: 1;
      }
      .cta-title {
        margin-bottom: 0.75rem;
      }
      .cta-sub {
        font-size: 0.95rem;
        color: var(--slate-light);
        line-height: 1.7;
        max-width: 400px;
      }
      .cta-right {
        display: flex;
        gap: 1rem;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
      }

      @media (max-width: 960px) {
        .hero {
          grid-template-columns: 1fr;
          min-height: auto;
          padding: 3rem 0 4rem;
        }
        .hero-right {
          display: none;
        }
        .stats-inner {
          grid-template-columns: 1fr 1fr;
        }
        .stat-item {
          border-right: none;
          border-bottom: 1px solid var(--border);
        }
        .stat-item:nth-child(odd) {
          border-right: 1px solid var(--border);
        }
        .expertise-grid {
          grid-template-columns: 1fr;
        }
        .proj-grid {
          grid-template-columns: 1fr;
        }
        .t-grid {
          grid-template-columns: 1fr;
        }
        .cta-section {
          flex-direction: column;
          text-align: center;
        }
        .cta-sub {
          max-width: 100%;
        }
        .cta-right {
          flex-wrap: wrap;
          justify-content: center;
        }
      }
    </style>
  </head>
  <body>
    <nav class="nav">
      <div class="nav-bar">
        <a href="index.php" class="nav-logo">
          <div class="logo-mark">AO</div>
          Ahmed Olusesi
        </a>
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="portfolio.php">Portfolio</a></li>
          <li><a href="blog.php">Insights</a></li>
          <li><a href="contact.php" class="nav-cta">Engage</a></li>
        </ul>
        <button class="nav-mobile-btn">
          <span></span><span></span><span></span>
        </button>
      </div>
    </nav>

    <div class="page-wrap">
      <!-- HERO -->
      <section class="section">
        <div class="container">
          <div class="hero">
            <div>
              <div class="hero-overline">
                <div class="status-dot"></div>
                <span class="status-text"
                  >Available for Senior Roles & Consulting</span
                >
              </div>
              <h1 class="display-xl hero-title reveal">
                Principal<br />
                <span class="line-2">Software</span><br />
                Engineer
              </h1>
              <p class="hero-desc reveal reveal-d1">
                15+ years engineering distributed systems at scale. I've built
                infrastructure that processes billions of transactions, led
                cross-functional teams of 30+, and shipped open-source tools
                trusted by 50,000 developers.
              </p>
              <div class="hero-actions reveal reveal-d2">
                <a href="portfolio.php" class="btn btn-primary btn-lg">
                  View Portfolio
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                  >
                    <path d="M5 12h14M12 5l7 7-7 7" />
                  </svg>
                </a>
                <div class="hero-divider"></div>
                <a href="about.php" class="btn btn-ghost btn-lg"
                  >My Background</a
                >
              </div>
            </div>

            <!-- RIGHT CARD -->
            <div class="hero-right reveal reveal-d2">
              <div class="hero-float hero-float-1">
                <div class="hf-icon">⚡</div>
                <div>
                  <div class="hf-label">99.99% Uptime</div>
                  <div class="hf-sub">Production systems</div>
                </div>
              </div>
              <div class="hero-main-card">
                <div class="hc-header">
                  <div class="hc-dots">
                    <div class="hc-dot hc-dot-r"></div>
                    <div class="hc-dot hc-dot-y"></div>
                    <div class="hc-dot hc-dot-g"></div>
                  </div>
                  <div class="hc-title">system.profile</div>
                </div>
                <div class="hc-body">
                  <div class="hc-metric-row">
                    <div class="hc-metric">
                      <div class="hc-metric-num">15+</div>
                      <div class="hc-metric-label">Years</div>
                    </div>
                    <div class="hc-metric">
                      <div class="hc-metric-num">80+</div>
                      <div class="hc-metric-label">Projects</div>
                    </div>
                    <div class="hc-metric">
                      <div class="hc-metric-num">34k</div>
                      <div class="hc-metric-label">OSS Stars</div>
                    </div>
                  </div>
                  <div class="hc-skill-row">
                    <div class="hc-skill">
                      <div class="hc-skill-top">
                        <span class="hc-skill-name">System Architecture</span
                        ><span class="hc-skill-pct">97%</span>
                      </div>
                      <div class="hc-bar">
                        <div class="hc-fill" style="--w: 97%"></div>
                      </div>
                    </div>
                    <div class="hc-skill">
                      <div class="hc-skill-top">
                        <span class="hc-skill-name">Cloud Infrastructure</span
                        ><span class="hc-skill-pct">94%</span>
                      </div>
                      <div class="hc-bar">
                        <div class="hc-fill" style="--w: 94%"></div>
                      </div>
                    </div>
                    <div class="hc-skill">
                      <div class="hc-skill-top">
                        <span class="hc-skill-name">Backend Engineering</span
                        ><span class="hc-skill-pct">96%</span>
                      </div>
                      <div class="hc-bar">
                        <div class="hc-fill" style="--w: 96%"></div>
                      </div>
                    </div>
                    <div class="hc-skill">
                      <div class="hc-skill-top">
                        <span class="hc-skill-name">Technical Leadership</span
                        ><span class="hc-skill-pct">90%</span>
                      </div>
                      <div class="hc-bar">
                        <div class="hc-fill" style="--w: 90%"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="hero-float hero-float-2">
                <div class="hf-icon">🚀</div>
                <div>
                  <div class="hf-label">Just shipped v3.0</div>
                  <div class="hf-sub">Forge CLI — 18k stars</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- STATS BAND -->
      <div class="stats-band">
        <div class="container">
          <div class="stats-inner">
            <div class="stat-item reveal">
              <div class="stat-num">
                <span class="teal" data-target="12" data-suffix="+">0+</span>
              </div>
              <div class="stat-label">
                Years of production engineering experience
              </div>
            </div>
            <div class="stat-item reveal reveal-d1">
              <div class="stat-num">
                <span class="teal" data-target="80" data-suffix="+">0+</span>
              </div>
              <div class="stat-label">
                Enterprise & startup projects delivered
              </div>
            </div>
            <div class="stat-item reveal reveal-d2">
              <div class="stat-num">
                <span class="teal" data-target="34" data-suffix="k">0k</span>
              </div>
              <div class="stat-label">
                GitHub stars across open-source projects
              </div>
            </div>
            <div class="stat-item reveal reveal-d3">
              <div class="stat-num">
                <span class="teal" data-target="5" data-suffix="B+">0B+</span>
              </div>
              <div class="stat-label">
                Transactions processed through built systems
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- EXPERTISE -->
      <section class="section">
        <div class="container">
          <div class="sh">
            <div>
              <div class="eyebrow reveal">Core Expertise</div>
              <h2 class="display-md reveal reveal-d1">
                Engineering at every layer
              </h2>
            </div>
            <p class="section-sub reveal reveal-d2">
              From bare-metal performance tuning to executive technical strategy
              — I operate across the full engineering spectrum.
            </p>
          </div>
          <div class="expertise-grid">
            <div class="expertise-item reveal">
              <div class="exp-number">01</div>
              <div class="exp-title">Distributed Systems Architecture</div>
              <p class="exp-desc">
                Designing fault-tolerant, highly available systems. CAP theorem
                trade-offs, consensus protocols, event sourcing, and CQRS
                patterns applied at scale.
              </p>
              <div class="exp-tags">
                <span class="chip">Kafka</span><span class="chip">gRPC</span
                ><span class="chip">Raft</span><span class="chip">CQRS</span>
              </div>
            </div>
            <div class="expertise-item reveal reveal-d1">
              <div class="exp-number">02</div>
              <div class="exp-title">
                Cloud Infrastructure & Platform Engineering
              </div>
              <p class="exp-desc">
                Multi-region Kubernetes deployments, IaC with Terraform, GitOps
                workflows, and zero-downtime release strategies for
                mission-critical services.
              </p>
              <div class="exp-tags">
                <span class="chip">AWS</span><span class="chip">K8s</span
                ><span class="chip">Terraform</span
                ><span class="chip">ArgoCD</span>
              </div>
            </div>
            <div class="expertise-item reveal reveal-d2">
              <div class="exp-number">03</div>
              <div class="exp-title">Performance & Reliability Engineering</div>
              <p class="exp-desc">
                Profiling, bottleneck analysis, load testing, and SLO/SLA
                design. Building systems that stay reliable when everything else
                fails.
              </p>
              <div class="exp-tags">
                <span class="chip">Go</span><span class="chip">Rust</span
                ><span class="chip">eBPF</span
                ><span class="chip">Prometheus</span>
              </div>
            </div>
            <div class="expertise-item reveal">
              <div class="exp-number">04</div>
              <div class="exp-title">Full-Stack Product Development</div>
              <p class="exp-desc">
                End-to-end product engineering from API design to pixel-perfect
                UIs. Type-safe, component-driven, accessible interfaces at
                production quality.
              </p>
              <div class="exp-tags">
                <span class="chip">React</span
                ><span class="chip">TypeScript</span
                ><span class="chip">GraphQL</span
                ><span class="chip">Next.js</span>
              </div>
            </div>
            <div class="expertise-item reveal reveal-d1">
              <div class="exp-number">05</div>
              <div class="exp-title">Data Engineering & ML Integration</div>
              <p class="exp-desc">
                Streaming pipelines, data warehousing, feature stores, and
                integrating ML models into production systems with robust
                monitoring and rollback.
              </p>
              <div class="exp-tags">
                <span class="chip">Spark</span><span class="chip">Airflow</span
                ><span class="chip">dbt</span
                ><span class="chip">TensorFlow</span>
              </div>
            </div>
            <div class="expertise-item reveal reveal-d2">
              <div class="exp-number">06</div>
              <div class="exp-title">Technical Leadership & Strategy</div>
              <p class="exp-desc">
                Engineering org design, technical roadmaps, hiring, mentorship,
                and bridging the gap between executive vision and engineering
                execution.
              </p>
              <div class="exp-tags">
                <span class="chip">Staff Eng</span
                ><span class="chip">RFC Culture</span
                ><span class="chip">OKRs</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- FEATURED PROJECTS -->
      <section class="section" style="padding-top: 0">
        <div class="container">
          <div class="sh">
            <div>
              <div class="eyebrow reveal">Selected Work</div>
              <h2 class="display-md reveal reveal-d1">Featured projects</h2>
            </div>
            <a href="portfolio.php" class="btn btn-ghost reveal reveal-d2"
              >Full Portfolio →</a
            >
          </div>
          <div class="proj-grid">
            <div class="proj-card reveal">
              <div class="proj-visual pv-1">NEXUS</div>
              <div class="proj-body">
                <div class="proj-chips">
                  <span class="chip">Go</span
                  ><span class="chip">Kubernetes</span
                  ><span class="chip">Kafka</span
                  ><span class="chip">PostgreSQL</span>
                </div>
                <div class="proj-name">Nexus Data Platform</div>
                <p class="proj-desc">
                  Enterprise-grade data orchestration handling 2M+
                  events/second. Built for a Fortune 100 client requiring
                  sub-10ms P99 latency and 99.99% SLA guarantees. Complete
                  zero-downtime migration from a legacy batch architecture.
                </p>
              </div>
              <div class="proj-footer">
                <span class="proj-year">2025 · Enterprise</span>
                <a href="portfolio.php" class="proj-link">Case Study →</a>
              </div>
            </div>
            <div class="proj-grid-right">
              <div class="proj-card reveal reveal-d1">
                <div class="proj-visual pv-2 proj-visual-sm">ARIA</div>
                <div class="proj-body proj-body-sm">
                  <div class="proj-chips">
                    <span class="chip">Python</span
                    ><span class="chip">TensorFlow</span
                    ><span class="chip">AWS</span>
                  </div>
                  <div class="proj-name proj-name-sm">Aria AI Engine</div>
                  <p class="proj-desc" style="font-size: 0.78rem">
                    ML recommendation system — 42% CTR lift, 5M daily users.
                  </p>
                </div>
                <div class="proj-footer proj-footer-sm">
                  <span class="proj-year">2024</span>
                  <a href="portfolio.php" class="proj-link">View →</a>
                </div>
              </div>
              <div class="proj-card reveal reveal-d2">
                <div class="proj-visual pv-3 proj-visual-sm">FORGE</div>
                <div class="proj-body proj-body-sm">
                  <div class="proj-chips">
                    <span class="chip">Rust</span><span class="chip">WASM</span>
                  </div>
                  <div class="proj-name proj-name-sm">Forge CLI Toolkit</div>
                  <p class="proj-desc" style="font-size: 0.78rem">
                    OSS developer toolkit — 18k GitHub stars, Best Tool 2024.
                  </p>
                </div>
                <div class="proj-footer proj-footer-sm">
                  <span class="proj-year">2024 · Open Source</span>
                  <a href="portfolio.php" class="proj-link">View →</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- TESTIMONIALS -->
      <section
        class="section"
        style="
          background: linear-gradient(
            180deg,
            transparent 0%,
            var(--navy-2) 50%,
            transparent 100%
          );
          padding-top: 0;
        "
      >
        <div class="container">
          <div class="sh">
            <div>
              <div class="eyebrow reveal">Testimonials</div>
              <h2 class="display-md reveal reveal-d1">
                Executive endorsements
              </h2>
            </div>
          </div>
          <div class="t-grid">
            <div class="glass-card t-card reveal">
              <div class="t-stars">★★★★★</div>
              <div class="t-quote">"</div>
              <p class="t-text">
                Alex architected our payments infrastructure from the ground up.
                The system has processed $2B+ with zero critical incidents. An
                exceptionally rare combination of deep technical skill and
                strategic thinking.
              </p>
              <div class="t-author">
                <div
                  class="t-av"
                  style="background: linear-gradient(135deg, #00c9ae, #0082b0)"
                >
                  JK
                </div>
                <div>
                  <div class="t-name">James Kim</div>
                  <div class="t-role">CTO · Series C Fintech</div>
                </div>
              </div>
            </div>
            <div class="glass-card t-card reveal reveal-d1">
              <div class="t-stars">★★★★★</div>
              <div class="t-quote">"</div>
              <p class="t-text">
                One of the best engineers I've ever worked with. Alex led the
                microservices migration of our monolith with zero downtime and
                left us with systems that scaled 10x. The team grew under his
                leadership too.
              </p>
              <div class="t-author">
                <div
                  class="t-av"
                  style="background: linear-gradient(135deg, #6b21a8, #9a3412)"
                >
                  SR
                </div>
                <div>
                  <div class="t-name">Sarah Rodriguez</div>
                  <div class="t-role">VP Engineering · SaaS Platform</div>
                </div>
              </div>
            </div>
            <div class="glass-card t-card reveal reveal-d2">
              <div class="t-stars">★★★★★</div>
              <div class="t-quote">"</div>
              <p class="t-text">
                Forge CLI became the industry standard for our team of 200
                engineers. Alex didn't just write great code — he thought
                through the developer experience at every level. That's rare.
              </p>
              <div class="t-author">
                <div
                  class="t-av"
                  style="background: linear-gradient(135deg, #065f46, #0a4a6e)"
                >
                  MP
                </div>
                <div>
                  <div class="t-name">Michael Park</div>
                  <div class="t-role">Engineering Director · DevTools Co.</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- CTA -->
      <section class="section-sm">
        <div class="container">
          <div class="cta-section reveal">
            <div class="cta-left">
              <div class="eyebrow" style="margin-bottom: 1rem">
                Ready to work together?
              </div>
              <h2 class="display-md cta-title">
                Let's solve hard<br />problems at scale.
              </h2>
              <p class="cta-sub">
                I'm selectively taking on senior consulting roles, advisory
                positions, and fractional CTO engagements for 2026.
              </p>
            </div>
            <div class="cta-right">
              <a href="contact.php" class="btn btn-primary btn-lg"
                >Start a Conversation →</a
              >
              <a href="portfolio.php" class="btn btn-ghost btn-lg"
                >View My Work</a
              >
            </div>
          </div>
        </div>
      </section>
    </div>

    <footer>
      <div class="footer-inner">
        <div class="footer-top">
          <div class="footer-brand">
            <a href="index.php" class="footer-logo"
              ><div class="logo-mark">AO</div>
              Ahmed Olusesi</a
            >
            <p class="footer-brand-desc">
              Principal Software Engineer specializing in distributed systems,
              cloud infrastructure, and engineering leadership.
            </p>
          </div>
          <div class="footer-col">
            <h4>Navigation</h4>
            <div class="footer-col-links">
              <a href="index.php">Home</a
              ><a href="about.php">About</a
              ><a href="portfolio.php">Portfolio</a
              ><a href="blog.php">Insights</a
              ><a href="contact.php">Contact</a>
            </div>
          </div>
          <div class="footer-col">
            <h4>Connect</h4>
            <div class="footer-col-links">
              <a href="#">GitHub</a><a href="#">LinkedIn</a
              ><a href="#">Twitter</a><a href="#">Dev.to</a>
            </div>
          </div>
          <div class="footer-col">
            <h4>Services</h4>
            <div class="footer-col-links">
              <a href="#">Architecture Review</a><a href="#">CTO Advisory</a
              ><a href="#">Engineering Consulting</a><a href="#">Code Audit</a>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <a href="index.php" class="footer-logo" style="font-size: 0.85rem"
            ><div
              class="logo-mark"
              style="width: 24px; height: 24px; font-size: 0.6rem"
            >
              AM
            </div>
            Ahmed Olusesi</a
          >
          <p>© 2026 Ahmed Olusesi. All rights reserved.</p>
        </div>
      </div>
    </footer>

    <script src="./assets/js/main.js"></script>
    <script>
      // Animate skill bars in hero card
      const io = new IntersectionObserver(
        (entries) => {
          entries.forEach((e) => {
            if (e.isIntersecting)
              e.target
                .querySelectorAll(".hc-fill")
                .forEach((f) => f.classList.add("go"));
          });
        },
        { threshold: 0.5 }
      );
      document.querySelector(".hero-main-card") &&
        io.observe(document.querySelector(".hero-main-card"));
    </script>
  </body>
    </html>
