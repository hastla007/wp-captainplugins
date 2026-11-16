# Captain Plugins Theme

Erste Umsetzung eines nativen WordPress-Block-Themes für die B2B-Website von Captain Plugins.

## Installieren

Den Ordner `captain-plugins` als ZIP verpacken oder nach `wp-content/themes/captain-plugins` kopieren und anschließend im WordPress-Admin aktivieren. Das Theme benötigt WordPress 6.6 oder neuer und – wie alle Captain-Produkte (Entscheidung vom 16. November 2026) – PHP 8.5 oder neuer sowie MySQL 9.7 (LTS) oder MariaDB 12.3 (LTS). Liegt der Server darunter, zeigt das Theme im Admin eine Warnung, sperrt die Website aber nicht. Für Shopseiten ist WooCommerce erforderlich; die Theme-Aktivierung selbst hängt nicht davon ab.

## Einrichten

Nach der Aktivierung führt **Design → Einrichtung** durch den optionalen Setup-Assistenten. Er bietet WooCommerce, Yoast SEO und License Captain zur Installation/Aktivierung an, importiert ausgewählte Inhaltsgruppen und kann die fünfzehn vorhandenen Captain-Pro-Jahrespläne (einschließlich Form und Workflow Captain Pro) als WooCommerce-Entwürfe anlegen. Review Captain Pro erhält seine Produktentwürfe, sobald die Preisbeträge im Produktkatalog feststehen.

- WooCommerce und Yoast SEO werden über wordpress.org bezogen. WooCommerce ist optional installierbar, wird aber für Shop und Produktentwürfe benötigt; Yoast bleibt optional.
- License Captain besteht aus Server und Client. Auf dieser Website läuft der Server, damit die Captain-Pro-Jahrespläne lizenziert werden können; der Client ist in jedem Pro-Add-on enthalten und für Kunden unsichtbar. Zusätzlich wird License Captain (Server und Client) als eigenes Produkt an Plugin-Hersteller verkauft. Das Theme verteilt keine Plugin-ZIP. Für den Assistenten kann eine vertrauenswürdige HTTPS-ZIP samt SHA-256-Prüfsumme über `wp-config.php` konfiguriert werden:

  ```php
  define( 'CAPTAIN_LICENSE_PLUGIN_ZIP', 'https://downloads.example.com/wp-license.zip' );
  define( 'CAPTAIN_LICENSE_PLUGIN_SHA256', '64-stelliger-sha256-hash' );
  ```

  Ohne Paketquelle kann die freigegebene ZIP manuell über den WordPress-Plugin-Uploader installiert werden.
- Die Seitengruppen **Website-Grundseiten**, **Produktseiten** und **Ratgeber** sind separat auswählbar. Inhalte werden aus den Markdown-Dateien unter `texte/homepage/` mit `python3 tools/build-theme-content.py` zu editierbaren Gutenberg-Blöcken gebaut.
- Beim Import erhalten Produkt-Startseiten, Preis-/Vergleichsseiten und Ressourcen passende Block-Templates. Die Produktvorlage zeigt den Seitentitel als gestalteten Einstieg; manuell gewählte Vorlagen bleiben bei späteren Imports erhalten.
- Markdown-H2-Abschnitte werden als breite, rhythmisch wechselnde Inhaltsbereiche aufgebaut. Der Startseiten-Einstieg nutzt ein Hero-Band; Screenshot-, Demo- und Kundenbeispiel-Briefings erscheinen als klar erkennbare Medienkarten.
- Reine Linkzeilen werden als Gutenberg-Buttons gesetzt. Fehlende Download-/Checkoutziele bleiben klar markierte redaktionelle Hinweise.
- FAQ-Seiten werden zu nativen aufklappbaren Details-Blöcken. Preisübersichten bekommen eine eigene Tabellenformatierung; Kopfzellen und Tastatur-Scrollbereich sind zugänglich ausgezeichnet.
- Bereits vorhandene Seiten werden nicht überschrieben. Das Theme aktualisiert nur eigene, seit dem Import unveränderte Seiten. SEO-Felder werden übernommen, wenn sie leer oder weiterhin unverändert sind.
- Vollständige Seiten können veröffentlicht werden. Seiten mit Download-, Checkout-, Support-, Screenshot- oder Betreiber-Platzhaltern werden als Entwurf angelegt. Bestehende statische Startseiten bleiben unangetastet.
- Der Produkt-Schritt legt virtuelle, verborgene **Entwürfe** für Voucher, Pass, Affiliate, Form und Workflow Captain Pro mit fünfzehn Jahresplänen an. Er verändert keine bestehenden SKUs, Preise, Steuer- oder Zahlungseinstellungen und trägt keine Download-Dateien ein. WooCommerce muss auf EUR stehen; der License-Captain-Server dieses Shops muss aktiv sein, damit die Pläne im Lizenzkatalog zugeordnet werden.
- Brotkrumen zeigen auf Unterseiten die Orientierung im Seitenbaum. Offene Download-/Checkout-Ziele sind in den importierten Texten als Platzhalter sichtbar und führen nicht zu einem funktionslosen Link.
- Ein Sprunglink führt per Tastatur direkt zum Hauptinhalt. Fokusindikatoren sind deutlich sichtbar; die finalen Kontrast- und Screenreader-Prüfungen brauchen weiterhin eine echte WordPress-Installation.
- Breite Tabellen sind auf schmalen Ansichten horizontal scrollbar und für Tastaturbedienung fokussierbar; Kopfzellen sind als Spaltenüberschriften markiert.
- Yoast erhält beim Import SEO-Titel, Meta-Beschreibung, Fokus-Keyphrase sowie Social-Titel und Social-Beschreibung. Individuelle `social_title`- und `social_description`-Felder im Markdown sind möglich; ohne diese werden die SEO-Werte verwendet. Social-Bilder und die finale Snippet-Freigabe bleiben Teil der redaktionellen Veröffentlichung.
- License Captain ZIP, Releases/Downloads, Checkout, Rechtstexte, Steuerkonfiguration, Supportwege und Unternehmensangaben müssen vor dem Verkauf ergänzt und geprüft werden.

Der Import ordnet die Vorlagen automatisch zu: **Produktseite** für alle Produkt-Startseiten (`/…-captain/`), **Preisübersicht** für Preise, Captain Pro und `…/preise/`, **Breite Inhaltsseite** für Produktübersicht, Vergleich, Lösungen, Kompatibilität und Integrationen, sonst **Ressourcen- und Dokumentationsseite** mit Lesespalte. Manuell gewählte Vorlagen bleiben erhalten. Die WooCommerce-Seiten Warenkorb, Checkout und Mein Konto verwenden ihre gleichnamigen Seitentemplates, sofern die WordPress-Seiten diese Slugs haben.

Die vollständige Reihenfolge von der Bestandsaufnahme bis Betrieb und Release steht in [ROADMAP.md](ROADMAP.md), Änderungen pro Version in [CHANGELOG](captain-plugins/CHANGELOG.md). Designvorgaben stehen in [../design/konzept.md](../design/konzept.md).

Die Theme-Oberfläche orientiert sich an den vorhandenen [Homepage-](../design/mockups/homepage-desktop.jpg), [Produktübersichts-](../design/mockups/products-overview-desktop.jpg), [Voucher-Captain-](../design/mockups/voucher-captain-desktop.jpg) und [Preisplan-Mockups](../design/mockups/captain-pro-pricing-desktop.jpg). Vier freigestellte Kapitänsposen (zeigend, Daumen hoch, Fernrohr, verschränkte Arme) liegen als WebP unter `captain-plugins/assets/images/` und werden als dekorative CSS-Hintergründe eingesetzt. Die Mockups dienen als Gestaltungsreferenz; ihre Produktansichten sind keine echten Screenshots.

## Theme-Umfang

- Block-Templates und Template Parts, bearbeitbar im Site Editor; einheitlicher Seitenkopf mit Brotkrumen.
- Header mit Klick-Untermenüs, Gold-CTA und Disclosure-Menü bis Tablet-Breite; Footer mit benannten Navigationen.
- Startseiten-Hero mit Kapitän, Produkt-Hero mit Medienrahmen, Produkt- und Featurekarten mit Icons für alle sieben Produkte, Tarifkarten, CTA-Bänder mit Kapitän.
- Ruhiger Lesefluss für Ratgeber, Dokumentation, Support und FAQ; breite, tastaturbedienbare Tabellen für Matrizen.
- Patterns für Produkt-Heros, Produktkarten, Features, Abläufe, Free-/Pro-Vergleich, Preise, Screenshot-Briefings, Kompatibilität, FAQ, Ressourcen und CTAs.
- Design-Tokens in `theme.json` (Farben, 4–96-px-Abstände, 75rem-Container, Typoskala) und sichtbare Tastaturfokusse; Kontraste sind in `design/konzept.md` dokumentiert.
- Warenkorb-, Checkout- und Mein-Konto-Templates, die den Seiteninhalt mit den WooCommerce-Blöcken ausgeben; Basisstyles nur auf öffentlichen WooCommerce-Klassen.

## Social-Vorschaubilder

Unter `captain-plugins/assets/social/` liegen 1200 × 630 Pixel große Vorschaubilder für Startseite, alle sieben Produkte und Captain Pro (Neuaufbau: `cd tools/qa && node make-social-images.cjs`). Der Seitenimport trägt bei aktivem Yoast SEO für jede Seite das Bild ihres Produktbereichs als Facebook-/X-Bild ein; eigene Bilder lassen sich im Markdown über `social_image: https://…` oder `social_image: theme:assets/…` festlegen. Bereits von Hand geänderte Yoast-Bilder werden nicht überschrieben.

## Datenschutz und externe Ressourcen

Geprüft im Browser (16. November 2026): Das Theme setzt keine Cookies, schreibt nichts in `localStorage`/`sessionStorage` und fragt keine fremden Hosts an. Schriften sind Systemschriften, Icons und Kapitänsbilder liegen im Theme bzw. als Inline-SVG im CSS vor. Der WordPress-Emoji-Loader ist deaktiviert, weil er Inline-JavaScript ausgibt und Grafiken vom WordPress-CDN nachladen kann. Cookies und Dienste von WooCommerce, Zahlungsanbietern und weiteren Plugins sind davon unabhängig in der Datenschutzerklärung zu beschreiben.

## Werkzeuge

| Befehl | Zweck |
|---|---|
| `python3 tools/build-theme-content.py` | Website-Texte aus `texte/homepage/` in importierbare Gutenberg-Seiten übersetzen |
| `python3 tools/make-pot.py` | Übersetzungsvorlage `languages/captain-plugins.pot` erzeugen |
| `python3 tools/make-translations.py` | Englische Theme-Oberfläche `languages/en_US.po/.mo` aus `tools/translations_en_US.py` bauen; bricht ab, wenn ein neuer String unübersetzt ist |
| `python3 tools/media-inventory.py` | Liste aller Screenshot-, Demo- und Diagramm-Platzhalter erzeugen |
| `python3 tools/release-blockers.py` | Bericht `docs/RELEASE-BLOCKER.md` mit allen fehlenden Linkzielen, Betreiberangaben und Vorbehalten je Seite |
| `php tests/run.php /pfad/zu/wp-load.php` | 30 Integrationstests (Vorlagenzuordnung, Importschutz, SEO-Felder, Titel-Fallback, ausgemusterte Seiten, Social-Bilder, Versionsprüfung, Render-Filter) gegen eine Test-Installation mit aktivem Theme |
| `tools/build-theme-zip.sh` | Installierbares Theme-ZIP unter `dist/` bauen (inkl. Inhalts- und POT-Neubau und PHP-Lint) |

Die Pattern-Texte mit eckigen Klammern sind redaktionelle Felder, die beim Einfügen auszufüllen sind. Der Preisvergleich startet mit den aktuellen Konzeptpreisen und enthält einen internen Abgleichhinweis. Screenshot-Platzhalter enthalten ein konkretes Aufnahmebriefing und müssen vor Veröffentlichung ersetzt werden.

## Setup-Assistent und Grenzen

Der Assistent erledigt die gewählten Installations-, Seitenimport- und Produktentwurfsschritte. Er konfiguriert weder Steuern/Zahlungen noch Lizenzserver-Geheimnisse und veröffentlicht keine Produktangebote. Lizenzprüfung, Checkout, Gutscheine, Tickets, Affiliate-Abrechnung und Plugin-Downloads bleiben in WooCommerce, License Captain und den jeweiligen Captain-Plugins. Bei aktiver Yoast-Installation schreibt der Seitenimport grundlegende Yoast-Titel, Meta-Beschreibung und Fokus-Keyphrase, ohne bestehende individuelle Werte zu ersetzen.
