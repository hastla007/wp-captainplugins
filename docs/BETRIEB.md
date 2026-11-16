# Betrieb: Installation, Update, Rückfall und Pflege

Stand: 16. November 2026, Theme-Version 0.6.0. Diese Anleitung deckt Phase 10 der [Theme-Roadmap](../theme/ROADMAP.md) ab. Prüfwerkzeuge liegen unter [`tools/qa/`](../tools/qa/README.md).

## Voraussetzungen

| Komponente | Mindestens | Hinweis |
|---|---|---|
| WordPress | 6.6 | getestet bis 7.1.4 (mit WooCommerce 11.3, Yoast SEO 28.8, License Captain 0.2.0) |
| PHP | 8.5 | Entscheidung der Inhaberin vom 16.11.2026. **WordPress aktiviert das Theme auf älterem PHP nicht** („Requires PHP: 8.5“): Produktion und Staging vor dem Theme-Wechsel auf PHP 8.5 umstellen. PHP 8.6 kommt in die Testmatrix. |
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
   node site-check.cjs --base https://staging.example.com --axe --all-widths --seed /shop/,/warenkorb/,/kasse/,/mein-konto/ --ignore-axe label-content-name-mismatch
   node smoke.cjs --base https://staging.example.com --shop --shop-paths /shop/,/warenkorb/,/kasse/,/mein-konto/ --product /produkt/<slug>/
   node keyboard.cjs --base https://staging.example.com
   node shop-flow.cjs --base https://staging.example.com --cart /warenkorb/ --checkout /kasse/ --account /mein-konto/   # mit --order nur im Testmodus des Shops
   node visual.cjs --base https://staging.example.com   # vorher mit --update auf dem alten Stand Referenzbilder erzeugen
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

## Cache-Header für statische Dateien

Theme-CSS und -Bilder tragen eine Versionsnummer in der URL (`?ver=0.6.0`) und dürfen deshalb lange zwischengespeichert werden. Lighthouse schätzt die Ersparnis auf rund 145 KB pro Wiederbesuch.

Apache (`.htaccess`):

```apache
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType text/css "access plus 1 year"
  ExpiresByType application/javascript "access plus 1 year"
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType image/png "access plus 1 year"
  ExpiresByType image/svg+xml "access plus 1 year"
</IfModule>
```

nginx:

```nginx
location ~* \.(css|js|webp|jpe?g|png|svg)$ { expires 1y; add_header Cache-Control "public, immutable"; }
```

Messwerte der Testinstallation (Lighthouse 12, 16.11.2026): Performance mobil 96–98 / Desktop 100, Barrierefreiheit 100, SEO 100, Best Practices 100 nach Favicon-Korrektur; LCP mobil 2,0–2,5 s (simuliertes 4G), CLS 0.

## 6. Monitoring (datenschutzgerecht)

| Was | Empfehlung |
|---|---|
| Verfügbarkeit | **Eingerichtet:** Workflow `.github/workflows/uptime.yml` prüft stündlich Startseite, Preise, Captain Pro, Warenkorb und Kasse (HTTP 200, Antwortzeit, kein „kritischer Fehler“) und das TLS-Zertifikat (≥ 21 Tage). Bei einem Ausfall legt er das Issue „Website nicht verfügbar“ an und schließt es, sobald alles wieder läuft. Aktivieren: Repository-Variable `SITE_URL` (und bei deutschen Shop-Slugs `SHOP_PATHS`, z. B. `/warenkorb/,/kasse/`) setzen und das Repository „beobachten“. Für kürzere Intervalle zusätzlich einen externen Dienst nutzen. |
| License Captain | **Eingerichtet:** `tools/ops/captain-monitoring.php` als `wp-content/mu-plugins/captain-monitoring.php` ablegen. Es mailt die Gesundheitswarnungen von License Captain (`wplc/health_alert`: offene Verlängerungen, fehlgeschlagene Jobs, Lizenzprodukte ohne Plan …) an `CAPTAIN_MONITORING_EMAIL` bzw. die Admin-Adresse. Diagnose zusätzlich unter *WooCommerce → License diagnostics*. |
| PHP-Fehler | `WP_DEBUG_LOG` auf Staging; in Produktion Fehlerprotokoll des Hosters täglich prüfen bzw. automatisch melden lassen. `WP_DEBUG_DISPLAY` in Produktion immer aus. |
| Checkout-Abbrüche | **Eingerichtet** über dasselbe Must-Use-Plugin: täglich um 06:17 eine Mail mit der Zahl fehlgeschlagener, abgebrochener und offener Bestellungen der letzten 24 Stunden (nur Zahlen, keine Kundendaten; Schwelle per Filter `captain_monitoring_order_threshold`). Zahlungsanbieter-Dashboard für Fehlversuche zusätzlich prüfen. |
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

## WooCommerce: Hinweise aus dem Shop-Test

Geprüft mit WooCommerce 9.4 und den 15 Captain-Pro-Produkten aus dem Setup-Assistenten (16.11.2026).

- **Shop-Dateien:** Auf Inhaltsseiten ohne Shop-Blöcke lädt das Theme das klassische WooCommerce-CSS und die jQuery-Skripte nicht (Lighthouse Startseite 78 → 94). Abschalten mit `add_filter( 'captain_plugins_trim_shop_assets', '__return_false' );`.
- **Bestellzuordnung (Order Attribution):** WooCommerce lädt dafür auf allen Seiten `sourcebuster.js` und setzt `sbjs_*`-Cookies. Das Theme ändert das nicht. Entweder in der Datenschutzerklärung aufführen oder unter *WooCommerce → Einstellungen → Erweitert → Funktionen* abschalten.
- **Leerer Warenkorb:** Die WooCommerce-Vorlage zeigt „Neu im Shop“ mit Produktkacheln. Für einen Lizenz-Shop besser im Editor durch einen Hinweis und einen Link auf `/preise/` ersetzen.
- **Shop-Übersicht `/shop/`:** Die Pro-Produkte sind im Katalog standardmäßig verborgen, gekauft wird über die Preisseiten. Die Shop-Seite in Yoast auf noindex setzen oder per Weiterleitung auf `/preise/` führen.
- **Kasse für digitale Lizenzen:** Telefon und Lieferadresse sind nicht nötig; unter *WooCommerce → Einstellungen → Allgemein/Versand* bzw. im Checkout-Block die Felder auf das Nötige reduzieren.
- **E-Mail-Fußzeile:** Standardtext „Built with WooCommerce“ unter *WooCommerce → Einstellungen → E-Mails* ersetzen.
- **Bekannte WooCommerce-Befunde:** axe meldet `label-content-name-mismatch` am „In den Warenkorb“- und „Entfernen“-Button (Markup von WooCommerce, nicht vom Theme). Die Shop-Übersicht erreicht in Lighthouse rund 63 Punkte, weil WooCommerce dort viele Skripte im Kopf lädt.

## Staging-Nachbau und Ergebnisse (16.11.2026)

Geprüft auf WordPress 7.1.4 (de_DE), WooCommerce 11.3.0, Yoast SEO 28.8 und License Captain 0.2.0 mit MariaDB 10.11; dazu läuft `.github/workflows/staging-php85.yml` bei jedem Push mit PHP 8.5 gegen MySQL- und MariaDB-LTS.

- **Yoast:** genau ein Titel, eine Beschreibung, ein Canonical und ein robots-Tag je Seite; Titel/Beschreibung wie importiert; Social-Bild je Produktbereich; Warenkorb, Kasse, Konto und Suche noindex; Yoast-Sitemap ohne diese Seiten und ohne Autoren (`tools/qa/seo-head.py`). Empfehlung: in Yoast unter *Darstellung in der Suche → Inhaltstypen → Produkte* eine Beschreibungsvorlage mit `%%excerpt%%` setzen und die Organisation (Name, Logo) hinterlegen; die Shop-Seite auf noindex stellen.
- **License Captain end-to-end:** Kauf (auch als Gast; Pflicht-Zustimmung zum vorzeitigen Lizenzbeginn), Lizenz nach Zahlungseingang, Lizenzansicht im Konto, Aktivierung durch ein Pro-Add-on mit signierter Antwort, Funktionsfreigabe, Websitelimit, Verlängerung über *Jetzt verlängern* und die Bezahlseite (+1 Jahr), Deaktivierung. Wiederholbar mit `php tools/qa/license-e2e.php /pfad/zu/wp-load.php <Lizenzschlüssel>`.
- **Wichtig für den Verkauf:** License Captain gibt derzeit nur für Affiliate Captain Pro und Pass Captain Pro Pro-Funktionen frei. Voucher, Form, Workflow, Review und Course Captain Pro stehen in dessen Katalog noch auf „geplant“; Käufer bekämen eine Lizenz ohne freigeschaltete Funktion. Der Setup-Assistent meldet das und ergänzt die Funktionen bei einem erneuten Lauf, sobald License Captain sie freigibt.
- **Datenbank:** License Captain braucht MySQL/MariaDB mit `GET_LOCK` und einem beschreibbaren Primärserver (kein Proxy mit Connection-Multiplexing).
