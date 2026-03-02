<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About — Alex Morgan</title>
<link rel="stylesheet" href="./assets/styles/style.css" />
<style>
.about-hero{background:var(--navy);padding:6rem 0 5rem;position:relative;overflow:hidden;}
.ah-bg{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.025) 1px,transparent 1px);background-size:60px 60px;}
.ah-inner{max-width:1320px;margin:0 auto;padding:0 3rem;position:relative;z-index:2;display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;}
.about-photo{aspect-ratio:4/5;background:linear-gradient(135deg,#142D52,#1E3F70);border-radius:var(--r-lg);display:flex;align-items:center;justify-content:center;font-family:var(--display);font-size:7rem;font-weight:900;color:rgba(200,146,42,0.2);position:relative;overflow:hidden;border:1px solid rgba(255,255,255,0.07);}
.name-card{position:absolute;bottom:1.5rem;left:1.5rem;right:1.5rem;background:rgba(11,31,58,0.85);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.08);border-radius:10px;padding:1rem 1.25rem;}
.nc-name{font-family:var(--display);font-size:1.1rem;font-weight:800;color:white;}
.nc-role{font-size:0.72rem;color:rgba(255,255,255,0.4);margin-top:0.15rem;}
.avail{display:inline-flex;align-items:center;gap:0.5rem;background:rgba(16,185,129,0.12);border:1px solid rgba(16,185,129,0.25);border-radius:100px;padding:0.3rem 0.85rem;margin-top:0.65rem;font-size:0.68rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#34D399;}
.avail-dot{width:6px;height:6px;border-radius:50%;background:#10B981;animation:pulse 2s infinite;}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:0.3}}
.ah-text{color:white;}
.ah-bio{font-size:0.95rem;color:rgba(255,255,255,0.5);line-height:1.85;margin-bottom:1.25rem;}
.ah-meta{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-top:2rem;}
.am-item{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.07);border-radius:10px;padding:1rem;}
.am-label{font-size:0.65rem;color:rgba(255,255,255,0.3);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.3rem;}
.am-val{font-size:0.88rem;color:rgba(255,255,255,0.7);font-weight:500;}
.tl{position:relative;}
.tl-item{display:flex;gap:1.5rem;margin-bottom:2.5rem;}
.tl-left{display:flex;flex-direction:column;align-items:center;}
.tl-icon{width:40px;height:40px;border-radius:10px;background:var(--navy);display:flex;align-items:center;justify-content:center;font-size:0.9rem;flex-shrink:0;color:var(--gold);}
.tl-line{width:1px;flex:1;background:var(--border);margin:8px 0;min-height:30px;}
.tl-year{font-size:0.68rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--gold);margin-bottom:0.25rem;}
.tl-co{font-family:var(--display);font-size:1rem;font-weight:800;color:var(--navy);}
.tl-role{font-size:0.82rem;color:var(--slate);margin:0.15rem 0 0.5rem;}
.tl-desc{font-size:0.82rem;color:var(--ink3);line-height:1.7;}
.skills-band{background:var(--navy);padding:6rem 0;}
.skills-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:rgba(255,255,255,0.06);border-radius:16px;overflow:hidden;margin-top:3.5rem;}
.sgc{background:var(--navy-mid);padding:2rem;}
.sgc-title{font-size:0.65rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:var(--gold);margin-bottom:1.5rem;}
.sgc-list{display:flex;flex-direction:column;gap:1rem;}
.sgc-name{font-size:0.82rem;color:rgba(255,255,255,0.7);margin-bottom:0.4rem;display:flex;justify-content:space-between;}
.sgc-pct{color:rgba(255,255,255,0.3);font-size:0.72rem;}
.sgc-bar{height:3px;background:rgba(255,255,255,0.08);border-radius:100px;overflow:hidden;}
.sgc-fill{height:100%;border-radius:100px;background:linear-gradient(to right,var(--gold),rgba(200,146,42,0.4));transition:width 1.3s ease;width:0;}
.sgc-fill.go{width:var(--w);}
.val-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-top:3.5rem;}
.val-card{border:1px solid var(--border);border-radius:var(--r-lg);padding:2rem;background:white;transition:all 0.3s;border-top:3px solid var(--border);}
.val-card:hover{border-top-color:var(--gold);transform:translateY(-4px);box-shadow:var(--sh-md);}
.val-icon{font-size:1.5rem;margin-bottom:1rem;}
.val-title{font-family:var(--display);font-size:1rem;font-weight:800;margin-bottom:0.5rem;}
.val-text{font-size:0.82rem;color:var(--ink3);line-height:1.65;}
.awards-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:3.5rem;}
.award-card{background:white;border:1px solid var(--border);border-radius:var(--r-lg);padding:2rem;display:flex;flex-direction:column;gap:1rem;transition:all 0.3s;position:relative;overflow:hidden;}
.award-card::before{content:'';position:absolute;top:0;left:0;width:100%;height:3px;background:linear-gradient(to right,var(--gold),transparent);}
.award-card:hover{transform:translateY(-4px);box-shadow:var(--sh-md);}
.award-icon{font-size:2rem;}
.award-year{font-size:0.68rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--gold);}
.award-name{font-family:var(--display);font-size:1.05rem;font-weight:800;}
.award-org{font-size:0.8rem;color:var(--ink3);}
@media(max-width:1024px){.ah-inner{grid-template-columns:1fr;}.about-photo{max-width:380px;}.skills-grid{grid-template-columns:1fr 1fr;}.val-grid{grid-template-columns:1fr 1fr;}.awards-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.skills-grid{grid-template-columns:1fr;}.val-grid{grid-template-columns:1fr;}.awards-grid{grid-template-columns:1fr;}}
</style>
</head>
<body>
<nav class="nav">
  <div class="nav-inner">
    <a href="index.php" class="nav-logo"><div class="nav-logo-badge">AO</div>Ahmed Olusesi</a>
    <div class="nav-center"><a href="index.php">Home</a><a href="about.php" class="active">About</a>
    <a href="portfolio.php">Portfolio</a><a href="blog.php">Insights</a></div>
    <div class="nav-right"><a href="contact.php" class="nav-btn">Hire Me</a></div>
    <button class="nav-mobile-btn"><span></span><span></span><span></span></button>
  </div>
</nav>
<div class="page-wrap">
<section class="about-hero">
  <div class="ah-bg"></div>
  <div class="ah-inner">
    <div class="reveal">
      <div class="about-photo">AO
        <div class="name-card">
          <div class="nc-name">Ahmed Olusesi</div>
          <div class="nc-role">Principal Engineer · San Francisco, CA</div>
          <div class="avail"><div class="avail-dot"></div>Available Q1 2026</div>
        </div>
      </div>
    </div>
    <div class="ah-text">
      <div class="eyebrow reveal" style="color:var(--gold);">About Me</div>
      <h1 class="h1 reveal rd1" style="color:white;">Engineer.<br>Architect.<br><span style="color:var(--gold);">Problem Solver.</span></h1>
      <p class="ah-bio reveal rd2" style="margin-top:1.5rem;">I'm Alex — a Principal Software Engineer with 12 years building the systems that power enterprises and high-growth startups. I've led teams at Stripe, Airbnb, and Shopify, shipping software used by hundreds of millions of people.</p>
      <p class="ah-bio reveal rd2">My approach: understand the problem deeply, design for the right level of complexity, build it to last, and be honest about tradeoffs.</p>
      <div class="ah-meta reveal rd3">
        <div class="am-item"><div class="am-label">Location</div><div class="am-val">San Francisco, CA</div></div>
        <div class="am-item"><div class="am-label">Availability</div><div class="am-val">Q1 2026 · Remote-first</div></div>
        <div class="am-item"><div class="am-label">Focus</div><div class="am-val">Distributed Systems</div></div>
        <div class="am-item"><div class="am-label">Open To</div><div class="am-val">Contract & Advisory</div></div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container" style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;">
    <div>
      <p style="font-size:0.7rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--ink3);margin-bottom:2rem;">WORK HISTORY</p>
      <div class="tl">
        <div class="tl-item reveal"><div class="tl-left"><div class="tl-icon">🏛</div><div class="tl-line"></div></div><div class="tl-right"><div class="tl-year">2022 – Present</div><div class="tl-co">Stripe</div><div class="tl-role">Principal Software Engineer · Payments Infrastructure</div><p class="tl-desc">Led fraud detection rebuild processing $1B+ daily. Team of 12. Reduced false positives 34%, improved throughput 8×.</p></div></div>
        <div class="tl-item reveal rd1"><div class="tl-left"><div class="tl-icon">🏠</div><div class="tl-line"></div></div><div class="tl-right"><div class="tl-year">2019 – 2022</div><div class="tl-co">Airbnb</div><div class="tl-role">Staff Engineer · Search Infrastructure</div><p class="tl-desc">Built search ranking system to 150M+ queries/day. Led 8 engineers across SF and Dublin.</p></div></div>
        <div class="tl-item reveal rd2"><div class="tl-left"><div class="tl-icon">🛒</div><div class="tl-line"></div></div><div class="tl-right"><div class="tl-year">2016 – 2019</div><div class="tl-co">Shopify</div><div class="tl-role">Senior Backend Engineer · Core Platform</div><p class="tl-desc">GraphQL API migration for 1M+ merchants. Checkout reliability improved by 62%.</p></div></div>
        <div class="tl-item reveal rd3"><div class="tl-left"><div class="tl-icon">🚀</div></div><div class="tl-right"><div class="tl-year">2013 – 2016</div><div class="tl-co">Various Startups</div><div class="tl-role">Software Engineer</div><p class="tl-desc">First engineer at two Series A companies across fintech and developer tools.</p></div></div>
      </div>
    </div>
    <div>
      <p style="font-size:0.7rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--ink3);margin-bottom:2rem;">EDUCATION & CERTS</p>
      <div class="tl">
        <div class="tl-item reveal rd1"><div class="tl-left"><div class="tl-icon">🎓</div><div class="tl-line"></div></div><div class="tl-right"><div class="tl-year">2011 – 2013</div><div class="tl-co">Stanford University</div><div class="tl-role">M.Sc. Computer Science — Distributed Systems</div><p class="tl-desc">Thesis on optimistic concurrency in geographically distributed databases.</p></div></div>
        <div class="tl-item reveal rd2"><div class="tl-left"><div class="tl-icon">🏫</div></div><div class="tl-right"><div class="tl-year">2007 – 2011</div><div class="tl-co">UC Berkeley</div><div class="tl-role">B.Sc. Computer Engineering — Summa Cum Laude</div><p class="tl-desc">Led ACM programming chapter. Senior thesis on Byzantine fault-tolerant consensus.</p></div></div>
      </div>
      <div style="display:flex;flex-direction:column;gap:0.75rem;margin-top:1rem;">
        <div style="display:flex;align-items:center;gap:1rem;padding:1rem;background:var(--off);border:1px solid var(--border);border-radius:10px;" class="reveal rd1"><span style="font-size:1.25rem;">☁️</span><div><div style="font-weight:600;font-size:0.85rem;">AWS Solutions Architect Professional</div><div style="font-size:0.75rem;color:var(--ink3);">Amazon · 2024</div></div></div>
        <div style="display:flex;align-items:center;gap:1rem;padding:1rem;background:var(--off);border:1px solid var(--border);border-radius:10px;" class="reveal rd2"><span style="font-size:1.25rem;">☸️</span><div><div style="font-weight:600;font-size:0.85rem;">Certified Kubernetes Administrator (CKA)</div><div style="font-size:0.75rem;color:var(--ink3);">CNCF · 2023</div></div></div>
      </div>
    </div>
  </div>
</section>

<section class="skills-band">
  <div style="max-width:1320px;margin:0 auto;padding:0 3rem;">
    <div class="eyebrow reveal" style="color:var(--gold);">Proficiency</div>
    <h2 class="h2 reveal rd1" style="color:white;">Technical skills</h2>
    <div class="skills-grid">
      <div class="sgc reveal"><div class="sgc-title">Backend</div><div class="sgc-list"><div><div class="sgc-name">Go<span class="sgc-pct">97%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:97%"></div></div></div><div><div class="sgc-name">Rust<span class="sgc-pct">88%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:88%"></div></div></div><div><div class="sgc-name">Python<span class="sgc-pct">93%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:93%"></div></div></div></div></div>
      <div class="sgc reveal rd1"><div class="sgc-title">Cloud & Infra</div><div class="sgc-list"><div><div class="sgc-name">Kubernetes<span class="sgc-pct">95%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:95%"></div></div></div><div><div class="sgc-name">AWS<span class="sgc-pct">94%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:94%"></div></div></div><div><div class="sgc-name">Terraform<span class="sgc-pct">89%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:89%"></div></div></div></div></div>
      <div class="sgc reveal rd2"><div class="sgc-title">Data</div><div class="sgc-list"><div><div class="sgc-name">PostgreSQL<span class="sgc-pct">96%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:96%"></div></div></div><div><div class="sgc-name">Kafka<span class="sgc-pct">91%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:91%"></div></div></div><div><div class="sgc-name">Redis<span class="sgc-pct">93%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:93%"></div></div></div></div></div>
      <div class="sgc reveal rd3"><div class="sgc-title">Frontend</div><div class="sgc-list"><div><div class="sgc-name">React/Next.js<span class="sgc-pct">88%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:88%"></div></div></div><div><div class="sgc-name">GraphQL<span class="sgc-pct">90%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:90%"></div></div></div><div><div class="sgc-name">TypeScript<span class="sgc-pct">91%</span></div><div class="sgc-bar"><div class="sgc-fill" style="--w:91%"></div></div></div></div></div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="eyebrow reveal">Philosophy</div>
    <h2 class="h2 reveal rd1">Engineering principles I live by</h2>
    <div class="val-grid">
      <div class="val-card reveal rd1"><div class="val-icon">🎯</div><div class="val-title">Clarity over cleverness</div><p class="val-text">The right abstraction is obvious. The wrong one requires a wiki page to explain.</p></div>
      <div class="val-card reveal rd2"><div class="val-icon">🛡️</div><div class="val-title">Design for failure</div><p class="val-text">Every system will fail. Graceful degradation and observability are day-one requirements.</p></div>
      <div class="val-card reveal rd3"><div class="val-icon">📊</div><div class="val-title">Data-driven decisions</div><p class="val-text">Profile first, optimize second. Intuition is a starting point, never a conclusion.</p></div>
      <div class="val-card reveal rd4"><div class="val-icon">📖</div><div class="val-title">Documentation is code</div><p class="val-text">An undocumented system is a liability. Docs ship alongside the feature, always.</p></div>
    </div>
  </div>
</section>

<section class="section" style="padding-top:0;">
  <div class="container">
    <div class="rule" style="margin-bottom:5rem;"></div>
    <div class="eyebrow reveal">Recognition</div>
    <h2 class="h2 reveal rd1">Awards & speaking</h2>
    <div class="awards-grid">
      <div class="award-card reveal rd1"><div class="award-icon">🏆</div><div class="award-year">2024</div><div class="award-name">Best Open Source Tool</div><div class="award-org">DevAwards — Forge CLI (18k ★)</div></div>
      <div class="award-card reveal rd2"><div class="award-icon">🎤</div><div class="award-year">2024</div><div class="award-name">Keynote · GopherCon US</div><div class="award-org">"Designing for Failure at Scale"</div></div>
      <div class="award-card reveal rd3"><div class="award-icon">📝</div><div class="award-year">2023</div><div class="award-name">Top Engineering Blog</div><div class="award-org">Dev.to Community · 8k subscribers</div></div>
    </div>
  </div>
</section>
</div>
<footer class="footer">
  <div class="footer-top">
    <div><a href="index.php" class="footer-logo"><div class="nav-logo-badge">AM</div>Ahmed Olusesi</a><p class="footer-brand-desc">Principal Software Engineer & Systems Architect based in San Francisco.</p></div>
    <div><div class="footer-col-title">Navigation</div><div class="footer-links"><a href="index.php">Home</a><a href="about.php">About</a><a href="portfolio.php">Portfolio</a><a href="blog.php">Insights</a><a href="contact.php">Contact</a></div></div>
    <div><div class="footer-col-title">Connect</div><div class="footer-links"><a href="#">GitHub</a><a href="#">LinkedIn</a><a href="#">Twitter</a></div></div>
    <div><div class="footer-col-title">Legal</div><div class="footer-links"><a href="#">Privacy</a><a href="#">Terms</a></div></div>
  </div>
  <div class="footer-bottom"><span>© 2026 Ahmed Olusesi.</span><span>San Francisco, CA 🇺🇸</span></div>
</footer>
<script src="./assets/js/main.js"></script>
<script>
const so=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.querySelectorAll('.sgc-fill').forEach(b=>b.classList.add('go'));so.unobserve(e.target);}});},{threshold:0.2});
document.querySelectorAll('.sgc').forEach(c=>so.observe(c));
</script>
</body>
</html>
