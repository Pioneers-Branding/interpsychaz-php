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
     A form without a solved challenge never posts. If the reCAPTCHA script
     cannot load (blocked network/extension), submissions are allowed through
     rather than silently lost. */
  document.addEventListener('submit', (e) => {
    const form = e.target;
    if (!form.matches || !form.matches('form[action*="formester.com"]')) return;
    if (window.ipazRecaptchaFailed && window.ipazRecaptchaFailed()) return;
    const w = widgets.get(form);
    const token = w && window.grecaptcha && grecaptcha.enterprise.getResponse(w.id);
    if (token) return;
    e.preventDefault();
    e.stopPropagation();
    if (window.ipazRecaptchaEnsure) window.ipazRecaptchaEnsure();
    let err = w && w.err;
    if (!err) {
      err = form.querySelector('.ipaz-recaptcha-error');
      if (!err) {
        err = document.createElement('p');
        err.className = 'ipaz-recaptcha-error';
        err.setAttribute('role', 'alert');
        err.textContent = 'Please confirm you are not a robot.';
        const btn = form.querySelector('[type="submit"]');
        if (btn && btn.parentNode) btn.parentNode.insertBefore(err, btn.nextSibling);
        else form.appendChild(err);
      }
    }
    err.classList.add('is-visible');
  }, true);
})();
</script>
<script>
/* Load reCAPTCHA Enterprise only when a form is near the viewport or the
   visitor starts interacting. Keeps ~350 KB of third-party JS off the
   critical path on every page. */
(function () {
  var SRC = 'https://www.google.com/recaptcha/enterprise.js?onload=ipazRecaptchaLoad&render=explicit';
  var loading = false, failed = false;
  window.ipazRecaptchaFailed = function () { return failed; };
  function load() {
    if (loading || failed) return;
    if (window.grecaptcha && window.grecaptcha.enterprise) return;
    loading = true;
    var s = document.createElement('script');
    s.src = SRC;
    s.async = true;
    s.defer = true;
    s.onerror = function () { failed = true; loading = false; };
    document.head.appendChild(s);
  }
  window.ipazRecaptchaEnsure = load;

  var forms = document.querySelectorAll('form[action*="formester.com"]');
  if ('IntersectionObserver' in window && forms.length) {
    var io = new IntersectionObserver(function (entries) {
      for (var i = 0; i < entries.length; i++) {
        if (entries[i].isIntersecting) { io.disconnect(); load(); return; }
      }
    }, { rootMargin: '600px 0px' });
    for (var i = 0; i < forms.length; i++) io.observe(forms[i]);
  }
  /* Real gestures only. The consent banner focuses itself on load, so focusin
     must be scoped to a form or it would pull reCAPTCHA in on every page. */
  function inForm(t) {
    return !!(t && t.closest && t.closest('form[action*="formester.com"]'));
  }
  document.addEventListener('pointerdown', load, { once: true, passive: true, capture: true });
  document.addEventListener('touchstart', load, { once: true, passive: true, capture: true });
  document.addEventListener('focusin', function (e) { if (inForm(e.target)) load(); }, true);
  document.addEventListener('keydown', function (e) { if (inForm(e.target)) load(); }, true);
})();
</script>
