---
url: /workflow-captain/installation/
seo_title: Workflow Captain installieren: erste Automation
meta_description: Installieren Sie Workflow Captain, prüfen Sie WordPress-Voraussetzungen und erstellen Sie Ihren ersten WordPress- oder WooCommerce-Workflow.
focus_keyphrase: Workflow Captain installieren
---

# Workflow Captain installieren und den ersten Ablauf testen

Workflow Captain Free lässt sich direkt in WordPress installieren. Für WooCommerce-Auslöser benötigen Sie WooCommerce; für Suite-Funktionen kommen Workflow Captain Pro, das passende Captain-Plugin und dessen Pro-Add-on hinzu.

## Voraussetzungen

- WordPress 7.0 oder neuer und PHP 8.5 oder neuer; empfohlen MySQL 9.7 oder MariaDB 12.3 (ältere Datenbankserver erzeugen nur eine Warnung im Website-Zustand).
- WooCommerce optional ab Version 11.2.2 für die Bestell-Auslöser.
- Für Pro: Workflow Captain ab Version 0.2.0 und eine gültige Workflow-Captain-Pro-Lizenz; für Suite-Funktionen das jeweilige Captain-Plugin mit kompatiblem Providervertrag und eine gültige Lizenz seines Pro-Add-ons.
- Vor dem Start ein aktuelles Backup und eine Staging-Umgebung für erste Tests.

## Installation

1. Sichern Sie Website und Datenbank. Prüfen Sie die [Kompatibilitätsübersicht](/workflow-captain/kompatibilitaet/).
2. Installieren und aktivieren Sie Workflow Captain über den freigegebenen Download bzw. die WordPress-Pluginverwaltung.
3. Öffnen Sie **Workflow Captain → Einstellungen**, prüfen Sie Grenzen, Aufbewahrung und Rechte und kontrollieren Sie den Status unter **Werkzeuge → Website-Zustand**.
4. Falls benötigt, aktivieren Sie WooCommerce und kontrollieren Sie den Provider unter **Workflow Captain → Provider**.
5. Ist WP-Cron abgeschaltet, rufen Sie `wp workflow-captain process` jede Minute per System-Cron auf.
6. Für Pro: Laden Sie das Pro-Add-on aus Ihrem Kundenkonto hoch, aktivieren Sie es und tragen Sie Ihren Lizenzschlüssel unter **Workflow Captain → Pro-Lizenz** ein.
7. Aktivieren Sie nur die Captain-Plugins, deren Provider Sie tatsächlich verwenden möchten.

## Einen ersten Workflow sicher einrichten

1. Legen Sie einen Workflow mit einem WordPress-, WooCommerce- oder Zeitplan-Auslöser an – oder importieren Sie eine Vorlage als Entwurf.
2. Ergänzen Sie eine einfache Bedingung und eine Nachricht, Markierung oder Notiz.
3. Prüfen Sie Empfänger, Felder und mögliche Seiteneffekte.
4. Führen Sie den Testlauf mit Beispieldaten aus; er hat keine Seiteneffekte.
5. Aktivieren Sie den Workflow zunächst in einer Test- oder Staging-Umgebung. Prüfen Sie nach dem echten Ereignis den Run-Status und das Protokoll.

## Pro und Suite-Provider

Für einen Captain-Provider müssen beide Seiten bereit sein: Das Quellplugin muss einen kompatiblen Vertrag bereitstellen, und sowohl Workflow Captain Pro als auch das Pro-Add-on des Produkts müssen lizenziert sein. Fehlt die Mindestversion, der Vertrag oder eine Lizenz, zeigen die Seite **Workflow Captain → Provider** und die Pro-Lizenzseite, warum der Provider nicht angemeldet ist. Er wird nicht stillschweigend durch direkte Datenbankzugriffe ersetzt.

[Screenshot-Platzhalter: Installationsansicht mit Workflow Captain im Adminmenü, Systemstatus der WordPress-/Woo-Provider und einem ersten Dry Run zeigen. Keine Lizenzschlüssel oder realen Bestellungen sichtbar machen.]

[Workflow Captain FAQ](/workflow-captain/faq/) · [Dokumentation](/dokumentation/workflow-captain/) · [Support](/support/)
