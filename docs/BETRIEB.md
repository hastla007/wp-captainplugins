# Betrieb: Installation, Update, Rückfall und Pflege

Stand: 16. November 2026, Theme-Version 0.3.0. Diese Anleitung deckt Phase 10 der [Theme-Roadmap](../theme/ROADMAP.md) ab. Prüfwerkzeuge liegen unter [`tools/qa/`](../tools/qa/README.md).

## Voraussetzungen

| Komponente | Mindestens | Hinweis |
|---|---|---|
| WordPress | 6.6 | getestet mit 6.7 |
| PHP | 8.5 | Entscheidung der Inhaberin vom 16.11.2026; PHP 8.6 kommt in die Testmatrix |
| Datenbank | MySQL 9.7 (LTS) oder MariaDB 12.3 (LTS) | ältere Versionen: Warnung im Admin, keine Sperre |
| WooCommerce | laut Kompatibilitätsmatrix der Plugins | nur für Shop, Konto und Pro-Produkte |
| Yoast SEO | aktuelle Version | optional; übernimmt Titel, Beschreibungen, Social-Bilder, Sitemap, Schema |

**Website-Sprache:** Unter *Einstellungen → Allgemein* muss **Deutsch** eingestellt und das deutsche Sprachpaket installiert sein. Sonst liest ein Screenreader die WordPress-Bedienelemente auf Englisch vor („Skip to content“, „Open menu“, „Close menu“, „submenu“) und WooCommerce-Hinweise erscheinen englisch.

## 1. Paket bauen

```bash
tools/build-theme-zip.sh
```

Das Skript baut Inhalte und Übersetzungsvorlage neu, prüft alle PHP-Dateien und legt `dist/captain-plugins-<Version>.zip` an. Vor dem Bau `CHANGELOG.md` und die Version in `style.css` pflegen.

## 2. Vor jeder Aktivierung oder jedem Update: Sicherung

1. **Datenbank sichern** (Hoster-Backup oder `wp db export vor-theme-update.sql`).
2. **Theme-Ordner sichern:** `wp-content/themes/captain-plugins/` als ZIP kopieren. So bleibt die vorherige Version einspielbar.
3. **Site-Editor-Anpassungen sichern:** Unter *Design → Editor → Vorlagen/Template-Teile* gespeicherte Änderungen werden in der Datenbank gehalten und übersteuern die Theme-Dateien. *Design → Editor → Werkzeuge → Exportieren* speichert sie zusätzlich als ZIP.
4. Uhrzeit und aktuelle Theme-Version notieren.

## 3. Zuerst auf Staging

1. Staging aus der aktuellen Produktion klonen (Dateien und Datenbank).
2. ZIP über *Design → Themes → Theme hochladen* installieren bzw. ersetzen.
3. Optional *Design → Einrichtung → Website-Texte übernehmen*. Unveränderte Theme-Seiten werden aktualisiert, von Hand bearbeitete bleiben erhalten, nicht mehr gelieferte Seiten gehen auf Entwurf (siehe [Weiterleitungen](WEITERLEITUNGEN.md)).
4. Prüfen:
   ```bash
   cd tools/qa && npm install
   node validate-blocks.cjs
   node site-check.cjs --base https://staging.example.com --axe
   node smoke.cjs --base https://staging.example.com
   php seo-fields.php
   ```
5. Manuell: Kaufstrecke (Produkt → Warenkorb → Checkout → Bestätigung → Konto → Lizenzaktivierung im Pro-Add-on → Update), Blocks- und Classic-Checkout, Formulare, Menü mit Tastatur, eine Seite mit Screenreader.
6. Erst bei vollständig bestandener Prüfung in Produktion übernehmen.

## 4. Produktion und Smoke-Check

1. Wartungsfenster mit wenig Verkehr wählen, Sicherung nach Abschnitt 2 erstellen.
2. Theme-ZIP hochladen und ersetzen; ggf. Seitenimport wie auf Staging.
3. Caches leeren (Seiten-Cache, Objekt-Cache, CDN).
4. Sofort danach:
   ```bash
   node tools/qa/smoke.cjs --base https://www.example.com
   ```
   Der Smoke-Check prüft Startseite, Produkte, Captain Pro, Preise, License Captain, Dokumentation, Support und FAQ auf HTTP 200, H1, Header/Footer und Theme-CSS sowie 404-Status und Suche.
5. Eine Testbestellung im Shop-Testmodus oder mit 100-%-Gutschein durchführen, sofern der Shop das erlaubt.

## 5. Rückfallweg

| Problem | Maßnahme |
|---|---|
| Layoutfehler oder PHP-Fehler nach Theme-Update | Gesicherten Theme-Ordner aus Abschnitt 2 zurückkopieren (überschreibt die neue Version), Caches leeren, Smoke-Check wiederholen. |
| Kritischer Fehler, Admin nicht erreichbar | Per FTP/SSH `wp-content/themes/captain-plugins` umbenennen; WordPress wechselt auf ein Standard-Theme. Danach gesicherte Version einspielen. |
| Seiteninhalte durch Import ungewollt geändert | Betroffene Seiten über *Revisionen* zurücksetzen; nur bei größerem Schaden Datenbanksicherung einspielen (Bestellungen seit der Sicherung beachten!). |
| Site-Editor-Anpassungen verloren | Export aus Abschnitt 2 über *Design → Editor* wieder einspielen. |

Eine Datenbank-Wiederherstellung verwirft Bestellungen, Lizenzen und Konten, die nach der Sicherung entstanden sind. Sie ist deshalb nur das letzte Mittel.

## 6. Monitoring (datenschutzgerecht)

| Was | Empfehlung |
|---|---|
| Verfügbarkeit | Externer Uptime-Check der Startseite und von `/preise/` im 5-Minuten-Takt; Alarm per E-Mail. |
| PHP-Fehler | `WP_DEBUG_LOG` auf Staging; in Produktion Fehlerprotokoll des Hosters täglich prüfen bzw. automatisch melden lassen. `WP_DEBUG_DISPLAY` in Produktion immer aus. |
| Checkout-Abbrüche | WooCommerce-Berichte (fehlgeschlagene und abgebrochene Bestellungen) wöchentlich prüfen; Zahlungsanbieter-Dashboard für Fehlversuche. |
| Suchanfragen | WordPress-interne Suche ohne Fremddienst auswerten, z. B. über die Server-Logs (`?s=`) oder ein lokal speicherndes Plugin. |
| CTA-Klicks | Nur mit Einwilligung und einem datenschutzkonform eingerichteten Analysewerkzeug; das Theme liefert kein Tracking mit. In der Datenschutzerklärung aufführen. |
| Search Console | Indexierung, Crawling-Fehler und Core Web Vitals monatlich prüfen. |

## 7. Pflegezyklus

| Rhythmus | Aufgabe |
|---|---|
| wöchentlich | WordPress-, Plugin- und Theme-Updates zuerst auf Staging einspielen; Smoke-Check; danach Produktion. Sicherheitsupdates sofort. |
| monatlich | `site-check.cjs --axe` gegen Produktion; Search Console; tote Links; Preise und Kompatibilitätsangaben mit den Plugin-Releases abgleichen. |
| je Plugin-Release | Kompatibilitätsmatrix, Changelog-Seiten, Produkt- und FAQ-Texte aktualisieren (`texte/homepage/`), Inhalte neu bauen, Seitenimport auf Staging. |
| vierteljährlich | Barrierefreiheit manuell (Tastatur, Screenreader, Zoom), Ladezeiten, Datenschutzerklärung auf neue Dienste prüfen. |
| jährlich | PHP-/Datenbank-Mindestversionen überprüfen, Rechtstexte prüfen lassen, Bildrechte und Screenshots aktualisieren. |

## 8. Nach größeren WordPress-, WooCommerce- oder Produkt-Releases

Diese Seitentypen erneut durchgehen (automatisch mit `site-check.cjs`, zusätzlich per Sichtprüfung):

- Startseite, Produktübersicht, je eine Produkt-, Features-, Pro- und FAQ-Seite
- Preise, Captain Pro, License-Captain-Preise
- Kompatibilität und Integrationen (breite Tabellen)
- Dokumentation/Installation, ein Ratgeberartikel, Suche, 404
- Warenkorb, Checkout (Blocks und Classic), Bestellbestätigung, Mein Konto inklusive Lizenzansicht
- Block-Editor: eine Seite öffnen; es darf keine Meldung „Dieser Block enthält unerwarteten oder ungültigen Inhalt“ erscheinen (vorab: `node tools/qa/validate-blocks.cjs`).
