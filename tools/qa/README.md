# Prüfwerkzeuge (QA)

Einmalig installieren (Node.js 20+). Playwright lädt Chromium mit `npx playwright install chromium`; ein vorhandener Chrome/Chromium lässt sich alternativ über `CHROMIUM_PATH=/pfad/zu/chrome` nutzen:

```bash
cd tools/qa && npm install
```

| Befehl | Prüft | Wann |
|---|---|---|
| `node validate-blocks.cjs` | Gutenberg-Blockvalidierung aller Templates, Template Parts, Patterns und generierten Seiten – dieselbe Prüfung wie der Block-Editor (verhindert „Dieser Block enthält unerwarteten Inhalt“) | nach jeder Änderung an Templates, Patterns oder `tools/build-theme-content.py` |
| `node site-check.cjs --base URL [--axe] [--all-widths] [--seed /shop/,/warenkorb/]` | Crawlt alle internen Seiten: tote Links, horizontaler Überlauf, abgeschnittene Überschriften, genau eine H1, Überschriftenhierarchie, lang-Attribut, Bilder ohne Alt, unbenannte Links/Buttons, JS-Fehler; mit `--axe` WCAG-2.2-AA- und Best-Practice-Regeln (`--ignore-axe regel` für dokumentierte Fremd-Befunde). Ansichten: Desktop, Tablet, Mobil, Zoom 200 %, mit `--all-widths` zusätzlich 320 px, 1024 px und 1920 px. `--seed` ergänzt nicht verlinkte Startseiten (Shop). Folgt keinen Warenkorb-/Logout-Links | vor jedem Release auf Staging |
| `php seo-fields.php` | SEO-Titel (max. 60 Zeichen), Meta-Beschreibungen (70–160), fehlende Fokus-Keyphrases, doppelte Titel/Keyphrases aller generierten Seiten | nach Textänderungen und vor der SEO-Freigabe |
| `node visual.cjs --base URL --update`, danach `node visual.cjs --base URL` | Visueller Regressionstest: speichert Referenzbilder von 14 Seitentypen (Desktop und Mobil) lokal unter `.visual/baseline/` und meldet nach einer Änderung Seiten mit mehr als 0,3 % geänderten Pixeln; Differenzbilder unter `.visual/diff/` | vor einem Theme-Update Referenz erzeugen, danach vergleichen |
| `node editor-check.cjs [Seiten.html …]` | Rendert importierte Seiten im echten Gutenberg-Editor-Canvas mit `theme.css` und den Global Styles (`editor/global.css`, aus WordPress mit `wp eval 'echo wp_get_global_stylesheet();'`); meldet ungültige Blöcke und Überlauf, Screenshots unter `.visual/editor/` zum Vergleich mit dem Frontend | nach Änderungen an Styles, Patterns oder dem Inhaltsgenerator |
| `node smoke.cjs --base URL [--shop] [--product /produkt/slug/]` | Kernseiten (HTTP 200, H1, Header/Footer, Theme-CSS, kein „critical error“), 404-Status, Suche; mit `--shop` Shopseiten, mit `--product` Warenkorb und Checkout mit Bestellknopf (ohne zu bestellen) | direkt nach Aktivierung oder Update in Produktion |
| `node keyboard.cjs --base URL [--checkout /kasse/ --product /produkt/slug/]` | Skip-Link als erster Tab-Stopp und Sprung in den Hauptinhalt, sichtbarer Fokus an jedem Tab-Stopp, kein Fokus auf unsichtbaren Elementen, Untermenüs mit Enter/Escape, mobiles Menü; Checkout-Fehler mit aria-invalid und verknüpfter Meldung | vor jedem Release auf Staging |
| `node shop-flow.cjs --base URL [--order]` | Kaufablauf Desktop und mobil: Katalog → Produkt → Warenkorb → Checkout → Fehlermeldungen → (mit `--order` Testbestellung) → Bestätigung → Konto; Screenshots | nach Shop-, Theme- oder WooCommerce-Updates, `--order` nur im Testmodus |
| `python3 ../price-check.py` | Preise auf Preisseite, Pro-Seiten und Preis-Pattern = Shop-Katalog des Setup-Assistenten | nach Preisänderungen (läuft auch in CI) |
| `python3 ../acceptance-list.py` | schreibt `docs/ABNAHME.md` (Abnahmeliste aller Seiten) und prüft die License-Captain-Sprachregel und SEO-Felder | vor der redaktionellen Abnahme (läuft auch in CI) |

Alle Browser-Skripte nutzen Chromium; mit `BROWSER=firefox` oder `BROWSER=webkit` (vorher `npx playwright install firefox webkit`) laufen sie in den anderen Engines. Der Workflow `.github/workflows/site-check.yml` macht das wöchentlich gegen die Repository-Variable `SITE_URL`.

Alle Skripte beenden sich mit Exit-Code 1, wenn etwas gefunden wurde, und eignen sich damit für CI. Automatische Prüfungen ersetzen nicht die manuelle Abnahme mit Tastatur und Screenreader (siehe `theme/ROADMAP.md`, Phase 9).
