---
url: /license-captain/features/
seo_title: License Captain: Lizenzverkauf und Updates
meta_description: Verwalten Sie WooCommerce-Lizenzen, Website-Aktivierungen, Laufzeiten, Entitlements, Kundenübersichten und Plugin-Updates.
focus_keyphrase: WordPress Lizenzverwaltung
---

# Lizenzverwaltung vom Shop bis zur Plugin-Aktualisierung

## WooCommerce als Lizenzshop

Kennzeichnen Sie Produkte oder Varianten im klassischen Produkteditor als Lizenzangebote. Legen Sie Plan, Abrechnungsintervall (monatlich oder jährlich), Limit für Live-Websites, Supportstufe und Entitlements fest. Viele Pläne pflegen Sie per CSV-Import und -Export; Produkte, Pläne und Funktionsbezeichnungen können außerdem aus einer Katalogdatei (`wplc-catalog.json`) im Release-Paket eingespielt werden. Eine Lizenz wird je gekaufter Einheit erstellt, sobald die Bestellung bezahlt ist; der Kauf setzt ein Kundenkonto voraus.

## Website-Aktivierungen

Kunden aktivieren ihre Lizenz für Live-, Staging- oder Entwicklungswebsites. Das Limit zählt Live-Websites; je Live-Website ist eine Staging-Website frei, dazu mindestens fünf lokale Entwicklungsinstallationen. Kunden sehen ihre Aktivierungen, deaktivieren Websites oder übertragen eine Aktivierung nach einem Domainumzug. Kopien einer Website erkennt der Client und schaltet Premium-Funktionen dort ab, bis die Kopie eigens aktiviert wird.

## Laufzeit, Status und Verlängerung

Lizenzen durchlaufen feste Zustände (aktiv, überfällig, gesperrt, abgelaufen, widerrufen); jede Änderung steht im Auditverlauf. Eine Erstattung widerruft die Lizenz, ein Stripe-Zahlungsstreit sperrt sie. Kunden verlängern manuell von 30 Tagen vor bis 30 Tage nach Ablauf mit demselben Schlüssel oder nutzen die optionale automatische Verlängerung über das offizielle WooCommerce-Stripe-Gateway, mit Vorabhinweis, Wiederholungsversuchen und 14 Tagen Kulanzzeit. Kunden wechseln anteilig in einen höheren Plan oder zur nächsten Verlängerung in einen günstigeren. Höhere Verlängerungspreise kündigen Sie mit Frist an.

## Signierte API und Berechtigungen

Der Client in Ihren Plugins fragt Lizenzstatus und Entitlements über die REST-API v1 ab. Anfragen werden je Installation signiert und gegen Wiederholung geschützt, Antworten mit Ed25519 signiert und an die Anfrage gebunden. Der Client prüft sie gegen den öffentlichen Schlüssel, den Sie im Plugin hinterlegen. So können Funktionen und Updatezugriff an den erworbenen Plan gebunden werden.

## Server und Client

License Captain besteht aus zwei Bausteinen:

- **Server:** das Plugin für Ihren WooCommerce-Shop. Es verkauft Lizenzen, verwaltet Aktivierungen, Laufzeiten und Berechtigungen und stellt Releases bereit.
- **Client:** eine PHP-Bibliothek, die Sie per Exportskript unter dem Namensraum Ihres Plugins in jedes Plugin einbinden, das Sie lizenzieren möchten. Sie bringt Lizenzseite, Hinweise, Funktionsfreigabe, Offline-Fenster, Updater und Deinstallation mit. Ein Vertragstest prüft Aktivierung, Statusprüfung, Updateabruf und Deaktivierung gegen Ihren Server.

Der Client wird mit Ihrem Plugin ausgeliefert; ein separates Client-Plugin gibt es nicht. Auf den Websites Ihrer Kunden setzt er WordPress 7.0+ und PHP 8.5+ voraus. Ihre Kunden installieren nichts zusätzlich: Sie geben ihren Lizenzschlüssel direkt in Ihrem Plugin ein.

## Updates und Release-Notizen

Laden Sie Release-ZIPs in einen privaten Speicher oder einen S3-kompatiblen Bucket oder registrieren Sie eine HTTPS-Paketadresse mit SHA-256-Prüfsumme; veröffentlichen und zurückziehen Sie Releases im Admin oder per WP-CLI. Lizenzierte Installationen erhalten signierte Updateinformationen und kurzlebige Einmal-Downloadlinks. Changelogs können per Shortcode oder Block in Kundenkonten oder Inhaltsseiten angezeigt werden.

## Kundenbereich und Datenschutz

Der Kundenbereich fasst Lizenzen und aktivierte Websites zusammen. Kunden laden bis zu fünf Mitbenutzer ein oder übergeben eine Lizenz an ein anderes Kundenkonto. Eine Preistabelle mit Kaufbutton binden Sie per Shortcode oder Block ein. Fünfzehn Kunden-E-Mails laufen über die WooCommerce-E-Mail-Einstellungen; der Lizenzschlüssel steht standardmäßig nicht in der E-Mail. Datenschutzexport und -löschung unterstützen die Werkzeuge Ihrer WordPress-Installation, ein täglicher Job löscht alte Daten nach den eingestellten Fristen.

## Einstellungen nach Ihren Regeln

Fristen, Grenzen und Texte stellen Sie auf der Einstellungsseite ein, ohne Code anzufassen. Jede Einstellung startet mit einer Vorgabe, die dem bisherigen Verhalten entspricht; Sie passen sie an Ihr Geschäft an.

- **Übersichtliche Reiter:** Verlängerung, Websites und Staging, Updates und Downloads, E-Mails und Texte, Recht und Datenschutz, Betrieb. Jedes Feld hat einen Hilfetext; überschreibt Code im Shop einen Wert, zeigt die Seite das an.
- **Verlängerung:** Kulanzzeit, Wiederholungsplan fehlgeschlagener Abbuchungen, Zeitfenster der manuellen Verlängerung und Erinnerungstage legen Sie selbst fest.
- **Länderprofile:** Für Deutschland, Österreich, die Schweiz, die EU allgemein und andere Länder schlägt License Captain Werte vor. Sie sehen vorher und nachher und übernehmen nur, was Sie auswählen; nichts wird still überschrieben. Die Vorschläge sind als ungeprüft gekennzeichnet und ersetzen keine Rechtsberatung.
- **Recht und Datenschutz:** Aufbewahrungsfristen je Datenart sowie Wortlaut und Pflicht der Zustimmungen zu Widerrufsverzicht und automatischer Verlängerung, je Sprache. Die Vorgaben sind Vorschläge, die Sie für Ihr Land prüfen.
- **Websites Ihrer Kunden:** Staging-Erkennung, Zahl der Staging- und Entwicklungs-Websites, Offline-Frist des Clients und neue Aktivierungen je Stunde, global oder je Tarif.
- **Downloads und Mitbenutzer:** ob nach Ablauf noch geladen werden darf, wie viele ältere Versionen wählbar sind und wie viele Mitbenutzer eine Lizenz haben darf.
- **Ihre Marke und Kommunikation:** Support-Kontakt, Installationsschritte und Dokumentationslink je Produkt, Bezeichnungen im Kundenkonto und Testversand jeder E-Mail. Gesundheitsmeldungen des Servers gehen an die Empfänger, die Sie eintragen.
- **Client in Ihrem Plugin:** Support-Link und Texte der Lizenzseite passen Sie beim Export der Bibliothek an. Erkennt der Client die Umgebung falsch, wählen Ihre Kunden bei der Aktivierung, ob es eine Live-, Staging- oder Entwicklungswebsite ist.
- **Einstellungen übertragen und sichern:** Export und Import als JSON-Datei mit Vorschau, Zugangsdaten und Schlüssel bleiben außen vor. Zurücksetzen je Bereich oder gesamt, dieselben Befehle per WP-CLI, und ein Änderungsprotokoll zeigt, wer wann welchen Wert geändert hat.
- **Rechte und Deinstallation:** Regeln, die alle Kunden-Websites betreffen, ändert nur, wer dafür berechtigt ist. Beim Entfernen des Plugins entscheiden Sie, ob die Daten bleiben (Vorgabe) oder gelöscht werden.

## Verwaltung und Betrieb

Lizenzliste mit Suche, Lizenzdetails mit Aktivierungen, Verlängerungen und Auditverlauf, Support-Aktionen wie Sperren, Widerrufen, Laufzeit ändern oder Lizenz manuell anlegen. Eigene Berechtigungen trennen Support, Katalog, Releases und Preise. Dazu kommen Diagnoseseite, WP-CLI-Befehle (auch für Schlüsselrotation) und dokumentierte Hooks für andere Plugins im Shop.

[Screenshot-Platzhalter: Kundenansicht mit Lizenzstatus, Laufzeit und Website-Aktivierungen zeigen; Lizenzschlüssel und Domains durch Testwerte ersetzen.] · [Screenshot-Platzhalter: Changelog-Block mit Produktname, Releaseversion und sichtbaren Änderungsnotizen zeigen; ausschließlich fiktive Produktdaten verwenden.]  
[Preise und Pläne](/license-captain/preise/)
