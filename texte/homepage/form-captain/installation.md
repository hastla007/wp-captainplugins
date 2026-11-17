---
url: /form-captain/installation/
seo_title: Form Captain installieren: Formulare einrichten
meta_description: Installieren Sie Form Captain, wählen Sie eine Formularvorlage, fügen Sie Felder hinzu und testen Sie Ihre erste Einsendung in WordPress.
focus_keyphrase: Form Captain installieren
---

# Form Captain installieren und das erste Formular veröffentlichen

Mit Form Captain richten Sie ein Formular direkt in WordPress ein und verwalten Antworten anschließend im Admin. Sie benötigen weder einen externen Formularaccount noch eine Pro-Lizenz, um den kostenlosen Kern zu verwenden.

## Voraussetzungen

Form Captain setzt WordPress 6.8 oder neuer und PHP 8.5 oder neuer voraus. WooCommerce ist optional und wird nur für die Käuferfragebögen von Form Captain Pro benötigt (ab Version 11.2). Multisite wird in Version 1.0 nicht unterstützt. Die jeweils getestete Umgebung steht in den Releasehinweisen.

## Installation und Ersteinrichtung

1. Installieren und aktivieren Sie Form Captain über den WordPress-Plugin-Installer oder das freigegebene ZIP-Paket.
2. Folgen Sie der Checkliste „Loslegen“ im Dashboard unter **Form Captain** und wählen Sie eine Vorlage für Kontakt, Angebot oder Support.
3. Ergänzen Sie Felder, Pflichtangaben, Hilfetexte und Validierungsregeln.
4. Konfigurieren Sie Admin-Benachrichtigung, optionale Bestätigung und Datenschutz-/Aufbewahrungsregeln.
5. Veröffentlichen Sie das Formular und fügen Sie es mit dem Block „Form Captain“ oder dem Shortcode `[form_captain id="…"]` in eine Seite ein.
6. Senden Sie eine Testeinsendung ab und prüfen Sie Eintrag, Status und E-Mail-Zustellung.

## E-Mail-Zustellung prüfen

WordPress-E-Mail hängt von der Serverkonfiguration ab. Prüfen Sie Absenderdomäne und Testzustellung; bei Bedarf richten Sie einen SMTP-Versanddienst ein. Form Captain zeigt Versand- und Integrationsstatus, kann aber die Zustellbarkeit des Mailservers nicht garantieren.

## Pro-Funktionen aktivieren

Installieren Sie Form Captain Pro separat mit dem ZIP-Paket aus Ihrem Kundenkonto, tragen Sie auf der Lizenzseite im Menü **Form Captain** den mit Ihrem Kauf bereitgestellten Lizenzschlüssel ein und prüfen Sie anschließend die Pro-Funktionen. Für Webhooks aktivieren Sie zusätzlich den Connector „Form Captain Pro: Webhooks“ unter **Form Captain → Integrationen**. Lizenz- oder Updateprobleme löschen Ihre Formulare und gespeicherten Einträge nicht.

## Vor dem Livegang testen

Prüfen Sie das Formular auf Mobilgeräten, validieren Sie Pflichtfelder und Einwilligung, kontrollieren Sie Zugriffsrechte für Einträge und testen Sie Export sowie Löschung mit synthetischen Daten.

[Features](/form-captain/features/) · [Kompatibilität](/form-captain/kompatibilitaet/) · [Dokumentation](/dokumentation/form-captain/)
