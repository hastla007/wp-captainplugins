---
url: /dokumentation/workflow-captain/
seo_title: Workflow Captain Dokumentation – Workflows einrichten und betreiben
meta_description: Workflow Captain Dokumentation zu Installation, Triggern, Bedingungen, Aktionen, Warteschlange, Protokollen und Integrationen.
focus_keyphrase: Workflow Captain Dokumentation
---

# Workflow Captain Dokumentation

Diese Dokumentationsübersicht begleitet Sie von der Installation bis zum sicheren Betrieb. Die Funktions- und Providerbeschreibungen orientieren sich am geplanten Version-1-Umfang. Konkrete UI-Schritte, Screenshots und Contract-Felder werden bei Release mit der ausgelieferten Version synchronisiert.

## Einstieg

- [Workflow Captain installieren](/workflow-captain/installation/)
- [Systemanforderungen prüfen](/workflow-captain/kompatibilitaet/)
- [Free- und Pro-Funktionen vergleichen](/workflow-captain/features/)
- [Captain-Provider und Webhooks](/workflow-captain/integrationen/)

## Workflow aufbauen

Wählen Sie einen oder mehrere Startauslöser aus der verfügbaren Providerpalette. Ergänzen Sie Bedingungen, Tokens und Aktionen in der vorgesehenen Reihenfolge. In Pro können Sie bei Bedarf Zweige, Freigaben, Verzögerungen und Event-Korrelation konfigurieren. Der Editor validiert fehlende Felder und nicht verfügbare Provider, bevor ein Workflow aktiviert wird.

## Testen und aktivieren

Führen Sie zunächst einen Dry Run mit Testdaten aus. Prüfen Sie Ereignisquelle, Empfänger, Datenauswahl und mögliche Seiteneffekte. Veröffentlichen Sie den Ablauf erst nach erfolgreicher Validierung. Aktivieren Sie neue Automationen zunächst in einer Staging-Umgebung oder mit risikoarmen Aktionen.

## Ausführungen und Fehler

Das Run-Protokoll zeigt Status, Ablaufversion, Providervertrag und redigierte Ein-/Ausgabedaten. Pro ergänzt begrenzte Wiederholungen, Retry-Historie, Dead-letter-Status und kontrolliertes Replay. Ein Replay kann externe Seiteneffekte erneut auslösen; prüfen Sie den betroffenen Vorgang und verwenden Sie nur idempotente Aktionen.

## Datenschutz und Zuständigkeiten

Payloads enthalten nur die vom Provider freigegebenen Felder. Geheimnisse und sensible Werte werden maskiert oder ausgeschlossen. Fachplugins bleiben Eigentümer ihrer Geschäftsobjekte; Workflow Captain verwendet öffentliche Serviceverträge statt fremder Datenbanktabellen.

## Support und Referenzen

Die versionspezifische Trigger-, Action-, Token- und Fehlerreferenz wird mit den stabilen Providerverträgen veröffentlicht. Bei einer Supportanfrage helfen Workflow-Version, betroffener Provider, Contract-Version und redigierte Run-ID. Senden Sie keine Secrets, Lizenzschlüssel oder vollständigen Kundendaten.

[Installationsanleitung](/workflow-captain/installation/) · [FAQ](/workflow-captain/faq/) · [Support](/support/)

[Screenshot-Platzhalter: Dokumentationsgrafik des Ereignisflusses Trigger → Bedingungen → Aktion → Run-Protokoll sowie eine maskierte Fehlerdiagnose zeigen.]
