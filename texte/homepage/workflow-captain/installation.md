---
url: /workflow-captain/installation/
seo_title: Workflow Captain installieren: erste Automation
meta_description: Installieren Sie Workflow Captain, prüfen Sie WordPress-Voraussetzungen und erstellen Sie Ihren ersten WordPress- oder WooCommerce-Workflow.
focus_keyphrase: Workflow Captain installieren
---

# Workflow Captain installieren und den ersten Ablauf testen

Workflow Captain Free lässt sich direkt in WordPress installieren. Für WooCommerce-Trigger benötigen Sie WooCommerce; für Suite-Funktionen kommen das passende Captain-Plugin und gegebenenfalls Workflow Captain Pro hinzu.

## Voraussetzungen

- WordPress 6.8 oder neuer und PHP 8.5 oder neuer gemäß Produktkonzept.
- WooCommerce optional ab Version 8.0 für Shop-Auslöser und -Aktionen.
- Für Pro: gültige Workflow-Captain-Pro-Lizenz; für Suite-Aktionen das jeweils benötigte Captain-Plugin mit kompatiblem Providervertrag.
- Vor dem Start ein aktuelles Backup und eine Staging-Umgebung für erste Tests.

## Installation

1. Sichern Sie Website und Datenbank. Prüfen Sie die [Kompatibilitätsübersicht](/workflow-captain/kompatibilitaet/).
2. Installieren und aktivieren Sie Workflow Captain über den freigegebenen Download bzw. die WordPress-Pluginverwaltung.
3. Öffnen Sie **Workflow Captain** im WordPress-Admin und prüfen Sie den Systemstatus.
4. Falls benötigt, aktivieren Sie WooCommerce und kontrollieren Sie den Status der Woo-Provider.
5. Installieren Sie das Pro-Add-on separat und aktivieren Sie Ihren Lizenzschlüssel im Lizenzbereich des Plugins.
6. Aktivieren Sie nur die Captain-Plugins, deren Provider Sie tatsächlich verwenden möchten.

## Einen ersten Workflow sicher einrichten

1. Legen Sie einen Workflow mit einem WordPress- oder WooCommerce-Ereignis an.
2. Ergänzen Sie eine einfache Bedingung und eine passende Benachrichtigungs- oder Notizaktion.
3. Prüfen Sie Empfänger, Felder und mögliche Seiteneffekte.
4. Führen Sie den Dry Run mit Testdaten aus und kontrollieren Sie die redigierte Vorschau.
5. Aktivieren Sie den Workflow zunächst in einer Test- oder Staging-Umgebung. Prüfen Sie nach dem echten Ereignis den Run-Status und das Protokoll.

## Pro und Suite-Provider

Für einen Captain-Provider müssen beide Seiten bereit sein: das Quellplugin muss einen öffentlichen, kompatiblen Vertrag bereitstellen und die erforderliche Pro-Berechtigung muss aktiv sein. Fehlt die Mindestversion oder der Vertrag, bleibt der Provider als inkompatibel oder nicht verfügbar gekennzeichnet. Er wird nicht stillschweigend durch direkte Datenbankzugriffe ersetzt.

[Screenshot-Platzhalter: Installationsansicht mit Workflow Captain im Adminmenü, Systemstatus der WordPress-/Woo-Provider und einem ersten Dry Run zeigen. Keine Lizenzschlüssel oder realen Bestellungen sichtbar machen.]

[Workflow Captain FAQ](/workflow-captain/faq/) · [Dokumentation](/dokumentation/workflow-captain/) · [Support](/support/)
