const { execSync, spawn } = require('child_process');
const fs = require('fs');
const path = require('path');
const http = require('http');

const SRC_DIR = __dirname;
const OUT_DIR = path.join(__dirname, 'public');

// Pages to build (all PHP files except config and includes)
const pages = [];

function findPhpFiles(dir, baseDir = dir) {
  const items = fs.readdirSync(dir);
  for (const item of items) {
    const fullPath = path.join(dir, item);
    const stat = fs.statSync(fullPath);
    if (stat.isDirectory() && !['wp-content', 'wp-includes', '_external', '.git', 'includes', 'public', 'node_modules'].includes(item)) {
      findPhpFiles(fullPath, baseDir);
    } else if (stat.isFile() && item.endsWith('.php') && item !== 'config.php' && item !== 'router.php' && !fullPath.includes('includes')) {
      const relative = path.relative(baseDir, fullPath).replace(/\.php$/, '');
      pages.push({
        phpFile: fullPath,
        outputName: relative === 'index' ? 'index.html' : relative + '/index.html',
        outputDir: path.join(OUT_DIR, relative === 'index' ? '' : relative),
      });
    }
  }
}

findPhpFiles(SRC_DIR);

console.log(`Found ${pages.length} pages to build`);

// Ensure output directories exist
for (const page of pages) {
  fs.mkdirSync(page.outputDir, { recursive: true });
}

// Copy static assets
function copyDirSync(src, dest) {
  if (!fs.existsSync(src)) return;
  fs.mkdirSync(dest, { recursive: true });
  const items = fs.readdirSync(src);
  for (const item of items) {
    const srcPath = path.join(src, item);
    const destPath = path.join(dest, item);
    if (item === '.git' || item === 'node_modules' || item === 'public') continue;
    const stat = fs.statSync(srcPath);
    if (stat.isDirectory()) {
      copyDirSync(srcPath, destPath);
    } else {
      fs.copyFileSync(srcPath, destPath);
    }
  }
}

// Copy wp-content, wp-includes, _external
console.log('Copying static assets...');
for (const asset of ['wp-content', 'wp-includes', '_external']) {
  const srcPath = path.join(SRC_DIR, asset);
  const destPath = path.join(OUT_DIR, asset);
  if (fs.existsSync(srcPath)) {
    copyDirSync(srcPath, destPath);
    console.log(`  Copied ${asset}`);
  }
}

// Copy .htaccess if exists
const htaccessSrc = path.join(SRC_DIR, '.htaccess');
if (fs.existsSync(htaccessSrc)) {
  fs.copyFileSync(htaccessSrc, path.join(OUT_DIR, '.htaccess'));
}

// Check if PHP is available in the build environment
function hasPhp() {
  try {
    execSync('php -v', { stdio: 'ignore' });
    return true;
  } catch (e) {
    return false;
  }
}

// Start PHP built-in server and render pages
async function renderPages() {
  if (!hasPhp()) {
    console.log('Notice: PHP binary not found in build environment (e.g., Vercel build).');
    console.log('Using pre-rendered static HTML and assets in /public directory.');
    console.log('\nBuild complete! Output in /public directory');
    return;
  }

  console.log('Starting PHP server...');
  
  const phpProcess = spawn('php', ['-S', '127.0.0.1:8888', 'router.php'], {
    cwd: SRC_DIR,
    stdio: 'ignore',
  });

  // Handle spawn error gracefully
  phpProcess.on('error', (err) => {
    console.warn(`Warning: Failed to spawn PHP: ${err.message}`);
  });

  // Wait for server to start
  await new Promise(resolve => setTimeout(resolve, 2000));

  console.log('Rendering pages...');

  for (const page of pages) {
    try {
      const urlPath = path.relative(SRC_DIR, page.phpFile).replace(/\\/g, '/').replace(/\.php$/, '');
      const url = `http://127.0.0.1:8888/${urlPath}`;
      
      const html = await new Promise((resolve, reject) => {
        http.get(url, (res) => {
          let data = '';
          res.on('data', chunk => data += chunk);
          res.on('end', () => resolve(data));
        }).on('error', reject);
      });

      fs.writeFileSync(path.join(OUT_DIR, page.outputName), html);
      console.log(`  Built: ${page.outputName}`);
    } catch (err) {
      console.error(`  Error building ${page.phpFile}: ${err.message}`);
    }
  }

  try {
    phpProcess.kill();
  } catch (e) {}
  console.log('\nBuild complete! Output in /public directory');
}

renderPages().catch(console.error);
