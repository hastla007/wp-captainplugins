# Website-Konzept für die WordPress-Plugins

**Arbeitsstand:** 15. November 2026  
**Ziel:** Firmenkunden, Agenturen, Veranstalter, WooCommerce-Shops und Betreiber eigener Partnerprogramme  
**Primärmarkt:** DACH, deutschsprachige Website zuerst; englische Fassung in einer zweiten Ausbaustufe

**Arbeitsannahmen für die Website-Texte:** Die Plugins und Captain-Pro-Angebote werden als verkaufsfähig behandelt. Alle Funktionen, die in den aktuellen Produktplänen und Entwicklungsarbeiten enthalten sind, werden als Bestandteil des finalen Releases vor Verkaufsstart angenommen und in der Marketingcopy als Produktumfang beschrieben. Die Preisangaben aus den jeweiligen Produktkonzepten und `docs/TARIFE.md` gelten vorerst als Grundlage; die Website führt sie zentral in `texte/homepage/preise.md`. Für Workflow Captain gelten die V1-Entscheidungen aus dem verlinkten Plugin-Konzept, während noch nicht ausgeführte Kompatibilitätstests ausdrücklich als Release-Aufgabe markiert bleiben. **License Captain besteht aus Server und Client.** Unsere Pro-Add-ons werden darüber lizenziert (Client unsichtbar im Pro-Plugin); zusätzlich wird License Captain als eigenes Produkt an Plugin-Hersteller verkauft. Details: Abschnitt „Lizenzmodell“.

## 1. Kurzempfehlung

Die Website sollte als gemeinsame Produktfamilie mit einer klaren Produktübersicht aufgebaut werden. Die sechs kostenlosen Kern-Plugins lösen unterschiedliche Geschäftsaufgaben. License Captain wird als eigenes Produkt (Server und Client) für Anbieter eigener WordPress-Produkte präsentiert:

- **Voucher Captain** – Gutscheine, Geschenkkarten und Guthaben in WooCommerce verkaufen und verwalten.
- **Pass Captain** – Veranstaltungen, Tickets, Reservierungen und Einlass in WordPress organisieren.
- **Affiliate Captain** – ein eigenes Partnerprogramm mit nachvollziehbaren Provisionen und Auszahlungen betreiben.
- **Form Captain** – Formulare, Einsendungen und sichere Übergaben in WordPress verwalten.
- **Review Captain** – lokale Kundenstimmen und externe Bewertungen mit Quellenbezug verwalten.
- **Workflow Captain** – WordPress-, WooCommerce- und Captain-Suite-Abläufe visuell automatisieren.
- **License Captain** – Lizenzverkauf, Aktivierungen und Updates für Anbieter von WordPress-Plugins steuern.

**Captain Pro** ist die gemeinsame Produktlinie der sechs separaten kostenpflichtigen Premium-Erweiterungen zu Voucher, Pass, Affiliate, Form, Review und Workflow Captain. Die Kern-Plugins bleiben kostenlos. Für die Textfassung gelten die Produkte als kaufbar und die in den neueren Pro-Umfangsplänen beschriebenen Funktionen als Verkaufsumfang. License Captain wird separat verkauft und ist nicht Teil eines Captain-Pro-Plans.

### Vorgeschlagener Markenaufbau

**Hauptmarke / Produktfamilie**  
Eine gemeinsame Unternehmens- bzw. Produktfamilien-Startseite mit Navigation zu sechs kostenlosen Kern-Plugins sowie zu License Captain.

**Kostenlose Kern-Plugins**  
Voucher Captain, Pass Captain, Affiliate Captain, Form Captain, Review Captain und Workflow Captain erhalten je eine eigenständige Produktseite mit Anwendungsfällen, Features, Pro-Seite, FAQ, Voraussetzungen und CTA zum kostenlosen Kern oder zur passenden Pro-Version.

**Pro-Linie**  
Eine Seite „Captain Pro“ erklärt die Erweiterungslogik und führt zu sechs separaten Pro-Angeboten mit Preisen, Website-Limits und Funktionsübersichten.

**License Captain**  
Ein eigenes Produkt für WordPress-Plugin-Hersteller und Softwareanbieter, bestehend aus Server und Client: Lizenzverkauf, Website-Aktivierungen, Verlängerungen, Berechtigungen und Plugin-Updates. Der Server läuft im WooCommerce-Shop des Herstellers, der Client wird in dessen Plugins eingebunden und mit ihnen ausgeliefert.

### Lizenzmodell: License Captain (verbindlich)

- **License Captain besteht aus Server und Client.** Der Server ist ein WordPress-Plugin für den WooCommerce-Shop (Lizenzverkauf, Aktivierungen, Laufzeiten, Berechtigungen, Releases). Der Client wird in jedes zu lizenzierende Plugin eingebunden und übernimmt Lizenzaktivierung, Statusprüfung und Updateabruf über die signierte API.
- **Unsere Captain-Pro-Add-ons werden über License Captain lizenziert.** Der Client steckt in jedem Pro-Add-on, der Server läuft in unserem Shop. Pro-Kunden geben ihren Lizenzschlüssel im Pro-Plugin ein und müssen von License Captain nichts wissen. Pro-, Preis-, FAQ- und Installationsseiten erwähnen License Captain deshalb nicht – weder als „inklusive“, „kostenlos“ noch als „nicht enthalten“.
- **License Captain ist zusätzlich ein eigenes Produkt.** Plugin-Hersteller kaufen Server und Client, um ihre eigenen Plugins zu lizenzieren. Es hat eigene Produkt-, Feature-, Preis- und FAQ-Seiten.


## 2. Produktanalyse und Positionierung

### Voucher Captain

**Zielkunden:** WooCommerce-Shops, Händler mit Geschenkkarten, Dienstleister, Veranstalter mit Wertgutscheinen, Filialbetriebe und Unternehmen mit personalisierten Kundengeschenken.

**Kernnutzen:** Gutscheinverkauf, individuelle Gestaltung, geplante Zustellung, Einlösung und Guthabenverwaltung in einem WordPress-/WooCommerce-Workflow.

**Kernfunktionen im finalen Verkaufsumfang:** einfache und variable Gutscheinprodukte; feste Werte, Produktpreis oder Wunschbetrag; Rabattcodes und Geschenkkarten mit Restguthaben; Ablaufregeln; Empfängerfelder und eigene Produktfelder; sofortige oder terminierte Zustellung; PDF-Designer mit Vorlagen, QR-/Barcode-Elementen und Vorschau; Kunden-Downloads; Verwaltung mit Verlauf und CSV; Codeimport; HPOS-, Checkout-Blocks-, Mehrsprachigkeits- und Mehrwährungs-Integrationen. Dazu kommen Gutscheinaktionen und Bonusgutscheine, Empfehlungsprogramme, Geschenkkarten-Aufladung, Auswertungen sowie die Pass-Captain-Anbindung für Gutscheinzahlung, Ticketgutscheine und gemeinsamen Scanner.

**Wichtige Abgrenzung:** Die Eventverwaltung, Ticketkontingente und der Veranstaltungseinlass gehören zu Pass Captain. Voucher Captain ergänzt den Ticketverkauf durch Gutscheinzahlung, Ticketgutscheine und den gemeinsamen Scanner. Steuerliche Behandlung von Gutscheinarten muss fachlich geprüft werden; keine pauschalen Steuerrechtsversprechen veröffentlichen.

**Voucher Captain Pro:** Firmenbestellungen mit CSV-Empfängerliste, Apple-/Google-Wallet-Pässe und SMS-Zustellung. Pro macht Gutscheine für Filialunternehmen, größere Teams und Marken mit digitalen Wallet- und kanalübergreifenden Versandprozessen besonders leistungsfähig. Teamrollen sind kein exklusives Pro-Merkmal.

**Positionierungssatz:** „Verkaufen Sie personalisierte Gutscheine und Geschenkkarten direkt in WooCommerce – mit passender Gestaltung, geplanter Zustellung und transparenter Guthabenverwaltung.“

### Pass Captain

**Zielkunden:** Veranstalter, Seminar- und Kursanbieter, Vereine, Kultur- und Freizeiteinrichtungen, Eventagenturen und Organisationen mit eigenem WordPress-Auftritt.

**Kernnutzen:** Events, Bestellungen, Tickets und Einlass im eigenen WordPress verwalten; WooCommerce kann optional den Verkauf abwickeln.

**Kernfunktionen im finalen Verkaufsumfang:** Einzeltermine und Serien mit Preisstufen; Shortcodes, Gutenberg-Blöcke, Kalender und iCal-Feed; zeitlich begrenzte Reservierungen; Zahlungen über Stripe, PayPal oder Mollie sowie optional WooCommerce; QR-/PDF-Tickets und Apple-/Google-Wallet; Sitzpläne, Teilnehmerfelder und Vor-Ort-Kasse; automatische Preisregeln, Kampagnencodes und Käuferlimits; Event- und Service-Wartelisten; Buchungen für Kurse, Verleih und Bootsschulen mit Pufferzeiten, Umbuchung, Storno, No-Show und Anbieterbestätigung; Offline-Scanner; E-Mail- und SMS-Erinnerungen; Veranstalter-API; Voucher-Captain-Anbindung. Für den professionellen Betrieb kommen Audit-Logs, rollenbezogene Datenansichten, Step-up-2FA, zeitlich begrenzter Supportzugriff, Multisite-Übersicht, Systemdiagnose, sichere Webhooks und WP-CLI hinzu.

**Wichtige Abgrenzung:** WooCommerce ist optional. Steuerprofile unterstützen die Konfiguration und Dokumentation länderspezifischer Regeln; Steuersätze und steuerrechtliche Beurteilung kommen vom Betreiber bzw. dessen Beratung. Die Mobile-API ermöglicht kompatible Scanner-Apps; eine native Pass-Captain-App wird nicht versprochen.

**Pass Captain Pro:** E-Rechnungen nach XRechnung/ZUGFeRD, Kartenterminal-Unterstützung für Stripe Terminal und SumUp sowie White-Label-Darstellung. Ergänzend umfasst der Pro-Ausbau einen virtuellen Warteraum und schreibende API-Zugriffe mit konfigurierbaren Scopes. Die Basisfunktionen, Zahlungsanbieter und allgemeinen Integrationen stehen bereits im Kern zur Verfügung.

**Positionierungssatz:** „Planen Sie Veranstaltungen, verwalten Sie Tickets und organisieren Sie den Einlass in Ihrer eigenen WordPress-Umgebung.“

### Affiliate Captain

**Zielkunden:** WooCommerce-Händler, digitale Anbieter, Kurs- und Aboanbieter sowie Unternehmen, die ein eigenes Empfehlungsprogramm mit Partnern, Creators oder Vertriebspartnern betreiben möchten.

**Kernnutzen:** Partnerprogramm, Zuordnung von Verkäufen, Provisionsabrechnung und Auszahlungen an einer Stelle verwalten.

**Kernfunktionen im finalen Verkaufsumfang:** Partnerbewerbung mit Double-Opt-in und Freigabe; Partnergruppen; Partnercodes und Referral-Links; consentberücksichtigende Attribution; Provisionsregeln je Partner, Gruppe, Produkt, Kategorie, Tag oder SKU; Haltefristen; positionsgenaue Erstattungskorrekturen; Auszahlungsläufe mit SEPA-XML; druckbare Gutschriften mit Steuerstatus-Snapshot; Partnerportal ohne Kundendaten; Kampagnen, QR-Codes, Werbemittel, Betrugsprüfungen, Berichte, Im-/Export und versionierter Integrationsvertrag. Das Plugin funktioniert eigenständig; WooCommerce ist optional.

**Wichtige Abgrenzung:** Cookie-/Consent-, Steuer- und Belegpflichten benötigen fachliche Prüfung. Die Website kann Funktionen beschreiben, aber keine rechtliche Konformität garantieren. Das Kern-Plugin bietet Auszahlungsläufe und SEPA-Export; automatische PayPal-Auszahlungen sind als Pro-Funktion dokumentiert.

**Affiliate Captain Pro:** signierte Webhooks für automatisierte Abläufe, erweiterte REST-API für individuelle Anbindungen, White-Label-Partnerportal für die eigene Marke und automatische PayPal-Auszahlungen.

**Positionierungssatz:** „Bauen Sie Ihr eigenes Partnerprogramm auf – mit klarer Zuordnung, nachvollziehbaren Provisionen und strukturierten Auszahlungen.“

### Workflow Captain

**Zielkunden:** WooCommerce-Shops, Unternehmen mit mehreren Captain-Plugins, Agenturen und technische Betreiber, die wiederkehrende Abläufe dokumentieren und ohne externe Automations-Cloud koordinieren möchten.

**Kernnutzen:** Ereignisse aus WordPress, WooCommerce und der Captain Suite visuell mit Bedingungen, Zeitplanung und sicheren Aktionen verbinden. Ausführung, Fehler und Wiederholungen bleiben auf der eigenen WordPress-Website nachvollziehbar.

**Workflow Captain Free:** unbegrenzte Workflows und Ausführungen ohne Task-Credits; WP-Core- und optionale WooCommerce-Provider; mehrere Trigger und Aktionen; einfache Bedingungen; Basis-Zeitplanung; Dry Run und 30-Tage-Logs; Entwickler-Registry. WooCommerce ist optional.

**Workflow Captain Pro:** Provider für alle Captain-Plugins; versionierte SDK-/Projekt-Connectoren; signierte Webhooks; Event-Korrelation, erweiterte Bedingungsgruppen, If/Else und Freigaben; geplante Queue-Aktionen mit Refund-/Storno-/Opt-out-Abbruch; Retry/Backoff, idempotentes Replay, Dead-letter, Audit, Rezeptvorlagen sowie schema-geprüfter Import/Export. Alle Funktionen sind in jedem Plan enthalten; keine Task-Credits oder monatlichen Run-Limits.

**Preise und Voraussetzungen:** Single 129 €/Jahr für 1 Live-Website, Business 229 €/Jahr für 5, Agency 399 €/Jahr für 25. Standard-Support für Single/Business, Priority für Agency. Produktkonzept: WordPress 6.8+, PHP 8.3+, WooCommerce optional ab 8.0. Diese Angaben sind festgelegte Konzeptwerte; getestete Kombinationen sowie Provider-Mindestversionen werden vor Release verifiziert.

**Sicherheits- und Scopegrenzen:** Fachplugins bleiben Eigentümer ihrer Objekte und Geschäftslogik. Workflow Captain verwendet öffentliche Providerverträge; kein direkter Tabellenzugriff, freier PHP-/SQL-Code oder beliebige Webhook-Ziele. Keine Cloud-Plattform, Taskabrechnung, native App-Bibliothek oder autonome KI-Workflows in v1. Projektbezogene BoatingSchool-/LearnBoating-Verbindungen sind separate Connector-Arbeiten und werden nicht als Standardintegration verkauft.

**Positionierungssatz:** „Verbinden Sie WordPress-, WooCommerce- und Captain-Suite-Abläufe visuell – lokal, versioniert und mit nachvollziehbaren Run-Protokollen.“

### License Captain

**Zielkunden:** WordPress-Plugin-Anbieter und Softwarefirmen, die kostenpflichtige Plugins mit Lizenzen und Updates vertreiben.

**Kernnutzen:** WooCommerce als Lizenzshop nutzen und Produktlizenzen über Aktivierungen, Laufzeiten, Verlängerungen, Berechtigungen und Updates verwalten.

**Funktionen im finalen Verkaufsumfang:** WooCommerce-Produkte als Lizenzprodukte konfigurieren; Lizenz je gekaufter Einheit; Aktivierung und Deaktivierung von Live-, Staging- und Entwicklungsinstallationen; Status- und Auditverlauf; manuelle und opt-in-gestützte automatische Verlängerung mit Stripe; Kunden-Lizenzbereich per Shortcode oder Block; signierte REST-API; Entitlements; Adminwerkzeuge; Releaseverwaltung und Updatebereitstellung; Datenschutzexport/-löschung. Produkt-Changelogs können gezielt per Shortcode oder Gutenberg-Block eingebunden werden.

**Angebot:** License Captain besteht aus Server und Client. Der Server verbindet WooCommerce-Lizenzverkauf, Aktivierungsverwaltung, Verlängerungen und Updateauslieferung; der Client wird in die Plugins des Herstellers eingebunden. Automatische Verlängerungen laufen über Stripe; manuelle Verlängerungen können mit den verfügbaren Shop-Zahlungsarten bezahlt werden. Preise und Pläne werden separat aus dem License-Captain-Shopkatalog übernommen.

**Positionierungssatz:** „Verwalten Sie Lizenzen und Plugin-Updates über Ihren WooCommerce-Shop – mit Aktivierungsübersicht, Laufzeiten und einer API für Ihre Produkt-Plugins.“

### Captain Pro

**Rolle im Portfolio:** Übergreifende Premium-Linie für Voucher, Pass, Affiliate, Form, Review und Workflow Captain. Jedes Add-on wird als eigenes Produkt mit eigener Seite, Lizenz und klarer Kompatibilität geführt.

**Für diese Textfassung:** Captain Pro wird als kaufbares Angebot für den vollständigen finalen Funktionsumfang dargestellt. Entwicklungsarbeiten aus den aktuellen Produktplänen und Feature-Branches werden als Bestandteil der Verkaufsfassung eingeplant. Website-Copy, Produktvergleich und Pro-Tabellen beschreiben daher den geplanten Release-Umfang ohne Entwicklungsstatus-Hinweise.

## 3. Zielgruppen, Kaufmotive und Website-Stimme

| Zielgruppe | Kaufmotiv | Geeignete Belege | CTA |
|---|---|---|---|
| WooCommerce-Shopbetreiber | Gutscheine und Guthaben einfacher verkaufen und abwickeln | PDF-Vorschau, Ablaufbeispiel, Mein-Konto-Ansicht, Checkout-Kompatibilität | „Voucher Captain ansehen“ / „Kostenlos starten“ |
| Veranstalter und Kursanbieter | Termine, Buchungen, Tickets und Einlass selbst organisieren | Eventliste, Ticketfluss, Scanner-Demo, Bericht | „Pass Captain entdecken“ |
| Händler mit Partnern | Partnerverkäufe zuordnen und Abrechnung kontrollieren | Provisionsregel-Beispiel, Refund-Korrektur, Partnerportal, Auszahlungslauf | „Partnerprogramm aufbauen“ |
| Plugin-Hersteller | Lizenzen und Updates kontrolliert verkaufen | Ablaufdiagramm, Kundenansicht, API-Dokumentation, Sicherheits-/Betriebshinweise | „Lizenzplattform kennenlernen“ |
| Agenturen und Entwickler | Mehrere Geschäftsprozesse mit WordPress-Plugins umsetzen | Integrationsverträge, Kompatibilitätsmatrix, Installations-/Migrationshinweise | „Technische Details ansehen“ |

**Ton:** professionell, konkret und geschäftsorientiert. Nutzen zuerst nennen, dann Funktion und Beleg. DACH-Schreibweise, klare Sie-Ansprache auf der Website (Plugin-UI kann abweichen). Keine Superlative, unbelegte Zeitersparnis, Rechtskonformitäts- oder Umsatzzusagen.

## 4. Sitemap und Seitenkonzept

### A. Gemeinsame Produktfamilie

#### 1) Startseite – `/`
**Ziel:** In wenigen Sekunden erklären, für wen die Produktfamilie ist, und Besucher zum passenden Plugin oder Captain-Pro-Plan leiten.

**SEO-Titel:** WordPress-Plugins für Gutscheine, Events und Partnerprogramme | Captain  
**Meta-Description:** Entdecken Sie WordPress- und WooCommerce-Plugins für Gutscheine, Ticketverwaltung, Affiliate-Programme und Lizenzmanagement – passend für Shops und Unternehmen.

**Inhalt / Reihenfolge:**
1. Hero: „Geschäftsprozesse in WordPress. Klar organisiert.“ Unterzeile: „Plugins für Gutscheine, Events, Partnerprogramme und den Verkauf eigener WordPress-Software.“ CTA: „Produkte entdecken“ und sekundär „Welches Plugin passt?“
2. Sieben Produktkarten für die sechs kostenlosen Kern-Plugins und License Captain (Server und Client); jede Karte zeigt Problem, Kernnutzen, Angebotsstatus und passenden CTA.
3. Use-case-Navigation: „Gutscheine verkaufen“, „Events verwalten“, „Partner gewinnen“, „Formulare annehmen“, „Kundenbewertungen verwalten“, „Abläufe automatisieren“ und „WordPress-Plugins lizenzieren“.
4. Produktprinzipien: eigene WordPress-Umgebung, WooCommerce-Integration wo passend, dokumentierte Schnittstellen, klare Datenflüsse.
5. Kostenlose Kern-Plugins, kostenpflichtige Captain-Pro-Erweiterungen und License Captain als eigenes Produkt für Plugin-Hersteller verständlich erklären.
6. Vertrauensbereich mit Platzhaltern für Screenshots, Demo und Kundenbeispiele; Kompatibilität und Supportdaten sachlich ausweisen.
7. FAQ und CTA.

#### 2) Produktübersicht – `/produkte/`
**Ziel:** Auswahlhilfe nach Geschäftsaufgabe, keine bloße Wiederholung der Startseite.

**SEO-Titel:** WordPress-Plugins für Unternehmen: Gutscheine, Events & Affiliate  
**Inhalt:** Vergleichsmatrix nach Einsatz, WooCommerce-Abhängigkeit, zentralen Funktionen, Zielgruppe und Verfügbarkeit. Jede Zeile verlinkt auf eine Produktseite. Hinweis: Captain Pro ist eine Erweiterungslinie, License Captain adressiert Plugin-Anbieter.

#### 3) Captain Pro – `/captain-pro/`
**Ziel:** Pro-Linie, Preispläne und Verhältnis zum kostenlosen Kern erklären.

**SEO-Titel:** Captain Pro – WordPress-Plugins mit Pro-Funktionen erweitern  
**Meta-Description:** Erweitern Sie Voucher, Pass, Affiliate, Form, Review und Workflow Captain mit Pro-Funktionen. Vergleichen Sie Jahrespläne für 1, 5 oder 25 Websites.

**Inhalt:** Nutzen des kostenlosen Kern-Plugins erklären; sechs Pro-Karten mit Funktionen, Jahrespreisen und Live-Website-Limits; License Captain auf Pro-Seiten nicht erwähnen (der Client ist unsichtbar im Pro-Add-on enthalten); FAQ „Was bleibt kostenlos?“, „Brauche ich WooCommerce?“, „Wie viele Websites?“; CTA „Plan auswählen“ und „Kostenlosen Kern laden“.

#### 4) Über das Projekt – `/ueber/`
**Ziel:** Urheberschaft, Produktprinzipien und Entwicklungsphilosophie glaubwürdig darstellen.

**Inhalt:** Wer hinter den Plugins steht (nur verifizierte Angaben einsetzen); Produktfamilie und technische Leitlinien; öffentliche Roadmaps bzw. Changelogs; Kontaktweg; keine erfundenen Kundenlogos oder Referenzen.

#### 5) Support & Dokumentation – `/support/`, `/dokumentation/`
**Inhalt:** Installationsanleitungen, Voraussetzungen, Kompatibilitätsmatrix, FAQ, bekannte Einschränkungen, Changelog, Supportweg und klare Angaben zu Reaktionszeiten (erst nach interner Festlegung). Produktdokumentation sollte auch ohne Kauf erreichbar sein.

#### 6) Preise – `/preise/`
**Ziel:** Pro-Tarife direkt vergleichen und passende Lizenz auswählen. Für den Text gelten die folgenden, vom Auftraggeber vorläufig übernommenen Jahrespreise:

| Produkt | 1 Live-Website | 5 Live-Websites | 25 Live-Websites |
|---|---:|---:|---:|
| Voucher Captain Pro | 129 € / Jahr | 229 € / Jahr | 399 € / Jahr |
| Pass Captain Pro | 169 € / Jahr | 299 € / Jahr | 549 € / Jahr |
| Affiliate Captain Pro | 229 € / Jahr | 399 € / Jahr | 699 € / Jahr |
| Form Captain Pro | 49 € / Jahr | 99 € / Jahr | 199 € / Jahr |
| Workflow Captain Pro | 129 € / Jahr | 229 € / Jahr | 399 € / Jahr |
| Review Captain Pro | Preis laut aktuellem Shopkatalog | Preis laut aktuellem Shopkatalog | Preis laut aktuellem Shopkatalog |

Alle Premiumfunktionen des jeweiligen Add-ons sind in jedem Tarif enthalten; die Stufen unterscheiden sich nach Website-Anzahl. Standard-Support ist für Single und Business vorgesehen, Priority für Agency. License Captain wird separat verkauft; eigene Preise und Pläne stehen auf einer separaten Produktseite und werden mit dem License-Captain-Shopkatalog abgeglichen. Preisangaben werden vor dem Livegang mit der WooCommerce-Preisdarstellung (Netto/Brutto), Verlängerung, Widerruf und tatsächlichem Shopkatalog abgeglichen.

### B. Produktseiten – Seitenvorlagen und Inhalte

Jede Produktfamilie bekommt eine Übersichtsseite und klar auffindbare Unterseiten für **Features**, **Pro-Version** und **FAQ**. Die Navigation und Breadcrumbs sollen zwischen Übersicht und Unterseiten verlinken. Die Beispieltexte unten sind Startcopy, noch kein vollständiger finaler Launchtext.

#### Verbindliche Unterseiten je Produkt

| Produkt | Übersicht | Features | Pro-/Paketseite | FAQ |
|---|---|---|---|---|
| Voucher Captain | `/voucher-captain/` | `/voucher-captain/features/` | `/voucher-captain/pro/` | `/voucher-captain/faq/` |
| Pass Captain | `/pass-captain/` | `/pass-captain/features/` | `/pass-captain/pro/` | `/pass-captain/faq/` |
| Affiliate Captain | `/affiliate-captain/` | `/affiliate-captain/features/` | `/affiliate-captain/pro/` | `/affiliate-captain/faq/` |
| Form Captain | `/form-captain/` | `/form-captain/features/` | `/form-captain/pro/` | `/form-captain/faq/` |
| Review Captain | `/review-captain/` | `/review-captain/features/` | `/review-captain/pro/` | `/review-captain/faq/` |
| Workflow Captain | `/workflow-captain/` | `/workflow-captain/features/` | `/workflow-captain/pro/` | `/workflow-captain/faq/` |
| License Captain | `/license-captain/` | `/license-captain/features/` | `/license-captain/preise/` | `/license-captain/faq/` |

**Inhalte der Unterseiten:**

- **Features:** Funktionsgruppen mit konkretem Nutzen, Screenshots oder kurzen Abläufen, Voraussetzungen und Grenzen. Hauptfunktionen auf der Übersichtsseite anreißen und zur vollständigen Feature-Seite verlinken.
- **Pro-/Preisseite:** Bei Voucher, Pass, Affiliate, Form, Review und Workflow Captain die enthaltenen Zusatzfunktionen gegenüber dem kostenlosen Kern nennen und den passenden Single-, Business- und Agency-Plan darstellen. Für License Captain eine eigenständige Seite mit Preisen/Plänen aus dem Shopkatalog vorsehen (Server und Client). Auf Pro-Seiten License Captain nicht erwähnen.
- **FAQ:** Je Produkt eigene, sichtbare Antworten zu Installation, WooCommerce-Abhängigkeit, Kompatibilität, Daten, Updates, Lizenzierung und Support. Fragen auf den FAQ-Seiten und passende Kurz-FAQs auf den Produktseiten dürfen sich ergänzen.


#### 7) Voucher Captain – `/voucher-captain/`
**SEO-Titel:** WooCommerce-Gutscheine & Geschenkkarten mit Voucher Captain  
**Primärkeyword:** WooCommerce Gutschein Plugin  
**Weitere Begriffe:** Geschenkkarten WooCommerce, PDF-Gutschein WordPress, Gutschein Restguthaben, Gutschein automatisch versenden.

**Hero-Entwurf:** „Gutscheine verkaufen, die zu Ihrer Marke passen.“  
„Erstellen Sie in WooCommerce personalisierte Gutscheine und Geschenkkarten, steuern Sie Wert und Zustellung und behalten Sie Einlösungen und Restguthaben im Blick.“  
CTA: „Kostenlos herunterladen“ / sekundär „Funktionen ansehen“.

**Abschnitte:**
1. Herausforderung: Standard-Gutscheine passen oft nicht zu Sortiment, Empfängerkommunikation und Zustellung.
2. Produktfluss in vier Schritten: Produkt konfigurieren → Kunde personalisiert → PDF/E-Mail zustellen → einlösen und Guthaben verfolgen.
3. Highlights: Wunschbetrag; Empfängername/Nachricht/Termin; PDF-Designer mit QR und Barcode; Restguthaben; Gutscheinstatus und Adminverlauf.
4. Gutscheinregeln: Produktpreis, fester oder kundenseitig bestimmter Wert; Rabatt oder Guthaben; Mindest-/Höchstwert, Ablaufdatum, Produkt-/Kategorieeinschränkungen und erlaubte Empfängeradressen.
5. Personalisierung und Zustellung: flexible Empfänger- und Zusatzfelder; Versand sofort, nach Frist oder zu einem gewählten Datum; E-Mail an Käufer, Empfänger oder beide; eigene Vorlagen und signierte Gast-Downloadlinks.
6. Gestaltung und Verwaltung: mehrere PDF-Vorlagen und Formate; Drag-and-drop-Designer; QR-/Barcode; Kundenbereich; erneuter Versand; Status-/Änderungsverlauf; Korrekturen und CSV-/XLS-/XLSX-/ODS-Codeimport.
7. Shop-Kompatibilität: WooCommerce, HPOS, Blocks-Checkout, WooCommerce Subscriptions, WPML/WCML und unterstützte Mehrwährungsdienste; konkrete Versionsmatrix ergänzen.
8. Demo-/Screenshot-Galerie mit Platzhaltern: Produkteditor, Gutschein-PDF, Kundenkonto, Einlöseseite.
9. Anwendungsfälle: Einzelhandel, Geschenkkarten, Kurse/Services, Kundenaktionen.
10. Integrationen: Pass Captain ergänzt Gutscheinzahlung im Ticketcheckout, Ticketgutscheine und einen gemeinsamen Scanner.
11. Free-/Pro-Vergleich: Der kostenlose Kern umfasst Gutscheinverkauf, PDF, Personalisierung, Guthaben, Einlösung, Aktionen und Bonusgutscheine, Empfehlungsfunktionen, Geschenkkarten-Aufladung, Auswertungen sowie die Pass-Captain-Grundintegration. Voucher Captain Pro ergänzt Firmenbestellungen mit CSV-Empfängerliste, Apple-/Google-Wallet-Pässe und SMS-Zustellung.
12. FAQ: variable Produkte, Wunschwert, Teilnutzung, Versanddatum, Gastbestellungen, Import.
13. CTA zum kostenlosen Kern-Plugin und zum passenden Captain-Pro-Tarif; Platzhalter für spätere Screenshots und Demo.

#### 8) Pass Captain – `/pass-captain/`
**SEO-Titel:** WordPress Event- und Ticket-Plugin mit Einlassscanner | Pass Captain  
**Primärkeyword:** WordPress Ticket Plugin  
**Weitere Begriffe:** Eventmanagement WordPress, Tickets verkaufen WooCommerce, QR-Code Einlassscanner, Veranstaltungstickets verwalten.

**Hero-Entwurf:** „Events und Einlass direkt in WordPress verwalten.“  
„Organisieren Sie Termine, Tickets, Reservierungen und Einlass in Ihrer eigenen WordPress-Umgebung. WooCommerce lässt sich für den Verkauf optional anbinden.“  
CTA: „Pass Captain entdecken“.

**Abschnitte:**
1. Zielbild: vom veröffentlichten Termin bis zum geprüften Ticket.
2. Eventverwaltung und Veröffentlichung: Einzel- und Serientermine, eigene Preisstufen, Gutenberg-Blöcke, Shortcodes, Kalender und iCal-Abos.
3. Ticketverkauf und Checkout: zeitlich begrenzte Reservierungen, kostenlose und bezahlte Bestellungen, Stripe/PayPal/Mollie oder optional WooCommerce; Frühbucher-, Last-minute-, Nachfrage- und Zeitfensterpreise; Rabattregeln und Käuferlimits.
4. Tickets und Käuferportal: sichere Zufallscodes, QR, PDF sowie Apple-/Google-Wallet; Sitzplatzwahl; Teilnehmer- und Einwilligungsfelder; Weitergabe, erneuter Versand, Rechnungsdaten und Bestellübersicht.
5. Einlass und Team: Webscanner und installierbarer Offline-Scanner, Mobile-API, event- und terminbezogene Teamzuweisung, Tages-/Bereichsregeln, Check-out und Wiedereinlass.
6. Servicebuchungen und Wartelisten: Ressourcen, Zeitfenster, Dauer, Puffer, Verfügbarkeiten, Umbuchung, Storno, No-Show, Partnerbestätigung, automatische Nachrückangebote und Servicepässe.
7. Abrechnung und Veranstalter: Rechnungen und Gutschriften, Erstattung mit optionalem Vier-Augen-Prinzip und 2FA, Regeln für mehrere Verkäufer im Warenkorb sowie Abrechnungen je Verkäufer.
8. Kommunikation, Integrationen und Betrieb: E-Mail/SMS-Erinnerungen, signierte Webhooks, Veranstalter-API, Affiliate-Captain-Verbindung, Voucher-Captain-Zahlung und Ticketgutscheine; Audit-Logs, rollenbezogene Datenansichten, verschlüsselte Secrets, Diagnose, WP-CLI und Multisite-Übersicht.
9. Einsatzbeispiele: Seminare, Vereine, Kultur/Freizeit, Bootsschulen, Kurse und Verleih. Die B2B-Bestellung von Zugangscodes für die Bootsschul-Plattform wird als konkreter Anwendungsfall beschrieben.
10. Kompatibilität und Steuerprofile: WooCommerce bleibt optional; Länder- und Steuerklassenprofile lassen sich konfigurieren, die Steuersätze pflegt der Shopbetreiber.
11. Demo-Flow als Platzhalter, Screenshotslots, Voraussetzungen und FAQ.
12. Pro-Upgrade mit E-Rechnung, Kartenterminal, White Label, Warteraum, schreibender API und Preisplan.

#### 9) Affiliate Captain – `/affiliate-captain/`
**SEO-Titel:** Affiliate-Plugin für WordPress und WooCommerce | Affiliate Captain  
**Primärkeyword:** Affiliate Plugin WordPress  
**Weitere Begriffe:** WooCommerce Partnerprogramm, Affiliate Provisionen verwalten, Partnerprogramm Plugin, SEPA Affiliate Auszahlung.

**Hero-Entwurf:** „Ihr Partnerprogramm. Ihre Regeln. Ihre Daten.“  
„Gewinnen Sie Partner, ordnen Sie Verkäufe nachvollziehbar zu und steuern Sie Provisionen, Rückerstattungen und Auszahlungsläufe über WordPress.“  
CTA: „Affiliate Captain kennenlernen“.

**Abschnitte:**
1. Partnerprogramm ohne Blackbox: Ablauf Bewerbung → Empfehlung → Verkauf → Provision → Korrektur → Auszahlung.
2. Partner-Onboarding und Portal: Bewerbungen, Double-Opt-in, Freigabe, Gruppen, eindeutige Referral-Links und Partnercodes.
3. Kampagnen und Werbemittel: QR-Codes, Banner/Assets und Kampagnenlinks zentral bereitstellen.
4. Flexible Attribution und Regeln: Zuordnung mit Consent-Berücksichtigung; Provisionen je Partner, Gruppe, Produkt, Kategorie, Tag oder SKU; Haltefristen und Betrugsprüfungen.
5. Nachvollziehbare Abrechnung: Ledger, positionsgenaue Refund-Korrekturen, Auszahlungsläufe, SEPA-XML, druckbare Gutschriften und Steuerstatus-Snapshot.
6. Berichte und Verwaltung: Berichte, Im-/Export, versionierter Integrationsvertrag; Partnerportal ohne Zugriff auf Kundendaten.
7. Integrationen: eigenständig nutzbar; WooCommerce optional; dokumentierte Verträge für weitere Produktintegrationen.
8. Anwendungsfälle: Onlinehandel, Kurse, Abonnements, Creator- und Agenturprogramme.
9. Recht und Datenschutz: Cookie-/Consent-, Steuer- und Belegpflichten fachlich prüfen lassen; keine Rechtsberatung versprechen.
10. FAQ: Provisionen, Refunds, Cookies, Auszahlungsarten, Import und Mehrwährung.
11. Pro-Angebot: Webhooks, erweiterte API, White-Label-Portal und automatische PayPal-Auszahlungen.

#### 10) License Captain – `/license-captain/`
**SEO-Titel:** WordPress Plugin-Lizenzen und Updates mit WooCommerce verwalten  
**Primärkeyword:** WordPress Lizenzmanager Plugin  
**Weitere Begriffe:** Plugin Updates verkaufen, WooCommerce Lizenzschlüssel, WordPress Softwarelizenz Verwaltung.

**Hero-Entwurf:** „Der Lizenzserver für Ihre WordPress-Produkte.“  
„Nutzen Sie WooCommerce für den Lizenzverkauf und steuern Sie Aktivierungen, Laufzeiten, Verlängerungen, Berechtigungen und Updatezugriffe zentral.“  
License Captain besteht aus Server und Client und hat eigene Preise und Pläne im Shopkatalog.

**Abschnitte:**
1. Zielgruppe: kleine und mittlere Plugin-Hersteller, Agenturen und Softwareteams.
2. Lizenz-Lifecycle als Ablaufgrafik: WooCommerce-Kauf → Lizenz → Website-Aktivierung → Entitlement-Prüfung → Update → Verlängerung.
3. Funktionen: Aktivierungslimits, Live/Staging/Development, Kundenbereich, Adminverwaltung, signierte API, Updateverwaltung. Neue Inhaltsmodule: Mein-Lizenzen-Übersicht per Shortcode/Block und Produkt-Changelog per Shortcode/Block.
4. Automatische vs. manuelle Verlängerungen und Zahlungsanbieter klar unterscheiden; PayPal derzeit manuell.
5. Sicherheit und Betrieb: Schlüsselkonfiguration, HTTPS, Backups, Hostingvoraussetzungen, API-Dokumentation.
6. Preise und Pläne: License Captain wird separat angeboten; Kaufoptionen, Laufzeiten und Website-Limits richten sich nach dem eigenen Shopkatalog.
7. Server und Client: Der Server stellt API und Lizenzverwaltung bereit. Der Client wird in jedes Plugin des Herstellers eingebunden und mit ihm ausgeliefert; Endkunden installieren nichts zusätzlich.
8. FAQ: eigener Shop, WooCommerce, Lizenzlaufzeit, Updates, Site-Transfer, Kundenansicht, Release-Notizen und Einbindung des Clients.

#### 11–13) Captain Pro-Produktseiten

Jedes der sechs kostenpflichtigen Add-ons erhält eine Pro-Seite unter der jeweiligen Produkt-URL (`/voucher-captain/pro/`, `/pass-captain/pro/`, `/affiliate-captain/pro/`, `/form-captain/pro/`, `/review-captain/pro/`, `/workflow-captain/pro/`). Die Seite nennt das benötigte Kern-Plugin, Zusatzfunktionen, Kompatibilität, Website-Limits, Verlängerung und Support. License Captain wird nicht als Bestandteil der Pro-Angebote genannt. Die vorläufig festgelegten Pro-Preise sind in der zentralen Preisübersicht gepflegt; Review Captain nutzt den aktuellen Shoppreis, bis die Beträge feststehen.

**Voucher Captain Pro – Zielgruppe und Seiteninhalt:** Unternehmen mit mehreren Standorten, hohem Gutscheinaufkommen oder kanalübergreifendem Versand. Hero: „Gutscheinaktionen für Ihr ganzes Unternehmen – zentral gesteuert.“ Inhalte: CSV-Massenbestellungen mit Empfängerdaten; individuelle Gutschein-PDFs und Zustelltermine; Apple-/Google-Wallet-Pässe; SMS mit sicherem Link; Kampagnen- und Empfehlungsberichte; Pass-Captain-Anbindung für Ticketgutscheine. CTA: „Voucher Captain Pro auswählen“; Free-Kern bleibt dauerhaft kostenlos.

**Pass Captain Pro – Zielgruppe und Seiteninhalt:** Veranstaltungsorte, Veranstalter und Agenturen mit höheren Anforderungen an Abrechnung, Einlass und eigene Markenführung. Hero: „Mehr Kontrolle für professionelle Ticket- und Serviceabläufe.“ Inhalte: XRechnung/ZUGFeRD für E-Rechnungen; Stripe-Terminal- und SumUp-Anbindung; White Label für Tickets und Portale; virtueller Warteraum bei hoher Nachfrage; schreibende API mit gezielten Berechtigungen. CTA: „Pass Captain Pro auswählen“; der kostenlose Kern deckt Events, Tickets, Zahlungen und Servicebuchungen ab.

**Affiliate Captain Pro – Zielgruppe und Seiteninhalt:** wachsende Partnerprogramme, Plattformen und Unternehmen mit individuellen Integrations- oder Auszahlungsanforderungen. Hero: „Ihr Partnerprogramm, verbunden mit Ihren Prozessen.“ Inhalte: signierte Webhooks für automatisierte Workflows; erweiterte REST-API; White-Label-Partnerportal; automatisierte PayPal-Auszahlungen. CTA: „Affiliate Captain Pro auswählen“; der kostenlose Kern enthält Partnerverwaltung, Attribution, Provisionen, Korrekturen und SEPA-Auszahlungsläufe.

#### 10) Workflow Captain – `/workflow-captain/`
**SEO-Titel:** WordPress-Automatisierung mit Workflow Captain | Captain Plugins  
**Primärkeyword:** WordPress Workflow Plugin  
**Weitere Begriffe:** WooCommerce Automatisierung, WordPress Webhooks, Captain-Plugins verbinden.

**Hero-Entwurf:** „Wiederkehrende Abläufe. Ein klarer Workflow.“  
„Verbinden Sie WordPress-, WooCommerce- und Captain-Suite-Ereignisse visuell mit Bedingungen, Zeitplanung und nachvollziehbaren Aktionen.“  
CTA: „Workflow Captain kostenlos starten“ / sekundär „Pro-Integrationen ansehen“.

**Abschnitte:**
1. Problem und Zielgruppe: Unternehmen und Agenturen, die manuelle Übergaben zwischen Plugins reduzieren und Run-Status nachvollziehen möchten.
2. Ablauf: Ereignis wählen → Bedingungen festlegen → Aktionen verbinden → Dry Run prüfen → veröffentlichen und überwachen.
3. Free-Umfang: WP-/WooCommerce-Provider, unbegrenzte Workflows und Runs, mehrere Trigger und Aktionen, einfache Bedingungen, Basis-Zeitplanung, Dry Run und 30-Tage-Logs.
4. Pro-Umfang: Captain-Suite-Provider, signierte Webhooks, Versionen und Rezepte, Event-Korrelation, erweiterte Logik, Retry/Replay, Audit und längere Protokollaufbewahrung.
5. Integrationen und Grenzen: öffentliche Providerverträge; Fachplugins bleiben Eigentümer ihrer Daten; keine direkte Datenbankkopplung, freie PHP-/SQL-Ausführung oder breite native Drittanbieter-App-Bibliothek.
6. Voraussetzungen, Testmatrix, Preis, Support und FAQ; Screenshot-Platzhalter für Builder, Providerstatus und redigiertes Run-Protokoll.

### C. Conversion- und Vertrauensseiten

Für alle fehlenden Medien erhalten Design und Copy eindeutige Platzhalter, zum Beispiel `[Screenshot-Platzhalter: Gutschein-PDF-Designer mit markiertem Layoutbereich, Elementleiste und PDF-Vorschau zeigen.]`, `[Demo-Video: Ticket-Checkout und Einlass]` und `[Kundenbeispiel: Affiliate-Programm im Einsatz]`. Diese Platzhalter markieren spätere Asset-Slots und dürfen nicht wie echte Referenzen wirken.

#### 14) Vergleich – `/vergleich/`
Vergleich der sechs kostenlosen Kern-Plugins und License Captain nach Geschäftsaufgabe, Abhängigkeit von WooCommerce, Funktionen und Reife-/Verfügbarkeitsstatus. Keine unbelegten Wettbewerbervergleiche oder Leistungszahlen.

#### 15) Integrationen – `/integrationen/`
Aktuelle Integrationen und Voraussetzungen je Produkt. Zwischen „verfügbar“, „optional“, „in Entwicklung“ und „geplant“ unterscheiden. Technische Integrationen ausschließlich aus geprüfter Dokumentation übernehmen.

#### 16) FAQ – `/faq/`
Produktübergreifende häufige Fragen plus produktspezifische FAQs auf den jeweiligen Produktseiten. Strukturierte FAQ-Daten nur dann einsetzen, wenn die Fragen tatsächlich sichtbar und aktuell gehalten werden.

#### 17) Rechtliches und Datenschutz – `/datenschutz/`, `/agb/`, `/widerruf/`, `/impressum/`
Von qualifizierter Stelle prüfen lassen. Affiliate, Gutscheine, automatische Verlängerung und digitale Software haben unterschiedliche Anforderungen. Keine generischen Vorlagen ungeprüft übernehmen.

#### 18) Anwendungsfall Bootsschulen – `/loesungen/bootsschulen/`
Eigene B2B-Seite für Bootsschulen, die Kurse, Verleih und wiederkehrende Servicebuchungen organisieren. Pass Captain wird als Werkzeug für Zeitfenster, Ressourcen, Buchungsregeln, Tickets, Einlass und Wartelisten positioniert. Der im Repository beschriebene Zugangscode-Shop ist ein separater B2B-Anwendungsfall mit WooCommerce-Bestellung und Codezustellung; ihn auf der Seite als ergänzenden Shop-Workflow erklären und nicht mit der Pass-Captain-Kernfunktion verwechseln. Screenshots und Ablaufgrafik erhalten vorerst Platzhalter.

## 5. SEO-Konzept

### Yoast SEO als redaktioneller Workflow

Die WordPress-Website soll **Yoast SEO** als SEO-Plugin verwenden. Für jede Indexierungsseite werden in Yoast ein eindeutiger SEO-Titel und eine Meta-Description gepflegt; pro URL wird eine primäre Suchintention bzw. Fokus-Keyphrase festgelegt. Yoast wird außerdem für die XML-Sitemap, Breadcrumbs und die passende strukturierte Datenausgabe eingerichtet, soweit das Theme und die Seitenstruktur diese Funktionen unterstützen. Vorschauen in Yoast dienen der redaktionellen Kontrolle; sie sind keine Rankingzusage und ersetzen weder Keywordvalidierung noch technische Prüfung.

### Suchintentionen und Keyword-Cluster


| Seite | Suchintention | Primärkeyword / Themencluster |
|---|---|---|
| Startseite | Anbieter-/Lösungsüberblick | WordPress Plugins für Unternehmen; WooCommerce Business Plugins |
| Voucher Captain | Lösung evaluieren | WooCommerce Gutschein Plugin; Geschenkkarten; PDF-Gutscheine |
| Pass Captain | Event-/Ticketlösung evaluieren | WordPress Ticket Plugin; Eventmanagement WordPress; Einlassscanner |
| Affiliate Captain | Partnerprogramm aufbauen | Affiliate Plugin WordPress; WooCommerce Partnerprogramm; Provisionen verwalten |
| Form Captain | Formulare erstellen | WordPress Formular Plugin; Kontaktformular WordPress; Formulareinsendungen verwalten |
| Review Captain | Bewertungen sammeln und verwalten | WordPress Bewertungsplugin; Kundenbewertungen anzeigen; Bewertungsanfragen |
| Workflow Captain | Automatisierung | WordPress Workflow Plugin; WooCommerce Automatisierung; WordPress Webhooks |
| License Captain | Softwarevertrieb | WordPress Lizenzmanager; WooCommerce Lizenzschlüssel; Plugin Updates verkaufen |
| Captain Pro | Erweiterungen vergleichen | WordPress Plugin Pro Add-on; Premium-Erweiterung WooCommerce |
| Dokumentation | konkrete Umsetzung | produktbezogene Installations- und Fehlerbehebungsbegriffe |

Die Keywords sind thematische Arbeitshypothesen, keine Suchvolumen- oder Rankingzusage. Vor dem finalen SEO-Release mit Search Console/Keyworddaten prüfen und nach tatsächlicher Nachfrage priorisieren.

### On-page- und technische Grundlagen

- Eine primäre Suchintention pro URL; SEO-Titel, H1 und Meta-Description in Yoast SEO eindeutig pflegen.
- Deutsche URL-Slugs, kanonische URLs, XML-Sitemap, Robots-Regeln, saubere Weiterleitungen und Breadcrumbs.
- Interne Links von Startseite → Produktübersicht → Produktseite → Doku/FAQ/Download.
- Produktseiten mit eigenen Screenshots, aussagekräftigem Alt-Text und konkreten Beispielen statt generischen Stockbildern.
- Schema.org nur passend zur tatsächlichen Seitenart und mit sichtbarem Inhalt; keine Bewertungen, Preise oder Verfügbarkeiten erfinden.
- Performance, mobile Darstellung, Barrierefreiheit und Core Web Vitals vor Veröffentlichung prüfen.
- Changelogs und Kompatibilitätsangaben datieren und regelmäßig aktualisieren.
- Für kostenlose Kern-Plugins Downloadziel und Supportweg direkt sichtbar machen; Pro-Kaufpfad separat führen. License Captain als eigenes Produkt (Server und Client) für Plugin-Hersteller darstellen.
- Englische Version später mit eigener URL-Struktur und professioneller Übersetzung; keine automatisch duplizierten Seiten.

### Content-Plan für die erste Ausbauphase

1. Kernseiten und Produktseiten vollständig erstellen.
2. Je Produkt drei praxisorientierte Ratgeber veröffentlichen. Die ersten 21 redaktionellen Entwürfe liegen unter `texte/homepage/ratgeber/` und sind im README verlinkt.
3. Integrations-/Kompatibilitätsartikel und bebilderte Anleitungen ergänzen.
4. Releasebeiträge und Changelog mit jeder stabilen Veröffentlichung aktualisieren.
5. Funktionscopy auf Basis der übernommenen Produktpläne schreiben; Screenshot-, Demo- und Kundenbeispiel-Slots bis zur Lieferung echter Medien als Platzhalter kennzeichnen.

## 6. To-do und Freigabereihenfolge

### Phase 1 – Produkt- und Releaseklarheit

- [ ] Hauptmarke, Domain, finale Schreibweisen und Sprachansprache bestätigen.
- [x] Finalen Kern- und Pro-Umfang als redaktionelle Produktmatrix für die Texte festlegen.
- [ ] Alle Funktionen aus den aktuellen Entwicklungsarbeiten in die finale Verkaufsfassung integrieren und abnehmen.
- [ ] Voucher-Captain-Free-/Pro-Aufteilung in Code, README, Add-on und Shopkatalog mit dieser Produktmatrix synchronisieren.
- [ ] Download-, Checkout- und Kauflinks für alle Produkte hinterlegen.
- [x] Vorläufige Pro-Pläne und Jahrespreise übernehmen: Single/Business/Agency mit 1/5/25 Live-Websites. License Captain erhält ein separates Angebot mit Preisen aus dem eigenen Shopkatalog.
- [ ] License-Captain-Stripe-, Browser-, Add-on- und Produktionsabnahmen abschließen.
- [ ] Release-Gates, Mindestversionen und Supportmodell je Produkt final freigeben.
- [ ] Rechtstexte und Produktbedingungen fachlich prüfen: AGB, Datenschutz, Widerruf, Lizenz-/Verlängerungshinweise sowie Gutschein- und Affiliate-Abrechnung.

### Phase 2 – Informationsarchitektur und Belege

- [x] Sitemap, geplante URL-Struktur und Markdown-Seitenhierarchie festhalten.
- [x] Produktprofile, Zielgruppen, Kernnutzen, Features und Pro-Angebote als Textgrundlage ausarbeiten.
- [x] Platzhalter für Screenshots, Demos und Kundenbeispiele in den Texten einsetzen.
- [x] Mindestversionen, geprüfte Plattformstände, Integrationen und Supportstufen je Produkt anhand der Repositories erfassen; vor Veröffentlichung mit der finalen Release-Matrix abgleichen.
- [x] Erste produktspezifische FAQs verfassen.
- [ ] FAQs mit echten Supportfragen abgleichen.
- [ ] Logo, Produkticons, Markenfarben und Screenshot-Stil bereitstellen.

### Phase 3 – Copy und SEO

- [x] Deutsche Marketingtexte für Startseite, Produkte, Preise, Captain Pro, Support, Dokumentation, Vergleich, Integrationen, übergreifende FAQ und Anwendungsfall Bootsschulen verfassen.
- [x] Für jedes Produkt Übersicht, Features, Pro-/Paket-Seite und FAQ erstellen.
- [x] 21 SEO-Ratgeberentwürfe mit je drei Artikeln in sieben Produktbereichen anlegen.
- [x] SEO-Titel, Meta-Descriptions, Fokus-Keyphrases, URL-Slugs und interne Links als Erstfassung einarbeiten.
- [ ] Yoast SEO installieren und konfigurieren; Sitemap, Breadcrumbs, Indexierung und strukturierte Datenausgabe technisch prüfen.
- [ ] Suchbegriffe mit Search Console oder Keyworddaten validieren.
- [x] Schritt-für-Schritt-Installationsanleitungen für die sechs Kern-Plugins, License Captain und Captain Pro erstellen; Screenshot-Platzhalter enthalten Bildbriefings.
- [ ] Produktcopy anhand finaler Release-Funktionen und rechtlicher Aussagen freigeben.
- [ ] Impressum, Datenschutz, AGB und Widerrufsseite mit den erforderlichen Unternehmensdaten und fachlicher Prüfung erstellen.

### Phase 4 – Website-Umsetzung und Qualität

- [ ] Responsive Layout und Navigation umsetzen.
- [ ] Download-, Lizenz-, Checkout-, Demo- und Kontakt-CTAs mit echten URLs verknüpfen.
- [ ] Produktbilder, Demos und freigegebene Kundenbeispiele einsetzen.
- [ ] Mobile Darstellung, Barrierefreiheit, Performance und Formulare prüfen.
- [ ] Canonicals, Robots, strukturierte Daten, Redirects sowie Analytics/Consent konfigurieren.
- [ ] Preise, Website-Limits und Lizenzbedingungen mit dem finalen WooCommerce-Katalog abgleichen.

### Phase 5 – Laufende Verbesserung

- [ ] Search Console und datenschutzkonforme Nutzungsanalyse einrichten.
- [ ] Suchanfragen, Klickrate, Downloads, Demo-Anfragen und Pro-Konversion auswerten.
- [ ] Produktseiten, Kompatibilitätsangaben, FAQs und Ratgeber bei Releases aktualisieren.
- [ ] Ratgeber nach tatsächlichen Support- und Suchfragen erweitern.

## 7. Textregeln und Release-Annahmen

| Thema | Sichere Darstellung |
|---|---|
| Finaler Angebotsstand | Die Marketingtexte beschreiben den vollständigen hier definierten Verkaufsumfang. Alle Funktionen aus den aktuellen Entwicklungsarbeiten werden bis zum Verkaufsstart in die finale Version integriert. |
| Free und Pro | Die in diesem Konzept festgelegte Free-/Pro-Zuordnung ist die redaktionelle Quelle für Website, Produkt-README, Vergleichstabelle und Add-on-Beschreibungen. |
| License Captain | Eigenes Produkt aus Server und Client; eigener Shoppreis. Lizenziert intern auch die Captain-Pro-Add-ons (Client unsichtbar im Pro-Plugin), wird gegenüber Pro-Kunden aber nicht erwähnt. |
| Steuer / Recht / Datenschutz | Technische Funktionen sachlich nennen; keine Compliance- oder Steuerrechtsgarantie geben. |
| Kompatibilität | Mit konkreten geprüften Versionen und Prüfdatum angeben. |
| Zeit- oder Umsatzeffekte | Keine garantierten Einsparungen, Verkaufssteigerungen oder ROI versprechen. |

## 8. Repository-Grundlage und finale Produktmatrix

Die Prüfung vom **15.11.2026** bezog Hauptstände, neuere Produktdokumente und aktuelle Feature-Arbeiten ein. Für dieses Konzept gilt die redaktionelle Annahme, dass alle dort beschriebenen Funktionen vor Verkaufsstart Teil des finalen Releases werden. Die offenen Entwicklungsarbeiten dienen somit als Umfangsquelle, nicht als Einschränkung der Website-Copy. Bei abweichenden READMEs und älteren Produktplänen gilt für das Marketing die nachfolgende Produktmatrix; sie ist vor Veröffentlichung synchron in Code, Dokumentation und Shop-Angebot umzusetzen.

### In den finalen Verkaufsumfang übernommene Entwicklungsarbeiten

| Repository / Referenz | Im finalen Produktumfang berücksichtigt |
|---|---|
| [Pass Captain #26](https://github.com/hastla007/wp-passmaster/pull/26) | Servicebuchungen, automatische Wartelisten, direkte Zahlungen, Preis- und Käuferregeln, iCal, Wallet-Tickets, Offline-Scanner, Mehranbieter-Warenkörbe, Sicherheits- und Betriebswerkzeuge. |
| [Voucher Captain #15](https://github.com/hastla007/wp-couponmaster/pull/15) | Kostenloser Kern, Gutscheinaktionen und Prämien, Empfehlungen, Geschenkkarten-Aufladung, Auswertungen, Pass-Captain-Verbindung, robuste Gutscheinausgabe und Verwaltung. Pro ergänzt Firmenbestellungen, Wallet-Pässe und SMS. |
| [License Captain](https://github.com/hastla007/wp-license) | Lizenzübersicht für Kunden und Produkt-Changelogs über Shortcodes und Gutenberg-Blöcke zusätzlich zu Lizenzverkauf, Aktivierungen, Verlängerungen und Updateauslieferung. |
| [Workflow Captain](https://github.com/hastla007/wp-workflowmaster) | WP-/WooCommerce-Kern und separates Pro-Add-on; versionierte Suite-Provider, sichere Webhooks, erweiterte Logik, Queue/Replay, Rezeptvorlagen sowie festgelegte Jahrespläne und Mindestversionen gemäß `konzept.md` und `TODO.md` im Plugin-Repository. |
| [Affiliate Captain](https://github.com/hastla007/wpaffiliatemaster) und [Captain Pro](https://github.com/hastla007/captain-pro) | Hauptprodukt 0.13.0 / Integrationsvertrag 1.3.0; Pro-Module für signierte Webhooks, erweiterte API, White Label und automatische PayPal-Auszahlungen. |

- [boatingschool-wp](https://github.com/hastla007/boatingschool-wp) – `theme/konzept.md` ergänzt den passenden B2B-Anwendungsfall: Bootsschulen kaufen Kurs-Zugangscodes in Kontingenten und verteilen sie über ihre Plattform. Der WooCommerce-Adapter ist als Umsetzungspunkt im Projekt-To-do zu berücksichtigen.
- [wp-captainplugins](https://github.com/hastla007/wp-captainplugins) – zentrales Repository für Website-Texte und Homepage-Konzept. Dieses Konzept ist unter `texte/homepage/konzept.md` abgelegt.
- [License Captain](https://github.com/hastla007/wp-license) – Lizenzserver für WooCommerce mit API, Verlängerungen, Updateverwaltung sowie Kundenblöcken/-Shortcodes für Lizenzübersicht und Changelog, plus Client zum Einbinden in Plugins.
- [Pass Captain](https://github.com/hastla007/wp-passmaster) – Event-, Ticket-, Servicebuchungs- und Einlassverwaltung einschließlich der unter PR #26 beschriebenen finalen Erweiterungen.
- [Voucher Captain](https://github.com/hastla007/wp-couponmaster) – WooCommerce-Gutscheine, Geschenkkarten, PDF-Gestaltung, Zustellung, Einlösung und die im finalen Produktumfang festgelegten Erweiterungen aus PR #15.
- [Affiliate Captain](https://github.com/hastla007/wpaffiliatemaster) – Partnerprogramm, Attribution, Provisionsledger, Auszahlungsabläufe und Portal; Haupt-README weist Version 0.13.0 und Integrationsvertrag 1.3.0 aus.
- [Captain Pro](https://github.com/hastla007/captain-pro) – Premium-Add-ons für die Captain-Suite; die finalen Angebotsseiten verwenden die jeweils festgelegten Pro-Umfänge und Preise.

---

**Textentwürfe:** Die Startseite, gemeinsamen Unternehmensseiten sowie die Produkt-, Features-, Pro-/Paket- und FAQ-Seiten liegen als einzelne Markdown-Dateien in `texte/homepage/`. Die Datei `texte/homepage/README.md` enthält Navigation und Seitenübersicht. Screenshot-, Demo- und Kundenbeispiel-Platzhalter bleiben bis zur Bereitstellung echter Medien bestehen.

## 9. Erweiterung nach dem Expert:innen-Panel

### Ergebnis der moderierten Debatte

**B2B-Produktmarketing:** Die Produktfamilie braucht eine gemeinsame Dachbotschaft, aber jedes Plugin muss eine klar erkennbare Geschäftsaufgabe lösen. Die Startseite führt zur passenden Lösung; die Produktseiten verkaufen jeweils einen konkreten Arbeitsablauf.

**DACH-Conversion-Copy:** Eine lange Funktionsliste überzeugt erst, wenn der Nutzen zuerst steht. Jede Funktion wird in der Copy deshalb mit einem Ergebnis für den Betrieb verbunden: weniger manuelle Schritte, bessere Übersicht, nachvollziehbare Abläufe oder ein professioneller Auftritt. Keine unbelegten Umsatz- oder Zeitgarantien.

**WordPress-/WooCommerce-Architektur:** Leistungsversprechen werden nach Produktkern, optionaler Integration und Pro-Erweiterung sortiert. WooCommerce-Abhängigkeiten, Zahlungsmethoden, Datenflüsse und Rollen gehören auf Feature- und FAQ-Seiten, nicht versteckt in Fußnoten.

**SEO/Yoast:** Produktübersicht, Feature-Seite, Pro-Seite und FAQ haben unterschiedliche Suchintentionen. Jede URL erhält ein eigenes Keyword-Thema; gleiche Keywords und nahezu identische Absätze auf mehreren Seiten würden die Seiten gegenseitig konkurrieren lassen.

**UX-/Informationsarchitektur:** Besucher sollen auf jeder Seite in kurzer Zeit drei Fragen beantworten können: Passt das Plugin zu meinem Betrieb? Welche Funktionen brauche ich? Was ist mein nächster Schritt? Deshalb folgen Nutzen, Ablauf, Funktionen, Integrationen, Free-/Pro-Abgrenzung, Preis und FAQ in einer konsistenten Reihenfolge.

**B2B-Conversion und Preise:** Die bestehenden Captain-Pro-Pläne bleiben für diese Textfassung gesetzt. Der Preisvergleich muss klar zeigen, dass sich Single, Business und Agency nach Zahl der Live-Websites unterscheiden. License Captain erhält eine separate Produkt- und Preisseite; seine Preisstufen stammen aus dem eigenen Shopkatalog.

**Gemeinsamer Beschluss:** Features werden vollständig berücksichtigt, aber in verständliche Funktionsgruppen gegliedert. Übersichtsseiten verkaufen den Nutzen, Feature-Seiten liefern Tiefe, Pro-Seiten erklären den Upgradegrund, FAQs beseitigen konkrete Kaufbarrieren.

### Zielgruppenbotschaften und Belege

| Produkt | Hauptzielgruppe und Kaufanlass | Zentrale Botschaft | Beleg/Visual im Layout | Primärer CTA |
|---|---|---|---|---|
| Voucher Captain | WooCommerce-Shops, Filialunternehmen, Dienstleister; Gutscheine professionell ausstellen und verwalten | „Gutscheine, Geschenkkarten und Guthaben passend zu Ihrer Marke verkaufen und verwalten.“ | Platzhalter für Gutschein-Designer, personalisiertes PDF, Kundenkonto und Einlösung | „Kostenlos starten“; ergänzend „Pro-Funktionen vergleichen“ |
| Pass Captain | Veranstalter, Seminaranbieter, Vereine, Kurs- und Verleihbetriebe; Verkauf, Buchungen und Einlass koordinieren | „Events, Tickets und Servicebuchungen in WordPress organisieren – vom Termin bis zum Einlass.“ | Platzhalter für Eventkalender, Checkout, Ticket/Wallet und Scanner | „Pass Captain entdecken“ bzw. „Kostenlosen Kern laden“ |
| Affiliate Captain | Onlinehändler, digitale Anbieter, Abo- und Kursanbieter; Partnerprogramm kontrolliert aufbauen | „Partner gewinnen, Verkäufe nachvollziehen und Provisionen transparent abrechnen.“ | Platzhalter für Partnerportal, Provisionsregel, Refund-Korrektur und Auszahlung | „Partnerprogramm aufbauen“ |
| Workflow Captain | WordPress-Unternehmen, WooCommerce-Shops und Agenturen; wiederkehrende Abläufe zwischen Core, Shop und Captain Suite verbinden | „WordPress- und WooCommerce-Abläufe visuell verbinden und nachvollziehbar ausführen.“ | Platzhalter für Workflow-Builder, Providerstatus, Dry Run und Run-Protokoll | „Kostenlos starten“ / „Pro ansehen“ |
| License Captain | Plugin-Hersteller, Agenturen und Softwareteams; Lizenzen und Updates über WooCommerce verkaufen | „Lizenzserver für Ihren Shop, Client für Ihre Plugins – Lizenzen und Updates aus einer Hand.“ | Platzhalter für Lizenzübersicht, Aktivierungslimits, Update- und Changelog-Ansicht sowie Server-Client-Diagramm | „Server und Client für Ihre Plugins“ |

### Einheitlicher Aufbau der Produkt- und Unterseiten

1. **Hero:** Zielgruppe und Ergebnis in der H1; eine kurze Erklärung, was das Produkt erledigt; primärer CTA und passende Alternative. Keine abstrakten Claims ohne Produktbezug.
2. **Betriebsproblem:** konkrete Situation aus dem Alltag der Zielgruppe benennen.
3. **So funktioniert es:** drei bis fünf Schritte vom Start bis zum Ergebnis, mit passendem Screenshot-/Demo-Platzhalter.
4. **Funktionsgruppen:** je Abschnitt Nutzenüberschrift, kurze Erklärung und die dazugehörigen Features. Die vollständigen technischen Einzelheiten liegen auf der Features-Seite.
5. **Einsatzfälle:** Beispiele nach Unternehmenstyp und Ablauf, ohne erfundene Kundenreferenzen.
6. **Integrationen und Voraussetzungen:** WooCommerce optional oder erforderlich, unterstützte Zahlungswege, Datenübergaben und Kompatibilität klar erklären.
7. **Free-/Pro-Vergleich:** Kernfunktionen und Pro-Funktionen nebeneinander; Pro-Vorteile anhand konkreter Abläufe darstellen.
8. **Preis und Lizenz:** Jahrespreis, Website-Limit, Supportumfang und Verlängerungsmodell sichtbar und leicht vergleichbar.
9. **FAQ und Abschluss-CTA:** Einwände beantworten und die nächste Handlung wiederholen.

Die **Features-Seite** gliedert den kompletten Funktionsumfang nach Arbeitsabläufen. Die **Pro-Seite** führt mit Upgrade-Auslösern, konkretem Vergleich und Preis-CTA. Die **FAQ-Seite** beantwortet Produktfragen; dieselben Fragen können als kurze, sichtbare FAQ-Auszüge auf der Übersichtsseite wiederkehren.

### Layout- und UX-Vorgaben

- Einheitliche Kopfzeile mit Produkteinstieg, „Captain Pro“, Preise, Dokumentation und Support; auf Mobilgeräten eine klar erkennbare Navigation und ein gut erreichbarer CTA.
- Auf Produktseiten eine kurze Funktionsnavigation oder Sprungmarken verwenden. Längere Feature-Listen in verständliche Gruppen mit aufklappbaren Details gliedern.
- Preisvergleich mit klaren Spalten (Single, Business, Agency), Website-Limits und Jahrespreis je Captain-Pro-Produkt. License Captain separat nach seinen eigenen Shopplänen darstellen.
- CTA-Texte an den Status des Angebots binden: kostenloser Download für Kern-Plugins, Planwahl für Captain Pro und separater Kauf-CTA für License Captain.
- Screenshots, Demos und Referenzen als klar markierte Layout-Platzhalter führen. Keine generischen Stockbilder als Produktbeweis und keine erfundenen Logos, Bewertungen oder Case Studies.
- Barrierearme Kontraste, verständliche Linktexte, Tastaturbedienung und mobile Lesbarkeit von Vergleichstabellen und FAQs berücksichtigen.

### Yoast-SEO-Redaktionsbrief

Für jede URL werden in Yoast Fokus-Keyphrase, SEO-Titel, Meta-Description, Social-Vorschau und Indexierungsstatus einzeln gepflegt. Die Fokus-Keyphrase ist ein Redaktionshinweis; Lesbarkeit, Suchintention und echter Seiteninhalt haben Vorrang vor Ampelfarben.

| Seitentyp | Abgrenzung der Suchintention | Redaktioneller Schwerpunkt |
|---|---|---|
| Produktübersicht | Lösung und Zielgruppe evaluieren | Nutzen, Hauptablauf, wichtigste Features, Free/Pro und CTA |
| Features | einzelne Fähigkeiten und Arbeitsabläufe verstehen | Funktionsgruppen, konkrete Beispiele, Integrationen und Voraussetzungen |
| Pro-Version | Upgrade und Tarif vergleichen | zusätzliche Funktionen, Lizenzlimits, Jahrespreise und Kaufentscheidung |
| FAQ | konkrete Nutzungs- und Kaufbarrieren klären | präzise Antworten, interne Links auf Features, Preise, Dokumentation und Support |
| Anwendungsfall | Lösung für eine Branche evaluieren | branchentypischer Ablauf und passende Plugin-Funktionen |

Interne Verlinkung folgt der Kaufreise: Startseite → Produktübersicht → Features/Pro/FAQ → Preis oder Download. FAQ- und Produktdaten werden nur mit passenden, sichtbaren Inhalten ausgezeichnet; strukturierte Daten gelten nicht als Rankingversprechen.

### Umsetzungsplan aus der Debatte

1. Die finale Produktmatrix aus Abschnitt 8 als redaktionelle Quelle für Kern-, Pro- und Integrationsfunktionen fixieren.
2. Pro Plugin ein kompaktes Faktenblatt mit Zielgruppe, Kaufanlass, Nutzenversprechen, Featuregruppen, Integrationen, Voraussetzungen, CTA und häufigsten Einwänden erstellen.
3. Für jedes Plugin zuerst die Übersichtsseite schreiben, daraus Features-, Pro- und FAQ-Seiten ableiten und Dopplungen gezielt vermeiden.
4. Preis-, Lizenz-, Verlängerungs- und Supportangaben auf allen Seiten konsistent ausspielen; fehlende Konditionen als interne Freigabepunkte sammeln.
5. Layout mit echten Produktabläufen vorbereiten und Platzhalter für Screenshots, Demo und Kundenbeispiele einsetzen.
6. Yoast-Felder, interne Links, Breadcrumbs, Canonicals, Indexierung und mobile Seitendarstellung bei der Umsetzung prüfen.
7. Vor dem Verkaufsstart Copy, Shopkatalog und finalen Produktumfang gemeinsam abgleichen; nach Releases die Feature- und FAQ-Seiten aktualisieren.

### Interne Angaben, die vor Veröffentlichung einzusetzen sind

- Finale Netto-/Bruttopreislogik und Steueranzeige für Österreich, Deutschland und die Schweiz.
- Verlängerung, Kündigung, Widerruf und Supportumfang je Tarif.
- Konkrete WordPress-, PHP- und WooCommerce-Kompatibilitätsversionen des finalen Releases.
- Download-, Checkout-, Dokumentations- und Support-URLs.
- Freigegebene Produkt-Screenshots und Demo-Abläufe; Kundenbeispiele nur nach Zustimmung und Verifikation.
