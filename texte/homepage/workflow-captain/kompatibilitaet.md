---
url: /workflow-captain/kompatibilitaet/
seo_title: Workflow Captain Kompatibilität: WordPress, PHP, Woo
meta_description: Prüfen Sie die WordPress-, PHP- und WooCommerce-Anforderungen sowie die Voraussetzungen der Workflow-Captain-Pro-Provider.
focus_keyphrase: Workflow Captain Kompatibilität
---

# Voraussetzungen und Kompatibilität

Die Werte unten sind die Mindestanforderungen von Workflow Captain und Workflow Captain Pro. Unterhalb der PHP- oder WordPress-Mindestversion bleibt das Plugin mit einem Hinweis inaktiv; gespeicherte Daten bleiben unverändert.

| Komponente | Mindestversion | Hinweis |
|---|---:|---|
| WordPress | 7.0 | Kostenloser Kern und Pro-Add-on |
| PHP | 8.5 | Kostenloser Kern und Pro-Add-on |
| Datenbank | MySQL 9.7 (LTS) / MariaDB 12.3 (LTS) | Ältere Versionen erzeugen eine Warnung im Website-Zustand, keine Sperre |
| WooCommerce | 11.2.2 | Optional; erforderlich für die WooCommerce-Auslöser. HPOS und klassische Bestelltabellen |
| Captain-Suite-Plugins | Je Providervertrag | Pass, Voucher, Affiliate, Form und Review Captain mit kompatibler Vertragsversion; zusätzlich das lizenzierte Pro-Add-on des Produkts |
| Pro-Erweiterung | Workflow Captain 0.2.0 und aktive Pro-Lizenz | Workflow Captain Pro wird separat angeboten; für netzwerkweite Workflows müssen Workflow Captain und Pro netzwerkweit aktiviert sein |

## WooCommerce und Bestellmodi

Der WooCommerce-Provider liest Bestellungen ausschließlich über die WooCommerce-CRUD-Schnittstellen und unterstützt damit HPOS und die klassische Bestellspeicherung sowie Bestellungen aus dem klassischen und dem Block-Checkout. Unter WooCommerce 11.2.2 meldet sich der Provider nicht an und wird auf der Seite **Workflow Captain → Provider** als zu alt angezeigt.

## Provider-Kompatibilität

Ein Provider meldet sich nur an, wenn die Vertragsversion des Fachplugins mindestens die geforderte Version hat und dieselbe Hauptversion trägt; die Plugin-Version allein entscheidet nicht. Fehlt ein Plugin, ist der Vertrag inkompatibel oder fehlt eine Lizenz, wird der Provider als nicht verfügbar ausgewiesen. Neue Ereignisse eines Anbieters ohne Provider bleiben pausiert gespeichert, nichts wird gelöscht. Workflows werden nicht auf unbekannte oder geänderte Vertragsfelder umgedeutet.

## Betriebsanforderungen

Die Ausführung erfolgt lokal auf der WordPress-Website. Ist Action Scheduler vorhanden (etwa mit WooCommerce), nutzt Workflow Captain ihn, sonst WP-Cron. Für regelmäßige, zeitnahe Läufe empfehlen wir einen System-Cron, der `wp workflow-captain process` jede Minute aufruft; in Multisite je Website. Workflow Captain gibt auf öffentlichen Seiten nichts aus. Queue- und Systemlimits können Läufe verzögern oder sicher ablehnen, verursachen aber keine Task-Kosten.

[Integrationen ansehen](/workflow-captain/integrationen/) · [Installationsanleitung](/workflow-captain/installation/) · [Systemweite Kompatibilität](/kompatibilitaet/)
