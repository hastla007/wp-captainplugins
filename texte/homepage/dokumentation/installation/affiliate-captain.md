---
url: /dokumentation/installation/affiliate-captain/
seo_title: Affiliate Captain installieren und einrichten
meta_description: Installieren Sie Affiliate Captain, richten Sie Partnerseiten, Provisionen, Auszahlungen und sichere Einstellungen ein.
focus_keyphrase: Affiliate Captain installieren
---

# Affiliate Captain installieren und das Partnerprogramm einrichten

Affiliate Captain verwaltet Partnerbewerbungen, Links, Attribution, Provisionen und Auszahlungsläufe. Es kann eigenständig oder mit einer optionalen WooCommerce-Integration arbeiten.

## Voraussetzungen

- WordPress 6.3 oder neuer
- PHP 7.4 oder neuer
- Erweiterungen sodium und dom
- zip wird für den Programmexport benötigt
- WooCommerce 8.0 oder neuer nur für die optionale WooCommerce-Integration

Erstellen Sie ein Backup und richten Sie das Programm zunächst auf einer Staging-Website ein.

## 1. Plugin installieren

Laden Sie das Plugin-Paket aus [Download-Quelle ergänzen] herunter. Installieren Sie es unter **Plugins → Installieren → Plugin hochladen** und aktivieren Sie Affiliate Captain.

## 2. Partnerseiten anlegen

Die Einrichtungs-Checkliste führt durch die ersten Schritte. Sie können Bewerbung, Partnerbereich und Begrüßungsseite automatisch anlegen lassen. Alternativ verwenden Sie die bereitgestellten Blöcke oder Shortcodes für die Bewerbungsseite, das Partnerportal und die Begrüßungsseite.

> **Screenshot-Platzhalter 1 – Einrichtungs-Checkliste:** Zeigen Sie die Affiliate-Captain-Startseite nach Aktivierung mit den empfohlenen Einrichtungsschritten und der Option, die Partnerseiten automatisch anzulegen. Site-URL und Kontodaten anonymisieren.

## 3. Regeln und Bedingungen festlegen

Legen Sie Teilnahmebedingungen, Standardprovision, Haltefrist und Mindestbetrag fest. Organisieren Sie Partner bei Bedarf in Gruppen und definieren Sie abweichende Regeln für Partner, Produkte, Kategorien oder SKUs. Testen Sie Referral-Link und Partnercode mit einer Testbestellung.

> **Screenshot-Platzhalter 2 – Provisionseinstellungen:** Zeigen Sie Standardprovision, Haltefrist und Mindestbetrag mit fiktiven Werten. Keine echten Vertragstexte oder personenbezogenen Daten einblenden.

## 4. Auszahlungen vorbereiten

Hinterlegen Sie unter den Auszahlungseinstellungen die Unternehmensangaben und das Firmenkonto für SEPA. Für Gutschriften pflegen Sie Anschrift und die für Ihren Prozess erforderlichen Steuerangaben. Stimmen Sie das Gutschriftverfahren und die Partnerbedingungen fachlich ab.

Für eine produktive Installation sollte ein eigener Verschlüsselungsschlüssel in der Serverkonfiguration liegen. Halten Sie ihn geheim, speichern Sie ihn nicht im Repository und sichern Sie ihn in Ihrer zugriffsgeschützten Schlüsselverwaltung.

> **Screenshot-Platzhalter 3 – Auszahlungseinstellungen:** Zeigen Sie die Felder für SEPA-Auszahlung und Gutschriftkonfiguration mit ausschließlich erfundenen Daten. IBAN, Steuer-ID und Adresse dürfen keine echten Werte enthalten.

## 5. Cache und Reverse Proxy prüfen

Seiten mit Bewerbungsformular und Partnerbegrüßung sowie Seiten, auf denen Partnerparameter erfasst werden, müssen vom Seiten- oder CDN-Cache korrekt behandelt werden. Prüfen Sie die Cache-Regeln, wenn Formulare oder Partnerlinks über ein Widget oder Theme-Template ausgegeben werden. Hinter Cloudflare oder einem Reverse Proxy tragen Sie dessen IP-Bereiche gemäß der Dokumentation ein.

> **Screenshot-Platzhalter 4 – Missbrauchsschutz:** Zeigen Sie die Einstellungen für Reverse Proxy und Cache-Hinweise. IP-Adressen nur aus reservierten Beispieldokumentationsbereichen verwenden.

## 6. Testpartner bis zur Auszahlung begleiten

Legen Sie einen Testpartner an, folgen Sie einem Referral-Link und prüfen Sie die zugeordnete Bestellung. Kontrollieren Sie Provision, Haltefrist, eventuelle Refund-Korrektur, Auszahlungslauf und SEPA-Export in einer Testumgebung.

> **Screenshot-Platzhalter 5 – Partnerportal und Auszahlungslauf:** Zeigen Sie Testpartnerdaten, eine Beispielprovision und einen Testlauf. Partnername, IBAN, Bestellungen und Beträge müssen fiktiv sein.

[Affiliate Captain Features](/affiliate-captain/features/) · [FAQ](/affiliate-captain/faq/) · [Dokumentation](/dokumentation/)