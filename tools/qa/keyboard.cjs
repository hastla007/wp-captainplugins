#!/usr/bin/env node
/**
 * Keyboard and focus check (Roadmap Phase 9).
 * Usage: node keyboard.cjs --base https://staging.example.com [--paths /,/preise/] [--checkout /checkout/ --product /produkt/slug/]
 *
 * For each page (desktop and mobile): the first Tab reaches the skip link, the skip link moves focus to
 * the main content, every focusable element reached by Tab shows a visible focus indicator, no focus
 * lands on hidden elements, and the header submenus open with Enter and close with Escape.
 * With --checkout and --product: an empty checkout submission marks the invalid fields with
 * aria-invalid and names the error text via aria-describedby or a live region.
 */
const { launch, device } = require('./lib-browser.cjs');

const args = process.argv.slice(2);
const option = (name, fallback) => { const i = args.indexOf(name); return i >= 0 ? args[i + 1] : fallback; };
const base = option('--base', 'http://localhost:8088').replace(/\/$/, '');
const paths = (option('--paths', '') || '/,/voucher-captain/,/preise/,/faq/,/kompatibilitaet/,/dokumentation/').split(',').filter(Boolean);
const checkout = option('--checkout', '');
const product = option('--product', '');
const maxTabs = parseInt(option('--max-tabs', '80'), 10);

const focusInfo = () => {
	const el = document.activeElement;
	if (!el || el === document.body) return null;
	const style = getComputedStyle(el);
	const rect = el.getBoundingClientRect();
	const outline = style.outlineStyle !== 'none' && parseFloat(style.outlineWidth) > 0;
	const shadow = style.boxShadow && style.boxShadow !== 'none';
	return {
		label: (el.getAttribute('aria-label') || el.textContent || el.getAttribute('name') || el.tagName).trim().replace(/\s+/g, ' ').slice(0, 50),
		tag: el.tagName.toLowerCase(),
		visible: rect.width > 0 && rect.height > 0 && style.visibility !== 'hidden',
		indicator: outline || shadow,
		skip: el.classList.contains('skip-link'),
	};
};

(async () => {
	const browser = await launch();
	const problems = [];
	let checked = 0;
	for (const [view, options] of [['Desktop', { viewport: { width: 1440, height: 900 } }], ['Mobil', device('iPhone 13')]]) {
		const page = await browser.newPage(options);
		for (const p of paths) {
			await page.goto(base + p, { waitUntil: 'networkidle' });
			const preset = await page.evaluate(focusInfo);
			if (preset) {
				// The page moved focus itself (e.g. WooCommerce focuses the empty-cart notice); the skip link is then behind it.
				console.log(`Hinweis ${view} ${p}: Seite setzt den Fokus beim Laden auf „${preset.label}“.`);
				await page.evaluate(() => { const root = document.documentElement; root.setAttribute('tabindex', '-1'); root.focus(); root.removeAttribute('tabindex'); });
			}
			await page.keyboard.press('Tab');
			const first = await page.evaluate(focusInfo);
			if (!first || !first.skip) problems.push(`${view} ${p}: erster Tab erreicht nicht den Skip-Link (${first ? first.label : 'nichts'})`);
			else {
				await page.keyboard.press('Enter');
				const inMain = await page.evaluate(() => { const main = document.querySelector('main'); return !!main && (main === document.activeElement || main.contains(document.activeElement) || location.hash === '#' + main.id); });
				if (!inMain) problems.push(`${view} ${p}: Skip-Link führt nicht zum Hauptinhalt`);
			}
			await page.goto(base + p, { waitUntil: 'networkidle' });
			const seen = new Set();
			for (let i = 0; i < maxTabs; i += 1) {
				await page.keyboard.press('Tab');
				const info = await page.evaluate(focusInfo);
				if (!info) break;
				checked += 1;
				const key = `${info.tag}:${info.label}`;
				if (!info.visible) problems.push(`${view} ${p}: Fokus auf unsichtbarem Element ${key}`);
				else if (!info.indicator && !seen.has(key)) problems.push(`${view} ${p}: kein sichtbarer Fokusrahmen bei ${key}`);
				seen.add(key);
			}
		}
		if (view === 'Desktop') {
			await page.goto(base + paths[0], { waitUntil: 'networkidle' });
			const toggle = page.locator('.cp-main-nav .wp-block-navigation-submenu__toggle').first();
			if (await toggle.count()) {
				await toggle.focus();
				await page.keyboard.press('Enter');
				await page.waitForTimeout(300); // the navigation's click handler runs asynchronously
				const open = await toggle.getAttribute('aria-expanded');
				await page.keyboard.press('Escape');
				await page.waitForTimeout(300);
				const closed = await toggle.getAttribute('aria-expanded');
				if (open !== 'true') problems.push('Desktop: Untermenü öffnet nicht mit Enter');
				if (closed !== 'false') problems.push('Desktop: Untermenü schließt nicht mit Escape');
			}
		} else {
			await page.goto(base + paths[0], { waitUntil: 'networkidle' });
			const opener = page.locator('.wp-block-navigation__responsive-container-open').first();
			if (await opener.count()) {
				await opener.focus();
				await page.keyboard.press('Enter');
				await page.waitForTimeout(300);
				const inDialog = await page.evaluate(() => !!document.activeElement.closest('.wp-block-navigation__responsive-container.is-menu-open'));
				await page.keyboard.press('Escape');
				await page.waitForTimeout(300);
				const back = await page.evaluate(() => document.activeElement && document.activeElement.classList.contains('wp-block-navigation__responsive-container-open'));
				if (!inDialog) problems.push('Mobil: Fokus springt beim Öffnen nicht ins Menü');
				if (!back) problems.push('Mobil: Escape schließt das Menü nicht oder Fokus kehrt nicht zum Menüknopf zurück');
			}
		}
		await page.close();
	}
	if (checkout && product) {
		const page = await browser.newPage({ viewport: { width: 1280, height: 900 } });
		await page.goto(base + product, { waitUntil: 'networkidle' });
		await page.locator('.single_add_to_cart_button, button[name="add-to-cart"]').first().click().catch(() => {});
		await page.waitForLoadState('networkidle');
		await page.goto(base + checkout, { waitUntil: 'networkidle' });
		await page.locator('.wc-block-components-checkout-place-order-button, #place_order').first().click().catch(() => {});
		await page.waitForTimeout(2000);
		const result = await page.evaluate(() => {
			const invalid = [...document.querySelectorAll('[aria-invalid="true"]')];
			const described = invalid.filter((el) => (el.getAttribute('aria-describedby') || '').split(' ').some((id) => id && document.getElementById(id) && document.getElementById(id).textContent.trim()));
			const live = [...document.querySelectorAll('[role="alert"], [aria-live="assertive"], [aria-live="polite"]')].some((el) => el.textContent.trim().length > 0);
			return { invalid: invalid.length, described: described.length, live };
		});
		checked += 1;
		if (!result.invalid) problems.push('Checkout: leeres Formular markiert keine Felder mit aria-invalid');
		else if (result.described < result.invalid && !result.live) problems.push(`Checkout: ${result.invalid - result.described} ungültige Felder ohne verknüpfte Fehlermeldung und ohne Live-Region`);
		console.log(`Checkout-Fehlerzustand: ${result.invalid} Felder ungültig, ${result.described} mit verknüpfter Meldung, Live-Region ${result.live ? 'ja' : 'nein'}`);
		await page.close();
	}
	await browser.close();
	console.log(`${checked} Fokusschritte auf ${paths.length} Seiten in 2 Ansichten geprüft.`);
	if (problems.length) { problems.forEach((p) => console.log('  ' + p)); process.exit(1); }
	console.log('  Keine Befunde.');
})();
