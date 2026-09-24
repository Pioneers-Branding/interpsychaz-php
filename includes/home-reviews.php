<style>
.home-reviews { padding: 60px 0; background: #fbf9f6; color: #262858; }
.home-reviews .home-reviews-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 24px; margin-bottom: 28px; }
.home-reviews .home-reviews-eyebrow { font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: .12em; color: #a74b20; margin: 0 0 10px; }
.home-reviews h2 { font-size: clamp(28px, 4vw, 42px); line-height: 1.2; margin: 0 0 12px; }
.home-reviews-header p { margin: 0; }
.home-reviews-controls { display: flex; gap: 10px; flex-shrink: 0; }
.home-reviews-controls button { width: 44px; height: 44px; border: 1px solid #262858; border-radius: 50%; color: #262858; background: white; padding: 0; font-size: 22px; cursor: pointer; }
.home-reviews-controls button:disabled { opacity: .35; cursor: default; }
.home-review-track { display: flex; gap: 24px; overflow-x: auto; scroll-snap-type: x mandatory; align-items: flex-start; padding: 4px 2px 18px; }
.home-reviews .home-review-card { box-sizing: border-box; flex: 0 0 calc((100% - 48px) / 3); min-width: 0; margin: 0; padding: 26px; border: 1px solid #dedee5; border-radius: 20px; background: white; scroll-snap-align: start; overflow-wrap: anywhere; }
.home-review-author { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
.home-review-avatar { display: grid; place-items: center; flex-shrink: 0; width: 44px; height: 44px; border-radius: 50%; background: #eeedf5; font-weight: bold; }
.home-reviews .home-review-author h3 { margin: 0; font-size: 18px; line-height: 1.4; }
.home-review-stars { color: #ad5e19; letter-spacing: 2px; font-size: 16px; }
.home-reviews .home-review-card p, .home-reviews .home-review-card blockquote { font-size: 16px; line-height: 1.7; color: #45455c; padding: 0; margin: 0; border: 0; background: none; font-style: normal; }
.home-reviews .home-review-card blockquote::before, .home-reviews .home-review-card blockquote::after { content: none; }
.home-review-full { margin-top: 16px; }
.home-review-full summary { cursor: pointer; color: #262858; text-decoration: underline; font-weight: 600; }
.home-reviews .home-review-full blockquote { margin-top: 16px; }
.home-review-card:has(details[open]) .home-review-excerpt { display: none; }
.home-review-full .review-less, .home-review-full[open] .review-more { display: none; }
.home-review-full[open] .review-less { display: inline; }
.home-reviews .home-reviews-note { font-size: 13px; margin: 18px 0 0; color: #606074; }
.review-sr-only { position: absolute; width: 1px; height: 1px; padding: 0; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; }
.home-reviews button:focus-visible, .home-review-track:focus-visible, .home-review-full summary:focus-visible { outline: 3px solid #bd6d32; outline-offset: 4px; }
@media(max-width: 1000px) { .home-reviews .home-review-card { flex-basis: calc((100% - 24px) / 2); } }
@media(max-width: 600px) {
 .home-reviews { padding: 40px 0; }
 .home-reviews .home-reviews-header { align-items: flex-start; flex-direction: column; gap: 18px; }
 .home-reviews .home-review-card { flex-basis: 90%; padding: 22px; }
}
</style>
<section class="home-reviews" aria-labelledby="home-reviews-heading">
  <div class="container">
    <div class="home-reviews-header">
      <div>
        <p class="home-reviews-eyebrow">Patient and colleague reviews</p>
        <h2 id="home-reviews-heading">In their own words</h2>
        <p>Read what patients and fellow clinicians have shared about our practice.</p>
      </div>
      <div class="home-reviews-controls">
        <button type="button" data-review-direction="-1" aria-label="Previous reviews" aria-controls="home-review-track">&#8592;</button>
        <button type="button" data-review-direction="1" aria-label="Next reviews" aria-controls="home-review-track">&#8594;</button>
      </div>
    </div>
    <div id="home-review-track" class="home-review-track" role="region" aria-label="Practice reviews" tabindex="0">
      <article class="home-review-card">
        <div class="home-review-author"><span class="home-review-avatar" aria-hidden="true">S</span><div><h3>Shannon H.</h3><span class="home-review-stars" aria-label="5 out of 5 stars">★★★★★</span></div></div>
        <p class="home-review-excerpt">As a psychologist, I have collaborated and consulted with Dr. Gomez for the last couple of years. Dr. Gomez approaches his work with empathy and dedication. He takes the time to try to understand his…</p>
        <details class="home-review-full">
          <summary><span class="review-more">Read full review</span><span class="review-less">Show less</span><span class="review-sr-only"> by Shannon H.</span></summary>
          <blockquote>As a psychologist, I have collaborated and consulted with Dr. Gomez for the last couple of years. Dr. Gomez approaches his work with empathy and dedication. He takes the time to try to understand his patients' experiences and works with other professionals to ensure patients receive the best possible care and outcomes. I am very appreciative of his knowledge, experience and perspectives.</blockquote>
        </details>
      </article>
      <article class="home-review-card">
        <div class="home-review-author"><span class="home-review-avatar" aria-hidden="true">J</span><div><h3>John F.</h3><span class="home-review-stars" aria-label="5 out of 5 stars">★★★★★</span></div></div>
        <blockquote>Very thoughtful and considerate. Knowledgeable and good communication.</blockquote>
      </article>
      <article class="home-review-card">
        <div class="home-review-author"><span class="home-review-avatar" aria-hidden="true">M</span><div><h3>Mandie M.</h3><span class="home-review-stars" aria-label="5 out of 5 stars">★★★★★</span></div></div>
        <p class="home-review-excerpt">As a fellow psychiatric provider in the community, we get to know other local providers very well, and I cannot recommend Dr. Gomez highly enough. He has been the most thorough, careful,…</p>
        <details class="home-review-full">
          <summary><span class="review-more">Read full review</span><span class="review-less">Show less</span><span class="review-sr-only"> by Mandie M.</span></summary>
          <blockquote>As a fellow psychiatric provider in the community, we get to know other local providers very well, and I cannot recommend Dr. Gomez highly enough. He has been the most thorough, careful, compassionate, and evidence-based colleague I have been fortunate enough to meet here in the valley. I have referred scores of patients to him for his specialized interventions, such as TMS, Spravato (esketamine), and even ECT, and he has always taken exceptional care of our mutual patients. I would refer family and friends to Dr. Gomez without hesitation, and I have even referred patients needing a higher level of care than I can provide. I am honored to call Dr. Gomez a colleague, and I feel he elevates the reputation of psychiatrists as a whole.</blockquote>
        </details>
      </article>
      <article class="home-review-card">
        <div class="home-review-author"><span class="home-review-avatar" aria-hidden="true">J</span><div><h3>Janet C.</h3><span class="home-review-stars" aria-label="5 out of 5 stars">★★★★★</span></div></div>
        <p class="home-review-excerpt">I feel fortunate and blessed to have found Dr. Gomez’s practice. He is genuinely concerned about helping me improve my mental health. I am receiving TMS therapy. Today was my 13th visit, and I began…</p>
        <details class="home-review-full">
          <summary><span class="review-more">Read full review</span><span class="review-less">Show less</span><span class="review-sr-only"> by Janet C.</span></summary>
          <blockquote>I feel fortunate and blessed to have found Dr. Gomez’s practice. He is genuinely concerned about helping me improve my mental health. I am receiving TMS therapy. Today was my 13th visit, and I began noticing positive results the first week. Noemi, the TMS technician is awesome. She also is genuinely concerned about providing the best treatments. I would highly recommend this practice if you are struggling with your mental health.</blockquote>
        </details>
      </article>
      <article class="home-review-card">
        <div class="home-review-author"><span class="home-review-avatar" aria-hidden="true">A</span><div><h3>Alex C.</h3><span class="home-review-stars" aria-label="5 out of 5 stars">★★★★★</span></div></div>
        <blockquote>After 4 weeks my depression is going away! I had suicidal depression for the last year. Now I have hope!</blockquote>
      </article>
    </div>
    <p class="home-reviews-note">Reviews reflect individual experiences and are not a guarantee of treatment results.</p>
  </div>
</section>
<script>
(() => {
  const track = document.getElementById('home-review-track');
  if (!track) return;
  const buttons = track.closest('.home-reviews').querySelectorAll('[data-review-direction]');
  const update = () => {
    buttons[0].disabled = track.scrollLeft <= 2;
    buttons[1].disabled = track.scrollLeft >= track.scrollWidth - track.clientWidth - 2;
  };
  const move = direction => {
    const card = track.querySelector('.home-review-card');
    track.scrollBy({left: direction * (card.getBoundingClientRect().width + parseFloat(getComputedStyle(track).gap)),
      behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth'});
  };
  buttons.forEach(button => button.addEventListener('click', () => move(Number(button.dataset.reviewDirection))));
  track.addEventListener('keydown', event => {
    if (event.target !== track || !['ArrowLeft', 'ArrowRight'].includes(event.key)) return;
    event.preventDefault();
    move(event.key === 'ArrowRight' ? 1 : -1);
  });
  track.addEventListener('scroll', update, {passive: true});
  window.addEventListener('resize', update);
  update();
})();
</script>
