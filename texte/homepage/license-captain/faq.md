---
url: /license-captain/faq/
seo_title: License Captain FAQ – WordPress-Lizenzen und Updates
meta_description: Antworten zu License Captain: Lizenzserver für WooCommerce und Client für Ihre WordPress-Plugins.
focus_keyphrase: WordPress Lizenzmanager FAQ
---

# Fragen zu License Captain

## Was ist in License Captain enthalten?
Server und Client. Der Server läuft als Plugin in Ihrem WooCommerce-Shop, der Client wird in Ihre eigenen Plugins eingebunden. License Captain richtet sich an Unternehmen, die eigene Plugins oder Softwareprodukte lizenzieren und Updates bereitstellen möchten.

## Benötige ich WooCommerce?
Für den Server ja: WooCommerce dient als Shop für Lizenzprodukte und Bestellungen. Der Server setzt WooCommerce 11.2.2 oder neuer voraus. Die Websites Ihrer Kunden brauchen kein WooCommerce – dort läuft nur Ihr Plugin mit dem eingebundenen Client (WordPress 7.0+, PHP 8.5+).

## Wie wird eine Lizenz erstellt?
Nach erfolgreicher Zahlung erhält jede gekaufte Produkteinheit eine Lizenz mit dem im Produktplan festgelegten Abrechnungsintervall, Website-Limit und den Berechtigungen. Der Kauf setzt ein Kundenkonto voraus.

## Kann ich eine Website wechseln?
Ja. Kunden deaktivieren nicht mehr benötigte Websites im Kundenkonto und geben damit einen Platz frei; nach einem Domainumzug überträgt der Client die Aktivierung auf die neue Adresse. Das Limit zählt Live-Websites; je Live-Website ist eine Staging-Website frei, dazu kommen mindestens fünf lokale Entwicklungsinstallationen.

## Sind automatische Verlängerungen verfügbar?
Ja. Kunden können manuell mit jeder Shop-Zahlungsart verlängern oder im Checkout die automatische Verlängerung über das offizielle WooCommerce-Stripe-Gateway wählen. Vor jeder Abbuchung erhalten sie einen Hinweis. Eine automatische Verlängerung über PayPal wird nicht angeboten; PayPal-Kunden verlängern manuell.

## Wie erhalten meine Plugins Updates?
Sie laden Releases im Shop hoch oder registrieren eine HTTPS-Paketadresse mit Prüfsumme. Der Client in Ihrem Plugin fragt über die signierte API nach Updates und bindet sie in die normale WordPress-Updateanzeige ein; lizenzierte Installationen erhalten kurzlebige Einmal-Downloadlinks.

## Müssen meine Kunden ein zusätzliches Plugin installieren?
Nein. Der License-Captain-Client wird mit Ihrem Plugin ausgeliefert. Ihre Kunden geben ihren Lizenzschlüssel direkt in Ihrem Plugin ein.

## Kann ich Release-Notizen anzeigen?
Ja. Produkt-Changelogs können über den Shortcode `[wplc_changelog]` oder den Block „Änderungsprotokoll“ ausgegeben werden. Für Lizenzliste und Preistabelle gibt es ebenfalls Shortcode und Block.

## Funktioniert License Captain mit WooCommerce Subscriptions?
License Captain verlängert Lizenzen selbst. Produkte von WooCommerce Subscriptions lassen sich nicht als Lizenzprodukte zuordnen.

## Läuft der Server in einem Multisite-Netzwerk?
Ja, jede Website des Netzwerks ist dabei ein eigener, unabhängiger Lizenzserver mit eigenen Lizenzen, Releases und API-Endpunkten. Vorgesehen ist der Betrieb auf der einen Shop-Website.

[Features ansehen](/license-captain/features/) · [Preise und Pläne](/license-captain/preise/) · [Support](/support/)
