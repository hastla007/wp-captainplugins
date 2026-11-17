# Abgleich Website ↔ Plugin-Stand

Stand: 17.11.2026. Geprüft gegen die Plugins auf der Staging-Installation (WordPress 7.1.4, WooCommerce 11.3.0, Yoast SEO 28.8) und gegen die To-do-Listen der Plugin-Repositories. Vor dem Livegang und nach jedem Plugin-Release erneut prüfen.

## Versionen und Voraussetzungen laut Plugin-Kopf

| Plugin | Version | WordPress | PHP (Kopf) | WooCommerce |
|---|---|---|---|---|
| Voucher Captain | 1.1.0 | 6.4 | 8.1 | 8.9, erforderlich |
| Pass Captain | 1.4.0 | 6.4 | 8.2 | optional, ab 8.2 |
| Affiliate Captain | 0.16.0 | 6.3 | 8.5 | optional, ab 8.0 |
| Form Captain | 1.0.0-dev | 6.8 | 8.3 | optional |
| Review Captain | 0.1.0-dev | 6.5 | 8.5 | optional |
| Workflow Captain | 0.2.0 | 6.4 | 8.1 | optional |
| Course Captain | 1.0.0-dev | 7.0 | 8.3 | nicht erforderlich |
| License Captain | 0.2.0 | 6.5 | 7.4 | 8.9, erforderlich |
| Voucher / Pass / Affiliate Captain Pro | je 0.1.0 | 6.5 | 8.1 / 8.2 / 7.4 | wie Kern |

Die Website nennt für alle Produkte PHP 8.5 als Mindestversion. Das ist eine bewusste Entscheidung für die ganze Suite und strenger als die Plugin-Köpfe, also unkritisch. Kritisch wäre nur eine Angabe, die *niedriger* ist als die tatsächliche Voraussetzung.

**Korrigiert:**

- Course Captain verlangt WordPress 7.0, nicht 6.8 (Produktseite, Pro, Installation, Kompatibilität).
- Review Captain hat jetzt die konkrete Angabe WordPress 6.5 statt „Veröffentlichungsversion“.

**Unkritisch:** Workflow Captain wird mit WordPress 6.8 angegeben, der Kopf verlangt 6.4.

## Pro-Funktionen: Behauptung und Code

| Add-on | Website verspricht | Stand im Code (captain-pro 0.1.0) | Bewertung |
|---|---|---|---|
| Voucher Captain Pro | CSV-Massenbestellungen, Wallet-Pässe, SMS-Zustellung | Entwicklungsvorschau mit Lizenz-/Update-Mechanik und einer Beispielfunktion; keine der drei Funktionen vorhanden, auch nicht im Kern | bis Release zu bauen |
| Pass Captain Pro | E-Rechnungen, Kartenterminal, White Label, Warteraum, schreibende API | Code für alle fünf vorhanden (XRechnung/ZUGFeRD, Terminal, White Label, Warteraum, REST); mit Pass Captain 1.4.0 noch inaktiv (Kern-Vertrag fehlt) | Freigabe hängt am Kern-Release |
| Affiliate Captain Pro | Webhooks, erweiterte REST-API, White-Label-Portal, PayPal-Auszahlungen | Code für alle vier vorhanden | passt |
| Form Captain Pro | Mehrstufige Formulare, Uploads, Regeln, Webhooks, Protokoll, PDF | kein Add-on vorhanden | bis Release zu bauen |
| Review Captain Pro | Plattformverbindungen, Sync, Anfragen, Widgets, Auswertungen | kein Add-on vorhanden | bis Release zu bauen |
| Workflow Captain Pro | Suite-Provider, signierte Webhooks, Ablauflogik, Wiederholungen, Protokolle | kein Add-on vorhanden | bis Release zu bauen |
| Course Captain Pro | Lernpfade, Drip, Prüfungen, Zertifikatsdesigner, Gruppen, Kohorten, Kursverkauf | kein Add-on vorhanden | bis Release zu bauen |

Der Shop ist bereits abgesichert: Der Setup-Assistent legt nur Pro-Produkte an, deren Funktionen im License-Captain-Katalog freigegeben sind. Derzeit sind das Affiliate und Pass. Die Texte auf /captain-pro/, /preise/, den sieben Pro-Seiten und in der FAQ beschreiben aber alle sieben Add-ons als kaufbar.

**Entscheidung des Inhabers (17.11.2026):** Alle Kern-Plugins und alle sieben Pro-Add-ons sind zum Release fertig. Die Website beschreibt deshalb den geplanten Release-Umfang (Code, Konzept und To-do), ohne „in Vorbereitung“-Hinweise.

Die Spalte „Stand im Code“ zeigt, was bis zum Release noch gebaut werden muss, damit die Texte stimmen. Falls sich ein Add-on verzögert, gibt es den Ablauf „in Vorbereitung“ in [REDAKTION.md](REDAKTION.md#pro-add-ons-in-vorbereitung).

## Release-Stand der Kern-Plugins

- **Entwicklungsstand:** Form Captain (1.0.0-dev), Review Captain (0.1.0-dev) und Course Captain (1.0.0-dev) sind Entwicklungsversionen. Course Captain liegt nur auf einem Feature-Branch.
- **Vorab auf Branch:** Workflow Captain 0.2.0 liegt ebenfalls nur auf einem Branch.
- **Download-Links:** Die Download-Ziele müssen mit dem jeweiligen Release gesetzt werden (Roadmap R3/R10).

## Frontend-Prüfung im Theme

Testseiten mit den Shortcodes/Blöcken von Form, Voucher, Pass, Review, Affiliate, Course und License Captain, jeweils Desktop und Mobil:

- **Ergebnis:** axe ohne Befund, kein horizontaler Überlauf, keine JavaScript-Fehler.
- **Theme-Anpassungen:**
  - Absende-Knöpfe der Plugin-Formulare übernehmen das Theme-Design (vorher teils Browser-Standard).
  - Inhalte ohne volle Breite haben jetzt auf allen Seiten einen Seitenrand (vorher bündig am Bildschirmrand, z. B. Shortcodes direkt in einer Seite).
