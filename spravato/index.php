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
$FORM_ENDPOINT  = 'https://app.formester.com/forms/RHUbxZYz6/submissions';

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
$LOGO_LIGHT   = $asset('interpsychaz-logo.webp');       // white — dark backgrounds
$LOGO_DARK    = $asset('interpsychaz-logo-dark.webp');  // indigo — light backgrounds
$SPRAVATO_MARK = $asset('spravato-logo.webp');          // SPRAVATO® brand lockup

$IMG = [
  'hero'    => ['file'=>'ambience/hero-bg-inter.webp',      'id'=>'photo-1524758631624-e2822e304c36', 'alt'=>'Illustration of neurons firing across a synapse'],
  'science' => ['file'=>'spravato-esketamine.jpg',          'id'=>'photo-1631549916768-4119b2e5f926', 'alt'=>'SPRAVATO esketamine nasal spray device'],
  'session' => ['file'=>'spravato-treatment-session.webp',  'id'=>'photo-1512678080530-7760d81faba6', 'alt'=>'A patient resting in a recliner during a monitored SPRAVATO session'],
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
   logo file still renders, as a clean wordmark tile, so the wall stays complete. */
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
  ['How often will I need to come in?',
   'Sessions are typically twice a week for the first four weeks. After that the frequency is gradually reduced into a maintenance schedule, based on how you are responding.'],
  ['Do I keep taking my current antidepressant?',
   'Yes. SPRAVATO® is approved for use alongside an oral antidepressant, and insurers generally require you to stay on one during treatment. We coordinate both sides of the plan in the same practice.'],
  ['What are the common side effects?',
   'Dissociation, dizziness, fatigue, nausea or vomiting, a feeling of being drunk or euphoric, anxiety or numbness, and a spinning sensation. They usually begin shortly after the dose and resolve the same day, which is what the monitoring period is for.'],
  ['Who should not take SPRAVATO®?',
   'It is not recommended for people with aneurysms or blood vessel disease, abnormal blood vessel connections (arteriovenous malformation), a history of bleeding in the brain, or a known allergic reaction to esketamine or ketamine. Your evaluation screens for all of these.'],
  ['How is it different from ECT?',
   'Both treat depression that has not responded to medication, but ECT requires anesthesia and induces a seizure, while SPRAVATO® is a nasal spray given without sedation. SPRAVATO® also does not carry the cognitive side effects, such as memory loss, sometimes associated with ECT.'],
  ['How long does approval take, and what if I am denied?',
   'Prior authorization usually takes three days to two weeks. Denials do happen, most often because of missing documentation — if that happens, our team files the appeal on your behalf with the additional clinical evidence.'],
  ['Do I need a referral to be seen?',
   'No referral is needed to schedule with us. If you already have a therapist or primary care provider, we are glad to coordinate so everyone stays aligned.'],
];

/* Verbatim Google reviews. Dates are the month each was posted, so they don't
   drift the way "2 months ago" would. */
$reviews = [
  ['John Jakob', 'JJ', '4 reviews', 'July 2026', 'Jessica Cruz, NP',
   'My initial. appointment was with Nurse Practitioner Jessica Cruz. It was very worthwhile. NP Cruz is very welcoming yet very nonjudgemental and professional. She welcomes questions and thoroughly answers them. Her professional knowledge is very thorough. I was in the pharmaceutical industry for over 25 years and have dealt with many medical professionals in almost all specialties. NP Cruz impressed me as a top notch practitioner. At the end of that initial session I realized that my situation would be much improved with a bit of time and patience.'],
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
  ['Colton Moore', 'CM', 'Local Guide · 15 reviews', 'October 2025', 'Dr. Gomez',
   'Dr Gomez and his staff are amazing. Everyone is kind, professional, and makes you feel comfortable right away. Dr Gomez really listens, explains things clearly, and you can tell he truly cares about his patients. Overall a great experience and I’m grateful to have found him.'],
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
  #nav[data-state="top"] .nav-phone{ color:#FBF9F6; }
  #nav[data-state="top"] .nav-phone:hover{ color:#F5975F; }
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
  .reveal { opacity:0; transform:translateY(22px); transition:opacity .8s cubic-bezier(.2,.7,.2,1), transform .8s cubic-bezier(.2,.7,.2,1); }
  .reveal.in { opacity:1; transform:none; }

  /* ── Glass eligibility card ──────────────────────────────────────────────
     Frosted panel over the hero artwork: a light gradient sheet for the glass
     itself, a tinted base so type stays legible, and an inset top highlight. */
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

  .glass-field{
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.16);
    color: #FBF9F6;
    transition: background-color .2s, border-color .2s, box-shadow .2s;
  }
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

  /* Testimonial slider */
  .slider{ scrollbar-width:none; -ms-overflow-style:none; }
  .slider::-webkit-scrollbar{ display:none; }
  .quote{ display:-webkit-box; -webkit-box-orient:vertical; -webkit-line-clamp:9; overflow:hidden; }
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
     eligibility check — stay one thumb away once the hero form scrolls off. */
  #stickyBar{ transform:translateY(120%); transition:transform .35s cubic-bezier(.2,.7,.2,1); }
  #stickyBar.show{ transform:none; }

  @media (prefers-reduced-motion: reduce){
    .reveal{opacity:1;transform:none;transition:none}
    .animate-ping{animation:none}
    #stickyBar{transition:none}
  }
</style>
</head>

<body class="bg-cream text-ink font-sans antialiased selection:bg-accent-200 selection:text-brand-900">

<!-- ══════════════════ TOP BAR ══════════════════ -->
<div class="hidden md:block bg-brand-950 text-brand-200/80 text-[13px]">
  <div class="mx-auto max-w-8xl px-6 lg:px-10 h-10 flex items-center justify-between">
    <p class="text-white/60">REMS-certified SPRAVATO&reg; treatment center &middot; Now accepting new patients in Phoenix</p>
    <div class="flex items-center gap-6 text-white/60">
      <span><?= $ADDRESS_L2 ?></span>
      <span class="h-3 w-px bg-white/20"></span>
      <span>Mon–Fri · 8am–5pm</span>
      <span class="h-3 w-px bg-white/20"></span>
      <a href="tel:<?= $PHONE_LINK ?>" class="font-medium text-white/85 hover:text-white transition"><?= $PHONE_DISPLAY ?></a>
    </div>
  </div>
</div>

<!-- ══════════════════ NAV ══════════════════ -->
<header id="nav" data-state="top" class="sticky top-0 z-50 transition-all duration-300 bg-cream/80 backdrop-blur-xl border-b border-black/5">
  <nav class="mx-auto max-w-8xl px-6 lg:px-10">
    <div class="h-[72px] flex items-center justify-between gap-8">

      <a href="#top" class="relative block shrink-0 h-11 sm:h-[52px] aspect-[545/228]" aria-label="Interventional Psychiatry of Arizona — home">
        <img src="<?= $LOGO_DARK ?>" alt="Interventional Psychiatry of Arizona — Building Strong Minds"
             width="545" height="228" class="nav-logo nav-logo-dark absolute inset-0 h-full w-auto">
        <img src="<?= $LOGO_LIGHT ?>" alt="" aria-hidden="true"
             width="545" height="228" class="nav-logo nav-logo-light absolute inset-0 h-full w-auto">
      </a>

      <div class="hidden lg:flex items-center gap-0.5 xl:gap-1 whitespace-nowrap text-[15px] text-brand-900/75">
        <a href="#qualify"   class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Do I qualify?</a>
        <a href="#science"   class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">How it works</a>
        <a href="#process"   class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Your treatment</a>
        <a href="#insurance" class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Insurance &amp; cost</a>
        <a href="#safety"    class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Safety</a>
        <a href="#faq"       class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">FAQ</a>
      </div>

      <div class="flex items-center gap-3">
        <a href="tel:<?= $PHONE_LINK ?>" class="nav-phone hidden xl:flex items-center gap-2 whitespace-nowrap text-[15px] font-medium text-brand-900 hover:text-accent-600 transition">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
          <?= $PHONE_DISPLAY ?>
        </a>
        <a href="#eligibility" class="nav-cta inline-flex items-center gap-2 whitespace-nowrap rounded-full bg-brand-900 px-5 py-2.5 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition shadow-sm hover:shadow-md">
          Check my eligibility
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
        </a>
        <button id="menuBtn" aria-label="Open menu" class="nav-burger lg:hidden grid place-items-center h-10 w-10 rounded-lg border border-black/10 text-brand-900">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
      </div>
    </div>

    <!-- mobile drawer -->
    <div id="mobileMenu" class="lg:hidden hidden pb-5">
      <div class="nav-drawer grid gap-1 text-[16px] text-brand-900/80 border-t border-black/5 pt-4">
        <a href="#qualify"   class="nav-link px-3 py-2.5 rounded-lg hover:bg-sand">Do I qualify?</a>
        <a href="#science"   class="nav-link px-3 py-2.5 rounded-lg hover:bg-sand">How it works</a>
        <a href="#process"   class="nav-link px-3 py-2.5 rounded-lg hover:bg-sand">Your treatment</a>
        <a href="#insurance" class="nav-link px-3 py-2.5 rounded-lg hover:bg-sand">Insurance &amp; cost</a>
        <a href="#safety"    class="nav-link px-3 py-2.5 rounded-lg hover:bg-sand">Safety</a>
        <a href="#faq"       class="nav-link px-3 py-2.5 rounded-lg hover:bg-sand">FAQ</a>
        <a href="tel:<?= $PHONE_LINK ?>" class="nav-phone px-3 py-2.5 rounded-lg font-medium text-accent-600"><?= $PHONE_DISPLAY ?></a>
      </div>
    </div>
  </nav>
</header>

<!-- ══════════════════ HERO ══════════════════ -->
<section id="top" class="relative overflow-hidden bg-brand-950 -mt-[72px] pt-[72px]">
  <img src="<?= $img('hero', 2000) ?>" alt="<?= $alt('hero') ?>" fetchpriority="high" decoding="async"
       class="js-photo pointer-events-none absolute inset-0 h-full w-full object-cover">
  <!-- flat, even tint — just enough to hold the type against the image -->
  <div class="pointer-events-none absolute inset-0 bg-brand-950/50"></div>

  <div class="relative mx-auto max-w-8xl px-6 lg:px-10 pt-10 pb-16 lg:pt-12 lg:pb-20">
    <div class="grid lg:grid-cols-12 gap-10 lg:gap-10 items-center">

      <div class="lg:col-span-6 reveal">
        <div class="inline-flex items-center gap-2.5 rounded-full border border-white/15 bg-white/5 px-4 py-1.5 text-[13px] text-cream/80 backdrop-blur">
          <span class="relative flex h-2 w-2">
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-accent-400 opacity-75"></span>
            <span class="relative inline-flex h-2 w-2 rounded-full bg-accent-400"></span>
          </span>
          REMS-certified SPRAVATO&reg; center · Phoenix, Arizona
        </div>

        <h1 class="mt-7 font-display text-[2.45rem] leading-[1.06] sm:text-[3.2rem] lg:text-[3.35rem] xl:text-[3.7rem] tracking-tightest text-cream font-light">
          Two antidepressants<br class="hidden sm:block"> haven't worked.
          <span class="italic text-accent-400"><?= $SPR ?> works differently.</span>
        </h1>

        <p class="mt-6 max-w-lg text-[16.5px] lg:text-[17.5px] leading-relaxed text-cream/70 font-light">
          SPRAVATO&reg; (esketamine) is the first prescription nasal spray used alongside an oral
          antidepressant to treat severe, treatment-resistant depression. It targets the brain's
          glutamate system rather than serotonin — and many patients feel a shift within 24 hours,
          not weeks.
        </p>

        <div class="mt-9 flex flex-col sm:flex-row gap-3.5">
          <a href="#eligibility" class="group inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-7 py-4 text-[15.5px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
            Check if I qualify
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
          </a>
          <a href="tel:<?= $PHONE_LINK ?>" class="inline-flex items-center justify-center gap-2.5 rounded-full border border-white/20 bg-white/5 px-7 py-4 text-[15.5px] font-medium text-cream hover:bg-white/10 transition backdrop-blur">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
            Call <?= $PHONE_DISPLAY ?>
          </a>
        </div>

        <dl class="mt-9 grid grid-cols-3 gap-6 max-w-lg border-t border-white/10 pt-7">
          <div>
            <dt class="font-display text-3xl text-cream font-light">24 hrs</dt>
            <dd class="mt-1.5 text-[13px] leading-snug text-cream/50">Symptom relief can begin this fast</dd>
          </div>
          <div>
            <dt class="font-display text-3xl text-cream font-light">$10</dt>
            <dd class="mt-1.5 text-[13px] leading-snug text-cream/50">Per treatment for eligible commercial plans<sup class="text-accent-400">*</sup></dd>
          </div>
          <div>
            <dt class="font-display text-3xl text-cream font-light">Most</dt>
            <dd class="mt-1.5 text-[13px] leading-snug text-cream/50">Insurance plans accepted &amp; verified for you</dd>
          </div>
        </dl>
      </div>

      <!-- eligibility form -->
      <div id="eligibility" class="lg:col-span-6 reveal scroll-mt-28" style="transition-delay:.15s">
        <div class="relative">
          <div class="pointer-events-none absolute -inset-4 rounded-[36px] bg-gradient-to-br from-accent-400/20 via-transparent to-brand-500/20 blur-2xl"></div>

          <form id="contactForm" action="<?= $FORM_ENDPOINT ?>" method="POST" accept-charset="UTF-8"
                class="glass relative rounded-[28px] p-7 sm:p-8">

            <div class="flex items-start justify-between gap-4">
              <div>
                <h2 class="font-display text-[27px] leading-tight tracking-tight text-cream">Check your SPRAVATO&reg; eligibility</h2>
                <p class="mt-2 text-[14.5px] leading-relaxed text-cream/60">
                  Two questions and your contact details. We verify your benefits and call you back
                  within one business day.
                </p>
              </div>
              <span class="hidden sm:grid place-items-center h-11 w-11 shrink-0 rounded-2xl bg-white/10 ring-1 ring-white/15 text-accent-400">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-5 w-5"><path d="M12 3l7.5 3v5.5c0 4.4-3.1 8.2-7.5 9.5-4.4-1.3-7.5-5.1-7.5-9.5V6L12 3Z"/><path d="M9.5 12l1.8 1.8L15 10"/></svg>
              </span>
            </div>

            <div class="mt-6 grid sm:grid-cols-2 gap-3.5">
              <div class="sm:col-span-2">
                <label for="tried" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">How many antidepressants have you tried without enough relief?</label>
                <select id="tried" name="Antidepressants tried" class="glass-field w-full appearance-none rounded-xl px-4 py-3 text-[15px] outline-none"
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
                <select id="carrier" name="Insurance" class="glass-field w-full appearance-none rounded-xl px-4 py-3 text-[15px] outline-none"
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
                <input id="fname" name="First name" required class="glass-field w-full rounded-xl px-4 py-3 text-[15px] outline-none" placeholder="Jane">
              </div>
              <div>
                <label for="lname" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Last name</label>
                <input id="lname" name="Last name" required class="glass-field w-full rounded-xl px-4 py-3 text-[15px] outline-none" placeholder="Doe">
              </div>
              <div>
                <label for="phone" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Phone</label>
                <input id="phone" name="Phone" type="tel" required class="glass-field w-full rounded-xl px-4 py-3 text-[15px] outline-none" placeholder="(602) 000-0000">
              </div>
              <div>
                <label for="email" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Email</label>
                <input id="email" name="Email" type="email" required class="glass-field w-full rounded-xl px-4 py-3 text-[15px] outline-none" placeholder="you@email.com">
              </div>
              <div class="sm:col-span-2">
                <label for="msg" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Anything you'd like us to know <span class="font-normal text-cream/35">(optional)</span></label>
                <textarea id="msg" name="Message" rows="2" class="glass-field w-full rounded-xl px-4 py-3 text-[15px] outline-none resize-none" placeholder="Briefly — what you've tried, and what you're hoping to change."></textarea>
              </div>
            </div>

            <!-- Spam trap: real people never see this, bots fill it in. -->
            <div class="hidden" aria-hidden="true">
              <label>Do not fill this in <input type="text" name="company" tabindex="-1" autocomplete="off"></label>
            </div>
            <input type="hidden" name="Source" value="Spravato landing page">
            <input type="hidden" name="Interested in" value="Spravato (nasal esketamine)">

            <button type="submit" class="group mt-6 w-full inline-flex items-center justify-center gap-2.5 rounded-full bg-cream px-8 py-4 text-[15.5px] font-medium text-brand-900 hover:bg-white transition shadow-lg shadow-black/25">
              Check my eligibility
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
            </button>

            <p id="formNote" class="hidden mt-4 rounded-xl border border-accent-400/30 bg-accent-500/15 px-4 py-3 text-[14px] text-cream/85"></p>

            <div class="mt-5 flex items-start gap-2.5 text-[12px] leading-relaxed text-cream/55">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-4 w-4 shrink-0 mt-px"><rect x="4.5" y="10" width="15" height="10" rx="2"/><path d="M8 10V7.5a4 4 0 0 1 8 0V10"/></svg>
              <p>Please don't include sensitive medical details. This form is not for emergencies — in a crisis, call <a href="tel:988" class="font-semibold text-accent-400 hover:underline">988</a> or 911.</p>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════ TRUST STRIP ══════════════════ -->
<section class="border-b border-black/5 bg-cream">
  <div class="mx-auto max-w-8xl px-6 lg:px-10 py-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-7">
      <?php
      $trust = [
        ['REMS-certified center',  'Trained staff, protocol-driven monitoring'],
        ['FDA-approved treatment', 'For TRD and MDD with suicidal ideation'],
        ['Insurance handled',      'We file the prior authorization for you'],
        ['Board-certified team',   '15+ years of psychiatric practice'],
      ];
      foreach ($trust as [$t, $s]): ?>
      <div class="reveal flex items-start gap-3">
        <span class="mt-1 grid place-items-center h-5 w-5 rounded-full bg-brand-900/8 text-brand-700 shrink-0">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="h-3 w-3"><path d="M5 13l4 4L19 7"/></svg>
        </span>
        <div>
          <p class="text-[14.5px] font-semibold text-brand-900"><?= $t ?></p>
          <p class="text-[13.5px] text-brand-900/55 mt-0.5 leading-snug"><?= $s ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════════════ DO I QUALIFY ══════════════════ -->
<section id="qualify" class="py-16 lg:py-24 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">

    <div class="max-w-3xl reveal">
      <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Do I qualify?</p>
      <h2 class="mt-5 font-display text-4xl lg:text-[3.2rem] leading-[1.08] tracking-tightest text-brand-900 font-light">
        <?= $SPR ?> is for a<br class="hidden sm:block"> specific kind of depression.
      </h2>
      <p class="mt-6 text-[17px] leading-relaxed text-brand-900/60 font-light">
        It is approved for two groups of adults with major depressive disorder — and about
        30% of people diagnosed with depression fall into treatment-resistant territory.
        If one of these sounds like you, the next step is a conversation.
      </p>
    </div>

    <div class="mt-14 grid md:grid-cols-3 gap-5 lg:gap-6">
      <?php
      $criteria = [
        ['Treatment-resistant depression',
         'You are an adult with major depressive disorder that has not responded to standard antidepressant treatment.',
         'Most common reason patients come to us'],
        ['Two or more antidepressants tried',
         'You have not responded adequately to at least two different antidepressants during your current depressive episode — usually at an adequate dose, for at least six weeks each.',
         'This is the criterion insurers check'],
        ['Depression with suicidal thoughts',
         'You are an adult experiencing depressive symptoms alongside suicidal thoughts or actions, where waiting weeks for a medication to work is not an option.',
         'Rapid relief is the reason it is approved here'],
      ];
      foreach ($criteria as $i => [$h, $p, $note]): ?>
      <article class="reveal relative flex flex-col rounded-3xl border border-black/[0.07] bg-white p-8 transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-brand-900/[0.07] hover:border-brand-900/15"
               style="transition-delay:<?= $i * 70 ?>ms">
        <span class="grid place-items-center h-11 w-11 rounded-2xl bg-accent-50 text-accent-600 ring-1 ring-accent-200">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" class="h-5 w-5"><path d="M5 13l4 4L19 7"/></svg>
        </span>
        <h3 class="mt-6 font-display text-[24px] leading-snug tracking-tight text-brand-900"><?= $h ?></h3>
        <p class="mt-3 text-[15px] leading-relaxed text-brand-900/60"><?= $p ?></p>
        <p class="mt-auto pt-6 text-[12.5px] uppercase tracking-[0.14em] text-brand-900/35"><?= $note ?></p>
      </article>
      <?php endforeach; ?>
    </div>

    <div class="reveal mt-8 flex flex-col sm:flex-row items-center justify-between gap-5 rounded-2xl border border-black/[0.07] bg-white px-7 py-6">
      <p class="text-[16px] leading-relaxed text-brand-900/65 text-center sm:text-left">
        <span class="text-brand-900 font-medium">Not sure whether you meet the criteria?</span>
        That is exactly what the first call is for — and it is free.
      </p>
      <div class="flex flex-wrap items-center justify-center gap-3 shrink-0">
        <a href="#eligibility" class="group inline-flex items-center gap-2 rounded-full bg-brand-900 px-6 py-3 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition">
          Check my eligibility
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
        </a>
        <a href="tel:<?= $PHONE_LINK ?>" class="inline-flex items-center gap-2 rounded-full border border-black/10 px-6 py-3 text-[14.5px] font-medium text-brand-900 hover:bg-sand transition">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
          <?= $PHONE_DISPLAY ?>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════ THE SCIENCE ══════════════════ -->
<section id="science" class="py-16 lg:py-24 bg-white border-y border-black/5 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">
    <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center">

      <div class="reveal lg:col-span-5">
        <figure class="relative overflow-hidden rounded-[28px] shadow-xl shadow-brand-900/10 ring-1 ring-black/5">
          <img src="<?= $img('science', 1100) ?>" alt="<?= $alt('science') ?>" loading="lazy" decoding="async"
               class="js-photo aspect-[4/3] w-full object-cover">
        </figure>

        <div class="mt-6 flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-black/[0.07] bg-cream px-6 py-5">
          <img src="<?= $SPRAVATO_MARK ?>" alt="SPRAVATO (esketamine) CIII nasal spray"
               width="268" height="90" loading="lazy" class="js-photo h-9 w-auto">
          <p class="text-[13.5px] leading-snug text-brand-900/55 max-w-[15rem]">
            Dispensed only through REMS-certified centers. We are one.
          </p>
        </div>
      </div>

      <div class="lg:col-span-7">
        <div class="reveal">
          <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">How it works</p>
          <h2 class="mt-5 font-display text-4xl lg:text-[3rem] leading-[1.08] tracking-tightest text-brand-900 font-light">
            A different target<br class="hidden sm:block"> in the brain.
          </h2>
          <p class="mt-6 text-[16.5px] leading-relaxed text-brand-900/60 font-light max-w-xl">
            Standard antidepressants work on serotonin and norepinephrine, and often take weeks
            to build an effect. SPRAVATO&reg; (esketamine) acts on the brain's glutamate system
            instead — which is why it moves so much faster.
          </p>
        </div>

        <div class="mt-11 grid sm:grid-cols-2 gap-x-12 gap-y-10">
          <?php
          $mechanism = [
            ['It blocks NMDA receptors',
             'NMDA receptors are the doorways on neurons that control the flow of glutamate. When they are overactive, the brain’s communication system falls out of balance — and mood and suicidal thinking suffer. Esketamine blocks them, restoring that balance.'],
            ['It rebuilds connections',
             'Chronic stress and depression damage the connections between neurons. Esketamine promotes neuroplasticity — the brain’s ability to form new neural pathways — so improvement can hold rather than fade.'],
            ['It works in hours, not months',
             'Because it is not waiting on serotonin to accumulate, many patients report a reduction in symptoms within 24 hours to a few days of the first treatment rather than the six to twelve weeks an oral trial takes.'],
            ['It is used alongside your antidepressant',
             'SPRAVATO® is prescribed with an oral antidepressant, not instead of one. It is not a pain reliever or an anesthetic, and it is only given under medical supervision.'],
          ];
          foreach ($mechanism as $i => [$h, $p]): ?>
          <div class="reveal" style="transition-delay:<?= $i * 70 ?>ms">
            <div class="h-px w-10 bg-accent-500"></div>
            <h3 class="mt-5 font-display text-[22px] tracking-tight text-brand-900"><?= $h ?></h3>
            <p class="mt-3 text-[15px] leading-relaxed text-brand-900/60"><?= $p ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════ COMPARISON ══════════════════ -->
<section class="relative overflow-hidden bg-brand-900 text-cream grain">
  <div class="pointer-events-none absolute -right-40 -top-20 h-[30rem] w-[30rem] rounded-full bg-brand-600/45 blur-[110px]"></div>
  <div class="relative mx-auto max-w-8xl px-6 lg:px-10 py-16 lg:py-24">

    <div class="max-w-3xl reveal">
      <p class="text-[12px] uppercase tracking-[0.24em] text-accent-400 font-semibold">How it compares</p>
      <h2 class="mt-5 font-display text-4xl lg:text-[3rem] leading-[1.08] tracking-tightest font-light">
        Faster than pills.<br class="hidden sm:block"> Gentler than ECT.
      </h2>
      <p class="mt-6 text-[16.5px] leading-relaxed text-cream/65 font-light">
        All three of these treat depression that hasn't responded to standard care. They differ
        in how fast they work, what a session costs you in time, and what you feel afterward.
      </p>
    </div>

    <div class="reveal mt-12 overflow-x-auto -mx-6 px-6 lg:mx-0 lg:px-0">
      <table class="w-full min-w-[46rem] border-separate border-spacing-0 text-left">
        <caption class="sr-only">SPRAVATO® compared with oral antidepressants and electroconvulsive therapy</caption>
        <thead>
          <tr>
            <th scope="col" class="w-[22%] pb-5 pr-6 text-[12px] uppercase tracking-[0.16em] font-semibold text-cream/40">&nbsp;</th>
            <th scope="col" class="w-[26%] rounded-t-2xl bg-accent-500/15 px-6 pt-6 pb-5 align-bottom">
              <span class="block font-display text-[22px] tracking-tight text-cream"><?= $SPR ?></span>
              <span class="mt-1 block text-[12.5px] text-accent-400">Esketamine nasal spray</span>
            </th>
            <th scope="col" class="w-[26%] px-6 pb-5 align-bottom">
              <span class="block font-display text-[22px] tracking-tight text-cream/80">Oral antidepressants</span>
              <span class="mt-1 block text-[12.5px] text-cream/40">SSRIs, SNRIs and others</span>
            </th>
            <th scope="col" class="w-[26%] px-6 pb-5 align-bottom">
              <span class="block font-display text-[22px] tracking-tight text-cream/80">ECT</span>
              <span class="mt-1 block text-[12.5px] text-cream/40">Electroconvulsive therapy</span>
            </th>
          </tr>
        </thead>
        <tbody class="align-top">
          <?php
          $rows = [
            ['Time to relief',      'Hours to days',                      'Typically 6–12 weeks per trial',   'Over a course of sessions'],
            ['How it is given',     'A nasal spray you self-administer',  'A pill you take daily at home',    'Anesthesia and an induced seizure'],
            ['Sedation',            'None — you stay awake',              'None',                             'General anesthesia every session'],
            ['What it targets',     'Glutamate and NMDA receptors',       'Serotonin and norepinephrine',     'Whole-brain seizure activity'],
            ['Memory effects',      'Not typical',                        'Not typical',                      'Memory loss is a known risk'],
            ['Time at the clinic',  '~2 hours of monitoring per session', 'None — taken at home',             'A half day, plus recovery time'],
            ['Driving afterward',   'Not until the next day',             'Unrestricted',                     'Not the same day'],
          ];
          foreach ($rows as $i => [$label, $a, $b, $c]):
            $last = $i === count($rows) - 1;
          ?>
          <tr>
            <th scope="row" class="border-t border-white/10 py-5 pr-6 text-[14.5px] font-medium text-cream/55"><?= $label ?></th>
            <td class="border-t border-white/10 bg-accent-500/15 px-6 py-5 text-[15px] text-cream <?= $last ? 'rounded-b-2xl' : '' ?>">
              <span class="flex items-start gap-2.5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" class="mt-1 h-3.5 w-3.5 shrink-0 text-accent-400"><path d="M5 13l4 4L19 7"/></svg>
                <?= $a ?>
              </span>
            </td>
            <td class="border-t border-white/10 px-6 py-5 text-[15px] text-cream/60"><?= $b ?></td>
            <td class="border-t border-white/10 px-6 py-5 text-[15px] text-cream/60"><?= $c ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="reveal mt-10 flex flex-col sm:flex-row items-center gap-4">
      <a href="#eligibility" class="group inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-7 py-3.5 text-[15px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
        See if SPRAVATO&reg; is right for me
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
      </a>
      <p class="text-[14px] leading-relaxed text-cream/45 max-w-lg">
        We also offer TMS, ECT and medication management in the same practice — so if SPRAVATO&reg;
        isn't the right fit, you don't start over somewhere else.
      </p>
    </div>
  </div>
</section>

<!-- ══════════════════ PROCESS ══════════════════ -->
<section id="process" class="py-16 lg:py-24 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">

    <div class="max-w-2xl reveal">
      <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Your treatment</p>
      <h2 class="mt-5 font-display text-4xl lg:text-[3.1rem] leading-[1.08] tracking-tightest text-brand-900 font-light">
        From first call to first dose.
      </h2>
      <p class="mt-6 text-[16.5px] leading-relaxed text-brand-900/60 font-light">
        No guesswork about what happens next, or who is handling which part.
      </p>
    </div>

    <div class="relative mt-16">
      <div class="hidden lg:block absolute top-7 left-0 right-0 h-px bg-gradient-to-r from-transparent via-black/10 to-transparent"></div>
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">
        <?php
        $steps = [
          ['Consultation &amp; evaluation',
           'A full psychiatric evaluation — history, every medication you have tried, medical factors and a baseline depression score. This is also where we screen for the conditions that rule SPRAVATO® out.'],
          ['Insurance &amp; authorization',
           'We file the prior authorization and talk to your insurer directly. Approval typically takes three days to two weeks; if it is denied, we file the appeal with additional clinical evidence.'],
          ['Induction — weeks 1 to 4',
           'Two sessions per week for the first month, alongside your oral antidepressant. Many patients notice a change in the first days rather than the first month.'],
          ['Maintenance &amp; follow-up',
           'Once you are responding, sessions taper to a maintenance schedule set by how you are actually doing — tracked at every visit, not reassessed months later.'],
        ];
        foreach ($steps as $i => [$h, $p]): ?>
        <div class="reveal relative" style="transition-delay:<?= $i * 90 ?>ms">
          <span class="relative z-10 grid place-items-center h-14 w-14 rounded-2xl bg-brand-900 text-cream font-display text-xl font-light shadow-lg shadow-brand-900/15">
            <?= $i + 1 ?>
          </span>
          <h3 class="mt-6 font-display text-[23px] leading-snug tracking-tight text-brand-900"><?= $h ?></h3>
          <p class="mt-3 text-[15px] leading-relaxed text-brand-900/60"><?= $p ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- what one session looks like -->
    <div class="reveal mt-16 grid lg:grid-cols-12 gap-10 lg:gap-14 items-center rounded-[28px] border border-black/[0.07] bg-white p-7 sm:p-10">
      <div class="lg:col-span-5">
        <figure class="overflow-hidden rounded-2xl ring-1 ring-black/5">
          <img src="<?= $img('session', 1000) ?>" alt="<?= $alt('session') ?>" loading="lazy" decoding="async"
               class="js-photo aspect-[4/3] w-full object-cover">
        </figure>
      </div>
      <div class="lg:col-span-7">
        <h3 class="font-display text-[27px] lg:text-[2rem] leading-tight tracking-tight text-brand-900">What one session actually looks like</h3>
        <p class="mt-4 text-[15.5px] leading-relaxed text-brand-900/60">
          You are with us for about two hours, in a private room with a recliner. Nothing about it
          is rushed, and you are never left alone with it.
        </p>
        <ul class="mt-8 grid sm:grid-cols-3 gap-5">
          <?php
          $session = [
            ['You self-administer', 'The nasal spray, under the direct supervision of our trained staff.',
             'M12 3c3 3.5 5 6.4 5 9a5 5 0 0 1-10 0c0-2.6 2-5.5 5-9Z'],
            ['Two-hour monitoring', 'Vital signs are checked throughout. Most side effects appear and resolve inside this window.',
             'M12 7v5l3 2M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18Z'],
            ['Arrange a ride home',  'No driving or operating machinery until the next day, after a full night’s sleep.',
             'M5 16h14M6.5 16V11l1.6-4h7.8l1.6 4v5M8 19v-3M16 19v-3'],
          ];
          foreach ($session as [$h, $p, $icon]): ?>
          <li>
            <span class="grid place-items-center h-10 w-10 rounded-xl bg-sand text-brand-800">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="<?= $icon ?>"/></svg>
            </span>
            <p class="mt-4 text-[15.5px] font-medium text-brand-900"><?= $h ?></p>
            <p class="mt-1.5 text-[14px] leading-relaxed text-brand-900/55"><?= $p ?></p>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="reveal mt-12 text-center">
      <a href="#eligibility" class="group inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-8 py-4 text-[15.5px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
        Start with an eligibility check
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
      </a>
      <p class="mt-4 text-[13.5px] text-brand-900/45">
        Or call <a href="tel:<?= $PHONE_LINK ?>" class="font-medium text-brand-900/70 hover:text-accent-600 transition"><?= $PHONE_DISPLAY ?></a> — we answer Monday to Friday, 8am–5pm.
      </p>
    </div>
  </div>
</section>

<!-- ══════════════════ THE SPACE ══════════════════ -->
<section id="space" class="py-16 lg:py-24 bg-brand-950 text-cream grain relative overflow-hidden scroll-mt-24">
  <div class="pointer-events-none absolute -left-40 top-10 h-[28rem] w-[28rem] rounded-full bg-brand-600/35 blur-[120px]"></div>

  <div class="relative mx-auto max-w-8xl px-6 lg:px-10">
    <div class="max-w-3xl reveal">
      <p class="text-[12px] uppercase tracking-[0.24em] text-accent-400 font-semibold">Our Phoenix clinic</p>
      <h2 class="mt-5 font-display text-4xl lg:text-[3rem] leading-[1.08] tracking-tightest font-light">
        Two hours, somewhere calm.
      </h2>
      <p class="mt-6 text-[16.5px] leading-relaxed text-cream/65 font-light">
        You will spend more time here than at a normal appointment, so it is worth knowing what
        you are walking into: a private room, a recliner, staff within reach the whole time.
      </p>
    </div>

    <?php
    /* Practice photography. Each tile carries its own caption so the wall reads as
       a tour rather than decoration. */
    $gallery = [
      ['room',      'The monitoring room',  'Recliners, vitals equipment and privacy screens — where your two hours are spent.', 'sm:col-span-2 lg:col-span-6 lg:row-span-2'],
      ['reception', 'Reception',            'Check-in is quiet and unhurried; there is no crowded waiting room to sit in.',      'lg:col-span-3'],
      ['care',      'Someone stays with you','A clinician supervises the dose and monitors you afterward — never left alone with it.', 'lg:col-span-3'],
      ['tms',       'Everything under one roof','If SPRAVATO® isn’t the right fit, TMS, ECT and medication management are down the same hall.', 'sm:col-span-2 lg:col-span-6'],
    ];
    ?>
    <div class="reveal mt-14 grid gap-4 sm:grid-cols-2 lg:grid-cols-12 lg:auto-rows-[15rem]">
      <?php foreach ($gallery as $i => [$slot, $title, $caption, $span]): ?>
      <!-- The tiles are aspect-driven until the 12-column collage takes over at lg,
           where the row spans set their height instead. -->
      <figure class="group relative overflow-hidden rounded-3xl ring-1 ring-white/12 aspect-[4/3] sm:aspect-[3/2] lg:aspect-auto <?= $span ?>"
              style="transition-delay:<?= $i * 70 ?>ms">
        <img src="<?= $img($slot, 1200) ?>" alt="<?= $alt($slot) ?>" loading="lazy" decoding="async"
             class="js-photo h-full w-full object-cover transition duration-700 group-hover:scale-[1.04]">
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-brand-950/90 via-brand-950/20 to-transparent"></div>
        <figcaption class="absolute inset-x-0 bottom-0 p-6">
          <p class="text-[16px] font-medium text-cream"><?= $title ?></p>
          <p class="mt-1 text-[13.5px] leading-snug text-cream/60 max-w-sm"><?= $caption ?></p>
        </figcaption>
      </figure>
      <?php endforeach; ?>
    </div>

    <div class="reveal mt-10 flex flex-col sm:flex-row items-center gap-4">
      <a href="#eligibility" class="group inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-7 py-3.5 text-[15px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
        Check my eligibility
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
      </a>
      <p class="text-[14px] leading-relaxed text-cream/45 max-w-md">
        <?= $ADDRESS_L1 ?>, <?= $ADDRESS_L2 ?> — Monday to Friday, 8am–5pm.
      </p>
    </div>
  </div>
</section>

<!-- ══════════════════ INSURANCE & COST ══════════════════ -->
<section id="insurance" class="py-16 lg:py-20 bg-white border-y border-black/5 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">

    <div class="grid lg:grid-cols-12 gap-10 lg:gap-16 items-end reveal">
      <div class="lg:col-span-7">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Insurance &amp; cost</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[3rem] leading-[1.08] tracking-tightest text-brand-900 font-light">
          Covered by most plans —<br class="hidden sm:block"> with a form we fill in.
        </h2>
      </div>
      <div class="lg:col-span-5">
        <p class="text-[16px] leading-relaxed text-brand-900/60 font-light">
          The vast majority of commercial plans, Medicare and many Medicaid programs cover
          SPRAVATO&reg; for treatment-resistant depression. What stands between you and approval is
          a prior authorization — and our care coordinators handle that, start to finish.
        </p>
      </div>
    </div>

    <div class="mt-12 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
      <?php foreach ($insurers as $i => [$carrier, $file]):
        $path  = $IMG_DIR . '/insurance/' . $file;
        $exists = is_file(__DIR__ . '/' . $path);
      ?>
      <div class="reveal group grid place-items-center h-24 sm:h-28 rounded-2xl border border-black/[0.07] bg-white px-5 transition duration-300 hover:-translate-y-0.5 hover:border-brand-900/15 hover:shadow-lg hover:shadow-brand-900/[0.06]"
           style="transition-delay:<?= min($i, 9) * 40 ?>ms">
        <?php if ($exists): ?>
        <img src="<?= $BASE ?>/<?= $path ?>?v=<?= filemtime(__DIR__ . '/' . $path) ?>" alt="<?= $carrier ?>" loading="lazy" decoding="async"
             class="js-photo max-h-11 sm:max-h-12 max-w-[85%] w-auto object-contain opacity-90 transition duration-300 group-hover:opacity-100">
        <?php else: ?>
        <span class="text-center font-display text-[19px] leading-tight tracking-tight text-brand-900/70"><?= $carrier ?></span>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- the money questions, answered before they have to ask -->
    <div class="mt-12 grid md:grid-cols-3 gap-5">
      <?php
      $cost = [
        ['Two parts to the bill',
         'The medication itself may run through your pharmacy or medical benefits. The two-hour observation visit is billed separately, under your medical benefits. We tell you what each will cost before you start.',
         'M4 7h16v12H4V7Zm4-3h8v3H8V4Zm-1 8h10M7 15h6'],
        ['As little as $10 per treatment',
         'Janssen’s SPRAVATO withMe savings program can reduce out-of-pocket medication costs to as little as $10 per treatment for eligible patients with commercial insurance. It covers the medication, not the clinic visit.',
         'M12 3v18M16.5 7.5c0-1.7-2-2.7-4.5-2.7S7.5 5.9 7.5 7.9s2 2.6 4.5 3.1 4.5 1.1 4.5 3.1-2 3.1-4.5 3.1-4.5-1-4.5-2.7'],
        ['Medicare &amp; AHCCCS too',
         'Medicare Part B generally covers SPRAVATO® and the observation visits in an outpatient psychiatric setting. Most state Medicaid programs, including Arizona’s AHCCCS, cover it as well — prior authorization almost always required.',
         'M12 3l7.5 3v5.5c0 4.4-3.1 8.2-7.5 9.5-4.4-1.3-7.5-5.1-7.5-9.5V6L12 3Z'],
      ];
      foreach ($cost as $i => [$h, $p, $icon]): ?>
      <div class="reveal rounded-3xl border border-black/[0.07] bg-cream p-8" style="transition-delay:<?= $i * 70 ?>ms">
        <span class="grid place-items-center h-11 w-11 rounded-2xl bg-white text-brand-800 ring-1 ring-black/5">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="<?= $icon ?>"/></svg>
        </span>
        <h3 class="mt-6 font-display text-[22px] tracking-tight text-brand-900"><?= $h ?></h3>
        <p class="mt-3 text-[14.5px] leading-relaxed text-brand-900/60"><?= $p ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="reveal mt-8 flex flex-col sm:flex-row sm:items-center justify-between gap-5 rounded-2xl bg-sand/70 px-6 py-5">
      <p class="text-[14.5px] leading-relaxed text-brand-900/60 max-w-2xl">
        <span class="font-medium text-brand-900">Denied before, or worried you will be?</span>
        Denials are usually a documentation problem, not a verdict. We file the appeal with the
        clinical evidence your insurer is asking for.
      </p>
      <a href="tel:<?= $PHONE_LINK ?>" class="group inline-flex items-center justify-center gap-2 rounded-full bg-brand-900 px-6 py-3 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition shrink-0">
        Verify my coverage
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
      </a>
    </div>

    <p class="mt-6 text-[11.5px] leading-relaxed text-brand-900/30 max-w-4xl">
      <sup>*</sup>Savings program eligibility, benefits and plan participation are set by the program
      sponsor and your insurer and can change; restrictions apply. Coverage varies by plan and by
      treatment. All carrier names and logos are the property of their respective owners and are shown
      solely to indicate plans accepted at this practice. Their use does not imply endorsement or
      affiliation.
    </p>
  </div>
</section>

<!-- ══════════════════ SAFETY ══════════════════ -->
<section id="safety" class="py-16 lg:py-24 bg-sand/60 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">
    <div class="grid lg:grid-cols-12 gap-12 lg:gap-16">

      <div class="lg:col-span-5 reveal">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Safety</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[2.9rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
          Why it is only given<br class="hidden sm:block"> in a clinic.
        </h2>
        <p class="mt-6 text-[16.5px] leading-relaxed text-brand-900/60 font-light">
          SPRAVATO&reg; is a scheduled medication that can cause dissociation and raise blood pressure,
          so it is dispensed only through a REMS-certified center. We are one — which means trained
          staff, strict protocols and a monitoring period that is not optional.
        </p>

        <ul class="mt-8 space-y-4">
          <?php
          $rems = [
            ['Direct supervision', 'A clinician is with you while you self-administer the nasal spray.'],
            ['Two-hour monitoring', 'After every dose, with vital signs observed for potential side effects.'],
            ['Transportation required', 'You cannot drive or operate machinery until the next day, after a full night’s rest.'],
          ];
          foreach ($rems as [$h, $p]): ?>
          <li class="flex items-start gap-3.5 rounded-2xl border border-black/[0.07] bg-white px-5 py-4">
            <span class="mt-0.5 grid place-items-center h-6 w-6 shrink-0 rounded-full bg-brand-900/[0.07] text-brand-700">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="h-3 w-3"><path d="M5 13l4 4L19 7"/></svg>
            </span>
            <div>
              <p class="text-[15px] font-medium text-brand-900"><?= $h ?></p>
              <p class="mt-1 text-[14px] leading-relaxed text-brand-900/55"><?= $p ?></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="lg:col-span-7 reveal" style="transition-delay:.1s">
        <div class="grid sm:grid-cols-2 gap-5">

          <div class="rounded-3xl border border-black/[0.07] bg-white p-8">
            <h3 class="font-display text-[23px] tracking-tight text-brand-900">Common side effects</h3>
            <p class="mt-3 text-[14.5px] leading-relaxed text-brand-900/55">
              These usually begin shortly after the dose and resolve the same day — which is exactly
              what the monitoring period is for.
            </p>
            <ul class="mt-6 flex flex-wrap gap-2">
              <?php foreach ([
                'Dissociation','Dizziness','Fatigue','Nausea or vomiting',
                'Feeling drunk or euphoric','Anxiety or numbness','Spinning sensation',
                'Increased blood pressure','Sedation',
              ] as $se): ?>
              <li class="rounded-full bg-sand px-3.5 py-1.5 text-[13px] text-brand-900/70"><?= $se ?></li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="rounded-3xl border border-accent-200 bg-accent-50/60 p-8">
            <h3 class="font-display text-[23px] tracking-tight text-brand-900">Who should not take it</h3>
            <p class="mt-3 text-[14.5px] leading-relaxed text-brand-900/55">
              SPRAVATO&reg; is not recommended for people with any of the following. Your evaluation
              screens for all of them before anything is prescribed.
            </p>
            <ul class="mt-6 space-y-3">
              <?php foreach ([
                'Aneurysms or blood vessel disease',
                'Abnormal blood vessel connections (arteriovenous malformation)',
                'A history of bleeding in the brain',
                'An allergic reaction to esketamine or ketamine',
              ] as $contra): ?>
              <li class="flex items-start gap-3 text-[14.5px] leading-relaxed text-brand-900/70">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mt-1 h-3.5 w-3.5 shrink-0 text-accent-600"><path d="M5 5l14 14M19 5 5 19"/></svg>
                <?= $contra ?>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="sm:col-span-2 rounded-3xl bg-brand-900 p-8 text-cream">
            <p class="text-[12px] uppercase tracking-[0.16em] text-cream/40">Important</p>
            <p class="mt-3 text-[15.5px] leading-relaxed text-cream/75">
              SPRAVATO&reg; is not a pain reliever or an anesthetic, and it is never taken home. Tell
              your provider about every medical condition and medication you are on — that is how we
              judge whether it is safe for you specifically. This page is general information, not
              medical advice, and it is not a substitute for the full Prescribing Information and
              Medication Guide your clinician will review with you.
            </p>
            <div class="mt-6 flex flex-wrap items-center gap-4">
              <a href="#eligibility" class="group inline-flex items-center gap-2 rounded-full bg-accent-500 px-6 py-3 text-[14.5px] font-medium text-white hover:bg-accent-600 transition">
                Talk it through with a psychiatrist
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
              </a>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════ TESTIMONIALS ══════════════════ -->
<section class="py-16 lg:py-24 overflow-hidden">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">

    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-8 reveal">
      <div class="max-w-2xl">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Patient experiences</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[3rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
          In their words.
        </h2>
        <p class="mt-5 text-[15.5px] leading-relaxed text-brand-900/55">
          Unedited reviews left by our patients on Google, reproduced word for word.
        </p>
      </div>

      <div class="flex items-center gap-2.5 shrink-0">
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

    <div class="reveal mt-12" role="region" aria-label="Patient reviews from Google">
      <div id="tTrack" tabindex="0"
           class="slider flex gap-5 overflow-x-auto snap-x snap-mandatory scroll-smooth -mx-6 px-6 lg:-mx-2 lg:px-2 pb-3 outline-none">
        <?php foreach ($reviews as [$name, $initials, $meta, $when, $tag, $body]): ?>
        <figure class="t-card snap-start shrink-0 flex flex-col w-[86%] sm:w-[calc(50%-10px)] lg:w-[calc(33.333%-14px)] rounded-3xl border border-black/[0.07] bg-white p-8">
          <div class="flex items-start gap-3.5">
            <span class="grid place-items-center h-11 w-11 shrink-0 rounded-full bg-brand-900/[0.07] font-display text-[15px] text-brand-800"><?= $initials ?></span>
            <div class="min-w-0">
              <p class="text-[15.5px] font-medium text-brand-900 truncate"><?= $name ?></p>
              <p class="text-[12.5px] text-brand-900/45 mt-0.5"><?= $meta ?> · <?= $when ?></p>
            </div>
            <svg viewBox="0 0 24 24" class="ml-auto h-6 w-6 shrink-0 text-accent-400/50" fill="currentColor"><path d="M9.5 6C6.5 7.5 5 10.2 5 14v4h6v-6H8.2c.2-2 1.2-3.4 3-4.3L9.5 6Zm9 0C15.5 7.5 14 10.2 14 14v4h6v-6h-2.8c.2-2 1.2-3.4 3-4.3L18.5 6Z"/></svg>
          </div>

          <blockquote class="quote mt-5 text-[15.5px] leading-relaxed text-brand-900/70 font-light"><?= $body ?></blockquote>
          <button type="button" class="q-more mt-3 self-start text-[13.5px] font-medium text-accent-600 hover:underline">Read full review</button>

          <figcaption class="mt-auto pt-6 flex items-center justify-between gap-3">
            <span class="text-[12.5px] text-brand-900/40">Google review</span>
            <span class="rounded-full bg-sand px-2.5 py-1 text-[12px] text-brand-900/60 shrink-0"><?= $tag ?></span>
          </figcaption>
        </figure>
        <?php endforeach; ?>
      </div>

      <!-- scroll progress -->
      <div class="mt-7 h-[3px] w-full max-w-xs rounded-full bg-brand-900/10 overflow-hidden">
        <div id="tProgress" class="h-full w-1/3 rounded-full bg-brand-800 transition-[width,transform] duration-200"></div>
      </div>
    </div>

    <div class="reveal mt-12 flex flex-col sm:flex-row items-center justify-center gap-x-5 gap-y-4 text-center">
      <p class="font-display text-[22px] tracking-tight text-brand-900">Your first visit starts with a phone call.</p>
      <a href="#eligibility" class="group inline-flex items-center gap-2 rounded-full bg-accent-500 px-7 py-3.5 text-[15px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20 shrink-0">
        Check my eligibility
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
      </a>
    </div>

    <p class="mt-10 text-[12.5px] leading-relaxed text-brand-900/35 max-w-3xl">
      Reviews are reproduced as published by their authors on Google and describe care at this
      practice generally, not SPRAVATO&reg; treatment specifically. Patient experiences vary;
      testimonials reflect individual results and are not a guarantee of outcome.
    </p>
  </div>
</section>

<!-- ══════════════════ FAQ ══════════════════ -->
<section id="faq" class="py-16 lg:py-24 bg-sand/60 scroll-mt-24">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">
    <div class="grid lg:grid-cols-12 gap-14">

      <div class="lg:col-span-4 reveal">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Questions</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[2.9rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
          Good to know before you call.
        </h2>
        <p class="mt-6 text-[15.5px] leading-relaxed text-brand-900/60">
          Still unsure? A short phone call answers most of it — no forms, no waiting room.
        </p>

        <div class="mt-8 rounded-2xl border border-black/[0.07] bg-white p-6">
          <p class="text-[12px] uppercase tracking-[0.16em] text-brand-900/40">Ask us directly</p>
          <a href="tel:<?= $PHONE_LINK ?>" class="mt-2 block font-display text-[26px] tracking-tight text-brand-900 hover:text-accent-600 transition"><?= $PHONE_DISPLAY ?></a>
          <p class="mt-1 text-[13.5px] text-brand-900/45">Monday to Friday, 8am–5pm</p>
          <a href="#eligibility" class="group mt-5 inline-flex items-center gap-2 rounded-full bg-brand-900 px-6 py-3 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition">
            Check my eligibility
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>

      <div class="lg:col-span-8 reveal" style="transition-delay:.1s">
        <?php foreach ($faqs as $i => [$q, $a]): ?>
        <div class="faq border-b border-black/10 <?= $i === 0 ? 'border-t' : '' ?>">
          <button class="faq-btn w-full flex items-start justify-between gap-6 py-6 text-left group">
            <span class="text-[17.5px] leading-snug text-brand-900 font-medium group-hover:text-accent-600 transition"><?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8') ?></span>
            <span class="faq-icon mt-1 grid place-items-center h-7 w-7 shrink-0 rounded-full border border-black/15 text-brand-900 transition-transform duration-300">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5"><path d="M12 5v14M5 12h14"/></svg>
            </span>
          </button>
          <div class="faq-body">
            <div>
              <p class="pb-6 pr-14 text-[15.5px] leading-relaxed text-brand-900/60"><?= htmlspecialchars($a, ENT_QUOTES, 'UTF-8') ?></p>
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
  <div class="pointer-events-none absolute -left-40 bottom-0 h-[30rem] w-[30rem] rounded-full bg-brand-600/40 blur-[120px]"></div>
  <div class="pointer-events-none absolute right-0 -top-24 h-[26rem] w-[26rem] rounded-full bg-accent-500/15 blur-[120px]"></div>

  <div class="relative mx-auto max-w-8xl px-6 lg:px-10 py-16 lg:py-20">
    <div class="grid lg:grid-cols-12 gap-10 lg:gap-16 items-center">

      <div class="lg:col-span-6 reveal">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-400 font-semibold">Get started</p>
        <h2 class="mt-4 font-display text-4xl lg:text-[3rem] leading-[1.08] tracking-tightest font-light">
          You have waited<br> long enough.
        </h2>
        <p class="mt-5 text-[16.5px] leading-relaxed text-cream/65 font-light max-w-md">
          Prior authorization takes three days to two weeks. The sooner we start it, the sooner
          you can start treatment — and the first conversation costs you nothing.
        </p>

        <div class="mt-8 flex flex-col sm:flex-row gap-3.5">
          <a href="tel:<?= $PHONE_LINK ?>" class="inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-7 py-4 text-[15.5px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
            Call <?= $PHONE_DISPLAY ?>
          </a>
          <a href="#eligibility" class="group inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-7 py-4 text-[15.5px] font-medium text-cream hover:bg-white/10 transition backdrop-blur">
            Check my eligibility
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:-translate-y-0.5"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
          </a>
        </div>

        <p class="mt-7 flex items-start gap-2.5 text-[13.5px] leading-relaxed text-cream/50">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-4 w-4 shrink-0 mt-0.5 text-accent-400"><path d="M12 8.5v4.5M12 16.5h.01"/><path d="M10.3 3.9 2.6 17.3A2 2 0 0 0 4.3 20.3h15.4a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
          <span><span class="text-cream/80 font-medium">In crisis?</span> Call 911, or call or text
            <a href="tel:988" class="font-semibold text-accent-400 hover:underline">988</a> for the 24/7 Suicide &amp; Crisis Lifeline.</span>
        </p>
      </div>

      <!-- where to find us -->
      <div class="lg:col-span-6 reveal" style="transition-delay:.12s">
        <div class="overflow-hidden rounded-2xl border border-white/12 bg-white/[0.04]">
          <iframe
            title="Map to Interventional Psychiatry of Arizona, <?= $ADDRESS_L1 ?>, <?= $ADDRESS_L2 ?>"
            src="https://www.google.com/maps?q=<?= $MAPS_QUERY ?>&output=embed"
            class="block h-64 w-full grayscale-[0.3] contrast-[1.05] transition duration-500 hover:grayscale-0"
            loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
          <div class="flex flex-wrap items-center justify-between gap-3 px-6 py-5">
            <p class="text-[14.5px] leading-snug text-cream/70">
              <span class="text-cream"><?= $ADDRESS_L1 ?></span><br><?= $ADDRESS_L2 ?>
            </p>
            <p class="text-[14.5px] leading-snug text-cream/45 shrink-0">Mon–Fri<br>8am–5pm</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════ FOOTER ══════════════════ -->
<footer class="bg-brand-950 border-t border-white/10 text-cream/60 pb-24 lg:pb-0">
  <div class="mx-auto max-w-8xl px-6 lg:px-10 py-14">
    <div class="grid md:grid-cols-12 gap-10">

      <div class="md:col-span-5">
        <img src="<?= $LOGO_LIGHT ?>" alt="Interventional Psychiatry of Arizona — Building Strong Minds"
             width="545" height="228" loading="lazy" class="h-16 w-auto">
        <p class="mt-6 text-[14.5px] leading-relaxed max-w-sm">
          A REMS-certified SPRAVATO&reg; treatment center in Phoenix — alongside TMS, ECT,
          medication management and psychotherapy, delivered by a team that stays with you.
        </p>

        <a href="tel:<?= $PHONE_LINK ?>" class="group mt-7 inline-flex items-center gap-2.5 rounded-full bg-accent-500 px-6 py-3 text-[14.5px] font-medium text-white hover:bg-accent-600 transition">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
          Call <?= $PHONE_DISPLAY ?>
        </a>
      </div>

      <div class="md:col-span-2">
        <p class="text-[12px] uppercase tracking-[0.18em] text-cream/35">SPRAVATO&reg;</p>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <li><a href="#qualify"   class="hover:text-accent-400 transition">Do I qualify?</a></li>
          <li><a href="#science"   class="hover:text-accent-400 transition">How it works</a></li>
          <li><a href="#process"   class="hover:text-accent-400 transition">Your treatment</a></li>
          <li><a href="#space"     class="hover:text-accent-400 transition">Our clinic</a></li>
          <li><a href="#safety"    class="hover:text-accent-400 transition">Safety</a></li>
        </ul>
      </div>

      <div class="md:col-span-2">
        <p class="text-[12px] uppercase tracking-[0.18em] text-cream/35">Practice</p>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <li><a href="#insurance"   class="hover:text-accent-400 transition">Insurance &amp; cost</a></li>
          <li><a href="#faq"         class="hover:text-accent-400 transition">FAQ</a></li>
          <li><a href="#contact"     class="hover:text-accent-400 transition">Contact</a></li>
          <li><a href="#eligibility" class="hover:text-accent-400 transition">Check my eligibility</a></li>
        </ul>
      </div>

      <div class="md:col-span-3">
        <p class="text-[12px] uppercase tracking-[0.18em] text-cream/35">Visit</p>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <li><?= $ADDRESS_L1 ?><br><?= $ADDRESS_L2 ?></li>
          <li><a href="tel:<?= $PHONE_LINK ?>" class="hover:text-accent-400 transition"><?= $PHONE_DISPLAY ?></a></li>
          <li class="text-cream/40">Mon–Fri · 8am–5pm</li>
        </ul>
      </div>
    </div>

    <div class="mt-12 pt-7 border-t border-white/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-[13px] text-cream/40">
      <p>&copy; <?= $YEAR ?> Interventional Psychiatry of Arizona. All rights reserved.</p>
      <p><?= $ADDRESS_L1 ?>, <?= $ADDRESS_L2 ?> &middot; Mon–Fri 8am–5pm</p>
    </div>

    <p class="mt-8 text-[12px] leading-relaxed text-cream/25 max-w-4xl">
      SPRAVATO&reg; is a registered trademark of Janssen Pharmaceuticals, Inc. SPRAVATO withMe is a
      program of Janssen Pharmaceuticals, Inc. Those marks are used here only to identify the
      treatment offered at this practice; Interventional Psychiatry of Arizona is an independent
      REMS-certified provider and is not affiliated with, endorsed by or sponsored by Janssen
      Pharmaceuticals, Inc. or Johnson &amp; Johnson. The content on this page is for general
      informational purposes only and is not a substitute for professional medical advice, diagnosis
      or treatment, nor for the full Prescribing Information, Boxed Warning and Medication Guide for
      SPRAVATO&reg;. Always seek the guidance of a qualified health provider with questions about a
      medical condition.
    </p>
  </div>
</footer>

<!-- ══════════════════ STICKY MOBILE CTA ══════════════════ -->
<div id="stickyBar" class="lg:hidden fixed inset-x-0 bottom-0 z-40 border-t border-white/10 bg-brand-950/95 px-4 py-3 backdrop-blur-xl">
  <div class="flex items-center gap-3">
    <a href="tel:<?= $PHONE_LINK ?>" class="flex-1 inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-5 py-3 text-[14.5px] font-medium text-cream">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
      Call
    </a>
    <a href="#eligibility" class="flex-[1.4] inline-flex items-center justify-center gap-2 rounded-full bg-accent-500 px-5 py-3 text-[14.5px] font-medium text-white">
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
      'url'         => $absolute(''),
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

menuBtn.addEventListener('click', () => { mobileMenu.classList.toggle('hidden'); setNavState(); });
mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
  mobileMenu.classList.add('hidden'); setNavState();
}));

/* ---------- sticky mobile CTA ----------
   Hidden while the hero form is on screen — two competing calls to action in
   the same viewport just split attention. */
(() => {
  const bar  = document.getElementById('stickyBar');
  const form = document.getElementById('eligibility');
  if (!bar || !form) return;
  const io = new IntersectionObserver(
    ([e]) => bar.classList.toggle('show', !e.isIntersecting),
    { threshold: 0 }
  );
  io.observe(form);
})();

/* ---------- scroll reveal ---------- */
const io = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
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

/* ---------- testimonial slider ---------- */
(() => {
  const track = document.getElementById('tTrack');
  if (!track) return;
  const prev = document.getElementById('tPrev');
  const next = document.getElementById('tNext');
  const bar  = document.getElementById('tProgress');
  const gap  = 20;

  const step = () => (track.querySelector('.t-card')?.offsetWidth || 320) + gap;
  const maxScroll = () => track.scrollWidth - track.clientWidth;

  const sync = () => {
    const max = maxScroll();
    const at = track.scrollLeft;
    prev.disabled = at < 4;
    next.disabled = at > max - 4;
    /* the rail shows how much of the set is visible, and where you are in it */
    const visible = Math.min(1, track.clientWidth / track.scrollWidth);
    bar.style.width = (visible * 100) + '%';
    bar.style.transform = `translateX(${max > 0 ? (at / max) * ((1 / visible) - 1) * 100 : 0}%)`;
  };

  prev.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }));
  next.addEventListener('click', () => track.scrollBy({ left:  step(), behavior: 'smooth' }));
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
   If a photo fails to load, drop it so the brand gradient underneath shows
   through rather than leaving a broken-image frame in the layout. */
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
