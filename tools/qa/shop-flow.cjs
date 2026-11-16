#!/usr/bin/env node
/**
 * End-to-end shop walk-through for staging or a local test shop (Roadmap Phase 7).
 * Usage: node shop-flow.cjs --base https://staging.example.com [--out shop-shots]
 *        [--shop /shop/] [--cart /cart/] [--checkout /checkout/] [--account /my-account/] [--order]
 *
 * Desktop (1366 px) and mobile (390 px): catalogue → product → add to cart → cart → checkout →
 * empty-form validation → (with --order) test order with the first offline payment method →
 * order confirmation → account login form. Screenshots go to --out; JavaScript errors are listed.
 * --order places real orders: use it only in a test shop or with a test payment method.
 */
const fs = require('fs');
const path = require('path');
const { launch, device } = require('./lib-browser.cjs');

const args = process.argv.slice(2);
const option = (name, fallback) => { const i = args.indexOf(name); return i >= 0 ? args[i + 1] : fallback; };
const base = option('--base', 'http://localhost:8088').replace(/\/$/, '');
const out = option('--out', 'shop-shots');
const urls = {
	shop: option('--shop', '/shop/'),
	cart: option('--cart', '/cart/'),
	checkout: option('--checkout', '/checkout/'),
	account: option('--account', '/my-account/'),
};
const placeOrder = args.includes('--order');

(async () => {
	fs.mkdirSync(out, { recursive: true });
	const browser = await launch();
	let failures = 0;
	for (const [view, width, height] of [['desktop', 1366, 900], ['mobil', 390, 844]]) {
		const context = await browser.newContext({ viewport: { width, height } });
		const page = await context.newPage();
		const errors = [];
		page.on('pageerror', (e) => errors.push(String(e)));
		page.on('console', (m) => m.type() === 'error' && errors.push(m.text()));
		const shot = async (name) => { await page.waitForTimeout(700); await page.screenshot({ path: path.join(out, `${view}-${name}.png`), fullPage: true }); };
		const step = (name, ok, detail = '') => { console.log(`${ok ? 'OK  ' : 'FEHLER'} ${view}: ${name}${ok ? '' : ' – ' + detail}`); if (!ok) failures += 1; };

		await page.goto(base + urls.shop, { waitUntil: 'networkidle' });
		await shot('1-katalog');
		const link = await page.locator('.wc-block-product a[href], li.product a[href]').first().getAttribute('href').catch(() => null);
		step('Katalog zeigt Produkte', !!link, 'kein Produktlink gefunden');
		if (!link) { await context.close(); continue; }
		await page.goto(link, { waitUntil: 'networkidle' });
		await shot('2-produkt');
		const add = page.locator('.single_add_to_cart_button, button[name="add-to-cart"]').first();
		step('Produktseite hat Warenkorb-Button', await add.count() > 0, 'kein Button');
		await add.click().catch(() => {});
		await page.waitForLoadState('networkidle');
		await page.goto(base + urls.cart, { waitUntil: 'networkidle' });
		await shot('3-warenkorb');
		await page.goto(base + urls.checkout, { waitUntil: 'networkidle' });
		await page.waitForTimeout(1200);
		await shot('4-checkout');
		const submit = page.locator('.wc-block-components-checkout-place-order-button, #place_order').first();
		step('Checkout hat Bestellknopf', await submit.count() > 0, 'kein Bestellknopf');
		if (await submit.count()) {
			await submit.click();
			await page.waitForTimeout(1500);
			await shot('5-checkout-fehler');
			const invalid = await page.locator('.wc-block-components-validation-error, .woocommerce-error, .woocommerce-invalid').count();
			step('Leeres Formular zeigt Fehlermeldungen', invalid > 0, 'keine Fehlermeldung sichtbar');
		}
		if (placeOrder && await submit.count()) {
			const fill = async (selector, value) => { const field = page.locator(selector).first(); if (await field.count() && await field.isEditable()) await field.fill(value); };
			for (const [selector, value] of [
				['#email', `test-${view}@example.com`], ['#billing_email', `test-${view}@example.com`],
				['#billing-first_name', 'Erika'], ['#billing_first_name', 'Erika'],
				['#billing-last_name', 'Muster'], ['#billing_last_name', 'Muster'],
				['#billing-address_1', 'Hauptstraße 1'], ['#billing_address_1', 'Hauptstraße 1'],
				['#billing-postcode', '1010'], ['#billing_postcode', '1010'],
				['#billing-city', 'Wien'], ['#billing_city', 'Wien'],
				['#billing_phone', '+43 1 234567'],
			]) await fill(selector, value);
			await submit.click();
			await page.waitForURL(/order-received|bestellung-erhalten/, { timeout: 20000 }).catch(() => {});
			await shot('6-bestaetigung');
			step('Testbestellung führt zur Bestätigung', /order-received|bestellung-erhalten/.test(page.url()), page.url());
		}
		await page.goto(base + urls.account, { waitUntil: 'networkidle' });
		await shot('7-konto');
		step('Keine JavaScript-Fehler', errors.length === 0, errors.slice(0, 3).join(' | '));
		await context.close();
	}
	await browser.close();
	console.log(failures ? `${failures} Schritte fehlgeschlagen. Screenshots: ${out}` : `Alle Schritte bestanden. Screenshots: ${out}`);
	process.exit(failures ? 1 : 0);
})();
