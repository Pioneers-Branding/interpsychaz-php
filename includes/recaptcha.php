<?php
/* reCAPTCHA Enterprise checkbox for every Formester form on the page — the
   contact form, inlined on most pages and repeated in the footer.

   Rendered explicitly rather than through markup: the contact form is
   duplicated on many pages, and auto-render only picks up widgets that exist
   before enterprise.js arrives. Include once per page, just before </body>. */
if (!empty($GLOBALS['IPAZ_RECAPTCHA_LOADED'])) return;
$GLOBALS['IPAZ_RECAPTCHA_LOADED'] = true;
$RECAPTCHA_SITE_KEY = '6Ldc2O4tAAAAAHapsM6mHnimBBdh-2m41fmXHVPz';
?>
<style>
  .ipaz-recaptcha { margin: 16px 0 4px; min-height: 78px; }
  .ipaz-recaptcha-error { display: none; margin: 6px 0 0; color: #c0392b; font-size: 13.5px; }
  .ipaz-recaptcha-error.is-visible { display: block; }
</style>
<script>
(() => {
  const SITE_KEY = <?= json_encode($RECAPTCHA_SITE_KEY) ?>;
  const widgets = new Map();

  const forms = () => document.querySelectorAll('form[action*="formester.com"]');

  window.ipazRecaptchaLoad = () => {
    grecaptcha.enterprise.ready(() => {
      forms().forEach((form) => {
        if (widgets.has(form)) return;
        const btn = form.querySelector('[type="submit"]');
        const box = document.createElement('div');
        box.className = 'ipaz-recaptcha';
        const err = document.createElement('p');
        err.className = 'ipaz-recaptcha-error';
        err.setAttribute('role', 'alert');
        err.textContent = 'Please confirm you are not a robot.';
        const anchor = btn && btn.parentNode !== form ? btn.parentNode : btn;
        form.insertBefore(box, anchor && anchor.parentNode === form ? anchor : null);
        box.after(err);
        const id = grecaptcha.enterprise.render(box, {
          sitekey: SITE_KEY,
          action: 'CONTACT',
          callback: () => err.classList.remove('is-visible'),
        });
        widgets.set(form, { id, err });
      });
    });
  };

  /* Capture on document so this runs before any page-level submit handler.
     A form without a solved challenge never posts. */
  document.addEventListener('submit', (e) => {
    const form = e.target;
    if (!form.matches || !form.matches('form[action*="formester.com"]')) return;
    const w = widgets.get(form);
    const token = w && window.grecaptcha && grecaptcha.enterprise.getResponse(w.id);
    if (token) return;
    e.preventDefault();
    e.stopPropagation();
    if (w) w.err.classList.add('is-visible');
  }, true);
})();
</script>
<script src="https://www.google.com/recaptcha/enterprise.js?onload=ipazRecaptchaLoad&render=explicit" async defer></script>
