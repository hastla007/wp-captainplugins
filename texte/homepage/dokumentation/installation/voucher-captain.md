---
url: /dokumentation/installation/voucher-captain/
seo_title: Voucher Captain installieren und einrichten
meta_description: Installieren Sie Voucher Captain, richten Sie Ihr erstes Gutscheinprodukt ein und testen Sie PDF, Zustellung und Einlösung.
focus_keyphrase: Voucher Captain installieren
---

# Voucher Captain installieren und den ersten Gutschein einrichten

Voucher Captain erweitert WooCommerce um Gutscheinprodukte, Geschenkkarten, PDF-Gestaltung, Zustellung und Einlösung.

## Voraussetzungen

- WordPress 6.4 oder neuer
- WooCommerce 8.9 oder neuer
- PHP 8.5 oder neuer
- MySQL 9.7 (LTS) oder MariaDB 12.3 (LTS) oder neuer
- PHP-Erweiterungen GD, mbstring und zip

Aktivieren Sie zuerst WooCommerce. Erstellen Sie vor der Installation ein Backup und testen Sie den Ablauf möglichst zunächst auf einer Staging-Website.

## 1. Plugin installieren

Laden Sie das Voucher-Captain-ZIP aus [Download-Quelle ergänzen] herunter. Öffnen Sie in WordPress **Plugins → Installieren → Plugin hochladen**, wählen Sie die ZIP-Datei, installieren Sie das Plugin und aktivieren Sie es anschließend.

Nach der Aktivierung werden Startvorlagen für eine Geschenkkarte im A5-Format und einen Gutschein- oder Leistungspass im A6-Format angelegt.

> **Screenshot-Platzhalter 1 – Plugin aktiviert:** Zeigen Sie die WordPress-Pluginliste mit aktivem Voucher Captain und WooCommerce. Sichtbar sollen Pluginname und Aktivierungsstatus sein; E-Mail, Website-Adresse und andere installierte Plugins ausblenden.

## 2. Gutscheinprodukt anlegen

Erstellen Sie unter **Produkte** ein neues einfaches oder variables WooCommerce-Produkt. Aktivieren Sie in den Produktdaten die Option **Gutschein** und öffnen Sie den Tab **Gutschein**.

Legen Sie fest, ob der Gutschein den Produktpreis verwendet, einen festen Wert besitzt oder einen Wunschbetrag zulässt. Definieren Sie bei Bedarf Ablauf, Empfängerangaben, Produkteinschränkungen und weitere Einlösebedingungen.

> **Screenshot-Platzhalter 2 – Produktdaten „Gutschein“:** Zeigen Sie einen Beispielartikel mit aktivierter Gutscheinoption und geöffnetem Gutschein-Tab. Die Ansicht soll Wertart, Wunschbetrag-Einstellungen und Empfängerfelder erkennen lassen. Produktpreis und interne IDs dürfen fiktiv sein.

## 3. PDF-Vorlage gestalten

Wählen Sie eine Startvorlage oder erstellen Sie ein eigenes Design. Platzieren Sie Logo, Texte, Gutscheinwert, Code und optional QR- oder Barcode. Prüfen Sie die Vorschau mit langen Namen und mit leeren optionalen Feldern.

> **Screenshot-Platzhalter 3 – PDF-Designer:** Zeigen Sie die Arbeitsfläche mit einer neutral gebrandeten Gutscheinvorlage, sichtbarer Elementleiste und Vorschau. Einen Beispielcode verwenden, der nicht eingelöst werden kann.

## 4. Zustellung konfigurieren

Wählen Sie, ob der Gutschein sofort, nach einer Frist oder zu einem Wunschdatum versendet wird. Legen Sie fest, ob Käufer, Empfänger oder beide die E-Mail erhalten. Prüfen Sie Betreff, Nachricht, PDF-Anhang und den Link zum Abruf.

> **Screenshot-Platzhalter 4 – Zustellung:** Zeigen Sie die Versandoptionen für Zeitpunkt und Empfänger sowie den E-Mail-Vorlagenbereich. Echte E-Mail-Adressen durch beispiel@firma.test ersetzen.

## 5. Testbestellung und Einlösung durchführen

Führen Sie eine Testbestellung mit einem Test-Zahlungsweg aus. Prüfen Sie Gutschein-PDF, Empfängerangaben und Kundenkonto. Verwenden Sie den Code im Checkout und kontrollieren Sie Status und Verlauf in der Gutscheinverwaltung. Testen Sie bei einer Geschenkkarte auch eine Teilnutzung und das verbleibende Guthaben.

> **Screenshot-Platzhalter 5 – Gutschein im Kundenkonto:** Zeigen Sie einen Testgutschein mit Status und Downloadmöglichkeit. Code und Bestellnummer müssen unbrauchbar oder vollständig anonymisiert sein.

## Danach

Wenn der Testablauf passt, können Sie weitere Gutscheinprodukte, Vorlagen und Zustellregeln einrichten. Firmenbestellungen, Wallet-Pässe und SMS-Zustellung finden Sie in [Voucher Captain Pro (in Vorbereitung)](/voucher-captain/pro/).

[Voucher Captain Features](/voucher-captain/features/) · [FAQ](/voucher-captain/faq/) · [Support](/support/)

**Captain-Pro-Hinweis:** Wenn Sie Voucher Captain Pro (in Vorbereitung) installieren, benötigt die kombinierte Installation mindestens WordPress 6.5+. Die übrigen Anforderungen des Kerns bleiben bestehen. [Vollständige Kompatibilitätsmatrix](/kompatibilitaet/).