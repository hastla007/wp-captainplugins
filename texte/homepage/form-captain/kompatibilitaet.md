---
url: /form-captain/kompatibilitaet/
seo_title: Form Captain Kompatibilität – WordPress, WooCommerce und Blöcke
meta_description: Prüfen Sie die Form-Captain-Voraussetzungen für WordPress, E-Mail, Gutenberg, WooCommerce und Captain-Suite-Integrationen.
focus_keyphrase: Form Captain Kompatibilität
---

# Form Captain: Kompatibilität und Voraussetzungen

Form Captain ist ein WordPress-natives Formularplugin. Die genaue Versionsmatrix wird pro Release veröffentlicht, damit Mindestanforderungen und getestete Umgebungen zum tatsächlich freigegebenen Paket passen.

## Kompatibilitätsübersicht

| System | Verwendung | Voraussetzung |
|---|---|---|
| WordPress | Formularverwaltung, Editor, Entries und Privacy-Hooks | Version 6.8 oder neuer |
| PHP | Ausführung des Plugins und Pro-Add-ons | Version 8.3 oder neuer |
| Gutenberg / Block-Editor | Formularblock und Vorschau | WordPress-Block-Editor; Shortcode als Fallback |
| Klassischer Editor | Formular-Einbettung | Shortcode |
| WooCommerce | Produktanfragen und optionale Shopkontexte | Optional ab Version 8.0; HPOS und klassischer Bestellspeicher; Checkout-Blocks-Integration nicht in v1.0 |
| SMTP-/Mail-Plugins | Versand von Benachrichtigungen | Optional; Zustellung hängt vom Mailserver und Anbieter ab |
| Captain-Suite-Plugins | Versionierte Form-Aktionen und Übergaben | Verfügbarer Adapter und kompatible Vertragsversion |
| Multisite | Netzwerkweite Installation | In Version 1.0 nicht unterstützt |

## Theme und Pagebuilder

Formulare verwenden responsives Frontend-Markup und Theme-erbliche Farben. Gutenberg-Block und Shortcode bieten Einbettungswege. Pagebuilder-Integrationen werden nur ausgewiesen, wenn die jeweilige Version praktisch geprüft ist.

## Datenschutz und externe Dienste

Der Kern lädt keine verpflichtenden externen Form-Skripte. Captcha und Drittanbieterintegrationen werden ausdrücklich aktiviert und in der Datenschutzhinweis- und Datenflussdokumentation beschrieben. Entries bleiben standardmäßig auf der WordPress-Website.

## Versions- und Teststatus

WordPress-, PHP-, WooCommerce-, Checkout-Block-, HPOS-, Caching-, Security-, SMTP- und Pagebuilder-Versionen werden in der Release-Kompatibilitätsmatrix mit Testdatum dokumentiert.

[Installation](/form-captain/installation/) · [Integrationen](/form-captain/integrationen/) · [Support](/support/)
