<section class="hero home-hero">
  <div class="shell hero-grid">
    <div class="hero-copy">
      <p class="eyebrow">XSPec Hospitech</p>
      <h1>Communication around the care room.</h1>
      <p class="lead">Nurse call, smart beds and fall management. Browse four product families from the original brochure concept, then prepare an enquiry draft.</p>
      <div class="actions">
        <a class="button primary" href="#products">Browse product families</a>
        <a class="text-link" href="/?page=contact">Create a local draft</a>
      </div>
      <p class="source-note">Reference descriptions, presented as a portfolio demo.</p>
    </div>
    <?= render_template('illustration', []) ?>
  </div>
</section>
<section class="section" id="products">
  <div class="shell">
    <div class="section-heading">
      <div><p class="eyebrow">Product families</p><h2>Choose a product family.</h2></div>
      <p>Browse the source overview and feature descriptions for each brand.</p>
    </div>
    <div class="family-grid">
      <?php $number = 0; foreach ($products as $slug => $product): $number++; ?>
        <article class="family-card theme-<?= e($slug) ?>">
          <div class="family-top"><span class="brand-label"><?= e($product['brand']) ?></span><span class="item-number"><?= sprintf('%02d', $number) ?></span></div>
          <h3><a href="/?page=<?= e($slug) ?>"><?= e($product['title']) ?></a></h3>
          <p><?= e($product['subtitle']) ?></p>
          <a class="family-link" href="/?page=<?= e($slug) ?>">Read <?= e($product['brand']) ?> details</a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
