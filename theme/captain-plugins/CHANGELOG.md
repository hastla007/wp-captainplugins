# Änderungsprotokoll – Captain Plugins Theme

## 0.6.0 – 16. November 2026

Geprüft auf WordPress 7.1.4, WooCommerce 11.3.0, Yoast SEO 28.8 und License Captain 0.2.0 (MariaDB); PHP 8.5 im Workflow `staging-php85.yml`.

### Behoben
- **Doppelter `<title>` mit Yoast:** Das Block-Theme meldete `title-tag` an; Yoast gab deshalb einen zweiten Titel aus.
- **Zwei H1 auf der Bestellbestätigung** mit WooCommerce 10+: Die Status-Überschrift von WooCommerce ist jetzt der Seitentitel.
- Lizenzansicht von License Captain: klassische WooCommerce-Knöpfe im Theme-Design statt Browser-Standard.
- „Passwort anzeigen“-Knopf zu klein (WCAG 2.5.8).
- Yoast-Sitemap ohne Warenkorb, Kasse, Konto und Autoren.
- Bei frischen WooCommerce-Installationen fügte WooCommerce Mini-Warenkorb und Konto-Symbol in den Header ein (Symbol unsichtbar, Menüknopf mobil verschoben, axe-Befund auf allen Seiten); jetzt unterbunden, Konto-Link im Footer.
- Kein Gravatar-Abruf im Frontend (Datenschutz): lokales Profilbild.
- Setup-Assistent ergänzt Pro-Funktionen nachträglich, sobald License Captain sie freigibt, und meldet Produkte ohne freigegebene Funktionen.

### Neu
- Werkzeuge: `seo-head.py` (SEO-Kopf aller Seiten), `license-e2e.php` (Lizenzaktivierung), `tools/ci/` und Workflow `staging-php85.yml`, Verfügbarkeits-Check `uptime.yml`, Must-Use-Plugin `tools/ops/captain-monitoring.php`.

## 0.5.0 – 16. November 2026

### Neu
- **Shop-Vorlagen** für Katalog, Produktsuche, Produktdetail und Bestellbestätigung mit Seitenkopf, Brotkrumen und Lizenz-Hinweisen („So geht es weiter“); Platzhalterbild in Markenfarben.
- Setup-Assistent: Lizenzprodukte ohne Bewertungen und einzeln verkäuflich; WooCommerce-E-Mails in Markenfarben, solange die Standardfarben gelten.
- Klassische WooCommerce-Formulare kennzeichnen Fehler mit `aria-invalid` und verknüpfter Meldung (`assets/js/form-errors.js`, nur Kasse und Konto).
- 301-Rückfall für entfallene Theme-Seiten, nur wenn sonst ein 404 entstünde.
- Core-Sitemap ohne Warenkorb, Kasse, Konto und ohne Autoren-Sitemap; Produkte ohne Yoast mit Meta-Beschreibung aus der Kurzbeschreibung.
- Werkzeuge: `shop-flow.cjs`, `keyboard.cjs`, `price-check.py`, `acceptance-list.py` (Abnahmeliste `docs/ABNAHME.md`, Sprachregel-Prüfung), Smoke-Test mit Shop und Checkout, Site-Check mit 7 Breiten und Shop-Startseiten, Browser-Wahl (Chromium, Firefox, WebKit), Workflow `site-check.yml` gegen Staging/Produktion, 36 Integrationstests.

### Behoben
- Shopseiten ohne Seitenkopf, Brotkrumen am Header, H1/H3-Sprung im Katalog, Bewertungsformular bei Lizenzprodukten, schmale Felder und lila Zahlungsbox im klassischen Checkout, Kontomenü-Abstände, fehlender Seitenrand und ausgeblendete Bestellnummer mobil.
- Kein sichtbarer Fokus an WooCommerce-Feldern und Produktbild-Links; zu kleiner Adressschalter im Block-Checkout (WCAG 2.5.8).
- Menü brach bei 1024 px zweizeilig um; lange Komposita wurden bei 320 px abgeschnitten; Brotkrumen-Trenner am Zeilenanfang.
- Warenkorb sprang beim Laden (CLS mobil bis 1,4, jetzt unter 0,05); WooCommerce-CSS und jQuery bremsten Inhaltsseiten (Lighthouse Startseite mit WooCommerce 78 → 94).

## 0.4.0 – 16. November 2026

### Neu
- **Course Captain** als achtes Produkt: Produkt-, Features-, Pro-, FAQ-, Installations-, Kompatibilitäts- und Integrationsseite, Dokumentation, drei Ratgeber, Lösungsseite „Online-Akademien und Weiterbildung“, Kurs-Icon, Menü, Footer, Produktkarte und Social-Bild.
- Englische Übersetzung der Theme-Oberfläche (`languages/en_US.po/.mo`).
- Marken-Favicon als Fallback, solange kein Website-Icon gesetzt ist.
- Pattern-Katalog mit Vorschaubildern (`docs/PATTERNS.md`).
- Werkzeuge: PHPCS mit WordPress-Coding-Standards und PHP-8.5-Kompatibilität, visueller Regressionstest, Editor-Canvas-Prüfung, Release-Blocker-Bericht, 31 Integrationstests, GitHub-Actions-Workflow.

### Behoben
- Brotkrumen-Trennzeichen wurden von Screenreadern vorgelesen.
- Lösungsseiten liefen in der schmalen Lesespalte; zweispaltige Abschnitte hatten keine Abstände zwischen Button-Reihen.
- Preis-Pattern listete nur drei von fünf bepreisten Pro-Add-ons; Startseiten-Hero-Pattern nannte nicht alle Produktbereiche.
- Setup-Assistent: Checkbox-Ausgabe über `wp_kses`, Übersetzerhinweise für alle Platzhalter-Texte.

## 0.3.0 – 16. November 2026

### Neu
- Mindestversionen PHP 8.5, MySQL 9.7 (LTS), MariaDB 12.3 (LTS) nach Entscheidung der Inhaberin: `Requires PHP: 8.5` und Admin-Warnung bei älterer Umgebung (keine Sperre); Website-Texte angepasst.
- Social-Vorschaubilder (1200 × 630) für Startseite, sieben Produkte und Captain Pro; der Import übergibt sie an Yoast.
- Ausgemusterte Seiten (`content/retired.php`): unveränderte alte Kopien gehen beim Import auf Entwurf, z. B. `/license-captain/im-paket/`.
- QA-Werkzeuge unter `tools/qa/` (Block-Validierung, Site-Check mit axe-core, Smoke-Test, SEO-Feldprüfung).
- Dokumentation: Betrieb, Redaktion, Weiterleitungen.

### Behoben
- Ohne Yoast hängte WordPress den Seitennamen an den vollständigen SEO-Titel an.
- 22 SEO-Titel über 60 Zeichen, zwei zu lange Beschreibungen, doppelter Titel von Startseite und Produktübersicht; Ratgeber- und Lösungsverzeichnisse ohne SEO-Felder.
- Einheitlich „License Captain“ statt „WP License Captain“.

### Geändert
- WordPress-Emoji-Loader deaktiviert: keine Inline-Skripte, kein Browser-Speicher, keine Anfragen an das WordPress-CDN.
- `make-pot.py` schreibt die Übersetzungsvorlage nur bei geänderten Strings.

## 0.2.0 – 16. November 2026

### Neu
- Gestaltung nach `design/konzept.md` und den Mockups: Navy-Header mit Untermenüs (Klick statt Hover), Gold-CTA, mobiles Disclosure-Menü bis Tablet-Breite, vollbreiter Footer mit benannten Navigationen.
- Startseiten-Hero mit freigestelltem Kapitän, Wellenkante, Produktkarten mit Icons, CTA-Bänder mit Kapitän; 404-Seite mit Fernrohr-Pose.
- Produkt-Hero (Produktname, H1, Lead, Buttons, Medienrahmen), Feature-Karten, Tarifkarten für Single/Business/Agency und Solo/Studio/Agency, Medienrahmen „Produktansicht folgt“ statt gestrichelter Kästen.
- Alle sieben Website-Produkte (Voucher, Pass, Affiliate, Form, Review, Workflow, License Captain) in Menü, Footer, Generator, Pattern und Icons.
- Ruhiger Lesefluss für Ratgeber, Dokumentation, Support und FAQ; breite Vorlage für Kompatibilitäts- und Integrationsmatrizen.
- Einheitlicher Seitenkopf mit Brotkrumen, zentrierte Köpfe für Übersichten und Preise.
- WooCommerce-Basisstyles auf öffentlichen Klassen (Hinweise mit Statussymbol, Konto-Navigation, Leerzustand).
- Übersetzungsvorlage `languages/captain-plugins.pot` (Generator: `tools/make-pot.py`), Theme-Vorschaubild, vollständige Theme-Kopfdaten.
- Impressum und Datenschutz als Entwurfsvorlagen mit Betreiber-Platzhaltern.

### Behoben
- PHP-Syntaxfehler in `inc/catalog.php`, der jede Seite mit „critical error“ abbrach.
- Doppelter Skip-Link, unlesbare Menülinks, eingerückter Header/Footer, Footer-Spalten mit Wortumbrüchen.
- `front-page.html` zeigte ohne statische Startseite einen leeren Inhaltsbereich.
- Social-Titel/-Beschreibung für Yoast fielen bei leeren Feldern nicht auf die SEO-Werte zurück.
- Layout-Änderungen erreichten unveränderte importierte Seiten nicht (Quell-Hash berücksichtigt jetzt das erzeugte Markup).
- Fehlende Download-/Checkout-Ziele erscheinen als klar markierte, nicht klickbare Buttons statt als Rohtext.
- Platzhalterzeilen mit Trennpunkten oder harten Zeilenumbrüchen wurden nicht als Medien-Briefing erkannt.

### Geändert
- License Captain wird als eigenes Produkt aus Server und Client dargestellt und auf Pro-, Preis- und FAQ-Seiten nicht mehr erwähnt.
- Design-Tokens in `theme.json` nach Konzept (Abstands-Raster 4–96 px, 75rem-Container, goldener Primärbutton).

## 0.1.0
- Erste Theme-Struktur, Templates, Patterns, Setup-Assistent und Inhaltsimport.
