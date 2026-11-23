---
url: /form-captain/features/
seo_title: Form Captain Features: Formulare und Einsendungen
meta_description: Erstellen Sie WordPress-Formulare mit Vorlagen, Validierung, E-Mail-Benachrichtigungen, sicher gespeicherten Einträgen, CSV-Export und Spamschutz.
focus_keyphrase: WordPress Formular Features
---

# Form Captain Features: Erstellen, veröffentlichen, bearbeiten

Form Captain unterstützt den gesamten Basisablauf vom Formularentwurf bis zur bearbeiteten Anfrage. Der kostenlose Kern ist für alltägliche Formulare ausgelegt; Pro ergänzt komplexere Workflows.

## Formulare visuell zusammenstellen

Starten Sie mit den drei Vorlagen Kontakt, Angebotsanfrage und Support. Für weitere Einsatzbereiche erstellen Sie eigene Formulare unter **Form Captain → Formulare** im visuellen Editor mit Feldpalette, Reihenfolge per Ziehen oder Tastatur, Feldeinstellungen, Vorschau (Desktop/Mobil) und Speichern. Zu den Feldern zählen einzeiliger Text, Absatz, E-Mail, Telefon, Zahl, Auswahlliste (optional mit Mehrfachauswahl), Checkboxen, Optionsfelder, Datum, Überschrift/HTML-Hinweis, versteckte Werte und Einwilligung. Felder lassen sich als „sensibel“ markieren; sie erscheinen dann standardmäßig weder in E-Mails noch in Integrationen.

Formulare durchlaufen die Status Entwurf, veröffentlicht, pausiert und archiviert. Jede Veröffentlichung erzeugt eine feste Version, sodass ältere Einträge mit ihren ursprünglichen Feldern lesbar bleiben. Formulare lassen sich als JSON exportieren und importieren; Einträge sind darin nie enthalten.

## Validierung und barrierearme Einbettung

Serverseitige Validierung prüft Pflichtfelder und Werte. Einfache bedingte Feldanzeige (eine Regel je Feld, z. B. „anzeigen, wenn Feld X gleich Y“) passt das Formular an Antworten an. Der Block „Form Captain“ und der Shortcode `[form_captain id="…"]` ermöglichen die Einbettung in WordPress-Seiten. Formulare funktionieren auch ohne JavaScript und sind für Seiten-Caches geeignet. Responsives, barrierearmes Markup mit sichtbaren Labels und verknüpften Fehlermeldungen orientiert sich an den Theme-Farben und lädt keine externen Skripte oder Fonts.

## E-Mail-Benachrichtigungen und Bestätigung

Konfigurieren Sie Empfängeradresse, Antwortadresse, Betreff mit Platzhaltern und Feldauswahl für Admin-Nachrichten. Eine Bestätigung an die absendende Person kann optional aktiviert werden. Nach dem Absenden zeigt das Formular eine Meldung oder leitet auf eine Seite Ihrer Website weiter. E-Mails werden nach dem Speichern über eine Warteschlange versendet und bei Fehlern bis zu achtmal wiederholt. Form Captain weist auf Absender- und Zustellungsprobleme hin und bietet eine Testmail; für zuverlässigen Versand kann ein SMTP-Dienst erforderlich sein.

## Einträge direkt im WordPress-Admin

Einsendungen werden persistent in eigenen Tabellen gespeichert. Suche, Filter, Status (neu, gelesen, archiviert, Spam), Sammelaktionen, Detailansicht mit Versandstatus, interne Notizen, Papierkorb und CSV-Export mit Spaltenauswahl unterstützen die tägliche Bearbeitung. Eine Rollen- und Rechte-Matrix legt fest, wer Formulare verwaltet, Einträge liest, bearbeitet, exportiert oder löscht. IP-Adressen werden nicht gespeichert.

Bestehende Formulare aus einem verbreiteten Shortcode-Formularformat übernehmen Sie mit Vorschau und Konvertierungsbericht als Entwurf. Alt-Einträge importieren Sie aus einer CSV-Datei mit Spaltenzuordnung, Trockenlauf und der Möglichkeit, einen Import innerhalb von 7 Tagen rückgängig zu machen.

## Spamschutz und Datenschutzwerkzeuge

Honeypot, Mindest-Ausfüllzeit, Rate-Limit und eine einfache Blockliste für Begriffe und E-Mail-Domains bilden den Basisspamschutz ohne Drittanbieter. Externe Captcha-Anbieter lassen sich über Erweiterungen ergänzen und müssen nach Anzeige von Anbieter und Datenfluss bewusst aktiviert werden. Datenexport, Löschung, frei einstellbare Aufbewahrungsfristen, Einwilligungsnachweis und -widerruf sowie die WordPress-Privacy-Werkzeuge unterstützen den verantwortungsvollen Umgang mit Formulardaten.

Systemstatus, Website-Zustand und WP-CLI-Befehle (`wp form-captain`) zeigen Warteschlange, Mailfehler und Cron-Status, ohne Formularinhalte preiszugeben.

## Einstellungen und Anpassung an Ihr Land

Form Captain lässt sich an Ihre Abläufe und die Gepflogenheiten Ihres Landes anpassen. Alle folgenden Einstellungen sind im kostenlosen Kern enthalten; Vorgaben ab Werk ändern bestehendes Verhalten nicht.

- **Länderprofile als Vorschlag:** Für Deutschland, Österreich, die Schweiz, die EU allgemein und „International“ schlägt Form Captain passende Werte vor, etwa Aufbewahrung, Papierkorb-Frist, CSV-Trennzeichen sowie Postleitzahl- und Telefonformat für neue Felder. Sie sehen jeden Wert vorher und nachher und übernehmen nur, was Sie auswählen; nichts wird still überschrieben. Werte mit rechtlicher Bedeutung sind als ungeprüft gekennzeichnet – Einwilligungs- und Aufbewahrungswerte prüfen Sie als Betreiber selbst.
- **Aufbewahrung frei wählbar:** Fristen in Tagen, Monaten oder Jahren oder manuelles Löschen, global und je Formular, dazu einstellbare Schonfrist und Vorwarnung vor dem Löschen.
- **Eingabeformate je Land:** Postleitzahl-Muster für Deutschland, Österreich, die Schweiz oder allgemein, Telefonnummern wahlweise international mit „+“ und eine Mindestalter-Prüfung am Datumsfeld.
- **Eigene Texte je Formular:** Schaltflächentext, Pflichtfeld-Hinweis und Fehlermeldungen passen Sie je Formular an. Die Bestätigungsmail geht in der Sprache der Seite hinaus, auf der das Formular stand.
- **E-Mails mit Ihrem Auftritt:** Logo, Fußzeile etwa für Ihre Firmenangaben, feste Antwortadresse, Format je Formular und ein Test-Versand der echten Bestätigungsmail mit Beispielwerten.
- **Double-Opt-in je Formular:** Auf Wunsch bestätigt die absendende Person ihre E-Mail-Adresse über einen Link, bevor Aktionen laufen. Gültigkeit des Links und Löschung unbestätigter Einsendungen stellen Sie ein.
- **Grenzen und Vorgangsnummer:** Formulare öffnen und schließen zu einem Zeitpunkt oder nach einer Höchstzahl an Einsendungen. Eine Vorgangsnummer mit eigenem Präfix und optionalem Jahresneustart steht als Platzhalter in E-Mails bereit.
- **Spamschutz nach Bedarf:** Ein eingebauter Schutz lässt den Browser eine kleine Rechenaufgabe lösen – ohne externen Dienst. Sendegrenzen sind einstellbar, dieser Schutz lässt sich je Formular verschärfen oder abschalten, und hinter Diensten wie Cloudflare wählen Sie die richtige Quelle der Besucheradresse.
- **Einstellungen übertragen und nachvollziehen:** Export und Import als JSON-Datei mit Vorschau, ohne Zugangsdaten. Dazu Zurücksetzen je Bereich, ein Änderungsprotokoll (wer hat wann was von welchem auf welchen Wert geändert), WP-CLI-Befehle für Einstellungen und ein eigenes Recht, wer Einstellungen verwalten darf.
- **Deinstallation nach Ihrer Wahl:** Daten behalten (Vorgabe) oder nach ausdrücklicher Bestätigung vollständig löschen. Hinweise auf Pro-Funktionen in den Einstellungen lassen sich ausblenden.

Einstellungen für Pro-Funktionen wie Uploads, mehrstufige Formulare, PDF, Webhooks und WooCommerce-Fragebögen finden Sie auf der [Pro-Seite](/form-captain/pro/).

## Pro-Workflows

Form Captain Pro ergänzt mehrstufige Formulare mit Fortschritt und Fortsetzen-Link, geschützte Uploads mit Typ- und Größenlimits sowie UND-/ODER-Bedingungsgruppen. Steuern Sie Bestätigungen und Benachrichtigungsziele anhand der Antworten. Serverseitige Validierung prüft die Regeln unabhängig von der Browserdarstellung. Für WooCommerce ordnen Sie Produkten einen Käuferfragebogen zu, den Kundinnen und Kunden nach bestätigtem Kauf ausfüllen.

Webhooks übertragen zugeordnete Felder an öffentliche HTTPS-Ziele mit Signatur, Idempotenz, Zeitlimit, Wiederholungen und Jobstatus. Einträge lassen sich als PDF herunterladen. Datei- und PDF-Zugriffe folgen den WordPress-Berechtigungen und Datenschutzregeln.

## Schnittstellen statt Datenbankkopplung

Die Suite-Integrationen nutzen versionierte öffentliche Verträge. Form-Einsendungen können über den passenden Adapter mit Pass Captain, Voucher Captain, Affiliate Captain oder Review Captain Pro verbunden werden. Workflow Captain Pro erhält mit einer Form-Captain-Pro-Lizenz Ereignisse nach dem Speichern; nur freigegebene, nicht sensible Werte werden weitergegeben. Externe Aktionen erfolgen getrennt von der Speicherung des Eintrags; eine Jobliste unter **Form Captain → Integrationen** zeigt Status und Fehler und erlaubt das gezielte Wiederholen. Eingebaute Aktionen senden eine zusätzliche Admin-Benachrichtigung, setzen den Eintragsstatus, anonymisieren Einträge nach einer Frist oder bereiten eine Übergabe vor, die erst nach manueller Bestätigung ausgeführt wird; Buchung, Ausgabe, Partnerfreigabe und Review-Veröffentlichung werden nicht allein durch eine Formulareinsendung ausgelöst.

[Form Captain Pro vergleichen](/form-captain/pro/) · [Dokumentation](/dokumentation/form-captain/) · [Häufige Fragen](/form-captain/faq/)

[Screenshot-Platzhalter: Eintragsliste mit Statusfilter sowie Detailansicht mit geschwärzten Testdaten zeigen. Keine echte IP-Adresse, E-Mail oder sensible Anfrage verwenden.]
