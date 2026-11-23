---
url: /ratgeber/workflow-captain/woocommerce-bestellungen-automatisieren/
seo_title: WooCommerce-Bestellungen automatisieren
meta_description: Planen Sie sichere WooCommerce-Automationen für Bestellungen, Refunds und Statuswechsel mit klaren Regeln, Protokollen und Deduplizierung.
focus_keyphrase: WooCommerce Bestellungen automatisieren
---

# WooCommerce-Bestellungen automatisieren

Automatisierte Bestellabläufe sparen manuelle Schritte, wenn sie auf verlässlichen Ereignissen und klaren Zuständigkeiten beruhen. Beginnen Sie mit einem eng umrissenen Prozess und testen Sie ihn vor der Aktivierung mit Bestell- und Refund-Szenarien.

## Geeignete Startpunkte

Workflow Captain bietet ab WooCommerce 11.2.2 die Auslöser „Bestellung angelegt“, „bezahlt“, „Statuswechsel“, „erstattet“ und „storniert“, mit HPOS und klassischen Bestelltabellen. Produkt- oder Coupon-Ereignisse gehören nicht dazu. Gastbestellungen benötigen eigene Regeln, wenn keine WordPress-Benutzer-ID vorliegt.

## Bedingungen und Daten sparsam wählen

Workflow Captain übergibt Status, Beträge in kleinster Einheit, Währung, Anzahl der Positionen, Zahlungsart und Kennungen – nie Adressen, E-Mail-Adressen, Namen, IP-Adresse, Kundennotiz oder Gutscheincodes. Nutzen Sie in Bedingungen nur die Felder, die für die Entscheidung gebraucht werden. Eine Nachricht an Kundinnen und Kunden mit Konto adressiert der Workflow über die Benutzer-ID; die E-Mail-Adresse wird erst beim Versand aufgelöst.

## Refunds und doppelte Events behandeln

Refunds können teilweise oder vollständig erfolgen. Workflow Captain unterscheidet Erstattungen über ihre Refund-ID und erkennt doppelte Ereignisse. Vermeiden Sie trotzdem, mit mehreren ähnlichen Auslösern dieselbe Wirkung doppelt auszuführen. Ist unklar, ob eine Nachricht schon hinausging, hält der Lauf an und ein Mensch entscheidet.

## Geschäftslogik beim zuständigen Plugin lassen

Ein Workflow kann benachrichtigen, markieren, Notizen anlegen oder – mit Pro – einen freigegebenen Service aufrufen. Bestellungen ändert er nicht. Er sollte keine eigene Provisionsberechnung, Auszahlung, Ticketvergabe oder Gutscheinbuchhaltung ersetzen. Verwenden Sie dafür die öffentliche Schnittstelle des Fachplugins.

Workflow Captain enthält den WooCommerce-Provider, Wiederholung und Laufprotokoll im kostenlosen Kern; Pro ergänzt Suite-Verbindungen, Webhooks, Event-Korrelation und den Abbruch geplanter Abläufe bei Erstattung oder Storno.

[Workflow Captain Features](/workflow-captain/features/) · [Voraussetzungen](/workflow-captain/kompatibilitaet/) · [Preise](/preise/)
