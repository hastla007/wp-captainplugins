# Captain Plugins Theme

Erste Umsetzung eines nativen WordPress-Block-Themes für die B2B-Website von Captain Plugins.

## Installieren

Den Ordner `captain-plugins` als ZIP verpacken oder nach `wp-content/themes/captain-plugins` kopieren und anschließend im WordPress-Admin aktivieren. Das Theme benötigt WordPress 6.6 oder neuer und PHP 7.4 oder neuer. Für Shopseiten ist WooCommerce erforderlich; die Theme-Aktivierung selbst hängt nicht davon ab.

## Einrichten

1. Website-Titel, Logo und Menüs unter **Design → Editor** bzw. in den Website-Einstellungen setzen.
2. Die vorbereitete Startseite über **Einstellungen → Lesen** als statische Startseite auswählen.
3. Seiteninhalte aus `../texte/homepage/` übernehmen und Patterns im Editor einfügen.
4. Produktpreise, Downloads, Checkout-, Support- und Dokumentationsziele mit den tatsächlichen Shop- und Plugin-Endpunkten verbinden.
5. Yoast SEO je Seite pflegen; Meta-Tags und strukturierte Daten nicht im Theme duplizieren.
6. Screenshot-Platzhalter vor Veröffentlichung durch freigegebene echte Produktansichten ersetzen.

Die vollständige Reihenfolge von der Bestandsaufnahme bis Betrieb und Release steht in [ROADMAP.md](../ROADMAP.md). Designvorgaben stehen in [../design/konzept.md](../design/konzept.md).

Die Theme-Oberfläche orientiert sich an den vorhandenen [Homepage-](../design/mockups/homepage-desktop.jpg), [Produktübersichts-](../design/mockups/products-overview-desktop.jpg) und [Preisplan-Mockups](../design/mockups/captain-pro-pricing-desktop.jpg). Die Mockups dienen als Gestaltungsreferenz; ihre Produktansichten sind keine echten Screenshots.

## Theme-Umfang

- Block-Templates und Template Parts, bearbeitbar im Site Editor.
- Patterns für Produkt-Heros, Features, Abläufe, Free-/Pro-Vergleich, Preise, Screenshot-Briefings, Kompatibilität, FAQ, Ressourcen und CTAs.
- Responsive Basisstile, globale Design-Tokens und sichtbare Tastaturfokusse.
- Warenkorb- und Checkout-Templates, die den Inhalt der dafür angelegten WordPress-Seiten ausgeben.

Die Pattern-Texte mit eckigen Klammern sind redaktionelle Felder, die beim Einfügen auszufüllen sind. Der Preisvergleich startet mit den aktuellen Konzeptpreisen und enthält einen internen Abgleichhinweis. Screenshot-Platzhalter enthalten ein konkretes Aufnahmebriefing und müssen vor Veröffentlichung ersetzt werden.

## Nicht im Theme enthalten

Lizenzprüfung, Shop-/Checkout-Funktionalität, Gutscheine, Tickets, Affiliate-Abrechnung, Preisverwaltung, Kundenkonten und SEO-Metadaten. Dafür sind WooCommerce, Yoast SEO und die jeweiligen Captain-Plugins zuständig.
