---
url: /course-captain/kompatibilitaet/
seo_title: Course Captain Kompatibilität: WordPress, PHP, Datenbank
meta_description: Voraussetzungen von Course Captain: WordPress 7.0+, PHP 8.5+, MySQL 9.7 oder MariaDB 12.3, optionales WooCommerce, Themes, Editoren und Teststatus.
focus_keyphrase: Course Captain Kompatibilität
---

# Course Captain: Kompatibilität und Voraussetzungen

Course Captain ist ein eigenständiges WordPress-Plugin. Für Kursaufbau, Lernen und Prüfen genügt WordPress; WooCommerce und weitere Captain-Plugins sind optional.

## Kompatibilitätsübersicht

| System | Verwendung | Voraussetzung |
|---|---|---|
| WordPress | Kurse, Lernraum, Blöcke, REST-API, Datenschutzwerkzeuge | Version 7.0 oder neuer |
| PHP | Ausführung von Kern und Pro-Add-on | Version 8.5 oder neuer |
| Datenbank | Fragen, Fortschritt, Prüfungen und Nachweise | MySQL 9.7 (LTS) oder MariaDB 12.3 (LTS) oder neuer; ältere Versionen ab MariaDB 10.6 / MySQL 8.0 erzeugen eine Warnung im Systemstatus, keine Sperre; InnoDB und JSON-Funktionen erforderlich |
| Block-Editor | Lektionen, Kurskatalog- und Lernraum-Blöcke | WordPress-Block-Editor; Shortcodes als Fallback |
| Klassischer Editor | Einbindung von Katalog und Lernraum | Shortcodes |
| WooCommerce | Kursverkauf mit Course Captain Pro | Optional, Version 11.2.2 oder neuer; HPOS sowie klassischer und Block-Checkout werden für die Freigabe geprüft |
| E-Mail-Versand | Einladungen, Benachrichtigungen | Funktionierender WordPress-Mailversand oder SMTP-Plugin |
| Captain-Suite-Plugins | Gutscheine, Termine, Formulare, Bewertungen, Provisionen, Automationen | Jeweils kompatible Version mit verfügbarem Integrationsvertrag |
| Multisite | Netzwerkweite Installation | Nur Aktivierung je Website; Netzwerkaktivierung gesperrt; netzwerkweiter Betrieb in Version 1.0 nicht zugesagt |

## Themes und Darstellung

Course Captain übernimmt die Gestaltung des aktiven Themes und kapselt eigene Styles für den Lernraum. Kurskatalog und Lernraum funktionieren in Block-Themes und klassischen Themes. Ohne JavaScript bleibt ein verständlicher Fallback erhalten.

## Datenschutz und externe Dienste

Lernstände, Ergebnisse und Nachweise liegen in der WordPress-Datenbank. Course Captain benötigt keinen externen LMS- oder Cloud-Dienst. Eingebettete Videos von Drittanbietern unterliegen deren Bedingungen und sind in der Datenschutzerklärung aufzuführen. Pro sendet für die Lizenzprüfung keine Kurs-, Prüfungs- oder Teilnehmerdaten.

## Versions- und Teststatus

Die genannten Versionen sind die Mindestanforderungen für Version 1.0. Getestete WordPress-, WooCommerce- und Plugin-Kombinationen werden mit jedem Release in der [Kompatibilitätsmatrix](/kompatibilitaet/) und im Changelog veröffentlicht. Eine Mindestversion bedeutet nicht automatisch, dass jede Kombination getestet ist.

[Installation](/course-captain/installation/) · [Integrationen](/course-captain/integrationen/) · [Häufige Fragen](/course-captain/faq/)
