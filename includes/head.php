<?php
$currentPage = basename($_SERVER['SCRIPT_NAME'], '.php');
$pageTitle = $pageTitle ?? 'Interventional Psychiatry of Arizona';
$pageDescription = $pageDescription ?? 'Interventional Psychiatry of Arizona is a skilled Premier Psychiatry Center in Phoenix, AZ. Accepting new appointments. Call today or request an appointment on our website.';
$pageOgImage = $pageOgImage ?? '/wp-content/uploads/2025/03/az-logo-white.png.png.webp';
$pageOgType = $pageOgType ?? 'website';
$pageCanonical = $pageCanonical ?? SITE_URL . $_SERVER['REQUEST_URI'];
$pageBreadcrumb = $pageBreadcrumb ?? [['name' => 'Home', 'url' => SITE_URL . '/']];
$pageSchemaType = $pageSchemaType ?? 'WebPage';
$pageRobots = $pageRobots ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
?>
<!DOCTYPE html>
<html class="no-js" lang="en-US">
<head itemscope="" itemtype="http://schema.org/WebSite">
<meta charset="utf-8"/>
<link as="font" crossorigin="" href="/wp-content/uploads/dmm-consent-guard/fonts/f-b58a5805e17f555e1620.woff2" rel="preload" type="font/woff2"/>
<link as="font" crossorigin="" href="/wp-content/uploads/dmm-consent-guard/fonts/cinzel-v26-latin.woff2" rel="preload" type="font/woff2"/>
<script id="dmm-cg-boot">window.DMMCG={"mode":"disclaimer","cats":["functional","analytics","marketing"],"allow":[],"lib":["code.jquery.com","cdnjs.cloudflare.com","unpkg.com","jsdelivr.net","bootstrapcdn.com","ajax.aspnetcdn.com","use.fontawesome.com","kit.fontawesome.com"],"map":{"google-analytics.com":"analytics","analytics.google.com":"analytics","googletagmanager.com":"analytics","segment.com":"analytics","segment.io":"analytics","withcherry.com":"marketing","recaptcha.net":"functional","gstatic.com":"functional","doubleclick.net":"marketing","googleadservices.com":"marketing","googlesyndication.com":"marketing","facebook.com":"marketing","facebook.net":"marketing","connect.facebook.net":"marketing","tiktok.com":"marketing","bing.com":"marketing","clarity.ms":"analytics","hotjar.com":"analytics","hotjar.io":"analytics","linkedin.com":"marketing","licdn.com":"marketing","hubspot.com":"marketing","hs-scripts.com":"marketing","hs-analytics.net":"analytics","youtube.com":"functional","youtube-nocookie.com":"functional","ytimg.com":"functional","vimeo.com":"functional","fonts.googleapis.com":"functional","fonts.gstatic.com":"functional","translate.google.com":"functional","translate.googleapis.com":"functional","gravatar.com":"functional","w.org":"functional","wp.com":"analytics","cloudflareinsights.com":"analytics","intercom.io":"marketing","tawk.to":"functional","podium.com":"marketing","birdeye.com":"marketing","callrail.com":"marketing","twilio.com":"functional","stripe.com":"functional","paypal.com":"functional"},"ep":"https://interpsychaz.com/wp-json/dmm/v1/","tok":"4249d6030bed8d8538c71a2e62a52d4b","pv":1,"audit":1,"banner":1,"recaptcha":1,"embeds":"placeholder","site":"interpsychaz.com"};</script>
<script id="dmm-cg-guard">(function (w, d) {
	'use strict';
	var C = w.DMMCG;
	if (!C || !C.ep || w.__dmmCgLoaded) { return; }
	w.__dmmCgLoaded = true;
	var oFetch  = w.fetch;
	var oBeacon = w.navigator && w.navigator.sendBeacon ? w.navigator.sendBeacon.bind(w.navigator) : null;
	var oOpen   = w.XMLHttpRequest ? w.XMLHttpRequest.prototype.open : null;
	var oSend   = w.XMLHttpRequest ? w.XMLHttpRequest.prototype.send : null;
	var oSetAttr = Element.prototype.setAttribute;
	var oWrite  = d.write;
	var oWriteLn = d.writeln;
	var ENFORCE = C.mode === 'enforce';
	var SELF    = (C.site || w.location.hostname).toLowerCase();
	var COOKIE  = 'dmm_cg_consent';
	var GPC     = !!(w.navigator && w.navigator.globalPrivacyControl);
	var consent = null;
	var once    = {};
	var seen    = {};
	var buf     = [];
	var timer   = null;
	function absUrl(u) {
		if (u == null) { return ''; }
		u = String(u);
		if (!u || /^(data|blob|javascript|about|mailto|tel|#):/i.test(u)) { return ''; }
		try { return new URL(u, w.location.href).href; } catch (e) { return ''; }
	}
	function hostOf(u) {
		var a = absUrl(u);
		if (!a) { return ''; }
		try { return new URL(a).hostname.toLowerCase(); } catch (e) { return ''; }
	}
	function pathOf(u) {
		var a = absUrl(u);
		if (!a) { return ''; }
		try { return new URL(a).pathname.slice(0, 190); } catch (e) { return ''; }
	}
	function suffixed(host, pattern) {
		if (!pattern) { return false; }
		pattern = String(pattern).toLowerCase().replace(/^\./, '');
		return host === pattern || host.slice(-(pattern.length + 1)) === '.' + pattern;
	}
	function isSelf(host) {
		if (!host) { return true; }
		var a = host.replace(/^www\./, '');
		var b = SELF.replace(/^www\./, '');
		return a === b || a.slice(-(b.length + 1)) === '.' + b;
	}
	function isAllowed(host) {
		for (var i = 0; i < (C.allow || []).length; i++) {
			if (suffixed(host, C.allow[i])) { return true; }
		}
		return false;
	}
	function isLibrary(host, url) {
		if (host === 'ajax.googleapis.com') { return /\/ajax\/libs\//i.test(url || ''); }
		for (var i = 0; i < (C.lib || []).length; i++) {
			if (suffixed(host, C.lib[i])) { return true; }
		}
		return false;
	}
	function catOf(host, url) {
		if (host === 'www.google.com' || host === 'google.com') {
			if (/\/recaptcha\//.test(url || '')) { return 'functional'; }
			if (/\/(pagead|ads|ccm|maps)\//.test(url || '')) { return 'marketing'; }
		}
		var map = C.map || {};
		for (var k in map) {
			if (Object.prototype.hasOwnProperty.call(map, k) && suffixed(host, k)) { return map[k]; }
		}
		return 'unknown';
	}
	function readCookie() {
		var m = d.cookie.match(/(?:^|;\s*)dmm_cg_consent=([^;]*)/);
		if (!m) { return null; }
		try {
			var o = JSON.parse(decodeURIComponent(m[1]));
			if (!o || typeof o !== 'object' || o.v !== C.pv || !(o.c instanceof Array)) { return null; }
			return o;
		} catch (e) { return null; }
	}
	function writeCookie(o) {
		var v = encodeURIComponent(JSON.stringify(o));
		d.cookie = COOKIE + '=' + v + ';path=/;max-age=31536000;samesite=Lax' +
			(w.location.protocol === 'https:' ? ';secure' : '');
	}
	function granted(cat) {
		if (cat === 'necessary') { return true; }
		if (!consent) { return false; }
		return consent.c.indexOf(cat) > -1;
	}
	consent = readCookie();
	function record(host, url, kind, cat, blocked) {
		if (!C.audit) { return; }
		var phase = consent ? 'post' : 'pre';
		var key = host + '|' + kind + '|' + phase;
		if (seen[key]) { return; }
		seen[key] = 1;
		buf.push({ h: host, p: pathOf(url), k: kind, c: cat, ph: phase, b: blocked ? 1 : 0 });
		if (!timer) { timer = w.setTimeout(flush, 1500); }
	}
	function flush() {
		timer = null;
		if (!buf.length) { return; }
		var body = JSON.stringify({ t: C.tok, pg: w.location.pathname.slice(0, 190), items: buf.splice(0, 50) });
		post('audit', body);
	}
	function post(route, body) {
		var url = C.ep + route;
		try {
			if (oBeacon && oBeacon(url, new Blob([body], { type: 'text/plain;charset=UTF-8' }))) { return; }
		} catch (e) { /* fall through */ }
		try {
			if (oFetch) {
				oFetch.call(w, url, { method: 'POST', body: body, keepalive: true, credentials: 'omit', headers: { 'Content-Type': 'text/plain' } });
			}
		} catch (e2) { /* give up */ }
	}
	function decide(rawUrl, kind) {
		var url = absUrl(rawUrl);
		if (!url) { return; }
		var host = hostOf(url);
		if (!host || isSelf(host) || isAllowed(host) || isLibrary(host, url)) {
			record(host, url, kind, '', false);
			return;
		}
		var cat = catOf(host, url);
		if (cat === 'unknown') {
			record(host, url, kind, cat, false);
			return;
		}
		var block = !granted(cat);
		record(host, url, kind, cat, block);
		if (!block) { return; }
		if (kind === 'script') {
			var s = d.createElement('script');
			for (var i = 0; i < (w.__dmmCgAttrs || []).length; i++) {
				var a = w.__dmmCgAttrs[i];
				if (a.name !== 'type' && a.name !== 'src') { oSetAttr.call(s, a.name, a.value); }
			}
			oSetAttr.call(s, 'data-dmm-cat', cat);
			oSetAttr.call(s, 'data-dmm-src', url);
			if (oSetAttr) { oSetAttr.call(s, 'type', 'text/dummy'); }
			if (s.parentNode) { s.parentNode.replaceChild(s, s); }
			return false;
		}
		if (kind === 'iframe' || kind === 'img') {
			var el = d.createElement(kind === 'iframe' ? 'iframe' : 'img');
			for (var j = 0; j < (w.__dmmCgAttrs || []).length; j++) {
				var at = w.__dmmCgAttrs[j];
				oSetAttr.call(el, at.name, at.value);
			}
			oSetAttr.call(el, 'data-dmm-cat', cat);
			oSetAttr.call(el, 'data-dmm-src', url);
			return false;
		}
		return false;
	}
	function reactivate(scope) {
		var nodes = (scope || d).querySelectorAll('[data-dmm-cat]');
		for (var i = 0; i < nodes.length; i++) {
			var el = nodes[i];
			var url = el.getAttribute('data-dmm-src');
			var cat = el.getAttribute('data-dmm-cat');
			var inline = el.getAttribute('data-dmm-inline') === '1';
			var host = url ? hostOf(url) : '';
			if (!granted(cat) && !(url && once[absUrl(url)]) && !(host && isAllowed(host))) { continue; }
			var tag = el.tagName.toLowerCase();
			if (tag === 'script' && el.parentNode) {
				var s = d.createElement('script');
				for (var a = 0; a < el.attributes.length; a++) {
					var at = el.attributes[a];
					if (at.name === 'type' || at.name.indexOf('data-dmm-') === 0) { continue; }
					oSetAttr.call(s, at.name, at.value);
				}
				var origType = el.getAttribute('data-dmm-type');
				if (origType) { oSetAttr.call(s, 'type', origType); }
				if (inline) { s.text = el.textContent; }
				else if (url) { s.src = url; }
				el.parentNode.replaceChild(s, el);
			} else {
				var attrName = el.getAttribute('data-dmm-attr') || 'src';
				el.removeAttribute('data-dmm-cat');
				el.removeAttribute('data-dmm-src');
				el.removeAttribute('data-dmm-attr');
				if (url) { el.setAttribute(attrName, url); }
			}
		}
		var boxes = (scope || d).querySelectorAll('.dmm-cg-embed');
		for (var b = 0; b < boxes.length; b++) {
			if (!boxes[b].querySelector('[data-dmm-src]')) { releaseBox(boxes[b]); }
		}
	}
	function releaseBox(box) {
		var frame = box.querySelector('iframe');
		if (frame && box.parentNode) {
			box.parentNode.insertBefore(frame, box);
			box.parentNode.removeChild(box);
			return;
		}
		box.removeAttribute('data-dmm-placeholder');
	}
	function placeholders() {
		if (C.embeds !== 'placeholder') { return; }
		var frames = d.querySelectorAll('iframe[data-dmm-src]:not([data-dmm-ph])');
		for (var i = 0; i < frames.length; i++) {
			(function (frame) {
				if (granted(frame.getAttribute('data-dmm-cat'))) { return; }
				oSetAttr.call(frame, 'data-dmm-ph', '1');
				var label = frame.getAttribute('data-dmm-label') || hostOf(frame.getAttribute('data-dmm-src'));
				var box = d.createElement('div');
				box.className = 'dmm-cg-embed';
				box.setAttribute('data-dmm-placeholder', '1');
				var h = parseInt(frame.getAttribute('height'), 10);
				if (h > 0) { box.style.setProperty('--dmm-embed-h', h + 'px'); }
				var btn = d.createElement('button');
				btn.type = 'button';
				btn.className = 'dmm-cg-embed__btn';
				btn.textContent = 'Load ' + label;
				var note = d.createElement('span');
				note.className = 'dmm-cg-embed__note';
				note.textContent = label + ' will receive your IP address.';
				btn.addEventListener('click', function () {
					var url = absUrl(frame.getAttribute('data-dmm-src'));
					once[url] = 1;
					frame.removeAttribute('data-dmm-cat');
					frame.src = frame.getAttribute('data-dmm-src');
					frame.removeAttribute('data-dmm-src');
					releaseBox(box);
				});
				frame.parentNode.insertBefore(box, frame);
				box.appendChild(btn);
				box.appendChild(note);
				box.appendChild(frame);
			}(frames[i]));
		}
	}
	function lazyRecaptcha() {
		if (!C.recaptcha) { return; }
		var armed = false;
		var fire = function (ev) {
			if (armed) { return; }
			var t = ev.target;
			if (!t || !t.tagName) { return; }
			var tag = t.tagName.toLowerCase();
			var inForm = typeof t.closest === 'function' && t.closest('form');
			if (tag !== 'input' && tag !== 'textarea' && tag !== 'select' && !inForm) { return; }
			armed = true;
			C.allow = (C.allow || []).concat(['google.com', 'gstatic.com', 'recaptcha.net']);
			reactivate(d);
			d.dispatchEvent(new CustomEvent('dmm:recaptcha'));
		};
		d.addEventListener('focusin', fire, true);
		d.addEventListener('pointerdown', fire, true);
	}
	var VENDOR_COOKIES = {
		analytics: ['_ga', '_gid', '_gat', '__utm', 'ajs_', '_hj', '_clck', '_clsk', '_gcl_au'],
		marketing: ['_fbp', '_fbc', '_gcl_', 'IDE', 'test_cookie', 'li_sugr', 'li_fat_id', '_uet', 'ttclid', '_ttp', 'MUID'],
		functional: []
	};
	function dropCookie(name) {
		var parts = w.location.hostname.split('.');
		var scopes = ['', w.location.hostname];
		for (var i = 0; i < parts.length - 1; i++) { scopes.push('.' + parts.slice(i).join('.')); }
		for (var s = 0; s < scopes.length; s++) {
			d.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/' +
				(scopes[s] ? ';domain=' + scopes[s] : '');
		}
	}
	function clearVendorCookies(cats) {
		var present = d.cookie.split(';');
		for (var i = 0; i < present.length; i++) {
			var name = present[i].split('=')[0].trim();
			if (!name || name === COOKIE) { continue; }
			for (var c = 0; c < cats.length; c++) {
				var prefixes = VENDOR_COOKIES[cats[c]] || [];
				for (var p = 0; p < prefixes.length; p++) {
					if (name.indexOf(prefixes[p]) === 0) { dropCookie(name); break; }
				}
			}
		}
	}
	function apply(cats, method) {
		var previous = consent ? consent.c.slice() : [];
		var valid = [];
		var i;
		for (i = 0; i < cats.length; i++) {
			if ((C.cats || []).indexOf(cats[i]) > -1 && valid.indexOf(cats[i]) < 0) { valid.push(cats[i]); }
		}
		var revoked = [];
		for (i = 0; i < previous.length; i++) {
			if (valid.indexOf(previous[i]) < 0) { revoked.push(previous[i]); }
		}
		var stored = { v: C.pv, t: Math.floor(Date.now() / 1000), c: valid };
		writeCookie(stored);
		consent = stored;
		seen = {};
		post('consent', JSON.stringify({
			t: C.tok, c: valid, m: method || 'save',
			v: C.pv, pg: w.location.pathname.slice(0, 190), gpc: GPC ? 1 : 0
		}));
		d.dispatchEvent(new CustomEvent('dmm:consent', { detail: stored }));
		if (revoked.length) {
			clearVendorCookies(revoked);
			w.location.reload();
			return;
		}
		reactivate(d);
	}
	w.dmmConsent = {
		version: C.pv,
		mode: C.mode,
		gpc: GPC,
		categories: C.cats || [],
		get: function () { return consent ? consent.c.slice() : null; },
		has: function (cat) { return granted(cat); },
		acceptAll: function () { apply((C.cats || []).slice(), 'accept_all'); },
		acknowledge: function () { apply((C.cats || []).slice(), 'acknowledge'); },
		rejectAll: function () { apply([], 'reject_all'); },
		save: function (cats) { apply(cats || [], 'save'); },
		withdraw: function () { apply([], 'withdraw'); },
		open: function () { d.dispatchEvent(new CustomEvent('dmm:open')); },
		debug: function () { return { config: C, consent: consent, pending: buf.slice(), seen: Object.keys(seen) }; }
	};
	function ready() {
		placeholders();
		lazyRecaptcha();
		if (consent) { reactivate(d); }
	}
	if (d.readyState === 'loading') { d.addEventListener('DOMContentLoaded', ready); }
	else { ready(); }
	w.addEventListener('pagehide', flush);
	d.addEventListener('visibilitychange', function () { if (d.visibilityState === 'hidden') { flush(); } });
}(window, document));
</script>
<!-- Google Tag Manager + gtag.js (consolidated: one loader, deferred until window load + idle or first interaction) -->
<script>
window.dataLayer = window.dataLayer || [];
window.gtag = window.gtag || function(){window.dataLayer.push(arguments);};
(function(w,d){
  var booted = false;
  function boot(){
    if (booted) { return; }
    booted = true;
    w.gtag('js', new Date());
    w.gtag('config', '<?php echo GA_ID_1; ?>');
    w.gtag('config', '<?php echo GA_ID_2; ?>');
    w.gtag('config', '<?php echo GOOGLE_ADS_ID; ?>');
    var ref = d.getElementsByTagName('script')[0];
    var gtm = d.createElement('script');
    gtm.async = true;
    gtm.src = 'https://www.googletagmanager.com/gtm.js?id=<?php echo GTM_ID; ?>&l=dataLayer';
    ref.parentNode.insertBefore(gtm, ref);
    var g = d.createElement('script');
    g.async = true;
    g.src = 'https://www.googletagmanager.com/gtag/js?id=<?php echo GA_ID_1; ?>';
    ref.parentNode.insertBefore(g, ref);
  }
  var signals = ['pointerdown','keydown','touchstart','scroll'];
  var onSignal = function(){ boot(); };
  signals.forEach(function(evt){
    w.addEventListener(evt, onSignal, {passive:true, capture:true, once:true});
  });
  w.addEventListener('pagehide', boot);
  d.addEventListener('visibilitychange', function(){ if (d.visibilityState === 'hidden') { boot(); } });
})(window,document);
</script>
<!-- End Google Tag Manager + gtag.js -->
<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
<link href="https://gmpg.org/xfn/11" rel="profile"/>
<link href="/wp-content/uploads/2025/03/az-logo-white.png.png" rel="icon" type="image/x-icon"/>
<meta content="#FFFFFF" name="msapplication-TileColor"/>
<meta content="/wp-content/uploads/2025/03/az-logo-white.png.png" name="msapplication-TileImage"/>
<link href="/wp-content/uploads/2025/03/az-logo-white.png.png" rel="apple-touch-icon-precomposed"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="<?php echo SITE_NAME; ?>" itemprop="name"/>
<meta content="<?php echo SITE_URL; ?>" itemprop="url"/>
<meta content="/wp-content/uploads/2025/03/az-logo-white.png.png.webp" property="og:image"/>
<meta content="<?php echo $pageRobots; ?>" name="robots"/>
<script>document.documentElement.className = document.documentElement.className.replace( /\bno-js\b/,'js' );</script>
<title><?php echo $pageTitle; ?></title>
<link href="/wp-content/cache/min/perf/bundle-a.css" id="perf-bundle-a-css" media="all" rel="stylesheet"/>
<meta content="<?php echo $pageDescription; ?>" name="description"/>
<link href="<?php echo $pageCanonical; ?>" rel="canonical"/>
<meta content="en_US" property="og:locale"/>
<meta content="<?php echo $pageOgType; ?>" property="og:type"/>
<meta content="<?php echo $pageTitle; ?>" property="og:title"/>
<meta content="<?php echo $pageDescription; ?>" property="og:description"/>
<meta content="<?php echo $pageCanonical; ?>" property="og:url"/>
<meta content="<?php echo SITE_NAME; ?>" property="og:site_name"/>
<meta content="<?php echo FACEBOOK_URL; ?>" property="article:publisher"/>
<meta content="summary_large_image" name="twitter:card"/>
<script class="yoast-schema-graph" type="application/ld+json">{"@context":"https://schema.org","@graph":[{"@type":"<?php echo $pageSchemaType; ?>","@id":"<?php echo $pageCanonical; ?>","url":"<?php echo $pageCanonical; ?>","name":"<?php echo $pageTitle; ?>","isPartOf":{"@id":"<?php echo SITE_URL; ?>/#website"},"about":{"@id":"<?php echo SITE_URL; ?>/#organization"},"description":"<?php echo $pageDescription; ?>","breadcrumb":{"@id":"<?php echo $pageCanonical; ?>/#breadcrumb"},"inLanguage":"en-US"},{"@type":"BreadcrumbList","@id":"<?php echo $pageCanonical; ?>/#breadcrumb","itemListElement":[<?php foreach($pageBreadcrumb as $i => $bc): ?>{"@type":"ListItem","position":<?php echo $i+1; ?>,"name":"<?php echo $bc['name']; ?>"<?php if(isset($bc['url'])): ?>,"item":"<?php echo $bc['url']; ?>"<?php endif; ?>}<?php echo $i < count($pageBreadcrumb)-1 ? ',' : ''; ?><?php endforeach; ?>]},{"@type":"WebSite","@id":"<?php echo SITE_URL; ?>/#website","url":"<?php echo SITE_URL; ?>/","name":"<?php echo SITE_NAME; ?>","publisher":{"@id":"<?php echo SITE_URL; ?>/#organization"}},{"@type":"Organization","@id":"<?php echo SITE_URL; ?>/#organization","name":"<?php echo SITE_NAME; ?>","url":"<?php echo SITE_URL; ?>/"}]}</script>
<style>
        body {background-color:#fff;background-image:url(/wp-content/themes/mts_schema/images/nobg.png);}
         
        /* Top Level Navigation */
        #secondary-navigation > nav > ul > li > a {
            color: #ffffff !important;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            font-size: 16px;
            text-transform: uppercase;
        }
        #secondary-navigation > nav > ul > li:hover > a,
        #secondary-navigation > nav > ul > li.current-menu-item > a,
        #secondary-navigation > nav > ul > li.current-menu-parent > a {
            color: #ffffff !important;
        }

        #secondary-navigation > nav > ul > li:hover,
        #secondary-navigation > nav > ul > li.current-menu-item,
        #secondary-navigation > nav > ul li.current-menu-item,
        #secondary-navigation > nav > ul > li.current-menu-parent {
            background-color: #ef7136 !important;
        }

        /* Dropdown Sub-menus */
        #secondary-navigation .navigation ul.sub-menu,
        #secondary-navigation .navigation ul ul {
            background-color: #ffffff !important;
            border-radius: 4px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18) !important;
            border: 1px solid rgba(0, 0, 0, 0.08);
            min-width: 280px !important;
            width: max-content !important;
            max-width: 400px !important;
            padding: 6px 0 !important;
            z-index: 9999 !important;
        }

        #secondary-navigation .navigation ul.sub-menu li,
        #secondary-navigation .navigation ul ul li {
            background: #ffffff !important;
            display: block !important;
            float: none !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        body #secondary-navigation .navigation ul.sub-menu li a,
        body #secondary-navigation .navigation ul ul li a,
        #secondary-navigation .navigation ul.sub-menu li a,
        #secondary-navigation .navigation ul ul li a {
            color: #154064 !important;
            font-family: 'Roboto', sans-serif !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            text-transform: none !important;
            letter-spacing: 0.2px !important;
            line-height: 1.4 !important;
            display: block !important;
            padding: 10px 20px !important;
            width: 100% !important;
            box-sizing: border-box !important;
            background: #ffffff !important;
            border-bottom: 1px solid #f2f4f7 !important;
            transition: all 0.2s ease !important;
            text-align: left !important;
            white-space: normal !important;
        }

        #secondary-navigation .navigation ul.sub-menu li:last-child a,
        #secondary-navigation .navigation ul ul li:last-child a {
            border-bottom: none !important;
        }

        body #secondary-navigation .navigation ul.sub-menu li:hover > a,
        body #secondary-navigation .navigation ul.sub-menu li a:hover,
        body #secondary-navigation .navigation ul ul li:hover > a,
        body #secondary-navigation .navigation ul ul li a:hover,
        #secondary-navigation .navigation ul.sub-menu li:hover > a,
        #secondary-navigation .navigation ul.sub-menu li a:hover {
            background-color: #ef7136 !important;
            color: #ffffff !important;
            padding-left: 24px !important;
        }

        body #secondary-navigation .navigation ul.sub-menu li.current-menu-item > a,
        body #secondary-navigation .navigation ul.sub-menu li.current_page_item > a,
        #secondary-navigation .navigation ul.sub-menu li.current-menu-item > a,
        #secondary-navigation .navigation ul.sub-menu li.current_page_item > a {
            background-color: #4b4d97 !important;
            color: #ffffff !important;
        }

        staff-grid p + span,
        .dflex p + span,
        .staff-block,
        a.btn,
        a.niceButi { background-color: #ef7136 !important; }

        .side-social-icons a, 
        .page-header,
        section.page-header,section#wda_testi:after,html button.aicon_link, div.header-social-icons a { background-color: #4b4d97 !important; }
        .dm-service-section:nth-child(even) img { outline: 2px solid #154064; }
        .mobileBtn a, .hours { background-color: #4b4d97; }
        html ul ul.wda-long-menu { background-color: #4b4d97; }

        .pace .pace-progress, #mobile-menu-wrapper ul li a:hover, .page-numbers.current, .pagination a:hover, .single .pagination a:hover .current { background: #4b4d97; }
        .postauthor h5, .single_post a, .textwidget a, .pnavigation2 a, .sidebar.c-4-12 a:hover, footer .widget li a:hover, .reply a, .title a:hover, .post-info a:hover, .widget .thecomment, #tabber .inside li a:hover, .readMore a:hover, .fn a, a:not(.sticks):not(.header-btn):not(.btn), .readMore a, #primary-navigation a:hover, .widget .wp_review_tab_widget_content a, .sidebar .wpt_widget_content a { color:#4b4d97; }
        a#pull, #commentform input#submit, #mtscontact_submit, .mts-subscribe input[type='submit'], .widget_product_search input[type='submit'], #move-to-top:hover, .currenttext, .pagination a:hover, .pagination .nav-previous a:hover, .pagination .nav-next a:hover, #load-posts a:hover, .single .pagination a:hover .currenttext, .single .pagination > .current .currenttext, #tabber ul.tabs li a.selected, .tagcloud a, .navigation ul .sfHover a, .woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button, .woocommerce .bypostauthor:after, #searchsubmit, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button, .latestPost-review-wrapper, .latestPost .review-type-circle.latestPost-review-wrapper { background-color: #4b4d97; }
        .related-posts .title a:hover, .latestPost .title a { color: #4b4d97; }
        .navigation #wpmm-megamenu .wpmm-pagination a { background-color: #4b4d97!important; }
        footer {background-color:#154064; }
        .copyrights:before { border-color: transparent transparent transparent; }
        .flex-control-thumbs .flex-active{ border-top:3px solid #4b4d97;}
        .wpmm-megamenu-showing.wpmm-light-scheme { background-color:#4b4d97!important; }

        /* Responsive YouTube Player Embeds */
        .rll-youtube-player {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
            margin: 20px auto;
            background: #000;
            border-radius: 6px;
            cursor: pointer;
        }
        .rll-youtube-player iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        .rll-youtube-player img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: filter 0.3s ease;
        }
        .rll-youtube-player:hover img {
            filter: brightness(80%);
        }
        .rll-youtube-player .play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 68px;
            height: 48px;
            background-color: rgba(33, 33, 33, 0.85);
            border-radius: 12px;
            cursor: pointer;
            border: none;
            transition: background-color 0.2s ease, transform 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
        .rll-youtube-player:hover .play-btn {
            background-color: #ff0000;
            transform: translate(-50%, -50%) scale(1.1);
        }
        .rll-youtube-player .play-btn::after {
            content: '';
            border-style: solid;
            border-width: 9px 0 9px 16px;
            border-color: transparent transparent transparent #ffffff;
            display: block;
            margin-left: 3px;
        }
</style>
<link href="/wp-content/cache/min/perf/bundle-a.css" id="perf-bundle-a-css" media="all" rel="stylesheet"/>
<style id="slickcss-inline-css">
	:root {
	    --pColor: #4b4d97;
	    --sColor: #154064;
	    --aColor: #ef7136;
	}
</style>
<script src="/wp-content/cache/min/1/ajax/libs/jquery/1.12.4/jquery.min.js" defer id="jquery-js"></script>
<script>
var mts_customscript = {"responsive":"1","nav_menu":"both"};
</script>
<script src="/wp-content/cache/min/1/wp-content/themes/mts_schema/js/customscript.js" defer id="customscript-js"></script>
<script src="/wp-content/cache/min/1/wp-content/themes/mts_schema/content/js/ada.js" defer id="ada_js-js"></script>
<script src="/wp-content/cache/min/1/wp-content/themes/blossom-child/assets/wow.js" defer id="wow-js"></script>
<style id="wp-custom-fonts">
        #logo a { font-family: 'Roboto'; font-weight: normal; font-size: 32px; color: #222222;text-transform: uppercase; }
        body { font-family: 'Roboto'; font-weight: 300; font-size: 18px; color: #000000; }
        h1 { font-family: 'Jost'; font-weight: 700; font-size: 36px; color: #000000; }
        h2 { font-family: 'Jost'; font-weight: 600; font-size: 32px; color: #000000; }
        h3 { font-family: 'Jost'; font-weight: 500; font-size: 26px; color: #000000; }
        h4 { font-family: 'Jost'; font-weight: normal; font-size: 20px; color: #000000; }
        h5 { font-family: 'Jost'; font-weight: normal; font-size: 18px; color: #000000; }
</style>
<script class="dm-schema" type="application/ld+json">
    	{
		    "@context": "http://schema.org",
		    "@type": "LocalBusiness",
		    "name": "<?php echo SITE_NAME; ?>",
		    "url": "<?php echo SITE_URL; ?>",
		    "image": "/wp-content/uploads/2025/03/az-logo-white.png.png.webp",
		    "address": {
		        "addressLocality": "Phoenix",
		        "addressRegion": "AZ",
		        "postalCode": "85016",
		        "streetAddress": "2929 E Camelback Rd, Suite 119"
		    },
		    "openingHours": "Mon-Fri: 8am-5pm,Sat, Sun: Closed",
		    "priceRange": "$$",
		    "telephone" : "+1-(602) 824-8404",
		    "description": "Convenient and affordable Premier Psychiatry Center in Phoenix, AZ."
    	}
</script>
<?php if ($currentPage === 'index'): ?>
<link as="image" fetchpriority="high" href="/wp-content/uploads/2025/06/UntitledCOMPRESSED-poster.webp" rel="preload"/>
<?php endif; ?>
<style id="wp-custom-css">
@media only screen 
  and (max-device-width: 880px) {
div#gform_wrapper_2 .gform_button {
    color: #4B4D97 !important;
    font-weight: 600 !important;
	background: #ccc !important;
}
}
</style>
<link href="/wp-content/cache/min/perf/bundle-b.css" id="perf-bundle-b-css" media="all" rel="stylesheet"/>
<?php $_perfGform = __DIR__ . '/../wp-content/cache/min/perf/bundle-gform.css'; if (file_exists($_perfGform)) { echo '<style id="perf-gform-inline">' . file_get_contents($_perfGform) . '</style>'; } ?>
<?php
// Page-specific stylesheets. WordPress enqueued these only on the pages that use
// them; the static port has to do the same or those pages render unstyled.
$pageOnlyStyles = [
    'meet-our-team'                  => ['wda_staff_grid-css' => '/wp-content/cache/min/1/wp-content/themes/mts_schema/theme-specific/doctors/doctor-grid.css'],
    'for-providers__refer-a-patient' => ['dashicons-css'      => '/wp-content/cache/min/1/wp-includes/css/dashicons.min.css'],
];
foreach (($pageOnlyStyles[$currentPage] ?? []) as $id => $href):
?>
<link href="<?php echo $href; ?>" id="<?php echo $id; ?>" media="all" rel="stylesheet"/>
<?php endforeach; ?>
<style>
/* Premium Gravity Forms Overrides */
.gform_wrapper .gform_body .gfield input[type=text],
.gform_wrapper .gform_body .gfield input[type=email],
.gform_wrapper .gform_body .gfield input[type=tel],
.gform_wrapper .gform_body .gfield select,
.gform_wrapper .gform_body .gfield textarea {
    width: 100% !important;
    padding: 12px 15px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    background-color: #ffffff !important;
    color: #1f2937 !important;
    font-size: 16px !important;
    font-family: inherit !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05) inset !important;
    box-sizing: border-box !important;
    margin-top: 4px !important;
}

.gform_wrapper .gform_body .gfield input:focus,
.gform_wrapper .gform_body .gfield select:focus,
.gform_wrapper .gform_body .gfield textarea:focus {
    outline: none !important;
    border-color: #4b4d97 !important;
    box-shadow: 0 0 0 3px rgba(75, 77, 151, 0.2) !important;
    background-color: #fff !important;
}

.gform_wrapper .gform_body .gfield_label {
    font-weight: 600 !important;
    color: #374151 !important;
    margin-bottom: 5px !important;
    display: inline-block !important;
    font-size: 15px !important;
}

.gform_wrapper .gform_footer button.gform_button,
.gform_wrapper .gform_footer input.gform_button,
.gform_wrapper .gform_footer button[type="submit"] {
    background-color: #ea8529 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    padding: 14px 28px !important;
    border-radius: 30px !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(234, 133, 41, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.gform_wrapper .gform_footer button.gform_button:hover,
.gform_wrapper .gform_footer input.gform_button:hover,
.gform_wrapper .gform_footer button[type="submit"]:hover {
    background-color: #d67420 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 15px rgba(234, 133, 41, 0.4) !important;
}

.gform_wrapper .gform_fields {
    display: grid !important;
    grid-gap: 20px !important;
}

.gform_wrapper .gfield_radio .gchoice {
    margin-bottom: 8px !important;
    display: flex !important;
    align-items: center !important;
}

.gform_wrapper .gfield_radio input[type="radio"] {
    margin-right: 10px !important;
    width: 18px !important;
    height: 18px !important;
    accent-color: #4b4d97 !important;
}

.gform_wrapper .gfield_description p {
    font-size: 13px !important;
    color: #6b7280 !important;
    line-height: 1.5 !important;
    margin-top: 8px !important;
}
</style>

<style>
/* Premium Gravity Forms Overrides */
.gform_wrapper .gform_body .gfield input[type=text],
.gform_wrapper .gform_body .gfield input[type=email],
.gform_wrapper .gform_body .gfield input[type=tel],
.gform_wrapper .gform_body .gfield select,
.gform_wrapper .gform_body .gfield textarea {
    width: 100% !important;
    padding: 12px 15px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    background-color: #ffffff !important;
    color: #1f2937 !important;
    font-size: 16px !important;
    font-family: inherit !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05) inset !important;
    box-sizing: border-box !important;
    margin-top: 4px !important;
}

.gform_wrapper .gform_body .gfield input:focus,
.gform_wrapper .gform_body .gfield select:focus,
.gform_wrapper .gform_body .gfield textarea:focus {
    outline: none !important;
    border-color: #4b4d97 !important;
    box-shadow: 0 0 0 3px rgba(75, 77, 151, 0.2) !important;
    background-color: #fff !important;
}

.gform_wrapper .gform_body .gfield_label {
    font-weight: 600 !important;
    color: #374151 !important;
    margin-bottom: 5px !important;
    display: inline-block !important;
    font-size: 15px !important;
}

.gform_wrapper .gform_footer button.gform_button,
.gform_wrapper .gform_footer input.gform_button,
.gform_wrapper .gform_footer button[type="submit"] {
    background-color: #ea8529 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    padding: 14px 28px !important;
    border-radius: 30px !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(234, 133, 41, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.gform_wrapper .gform_footer button.gform_button:hover,
.gform_wrapper .gform_footer input.gform_button:hover,
.gform_wrapper .gform_footer button[type="submit"]:hover {
    background-color: #d67420 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 15px rgba(234, 133, 41, 0.4) !important;
}

.gform_wrapper .gform_fields {
    display: grid !important;
    grid-gap: 20px !important;
}

.gform_wrapper .gfield_radio .gchoice {
    margin-bottom: 8px !important;
    display: flex !important;
    align-items: center !important;
}

.gform_wrapper .gfield_radio input[type="radio"] {
    margin-right: 10px !important;
    width: 18px !important;
    height: 18px !important;
    accent-color: #4b4d97 !important;
}

.gform_wrapper .gfield_description p {
    font-size: 13px !important;
    color: #6b7280 !important;
    line-height: 1.5 !important;
    margin-top: 8px !important;
}
</style>

<style>
/* Premium Gravity Forms Overrides */
.gform_wrapper .gform_body .gfield input[type=text],
.gform_wrapper .gform_body .gfield input[type=email],
.gform_wrapper .gform_body .gfield input[type=tel],
.gform_wrapper .gform_body .gfield select,
.gform_wrapper .gform_body .gfield textarea {
    width: 100% !important;
    padding: 12px 15px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    background-color: #ffffff !important;
    color: #1f2937 !important;
    font-size: 16px !important;
    font-family: inherit !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05) inset !important;
    box-sizing: border-box !important;
    margin-top: 4px !important;
}

.gform_wrapper .gform_body .gfield input:focus,
.gform_wrapper .gform_body .gfield select:focus,
.gform_wrapper .gform_body .gfield textarea:focus {
    outline: none !important;
    border-color: #4b4d97 !important;
    box-shadow: 0 0 0 3px rgba(75, 77, 151, 0.2) !important;
    background-color: #fff !important;
}

.gform_wrapper .gform_body .gfield_label {
    font-weight: 600 !important;
    color: #374151 !important;
    margin-bottom: 5px !important;
    display: inline-block !important;
    font-size: 15px !important;
}

.gform_wrapper .gform_footer button.gform_button,
.gform_wrapper .gform_footer input.gform_button,
.gform_wrapper .gform_footer button[type="submit"] {
    background-color: #ea8529 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    padding: 14px 28px !important;
    border-radius: 30px !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(234, 133, 41, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.gform_wrapper .gform_footer button.gform_button:hover,
.gform_wrapper .gform_footer input.gform_button:hover,
.gform_wrapper .gform_footer button[type="submit"]:hover {
    background-color: #d67420 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 15px rgba(234, 133, 41, 0.4) !important;
}

.gform_wrapper .gform_fields {
    display: grid !important;
    grid-gap: 20px !important;
}

.gform_wrapper .gfield_radio .gchoice {
    margin-bottom: 8px !important;
    display: flex !important;
    align-items: center !important;
}

.gform_wrapper .gfield_radio input[type="radio"] {
    margin-right: 10px !important;
    width: 18px !important;
    height: 18px !important;
    accent-color: #4b4d97 !important;
}

.gform_wrapper .gfield_description p {
    font-size: 13px !important;
    color: #6b7280 !important;
    line-height: 1.5 !important;
    margin-top: 8px !important;
}
</style>

<style>
/* Premium Gravity Forms Overrides */
.gform_wrapper .gform_body .gfield input[type=text],
.gform_wrapper .gform_body .gfield input[type=email],
.gform_wrapper .gform_body .gfield input[type=tel],
.gform_wrapper .gform_body .gfield select,
.gform_wrapper .gform_body .gfield textarea {
    width: 100% !important;
    padding: 12px 15px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    background-color: #ffffff !important;
    color: #1f2937 !important;
    font-size: 16px !important;
    font-family: inherit !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05) inset !important;
    box-sizing: border-box !important;
    margin-top: 4px !important;
}

.gform_wrapper .gform_body .gfield input:focus,
.gform_wrapper .gform_body .gfield select:focus,
.gform_wrapper .gform_body .gfield textarea:focus {
    outline: none !important;
    border-color: #4b4d97 !important;
    box-shadow: 0 0 0 3px rgba(75, 77, 151, 0.2) !important;
    background-color: #fff !important;
}

.gform_wrapper .gform_body .gfield_label {
    font-weight: 600 !important;
    color: #374151 !important;
    margin-bottom: 5px !important;
    display: inline-block !important;
    font-size: 15px !important;
}

.gform_wrapper .gform_footer button.gform_button,
.gform_wrapper .gform_footer input.gform_button,
.gform_wrapper .gform_footer button[type="submit"] {
    background-color: #ea8529 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    padding: 14px 28px !important;
    border-radius: 30px !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(234, 133, 41, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.gform_wrapper .gform_footer button.gform_button:hover,
.gform_wrapper .gform_footer input.gform_button:hover,
.gform_wrapper .gform_footer button[type="submit"]:hover {
    background-color: #d67420 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 15px rgba(234, 133, 41, 0.4) !important;
}

.gform_wrapper .gform_fields {
    display: grid !important;
    grid-gap: 20px !important;
}

.gform_wrapper .gfield_radio .gchoice {
    margin-bottom: 8px !important;
    display: flex !important;
    align-items: center !important;
}

.gform_wrapper .gfield_radio input[type="radio"] {
    margin-right: 10px !important;
    width: 18px !important;
    height: 18px !important;
    accent-color: #4b4d97 !important;
}

.gform_wrapper .gfield_description p {
    font-size: 13px !important;
    color: #6b7280 !important;
    line-height: 1.5 !important;
    margin-top: 8px !important;
}
</style>

<style>
/* Premium Gravity Forms Overrides */
.gform_wrapper .gform_body .gfield input[type=text],
.gform_wrapper .gform_body .gfield input[type=email],
.gform_wrapper .gform_body .gfield input[type=tel],
.gform_wrapper .gform_body .gfield select,
.gform_wrapper .gform_body .gfield textarea {
    width: 100% !important;
    padding: 12px 15px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    background-color: #ffffff !important;
    color: #1f2937 !important;
    font-size: 16px !important;
    font-family: inherit !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05) inset !important;
    box-sizing: border-box !important;
    margin-top: 4px !important;
}

.gform_wrapper .gform_body .gfield input:focus,
.gform_wrapper .gform_body .gfield select:focus,
.gform_wrapper .gform_body .gfield textarea:focus {
    outline: none !important;
    border-color: #4b4d97 !important;
    box-shadow: 0 0 0 3px rgba(75, 77, 151, 0.2) !important;
    background-color: #fff !important;
}

.gform_wrapper .gform_body .gfield_label {
    font-weight: 600 !important;
    color: #374151 !important;
    margin-bottom: 5px !important;
    display: inline-block !important;
    font-size: 15px !important;
}

.gform_wrapper .gform_footer button.gform_button,
.gform_wrapper .gform_footer input.gform_button,
.gform_wrapper .gform_footer button[type="submit"] {
    background-color: #ea8529 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    padding: 14px 28px !important;
    border-radius: 30px !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(234, 133, 41, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.gform_wrapper .gform_footer button.gform_button:hover,
.gform_wrapper .gform_footer input.gform_button:hover,
.gform_wrapper .gform_footer button[type="submit"]:hover {
    background-color: #d67420 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 15px rgba(234, 133, 41, 0.4) !important;
}

.gform_wrapper .gform_fields {
    display: grid !important;
    grid-gap: 20px !important;
}

.gform_wrapper .gfield_radio .gchoice {
    margin-bottom: 8px !important;
    display: flex !important;
    align-items: center !important;
}

.gform_wrapper .gfield_radio input[type="radio"] {
    margin-right: 10px !important;
    width: 18px !important;
    height: 18px !important;
    accent-color: #4b4d97 !important;
}

.gform_wrapper .gfield_description p {
    font-size: 13px !important;
    color: #6b7280 !important;
    line-height: 1.5 !important;
    margin-top: 8px !important;
}
</style>

<style>
/* Premium Gravity Forms Overrides */
.gform_wrapper .gform_body .gfield input[type=text],
.gform_wrapper .gform_body .gfield input[type=email],
.gform_wrapper .gform_body .gfield input[type=tel],
.gform_wrapper .gform_body .gfield select,
.gform_wrapper .gform_body .gfield textarea {
    width: 100% !important;
    padding: 12px 15px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    background-color: #ffffff !important;
    color: #1f2937 !important;
    font-size: 16px !important;
    font-family: inherit !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05) inset !important;
    box-sizing: border-box !important;
    margin-top: 4px !important;
}

.gform_wrapper .gform_body .gfield input:focus,
.gform_wrapper .gform_body .gfield select:focus,
.gform_wrapper .gform_body .gfield textarea:focus {
    outline: none !important;
    border-color: #4b4d97 !important;
    box-shadow: 0 0 0 3px rgba(75, 77, 151, 0.2) !important;
    background-color: #fff !important;
}

.gform_wrapper .gform_body .gfield_label {
    font-weight: 600 !important;
    color: #374151 !important;
    margin-bottom: 5px !important;
    display: inline-block !important;
    font-size: 15px !important;
}

.gform_wrapper .gform_footer button.gform_button,
.gform_wrapper .gform_footer input.gform_button,
.gform_wrapper .gform_footer button[type="submit"] {
    background-color: #ea8529 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    padding: 14px 28px !important;
    border-radius: 30px !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(234, 133, 41, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.gform_wrapper .gform_footer button.gform_button:hover,
.gform_wrapper .gform_footer input.gform_button:hover,
.gform_wrapper .gform_footer button[type="submit"]:hover {
    background-color: #d67420 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 15px rgba(234, 133, 41, 0.4) !important;
}

.gform_wrapper .gform_fields {
    display: grid !important;
    grid-gap: 20px !important;
}

.gform_wrapper .gfield_radio .gchoice {
    margin-bottom: 8px !important;
    display: flex !important;
    align-items: center !important;
}

.gform_wrapper .gfield_radio input[type="radio"] {
    margin-right: 10px !important;
    width: 18px !important;
    height: 18px !important;
    accent-color: #4b4d97 !important;
}

.gform_wrapper .gfield_description p {
    font-size: 13px !important;
    color: #6b7280 !important;
    line-height: 1.5 !important;
    margin-top: 8px !important;
}
</style>

<style>
/* Premium Gravity Forms Overrides */
.gform_wrapper .gform_body .gfield input[type=text],
.gform_wrapper .gform_body .gfield input[type=email],
.gform_wrapper .gform_body .gfield input[type=tel],
.gform_wrapper .gform_body .gfield select,
.gform_wrapper .gform_body .gfield textarea {
    width: 100% !important;
    padding: 12px 15px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    background-color: #ffffff !important;
    color: #1f2937 !important;
    font-size: 16px !important;
    font-family: inherit !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05) inset !important;
    box-sizing: border-box !important;
    margin-top: 4px !important;
}

.gform_wrapper .gform_body .gfield input:focus,
.gform_wrapper .gform_body .gfield select:focus,
.gform_wrapper .gform_body .gfield textarea:focus {
    outline: none !important;
    border-color: #4b4d97 !important;
    box-shadow: 0 0 0 3px rgba(75, 77, 151, 0.2) !important;
    background-color: #fff !important;
}

.gform_wrapper .gform_body .gfield_label {
    font-weight: 600 !important;
    color: #374151 !important;
    margin-bottom: 5px !important;
    display: inline-block !important;
    font-size: 15px !important;
}

.gform_wrapper .gform_footer button.gform_button,
.gform_wrapper .gform_footer input.gform_button,
.gform_wrapper .gform_footer button[type="submit"] {
    background-color: #ea8529 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    padding: 14px 28px !important;
    border-radius: 30px !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(234, 133, 41, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.gform_wrapper .gform_footer button.gform_button:hover,
.gform_wrapper .gform_footer input.gform_button:hover,
.gform_wrapper .gform_footer button[type="submit"]:hover {
    background-color: #d67420 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 15px rgba(234, 133, 41, 0.4) !important;
}

.gform_wrapper .gform_fields {
    display: grid !important;
    grid-gap: 20px !important;
}

.gform_wrapper .gfield_radio .gchoice {
    margin-bottom: 8px !important;
    display: flex !important;
    align-items: center !important;
}

.gform_wrapper .gfield_radio input[type="radio"] {
    margin-right: 10px !important;
    width: 18px !important;
    height: 18px !important;
    accent-color: #4b4d97 !important;
}

.gform_wrapper .gfield_description p {
    font-size: 13px !important;
    color: #6b7280 !important;
    line-height: 1.5 !important;
    margin-top: 8px !important;
}
</style>

<style>
/* Premium Gravity Forms Overrides */
.gform_wrapper .gform_body .gfield input[type=text],
.gform_wrapper .gform_body .gfield input[type=email],
.gform_wrapper .gform_body .gfield input[type=tel],
.gform_wrapper .gform_body .gfield select,
.gform_wrapper .gform_body .gfield textarea {
    width: 100% !important;
    padding: 12px 15px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    background-color: #ffffff !important;
    color: #1f2937 !important;
    font-size: 16px !important;
    font-family: inherit !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05) inset !important;
    box-sizing: border-box !important;
    margin-top: 4px !important;
}

.gform_wrapper .gform_body .gfield input:focus,
.gform_wrapper .gform_body .gfield select:focus,
.gform_wrapper .gform_body .gfield textarea:focus {
    outline: none !important;
    border-color: #4b4d97 !important;
    box-shadow: 0 0 0 3px rgba(75, 77, 151, 0.2) !important;
    background-color: #fff !important;
}

.gform_wrapper .gform_body .gfield_label {
    font-weight: 600 !important;
    color: #374151 !important;
    margin-bottom: 5px !important;
    display: inline-block !important;
    font-size: 15px !important;
}

.gform_wrapper .gform_footer button.gform_button,
.gform_wrapper .gform_footer input.gform_button,
.gform_wrapper .gform_footer button[type="submit"] {
    background-color: #ea8529 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    padding: 14px 28px !important;
    border-radius: 30px !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(234, 133, 41, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.gform_wrapper .gform_footer button.gform_button:hover,
.gform_wrapper .gform_footer input.gform_button:hover,
.gform_wrapper .gform_footer button[type="submit"]:hover {
    background-color: #d67420 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 15px rgba(234, 133, 41, 0.4) !important;
}

.gform_wrapper .gform_fields {
    display: grid !important;
    grid-gap: 20px !important;
}

.gform_wrapper .gfield_radio .gchoice {
    margin-bottom: 8px !important;
    display: flex !important;
    align-items: center !important;
}

.gform_wrapper .gfield_radio input[type="radio"] {
    margin-right: 10px !important;
    width: 18px !important;
    height: 18px !important;
    accent-color: #4b4d97 !important;
}

.gform_wrapper .gfield_description p {
    font-size: 13px !important;
    color: #6b7280 !important;
    line-height: 1.5 !important;
    margin-top: 8px !important;
}
</style>
</head>
