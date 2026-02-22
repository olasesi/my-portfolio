<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact — Alex Morgan</title>
<link rel="stylesheet" href="corp-style.css">
<style>
.contact-hero { background:var(--navy);padding:6rem 0 0;position:relative;overflow:hidden; }
.ch-bg { position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.025) 1px,transparent 1px);background-size:60px 60px; }
.ch-inner { max-width:1320px;margin:0 auto;padding:0 3rem;position:relative;z-index:2; }
.ch-title { font-family:var(--display);font-size:clamp(3rem,5vw,4.5rem);font-weight:900;color:white;line-height:1;margin-bottom:1rem;max-width:600px; }
.ch-sub { font-size:0.95rem;color:rgba(255,255,255,0.45);line-height:1.75;max-width:480px;margin-bottom:4rem; }
.ch-grid { display:grid;grid-template-columns:1fr 1.6fr; }
.ch-left { padding:4rem 3rem 5rem 0; }
.ch-right { background:white;padding:4rem 3rem;border-radius:var(--r-lg) var(--r-lg) 0 0;margin-bottom:-1px; }

/* INFO CARDS */
.info-stack { display:flex;flex-direction:column;gap:1rem;margin-bottom:3rem; }
.info-card { display:flex;align-items:flex-start;gap:1rem;padding:1.25rem;border:1px solid rgba(255,255,255,0.08);border-radius:10px;background:rgba(255,255,255,0.04); }
.ic-icon { width:38px;height:38px;border-radius:8px;background:rgba(200,146,42,0.15);border:1px solid rgba(200,146,42,0.2);display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0; }
.ic-label { font-size:0.65rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-bottom:0.2rem; }
.ic-val { font-size:0.88rem;color:rgba(255,255,255,0.7); }
.ic-val a { color:rgba(255,255,255,0.7);text-decoration:none;transition:color 0.2s; }
.ic-val a:hover { color:var(--gold); }

/* AVAIL */
.avail-block { background:rgba(16,185,129,0.08);border:1px solid rgba(16,185,129,0.2);border-radius:10px;padding:1.25rem;margin-bottom:2rem; }
.avail-row { display:flex;align-items:center;gap:0.6rem;margin-bottom:0.5rem; }
.avail-pulse { width:8px;height:8px;border-radius:50%;background:#10B981;animation:p 2s infinite; }
@keyframes p{0%,100%{opacity:1}50%{opacity:0.3}}
.avail-title { font-size:0.82rem;font-weight:700;color:#34D399; }
.avail-detail { font-size:0.78rem;color:rgba(255,255,255,0.4);line-height:1.6;padding-left:1.4rem; }

/* SOCIALS */
.social-row { display:flex;gap:0.75rem;flex-wrap:wrap; }
.soc-btn { display:flex;align-items:center;gap:0.5rem;padding:0.55rem 1rem;border-radius:8px;border:1.5px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.5);font-size:0.78rem;font-weight:600;text-decoration:none;transition:all 0.2s; }
.soc-btn:hover { border-color:var(--gold);color:var(--gold); }

/* FORM */
.form-title { font-family:var(--display);font-size:1.6rem;font-weight:900;color:var(--navy);margin-bottom:0.4rem; }
.form-sub { font-size:0.85rem;color:var(--ink3);margin-bottom:2.5rem; }
.fg { margin-bottom:1.4rem; }
.fl { display:block;font-size:0.72rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:var(--ink2);margin-bottom:0.5rem; }
.fc { width:100%;padding:0.8rem 1rem;border:1.5px solid var(--border);border-radius:8px;background:var(--off);font-family:var(--body);font-size:0.88rem;color:var(--ink);outline:none;transition:all 0.2s;appearance:none; }
.fc:focus { border-color:var(--navy);background:white;box-shadow:0 0 0 3px rgba(11,31,58,0.06); }
.fc::placeholder { color:var(--ink3); }
textarea.fc { resize:vertical;min-height:120px; }
.fr { display:grid;grid-template-columns:1fr 1fr;gap:1.25rem; }

/* CHIPS */
.service-chips { display:flex;flex-wrap:wrap;gap:0.5rem;margin-top:0.5rem; }
.sc { font-size:0.75rem;font-weight:600;padding:0.4rem 0.9rem;border-radius:6px;border:1.5px solid var(--border);background:white;color:var(--ink2);cursor:pointer;transition:all 0.2s;user-select:none;letter-spacing:0.02em; }
.sc:hover { border-color:var(--navy); }
.sc.on { background:var(--navy);color:white;border-color:var(--navy); }

/* SUBMIT */
.submit-row { display:flex;align-items:center;gap:1.5rem;margin-top:2rem; }
.btn-submit { background:var(--navy);color:white;border:none;border-radius:8px;padding:1rem 2rem;font-family:var(--body);font-size:0.85rem;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;cursor:pointer;display:flex;align-items:center;gap:0.6rem;transition:all 0.25s; }
.btn-submit:hover { background:var(--navy-light);transform:translateY(-2px);box-shadow:var(--sh-md); }
.privacy-note { font-size:0.72rem;color:var(--ink3); }

/* SUCCESS */
.form-success { display:none;text-align:center;padding:4rem 2rem; }
.fs-icon { font-size:3.5rem;margin-bottom:1rem; }
.fs-title { font-family:var(--display);font-size:1.6rem;font-weight:900;color:var(--navy);margin-bottom:0.75rem; }
.fs-sub { font-size:0.9rem;color:var(--ink3);line-height:1.7; }

/* PROCESS */
.process-section { background:var(--off);padding:6rem 0; }
.process-grid { display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-top:4rem;position:relative; }
.process-grid::before { content:'';position:absolute;top:2.2rem;left:calc(12.5% + 1rem);right:calc(12.5% + 1rem);height:1px;background:var(--border);z-index:0; }
.proc-card { background:white;border:1px solid var(--border);border-radius:var(--r-lg);padding:2rem;text-align:center;position:relative;z-index:1;transition:all 0.3s; }
.proc-card:hover { transform:translateY(-5px);box-shadow:var(--sh-md);border-color:var(--ice); }
.proc-num { width:44px;height:44px;border-radius:50%;background:var(--navy);color:white;font-family:var(--display);font-size:1rem;font-weight:900;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;position:relative;z-index:1; }
.proc-title { font-family:var(--display);font-size:0.95rem;font-weight:800;margin-bottom:0.5rem; }
.proc-text { font-size:0.8rem;color:var(--ink3);line-height:1.65; }

/* FAQ */
.faq-grid { display:grid;grid-template-columns:1fr 1fr;gap:1px;background:var(--border);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;margin-top:3.5rem; }
.faq-item { background:white;padding:2rem; }
.faq-q-text { font-family:var(--display);font-size:1rem;font-weight:800;color:var(--navy);margin-bottom:0.75rem; }
.faq-a-text { font-size:0.85rem;color:var(--ink3);line-height:1.75; }

@media(max-width:1024px) { .ch-grid{grid-template-columns:1fr;} .ch-left{padding:3rem 0;} .process-grid{grid-template-columns:1fr 1fr;} .process-grid::before{display:none;} .faq-grid{grid-template-columns:1fr;} }
@media(max-width:600px) { .fr{grid-template-columns:1fr;} }
</style>
</head>
<body>
<nav class="nav">
  <div class="nav-inner">
    <a href="corp-index.html" class="nav-logo"><div class="nav-logo-badge">AM</div>Alex Morgan</a>
    <div class="nav-center"><a href="corp-index.html">Home</a><a href="corp-about.html">About</a><a href="corp-portfolio.html">Portfolio</a><a href="corp-blog.html">Insights</a></div>
    <div class="nav-right"><a href="corp-contact.html" class="nav-btn active" style="background:var(--gold-light);">Hire Me</a></div>
    <button class="nav-mobile-btn"><span></span><span></span><span></span></button>
  </div>
</nav>
<div class="page-wrap">

<section class="contact-hero">
  <div class="ch-bg"></div>
  <div class="ch-inner">
    <div class="eyebrow reveal" style="color:var(--gold);">Get In Touch</div>
    <h1 class="ch-title reveal rd1">Let's build something<br><span style="color:var(--gold);">that scales.</span></h1>
    <p class="ch-sub reveal rd2">I take on a limited number of engagements each quarter. Tell me about your project and I'll get back to you within 24 hours.</p>
    <div class="ch-grid reveal rd2">
      <div class="ch-left">
        <div class="avail-block">
          <div class="avail-row"><div class="avail-pulse"></div><span class="avail-title">Currently available for new work</span></div>
          <div class="avail-detail">Taking on contracts starting Q2 2026. Capacity is limited — reach out early.</div>
        </div>
        <div class="info-stack">
          <div class="info-card"><div class="ic-icon">📍</div><div><div class="ic-label">Based in</div><div class="ic-val">San Francisco, CA (Remote-first)</div></div></div>
          <div class="info-card"><div class="ic-icon">📧</div><div><div class="ic-label">Email</div><div class="ic-val"><a href="mailto:alex@alexmorgan.dev">alex@alexmorgan.dev</a></div></div></div>
          <div class="info-card"><div class="ic-icon">🕐</div><div><div class="ic-label">Response time</div><div class="ic-val">Within 24 hours on weekdays (PT)</div></div></div>
          <div class="info-card"><div class="ic-icon">💼</div><div><div class="ic-label">Open to</div><div class="ic-val">Contract · Advisory · Consulting</div></div></div>
        </div>
        <p style="font-size:0.65rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.25);margin-bottom:1rem;">CONNECT</p>
        <div class="social-row">
          <a href="#" class="soc-btn">🐙 GitHub</a>
          <a href="#" class="soc-btn">💼 LinkedIn</a>
          <a href="#" class="soc-btn">🐦 Twitter</a>
          <a href="#" class="soc-btn">✍️ Dev.to</a>
        </div>
      </div>
      <div class="ch-right">
        <div id="formWrap">
          <div class="form-title">Send a message</div>
          <p class="form-sub">Fill in the details below. I read every message personally.</p>
          <form onsubmit="handleSubmit(event)">
            <div class="fr">
              <div class="fg"><label class="fl">First Name *</label><input type="text" class="fc" placeholder="John" required></div>
              <div class="fg"><label class="fl">Last Name *</label><input type="text" class="fc" placeholder="Doe" required></div>
            </div>
            <div class="fr">
              <div class="fg"><label class="fl">Email *</label><input type="email" class="fc" placeholder="john@company.com" required></div>
              <div class="fg"><label class="fl">Company</label><input type="text" class="fc" placeholder="Acme Corp"></div>
            </div>
            <div class="fg">
              <label class="fl">I need help with</label>
              <div class="service-chips">
                <div class="sc" onclick="this.classList.toggle('on')">System Architecture</div>
                <div class="sc" onclick="this.classList.toggle('on')">Cloud Infrastructure</div>
                <div class="sc" onclick="this.classList.toggle('on')">Backend Engineering</div>
                <div class="sc" onclick="this.classList.toggle('on')">Technical Advisory</div>
                <div class="sc" onclick="this.classList.toggle('on')">Code Review</div>
                <div class="sc" onclick="this.classList.toggle('on')">Team Leadership</div>
              </div>
            </div>
            <div class="fg">
              <label class="fl">Budget Range</label>
              <select class="fc">
                <option value="">Select...</option>
                <option>Under $10,000</option>
                <option>$10,000 – $25,000</option>
                <option>$25,000 – $75,000</option>
                <option>$75,000+</option>
                <option>Ongoing retainer</option>
              </select>
            </div>
            <div class="fg"><label class="fl">Project Description *</label><textarea class="fc" placeholder="Describe your project, technical context, timeline, and any specific challenges you're facing..." required></textarea></div>
            <div class="submit-row">
              <button type="submit" class="btn-submit">Send Message <span>→</span></button>
              <span class="privacy-note">🔒 Confidential & never shared</span>
            </div>
          </form>
        </div>
        <div class="form-success" id="formSuccess">
          <div class="fs-icon">✅</div>
          <div class="fs-title">Message received!</div>
          <p class="fs-sub">Thanks for reaching out. I'll review your project details and reply within 24 hours on weekdays.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PROCESS -->
<section class="process-section">
  <div class="container">
    <div class="eyebrow reveal">How It Works</div>
    <h2 class="h2 reveal rd1">From first contact<br>to first commit.</h2>
    <div class="process-grid">
      <div class="proc-card reveal rd1"><div class="proc-num">01</div><div class="proc-title">Discovery Call</div><p class="proc-text">A 30-minute call to understand your challenge, constraints, and goals. No sales pitch — just an honest conversation.</p></div>
      <div class="proc-card reveal rd2"><div class="proc-num">02</div><div class="proc-title">Proposal & Scope</div><p class="proc-text">A detailed written proposal with scope, timeline, deliverables, and pricing. Typically within 48 hours.</p></div>
      <div class="proc-card reveal rd3"><div class="proc-num">03</div><div class="proc-title">Kickoff</div><p class="proc-text">Agreements signed, tools set up, first sprint planned. I'm embedded and moving within the first week.</p></div>
      <div class="proc-card reveal rd4"><div class="proc-num">04</div><div class="proc-title">Delivery</div><p class="proc-text">Weekly updates, async-first communication, and a clean handoff with documentation that actually makes sense.</p></div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section" style="padding-top:0;">
  <div class="container">
    <div class="rule" style="margin-bottom:5rem;"></div>
    <div class="eyebrow reveal">FAQ</div>
    <h2 class="h2 reveal rd1">Common questions</h2>
    <div class="faq-grid">
      <div class="faq-item reveal rd1"><div class="faq-q-text">What's your typical engagement model?</div><p class="faq-a-text">I prefer 3–6 month fixed-scope contracts with clear milestones, but I also take on advisory retainers (4–8 hrs/month) for funded startups that need an expert on call without a full engagement.</p></div>
      <div class="faq-item reveal rd2"><div class="faq-q-text">Do you work with early-stage startups?</div><p class="faq-a-text">Yes, selectively. I love working with technical founders on early architecture decisions — the ones that compound over time. These engagements are typically shorter and more focused.</p></div>
      <div class="faq-item reveal rd1"><div class="faq-q-text">What's your rate?</div><p class="faq-a-text">Project-based work starts at $15,000. Hourly advisory rates are available for existing clients. I'm happy to discuss options in an initial call — I'd rather find a structure that works for both sides than lose a great project over pricing.</p></div>
      <div class="faq-item reveal rd2"><div class="faq-q-text">Can you sign an NDA?</div><p class="faq-a-text">Absolutely. I have a standard mutual NDA ready to go, or I'm happy to review yours. Confidentiality is a baseline expectation on every engagement.</p></div>
      <div class="faq-item reveal rd1"><div class="faq-q-text">Do you do remote work?</div><p class="faq-a-text">Yes — I've been remote-first since 2019 and operate with strong async habits. I'm in the PT timezone and available for occasional on-site visits in the SF Bay Area or NYC.</p></div>
      <div class="faq-item reveal rd2"><div class="faq-q-text">How soon can you start?</div><p class="faq-a-text">Typically 2–3 weeks after agreements are signed. If you have an urgent need, mention it in your message and I'll let you know if I can accommodate a faster start.</p></div>
    </div>
  </div>
</section>
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
  function handleSubmit(e) {
    e.preventDefault();
    const btn = e.target.querySelector('.btn-submit');
    btn.textContent = 'Sending...'; btn.disabled = true;
    setTimeout(() => {
      document.getElementById('formWrap').style.display = 'none';
      document.getElementById('formSuccess').style.display = 'block';
    }, 1000);
  }
</script>
</body>
</html>
