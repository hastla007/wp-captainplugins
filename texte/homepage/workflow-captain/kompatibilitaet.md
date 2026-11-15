---
url: /workflow-captain/kompatibilitaet/
seo_title: Workflow Captain Kompatibilität – WordPress, PHP und WooCommerce
meta_description: Prüfen Sie die vorgesehenen WordPress-, PHP- und WooCommerce-Anforderungen sowie die Voraussetzungen der Workflow-Captain-Pro-Provider.
focus_keyphrase: Workflow Captain Kompatibilität
---

# Voraussetzungen und Kompatibilität

Die Versionswerte unten sind die im Workflow-Captain-Konzept festgelegten Mindestanforderungen. Das Konzept dokumentiert noch keine ausgeführten Integrationstests. Getestete Kombinationen und Mindestversionen der einzelnen Suite-Provider müssen vor dem Release in einer aktualisierten Matrix veröffentlicht werden.

| Komponente | Vorgesehene Mindestversion | Hinweis |
|---|---:|---|
| WordPress | 6.8 | Kostenloser Kern und Pro-Add-on |
| PHP | 8.3 | Kostenloser Kern und Pro-Add-on |
| WooCommerce | 8.0 | Optional; erforderlich für WooCommerce-Provider |
| Captain-Suite-Plugins | Je Providervertrag | Erfordert kompatible Kernversion und öffentliche Schnittstelle |
| Pro-Erweiterung | Aktive Pro-Lizenz | Workflow Captain Pro wird separat angeboten; für Suite-Funktionen müssen die passenden Provider verfügbar sein |

## WooCommerce und Bestellmodi

Das Konzept sieht HPOS sowie klassische und Blocks-Bestellungen als Release-Gates vor. Diese Angabe beschreibt den geplanten Abnahmeumfang, nicht bereits bestätigte Testergebnisse. Die konkrete WooCommerce-Testmatrix wird vor dem Verkaufsstart ergänzt.

## Provider-Kompatibilität

Ein Provider meldet seine Vertragsversion und erforderlichen Plugin-Mindeststände. Fehlt ein Plugin, ist der Contract inkompatibel oder eine erforderliche Berechtigung nicht vorhanden, wird der Provider als nicht verfügbar ausgewiesen. Workflows werden nicht auf unbekannte oder geänderte Vertragsfelder umgedeutet.

## Betriebsanforderungen

Die Ausführung erfolgt lokal auf der WordPress-Website. Mit WooCommerce kommt Action Scheduler zum Einsatz; ohne WooCommerce ist WP-Cron vorgesehen. Für regelmäßige, zeitnahe Läufe empfiehlt das Konzept einen korrekt eingerichteten System-Cron. Queue- und Systemlimits können Läufe verzögern oder sicher ablehnen, verursachen aber keine Task-Kosten.

[Integrationen ansehen](/workflow-captain/integrationen/) · [Installationsanleitung](/workflow-captain/installation/) · [Systemweite Kompatibilität](/kompatibilitaet/)
