<?php
$product = $route['product'];
$slug = $route['slug'];
?>
<div class="theme-<?= e($slug) ?>">
  <section class="hero product-hero">
    <div class="shell">
      <nav class="breadcrumbs" aria-label="Breadcrumb">
        <a href="/">Home</a><span aria-hidden="true">/</span><span><?= e($product['brand']) ?></span>
      </nav>
      <div class="hero-grid">
        <div class="hero-copy">
          <p class="eyebrow brand-label"><?= e($product['brand']) ?></p>
          <h1><?= e($product['title']) ?></h1>
          <p class="lead"><?= e($product['subtitle']) ?></p>
          <div class="actions">
            <a class="button primary" href="#features">View feature descriptions</a>
            <a class="text-link" href="#enquiry">Draft an enquiry</a>
          </div>
          <p class="source-note">Product description retained from the local concept; not independently verified.</p>
        </div>
        <?= render_template('illustration', []) ?>
      </div>
    </div>
  </section>
  <section class="section overview-section">
    <div class="shell overview-grid">
      <div><p class="eyebrow">Overview</p><h2><?= e($product['brand']) ?> in the source brochure.</h2></div>
      <div class="prose">
        <?php foreach ($product['summary'] as $paragraph): ?>
          <p><?= e($paragraph) ?></p>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <section class="section feature-section" id="features">
    <div class="shell">
      <div class="section-heading">
        <div><p class="eyebrow">Products &amp; features</p><h2><?= e($product['brand']) ?> highlights.</h2></div>
        <p><?= count($product['features']) ?> descriptions from the original concept.</p>
      </div>
      <ol class="feature-list">
        <?php foreach ($product['features'] as $index => $feature): ?>
          <li>
            <span class="feature-number" aria-hidden="true"><?= sprintf('%02d', $index + 1) ?></span>
            <div><h3><?= e($feature[0]) ?></h3><p><?= e($feature[1]) ?></p></div>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>
  <section class="section enquiry-section" id="enquiry">
    <div class="shell enquiry-grid">
      <div class="enquiry-copy">
        <p class="eyebrow">Local enquiry draft</p>
        <h2>Ask about <?= e($product['brand']) ?>.</h2>
        <p>The source concept references <strong><?= e(brochure_title($product)) ?></strong>. No brochure file is supplied in this demo.</p>
        <p>Create a text draft you can review and download. Nothing is submitted to a company or service.</p>
      </div>
      <?= render_template('form', ['products' => $products, 'interest' => $slug]) ?>
    </div>
  </section>
</div>
