---
url: /dokumentation/workflow-captain/
seo_title: Workflow Captain Dokumentation: Workflows betreiben
meta_description: Workflow Captain Dokumentation zu Installation, Triggern, Bedingungen, Aktionen, Warteschlange, Protokollen und Integrationen.
focus_keyphrase: Workflow Captain Dokumentation
---

# Workflow Captain Dokumentation

Diese Dokumentationsübersicht begleitet Sie von der Installation bis zum sicheren Betrieb. Die Funktions- und Providerbeschreibungen beziehen sich auf Version 1 von Workflow Captain und Workflow Captain Pro.

## Einstieg

- [Workflow Captain installieren](/workflow-captain/installation/)
- [Systemanforderungen prüfen](/workflow-captain/kompatibilitaet/)
- [Free- und Pro-Funktionen vergleichen](/workflow-captain/features/)
- [Captain-Provider und Webhooks](/workflow-captain/integrationen/)

## Workflow aufbauen

Wählen Sie im visuellen Editor genau einen Auslöser: ein Ereignis eines Providers oder einen Zeitplan. Ergänzen Sie Wenn/Sonst-Bedingungen, Wartezeiten und Aktionen; Nachrichten und Notizen können Platzhalter aus dem Ereignis enthalten. In Pro kommen Freigabeschritte, Event-Korrelation, Webhook- und Gutschein-Aktionen hinzu. Der Editor prüft fehlende Felder, offene Ausgänge und nicht verfügbare Provider, bevor ein Workflow veröffentlicht wird. Jede veröffentlichte Version bleibt für laufende Läufe unverändert.

## Testen und aktivieren

Führen Sie zunächst einen Testlauf mit Beispieldaten aus; er hat keine Seiteneffekte. Prüfen Sie Ereignisquelle, Empfänger, Datenauswahl und mögliche Seiteneffekte. Veröffentlichen Sie den Ablauf erst nach erfolgreicher Validierung. Aktivieren Sie neue Automationen zunächst in einer Staging-Umgebung oder mit risikoarmen Aktionen.

## Ausführungen und Fehler

Die Laufansicht zeigt Status, Workflow-Version, Korrelation, Zeitleiste der Schritte und redigierte Ereignisdaten. Bei vorübergehenden Fehlern wiederholt Workflow Captain nach festem Plan; fehlgeschlagene oder pausierte Ereignisse reihen Sie unter **Workflow Captain → Ereignisse** gezielt erneut ein. Ist unklar, ob eine Nachricht schon hinausging, hält der Lauf an, bis ein Mensch entscheidet. Erledigte Läufe werden nach 30 Tagen gelöscht, fehlgeschlagene Ereignisse nach 90 Tagen; Pro erlaubt bis zu 365 Tage Aufbewahrung und CSV-Export.

## Datenschutz und Zuständigkeiten

Payloads enthalten nur die vom Provider freigegebenen Felder. Geheimnisse und sensible Werte werden maskiert oder ausgeschlossen. Fachplugins bleiben Eigentümer ihrer Geschäftsobjekte; Workflow Captain verwendet öffentliche Serviceverträge statt fremder Datenbanktabellen.

## Support und Referenzen

Für eine Supportanfrage laden Sie unter **Workflow Captain → Ereignisse** die Diagnose herunter (oder `wp workflow-captain diagnostics`); sie enthält Versionen, Zustand von Datenbank und Worker sowie angemeldete Adapter, aber keine persönlichen Daten und keine Geheimnisse. Hilfreich sind außerdem Workflow-Version, betroffener Provider und Lauf-ID. Senden Sie keine Secrets, Lizenzschlüssel oder vollständigen Kundendaten.

[Installationsanleitung](/workflow-captain/installation/) · [FAQ](/workflow-captain/faq/) · [Support](/support/)

[Screenshot-Platzhalter: Dokumentationsgrafik des Ereignisflusses Trigger → Bedingungen → Aktion → Run-Protokoll sowie eine maskierte Fehlerdiagnose zeigen.]
