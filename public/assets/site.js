(() => {
  'use strict';

  const disclosures = [...document.querySelectorAll('[data-disclosure]')];
  document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') return;
    const open = disclosures.find((item) => item.open);
    if (open) {
      open.open = false;
      open.querySelector('summary').focus();
    }
  });
  document.addEventListener('pointerdown', (event) => {
    disclosures.forEach((item) => {
      if (item.open && !item.contains(event.target)) item.open = false;
    });
  });

  const form = document.querySelector('[data-enquiry-form]');
  if (!form) return;
  const result = document.querySelector('[data-draft-result]');
  const preview = result.querySelector('[data-draft-preview]');
  const download = result.querySelector('[data-draft-download]');
  const status = form.querySelector('[data-draft-status]');
  const fields = ['name', 'email', 'company', 'message'];
  const limits = { name: 100, email: 254, company: 120, message: 2000 };
  const controls = Object.fromEntries(fields.map((name) => [name, form.elements.namedItem(name)]));
  const interest = form.elements.namedItem('interest');
  const acknowledgement = form.elements.namedItem('acknowledge');
  let ownedUrl = null;

  const setStatus = (message, error = false) => {
    status.textContent = message;
    status.dataset.state = error ? 'error' : 'info';
  };
  const clearDraft = () => {
    if (ownedUrl !== null) URL.revokeObjectURL(ownedUrl);
    ownedUrl = null;
    download.removeAttribute('href');
    preview.textContent = '';
    result.hidden = true;
  };
  const clearFieldErrors = () => {
    fields.forEach((name) => controls[name].setCustomValidity(''));
    interest.setCustomValidity('');
  };
  form.addEventListener('invalid', () => {
    setStatus('Check the required fields and the email format before creating a draft.', true);
  }, true);
  form.addEventListener('input', (event) => {
    if (typeof event.target.setCustomValidity === 'function') event.target.setCustomValidity('');
    const hadDraft = ownedUrl !== null;
    clearDraft();
    setStatus(hadDraft ? 'Details changed. Create a new draft to review them.' : '');
  });
  form.addEventListener('change', () => {
    const hadDraft = ownedUrl !== null;
    clearDraft();
    if (hadDraft) setStatus('Details changed. Create a new draft to review them.');
  });
  form.addEventListener('reset', () => {
    clearDraft();
    clearFieldErrors();
    setStatus('Draft and form details cleared.');
  });
  form.addEventListener('submit', (event) => {
    event.preventDefault();
    clearDraft();
    clearFieldErrors();
    const values = {};
    fields.forEach((name) => {
      values[name] = controls[name].value.replace(/\r\n?/g, '\n').trim();
      controls[name].value = values[name];
      if (controls[name].required && values[name] === '') {
        controls[name].setCustomValidity('Enter a value with visible text.');
      } else if (values[name].length > limits[name]) {
        controls[name].setCustomValidity(`Use no more than ${limits[name]} characters.`);
      } else if (/[\u0000-\u0008\u000b\u000c\u000e-\u001f\u007f-\u009f]/u.test(values[name])) {
        controls[name].setCustomValidity('Remove control characters from this field.');
      }
    });
    const option = [...interest.options].find((item) => item.value === interest.value);
    if (!option) interest.setCustomValidity('Choose a product from the list.');
    if (!form.reportValidity() || !acknowledgement.checked || !option) return;
    const draft = [
      'XSPec Hospitech | Portfolio enquiry draft',
      'Local draft only. No message was sent.',
      '',
      `Product interest: ${option.textContent.trim()}`,
      `Name: ${values.name}`,
      `Email: ${values.email}`,
      `Company: ${values.company || '(not provided)'}`,
      '',
      'Message:',
      values.message,
      '',
      'Product descriptions and business details are unverified references from a local brochure concept.',
      '',
    ].join('\n');
    try {
      ownedUrl = URL.createObjectURL(new Blob([draft], { type: 'text/plain;charset=utf-8' }));
      download.href = ownedUrl;
      preview.textContent = draft;
      result.hidden = false;
      setStatus('Draft ready. Review it, then download a text copy. Nothing has been submitted.');
      result.querySelector('h2').focus();
    } catch {
      clearDraft();
      setStatus('The browser could not create a local text file. Try a current browser; nothing was submitted.', true);
    }
  });
  window.addEventListener('pagehide', clearDraft);

  if (typeof Blob !== 'function' || typeof URL.createObjectURL !== 'function') {
    setStatus('Local text-file creation is unavailable in this browser. The form remains inactive.', true);
    return;
  }
  form.querySelector('fieldset').disabled = false;
  setStatus('Create a draft to preview it here. No message will be sent.');
})();
