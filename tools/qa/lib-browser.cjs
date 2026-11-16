/**
 * Shared browser start for the QA scripts.
 * BROWSER=chromium (default) | firefox | webkit selects the engine; CHROMIUM_PATH points to an
 * existing Chrome/Chromium binary. Firefox does not support Playwright's isMobile option, so mobile
 * device presets are reduced to viewport, user agent and touch there.
 */
const playwright = require('playwright');

const name = (process.env.BROWSER || 'chromium').toLowerCase();
const engine = playwright[name];
if (!engine || !['chromium', 'firefox', 'webkit'].includes(name)) {
	throw new Error(`Unbekannter Browser „${name}“ (chromium, firefox oder webkit)`);
}

function launch() {
	return engine.launch(name === 'chromium' && process.env.CHROMIUM_PATH ? { executablePath: process.env.CHROMIUM_PATH } : {});
}

function device(preset) {
	const options = { ...playwright.devices[preset] };
	if (name === 'firefox') {
		delete options.isMobile;
		delete options.defaultBrowserType;
	}
	return options;
}

module.exports = { launch, device, name, devices: playwright.devices };
