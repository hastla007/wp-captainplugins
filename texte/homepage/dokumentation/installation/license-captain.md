---
url: /dokumentation/installation/license-captain/
seo_title: License Captain installieren und konfigurieren
meta_description: Installieren Sie License Captain als WooCommerce-Lizenzserver und richten Sie Produktschlüssel, Aktivierungen, Updates und Stripe ein.
focus_keyphrase: License Captain installieren
---

# License Captain als WooCommerce-Lizenzserver einrichten

License Captain nutzt WooCommerce für den Verkauf von Softwarelizenzen und verwaltet Aktivierungen, Berechtigungen, Verlängerungen und Updates für Ihre Produkt-Plugins.

## Voraussetzungen

- WordPress 7.0 oder neuer
- Aktives WooCommerce 11.2.2 oder neuer
- PHP 8.5 oder neuer
- MySQL 9.7 (LTS) oder MariaDB 12.3 (LTS) oder neuer mit einem einzigen beschreibbaren primären Datenbankserver (die Verlängerungssperren nutzen `GET_LOCK`)
- Zuverlässiger WordPress-Cron; für den Produktionsbetrieb wird ein System-Cron empfohlen
- Für automatische Verlängerungen: offizielles WooCommerce-Stripe-Gateway und Stripe-Konto

Richten Sie den Lizenzserver mit HTTPS ein. Erstellen Sie vor der Erstinstallation ein Backup und führen Sie die Konfiguration zuerst in einer Testumgebung durch.

## 1. Plugin und WooCommerce installieren

Installieren und aktivieren Sie WooCommerce. Prüfen Sie die Prüfsumme des License-Captain-ZIPs mit der beiliegenden `.sha256`-Datei. Installieren Sie danach das ZIP über **Plugins → Installieren → Plugin hochladen** und aktivieren Sie License Captain. Die Aktivierung legt die Datenbanktabellen und geplanten Aufgaben an. Unter **WooCommerce → Lizenzeinstellungen** zeigt eine Checkliste „Erste Schritte“, was noch fehlt. In einem Multisite-Netzwerk aktivieren Sie License Captain auf der Shop-Website; jede Website arbeitet als eigener Lizenzserver.

> **Screenshot-Platzhalter 1 – Lizenzserver aktiv:** Zeigen Sie die Pluginliste mit aktivem WooCommerce und License Captain. Website-Adresse, Adminname und andere vertrauliche Plugins ausblenden.

## 2. Stabile Schlüssel konfigurieren

Vor dem Ausstellen der ersten Lizenz richten Sie in wp-config.php getrennte, zufällige Geheimnisse ein: einen Schlüsselring für Lizenzschlüssel, einen für die verschlüsselten Installationsdaten und den Ed25519-Schlüssel, mit dem der Server seine Antworten signiert. Verwenden Sie mindestens 32 zufällige Bytes pro Geheimnis (zum Beispiel aus `openssl rand -base64 48`), nicht die WordPress-Salts. Speichern Sie die Werte in einer zugriffsgeschützten Schlüsselverwaltung, nicht im Quellcode-Repository, und hinterlegen Sie sie auf jedem Webserver des Shops.

Beispiel für einen neuen Shop:

~~~php
define( 'WPLC_LICENSE_KEY_SECRETS', array(
	'2027-01' => 'HIER_EINEN_EIGENEN_ZUFAELLIGEN_SCHLUESSEL_EINTRAGEN',
) );
define( 'WPLC_LICENSE_KEY_ID', '2027-01' );

define( 'WPLC_INSTALLATION_ENCRYPTION_KEYS', array(
	'2027-01' => 'HIER_EINEN_ANDEREN_ZUFAELLIGEN_SCHLUESSEL_EINTRAGEN',
) );
define( 'WPLC_INSTALLATION_ENCRYPTION_KEY_ID', '2027-01' );

define( 'WPLC_RESPONSE_SIGNING_KEY', 'AUSGABE_VON_wp_wplc_signing-key_--generate' );
~~~

Den Wert für `WPLC_RESPONSE_SIGNING_KEY` erzeugt `wp wplc signing-key --generate`. Die Schlüsselringe (Arrays) erlauben eine spätere Rotation, ohne ausgegebene Schlüssel oder aktivierte Websites ungültig zu machen; entfernen oder umbenennen Sie keinen Eintrag, solange Lizenzen oder Installationen ihn nutzen. Die Platzhalter müssen durch unterschiedliche, zufällige Geheimnisse ersetzt werden. Veröffentlichen Sie keine Schlüssel in Screenshots, Supportanfragen oder Logs.

Ohne diese Konstanten leitet License Captain die Schlüssel aus den WordPress-Salts ab und zeigt eine dauerhafte Warnung. Ändern sich die Salts, können ausgegebene Schlüssel nicht mehr angezeigt werden und alle aktivierten Websites müssen neu aktiviert werden.

> **Screenshot-Platzhalter 2 – Sicherheitshinweis/Diagnose:** Zeigen Sie die License-Captain-Diagnose, in der keine Warnung zum Salt-Fallback angezeigt wird. Geheimnisse, Umgebungsvariablen und Serverpfade dürfen nicht sichtbar sein.

## 3. WooCommerce-Produkte als Lizenzen konfigurieren

Wählen Sie im klassischen Produkteditor ein Produkt oder eine Variante und markieren Sie es als Lizenzprodukt. Definieren Sie Abrechnungsintervall (monatlich oder jährlich), Limit für Live-Websites, Supportstufe und Entitlements. Viele Pläne lassen sich per CSV importieren; alternativ liefern Sie eine Katalogdatei `wplc-catalog.json` im Release-Paket mit. Produkte von WooCommerce Subscriptions können nicht als Lizenzprodukte zugeordnet werden. Der Kauf setzt ein Kundenkonto voraus; prüfen Sie deshalb den WooCommerce-Konto- und Checkout-Ablauf.

> **Screenshot-Platzhalter 3 – Lizenzprodukt:** Zeigen Sie die Lizenzkonfiguration eines fiktiven Pluginprodukts mit Abrechnungsintervall, Limit und Berechtigungen. Keine echten Lizenzschlüssel oder Kundenbestellungen einblenden.

## 4. Verlängerungen einrichten

Manuelle Verlängerungen können über verfügbare Shop-Zahlungsarten abgewickelt werden. Für automatische Verlängerungen verbinden Sie das offizielle WooCommerce-Stripe-Gateway und aktivieren die Einwilligungsoption im Checkout.

Wenn Stripe genutzt wird, richten Sie zusätzlich den unter **WooCommerce → Lizenzeinstellungen** angezeigten Webhook-Endpunkt in Stripe ein. Der License-Captain-Webhook ist separat vom WooCommerce-Stripe-Webhook und benötigt sein eigenes Signing Secret, das Sie als `WPLC_STRIPE_WEBHOOK_SECRET` (für den Testmodus optional `WPLC_STRIPE_WEBHOOK_SECRET_TEST`) in wp-config.php eintragen. Die produktspezifische Dokumentation führt die benötigten Ereignisse auf. Auf einer Staging-Kopie mit `WP_ENVIRONMENT_TYPE` = `staging` pausiert License Captain Abbuchungen automatisch.

> **Screenshot-Platzhalter 4 – Verlängerungs- und Webhookeinstellungen:** Zeigen Sie Testmodus, Status des Stripe-Gateways und die Stelle, an der der Webhook-Endpunkt angezeigt wird. Webhook-Signing-Secret und Live-Schlüssel vollständig verbergen.

## 5. Erstes Produkt-Plugin anbinden

Binden Sie den License-Captain-Client in jedes Plugin ein, das Sie lizenzieren möchten, und liefern Sie ihn mit dem Plugin aus. Kopieren Sie die Client-Bibliothek mit dem mitgelieferten Exportskript unter dem Namensraum Ihres Plugins. Hinterlegen Sie im Client die HTTPS-Adresse Ihres Lizenzservers, den Produktschlüssel aus Ihrem Katalog und den öffentlichen Signaturschlüssel des Servers (Ausgabe von `wp wplc signing-key --field=public_key`) laut Client-Dokumentation. Der mitgelieferte Vertragstest prüft Aktivierung, Statusprüfung, Updateabruf und Deaktivierung gegen Ihren Server. Ihre Kunden aktivieren ihren Lizenzschlüssel anschließend direkt in Ihrem Plugin. Konfigurieren Sie Entitlements und erlaubte Updatepakete. Erstellen Sie danach ein Testprodukt, kaufen Sie eine Lizenz im Testmodus und prüfen Sie Aktivierung, Statusanzeige und Updatezugriff.

> **Screenshot-Platzhalter 5 – Kundenkonto mit Lizenz:** Zeigen Sie eine Testlizenz mit Status, Ablaufdatum und anonymisierter Aktivierung. Lizenzschlüssel und Domain durch unbrauchbare Beispieldaten ersetzen.

## 6. Release und Betrieb vorbereiten

Laden Sie ein Releasepaket hoch oder registrieren Sie eine HTTPS-Paketadresse mit Prüfsumme. Für hochgeladene Pakete empfiehlt sich ein Verzeichnis außerhalb des Web-Roots (`WPLC_PACKAGE_STORAGE_DIR`) oder ein privater S3-kompatibler Bucket. Nehmen Sie die API- und Kontoseiten von Seiten- und CDN-Caches aus. Testen Sie Download, Update, Rücknahme eines Releases und Cron-/Action-Scheduler-Verarbeitung. Richten Sie Backups und Monitoring ein.

[License Captain Features](/license-captain/features/) · [FAQ](/license-captain/faq/) · [Dokumentation](/dokumentation/)

**Kompatibilitätshinweis:** WordPress 7.0 und WooCommerce 11.2.2 sind die Mindestversionen. Getestet werden WordPress 7.0 mit WooCommerce 11.2.2 sowie die aktuelle WordPress-Version mit WooCommerce 11.3.0, jeweils auf PHP 8.5 mit MySQL 9.7 und MariaDB 12.3, mit HPOS und klassischer Bestellspeicherung sowie in einem Multisite-Netzwerk. [Vollständige Kompatibilitätsmatrix](/kompatibilitaet/).
