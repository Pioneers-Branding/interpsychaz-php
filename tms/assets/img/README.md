# Image assets — TMS Therapy landing page

Every image on the page is declared once, in the `$IMG` array near the top of
`index.php`. Files are cache-busted by modification time, so replacing a file takes
effect on the next page load — no code change needed.

Asset URLs are built against `$BASE`, the URL path the folder is served from. That is
derived from the folder name, so the page renders correctly at `/tms`, `/tms/`, or with
the folder's contents deployed at the domain root. **If you rename the folder, nothing
needs changing** — `$BASE` follows it.

> **Do not rename this folder to `tms-therapy`.** A page already exists at
> `tms-therapy.php` in the site root, and the two would compete for the same URL.
> Apache resolves the directory first, but the local `php -S router.php` dev server
> resolves the root PHP file — so you would preview the wrong page. This is the same
> trap that keeps the medication landing page at `medication/`.

## Brand lockups

| File | Used for |
|---|---|
| `interpsychaz-logo.webp` | White lockup — footer, confirmation page, and the header while it floats over the hero |
| `interpsychaz-logo-dark.webp` | Indigo (`#262858`) recolour — header once scrolled onto light backgrounds |
| `favicon-32.png`, `favicon-180.png` | Browser tab and iOS home-screen icon |

## Photography

| File | Slot | Where it appears |
|---|---|---|
| `ambience/hero-tms.jpg` | `hero` | Hero background, and the fixed background on `thank-you.php`. 1900 × 1425, the only image loaded eagerly |
| `ambience/magstim-coil.jpg` | `coil` | "How it works" — a patient with the Magstim coil in position. 1400 × 787 |
| `tms-session.jpg` | `session` | "A session" — a patient reclined in the chair with the coil in position. 533 × 400 |
| `ambience/evaluation.jpg` | `evaluation` | "Is TMS for me?" — a clinician listening during a consultation |
| `ambience/why-patient-trust-us.webp` | `care` | Hero card, and the last tile of the practice rail |
| `ambience/inter-a-2.webp` | `chair` | Practice rail — our Magstim chair and stimulator |
| `ambience/inter-a-1.webp` | `room` | Practice rail — a treatment room |
| `ambience/inter-a-3.png` | `reception` | Practice rail — the front desk |

**The hero is bright, and the overlays are tuned to it.** Unlike the Spravato and
medication heroes, this photograph has no dark ground of its own — the two overlay
layers in the hero markup run heavier (`bg-brand-950/70` plus a
`from-brand-950/80 via-brand-950/55 to-brand-950/65` gradient) so the cream headline and
the `/50`-opacity stat captions stay legible. **Swapping the hero image means re-tuning
those two numbers**, or the lower-left copy washes out against the photo.

**`tms-session.jpg` is deliberately cropped, and the framing is constrained.** The
source (`public/wp-content/uploads/2025/04/Magstim-TMS-Clinical-Treatment-Service.jpg`,
1920 × 1080) carries a large Magstim watermark over its bottom-right quadrant. The
watermark is a circle whose leftmost point sits at roughly (1158, 930); it curves up and
to the right, passing (1216, 700), (1287, 600) and (1417, 500). A translucent `m`
letterform starts near x≈1265, y≈760. **The higher the crop's bottom edge, the further
right it may extend** — that circle is the only thing setting the right limit.

The patient's head and the coil sit at x≈1050–1140, so the usable margin to her right is
small at any bottom edge below y≈800. **She cannot be placed dead-centre in a frame that
also keeps the chair**: centring her head would need as much empty space to her right as
her body occupies to her left, and the watermark owns all of it.

The current crop is `sips -c 400 533 --cropOffset 380 642` — the box x 642–1175,
y 380–780 — which puts her a little right of centre with the chair, her hands and the
coil all inside the frame, and clears the arc by roughly 10 px at the bottom-right
corner. It is small (533 px) because the framing, not the source, is the limit; the slot
renders at about 534 CSS px, so it is a 1× image rather than the 1.5× the old crop gave.

Earlier cuts, all of which left her head jammed against the right edge:
`-c 608 810 --cropOffset 295 355`, `-c 800 1060 --cropOffset 230 55` and
`-c 701 935 --cropOffset 322 178`. If you re-crop, keep the bottom-right corner clear of
the arc and check that corner in the result.

**Why the ambience photos live in a small rail:** these practice sources top out at
680 px wide, and `inter-a-3.png` is only 141 × 176. At the rail's tile size (11.5–13.5 rem)
they stay sharp; in a full-width grid they would visibly upscale. If you re-shoot the
practice at 1200 px or wider, the rail can become a proper grid.

## Insurance carrier logos — `insurance/`

A carrier listed in `$insurers` without a matching file still renders, as a plain
wordmark tile, so the wall never shows a gap. The same list also populates the "Your
insurance" dropdown in the eligibility form.

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
  identifiable patient without written authorisation. The Magstim frames are vendor
  marketing photography of models.
- **`ambience/magstim-coil.jpg` and `tms-session.jpg` are Magstim's own marketing
  photography**, taken from magstim.com (`Magstim-TMS-Horizon-Inspire-4.jpg` and
  `Magstim-TMS-Clinical-Treatment-Service.jpg`). Manufacturers generally allow customers
  to use product imagery, but that permission is worth confirming with your Magstim rep
  and keeping on file. If it is ever withdrawn, both slots fall back cleanly to their
  Unsplash ids.
