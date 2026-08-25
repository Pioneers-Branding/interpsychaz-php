/**
 * Downloads any asset referenced by the site but missing from wp-content/.
 *
 * Some binaries (e.g. the Meet Our Team staff photos) were never copied during the
 * static port. Run this with the VPN connected, then re-run `node build.js`.
 *
 *   node fetch-missing-assets.js            # download what's missing
 *   node fetch-missing-assets.js --dry-run  # just list what's missing
 */
const fs = require('fs');
const path = require('path');
const https = require('https');

const SRC = __dirname;
const ORIGIN = 'https://interpsychaz.com';
const DRY = process.argv.includes('--dry-run');

function collectRefs() {
  const refs = new Map(); // url -> Set(files)
  const files = fs.readdirSync(SRC).filter(f => f.endsWith('.php'))
    .concat(['includes/head.php', 'includes/header.php', 'includes/footer.php']);

  const add = (u, f) => {
    if (!u) return;
    u = u.replace(/^https?:\/\/(?:www\.)?interpsychaz\.com/i, '').split('?')[0].split('#')[0];
    if (!u.startsWith('/wp-content') && !u.startsWith('/wp-includes')) return;
    if (!refs.has(u)) refs.set(u, new Set());
    refs.get(u).add(f);
  };

  for (const f of files) {
    const s = fs.readFileSync(path.join(SRC, f), 'utf8');
    for (const m of s.matchAll(/\b(?:src|href|data-lazy-src|data-bg|data-lazy-bg|poster)="([^"]+)"/gi)) add(m[1].trim(), f);
    for (const m of s.matchAll(/background-image:\s*url\(([^)]+)\)/gi)) add(m[1].replace(/['"]/g, '').trim(), f);
    for (const attr of ['srcset', 'data-lazy-srcset']) {
      for (const m of s.matchAll(new RegExp('\\b' + attr + '="([^"]+)"', 'gi'))) {
        for (const part of m[1].split(',')) add(part.trim().split(/\s+/)[0], f);
      }
    }
  }
  return refs;
}

function download(urlPath, dest) {
  return new Promise((resolve, reject) => {
    https.get(ORIGIN + urlPath, res => {
      if (res.statusCode !== 200) { res.resume(); return reject(new Error('HTTP ' + res.statusCode)); }
      fs.mkdirSync(path.dirname(dest), { recursive: true });
      const out = fs.createWriteStream(dest);
      res.pipe(out);
      out.on('finish', () => out.close(() => resolve(fs.statSync(dest).size)));
      out.on('error', reject);
    }).on('error', reject).setTimeout(30000, function () { this.destroy(new Error('timeout')); });
  });
}

(async () => {
  const refs = collectRefs();
  const missing = [...refs.keys()]
    .filter(u => !fs.existsSync(path.join(SRC, decodeURIComponent(u))))
    .sort();

  console.log(`Referenced assets: ${refs.size}   Missing locally: ${missing.length}`);
  if (!missing.length) return console.log('Nothing to download.');

  for (const u of missing) console.log('  missing: ' + u + '   <- ' + [...refs.get(u)].slice(0, 3).join(', '));
  if (DRY) return console.log('\n(dry run - nothing downloaded)');

  console.log('\nDownloading from ' + ORIGIN + ' ...');
  let ok = 0, fail = 0;
  for (const u of missing) {
    const dest = path.join(SRC, decodeURIComponent(u));
    try {
      const size = await download(u, dest);
      console.log(`  OK   ${u} (${size} bytes)`);
      ok++;
    } catch (e) {
      console.log(`  FAIL ${u} - ${e.message}`);
      fail++;
    }
  }
  console.log(`\nDownloaded ${ok}, failed ${fail}.`);
  if (ok) console.log('Now re-run: node build.js');
})();
