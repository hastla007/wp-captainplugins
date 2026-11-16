#!/usr/bin/env node
/**
 * Visual regression check for the key page types (desktop and mobile).
 * Usage:
 *   node visual.cjs --base URL --update     store reference images in .visual/baseline/
 *   node visual.cjs --base URL              compare against them; diffs go to .visual/diff/
 * Options: --threshold 0.3 (percent of changed pixels allowed per page), --paths /a/,/b/
 * Exit code 1 when a page changed beyond the threshold or a reference is missing.
 */
const fs = require('fs');
const path = require('path');
const { chromium, devices } = require('playwright');
const { PNG } = require('pngjs');
const pixelmatch = require('pixelmatch');

const args = process.argv.slice(2);
const option = (name, fallback) => { const i = args.indexOf(name); return i >= 0 ? args[i + 1] : fallback; };
const base = option('--base', 'http://localhost:8088').replace(/\/$/, '');
const update = args.includes('--update');
const threshold = parseFloat(option('--threshold', '0.3'));
const paths = (option('--paths', '') || '/,/produkte/,/voucher-captain/,/voucher-captain/features/,/voucher-captain/pro/,/preise/,/course-captain/,/license-captain/,/faq/,/kompatibilitaet/,/ratgeber/,/ratgeber/course-captain/online-kurs-wordpress-erstellen/,/loesungen/akademien/,/gibt-es-nicht/').split(',').filter(Boolean);
const root = path.join(__dirname, '.visual');
const dirs = { baseline: path.join(root, 'baseline'), current: path.join(root, 'current'), diff: path.join(root, 'diff') };
Object.values(dirs).forEach((dir) => fs.mkdirSync(dir, { recursive: true }));
const slug = (p) => (p.replace(/^\/|\/$/g, '').replace(/[^a-z0-9]+/gi, '-') || 'startseite');

(async () => {
	const browser = await chromium.launch(process.env.CHROMIUM_PATH ? { executablePath: process.env.CHROMIUM_PATH } : {});
	const results = [];
	for (const [label, options] of [['desktop', { viewport: { width: 1440, height: 900 } }], ['mobil', { ...devices['iPhone 13'] }]]) {
		const page = await browser.newPage({ ...options, reducedMotion: 'reduce' });
		for (const p of paths) {
			await page.goto(base + p, { waitUntil: 'networkidle' });
			await page.addStyleTag({ content: '*{caret-color:transparent!important;animation:none!important;transition:none!important}' });
			const name = `${slug(p)}-${label}.png`;
			const target = path.join(update ? dirs.baseline : dirs.current, name);
			await page.screenshot({ path: target, fullPage: true });
			if (update) { results.push({ name, status: 'Referenz gespeichert' }); continue; }
			const refFile = path.join(dirs.baseline, name);
			if (!fs.existsSync(refFile)) { results.push({ name, status: 'keine Referenz', fail: true }); continue; }
			const a = PNG.sync.read(fs.readFileSync(refFile));
			const b = PNG.sync.read(fs.readFileSync(target));
			if (a.width !== b.width || a.height !== b.height) {
				results.push({ name, status: `Größe geändert (${a.width}×${a.height} → ${b.width}×${b.height})`, fail: true });
				continue;
			}
			const diff = new PNG({ width: a.width, height: a.height });
			const changed = pixelmatch(a.data, b.data, diff.data, a.width, a.height, { threshold: 0.1 });
			const percent = (changed / (a.width * a.height)) * 100;
			if (percent > 0) fs.writeFileSync(path.join(dirs.diff, name), PNG.sync.write(diff));
			results.push({ name, status: `${percent.toFixed(3)} % Pixel geändert`, fail: percent > threshold });
		}
		await page.close();
	}
	await browser.close();
	for (const r of results) console.log(`${r.fail ? 'ABWEICHUNG' : 'OK        '} ${r.name}: ${r.status}`);
	const failed = results.filter((r) => r.fail).length;
	console.log(update ? `${results.length} Referenzbilder unter ${path.relative(process.cwd(), dirs.baseline)} gespeichert.` : failed ? `${failed} Seiten weichen ab – Differenzbilder unter ${path.relative(process.cwd(), dirs.diff)}.` : `Alle ${results.length} Ansichten unverändert.`);
	process.exit(failed ? 1 : 0);
})();
