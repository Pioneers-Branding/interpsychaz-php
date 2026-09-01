<?php
/**
 * Interventional Psychiatry of Arizona — SPRAVATO® landing page.
 *
 * Single-file, conversion-focused page. Tailwind CSS (CDN) + vanilla JS.
 * Copy is drawn from the practice's own Spravato pages on interpsychaz.com.
 *
 * SPRAVATO® is a registered trademark of Janssen Pharmaceuticals, Inc. It is used
 * here to identify the treatment offered at this REMS-certified practice. See the
 * trademark notice in the footer.
 */
$PHONE_DISPLAY = '(602) 824-8404';
$PHONE_LINK    = '+16028248404';
$ADDRESS_L1    = '2122 E. Highland Ave, Suite 335';
$ADDRESS_L2    = 'Phoenix, AZ 85016';
$YEAR          = date('Y');
$MAPS_QUERY    = urlencode($ADDRESS_L1 . ', ' . $ADDRESS_L2);
$FORM_ENDPOINT = 'https://app.formester.com/forms/thRvisL2m/submissions';

/* The registered mark, set small and raised, so the brand reads correctly in
   display type without shouting. Body copy uses a plain "SPRAVATO®". */
$RX  = '<sup class="align-super text-[0.42em] font-normal">&reg;</sup>';
$SPR = 'SPRAVATO' . $RX;

/* This page carries no outbound links. Every click either scrolls to the form,
   dials the practice, or submits — nothing hands the visitor an exit. */

/* ─── IMAGERY ────────────────────────────────────────────────────────────────
 * Every photo slot is declared once, here. A slot falls back to a licensed
 * stock placeholder until a real file exists at assets/img/<file>.
 */
$IMG_DIR = 'assets/img';

/* The URL path this folder is served from — "/spravato" normally, "" if the
   folder's contents are deployed at the domain root. Assets are emitted against
   it rather than relatively, because a relative path silently resolves to the
   site root when the page is reached without a trailing slash (/spravato). */
$BASE = (function (): string {
  $dir  = basename(__DIR__);
  $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
  return preg_match('#^(.*/' . preg_quote($dir, '#') . ')(?:/|$)#', $path, $m) ? $m[1] : '';
})();

$asset = function (string $rel) use ($IMG_DIR, $BASE): string {
  $p = $IMG_DIR . '/' . $rel;
  return $BASE . '/' . (is_file(__DIR__ . '/' . $p) ? $p . '?v=' . filemtime(__DIR__ . '/' . $p) : $p);
};
$LOGO_LIGHT    = $asset('interpsychaz-logo.webp');       // white — dark backgrounds
$LOGO_DARK     = $asset('interpsychaz-logo-dark.webp');  // indigo — light backgrounds
$SPRAVATO_MARK = $asset('spravato-logo.webp');           // SPRAVATO® brand lockup

$IMG = [
  'hero'      => ['file'=>'ambience/hero-happy-patient.jpg',  'id'=>'photo-1559757148-5c350d0d3c56', 'alt'=>'A woman standing at the shore with her arms raised and her face turned to the sun, smiling'],
  'device'    => ['file'=>'ambience/spravato-image.webp',     'id'=>'photo-1631549916768-4119b2e5f926', 'alt'=>'A patient holding the SPRAVATO 28 mg esketamine nasal spray device up to their nose'],
  'session'   => ['file'=>'spravato-treatment-session.webp',  'id'=>'photo-1512678080530-7760d81faba6', 'alt'=>'A woman self-administering an esketamine nasal spray'],
  /* Practice photography — the rooms a patient actually walks into. */
  'room'      => ['file'=>'ambience/inter-a-1.webp',           'id'=>'photo-1512678080530-7760d81faba6', 'alt'=>'Our monitoring room, with recliners, vitals equipment and privacy screens'],
  'reception' => ['file'=>'ambience/inter-a-3.png',            'id'=>'photo-1519494026892-80bbd2d6fd0d', 'alt'=>'The front desk and reception area at our Phoenix office'],
  'care'      => ['file'=>'ambience/why-patient-trust-us.webp','id'=>'photo-1584515933487-779824d29309', 'alt'=>'A clinician with a patient during a treatment session at our Phoenix practice'],
  'tms'       => ['file'=>'ambience/inter-a-2.webp',           'id'=>'photo-1666214280557-f1b5022eb634', 'alt'=>'Our TMS treatment room, with the Magstim chair and stimulator'],
];

/** Resolve a slot to a URL — local file wins, stock placeholder otherwise. */
$img = function (string $key, int $w = 1200) use ($IMG, $IMG_DIR, $BASE): string {
  if (!isset($IMG[$key])) return '';
  $local = $IMG_DIR . '/' . $IMG[$key]['file'];
  if (is_file(__DIR__ . '/' . $local)) return $BASE . '/' . $local . '?v=' . filemtime(__DIR__ . '/' . $local);
  return 'https://images.unsplash.com/' . $IMG[$key]['id'] . '?auto=format&fit=crop&w=' . $w . '&q=70';
};
$alt = fn(string $key): string => $IMG[$key]['alt'] ?? '';

/** Absolute URL, for meta tags that scrapers can't resolve relatively. */
$absolute = function (string $path): string {
  if (str_starts_with($path, 'http')) return $path;
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $host   = $_SERVER['HTTP_HOST'] ?? 'interpsychaz.com';
  return $scheme . '://' . $host . '/' . ltrim($path, '/');
};

/* Insurance carriers — logos live in assets/img/insurance/. A carrier without a
   logo file still renders, as a clean wordmark tile, so the wall stays complete.
   The same list populates the "Your insurance" dropdown in the form. */
$insurers = [
  ['Aetna',                             'aetna.webp'],
  ['Ambetter Health',                   'ambetter.png'],
  ['Arizona Complete Health',           'arizona-complete-health.png'],
  ['Blue Cross Blue Shield of Arizona', 'bcbs-arizona.png'],
  ['Care1st Health Plan Arizona',       'care1st.png'],
  ['Cigna Healthcare',                  'cigna.png'],
  ['Curative',                          'curative.png'],
  ['Health Net',                        'health-net.png'],
  ['Humana',                            'humana.png'],
  ['Medicare',                          'medicare.png'],
  ['Mercy Care',                        'mercy-care.png'],
  ['Optum',                             'optum.png'],
  ['SCAN Health Plan',                  'scan-health-plan.png'],
  ['TRICARE For Life',                  'tricare-for-life.png'],
  ['TriWest Healthcare Alliance',       'triwest.png'],
  ['UnitedHealthcare Community Plan',   'unitedhealthcare-community-plan.png'],
  ['Wellcare By Allwell',               'wellcare-allwell.png'],
];

/* ─── COMPARISON ─────────────────────────────────────────────────────────────
 * One source of truth, rendered twice: as stacked cards on phones and as a
 * table from lg up. Whichever is hidden is display:none, so assistive tech and
 * the page's text content only ever see one of them.
 */
$compareCols = [
  ['SPRAVATO&reg;',        'Esketamine nasal spray'],
  ['Oral antidepressants', 'SSRIs, SNRIs and others'],
  ['ECT',                  'Electroconvulsive therapy'],
];
$compareRows = [
  ['Time to relief',     ['Hours to days',                      'Typically 6–12 weeks per trial', 'Over a course of sessions']],
  ['How it is given',    ['A nasal spray you self-administer',  'A pill you take daily at home',  'Anesthesia and an induced seizure']],
  ['Sedation',           ['None — you stay awake',              'None',                           'General anesthesia every session']],
  ['What it targets',    ['Glutamate and NMDA receptors',       'Serotonin and norepinephrine',   'Whole-brain seizure activity']],
  ['Memory effects',     ['Not typical',                        'Not typical',                    'Memory loss is a known risk']],
  ['Time at the clinic', ['~2 hours of monitoring per session', 'None — taken at home',           'A half day, plus recovery time']],
  ['Driving afterward',  ['Not until the next day',             'Unrestricted',                   'Not the same day']],
];

/* FAQ copy is plain text — it is rendered on the page and re-used verbatim in the
   FAQPage structured data below, so it must not carry markup. */
$faqs = [
  ['Is SPRAVATO® covered by my insurance?',
   'For most patients, yes. The majority of commercial plans, Medicare and many Medicaid programs — including Arizona’s AHCCCS — cover SPRAVATO® for treatment-resistant depression. Coverage is not automatic: insurers require a prior authorization first. Our care coordinators handle that paperwork and talk to your insurer directly.'],
  ['What will it actually cost me?',
   'There are two parts to the bill: the medication itself, and the two-hour observation visit, which is billed under your medical benefits. After insurance you may still owe a deductible, copay or coinsurance. Janssen’s SPRAVATO withMe savings program can reduce the medication cost to as little as $10 per treatment for eligible patients with commercial insurance — that program covers the medication, not the clinic visit.'],
  ['How quickly does SPRAVATO® work?',
   'Much faster than a standard antidepressant. Where oral medications typically take weeks or months to show an effect, many patients notice a reduction in symptoms within 24 hours to a few days of their first treatment. That speed is why it is used for severe depression and for depressive symptoms with suicidal thoughts.'],
  ['What happens during a treatment session?',
   'You self-administer the nasal spray under the direct supervision of our staff, then stay with us for a two-hour monitoring period in a private room with a recliner. Vital signs are checked throughout. Most side effects appear during that window and resolve the same day.'],
  ['Can I drive myself home?',
   'No. You will need someone to drive you, and you should not drive or operate machinery until the next day, after a full night’s sleep. We will tell you this again at scheduling so you can plan the day.'],
  ['What are the common side effects?',
   'Dissociation, dizziness, fatigue, nausea or vomiting, a feeling of being drunk or euphoric, anxiety or numbness, and a spinning sensation. They usually begin shortly after the dose and resolve the same day, which is what the monitoring period is for.'],
  ['How long does approval take, and what if I am denied?',
   'Prior authorization usually takes three days to two weeks. Denials do happen, most often because of missing documentation — if that happens, our team files the appeal on your behalf with the additional clinical evidence.'],
  ['Do I need a referral to be seen?',
   'No referral is needed to schedule with us. If you already have a therapist or primary care provider, we are glad to coordinate so everyone stays aligned.'],
];

/* Verbatim Google reviews. Dates are the month each was posted, so they don't
   drift the way "2 months ago" would. */
$reviews = [
  ['Gary Johnson', 'GJ', '10 reviews', 'June 2026', 'Dr. Gomez',
   'Dr. Gomez is incredible. He took the time to really understand my situation, medical history, and what I was trying to accomplish. He was empathetic, caring, and listened without judgement. I highly recommend him and his staff.'],
  ['Michael Stella', 'MS', 'Local Guide · 26 reviews', 'May 2026', 'Jessica Cruz, NP',
   'The care I received her was far different past experiences with other providers, since Jessica took the time to hear all of my concerns, and fully took them into consideration as we developed a treatment plan. It was much appreciated!'],
  ['Sandra Bennewitz', 'SB', 'Local Guide · 25 reviews', 'June 2026', 'Dr. Gomez',
   'Dr. Gomez is SO kind, thoughtful and smart. He really listens and is so helpful. His office staff is competent and very caring. I highly recommend Dr. Gomez.'],
  ['Logan', 'L', '7 reviews', 'April 2026', 'Our team',
   'I’ve had a wonderful experience with all staff members. The whole office has been helpful, especially with handling any insurance issues that have surfaced. I’m grateful to have found this office and its staff and I would highly recommend the facility to others!'],
  ['Benjamin Ernyei', 'BE', 'Local Guide · 13 reviews', 'November 2025', 'Dr. Gomez',
   'Dr Gomez and the staff at Interventional Psychiatry of AZ have been my best choice in care in the past couple years. Dr Gomez always listens to my issues and has made several recommendations in my care and treatment for my mental health best concerns. His staff is very supportive and I have always recommended Dr Gomez to anyone looking for an excellent, respectful, and supportive psychiatrist.'],
  ['Walker Eltife', 'WE', '5 reviews', 'September 2025', 'Dr. Gomez',
   'Dr. Gomez is an amazing man and doctor. He took me on when I moved to Arizona. I was patient of his for roughly 3 years he was always professional, compassionate, insightful and understanding. He played a huge part in helping me continue my sobriety while in Arizona. His staff is informative and kind as well and is always quick to lend a hand or answer any questions. I would send my own family Dr Gomez.'],
];
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
  gtag('config', 'AW-11337249981');
</script>

<title>SPRAVATO&reg; (Esketamine) Nasal Spray in Phoenix, AZ | Interventional Psychiatry of Arizona</title>
<meta name="description" content="REMS-certified SPRAVATO® (esketamine) nasal spray for treatment-resistant depression in Phoenix, AZ. Relief for some patients within 24 hours. Most insurance accepted — we handle the prior authorization. Call (602) 824-8404.">
<meta property="og:title" content="SPRAVATO® (Esketamine) for Treatment-Resistant Depression | Phoenix, AZ">
<meta property="og:description" content="If two antidepressants haven’t worked, SPRAVATO® works differently — and faster. REMS-certified treatment center in Phoenix. Most insurance accepted.">
<meta property="og:type" content="website">
<meta property="og:image" content="<?= $absolute($img('hero', 1200)) ?>">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" type="image/png" sizes="32x32" href="<?= $asset('favicon-32.png') ?>">
<link rel="apple-touch-icon" href="<?= $asset('favicon-180.png') ?>">
<meta name="theme-color" content="#262858">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="image" href="<?= $img('hero', 2000) ?>" fetchpriority="high">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        ink:    '#1E1F42',
        /* Primary — #4B4D97 at 600, darker steps stay in the same indigo family */
        brand:  { 950:'#262858', 900:'#31336E', 800:'#3C3E84', 700:'#444690', 600:'#4B4D97', 500:'#7476BC', 200:'#C9CAE6' },
        /* Accent — built around #EF7136 */
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
  /* Nothing on the page may push the viewport sideways on a phone. */
  html, body { overflow-x: hidden; }

  /* Soft film grain over the dark bands so the gradients don't band */
  .grain::after{
    content:''; position:absolute; inset:0; pointer-events:none; opacity:.22; mix-blend-mode:overlay;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='240' height='240'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='3'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
  }

  /* ── Header ──────────────────────────────────────────────────────────────
     Transparent while it floats over the hero, solid cream once the page
     scrolls past it. Children recolour off the header's data-state. */
  #nav{ transition: background-color .35s ease, border-color .35s ease, backdrop-filter .35s ease; }
  #nav[data-state="top"]{ background:transparent; border-color:transparent; backdrop-filter:none; box-shadow:none; }
  #nav[data-state="top"] .nav-link{ color:rgba(251,249,246,.80); }
  #nav[data-state="top"] .nav-link:hover{ background:rgba(255,255,255,.10); color:#FBF9F6; }
  #nav[data-state="top"] .nav-cta{ background:#EF7136; color:#fff; }
  #nav[data-state="top"] .nav-cta:hover{ background:#C24E12; }
  #nav[data-state="top"] .nav-burger{ color:#FBF9F6; border-color:rgba(255,255,255,.28); }
  #nav[data-state="top"] .nav-drawer{ border-color:rgba(255,255,255,.15); }

  /* Logo lockups cross-fade with the header state */
  .nav-logo{ transition:opacity .35s ease; }
  #nav[data-state="top"] .nav-logo-dark{ opacity:0; }
  #nav[data-state="top"] .nav-logo-light{ opacity:1; }
  .nav-logo-light{ opacity:0; }

  /* Scroll reveal */
  .reveal { opacity:0; transform:translateY(18px); transition:opacity .7s cubic-bezier(.2,.7,.2,1), transform .7s cubic-bezier(.2,.7,.2,1); }
  .reveal.in { opacity:1; transform:none; }

  /* ── Glass eligibility card ──────────────────────────────────────────────
     Frosted panel over the hero artwork: a light gradient sheet for the glass
     itself, a tinted base so type stays legible, and an inset top highlight. */
  .glass{
    background: linear-gradient(160deg, rgba(255,255,255,.14), rgba(255,255,255,.05)), rgba(38,40,88,.55);
    backdrop-filter: blur(22px) saturate(150%);
    -webkit-backdrop-filter: blur(22px) saturate(150%);
    border: 1px solid rgba(255,255,255,.18);
    box-shadow: 0 30px 70px -25px rgba(8,10,35,.75), inset 0 1px 0 rgba(255,255,255,.25);
  }
  @supports not ((backdrop-filter: blur(1px)) or (-webkit-backdrop-filter: blur(1px))){
    .glass{ background: rgba(38,40,88,.93); }
  }

  .glass-field{
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.16);
    color: #FBF9F6;
    /* 16px on phones keeps iOS Safari from zooming the viewport on focus. */
    font-size: 16px;
    transition: background-color .2s, border-color .2s, box-shadow .2s;
  }
  @media (min-width: 640px){ .glass-field{ font-size: 15px; } }
  .glass-field::placeholder{ color: rgba(251,249,246,.46); }
  .glass-field:hover{ border-color: rgba(255,255,255,.26); }
  .glass-field:focus{
    background: rgba(255,255,255,.13);
    border-color: #EF7136;
    box-shadow: 0 0 0 3px rgba(239,113,54,.22);
  }
  /* Native dropdown panels don't inherit the glass — set them explicitly or the
     options render cream-on-white. */
  .glass-field option{ color:#1E1F42; background:#FBF9F6; }
  /* Keep browser autofill from painting a solid block over the glass */
  .glass-field:-webkit-autofill,
  .glass-field:-webkit-autofill:focus{
    -webkit-text-fill-color: #FBF9F6;
    -webkit-box-shadow: 0 0 0 1000px rgba(72,74,120,.55) inset;
    transition: background-color 9999s ease-in-out 0s;
  }

  /* Horizontal rails — testimonials and the carrier wall on small screens */
  .slider{ scrollbar-width:none; -ms-overflow-style:none; }
  .slider::-webkit-scrollbar{ display:none; }
  .quote{ display:-webkit-box; -webkit-box-orient:vertical; -webkit-line-clamp:7; overflow:hidden; }
  .q-open .quote{ -webkit-line-clamp:unset; }
  .q-more{ display:none; }
  .q-clamped .q-more{ display:inline-flex; }

  /* FAQ accordion */
  .faq-body { display:grid; grid-template-rows:0fr; transition:grid-template-rows .35s cubic-bezier(.2,.7,.2,1); }
  .faq.open .faq-body { grid-template-rows:1fr; }
  .faq-body > div { overflow:hidden; }
  .faq.open .faq-icon { transform:rotate(45deg); }

  /* ── Sticky mobile action bar ────────────────────────────────────────────
     The two things a visitor on a phone actually wants — call, or start the
     eligibility check — stay one thumb away once the hero form scrolls off.
     Padded for the iOS home indicator. */
  #stickyBar{
    transform:translateY(130%);
    transition:transform .35s cubic-bezier(.2,.7,.2,1);
    padding-bottom: calc(0.75rem + env(safe-area-inset-bottom));
  }
  #stickyBar.show{ transform:none; }

  @media (prefers-reduced-motion: reduce){
    .reveal{opacity:1;transform:none;transition:none}
    .animate-ping{animation:none}
    #stickyBar{transition:none}
  }
</style>
<!-- Reveal-on-scroll starts at opacity 0; without JS it would never come back. -->
<noscript><style>.reveal{opacity:1 !important;transform:none !important}</style></noscript>
</head>

<body class="bg-cream text-ink font-sans antialiased selection:bg-accent-200 selection:text-brand-900">

<!-- ══════════════════ TOP BAR ══════════════════ -->
<div class="hidden md:block bg-brand-950 text-brand-200/80 text-[13px]">
  <div class="mx-auto max-w-8xl px-6 lg:px-10 h-10 flex items-center justify-between gap-6">
    <p class="text-white/60 truncate">REMS-certified SPRAVATO&reg; treatment center &middot; Now accepting new patients in Phoenix</p>
    <div class="flex items-center gap-5 shrink-0 text-white/60">
      <span class="hidden lg:inline">Mon–Fri · 8am–5pm</span>
      <span class="hidden lg:inline h-3 w-px bg-white/20"></span>
      <a href="tel:<?= $PHONE_LINK ?>" class="font-medium text-white/85 hover:text-white transition"><?= $PHONE_DISPLAY ?></a>
    </div>
  </div>
</div>

<!-- ══════════════════ NAV ══════════════════ -->
<header id="nav" data-state="top" class="sticky top-0 z-50 transition-all duration-300 bg-cream/85 backdrop-blur-xl border-b border-black/5">
  <nav class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-10">
    <div class="h-[68px] sm:h-[80px] flex items-center justify-between gap-4 lg:gap-8">

      <a href="#top" class="relative block shrink-0 h-12 sm:h-[3.6rem] aspect-[545/228]" aria-label="Interventional Psychiatry of Arizona — home">
        <img src="<?= $LOGO_DARK ?>" alt="Interventional Psychiatry of Arizona — Building Strong Minds"
             width="545" height="228" class="nav-logo nav-logo-dark absolute inset-0 h-full w-auto">
        <img src="<?= $LOGO_LIGHT ?>" alt="" aria-hidden="true"
             width="545" height="228" class="nav-logo nav-logo-light absolute inset-0 h-full w-auto">
      </a>

      <div class="hidden lg:flex items-center gap-0.5 xl:gap-1 whitespace-nowrap text-[15px] text-brand-900/75">
        <a href="#qualify"   class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Do I qualify?</a>
        <a href="#science"   class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">How it works</a>
        <a href="#process"   class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Treatment</a>
        <a href="#insurance" class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Insurance</a>
        <a href="#faq"       class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">FAQ</a>
      </div>

      <div class="flex items-center gap-2 sm:gap-3">
        <!-- Phones get a tap-to-call button; the long CTA would overflow the bar,
             and the sticky footer already carries the eligibility action. -->
        <a href="tel:<?= $PHONE_LINK ?>" aria-label="Call <?= $PHONE_DISPLAY ?>"
           class="nav-cta sm:hidden grid place-items-center h-11 w-11 rounded-full bg-brand-900 text-cream">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-[18px] w-[18px]"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
        </a>
        <a href="#eligibility" class="nav-cta hidden sm:inline-flex items-center gap-2 whitespace-nowrap rounded-full bg-brand-900 px-5 py-2.5 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition shadow-sm hover:shadow-md">
          Check my eligibility
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
        </a>
        <button id="menuBtn" aria-label="Open menu" aria-expanded="false" aria-controls="mobileMenu"
                class="nav-burger lg:hidden grid place-items-center h-11 w-11 rounded-lg border border-black/10 text-brand-900">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
      </div>
    </div>

    <!-- mobile drawer -->
    <div id="mobileMenu" class="lg:hidden hidden pb-5">
      <div class="nav-drawer grid gap-1 text-[16px] text-brand-900/80 border-t border-black/5 pt-4">
        <a href="#qualify"     class="nav-link px-3 py-3 rounded-lg hover:bg-sand">Do I qualify?</a>
        <a href="#science"     class="nav-link px-3 py-3 rounded-lg hover:bg-sand">How it works</a>
        <a href="#process"     class="nav-link px-3 py-3 rounded-lg hover:bg-sand">Your treatment</a>
        <a href="#insurance"   class="nav-link px-3 py-3 rounded-lg hover:bg-sand">Insurance &amp; cost</a>
        <a href="#safety"      class="nav-link px-3 py-3 rounded-lg hover:bg-sand">Safety</a>
        <a href="#faq"         class="nav-link px-3 py-3 rounded-lg hover:bg-sand">FAQ</a>
        <a href="#eligibility" class="mt-1 px-3 py-3 rounded-lg bg-accent-500 text-center font-medium text-white">Check my eligibility</a>
      </div>
    </div>
  </nav>
</header>

<!-- ══════════════════ HERO ══════════════════ -->
<section id="top" class="relative overflow-hidden bg-brand-950 -mt-[68px] sm:-mt-[80px] pt-[68px] sm:pt-[80px]">
  <img src="<?= $img('hero', 2000) ?>" alt="<?= $alt('hero') ?>" fetchpriority="high" decoding="async"
       class="js-photo pointer-events-none absolute inset-0 h-full w-full object-cover object-center">
  <!-- Two overlays rather than one: a flat tint to sit the brand over the photo, then
       a left-to-right gradient that darkens behind the headline and behind the form
       while staying light through the middle, where the subject is. -->
  <div class="pointer-events-none absolute inset-0 bg-brand-950/55"></div>
  <div class="pointer-events-none absolute inset-0 bg-gradient-to-r from-brand-950/55 via-brand-950/5 to-brand-950/45"></div>

  <div class="relative mx-auto max-w-8xl px-5 sm:px-6 lg:px-10 pt-8 pb-12 lg:pt-12 lg:pb-16">
    <div class="grid lg:grid-cols-12 gap-8 lg:gap-10 items-center">

      <div class="lg:col-span-6 reveal">
        <div class="inline-flex items-center gap-2.5 rounded-full border border-white/15 bg-white/5 px-3.5 py-1.5 text-[12px] sm:text-[13px] text-cream/80 backdrop-blur">
          <span class="relative flex h-2 w-2 shrink-0">
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-accent-400 opacity-75"></span>
            <span class="relative inline-flex h-2 w-2 rounded-full bg-accent-400"></span>
          </span>
          REMS-certified SPRAVATO&reg; center · Phoenix, AZ
        </div>

        <h1 class="mt-5 sm:mt-7 font-display text-[2rem] leading-[1.08] min-[400px]:text-[2.3rem] sm:text-[2.9rem] lg:text-[3.1rem] xl:text-[3.6rem] tracking-tightest text-cream font-light">
          Two antidepressants<br class="hidden min-[400px]:block"> haven't worked.
          <span class="italic text-accent-400"><?= $SPR ?> works differently.</span>
        </h1>

        <p class="mt-5 max-w-lg text-[15.5px] sm:text-[16.5px] lg:text-[17.5px] leading-relaxed text-cream/70 font-light">
          SPRAVATO&reg; (esketamine) is the first prescription nasal spray used alongside an oral
          antidepressant to treat severe, treatment-resistant depression. Many patients feel a shift
          within 24 hours, not weeks.
        </p>

        <div class="mt-7 flex flex-col sm:flex-row gap-3">
          <a href="#eligibility" class="group inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-6 py-3.5 sm:px-7 sm:py-4 text-[15.5px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
            Check if I qualify
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
          </a>
          <a href="tel:<?= $PHONE_LINK ?>" class="inline-flex items-center justify-center gap-2.5 rounded-full border border-white/20 bg-white/5 px-6 py-3.5 sm:px-7 sm:py-4 text-[15.5px] font-medium text-cream hover:bg-white/10 transition backdrop-blur">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
            <span class="sm:hidden">Call us</span>
            <span class="hidden sm:inline">Call <?= $PHONE_DISPLAY ?></span>
          </a>
        </div>

        <!-- A real photograph from the practice, at a size where the 680px source
             still looks sharp — the treatment is a person in a room, not a diagram. -->
        <figure class="mt-7 flex items-center gap-4 max-w-lg rounded-2xl border border-white/12 bg-white/[0.07] p-2.5 backdrop-blur">
          <img src="<?= $img('care', 600) ?>" alt="<?= $alt('care') ?>" loading="lazy" decoding="async"
               class="js-photo h-16 w-16 sm:h-[4.5rem] sm:w-[4.5rem] shrink-0 rounded-xl object-cover">
          <figcaption class="pr-1 text-[13.5px] sm:text-[14px] leading-snug text-cream/70">
            A nasal spray you take yourself, here in our Phoenix office — with a clinician beside you
            the whole time.
          </figcaption>
        </figure>

        <dl class="mt-5 grid grid-cols-3 gap-3 sm:gap-6 max-w-lg border-t border-white/10 pt-5">
          <div>
            <dt class="font-display text-2xl sm:text-3xl text-cream font-light">24 hrs</dt>
            <dd class="mt-1 text-[12px] sm:text-[13px] leading-snug text-cream/50">Relief can begin this fast</dd>
          </div>
          <div>
            <dt class="font-display text-2xl sm:text-3xl text-cream font-light">$10</dt>
            <dd class="mt-1 text-[12px] sm:text-[13px] leading-snug text-cream/50">Per treatment, eligible plans<sup class="text-accent-400">*</sup></dd>
          </div>
          <div>
            <dt class="font-display text-2xl sm:text-3xl text-cream font-light">Most</dt>
            <dd class="mt-1 text-[12px] sm:text-[13px] leading-snug text-cream/50">Insurance accepted &amp; verified</dd>
          </div>
        </dl>
      </div>

      <!-- eligibility form -->
      <div id="eligibility" class="lg:col-span-6 reveal scroll-mt-24 sm:scroll-mt-28" style="transition-delay:.12s">
        <div class="relative">
          <div class="pointer-events-none absolute -inset-3 sm:-inset-4 rounded-[32px] bg-gradient-to-br from-accent-400/20 via-transparent to-brand-500/20 blur-2xl"></div>

          <form id="contactForm" action="<?= $FORM_ENDPOINT ?>" method="POST" accept-charset="UTF-8"
                class="glass relative rounded-3xl sm:rounded-[28px] p-5 sm:p-8">

            <div class="flex items-start justify-between gap-4">
              <div>
                <h2 class="font-display text-[22px] sm:text-[27px] leading-tight tracking-tight text-cream">Check your SPRAVATO&reg; eligibility</h2>
                <p class="mt-2 text-[14px] sm:text-[14.5px] leading-relaxed text-cream/60">
                  Two questions and your contact details. We verify your benefits and call you back
                  within one business day.
                </p>
              </div>
              <span class="hidden sm:grid place-items-center h-11 w-11 shrink-0 rounded-2xl bg-white/10 ring-1 ring-white/15 text-accent-400">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-5 w-5"><path d="M12 3l7.5 3v5.5c0 4.4-3.1 8.2-7.5 9.5-4.4-1.3-7.5-5.1-7.5-9.5V6L12 3Z"/><path d="M9.5 12l1.8 1.8L15 10"/></svg>
              </span>
            </div>

            <div class="mt-5 sm:mt-6 grid sm:grid-cols-2 gap-3 sm:gap-3.5">
              <div class="sm:col-span-2">
                <label for="tried" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">How many antidepressants have you tried without enough relief?</label>
                <select id="tried" name="Antidepressants tried" class="glass-field w-full appearance-none rounded-xl px-4 py-3 pr-10 outline-none"
                        style="background-image:url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%23FBF9F6' stroke-opacity='.6' stroke-width='2'%3E%3Cpath d='m4 6 4 4 4-4'/%3E%3C/svg%3E&quot;);background-repeat:no-repeat;background-position:right 1rem center">
                  <?php foreach ([
                    'Two or more — none have worked well enough',
                    'One so far',
                    'None yet — I’m just starting to look',
                    'I’m not sure',
                  ] as $opt): ?>
                  <option><?= $opt ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="sm:col-span-2">
                <label for="carrier" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Your insurance</label>
                <select id="carrier" name="Insurance" class="glass-field w-full appearance-none rounded-xl px-4 py-3 pr-10 outline-none"
                        style="background-image:url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%23FBF9F6' stroke-opacity='.6' stroke-width='2'%3E%3Cpath d='m4 6 4 4 4-4'/%3E%3C/svg%3E&quot;);background-repeat:no-repeat;background-position:right 1rem center">
                  <option>I’m not sure — please check for me</option>
                  <?php foreach ($insurers as [$carrier, $file]): ?>
                  <option><?= $carrier ?></option>
                  <?php endforeach; ?>
                  <option>AHCCCS / Arizona Medicaid</option>
                  <option>Another plan</option>
                  <option>No insurance / self-pay</option>
                </select>
              </div>
              <div>
                <label for="fname" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">First name</label>
                <input id="fname" name="First name" autocomplete="given-name" required class="glass-field w-full rounded-xl px-4 py-3 outline-none" placeholder="Jane">
              </div>
              <div>
                <label for="lname" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Last name</label>
                <input id="lname" name="Last name" autocomplete="family-name" required class="glass-field w-full rounded-xl px-4 py-3 outline-none" placeholder="Doe">
              </div>
              <div>
                <label for="phone" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Phone</label>
                <input id="phone" name="Phone" type="tel" inputmode="tel" autocomplete="tel" required class="glass-field w-full rounded-xl px-4 py-3 outline-none" placeholder="(602) 000-0000">
              </div>
              <div>
                <label for="email" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Email</label>
                <input id="email" name="Email" type="email" inputmode="email" autocomplete="email" required class="glass-field w-full rounded-xl px-4 py-3 outline-none" placeholder="you@email.com">
              </div>
            </div>

            <!-- Spam trap: real people never see this, bots fill it in. -->
            <div class="hidden" aria-hidden="true">
              <label>Do not fill this in <input type="text" name="company" tabindex="-1" autocomplete="off"></label>
            </div>
            <input type="hidden" name="Source" value="Spravato landing page">
            <input type="hidden" name="Interested in" value="Spravato (nasal esketamine)">

            <button type="submit" class="group mt-5 w-full inline-flex items-center justify-center gap-2.5 rounded-full bg-cream px-6 py-4 text-[15.5px] font-medium text-brand-900 hover:bg-white transition shadow-lg shadow-black/25">
              Check my eligibility
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
            </button>

            <p id="formNote" class="hidden mt-4 rounded-xl border border-accent-400/30 bg-accent-500/15 px-4 py-3 text-[14px] text-cream/85"></p>

            <p class="mt-4 flex items-start gap-2.5 text-[11.5px] sm:text-[12px] leading-relaxed text-cream/55">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-4 w-4 shrink-0 mt-px"><rect x="4.5" y="10" width="15" height="10" rx="2"/><path d="M8 10V7.5a4 4 0 0 1 8 0V10"/></svg>
              <span>Please don't include sensitive medical details. Not for emergencies — in a crisis, call <a href="tel:988" class="font-semibold text-accent-400 hover:underline">988</a> or 911.</span>
            </p>
          </form>
        </div>
      </div>

    </div>
  </div>

  <!-- trust bar, attached to the hero so it costs no extra band -->
  <div class="relative border-t border-white/10 bg-brand-950/60">
    <div class="mx-auto max-w-8xl px-5 sm:px-6 lg:px-10 py-5">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-4">
        <?php
        $trust = [
          ['REMS-certified',    'Protocol-driven monitoring'],
          ['FDA-approved',      'For TRD and MDD with SI'],
          ['Insurance handled', 'We file the authorization'],
          ['Board-certified',   '15+ years in practice'],
        ];
        foreach ($trust as [$t, $s]): ?>
        <div class="flex items-start gap-2.5">
          <span class="mt-0.5 grid place-items-center h-4 w-4 shrink-0 rounded-full bg-accent-500/20 text-accent-400">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" class="h-2.5 w-2.5"><path d="M5 13l4 4L19 7"/></svg>
          </span>
          <div class="min-w-0">
            <p class="text-[13.5px] font-semibold text-cream"><?= $t ?></p>
            <p class="text-[12.5px] text-cream/45 leading-snug"><?= $s ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════ DO I QUALIFY ══════════════════ -->
<section id="qualify" class="py-12 sm:py-14 lg:py-20 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-5 sm:px-6 lg:px-10">

    <div class="max-w-3xl reveal">
      <p class="text-[11.5px] sm:text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Do I qualify?</p>
      <h2 class="mt-4 font-display text-[1.9rem] sm:text-[2.5rem] lg:text-[3rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
        <?= $SPR ?> is for a specific kind of depression.
      </h2>
      <p class="mt-4 text-[15.5px] sm:text-[17px] leading-relaxed text-brand-900/60 font-light">
        It is approved for two groups of adults with major depressive disorder — and about 30% of
        people diagnosed with depression fall into treatment-resistant territory.
      </p>
    </div>

    <div class="mt-8 sm:mt-10 grid sm:grid-cols-3 gap-3.5 sm:gap-5">
      <?php
      $criteria = [
        ['Treatment-resistant depression',
         'An adult with major depressive disorder that has not responded to standard antidepressant treatment.'],
        ['Two or more antidepressants tried',
         'No adequate response to at least two different antidepressants during your current episode — usually six weeks each. This is the criterion insurers check.'],
        ['Depression with suicidal thoughts',
         'Depressive symptoms alongside suicidal thoughts or actions, where waiting weeks for a medication to work is not an option.'],
      ];
      foreach ($criteria as $i => [$h, $p]): ?>
      <article class="reveal flex gap-4 sm:block rounded-2xl sm:rounded-3xl border border-black/[0.07] bg-white p-5 sm:p-7 transition duration-300 hover:border-brand-900/15 hover:shadow-lg hover:shadow-brand-900/[0.06]"
               style="transition-delay:<?= $i * 60 ?>ms">
        <span class="grid place-items-center h-9 w-9 sm:h-11 sm:w-11 shrink-0 rounded-xl sm:rounded-2xl bg-accent-50 text-accent-600 ring-1 ring-accent-200">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" class="h-4 w-4 sm:h-5 sm:w-5"><path d="M5 13l4 4L19 7"/></svg>
        </span>
        <div class="min-w-0">
          <h3 class="sm:mt-5 font-display text-[19px] sm:text-[22px] leading-snug tracking-tight text-brand-900"><?= $h ?></h3>
          <p class="mt-2 text-[14.5px] sm:text-[15px] leading-relaxed text-brand-900/60"><?= $p ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <div class="reveal mt-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 rounded-2xl border border-black/[0.07] bg-white px-5 sm:px-7 py-5">
      <p class="text-[15px] sm:text-[16px] leading-relaxed text-brand-900/65">
        <span class="text-brand-900 font-medium">Not sure whether you meet the criteria?</span>
        That is exactly what the first call is for.
      </p>
      <a href="#eligibility" class="group inline-flex items-center justify-center gap-2 rounded-full bg-brand-900 px-6 py-3 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition shrink-0">
        Check my eligibility
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════ HOW IT WORKS + HOW IT COMPARES ══════════════════ -->
<section id="science" class="bg-white border-y border-black/5 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-5 sm:px-6 lg:px-10 py-12 sm:py-14 lg:py-20">

    <div class="grid lg:grid-cols-12 gap-8 lg:gap-14 items-center">
      <div class="lg:col-span-7 reveal">
        <p class="text-[11.5px] sm:text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">How it works</p>
        <h2 class="mt-4 font-display text-[1.9rem] sm:text-[2.5rem] lg:text-[3rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
          A different target in the brain.
        </h2>
        <p class="mt-4 text-[15.5px] sm:text-[16.5px] leading-relaxed text-brand-900/60 font-light max-w-xl">
          Standard antidepressants work on serotonin and norepinephrine, and take weeks to build an
          effect. SPRAVATO&reg; acts on the brain's glutamate system instead — which is why it moves
          so much faster.
        </p>

        <!-- The mechanism as a sequence: each step follows from the one before it,
             so the cards are numbered and joined by a rule on wide screens. -->
        <ol class="relative mt-8 grid sm:grid-cols-3 gap-3.5 sm:gap-4">
          <div class="hidden sm:block absolute top-[2.4rem] left-[12%] right-[12%] h-px bg-black/10"></div>
          <?php
          $mechanism = [
            ['Blocks NMDA receptors', 'The doorways controlling glutamate flow. When they are overactive, mood and thinking suffer; esketamine restores the balance.',
             'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18Z M5.6 5.6l12.8 12.8'],
            ['Rebuilds connections',  'Depression damages the connections between neurons. Esketamine promotes neuroplasticity, so improvement can hold rather than fade.',
             'M7 5.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z M21 9.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z M14 18.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z M6.6 7.1l10 1.6 M18.4 11.2 13.3 17'],
            ['Works with your meds',  'It is prescribed alongside an oral antidepressant, not instead of one — and only ever given under medical supervision.',
             'M10.5 3.5a5 5 0 0 1 7 7l-7 7a5 5 0 0 1-7-7l7-7Z M7 7l7 7'],
          ];
          foreach ($mechanism as $i => [$h, $p, $icon]): ?>
          <li class="reveal relative flex gap-4 sm:block rounded-2xl border border-black/[0.07] bg-cream p-5 sm:p-6" style="transition-delay:<?= $i * 60 ?>ms">
            <span class="relative grid place-items-center h-10 w-10 sm:h-12 sm:w-12 shrink-0 rounded-full bg-white text-brand-700 ring-1 ring-black/[0.07] shadow-sm">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="h-[18px] w-[18px] sm:h-5 sm:w-5"><path d="<?= $icon ?>"/></svg>
              <span class="absolute -top-1 -right-1 grid place-items-center h-4 w-4 rounded-full bg-accent-500 text-[10px] font-semibold text-white"><?= $i + 1 ?></span>
            </span>
            <div class="min-w-0">
              <h3 class="sm:mt-4 font-display text-[18px] sm:text-[19px] leading-snug tracking-tight text-brand-900"><?= $h ?></h3>
              <p class="mt-1.5 text-[14px] leading-relaxed text-brand-900/60"><?= $p ?></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ol>

        <!-- The whole argument in one picture: how long each takes to do anything. -->
        <div class="reveal mt-4 rounded-2xl border border-black/[0.07] bg-cream p-5 sm:p-6">
          <p class="text-[11.5px] uppercase tracking-[0.16em] text-brand-900/40">Time to first relief</p>
          <div class="mt-4 space-y-3.5">
            <?php
            $speed = [
              ['SPRAVATO&reg;',        '24 hours to a few days', '12%',  true],
              ['Oral antidepressant', '6 to 12 weeks',          '100%', false],
            ];
            foreach ($speed as [$who, $when, $width, $lead]): ?>
            <div>
              <div class="flex items-baseline justify-between gap-3">
                <p class="text-[14.5px] font-medium <?= $lead ? 'text-brand-900' : 'text-brand-900/55' ?>"><?= $who ?></p>
                <p class="text-[13.5px] font-medium <?= $lead ? 'text-accent-600' : 'text-brand-900/40' ?>"><?= $when ?></p>
              </div>
              <div class="mt-1.5 h-2 rounded-full bg-brand-900/[0.07] overflow-hidden">
                <div class="h-full rounded-full <?= $lead ? 'bg-accent-500' : 'bg-brand-500/45' ?>" style="width:<?= $width ?>"></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <p class="mt-3.5 text-[12px] text-brand-900/40">Illustrative, not to scale. Individual response varies.</p>
        </div>
      </div>

      <div class="reveal lg:col-span-5">
        <!-- The source is portrait (578 × 661), so the frame stays portrait and is
             capped on phones rather than cropped to a landscape band. -->
        <figure class="mx-auto max-w-[15rem] sm:max-w-[19rem] lg:max-w-none overflow-hidden rounded-2xl sm:rounded-3xl ring-1 ring-black/5">
          <img src="<?= $img('device', 900) ?>" alt="<?= $alt('device') ?>" loading="lazy" decoding="async"
               class="js-photo aspect-[7/8] w-full object-cover">
        </figure>
        <div class="mt-3.5 flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-black/[0.07] bg-cream px-5 py-4">
          <img src="<?= $SPRAVATO_MARK ?>" alt="SPRAVATO (esketamine) CIII nasal spray"
               width="268" height="90" loading="lazy" class="js-photo h-7 w-auto">
          <p class="text-[12.5px] leading-snug text-brand-900/50 max-w-[13rem]">Dispensed only through REMS-certified centers. We are one.</p>
        </div>
      </div>
    </div>

    <!-- ── comparison ──────────────────────────────────────────────────────────
         Kept dark, because the highlighted SPRAVATO® column needs the contrast —
         but contained as a panel rather than a second full-width blue band. -->
    <div class="relative overflow-hidden mt-10 sm:mt-12 rounded-[24px] sm:rounded-[28px] bg-brand-950 text-cream grain p-5 sm:p-8 lg:p-10 reveal">
      <div class="pointer-events-none absolute -right-32 -top-24 h-[24rem] w-[24rem] rounded-full bg-brand-600/40 blur-[110px]"></div>
      <div class="relative">
      <h3 class="font-display text-[1.6rem] sm:text-[2rem] leading-tight tracking-tightest font-light">
        Faster than pills. Gentler than ECT.
      </h3>
      <p class="mt-3 text-[15px] sm:text-[15.5px] leading-relaxed text-cream/60 font-light max-w-2xl">
        All three treat depression that hasn't responded to standard care. They differ in how fast
        they work, what a session costs you in time, and what you feel afterward.
      </p>

      <!-- Phones and tablets: one card per attribute, so nothing scrolls sideways. -->
      <div class="mt-7 grid gap-3 sm:grid-cols-2 lg:hidden">
        <?php foreach ($compareRows as [$label, $values]): ?>
        <div class="overflow-hidden rounded-2xl border border-white/12 bg-white/[0.03]">
          <p class="px-4 pt-3.5 pb-2.5 text-[11.5px] uppercase tracking-[0.16em] text-cream/45"><?= $label ?></p>
          <div class="border-t border-white/10">
            <?php foreach ($compareCols as $c => [$colName, $colSub]):
              $lead = $c === 0; ?>
            <div class="flex items-start gap-2.5 px-4 py-3 <?= $lead ? 'bg-accent-500/15' : 'border-t border-white/[0.07]' ?>">
              <?php if ($lead): ?>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" class="mt-[3px] h-3.5 w-3.5 shrink-0 text-accent-400"><path d="M5 13l4 4L19 7"/></svg>
              <?php else: ?>
              <span class="mt-2 h-1 w-1 shrink-0 rounded-full bg-cream/25"></span>
              <?php endif; ?>
              <div class="min-w-0">
                <p class="text-[11.5px] uppercase tracking-[0.12em] <?= $lead ? 'text-accent-400' : 'text-cream/35' ?>"><?= $colName ?></p>
                <p class="mt-0.5 text-[14.5px] leading-snug <?= $lead ? 'text-cream' : 'text-cream/60' ?>"><?= $values[$c] ?></p>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Large screens: the real table, where all three columns fit at once. -->
      <table class="hidden lg:table w-full mt-8 border-separate border-spacing-0 text-left">
        <caption class="sr-only">SPRAVATO® compared with oral antidepressants and electroconvulsive therapy</caption>
        <thead>
          <tr>
            <th scope="col" class="w-[22%] pb-5 pr-6"><span class="sr-only">Attribute</span></th>
            <?php foreach ($compareCols as $c => [$colName, $colSub]): ?>
            <th scope="col" class="w-[26%] px-6 pb-5 align-bottom <?= $c === 0 ? 'rounded-t-2xl bg-accent-500/15 pt-6' : '' ?>">
              <span class="block font-display text-[22px] tracking-tight <?= $c === 0 ? 'text-cream' : 'text-cream/80' ?>"><?= $c === 0 ? $SPR : $colName ?></span>
              <span class="mt-1 block text-[12.5px] <?= $c === 0 ? 'text-accent-400' : 'text-cream/40' ?>"><?= $colSub ?></span>
            </th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody class="align-top">
          <?php foreach ($compareRows as $i => [$label, $values]):
            $last = $i === count($compareRows) - 1; ?>
          <tr>
            <th scope="row" class="border-t border-white/10 py-5 pr-6 text-[14.5px] font-medium text-cream/55"><?= $label ?></th>
            <?php foreach ($values as $c => $v): ?>
            <td class="border-t border-white/10 px-6 py-5 text-[15px] <?= $c === 0 ? 'bg-accent-500/15 text-cream ' . ($last ? 'rounded-b-2xl' : '') : 'text-cream/60' ?>">
              <?php if ($c === 0): ?>
              <span class="flex items-start gap-2.5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" class="mt-1 h-3.5 w-3.5 shrink-0 text-accent-400"><path d="M5 13l4 4L19 7"/></svg>
                <?= $v ?>
              </span>
              <?php else: ?>
              <?= $v ?>
              <?php endif; ?>
            </td>
            <?php endforeach; ?>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="mt-7 flex flex-col sm:flex-row sm:items-center gap-4">
        <a href="#eligibility" class="group inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-6 py-3.5 text-[15px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20 shrink-0">
          See if it's right for me
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
        </a>
        <p class="text-[14px] leading-relaxed text-cream/45 max-w-md">
          We also offer TMS, ECT and medication management — so if SPRAVATO&reg; isn't the right fit,
          you don't start over somewhere else.
        </p>
      </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════ YOUR TREATMENT + THE CLINIC ══════════════════ -->
<section id="process" class="py-12 sm:py-14 lg:py-20 border-b border-black/5 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-5 sm:px-6 lg:px-10">

    <div class="max-w-2xl reveal">
      <p class="text-[11.5px] sm:text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Your treatment</p>
      <h2 class="mt-4 font-display text-[1.9rem] sm:text-[2.5rem] lg:text-[3rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
        From first call to first dose.
      </h2>
    </div>

    <div class="relative mt-8 sm:mt-10">
      <div class="hidden lg:block absolute top-6 left-0 right-0 h-px bg-gradient-to-r from-transparent via-black/10 to-transparent"></div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 lg:gap-7">
        <?php
        $steps = [
          ['Consultation &amp; evaluation',
           'A full psychiatric evaluation — history, every medication tried, medical factors and a baseline depression score. Also where we screen for what rules SPRAVATO® out.'],
          ['Insurance &amp; authorization',
           'We file the prior authorization and talk to your insurer. Approval typically takes three days to two weeks; if denied, we file the appeal.'],
          ['Induction — weeks 1 to 4',
           'Two sessions per week for the first month, alongside your oral antidepressant. Many patients notice a change in the first days.'],
          ['Maintenance &amp; follow-up',
           'Once you are responding, sessions taper to a maintenance schedule set by how you are actually doing — tracked at every visit.'],
        ];
        foreach ($steps as $i => [$h, $p]): ?>
        <div class="reveal relative flex gap-4 lg:block" style="transition-delay:<?= $i * 70 ?>ms">
          <span class="relative z-10 grid place-items-center h-11 w-11 lg:h-12 lg:w-12 shrink-0 rounded-2xl bg-brand-900 text-cream font-display text-lg font-light shadow-lg shadow-brand-900/15">
            <?= $i + 1 ?>
          </span>
          <div class="min-w-0">
            <h3 class="lg:mt-5 font-display text-[19px] sm:text-[21px] leading-snug tracking-tight text-brand-900"><?= $h ?></h3>
            <p class="mt-2 text-[14.5px] sm:text-[15px] leading-relaxed text-brand-900/60"><?= $p ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- what one session looks like — a compact strip rather than its own band -->
    <div class="reveal mt-10 rounded-2xl sm:rounded-3xl bg-sand/70 p-5 sm:p-7">
      <h3 class="font-display text-[20px] sm:text-[23px] tracking-tight text-brand-900">What one session actually looks like</h3>
      <ul class="mt-5 grid sm:grid-cols-3 gap-5 sm:gap-6">
        <?php
        $session = [
          ['You self-administer', 'The nasal spray, under the direct supervision of our trained staff.',
           'M12 3c3 3.5 5 6.4 5 9a5 5 0 0 1-10 0c0-2.6 2-5.5 5-9Z'],
          ['Two-hour monitoring', 'In a private room with a recliner. Vital signs checked throughout; most side effects resolve inside this window.',
           'M12 7v5l3 2M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18Z'],
          ['Arrange a ride home',  'No driving or operating machinery until the next day, after a full night’s sleep.',
           'M5 16h14M6.5 16V11l1.6-4h7.8l1.6 4v5M8 19v-3M16 19v-3'],
        ];
        foreach ($session as [$h, $p, $icon]): ?>
        <li class="flex gap-3.5 sm:block">
          <span class="grid place-items-center h-9 w-9 sm:h-10 sm:w-10 shrink-0 rounded-xl bg-white text-brand-800 ring-1 ring-black/5">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 sm:h-5 sm:w-5"><path d="<?= $icon ?>"/></svg>
          </span>
          <div class="min-w-0">
            <p class="sm:mt-3.5 text-[15px] font-medium text-brand-900"><?= $h ?></p>
            <p class="mt-1 text-[14px] leading-relaxed text-brand-900/55"><?= $p ?></p>
          </div>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- the practice itself -->
    <?php
    /* Spans total 12 per row: 5+4+3, then the row-spanning tile plus 7. */
    $gallery = [
      ['session',   'Self-administered, supervised',  'lg:col-span-5 lg:row-span-2'],
      ['room',      'The monitoring room',            'lg:col-span-4'],
      ['reception', 'Reception, never a crowd',       'lg:col-span-3'],
      ['tms',       'TMS and ECT down the same hall', 'lg:col-span-7'],
    ];
    ?>
    <div class="reveal mt-10">
      <div class="flex flex-wrap items-end justify-between gap-3">
        <h3 class="font-display text-[20px] sm:text-[23px] tracking-tight text-brand-900">Our Phoenix clinic</h3>
        <p class="text-[13.5px] text-brand-900/45"><?= $ADDRESS_L1 ?>, <?= $ADDRESS_L2 ?></p>
      </div>
      <div class="mt-4 grid grid-cols-2 gap-2.5 sm:gap-3 lg:grid-cols-12 lg:auto-rows-[10.5rem]">
        <?php foreach ($gallery as $i => [$slot, $caption, $span]): ?>
        <figure class="group relative overflow-hidden rounded-xl sm:rounded-2xl ring-1 ring-black/5 aspect-[4/3] lg:aspect-auto <?= $i === 0 ? 'col-span-2 lg:col-span-5' : '' ?> <?= $span ?>">
          <img src="<?= $img($slot, 900) ?>" alt="<?= $alt($slot) ?>" loading="lazy" decoding="async"
               class="js-photo h-full w-full object-cover transition duration-700 group-hover:scale-[1.04]">
          <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-brand-950/85 via-brand-950/10 to-transparent"></div>
          <figcaption class="absolute inset-x-0 bottom-0 p-3 sm:p-4 text-[12.5px] sm:text-[14px] font-medium leading-snug text-cream"><?= $caption ?></figcaption>
        </figure>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="reveal mt-8 text-center">
      <a href="#eligibility" class="group inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-7 py-4 text-[15.5px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
        Start with an eligibility check
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
      </a>
      <p class="mt-3.5 text-[13.5px] text-brand-900/45">
        Or call <a href="tel:<?= $PHONE_LINK ?>" class="font-medium text-brand-900/70 hover:text-accent-600 transition"><?= $PHONE_DISPLAY ?></a> — Monday to Friday, 8am–5pm.
      </p>
    </div>
  </div>
</section>

<!-- ══════════════════ INSURANCE & COST ══════════════════ -->
<section id="insurance" class="py-12 sm:py-14 lg:py-20 bg-white border-b border-black/5 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-5 sm:px-6 lg:px-10">

    <div class="grid lg:grid-cols-12 gap-5 lg:gap-16 lg:items-end reveal">
      <div class="lg:col-span-7">
        <p class="text-[11.5px] sm:text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Insurance &amp; cost</p>
        <h2 class="mt-4 font-display text-[1.9rem] sm:text-[2.5rem] lg:text-[2.9rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
          Covered by most plans — with a form we fill in.
        </h2>
      </div>
      <div class="lg:col-span-5">
        <p class="text-[15.5px] sm:text-[16px] leading-relaxed text-brand-900/60 font-light">
          The vast majority of commercial plans, Medicare and many Medicaid programs cover
          SPRAVATO&reg;. What stands between you and approval is a prior authorization — and our care
          coordinators handle that, start to finish.
        </p>
      </div>
    </div>

    <!-- A rail on phones, a wrapped wall from lg — 17 logos would otherwise be
         nine rows of vertical scroll on a handset. -->
    <div class="slider reveal mt-8 flex gap-2.5 sm:gap-3 overflow-x-auto snap-x pb-1 -mx-5 px-5 sm:-mx-6 sm:px-6 lg:mx-0 lg:px-0 lg:flex-wrap lg:overflow-visible">
      <?php foreach ($insurers as $i => [$carrier, $file]):
        $path   = $IMG_DIR . '/insurance/' . $file;
        $exists = is_file(__DIR__ . '/' . $path);
      ?>
      <div class="snap-start grid place-items-center shrink-0 h-20 sm:h-24 w-[8.5rem] sm:w-[10rem] lg:w-[calc(20%-0.6rem)] rounded-xl sm:rounded-2xl border border-black/[0.07] bg-white px-4 transition duration-300 hover:border-brand-900/15 hover:shadow-lg hover:shadow-brand-900/[0.06]">
        <?php if ($exists): ?>
        <img src="<?= $BASE ?>/<?= $path ?>?v=<?= filemtime(__DIR__ . '/' . $path) ?>" alt="<?= $carrier ?>" loading="lazy" decoding="async"
             class="js-photo max-h-9 sm:max-h-11 max-w-[85%] w-auto object-contain opacity-90">
        <?php else: ?>
        <span class="text-center font-display text-[15px] sm:text-[18px] leading-tight tracking-tight text-brand-900/70"><?= $carrier ?></span>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <p class="lg:hidden mt-2.5 text-[12px] text-brand-900/35">Swipe to see all 17 plans →</p>

    <!-- the money questions, answered before they have to ask -->
    <div class="mt-8 grid sm:grid-cols-3 gap-3.5 sm:gap-5">
      <?php
      $cost = [
        ['Two parts to the bill',
         'The medication may run through your pharmacy or medical benefits. The two-hour observation visit is billed separately. We tell you what each costs before you start.',
         'M4 7h16v12H4V7Zm4-3h8v3H8V4Zm-1 8h10M7 15h6'],
        ['As little as $10 a treatment',
         'Janssen’s SPRAVATO withMe program can cut out-of-pocket medication costs to as little as $10 per treatment for eligible commercial plans. It covers the medication, not the clinic visit.',
         'M12 3v18M16.5 7.5c0-1.7-2-2.7-4.5-2.7S7.5 5.9 7.5 7.9s2 2.6 4.5 3.1 4.5 1.1 4.5 3.1-2 3.1-4.5 3.1-4.5-1-4.5-2.7'],
        ['Medicare &amp; AHCCCS too',
         'Medicare Part B generally covers SPRAVATO® and the observation visits in an outpatient setting. Most Medicaid programs, including Arizona’s AHCCCS, cover it — with prior authorization.',
         'M12 3l7.5 3v5.5c0 4.4-3.1 8.2-7.5 9.5-4.4-1.3-7.5-5.1-7.5-9.5V6L12 3Z'],
      ];
      foreach ($cost as $i => [$h, $p, $icon]): ?>
      <div class="reveal flex gap-4 sm:block rounded-2xl sm:rounded-3xl border border-black/[0.07] bg-white p-5 sm:p-7" style="transition-delay:<?= $i * 60 ?>ms">
        <span class="grid place-items-center h-9 w-9 sm:h-11 sm:w-11 shrink-0 rounded-xl sm:rounded-2xl bg-sand text-brand-800">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 sm:h-5 sm:w-5"><path d="<?= $icon ?>"/></svg>
        </span>
        <div class="min-w-0">
          <h3 class="sm:mt-5 font-display text-[19px] sm:text-[21px] tracking-tight text-brand-900"><?= $h ?></h3>
          <p class="mt-2 text-[14.5px] leading-relaxed text-brand-900/60"><?= $p ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="reveal mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 rounded-2xl bg-sand/70 px-5 sm:px-6 py-5">
      <p class="text-[14.5px] leading-relaxed text-brand-900/60">
        <span class="font-medium text-brand-900">Denied before, or worried you will be?</span>
        Denials are usually a documentation problem, not a verdict. We file the appeal.
      </p>
      <a href="tel:<?= $PHONE_LINK ?>" class="group inline-flex items-center justify-center gap-2 rounded-full bg-brand-900 px-6 py-3 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition shrink-0">
        Verify my coverage
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════ SAFETY ══════════════════ -->
<section id="safety" class="py-12 sm:py-14 lg:py-20 bg-sand/60 border-y border-black/5 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-5 sm:px-6 lg:px-10">
    <div class="grid lg:grid-cols-12 gap-8 lg:gap-14">

      <div class="lg:col-span-5 reveal">
        <p class="text-[11.5px] sm:text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Safety</p>
        <h2 class="mt-4 font-display text-[1.9rem] sm:text-[2.4rem] lg:text-[2.7rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
          Why it is only given in a clinic.
        </h2>
        <p class="mt-4 text-[15.5px] sm:text-[16.5px] leading-relaxed text-brand-900/60 font-light">
          SPRAVATO&reg; can cause dissociation and raise blood pressure, so it is dispensed only
          through a REMS-certified center. We are one — trained staff, strict protocols, and a
          monitoring period that is not optional.
        </p>

        <ul class="mt-6 space-y-2.5">
          <?php
          $rems = [
            ['Direct supervision',      'A clinician is with you while you self-administer.'],
            ['Two-hour monitoring',     'After every dose, with vital signs observed.'],
            ['Transportation required', 'No driving until the next day, after a full night’s rest.'],
          ];
          foreach ($rems as [$h, $p]): ?>
          <li class="flex items-start gap-3 rounded-xl sm:rounded-2xl border border-black/[0.07] bg-white px-4 sm:px-5 py-3.5">
            <span class="mt-0.5 grid place-items-center h-5 w-5 shrink-0 rounded-full bg-brand-900/[0.07] text-brand-700">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="h-2.5 w-2.5"><path d="M5 13l4 4L19 7"/></svg>
            </span>
            <div class="min-w-0">
              <p class="text-[14.5px] font-medium text-brand-900"><?= $h ?></p>
              <p class="mt-0.5 text-[13.5px] leading-snug text-brand-900/55"><?= $p ?></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="lg:col-span-7 reveal grid sm:grid-cols-2 gap-3.5 sm:gap-5 content-start" style="transition-delay:.08s">

        <div class="rounded-2xl sm:rounded-3xl border border-black/[0.07] bg-white p-5 sm:p-7">
          <h3 class="font-display text-[20px] sm:text-[22px] tracking-tight text-brand-900">Common side effects</h3>
          <p class="mt-2 text-[14px] leading-relaxed text-brand-900/55">
            These usually begin shortly after the dose and resolve the same day — which is exactly
            what the monitoring period is for.
          </p>
          <ul class="mt-4 flex flex-wrap gap-1.5 sm:gap-2">
            <?php foreach ([
              'Dissociation','Dizziness','Fatigue','Nausea','Feeling drunk or euphoric',
              'Anxiety or numbness','Spinning sensation','Raised blood pressure','Sedation',
            ] as $se): ?>
            <li class="rounded-full bg-sand px-3 py-1.5 text-[12.5px] text-brand-900/70"><?= $se ?></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="rounded-2xl sm:rounded-3xl border border-accent-200 bg-accent-50/60 p-5 sm:p-7">
          <h3 class="font-display text-[20px] sm:text-[22px] tracking-tight text-brand-900">Who should not take it</h3>
          <p class="mt-2 text-[14px] leading-relaxed text-brand-900/55">
            Your evaluation screens for all of these before anything is prescribed.
          </p>
          <ul class="mt-4 space-y-2.5">
            <?php foreach ([
              'Aneurysms or blood vessel disease',
              'Abnormal blood vessel connections (AVM)',
              'A history of bleeding in the brain',
              'An allergy to esketamine or ketamine',
            ] as $contra): ?>
            <li class="flex items-start gap-2.5 text-[14px] leading-relaxed text-brand-900/70">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mt-1 h-3.5 w-3.5 shrink-0 text-accent-600"><path d="M5 5l14 14M19 5 5 19"/></svg>
              <?= $contra ?>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <p class="sm:col-span-2 rounded-2xl bg-brand-900 px-5 sm:px-7 py-5 text-[14px] leading-relaxed text-cream/75">
          SPRAVATO&reg; is not a pain reliever or an anesthetic, and it is never taken home. Tell your
          provider about every condition and medication you are on — that is how we judge whether it
          is safe for you specifically. This page is general information, not medical advice, and not
          a substitute for the full Prescribing Information and Medication Guide your clinician will
          review with you.
        </p>

      </div>
    </div>
  </div>
</section>

<!-- ══════════════════ REVIEWS + FAQ ══════════════════ -->
<section id="faq" class="py-12 sm:py-14 lg:py-20 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-5 sm:px-6 lg:px-10">

    <!-- reviews rail — horizontal, so it costs almost no vertical space -->
    <div class="reveal">
      <div class="flex items-end justify-between gap-6">
        <div>
          <p class="text-[11.5px] sm:text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Patient experiences</p>
          <h2 class="mt-4 font-display text-[1.9rem] sm:text-[2.4rem] leading-[1.1] tracking-tightest text-brand-900 font-light">In their words.</h2>
        </div>
        <div class="hidden sm:flex items-center gap-2.5 shrink-0">
          <button id="tPrev" aria-label="Previous reviews" aria-controls="tTrack"
                  class="grid place-items-center h-11 w-11 rounded-full border border-black/10 text-brand-900 transition hover:bg-brand-900 hover:text-cream hover:border-brand-900 disabled:opacity-30 disabled:pointer-events-none">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M19 12H6M13 5l-7 7 7 7"/></svg>
          </button>
          <button id="tNext" aria-label="More reviews" aria-controls="tTrack"
                  class="grid place-items-center h-11 w-11 rounded-full border border-black/10 text-brand-900 transition hover:bg-brand-900 hover:text-cream hover:border-brand-900 disabled:opacity-30 disabled:pointer-events-none">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
          </button>
        </div>
      </div>

      <div id="tTrack" tabindex="0" role="region" aria-label="Patient reviews from Google"
           class="slider mt-6 flex gap-3.5 sm:gap-5 overflow-x-auto snap-x snap-mandatory scroll-smooth -mx-5 px-5 sm:-mx-6 sm:px-6 lg:-mx-2 lg:px-2 pb-2 outline-none">
        <?php foreach ($reviews as [$name, $initials, $meta, $when, $tag, $body]): ?>
        <figure class="t-card snap-start shrink-0 flex flex-col w-[85%] sm:w-[calc(50%-10px)] lg:w-[calc(33.333%-14px)] rounded-2xl sm:rounded-3xl border border-black/[0.07] bg-white p-5 sm:p-7">
          <div class="flex items-start gap-3">
            <span class="grid place-items-center h-10 w-10 shrink-0 rounded-full bg-brand-900/[0.07] font-display text-[14px] text-brand-800"><?= $initials ?></span>
            <div class="min-w-0">
              <p class="text-[15px] font-medium text-brand-900 truncate"><?= $name ?></p>
              <p class="text-[12px] text-brand-900/45 mt-0.5 truncate"><?= $meta ?> · <?= $when ?></p>
            </div>
            <svg viewBox="0 0 24 24" class="ml-auto h-5 w-5 shrink-0 text-accent-400/50" fill="currentColor"><path d="M9.5 6C6.5 7.5 5 10.2 5 14v4h6v-6H8.2c.2-2 1.2-3.4 3-4.3L9.5 6Zm9 0C15.5 7.5 14 10.2 14 14v4h6v-6h-2.8c.2-2 1.2-3.4 3-4.3L18.5 6Z"/></svg>
          </div>
          <blockquote class="quote mt-4 text-[14.5px] sm:text-[15px] leading-relaxed text-brand-900/70 font-light"><?= $body ?></blockquote>
          <button type="button" class="q-more mt-2.5 self-start text-[13.5px] font-medium text-accent-600 hover:underline">Read full review</button>
          <figcaption class="mt-auto pt-5 flex items-center justify-between gap-3">
            <span class="text-[12px] text-brand-900/40">Google review</span>
            <span class="rounded-full bg-sand px-2.5 py-1 text-[11.5px] text-brand-900/60 shrink-0"><?= $tag ?></span>
          </figcaption>
        </figure>
        <?php endforeach; ?>
      </div>
      <p class="mt-3 text-[12px] leading-relaxed text-brand-900/35 max-w-3xl">
        Reviews are reproduced as published by their authors on Google and describe care at this
        practice generally, not SPRAVATO&reg; treatment specifically. Individual results vary.
      </p>
    </div>

    <!-- FAQ -->
    <div class="mt-12 sm:mt-14 grid lg:grid-cols-12 gap-8 lg:gap-14">
      <div class="lg:col-span-4 reveal">
        <p class="text-[11.5px] sm:text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Questions</p>
        <h2 class="mt-4 font-display text-[1.9rem] sm:text-[2.4rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
          Good to know before you call.
        </h2>

        <div class="mt-6 rounded-2xl border border-black/[0.07] bg-white p-5 sm:p-6">
          <p class="text-[11.5px] uppercase tracking-[0.16em] text-brand-900/40">Ask us directly</p>
          <a href="tel:<?= $PHONE_LINK ?>" class="mt-1.5 block font-display text-[24px] sm:text-[26px] tracking-tight text-brand-900 hover:text-accent-600 transition"><?= $PHONE_DISPLAY ?></a>
          <p class="mt-1 text-[13.5px] text-brand-900/45">Monday to Friday, 8am–5pm</p>
          <a href="#eligibility" class="group mt-4 inline-flex items-center gap-2 rounded-full bg-brand-900 px-5 py-3 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition">
            Check my eligibility
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>

      <div class="lg:col-span-8 reveal" style="transition-delay:.08s">
        <?php foreach ($faqs as $i => [$q, $a]): ?>
        <div class="faq border-b border-black/10 <?= $i === 0 ? 'border-t' : '' ?>">
          <button class="faq-btn w-full flex items-start justify-between gap-4 sm:gap-6 py-5 text-left group">
            <span class="text-[16px] sm:text-[17.5px] leading-snug text-brand-900 font-medium group-hover:text-accent-600 transition"><?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8') ?></span>
            <span class="faq-icon mt-0.5 grid place-items-center h-7 w-7 shrink-0 rounded-full border border-black/15 text-brand-900 transition-transform duration-300">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5"><path d="M12 5v14M5 12h14"/></svg>
            </span>
          </button>
          <div class="faq-body">
            <div>
              <p class="pb-5 pr-8 sm:pr-14 text-[14.5px] sm:text-[15.5px] leading-relaxed text-brand-900/60"><?= htmlspecialchars($a, ENT_QUOTES, 'UTF-8') ?></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════ CONTACT ══════════════════ -->
<section id="contact" class="relative overflow-hidden bg-brand-950 text-cream grain">
  <div class="pointer-events-none absolute -left-40 bottom-0 h-[26rem] w-[26rem] rounded-full bg-brand-600/40 blur-[120px]"></div>
  <div class="pointer-events-none absolute right-0 -top-24 h-[22rem] w-[22rem] rounded-full bg-accent-500/15 blur-[120px]"></div>

  <div class="relative mx-auto max-w-8xl px-5 sm:px-6 lg:px-10 py-12 sm:py-14 lg:py-16">
    <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-center">

      <div class="lg:col-span-6 reveal">
        <p class="text-[11.5px] sm:text-[12px] uppercase tracking-[0.24em] text-accent-400 font-semibold">Get started</p>
        <h2 class="mt-3 font-display text-[1.9rem] sm:text-[2.5rem] lg:text-[2.9rem] leading-[1.1] tracking-tightest font-light">
          You have waited long enough.
        </h2>
        <p class="mt-4 text-[15.5px] sm:text-[16.5px] leading-relaxed text-cream/65 font-light max-w-md">
          Prior authorization takes three days to two weeks. The sooner we start it, the sooner you
          can start treatment — and the first conversation costs you nothing.
        </p>

        <div class="mt-7 flex flex-col sm:flex-row gap-3">
          <a href="tel:<?= $PHONE_LINK ?>" class="inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-6 py-3.5 sm:px-7 sm:py-4 text-[15.5px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
            Call <?= $PHONE_DISPLAY ?>
          </a>
          <a href="#eligibility" class="group inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-6 py-3.5 sm:px-7 sm:py-4 text-[15.5px] font-medium text-cream hover:bg-white/10 transition backdrop-blur">
            Check my eligibility
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:-translate-y-0.5"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
          </a>
        </div>

        <p class="mt-6 flex items-start gap-2.5 text-[13px] sm:text-[13.5px] leading-relaxed text-cream/50">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-4 w-4 shrink-0 mt-0.5 text-accent-400"><path d="M12 8.5v4.5M12 16.5h.01"/><path d="M10.3 3.9 2.6 17.3A2 2 0 0 0 4.3 20.3h15.4a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
          <span><span class="text-cream/80 font-medium">In crisis?</span> Call 911, or call or text
            <a href="tel:988" class="font-semibold text-accent-400 hover:underline">988</a> for the 24/7 Suicide &amp; Crisis Lifeline.</span>
        </p>
      </div>

      <div class="lg:col-span-6 reveal" style="transition-delay:.1s">
        <div class="overflow-hidden rounded-2xl border border-white/12 bg-white/[0.04]">
          <iframe
            title="Map to Interventional Psychiatry of Arizona, <?= $ADDRESS_L1 ?>, <?= $ADDRESS_L2 ?>"
            src="https://www.google.com/maps?q=<?= $MAPS_QUERY ?>&output=embed"
            class="block h-52 sm:h-60 w-full grayscale-[0.3] contrast-[1.05]"
            loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
          <div class="flex flex-wrap items-center justify-between gap-3 px-5 sm:px-6 py-4">
            <p class="text-[14px] leading-snug text-cream/70">
              <span class="text-cream"><?= $ADDRESS_L1 ?></span><br><?= $ADDRESS_L2 ?>
            </p>
            <p class="text-[14px] leading-snug text-cream/45 shrink-0">Mon–Fri<br>8am–5pm</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════ FOOTER ══════════════════ -->
<footer class="bg-brand-950 border-t border-white/10 text-cream/60 pb-24 lg:pb-0">
  <div class="mx-auto max-w-8xl px-5 sm:px-6 lg:px-10 py-10 sm:py-12">
    <div class="grid sm:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-10">

      <div class="lg:col-span-5">
        <img src="<?= $LOGO_LIGHT ?>" alt="Interventional Psychiatry of Arizona — Building Strong Minds"
             width="545" height="228" loading="lazy" class="h-14 sm:h-16 w-auto">
        <p class="mt-5 text-[14px] leading-relaxed max-w-sm">
          A REMS-certified SPRAVATO&reg; treatment center in Phoenix — alongside TMS, ECT,
          medication management and psychotherapy.
        </p>
        <a href="tel:<?= $PHONE_LINK ?>" class="mt-5 inline-flex items-center gap-2.5 rounded-full bg-accent-500 px-5 py-3 text-[14.5px] font-medium text-white hover:bg-accent-600 transition">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
          Call <?= $PHONE_DISPLAY ?>
        </a>
      </div>

      <div class="lg:col-span-3">
        <p class="text-[11.5px] uppercase tracking-[0.18em] text-cream/35">On this page</p>
        <ul class="mt-4 space-y-2.5 text-[14px]">
          <li><a href="#qualify"   class="hover:text-accent-400 transition">Do I qualify?</a></li>
          <li><a href="#science"   class="hover:text-accent-400 transition">How it works</a></li>
          <li><a href="#process"   class="hover:text-accent-400 transition">Your treatment</a></li>
          <li><a href="#insurance" class="hover:text-accent-400 transition">Insurance &amp; cost</a></li>
          <li><a href="#safety"    class="hover:text-accent-400 transition">Safety</a></li>
          <li><a href="#faq"       class="hover:text-accent-400 transition">FAQ</a></li>
        </ul>
      </div>

      <div class="lg:col-span-4">
        <p class="text-[11.5px] uppercase tracking-[0.18em] text-cream/35">Visit</p>
        <ul class="mt-4 space-y-2.5 text-[14px]">
          <li><?= $ADDRESS_L1 ?><br><?= $ADDRESS_L2 ?></li>
          <li class="text-cream/40">Mon–Fri · 8am–5pm</li>
        </ul>
      </div>
    </div>

    <div class="mt-9 pt-6 border-t border-white/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-[12.5px] text-cream/40">
      <p>&copy; <?= $YEAR ?> Interventional Psychiatry of Arizona. All rights reserved.</p>
      <p><?= $ADDRESS_L2 ?> &middot; Mon–Fri 8am–5pm</p>
    </div>

    <p class="mt-6 text-[11.5px] leading-relaxed text-cream/25 max-w-4xl">
      <sup>*</sup>Savings program eligibility, benefits and plan participation are set by the program
      sponsor and your insurer and can change; restrictions apply. Coverage varies by plan and by
      treatment. Carrier names and logos are the property of their respective owners and are shown
      solely to indicate plans accepted at this practice; their use does not imply endorsement or
      affiliation. SPRAVATO&reg; and SPRAVATO withMe are trademarks of Janssen Pharmaceuticals, Inc.,
      used here only to identify the treatment offered at this practice — Interventional Psychiatry of
      Arizona is an independent REMS-certified provider, not affiliated with, endorsed by or sponsored
      by Janssen Pharmaceuticals, Inc. or Johnson &amp; Johnson. The content on this page is for
      general informational purposes only and is not a substitute for professional medical advice,
      diagnosis or treatment, nor for the full Prescribing Information, Boxed Warning and Medication
      Guide for SPRAVATO&reg;.
    </p>
  </div>
</footer>

<!-- ══════════════════ STICKY MOBILE CTA ══════════════════ -->
<div id="stickyBar" class="lg:hidden fixed inset-x-0 bottom-0 z-40 border-t border-white/10 bg-brand-950/95 px-4 pt-3 backdrop-blur-xl">
  <div class="flex items-center gap-2.5">
    <a href="tel:<?= $PHONE_LINK ?>" class="flex-1 inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-4 py-3.5 text-[14.5px] font-medium text-cream">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
      Call
    </a>
    <a href="#eligibility" class="flex-[1.5] inline-flex items-center justify-center gap-2 rounded-full bg-accent-500 px-4 py-3.5 text-[14.5px] font-medium text-white">
      Check my eligibility
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
    </a>
  </div>
</div>

<?php
/* Structured data — the FAQ block is generated from the same $faqs array the page
   renders, so the two can never drift apart. */
$schema = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type'       => 'MedicalClinic',
      'name'        => 'Interventional Psychiatry of Arizona',
      'url'         => $absolute($BASE . '/'),
      'telephone'   => $PHONE_DISPLAY,
      'image'       => $absolute($img('hero', 1200)),
      'address'     => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => $ADDRESS_L1,
        'addressLocality' => 'Phoenix',
        'addressRegion'   => 'AZ',
        'postalCode'      => '85016',
        'addressCountry'  => 'US',
      ],
      'medicalSpecialty' => 'Psychiatric',
      'availableService' => [
        '@type'       => 'MedicalTherapy',
        'name'        => 'SPRAVATO® (esketamine) nasal spray',
        'description' => 'REMS-certified esketamine nasal spray treatment, used alongside an oral antidepressant, for adults with treatment-resistant depression and for depressive symptoms with suicidal thoughts or actions.',
      ],
    ],
    [
      '@type'      => 'FAQPage',
      'mainEntity' => array_map(fn($f) => [
        '@type'          => 'Question',
        'name'           => $f[0],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
      ], $faqs),
    ],
  ],
];
?>
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>

<script>
/* ---------- mobile menu ---------- */
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const nav = document.getElementById('nav');

/* ---------- header state ----------
   Transparent over the hero, solid cream once scrolled past it — and always
   solid while the mobile drawer is open, so the links stay readable. */
const setNavState = () => {
  const solid = window.scrollY > 12 || !mobileMenu.classList.contains('hidden');
  nav.dataset.state = solid ? 'solid' : 'top';
  nav.classList.toggle('shadow-[0_1px_24px_rgba(10,28,27,0.08)]', solid);
};
setNavState();
window.addEventListener('scroll', setNavState, { passive: true });

menuBtn.addEventListener('click', () => {
  const open = mobileMenu.classList.toggle('hidden') === false;
  menuBtn.setAttribute('aria-expanded', String(open));
  setNavState();
});
mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
  mobileMenu.classList.add('hidden');
  menuBtn.setAttribute('aria-expanded', 'false');
  setNavState();
}));

/* ---------- sticky mobile CTA ----------
   Hidden while the hero form is on screen — two competing calls to action in
   the same viewport just split attention. */
(() => {
  const bar  = document.getElementById('stickyBar');
  const form = document.getElementById('eligibility');
  if (!bar || !form) return;
  new IntersectionObserver(
    ([e]) => bar.classList.toggle('show', !e.isIntersecting),
    { threshold: 0 }
  ).observe(form);
})();

/* ---------- scroll reveal ---------- */
const io = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
}, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });
document.querySelectorAll('.reveal').forEach(el => io.observe(el));

/* ---------- FAQ accordion ---------- */
document.querySelectorAll('.faq-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const item = btn.closest('.faq');
    const wasOpen = item.classList.contains('open');
    document.querySelectorAll('.faq').forEach(f => f.classList.remove('open'));
    if (!wasOpen) item.classList.add('open');
  });
});

/* ---------- testimonial rail ---------- */
(() => {
  const track = document.getElementById('tTrack');
  if (!track) return;
  const prev = document.getElementById('tPrev');
  const next = document.getElementById('tNext');
  const step = () => (track.querySelector('.t-card')?.offsetWidth || 320) + 20;

  const sync = () => {
    if (!prev || !next) return;
    const max = track.scrollWidth - track.clientWidth;
    prev.disabled = track.scrollLeft < 4;
    next.disabled = track.scrollLeft > max - 4;
  };

  prev?.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }));
  next?.addEventListener('click', () => track.scrollBy({ left:  step(), behavior: 'smooth' }));
  track.addEventListener('scroll', sync, { passive: true });
  window.addEventListener('resize', sync);
  sync();

  /* Only offer "Read full review" on the reviews that are actually clipped. */
  track.querySelectorAll('.t-card').forEach(card => {
    const quote = card.querySelector('.quote');
    const more  = card.querySelector('.q-more');
    if (quote.scrollHeight > quote.clientHeight + 2) card.classList.add('q-clamped');
    more.addEventListener('click', () => {
      card.classList.toggle('q-open');
      more.textContent = card.classList.contains('q-open') ? 'Show less' : 'Read full review';
      sync();
    });
  });
})();

/* ---------- photo fallback ----------
   If a photo fails to load, drop it so the brand colour underneath shows through
   rather than leaving a broken-image frame in the layout. */
document.querySelectorAll('.js-photo').forEach(im => {
  im.addEventListener('error', () => im.remove(), { once: true });
});

/* ---------- eligibility form ----------
   Posts to Formester over fetch so the visitor stays on the page. If that call
   can't be confirmed — CORS, offline, an endpoint change — the form falls back
   to a normal browser POST, which always reaches Formester. */
(() => {
  const form = document.getElementById('contactForm');
  if (!form) return;
  const note = document.getElementById('formNote');
  const btn  = form.querySelector('button[type="submit"]');
  const btnLabel = btn.innerHTML;

  const say = (text, ok) => {
    note.textContent = text;
    note.classList.remove('hidden');
    note.classList.toggle('border-accent-400/30', ok);
    note.classList.toggle('bg-accent-500/15', ok);
    note.classList.toggle('border-red-400/40', !ok);
    note.classList.toggle('bg-red-500/15', !ok);
  };

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    /* Bots fill the hidden field; drop those without telling them why. */
    if (form.elements.company && form.elements.company.value) return;

    btn.disabled = true;
    btn.classList.add('opacity-70');
    btn.textContent = 'Sending…';

    try {
      const res = await fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { Accept: 'application/json' },
      });
      if (!res.ok) throw new Error('HTTP ' + res.status);

      form.reset();
      say('Thank you — we have your request. A member of our team will review your eligibility and reach out within one business day.', true);
      btn.innerHTML = btnLabel;
      btn.disabled = false;
      btn.classList.remove('opacity-70');
    } catch (err) {
      /* Couldn't confirm it landed — hand the submission to the browser, which
         posts it for real even when fetch is blocked. */
      form.submit();
    }
  });
})();
</script>
</body>
</html>
