<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/helpers.php';

session_start_safe();

// Already logged in → go to dashboard
if ( is_logged_in() ) redirect( ADMIN_URL . '/index.php' );

$error = '';

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    $email    = trim( $_POST[ 'email' ]    ?? '' );
    $password = trim( $_POST[ 'password' ] ?? '' );

    if ( $email && $password ) {
        $st = db()->prepare( 'SELECT * FROM admins WHERE email = ? LIMIT 1' );
        $st->execute( [ $email ] );
        $admin = $st->fetch();

        if ( $admin && password_verify( $password, $admin[ 'password' ] ) ) {
            login_admin( $admin );
            redirect( ADMIN_URL . '/index.php' );
        }
    }
    $error = 'Invalid email or password.';
    // Throttle brute-force slightly
    sleep( 1 );
}
?>
<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'UTF-8' />
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0' />
<title>Admin Login — Ahmed Olusesi Blog</title>
<style>
* {
    box-sizing:border-box;
    margin:0;
    padding:0}
    body {
        font-family:'Segoe UI', sans-serif;
        background:#07111F;
        color:#AAC0D6;
        min-height:100vh;
        display:flex;
        align-items:center;
        justify-content:center;
        padding:2rem;
    }
    .card {
        background:#0C1A2E;
        border:1px solid rgba( 255, 255, 255, 0.1 );
        border-radius:16px;
        padding:2.5rem;
        width:100%;
        max-width:400px;
    }
    .logo {
        font-size:1.4rem;
        font-weight:800;
        color:#fff;
        margin-bottom:0.2rem;
    }
    .logo span {
        color:#00C9AE;
    }
    .sub {
        font-size:0.82rem;
        color:#7A91AA;
        margin-bottom:2rem;
    }
    label {
        display:block;
        font-size:0.7rem;
        font-weight:700;
        letter-spacing:0.08em;
        text-transform:uppercase;
        color:#7A91AA;
        margin-bottom:0.4rem;
        margin-top:1rem;
    }
    input {
        width:100%;
        padding:0.75rem 1rem;
        background:rgba( 255, 255, 255, 0.05 );
        border:1px solid rgba( 255, 255, 255, 0.1 );
        border-radius:8px;
        color:#fff;
        font-size:0.9rem;
        outline:none;
        transition:border-color 0.2s;
    }
    input:focus {
        border-color:#00C9AE;
    }
    .btn {
        width:100%;
        margin-top:1.75rem;
        padding:0.85rem;
        background:#00C9AE;
        color:#07111F;
        border:none;
        border-radius:8px;
        font-size:0.9rem;
        font-weight:700;
        cursor:pointer;
    }
    .btn:hover {
        background:#00DEC0;
    }
    .error {
        background:rgba( 239, 68, 68, 0.1 );
        border:1px solid rgba( 239, 68, 68, 0.3 );
        border-radius:8px;
        padding:0.85rem 1rem;
        margin-bottom:1rem;
        font-size:0.84rem;
        color:#FCA5A5;
    }
    .back {
        display:block;
        text-align:center;
        margin-top:1.25rem;
        font-size:0.8rem;
        color:#7A91AA;
        text-decoration:none;
    }
    .back:hover {
        color:#00C9AE;
    }
    </style>
    </head>
    <body>
    <div class = 'card'>
    <div class = 'logo'>Ahmed<span>.</span>Blog</div>
    <div class = 'sub'>Admin panel — sign in to continue.</div>
    <?php if ( $error ): ?>
    <div class = 'error'>< ?= e( $error ) ?></div>
    <?php endif;
    ?>
    <form method = 'POST' autocomplete = 'off'>
    <label>Email</label>
    <input type = 'email' name = 'email' value = "<?= e($_POST['email'] ?? '') ?>" required autofocus />
    <label>Password</label>
    <input type = 'password' name = 'password' required />
    <button type = 'submit' class = 'btn'>Sign In →</button>
    </form>
    <a class = 'back' href = '<?= SITE_URL ?>'>← Back to blog</a>
    </div>
    </body>
    </html>
