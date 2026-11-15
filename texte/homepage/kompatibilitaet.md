---
url: /kompatibilitaet/
seo_title: Systemanforderungen & Integrationen | Captain Plugins
meta_description: Prüfen Sie WordPress-, PHP- und WooCommerce-Mindestversionen, getestete Umgebungen, Integrationen und Supportumfang der Captain Plugins.
focus_keyphrase: Captain Plugins Kompatibilität
---

# Kompatibilität, Integrationen und Support

Hier finden Sie die in den Produkt-Repositories dokumentierten Mindestversionen, Testumgebungen, Integrationen und Supportstufen. Mindestanforderungen und getestete Versionen sind getrennt ausgewiesen. Wenn Kern-Plugin und Pro-Add-on gemeinsam eingesetzt werden, gilt die höhere Mindestanforderung.

## Systemanforderungen

| Produkt | WordPress mindestens | PHP mindestens | WooCommerce | Weitere Voraussetzungen |
|---|---:|---:|---|---|
| Voucher Captain | 6.4 | 8.1 | 8.9 erforderlich | PHP-Erweiterungen GD, mbstring und zip |
| Voucher Captain Pro | 6.5 kombiniert | 8.1 | 8.9 erforderlich | Pro-Add-on setzt WP 6.5 voraus; Voucher Captain muss installiert sein |
| Pass Captain | 6.4 | 8.2 | Optional, ab 8.2 | Ohne WooCommerce nutzbar |
| Pass Captain Pro | 6.5 kombiniert | 8.2 | Optional, ab 8.2 | Pro-Add-on setzt WP 6.5 voraus; Pass Captain muss installiert sein |
| Affiliate Captain | 6.3 | 7.4 | Optional, ab 8.0 | PHP-Erweiterungen sodium und dom; zip für Programmausgabe |
| Affiliate Captain Pro | 6.5 kombiniert | 7.4 | Optional, ab 8.0 | Pro-Add-on setzt WP 6.5 voraus; Affiliate Captain muss installiert sein |
| Form Captain | 6.8 | 8.3 | Optional, ab 8.0 | WooCommerce ist für den Kern nicht erforderlich; keine Multisite-Unterstützung in v1.0 |
| Form Captain Pro | 6.8 | 8.3 | Optional, ab 8.0 | Separates Add-on; setzt Form Captain voraus. WooCommerce- und Suite-Adapter benötigen kompatible Versionen |
| Review Captain | Veröffentlichungsversion | Releaseangabe | Optional | Externe Plattformverbindungen benötigen berechtigte Anbieterzugänge |
| Review Captain Pro | Veröffentlichungsversion | Releaseangabe | Optional | Native Synchronisierung je Plattform nur mit API-/Tarifberechtigung |
| Workflow Captain | 6.8 | 8.3 | Optional, ab 8.0 | WooCommerce nur für Shop-Provider; Captain-Provider verlangen jeweils den kompatiblen Vertrag |
| Workflow Captain Pro | 6.8 | 8.3 | Optional, ab 8.0 | Separates Add-on; WP License-/Captain-Pro-Lizenz und kompatible Provider erforderlich |
| License Captain | 6.5 | 7.4 | 8.9 erforderlich | WooCommerce muss aktiv sein; MySQL/MariaDB mit beschreibbarem Primärserver und funktionierendem Cron |

License Captain ist ein separat erhältliches Server-Plugin. Es setzt WooCommerce voraus und ist nicht Bestandteil der Captain-Pro-Angebote.

## Getestete Plattformen

| Produkt | Dokumentierter Teststand |
|---|---|
| Voucher Captain | WordPress 7.1.4, WooCommerce 11.2.2, PHP 8.1 und 8.4; MySQL 8.4 und MariaDB 11.4; HPOS und klassische Speicherung. Yoast SEO 28.8 wird optional mitgetestet. CI prüft außerdem WP 6.4.5 / WooCommerce 8.9.0 / PHP 8.1. |
| Pass Captain | Die Kompatibilitätsdokumentation führt WordPress 6.4–7.1, PHP 8.2–8.4 und optional WooCommerce 8.2–11.3 auf. Getestet werden MySQL 8.0/8.4, MariaDB 10.6/11.4, HPOS und klassische Speicherung sowie klassischer und Blocks-Checkout. |
| Affiliate Captain | Plugin-Metadaten deklarieren WordPress 6.3 und PHP 7.4; WooCommerce ist optional. Die dokumentierte Integrationsprüfung umfasst WooCommerce bis 11.3 sowie MariaDB 10.11 und MySQL 8.4. |
| Form Captain | Produktanforderung: WordPress 6.8 und PHP 8.3; WooCommerce optional ab 8.0. HPOS und klassischer Bestellspeicher werden je Release getestet ausgewiesen. Multisite wird in v1.0 nicht unterstützt. |
| Review Captain | WordPress-/PHP-Mindestversionen und konkrete Testmatrix stehen in den Releaseangaben. Plattform-APIs setzen separate Zugangsdaten und die jeweiligen Anbieterrechte voraus. |
| Workflow Captain | Konzeptanforderungen: WordPress 6.8+, PHP 8.3+; WooCommerce 8.0+ optional. HPOS sowie klassische und Blocks-Bestellungen sind Release-Gates; getestete Versionen sind vor Release zu ergänzen. |
| License Captain | CI-Matrix: WordPress 6.5 mit WooCommerce 8.9.3 oder 9.4.3 auf PHP 7.4 sowie aktuelle WordPress-Version mit WooCommerce 11.2.2 auf PHP 8.3; HPOS und klassische Speicherung, außerdem Multisite-Unterverzeichnis im aktuellen Teststand. |

**Release-Hinweis:** Eine deklarierte Mindestversion ist nicht automatisch für jede Kombination erfolgreich getestet. License Captain deklariert WooCommerce 8.9 als Minimum; die CI-Matrix führt unter anderem 8.9.3, 9.4.3 und 11.2.2 auf. Der erfolgreiche Lauf für die Mindestlinie muss vor dem finalen Release belegt werden. Teststände sollten zur Veröffentlichung erneut mit den dann aktuellen Versionen abgeglichen werden.

## Integrationsmatrix

| Integration / Funktion | Voucher Captain | Pass Captain | Affiliate Captain | Form Captain | Review Captain | Workflow Captain | License Captain |
|---|---|---|---|---|---|---|---|
| WooCommerce | Erforderlich: Produkte, Bestellungen, Gutscheine und Einlösung | Optional: Bestellsynchronisierung und Woo-Zahlungsablauf | Optional: WooCommerce-Verkäufe als Provisionsquelle | Optional für Shopformulare und Shopereignisse | Optional für Produktzuordnung und Bewertungsanfragen | Optional; Woo-Provider im Free-Kern | Erforderlich: Produktkatalog, Lizenzverkauf und Bestellungen |
| HPOS / klassische Bestellspeicherung | Beides in der CI-Matrix | Beides in Kompatibilitätsmatrix | WooCommerce-Integration für aktuelle Speicherformen | Nach Release-Test ausgewiesen | Nach Release-Test ausgewiesen | Geplantes Release-Gate; Testmatrix folgt | Beides in der CI-Matrix |
| Checkout Blocks | Unterstützt | In der Kompatibilitätsmatrix aufgeführt | Partnercode-Feld ab WooCommerce 8.9 | Keine Form-Captain-Checkout-Blocks-Integration in v1.0 | Nach Release-Test ausgewiesen | Geplantes Release-Gate; Testmatrix folgt | Dokumentiert; automatische Verlängerung primär mit offiziellem WooCommerce-Stripe-Gateway |
| Zahlungen | WooCommerce-Zahlungsablauf | Stripe, PayPal, Mollie oder optional WooCommerce | WooCommerce als Verkaufsquelle; Auszahlungen über Zahlungsanbieter-Add-ons/Anbindungen | Keine Zahlungen in Pro v1 | Keine Zahlungsfunktion | Keine eigene Zahlungsabwicklung; nur freigegebene Aktionen | Offizielles WooCommerce-Stripe-Gateway für automatische Verlängerung; manuell weitere WooCommerce-Zahlungsarten |
| Captain-Produkte / APIs | Pass Captain für Ticketgutscheine, Gutscheinzahlung und gemeinsamen Scanner | Voucher Captain, Webhooks, iCal, Veranstalter- und Mobile-API | Versionierter öffentlicher Vertrag für Pass Captain, Voucher Captain und Connector-Add-ons | Versionierter Vertrag zu Pass, Voucher, Affiliate und Review Captain | Versionierte Ereignisse aus Voucher, Pass, Affiliate und Form Captain | Providervertrag für Core, WooCommerce und Captain Suite; keine direkten Tabellenzugriffe | API für Lizenzprüfung, Berechtigungen und Updates der Produkt-Plugins |

### Weitere Integrationen

- **Voucher Captain:** WooCommerce Subscriptions; WPML/WCML; Aelia Currency Switcher, WOOCS und CURCY; Flexible Product Fields und Flexible Checkout Fields. Yoast SEO ist optional und in der Testumgebung berücksichtigt.
- **Pass Captain:** SMS über Twilio oder einen generischen HTTP-Dienst; Webhooks, iCal, Partner-API und Mobile-API. WooCommerce bleibt optional.
- **Affiliate Captain:** versionierter öffentlicher Integrationsvertrag; kompatible Verkaufsquellen nutzen die bereitgestellten Schnittstellen statt direkt auf Plugin-Tabellen zuzugreifen.
- **License Captain:** WooCommerce-Subscriptions-Produkte dürfen laut Produktdokumentation nicht als Lizenzprodukte zugeordnet werden.
- **Form Captain:** Suite-Aktionen nutzen versionierte öffentliche Verträge. Eine Einsendung allein bestätigt keine Buchung, Zahlung, Partnerfreigabe oder öffentliche Review.
- **Review Captain:** externe Quellen werden nicht gescrapt. API-/Tarifzugang, Quellenhinweise und Anbieterbedingungen bestimmen Synchronisierung und Darstellung.
- **Workflow Captain:** Ausführung lokal in WordPress; Action Scheduler bei WooCommerce, sonst WP-Cron mit System-Cron-Empfehlung. Die genannten Mindestversionen sind keine bestätigte Testmatrix.

Drittanbieter-Zahlungsdienste benötigen ein eigenes Konto und passende Zugangsdaten.

## Supportumfang je Produkt

| Produkt | Kostenloses Kern-Plugin | Captain-Pro-Plan |
|---|---|---|
| Voucher Captain | Produktdokumentation; konkreten öffentlichen Supportkontakt vor Veröffentlichung ergänzen | Single und Business: Standard-Support. Agency: Priority-Support. |
| Pass Captain | Dokumentation und GitHub Issues; Sicherheitsmeldungen über private GitHub Security Advisories | Single und Business: Standard-Support. Agency: Priority-Support. |
| Affiliate Captain | Produktdokumentation; konkreten öffentlichen Supportkontakt vor Veröffentlichung ergänzen | Single und Business: Standard-Support. Agency: Priority-Support. |
| Form Captain | Dokumentation und veröffentlichte öffentliche Supportkanäle | Solo/Studio: Standard; Agency: priorisiert. Umfang und Kanal stehen beim Kauf. |
| Review Captain | Dokumentation und veröffentlichte öffentliche Supportkanäle | Solo/Studio: Standard; Agency: priorisiert. Umfang und Kanal stehen beim Kauf. |
| Workflow Captain | Dokumentation und veröffentlichte öffentliche Supportkanäle | Single/Business: Standard; Agency: Priority. Umfang und Kanal stehen beim Kauf. |
| License Captain | Separates Server-Plugin; Preise und Supportumfang gemäß eigenem Shopplan | Supportstufe richtet sich nach dem gewählten License-Captain-Plan. |

Die Tarife ordnen **Single (1 Live-Website)** und **Business (5 Live-Websites)** dem Standard-Support zu. **Agency (25 Live-Websites)** enthält Priority-Support. Verbindliche Reaktionszeiten und abschließende kommerzielle Supportkanäle sind in den Tarifunterlagen nicht festgelegt; deshalb werden hier keine Antwortzeitversprechen gemacht.

## Quellen in den Repositories

- [Voucher Captain: Kompatibilität](https://github.com/hastla007/wp-couponmaster/blob/claude/youthful-bardeen-7ejd7a/COMPATIBILITY.md) · [Readme](https://github.com/hastla007/wp-couponmaster/blob/main/README.md)
- [Pass Captain: Kompatibilität](https://github.com/hastla007/wp-passmaster/blob/claude/wp-plugin-analysis-todos-kvbfan/docs/COMPATIBILITY.md) · [Supportmodell](https://github.com/hastla007/wp-passmaster/blob/claude/wp-plugin-analysis-todos-kvbfan/docs/SUPPORT.md)
- [Affiliate Captain: Readme](https://github.com/hastla007/wpaffiliatemaster/blob/main/readme.txt) · [Integrationsvertrag](https://github.com/hastla007/wpaffiliatemaster/blob/main/docs/CONTRACT.md)
- [License Captain: Kompatibilität](https://github.com/hastla007/wp-license/blob/main/docs/COMPATIBILITY.md)
- [Captain Pro: Tarife](https://github.com/hastla007/captain-pro/blob/main/docs/TARIFE.md)

[Preise](/preise/) · [Integrationen im Detail](/integrationen/) · [Installationsanleitungen](/dokumentation/installation/) · [Support](/support/)
