<?php
// ── Slug generator ───────────────────────────────────────────
function make_slug(string $text): string {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

// ── Unique slug (checks DB for conflicts) ────────────────────
function unique_slug(string $base, string $table, int $excludeId = 0): string {
    $slug  = make_slug($base);
    $orig  = $slug;
    $i     = 1;
    $pdo   = db();
    while (true) {
        $sql = "SELECT id FROM `$table` WHERE slug = ? AND id != ?";
        $st  = $pdo->prepare($sql);
        $st->execute([$slug, $excludeId]);
        if (!$st->fetch()) break;
        $slug = $orig . '-' . $i++;
    }
    return $slug;
}

// ── Handle featured image upload ─────────────────────────────
// Returns filename on success, null on no file, throws on error.
function handle_upload(string $inputName): ?string {
    if (empty($_FILES[$inputName]['name'])) return null;

    $file = $_FILES[$inputName];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Upload error code: ' . $file['error']);
    }
    if ($file['size'] > MAX_FILE_SIZE) {
        throw new RuntimeException('File too large. Maximum is 5 MB.');
    }

    $mime = mime_content_type($file['tmp_name']);
    if (!in_array($mime, ALLOWED_TYPES, true)) {
        throw new RuntimeException('Invalid file type. Only JPEG, PNG, WebP, GIF allowed.');
    }

    $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('img_', true) . '.' . strtolower($ext);
    $dest     = UPLOAD_DIR . $filename;

    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        throw new RuntimeException('Could not save uploaded file.');
    }
    return $filename;
}

// ── Delete an uploaded image file ────────────────────────────
function delete_upload(?string $filename): void {
    if ($filename && file_exists(UPLOAD_DIR . $filename)) {
        unlink(UPLOAD_DIR . $filename);
    }
}

// ── Safe HTML output ─────────────────────────────────────────
function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// ── Truncate plain text ──────────────────────────────────────
function truncate(string $text, int $words = 25): string {
    $plain = strip_tags($text);
    $arr   = explode(' ', $plain);
    if (count($arr) <= $words) return $plain;
    return implode(' ', array_slice($arr, 0, $words)) . '…';
}

// ── Flash messages (one-time session notices) ────────────────
function flash(string $type, string $message): void {
    session_start_safe();
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash(): ?array {
    session_start_safe();
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $f;
    }
    return null;
}

// ── Render flash message HTML ────────────────────────────────
function render_flash(): void {
    $f = get_flash();
    if (!$f) return;
    $color = $f['type'] === 'success' ? '#00C9AE' : '#ef4444';
    $bg    = $f['type'] === 'success' ? 'rgba(0,201,174,0.1)' : 'rgba(239,68,68,0.1)';
    $bdr   = $f['type'] === 'success' ? 'rgba(0,201,174,0.3)' : 'rgba(239,68,68,0.3)';
    echo "<div style='background:{$bg};border:1px solid {$bdr};color:{$color};padding:0.9rem 1.2rem;border-radius:8px;margin-bottom:1.5rem;font-size:0.88rem;font-weight:600;'>"
        . e($f['message']) . "</div>";
}

// ── Redirect ─────────────────────────────────────────────────
function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

// ── Pagination helper ─────────────────────────────────────────
function paginate(int $total, int $perPage, int $current): array {
    $pages = (int) ceil($total / $perPage);
    return [
        'total'   => $total,
        'pages'   => $pages,
        'current' => $current,
        'offset'  => ($current - 1) * $perPage,
        'prev'    => $current > 1 ? $current - 1 : null,
        'next'    => $current < $pages ? $current + 1 : null,
    ];
}

// ── Reading time estimate ─────────────────────────────────────
function reading_time(string $html): string {
    $words = str_word_count(strip_tags($html));
    $mins  = max(1, (int) round($words / 200));
    return $mins . ' min read';
}

// ── Format date ──────────────────────────────────────────────
function fmt_date(string $date, string $format = 'M j, Y'): string {
    return date($format, strtotime($date));
}
