<div class="enquiry-tool">
  <form data-enquiry-form action="/?page=contact" method="post">
    <fieldset disabled>
      <legend>Enquiry details</legend>
      <p class="form-help">Use sample details for this portfolio demo. Your draft is created on this page.</p>
      <div class="form-field">
        <label for="enquiry-interest">Product interest</label>
        <select id="enquiry-interest" name="interest">
          <option value="">General</option>
          <?php foreach ($products as $slug => $item): ?>
            <option value="<?= e($slug) ?>"<?= $interest === $slug ? ' selected' : '' ?>><?= e($item['brand']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="field-pair">
        <div class="form-field">
          <label for="enquiry-name">Name <span>(required)</span></label>
          <input id="enquiry-name" name="name" type="text" autocomplete="name" maxlength="100" required>
        </div>
        <div class="form-field">
          <label for="enquiry-email">Email <span>(required)</span></label>
          <input id="enquiry-email" name="email" type="email" autocomplete="email" maxlength="254" required>
        </div>
      </div>
      <div class="form-field">
        <label for="enquiry-company">Company <span>(optional)</span></label>
        <input id="enquiry-company" name="company" type="text" autocomplete="organization" maxlength="120">
      </div>
      <div class="form-field">
        <label for="enquiry-message">Message <span>(required, up to 2000 characters)</span></label>
        <textarea id="enquiry-message" name="message" rows="5" maxlength="2000" required></textarea>
      </div>
      <label class="acknowledgement">
        <input name="acknowledge" type="checkbox" required>
        <span>I understand that this creates a local draft and sends no message.</span>
      </label>
      <div class="actions form-actions">
        <button class="button primary" type="submit">Create draft</button>
        <button class="button secondary" type="reset">Reset</button>
      </div>
    </fieldset>
    <noscript><p class="form-status">JavaScript is needed to create a local text draft. The form is inactive and submits nothing.</p></noscript>
    <p class="form-status" data-draft-status data-state="loading" role="status" aria-live="polite">The local draft tool is inactive until JavaScript is ready.</p>
  </form>
  <section class="draft-result" data-draft-result aria-labelledby="draft-title" hidden>
    <h2 id="draft-title" tabindex="-1">Review your draft</h2>
    <p>Download a text copy when you are ready. Editing a field clears this preview.</p>
    <pre data-draft-preview></pre>
    <a class="button primary" data-draft-download download="hospitech-enquiry-demo.txt">Download .txt</a>
  </section>
</div>
