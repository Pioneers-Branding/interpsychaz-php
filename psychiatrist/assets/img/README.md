# Image assets — Psychiatrist landing page

Every photo is declared once, in the `$IMG` array near the top of `index.php`;
team headshots are declared separately in `$team` and resolved by `$teamImg()`.
Files are cache-busted by modification time, so replacing a file takes effect on the
next page load — no code change needed.

Asset URLs are built against `$BASE`, the URL path the folder is served from, so the
page renders correctly at `/psychiatrist`, `/psychiatrist/`, or with the folder's
contents deployed at the domain root. **If you rename the folder, nothing needs
changing** — `$BASE` follows it. Unlike `medication/` and `tms/`, this folder name
collides with nothing in the site root, so it could safely be renamed to `psychiatry/`
if that reads better in ads.

## Brand lockups

| File | Used for |
|---|---|
| `interpsychaz-logo.webp` | White lockup — footer, confirmation page, and the header while it floats over the hero |
| `interpsychaz-logo-dark.webp` | Indigo (`#262858`) recolour — header once scrolled onto light backgrounds |
| `favicon-32.png`, `favicon-180.png` | Browser tab and iOS home-screen icon |

## Photography

| File | Slot | Where it appears |
|---|---|---|
| `ambience/hero-consult.jpg` | `hero` | Hero background, and the fixed background on `thank-you.php`. 1900 px wide, the only image loaded eagerly |
| `ambience/why-patient-trust-us.webp` | `care` | "What we treat" figure, and the last tile of the practice rail |
| `ambience/inter-a-3.png` | `reception` | Practice rail — the front desk |
| `ambience/inter-a-1.webp` | `room` | Practice rail — a treatment room |
| `ambience/inter-a-2.webp` | `chair` | Practice rail — the TMS room |

**The hero is a high-key photograph, and the overlays are tuned to it.** It is much
brighter than the Spravato, medication or TMS heroes, so both overlay layers run heavy
(`bg-brand-950/75` plus a `from-brand-950/90 via-brand-950/50 to-brand-950/70` gradient)
and the photo reads as texture behind the headline. **Swapping the hero means re-tuning
those two values**, or the cream headline washes out.

> Use only Tailwind's standard opacity steps here (…/70, /75, /80, /90). An earlier
> revision used `/72` and `/82`; the Play CDN did not emit them and the hero rendered
> almost unshaded, with the headline illegible over the photograph.

## Team headshots — `team/`

| File | Person |
|---|---|
| `gomez.jpg` | Gerhard Gómez, M.D. — Adult Interventional Psychiatrist |
| `jacobson.jpg` | Michael Jacobson, PA-C — Physician Assistant |
| `nina-gomez.jpg` | Nina Gómez, DNP-PMHNP — Psychiatric Nurse Practitioner |
| `cruz.jpg` | Jessica Cruz, PMHNP — Psychiatric Mental Health Nurse Practitioner |

Sourced from `meet-our-team.php`, mapped to people by the order that page lists them
(`Jess-Cruz-headshot.jpg` confirms the mapping). Rendered at `aspect-square` from `sm`
up with `object-top`, so a portrait crop keeps the face in frame. They are square-ish
and around 700 px — replace like for like, and **check the name-to-face mapping after
any swap**, because these are real, named clinicians.

A person in `$team` whose headshot file is missing still renders — the card simply
drops the image and keeps the name, role, bio and tags.

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
- Alt text lives beside each slot in the `$IMG` array in `index.php`; headshot alt text
  is generated from the person's name and role. Update it when a photo changes.
- Every slot has a real file, so the page makes no external image request. Each `$IMG`
  slot still names an Unsplash fallback id in case a file goes missing.
- Filenames must not contain spaces.
- Patient-facing photography should use models or consented photos — never an
  identifiable patient without written authorisation.
