<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = trim($_POST['password'] ?? '');
    if ($password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Hash Generator</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #07111F; color: #AAC0D6; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .card { background: #0C1A2E; border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 520px; }
        h1 { font-size: 1.2rem; font-weight: 800; color: #fff; margin-bottom: 0.25rem; }
        .sub { font-size: 0.82rem; color: #7A91AA; margin-bottom: 2rem; }
        label { display: block; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #7A91AA; margin-bottom: 0.4rem; margin-top: 1rem; }
        input[type="text"], input[type="password"] { width: 100%; padding: 0.75rem 1rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #fff; font-size: 0.9rem; outline: none; transition: border-color 0.2s; }
        input:focus { border-color: #00C9AE; }
        .btn { width: 100%; margin-top: 1.5rem; padding: 0.85rem; background: #00C9AE; color: #07111F; border: none; border-radius: 8px; font-size: 0.9rem; font-weight: 700; cursor: pointer; }
        .btn:hover { background: #00DEC0; }
        .result { margin-top: 1.5rem; background: rgba(0,201,174,0.08); border: 1px solid rgba(0,201,174,0.25); border-radius: 8px; padding: 1rem; display: none; }
        .result-label { font-size: 0.67rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #00C9AE; margin-bottom: 0.5rem; }
        .hash { font-family: 'Fira Code', monospace; font-size: 0.78rem; color: #fff; word-break: break-all; line-height: 1.6; user-select: all; }
        .copy-btn { margin-top: 0.75rem; padding: 0.5rem 1rem; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 6px; color: #AAC0D6; font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all 0.2s; }
        .copy-btn:hover { background: #00C9AE; color: #07111F; border-color: #00C9AE; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Password Hash Generator</h1>
        <div class="sub">Generates a bcrypt hash for MySQL admin password field.</div>
        <form method="POST">
            <label>Password to hash</label>
            <input type="text" name="password" placeholder="Enter your plain-text password" value="<?= htmlspecialchars($_POST['password'] ?? '') ?>" required autofocus />
            <button type="submit" class="btn">Generate Hash</button>
        </form>
        <?php if (!empty($hash)): ?>
            <div class="result" style="display:block;">
                <div class="result-label">Bcrypt Hash</div>
                <div class="hash" id="hashValue"><?= htmlspecialchars($hash) ?></div>
                <button class="copy-btn" onclick="copyHash()">Copy Hash</button>
            </div>
            <div style="margin-top:1.5rem;">
                <div class="result-label" style="color:#7A91AA;">SQL to update admin password</div>
                <div class="hash" style="font-size:0.72rem;color:#7A91AA;background:rgba(255,255,255,0.03);padding:0.75rem;border-radius:6px;border:1px solid rgba(255,255,255,0.06);">
                    UPDATE admins SET password = '<?= htmlspecialchars($hash) ?>' WHERE email = 'admin@ahmed-olusesi.com';
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script>
        function copyHash() {
            const text = document.getElementById('hashValue').textContent;
            navigator.clipboard.writeText(text).then(() => {
                const btn = document.querySelector('.copy-btn');
                btn.textContent = 'Copied!';
                setTimeout(() => { btn.textContent = 'Copy Hash'; }, 2000);
            });
        }
    </script>
</body>
</html>
