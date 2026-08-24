<?php if(!isset($hideVisitUs) || !$hideVisitUs): ?>
<section class="visit-us-today">
<div class="container">
<div class="dm-flex">
<div class="dm-half">
<h2>Come Visit Us</h2>
<div class="gform_wrapper gform_wrapper_2" id="gform_wrapper_2" data-form-id="2">
<div class="gform_anchor" id="gf_2"></div>
<form method="post" enctype="multipart/form-data" id="gform_2" action="/thank-you/">
<div class="gform_body gform-body gform_fields">
<div class="gform_field gform_field gfield" id="field_2_1">
<label class="gfield_label gform-field-label" for="input_2_1">Name <span class="gfield_required">*</span></label>
<div class="ginput_container ginput_container_text"><input name="input_1" id="input_2_1" type="text" value="" class="medium" tabindex="5" placeholder="Enter Name" required="required"/></div>
</div>
<div class="gform_field gform_field gfield" id="field_2_2">
<label class="gfield_label gform-field-label" for="input_2_2">Phone <span class="gfield_required">*</span></label>
<div class="ginput_container ginput_container_phone"><input name="input_2" id="input_2_2" type="tel" value="" class="medium" tabindex="6" placeholder="Enter Phone" required="required"/></div>
</div>
<div class="gform_field gform_field gfield" id="field_2_3">
<label class="gfield_label gform-field-label" for="input_2_3">Email <span class="gfield_required">*</span></label>
<div class="ginput_container ginput_container_email"><input name="input_3" id="input_2_3" type="email" value="" class="medium" tabindex="7" placeholder="Enter Email" required="required"/></div>
</div>
<div class="gform_field gform_field gfield" id="field_2_4">
<label class="gfield_label gform-field-label" for="input_2_4">Message</label>
<div class="ginput_container ginput_container_textarea"><textarea name="input_4" id="input_2_4" class="textarea medium" tabindex="8" rows="5" cols="50" placeholder="Enter Message"></textarea></div>
</div>
<div class="gform_field gform_field gfield" id="field_2_5">
<label class="gfield_label gform-field-label">Reason for Inquiry <span class="gfield_required">*</span></label>
<div class="ginput_container ginput_container_select">
<select name="input_5[]" id="input_2_5" multiple="multiple" class="medium gfield_select" tabindex="9">
<option value="General Inquiry">General Inquiry</option>
<option value="New Patient">New Patient</option>
<option value="TMS">TMS</option>
<option value="Spravato">Spravato</option>
<option value="Medication Management">Medication Management</option>
<option value="ECT">ECT</option>
</select>
</div>
</div>
<div class="gform_field gform_field gfield" id="field_2_6">
<label class="gfield_label gform-field-label">SMS Opt-in</label>
<div class="ginput_container ginput_container_radio">
<span class="gfield_radio gform-field-radio"><input type="radio" name="input_6" value="Yes" id="choice_2_6_0" tabindex="10"/><label for="choice_2_6_0" class="gfield_radio_label">Yes</label><input type="radio" name="input_6" value="No" id="choice_2_6_1" tabindex="11" checked="checked"/><label for="choice_2_6_1" class="gfield_radio_label">No</label></span>
</div>
</div>
</div>
<div class="gform_footer">
<input type="submit" id="gform_submit_button_2" class="gform_button button" value="Send Message" tabindex="12"/>
</div>
<div style="display:none"><input type="hidden" name="gform_unique_id" value=""/><input type="hidden" name="state_2" value="WyJhNjYsImEzNDNiNDlhNjE0MGJlMTg0MjE4ZjFlN2I4OTY2NTgiXQ=="/><input type="hidden" name="gform_target_page_number_2" value="0"/><input type="hidden" name="gform_source_page_number_2" value="0"/><input type="hidden" name="gform_target_page_number_2" value="0"/><input type="hidden" name="gform_source_page_number_2" value="0"/><input type="hidden" name="gform_confirmation_callback_2" value=""/></div>
</form>
</div>
</div>
<div class="dm-half">
<iframe allowfullscreen="" height="450" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3326.823582626749!2d-112.03820942507127!3d33.505966773367575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x872b0dfeafc5cab7%3A0x53193372ee4a5f6c!2sInterventional%20Psychiatry%20of%20Arizona!5e0!3m2!1sen!2sin!4v1762937676279!5m2!1sen!2sin" style="border:0;" width="100%"></iframe>
</div>
</div>
</div>
</section>
<?php endif; ?>
<footer id="site-footer" itemscope="" itemtype="http://schema.org/WPFooter" role="contentinfo">
<div class="copyrights">
<div class="dm-ff mmn">
<div class="container">
<div class="dm-h">
<div class="footer-logo-wrap">
<a href="/"><img alt="<?php echo SITE_NAME; ?>" src="/wp-content/uploads/2025/03/az-logo-white.png.png.webp"/></a>
</div>
</div>
<div class="dm-h">
<a class="btn" href="/appointments/"> <i aria-hidden="true" class="fa fa-calendar"></i> Request an Appointment </a> <br/>
<p>If you or a loved one is having a behavioral health crisis hotline <?php echo CRISIS_HOTLINE; ?>.
						</p>
</div>
</div>
</div>
<div class="dm-flex">
<div class="dm-fourth">
<h3>
        				Social
        			</h3>
<div class="social-icons">
<a class="header-facebook" href="<?php echo FACEBOOK_URL; ?>" target="_blank">
<span class="fa fa-facebook"></span>
</a>
<a class="header-google" href="<?php echo GOOGLE_MAPS_RATING; ?>" target="_blank">
<span class="fa fa-google"></span>
</a>
<a class="header-linkedin" href="<?php echo LINKEDIN_URL; ?>" target="_blank">
<span class="fa fa-linkedin"></span>
</a>
<a class="header-instagram" href="<?php echo INSTAGRAM_URL; ?>" target="_blank">
<span class="fa fa-instagram"></span>
</a>
</div>
</div>
<div class="dm-fourth">
<h3> Office Hours </h3>
<div class="footer-hours">
<p>Mon-Fri: 8am-5pm<br/>
Sat, Sun: Closed</p>
</div>
</div>
<div class="dm-fourth">
<h3>
        				Contact Us
        			</h3>
<p>
<a href="<?php echo GOOGLE_MAPS_OFFICE; ?>" target="_blank"> <?php echo SITE_ADDRESS; ?></a> </p>
<p> Phone: <a href="tel:<?php echo SITE_PHONE_RAW; ?>"> <?php echo SITE_PHONE; ?> </a>
</p>
</div>
</div>
<div class="dm-full footer-creds">
<div class="container">
</div>
</div>
</div>
</footer>
</div>
<!--Start of Tawk.to Script-->
<script>
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/<?php echo TAWK_ID; ?>';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<div aria-labelledby="dmm-cg-title" class="dmm-cg dmm-cg--notice" hidden="" id="dmm-cg" role="region">
<div class="dmm-cg__panel">
<div class="dmm-cg__notice">
<div class="dmm-cg__notice-copy">
<h2 class="dmm-cg__title" id="dmm-cg-title">This site uses tracking technologies</h2>
<p class="dmm-cg__body">
							We and the services embedded in this site — analytics, advertising, booking, maps and translation — collect information about your visit, including your IP address, your browser and the pages you view. Some of that information is shared with those companies. This happens as you browse.															<a class="dmm-cg__inline-link" href="/privacy-policy/#cookies">Read our Privacy Policy</a>.
													</p>
</div>
<div class="dmm-cg__actions dmm-cg__actions--single">
<button class="dmm-cg__btn dmm-cg__btn--primary" data-dmm-action="acknowledge" type="button">I understand</button>
</div>
</div>
</div>
</div>
<div class="dmm-cg-footer">
<button class="dmm-cg-open dmm-cg-open--inline" type="button">Cookie settings</button>
</div>
<div class="cta_fixed_button"><a class="sticks" href="tel:<?php echo SITE_PHONE_RAW; ?>" onclick="ga('send', 'event', { eventCategory: 'Mobile', eventAction: 'Call Us', eventValue: 25});"> <i class="fa fa-phone"></i> Call Us </a><a class="sticks" href="sms:<?php echo SITE_PHONE_RAW; ?>"> <i class="fa fa-envelope"></i> Text Us </a></div><div class="move_down"></div> <div class="wda-access-toolbar"><div class="wda-toolbar-toggle-link"><svg fill="currentColor" viewbox="0 0 100 100" width="1em" xmlns="http://www.w3.org/2000/svg"><title>Accessibility Tools</title><path d="M50 8.1c23.2 0 41.9 18.8 41.9 41.9 0 23.2-18.8 41.9-41.9 41.9C26.8 91.9 8.1 73.2 8.1 50S26.8 8.1 50 8.1M50 0C22.4 0 0 22.4 0 50s22.4 50 50 50 50-22.4 50-50S77.6 0 50 0zm0 11.3c-21.4 0-38.7 17.3-38.7 38.7S28.6 88.7 50 88.7 88.7 71.4 88.7 50 71.4 11.3 50 11.3zm0 8.9c4 0 7.3 3.2 7.3 7.3S54 34.7 50 34.7s-7.3-3.2-7.3-7.3 3.3-7.2 7.3-7.2zm23.7 19.7c-5.8 1.4-11.2 2.6-16.6 3.2.2 20.4 2.5 24.8 5 31.4.7 1.9-.2 4-2.1 4.7-1.9.7-4-.2-4.7-2.1-1.8-4.5-3.4-8.2-4.5-15.8h-2c-1 7.6-2.7 11.3-4.5 15.8-.7 1.9-2.8 2.8-4.7 2.1-1.9-.7-2.8-2.8-2.1-4.7 2.6-6.6 4.9-11 5-31.4-5.4-.6-10.8-1.8-16.6-3.2-1.7-.4-2.8-2.1-2.4-3.9.4-1.7 2.1-2.8 3.9-2.4 19.5 4.6 25.1 4.6 44.5 0 1.7-.4 3.5.7 3.9 2.4.7 1.8-.3 3.5-2.1 3.9z"></path></svg></div><div id="wda-toolbar"><h4>Accessibility Tools</h4><div class="wda-btn wda-btn-resize-plus"><svg version="1.1" viewbox="0 0 448 448" width="1em" xmlns="http://www.w3.org/2000/svg"><title>Increase Text</title><path d="M256 200v16c0 4.25-3.75 8-8 8h-56v56c0 4.25-3.75 8-8 8h-16c-4.25 0-8-3.75-8-8v-56h-56c-4.25 0-8-3.75-8-8v-16c0-4.25 3.75-8 8-8h56v-56c0-4.25 3.75-8 8-8h16c4.25 0 8 3.75 8 8v56h56c4.25 0 8 3.75 8 8zM288 208c0-61.75-50.25-112-112-112s-112 50.25-112 112 50.25 112 112 112 112-50.25 112-112zM416 416c0 17.75-14.25 32-32 32-8.5 0-16.75-3.5-22.5-9.5l-85.75-85.5c-29.25 20.25-64.25 31-99.75 31-97.25 0-176-78.75-176-176s78.75-176 176-176 176 78.75 176 176c0 35.5-10.75 70.5-31 99.75l85.75 85.75c5.75 5.75 9.25 14 9.25 22.5z"></path></svg>Increase Text</div><div class="wda-btn wda-btn-resize-minus"><svg version="1.1" viewbox="0 0 448 448" width="1em" xmlns="http://www.w3.org/2000/svg"><title>Decrease Text</title><path d="M256 200v16c0 4.25-3.75 8-8 8h-200c-4.25 0-8-3.75-8-8v-16c0-4.25 3.75-8 8-8h200c4.25 0 8 3.75 8 8zM288 208c0-61.75-50.25-112-112-112s-112 50.25-112 112 50.25 112 112 112 112-50.25 112-112zM416 416c0 17.75-14.25 32-32 32-8.5 0-16.75-3.5-22.5-9.5l-85.75-85.5c-29.25 20.25-64.25 31-99.75 31-97.25 0-176-78.75-176-176s78.75-176 176-176 176 78.75 176 176c0 35.5-10.75 70.5-31 99.75l85.75 85.75c5.75 5.75 9.25 14 9.25 22.5z"></path></svg>Decrease Text</div><div class="wda-btn wda-btn-highlight-links"><svg version="1.1" viewbox="0 0 448 448" width="1em" xmlns="http://www.w3.org/2000/svg"><title>Highlight Links</title><path d="M400 32H48C21.5 32 0 53.5 0 80v288c0 26.5 21.5 48 48 48h160v32H128v32h96h96v-32h-80v-32h160c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-16 256H64V80h320v208z" fill="currentColor"></path></svg>Highlight Links</div><div class="wda-btn wda-btn-readable-font"><svg version="1.1" viewbox="0 0 448 448" width="1em" xmlns="http://www.w3.org/2000/svg"><title>Readable Font</title><path d="M181.25 139.75l-42.5 112.5c24.75 0.25 49.5 1 74.25 1 4.75 0 9.5-0.25 14.25-0.5-13-38-28.25-76.75-46-113zM0 416l0.5-19.75c23.5-7.25 49-2.25 59.5-29.25l59.25-154 70-181h32c1 1.75 2 3.5 2.75 5.25l51.25 120c18.75 44.25 36 89 55 133 11.25 26 20 52.75 32.5 78.25 1.75 4 5.25 11.5 8.75 14.25 8.25 6.5 31.25 8 43 12.5 0.75 4.75 1.5 9.5 1.5 14.25 0 2.25-0.25 4.25-0.25 6.5-31.75 0-63.5-4-95.25-4-32.75 0-65.5 2.75-98.25 3.75 0-6.5 0.25-13 1-19.5l32.75-7c6.75-1.5 20-3.25 20-12.5 0-9-32.25-83.25-36.25-93.5l-112.5-0.5c-6.5 14.5-31.75 80-31.75 89.5 0 19.25 36.75 20 51 22 0.25 4.75 0.25 9.5 0.25 14.5 0 2.25-0.25 4.5-0.5 6.75-29 0-58.25-5-87.25-5-3.5 0-8.5 1.5-12 2-15.75 2.75-31.25 3.5-47 3.5z" fill="currentColor"></path></svg>Readable Font</div><div class="wda-btn wda-btn-reset-font"><svg height="682.66669" id="svg4641" version="1.1" viewbox="0 0 682.66669 682.66669" width="682.66669" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"><defs id="defs4645"><clippath clippathunits="userSpaceOnUse" id="clipPath4663"><path d="M 0,512 H 512 V 0 H 0 Z" id="path4661"></path></clippath></defs><g id="g4647" transform="matrix(1.3333333,0,0,-1.3333333,0,682.66667)"><g id="g4649" transform="translate(119.1121,241.7875)"><path d="M 0,0 27.157,-30.856" id="path4651" style="fill:none;stroke:#000;stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"></path></g><g id="g4653" transform="translate(111.3159,241.9036)"><path d="M 0,0 V -30.972" id="path4655" style="fill:none;stroke:#000;stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"></path></g></g></svg>Reset Font</div></div></div>
<script src="/wp-content/cache/min/1/wp-content/plugins/dmm-consent-guard/assets/js/banner.js?ver=1786719158" defer id="dmm-cg-banner-js"></script>
<script>
window.lazyLoadOptions=[{elements_selector:"img[data-lazy-src],.rocket-lazyload,iframe[data-lazy-src]",data_src:"lazy-src",data_srcset:"lazy-srcset",data_sizes:"lazy-sizes",class_loading:"lazyloading",class_loaded:"lazyloaded",threshold:300}];
</script>
<script async src="/wp-content/plugins/wp-rocket/assets/js/lazyload/17.8.3/lazyload.min.js"></script>
<script src="/wp-content/cache/min/1/wp-content/themes/mts_schema/js/owl.carousel.min.js" defer id="owl-carousel-js"></script>
<script src="/wp-content/cache/min/1/wp-content/themes/mts_schema/js/slick.js?ver=1782683147" defer id="slick-main-js"></script>
<!-- Responsive YouTube Video Player Init -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var players = document.querySelectorAll(".rll-youtube-player");
    players.forEach(function(player) {
        var videoId = player.getAttribute("data-id") || "";
        var dataSrc = player.getAttribute("data-src") || "";
        if (!videoId && dataSrc) {
            var parts = dataSrc.split('/');
            videoId = parts[parts.length - 1].split('?')[0];
        }
        if (!videoId) return;

        var query = player.getAttribute("data-query") || "";
        var embedUrl = dataSrc || ("https://www.youtube.com/embed/" + videoId);
        if (embedUrl.indexOf("http") !== 0) {
            embedUrl = "https://www.youtube.com/embed/" + videoId;
        }

        var altText = player.getAttribute("data-alt") || "Play Video";

        // Create thumbnail container
        player.innerHTML = "";
        
        var img = document.createElement("img");
        img.src = "https://i.ytimg.com/vi/" + videoId + "/hqdefault.jpg";
        img.alt = altText;
        img.loading = "lazy";

        var btn = document.createElement("button");
        btn.className = "play-btn";
        btn.setAttribute("type", "button");
        btn.setAttribute("aria-label", altText);

        player.appendChild(img);
        player.appendChild(btn);

        function loadVideo() {
            var iframe = document.createElement("iframe");
            var sep = embedUrl.indexOf("?") === -1 ? "?" : "&";
            var fullUrl = embedUrl + sep + "autoplay=1";
            if (query) {
                fullUrl += "&" + query.replace(/^\?/, "");
            }
            iframe.setAttribute("src", fullUrl);
            iframe.setAttribute("frameborder", "0");
            iframe.setAttribute("allowfullscreen", "1");
            iframe.setAttribute("allow", "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share");
            player.innerHTML = "";
            player.appendChild(iframe);
        }

        player.addEventListener("click", loadVideo);
    });
});

// Mobile Drawer Navigation Toggle
document.addEventListener("DOMContentLoaded", function() {
    var toggleBtns = document.querySelectorAll("#pull, .toggle-mobile-menu");
    toggleBtns.forEach(function(btn) {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            document.body.classList.toggle("mobile-menu-active");
            var overlay = document.getElementById("mobile-menu-overlay");
            if (!overlay) {
                overlay = document.createElement("div");
                overlay.id = "mobile-menu-overlay";
                document.body.appendChild(overlay);
                overlay.addEventListener("click", function() {
                    document.body.classList.remove("mobile-menu-active");
                    overlay.style.display = "none";
                });
            }
            if (document.body.classList.contains("mobile-menu-active")) {
                overlay.style.display = "block";
            } else {
                overlay.style.display = "none";
            }
        });
    });
});
</script>
</body>
</html>
