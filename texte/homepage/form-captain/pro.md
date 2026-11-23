---
url: /form-captain/pro/
seo_title: Form Captain Pro – mehrstufige Formulare und Workflows
meta_description: Erweitern Sie WordPress-Formulare um mehrstufige Abläufe, sichere Uploads, UND-/ODER-Regeln, Webhooks, PDF-Ausgaben und WooCommerce-Fragebögen.
focus_keyphrase: Form Captain Pro
---

# Form Captain Pro: Komplexe Formulare zuverlässig abwickeln

Wenn eine Anfrage mehr als ein paar Felder umfasst, braucht Ihr Team klare Abläufe und vollständige Einträge. Form Captain Pro ergänzt den kostenlosen Formular-Kern um mehrstufige Formulare, geschützte Datei-Uploads, UND-/ODER-Bedingungen mit Routing, signierte Webhooks, PDF-Ausgaben und WooCommerce-Käuferfragebögen. Pro ist ein separates Add-on und setzt das kostenlose Form Captain voraus.

## Mehrstufige Formulare mit Fortsetzen-Funktion

Teilen Sie umfangreiche Formulare mit dem Feld „Schrittgrenze“ in bis zu 20 Schritte auf. Eine Fortschrittsanzeige („Schritt 2 von 3“) zeigt, wo sich die absendende Person befindet. „Weiter“ prüft die Felder des Schritts auch serverseitig. Mit „Speichern und später fortsetzen“ erhält die Person einen Fortsetzen-Link, der 7 Tage gültig ist; sensible Felder, Datei- und Einwilligungsfelder werden nie im Entwurf gespeichert. Ohne JavaScript erscheint das Formular als eine Seite und funktioniert weiter.

## Dateien geschützt anfragen

Der Feldtyp „Datei-Upload“ nimmt eine Datei je Feld an. Erlaubte Dateitypen (Standard: PDF, JPG, PNG; zusätzlich z. B. Office-Dateien ohne Makros) und die Höchstgröße (bis 10 MB) legen Sie je Feld fest. Der Dateiinhalt wird unabhängig von der Endung geprüft; SVG, HTML, Skripte, Archive und ausführbare Dateien sind nie erlaubt. Dateien liegen unter zufälligen Namen in einem geschützten Verzeichnis und lassen sich nur aus der Eintragsansicht mit Leserecht herunterladen. Löschung, Aufbewahrungsende, Anonymisierung und Datenschutz-Löschanfragen entfernen auch die zugehörigen Dateien. Ein Hook für Malware-Scanner steht bereit.

## Regeln für Felder und Benachrichtigungen

Statt einer einzelnen Regel je Feld (Free) blenden Sie Felder über Bedingungsgruppen mit bis zu 10 Regeln ein oder aus – wahlweise müssen alle (UND) oder eine (ODER) zutreffen. Routing-Regeln ersetzen oder ergänzen die Empfänger der Admin-Benachrichtigung und wählen eine eigene Bestätigungsmeldung oder Weiterleitungsseite anhand der Antworten. Die Prüfung erfolgt auch serverseitig; Regeln sind reine Daten, es wird kein Code ausgeführt.

## Webhooks und nachvollziehbare Übergaben

Legen Sie Endpunkte unter **Form Captain → Webhooks** an und übermitteln Sie je Formular bis zu 15 zugeordnete Felder an externe Systeme, etwa n8n, Make oder eigene Anwendungen. Webhooks verwenden eine HMAC-Signatur mit Zeitstempel und Nonce gegen Wiederholungsangriffe, Secret-Wechsel ohne Ausfall, Idempotenzschlüssel, ein Zeitlimit von 10 Sekunden sowie bis zu 8 Wiederholungen mit wachsendem Abstand. Erlaubt sind nur öffentliche HTTPS-Ziele; interne Adressen und Weiterleitungen werden blockiert. Sensible Felder werden nie übertragen. Schlägt eine Zustellung endgültig fehl, bleibt der Formulareintrag in WordPress erhalten und der Auftrag lässt sich in der Jobliste erneut anstoßen.

## PDF-Ausgaben aus Einträgen

In der Eintragsansicht laden Sie einen Eintrag mit „Als PDF herunterladen“ als PDF/A-Dokument herunter. Das PDF wird beim Abruf mit festem Layout und eingebetteter Schrift erzeugt und nicht auf dem Server gespeichert. Es enthält die Antworten des Eintrags; sensible Felder erscheinen nur für Nutzer mit Exportrecht. Der Abruf erfordert das Recht, Einträge zu lesen. Es werden keine externen Ressourcen geladen; sehr lange Einträge werden nach 30 Seiten mit Hinweis gekürzt.

## WooCommerce-Käuferfragebögen nach dem Kauf

Ordnen Sie einem Produkt im klassischen WooCommerce-Produkteditor ein veröffentlichtes Formular zu, etwa für Personalisierungs- oder Lieferangaben. Nach bestätigter Zahlung erhält jede Bestellposition einen eigenen Fragebogen; der Link erscheint auf der Bestellbestätigung, unter „Mein Konto“ und in den Kunden-E-Mails von WooCommerce, für Gastbestellungen mit einem zeitlich begrenzten Zugangslink. Die Antwort wird als Form-Captain-Eintrag mit geprüftem Bestellbezug gespeichert; in der Bestellung sehen Sie den Status je Position. Optional markieren Sie einen Fragebogen als „vor Bearbeitung erforderlich“, fordern eine Korrektur an oder versenden eine einmalige Erinnerung.

Form Captain Pro verändert weder Checkout-Felder noch Zahlungs- oder Bestellstatus. Storno und Vollerstattung schließen offene Fragebögen. Unterstützt werden HPOS und der klassische Bestellspeicher sowie Bestellungen aus klassischem und Block-Checkout.

## Captain-Suite-Verbindungen

Verbindungen zu Pass Captain, Voucher Captain, Affiliate Captain und Review Captain Pro nutzen den versionierten öffentlichen Vertrag von Form Captain und werden unter **Form Captain → Integrationen** einzeln aktiviert. Eine Formulareinsendung löst keine Buchung, Ticket- oder Gutscheinausgabe, Partnerfreigabe oder Review-Veröffentlichung automatisch aus; jede Übergabe folgt den Freigaben und Grenzen des jeweiligen Plugins.

Mit Workflow Captain Pro verarbeiten Sie Ereignisse von Form Captain nach dem Speichern, etwa einen neuen Eintrag, eine Statusänderung, eine Löschung, einen Einwilligungswiderruf oder einen Benachrichtigungsfehler. Diese Verbindung setzt eine aktive Form-Captain-Pro-Lizenz voraus. Workflows erhalten keine Freitexte und keine sensiblen Felder; Antworten nur aus ausdrücklich freigegebenen Auswahl-, Zahlen- und Einwilligungsfeldern.

## Preise, Lizenz und Support

| Tarif | Jahrespreis zzgl. USt. | Live-Websites | Support |
|---|---:|---:|---|
| Single | 59 € | 1 | Standard |
| Business | 129 € | 5 | Standard |
| Agency | 249 € | 25 | Priorisiert |

Alle Pläne enthalten denselben Pro-Funktionsumfang, Updates und Support während der aktiven Laufzeit. Je Live-Website ist eine Staging-Aktivierung enthalten; Development-Aktivierungen zählen nicht zum Site-Limit. Es gibt keine Lifetime-Lizenz und keine kostenpflichtigen Einzel-Add-ons.

Form Captain Free und vorhandene Formulare und Einträge bleiben bei Ablauf einer Pro-Lizenz verfügbar. Ohne aktive Lizenz nimmt Pro keine neuen Uploads an, mehrstufige Formulare erscheinen als eine Seite und Webhook-Aufträge pausieren; bereits hochgeladene Dateien bleiben abrufbar und löschbar, offene Käuferfragebögen bleiben beantwortbar. Gespeicherte Pro-Einstellungen werden nicht gelöscht.

**[Form Captain Pro auswählen]([Checkout-URL])** · [Alle Captain-Pro-Pläne](/preise/)

[Form Captain Features](/form-captain/features/) · [Verfügbare Captain-Pro-Add-ons](/captain-pro/) · [FAQ](/form-captain/faq/)

[Screenshot-Platzhalter: Multi-Step-Formular mit Fortschrittsanzeige, bedingter Benachrichtigungsregel, geschützter Upload-Einstellung und PDF-Vorschau zeigen. Nur synthetische Beispieldaten verwenden.]
