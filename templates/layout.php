<?php
$page = $route['page'];
$title = $page === 'product' ? $route['product']['brand'] : ($page === 'contact' ? 'Local enquiry draft' : ($page === 'error' ? 'Page unavailable' : 'Brochure'));
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="A local XSPec Hospitech portfolio brochure concept with four product families and a local enquiry draft tool.">
  <title><?= e($title) ?> | XSPec Hospitech portfolio</title>
  <link rel="stylesheet" href="/assets/site.css">
  <link rel="icon" type="image/svg+xml" href="/assets/favicon.svg">
  <script src="/assets/site.js" defer></script>
</head>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
  <div class="demo-ribbon">
    <div class="shell ribbon-inner"><span>Portfolio brochure concept</span><a href="#demo-note">About this demo</a></div>
  </div>
  <header class="site-header">
    <div class="shell header-inner">
      <a class="brand" href="/" aria-label="XSPec Hospitech home">
        <span class="brand-mark" aria-hidden="true">XH</span>
        <span><strong>XSPec Hospitech</strong><small>Healthcare communication</small></span>
      </a>
      <nav class="main-nav" aria-label="Main navigation">
        <a href="/"<?= $page === 'home' ? ' aria-current="page"' : '' ?>>Home</a>
        <details class="product-nav" data-disclosure>
          <summary<?= $page === 'product' ? ' class="current"' : '' ?>>Products</summary>
          <div class="product-menu">
            <?php foreach ($products as $slug => $item): ?>
              <a href="/?page=<?= e($slug) ?>"<?= ($route['slug'] ?? '') === $slug ? ' aria-current="page"' : '' ?>><?= e($item['brand']) ?></a>
            <?php endforeach; ?>
          </div>
        </details>
        <a class="nav-draft" href="/?page=contact"<?= $page === 'contact' ? ' aria-current="page"' : '' ?>>Local enquiry</a>
      </nav>
    </div>
  </header>
  <main id="main" tabindex="-1"><?= $content ?></main>
  <footer class="site-footer" id="demo-note">
    <div class="shell footer-inner">
      <div><strong>XSPec Hospitech</strong><p>A portfolio brochure based on a local redesign concept. The care graphic is illustrative; product descriptions and business details are unverified references from that source.</p></div>
      <nav aria-label="Footer navigation"><a href="/#products">Product families</a><a href="/?page=contact">Create a local draft</a></nav>
    </div>
  </footer>
</body>
</html>
