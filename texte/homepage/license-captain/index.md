---
url: /license-captain/
seo_title: WordPress-Plugin-Lizenzen und Updates mit License Captain
meta_description: Verkaufen Sie Plugin-Lizenzen über WooCommerce und verwalten Sie Aktivierungen, Verlängerungen, Berechtigungen und Updates zentral.
focus_keyphrase: WordPress Lizenzmanager Plugin
---

# Lizenzen und Updates für Ihre WordPress-Plugins verwalten

License Captain unterstützt Softwareteams, Agenturen und Plugin-Hersteller beim Verkauf und Betrieb eigener WordPress-Produkte. Sie erhalten zwei aufeinander abgestimmte Bausteine: den **Server** für Ihren WooCommerce-Shop und den **Client**, den Sie in Ihre Plugins einbinden. So verwalten Sie Aktivierungen, Laufzeiten, Verlängerungen und Updates zentral.

**[License Captain entdecken](/license-captain/features/)** · [Preise und Pläne](/license-captain/preise/)

## Lizenzserver mit Ihren Produkt-Plugins verbinden

Ordnen Sie WooCommerce-Produkten oder Varianten Lizenzpläne mit monatlichem oder jährlichem Abrechnungsintervall, Limit für Live-Websites, Supportstufe und Berechtigungen zu. Nach dem Kauf erhält jede erworbene Einheit eine Lizenz. Der License-Captain-Client in Ihrem Plugin prüft über eine REST-API, welche Berechtigungen und Updates verfügbar sind: Anfragen werden je Installation signiert, Antworten des Servers mit Ed25519 signiert und vom Client gegen den im Plugin hinterlegten öffentlichen Schlüssel geprüft. Ihre Kunden aktivieren den Lizenzschlüssel direkt in Ihrem Plugin – sie brauchen dafür nichts zusätzlich zu installieren.

## Aktivierungen und Verlängerungen im Blick

Das Website-Limit zählt Live-Websites. Zu jeder Live-Website gehört eine kostenlose Staging-Website, zusätzlich erlaubt jede Lizenz mindestens fünf lokale Entwicklungsinstallationen. Statusänderungen landen im Auditverlauf. Kunden verlängern manuell mit jeder Shop-Zahlungsart oder wählen im Checkout die automatische Verlängerung über das offizielle WooCommerce-Stripe-Gateway, mit Vorabhinweis vor jeder Abbuchung, Wiederholungsversuchen und 14 Tagen Kulanzzeit. Diese Fristen sind Vorgaben: Kulanzzeit, Wiederholungsplan und weitere Regeln passen Sie in den Einstellungen an Ihr Geschäft an, auf Wunsch mit Vorschlägen aus einem Länderprofil.

## Eine bessere Übersicht für Ihre Kunden

Unter **Mein Konto → Lizenzen** sehen Kunden Schlüssel, Status, Plan, Laufzeit und aktivierte Websites. Sie deaktivieren Websites, verlängern, kündigen oder setzen die automatische Verlängerung fort, wechseln den Plan, laden das aktuelle Release herunter, laden Mitbenutzer ein oder übergeben eine Lizenz an ein anderes Kundenkonto. Lizenzliste, Produkt-Changelog und Preistabelle lassen sich zusätzlich als Shortcode oder Block auf beliebigen Seiten einbinden.

## Server und Client aus einer Hand

Der **License-Captain-Server** läuft als Plugin in Ihrem WooCommerce-Shop: Er erstellt Lizenzen beim Kauf, verwaltet Aktivierungen und stellt Updates bereit. Der **License-Captain-Client** ist eine PHP-Bibliothek, die Sie per Exportskript unter dem Namensraum Ihres Plugins einbinden und mit Ihrem Plugin ausliefern; ein separates Client-Plugin gibt es nicht. Beide Bausteine sind Teil des License-Captain-Angebots.

[Screenshot-Platzhalter: Lizenzübersicht mit Status, Website-Limit, aktiven Installationen und Updatezugriff zeigen; Schlüssel, E-Mail-Adressen und Domains anonymisieren.]  
[Diagramm: Kauf, Lizenz, Aktivierung und Update]

[Features](/license-captain/features/) · [Preise und Pläne](/license-captain/preise/) · [FAQ](/license-captain/faq/)

## Kompatibilität

Der License-Captain-Server benötigt WordPress 7.0+, PHP 8.5+ und aktives WooCommerce ab Version 11.2.2. Der Betrieb setzt MySQL 9.7 oder MariaDB 12.3 (oder neuer) mit einem einzigen beschreibbaren Primärserver voraus, weil die Verlängerungssperren MySQL-`GET_LOCK` nutzen, außerdem HTTPS und einen zuverlässigen Cron. HPOS und klassische Bestellspeicherung werden unterstützt. In einem Multisite-Netzwerk arbeitet jede Website als eigener, unabhängiger Lizenzserver; vorgesehen ist der Betrieb auf der einen Shop-Website. Für automatische Verlängerungen ist das offizielle WooCommerce-Stripe-Gateway erforderlich. Websites Ihrer Kunden, auf denen Ihr Plugin mit dem Client läuft, benötigen WordPress 7.0+ und PHP 8.5+, aber kein WooCommerce.

[Kompatibilitätsmatrix und geprüfte Plattformstände](/kompatibilitaet/).
