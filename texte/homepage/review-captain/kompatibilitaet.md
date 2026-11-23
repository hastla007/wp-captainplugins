---
url: /review-captain/kompatibilitaet/
seo_title: Review Captain Kompatibilität: WordPress und Plattformen
meta_description: Erfahren Sie, welche WordPress-, WooCommerce- und Plattformverbindungen Review Captain unterstützt und welche Zugänge für den Sync erforderlich sind.
focus_keyphrase: Review Captain Kompatibilität
---

# Review Captain: Kompatibilität und Plattformzugänge

Review Captain ist für WordPress-Websites konzipiert. Review Captain Pro verbindet Bewertungsquellen über deren offizielle APIs mit Ihren eigenen Zugängen oder über offizielle Anbieter-Widgets. Verfügbare Funktionen hängen vom Anbieterzugang, Kontotyp und der Berechtigung des Websitebetreibers ab.

## Kompatibilitätsübersicht

| System oder Quelle | Verwendung | Voraussetzung |
|---|---|---|
| WordPress | Core-Plugin, lokale Reviews, Blöcke und Shortcodes | Mindestversion gemäß aktuellem Releasehinweis |
| Elementor | Natives Widget „Review Captain“ (Bewertungen, Formular, Profil-Button) | Elementor aktiv; andere Page-Builder über Shortcode |
| Yoast SEO | Strukturierte Daten zulässiger lokaler Reviews im Yoast-Graph | Yoast SEO ab 26.0; sonst eigene JSON-LD-Ausgabe |
| WooCommerce | Produktzuordnung und Bewertungsanfragen nach Shop-Ereignissen | Pro; HPOS sowie klassischer und Block-Checkout; Versionen gemäß Kompatibilitätsmatrix |
| Google Business Profile | Bewertungen verwalteter Unternehmensstandorte synchronisieren | Pro; verifiziertes Unternehmensprofil, eigenes Google-Cloud-Projekt mit freigeschalteten Business-Profile-APIs |
| Trustpilot | Bewertungen synchronisieren oder TrustBox einbinden | Pro; API-/Tarifberechtigung oder freigegebener Widgetzugang |
| Trusted Shops / eTrusted | Review-Kanäle verbinden oder Trustbadge/eTrusted-Widget einsetzen | Pro; berechtigtes Konto und verfügbare API-/Widgetrechte |
| Apple App Store | Rezensionen eigener Apps anzeigen und synchronisieren | Pro; passende App-Store-Connect-Ressource und API-Berechtigung |
| Google Play | Rezensionen eigener Apps anzeigen und synchronisieren | Pro; Play-Console-Zugriff und Dienstkonto für die App; die API liefert nur aktuelle Rezensionen |
| Captain-Suite-Plugins | Voucher, Pass, Form, Affiliate und Workflow Captain anbinden | Pro-Adapter und kompatible, dokumentierte Plugin-Verträge |

## Datenzugriff und Anbieterbedingungen

Review Captain synchronisiert keine fremden Reviews durch Scraping. Externe Inhalte werden nur über offizielle APIs, freigegebene Einbettungen oder manuelle Kuration eingebunden. Plattformen können Profilbesitz, bestimmte Tarife oder zusätzliche API-Freigaben verlangen. Quellenhinweise, Löschfristen und zulässige Darstellung richten sich nach den jeweiligen Anbieterbedingungen.

## Versions- und Teststatus

Die genaue WordPress-, PHP- und WooCommerce-Mindestversion sowie die zuletzt getesteten Versionen werden für jedes Release in der Kompatibilitätsmatrix und im Changelog veröffentlicht. So stimmen die Angaben mit dem freigegebenen Paket überein.

[Review Captain installieren](/review-captain/installation/) · [Integrationen](/review-captain/integrationen/) · [Support](/support/)
