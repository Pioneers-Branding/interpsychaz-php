<?php
$pageTitle = 'Phoenix Psychiatry Testimonials | Interventional Psychiatry of Arizona';
$bodyClass = 'wp-singular page-template-default page page-id-160';
$pageDescription = 'Phoenix Psychiatry Testimonials - After working with my Psychologist and Psychiatrist for over 2 months, they’ve recommended I undergo ECT (in addition to the medications that I’m';
$pageOgImage = '/wp-content/uploads/2025/03/az-logo-white.png.png.webp';
$pageOgType = 'article';
$pageCanonical = 'https://interpsychaz.com/testimonials/';
$hideVisitUs = false;
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';
?>

<div class="clear"></div>
<div class="single" id="page">
<section class="page-header">
<div class="container">
<h1 class="page-title">Phoenix Psychiatry Testimonials</h1>
</div>
</section>
<article class="article">
<div id="content_box">
<div class="g post post-161 page type-page status-publish" id="post-161">
<div class="single_page">
<div class="post-content">
<style>
.testimonial-slideshow-section {
    padding: 60px 0;
    background: #fbf9f6;
    border-radius: 24px;
    margin: 40px 0;
    box-shadow: 0 10px 40px rgba(0,0,0,0.03);
}
.testimonial-slideshow-header {
    text-align: center;
    margin-bottom: 40px;
}
.testimonial-slideshow-header h2 {
    font-size: clamp(32px, 5vw, 48px);
    color: #262858;
    margin-bottom: 16px;
    font-weight: 700;
}
.testimonial-slideshow-header p {
    color: #606074;
    font-size: 18px;
    max-width: 600px;
    margin: 0 auto;
}
.testimonial-slider-container {
    position: relative;
    max-width: 900px;
    margin: 0 auto;
    overflow: hidden;
    padding: 20px;
}
.testimonial-track {
    display: flex;
    transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1);
    align-items: stretch;
}
.testimonial-slide {
    flex: 0 0 100%;
    box-sizing: border-box;
    padding: 0 20px;
    opacity: 0;
    transition: opacity 0.5s ease;
}
.testimonial-slide.active {
    opacity: 1;
}
.testimonial-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 12px 30px rgba(38, 40, 88, 0.08);
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    border: 1px solid rgba(222, 222, 229, 0.5);
}
.testimonial-quote-icon {
    position: absolute;
    top: 30px;
    left: 30px;
    font-size: 60px;
    color: rgba(189, 109, 50, 0.1);
    line-height: 1;
    font-family: Georgia, serif;
}
.testimonial-content {
    font-size: 18px;
    line-height: 1.8;
    color: #45455c;
    margin-bottom: 30px;
    position: relative;
    z-index: 1;
}
.testimonial-author {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-top: auto;
}
.author-avatar {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #262858, #3a3d7a);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: bold;
}
.author-info h4 {
    margin: 0;
    font-size: 18px;
    color: #262858;
}
.author-info .stars {
    color: #ad5e19;
    letter-spacing: 2px;
    font-size: 14px;
    margin-top: 4px;
}
.slider-controls {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-top: 40px;
}
.slider-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid #262858;
    background: transparent;
    color: #262858;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}
.slider-btn:hover {
    background: #262858;
    color: white;
}
.slider-dots {
    display: flex;
    gap: 10px;
}
.slider-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #dedee5;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease;
    padding: 0;
}
.slider-dot.active {
    background: #bd6d32;
    transform: scale(1.2);
}

@media(max-width: 768px) {
    .testimonial-card {
        padding: 30px 20px;
    }
    .testimonial-content {
        font-size: 16px;
    }
}
</style>

<div class="container">
    <div class="testimonial-slideshow-section">
        <div class="testimonial-slideshow-header">
            <h2>Patient Success Stories</h2>
            <p>Read what our patients have to say about their journey to better mental health with Interventional Psychiatry of Arizona.</p>
        </div>
        
        <div class="testimonial-slider-container">
            <div class="testimonial-track" id="testimonialTrack">
                
                <!-- Slide 1 -->
                <div class="testimonial-slide active">
                    <div class="testimonial-card">
                        <div class="testimonial-quote-icon">“</div>
                        <div class="testimonial-content">
                            <p>After working with my Psychologist and Psychiatrist for over 2 months, they’ve recommended I undergo ECT (in addition to the medications that I’m prescribed). My Psychiatrist heard of Interventional Psychiatry of Arizona and said they were a good option.</p>
                            <p>Dr. Gomez was able to see me quickly for a Psychiatric Evaluation. We determined that I have a strong case to undergo ECT treatment. The Dr. was very thorough and educational, especially regarding the beneficial impacts of ECT. There was plenty of time to ask any questions I had.</p>
                            <p>I left with all questions answered and I have a general time frame for the insurance process, before we can begin treatment. Thank you for the professional and expedient service!</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">S</div>
                            <div class="author-info">
                                <h4>Sam</h4>
                                <div class="stars">★★★★★</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-quote-icon">“</div>
                        <div class="testimonial-content">
                            <p>Very professional and really care about making you better. Will use them again even its 30 miles away from home!</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">D</div>
                            <div class="author-info">
                                <h4>Dominick</h4>
                                <div class="stars">★★★★★</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-quote-icon">“</div>
                        <div class="testimonial-content">
                            <p>My experience was great and I look forward to seeing how everything comes together for relief.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">S</div>
                            <div class="author-info">
                                <h4>Shannon</h4>
                                <div class="stars">★★★★★</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-quote-icon">“</div>
                        <div class="testimonial-content">
                            <p>Seeing Dr. Gomez has really made a difference in helping me stay stable with my bipolar disorder. If I tend to be slipping, he is able to see that and suggest that I take a closer look at what is happening and has me make the suggestions on how to correct what is going on. Personally for me and my family, He has been a life saver.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">C</div>
                            <div class="author-info">
                                <h4>Carol</h4>
                                <div class="stars">★★★★★</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-quote-icon">“</div>
                        <div class="testimonial-content">
                            <p>Dr. Gomez is amazing! I can’t say enough nice things about him and his staff. I wish there were more doctors like him. He truly has the patient’s best interest in mind with every decision he makes about your care.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">M</div>
                            <div class="author-info">
                                <h4>Michael</h4>
                                <div class="stars">★★★★★</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 6 -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-quote-icon">“</div>
                        <div class="testimonial-content">
                            <p>Dr Gomez is an Amazing caring doctor. My mother has been seeing him for her depression for about 3 years. She is a happy person again.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">E</div>
                            <div class="author-info">
                                <h4>ET</h4>
                                <div class="stars">★★★★★</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 7 -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-quote-icon">“</div>
                        <div class="testimonial-content">
                            <p>I had a great experience with Dr. Gomez. He was kind, patient, and compassionate to my care. He took the time to address all my concerns. I am very pleased.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">A</div>
                            <div class="author-info">
                                <h4>Anonymous</h4>
                                <div class="stars">★★★★★</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="slider-controls">
                <button class="slider-btn prev-btn" aria-label="Previous Testimonial">&#8592;</button>
                <div class="slider-dots" id="sliderDots"></div>
                <button class="slider-btn next-btn" aria-label="Next Testimonial">&#8594;</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('testimonialTrack');
    const slides = document.querySelectorAll('.testimonial-slide');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const dotsContainer = document.getElementById('sliderDots');
    
    let currentIndex = 0;
    const totalSlides = slides.length;
    
    // Create dots
    slides.forEach((_, index) => {
        const dot = document.createElement('button');
        dot.classList.add('slider-dot');
        if (index === 0) dot.classList.add('active');
        dot.setAttribute('aria-label', `Go to slide ${index + 1}`);
        dot.addEventListener('click', () => goToSlide(index));
        dotsContainer.appendChild(dot);
    });
    
    const dots = document.querySelectorAll('.slider-dot');
    
    function updateSlider() {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
        
        // Update active class on slides
        slides.forEach((slide, index) => {
            if (index === currentIndex) {
                slide.classList.add('active');
            } else {
                slide.classList.remove('active');
            }
        });
        
        // Update dots
        dots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }
    
    function goToSlide(index) {
        currentIndex = index;
        updateSlider();
    }
    
    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    }
    
    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlider();
    }
    
    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);
    
    // Auto-advance
    let autoPlayInterval = setInterval(nextSlide, 8000);
    
    // Pause on hover
    const sliderContainer = document.querySelector('.testimonial-slider-container');
    sliderContainer.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
    sliderContainer.addEventListener('mouseleave', () => {
        autoPlayInterval = setInterval(nextSlide, 8000);
    });
});
</script>
</article>
<?php require __DIR__ . '/includes/patient-video-slider.php'; ?>
<!--< ?php get_sidebar(); ?>-->
</div><!--#page-->

<?php
require_once __DIR__ . '/includes/footer.php';
?>

