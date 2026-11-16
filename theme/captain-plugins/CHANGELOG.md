# Änderungsprotokoll – Captain Plugins Theme

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
