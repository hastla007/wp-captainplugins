---
url: /dokumentation/installation/pass-captain/
seo_title: Pass Captain installieren und einrichten
meta_description: Installieren Sie Pass Captain und richten Sie Events, Servicebuchungen, Zahlungswege, Tickets und Scanner ein.
focus_keyphrase: Pass Captain installieren
---

# Pass Captain installieren und den ersten Ablauf einrichten

Pass Captain verwaltet Events, Tickets, Servicebuchungen, Wartelisten und Einlass in WordPress. WooCommerce ist optional.

## Voraussetzungen

- WordPress 6.4 oder neuer
- PHP 8.2 oder neuer
- MySQL oder MariaDB in einer unterstützten Version
- WooCommerce nur, wenn Sie den WooCommerce-Checkout verwenden

Erstellen Sie vorab ein Backup. Für neue Event- und Zahlungsabläufe empfiehlt sich zunächst eine Staging-Website.

## 1. Plugin installieren

Laden Sie das Pass-Captain-Paket aus [Download-Quelle ergänzen] herunter. Gehen Sie in WordPress zu **Plugins → Installieren → Plugin hochladen**, wählen Sie die ZIP-Datei, installieren und aktivieren Sie das Plugin.

> **Screenshot-Platzhalter 1 – Pass Captain aktiv:** Zeigen Sie die Pluginverwaltung nach erfolgreicher Aktivierung. Wenn WooCommerce installiert ist, soll außerdem sichtbar sein, dass es eine optionale Integration darstellt.

## 2. Eventseite veröffentlichen

Erstellen Sie eine WordPress-Seite für Ihre Events. Fügen Sie den Pass-Captain-Eventblock ein oder nutzen Sie den Shortcode [wp_pass_captain_events]. Für einen Kalender können Sie den Kalenderblock oder [wp_pass_captain_calendar] verwenden.

> **Screenshot-Platzhalter 2 – Eventblock im Editor:** Zeigen Sie den Gutenberg-Editor mit Eventliste oder Kalender und eine Vorschau mit neutralen Beispieldaten. Keine echten Teilnehmer- oder Bestelldaten zeigen.

## 3. Event oder Serie einrichten

Legen Sie im Pass-Captain-Bereich ein Event mit Titel, Beschreibung, Ort, Zeit und Kontingent an. Für wiederkehrende Termine erstellen Sie eine Serie und hinterlegen je Termin passende Preisstufen. Bei Platzwahl können Sie einen Saalplan und Teilnehmerfelder ergänzen.

> **Screenshot-Platzhalter 3 – Eventkonfiguration:** Zeigen Sie Termin, Kontingent und Preisstufen eines Beispielseminars. Persönliche Daten und interne Veranstalterinformationen ausblenden.

## 4. Reservierung und Zahlung testen

Definieren Sie Reservierungszeit und Verkaufsregeln. Sie können kostenlose Bestellungen anbieten oder Zahlungen über Stripe, PayPal oder Mollie abwickeln. Alternativ lässt sich WooCommerce für den Checkout anbinden. Prüfen Sie im Test die Bestellbestätigung, Ticketzustellung und den Umgang mit Storno oder Erstattung.

> **Screenshot-Platzhalter 4 – Checkout und Zahlungswahl:** Zeigen Sie eine Testbuchung mit Preis und gewähltem Zahlungsweg. Keine echten Zahlungsdaten oder Transaktionskennungen einblenden.

## 5. Ticket und Einlass vorbereiten

Erstellen Sie eine Seite für den Scanner und fügen Sie den Shortcode [wp_pass_captain_scanner] ein. Weisen Sie berechtigte Mitarbeitende dem Event oder einzelnen Terminen zu. Prüfen Sie QR-/PDF-Ticket, Check-in, Check-out und Wiedereinlass. Für Offlinebetrieb richten Sie den installierbaren Offline-Scanner gemäß der technischen Dokumentation ein.

> **Screenshot-Platzhalter 5 – Scanneransicht:** Zeigen Sie einen Beispiel-QR-Code und den erfolgreichen Check-in-Status auf einem Testgerät. Der Code muss ungültig oder anonymisiert sein; keine Teilnehmerliste sichtbar lassen.

## Servicebuchungen einrichten

Für Kurse oder Verleih definieren Sie Ressourcen, Zeitfenster, Dauer, Puffer und Buchungsregeln. Testen Sie Umbuchung, Stornofrist und Warteliste mit einem ausgebuchten Beispieltermin.

> **Screenshot-Platzhalter 6 – Ressourcen und Warteliste:** Zeigen Sie eine Ressource mit Verfügbarkeit, Pufferzeit und einer anonymisierten Wartelistenposition.

[Features](/pass-captain/features/) · [Pass Captain Pro](/pass-captain/pro/) · [FAQ](/pass-captain/faq/) · [Support](/support/)