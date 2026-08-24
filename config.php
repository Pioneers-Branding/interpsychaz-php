<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';

define('SITE_NAME', 'Interventional Psychiatry of Arizona');
define('SITE_URL', $protocol . '://' . $host);
define('SITE_PHONE', '(602) 824-8404');
define('SITE_PHONE_RAW', '6028248404');
define('SITE_ADDRESS', '2929 E Camelback Rd, Suite 119, Phoenix, AZ 85016');
define('SITE_GOOGLE_MAPS', 'https://maps.app.goo.gl/M77iocFYVFsBePD47');
define('SITE_APPOINTMENTS_URL', SITE_URL . '/appointments/');

define('GOOGLE_REVIEW_URL', 'http://search.google.com/local/writereview?placeid=ChIJt8rFr_4NK4cRbF9K7nIzGVM');
define('GOOGLE_MAPS_OFFICE', 'https://maps.app.goo.gl/M77iocFYVFsBePD47');
define('GOOGLE_MAPS_RATING', 'https://maps.app.goo.gl/3gQUrhL2xK6Wjpbo7');

define('FACEBOOK_URL', 'https://www.facebook.com/interpsychaz');
define('LINKEDIN_URL', 'http://linkedin.com/company/interventional-psychiatry-of-arizona1/');
define('INSTAGRAM_URL', 'https://www.instagram.com/interpsychaz/?fbclid=IwZXh0bgNhZW0CMTEAAR251kBD3kHgnDk16DcBasyrqUZTzMyT-ntZBaoL6D_sDNoKG5drlfozRjE_aem_5l3Cy-PnGIw_DFELZK52Aw');

define('GTM_ID', 'GTM-5B6CGF74');
define('GA_ID_1', 'G-7TQS8BS5C3');
define('GA_ID_2', 'G-Y09PPBJ34W');
define('GOOGLE_ADS_ID', 'AW-11337249981');
define('TAWK_ID', '67e6985c3b89e8190ea53578/1inec6aa9');

define('CRISIS_HOTLINE', '988');
