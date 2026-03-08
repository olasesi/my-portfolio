<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact — Ahmed Olusesi</title>
  <meta name="description" content="Hire Ahmed Olusesi — full-stack developer based in Lagos, Nigeria. Open to freelance, contract, and full-time roles. Remote worldwide." />
  <link rel="stylesheet" href="./assets/styles/style.css" />
  <style>

    /* ─── HERO ─── */
    .contact-hero { padding: 5rem 0 0; border-bottom: 1px solid var(--border); position: relative; overflow: hidden; }
    .contact-hero::before {
      content: ""; position: absolute; top: -100px; left: -100px;
      width: 500px; height: 500px; border-radius: 50%;
      background: radial-gradient(circle, rgba(0,201,174,0.04) 0%, transparent 70%);
      pointer-events: none;
    }
    .ch-inner { display: grid; grid-template-columns: 1fr 1.55fr; gap: 5rem; padding-bottom: 0; align-items: start; }
    .ch-left { padding-bottom: 5rem; padding-top: 1rem; }
    .ch-right {
      background: var(--navy-2); padding: 3.5rem;
      border-radius: var(--radius-lg) var(--radius-lg) 0 0;
      border: 1px solid var(--border-light); border-bottom: none;
    }

    /* ─── AVAILABILITY BLOCK ─── */
    .avail-block {
      display: flex; align-items: flex-start; gap: 0.75rem;
      background: rgba(0,201,174,0.06);
      border: 1px solid rgba(0,201,174,0.2);
      border-radius: 10px; padding: 1rem 1.1rem; margin-bottom: 2.25rem;
    }
    .avail-dot {
      width: 8px; height: 8px; border-radius: 50%;
      background: var(--teal); margin-top: 4px; flex-shrink: 0;
      box-shadow: 0 0 0 3px rgba(0,201,174,0.2);
      animation: blink 2.5s ease-in-out infinite;
    }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }
    .avail-text { font-size: 0.82rem; font-weight: 600; color: var(--teal); line-height: 1.5; }
    .avail-sub { font-size: 0.75rem; color: var(--slate); margin-top: 0.2rem; }

    /* ─── INFO STACK ─── */
    .info-stack { display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 2.5rem; }
    .info-card {
      display: flex; align-items: flex-start; gap: 0.9rem;
      padding: 1rem; border: 1px solid var(--border-light);
      border-radius: 10px; background: rgba(255,255,255,0.03);
    }
    .ic-icon {
      font-size: 1rem; width: 36px; height: 36px;
      background: rgba(0,201,174,0.08);
      border: 1px solid rgba(0,201,174,0.15);
      border-radius: 8px; display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .ic-label {
      font-size: 0.63rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase; color: var(--slate); margin-bottom: 0.2rem;
    }
    .ic-val { font-size: 0.875rem; color: var(--slate-light); }
    .ic-val a { color: var(--slate-light); text-decoration: none; transition: color var(--transition); }
    .ic-val a:hover { color: var(--teal); }

    /* ─── SOCIAL BUTTONS ─── */
    .social-row { display: flex; gap: 0.5rem; flex-wrap: wrap; }
    .soc-btn {
      display: flex; align-items: center; gap: 0.4rem;
      padding: 0.5rem 0.9rem; border-radius: 8px;
      border: 1px solid var(--border-light);
      color: var(--slate-light); font-size: 0.78rem; font-weight: 600;
      text-decoration: none; transition: all var(--transition);
      background: rgba(255,255,255,0.03);
    }
    .soc-btn:hover { border-color: var(--teal); color: var(--teal); background: rgba(0,201,174,0.06); }

    /* ─── FORM ─── */
    .form-title {
      font-family: var(--display); font-size: 1.5rem; font-weight: 800;
      color: var(--white); margin-bottom: 0.4rem; letter-spacing: -0.025em;
    }
    .form-sub { font-size: 0.85rem; color: var(--slate); margin-bottom: 2.5rem; }
    .fg { margin-bottom: 1.35rem; }
    .fl {
      display: block; font-size: 0.7rem; font-weight: 700;
      letter-spacing: 0.07em; text-transform: uppercase;
      color: var(--slate-light); margin-bottom: 0.5rem;
    }
    .fc {
      width: 100%; padding: 0.8rem 1rem;
      border: 1px solid var(--border-light);
      border-radius: 8px;
      background: rgba(255,255,255,0.04);
      font-family: var(--body); font-size: 0.88rem;
      color: var(--white); outline: none;
      transition: all var(--transition); appearance: none;
    }
    .fc:focus {
      border-color: var(--teal);
      background: rgba(255,255,255,0.07);
      box-shadow: 0 0 0 3px rgba(0,201,174,0.08);
    }
    .fc::placeholder { color: var(--slate); }
    .fc option { background: var(--navy-2); color: var(--white); }
    textarea.fc { resize: vertical; min-height: 120px; }
    .fr { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }

    /* ─── SERVICE CHIPS ─── */
    .service-chips { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.5rem; }
    .sc {
      font-size: 0.73rem; font-weight: 600; padding: 0.4rem 0.9rem;
      border-radius: 6px; border: 1px solid var(--border-light);
      background: rgba(255,255,255,0.03); color: var(--slate-light);
      cursor: pointer; transition: all var(--transition); user-select: none;
    }
    .sc:hover { border-color: var(--teal); color: var(--teal); }
    .sc.on { background: rgba(0,201,174,0.12); color: var(--teal); border-color: rgba(0,201,174,0.4); }

    /* ─── SUBMIT ─── */
    .submit-row { display: flex; align-items: center; gap: 1.5rem; margin-top: 2rem; }
    .btn-submit {
      background: var(--teal); color: var(--navy);
      border: none; border-radius: 8px;
      padding: 0.9rem 2rem; font-family: var(--body);
      font-size: 0.875rem; font-weight: 700;
      cursor: pointer; display: flex; align-items: center; gap: 0.5rem;
      transition: all var(--transition);
    }
    .btn-submit:hover { background: #00DEC0; transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,201,174,0.35); }
    .btn-submit:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
    .privacy-note { font-size: 0.72rem; color: var(--slate); }

    /* ─── SUCCESS STATE ─── */
    .form-success { display: none; text-align: center; padding: 4rem 2rem; }
    .fs-icon { font-size: 3.5rem; margin-bottom: 1rem; }
    .fs-title { font-family: var(--display); font-size: 1.6rem; font-weight: 800; color: var(--white); margin-bottom: 0.75rem; }
    .fs-sub { font-size: 0.9rem; color: var(--slate-light); line-height: 1.7; }

    /* ─── PROCESS ─── */
    .process-section {
      background: linear-gradient(180deg, transparent 0%, var(--navy-2) 30%, var(--navy-2) 70%, transparent 100%);
      padding: 6rem 0;
    }
    .process-grid {
      display: grid; grid-template-columns: repeat(4,1fr);
      gap: 1.5rem; margin-top: 4rem;
    }
    .proc-card {
      background: var(--card-bg); border: 1px solid var(--border);
      border-radius: var(--radius-lg); padding: 2rem; text-align: center;
      transition: all var(--transition); position: relative;
    }
    .proc-card::after {
      content: ""; position: absolute; top: 0; left: 0; right: 0; height: 2px;
      background: var(--teal); transform: scaleX(0); transform-origin: left;
      transition: transform var(--transition);
    }
    .proc-card:hover { background: var(--card-hover); border-color: var(--border-light); transform: translateY(-4px); }
    .proc-card:hover::after { transform: scaleX(1); }
    .proc-num {
      width: 44px; height: 44px; border-radius: 50%;
      background: var(--teal); color: var(--navy);
      font-family: var(--display); font-size: 1rem; font-weight: 800;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 1.25rem;
    }
    .proc-title { font-size: 0.95rem; font-weight: 700; color: var(--white); margin-bottom: 0.5rem; }
    .proc-text { font-size: 0.8rem; color: var(--slate); line-height: 1.7; }

    /* ─── FAQ ─── */
    .faq-grid {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 1px; background: var(--border);
      border: 1px solid var(--border-light);
      border-radius: var(--radius-lg); overflow: hidden;
      margin-top: 3.5rem;
    }
    .faq-item { background: var(--navy); padding: 2rem; transition: background var(--transition); }
    .faq-item:hover { background: var(--navy-2); }
    .faq-q { font-size: 0.95rem; font-weight: 700; color: var(--white); margin-bottom: 0.75rem; }
    .faq-a { font-size: 0.85rem; color: var(--slate-light); line-height: 1.8; }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 1024px) {
      .ch-inner { grid-template-columns: 1fr; }
      .ch-left { padding-bottom: 0; }
      .ch-right { border-radius: var(--radius-lg); border: 1px solid var(--border-light); }
      .process-grid { grid-template-columns: 1fr 1fr; }
      .faq-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
      .fr { grid-template-columns: 1fr; }
      .process-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<?php
/* ── Server-side form handling ── */
$sent    = false;
$error   = false;
$fields  = ['fname','lname','email','company','message'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fname'])) {
  $fname   = trim(strip_tags($_POST['fname']   ?? ''));
  $lname   = trim(strip_tags($_POST['lname']   ?? ''));
  $email   = filter_var(trim($_POST['email']   ?? ''), FILTER_VALIDATE_EMAIL);
  $company = trim(strip_tags($_POST['company'] ?? ''));
  $budget  = trim(strip_tags($_POST['budget']  ?? ''));
  $message = trim(strip_tags($_POST['message'] ?? ''));

  if ($fname && $lname && $email && $message) {
    $to      = 'olusesia@gmail.com';
    $subject = "Portfolio enquiry from $fname $lname" . ($company ? " — $company" : '');
    $body    = "Name: $fname $lname\n";
    $body   .= "Email: $email\n";
    if ($company)  $body .= "Company: $company\n";
    if ($budget)   $body .= "Budget: $budget\n";
    $body   .= "\nMessage:\n$message";
    $headers = "From: noreply@ahmedolusesi.com\r\nReply-To: $email\r\nX-Mailer: PHP/" . phpversion();

    $sent = @mail($to, $subject, $body, $headers);
    if (!$sent) $error = true;
  } else {
    $error = true;
  }
}
?>

  <?php include './includes/nav.php'; ?>

  <div class="page-wrap">

    <!-- ════════════════════════════════
         HERO
    ═════════════════════════════════ -->
    <section class="contact-hero">
      <div class="container">
        <div class="eyebrow reveal" style="margin-bottom:1.5rem;">Get In Touch</div>
        <h1 class="display-lg reveal reveal-d1" style="margin-bottom:1rem;">
          Let's build something<br /><span class="teal">worth using.</span>
        </h1>
        <p class="section-sub reveal reveal-d2" style="margin-bottom:3rem;">
          I take on a limited number of projects at a time. Tell me what you're building
          and I'll come back to you within 24 hours.
        </p>
        <div class="ch-inner reveal reveal-d2">

          <!-- Left: info -->
          <div class="ch-left">
            <div class="avail-block">
              <div class="avail-dot"></div>
              <div>
                <div class="avail-text">Currently available for new projects</div>
                <div class="avail-sub">Freelance · Contract · Full-time — remote worldwide</div>
              </div>
            </div>

            <div class="info-stack">
              <div class="info-card">
                <div class="ic-icon">📍</div>
                <div>
                  <div class="ic-label">Based in</div>
                  <div class="ic-val">Ikeja, Lagos — Nigeria</div>
                </div>
              </div>
              <div class="info-card">
                <div class="ic-icon">📧</div>
                <div>
                  <div class="ic-label">Email</div>
                  <div class="ic-val"><a href="mailto:olusesia@gmail.com">olusesia@gmail.com</a></div>
                </div>
              </div>
              <div class="info-card">
                <div class="ic-icon">📞</div>
                <div>
                  <div class="ic-label">Phone</div>
                  <div class="ic-val">
                    <a href="tel:+2349061937121">+234 906 193 7121</a><br />
                    <a href="tel:+2348074574512">+234 807 457 4512</a>
                  </div>
                </div>
              </div>
              <div class="info-card">
                <div class="ic-icon">🕐</div>
                <div>
                  <div class="ic-label">Response time</div>
                  <div class="ic-val">Within 24 hours on weekdays (WAT)</div>
                </div>
              </div>
              <div class="info-card">
                <div class="ic-icon">💼</div>
                <div>
                  <div class="ic-label">Open to</div>
                  <div class="ic-val">Freelance · Contract · Full-time</div>
                </div>
              </div>
            </div>

            <p style="font-size:0.63rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:var(--slate);margin-bottom:1rem;">Connect</p>
            <div class="social-row">
              <a href="https://github.com/olasesi" target="_blank" rel="noopener" class="soc-btn">⌥ GitHub</a>
              <a href="https://linkedin.com/in/ahmedolusesi" target="_blank" rel="noopener" class="soc-btn">🔗 LinkedIn</a>
            </div>
          </div>

          <!-- Right: form -->
          <div class="ch-right">
            <?php if ($sent): ?>
              <div class="form-success" style="display:block;">
                <div class="fs-icon">✅</div>
                <div class="fs-title">Message received!</div>
                <p class="fs-sub">
                  Thanks for reaching out. I'll read your message and reply within
                  24 hours on weekdays.
                </p>
              </div>
            <?php else: ?>
              <div id="formWrap">
                <div class="form-title">Send a message</div>
                <p class="form-sub">Fill in the details below — I read every message personally.</p>

                <?php if ($error): ?>
                  <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:8px;padding:0.9rem 1rem;margin-bottom:1.5rem;font-size:0.85rem;color:#FCA5A5;">
                    Something went wrong. Please check your details and try again.
                  </div>
                <?php endif; ?>

                <form method="POST" action="contact.php">
                  <div class="fr">
                    <div class="fg">
                      <label class="fl" for="fname">First Name *</label>
                      <input type="text" id="fname" name="fname" class="fc" placeholder="e.g. Tunde" required
                        value="<?= htmlspecialchars($_POST['fname'] ?? '') ?>" />
                    </div>
                    <div class="fg">
                      <label class="fl" for="lname">Last Name *</label>
                      <input type="text" id="lname" name="lname" class="fc" placeholder="e.g. Adeyemi" required
                        value="<?= htmlspecialchars($_POST['lname'] ?? '') ?>" />
                    </div>
                  </div>
                  <div class="fr">
                    <div class="fg">
                      <label class="fl" for="email">Email *</label>
                      <input type="email" id="email" name="email" class="fc" placeholder="you@company.com" required
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
                    </div>
                    <div class="fg">
                      <label class="fl" for="company">Company / Organisation</label>
                      <input type="text" id="company" name="company" class="fc" placeholder="Optional"
                        value="<?= htmlspecialchars($_POST['company'] ?? '') ?>" />
                    </div>
                  </div>
                  <div class="fg">
                    <label class="fl">I need help with</label>
                    <div class="service-chips">
                      <div class="sc" onclick="this.classList.toggle('on')">Web Development</div>
                      <div class="sc" onclick="this.classList.toggle('on')">Mobile App</div>
                      <div class="sc" onclick="this.classList.toggle('on')">Backend / API</div>
                      <div class="sc" onclick="this.classList.toggle('on')">UI/UX to Code</div>
                      <div class="sc" onclick="this.classList.toggle('on')">DevOps / Deployment</div>
                      <div class="sc" onclick="this.classList.toggle('on')">Code Review / Audit</div>
                    </div>
                  </div>
                  <div class="fg">
                    <label class="fl" for="budget">Approximate Budget</label>
                    <select id="budget" name="budget" class="fc">
                      <option value="">Select a range...</option>
                      <option <?= ($_POST['budget'] ?? '') === 'Under ₦500k' ? 'selected' : '' ?>>Under ₦500k</option>
                      <option <?= ($_POST['budget'] ?? '') === '₦500k – ₦1.5M' ? 'selected' : '' ?>>₦500k – ₦1.5M</option>
                      <option <?= ($_POST['budget'] ?? '') === '₦1.5M – ₦5M' ? 'selected' : '' ?>>₦1.5M – ₦5M</option>
                      <option <?= ($_POST['budget'] ?? '') === '₦5M+' ? 'selected' : '' ?>>₦5M+</option>
                      <option <?= ($_POST['budget'] ?? '') === 'Ongoing retainer' ? 'selected' : '' ?>>Ongoing retainer</option>
                      <option <?= ($_POST['budget'] ?? '') === 'Prefer to discuss' ? 'selected' : '' ?>>Prefer to discuss</option>
                    </select>
                  </div>
                  <div class="fg">
                    <label class="fl" for="message">Tell me about the project *</label>
                    <textarea id="message" name="message" class="fc" placeholder="Describe what you want to build, any technical context, your timeline, and any specific challenges you're facing..." required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                  </div>
                  <div class="submit-row">
                    <button type="submit" class="btn-submit">
                      Send Message
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                    <span class="privacy-note">🔒 Confidential &amp; never shared</span>
                  </div>
                </form>
              </div>
            <?php endif; ?>
          </div>

        </div>
      </div>
    </section>

    <!-- ════════════════════════════════
         PROCESS
    ═════════════════════════════════ -->
    <section class="process-section">
      <div class="container">
        <div class="sh">
          <div>
            <div class="eyebrow reveal">How It Works</div>
            <h2 class="display-md reveal reveal-d1">
              From first message<br />to first commit.
            </h2>
          </div>
        </div>
        <div class="process-grid">
          <div class="proc-card reveal">
            <div class="proc-num">01</div>
            <div class="proc-title">Discovery</div>
            <p class="proc-text">A quick call or message exchange to understand your project, goals, and constraints. No pitch — just a real conversation about what you need.</p>
          </div>
          <div class="proc-card reveal reveal-d1">
            <div class="proc-num">02</div>
            <div class="proc-title">Proposal & Scope</div>
            <p class="proc-text">A clear written breakdown of scope, timeline, deliverables, and cost. Typically back to you within 48 hours of our first conversation.</p>
          </div>
          <div class="proc-card reveal reveal-d2">
            <div class="proc-num">03</div>
            <div class="proc-title">Kickoff</div>
            <p class="proc-text">Agreements in place, environment set up, first sprint planned and underway — moving within the first week, no long ramp-up periods.</p>
          </div>
          <div class="proc-card reveal reveal-d3">
            <div class="proc-num">04</div>
            <div class="proc-title">Delivery</div>
            <p class="proc-text">Regular updates, async-first communication, and a clean handoff with documentation that makes sense. You own the code completely.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ════════════════════════════════
         FAQ
    ═════════════════════════════════ -->
    <section class="section" style="padding-top:0;">
      <div class="container">
        <div class="sh">
          <div>
            <div class="eyebrow reveal">FAQ</div>
            <h2 class="display-md reveal reveal-d1">Common questions</h2>
          </div>
        </div>
        <div class="faq-grid">
          <div class="faq-item reveal">
            <div class="faq-q">What kind of projects do you take on?</div>
            <p class="faq-a">Web apps, mobile apps (iOS &amp; Android), APIs, ERP/CRM systems, e-commerce builds, and CMS-based sites. I prefer projects where I can own the full stack — from database to UI — rather than just a small piece.</p>
          </div>
          <div class="faq-item reveal reveal-d1">
            <div class="faq-q">Do you work with startups or established businesses?</div>
            <p class="faq-a">Both. Early-stage startups often need someone who can move fast and wear multiple hats — that's a natural fit. Established businesses usually need someone who can come in, understand an existing codebase, and make improvements without breaking things.</p>
          </div>
          <div class="faq-item reveal">
            <div class="faq-q">What's your pricing model?</div>
            <p class="faq-a">Fixed-price for scoped projects, hourly for smaller engagements or ongoing retainers. I'll always give you a clear number upfront — no ambiguous "we'll see how it goes" arrangements.</p>
          </div>
          <div class="faq-item reveal reveal-d1">
            <div class="faq-q">How do you handle confidentiality?</div>
            <p class="faq-a">Happy to sign an NDA before any detailed discussion. Confidentiality is a default, not a negotiation. Everything you share stays between us.</p>
          </div>
          <div class="faq-item reveal">
            <div class="faq-q">Are you available for remote work?</div>
            <p class="faq-a">Yes — fully. I'm based in Lagos (WAT timezone) and have worked remotely with clients across Nigeria, the UK, and the US. Async-first with regular video check-ins works well for most projects.</p>
          </div>
          <div class="faq-item reveal reveal-d1">
            <div class="faq-q">How quickly can you start?</div>
            <p class="faq-a">Typically within 1–2 weeks of agreeing scope and terms. If you have an urgent start date, mention it in your message and I'll let you know whether I can accommodate it.</p>
          </div>
        </div>
      </div>
    </section>

  </div><!-- /page-wrap -->

  <?php include './includes/footer.php'; ?>

  <script src="./assets/js/main.js"></script>

</body>
</html>