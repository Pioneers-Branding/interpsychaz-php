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

## SPRAVATO® imagery

| File | Where it appears |
|---|---|
| `spravato-esketamine.jpg` | "How it works" section — the nasal spray device |
| `spravato-treatment-session.webp` | "What one session actually looks like" card |

## Practice photography — `ambience/`

| File | Where it appears |
|---|---|
| `hero-bg-inter.webp` | Hero background — neuron/synapse render |
| `inter-a-1.webp` | Our clinic gallery, large tile — the monitoring room |
| `inter-a-3.png` | Our clinic gallery — reception |
| `why-patient-trust-us.webp` | Our clinic gallery — a clinician with a patient |
| `inter-a-2.webp` | Our clinic gallery, wide tile — the TMS room |

**Worth re-exporting:** `hero-bg-inter.webp` is 680 × 453, which the full-bleed hero
scales up roughly 3×. A ≥ 2000 px wide version would sharpen the most prominent image
on the page.

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
