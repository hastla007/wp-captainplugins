# Abgleich Website ↔ Plugin-Stand

Stand: 17.11.2026, Nachtrag 23.11.2026. Je Produkt wurden die Website-Texte gegen Code, Konzept bzw. Spezifikation und To-do-Liste geprüft, jeweils auf dem neuesten Entwicklungs-Branch. Vor dem Livegang und nach jedem Plugin-Release erneut prüfen.

**Entscheidung des Inhabers:** Alle Kern-Plugins und alle sieben Pro-Add-ons sind zum Release fertig. Die Website beschreibt deshalb den Release-Umfang ohne „in Vorbereitung“-Hinweise. Falls sich ein Add-on verzögert, gilt der Ablauf in [REDAKTION.md](REDAKTION.md#pro-add-ons-in-vorbereitung).

## Mindestversionen (Suite-Entscheidung MINVER-1)

Alle Plugins und Add-ons verlangen in ihren neuesten Branches **WordPress 7.0** und **PHP 8.5**, dazu **WooCommerce 11.2.2**, wo WooCommerce genutzt wird. Die Datenbank soll MySQL 9.7 oder MariaDB 12.3 sein; ältere Versionen erzeugen nur eine Warnung. Die Website ist jetzt überall auf diesem Stand.

Die alten Angaben (WordPress 6.3 bis 6.8, WooCommerce 8.0 bis 8.9) stehen nur noch in `main` einzelner Repos. Diese Branches müssen vor dem Release gemergt werden.

## Referenzstände

| Produkt | Branch / Commit | Version | Auf `main`? |
|---|---|---|---|
| Voucher Captain | `main` (Stand 23.11.) | 1.3.0 | ja |
| Pass Captain | `main` (Stand 23.11.) | 1.6.0 | ja |
| Affiliate Captain | `main` (Stand 23.11.) | 0.20.0 | ja |
| Form Captain | `claude/sleepy-ptolemy-n32guj` 10cf219 | 1.0.0-dev | 7 Commits voraus |
| Review Captain | `claude/plugin-todo-abarbeiten-xzv9c8` 6050bbd | 0.1.0-dev | 2 Commits voraus |
| Workflow Captain | `main` = `claude/plugin-todo-liste-2a83v4` 197c8e8 | 0.2.0 | ja |
| Course Captain | `main` (Stand 23.11., PR #3 aus `claude/blissful-curie-tuuf7q`) | 1.0.0-dev | ja |
| License Captain | `claude/zen-babbage-7q4nac` fcd9146 | 0.2.0 | nein (60 Commits voraus) |
| Captain Pro (alle sechs Add-ons) | `main` (Stand 23.11., PR #7 gemergt, Kernel 1.2.0) | je 0.1.0 | ja |
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
- **Voucher, Pass und Form Captain Pro:** gebaut; PR #7 ist seit 23.11. in `main`.

## Inhaltliche Korrekturen (Auswahl)

- **Voucher:**
  - Pro um White Label ergänzt.
  - Yoast-Integration gestrichen (dafür gibt es keinen Code).
  - Scanner/Kasse, Aktionen, Kundenguthaben und Schnittstellen ergänzt.
- **Pass:**
  - Abendkasse mit Fiskalisierung, Pässe, Gästelisten, Kontingente und Ticketumtausch ergänzt.
  - Neue Shortcode-Namen.
  - Pro braucht Pass Captain ab 1.6.0 (Stand 23.11.).
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

## Entschieden am 17.11.2026

- **Form Captain Pro:** 59 / 129 / 249 € pro Jahr zzgl. USt. Website, Shop-Katalog (`inc/catalog.php`) und Preis-Pattern sind umgestellt.
- **Plannamen:** Alle Add-ons heißen Single / Business / Agency (1 / 5 / 25 Live-Websites), auch Form und Review Captain Pro. Solo/Studio entfällt.
- **BoatingSchool und LearnBoating:** Das sind interne Plugins des Inhabers (Testkunde). Sie erscheinen nicht auf der Website; `tools/acceptance-list.py` prüft das.

## Nachtrag 23.11.2026: vom Inhaber zurückgehaltene Funktionen

Captain Pro hat eine harte Sperre „gebaut, aber vom Inhaber noch nicht freigegeben“ (Entscheidung H1). Ein Release-Build lehnt diese Add-ons und Funktionen ab, bis die Freigabe da ist. Die Website beschreibt sie trotzdem (Annahme: alles ist zum Release fertig). Mit den Entscheidungen muss sie deshalb abgeglichen werden:

| Add-on | Zurückgehalten | Offene Entscheidung | Auf der Website |
|---|---|---|---|
| Voucher Captain Pro | alle vier Funktionen (CSV-Firmenbestellung, Wallet, SMS, White Label) | E4: Umfang, Verkaufsstart mit oder ohne Voucher Pro | Pro-Seite, Preise, Captain Pro |
| Affiliate Captain Pro | mehrere Programme, Store Credit, Stripe Connect, Leaderboard, Multi-Tier | E5 b: Umfang und Abnahme | nur „mehrere Partnerprogramme“ (Pro-Seite, Captain Pro, Pro-Installation) |
| Workflow Captain Pro | ganzes Add-on | D3 (Zuschnitt frei/Pro), D12 (Verkaufsreihenfolge) | Pro-Seite, Preise, Captain Pro |

Nicht zurückgehalten sind Pass, Form und Review Captain Pro sowie die ersten vier Funktionen von Affiliate Captain Pro.

**Entscheidung der Inhaberin (23.11.2026):** Die Website bleibt unverändert. Vor dem Verkaufsstart wird nichts verkauft. Vor dem Livegang prüfen, welche Sperren noch gelten; für jedes dann noch gesperrte Add-on den Ablauf „in Vorbereitung“ aus [REDAKTION.md](REDAKTION.md#pro-add-ons-in-vorbereitung) anwenden.

Neu seit 23.11. ist außerdem der Auftrag „Einstellungen der Captain Suite“: Länderprofile, Export/Import, Änderungsprotokoll und Pro-Hinweiszeilen im Kern; Rahmen in captain-pro `docs/settings/README.md`. Die Website beschreibt sie seit 23.11. nach dem geplanten Umfang (Entscheidung der Inhaberin):
- **Übergreifend:** ein Abschnitt auf der Produktübersicht und eine Frage in der FAQ.
- **Je Produkt:** ein Abschnitt „Einstellungen und Anpassung an Ihr Land“ auf der Features-Seite, Pro-Einstellungen auf der Pro-Seite, je eine FAQ-Frage.

Pro-Einstellungen stehen nur dort, wo es einen bestehenden oder freigegebenen Rechteschlüssel gibt. Nicht aufgenommen, weil Entscheidungen der Inhaberin offen sind:
- **Voucher:** Restguthaben-Erinnerung, Standorte/Filialabrechnung, Kassen-Anbindung
- **Pass:** Vorlagen-Designer, Storno-Staffeln, weitere E-Rechnungsformate und QR-Rechnung, Servicegebühr in Prozent
- **Affiliate:** Buchhaltungs-Export, erweiterte Betrugsregeln
- **Review:** Händlerantwort, Kennzeichen „gegen Vorteil“
- **Workflow:** eigenes Nachrichten-Design
- **Course:** Zustimmung bei Einschreibung, Altersgrenze, Pro-Verkaufseinstellungen (E5)
- **Form:** mehrere Dateien je Feld, mehrsprachige Formulare
- **License:** ausgehende Webhooks, Beta-Kanal, White Label/Schlüssel-Präfix, Kündigungsseite

Hinweis aus der Prüfung: Die Voucher-Pro-Seite nennt in der Einleitung „mehrere Standorte“, dafür gibt es keinen freigegebenen Schlüssel.

## Offene Fragen an den Inhaber

1. **Affiliate Captain Pro:** Die Readme nennt zusätzlich Store Credit, Stripe Connect, Leaderboard und Multi-Tier. Der Umfang ist laut To-do nicht entschieden (E5 b). Gehören sie zum Release?
2. **Course Captain:** Gehören R2-Funktionen (Lernnotizen, Kursvorlagen) und Basisberichte zum Release? Die deutsche Plugin-Übersetzung duzt, die Website siezt.
3. **Voucher Captain:** Die Kern-Branches widersprechen sich. Gutscheinanfragen für Form Captain gibt es nur auf einem Parallelbranch; die Website nennt sie nicht.
4. **License Captain:** Lizenzmodell des Servers (PROD-07), Name/Marke (PROD-05), Checkout-Typ für die automatische Verlängerung, deutsches Herstellerhandbuch (PROD-10).

## Frontend-Prüfung im Theme

Testseiten mit den Shortcodes und Blöcken von Form, Voucher, Pass, Review, Affiliate, Course und License Captain, jeweils am Desktop und mobil:

- **Ergebnis:** axe ohne Befund, kein horizontaler Überlauf, keine JavaScript-Fehler.
- **Theme-Anpassungen:**
  - Die Absende-Knöpfe der Plugins übernehmen das Theme-Design.
  - Inhalte ohne volle Breite halten auf allen Seiten einen Seitenrand ein.
