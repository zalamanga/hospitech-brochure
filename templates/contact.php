<section class="section contact-section">
  <div class="shell enquiry-grid">
    <div class="contact-copy">
      <p class="eyebrow">Local enquiry draft</p>
      <h1>Prepare it here.<br>Keep it local.</h1>
      <p class="lead">Use sample details, review your enquiry and download a text copy. This portfolio demo does not send messages.</p>
      <aside class="reference-contact">
        <h2>Reference contact details</h2>
        <p>Retained from the original local concept. These details are unverified and the contact links are inactive.</p>
        <dl>
          <dt>Address</dt><dd><?= e($contact['address']) ?></dd>
          <dt>Phone</dt><dd><?= e($contact['phone']) ?></dd>
          <dt>Fax</dt><dd><?= e($contact['fax']) ?></dd>
          <dt>Email</dt><dd><?= e($contact['email']) ?></dd>
          <dt>WhatsApp reference</dt><dd><?= e($contact['whatsapp']) ?></dd>
        </dl>
      </aside>
    </div>
    <?= render_template('form', ['products' => $products, 'interest' => '']) ?>
  </div>
</section>
