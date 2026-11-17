---
url: /workflow-captain/integrationen/
seo_title: Workflow Captain Integrationen: WooCommerce und Webhooks
meta_description: Verbinden Sie WordPress, WooCommerce und Captain-Plugins über versionierte Provider, separate Projekt-Connectoren und signierte Webhooks.
focus_keyphrase: Workflow Captain Integrationen
---

# Workflow Captain Integrationen

Workflow Captain nutzt Providerverträge, damit Ereignisse und Aktionen zwischen Plugins nachvollziehbar und versioniert bleiben. Free deckt WordPress Core, WooCommerce und Zeitpläne ab. Pro ergänzt die Captain Suite, eigene Connectoren, signierte Webhooks und n8n.

## WordPress und WooCommerce im kostenlosen Kern

Der WordPress-Provider liefert die Auslöser „Benutzer registriert“ und „Beitrag veröffentlicht“ (öffentliche Inhaltstypen). Der optionale WooCommerce-Provider ab WooCommerce 11.2.2 liefert „Bestellung angelegt“, „bezahlt“, „Statuswechsel“, „erstattet“ und „storniert“ – mit HPOS und klassischen Bestelltabellen. Übergeben werden Kennungen, Status, Beträge und Währung, nie Namen, E-Mail-Adressen, Anschriften oder Gutscheincodes. Bestellungen und Inhalte werden von Workflows nicht verändert.

## Captain-Suite-Provider in Pro

Workflow Captain Pro enthält Provider für folgende Produkte:

- **Voucher Captain:** Ausstellung, Zustellung und Zustellfehler, Einlösung, Reservierung, Ablauf, Sperre und Reaktivierung, Guthaben und Aufladung. Als Aktionen stehen Ausstellen, Sperren, Reaktivieren und Einlösen bereit; Grenzen und Berechtigungen setzt Voucher Captain durch.
- **Pass Captain:** Bestellung bezahlt, storniert oder erstattet, Tickets ausgestellt oder widerrufen, Check-in und Check-out, verschobene oder abgesagte Termine und Events, Erstattungen und Belege.
- **Affiliate Captain:** Partner, zugeordnete Verkäufe, Provisionen, Auszahlungen, Werbemittel und Code-Anfragen.
- **Form Captain:** Formulare und Einsendungen, Statuswechsel, Löschung, Import, Widerruf der Einwilligung und fehlgeschlagene Benachrichtigungen – nur mit freigegebenen Feldern.
- **Review Captain:** Review angelegt, Status geändert und entfernt; die Review-Schutzregeln bleiben bei Review Captain.

Für jede Verbindung müssen das Fachplugin mit kompatiblem Providervertrag und eine gültige Lizenz seines Pro-Add-ons vorhanden sein. Die genauen Mindestversionen stehen in der Kompatibilitätsübersicht. Geschäftslogik und Datenhoheit bleiben beim jeweiligen Fachplugin. Ein Provider für Course Captain ist für eine spätere Version vorgesehen.

## Webhooks, n8n und eigene Connectoren

Pro unterstützt signierte Ein- und Ausgangswebhooks und n8n-Verbindungen sowie einen versionierten Vertrag für separate Connector-Plugins. Webhooks verwenden konfigurierte HTTPS-Ziele, HMAC-Signatur mit Zeitfenster, Rate-Limits und Replay-Schutz. Connectoren deklarieren Ereignisse und Datenfelder in einem Manifest; jeder Connector ist ab Werk aus und wird vom Betreiber freigegeben, personenbezogene Felder nur ausdrücklich. Direkte Tabellenzugriffe und freie Codeausführung sind ausgeschlossen.

Projektbezogene BoatingSchool- oder LearnBoating-Verbindungen sind keine pauschal enthaltenen Standardintegrationen. Sie erfordern ein separates Connector-Plugin, passende Schnittstellen und abgestimmte Datenfreigaben.

[Kompatibilität](/workflow-captain/kompatibilitaet/) · [Workflow Captain Pro](/workflow-captain/pro/) · [Alle Captain-Integrationen](/integrationen/)

[Screenshot-Platzhalter: Integrationsübersicht mit WordPress, WooCommerce, Captain-Providern und Webhooks zeigen. Pro-Verträge, Versionsstatus und letzte Verbindung kenntlich machen. Keine echten Endpunkte, Schlüssel oder Payloads zeigen.]
