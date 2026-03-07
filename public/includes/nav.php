<?php
// Detect active page for nav highlighting
$current = basename( $_SERVER[ 'PHP_SELF' ] );
?>
<nav class = 'nav'>
<div class = 'nav-bar'>

<a href = '/index.php' class = 'nav-logo'>
<div class = 'logo-mark'>AO</div>
Ahmed Olusesi
</a>

<ul class = 'nav-links'>
<li>
<a href = '/index.php'

class = "<?php echo $current === 'index.php' ? 'active' : ''; ?>">
Home
</a>
</li>
<li>
<a href = '/about.php'

class = "<?php echo $current === 'about.php' ? 'active' : ''; ?>">
About
</a>
</li>
<li>
<a href = '/portfolio.php'

class = "<?php echo $current === 'portfolio.php' ? 'active' : ''; ?>">
Portfolio
</a>
</li>
<li>
<a href = '/blog.php'

class = "<?php echo $current === 'blog.php' ? 'active' : ''; ?>">
Blog
</a>
</li>
<li>
<a href = '/contact.php'

class = "nav-cta <?php echo $current === 'contact.php' ? 'active' : ''; ?>">
Hire Me
</a>
</li>
</ul>

<button class = 'nav-mobile-btn' aria-label = 'Toggle menu'>
<span></span><span></span><span></span>
</button>

</div>
</nav>