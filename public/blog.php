<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Insights — Alex Morgan</title>
<link rel="stylesheet" href="corp-style.css">
<style>
.blog-banner { padding: 5rem 0; border-bottom: 1px solid var(--border); }
.blog-banner-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: end; }
.search-box { position: relative; }
.search-box svg { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--slate); pointer-events: none; }
.search-input { width: 100%; padding: 0.72rem 1rem 0.72rem 2.75rem; background: var(--card-bg); border: 1px solid var(--border-light); border-radius: var(--radius); color: var(--white); font-family: var(--body); font-size: 0.875rem; outline: none; transition: border-color var(--transition); }
.search-input:focus { border-color: var(--teal); }
.search-input::placeholder { color: var(--slate); }
.cat-row { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 1rem; }
.cat-btn { font-size: 0.75rem; font-weight: 600; padding: 0.35rem 0.85rem; border-radius: 6px; border: 1px solid var(--border-light); background: transparent; color: var(--slate-light); cursor: pointer; transition: all var(--transition); }
.cat-btn:hover, .cat-btn.active { background: var(--teal); color: var(--navy); border-color: var(--teal); }

.feat-post { display: grid; grid-template-columns: 1fr 1fr; min-height: 360px; border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden; transition: all var(--transition); margin-bottom: 2rem; }
.feat-post:hover { border-color: var(--border-light); box-shadow: 0 20px 60px rgba(0,0,0,0.5); }
.feat-thumb { background: linear-gradient(135deg, #07111F 0%, #0D2444 60%, #072236 100%); display: flex; align-items: center; justify-content: center; font-family: var(--display); font-size: 5rem; font-weight: 800; color: rgba(0,201,174,0.25); letter-spacing: -0.05em; }
.feat-body { background: var(--card-bg); padding: 3rem; display: flex; flex-direction: column; justify-content: center; }
.feat-meta { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem; }
.post-cat { font-size: 0.67rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--teal); }
.post-date { font-size: 0.75rem; color: var(--slate); }
.feat-title { font-family: var(--display); font-size: 1.7rem; font-weight: 800; letter-spacing: -0.025em; line-height: 1.15; margin-bottom: 1rem; }
.feat-excerpt { font-size: 0.875rem; color: var(--slate-light); line-height: 1.8; margin-bottom: 1.75rem; }
.read-link { font-size: 0.8rem; font-weight: 700; color: var(--teal); text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: gap var(--transition); }
.read-link:hover { gap: 10px; }

.blog-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; }
.blog-card { border-radius: var(--radius-lg); overflow: hidden; transition: all var(--transition); display: flex; flex-direction: column; }
.blog-card:hover { transform: translateY(-4px); box-shadow: 0 20px 60px rgba(0,0,0,0.5); }
.blog-card.hide { display: none; }
.blog-thumb { height: 140px; display: flex; align-items: center; justify-content: center; font-family: var(--display); font-weight: 800; font-size: 2rem; letter-spacing: -0.04em; }
.bt-1 { background: linear-gradient(135deg,#071828,#0A2830); color: rgba(0,180,200,0.4); }
.bt-2 { background: linear-gradient(135deg,#0F0818,#1A1038); color: rgba(140,80,220,0.4); }
.bt-3 { background: linear-gradient(135deg,#16080A,#260D10); color: rgba(220,60,80,0.4); }
.bt-4 { background: linear-gradient(135deg,#07111F,#0D2040); color: rgba(0,120,220,0.4); }
.bt-5 { background: linear-gradient(135deg,#101408,#182010); color: rgba(80,200,80,0.4); }
.bt-6 { background: linear-gradient(135deg,#181208,#281C0A); color: rgba(220,160,0,0.4); }
.blog-body { padding: 1.5rem; flex: 1; background: var(--card-bg); border: 1px solid var(--border); border-top: none; }
.blog-meta { display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.75rem; }
.blog-title { font-size: 0.98rem; font-weight: 700; line-height: 1.35; margin-bottom: 0.5rem; }
.blog-excerpt { font-size: 0.8rem; color: var(--slate); line-height: 1.65; }
.blog-footer { padding: 0.9rem 1.5rem; border-top: 1px solid var(--border); background: var(--card-bg); display: flex; justify-content: space-between; align-items: center; }
.read-time { font-size: 0.7rem; color: var(--slate); }

.newsletter-band { background: linear-gradient(135deg, var(--navy-2) 0%, var(--navy-3) 100%); border: 1px solid var(--border-light); border-radius: 20px; padding: 4rem; display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; position: relative; overflow: hidden; }
.newsletter-band::before { content: ''; position: absolute; top: -60px; right: -60px; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(0,201,174,0.08), transparent 70%); }
.nl-title { font-family: var(--display); font-size: 1.8rem; font-weight: 800; letter-spacing: -0.025em; line-height: 1.2; }
.nl-sub { font-size: 0.875rem; color: var(--slate-light); line-height: 1.7; margin-top: 0.5rem; }
.nl-form { display: flex; gap: 0.75rem; position: relative; z-index: 1; }
.nl-input { flex: 1; padding: 0.8rem 1.2rem; background: var(--navy); border: 1px solid var(--border-light); border-radius: var(--radius); color: var(--white); font-family: var(--body); font-size: 0.875rem; outline: none; transition: border-color var(--transition); }
.nl-input:focus { border-color: var(--teal); }
.nl-input::placeholder { color: var(--slate); }

@media (max-width: 900px) {
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
<nav class="nav">
  <div class="nav-bar">
    <a href="corp-index.html" class="nav-logo"><div class="logo-mark">AM</div>Alex Morgan</a>
    <ul class="nav-links">
      <li><a href="corp-index.html">Home</a></li>
      <li><a href="corp-about.html">About</a></li>
      <li><a href="corp-portfolio.html">Portfolio</a></li>
      <li><a href="corp-blog.html" class="active">Insights</a></li>
      <li><a href="corp-contact.html" class="nav-cta">Engage</a></li>
    </ul>
    <button class="nav-mobile-btn"><span></span><span></span><span></span></button>
  </div>
</nav>
<div class="page-wrap">
  <section class="blog-banner">
    <div class="container">
      <div class="blog-banner-grid">
        <div>
          <div class="eyebrow reveal">Engineering Insights</div>
          <h1 class="display-lg reveal reveal-d1">Thinking out<br>loud on <span class="teal">systems.</span></h1>
          <p class="section-sub reveal reveal-d2" style="margin-top:1rem;">Technical deep-dives on distributed systems, performance engineering, and the craft of senior engineering.</p>
        </div>
        <div class="reveal reveal-d2">
          <div class="search-box">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            <input type="text" class="search-input" placeholder="Search articles..." id="searchInput">
          </div>
          <div class="cat-row">
            <button class="cat-btn active" data-cat="all">All</button>
            <button class="cat-btn" data-cat="systems">Distributed Systems</button>
            <button class="cat-btn" data-cat="perf">Performance</button>
            <button class="cat-btn" data-cat="rust">Rust</button>
            <button class="cat-btn" data-cat="leadership">Leadership</button>
            <button class="cat-btn" data-cat="career">Career</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="eyebrow reveal" style="margin-bottom:1.25rem;">Featured</div>
      <div class="feat-post reveal reveal-d1" data-cat="systems perf">
        <div class="feat-thumb">DS</div>
        <div class="feat-body">
          <div class="feat-meta"><span class="post-cat">Distributed Systems</span><span class="post-date">Feb 10, 2026</span></div>
          <h2 class="feat-title">Designing for Failure: Engineering Systems That Survive the Apocalypse</h2>
          <p class="feat-excerpt">After 12 years running production systems processing billions in daily transactions, here is the complete mental model I use to build systems that fail gracefully — every time.</p>
          <a href="#" class="read-link">Read Full Article →</a>
          <div class="read-time" style="margin-top:0.75rem;">14 min read</div>
        </div>
      </div>

      <h2 style="font-family:var(--display);font-size:1.3rem;font-weight:700;letter-spacing:-0.02em;margin-bottom:1.75rem;" class="reveal">All Articles</h2>
      <div class="blog-grid" id="blogGrid">
        <div class="blog-card reveal" data-cat="perf"><div class="blog-thumb bt-1">OPT</div><div class="blog-body"><div class="blog-meta"><span class="post-cat">Performance</span><span class="post-date">Jan 28, 2026</span></div><h3 class="blog-title">The Hidden Cost of Premature Optimization</h3><p class="blog-excerpt">Why optimizing before you understand your system leads to unmaintainable code and wrong answers.</p></div><div class="blog-footer"><span class="read-time">8 min</span><a href="#" class="read-link" style="font-size:0.75rem;">Read →</a></div></div>
        <div class="blog-card reveal reveal-d1" data-cat="systems"><div class="blog-thumb bt-2">API</div><div class="blog-body"><div class="blog-meta"><span class="post-cat">Systems</span><span class="post-date">Jan 15, 2026</span></div><h3 class="blog-title">Designing APIs as Works of Art</h3><p class="blog-excerpt">A well-designed API is a gift. The mental model I use to create interfaces that feel intuitive and last for years.</p></div><div class="blog-footer"><span class="read-time">11 min</span><a href="#" class="read-link" style="font-size:0.75rem;">Read →</a></div></div>
        <div class="blog-card reveal reveal-d2" data-cat="rust"><div class="blog-thumb bt-3">RS</div><div class="blog-body"><div class="blog-meta"><span class="post-cat">Rust</span><span class="post-date">Jan 5, 2026</span></div><h3 class="blog-title">Rust in Production: Six Months In</h3><p class="blog-excerpt">After migrating a critical service from Go to Rust — remarkable performance gains and a new appreciation for the compiler.</p></div><div class="blog-footer"><span class="read-time">15 min</span><a href="#" class="read-link" style="font-size:0.75rem;">Read →</a></div></div>
        <div class="blog-card reveal" data-cat="systems"><div class="blog-thumb bt-4">KV</div><div class="blog-body"><div class="blog-meta"><span class="post-cat">Distributed Systems</span><span class="post-date">Dec 18, 2025</span></div><h3 class="blog-title">Why Every Engineer Should Understand Raft</h3><p class="blog-excerpt">Consensus algorithms power everything from databases to service meshes. Understanding Raft changed how I think about reliability.</p></div><div class="blog-footer"><span class="read-time">18 min</span><a href="#" class="read-link" style="font-size:0.75rem;">Read →</a></div></div>
        <div class="blog-card reveal reveal-d1" data-cat="leadership"><div class="blog-thumb bt-5">LDR</div><div class="blog-body"><div class="blog-meta"><span class="post-cat">Leadership</span><span class="post-date">Dec 5, 2025</span></div><h3 class="blog-title">The 1:1 Format That Actually Works</h3><p class="blog-excerpt">After managing 30+ engineers, I've refined the 1:1 meeting. The secret: 80% of the talking should be theirs.</p></div><div class="blog-footer"><span class="read-time">6 min</span><a href="#" class="read-link" style="font-size:0.75rem;">Read →</a></div></div>
        <div class="blog-card reveal reveal-d2" data-cat="career"><div class="blog-thumb bt-6">L10</div><div class="blog-body"><div class="blog-meta"><span class="post-cat">Career</span><span class="post-date">Nov 22, 2025</span></div><h3 class="blog-title">How I Went Senior to Staff in 18 Months</h3><p class="blog-excerpt">Staff engineering is about a different scope, not better coding. Here's the mindset shift that made the difference.</p></div><div class="blog-footer"><span class="read-time">10 min</span><a href="#" class="read-link" style="font-size:0.75rem;">Read →</a></div></div>
      </div>
    </div>
  </section>

  <section class="section-sm">
    <div class="container">
      <div class="newsletter-band reveal">
        <div><div class="nl-title">Join 8,000<br><span class="teal">engineers</span></div><p class="nl-sub">Weekly deep-dives on distributed systems and engineering craft. No noise, just signal.</p></div>
        <div class="nl-form"><input type="email" class="nl-input" placeholder="your@email.com"><button class="btn btn-primary">Subscribe →</button></div>
      </div>
    </div>
  </section>
</div>

<footer>
  <div class="footer-inner">
    <div class="footer-top">
      <div class="footer-brand"><a href="corp-index.html" class="footer-logo"><div class="logo-mark">AM</div>Alex Morgan</a><p class="footer-brand-desc">Principal Software Engineer. Distributed systems, cloud, and engineering leadership.</p></div>
      <div class="footer-col"><h4>Navigation</h4><div class="footer-col-links"><a href="corp-index.html">Home</a><a href="corp-about.html">About</a><a href="corp-portfolio.html">Portfolio</a><a href="corp-blog.html">Insights</a><a href="corp-contact.html">Contact</a></div></div>
      <div class="footer-col"><h4>Connect</h4><div class="footer-col-links"><a href="#">GitHub</a><a href="#">LinkedIn</a><a href="#">Twitter</a></div></div>
      <div class="footer-col"><h4>Services</h4><div class="footer-col-links"><a href="#">Architecture Review</a><a href="#">CTO Advisory</a><a href="#">Consulting</a></div></div>
    </div>
    <div class="footer-bottom"><a href="corp-index.html" class="footer-logo" style="font-size:0.85rem;"><div class="logo-mark" style="width:24px;height:24px;font-size:0.6rem;">AM</div>Alex Morgan</a><p>© 2026 Alex Morgan. All rights reserved.</p></div>
  </div>
</footer>
<script src="corp-main.js"></script>
<script>
  document.querySelectorAll('.cat-btn').forEach(b => b.addEventListener('click', () => { document.querySelectorAll('.cat-btn').forEach(x => x.classList.remove('active')); b.classList.add('active'); filter(); }));
  document.getElementById('searchInput').addEventListener('input', filter);
  function filter() {
    const cat = document.querySelector('.cat-btn.active').dataset.cat;
    const q = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('.blog-card').forEach(c => {
      const cm = cat === 'all' || (c.dataset.cat||'').includes(cat);
      const tm = !q || c.querySelector('.blog-title').textContent.toLowerCase().includes(q) || c.querySelector('.blog-excerpt').textContent.toLowerCase().includes(q);
      c.classList.toggle('hide', !cm || !tm);
    });
  }
</script>
</body>
</html>
