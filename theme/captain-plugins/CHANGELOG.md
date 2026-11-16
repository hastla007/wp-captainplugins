# Änderungsprotokoll – Captain Plugins Theme

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
