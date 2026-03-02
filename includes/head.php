<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- ── SEO ── -->
  <title><?php echo isset($pageTitle) ? $pageTitle . ' — Ahmed Olusesi' : 'Ahmed Olusesi — Full-Stack Software Developer'; ?></title>
  <meta name="description" content="<?php echo isset($pageDesc) ? $pageDesc : 'Lagos-based full-stack developer building rugged, fast and efficient web and mobile products using React, Vue, Node.js, PHP, Laravel, Python, React Native and more.'; ?>" />
  <meta name="keywords" content="Ahmed Olusesi, full-stack developer, Lagos developer, React developer Nigeria, PHP Laravel developer, Node.js, React Native, software developer Lagos" />
  <meta name="author" content="Ahmed Olusesi Oladipupo" />
  <link rel="canonical" href="https://ahmedolusesi.com<?php echo $_SERVER['REQUEST_URI']; ?>" />

  <!-- ── Open Graph ── -->
  <meta property="og:type"        content="website" />
  <meta property="og:title"       content="<?php echo isset($pageTitle) ? $pageTitle . ' — Ahmed Olusesi' : 'Ahmed Olusesi — Full-Stack Software Developer'; ?>" />
  <meta property="og:description" content="Lagos-based full-stack developer building rugged, fast and efficient web and mobile products." />
  <meta property="og:url"         content="https://ahmedolusesi.com<?php echo $_SERVER['REQUEST_URI']; ?>" />
  <meta property="og:image"       content="https://ahmedolusesi.com/assets/images/og-cover.jpg" />

  <!-- ── Twitter Card ── -->
  <meta name="twitter:card"        content="summary_large_image" />
  <meta name="twitter:title"       content="Ahmed Olusesi — Full-Stack Software Developer" />
  <meta name="twitter:description" content="Lagos-based full-stack developer — React, Vue, Node, PHP, Laravel, React Native, Docker, AWS." />
  <meta name="twitter:image"       content="https://ahmedolusesi.com/assets/images/og-cover.jpg" />

  <!-- ── Fonts ── -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500;600&display=swap" />

  <!-- ── Stylesheet ── -->
  <link rel="stylesheet" href="./assets/styles/style.css" />

  <!-- ── Favicon ── -->
  <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg" />
</head>
<body>