#!/usr/bin/env node
/**
 * Gutenberg block validation, the same check the block editor runs when it opens content.
 * Usage: node validate-blocks.cjs [file.html ...]
 * Without arguments: theme templates, parts, patterns (via PHP) and generated pages.
 */
const fs = require('fs');
const path = require('path');
const { execFileSync } = require('child_process');
const { JSDOM } = require('jsdom');

const dom = new JSDOM('<!doctype html><html><body></body></html>', { url: 'http://localhost/' });
for (const key of ['window', 'document', 'navigator', 'Node', 'HTMLElement', 'Element', 'DOMParser', 'MutationObserver', 'getComputedStyle', 'requestAnimationFrame', 'CustomEvent', 'Event', 'KeyboardEvent']) {
	try { globalThis[key] = dom.window[key] ?? globalThis[key]; } catch (e) { /* read-only globals */ }
}
globalThis.window.matchMedia = globalThis.matchMedia = () => ({ matches: false, addListener() {}, removeListener() {}, addEventListener() {}, removeEventListener() {} });
const quiet = () => {};
console.warn = quiet; console.info = quiet; const realError = console.error; console.error = quiet;

const { registerCoreBlocks } = require('@wordpress/block-library');
const blocks = require('@wordpress/blocks');
registerCoreBlocks();

const theme = path.resolve(__dirname, '../../theme/captain-plugins');
function defaultSources() {
	const list = [];
	for (const dir of ['templates', 'parts', 'content/pages']) {
		for (const file of fs.readdirSync(path.join(theme, dir)).filter((f) => f.endsWith('.html'))) {
			list.push({ name: `${dir}/${file}`, source: fs.readFileSync(path.join(theme, dir, file), 'utf8') });
		}
	}
	for (const file of fs.readdirSync(path.join(theme, 'patterns')).filter((f) => f.endsWith('.php'))) {
		const php = `define("ABSPATH","/"); function __($s){return $s;} $p = require $argv[1]; echo $p["content"];`;
		list.push({ name: `patterns/${file}`, source: execFileSync('php', ['-r', php, path.join(theme, 'patterns', file)], { encoding: 'utf8' }) });
	}
	return list;
}
const sources = process.argv.length > 2
	? process.argv.slice(2).map((file) => ({ name: file, source: fs.readFileSync(file, 'utf8') }))
	: defaultSources();

let total = 0;
let external = 0;
const problems = [];
function walk(list, name) {
	for (const block of list) {
		total += 1;
		if (block.name === 'core/missing' && /^woocommerce\//.test(block.attributes.originalName || '')) {
			// WooCommerce blocks are registered by the plugin, not by this validator; WooCommerce renders and validates them.
			external += 1;
		} else if (block.name === 'core/missing') {
			problems.push(`${name}: unbekannter Block ${block.attributes.originalName}`);
		} else if (block.name && !block.isValid) {
			const issue = (block.validationIssues || [])[0];
			problems.push(`${name}: ${block.name} ungültig${issue ? ' – ' + issue.args.slice(1, 3).map(String).join(' / ').slice(0, 200) : ''}`);
		}
		walk(block.innerBlocks, name);
	}
}
for (const { name, source } of sources) {
	walk(blocks.parse(source.replace(/\{\{[^}]+\}\}/g, '')), name);
}
console.error = realError;
console.log(`${total} Blöcke in ${sources.length} Dateien geprüft, ${problems.length} Fehler${external ? ` (${external} WooCommerce-Blöcke übersprungen, werden vom Plugin gerendert)` : ''}`);
problems.forEach((line) => console.log('  ' + line));
process.exit(problems.length ? 1 : 0);
