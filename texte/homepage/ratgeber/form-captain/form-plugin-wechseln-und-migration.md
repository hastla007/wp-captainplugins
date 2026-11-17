---
url: /ratgeber/form-captain/form-plugin-wechseln-und-migration/
seo_title: WordPress-Formularplugin wechseln – Migration vorbereiten
meta_description: So bereiten Sie den Wechsel eines WordPress-Formularplugins vor: Formulare inventarisieren, Felder abgleichen, Entries sichern und Migration prüfen.
focus_keyphrase: WordPress Formular Plugin wechseln
---

# Ein WordPress-Formularplugin wechseln: Migration sicher vorbereiten

Ein Wechsel betrifft nicht nur das Formularlayout. Feldschlüssel, Benachrichtigungen, Einwilligungen, Weiterleitungen und gespeicherte Entries können sich je Plugin unterscheiden. Eine strukturierte Bestandsaufnahme verhindert, dass wichtige Anfragen oder Abläufe verloren gehen.

## Formulare und Abhängigkeiten inventarisieren

Notieren Sie Einbettungsseiten, Feldtypen, Pflichtfelder, Bestätigungen, E-Mail-Regeln, Captcha, Integrationen und Weiterleitungen. Kennzeichnen Sie Formulare, die für Verkauf, Support oder Terminbuchung kritisch sind.

## Entries sichern und Feldzuordnung prüfen

Exportieren Sie vorhandene Daten aus dem bisherigen Plugin, sichern Sie die Website und vergleichen Sie Quell- und Zielfelder. Unbekannte Feldtypen oder bedingte Regeln brauchen eine explizite Zuordnung. Löschen Sie Quelldaten erst nach erfolgreicher Prüfung und Backup.

## Testen, dann umstellen

Erstellen Sie das neue Formular zunächst auf Staging. Testen Sie Pflichtfelder, E-Mail-Versand, Eintragsspeicherung, Export, Berechtigungen und mobile Darstellung. Aktivieren Sie anschließend die neue Version auf der Live-Seite und beobachten Sie die ersten Einsendungen.

Form Captain ist für die zentrale Verwaltung von Formulareinsendungen in WordPress ausgelegt. Formulare aus einem verbreiteten Shortcode-Formularformat fügen Sie unter **Form Captain → Formulare** als Quelltext ein; eine Vorschau mit Konvertierungsbericht zeigt, welche Felder übernommen, angepasst oder verworfen werden, und das Formular entsteht als Entwurf. Datei-Upload-, Quiz- und Captcha-Tags werden dabei nicht übernommen. Vorhandene Einträge importieren Sie aus einer CSV-Datei mit Spaltenzuordnung und Trockenlauf; ein Import lässt sich innerhalb von 7 Tagen rückgängig machen. Die Daten des bisherigen Plugins bleiben unverändert. Ein automatischer verlustfreier Import jedes Fremdplugins ist nicht vorgesehen.

[Form Captain installieren](/form-captain/installation/) · [Support kontaktieren](/support/)
