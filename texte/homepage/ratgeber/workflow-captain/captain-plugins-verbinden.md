---
url: /ratgeber/workflow-captain/captain-plugins-verbinden/
seo_title: Captain-Plugins mit Workflows sicher verbinden
meta_description: So verbinden Sie Captain-Plugins über versionierte Provider, klare Datenverantwortung und geprüfte Aktionen in Workflow Captain.
focus_keyphrase: Captain Plugins verbinden
---

# Captain-Plugins mit Workflows verbinden

Mehrere Plugins in einem Geschäftsprozess einzusetzen, sollte nicht bedeuten, ihre Datenbanken direkt miteinander zu koppeln. Eine stabile Integration braucht einen klaren Ereignisvertrag, definierte Aktionen und nachvollziehbare Zuständigkeiten.

## Das Quellplugin bleibt maßgeblich

Voucher Captain verwaltet Gutscheine, Pass Captain Tickets und Einlass, Affiliate Captain Partner und Provisionen, Form Captain Einsendungen, Review Captain Reviews. Workflow Captain koordiniert die freigegebenen Übergaben, berechnet aber keine Fachlogik nach.

## Verträge versionieren

Jeder Provider sollte seine Ereignisse, Tokens, Pflichtversionen, Berechtigungen und Fehlercodes deklarieren. Bei inkompatiblen Änderungen muss ein betroffener Workflow verständlich pausieren oder eine Migration verlangen, statt Felder stillschweigend umzudeuten.

## Daten und Seiteneffekte begrenzen

Payloads sollten minimiert und sensible Angaben standardmäßig ausgeschlossen werden. Aktionen mit Außenwirkung benötigen Idempotenz und nachvollziehbare Statusmeldungen. Besonders bei Refunds, Stornos und Opt-outs muss ein Ablauf den aktuellen Geschäftsstatus erneut prüfen.

Workflow Captain Pro bündelt versionierte Provider für Pass, Voucher, Affiliate, Form und Review Captain. Ein Provider meldet sich nur an, wenn das jeweilige Kernplugin einen kompatiblen Providervertrag bereitstellt und dessen Pro-Add-on lizenziert ist. Erstattungen, Stornierungen, Provisionen, Auszahlungen oder Partnerstatus ändert ein Workflow nicht; einzige Aktionen mit Wirkung in einem Fachplugin sind die freigegebenen Gutschein-Aktionen von Voucher Captain.

[Integrationen im Detail](/workflow-captain/integrationen/) · [Pro-Funktionen](/workflow-captain/pro/) · [Dokumentation](/dokumentation/workflow-captain/)
