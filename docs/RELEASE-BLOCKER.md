# Release-Blocker

Automatisch erzeugt mit `python3 tools/release-blockers.py`. Alles hier muss vor dem Livegang ersetzt, entschieden oder bewusst ausgeblendet werden. Seiten mit Linkziel- oder Betreiber-Platzhaltern legt der Import als Entwurf an.

## Übersicht

| Art | Anzahl |
|---|---:|
| Fehlendes Linkziel | 29 |
| Betreiberangabe | 19 |
| Redaktioneller Vorbehalt | 13 |
| Medienplatzhalter | 112 |

Medienplatzhalter stehen einzeln im [Medieninventar](../texte/homepage/medieninventar.md).

## Fehlende Linkziele nach Art

| Ziel | Vorkommen |
|---|---:|
| Download-URL | 24 |
| Checkout-URL | 2 |
| License-Captain-Shop-URL | 1 |
| Checkout-Link je Plan ergänzen: Checkout-URL | 1 |
| Supportkontakt oder Formular ergänzen: Support-URL | 1 |

## Je Seite

### `/`

- **Fehlendes Linkziel:** „Kostenlos starten“ → Download-URL
- **Fehlendes Linkziel:** „Kostenlos starten“ → Download-URL
- **Fehlendes Linkziel:** „Kostenlos starten“ → Download-URL
- **Fehlendes Linkziel:** „Kostenlos starten“ → Download-URL

### `/affiliate-captain/`

- **Fehlendes Linkziel:** „Affiliate Captain kennenlernen“ → Download-URL

### `/affiliate-captain/pro/`

- **Fehlendes Linkziel:** „Affiliate Captain Pro auswählen“ → Checkout-URL
- **Fehlendes Linkziel:** „Kostenlosen Kern starten“ → Download-URL

### `/course-captain/`

- **Fehlendes Linkziel:** „Course Captain kostenlos starten“ → Download-URL

### `/course-captain/features/`

- **Fehlendes Linkziel:** „Course Captain kostenlos starten“ → Download-URL

### `/course-captain/pro/`

- **Fehlendes Linkziel:** „Course Captain kostenlos herunterladen“ → Download-URL

### `/datenschutz/`

- **Betreiberangabe:** Name, Anschrift und Kontakt des Verantwortlichen; ggf. Datenschutzbeauftragte Person
- **Betreiberangabe:** Hosting-Anbieter, verarbeitete Daten, Zweck, Rechtsgrundlage, Speicherdauer
- **Betreiberangabe:** WooCommerce-Bestellabwicklung, Kundenkonto, Rechnungsstellung, Zahlungsanbieter, Aufbewahrungsfristen
- **Betreiberangabe:** Verarbeitung bei Lizenzaktivierung und Updateabruf der Pro-Add-ons, z. B. Lizenzschlüssel, Website-Adresse, Plugin- und Systemversion; Zweck, Rechtsgrundlage, Speicherdauer
- **Betreiberangabe:** Kontaktformular, E-Mail, Supportsystem; Zweck, Rechtsgrundlage, Speicherdauer
- **Betreiberangabe:** Cookies und Dienste weiterer Plugins ergänzen, z. B. WooCommerce-Sitzungs- und Warenkorb-Cookies, Zahlungsanbieter, Einwilligungsverwaltung, Statistik, eingebettete Videos; nicht e
- **Betreiberangabe:** Auskunft, Berichtigung, Löschung, Einschränkung, Datenübertragbarkeit, Widerspruch, Widerruf von Einwilligungen, Beschwerderecht bei der zuständigen Aufsichtsbehörde
- **Betreiberangabe:** Datum der letzten Aktualisierung
- **Redaktioneller Vorbehalt:** Die Inhalte in doppelten eckigen Klammern sind vom Betreiber anhand der tatsächlich eingesetzten Dienste zu ergänzen und vor Veröffentlichung rechtlich prüfen zu lassen.

### `/dokumentation/installation/license-captain/`

- **Redaktioneller Vorbehalt:** Prüfen Sie vor Veröffentlichung die finale Release-Matrix.

### `/form-captain/`

- **Fehlendes Linkziel:** „Form Captain kostenlos starten“ → Download-URL

### `/impressum/`

- **Betreiberangabe:** Firmenname und Rechtsform
- **Betreiberangabe:** Straße und Hausnummer
- **Betreiberangabe:** PLZ, Ort, Land
- **Betreiberangabe:** E-Mail-Adresse
- **Betreiberangabe:** Telefonnummer, falls angegeben
- **Betreiberangabe:** Registergericht und Registernummer, falls eingetragen
- **Betreiberangabe:** UID/USt-IdNr.
- **Betreiberangabe:** Name der vertretungsberechtigten Person(en)
- **Betreiberangabe:** zuständige Behörde, Kammerzugehörigkeit und anwendbare Vorschriften, falls zutreffend
- **Betreiberangabe:** Name und Anschrift der inhaltlich verantwortlichen Person
- **Betreiberangabe:** Hinweis zur Verbraucherstreitbeilegung gemäß Geschäftsmodell prüfen und ergänzen
- **Redaktioneller Vorbehalt:** > Redaktionelle Vorlage: Alle Angaben in doppelten eckigen Klammern sind vom Betreiber zu ergänzen und vor Veröffentlichung rechtlich prüfen zu lassen.

### `/kompatibilitaet/`

- **Redaktioneller Vorbehalt:** HPOS sowie klassische und Blocks-Bestellungen sind Release-Gates; getestete Versionen sind vor Release zu ergänzen.
- **Redaktioneller Vorbehalt:** HPOS, klassischer und Block-Checkout sind Release-Gates für den Pro-Kursverkauf; getestete Versionen werden vor Release veröffentlicht.
- **Redaktioneller Vorbehalt:** Der erfolgreiche Lauf für die Mindestlinie muss vor dem finalen Release belegt werden.
- **Redaktioneller Vorbehalt:** | Voucher Captain | Produktdokumentation; konkreten öffentlichen Supportkontakt vor Veröffentlichung ergänzen | Single und Business: Standard-Support.
- **Redaktioneller Vorbehalt:** | Affiliate Captain | Produktdokumentation; konkreten öffentlichen Supportkontakt vor Veröffentlichung ergänzen | Single und Business: Standard-Support.

### `/license-captain/preise/`

- **Fehlendes Linkziel:** „Aktuelle License-Captain-Pläne ansehen“ → License-Captain-Shop-URL

### `/pass-captain/`

- **Fehlendes Linkziel:** „Pass Captain kennenlernen“ → Download-URL

### `/pass-captain/pro/`

- **Fehlendes Linkziel:** „Pass Captain Pro auswählen“ → Checkout-URL
- **Fehlendes Linkziel:** „Kostenlosen Kern starten“ → Download-URL

### `/preise/`

- **Fehlendes Linkziel:** „Checkout-Link je Plan ergänzen: Checkout-URL“ → Ziel fehlt
- **Redaktioneller Vorbehalt:** Verbindliche Antwortzeiten und Supportkanal werden in den Tarifunterlagen noch nicht festgelegt.
- **Redaktioneller Vorbehalt:** *Vor Veröffentlichung die Preisanzeige, Umsatzsteuer, Verlängerung und Kündigungsbedingungen mit dem Shop abstimmen.

### `/produkte/`

- **Fehlendes Linkziel:** „Kostenlos starten“ → Download-URL
- **Fehlendes Linkziel:** „Kostenlos starten“ → Download-URL
- **Fehlendes Linkziel:** „Kostenlos starten“ → Download-URL

### `/ratgeber/affiliate-captain/sepa-auszahlungen-vorbereiten/`

- **Fehlendes Linkziel:** „Affiliate Captain testen“ → Download-URL

### `/ratgeber/voucher-captain/gutscheine-gestalten-versenden/`

- **Fehlendes Linkziel:** „Mit Voucher Captain starten“ → Download-URL

### `/ratgeber/voucher-captain/wunschwert-restguthaben/`

- **Fehlendes Linkziel:** „Voucher Captain kostenlos herunterladen“ → Download-URL

### `/review-captain/`

- **Fehlendes Linkziel:** „Review Captain kostenlos entdecken“ → Download-URL

### `/support/`

- **Fehlendes Linkziel:** „Supportkontakt oder Formular ergänzen: Support-URL“ → Ziel fehlt

### `/voucher-captain/`

- **Fehlendes Linkziel:** „Kostenlos herunterladen“ → Download-URL

### `/voucher-captain/pro/`

- **Fehlendes Linkziel:** „Voucher Captain kostenlos herunterladen“ → Download-URL

### `/workflow-captain/`

- **Fehlendes Linkziel:** „Workflow Captain kostenlos starten“ → Download-URL
- **Fehlendes Linkziel:** „Workflow Captain kostenlos herunterladen“ → Download-URL
- **Redaktioneller Vorbehalt:** Konkrete Kompatibilität und Provider-Mindestversionen werden vor Release in der Matrix ausgewiesen.

### `/workflow-captain/faq/`

- **Redaktioneller Vorbehalt:** Die tatsächlich getesteten Versionen und Mindeststände einzelner Suite-Provider müssen vor Veröffentlichung in der [Kompatibilitätsübersicht](/workflow-captain/kompatibilitaet/) be

### `/workflow-captain/integrationen/`

- **Redaktioneller Vorbehalt:** 0 vorgesehen; die geprüften Versionen werden vor Release ausgewiesen.

### `/workflow-captain/pro/`

- **Fehlendes Linkziel:** „Workflow Captain kostenlos herunterladen“ → Download-URL
