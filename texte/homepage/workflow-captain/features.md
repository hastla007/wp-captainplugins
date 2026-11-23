---
url: /workflow-captain/features/
seo_title: Workflow Captain Features: Automationen für WordPress
meta_description: Entdecken Sie den visuellen Editor, WordPress- und WooCommerce-Auslöser, Captain-Suite-Provider, Webhooks, Protokolle und sichere Wiederholungen.
focus_keyphrase: WordPress Workflow Plugin Funktionen
---

# Workflow Captain Features: Abläufe visuell verbinden

Workflow Captain bündelt Ereignisse, Bedingungen und Aktionen in nachvollziehbaren Workflows. Der kostenlose Kern deckt WordPress und WooCommerce ab. Workflow Captain Pro ergänzt die Captain Suite, externe Webhook- und n8n-Verbindungen, eigene Connectoren, netzwerkweite Multisite-Workflows sowie erweiterte Logik und Protokolle.

## Im kostenlosen Kern

- Unbegrenzte Workflows und Ausführungen – keine Task-Credits oder externen Konten.
- Visueller Editor mit Auslöser, Wenn/Sonst-Bedingungen, Wartezeiten, Aktionen und Ende; per Tastatur bedienbar und mit Listenansicht. Jeder Workflow hat genau einen Auslöser.
- Bedingungen mit UND/ODER und einer Gruppenebene (bis 20 Regeln) auf Werten aus dem jeweiligen Ereignis.
- WordPress-Auslöser: Benutzer registriert, Beitrag veröffentlicht (öffentliche Inhaltstypen).
- WooCommerce-Auslöser (optional, ab WooCommerce 11.2.2, HPOS und klassische Bestelltabellen): Bestellung angelegt, bezahlt, Statuswechsel, erstattet, storniert.
- Zeitpläne als Auslöser: täglich, wöchentlich oder monatlich in der Zeitzone der Website.
- Aktionen: Nachricht an Betreiber, Nachricht an einen Benutzer, Markierung setzen oder entfernen, Notiz anlegen – mit Platzhaltern aus dem Ereignis. Markierungen und Notizen speichert Workflow Captain selbst; Bestellungen und Inhalte werden nicht verändert.
- Testlauf mit Beispieldaten ohne Seiteneffekte, Entwurf und Veröffentlichen mit unveränderlichen Versionen, Duplizieren, Archivieren, Export und Import als JSON, Vorlagen.
- Zuverlässige Ausführung: Erkennung doppelter Ereignisse, Wiederholung nach einstellbarem Plan, fehlgeschlagene Ereignisse gezielt erneut einreihen, Schleifenschutz, Parallelitätsgrenzen, Notfallpause und „Läufe nacheinander“ je Objekt oder Benutzer.
- Laufansicht mit Schritten und redigierten Daten; erledigte Läufe werden ab Werk nach 30 Tagen gelöscht, fehlgeschlagene Ereignisse nach 90 Tagen; beide Fristen lassen sich zwischen 1 und 180 Tagen einstellen.
- Eigene Rechte für Bearbeiten, Veröffentlichen, Protokolle und Wiederholen, Protokoll der Eingriffe, Website-Zustand, Diagnose-Download und WP-CLI-Befehle.
- Entwicklerschnittstelle für Adapter und eingehende Auslöser von Add-ons mit dokumentiertem Vertrag.

## Einstellungen und Betrieb

Alle folgenden Einstellungen sind im kostenlosen Kern enthalten.

- **Länderprofile** für Deutschland, Österreich, die Schweiz, die EU allgemein und andere Länder: Ein Profil schlägt passende Werte vor, zeigt Vorher und Nachher und überschreibt nichts ohne Ihre Bestätigung. Alle Werte bleiben danach frei änderbar.
- **Art der Nachricht:** Jede Nachricht an Kunden ist als Vertragsabwicklung oder Werbung gekennzeichnet. Werbung geht ab Werk nur an Empfänger mit erfasster Einwilligung und enthält einen Abmeldelink; abgemeldete Adressen landen auf einer Sperrliste.
- **Ruhezeit und Sendetage** für die ganze Website sowie eine Höchstzahl an Nachrichten je Empfänger und Tag; Nachrichten außerhalb des Fensters warten bis zum nächsten Sendebeginn.
- **Absender, Antwortadresse und Fußzeile** mit Platzhaltern für Ihre Impressums- und Datenschutzseite.
- **Geschäftsregeln statt fester Werte:** Anzahl der Wiederholungen, Schleifentiefe, Aufbewahrungsfristen und die Empfänger von Betreiber-Nachrichten nach Rollen stellen Sie selbst ein.
- **Testmodus** für die ganze Website: alle Nachrichten an eine Testadresse umleiten oder nur protokollieren, ohne etwas auszuführen.
- **Export und Import der Einstellungen** als JSON-Datei mit Vorschau der Unterschiede; Zugangsdaten und Schlüssel werden nie exportiert.
- **Zurücksetzen** je Reiter oder insgesamt, mit Rückgängig-Funktion.
- **Änderungsprotokoll** mit Zeitpunkt, Person sowie altem und neuem Wert; Einstellungen lassen sich auch per WP-CLI lesen, setzen, exportieren und zurücksetzen.
- **Deinstallation mit Wahl:** Beim Löschen des Plugins bleiben Ihre Daten ab Werk erhalten; vollständiges Entfernen nur nach ausdrücklicher Bestätigung.

Profilwerte und Vorgaben mit rechtlichem Bezug sind Vorschläge und ersetzen keine Rechtsberatung; prüfen Sie Texte und Einstellungen für Ihren Einsatz. Hinweise auf Pro-Einstellungen erscheinen im Kern nur als dezente Zeile am Ende eines Reiters und sind ausblendbar.

## Zusätzliche Funktionen in Workflow Captain Pro

- Provider für Pass Captain, Voucher Captain, Affiliate Captain, Form Captain und Review Captain; jeweils mit dem Plugin und dessen lizenziertem Pro-Add-on.
- Die Gutschein-Aktionen von Voucher Captain als Workflow-Schritte: ausstellen, sperren, reaktivieren und einlösen – mit den Grenzen und Berechtigungen des Voucher-Kerns.
- Eigene Connectoren: separate Connector-Plugins nach öffentlichem, versioniertem Vertrag, mit Starter-Beispiel; jeder Connector wird vom Betreiber freigegeben.
- Signierte ein- und ausgehende Webhooks und n8n-Verbindungen mit Replay-Schutz, Rate-Limit und Zustellstatus.
- Netzwerkweite Workflows in Multisite: Ein Ereignis einer Website startet Schritte auf freigegebenen Ziel-Websites desselben Netzwerks.
- Event-Korrelation über mehrere Ereignisse und Freigabeschritte.
- Abbruch geplanter Abläufe bei Refund, Storno, Widerruf oder Opt-out.
- Rezeptvorlagen für die Captain Suite.
- Protokollaufbewahrung über die freien 180 Tage hinaus, CSV-Protokollexport und ein längeres Änderungsprotokoll.
- Sendefenster und Ruhezeiten je Workflow, Feiertagskalender und Höchstzahlen je Empfänger für einzelne Workflows.

## Klare Zuständigkeiten

Workflow Captain orchestriert Abläufe. WooCommerce und die Captain-Plugins bleiben Eigentümer ihrer Bestellungen, Tickets, Gutscheine, Partner, Formulare, Reviews und Lizenzen. Aktionen laufen über dokumentierte Serviceverträge; direkte Tabellenzugriffe, beliebiger PHP-/SQL-Code und unkontrollierte Änderungen sind nicht Bestandteil des Produkts.

Jeder Suite-Provider benötigt das jeweilige Plugin mit kompatiblem Vertrag. Erstattungen, Stornierungen, Einlass, Provisionen, Auszahlungen, Partnerstatus und Lizenzänderungen löst ein Workflow nicht aus; sie bleiben bei den zuständigen Fachplugins. Die Mails der Kern-Plugins bleiben unverändert – ein Workflow verschickt nur zusätzliche Nachrichten.

[Workflow Captain Pro ansehen](/workflow-captain/pro/) · [Integrationen](/workflow-captain/integrationen/) · [FAQ](/workflow-captain/faq/)

[Screenshot-Platzhalter: Featureübersicht mit dem visuellen Editor, Provider-Auswahl und redigierter Run-Detailansicht zeigen. Pro-Funktionen eindeutig als Pro markieren; keine UI als fertigen Produkt-Screenshot ausgeben, bevor ein echter Release-Build aufgenommen wurde.]
