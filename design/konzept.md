# Designkonzept für das Captain-Plugins-WordPress-Theme

**Stand:** 15. November 2026  
**Zweck:** Visuelle und technische Designgrundlage für die Umsetzung der Captain-Plugins-Website als WordPress-Theme.  
**Verwandte Dokumente:** [Website-Umsetzungskonzept](../konzept-website.md), [redaktionelles Website-Konzept](../texte/homepage/konzept.md), [Texte und Seiteninventar](../texte/homepage/README.md).

## 1. Ausgangslage und Gestaltungsziel

Das Repo enthält bereits eine umfangreiche Website-Copy mit Seitenstruktur, SEO-Feldern, Produkt- und Pro-Abgrenzung, Preisplänen, Kompatibilität, Installation, Support, FAQ, Ratgeberartikeln und Platzhaltern für Screenshots und Demos. Das Website-Umsetzungskonzept beschreibt Navigation, Seitendramaturgie, CTAs, mobile Darstellung und Barrierefreiheit. Dieses Designkonzept übersetzt diese Vorarbeit in konkrete Theme-Bausteine.

Unter `design/mascot/` befinden sich acht JPEG-Dateien mit Kapitänsillustrationen. Sie geben der Produktfamilie ein wiedererkennbares Motiv; sie sind keine Produkt-Screenshots. Das Designkonzept `design/konzept.md` war zuvor leer. Im Repository ist keine fertige Theme-Oberfläche dokumentiert. Die erste Umsetzung soll deshalb auf den vorhandenen Texten und Illustrationen aufbauen, ohne eine nicht belegte UI oder Referenzen vorzutäuschen.

### Gestaltungsziel

Ein ruhiges, hochwertiges B2B-Software-Design, das komplexe Plugin-Funktionen verständlich strukturiert. Der Auftritt soll:

- in wenigen Sekunden vermitteln, welche Geschäftsaufgabe jedes Produkt löst;
- auf Screenshots, klare Abläufe und nachvollziehbare Fakten als Produktbelege setzen;
- die Kapitänsfigur sparsam als Markenakzent verwenden;
- über alle Produktseiten hinweg eine konsistente Navigation und Interaktion bieten;
- auf Mobilgeräten, per Tastatur und mit assistiven Technologien nutzbar sein;
- redaktionelle Pflege über WordPress-Blöcke ermöglichen, ohne für jede Seite individuelle Layouts zu programmieren.

## 2. Markenbild und visuelle Sprache

**Leitidee:** „Klarer Kurs für Geschäftsprozesse in WordPress.“  
Die Metapher des Kapitäns bietet Orientierung und Wiedererkennbarkeit. Sie soll die Inhalte unterstützen und darf technische Produktbelege nicht verdrängen.

### Designprinzipien

1. **Nutzen vor Dekoration:** Überschriften nennen Aufgabe oder Ergebnis; Illustrationen haben eine klare Funktion.
2. **Vertrauen durch Klarheit:** Preise, WooCommerce-Abhängigkeiten, Free-/Pro-Umfang, Kompatibilität und Support sichtbar und präzise darstellen.
3. **Wiederholung schafft Orientierung:** identische Komponenten verhalten sich auf jeder Produktseite gleich.
4. **Farbe unterstützt, erklärt aber nicht allein:** jedes Produkt hat neben einem Akzent auch Namen und Icon/Label.
5. **Echte Produktansichten vor Symbolbildern:** Screenshots zeigen reale, freigegebene Oberflächen; bis dahin sichtbare Platzhalter nur intern bzw. mit klarer Platzhalterkennzeichnung.

### Farb- und Typografiesystem

Die folgenden Farbwerte sind ein **Startvorschlag**, kein bestätigtes bestehendes Corporate Design. Vor Umsetzung mit Logo, Maskottchen und Kontrastprüfung abgleichen.

| Token | Startwert | Verwendung |
|---|---|---|
| `--cp-color-ink` | `#172B3A` | Haupttext, starke Überschriften |
| `--cp-color-navy` | `#143B53` | Header, Markenflächen, primäre Links |
| `--cp-color-blue-soft` | `#EAF2F6` | ruhige Flächen, Hinweisbereiche |
| `--cp-color-gold` | `#D5A64A` | sparsame Akzente, Hervorhebung |
| `--cp-color-paper` | `#FFFFFF` | Inhaltsflächen |
| `--cp-color-surface` | `#F5F7F8` | abgesetzte Sektionen/Karten |
| `--cp-color-muted` | `#52616B` | Sekundärtext |
| `--cp-color-border` | `#D7E0E5` | Trennlinien und Kartenränder |
| `--cp-color-success` | `#1F6B4F` | bestätigte Statusmeldungen |
| `--cp-color-error` | `#A73535` | Fehlermeldungen |

Gold soll für kleine Highlights und nicht für Fließtext auf weißem Hintergrund genutzt werden, sofern die Kontrastprüfung keinen geeigneten Kontrast nachweist. Statusfarben erhalten stets ein Textlabel oder Symbol mit zugänglichem Namen.

**Produktakzente (noch festzulegen):** Ein Akzent je Produktfamilie kann Karten, kleine Linien und Icons differenzieren. Die Farben werden in einer Tokens-Tabelle dokumentiert und auf Text-/UI-Kontrast geprüft; Produktfarben dürfen keine eigenständigen, losgelösten Markenwelten bilden.

**Typografie:** lokal/systemnahes Sans-Serif-Stack als Standard, zum Beispiel `system-ui, -apple-system, "Segoe UI", sans-serif`. Eine zusätzliche Webfont wird nur eingesetzt, wenn ein klarer Markenwert entsteht und Lizenz, Ladeverhalten und Fallback geregelt sind. Fließtext großzügig bemessen und auf Mobilgeräten nicht unter komfortable Lesbarkeit verkleinern. Überschriften erhalten eine klare, responsive Skala; Zeilenlänge im Textbereich begrenzen.

### Layout-Raster und Abstände

- Zentrierter Inhaltscontainer mit einer maximalen Breite von etwa 72–76rem; exakte Werte im Theme-Token festlegen.
- Lesebereiche bei langen Texten enger halten als Produktvergleiche oder Tabellen.
- 12-Spalten-Raster nur für größere Ansichten; auf kleinen Displays einspaltig.
- Ein einheitliches Abstands-Raster in CSS-Variablen verwenden (z. B. 4/8/12/16/24/32/48/64/96 px).
- Sektionen mit klaren vertikalen Abständen trennen. Karten nicht durch übermäßige Schatten, Rundungen oder Verläufe stapeln.
- Rahmen, Radius und Schatten als wenige konsistente Tokens definieren; Interaktionszustände klar sichtbar lassen.

## 3. Kapitänsillustrationen und Bildsprache

Die bestehenden JPEGs im Ordner `design/mascot/` sind Ausgangsmaterial. Einzelne Dateien vor der Produktion visuell sichten, Auflösung und Zuschnitt prüfen und klären, ob freigestellte Exportvarianten vorliegen oder erstellt werden dürfen.

| Pose / Funktion | Empfohlener Einsatz | Vermeiden |
|---|---|---|
| Zeigende Pose | Startseiten-Hero oder Wegweiser zu Produktauswahl | dauerhaft neben jedem CTA wiederholen |
| Daumen hoch | kurze Bestätigung, Abschluss-/Onboarding-Bereich | als Beweis für Produktqualität oder Kundenzufriedenheit ausgeben |
| WordPress-Tablet | WordPress-Bezug auf Startseite oder Über-Seite | Produkt-Screenshot vortäuschen |
| Fernrohr | Entdecken/Orientierung, Ressourcen oder Ratgeber | technische Funktionsgrafik ersetzen |
| Weitere Posen/Varianten | erst nach Sichtung in passende Szenen aufnehmen | ungeprüfte Auflösung oder unpassende Bildausschnitte veröffentlichen |

**Bildverarbeitung:** Zuschnitt mit ausreichend Weißraum; auf ein konsistentes Verhältnis und eine einheitliche visuelle Größe bringen. Wenn Transparenz erstellt wird, die Quelle erhalten und Kantenqualität kontrollieren. Für Website-Einsatz optimierte responsive Formate exportieren (WebP/AVIF, sofern die WordPress-Ausgabe das sauber unterstützt) und JPEG-Originale als Ausgang behalten.

**Alt-Texte:** dekoratives Maskottchen erhält leeren Alt-Text. Wenn die Pose im Kontext eine Bedeutung trägt, diese knapp beschreiben. Keine lange Bildbeschreibung, wenn der danebenstehende Text dieselbe Aussage bereits vermittelt.

**Produkt-Screenshots:** Layout-Platzhalter in Textentwürfen sind als Briefing für spätere Aufnahmen zu behandeln. Auf echten Produktseiten sollen reale UI-Aufnahmen mit anonymisierten Testdaten, erklärender Bildunterschrift und passender mobiler Variante eingesetzt werden. Keine Kundendaten, API-Schlüssel, Lizenzschlüssel, Bestellnummern oder echten Bankdaten zeigen.

## 4. Theme-Technologie und redaktionelles Modell

### Empfehlung: natives WordPress-Block-Theme

Ein leichtgewichtiges Block-Theme mit `theme.json`, Block-Templates, Template Parts und Patterns ist die bevorzugte Grundlage. Es ermöglicht wiederverwendbare Website-Komponenten und redaktionelle Anpassungen im Site Editor, während globale Farben und Abstände konsistent bleiben.

Die Umsetzung soll nicht für jedes Produkt ein vollständig eigenes Seitendesign bauen. Stattdessen werden wenige Seitentypen und Patterns bereitgestellt. Wenn vorhandener WordPress-Stack oder ein technisches Plugin dagegen spricht, kann ein klassisches Theme mit denselben Design-Tokens und Komponenten als Alternative umgesetzt werden; diese Entscheidung fällt vor dem Theme-Scaffold.

### Benötigte Templates und Template Parts

| WordPress-Template / Teil | Aufgabe |
|---|---|
| `front-page.html` | Startseite und Einstieg in die Produktfamilie |
| `page.html` | allgemeine Inhaltsseiten |
| `single.html` | Ratgeberartikel |
| `archive.html` / Ratgeberarchiv | Ratgeberübersicht und thematische Archive |
| `search.html` | Suchergebnisse |
| `404.html` | hilfreiche Fehlerseite mit Produkt-/Ressourcenlinks |
| Header Template Part | Desktop- und Mobilnavigation |
| Footer Template Part | Produkt-, Ressourcen-, Kontakt- und Rechtliches-Links |
| Breadcrumb-Pattern/Part | Orientierung bei Produkt-Unterseiten und Ratgeber |
| `theme.json` | globale Palette, Typografie, Abstände, Layoutbreiten und Editor-Styles |

Produktseiten werden zuerst als native Seiten mit wiederverwendbaren Patterns modelliert. Ein eigener Custom Post Type ist erst nötig, wenn Produktdaten unabhängig von Seiten gepflegt, automatisch verglichen oder über mehrere Listen ausgespielt werden müssen. Nicht ohne konkreten Bedarf zusätzliche Inhaltsmodelle oder Theme-Abhängigkeiten einführen.

### Vorgeschlagene Block-Patterns

- Produkt-Hero (Eyebrow, H1, Nutzen, CTA(s), Medienfläche)
- Produktkarte (Kurzbeschreibung, Zielgruppe, Status „kostenlos“/„Pro“, Link)
- Nutzen-/Featuregruppe mit Icon oder nummeriertem Ablauf
- Workflow in drei bis fünf Schritten
- UI-Screenshot mit Beschriftung und Quellen-/Kontexttext
- Kostenlos-/Pro-Vergleich
- Preisplan-Karten und Tarifvergleich
- Integrations-/Kompatibilitäts-Hinweis
- FAQ-Akkordeon oder native Details/Summary-Interaktion
- Ressourcen-/Ratgeberkarte
- Abschluss-CTA
- Hinweis-/Statusbox (Voraussetzung, Kompatibilität, Beta/Status nur wenn relevant)

Patterns erhalten editorfreundliche Texte, erkennbare Namen und einfache Konfigurationsoptionen. Autoren sollen Layouts zusammensetzen können, ohne Farben, Abstände und Schriftgrößen beliebig aus dem System zu lösen. Für Standardaufgaben keine Shortcode-Abhängigkeit im Theme erzeugen.

## 5. Seitenvorlagen und visuelle Hierarchie

Die vollständige URL- und Inhaltsstruktur steht im [Website-Umsetzungskonzept](../konzept-website.md). Das Theme benötigt mindestens folgende Layoutvarianten:

- **Startseite:** großzügiger Hero, Produktauswahl, Free-/Pro-Erklärung, Nutzungsszenarien, abschließender CTA.
- **Produktübersicht:** Auswahl nach Geschäftsaufgabe, Produktkarten und Vergleichseinstieg.
- **Produktdetail:** Produkt-Hero, Workflow, wichtigste Features, UI-Bild, Integrationen/Voraussetzungen, Free-/Pro-Verweis, FAQ-Auszug, CTA.
- **Features:** vollständige Funktionsgruppen mit internen Sprunglinks und UI-Bildbriefings.
- **Pro/Im-Paket:** Upgrade-Grund, Kern-/Pro-Abgrenzung, Preis-/Plan-Karten. License Captain zeigt „ohne Aufpreis enthalten“, kein separater Kauf.
- **Preise/Vergleich:** zugängliche Tarifkarten mit Website-Limits, Jahrespreis, Supportumfang und klarer Planwahl.
- **Dokumentation/Support/FAQ:** ruhige Lesefläche, Inhaltsnavigation, Links zu Installation, Kompatibilität und Kontakt.
- **Lösung/Use Case:** branchenspezifischer Ablauf und die tatsächlich passenden Produkte.
- **Ratgeber:** Lesespalte, Breadcrumb, Inhaltsverzeichnis wenn sinnvoll, Autoren-/Datum nur mit validen Angaben und kontextueller Produktverweis.
- **Integrationen/Kompatibilität:** sachliche Tabellen, Statusangaben, Versionshinweise und Update-Datum.

### Komponenten-Hierarchie

1. Primäre Aktion pro Seite optisch am stärksten.
2. Sekundäre Aktion als ruhiger Link oder Outline-Button.
3. Überschriften führen Lesende durch das Thema, statt alle Inhalte in Karten einzuschließen.
4. Produktpreise, Limits und Kaufbedingungen werden direkt an der Tarifwahl erklärt.
5. Bilder unterstützen das Argument und erhalten Bildunterschrift oder Kontext.
6. Footer enthält Navigation und Pflichtseiten, aber keine konkurrierende CTA-Wand.

## 6. Responsive Verhalten

Breakpoints werden anhand des Inhalts festgelegt, nicht anhand eines bestimmten Gerätemodells. Erste Testbereiche: schmal ab 320–375 CSS-Pixel, Tablet ca. 768–1024, Desktop ab ca. 1200. Das Layout muss auch dazwischen stabil bleiben.

- Mobilansicht einspaltig; Hero-Text und Haupt-CTA vor dekorativer Illustration.
- Produktkarten und Tarifpläne stapeln sich. Zwei Spalten nur, wenn Text, Touch-Ziele und Umbruch komfortabel bleiben.
- Navigation als zugängliches Disclosure-Menü; keine Hover-Abhängigkeiten.
- Große Screenshots responsiv zuschneiden und skalieren; keine verkleinerten unleserlichen Adminoberflächen.
- Tabellen erhalten auf Mobilgeräten eine Kartenalternative oder eine klar beschriftete, tastaturbedienbare Scrollfläche.
- Kein horizontales Scrollen des gesamten Seiteninhalts.
- Sticky Elemente vermeiden, außer sie lösen einen klaren Navigationsbedarf; Footer, Cookie-Banner, Tastaturfokus und Formularfelder dürfen nicht überdeckt werden.
- Bilder und Fonts erst in der notwendigen Größe laden; unterhalb des sichtbaren Bereichs verzögert laden, ohne das LCP-Hero-Bild unnötig zu verzögern.

## 7. Interaktionen und Barrierefreiheit

Barrierearme Interaktion ist Teil des Theme-Systems. Das Website-Umsetzungskonzept setzt WCAG 2.2 AA als Qualitätsziel; die Komponentenabnahme muss echte Tastatur- und Screenreader-Prüfung einschließen.

- Semantische Header-, Nav-, Main- und Footer-Landmarks; Skip-Link vor der Navigation.
- Sichtbarer Fokus mit ausreichendem Kontrast auf allen interaktiven Elementen.
- Menü, Akkordeon, Tabs und Dialoge ohne Maus bedienbar; korrekte Zustandsansagen und Fokusverwaltung.
- Akkordeons nur dann einsetzen, wenn sie Inhalte sinnvoll gruppieren. Wesentliche Kaufdetails nicht verstecken.
- Formulare mit zugeordneten Labels, verständlichen Fehlern, Hilfetext und Erfolgsstatus.
- Linktexte beschreiben das Ziel; gleiche Links haben konsistente Namen.
- Animationen minimal halten; reduzierte Bewegung bei `prefers-reduced-motion` berücksichtigen.
- Fokus darf bei Sticky Header oder CTA nicht verdeckt sein.
- Kontrast für Text, Icons, Rahmen und Fokusindikatoren nach finaler Farbwahl prüfen.
- Touchziele ausreichend groß dimensionieren; Theme-Controls mit WordPress-konformen Interaktionsmustern bauen.
- Screenreader-, Tastatur- und Zoomprüfung dokumentieren. Automatische Checker ergänzen die manuelle Abnahme, ersetzen diese jedoch nicht.

## 8. Yoast, SEO und Theme-Verantwortung

Yoast bleibt für SEO-Metadaten und passende Integrationen zuständig. Das Theme stellt sauberes semantisches HTML, eine klare Überschriftenstruktur, interne Navigationsmöglichkeiten und bei Bedarf einen Breadcrumb-Ausgabepunkt bereit. Es erzeugt keine konkurrierenden Meta-Tags und keine zweite Sitemap-/Schema-Implementierung.

- SEO-Titel, Meta-Descriptions, Fokus-Keyphrases und Indexierungsentscheidungen aus den bestehenden Textentwürfen in Yoast einpflegen.
- Breadcrumbs nur einmal ausgeben und mit der Yoast-Konfiguration abstimmen.
- Strukturierte Daten nur für Inhalte einsetzen, die sichtbar und auf der Seite vorhanden sind; keine Review-Markups oder Produktdaten erfinden.
- Seiten-Templates erlauben eindeutige H1 und sinnvolle Dokumentstruktur.
- Theme bleibt leichtgewichtig und lädt keine unnötigen Skripte oder Iconfonts.
- 404-, Such- und Archivseiten enthalten brauchbare interne Links, statt SEO-Text ohne Nutzwert zu generieren.
- Weiterleitungen und Canonical-Einstellungen redaktionell/technisch verwalten; nicht im Theme fest verdrahten.

## 9. Performance, Sicherheit und Pflege

- Theme ohne Page-Builder-Zwang; Gutenberg-Blöcke/Patterns und globale Styles bevorzugen.
- Assets nur bei Bedarf laden; JS nur für Interaktionen, die HTML/CSS nicht bereits abdecken.
- JavaScript im Theme vermeiden, wenn WordPress-Core-Elemente oder native Elemente genügen.
- CSS in Komponenten-/Tokenebenen pflegen, keine breite Sammlung seitenweiser Overrides.
- Lokale Bildgrößen und WordPress-responsive Bildausgabe nutzen; Alt-Texte im Medienbestand pflegen.
- Keine Lizenz-, Checkout- oder Produktlogik im Theme implementieren; diese bleibt bei Plugins/Shop.
- Theme darf beim Wechsel nicht redaktionelle Inhalte verlieren. Keine Produktdaten nur als Theme-Option speichern.
- In aktuellen WordPress-Versionen und dem vorgesehenen PHP-/Browser-Ziel testen, welche im Projekt verbindlich festzulegen sind.

## 10. Umsetzungsschritte / To-do-Liste

### A. Vor dem Scaffold

- [ ] Repo-Inventar mit den bestehenden Textdateien und URLs abgleichen; Seitenentwürfe nicht neu schreiben.
- [ ] Vorhandenes Logo, Typografie und alle acht Kapitäns-JPEGs sichten; Nutzungsrechte, Auflösung und geeignete Posen erfassen.
- [ ] Farbpalette mit Kontrastmessung finalisieren; Produktakzente dokumentieren.
- [ ] Entscheidung festhalten: natives Block-Theme (Empfehlung) oder begründete klassische Theme-Struktur.
- [ ] Zielversionen von WordPress/PHP, Build-/Deployprozess und unterstützten Browsern vom Projekt festlegen.
- [ ] Release-Quelle für Preise, Checkout-, Download- und Support-URLs bestimmen.
- [ ] Theme-Dateiname, Textdomain und Repository-Ordner festlegen.

### B. Designsystem und Theme-Grundgerüst

- [ ] CSS-Variablen und `theme.json` für Farben, Typografie, Layoutbreiten, Abstände und UI-Zustände definieren.
- [ ] Editoransicht an Frontend-Stile angleichen.
- [ ] Header, Desktop-/Mobile-Menü und Footer als Template Parts erstellen.
- [ ] Globales Seitengerüst inklusive Skip-Link, Breadcrumb-Ausgabe und Hauptinhalt umsetzen.
- [ ] Basis-Templates für Startseite, Seite, Beitrag, Archiv, Suche und 404 erstellen.
- [ ] Komponenten-Patterns für Hero, CTA, Feature, Workflow, Screenshot, Preis, Vergleich, FAQ und Ressourcen erstellen.

### C. Inhaltsvorlagen aufsetzen

- [ ] Startseite und Produktübersicht aus den bestehenden Markdown-Texten übertragen.
- [ ] Wiederverwendbare Produktdetailvorlage auf Voucher Captain, Pass Captain, Affiliate Captain und License Captain anwenden.
- [ ] Unterseiten Features, Pro/Im-Paket und FAQ in einheitliche Templates überführen.
- [ ] Preis-/Vergleichsansicht mit zentralem Tarifinhalt und mobilen Alternativen einrichten.
- [ ] Dokumentation, Support, Kompatibilität, Integrationen, Bootsschulen-Lösung und Ratgeber-Templates übertragen.
- [ ] Alle Platzhalter im CMS als interne redaktionelle Aufgaben markieren; keine Platzhalterseiten öffentlich indexieren.

### D. Medien und Feinschliff

- [ ] Maskottchen je Einsatzort auswählen, passend zuschneiden und optimierte Bildvarianten exportieren.
- [ ] Produkt-Screenshots gemäß den Bildbriefings in `konzept-website.md` erstellen und Datenschutzprüfung durchführen.
- [ ] Alt-Texte und Bildunterschriften festlegen; dekorative Bilder als dekorativ behandeln.
- [ ] Mobile Darstellung, Preisvergleiche, Tabellen, Menüs, Formulare und FAQ bei relevanten Breiten prüfen.
- [ ] Visuelle Konsistenz zwischen Frontend und Block-Editor abnehmen.

### E. Qualitätsprüfung und Übergabe

- [ ] Tastaturbedienung, Fokus, Kontrast, Vergrößerung, Screenreader-Ausgabe und reduzierte Bewegung prüfen.
- [ ] Links, Navigationszustände, CTAs und Breadcrumbs validieren.
- [ ] Yoast-Breadcrumbs, Metadaten, Canonicals und Sitemap-Zuständigkeit gegen Theme-Ausgabe abgleichen.
- [ ] Performance und Bildgrößen prüfen; unnötige Assets und Skripte entfernen.
- [ ] Kompatibilität mit WooCommerce, Yoast SEO und den tatsächlich aktivierten Plugins prüfen; Shop-Funktionen nicht im Theme nachbauen.
- [ ] README mit Installation, Theme-Konfiguration, Block-Patterns, Design-Tokens und Erweiterungshinweisen anlegen.
- [ ] Vor Release offene Unternehmens-, Preis-, Support- und Checkout-Angaben vollständig verifizieren.

## 11. Abnahmekriterien

Das Theme ist bereit für die redaktionelle Befüllung, wenn:

1. Alle wichtigen Inhaltstypen aus dem Website-Konzept ohne individuelle Seitenprogrammierung dargestellt werden können.
2. WordPress-Editor und Frontend die gleichen Typografie-, Farb- und Layoutregeln verwenden.
3. Desktop- und Mobilnavigation sowie interaktive Komponenten mit Maus, Tastatur und Touch funktionieren.
4. Preispläne und Featurevergleiche auf schmalen Displays lesbar bleiben.
5. Das Maskottchen die Marke ergänzt, aber keine fehlenden Produkt-Screenshots oder Kundenbelege ersetzt.
6. Yoast keine doppelte Meta-, Breadcrumb- oder Schema-Ausgabe erhält.
7. Die Inhalte beim Themewechsel erhalten bleiben und keine Kauf-/Lizenzlogik im Theme steckt.
8. Platzhalter, defekte Links und ungeprüfte Referenzen vor Livegang entfernt oder ersetzt sind.

## 12. Noch nicht festgelegte Designentscheidungen

- Finale Markenfarben, Logo-/Wortmarkenvariante und Schriftwahl.
- Akzentfarben je Produkt und konkrete Iconfamilie.
- Block-Theme oder klassische Theme-Implementierung nach Abgleich des WordPress-Stacks.
- Finale Live-URLs, CTA-Ziele, Download-/Checkout-/Supportablauf.
- Finale Produkt-Screenshots und freigegebene Mascot-Exporte.
- Verbindliche Browser-/WordPress-/PHP-Zielmatrix.

Diese Entscheidungen blockieren nicht die Strukturplanung. Sie werden während Designsystem und technischem Scaffold auf Grundlage des realen Logos, Stacks und Shopablaufs abgeschlossen.
