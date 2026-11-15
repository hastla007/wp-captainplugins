# Captain Plugins Theme

Erste Umsetzung eines nativen WordPress-Block-Themes für die B2B-Website von Captain Plugins.

## Installieren

Den Ordner `captain-plugins` als ZIP verpacken oder nach `wp-content/themes/captain-plugins` kopieren und anschließend im WordPress-Admin aktivieren. Das Theme benötigt WordPress 6.6 oder neuer und PHP 7.4 oder neuer. Für Shopseiten ist WooCommerce erforderlich; die Theme-Aktivierung selbst hängt nicht davon ab.

## Einrichten

Nach der Aktivierung führt **Design → Einrichtung** durch den optionalen Setup-Assistenten. Er bietet WooCommerce, Yoast SEO und License Captain zur Installation/Aktivierung an, importiert ausgewählte Inhaltsgruppen und kann die neun vorhandenen Captain-Pro-Jahrespläne als WooCommerce-Entwürfe anlegen.

- WooCommerce und Yoast SEO werden über wordpress.org bezogen. WooCommerce ist optional installierbar, wird aber für Shop und Produktentwürfe benötigt; Yoast bleibt optional.
- License Captain ist die Lizenzbasis und in den Captain-Pro-Angeboten enthalten. Das Theme verteilt keine Plugin-ZIP. Für den Assistenten kann eine vertrauenswürdige HTTPS-ZIP samt SHA-256-Prüfsumme über `wp-config.php` konfiguriert werden:

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
- Der Produkt-Schritt legt virtuelle, verborgene **Entwürfe** für die drei Captain-Pro-Produkte und die neun Jahrespläne an. Er verändert keine bestehenden SKUs, Preise, Steuer- oder Zahlungseinstellungen und trägt keine Download-Dateien ein. WooCommerce muss auf EUR stehen; License Captain muss aktiv sein, damit die Pläne zugeordnet werden.
- Brotkrumen zeigen auf Unterseiten die Orientierung im Seitenbaum. Offene Download-/Checkout-Ziele sind in den importierten Texten als Platzhalter sichtbar und führen nicht zu einem funktionslosen Link.
- Ein Sprunglink führt per Tastatur direkt zum Hauptinhalt. Fokusindikatoren sind deutlich sichtbar; die finalen Kontrast- und Screenreader-Prüfungen brauchen weiterhin eine echte WordPress-Installation.
- Breite Tabellen sind auf schmalen Ansichten horizontal scrollbar und für Tastaturbedienung fokussierbar; Kopfzellen sind als Spaltenüberschriften markiert.
- Yoast erhält beim Import SEO-Titel, Meta-Beschreibung, Fokus-Keyphrase sowie Social-Titel und Social-Beschreibung. Individuelle `social_title`- und `social_description`-Felder im Markdown sind möglich; ohne diese werden die SEO-Werte verwendet. Social-Bilder und die finale Snippet-Freigabe bleiben Teil der redaktionellen Veröffentlichung.
- License Captain ZIP, Releases/Downloads, Checkout, Rechtstexte, Steuerkonfiguration, Supportwege und Unternehmensangaben müssen vor dem Verkauf ergänzt und geprüft werden.

Für Produkt-Startseiten die Vorlage **Produktseite**, für Preise und Vergleich **Preisübersicht** und für Dokumentation, FAQ, Support und Kompatibilität **Ressourcen- und Dokumentationsseite** auswählen. Die WooCommerce-Seiten Warenkorb, Checkout und Mein Konto verwenden ihre gleichnamigen Seitentemplates, sofern die WordPress-Seiten diese Slugs haben.

Die vollständige Reihenfolge von der Bestandsaufnahme bis Betrieb und Release steht in [ROADMAP.md](../ROADMAP.md). Designvorgaben stehen in [../design/konzept.md](../design/konzept.md).

Die Theme-Oberfläche orientiert sich an den vorhandenen [Homepage-](../design/mockups/homepage-desktop.jpg), [Produktübersichts-](../design/mockups/products-overview-desktop.jpg) und [Preisplan-Mockups](../design/mockups/captain-pro-pricing-desktop.jpg). Die Mockups dienen als Gestaltungsreferenz; ihre Produktansichten sind keine echten Screenshots.

## Theme-Umfang

- Block-Templates und Template Parts, bearbeitbar im Site Editor.
- Patterns für Produkt-Heros, Features, Abläufe, Free-/Pro-Vergleich, Preise, Screenshot-Briefings, Kompatibilität, FAQ, Ressourcen und CTAs.
- Responsive Basisstile, globale Design-Tokens und sichtbare Tastaturfokusse.
- Warenkorb- und Checkout-Templates, die den Inhalt der dafür angelegten WordPress-Seiten ausgeben.
- Mein-Konto-Template, das die von WooCommerce bereitgestellten Kontoblöcke und Shortcodes im Seiteninhalt belässt.

Die Pattern-Texte mit eckigen Klammern sind redaktionelle Felder, die beim Einfügen auszufüllen sind. Der Preisvergleich startet mit den aktuellen Konzeptpreisen und enthält einen internen Abgleichhinweis. Screenshot-Platzhalter enthalten ein konkretes Aufnahmebriefing und müssen vor Veröffentlichung ersetzt werden.

## Setup-Assistent und Grenzen

Der Assistent erledigt die gewählten Installations-, Seitenimport- und Produktentwurfsschritte. Er konfiguriert weder Steuern/Zahlungen noch Lizenzserver-Geheimnisse und veröffentlicht keine Produktangebote. Lizenzprüfung, Checkout, Gutscheine, Tickets, Affiliate-Abrechnung und Plugin-Downloads bleiben in WooCommerce, License Captain und den jeweiligen Captain-Plugins. Bei aktiver Yoast-Installation schreibt der Seitenimport grundlegende Yoast-Titel, Meta-Beschreibung und Fokus-Keyphrase, ohne bestehende individuelle Werte zu ersetzen.
