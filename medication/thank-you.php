<?php
/**
 * Interventional Psychiatry of Arizona — Medication Management confirmation page.
 * Set this URL as the redirect destination on the Formester form.
 */
$PHONE_DISPLAY = '(602) 824-8404';
$PHONE_LINK    = '+16028248404';
$ADDRESS_L1    = '2122 E. Highland Ave, Suite 335';
$ADDRESS_L2    = 'Phoenix, AZ 85016';
$YEAR          = date('Y');
$IMG_DIR       = 'assets/img';

/* See index.php — assets are emitted against the folder's URL path so they
   resolve whether or not the page was reached with a trailing slash. */
$BASE = (function (): string {
  $dir  = basename(__DIR__);
  $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
  return preg_match('#^(.*/' . preg_quote($dir, '#') . ')(?:/|$)#', $path, $m) ? $m[1] : '';
})();

$asset = function (string $rel) use ($IMG_DIR, $BASE): string {
  $p = $IMG_DIR . '/' . $rel;
  return $BASE . '/' . (is_file(__DIR__ . '/' . $p) ? $p . '?v=' . filemtime(__DIR__ . '/' . $p) : $p);
};
$LOGO_LIGHT = $asset('interpsychaz-logo.webp');
$HERO_BG    = $asset('ambience/hero-medication.jpg');
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7TQS8BS5C3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7TQS8BS5C3');
</script>

<!-- Event snippet for Submit lead form conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-11337249981/BC21COuAyeccEL3pgp4q',
      'value': 1.0,
      'currency': 'USD'
  });
</script>

<title>Thank you | Medication Management at Interventional Psychiatry of Arizona</title>
<meta name="description" content="Your appointment request has been received. A member of our team will reach out within one business day.">
<!-- Confirmation pages should never appear in search results or be shared as a landing page. -->
<meta name="robots" content="noindex, nofollow">

<link rel="icon" type="image/png" sizes="32x32" href="<?= $asset('favicon-32.png') ?>">
<link rel="apple-touch-icon" href="<?= $asset('favicon-180.png') ?>">
<meta name="theme-color" content="#262858">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        ink:    '#1E1F42',
        brand:  { 950:'#262858', 900:'#31336E', 800:'#3C3E84', 700:'#444690', 600:'#4B4D97', 500:'#7476BC', 200:'#C9CAE6' },
        accent: { 50:'#FDF1E9', 200:'#FAD2B8', 400:'#F5975F', 500:'#EF7136', 600:'#C24E12' },
        cream:  '#FBF9F6',
        sand:   '#EFEDE7',
      },
      fontFamily: {
        display: ['Fraunces', 'ui-serif', 'Georgia', 'serif'],
        sans:    ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      letterSpacing: { tightest: '-0.045em' },
      maxWidth: { '8xl': '88rem' },
    }
  }
}
</script>

<style>
  body { -webkit-font-smoothing: antialiased; }

  /* Same frosted panel as the appointment form, so the confirmation feels like
     the other side of the same card. */
  .glass{
    background: linear-gradient(160deg, rgba(255,255,255,.14), rgba(255,255,255,.05)), rgba(38,40,88,.50);
    backdrop-filter: blur(22px) saturate(150%);
    -webkit-backdrop-filter: blur(22px) saturate(150%);
    border: 1px solid rgba(255,255,255,.18);
    box-shadow: 0 30px 70px -25px rgba(8,10,35,.75), inset 0 1px 0 rgba(255,255,255,.25);
  }
  @supports not ((backdrop-filter: blur(1px)) or (-webkit-backdrop-filter: blur(1px))){
    .glass{ background: rgba(38,40,88,.92); }
  }

  .rise { opacity:0; transform:translateY(16px); animation:rise .7s cubic-bezier(.2,.7,.2,1) forwards; }
  @keyframes rise { to { opacity:1; transform:none; } }

  .tick { stroke-dasharray:32; stroke-dashoffset:32; animation:draw .6s .35s cubic-bezier(.4,0,.2,1) forwards; }
  @keyframes draw { to { stroke-dashoffset:0; } }

  @media (prefers-reduced-motion: reduce){
    .rise{opacity:1;transform:none;animation:none}
    .tick{stroke-dashoffset:0;animation:none}
  }
</style>
</head>

<body class="min-h-screen bg-brand-950 text-cream font-sans antialiased selection:bg-accent-200 selection:text-brand-900">

<img src="<?= $HERO_BG ?>" alt="" aria-hidden="true"
     class="pointer-events-none fixed inset-0 h-full w-full object-cover">
<div class="pointer-events-none fixed inset-0 bg-brand-950/80"></div>

<main class="relative min-h-screen flex flex-col items-center justify-center px-6 py-14">

  <a href="<?= $BASE ?>/" class="rise inline-block" aria-label="Interventional Psychiatry of Arizona — home">
    <img src="<?= $LOGO_LIGHT ?>" alt="Interventional Psychiatry of Arizona — Building Strong Minds"
         width="545" height="228" class="h-16 w-auto">
  </a>

  <div class="glass rise mt-9 w-full max-w-xl rounded-[28px] p-8 sm:p-10 text-center" style="animation-delay:.08s">

    <span class="grid place-items-center h-16 w-16 mx-auto rounded-2xl bg-accent-500/20 ring-1 ring-accent-400/30 text-accent-400">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8">
        <path class="tick" d="M5 13l4.5 4.5L19 7"/>
      </svg>
    </span>

    <h1 class="mt-7 font-display text-[2.1rem] sm:text-[2.6rem] leading-[1.1] tracking-tightest font-light">
      Thank you — we have<br class="hidden sm:block"> your request.
    </h1>

    <p class="mt-5 text-[16.5px] leading-relaxed text-cream/70 font-light">
      A member of our team will check your insurance benefits and reach out within one business day
      to book your 90-minute initial evaluation.
    </p>

    <div class="mt-8 grid sm:grid-cols-3 gap-3 text-left">
      <div class="rounded-2xl border border-white/12 bg-white/[0.04] px-5 py-4">
        <p class="text-[11.5px] uppercase tracking-[0.16em] text-cream/40">Next</p>
        <p class="mt-1.5 text-[14px] leading-snug text-cream/80">We call or email to find a time that works.</p>
      </div>
      <div class="rounded-2xl border border-white/12 bg-white/[0.04] px-5 py-4">
        <p class="text-[11.5px] uppercase tracking-[0.16em] text-cream/40">Then</p>
        <p class="mt-1.5 text-[14px] leading-snug text-cream/80">Bring your current bottles, or a pharmacy list.</p>
      </div>
      <div class="rounded-2xl border border-white/12 bg-white/[0.04] px-5 py-4">
        <p class="text-[11.5px] uppercase tracking-[0.16em] text-cream/40">Sooner is fine</p>
        <p class="mt-1.5 text-[14px] leading-snug text-cream/80">Call us directly, Mon–Fri 8am–5pm.</p>
      </div>
    </div>

    <div class="mt-8 flex flex-col sm:flex-row gap-3.5">
      <a href="tel:<?= $PHONE_LINK ?>" class="flex-1 inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-7 py-4 text-[15.5px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
        Call <?= $PHONE_DISPLAY ?>
      </a>
      <a href="<?= $BASE ?>/" class="group flex-1 inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-7 py-4 text-[15.5px] font-medium text-cream hover:bg-white/10 transition backdrop-blur">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:-translate-x-0.5"><path d="M19 12H6M13 5l-7 7 7 7"/></svg>
        Back to the page
      </a>
    </div>

    <p class="mt-7 flex items-start gap-2.5 text-left text-[13px] leading-relaxed text-cream/50">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-4 w-4 shrink-0 mt-0.5 text-accent-400"><path d="M12 8.5v4.5M12 16.5h.01"/><path d="M10.3 3.9 2.6 17.3A2 2 0 0 0 4.3 20.3h15.4a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
      <span><span class="text-cream/80 font-medium">In crisis?</span> This form is not monitored for emergencies.
        Call 911, or call or text <a href="tel:988" class="font-semibold text-accent-400 hover:underline">988</a>
        for the 24/7 Suicide &amp; Crisis Lifeline.</span>
    </p>
  </div>

  <p class="rise mt-8 text-center text-[13px] text-cream/40" style="animation-delay:.16s">
    <?= $ADDRESS_L1 ?>, <?= $ADDRESS_L2 ?><br>
    <span class="text-cream/25">&copy; <?= $YEAR ?> Interventional Psychiatry of Arizona</span>
  </p>
</main>

</body>
</html>
