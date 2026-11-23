# Theme-Bauplan: Captain Plugins

Dieses Dokument ist die durchgängige To-do-Liste für die Umsetzung, Prüfung und Veröffentlichung des WordPress-Themes. Es baut auf [dem Designkonzept](../design/konzept.md), dem [Website-Konzept](../konzept-website.md) und den [Website-Texten](../texte/homepage/README.md) auf.

## Status

- [x] Bestehende Konzepte, Seitenentwürfe und Markenmaterial gesichtet.
- [x] Technische Richtung für den ersten Build festgelegt: natives WordPress-Block-Theme ohne zusätzliche Build-Abhängigkeiten.
- [x] Erste Theme-Struktur, globale Tokens, Templates, Template Parts und Startseiten-Patterns angelegt.
- [x] Erste wiederverwendbare Produkt-, Feature-, Ablauf-, Preis-, FAQ-, Ressourcen- und Screenshot-Briefing-Patterns ergänzt.
- [x] Setup-Assistent für optionale Plugin-Installation, geschützten Seitenimport und fünfzehn WooCommerce-Produktentwürfe mit Zuordnung zum License-Captain-Server dieses Shops umgesetzt.
- [x] Markdown-Inhalte in editierbare Gutenberg-Seitenvorlagen samt SEO-Basics kompilierbar gemacht.
- [x] Inhaltliche und visuelle Anpassung aller Seitentypen mit den finalen Texten.
- [x] WooCommerce- und Plugin-Ansichten mit echten Installationen und Produktdaten prüfen. *(WooCommerce 9.4 mit den 15 Pro-Produkten aus dem Setup-Assistenten: Katalog, Produkt, Warenkorb, klassischer und Block-Checkout, Testbestellungen, Bestätigung, Konto, E-Mails; eigene Theme-Vorlagen für Katalog, Produkt, Suche und Bestätigung. `tools/qa/shop-flow.cjs`.)*
- [ ] Redaktions-, Barrierefreiheits-, Browser- und Performance-Prüfung abschließen. *(Technisch abgeschlossen: 123 Seiten in 7 Breiten mit axe ohne Befund, Tastaturprüfung, CSS-Kompatibilität Firefox/Safari ohne Blocker, Lighthouse mit WooCommerce 94–96. Offen: redaktionelle Abnahme (`docs/ABNAHME.md`), Screenreader von Hand, Firefox/WebKit-Lauf über `site-check.yml` gegen Staging.)*
- [x] Release-Paket und Installations-/Betriebsdokumentation erstellen. *(`tools/build-theme-zip.sh`, `docs/BETRIEB.md`.)*

## Phase 1 – Anforderungen und Bestand sichern

- [x] `design/konzept.md`, `konzept-website.md`, `texte/homepage/` und `design/` erfassen.
- [x] Vorhandene Seitenrollen und Navigation als Grundlage übernehmen.
- [x] Produkte korrekt benennen: sieben kostenlose Kern-Plugins (inkl. Course Captain seit 16.11.2026), sieben separate Captain-Pro-Add-ons und License Captain als eigenes Produkt (Server und Client) für Plugin-Hersteller; Pro-Add-ons werden intern über License Captain lizenziert, ohne dass Pro-Kunden davon erfahren.
- [x] Bestehende Pläne und Preise nicht im Theme fest verdrahten; Preise kommen aus Shop-/Seiteninhalten.
- [ ] Für jeden Produktbereich finale URLs, Downloadziele, Checkoutziele und Supportwege mit der Website-Konfiguration abgleichen.
- [ ] Vor Release WordPress-, PHP-, WooCommerce- und Plugin-Mindestversionen anhand der dann freigegebenen Releases bestätigen. *(PHP 8.5, MySQL 9.7 und MariaDB 12.3 am 16.11.2026 entschieden und in Theme und Texten umgesetzt; Bestätigung gegen die finalen Releases offen.)*
- [ ] Bildrechte und finale Auswahl/Zuschnitte der Kapitänsillustrationen bestätigen; bis dahin keine Illustration als Produkt-UI ausgeben.

## Phase 2 – Plattform- und Inhaltsentscheidungen

- [x] WordPress-Block-Theme mit `theme.json` v3, HTML-Block-Templates und Pattern-Dateien als Startpunkt verwenden.
- [x] Theme bleibt Präsentationsschicht; Lizenz-, Checkout-, Gutschein-, Ticket- und Affiliate-Logik bleibt in den jeweiligen Plugins.
- [x] WooCommerce-Seiten über WordPress-Seiteninhalt und unterstützte WooCommerce-Blöcke ausgeben; keine instabilen internen Block-DOM-Strukturen voraussetzen.
- [x] Kein Theme-eigener Produkt-CPT und kein JavaScript-Framework im ersten Build. *(Einziges eigenes Skript: 2 KB Fehlerkennzeichnung für klassische WooCommerce-Formulare, nur auf Kasse und Konto.)*
- [x] Erste optionale Seitentemplates für Produkt-, Preis- und Ressourcenseiten angelegt; nach Sichtung der realen Produkt-UIs gegebenenfalls anpassen.
- [x] Yoast SEO im Import berücksichtigen: SEO-Titel, Meta-Beschreibung und Fokus-Keyphrase werden ohne Überschreiben eigener Yoast-Werte gesetzt.
- [x] Yoast-Social-Titel und -Beschreibung aus den SEO-Feldern ableiten und optional individuelle Social-Felder unterstützen.
- [x] Yoast SEO im redaktionellen Modell vervollständigen: Canonical URLs und Indexierung je Seitentyp prüfen; das Theme erzeugt keine konkurrierenden Meta-Tags. *(Mit Yoast SEO 28.8 auf WordPress 7.1 geprüft: je Seite genau ein Titel, Canonical, robots-Tag und eine Beschreibung wie importiert; behoben: doppelter `<title>` durch `title-tag`-Unterstützung des Block-Themes; Yoast-Sitemap ohne Warenkorb/Kasse/Konto und Autoren. `tools/qa/seo-head.py`.)*
- [ ] Zuständigkeit für Inhalte, SEO-Freigabe, rechtliche Seiten und Preisupdates festlegen. *(Rollenmodell in `docs/REDAKTION.md`; Personen benennt die Inhaberin.)*

## Phase 3 – Designsystem und Grundlagen

- [x] Farb-, Typografie-, Layout-, Abstands- und Button-Tokens in `theme.json` und CSS abbilden.
- [x] Farben und Tokens als Startwerte aus dem Konzept übernehmen und im Site Editor verfügbar machen.
- [x] Lesebreiten, globale Abstände, Fokusdarstellung, Links, Buttons und Formulargrundlagen definieren.
- [x] Sprunglink, sichtbare Hochkontrast-Fokusdarstellung und Tastaturfokus für breite Tabellen ergänzen.
- [x] Farbkontraste aller Kombinationen einschließlich Status- und Produktakzenten nach WCAG prüfen und dokumentieren. *(Tabelle in `design/konzept.md`, Abschnitt 2.)*
- [x] Mobile, Tablet und Desktop anhand vorhandener Mockups abgleichen.
- [x] Logo/Markenzeichen und finale Maskottchen-Assets optimiert und mit Alternativtextregeln einbinden. *(Vier freigestellte WebP-Posen als dekorative CSS-Hintergründe; Logo bleibt Wortmarke mit Anker-Icon, bis ein finales Logo vorliegt.)*
- [x] Editor-Styles mit Frontend-Styles abgleichen, damit bearbeitete Blöcke der Live-Darstellung entsprechen. *(Im echten Gutenberg-Editor-Canvas mit Theme-Styles geprüft; Darstellung entspricht dem Frontend – `tools/qa/editor-check.cjs`.)*

## Phase 4 – Theme-Grundgerüst

- [x] Theme-Verzeichnis mit `style.css`, `theme.json`, `functions.php` und README anlegen.
- [x] Globale Templates für Startseite, Seite, Beitrag, Archiv, Suche und 404 anlegen.
- [x] Header- und Footer-Template-Parts anlegen.
- [x] Kleine Theme-CSS-Datei für responsive Layouts und zentrale Komponenten anlegen.
- [x] Kopfbereich mit Navy-Fläche, hellem Menütext und Gold-CTA an die vorhandenen Website-Mockups angleichen.
- [x] Startseiten-Hero als zweispaltigen Markenauftritt mit Captain-Illustration und mobil gestapelter Darstellung umsetzen.
- [x] Startseiten-Produktübersicht als acht responsive, wiedererkennbare Produktkarten ausgeben.
- [x] Design-Tokens, Karten, Buttons, Produktseiten, FAQ, Preisübersicht und Medienplatzhalter visuell an die Referenzbilder angleichen.
- [x] Theme im WordPress-Admin installieren und Site-Editor-Kompatibilität prüfen. *(Theme-ZIP installiert; 3 519 Blöcke aus Templates, Parts, Patterns und Seiten bestehen die Blockvalidierung; Inhalte rendern im Editor-Canvas ohne ungültige Blöcke.)*
- [x] Navigationsblock, Menüzustände, Fokusreihenfolge und Tastaturbedienung im echten Browser prüfen. *(Playwright: Untermenü per Klick/Escape, Mobil- und Tablet-Overlay, Skip-Link, FAQ per Tastatur – alle Tests bestanden.)*
- [x] Theme-Angaben, Textdomain, Übersetzungsdateien und Lizenzhinweise für den Release vervollständigen. *(Kopfdaten, Domain Path und `.pot` erledigt; die Lizenz des Themes muss der Betreiber noch festlegen.)*

## Phase 5 – Komponenten und Vorlagen

- [x] Startseiten-Hero-Pattern mit B2B-Versprechen und klarer nächster Handlung bereitstellen.
- [x] Produktkarten-Pattern für die acht Website-Produkte bereitstellen.
- [x] Abschluss-CTA-Pattern bereitstellen.
- [x] Patterns für Produkt-Hero, Featuregruppen, Workflow, Screenshot mit erklärendem Platzhalter, Free-/Pro-Vergleich, Preispläne, Kompatibilität, FAQ und Ressourcen ergänzen.
- [x] Inhaltsbereiche nach H2 als breite, abwechselnd hinterlegte Gutenberg-Sektionen komponieren; Startseiten-Einstieg als Hero und Medien-Briefings als redaktionelle Karten ausgeben.
- [x] FAQ-Seiten in native Details-Blöcke und Preisübersichten in speziell formatierte, responsive Tabellen umwandeln.
- [x] Spezifische Pattern-Kompositionen für Features, Pro-/Preise, Vergleich, Lösung, Dokumentation, Support und Changelog in echten WordPress-Seiten abnehmen und bei Bedarf vertiefen.
- [x] Schlanke, barrierearme Brotkrumennavigation für Inhaltsseiten ergänzen; strukturierte Daten bleiben Yoast überlassen.
- [x] Tabellen- und FAQ-Darstellung für kleine Displays und Tastaturbedienung mit horizontal scrollbaren Tabellen und nativen Details-Blöcken vorbereiten.
- [x] Tabellenüberschriften semantisch markieren und scrollbare Tabellenregionen für die Tastatur fokussierbar ausgeben.
- [x] Passende Custom Templates beim Import neuen Seiten zuweisen und bestehende manuelle Vorlagenauswahl schützen.

## Phase 6 – Seiteninhalte einsetzen

- [x] Startseite, Produktübersicht, Captain-Pro-/Preis-/Vergleichsseiten, Produkt-Unterseiten, Dokumentation, Support, Integrationen, Kompatibilität, Bootsschul-Lösung, Über-uns, FAQs und Ratgeber aus Markdown in Theme-Inhalte kompilieren.
- [x] Importierte Seiten in einer echten WordPress-Installation redaktionell und visuell abnehmen. *(Technisch-visuell in WordPress 6.7 mit allen 90 Seiten abgenommen; redaktionelle Freigabe steht aus.)*
- [x] Screenshot-/Demo-/Kundenbeispiel-Platzhalter mit Aufnahmebriefing und klarer Kennzeichnung als Medienkarten in Redaktionsvorschau setzen.
- [ ] Medienkarten vor Livegang durch echte, freigegebene Ansichten bzw. belegte Kundenbeispiele ersetzen.
- [ ] Kundenlogos, Bewertungen, Kennzahlen oder Fallstudien nur nach Beleg und Freigabe einsetzen.
- [ ] Alle internen Links, CTAs, Downloads, Checkoutziele und Formulare mit realen Zielen verbinden. *(Interne Links ohne Fehler; Download-, Checkout- und Supportziele fehlen noch.)*

## Phase 7 – Shop und Plugin-Integration

- [x] Warenkorb- und Checkout-Seitenvorlagen so vorbereiten, dass deren WordPress-Seiteninhalt die WooCommerce-Blöcke enthält.
- [x] Mein-Konto-Seitentemplate für den WordPress-Seiteninhalt vorbereiten.
- [x] Assistent für WooCommerce-Produkte und License-Captain-Zuordnungen vorbereiten: fünfzehn jährliche Captain-Pro-Produktentwürfe mit bestehender Plan-/Preisstruktur einschließlich Form und Workflow Captain Pro, ohne Steuer- oder Zahlungseinstellungen zu ändern.
- [x] WooCommerce-Katalog, Produktdetail, Warenkorb, Checkout, Bestätigung, Konto und E-Mail-Einstiege mit installierter Shop-Konfiguration durchgehen. *(Desktop und mobil, Block- und klassischer Checkout; Shop-E-Mails in Markenfarben über den Setup-Assistenten.)*
- [x] Theme-Styling nur auf unterstützte WooCommerce-Blöcke und öffentliche Klassen anwenden; Block-Markup nicht nachbauen.
- [x] Produkt-/Pro-CTA und Preisangaben mit dem tatsächlichen Shop-Katalog abstimmen. *(`tools/price-check.py` gleicht Preisseite, Pro-Seiten und Preis-Pattern mit dem Katalog ab, aus dem der Setup-Assistent die Shop-Produkte anlegt; läuft bei jedem Push. Checkout-Links je Plan siehe Phase 6.)*
- [x] Kauf, Lizenzaktivierung, Erneuerung und Supportlinks end-to-end prüfen; Funktionsverantwortung bleibt bei Shop und Plugins. *(Mit License Captain 0.2.0, WooCommerce 11.3 und MariaDB: Kauf, Lizenz, Lizenzansicht, Aktivierung mit signierter Antwort, Funktionsfreigabe, Websitelimit, Verlängerung über Bezahlseite, Deaktivierung; `tools/qa/license-e2e.php`, läuft auch in `staging-php85.yml`. Supportlinks hängen an den offenen Zielen aus Phase 6.)*
- [x] Login-/Konto-Zustände, Fehlermeldungen und leere Warenkorb-/Suchzustände gestalten. *(Basisstyles auf öffentlichen WooCommerce-Klassen; Abnahme mit installiertem Shop offen.)*

## Phase 8 – SEO, Mehrsprachigkeit und Redaktion

- [x] Theme-Struktur für semantische Überschriften und redaktionell pflegbare Seiten vorbereitet.
- [x] Pro Inhaltsseite Yoast-SEO-Titel, Meta-Beschreibung, Fokus-Keyphrase und Social-Titel/-Beschreibung aus den Textmetadaten importieren; doppelte Fokus-Keyphrase der Startseite und Produktübersicht bereinigen.
- [ ] Social-Bilder und Snippet-Vorschauen pro Seite redaktionell auswählen und in Yoast abnehmen. *(Technisch in Yoast abgenommen: og:image, og:title und Beschreibung kommen auf allen 93 Seiten wie importiert an. Offen: redaktionelle Auswahl einzelner Seitenbilder.)*
- [x] Indexierung und Canonicals für Archive, Suche, Pagination und Shopseiten prüfen. *(Mit WooCommerce: Warenkorb, Kasse und Konto noindex und nicht in der Sitemap, Suche noindex, Produkte mit Canonical, Shop-Pagination funktioniert. Die Abnahme mit aktivem Yoast läuft über Phase 2.)*
- [x] Schema-Ausgabe von Yoast, WooCommerce und weiteren Plugins auf Doppelungen prüfen; strukturierte Daten nicht im Theme duplizieren. *(Theme gibt nachweislich keine strukturierten Daten aus; Yoast/WooCommerce bleiben allein zuständig.)*
- [x] URL-Slugs und Weiterleitungen für geänderte Seitennamen festlegen. *(`docs/WEITERLEITUNGEN.md`; ausgemusterte Seiten gehen beim Import automatisch auf Entwurf.)*
- [x] Textdomain und Übersetzungsworkflow aktivieren; deutschsprachige Website-Texte und UI-Strings sauber voneinander trennen. *(UI-Strings über `captain-plugins`-Textdomain und `tools/make-pot.py`; Website-Texte liegen als Seiteninhalte vor.)*
- [x] Redaktionsrollen, Pattern-Freigaben und Pflegeprozess für Preise, Changelog, Kompatibilität und Screenshots dokumentieren. *(`docs/REDAKTION.md`.)*

## Phase 9 – Qualität und Freigabe

- [x] Alle Seitentypen auf gängigen Desktop-, Tablet- und Mobilansichten manuell prüfen. *(Sichtprüfung bei 320, 390, 820, 1024, 1366 und 1920 px; behoben: Menüumbruch bei 1024 px, abgeschnittene Komposita bei 320 px. `site-check.cjs --all-widths` prüft 7 Ansichten automatisch.)*
- [ ] Tastaturbedienung, sichtbaren Fokus, Screenreader-Namen, Kontraste, Zoom bis 200 %, reduzierte Bewegung und Formularfehlerzustände prüfen. *(Automatisiert erledigt: axe-core ohne Verstöße auf 14 Seitentypen bei 100 % und 200 % Zoom, reduzierte Bewegung greift. Tastatur und Formularfehler jetzt auch im Shop geprüft (`tools/qa/keyboard.cjs`; klassische WooCommerce-Formulare melden Fehler per aria-invalid). Offen: manueller Screenreader-Durchlauf.)*
- [x] Sprunglink zum Hauptinhalt und kontraststarke, doppelt sichtbare Fokusdarstellung in die Theme-Vorlagen integrieren.
- [ ] HTML-Semantik, Heading-Hierarchie, Linktexte, Bildalternativen und Skip-Link in einem Screenreader-/Browserdurchlauf abnehmen. *(Automatisiert: je Seite genau eine H1, keine Hierarchiesprünge, keine leeren Links, Skip-Link, Landmarken und lang-Attribut auf 123 Seiten inklusive Shop; Screenreader-Durchlauf offen.)*
- [x] Layout mit und ohne WooCommerce, Yoast sowie den sieben kostenlosen Kern-Plugins und License Captain prüfen; degradierte Zustände verständlich halten. *(Mit und ohne WooCommerce geprüft; mit Yoast SEO 28.8, WooCommerce 11.3 und License Captain auf WordPress 7.1 geprüft. Am 17.11.2026 zusätzlich mit allen sieben Kern-Plugins und den Pro-Add-ons Voucher, Pass und Affiliate (13 Plugins aktiv, keine PHP-Fehler): Smoke-Test, SEO-Kopf, 122 Seiten in 7 Breiten mit axe ohne Befund, Testseiten mit den Frontends aller Plugins ohne Befund. Behoben: Plugin-Absendeknöpfe im Browser-Standard, fehlender Seitenrand bei Inhalten ohne volle Breite. Abgleich Texte ↔ Plugin-Stand: `docs/PLUGIN-ABGLEICH.md`.)*
- [x] Ladegewicht, Bildgrößen, Caching-Verhalten und Core Web Vitals mit realistischem Seiteninhalt bewerten. *(8–11 Requests, ca. 180–230 KB unkomprimiert, JS nur Core-Navigation; Core Web Vitals auf Staging messen.)*
- [x] SEO-Snippets, Social-Previews, Sitemap, robots/noindex und Weiterleitungen in Staging prüfen. *(In der Testinstallation mit WooCommerce: robots.txt und Core-Sitemap korrekt, alle Sitemap-URLs liefern 200, ohne noindex-Seiten und ohne Autoren-Sitemap; entfallene Theme-Seiten antworten mit 301. Mit Yoast übernimmt dessen Sitemap.)*
- [ ] Rechtliche Pflichtseiten, Datenschutz-/Cookie-Einbindung und Formularkonfiguration mit Verantwortlichen abgleichen. *(Impressum und Datenschutz liegen als Entwurfsvorlagen mit Betreiber-Platzhaltern bereit.)*
- [ ] Redaktionelle Abnahme aller Texte, Preise, Produktversprechen, Screenshots und CTAs einholen. *(Vorbereitet: `docs/ABNAHME.md` mit 93 Seiten, Status und Abzeichnungsspalten; Sprachregel und SEO-Felder automatisch geprüft.)*

## Phase 10 – Veröffentlichung und Betrieb

- [x] Theme-Version, Changelog, Lizenz und Installationspaket erstellen. *(Version 0.2.0, `CHANGELOG.md`, `tools/build-theme-zip.sh`; Lizenz offen.)*
- [x] Backup und Rückfallweg vor Aktivierung dokumentieren. *(`docs/BETRIEB.md`, Abschnitte 2 und 5.)*
- [x] Erst in Staging aktivieren und Shop-/Plugin-Regressionen prüfen. *(Zwei Staging-Nachbauten mit WordPress 7.1.4, WooCommerce 11.3, Yoast SEO 28.8, License Captain 0.2.0 und MariaDB: Installation per WP-CLI auf frischer Datenbank exakt nach `staging-php85.yml`, Import, Setup-Assistent, Testkauf mit Lizenz, 45 Integrationstests, Lizenzaktivierung, Smoke-Test mit Checkout, SEO-Kopf aller Seiten, Kaufablauf, Tastatur und axe auf 123 Seiten. Gefunden und behoben: doppelter Titel mit Yoast, doppelte H1 der Bestellbestätigung, von WooCommerce eingefügte Header-Symbole, Gravatar-Abruf, Abbruchschritt im Workflow. PHP 8.5 läuft im Workflow `staging-php85.yml` (WordPress aktiviert das Theme erst ab PHP 8.5).)*
- [ ] Produktionsaktivierung mit kurzem Smoke-Check für Startseite, Produkte, Preise, Checkout, Support und 404 durchführen. *(Smoke-Test `tools/qa/smoke.cjs` mit `--shop --product` prüft auch Warenkorb und Checkout.)*
- [x] Monitoring für Fehler, Checkout-Abbrüche, Suchanfragen und wichtige CTA-Klicks konfigurieren, datenschutzgerecht. *(Eingerichtet: stündlicher Verfügbarkeits- und Zertifikats-Check mit Issue-Alarm (`uptime.yml`), Must-Use-Plugin für License-Captain-Warnungen und tägliche Kennzahl abgebrochener Bestellungen (`tools/ops/captain-monitoring.php`). Scharf schalten: `SITE_URL` setzen und Plugin auf den Server legen. CTA-Klicks bewusst nur mit Einwilligung und eigenem Analysewerkzeug.)*
- [ ] Pflegezyklus für WordPress-/WooCommerce-Kompatibilität, Sicherheitsupdates, Barrierefreiheit und Inhalt festlegen. *(Vorschlag in `docs/BETRIEB.md`, Abschnitt 7; Bestätigung durch die Inhaberin offen.)*
- [x] Nach jedem größeren WordPress-, WooCommerce- oder Produktrelease kritische Seitentypen erneut durchgehen. *(Automatisiert: Workflow `site-check.yml` prüft wöchentlich und auf Knopfdruck Smoke-Test, alle Seiten in allen Breiten mit axe und Tastatur gegen `SITE_URL`, in Chromium, Firefox und WebKit; Liste in `docs/BETRIEB.md`, Abschnitt 8.)*

## Architektur des ersten Builds

Das Theme ist absichtlich leichtgewichtig. Es stellt globale Gestaltung, Vorlagen und redaktionelle Patterns bereit. Es implementiert keine Lizenzverwaltung, Warenkorblogik, Affiliate-Abrechnung oder Ticket-/Gutscheinprozesse. Diese Funktionen bleiben in den zuständigen Plugins und WooCommerce. Screenshots, Demos und Kundenbeispiele bleiben bis zur Freigabe gekennzeichnete Inhaltsplätze.

Der Setup-Assistent ist unter **Design → Einrichtung** verfügbar. Er installiert WooCommerce und Yoast SEO aus wordpress.org, wenn gewünscht. License Captain wird nur aus einer vorgegebenen HTTPS-ZIP installiert und verlangt dafür einen in `wp-config.php` hinterlegten SHA-256-Hash; alternativ ist die manuelle Installation der freigegebenen ZIP vorgesehen. Seiteninhalte sind in drei Gruppen wählbar. Bereits bearbeitete/benutzerdefinierte Seiten bleiben geschützt. Preispläne werden nur bei aktiver WooCommerce- und License-Captain-Installation sowie EUR-Währung als verborgene Produktentwürfe erstellt und zugeordnet. Der Wizard verändert keine Shop-Steuern, Zahlungen, rechtlichen Angaben oder Produktdateien.

Seiten mit noch nicht hinterlegten Download-/Checkout-Zielen markieren diese Stelle sichtbar als redaktionellen Linkziel-Platzhalter. Eine eigene Brotkrumennavigation verbessert die Orientierung auf Inhaltsseiten; strukturierte Breadcrumb-Daten werden nicht dupliziert. Der Importer wählt Produkt-, Preis-, Übersichts- und Ressourcen-Templates anhand der importierten URL aus und ersetzt keine später manuell abweichend gewählte Vorlage.

## Aktueller Build-Stand

Stand 16. November 2026, Theme-Version 0.4.0, acht Website-Produkte einschließlich Course Captain. Das Theme setzt das Designkonzept und die Mockups um: Navy-Header mit Klick-Untermenüs und Gold-CTA, Startseiten-Hero mit Kapitän, Produkt-Hero mit Medienrahmen, Produkt- und Featurekarten mit Icons für alle sieben Produkte, Tarifkarten, CTA-Bänder, ruhiger Lesefluss für Ratgeber und Dokumentation sowie breite Matrizen für Kompatibilität und Integrationen. Der Inhaltscompiler erzeugt 103 importierbare Seiten (davon Impressum und Datenschutz als Entwürfe).

**Geprüft in WordPress 6.7 (SQLite-Testinstallation):** Gutenberg-Blockvalidierung aller Templates, Parts, Patterns und Seiten ohne Fehler; Link-Crawler ohne tote interne Links; 90 Seiten in Desktop, Tablet und Mobil ohne horizontales Scrollen, mit genau einer H1 und ohne Hierarchiesprünge; axe-core ohne Verstöße; Menü-, Skip-Link- und FAQ-Tastaturtests bestanden; keine PHP-Warnungen.

**Zusätzlich vorhanden:** Betriebsdokumentation (`docs/BETRIEB.md`), Redaktionshandbuch (`docs/REDAKTION.md`), Weiterleitungsliste (`docs/WEITERLEITUNGEN.md`), QA-Werkzeuge (`tools/qa/`), Social-Bilder, Mindestversionen PHP 8.5 / MySQL 9.7 / MariaDB 12.3.

**Zusätzlich geprüft (0.4.0):** PHPCS ohne Befunde, Lighthouse 96–100, Editor-Canvas ohne ungültige Blöcke, axe ohne Verstöße auf allen 103 Seiten in vier Ansichten, visueller Regressionstest eingerichtet.

**Nur mit echter Umgebung prüfbar:** WooCommerce-Kaufstrecke und Konto, Yoast-Ausgabe mit echtem Plugin, Screenreader-Durchlauf mit NVDA/VoiceOver, Core Web Vitals auf Staging.

**Vom Betreiber zu entscheiden oder zu liefern:** Theme-Lizenz, Impressums- und Datenschutzangaben, Bildrechte der Kapitänsillustrationen, finale Download-, Checkout- und Support-URLs, echte Produkt-Screenshots (siehe `texte/homepage/medieninventar.md`), License-Captain-Preise.
