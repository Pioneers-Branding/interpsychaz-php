# Image assets — SPRAVATO® landing page

Every image on the page is declared once, in the `$IMG` array near the top of
`index.php`. Files are cache-busted by modification time, so replacing a file takes
effect on the next page load — no code change needed.

Asset URLs are built against `$BASE`, the URL path the folder is served from. That
is derived from the folder name, so the page renders correctly at `/spravato`,
`/spravato/`, or with the folder's contents deployed at the domain root. **If you
rename the folder, nothing needs changing** — `$BASE` follows it.

## Brand lockups

| File | Used for |
|---|---|
| `interpsychaz-logo.webp` | White lockup — footer, and the header while it floats over the hero |
| `interpsychaz-logo-dark.webp` | Indigo (`#262858`) recolour — header once scrolled onto light backgrounds |
| `spravato-logo.webp` | SPRAVATO® wordmark, shown once beside the mechanism section |
| `favicon-32.png`, `favicon-180.png` | Browser tab and iOS home-screen icon |

## Photography — `ambience/` and the SPRAVATO® slots

| File | Slot | Where it appears |
|---|---|---|
| `ambience/hero-happy-patient.jpg` | `hero` | Hero background — 1920 × 1280, the only image loaded eagerly. The subject is centred, so the hero uses two overlays: a flat tint plus a left-to-right gradient that darkens behind the headline and the form but stays light through the middle. Swapping in a photo with a differently placed subject means re-tuning that gradient |
| `ambience/hero-brain.webp` | — | The previous hero (1920 × 1440 brain render). Unused; kept in case you want it back |
| `ambience/why-patient-trust-us.webp` | `care` | Hero — the small patient card under the buttons |
| `ambience/spravato-image.webp` | `device` | "How it works" — the real SPRAVATO® 28 mg device in a patient's hand. Portrait (578 × 661), so its frame stays portrait and is width-capped on phones |
| `ambience/hero-bg-inter.webp` | — | No longer on the landing page; still the background of `thank-you.php`. Do not delete |
| `spravato-treatment-session.webp` | `session` | Clinic gallery, large tile — self-administering the nasal spray |
| `ambience/inter-a-1.webp` | `room` | Clinic gallery — the monitoring room |
| `ambience/inter-a-3.png` | `reception` | Clinic gallery — reception |
| `ambience/inter-a-2.webp` | `tms` | Clinic gallery — the TMS room |

The gallery's `lg` spans total 12 per row (5 + 4 + 3, then the row-spanning tile plus 7).
Adding or removing a tile means re-balancing those spans in the `$gallery` array.

**Not currently placed:** `spravato-esketamine.jpg` (1280 × 853) — a woman sitting with
her head in her hands. Kept in case you want a "who this is for" image; if you place it,
write alt text that describes what it actually shows.

**Worth re-exporting:** `hero-bg-inter.webp` is only 680 × 453. It is fine at the size
the mechanism section renders it, but do not promote it back to the hero without a
larger export.

## Insurance carrier logos — `insurance/`

A carrier listed in `$insurers` without a matching file still renders, as a plain
wordmark tile, so the wall never shows a gap. The same list also populates the
"Your insurance" dropdown in the eligibility form.

`aetna.webp` · `ambetter.png` · `arizona-complete-health.png` · `bcbs-arizona.png` ·
`care1st.png` · `cigna.png` · `curative.png` · `health-net.png` · `humana.png` ·
`medicare.png` · `mercy-care.png` · `optum.png` · `scan-health-plan.png` ·
`tricare-for-life.png` · `triwest.png` · `unitedhealthcare-community-plan.png` ·
`wellcare-allwell.png`

Logos sit on white cards, so a white background in the file is seamless. Trim tight to
the artwork; the card supplies the padding.

## Notes

- Export photos at ~80% JPEG/WebP quality; aim for under ~250 KB each.
- Alt text lives beside each slot in the `$IMG` array in `index.php`. Update it when a
  photo's subject changes — the gallery captions are separate, in the `$gallery` array.
- Every slot has a real file, so the page makes no external image request. Each slot
  still names an Unsplash fallback id in case a file goes missing.
- Filenames must not contain spaces.
- Patient-facing photography should use models or consented photos — never an
  identifiable patient without written authorisation.
