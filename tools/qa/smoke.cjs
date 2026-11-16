#!/usr/bin/env node
/**
 * Short smoke check after activation or an update (Roadmap Phase 10).
 * Usage: node smoke.cjs --base https://www.example.com [--paths /extra/,/pfad/]
 *        [--shop] [--shop-paths /shop/,/warenkorb/,/kasse/,/mein-konto/] [--product /produkt/slug/]
 * Checks the key pages for HTTP 200, a visible H1, header and footer, the theme stylesheet,
 * a correct 404 status and a working search. With --shop the shop pages are checked as well; with
 * --product the product is put into the cart and the checkout must show it together with an order
 * button (no order is placed). Exit code 1 on any failure.
 */
const { launch, device } = require('./lib-browser.cjs');

const args = process.argv.slice(2);
const option = (name, fallback) => { const i = args.indexOf(name); return i >= 0 ? args[i + 1] : fallback; };
const base = option('--base', 'http://localhost:8088').replace(/\/$/, '');
const extra = (option('--paths', '') || '').split(',').filter(Boolean);
const shopPaths = args.includes('--shop') ? (option('--shop-paths', '/shop/,/cart/,/checkout/,/my-account/') || '').split(',').filter(Boolean) : [];
const product = option('--product', '');
const paths = ['/', '/produkte/', '/voucher-captain/', '/captain-pro/', '/preise/', '/license-captain/', '/dokumentation/', '/support/', '/faq/', ...shopPaths, ...extra];

(async () => {
	const browser = await launch();
	const page = await browser.newPage({ viewport: { width: 1280, height: 900 } });
	const results = [];
	const check = (name, ok, detail = '') => results.push({ name, ok, detail });
	for (const path of paths) {
		const response = await page.goto(base + path, { waitUntil: 'domcontentloaded' }).catch((e) => ({ status: () => 0, error: e }));
		const status = response.status();
		const info = status ? await page.evaluate(() => ({
			h1: [...document.querySelectorAll('h1')].filter((h) => h.offsetParent).length,
			header: !!document.querySelector('.cp-site-header'),
			footer: !!document.querySelector('.cp-site-footer'),
			css: !!document.querySelector('link[href*="captain-plugins/assets/css/theme.css"]'),
			criticalError: document.body.innerText.includes('critical error') || document.body.innerText.includes('kritischer Fehler'),
		})) : {};
		check(`${path} lädt`, status === 200, `HTTP ${status || 'keine Verbindung'}`);
		if (status === 200) check(`${path} vollständig`, info.h1 === 1 && info.header && info.footer && info.css && !info.criticalError, JSON.stringify(info));
	}
	const statusOf = async (url) => {
		const response = await page.goto(url, { waitUntil: 'domcontentloaded' }).catch(() => null);
		return response ? response.status() : 0;
	};
	const missing = await statusOf(base + '/captain-smoke-check-gibt-es-nicht/');
	check('404 liefert Status 404', missing === 404, `HTTP ${missing || 'keine Verbindung'}`);
	const search = await statusOf(base + '/?s=Gutschein');
	check('Suche erreichbar', search === 200, `HTTP ${search || 'keine Verbindung'}`);
	if (product) {
		const checkoutPath = shopPaths.find((p) => /checkout|kasse/.test(p)) || '/checkout/';
		const status = await statusOf(base + product);
		check(`${product} lädt`, status === 200, `HTTP ${status || 'keine Verbindung'}`);
		const button = page.locator('.single_add_to_cart_button, button[name="add-to-cart"]').first();
		if (status === 200 && await button.count()) {
			await button.click();
			await page.waitForLoadState('networkidle').catch(() => {});
			await page.goto(base + checkoutPath, { waitUntil: 'networkidle' }).catch(() => {});
			const ready = await page.locator('.wc-block-components-checkout-place-order-button, #place_order').first().isVisible({ timeout: 15000 }).catch(() => false);
			const items = await page.locator('.wc-block-components-order-summary-item, .woocommerce-checkout-review-order-table .cart_item').count();
			check('Checkout zeigt Warenkorb und Bestellknopf', ready && items > 0, `Bestellknopf ${ready ? 'ja' : 'nein'}, Positionen ${items}`);
		} else {
			check('In den Warenkorb legen möglich', false, 'kein Warenkorb-Button gefunden');
		}
	}
	await browser.close();
	for (const r of results) console.log(`${r.ok ? 'OK  ' : 'FEHLER'} ${r.name}${r.ok ? '' : ' – ' + r.detail}`);
	const failed = results.filter((r) => !r.ok).length;
	console.log(failed ? `${failed} Prüfungen fehlgeschlagen.` : `Alle ${results.length} Prüfungen bestanden.`);
	process.exit(failed ? 1 : 0);
})();
