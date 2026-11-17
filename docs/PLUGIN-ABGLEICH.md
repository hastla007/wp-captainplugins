# Abgleich Website ↔ Plugin-Stand

Stand: 17.11.2026. Je Produkt wurden die Website-Texte gegen Code, Konzept bzw. Spezifikation und To-do-Liste geprüft, jeweils auf dem neuesten Entwicklungs-Branch. Vor dem Livegang und nach jedem Plugin-Release erneut prüfen.

**Entscheidung des Inhabers:** Alle Kern-Plugins und alle sieben Pro-Add-ons sind zum Release fertig. Die Website beschreibt deshalb den Release-Umfang ohne „in Vorbereitung“-Hinweise. Falls sich ein Add-on verzögert, gilt der Ablauf in [REDAKTION.md](REDAKTION.md#pro-add-ons-in-vorbereitung).

## Mindestversionen (Suite-Entscheidung MINVER-1)

Alle Plugins und Add-ons verlangen in ihren neuesten Branches **WordPress 7.0** und **PHP 8.5**, dazu **WooCommerce 11.2.2**, wo WooCommerce genutzt wird. Die Datenbank soll MySQL 9.7 oder MariaDB 12.3 sein; ältere Versionen erzeugen nur eine Warnung. Die Website ist jetzt überall auf diesem Stand.

Die alten Angaben (WordPress 6.3 bis 6.8, WooCommerce 8.0 bis 8.9) stehen nur noch in `main` einzelner Repos. Diese Branches müssen vor dem Release gemergt werden.

## Referenzstände

| Produkt | Branch / Commit | Version | Auf `main`? |
|---|---|---|---|
| Voucher Captain | `claude/plugin-todo-liste-2a83v4` 51daf99 | 1.3.0 | nein (`main` 1.1.0) |
| Pass Captain | `claude/wp-plugin-analysis-todos-kvbfan` 7eacad97 | 1.5.0 | nein (`main` 1.4.0) |
| Affiliate Captain | `claude/exciting-maxwell-srtg6v` 0b87f61 | 0.17.0 | nein (`main` 0.16.0) |
| Form Captain | `claude/sleepy-ptolemy-n32guj` 10cf219 | 1.0.0-dev | 7 Commits voraus |
| Review Captain | `claude/plugin-todo-abarbeiten-xzv9c8` 6050bbd | 0.1.0-dev | 2 Commits voraus |
| Workflow Captain | `main` = `claude/plugin-todo-liste-2a83v4` 197c8e8 | 0.2.0 | ja |
| Course Captain | `claude/zen-mayer-wfhra1` 290c276 + `claude/vigilant-sagan-wzdo1a` | 1.0.0-dev | nein (`main` nur Dokumente) |
| License Captain | `claude/zen-babbage-7q4nac` fcd9146 | 0.2.0 | nein (60 Commits voraus) |
| Captain Pro (Voucher, Pass, Affiliate, Form) | `claude/wp-plugin-analysis-todos-f78fzo` 313b766 (PR #7) | je 0.1.0 | nein |
| Review Captain Pro | `claude/review-captain-pro` 1a6afa8 | 0.1.0 | nein |
| Workflow Captain Pro | `claude/plugin-todo-liste-2a83v4` e004004 | 0.1.0 | nein |

## Bis zum Release noch zu bauen

Diese Funktionen beschreibt die Website, weil Konzept oder To-do sie für den Release vorsehen. Im Code fehlen sie noch:

- **Course Captain (Kern):**
  - Fragen- und Prüfungseditor, Drag-and-drop, Vorschau als Lernende
  - Oberfläche für den Smarttrainer, Video-Einbettung, Selbstanmeldung im Katalog
  - Import-, Abgabe- und Bewertungsoberfläche, Basisberichte
  - Im Prüfungsraum lassen sich Freitext, Reihenfolge, Lückentext und Karteikarte noch nicht beantworten.
- **Course Captain Pro:** komplett. Das Add-on gibt es in keinem Branch (Konzept R3).
- **Workflow Captain Pro:** Event-Korrelation, Freigabeschritte, Suite-Rezepte, längere Protokolle (365 Tage) mit CSV-Export, Abbruch geplanter Abläufe bei Erstattung oder Storno.
- **Review Captain Pro:**
  - Inbox mit Filtern, Widget „Produkt-/App-Rating“, „Mehr laden“
  - Pass-Adapter: Der Vertrag im Pass-Plugin fehlt noch.
- **Form Captain:** Übergabe an Review Captain Pro und Course-Captain-Verbindung (beide im To-do offen).
- **Affiliate Captain Pro:** PayPal-Sandbox-Test und End-to-end-Lauf (laut To-do offen). Die Funktionen sind gebaut.
- **Voucher, Pass und Form Captain Pro:** gebaut, aber nur auf PR #7. Der Merge ist Voraussetzung für den Release.

## Inhaltliche Korrekturen (Auswahl)

- **Voucher:**
  - Pro um White Label ergänzt.
  - Yoast-Integration gestrichen (dafür gibt es keinen Code).
  - Scanner/Kasse, Aktionen, Kundenguthaben und Schnittstellen ergänzt.
- **Pass:**
  - Abendkasse mit Fiskalisierung, Pässe, Gästelisten, Kontingente und Ticketumtausch ergänzt.
  - Neue Shortcode-Namen.
  - Pro braucht Pass Captain ab 1.5.0.
- **Affiliate:**
  - Gruppen, Wunschcodes, Import, Betrugsregeln, Gutschriften/E-Rechnung ergänzt.
  - Die PayPal-Sammeldatei gehört schon zum Kern.
  - Pro mit mehreren Partnerprogrammen.
- **Form:**
  - Bedingungen sind Gruppen mit UND/ODER plus Routing, nicht beliebig verschachtelt.
  - PDF mit festem Layout.
  - Neu in Pro: WooCommerce-Käuferfragebögen.
  - Der Kern hat keine WooCommerce-Funktionen.
  - Workflow-Ereignisse nur mit Workflow Captain Pro und Form Captain Pro.
- **Review:**
  - CSV-Export gehört zum Kern.
  - Workflow-Ereignisse: erstellt, Status geändert, entfernt.
  - Kein eigener Course-Adapter; Kursabschlüsse laufen über einen Projekt-Connector.
- **Workflow:**
  - Wenn/Sonst, Wartezeiten, Zeitpläne, Wiederholungen, Versionen und Export gehören zum Kern.
  - Auslöser und Aktionen auf den tatsächlichen Umfang reduziert.
  - Pro ohne License-Provider, dafür mit n8n, eigenen Connectoren und Multisite.
  - Course-Ereignisse kommen erst in einer späteren Version.
- **Course:**
  - Drip, Voraussetzungen und automatische Nachweise gehören zum Kern.
  - Selbstanmeldung statt „öffentlich“.
  - Neun Fragetypen; Blöcke und Shortcodes benannt.
  - Pass-Tickets geben Zugang, ein Check-in ist kein Abschluss.
  - Lösungserklärungen gibt es mit Pro.
- **License:**
  - Konstanten in der Installationsanleitung korrigiert (Schlüsselringe `…_SECRETS`/`…_KEYS`).
  - Verwaltung und Betrieb, Planwechsel, Mitbenutzer ergänzt.
  - Der Client verlangt beim Kunden WordPress 7.0 und PHP 8.5.

## Offene Fragen an den Inhaber

1. **Form Captain Pro – Preise:** Die Website und `inc/catalog.php` nennen 49/99/199 €. Konzept §3 (Entscheidung #9 vom 16.11.) und `docs/FORM-PRO.md` nennen 59/129/249 €. Welche gelten?
2. **Plannamen Review Captain Pro:** Die Website sagt Solo/Studio/Agency, Code und RC-004 sagen single/business/agency. Ist das gewollt?
3. **Affiliate Captain Pro:** Die Readme nennt zusätzlich Store Credit, Stripe Connect, Leaderboard und Multi-Tier. Der Umfang ist laut To-do nicht entschieden (E5 b). Gehören sie zum Release?
4. **Pass Captain Pro:** Sollen die geplanten Connectoren für BoatingSchool und LearnBoating als Pro-Funktion auf die Website?
5. **Course Captain:** Gehören R2-Funktionen (Lernnotizen, Kursvorlagen) und Basisberichte zum Release? Die deutsche Plugin-Übersetzung duzt, die Website siezt.
6. **Voucher Captain:** Die Kern-Branches widersprechen sich. Gutscheinanfragen für Form Captain gibt es nur auf einem Parallelbranch; die Website nennt sie nicht.
7. **License Captain:** Lizenzmodell des Servers (PROD-07), Name/Marke (PROD-05), Checkout-Typ für die automatische Verlängerung, deutsches Herstellerhandbuch (PROD-10).

## Frontend-Prüfung im Theme

Testseiten mit den Shortcodes und Blöcken von Form, Voucher, Pass, Review, Affiliate, Course und License Captain, jeweils am Desktop und mobil:

- **Ergebnis:** axe ohne Befund, kein horizontaler Überlauf, keine JavaScript-Fehler.
- **Theme-Anpassungen:**
  - Die Absende-Knöpfe der Plugins übernehmen das Theme-Design.
  - Inhalte ohne volle Breite halten auf allen Seiten einen Seitenrand ein.
