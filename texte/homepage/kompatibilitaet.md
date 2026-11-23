---
url: /kompatibilitaet/
seo_title: Systemanforderungen & Integrationen | Captain Plugins
meta_description: Prüfen Sie WordPress-, PHP- und WooCommerce-Mindestversionen, getestete Umgebungen, Integrationen und Supportumfang der Captain Plugins.
focus_keyphrase: Captain Plugins Kompatibilität
---

# Kompatibilität, Integrationen und Support

Hier finden Sie die in den Produkt-Repositories dokumentierten Mindestversionen, Testumgebungen, Integrationen und Supportstufen. Mindestanforderungen und getestete Versionen sind getrennt ausgewiesen. Wenn Kern-Plugin und Pro-Add-on gemeinsam eingesetzt werden, gilt die höhere Mindestanforderung.

**Mindestversionen für alle Captain-Plugins:** WordPress 7.0, PHP 8.5, MySQL 9.7 (LTS) oder MariaDB 12.3 (LTS); wo WooCommerce genutzt wird, WooCommerce 11.2.2. PHP 8.6 wird nach Erscheinen in die Testmatrix aufgenommen. Ältere Datenbankversionen lösen im Plugin eine Warnung aus, sperren die Nutzung aber nicht.

## Systemanforderungen

| Produkt | WordPress mindestens | PHP mindestens | Datenbank mindestens | WooCommerce | Weitere Voraussetzungen |
|---|---:|---:|---|---|---|
| Voucher Captain | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | 11.2.2 erforderlich | PHP-Erweiterungen GD, mbstring und zip |
| Voucher Captain Pro | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | 11.2.2 erforderlich | Voucher Captain ab 1.2.0 muss installiert sein |
| Pass Captain | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Optional, ab 11.2.2 | Ohne WooCommerce nutzbar |
| Pass Captain Pro | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Optional, ab 11.2.2 | Pass Captain ab 1.5.0 muss installiert sein |
| Affiliate Captain | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Optional, ab 11.2.2 | PHP-Erweiterungen sodium und dom; zip für Programmausgabe |
| Affiliate Captain Pro | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Optional, ab 11.2.2 | Affiliate Captain muss installiert sein |
| Form Captain | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Nicht erforderlich | Der Kern nutzt keine WooCommerce-Funktionen; keine Multisite-Unterstützung in v1.0 |
| Form Captain Pro | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Optional, ab 11.2.2, nur für Käuferfragebögen | Separates Add-on; setzt Form Captain voraus |
| Review Captain | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Optional, ab 11.2.2 | Externe Plattformverbindungen benötigen berechtigte Anbieterzugänge |
| Review Captain Pro | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Optional, ab 11.2.2 | Native Synchronisierung je Plattform nur mit API-/Tarifberechtigung |
| Workflow Captain | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Optional, ab 11.2.2 | WooCommerce nur für Shop-Provider; Captain-Provider verlangen jeweils den kompatiblen Vertrag |
| Workflow Captain Pro | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Optional, ab 11.2.2 | Separates Add-on; gültige Pro-Lizenz und kompatible Provider erforderlich |
| Course Captain | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Nicht erforderlich | Eigenständiges LMS; Multisite nur je Website aktivierbar, Netzwerkaktivierung gesperrt |
| Course Captain Pro | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | Optional, ab 11.2.2; für Kursverkauf erforderlich | Separates Add-on; setzt Course Captain voraus |
| License Captain | 7.0 | 8.5 | MySQL 9.7 / MariaDB 12.3 | 11.2.2 erforderlich | WooCommerce muss aktiv sein; MySQL/MariaDB mit beschreibbarem Primärserver und funktionierendem Cron |

License Captain besteht aus Server und Client. Die Angaben oben gelten für den Server, der WooCommerce voraussetzt. Der Client wird in die zu lizenzierenden Plugins eingebunden und setzt auf den Kundenwebsites WordPress 7.0 und PHP 8.5 voraus.

## Getestete Plattformen

> Alle Captain-Plugins werden auf PHP 8.5 mit MySQL 9.7 und MariaDB 12.3 getestet, jeweils mit der Mindestversion und der aktuellen Version von WordPress und WooCommerce.

| Produkt | Dokumentierter Teststand |
|---|---|
| Voucher Captain | WordPress 7.0 bis 7.1, WooCommerce 11.2.2 bis 11.3, PHP 8.5; HPOS und klassische Speicherung, klassischer und Block-Checkout. |
| Pass Captain | WordPress 7.0+, PHP 8.5, WooCommerce optional 11.2.2–11.3; CI auf MariaDB 12.3 und MySQL 9.7, HPOS und klassische Speicherung, klassischer und Blocks-Checkout. |
| Affiliate Captain | WordPress 7.0, PHP 8.5; geprüft bis WordPress 7.1 / WooCommerce 11.3, MySQL 9.7 und MariaDB 12.3. |
| Form Captain | WordPress 7.0, PHP 8.5; WooCommerce optional ab 11.2.2 (nur Pro, Käuferfragebögen), HPOS und klassische Speicherung. Multisite wird in v1.0 nicht unterstützt. |
| Review Captain | WordPress 7.0, PHP 8.5, WooCommerce ab 11.2.2; getestet bis WordPress 7.1 / WooCommerce 11.3. Plattform-APIs setzen separate Zugangsdaten und die jeweiligen Anbieterrechte voraus. |
| Workflow Captain | WordPress 7.0, PHP 8.5; WooCommerce optional ab 11.2.2; HPOS sowie klassische und Block-Bestellungen. |
| Course Captain | WordPress 7.0 bis 7.1, PHP 8.5, MySQL 9.7 / MariaDB 12.3; WooCommerce 11.2.2+ für den Pro-Kursverkauf mit HPOS, klassischem und Block-Checkout. |
| License Captain | CI-Matrix: WordPress 7.0 mit WooCommerce 11.2.2 und aktuelle WordPress-Version mit WooCommerce 11.3.0, beide auf PHP 8.5 mit MySQL 9.7 und MariaDB 12.3; HPOS und klassische Speicherung, Multisite-Unterverzeichnis. |

**Hinweis:** Teststände werden mit jedem Release mit den dann aktuellen Versionen von WordPress und WooCommerce abgeglichen.

## Integrationsmatrix

| Integration / Funktion | Voucher Captain | Pass Captain | Affiliate Captain | Form Captain | Review Captain | Workflow Captain | Course Captain | License Captain |
|---|---|---|---|---|---|---|---|---|
| WooCommerce | Erforderlich: Produkte, Bestellungen, Gutscheine und Einlösung | Optional: Bestellsynchronisierung und Woo-Zahlungsablauf | Optional: WooCommerce-Verkäufe als Provisionsquelle | Optional, nur für Käuferfragebögen (Pro) | Optional für Produktzuordnung und Bewertungsanfragen | Optional; Woo-Provider im Free-Kern | Optional: Kursverkauf und Zugänge mit Pro | Erforderlich: Produktkatalog, Lizenzverkauf und Bestellungen |
| HPOS / klassische Bestellspeicherung | Beides in der CI-Matrix | Beides in der CI-Matrix | Beides unterstützt | Beides unterstützt (Pro, Käuferfragebögen) | Beides unterstützt | Beides unterstützt | Beides unterstützt (Pro-Kursverkauf) | Beides in der CI-Matrix |
| Checkout Blocks | Unterstützt | Unterstützt | Partnercode-Feld im Block-Checkout | Keine Checkout-Felder; Käuferfragebögen (Pro) nach der Bestellung | Unterstützt | Unterstützt | Unterstützt (Pro-Kursverkauf) | Unterstützt; Zustimmung zur automatischen Verlängerung als zusätzliches Checkout-Feld, automatische Verlängerung mit dem offiziellen WooCommerce-Stripe-Gateway |
| Zahlungen | WooCommerce-Zahlungsablauf | Stripe, PayPal, Mollie oder optional WooCommerce | WooCommerce als Verkaufsquelle; Auszahlungen über Zahlungsanbieter-Add-ons/Anbindungen | Keine Zahlungen in Pro v1 | Keine Zahlungsfunktion | Keine eigene Zahlungsabwicklung; nur freigegebene Aktionen | Keine eigene Zahlungsabwicklung; Kauf über WooCommerce | Offizielles WooCommerce-Stripe-Gateway für automatische Verlängerung; manuell weitere WooCommerce-Zahlungsarten |
| Captain-Produkte / APIs | Pass Captain für Ticketgutscheine, Gutscheinzahlung und gemeinsamen Scanner | Voucher Captain, Webhooks, iCal, Veranstalter- und Mobile-API | Versionierter öffentlicher Vertrag für Pass Captain, Voucher Captain und Connector-Add-ons | Versionierter Vertrag zu Pass, Voucher, Affiliate und Review Captain; Workflow-Ereignisse mit Form Captain Pro | Versionierte Ereignisse aus Voucher, Pass, Affiliate und Form Captain; eigene Projekt-Connectoren | Providervertrag für Core, WooCommerce und Captain Suite; keine direkten Tabellenzugriffe | Versionierte Verträge zu Voucher, Pass, Form, Affiliate und Workflow Captain; REST-API | API für Lizenzprüfung, Berechtigungen und Updates der Produkt-Plugins |

### Weitere Integrationen

- **Voucher Captain:** WooCommerce Subscriptions; WPML/WCML; Aelia Currency Switcher, WOOCS und CURCY; Flexible Product Fields und Flexible Checkout Fields; Polylang; WooPayments.
- **Pass Captain:** SMS über Twilio oder einen generischen HTTP-Dienst; Webhooks, iCal, Partner-API und Mobile-API. WooCommerce bleibt optional.
- **Affiliate Captain:** versionierter öffentlicher Integrationsvertrag; kompatible Verkaufsquellen nutzen die bereitgestellten Schnittstellen statt direkt auf Plugin-Tabellen zuzugreifen.
- **License Captain:** WooCommerce-Subscriptions-Produkte dürfen laut Produktdokumentation nicht als Lizenzprodukte zugeordnet werden.
- **Course Captain:** Integrationen mit Voucher, Pass, Form, Review, Affiliate und Workflow Captain nutzen versionierte öffentliche Verträge; jedes Plugin bleibt Eigentümer seiner Daten. Ein Kauf oder Ticket-Check-in erzeugt keinen Lernerfolg.
- **Form Captain:** Suite-Aktionen nutzen versionierte öffentliche Verträge. Eine Einsendung allein bestätigt keine Buchung, Zahlung, Partnerfreigabe oder öffentliche Review.
- **Review Captain:** externe Quellen werden nicht gescrapt. API-/Tarifzugang, Quellenhinweise und Anbieterbedingungen bestimmen Synchronisierung und Darstellung.
- **Workflow Captain:** Ausführung lokal in WordPress; Action Scheduler bei WooCommerce, sonst WP-Cron mit System-Cron-Empfehlung.

Drittanbieter-Zahlungsdienste benötigen ein eigenes Konto und passende Zugangsdaten.

## Supportumfang je Produkt

| Produkt | Kostenloses Kern-Plugin | Captain-Pro-Plan |
|---|---|---|
| Voucher Captain | Produktdokumentation; konkreten öffentlichen Supportkontakt vor Veröffentlichung ergänzen | Single und Business: Standard-Support. Agency: Priority-Support. |
| Pass Captain | Dokumentation und GitHub Issues; Sicherheitsmeldungen über private GitHub Security Advisories | Single und Business: Standard-Support. Agency: Priority-Support. |
| Affiliate Captain | Produktdokumentation; konkreten öffentlichen Supportkontakt vor Veröffentlichung ergänzen | Single und Business: Standard-Support. Agency: Priority-Support. |
| Form Captain | Dokumentation und veröffentlichte öffentliche Supportkanäle | Single/Business: Standard; Agency: Priority. Umfang und Kanal stehen beim Kauf. |
| Review Captain | Dokumentation und veröffentlichte öffentliche Supportkanäle | Single/Business: Standard; Agency: Priority. Umfang und Kanal stehen beim Kauf. |
| Workflow Captain | Dokumentation und veröffentlichte öffentliche Supportkanäle | Single/Business: Standard; Agency: Priority. Umfang und Kanal stehen beim Kauf. |
| Course Captain | Dokumentation und veröffentlichte öffentliche Supportkanäle | Single/Business: Standard; Agency: Priority. Umfang und Kanal stehen beim Kauf. |
| License Captain | Eigenes Produkt (Server und Client); Preise und Supportumfang gemäß License-Captain-Plan | Supportstufe richtet sich nach dem gewählten License-Captain-Plan. |

Die Tarife ordnen **Single (1 Live-Website)** und **Business (5 Live-Websites)** dem Standard-Support zu. **Agency (25 Live-Websites)** enthält Priority-Support. Verbindliche Reaktionszeiten und abschließende kommerzielle Supportkanäle sind in den Tarifunterlagen nicht festgelegt; deshalb werden hier keine Antwortzeitversprechen gemacht.

## Quellen in den Repositories

- [Voucher Captain: Kompatibilität](https://github.com/hastla007/wp-couponmaster/blob/claude/plugin-todo-liste-2a83v4/COMPATIBILITY.md) · [Readme](https://github.com/hastla007/wp-couponmaster/blob/main/README.md)
- [Pass Captain: Kompatibilität](https://github.com/hastla007/wp-passmaster/blob/claude/wp-plugin-analysis-todos-kvbfan/docs/COMPATIBILITY.md) · [Supportmodell](https://github.com/hastla007/wp-passmaster/blob/claude/wp-plugin-analysis-todos-kvbfan/docs/SUPPORT.md)
- [Affiliate Captain: Readme](https://github.com/hastla007/wpaffiliatemaster/blob/main/readme.txt) · [Integrationsvertrag](https://github.com/hastla007/wpaffiliatemaster/blob/main/docs/CONTRACT.md)
- [Course Captain: Produktkonzept](https://github.com/hastla007/wp-coursemaster/blob/main/konzept.md)
- [License Captain: Kompatibilität](https://github.com/hastla007/wp-license/blob/main/docs/COMPATIBILITY.md)
- [Captain Pro: Tarife](https://github.com/hastla007/captain-pro/blob/main/docs/TARIFE.md)

[Preise](/preise/) · [Integrationen im Detail](/integrationen/) · [Installationsanleitungen](/dokumentation/installation/) · [Support](/support/)
