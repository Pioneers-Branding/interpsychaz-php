<?php
/**
 * Local Development & Production Router for Interventional Psychiatry of Arizona
 * Handles clean URLs, static assets, nested paths, and category/post mappings.
 */

$uri = $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($uri);
$path = urldecode($parsedUrl['path'] ?? '/');

// 1. If it's a real file that exists on disk (static assets, css, images, etc.), serve directly
$realPath = __DIR__ . $path;
if ($path !== '/' && file_exists($realPath) && is_file($realPath)) {
    // Determine MIME type for static assets
    $ext = strtolower(pathinfo($realPath, PATHINFO_EXTENSION));
    $mimeTypes = [
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'json'  => 'application/json',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'webp'  => 'image/webp',
        'svg'   => 'image/svg+xml',
        'ico'   => 'image/x-icon',
        'mp4'   => 'video/mp4',
        'webm'  => 'video/webm',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        'eot'   => 'application/vnd.ms-fontobject',
        'txt'   => 'text/plain',
        'xml'   => 'application/xml',
        'pdf'   => 'application/pdf',
    ];

    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
        header('Content-Length: ' . filesize($realPath));
        readfile($realPath);
        exit;
    }

    return false; // Let PHP built-in server handle other files
}

// 2. Handle root homepage request
$cleanSlug = trim($path, '/');
if ($cleanSlug === '' || $cleanSlug === 'index' || $cleanSlug === 'index.php' || $cleanSlug === 'index.html') {
    $_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/index.php';
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $_SERVER['PHP_SELF'] = '/index.php';
    require __DIR__ . '/index.php';
    exit;
}

// 3. Resolve candidate PHP files in priority order
$candidates = [];

// (a) Direct match: e.g. /about -> about.php, /meet-our-team -> meet-our-team.php
$candidates[] = __DIR__ . '/' . $cleanSlug . '.php';

// (b) Double-underscore translation for nested routes:
// e.g. /category/blog -> category__blog.php
// e.g. /category/blog/page/2 -> category__blog__page__2.php
// e.g. /for-providers/refer-a-patient -> for-providers__refer-a-patient.php
$doubleUnderscore = str_replace('/', '__', $cleanSlug);
$candidates[] = __DIR__ . '/' . $doubleUnderscore . '.php';

// (c) Specific alias mappings
if (preg_match('#^category/blog/page/(\d+)#', $cleanSlug, $m)) {
    $candidates[] = __DIR__ . '/category__blog__page__' . $m[1] . '.php';
}
if ($cleanSlug === 'category/blog' || $cleanSlug === 'blog') {
    $candidates[] = __DIR__ . '/category__blog.php';
}
if ($cleanSlug === 'for-providers/refer-a-patient' || $cleanSlug === 'refer-a-patient') {
    $candidates[] = __DIR__ . '/for-providers__refer-a-patient.php';
}

// (d) Services & Treatments prefixes:
if (strpos($cleanSlug, 'services/') === 0) {
    $sub = substr($cleanSlug, 9);
    $candidates[] = __DIR__ . '/services__' . $sub . '.php';
    $candidates[] = __DIR__ . '/' . $sub . '.php';
}
if (strpos($cleanSlug, 'treatments/') === 0) {
    $sub = substr($cleanSlug, 11);
    $candidates[] = __DIR__ . '/treatments__' . $sub . '.php';
    $candidates[] = __DIR__ . '/' . $sub . '.php';
}

// (e) Post prefix: e.g. /addiction-and-the-brain -> post__addiction-and-the-brain.php
$candidates[] = __DIR__ . '/post__' . $cleanSlug . '.php';

// (f) Strip post__ prefix if requested
if (strpos($cleanSlug, 'post__') === 0) {
    $candidates[] = __DIR__ . '/' . substr($cleanSlug, 6) . '.php';
}

// (g) Directory with index.php or public html
$candidates[] = __DIR__ . '/' . $cleanSlug . '/index.php';
$candidates[] = __DIR__ . '/public/' . $cleanSlug . '/index.html';

// 4. Find the first matching candidate file
$matchedFile = null;
foreach ($candidates as $candidate) {
    if (file_exists($candidate) && is_file($candidate)) {
        $matchedFile = $candidate;
        break;
    }
}

if ($matchedFile !== null) {
    if (substr($matchedFile, -5) === '.html') {
        header('Content-Type: text/html; charset=UTF-8');
        readfile($matchedFile);
        exit;
    }
    $_SERVER['SCRIPT_FILENAME'] = $matchedFile;
    $_SERVER['SCRIPT_NAME'] = '/' . basename($matchedFile);
    $_SERVER['PHP_SELF'] = '/' . basename($matchedFile);
    require $matchedFile;
    exit;
}

// 5. If no file found, return a clean 404 page
http_response_code(404);
$pageTitle = 'Page Not Found | Interventional Psychiatry of Arizona';
$pageDescription = 'The page you requested could not be found.';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';
?>
<div id="page" class="single" style="padding: 60px 0; text-align: center; min-height: 450px;">
    <div class="container">
        <h1 style="font-size: 48px; color: #4b4d97; margin-bottom: 20px;">404</h1>
        <h2 style="font-size: 28px; margin-bottom: 15px;">Page Not Found</h2>
        <p style="font-size: 18px; color: #666; max-width: 600px; margin: 0 auto 30px auto;">
            The page you are looking for does not exist or has been moved.
        </p>
        <p>
            <a href="/" class="btn" style="background-color: #ef7136; color: #fff; padding: 12px 28px; display: inline-block; margin: 5px;">Return to Home</a>
            <a href="/tms-therapy/" class="btn" style="background-color: #4b4d97; color: #fff; padding: 12px 28px; display: inline-block; margin: 5px;">Our Treatments</a>
            <a href="/contact/" class="btn" style="background-color: #154064; color: #fff; padding: 12px 28px; display: inline-block; margin: 5px;">Contact Us</a>
        </p>
    </div>
</div>
<?php
require_once __DIR__ . '/includes/footer.php';

