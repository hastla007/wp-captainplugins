#!/usr/bin/env node
/**
 * Crawl a site and check every internal page in desktop, tablet and mobile width.
 * Usage: node site-check.cjs --base https://staging.example.com [--axe] [--max 300] [--all-widths] [--seed /shop/,/cart/] [--ignore-axe rule]
 * Checks: HTTP status and broken internal links, horizontal overflow, exactly one visible H1,
 * no skipped heading levels, images without alt, unnamed links, JavaScript errors and – with --axe –
 * axe-core WCAG 2.2 AA rules. Exit code 1 when anything is found.
 */
const fs = require('fs');
const { launch, device } = require('./lib-browser.cjs');

const args = process.argv.slice(2);
const option = (name, fallback) => { const i = args.indexOf(name); return i >= 0 ? args[i + 1] : fallback; };
const base = (option('--base', 'http://localhost:8088')).replace(/\/$/, '');
const max = parseInt(option('--max', '300'), 10);
const useAxe = args.includes('--axe');
// Extra start pages that no menu links to, e.g. shop pages: --seed /shop/,/cart/,/checkout/
const seeds = (option('--seed', '') || '').split(',').filter(Boolean);
// axe rules owned by third-party markup (e.g. WooCommerce), documented in docs/BETRIEB.md: --ignore-axe rule-a,rule-b
const ignoreAxe = (option('--ignore-axe', '') || '').split(',').filter(Boolean);
const axeSource = useAxe ? fs.readFileSync(require.resolve('axe-core/axe.min.js'), 'utf8') : '';
const origin = new URL(base).origin;

async function crawl(context) {
	const page = await context.newPage();
	const seen = new Set(); const queue = ['/', ...seeds]; const broken = new Map(); const pages = [];
	while (queue.length && pages.length < max) {
		const url = queue.shift();
		if (seen.has(url)) continue;
		seen.add(url);
		const response = await page.goto(base + url, { waitUntil: 'domcontentloaded' }).catch(() => null);
		const status = response ? response.status() : 0;
		if (status >= 400 || !status) { continue; }
		pages.push(url);
		const links = await page.$$eval('a[href]', (anchors) => anchors.map((a) => a.href));
		for (const href of links) {
			let target;
			try { target = new URL(href); } catch (e) { continue; }
			if (target.origin !== origin || /\.(css|js|png|jpe?g|webp|svg|xml|zip|pdf)$/i.test(target.pathname) || /^\/(wp-|feed)/.test(target.pathname)) continue;
			// Never follow links that change state (cart, logout, order actions).
			if (/[?&](add-to-cart|remove_item|undo_item|removed_item|order_again|_wpnonce|customer-logout)=?/.test(target.search) || /customer-logout/.test(target.pathname)) continue;
			const key = target.pathname + (target.search && !target.search.includes('replytocom') ? target.search : '');
			if (seen.has(key) || queue.includes(key)) continue;
			const check = await context.request.get(base + key, { maxRedirects: 5 }).catch(() => null);
			if (!check || check.status() >= 400) {
				if (!broken.has(key)) broken.set(key, new Set());
				broken.get(key).add(url);
				seen.add(key);
			} else {
				queue.push(key);
			}
		}
	}
	await page.close();
	return { pages, broken };
}

(async () => {
	const browser = await launch();
	const context = await browser.newContext();
	const { pages, broken } = await crawl(context);
	const problems = [];
	for (const [url, sources] of broken) problems.push(`Toter Link ${url} (verlinkt auf ${[...sources].slice(0, 3).join(', ')})`);
	const viewports = [['Desktop', { viewport: { width: 1440, height: 900 } }], ['Tablet', { viewport: { width: 820, height: 1100 } }], ['Mobil', device('iPhone 13')], ['Zoom 200 %', { viewport: { width: 720, height: 900 } }]];
	if (args.includes('--all-widths')) {
		// Extra widths: smallest phones, tablet landscape right at the navigation breakpoint, large desktop.
		viewports.push(['Klein 320', { viewport: { width: 320, height: 640 } }], ['Tablet quer', { viewport: { width: 1024, height: 768 } }], ['Breit 1920', { viewport: { width: 1920, height: 1080 } }]);
	}
	for (const [label, options] of viewports) {
		const page = await browser.newPage(options);
		const errors = [];
		page.on('pageerror', (error) => errors.push(error.message));
		page.on('console', (message) => { if (message.type() === 'error' && !/404/.test(message.text())) errors.push(message.text()); });
		for (const url of pages) {
			errors.length = 0;
			await page.goto(base + url, { waitUntil: 'networkidle' });
			await page.evaluate(() => document.fonts.ready).catch(() => {}); // measure with the web font, not the fallback
			const result = await page.evaluate(() => {
				const visible = (el) => !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length);
				const levels = [...document.querySelectorAll('main h1, main h2, main h3, main h4, main h5, main h6')].filter(visible).map((h) => +h.tagName[1]);
				return {
					overflow: document.documentElement.scrollWidth - window.innerWidth,
					// Headings that are wider than their box (clipped words, e.g. long compounds on 320 px).
					clipped: [...document.querySelectorAll('h1, h2, h3')].filter((h) => h.offsetParent && h.scrollWidth > h.clientWidth + 1).map((h) => h.textContent.trim().slice(0, 40)),
					h1: [...document.querySelectorAll('h1')].filter(visible).length,
					jump: levels.some((level, i) => i > 0 && level - levels[i - 1] > 1),
					noAlt: document.querySelectorAll('img:not([alt])').length,
					lang: document.documentElement.getAttribute('lang') || '',
					unnamed: [...document.querySelectorAll('a:not([tabindex="-1"]):not([aria-hidden="true"]), button:not([aria-hidden="true"])')].filter((el) => visible(el) && !el.textContent.trim() && !el.getAttribute('aria-label') && !el.querySelector('img[alt]:not([alt=""])')).length,
				};
			});
			const issues = [];
			if (result.overflow > 0) issues.push(`horizontaler Überlauf ${result.overflow}px`);
			if (result.clipped.length) issues.push(`Überschrift breiter als ihr Rahmen: ${result.clipped.slice(0, 3).join(' | ')}`);
			if (result.h1 !== 1) issues.push(`${result.h1} sichtbare H1`);
			if (result.jump) issues.push('Überschriftenebene übersprungen');
			if (!result.lang) issues.push('html ohne lang-Attribut');
			if (result.noAlt) issues.push(`${result.noAlt} Bilder ohne alt`);
			if (result.unnamed) issues.push(`${result.unnamed} Links/Buttons ohne Namen`);
			if (errors.length) issues.push(`JS-Fehler: ${errors[0].slice(0, 120)}`);
			if (useAxe && label !== 'Tablet') {
				await page.addScriptTag({ content: axeSource });
				const axe = await page.evaluate(async () => (await window.axe.run(document, { runOnly: ['wcag2a', 'wcag2aa', 'wcag21a', 'wcag21aa', 'wcag22aa', 'best-practice'] })).violations.map((v) => `${v.id} (${v.nodes.length})`)).then((list) => list.filter((entry) => !ignoreAxe.includes(entry.split(' ')[0])));
				if (axe.length) issues.push(`axe: ${axe.join(', ')}`);
			}
			if (issues.length) problems.push(`${label} ${url}: ${issues.join('; ')}`);
		}
		await page.close();
	}
	await browser.close();
	console.log(`${pages.length} Seiten gecrawlt und in ${viewports.length} Ansichten geprüft${useAxe ? ' (mit axe-core)' : ''}.`);
	console.log(problems.length ? problems.map((p) => '  ' + p).join('\n') : '  Keine Befunde.');
	process.exit(problems.length ? 1 : 0);
})();
