<style>
.patient-video-slider .gumlet-video-grid {
    display: flex;
    flex-wrap: nowrap;
    gap: 24px;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    padding-bottom: 14px;
}
.patient-video-slider .gumlet-video-frame {
    flex: 0 0 calc((100% - 48px) / 3);
    min-width: 0;
    max-width: 420px;
    aspect-ratio: 16 / 9;
    scroll-snap-align: start;
    border-radius: 12px;
}
.patient-video-controls { display: flex; justify-content: flex-end; gap: 10px; margin-bottom: 16px; }
.patient-video-controls button {
    width: 44px; height: 44px; border-radius: 50%; border: 1px solid #243e50;
    background: #fff; color: #243e50; cursor: pointer; font-size: 22px; padding: 0;
}
.patient-video-controls button:disabled { opacity: .35; cursor: default; }
.patient-video-controls button:focus-visible,
.patient-video-slider .gumlet-video-grid:focus-visible { outline: 3px solid #bd6d32; outline-offset: 3px; }
@media (max-width: 1000px) {
    .patient-video-slider .gumlet-video-frame { flex-basis: calc((100% - 24px) / 2); }
}
@media (max-width: 600px) {
    .patient-video-slider .gumlet-video-frame { flex-basis: 88%; }
}
</style>
	<section class="gumlet-video-section patient-video-slider">
		<div class="container">
			<h2>Hear From Our Patients</h2>
			<div class="patient-video-controls">
                <button type="button" data-video-direction="-1" aria-label="Previous patient videos" aria-controls="patient-video-track">&#8592;</button>
                <button type="button" data-video-direction="1" aria-label="Next patient videos" aria-controls="patient-video-track">&#8594;</button>
            </div>
            <div class="gumlet-video-grid" id="patient-video-track" tabindex="0" role="region" aria-label="Patient testimonial videos">
                <div class="gumlet-video-frame">
                    <iframe loading="lazy" title="Featured patient video testimonial"
                        src="https://play.gumlet.io/embed/6ab419de6cc97c47e4fb1b3e?background=false&amp;autoplay=false&amp;loop=false&amp;disable_player_controls=true"
                        referrerpolicy="origin"
                        allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture; fullscreen; clipboard-write;"
                        allowfullscreen></iframe>
                </div>
				<div class="gumlet-video-frame">
					<iframe loading="lazy" title="Gumlet video player"
						src="https://play.gumlet.io/embed/6ab227f48a8d9ca7fc02a20f"
						referrerpolicy="origin"
						allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture; fullscreen; clipboard-write;"></iframe>
				</div>
				<div class="gumlet-video-frame">
					<iframe loading="lazy" title="Gumlet video player"
						src="https://play.gumlet.io/embed/6ab227f48a8d9ca7fc02a210"
						referrerpolicy="origin"
						allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture; fullscreen; clipboard-write;"></iframe>
				</div>
				<div class="gumlet-video-frame">
					<iframe loading="lazy" title="Gumlet video player"
						src="https://play.gumlet.io/embed/6ab227442394588e66b49ee3"
						referrerpolicy="origin"
						allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture; fullscreen; clipboard-write;"></iframe>
				</div>
			</div>
		</div>
	</section>
<script>
(() => {
    const track = document.getElementById('patient-video-track');
    if (!track) return;
    const section = track.closest('.patient-video-slider');
    const buttons = section.querySelectorAll('[data-video-direction]');
    const update = () => {
        buttons[0].disabled = track.scrollLeft <= 2;
        buttons[1].disabled = track.scrollLeft >= track.scrollWidth - track.clientWidth - 2;
    };
    buttons.forEach(button => button.addEventListener('click', () => {
        const card = track.querySelector('.gumlet-video-frame');
        const step = card.getBoundingClientRect().width + parseFloat(getComputedStyle(track).gap);
        track.scrollBy({ left: Number(button.dataset.videoDirection) * step,
            behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
    }));
    track.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
})();
</script>
