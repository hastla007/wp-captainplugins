---
url: /ratgeber/license-captain/plugin-updates-lizenzstatus/
seo_title: WordPress-Plugin-Updates an Lizenz und Berechtigung binden
meta_description: Verknüpfen Sie WooCommerce-Lizenzen, Entitlements und Updatebereitstellung für Ihre WordPress-Produkte mit License Captain.
focus_keyphrase: WordPress Plugin Updates verkaufen
---

# Plugin-Updates mit Lizenzstatus und Berechtigungen steuern

Ein kommerzielles Plugin benötigt einen klaren Zusammenhang zwischen Kauf, Lizenz und Updatezugriff. License Captain verwaltet diese Informationen zentral und stellt eine signierte API für Ihre Produkt-Plugins bereit.

## Berechtigungen definieren

Ordnen Sie einem Lizenzplan Entitlements zu. Damit bestimmen Sie, welche Produktfunktionen und Leistungen für den jeweiligen Plan verfügbar sind. Produkte, Pläne und Funktionsbezeichnungen können Sie als Katalogdatei (`wplc-catalog.json`) mit dem Release-Paket ausliefern; der Shop spielt sie beim Anlegen des Releases ein.

## Den Client in Ihr Plugin einbinden

Binden Sie den License-Captain-Client in Ihr Plugin ein und liefern Sie ihn mit Ihrem Plugin aus. Der Client fragt Lizenzstatus und Berechtigungen über signierte Requests bei Ihrem Server ab und prüft die Ed25519-Signatur der Antworten gegen den öffentlichen Schlüssel, den Sie im Plugin hinterlegen. Ein Offline-Fenster überbrückt kurze Ausfälle des Servers, Fehlerfälle zeigt er verständlich an. Ihre Kunden aktivieren den Lizenzschlüssel direkt in Ihrem Plugin.

## Releases bereitstellen

Laden Sie Release-ZIPs in einen privaten Speicher oder S3-kompatiblen Bucket oder registrieren Sie eine HTTPS-Paketadresse mit SHA-256-Prüfsumme. Releases lassen sich veröffentlichen und wieder zurückziehen. Kunden mit gültigem Updatezugriff erhalten die Updates in der normalen WordPress-Updateanzeige, geladen über kurzlebige Einmal-Downloadlinks.

## Release-Notizen sichtbar machen

Changelogs können pro Produkt in Kundenkonten oder auf Dokumentationsseiten eingebunden werden. So sehen Anwender, welche Änderungen ein Release enthält.

[Screenshot-Platzhalter: Releaseverwaltung mit Produkt, Version, Paketstatus und Prüfsumme zeigen; Paketadresse und geheime Werte unkenntlich machen.]  
[Diagramm: Lizenzprüfung und Update]

License Captain liefert beide Bausteine: den Server für Ihren WooCommerce-Shop und den Client, den Sie in Ihre Plugins einbinden.

**[License Captain kennenlernen](/license-captain/)** · [Features und Integrationswege](/license-captain/features/) · [Technische Dokumentation](/dokumentation/)
