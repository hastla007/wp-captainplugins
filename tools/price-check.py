#!/usr/bin/env python3
"""Compare the Captain Pro prices in the website texts with the shop catalogue (Roadmap Phase 7).

Source of truth in the repository: the plan rows in theme/captain-plugins/inc/catalog.php, from which
the setup assistant creates the WooCommerce products. Checked against:
  - texte/homepage/preise.md (overview table)
  - texte/homepage/<produkt>/pro.md (plan table "Single · 1 Website | 129 €")
  - theme/captain-plugins/patterns/pricing-comparison.php (price comparison pattern)
Products without a price in the catalogue must not show a euro amount on their Pro page.
Add-ons marked "(in Vorbereitung)" in preise.md are not on sale yet: their Pro page needs the
"In Vorbereitung" notice and must not link to the checkout.
Exit code 1 on any difference. Usage: python3 tools/price-check.py
"""
import pathlib
import re
import sys

ROOT = pathlib.Path(__file__).resolve().parent.parent
THEME = ROOT / 'theme' / 'captain-plugins'
TEXTS = ROOT / 'texte' / 'homepage'


def catalogue():
    source = (THEME / 'inc' / 'catalog.php').read_text(encoding='utf-8')
    products = {}
    for match in re.finditer(r"'([a-z]+-captain)-pro'\s*=>\s*array\((.*?)\n\t\t\),", source, re.S):
        block = match.group(2)
        prices = re.search(r"'prices'\s*=>\s*array\((.*?)\)", block, re.S)
        if prices:
            products[match.group(1)] = [int(v) for v in re.findall(r"=>\s*(\d+)", prices.group(1))]
    return products


def euros(text):
    return [int(v.replace('.', '')) for v in re.findall(r'(\d[\d.]*)\s*€', text)]


def main():
    expected = catalogue()
    problems = []
    if not expected:
        print('Keine Preise in inc/catalog.php gefunden.')
        return 1

    overview = (TEXTS / 'preise.md').read_text(encoding='utf-8')
    pattern = (THEME / 'patterns' / 'pricing-comparison.php').read_text(encoding='utf-8')
    for slug, prices in expected.items():
        name = slug.replace('-', ' ').title() + ' Pro'
        row = re.search(r'^\|\s*' + re.escape(name) + r'(\s*\(in Vorbereitung\))?\s*\|(.*)$', overview, re.M)
        if not row:
            problems.append(f'preise.md: Zeile „{name}“ fehlt')
        elif euros(row.group(2))[:3] != prices:
            problems.append(f'preise.md: {name} zeigt {euros(row.group(2))[:3]}, Katalog {prices}')

        cells = re.search(r'<th>' + re.escape(name) + r'(?: \(in Vorbereitung\))?</th>(.*?)</tr>', pattern)
        if not cells:
            problems.append(f'Pattern pricing-comparison: Zeile „{name}“ fehlt')
        elif euros(cells.group(1))[:3] != prices:
            problems.append(f'Pattern pricing-comparison: {name} zeigt {euros(cells.group(1))[:3]}, Katalog {prices}')

        pro = TEXTS / slug / 'pro.md'
        if pro.exists():
            # Plan rows start with the plan name (Single, Business, Agency, Solo, Studio …), in any column layout.
            plan_rows = re.findall(r'^\|\s*(?:Single|Business|Agency|Solo|Studio)\b([^\n]*)$', pro.read_text(encoding='utf-8'), re.M)
            shown = [euros(r)[0] for r in plan_rows if euros(r)]
            if shown[:3] != prices:
                problems.append(f'{slug}/pro.md: Plantabelle zeigt {shown[:3]}, Katalog {prices}')
        else:
            problems.append(f'{slug}/pro.md fehlt')

    # Add-ons in preparation: notice on the Pro page, no checkout link.
    for name in re.findall(r'^(?:\||##)\s*([A-Z][a-z]+ Captain Pro) \(in Vorbereitung\)', overview, re.M):
        slug = name[:-4].lower().replace(' ', '-')
        pro = TEXTS / slug / 'pro.md'
        text = pro.read_text(encoding='utf-8') if pro.exists() else ''
        if '**In Vorbereitung:**' not in text:
            problems.append(f'{slug}/pro.md: Hinweis „In Vorbereitung“ fehlt (in preise.md als in Vorbereitung markiert)')
        if 'Checkout-URL' in text or re.search(r'\]\(/(?:warenkorb|kasse|cart|checkout|shop)/', text):
            problems.append(f'{slug}/pro.md: Kauf-Link, obwohl das Add-on in Vorbereitung ist')

    for pro in sorted(TEXTS.glob('*-captain/pro.md')):
        slug = pro.parent.name
        if slug in expected or slug == 'license-captain':
            continue
        if euros(pro.read_text(encoding='utf-8')):
            problems.append(f'{slug}/pro.md nennt Eurobeträge, im Katalog ist aber kein Preis hinterlegt')

    checked = len(expected)
    if problems:
        print(f'{checked} Produkte mit Preisen geprüft, {len(problems)} Abweichungen:')
        for problem in problems:
            print('  ' + problem)
        return 1
    print(f'{checked} Produkte mit Preisen geprüft: preise.md, Pro-Seiten und Preis-Pattern stimmen mit dem Shop-Katalog überein.')
    return 0


if __name__ == '__main__':
    sys.exit(main())
