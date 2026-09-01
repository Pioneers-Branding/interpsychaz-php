# Image assets — Medication Management landing page

Every image on the page is declared once, in the `$IMG` array near the top of
`index.php`. Files are cache-busted by modification time, so replacing a file takes
effect on the next page load — no code change needed.

Asset URLs are built against `$BASE`, the URL path the folder is served from. That is
derived from the folder name, so the page renders correctly at `/medication`,
`/medication/`, or with the folder's contents deployed at the domain root. **If you
rename the folder, nothing needs changing** — `$BASE` follows it.

> **Do not rename this folder to `medication-management`.** A page already exists at
> `medication-management.php` in the site root, and the two would compete for the same
> URL. Apache resolves the directory first, but the local `php -S router.php` dev
> server resolves the root PHP file — so you would preview the wrong page.

## Brand lockups

| File | Used for |
|---|---|
| `interpsychaz-logo.webp` | White lockup — footer, and the header while it floats over the hero |
| `interpsychaz-logo-dark.webp` | Indigo (`#262858`) recolour — header once scrolled onto light backgrounds |
| `favicon-32.png`, `favicon-180.png` | Browser tab and iOS home-screen icon |

## Photography

| File | Slot | Where it appears |
|---|---|---|
| `ambience/hero-medication.jpg` | `hero` | Hero background — a weekly organiser being filled. 1920 × 1280, the only image loaded eagerly. Its dark slate ground is what lets the cream headline read; a lighter replacement will need the hero overlays re-tuned |
| `ambience/why-patient-trust-us.webp` | `care` | Hero — the small patient card under the buttons |
| `pills-in-hand.jpg` | `regimen` | "What we manage" — a hand holding four different tablets |
| `ambience/consultation.jpg` | `consult` | "Your first visit" — a clinician talking with a patient |
| `medication-review.jpg` | `review` | "Why patients switch" — a blister pack and tablet on a desk |
| `ambience/inter-a-3.png` | `reception` | Ambience rail — the front desk |
| `ambience/inter-a-1.webp` | `room` | Ambience rail — a treatment room |
| `ambience/inter-a-2.webp` | `tms` | Ambience rail — the TMS room |

**Why the ambience photos live in a small rail:** these practice sources top out at
680 px wide, and `inter-a-3.png` is only 141 × 176. At the rail's tile size (11.5–13.5 rem)
they stay sharp; in a full-width collage they would visibly upscale. If you re-shoot the
practice at 1200 px or wider, the rail can become a proper grid.

**Worth re-exporting:** `ambience/consultation.jpg` is 2000 × 1333 at ~700 KB, several
times heavier than anything else here. It is lazy-loaded and below the fold so it does
not affect LCP, but a ~1400 px WebP export would cut it by roughly 80%.

## Insurance carrier logos — `insurance/`

A carrier listed in `$insurers` without a matching file still renders, as a plain
wordmark tile, so the wall never shows a gap. The same list also populates the "Your
insurance" dropdown in the appointment form.

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
  photo's subject changes.
- Every slot has a real file, so the page makes no external image request. Each slot
  still names an Unsplash fallback id in case a file goes missing.
- Filenames must not contain spaces.
- Patient-facing photography should use models or consented photos — never an
  identifiable patient without written authorisation.
