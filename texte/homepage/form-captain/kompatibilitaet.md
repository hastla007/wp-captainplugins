---
url: /form-captain/kompatibilitaet/
seo_title: Form Captain Kompatibilität: WordPress und WooCommerce
meta_description: Prüfen Sie die Form-Captain-Voraussetzungen für WordPress, E-Mail, Gutenberg, WooCommerce und Captain-Suite-Integrationen.
focus_keyphrase: Form Captain Kompatibilität
---

# Form Captain: Kompatibilität und Voraussetzungen

Form Captain ist ein WordPress-natives Formularplugin. Die genaue Versionsmatrix wird pro Release veröffentlicht, damit Mindestanforderungen und getestete Umgebungen zum tatsächlich freigegebenen Paket passen.

## Kompatibilitätsübersicht

| System | Verwendung | Voraussetzung |
|---|---|---|
| WordPress | Formularverwaltung, Editor, Entries und Privacy-Hooks | Version 6.8 oder neuer |
| PHP | Ausführung des Plugins und Pro-Add-ons | Version 8.5 oder neuer |
| Datenbank | Speicherung von Formularen und Einsendungen | MySQL 9.7 (LTS) oder MariaDB 12.3 (LTS) oder neuer; ältere Versionen erzeugen eine Warnung |
| Gutenberg / Block-Editor | Block „Form Captain“ mit Vorschau | WordPress-Block-Editor; Shortcode als Fallback |
| Klassischer Editor | Formular-Einbettung | Shortcode `[form_captain id="…"]` |
| WooCommerce | Käuferfragebögen nach dem Kauf (Pro) | Optional ab Version 11.2; HPOS und klassischer Bestellspeicher; Bestellungen aus klassischem und Block-Checkout; Zuordnung im klassischen Produkteditor. Der Kern greift nicht in WooCommerce ein |
| SMTP-/Mail-Plugins | Versand von Benachrichtigungen | Optional; Zustellung hängt vom Mailserver und Anbieter ab |
| Captain-Suite-Plugins | Versionierte Form-Aktionen und Übergaben | Verfügbarer Adapter und kompatible Vertragsversion |
| Multisite | Netzwerkweite Installation | In Version 1.0 nicht unterstützt |

## Theme und Pagebuilder

Formulare verwenden responsives Frontend-Markup und übernehmen wahlweise Schrift und Farben des Themes oder einen schlichten Basisstil mit Akzentfarbe. Gutenberg-Block und Shortcode bieten Einbettungswege; Pagebuilder binden Formulare über den Shortcode ein. CSS und JavaScript werden nur auf Seiten mit Formular geladen.

Formulare enthalten keinen WordPress-Nonce und sind damit für Seiten-Caches geeignet; die REST-Routen unter `/wp-json/form-captain/v1/` sollten vom Cache ausgenommen bleiben. Ohne JavaScript werden Formulare über `admin-post.php` abgesendet.

## Datenschutz und externe Dienste

Der Kern lädt keine externen Skripte oder Schriften. Captcha-Erweiterungen und Drittanbieterintegrationen werden ausdrücklich aktiviert und in der Datenschutzhinweis- und Datenflussdokumentation beschrieben. Entries bleiben standardmäßig auf der WordPress-Website.

## Versions- und Teststatus

WordPress-, PHP-, WooCommerce-, Checkout-Block-, HPOS-, Caching-, Security-, SMTP- und Pagebuilder-Versionen werden in der Release-Kompatibilitätsmatrix mit Testdatum dokumentiert.

[Installation](/form-captain/installation/) · [Integrationen](/form-captain/integrationen/) · [Support](/support/)
