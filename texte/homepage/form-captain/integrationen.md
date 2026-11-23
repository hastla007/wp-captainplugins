---
url: /form-captain/integrationen/
seo_title: Form Captain Integrationen – Workflow und Connectoren
meta_description: Verbinden Sie Form Captain mit Workflow Captain, der Suite und individuellen WordPress-Projekten über versionierte Connectoren.
focus_keyphrase: Form Captain Integrationen
---

# Form Captain Integrationen

Form Captain speichert eine Einsendung zuerst als WordPress-Eintrag. Optionale Integrationen führen danach gezielte Aktionen aus und dokumentieren deren Status. Fällt eine Verbindung aus, bleibt der Eintrag erhalten.

## WooCommerce

Der Form-Captain-Kern funktioniert ohne WooCommerce und greift nicht in Warenkorb, Checkout oder Bestellungen ein. Form Captain Pro ergänzt Käuferfragebögen: Sie ordnen einem Produkt ein Formular zu, das Kundinnen und Kunden nach bestätigter Zahlung je Bestellposition ausfüllen. Unterstützt werden HPOS und der klassische Bestellspeicher sowie Bestellungen aus klassischem und Block-Checkout; die Zuordnung erfolgt im klassischen Produkteditor. Checkout-Felder, Zahlungen und Bestellstatus bleiben unverändert.

## Pass Captain

Veranstalter wählen im Event von Pass Captain ein Form-Captain-Formular als Anmeldung oder für Helfer-/Ausstelleranfragen aus; der Eventbezug wird signiert übergeben. Eine Anfrage erscheint im Event als „zu prüfen“. Ein Form-Eintrag allein reserviert keinen Platz und stellt kein Ticket aus; gebucht wird nur durch Ihr Personal.

## Voucher Captain

Ein Formular kann eine Firmenanfrage oder Gutscheinpersonalisierung erfassen. Eine Übergabe an Voucher Captain erfolgt über einen dokumentierten Adapter und eine nachvollziehbare Prüfung. Das Formular löst nicht selbstständig Ausgabe oder Zahlung aus.

## Affiliate Captain

Ein Partnerbewerbungsformular kann Angaben zur Prüfung erfassen. Eine Übergabe erstellt höchstens einen Partner im Status „pending“; Freigabe und Provision werden nicht automatisch ausgelöst.

## Review Captain

Mit Review Captain Pro kann ein Formular eine lokale Review zur Moderation übergeben. Feldzuordnung und Herkunft werden ausgewiesen. Neue Bewertungen bleiben pending und unverified; eine Review-Anfrage wird nicht automatisch aus einer Formulareinsendung versendet.

## Course Captain

Anmeldeformulare, Kursbewerbungen, Feedbackbögen und Tutoraufgaben lassen sich mit Course Captain verbinden. Form Captain bleibt Eigentümer der Einsendung; Course Captain vergibt einen Kurszugang erst nach einer geprüften Übergabe.

## Technischer Integrationsstatus

Der öffentliche Form-Captain-Vertrag ermöglicht versionierte Integrationen. Separate WordPress-Connector-Plugins können projektspezifische Aktionen ergänzen, ohne den Form-Captain-Kern zu verändern. Entwicklerdokumentation und ein Referenz-Connector zeigen, wie Aktionen, Feldfreigaben und Wiederholungen umgesetzt werden. Administratoren aktivieren Connectoren unter **Form Captain → Integrationen** ausdrücklich, prüfen sie mit einem Testlauf und wählen pro Formular die freigegebenen Felder und Aktionen. Wird ein Connector deaktiviert, pausieren seine offenen Aufträge und laufen nach erneuter Aktivierung weiter. Externe Ausführung erfolgt nach dem Speichern des Eintrags; Fehler lassen den Entry bestehen und sind nachvollziehbar.

Suite- und Projektverbindungen zeigen Plugin- und Vertragsversion, Feldzuordnung, letzten Lauf, Queue-Status und Fehler mit dem nächsten Schritt. Wiederholungen verwenden Idempotenz, damit sie keine doppelten Geschäftsaktionen auslösen. Kundenspezifische Connectoren sind eigenständige Erweiterungen mit eigener Projekt- und Supportgrenze; Form Captain enthält keine individuelle CRM-, Kurs- oder ERP-Logik.

## Workflow Captain

Mit Workflow Captain Pro und einer aktiven Form-Captain-Pro-Lizenz verbinden Sie Formularereignisse mit Workflows: Formular angelegt oder geändert, Eintrag angelegt, Status geändert oder gelöscht, Einträge importiert, Einwilligung widerrufen und Benachrichtigung fehlgeschlagen. Die Ereignisse entstehen nach dem Speichern. Workflows erhalten keine Freitexte und keine sensiblen Felder, Antworten nur aus ausdrücklich freigegebenen Auswahl-, Zahlen- und Einwilligungsfeldern. Statuswechsel, zusätzliche Benachrichtigungen, Anonymisierung nach Frist und bestätigte Übergaben stellen Sie direkt als Formularaktion in Form Captain ein. Zahlungen, Ticket- oder Gutscheinausgabe, Partnerfreigaben und Review-Veröffentlichungen erfordern weiterhin eine eigene, berechtigte Aktion im zuständigen Plugin.

[Kompatibilität](/form-captain/kompatibilitaet/) · [Review Captain](/review-captain/) · [Alle Captain-Integrationen](/integrationen/)

[Screenshot-Platzhalter: WordPress-Integrationsseite mit Workflow Captain sowie separat gelisteten Suite- und Projekt-Connectoren zeigen. Sichtbar sein sollen Aktiv/Inaktiv, Vertragsversion, freigegebene Formularaktion, ausgewählte Felder sowie letzter Lauf und ein verständlicher Fehlerstatus. Keine echten Zugangsdaten oder personenbezogenen Inhalte verwenden.]
