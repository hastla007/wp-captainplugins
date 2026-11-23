#!/usr/bin/env node
/**
 * Render imported pages in the real Gutenberg block-editor canvas with the theme styles and check them.
 * Usage: node editor-check.cjs [content-file.html ...]   (default: start page, Voucher Captain, prices, a guide)
 * Needs global-styles CSS from WordPress: wp eval 'echo wp_get_global_stylesheet();' > tools/qa/editor/global.css
 * (falls back to the committed copy). Reports blocks rendered, invalid-block warnings and horizontal overflow;
 * screenshots go to .visual/editor/. Exit code 1 on invalid blocks or overflow.
 */
const fs = require('fs');
const path = require('path');
const http = require('http');
const esbuild = require('esbuild');
const { chromium } = require('playwright');

const qa = __dirname;
const theme = path.resolve(qa, '../../theme/captain-plugins');
const pages = path.join(theme, 'content/pages');
const out = path.join(qa, '.visual/editor');
fs.mkdirSync(out, { recursive: true });
const files = process.argv.length > 2 ? process.argv.slice(2) : ['da39a3ee-startseite.html', '5b8b6745-voucher-captain.html', 'a7301b38-preise.html'].map((f) => path.join(pages, f));

(async () => {
	await esbuild.build({ entryPoints: [path.join(qa, 'editor/app.jsx')], bundle: true, outfile: path.join(out, 'app.js'), jsx: 'automatic', define: { 'process.env.NODE_ENV': '"production"', global: 'window' }, loader: { '.js': 'jsx' }, logLevel: 'error' });
	const wp = path.join(qa, 'node_modules/@wordpress');
	const read = (p) => fs.readFileSync(path.join(wp, p), 'utf8');
	const inside = ['block-library/build-style/common.css', 'block-library/build-style/style.css', 'block-library/build-style/theme.css', 'block-editor/build-style/content.css'].map(read).join('\n');
	const outer = ['components/build-style/style.css', 'block-editor/build-style/style.css', 'block-library/build-style/editor.css'].map(read).join('\n');
	const globalCss = fs.readFileSync(path.join(qa, 'editor/global.css'), 'utf8');
	const themeCss = fs.readFileSync(path.join(theme, 'assets/css/theme.css'), 'utf8').replace(/url\("\.\.\/images\//g, 'url("/images/');
	const server = http.createServer((req, res) => {
		const url = decodeURIComponent(req.url.split('?')[0]);
		if (url.startsWith('/images/')) { const f = path.join(theme, 'assets', url); if (fs.existsSync(f)) { res.writeHead(200, { 'Content-Type': 'image/webp' }); return res.end(fs.readFileSync(f)); } }
		if (url === '/app.js') { res.writeHead(200, { 'Content-Type': 'text/javascript' }); return res.end(fs.readFileSync(path.join(out, 'app.js'))); }
		const file = files.find((f) => '/' + path.basename(f) === url);
		if (!file) { res.writeHead(404); return res.end(); }
		const content = fs.readFileSync(file, 'utf8').replace(/\{\{year\}\}/g, '2026');
		res.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8' });
		res.end(`<!doctype html><html><head><meta charset="utf-8"><style>${outer}body{margin:0}</style></head><body><div id="root"></div><script>window.GLOBAL_CSS=${JSON.stringify(globalCss + inside)};window.THEME_CSS=${JSON.stringify(themeCss)};window.CONTENT=${JSON.stringify(content)};</script><script src="/app.js"></script></body></html>`);
	});
	await new Promise((resolve) => server.listen(0, '127.0.0.1', resolve));
	const port = server.address().port;
	const browser = await chromium.launch(process.env.CHROMIUM_PATH ? { executablePath: process.env.CHROMIUM_PATH } : {});
	const page = await browser.newPage({ viewport: { width: 1440, height: 2400 } });
	const errors = [];
	page.on('pageerror', (e) => errors.push(e.message));
	let failed = 0;
	for (const file of files) {
		await page.goto(`http://127.0.0.1:${port}/${path.basename(file)}`);
		await page.waitForTimeout(5000);
		const frame = page.frames().find((f) => f !== page.mainFrame());
		const info = frame ? await frame.evaluate(() => ({ blocks: document.querySelectorAll('[data-block]').length, invalid: document.querySelectorAll('.block-editor-warning').length, overflow: document.documentElement.scrollWidth - document.documentElement.clientWidth })) : null;
		await page.screenshot({ path: path.join(out, path.basename(file, '.html') + '.png') });
		const bad = !info || info.blocks === 0 || info.invalid > 0 || info.overflow > 0;
		failed += bad ? 1 : 0;
		console.log(`${bad ? 'FEHLER' : 'OK    '} ${path.basename(file)}: ${info ? `${info.blocks} Blöcke, ${info.invalid} ungültig, Überlauf ${info.overflow}px` : 'Editor-Canvas nicht geladen'}`);
	}
	if (errors.length) console.log('JS-Fehler:', [...new Set(errors)].slice(0, 3).join(' | '));
	await browser.close();
	server.close();
	console.log(`Screenshots unter ${path.relative(process.cwd(), out)}`);
	process.exit(failed || errors.length ? 1 : 0);
})();
