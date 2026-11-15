---
url: /kompatibilitaet/
seo_title: Systemanforderungen und Integrationen | Captain Plugins
meta_description: Vergleichen Sie WordPress-, PHP- und WooCommerce-Mindestversionen sowie Integrationen der Captain-Plugins.
focus_keyphrase: WordPress Plugin Kompatibilität
---

# Kompatibilität und Integrationen

Hier finden Sie die dokumentierten Mindestanforderungen, geprüften Plattformstände und Integrationen für Captain Plugins. Mindestversionen des Kern-Plugins und des Pro-Add-ons können voneinander abweichen. Wenn Sie Kern-Plugin und Pro-Erweiterung gemeinsam einsetzen, gilt die kombinierte Mindestversion.

## Systemanforderungen

| Produkt | WordPress | PHP | WooCommerce | Datenbank und Teststand |
|---|---:|---:|---|---|
| Voucher Captain | 6.4+ | 8.1+ mit GD, mbstring und zip | 8.9+ erforderlich | HPOS und klassische Bestellspeicherung; CI-Teststand WordPress 7.1.4, WooCommerce 11.2.2, PHP 8.4, MySQL 8.4 und MariaDB 11.4 |
| Voucher Captain Pro zusätzlich | 6.5+ | 8.1+ durch den Kern | 8.9+ erforderlich | Pro-Add-on benötigt Voucher Captain; kombinierte Installation mindestens WordPress 6.5 |
| Pass Captain | 6.4+ | 8.2+ | Optional; 8.2–11.3 freigegeben | MariaDB 10.6/11.4 oder MySQL 8.0/8.4; HPOS und klassische Speicherung geprüft |
| Pass Captain Pro zusätzlich | 6.5+ | 8.2+ durch den Kern | Optional; bei Nutzung der WooCommerce-Anbindung 8.2–11.3 | Pro-Add-on benötigt Pass Captain; kombinierte Installation mindestens WordPress 6.5 |
| Affiliate Captain | 6.3+ | 7.4+ mit sodium und dom; zip für Programmausgabe | Optional; 8.0+ und bis 11.3 geprüft | HPOS, Classic- und Blocks-Checkout; Integrationstests mit MariaDB 10.11 und MySQL 8.4 |
| Affiliate Captain Pro zusätzlich | 6.5+ | 7.4+ durch das Add-on; der Kern benötigt mindestens PHP 7.4 | Optional; 8.0+ bei WooCommerce-Nutzung | Pro-Add-on benötigt Affiliate Captain; kombinierte Installation mindestens WordPress 6.5 |
| License Captain | 6.5+ | 7.4+ | 8.9+ erforderlich | MySQL 8.0, ein beschreibbarer Primärserver und laufender Cron; HPOS und klassische Speicherung im Teststand |

**Hinweis zu getesteten Versionen:** Eine Mindestversion ist nicht automatisch identisch mit jeder getesteten Kombination. Bei License Captain ist WooCommerce 8.9 als Mindestversion deklariert; die dokumentierte CI-Matrix enthält unter anderem 9.4.3 und 11.2.2. Die Reihe 8.9.3 ist als Matrixpunkt aufgeführt, aber ihre erfolgreiche Ausführung muss für den finalen Release belegt sein. Bei der finalen Releasefreigabe werden die hier genannten Matrizen mit den tatsächlich veröffentlichten Versionen abgeglichen.

Voucher Captain wurde optional zusammen mit Yoast SEO 28.8 getestet. Yoast SEO ist für Voucher Captain nicht erforderlich.

## Integrationen je Produkt

| Produkt | Erforderlich | Optional oder verbunden |
|---|---|---|
| Voucher Captain | WooCommerce | HPOS, Blocks-Checkout, WooCommerce Subscriptions, WPML/WCML, WCML/Aelia/WOOCS/CURCY für Mehrwährung, Flexible Product Fields/Checkout Fields; Pass Captain für Gutscheinzahlung, Ticketgutscheine und gemeinsamen Scanner |
| Pass Captain | WordPress | WooCommerce-Checkout optional; Stripe, PayPal und Mollie; Voucher Captain und Affiliate Captain; SMS über Twilio oder generischen HTTP-Anbieter; iCal, Webhooks, Veranstalter- und Mobile-API; Web- und Offline-Scanner |
| Affiliate Captain | WordPress | WooCommerce optional; versionierter Integrationsvertrag für Pass Captain, Voucher Captain und weitere Verkaufsquellen; HPOS sowie Classic-/Blocks-Checkout |
| License Captain | WooCommerce | offizielles WooCommerce-Stripe-Gateway für automatische Verlängerungen; signierte REST-API, Entitlements und Updateauslieferung für Produkt-Plugins; kein WooCommerce-Subscriptions-Produkt als Lizenzprodukt verwenden |

Für Zahlungsdienste benötigen Sie ein eigenes Händlerkonto und die Zugangsdaten des jeweiligen Anbieters. Die Zuordnung optionaler Integrationen und die konkreten Funktionen je Add-on stehen auch auf den Produktseiten.

[Integrationen im Detail](/integrationen/) · [Installationsanleitungen](/dokumentation/installation/) · [Support](/support/)

## Support je Tarif

| Angebot | Supportstufe |
|---|---|
| Single · 1 Live-Website | Standard |
| Business · 5 Live-Websites | Standard |
| Agency · 25 Live-Websites | Priority |

Die Supportstufe gilt für die jeweilige Captain-Pro-Lizenz. License Captain ist im Angebot enthalten und wird nicht separat berechnet. Die Tarifunterlagen legen keine verbindlichen Antwortzeiten oder einen abschließenden Supportkanal fest; diese Angaben werden erst nach interner Festlegung veröffentlicht.

## Dokumentationsquellen

- [Voucher Captain Kompatibilität](https://github.com/hastla007/wp-couponmaster/blob/claude/youthful-bardeen-7ejd7a/COMPATIBILITY.md)
- [Pass Captain Kompatibilität](https://github.com/hastla007/wp-passmaster/blob/claude/wp-plugin-analysis-todos-kvbfan/docs/COMPATIBILITY.md) und [Supportmodell](https://github.com/hastla007/wp-passmaster/blob/claude/wp-plugin-analysis-todos-kvbfan/docs/SUPPORT.md)
- [Affiliate Captain Anforderungen](https://github.com/hastla007/wpaffiliatemaster/blob/main/README.md)
- [License Captain Kompatibilität](https://github.com/hastla007/wp-license/blob/main/docs/COMPATIBILITY.md)
- [Captain-Pro-Tarife](https://github.com/hastla007/captain-pro/blob/main/docs/TARIFE.md)