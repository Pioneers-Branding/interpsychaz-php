const fs = require("fs");
const path = require("path");

const root = path.resolve(__dirname, "..");

const bundleA = [
  "/wp-content/uploads/dmm-consent-guard/fonts/fonts-e32582ff5559e0a721ad.css",
  "/wp-content/cache/min/1/wp-content/plugins/dmm-consent-guard/assets/css/banner.css",
  "/wp-content/cache/min/1/wp-content/themes/mts_schema/content/css/ada.css",
  "/wp-content/cache/min/1/wp-content/themes/blossom-child/style.css",
  "/wp-content/themes/mts_schema/css/animate.min.css",
  "/wp-content/cache/min/1/wp-content/themes/mts_schema/fonts/all.min.css",
  "/wp-content/cache/min/1/wp-content/themes/mts_schema/css/responsive.css",
  "/wp-content/cache/min/1/wp-content/themes/mts_schema/content/css/content-style.css",
];

const bundleGform = [
  "/wp-content/cache/min/1/wp-content/plugins/gravityforms/assets/css/dist/basic.min.css",
  "/wp-content/plugins/gravityforms/assets/css/dist/theme-components.min.css",
  "/wp-content/plugins/gravityforms/assets/css/dist/theme.min.css",
];

function rewriteUrls(css, fileWebPath) {
  const dirWeb = path.posix.dirname(fileWebPath);
  return css.replace(/url\(\s*(['"]?)([^'")]+)\1\s*\)/g, (m, q, u) => {
    if (/^(data:|https?:|#|\/\/)/i.test(u)) return `url(${q}${u}${q})`;
    if (u.startsWith("/")) return `url(${q}${u}${q})`;
    const resolved = path.posix.normalize(path.posix.join(dirWeb, u));
    return `url(${q}${resolved}${q})`;
  });
}

function readCss(webPath) {
  const file = path.join(root, webPath.replace(/^\//, "").split("/").join(path.sep));
  if (!fs.existsSync(file)) throw new Error("missing: " + file);
  const raw = fs.readFileSync(file, "utf8");
  if (/@import\b/.test(raw)) console.log("WARNING @import found in " + webPath);
  return `/* ==== ${webPath} ==== */\n` + rewriteUrls(raw, webPath) + "\n";
}

const headFix = path.join(root, "tools", "site-master-fixes.css");
if (!fs.existsSync(headFix)) throw new Error("missing: " + headFix);
const masterFixes = "\n/* ==== inline: site-master-fixes-css ==== */\n" + fs.readFileSync(headFix, "utf8") + "\n";

const outDir = path.join(root, "wp-content", "cache", "min", "perf");
fs.mkdirSync(outDir, { recursive: true });

const a = bundleA.map(readCss).join("\n");
const b = masterFixes;
const g = bundleGform.map(readCss).join("\n");

fs.writeFileSync(path.join(outDir, "bundle-a.css"), a, "utf8");
fs.writeFileSync(path.join(outDir, "bundle-b.css"), b, "utf8");
fs.writeFileSync(path.join(outDir, "bundle-gform.css"), g, "utf8");

console.log("bundle-a.css", a.length, "bytes");
console.log("bundle-b.css", b.length, "bytes");
console.log("bundle-gform.css", g.length, "bytes");
