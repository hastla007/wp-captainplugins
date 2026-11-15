---
url: /dokumentation/installation/license-captain/
seo_title: License Captain installieren und konfigurieren
meta_description: Installieren Sie License Captain als WooCommerce-Lizenzserver und richten Sie Produktschlüssel, Aktivierungen, Updates und Stripe ein.
focus_keyphrase: License Captain installieren
---

# License Captain als WooCommerce-Lizenzserver einrichten

License Captain nutzt WooCommerce für den Verkauf von Softwarelizenzen und verwaltet Aktivierungen, Berechtigungen, Verlängerungen und Updates für Ihre Produkt-Plugins.

## Voraussetzungen

- WordPress 6.5 oder neuer
- Aktives WooCommerce
- PHP 7.4 oder neuer
- MySQL oder MariaDB mit beschreibbarem primärem Datenbankserver
- Zuverlässiger WordPress-Cron; für den Produktionsbetrieb wird ein System-Cron empfohlen
- Für automatische Verlängerungen: offizielles WooCommerce-Stripe-Gateway und Stripe-Konto

Richten Sie den Lizenzserver mit HTTPS ein. Erstellen Sie vor der Erstinstallation ein Backup und führen Sie die Konfiguration zuerst in einer Testumgebung durch.

## 1. Plugin und WooCommerce installieren

Installieren und aktivieren Sie WooCommerce. Installieren Sie danach das License-Captain-ZIP über **Plugins → Installieren → Plugin hochladen** und aktivieren Sie License Captain.

> **Screenshot-Platzhalter 1 – Lizenzserver aktiv:** Zeigen Sie die Pluginliste mit aktivem WooCommerce und License Captain. Website-Adresse, Adminname und andere vertrauliche Plugins ausblenden.

## 2. Stabile Schlüssel konfigurieren

Vor dem Ausstellen produktiver Lizenzen richten Sie zwei getrennte, zufällige Geheimnisse in der Serverkonfiguration ein: einen Schlüssel für Lizenzschlüssel und einen für verschlüsselte Installationsdaten. Verwenden Sie mindestens 32 zufällige Bytes pro Geheimnis. Speichern Sie die Werte in einer zugriffsgeschützten Schlüsselverwaltung und nicht im Quellcode-Repository.

Beispiel für die Konfiguration in wp-config.php:

~~~php
define( 'WPLC_LICENSE_KEY_SECRET', 'HIER_EINEN_EIGENEN_ZUFAELLIGEN_SCHLUESSEL_EINTRAGEN' );
define( 'WPLC_INSTALLATION_ENCRYPTION_KEY', 'HIER_EINEN_ANDEREN_ZUFAELLIGEN_SCHLUESSEL_EINTRAGEN' );
~~~

Die Platzhalter müssen durch unterschiedliche, zufällige Geheimnisse ersetzt werden. Veröffentlichen Sie keine Schlüssel in Screenshots, Supportanfragen oder Logs.

> **Screenshot-Platzhalter 2 – Sicherheitshinweis/Diagnose:** Zeigen Sie die License-Captain-Diagnose, in der keine Warnung zum Salt-Fallback angezeigt wird. Geheimnisse, Umgebungsvariablen und Serverpfade dürfen nicht sichtbar sein.

## 3. WooCommerce-Produkte als Lizenzen konfigurieren

Wählen Sie ein Produkt oder eine Variante und markieren Sie es als Lizenzprodukt. Definieren Sie Abrechnungsintervall, Laufzeit, Website-Limit, Supportstufe und Entitlements. Der Kauf setzt ein Kundenkonto voraus; prüfen Sie deshalb den WooCommerce-Konto- und Checkout-Ablauf.

> **Screenshot-Platzhalter 3 – Lizenzprodukt:** Zeigen Sie die Lizenzkonfiguration eines fiktiven Pluginprodukts mit Abrechnungsintervall, Limit und Berechtigungen. Keine echten Lizenzschlüssel oder Kundenbestellungen einblenden.

## 4. Verlängerungen einrichten

Manuelle Verlängerungen können über verfügbare Shop-Zahlungsarten abgewickelt werden. Für automatische Verlängerungen verbinden Sie das offizielle WooCommerce-Stripe-Gateway und aktivieren die Einwilligungsoption im Checkout.

Wenn Stripe genutzt wird, richten Sie zusätzlich den in den License-Captain-Einstellungen angezeigten Webhook-Endpunkt in Stripe ein. Der License-Captain-Webhook ist separat vom WooCommerce-Stripe-Webhook und benötigt sein eigenes Signing Secret. Die produktspezifische Dokumentation führt die benötigten Ereignisse und Konfigurationswerte auf.

> **Screenshot-Platzhalter 4 – Verlängerungs- und Webhookeinstellungen:** Zeigen Sie Testmodus, Status des Stripe-Gateways und die Stelle, an der der Webhook-Endpunkt angezeigt wird. Webhook-Signing-Secret und Live-Schlüssel vollständig verbergen.

## 5. Erstes Produkt-Plugin anbinden

Binden Sie Ihr Produkt-Plugin über die dokumentierte Client-Bibliothek und signierte API an. Konfigurieren Sie Entitlements und erlaubte Updatepakete. Erstellen Sie danach ein Testprodukt, kaufen Sie eine Lizenz im Testmodus und prüfen Sie Aktivierung, Statusanzeige und Updatezugriff.

> **Screenshot-Platzhalter 5 – Kundenkonto mit Lizenz:** Zeigen Sie eine Testlizenz mit Status, Ablaufdatum und anonymisierter Aktivierung. Lizenzschlüssel und Domain durch unbrauchbare Beispieldaten ersetzen.

## 6. Release und Betrieb vorbereiten

Laden Sie ein Releasepaket hoch oder registrieren Sie eine HTTPS-Paketadresse mit Prüfsumme. Testen Sie Download, Update, Rücknahme eines Releases und Cron-/Action-Scheduler-Verarbeitung. Richten Sie Backups und Monitoring ein.

[License Captain Features](/license-captain/features/) · [FAQ](/license-captain/faq/) · [Dokumentation](/dokumentation/)

**Kompatibilitätshinweis:** WooCommerce 8.9 ist die deklarierte Mindestversion. Die dokumentierte CI-Matrix führt außerdem WooCommerce 9.4.3 und 11.2.2 auf. Prüfen Sie vor Veröffentlichung die finale Release-Matrix. [Vollständige Kompatibilitätsmatrix](/kompatibilitaet/).