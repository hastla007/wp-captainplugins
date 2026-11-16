# Theme-Bauplan: Captain Plugins

Dieses Dokument ist die durchgängige To-do-Liste für die Umsetzung, Prüfung und Veröffentlichung des WordPress-Themes. Es baut auf [dem Designkonzept](../design/konzept.md), dem [Website-Konzept](../konzept-website.md) und den [Website-Texten](../texte/homepage/README.md) auf.

## Status

- [x] Bestehende Konzepte, Seitenentwürfe und Markenmaterial gesichtet.
- [x] Technische Richtung für den ersten Build festgelegt: natives WordPress-Block-Theme ohne zusätzliche Build-Abhängigkeiten.
- [x] Erste Theme-Struktur, globale Tokens, Templates, Template Parts und Startseiten-Patterns angelegt.
- [x] Erste wiederverwendbare Produkt-, Feature-, Ablauf-, Preis-, FAQ-, Ressourcen- und Screenshot-Briefing-Patterns ergänzt.
- [x] Setup-Assistent für optionale Plugin-Installation, geschützten Seitenimport und fünfzehn WooCommerce-Produktentwürfe mit Zuordnung zum License-Captain-Server dieses Shops umgesetzt.
- [x] Markdown-Inhalte in editierbare Gutenberg-Seitenvorlagen samt SEO-Basics kompilierbar gemacht.
- [ ] Inhaltliche und visuelle Anpassung aller Seitentypen mit den finalen Texten.
- [ ] WooCommerce- und Plugin-Ansichten mit echten Installationen und Produktdaten prüfen.
- [ ] Redaktions-, Barrierefreiheits-, Browser- und Performance-Prüfung abschließen.
- [ ] Release-Paket und Installations-/Betriebsdokumentation erstellen.

## Phase 1 – Anforderungen und Bestand sichern

- [x] `design/konzept.md`, `konzept-website.md`, `texte/homepage/` und `design/` erfassen.
- [x] Vorhandene Seitenrollen und Navigation als Grundlage übernehmen.
- [x] Produkte korrekt benennen: sechs kostenlose Kern-Plugins, sechs separate Captain-Pro-Add-ons und License Captain als eigenes Produkt (Server und Client) für Plugin-Hersteller; Pro-Add-ons werden intern über License Captain lizenziert, ohne dass Pro-Kunden davon erfahren.
- [x] Bestehende Pläne und Preise nicht im Theme fest verdrahten; Preise kommen aus Shop-/Seiteninhalten.
- [ ] Für jeden Produktbereich finale URLs, Downloadziele, Checkoutziele und Supportwege mit der Website-Konfiguration abgleichen.
- [ ] Vor Release WordPress-, PHP-, WooCommerce- und Plugin-Mindestversionen anhand der dann freigegebenen Releases bestätigen.
- [ ] Bildrechte und finale Auswahl/Zuschnitte der Kapitänsillustrationen bestätigen; bis dahin keine Illustration als Produkt-UI ausgeben.

## Phase 2 – Plattform- und Inhaltsentscheidungen

- [x] WordPress-Block-Theme mit `theme.json` v3, HTML-Block-Templates und Pattern-Dateien als Startpunkt verwenden.
- [x] Theme bleibt Präsentationsschicht; Lizenz-, Checkout-, Gutschein-, Ticket- und Affiliate-Logik bleibt in den jeweiligen Plugins.
- [x] WooCommerce-Seiten über WordPress-Seiteninhalt und unterstützte WooCommerce-Blöcke ausgeben; keine instabilen internen Block-DOM-Strukturen voraussetzen.
- [x] Kein Theme-eigener Produkt-CPT und kein JavaScript-Framework im ersten Build.
- [x] Erste optionale Seitentemplates für Produkt-, Preis- und Ressourcenseiten angelegt; nach Sichtung der realen Produkt-UIs gegebenenfalls anpassen.
- [x] Yoast SEO im Import berücksichtigen: SEO-Titel, Meta-Beschreibung und Fokus-Keyphrase werden ohne Überschreiben eigener Yoast-Werte gesetzt.
- [x] Yoast-Social-Titel und -Beschreibung aus den SEO-Feldern ableiten und optional individuelle Social-Felder unterstützen.
- [ ] Yoast SEO im redaktionellen Modell vervollständigen: Canonical URLs und Indexierung je Seitentyp prüfen; das Theme erzeugt keine konkurrierenden Meta-Tags.
- [ ] Zuständigkeit für Inhalte, SEO-Freigabe, rechtliche Seiten und Preisupdates festlegen.

## Phase 3 – Designsystem und Grundlagen

- [x] Farb-, Typografie-, Layout-, Abstands- und Button-Tokens in `theme.json` und CSS abbilden.
- [x] Farben und Tokens als Startwerte aus dem Konzept übernehmen und im Site Editor verfügbar machen.
- [x] Lesebreiten, globale Abstände, Fokusdarstellung, Links, Buttons und Formulargrundlagen definieren.
- [x] Sprunglink, sichtbare Hochkontrast-Fokusdarstellung und Tastaturfokus für breite Tabellen ergänzen.
- [ ] Farbkontraste aller Kombinationen einschließlich Status- und Produktakzenten nach WCAG prüfen und dokumentieren.
- [ ] Mobile, Tablet und Desktop anhand vorhandener Mockups abgleichen.
- [ ] Logo/Markenzeichen und finale Maskottchen-Assets optimiert und mit Alternativtextregeln einbinden.
- [ ] Editor-Styles mit Frontend-Styles abgleichen, damit bearbeitete Blöcke der Live-Darstellung entsprechen.

## Phase 4 – Theme-Grundgerüst

- [x] Theme-Verzeichnis mit `style.css`, `theme.json`, `functions.php` und README anlegen.
- [x] Globale Templates für Startseite, Seite, Beitrag, Archiv, Suche und 404 anlegen.
- [x] Header- und Footer-Template-Parts anlegen.
- [x] Kleine Theme-CSS-Datei für responsive Layouts und zentrale Komponenten anlegen.
- [x] Kopfbereich mit Navy-Fläche, hellem Menütext und Gold-CTA an die vorhandenen Website-Mockups angleichen.
- [x] Startseiten-Hero als zweispaltigen Markenauftritt mit Captain-Illustration und mobil gestapelter Darstellung umsetzen.
- [x] Startseiten-Produktübersicht als sieben responsive, wiedererkennbare Produktkarten ausgeben.
- [x] Design-Tokens, Karten, Buttons, Produktseiten, FAQ, Preisübersicht und Medienplatzhalter visuell an die Referenzbilder angleichen.
- [ ] Theme im WordPress-Admin installieren und Site-Editor-Kompatibilität prüfen.
- [ ] Navigationsblock, Menüzustände, Fokusreihenfolge und Tastaturbedienung im echten Browser prüfen.
- [ ] Theme-Angaben, Textdomain, Übersetzungsdateien und Lizenzhinweise für den Release vervollständigen.

## Phase 5 – Komponenten und Vorlagen

- [x] Startseiten-Hero-Pattern mit B2B-Versprechen und klarer nächster Handlung bereitstellen.
- [x] Produktkarten-Pattern für die sieben Website-Produkte bereitstellen.
- [x] Abschluss-CTA-Pattern bereitstellen.
- [x] Patterns für Produkt-Hero, Featuregruppen, Workflow, Screenshot mit erklärendem Platzhalter, Free-/Pro-Vergleich, Preispläne, Kompatibilität, FAQ und Ressourcen ergänzen.
- [x] Inhaltsbereiche nach H2 als breite, abwechselnd hinterlegte Gutenberg-Sektionen komponieren; Startseiten-Einstieg als Hero und Medien-Briefings als redaktionelle Karten ausgeben.
- [x] FAQ-Seiten in native Details-Blöcke und Preisübersichten in speziell formatierte, responsive Tabellen umwandeln.
- [ ] Spezifische Pattern-Kompositionen für Features, Pro-/Preise, Vergleich, Lösung, Dokumentation, Support und Changelog in echten WordPress-Seiten abnehmen und bei Bedarf vertiefen.
- [x] Schlanke, barrierearme Brotkrumennavigation für Inhaltsseiten ergänzen; strukturierte Daten bleiben Yoast überlassen.
- [x] Tabellen- und FAQ-Darstellung für kleine Displays und Tastaturbedienung mit horizontal scrollbaren Tabellen und nativen Details-Blöcken vorbereiten.
- [x] Tabellenüberschriften semantisch markieren und scrollbare Tabellenregionen für die Tastatur fokussierbar ausgeben.
- [x] Passende Custom Templates beim Import neuen Seiten zuweisen und bestehende manuelle Vorlagenauswahl schützen.

## Phase 6 – Seiteninhalte einsetzen

- [x] Startseite, Produktübersicht, Captain-Pro-/Preis-/Vergleichsseiten, Produkt-Unterseiten, Dokumentation, Support, Integrationen, Kompatibilität, Bootsschul-Lösung, Über-uns, FAQs und Ratgeber aus Markdown in Theme-Inhalte kompilieren.
- [ ] Importierte Seiten in einer echten WordPress-Installation redaktionell und visuell abnehmen.
- [x] Screenshot-/Demo-/Kundenbeispiel-Platzhalter mit Aufnahmebriefing und klarer Kennzeichnung als Medienkarten in Redaktionsvorschau setzen.
- [ ] Medienkarten vor Livegang durch echte, freigegebene Ansichten bzw. belegte Kundenbeispiele ersetzen.
- [ ] Kundenlogos, Bewertungen, Kennzahlen oder Fallstudien nur nach Beleg und Freigabe einsetzen.
- [ ] Alle internen Links, CTAs, Downloads, Checkoutziele und Formulare mit realen Zielen verbinden.

## Phase 7 – Shop und Plugin-Integration

- [x] Warenkorb- und Checkout-Seitenvorlagen so vorbereiten, dass deren WordPress-Seiteninhalt die WooCommerce-Blöcke enthält.
- [x] Mein-Konto-Seitentemplate für den WordPress-Seiteninhalt vorbereiten.
- [x] Assistent für WooCommerce-Produkte und License-Captain-Zuordnungen vorbereiten: fünfzehn jährliche Captain-Pro-Produktentwürfe mit bestehender Plan-/Preisstruktur einschließlich Form und Workflow Captain Pro, ohne Steuer- oder Zahlungseinstellungen zu ändern.
- [ ] WooCommerce-Katalog, Produktdetail, Warenkorb, Checkout, Bestätigung, Konto und E-Mail-Einstiege mit installierter Shop-Konfiguration durchgehen.
- [ ] Theme-Styling nur auf unterstützte WooCommerce-Blöcke und öffentliche Klassen anwenden; Block-Markup nicht nachbauen.
- [ ] Produkt-/Pro-CTA und Preisangaben mit dem tatsächlichen Shop-Katalog abstimmen.
- [ ] Kauf, Lizenzaktivierung, Erneuerung und Supportlinks end-to-end prüfen; Funktionsverantwortung bleibt bei Shop und Plugins.
- [ ] Login-/Konto-Zustände, Fehlermeldungen und leere Warenkorb-/Suchzustände gestalten.

## Phase 8 – SEO, Mehrsprachigkeit und Redaktion

- [x] Theme-Struktur für semantische Überschriften und redaktionell pflegbare Seiten vorbereitet.
- [x] Pro Inhaltsseite Yoast-SEO-Titel, Meta-Beschreibung, Fokus-Keyphrase und Social-Titel/-Beschreibung aus den Textmetadaten importieren; doppelte Fokus-Keyphrase der Startseite und Produktübersicht bereinigen.
- [ ] Social-Bilder und Snippet-Vorschauen pro Seite redaktionell auswählen und in Yoast abnehmen.
- [ ] Indexierung und Canonicals für Archive, Suche, Pagination und Shopseiten prüfen.
- [ ] Schema-Ausgabe von Yoast, WooCommerce und weiteren Plugins auf Doppelungen prüfen; strukturierte Daten nicht im Theme duplizieren.
- [ ] URL-Slugs und Weiterleitungen für geänderte Seitennamen festlegen.
- [ ] Textdomain und Übersetzungsworkflow aktivieren; deutschsprachige Website-Texte und UI-Strings sauber voneinander trennen.
- [ ] Redaktionsrollen, Pattern-Freigaben und Pflegeprozess für Preise, Changelog, Kompatibilität und Screenshots dokumentieren.

## Phase 9 – Qualität und Freigabe

- [ ] Alle Seitentypen auf gängigen Desktop-, Tablet- und Mobilansichten manuell prüfen.
- [ ] Tastaturbedienung, sichtbaren Fokus, Screenreader-Namen, Kontraste, Zoom bis 200 %, reduzierte Bewegung und Formularfehlerzustände prüfen.
- [x] Sprunglink zum Hauptinhalt und kontraststarke, doppelt sichtbare Fokusdarstellung in die Theme-Vorlagen integrieren.
- [ ] HTML-Semantik, Heading-Hierarchie, Linktexte, Bildalternativen und Skip-Link in einem Screenreader-/Browserdurchlauf abnehmen.
- [ ] Layout mit und ohne WooCommerce, Yoast sowie den sechs kostenlosen Kern-Plugins und License Captain prüfen; degradierte Zustände verständlich halten.
- [ ] Ladegewicht, Bildgrößen, Caching-Verhalten und Core Web Vitals mit realistischem Seiteninhalt bewerten.
- [ ] SEO-Snippets, Social-Previews, Sitemap, robots/noindex und Weiterleitungen in Staging prüfen.
- [ ] Rechtliche Pflichtseiten, Datenschutz-/Cookie-Einbindung und Formularkonfiguration mit Verantwortlichen abgleichen.
- [ ] Redaktionelle Abnahme aller Texte, Preise, Produktversprechen, Screenshots und CTAs einholen.

## Phase 10 – Veröffentlichung und Betrieb

- [ ] Theme-Version, Changelog, Lizenz und Installationspaket erstellen.
- [ ] Backup und Rückfallweg vor Aktivierung dokumentieren.
- [ ] Erst in Staging aktivieren und Shop-/Plugin-Regressionen prüfen.
- [ ] Produktionsaktivierung mit kurzem Smoke-Check für Startseite, Produkte, Preise, Checkout, Support und 404 durchführen.
- [ ] Monitoring für Fehler, Checkout-Abbrüche, Suchanfragen und wichtige CTA-Klicks konfigurieren, datenschutzgerecht.
- [ ] Pflegezyklus für WordPress-/WooCommerce-Kompatibilität, Sicherheitsupdates, Barrierefreiheit und Inhalt festlegen.
- [ ] Nach jedem größeren WordPress-, WooCommerce- oder Produktrelease kritische Seitentypen erneut durchgehen.

## Architektur des ersten Builds

Das Theme ist absichtlich leichtgewichtig. Es stellt globale Gestaltung, Vorlagen und redaktionelle Patterns bereit. Es implementiert keine Lizenzverwaltung, Warenkorblogik, Affiliate-Abrechnung oder Ticket-/Gutscheinprozesse. Diese Funktionen bleiben in den zuständigen Plugins und WooCommerce. Screenshots, Demos und Kundenbeispiele bleiben bis zur Freigabe gekennzeichnete Inhaltsplätze.

Der Setup-Assistent ist unter **Design → Einrichtung** verfügbar. Er installiert WooCommerce und Yoast SEO aus wordpress.org, wenn gewünscht. License Captain wird nur aus einer vorgegebenen HTTPS-ZIP installiert und verlangt dafür einen in `wp-config.php` hinterlegten SHA-256-Hash; alternativ ist die manuelle Installation der freigegebenen ZIP vorgesehen. Seiteninhalte sind in drei Gruppen wählbar. Bereits bearbeitete/benutzerdefinierte Seiten bleiben geschützt. Preispläne werden nur bei aktiver WooCommerce- und License-Captain-Installation sowie EUR-Währung als verborgene Produktentwürfe erstellt und zugeordnet. Der Wizard verändert keine Shop-Steuern, Zahlungen, rechtlichen Angaben oder Produktdateien.

Seiten mit noch nicht hinterlegten Download-/Checkout-Zielen markieren diese Stelle sichtbar als redaktionellen Linkziel-Platzhalter. Eine eigene Brotkrumennavigation verbessert die Orientierung auf Inhaltsseiten; strukturierte Breadcrumb-Daten werden nicht dupliziert. Der Importer wählt Produkt-, Preis-, Übersichts- und Ressourcen-Templates anhand der importierten URL aus und ersetzt keine später manuell abweichend gewählte Vorlage.

## Aktueller Build-Stand

Die Pattern-Bibliothek enthält einen Produkt-Hero, Featurekarten, eine Dreischrittfolge, einen Free-/Pro-Vergleich, Preisentwürfe, einen Kompatibilitätshinweis, FAQs mit nativen Details-Blöcken, Ressourcen-Karten und ein Screenshot-Aufnahmebriefing. Der Inhaltscompiler erzeugt aus 71 Markdown-Quellseiten fünf notwendige Verzeichnisseiten als 76 importierbare Gutenberg-Inhalte mit Hero-, Abschnitts-, CTA- und Medienkarten; FAQ-Seiten werden als native Details-Akkordeons und Preisübersichten mit semantischen, responsiven Tabellen ausgegeben. Alle Inhaltsseiten erhalten SEO-Titel, Meta-Beschreibung und Fokus-Keyphrase; Yoast erhält Social-Titel/-Beschreibung. Platzhalterseiten werden als Entwurf angelegt. Preise werden vor Shop-Veröffentlichung mit dem Produktkatalog abgeglichen.
