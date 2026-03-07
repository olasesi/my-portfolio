<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>500 — Server Error · Ahmed Olusesi</title>
<link rel="stylesheet" href="/assets/styles/style.css">
<style>
.error-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 3rem; }
.error-code { font-family: var(--display); font-size: clamp(6rem,20vw,12rem); font-weight: 800; letter-spacing: -0.06em; line-height: 1; color: var(--bg3); user-select: none; }
.error-title { font-family: var(--display); font-size: clamp(1.5rem,4vw,2.5rem); font-weight: 800; letter-spacing: -0.03em; margin-bottom: 1rem; margin-top: 0.5rem; }
.error-desc { font-size: 1rem; color: var(--ink3); line-height: 1.7; max-width: 420px; margin: 0 auto 2.5rem; }
.error-actions { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
.error-accent { color: var(--accent); }
</style>
</head>
<body>

<div class="error-page">
    <div>
        <div class="error-code">500</div>
        <h1 class="error-title">Something went <span class="error-accent">wrong.</span></h1>
        <p class="error-desc">
            There's a server-side error happening right now. It's being looked into.
            Try refreshing in a moment, or head back home.
        </p>
        <div class="error-actions">
            <a href="/" class="btn btn-primary btn-lg">Go Home</a>
            <a href="/contact" class="btn btn-outline btn-lg">Report the Issue</a>
        </div>
    </div>
</div>

</body>
</html>