<?php
// Usage: include this file AFTER setting $page_title
// Call layout_head() at the top, layout_foot() at the bottom.

function layout_head(string $title = 'Dashboard'): void { ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($title) ?> — Blog Admin</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --navy:   #07111F;
      --navy2:  #0C1A2E;
      --navy3:  #112038;
      --teal:   #00C9AE;
      --teal2:  #009E8A;
      --slate:  #7A91AA;
      --slatel: #AAC0D6;
      --white:  #FFFFFF;
      --border: rgba(255,255,255,0.08);
      --borderl:rgba(255,255,255,0.13);
      --red:    #ef4444;
      --sidebar-w: 240px;
    }

    body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--navy); color: var(--slatel); min-height: 100vh; display: flex; }

    /* ── SIDEBAR ── */
    .sidebar {
      width: var(--sidebar-w); flex-shrink: 0;
      background: var(--navy2); border-right: 1px solid var(--border);
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; height: 100vh; z-index: 100;
      overflow-y: auto;
    }
    .sb-logo {
      padding: 1.5rem 1.25rem 1.25rem;
      border-bottom: 1px solid var(--border);
      font-size: 1.1rem; font-weight: 800; color: var(--white);
      text-decoration: none; display: block;
    }
    .sb-logo span { color: var(--teal); }
    .sb-section {
      font-size: 0.62rem; font-weight: 700; letter-spacing: 0.14em;
      text-transform: uppercase; color: var(--slate);
      padding: 1.25rem 1.25rem 0.5rem;
    }
    .sb-link {
      display: flex; align-items: center; gap: 0.65rem;
      padding: 0.6rem 1.25rem; font-size: 0.84rem; font-weight: 500;
      color: var(--slatel); text-decoration: none;
      transition: all 0.2s; border-left: 2px solid transparent;
    }
    .sb-link:hover { color: var(--white); background: rgba(255,255,255,0.04); }
    .sb-link.active { color: var(--teal); border-left-color: var(--teal); background: rgba(0,201,174,0.07); font-weight: 600; }
    .sb-icon { font-size: 1rem; flex-shrink: 0; }
    .sb-bottom {
      margin-top: auto; padding: 1.25rem;
      border-top: 1px solid var(--border);
    }
    .sb-admin { font-size: 0.78rem; color: var(--slate); margin-bottom: 0.75rem; }
    .sb-admin strong { display: block; color: var(--white); font-size: 0.85rem; }
    .sb-logout {
      display: block; text-align: center; padding: 0.55rem;
      background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2);
      border-radius: 7px; color: #FCA5A5; font-size: 0.78rem; font-weight: 600;
      text-decoration: none; transition: all 0.2s;
    }
    .sb-logout:hover { background: rgba(239,68,68,0.2); }

    /* ── MAIN CONTENT ── */
    .main { margin-left: var(--sidebar-w); flex: 1; min-height: 100vh; display: flex; flex-direction: column; }
    .topbar {
      background: var(--navy2); border-bottom: 1px solid var(--border);
      padding: 1rem 2rem; display: flex; align-items: center;
      justify-content: space-between; position: sticky; top: 0; z-index: 50;
    }
    .topbar-title { font-size: 1rem; font-weight: 700; color: var(--white); }
    .topbar-right { display: flex; gap: 0.75rem; align-items: center; }
    .tb-btn {
      padding: 0.5rem 1rem; border-radius: 7px; font-size: 0.8rem; font-weight: 600;
      text-decoration: none; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.4rem;
    }
    .tb-btn-primary { background: var(--teal); color: var(--navy); }
    .tb-btn-primary:hover { background: #00DEC0; }
    .tb-btn-ghost { border: 1px solid var(--borderl); color: var(--slatel); }
    .tb-btn-ghost:hover { border-color: var(--teal); color: var(--teal); }

    .content { padding: 2rem; flex: 1; }

    /* ── CARDS ── */
    .card {
      background: var(--navy2); border: 1px solid var(--border);
      border-radius: 12px; overflow: hidden;
    }
    .card-header {
      padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
    }
    .card-title { font-size: 0.9rem; font-weight: 700; color: var(--white); }
    .card-body { padding: 1.5rem; }

    /* ── STAT CARDS ── */
    .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.75rem; }
    .stat-card { background: var(--navy2); border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; }
    .stat-num { font-size: 2rem; font-weight: 800; color: var(--teal); line-height: 1; margin-bottom: 0.35rem; }
    .stat-label { font-size: 0.78rem; color: var(--slate); }

    /* ── TABLE ── */
    .tbl { width: 100%; border-collapse: collapse; }
    .tbl th { font-size: 0.67rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--slate); padding: 0.75rem 1rem; border-bottom: 1px solid var(--border); text-align: left; white-space: nowrap; }
    .tbl td { padding: 0.9rem 1rem; border-bottom: 1px solid var(--border); font-size: 0.84rem; color: var(--slatel); vertical-align: middle; }
    .tbl tr:last-child td { border-bottom: none; }
    .tbl tr:hover td { background: rgba(255,255,255,0.02); }

    /* ── BADGES ── */
    .badge { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.2rem 0.65rem; border-radius: 100px; font-size: 0.68rem; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase; }
    .badge-published { background: rgba(0,201,174,0.12); color: var(--teal); border: 1px solid rgba(0,201,174,0.25); }
    .badge-draft { background: rgba(122,145,170,0.15); color: var(--slate); border: 1px solid rgba(122,145,170,0.25); }

    /* ── ACTION BUTTONS ── */
    .actions { display: flex; gap: 0.4rem; }
    .act-btn { padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600; text-decoration: none; transition: all 0.2s; border: 1px solid var(--borderl); color: var(--slatel); }
    .act-btn:hover { color: var(--white); border-color: var(--teal); }
    .act-btn-danger { border-color: rgba(239,68,68,0.3); color: #FCA5A5; }
    .act-btn-danger:hover { background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.5); }

    /* ── FORMS ── */
    .fg { margin-bottom: 1.35rem; }
    .fl { display: block; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase; color: var(--slate); margin-bottom: 0.5rem; }
    .fc { width: 100%; padding: 0.75rem 1rem; background: rgba(255,255,255,0.04); border: 1px solid var(--borderl); border-radius: 8px; color: var(--white); font-family: inherit; font-size: 0.88rem; outline: none; transition: border-color 0.2s; }
    .fc:focus { border-color: var(--teal); background: rgba(255,255,255,0.07); }
    .fc::placeholder { color: var(--slate); }
    .fc option { background: var(--navy2); }
    textarea.fc { resize: vertical; min-height: 100px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    .form-hint { font-size: 0.75rem; color: var(--slate); margin-top: 0.35rem; }
    .btn-submit { padding: 0.8rem 2rem; background: var(--teal); color: var(--navy); border: none; border-radius: 8px; font-size: 0.88rem; font-weight: 700; cursor: pointer; transition: all 0.2s; }
    .btn-submit:hover { background: #00DEC0; transform: translateY(-1px); }
    .btn-cancel { padding: 0.8rem 1.5rem; background: transparent; border: 1px solid var(--borderl); color: var(--slatel); border-radius: 8px; font-size: 0.88rem; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; transition: all 0.2s; }
    .btn-cancel:hover { border-color: var(--teal); color: var(--teal); }

    /* ── FILE INPUT ── */
    .file-input-wrap { position: relative; }
    .file-preview { margin-top: 0.75rem; max-height: 160px; border-radius: 8px; border: 1px solid var(--borderl); display: block; }

    /* ── DELETE CONFIRM ── */
    .confirm-form { display: inline; }

    /* ── EMPTY STATE ── */
    .empty { text-align: center; padding: 4rem 2rem; color: var(--slate); }
    .empty-icon { font-size: 2.5rem; margin-bottom: 1rem; }
    .empty-title { font-size: 1rem; font-weight: 700; color: var(--slatel); margin-bottom: 0.5rem; }

    /* ── PAGINATION ── */
    .pagination { display: flex; gap: 0.4rem; align-items: center; margin-top: 1.5rem; }
    .page-btn { padding: 0.45rem 0.85rem; border-radius: 7px; border: 1px solid var(--borderl); color: var(--slatel); text-decoration: none; font-size: 0.82rem; transition: all 0.2s; }
    .page-btn:hover, .page-btn.active { background: var(--teal); color: var(--navy); border-color: var(--teal); font-weight: 700; }
    .page-btn.disabled { opacity: 0.35; pointer-events: none; }

    @media (max-width: 900px) {
      .sidebar { transform: translateX(-100%); }
      .main { margin-left: 0; }
      .stats-row { grid-template-columns: 1fr 1fr; }
      .form-row { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<?php
$uri = $_SERVER['PHP_SELF'];
function sb_active(string $path): string {
    global $uri;
    return str_contains($uri, $path) ? 'active' : '';
}
?>
<aside class="sidebar">
  <a class="sb-logo" href="<?= ADMIN_URL ?>">Ahmed<span>.</span>Blog</a>

  <div class="sb-section">Content</div>
  <a class="sb-link <?= sb_active('/admin/index') ?>" href="<?= ADMIN_URL ?>/index.php">
    <span class="sb-icon">📊</span> Dashboard
  </a>
  <a class="sb-link <?= sb_active('/posts/') ?>" href="<?= ADMIN_URL ?>/posts/index.php">
    <span class="sb-icon">📝</span> Posts
  </a>
  <a class="sb-link <?= sb_active('/categories/') ?>" href="<?= ADMIN_URL ?>/categories/index.php">
    <span class="sb-icon">🏷️</span> Categories
  </a>

  <div class="sb-section">Site</div>
  <a class="sb-link" href="<?= SITE_URL ?>" target="_blank">
    <span class="sb-icon">🌐</span> View Blog
  </a>

  <div class="sb-bottom">
    <div class="sb-admin">
      Signed in as<strong><?= e(current_admin_name()) ?></strong>
    </div>
    <a class="sb-logout" href="<?= ADMIN_URL ?>/logout.php">Sign Out</a>
  </div>
</aside>

<div class="main">
<?php } // end layout_head ?>

<?php
function layout_foot(): void { ?>
</div><!-- /main -->
</body>
</html>
<?php } // end layout_foot ?>
