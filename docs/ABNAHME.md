# Redaktionelle Abnahme

Automatisch erzeugt mit `python3 tools/acceptance-list.py` aus `texte/homepage/`. Die Liste bereitet die Abnahme vor;
abgehakt wird von den Rollen aus dem [Redaktionshandbuch](REDAKTION.md): **R** = Redaktion (Text, Links, Medien),
**F** = Produktverantwortung (fachliche Richtigkeit), **G** = Freigabe durch die Inhaberin (Preise, Zusagen, Veröffentlichung).

- **Status:** *blockiert* = fehlendes Linkziel oder Betreiberangabe (Details in [RELEASE-BLOCKER.md](RELEASE-BLOCKER.md)), *Vorbehalt* = Text enthält einen Prüfvermerk, *bereit* = inhaltlich abnahmefähig.
- **Prüfen:** *Preise* = Eurobeträge (mit `python3 tools/price-check.py` gegen den Shop abgeglichen), *Zusagen* = absolute Formulierungen wie „garantiert“, „sofort“, „DSGVO-konform“, die belegt sein müssen, *Medien* = Screenshot-/Demo-Platzhalter.
- Automatisch geprüft: SEO-Felder vollständig, License Captain auf Seiten für Pro-Kunden nicht als Lizenzierungsweg. Ergebnis: keine Verstöße.
**93 Seiten:** 67 bereit, 1 mit Vorbehalt, 25 blockiert.


## Startseite und Übersichten

| Seite | Titel | Status | Linkziele/Betreiber | Prüfen | R | F | G |
|---|---|---|---|---|:-:|:-:|:-:|
| `/captain-pro/` | Wenn Ihr Betrieb mehr braucht: Captain Pro | bereit | – | – | ☐ | ☐ | ☐ |
| `/` | Geschäftsprozesse in WordPress. Klar organisiert. | blockiert | 4 offen | 3 Medien | ☐ | ☐ | ☐ |
| `/preise/` | Der passende Captain-Pro-Plan für Ihre Websites | blockiert | 1 offen | Preise | ☐ | ☐ | ☐ |
| `/produkte/` | Das passende WordPress-Plugin für Ihre Aufgabe | blockiert | 3 offen | Zusagen, 1 Medien | ☐ | ☐ | ☐ |
| `/vergleich/` | Welche Captain-Lösung passt zu Ihrem Unternehmen? | bereit | – | – | ☐ | ☐ | ☐ |

## Produkte

| Seite | Titel | Status | Linkziele/Betreiber | Prüfen | R | F | G |
|---|---|---|---|---|:-:|:-:|:-:|
| `/affiliate-captain/faq/` | Fragen zu Affiliate Captain | bereit | – | – | ☐ | ☐ | ☐ |
| `/affiliate-captain/features/` | Ein transparentes Partnerprogramm in WordPress | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/affiliate-captain/` | Ihr Partnerprogramm. Ihre Regeln. Ihre Daten. | blockiert | 1 offen | 2 Medien | ☐ | ☐ | ☐ |
| `/affiliate-captain/pro/` | Ihr Partnerprogramm, verbunden mit Ihren Prozessen | blockiert | 2 offen | Preise, 2 Medien | ☐ | ☐ | ☐ |
| `/course-captain/faq/` | Häufige Fragen zu Course Captain | bereit | – | – | ☐ | ☐ | ☐ |
| `/course-captain/features/` | Course Captain Features: das Lernmanagement für WordPress | blockiert | 1 offen | Zusagen, 2 Medien | ☐ | ☐ | ☐ |
| `/course-captain/` | Course Captain: Kurse erstellen, Wissen trainieren, Lernerfolge nachvollziehen | blockiert | 1 offen | Zusagen, 3 Medien | ☐ | ☐ | ☐ |
| `/course-captain/installation/` | Course Captain installieren und den ersten Kurs veröffentlichen | bereit | – | 4 Medien | ☐ | ☐ | ☐ |
| `/course-captain/integrationen/` | Course Captain Integrationen | bereit | – | 1 Medien | ☐ | ☐ | ☐ |
| `/course-captain/kompatibilitaet/` | Course Captain: Kompatibilität und Voraussetzungen | bereit | – | – | ☐ | ☐ | ☐ |
| `/course-captain/pro/` | Course Captain Pro: Schulungen professionell organisieren und verkaufen | blockiert | 1 offen | 2 Medien | ☐ | ☐ | ☐ |
| `/form-captain/faq/` | Häufige Fragen zu Form Captain | bereit | – | Preise | ☐ | ☐ | ☐ |
| `/form-captain/features/` | Form Captain Features: Erstellen, veröffentlichen, bearbeiten | bereit | – | Zusagen, 1 Medien | ☐ | ☐ | ☐ |
| `/form-captain/` | Form Captain: Formulare und Anfragen im eigenen WordPress verwalten | blockiert | 1 offen | Preise, 1 Medien | ☐ | ☐ | ☐ |
| `/form-captain/installation/` | Form Captain installieren und das erste Formular veröffentlichen | bereit | – | – | ☐ | ☐ | ☐ |
| `/form-captain/integrationen/` | Form Captain Integrationen | bereit | – | 1 Medien | ☐ | ☐ | ☐ |
| `/form-captain/kompatibilitaet/` | Form Captain: Kompatibilität und Voraussetzungen | bereit | – | – | ☐ | ☐ | ☐ |
| `/form-captain/pro/` | Form Captain Pro: Komplexe Formulare zuverlässig abwickeln | blockiert | 1 offen | Preise, Zusagen, 1 Medien | ☐ | ☐ | ☐ |
| `/license-captain/faq/` | Fragen zu License Captain | bereit | – | – | ☐ | ☐ | ☐ |
| `/license-captain/features/` | Lizenzverwaltung vom Shop bis zur Plugin-Aktualisierung | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/license-captain/` | Lizenzen und Updates für Ihre WordPress-Plugins verwalten | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/license-captain/preise/` | License Captain: Preise und Pläne | blockiert | 1 offen | – | ☐ | ☐ | ☐ |
| `/pass-captain/faq/` | Fragen zu Pass Captain | bereit | – | – | ☐ | ☐ | ☐ |
| `/pass-captain/features/` | Ein durchgängiger Ablauf für Events und Services | bereit | – | Zusagen, 2 Medien | ☐ | ☐ | ☐ |
| `/pass-captain/` | Events und Buchungen direkt in WordPress organisieren | blockiert | 1 offen | 2 Medien | ☐ | ☐ | ☐ |
| `/pass-captain/pro/` | Mehr Kontrolle für professionelle Ticket- und Serviceabläufe | blockiert | 2 offen | Preise, 2 Medien | ☐ | ☐ | ☐ |
| `/review-captain/faq/` | Häufige Fragen zu Review Captain | bereit | – | – | ☐ | ☐ | ☐ |
| `/review-captain/features/` | Review Captain Features: Bewertungen zentral organisieren | bereit | – | Zusagen, 1 Medien | ☐ | ☐ | ☐ |
| `/review-captain/` | Review Captain: Kundenstimmen, die Vertrauen schaffen | blockiert | 1 offen | 1 Medien | ☐ | ☐ | ☐ |
| `/review-captain/installation/` | Review Captain installieren und einrichten | bereit | – | – | ☐ | ☐ | ☐ |
| `/review-captain/integrationen/` | Review Captain Integrationen | bereit | – | 1 Medien | ☐ | ☐ | ☐ |
| `/review-captain/kompatibilitaet/` | Review Captain: Kompatibilität und Plattformzugänge | bereit | – | – | ☐ | ☐ | ☐ |
| `/review-captain/pro/` | Review Captain Pro: Bewertungen in Ihre Abläufe integrieren | blockiert | 1 offen | 1 Medien | ☐ | ☐ | ☐ |
| `/voucher-captain/faq/` | Fragen zu Voucher Captain | bereit | – | Zusagen | ☐ | ☐ | ☐ |
| `/voucher-captain/features/` | Gutscheinverwaltung für den WooCommerce-Alltag | bereit | – | Zusagen, 2 Medien | ☐ | ☐ | ☐ |
| `/voucher-captain/` | Gutscheine verkaufen, die zu Ihrer Marke passen | blockiert | 1 offen | Zusagen, 3 Medien | ☐ | ☐ | ☐ |
| `/voucher-captain/pro/` | Gutscheinaktionen für Ihr ganzes Unternehmen – zentral gesteuert | blockiert | 2 offen | Preise, 2 Medien | ☐ | ☐ | ☐ |
| `/workflow-captain/faq/` | Häufige Fragen zu Workflow Captain | bereit | – | Preise | ☐ | ☐ | ☐ |
| `/workflow-captain/features/` | Workflow Captain Features: Abläufe visuell verbinden | bereit | – | Zusagen, 1 Medien | ☐ | ☐ | ☐ |
| `/workflow-captain/` | Wiederkehrende Abläufe. Ein klarer Workflow. | blockiert | 2 offen | 1 Medien | ☐ | ☐ | ☐ |
| `/workflow-captain/installation/` | Workflow Captain installieren und den ersten Ablauf testen | bereit | – | 1 Medien | ☐ | ☐ | ☐ |
| `/workflow-captain/integrationen/` | Workflow Captain Integrationen | bereit | – | Zusagen, 1 Medien | ☐ | ☐ | ☐ |
| `/workflow-captain/kompatibilitaet/` | Voraussetzungen und Kompatibilität | bereit | – | – | ☐ | ☐ | ☐ |
| `/workflow-captain/pro/` | Workflow Captain Pro: Ihre Suite, sinnvoll verbunden | blockiert | 1 offen | Preise, 1 Medien | ☐ | ☐ | ☐ |

## Lösungen und Integrationen

| Seite | Titel | Status | Linkziele/Betreiber | Prüfen | R | F | G |
|---|---|---|---|---|:-:|:-:|:-:|
| `/integrationen/` | Ihre Abläufe verbunden | bereit | – | – | ☐ | ☐ | ☐ |
| `/kompatibilitaet/` | Kompatibilität, Integrationen und Support | Vorbehalt | – | – | ☐ | ☐ | ☐ |
| `/loesungen/akademien/` | Online-Akademien und Weiterbildung – vom Kurs bis zum Nachweis in WordPress | bereit | – | 3 Medien | ☐ | ☐ | ☐ |
| `/loesungen/bootsschulen/` | Kurse und Buchungen für Ihre Bootsschule – zentral in WordPress | bereit | – | 3 Medien | ☐ | ☐ | ☐ |

## Dokumentation

| Seite | Titel | Status | Linkziele/Betreiber | Prüfen | R | F | G |
|---|---|---|---|---|:-:|:-:|:-:|
| `/dokumentation/course-captain/` | Course Captain Dokumentation | bereit | – | Zusagen | ☐ | ☐ | ☐ |
| `/dokumentation/form-captain/` | Form Captain Dokumentation | bereit | – | – | ☐ | ☐ | ☐ |
| `/dokumentation/installation/affiliate-captain/` | Affiliate Captain installieren und das Partnerprogramm einrichten | bereit | – | 5 Medien | ☐ | ☐ | ☐ |
| `/dokumentation/installation/captain-pro/` | Captain Pro installieren und freischalten | bereit | – | 5 Medien | ☐ | ☐ | ☐ |
| `/dokumentation/installation/` | Captain Plugins installieren | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/dokumentation/installation/license-captain/` | License Captain als WooCommerce-Lizenzserver einrichten | bereit | – | 5 Medien | ☐ | ☐ | ☐ |
| `/dokumentation/installation/pass-captain/` | Pass Captain installieren und den ersten Ablauf einrichten | bereit | – | 6 Medien | ☐ | ☐ | ☐ |
| `/dokumentation/installation/voucher-captain/` | Voucher Captain installieren und den ersten Gutschein einrichten | bereit | – | Zusagen, 5 Medien | ☐ | ☐ | ☐ |
| `/dokumentation/review-captain/` | Review Captain Dokumentation | bereit | – | – | ☐ | ☐ | ☐ |
| `/dokumentation/workflow-captain/` | Workflow Captain Dokumentation | bereit | – | 1 Medien | ☐ | ☐ | ☐ |
| `/dokumentation/` | Dokumentation für Ihren Arbeitsablauf | bereit | – | – | ☐ | ☐ | ☐ |

## Ratgeber

| Seite | Titel | Status | Linkziele/Betreiber | Prüfen | R | F | G |
|---|---|---|---|---|:-:|:-:|:-:|
| `/ratgeber/affiliate-captain/provisionsregeln-partnerprogramm/` | Provisionsregeln für Ihr Partnerprogramm festlegen | bereit | – | Zusagen, 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/affiliate-captain/refunds-provisionen-korrigieren/` | Rückerstattungen und Affiliate-Provisionen nachvollziehbar korrigieren | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/affiliate-captain/sepa-auszahlungen-vorbereiten/` | Partnerauszahlungen mit SEPA vorbereiten | blockiert | 1 offen | 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/course-captain/mitarbeiterschulung-onboarding/` | Mitarbeiterschulung und Onboarding mit WordPress organisieren | bereit | – | – | ☐ | ☐ | ☐ |
| `/ratgeber/course-captain/online-kurs-wordpress-erstellen/` | Einen Online-Kurs in WordPress erstellen | bereit | – | – | ☐ | ☐ | ☐ |
| `/ratgeber/course-captain/pruefungsvorbereitung-wiederholung/` | Prüfungsvorbereitung online: Wiederholen mit System | bereit | – | – | ☐ | ☐ | ☐ |
| `/ratgeber/form-captain/form-plugin-wechseln-und-migration/` | Ein WordPress-Formularplugin wechseln: Migration sicher vorbereiten | bereit | – | – | ☐ | ☐ | ☐ |
| `/ratgeber/form-captain/formulareinsendungen-datenschutz/` | Formulareinsendungen in WordPress datenschutzgerecht verwalten | bereit | – | – | ☐ | ☐ | ☐ |
| `/ratgeber/form-captain/kontaktformular-wordpress-erstellen/` | Ein WordPress-Kontaktformular erstellen und Anfragen bearbeiten | bereit | – | – | ☐ | ☐ | ☐ |
| `/ratgeber/license-captain/kundenbereich-changelog/` | Lizenzübersicht und Produkt-Changelog im Kundenbereich anzeigen | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/license-captain/plugin-updates-lizenzstatus/` | Plugin-Updates mit Lizenzstatus und Berechtigungen steuern | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/license-captain/woocommerce-lizenzen-aktivierungen/` | WordPress-Plugin-Lizenzen mit WooCommerce verwalten | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/pass-captain/seminartickets-wordpress/` | Seminartickets mit WordPress organisieren und verkaufen | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/pass-captain/servicebuchungen-kurse-verleih/` | Kurs- und Verleihbuchungen in WordPress verwalten | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/pass-captain/warteliste-einlass-organisieren/` | Warteliste und Einlass für Events organisieren | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/review-captain/app-store-bewertungen-auf-website/` | App-Store-Bewertungen auf der Website zeigen | bereit | – | – | ☐ | ☐ | ☐ |
| `/ratgeber/review-captain/bewertungsanfragen-fair-automatisieren/` | Bewertungsanfragen fair automatisieren | bereit | – | – | ☐ | ☐ | ☐ |
| `/ratgeber/review-captain/google-bewertungen-in-wordpress-anzeigen/` | Google-Bewertungen in WordPress anzeigen: Quellen richtig einbinden | bereit | – | – | ☐ | ☐ | ☐ |
| `/ratgeber/voucher-captain/firmenbestellungen-csv/` | Gutscheine für Firmenkunden gesammelt ausstellen | bereit | – | 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/voucher-captain/gutscheine-gestalten-versenden/` | Gutscheine gestalten und zum passenden Zeitpunkt versenden | blockiert | 1 offen | Zusagen, 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/voucher-captain/wunschwert-restguthaben/` | WooCommerce-Gutscheine mit Wunschwert und Restguthaben anbieten | blockiert | 1 offen | 2 Medien | ☐ | ☐ | ☐ |
| `/ratgeber/workflow-captain/captain-plugins-verbinden/` | Captain-Plugins mit Workflows verbinden | bereit | – | – | ☐ | ☐ | ☐ |
| `/ratgeber/workflow-captain/woocommerce-bestellungen-automatisieren/` | WooCommerce-Bestellungen automatisieren | bereit | – | Zusagen | ☐ | ☐ | ☐ |
| `/ratgeber/workflow-captain/wordpress-automatisierung-ohne-cloud/` | WordPress-Automatisierung ohne externe Cloud planen | bereit | – | – | ☐ | ☐ | ☐ |

## Unternehmen, Support und Recht

| Seite | Titel | Status | Linkziele/Betreiber | Prüfen | R | F | G |
|---|---|---|---|---|:-:|:-:|:-:|
| `/datenschutz/` | Datenschutzerklärung | blockiert | 8 offen | – | ☐ | ☐ | ☐ |
| `/faq/` | Häufige Fragen zu Captain Plugins | bereit | – | – | ☐ | ☐ | ☐ |
| `/impressum/` | Impressum | blockiert | 11 offen | – | ☐ | ☐ | ☐ |
| `/support/` | Hilfe für Ihre Captain-Plugins | blockiert | 1 offen | – | ☐ | ☐ | ☐ |
| `/ueber/` | WordPress-Tools für Abläufe, die Ihr Geschäft voranbringen | bereit | – | 1 Medien | ☐ | ☐ | ☐ |
