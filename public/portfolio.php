<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portfolio — Alex Morgan</title>
<link rel="stylesheet" href="corp-style.css">
<style>
.port-hero { background:var(--navy); padding:6rem 0 5rem; position:relative; overflow:hidden; }
.port-hero-bg { position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.025) 1px,transparent 1px);background-size:60px 60px; }
.port-hero-inner { max-width:1320px;margin:0 auto;padding:0 3rem;position:relative;z-index:2;display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:end; }
.ph-title { font-family:var(--display);font-size:clamp(3rem,5vw,4.5rem);font-weight:900;line-height:1;color:white;margin-bottom:1rem; }
.ph-sub { font-size:0.95rem;color:rgba(255,255,255,0.45);line-height:1.7;max-width:420px; }
.ph-stats { display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:rgba(255,255,255,0.07);border-radius:12px;overflow:hidden; }
.ph-stat { padding:1.5rem;background:rgba(255,255,255,0.03);text-align:center; }
.ph-stat-num { font-family:var(--display);font-size:2rem;font-weight:900;color:var(--gold); }
.ph-stat-label { font-size:0.65rem;color:rgba(255,255,255,0.3);text-transform:uppercase;letter-spacing:0.08em;margin-top:0.3rem; }

/* FILTER */
.filter-bar { display:flex;gap:0.5rem;flex-wrap:wrap;margin:3rem 0 2.5rem;padding-bottom:2rem;border-bottom:1px solid var(--border); }
.fb { font-size:0.75rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;padding:0.5rem 1.2rem;border-radius:6px;border:1.5px solid var(--border);background:white;color:var(--ink3);cursor:pointer;transition:all 0.2s; }
.fb:hover { border-color:var(--navy);color:var(--navy); }
.fb.active { background:var(--navy);color:white;border-color:var(--navy); }

/* PROJECTS */
.proj-list { display:flex;flex-direction:column;gap:1px;background:var(--border);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden; }
.proj-row {
  display:grid;grid-template-columns:80px 1fr auto;align-items:center;gap:2rem;
  background:white;padding:1.75rem 2rem;
  transition:all 0.25s var(--ease);cursor:pointer;
}
.proj-row:hover { background:var(--off);transform:none; }
.proj-row.hide { display:none; }
.proj-num { font-family:var(--display);font-size:2rem;font-weight:900;color:var(--border);letter-spacing:-0.04em;text-align:center; }
.proj-info {}
.proj-meta { display:flex;align-items:center;gap:1rem;margin-bottom:0.4rem; }
.proj-cat { font-size:0.65rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--gold); }
.proj-year { font-size:0.72rem;color:var(--ink3); }
.proj-name { font-family:var(--display);font-size:1.15rem;font-weight:800;color:var(--navy);margin-bottom:0.3rem; }
.proj-tags-row { display:flex;gap:0.4rem;flex-wrap:wrap; }
.proj-ptag { font-size:0.65rem;font-weight:600;padding:0.18rem 0.5rem;border-radius:4px;background:var(--sky);color:var(--navy-light);text-transform:uppercase;letter-spacing:0.05em; }
.proj-right { display:flex;flex-direction:column;align-items:flex-end;gap:0.5rem;min-width:160px; }
.proj-result { font-size:0.78rem;font-weight:700;color:var(--green);text-align:right; }
.proj-cta {
  font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;
  color:var(--navy-light);text-decoration:none;display:flex;align-items:center;gap:4px;
  background:var(--sky);padding:0.4rem 0.85rem;border-radius:6px;
  transition:all 0.2s;white-space:nowrap;
}
.proj-cta:hover { background:var(--navy);color:white; }

/* CASE STUDY SIDE PANEL */
.panel-overlay { display:none;position:fixed;inset:0;z-index:800;background:rgba(11,31,58,0.6);backdrop-filter:blur(4px); }
.panel-overlay.open { display:block; }
.side-panel {
  position:fixed;top:0;right:-520px;width:520px;height:100vh;
  background:white;z-index:900;overflow-y:auto;
  transition:right 0.4s var(--ease);box-shadow:var(--sh-lg);
}
.side-panel.open { right:0; }
.sp-header { background:var(--navy);padding:2rem;position:sticky;top:0;z-index:10; }
.sp-close { position:absolute;top:1.5rem;right:1.5rem;width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,0.1);border:none;cursor:pointer;color:white;font-size:1rem;display:flex;align-items:center;justify-content:center;transition:background 0.2s; }
.sp-close:hover { background:rgba(255,255,255,0.2); }
.sp-cat { font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--gold);margin-bottom:0.75rem; }
.sp-title { font-family:var(--display);font-size:1.8rem;font-weight:900;color:white;line-height:1.1; }
.sp-body { padding:2rem; }
.sp-section { margin-bottom:2rem; }
.sp-section-title { font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--ink3);margin-bottom:0.75rem;padding-bottom:0.5rem;border-bottom:1px solid var(--border); }
.sp-text { font-size:0.88rem;color:var(--ink2);line-height:1.8; }
.sp-metrics { display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:1.5rem; }
.sp-metric { background:var(--navy);border-radius:10px;padding:1.25rem;text-align:center; }
.sp-metric-val { font-family:var(--display);font-size:1.6rem;font-weight:900;color:var(--gold); }
.sp-metric-label { font-size:0.65rem;color:rgba(255,255,255,0.4);margin-top:0.2rem; }
.sp-tech-list { display:flex;flex-wrap:wrap;gap:0.5rem; }
.sp-tech { font-size:0.75rem;font-weight:600;padding:0.3rem 0.75rem;border-radius:6px;background:var(--sky);color:var(--navy-light); }

@media(max-width:1024px) { .port-hero-inner{grid-template-columns:1fr;} }
@media(max-width:768px) { .proj-row{grid-template-columns:60px 1fr;} .proj-right{display:none;} .side-panel{width:100%;right:-100%;} }
</style>
</head>
<body>
<nav class="nav">
  <div class="nav-inner">
    <a href="corp-index.html" class="nav-logo"><div class="nav-logo-badge">AM</div>Alex Morgan</a>
    <div class="nav-center"><a href="corp-index.html">Home</a><a href="corp-about.html">About</a><a href="corp-portfolio.html" class="active">Portfolio</a><a href="corp-blog.html">Insights</a></div>
    <div class="nav-right"><a href="corp-contact.html" class="nav-btn">Hire Me</a></div>
    <button class="nav-mobile-btn"><span></span><span></span><span></span></button>
  </div>
</nav>
<div class="page-wrap">

<section class="port-hero">
  <div class="port-hero-bg"></div>
  <div class="port-hero-inner">
    <div>
      <div class="eyebrow reveal" style="color:var(--gold);">Portfolio</div>
      <h1 class="ph-title reveal rd1">Selected<br><span style="color:var(--gold);">Work</span></h1>
      <p class="ph-sub reveal rd2">Eight case studies across enterprise systems, open source, and product engineering.</p>
    </div>
    <div class="ph-stats reveal rd2">
      <div class="ph-stat"><div class="ph-stat-num">08</div><div class="ph-stat-label">Projects</div></div>
      <div class="ph-stat"><div class="ph-stat-num">$2B+</div><div class="ph-stat-label">Revenue Impact</div></div>
      <div class="ph-stat"><div class="ph-stat-num">5</div><div class="ph-stat-label">Industries</div></div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="filter-bar reveal">
      <button class="fb active" data-f="all">All Projects</button>
      <button class="fb" data-f="systems">Systems</button>
      <button class="fb" data-f="cloud">Cloud</button>
      <button class="fb" data-f="ml">ML / AI</button>
      <button class="fb" data-f="oss">Open Source</button>
      <button class="fb" data-f="fullstack">Full-Stack</button>
    </div>

    <div class="proj-list reveal rd1">
      <div class="proj-row" data-cat="systems cloud" onclick="openPanel('nexus')">
        <div class="proj-num">01</div>
        <div class="proj-info">
          <div class="proj-meta"><span class="proj-cat">Distributed Systems · Enterprise</span><span class="proj-year">2025</span></div>
          <div class="proj-name">Nexus Data Orchestration Platform</div>
          <div class="proj-tags-row"><span class="proj-ptag">Go</span><span class="proj-ptag">Kubernetes</span><span class="proj-ptag">Kafka</span><span class="proj-ptag">PostgreSQL</span></div>
        </div>
        <div class="proj-right"><div class="proj-result">2M+ req/sec · 99.99% SLA</div><span class="proj-cta">Case Study →</span></div>
      </div>
      <div class="proj-row" data-cat="ml cloud" onclick="openPanel('aria')">
        <div class="proj-num">02</div>
        <div class="proj-info">
          <div class="proj-meta"><span class="proj-cat">ML / AI · E-Commerce</span><span class="proj-year">2024</span></div>
          <div class="proj-name">Aria Real-Time Recommendation Engine</div>
          <div class="proj-tags-row"><span class="proj-ptag">Python</span><span class="proj-ptag">TensorFlow</span><span class="proj-ptag">SageMaker</span><span class="proj-ptag">Redis</span></div>
        </div>
        <div class="proj-right"><div class="proj-result">+42% Click-Through Rate</div><span class="proj-cta">Case Study →</span></div>
      </div>
      <div class="proj-row" data-cat="oss systems" onclick="openPanel('forge')">
        <div class="proj-num">03</div>
        <div class="proj-info">
          <div class="proj-meta"><span class="proj-cat">Open Source · Developer Tools</span><span class="proj-year">2024</span></div>
          <div class="proj-name">Forge CLI — Developer Productivity Toolkit</div>
          <div class="proj-tags-row"><span class="proj-ptag">Rust</span><span class="proj-ptag">WebAssembly</span><span class="proj-ptag">CLI</span></div>
        </div>
        <div class="proj-right"><div class="proj-result">18,000 GitHub Stars</div><span class="proj-cta">Case Study →</span></div>
      </div>
      <div class="proj-row" data-cat="fullstack" onclick="openPanel('quill')">
        <div class="proj-num">04</div>
        <div class="proj-info">
          <div class="proj-meta"><span class="proj-cat">Full-Stack · SaaS</span><span class="proj-year">2023</span></div>
          <div class="proj-name">Quill Real-Time CMS Dashboard</div>
          <div class="proj-tags-row"><span class="proj-ptag">React</span><span class="proj-ptag">GraphQL</span><span class="proj-ptag">Redis</span><span class="proj-ptag">Node.js</span></div>
        </div>
        <div class="proj-right"><div class="proj-result">50k DAU · &lt;60ms latency</div><span class="proj-cta">Case Study →</span></div>
      </div>
      <div class="proj-row" data-cat="systems cloud" onclick="openPanel('lumen')">
        <div class="proj-num">05</div>
        <div class="proj-info">
          <div class="proj-meta"><span class="proj-cat">Microservices · Enterprise</span><span class="proj-year">2023</span></div>
          <div class="proj-name">Lumen Microservices Migration</div>
          <div class="proj-tags-row"><span class="proj-ptag">Go</span><span class="proj-ptag">gRPC</span><span class="proj-ptag">Kafka</span><span class="proj-ptag">Terraform</span></div>
        </div>
        <div class="proj-right"><div class="proj-result">300% Perf Gain · 0 Downtime</div><span class="proj-cta">Case Study →</span></div>
      </div>
      <div class="proj-row" data-cat="oss fullstack" onclick="openPanel('dash')">
        <div class="proj-num">06</div>
        <div class="proj-info">
          <div class="proj-meta"><span class="proj-cat">Open Source · UI / Frontend</span><span class="proj-year">2023</span></div>
          <div class="proj-name">DashBlocks UI Component Library</div>
          <div class="proj-tags-row"><span class="proj-ptag">TypeScript</span><span class="proj-ptag">Next.js</span><span class="proj-ptag">Storybook</span></div>
        </div>
        <div class="proj-right"><div class="proj-result">6k+ npm downloads/week</div><span class="proj-cta">Case Study →</span></div>
      </div>
      <div class="proj-row" data-cat="ml cloud" onclick="openPanel('pulse')">
        <div class="proj-num">07</div>
        <div class="proj-info">
          <div class="proj-meta"><span class="proj-cat">Data Engineering · Analytics</span><span class="proj-year">2022</span></div>
          <div class="proj-name">Pulse Behavioral Analytics Pipeline</div>
          <div class="proj-tags-row"><span class="proj-ptag">Python</span><span class="proj-ptag">Spark</span><span class="proj-ptag">Airflow</span><span class="proj-ptag">Snowflake</span></div>
        </div>
        <div class="proj-right"><div class="proj-result">500GB/day · Real-time anomaly detection</div><span class="proj-cta">Case Study →</span></div>
      </div>
      <div class="proj-row" data-cat="fullstack systems" onclick="openPanel('vertex')">
        <div class="proj-num">08</div>
        <div class="proj-info">
          <div class="proj-meta"><span class="proj-cat">Full-Stack · Video Infrastructure</span><span class="proj-year">2022</span></div>
          <div class="proj-name">Vertex Global Live Streaming Platform</div>
          <div class="proj-tags-row"><span class="proj-ptag">Go</span><span class="proj-ptag">WebRTC</span><span class="proj-ptag">React</span><span class="proj-ptag">QUIC</span></div>
        </div>
        <div class="proj-right"><div class="proj-result">&lt;200ms global · 100k concurrent</div><span class="proj-cta">Case Study →</span></div>
      </div>
    </div>
  </div>
</section>
</div>

<!-- PANEL OVERLAY -->
<div class="panel-overlay" id="overlay" onclick="closePanel()"></div>
<div class="side-panel" id="sidePanel">
  <div class="sp-header">
    <button class="sp-close" onclick="closePanel()">✕</button>
    <div class="sp-cat" id="sp-cat"></div>
    <div class="sp-title" id="sp-title"></div>
  </div>
  <div class="sp-body" id="sp-body"></div>
</div>

<footer class="footer">
  <div class="footer-top">
    <div><a href="corp-index.html" class="footer-logo"><div class="nav-logo-badge">AM</div>Alex Morgan</a><p class="footer-brand-desc">Principal Software Engineer & Systems Architect. Building reliable systems since 2013.</p></div>
    <div><div class="footer-col-title">Navigation</div><div class="footer-links"><a href="corp-index.html">Home</a><a href="corp-about.html">About</a><a href="corp-portfolio.html">Portfolio</a><a href="corp-blog.html">Insights</a><a href="corp-contact.html">Contact</a></div></div>
    <div><div class="footer-col-title">Connect</div><div class="footer-links"><a href="#">GitHub</a><a href="#">LinkedIn</a><a href="#">Twitter</a></div></div>
    <div><div class="footer-col-title">Legal</div><div class="footer-links"><a href="#">Privacy</a><a href="#">Terms</a></div></div>
  </div>
  <div class="footer-bottom"><span>© 2026 Alex Morgan.</span><span>San Francisco, CA 🇺🇸</span></div>
</footer>

<script src="corp-main.js"></script>
<script>
const data = {
  nexus:{cat:'Enterprise · Distributed Systems',title:'Nexus Data Orchestration Platform',overview:'High-throughput event streaming platform for a Fortune 100 client. The existing system was collapsing under 200k events/second peak load. Needed a complete rebuild without disrupting live operations.',challenge:'4 years of accumulated technical debt across 3 legacy systems. No test coverage on critical paths. A hard requirement of zero planned downtime during migration.',solution:'Redesigned as a streaming-first architecture using Apache Kafka for ingestion, Go microservices for processing with backpressure mechanisms, and a custom horizontal sharding strategy for PostgreSQL. Deployed via Kubernetes with blue/green promotion pipelines.',tech:['Go','Apache Kafka','Kubernetes','PostgreSQL','Terraform','gRPC','Prometheus'],metrics:[{v:'2.1M',l:'Events/sec'},{v:'9ms',l:'P99 Latency'},{v:'99.99%',l:'Uptime SLA'}]},
  aria:{cat:'ML / AI · E-Commerce',title:'Aria Recommendation Engine',overview:'End-to-end ML personalization pipeline replacing a rule-based system for a major e-commerce platform with 5M daily users.',challenge:'Existing rule system had a ceiling — it could not learn from user behavior or adapt to trends. Inference had to be sub-50ms to avoid impacting checkout conversion.',solution:'Two-tower neural network in TensorFlow, served via TensorFlow Serving on SageMaker GPU endpoints. A Redis feature store serves real-time user signals. A/B tested via internal experimentation platform.',tech:['Python','TensorFlow','AWS SageMaker','Redis','Airflow','Feature Store'],metrics:[{v:'+42%',l:'CTR'},{v:'<50ms',l:'P99 Inference'},{v:'5M',l:'Daily Users'}]},
  forge:{cat:'Open Source · Rust',title:'Forge CLI Toolkit',overview:'Single-binary developer productivity toolkit built in Rust. Provides project scaffolding, parallel file processing, build automation, and a plugin system via WebAssembly.',challenge:'Existing tools were slow (JS-based), fragmented, and required heavy runtimes. Developers wanted something that felt as fast as the OS itself.',solution:'Wrote core in Rust using zero-copy parsing and rayon for parallelism. Compiled to a self-contained 4MB binary. WASM plugin system for extensibility without runtime deps.',tech:['Rust','WebAssembly','Rayon','Clap','Serde'],metrics:[{v:'18k',l:'GitHub ★'},{v:'50×',l:'Faster than JS'},{v:'4MB',l:'Binary size'}]},
  quill:{cat:'Full-Stack · SaaS CMS',title:'Quill CMS Dashboard',overview:'Real-time collaborative content platform with live co-editing, AI writing assistance, and version history for content teams at scale.',challenge:'Teams needed simultaneous editing without conflicts, real-time presence, and sub-100ms sync globally — all in a single unified product.',solution:'CRDTs (Yjs) for conflict-free real-time co-editing. GraphQL subscriptions for live presence. Redis pub/sub for multi-region sync. OpenAI API for inline writing suggestions.',tech:['React','TypeScript','GraphQL','Yjs CRDTs','Redis','Node.js','OpenAI'],metrics:[{v:'50k',l:'Daily Active Users'},{v:'<60ms',l:'Sync Latency'},{v:'99.95%',l:'Uptime'}]},
  lumen:{cat:'Enterprise · Microservices',title:'Lumen Microservices Migration',overview:'Complete decomposition of a 4M-line Rails monolith into 22 Go microservices for a Series B SaaS company.',challenge:'The monolith had a single 96-core database server, no service boundaries, and zero test coverage on billing-critical paths. Needed zero-downtime cutover.',solution:'Domain-driven decomposition into 22 services with event-driven communication via Kafka. Blue/green deployments via Kubernetes. Strangler fig pattern for incremental migration.',tech:['Go','Kafka','gRPC','Kubernetes','Terraform','PostgreSQL'],metrics:[{v:'22',l:'Services'},{v:'+300%',l:'Performance'},{v:'0',l:'Downtime min'}]},
  dash:{cat:'Open Source · Frontend',title:'DashBlocks UI Library',overview:'Open-source React component library with 60+ composable, accessible components and a themeable design system for dashboard applications.',challenge:'Teams kept rebuilding the same charts, tables, and filter components. No unified standard across products led to inconsistent UX.',solution:'Component library with full TypeScript support, Storybook documentation, and a CSS custom property theming system. Published to npm with automated release pipeline.',tech:['TypeScript','React','Storybook','Radix UI','CSS Custom Properties'],metrics:[{v:'60+',l:'Components'},{v:'6k',l:'npm/week'},{v:'4.9★',l:'npm Rating'}]},
  pulse:{cat:'Data Engineering · Analytics',title:'Pulse Analytics Pipeline',overview:'End-to-end behavioral analytics infrastructure for a B2B SaaS platform, unifying 12 data sources and enabling self-serve analytics.',challenge:'Raw events were siloed across 12 systems with no unified model. Analysts waited 24h+ for data. Business needed near-real-time dashboards and anomaly detection.',solution:'Spark-based ETL orchestrated by Airflow, landing into Snowflake via dbt models. Isolation Forest ML model for automated anomaly detection. Metabase for self-serve.',tech:['Python','Apache Spark','Airflow','Snowflake','dbt','Metabase'],metrics:[{v:'500GB',l:'Processed/day'},{v:'<15min',l:'Freshness'},{v:'12',l:'Source systems'}]},
  vertex:{cat:'Full-Stack · Video Infrastructure',title:'Vertex Live Platform',overview:'Global real-time live streaming and collaboration platform for distributed enterprise teams. Sub-200ms latency guaranteed in 40+ countries.',challenge:'WebRTC at scale with adaptive quality, global distribution, and 100k concurrent users — one of the hardest infrastructure problems in existence.',solution:'Selective Forwarding Unit (SFU) architecture in Go using the Pion WebRTC library. QUIC transport for reliability. Anycast routing to 12 global PoPs. Adaptive bitrate switching.',tech:['Go','WebRTC / Pion','QUIC','React','Redis','ClickHouse'],metrics:[{v:'<200ms',l:'Global P95'},{v:'100k',l:'Concurrent'},{v:'12',l:'Global PoPs'}]}
};

function openPanel(id) {
  const d = data[id]; if(!d) return;
  document.getElementById('sp-cat').textContent = d.cat;
  document.getElementById('sp-title').textContent = d.title;
  document.getElementById('sp-body').innerHTML = `
    <div class="sp-section"><div class="sp-section-title">Project Overview</div><p class="sp-text">${d.overview}</p></div>
    <div class="sp-section"><div class="sp-section-title">The Challenge</div><p class="sp-text">${d.challenge}</p></div>
    <div class="sp-section"><div class="sp-section-title">The Solution</div><p class="sp-text">${d.solution}</p></div>
    <div class="sp-metrics">${d.metrics.map(m=>`<div class="sp-metric"><div class="sp-metric-val">${m.v}</div><div class="sp-metric-label">${m.l}</div></div>`).join('')}</div>
    <div class="sp-section" style="margin-top:1.5rem;"><div class="sp-section-title">Tech Stack</div><div class="sp-tech-list">${d.tech.map(t=>`<span class="sp-tech">${t}</span>`).join('')}</div></div>
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
document.addEventListener('keydown', e => { if(e.key==='Escape') closePanel(); });

// Filter
document.querySelectorAll('.fb').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.fb').forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
    const f = btn.dataset.f;
    document.querySelectorAll('.proj-row').forEach(r => {
      r.classList.toggle('hide', f!=='all' && !(r.dataset.cat||'').includes(f));
    });
  });
});
</script>
</body>
</html>
