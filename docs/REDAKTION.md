# Redaktionshandbuch

Stand: 16. November 2026. Regelt, wer Website-Inhalte ändert und freigibt und wie wiederkehrende Inhalte gepflegt werden. Die Namen in der Rollentabelle legt die Inhaberin fest.

## Rollen und Zuständigkeiten

| Rolle | Verantwortlich für | WordPress-Rolle | Person |
|---|---|---|---|
| Inhaberin / Freigabe | Produktversprechen, Preise, Rechtstexte, Veröffentlichung | Administrator | [[Betreiber: Name]] |
| Redaktion | Texte in `texte/homepage/`, Seiten im Editor, Ratgeber, FAQ | Redakteur | [[Betreiber: Name]] |
| Produktverantwortung je Plugin | fachliche Richtigkeit von Features, Kompatibilität, Changelog | Autor (eigene Inhalte) oder Rückmeldung an die Redaktion | [[Betreiber: Namen je Produkt]] |
| SEO | SEO-Titel, Beschreibungen, Fokus-Keyphrases, Social-Bilder, Weiterleitungen | Redakteur + Yoast-Zugriff | [[Betreiber: Name]] |
| Technik | Theme, Plugins, Updates, Backups, Staging, Monitoring | Administrator | [[Betreiber: Name]] |
| Recht | Impressum, Datenschutz, AGB, Widerruf, Produktbedingungen | Freigabe außerhalb von WordPress | [[Betreiber: Kanzlei/Person]] |

Grundsatz: Wer schreibt, gibt nicht selbst frei. Preise, Rechtstexte und Produktversprechen veröffentlicht nur die Freigabe-Rolle.

## Wo Inhalte gepflegt werden

| Inhalt | Quelle | Ablauf |
|---|---|---|
| Seitentexte (Produkte, Preise, FAQ, Doku, Ratgeber) | `texte/homepage/*.md` im Repository | Änderung → `python3 tools/build-theme-content.py` → Theme-Update → *Design → Einrichtung → Website-Texte übernehmen* |
| Kurzfristige Korrekturen | direkt im Block-Editor | Möglich, aber die Seite gilt danach als „von Hand bearbeitet“ und wird beim nächsten Import **nicht** mehr aktualisiert. Änderung zusätzlich in die Markdown-Quelle übernehmen. |
| Header, Footer, Vorlagen | Theme (`parts/`, `templates/`) | nur über die Technik-Rolle; Site-Editor-Änderungen übersteuern das Theme dauerhaft und sind zu dokumentieren |
| Preise im Shop | WooCommerce / License-Captain-Katalog | Shop ist die Quelle; Website-Texte danach angleichen |

## Pattern-Freigaben

Freigegebene Block-Patterns (*Captain Plugins* im Pattern-Verzeichnis; Vorschau und Pflichtfelder im [Pattern-Katalog](PATTERNS.md)): Startseiten-Hero, Produkt-Hero, Produktkarten, Featurekarten, Ablauf, Free/Pro-Vergleich, Preisvergleich, Kompatibilitätshinweis, FAQ, Ressourcenkarten, Screenshot-Briefing, Abschluss-CTA.

- Redaktion darf Patterns einfügen und Texte, Links und Bilder darin ändern.
- Farben, Schriftgrößen und Abstände kommen aus dem Designsystem; individuelle Farbwerte sind im Editor deaktiviert und sollen nicht über eigenes CSS ersetzt werden.
- Texte in eckigen Klammern sind Pflichtfelder. Eine Seite mit offenen Klammern oder `[[Betreiber: …]]` wird nicht veröffentlicht.
- Neue Patterns oder geänderte Layouts beantragt die Redaktion bei der Technik-Rolle; Umsetzung im Theme, nicht als lose Seitenlayouts.

## Pflegeprozesse

### Preise und Pläne
1. Preis im Shop ändern (Quelle).
2. `texte/homepage/preise.md` und die betroffene `…/pro.md` bzw. `license-captain/preise.md` anpassen.
3. Inhalte neu bauen, auf Staging importieren, Tarifkarten prüfen.
4. Freigabe-Rolle gibt frei, dann Produktion.

### Changelog und Releases
1. Release-Notizen pflegt die Produktverantwortung im Plugin (License Captain stellt Changelogs über Blöcke/Shortcodes bereit).
2. Bei neuen Funktionen Features-, Pro- und FAQ-Seite des Produkts aktualisieren.

### Kompatibilität
1. Nach jedem Plugin-Release Mindest- und Testversionen in `texte/homepage/kompatibilitaet.md` und der Produktseite abgleichen.
2. Mindestversionen für alle Captain-Plugins: PHP 8.5, MySQL 9.7 (LTS) oder MariaDB 12.3 (LTS) – Änderungen nur nach Entscheidung der Inhaberin.

### Screenshots, Demos und Kundenbeispiele
1. Offene Aufnahmen stehen im [Medieninventar](../texte/homepage/medieninventar.md) (`python3 tools/media-inventory.py`).
2. Aufnahmen nur mit Testdaten: keine Kundendaten, Lizenzschlüssel, Bestellnummern, echten Bankdaten oder API-Schlüssel.
3. Bildunterschrift und Alt-Text ergänzen; den Platzhalter in der Markdown-Quelle durch das Bild ersetzen.
4. Kundenlogos, Bewertungen, Kennzahlen und Fallstudien nur mit schriftlicher Freigabe und Beleg.

### SEO-Freigabe
1. Neue oder geänderte Seiten brauchen `seo_title` (max. 60 Zeichen), `meta_description` (70–160 Zeichen) und eine eindeutige `focus_keyphrase` im Markdown-Kopf.
2. Prüfung: `php tools/qa/seo-fields.php`.
3. Bei geänderter oder entfernter URL: Eintrag in [WEITERLEITUNGEN.md](WEITERLEITUNGEN.md) und `theme/captain-plugins/content/retired.php`.

### Rechtliche Seiten
Impressum, Datenschutz, AGB und Widerruf ändert nur die Freigabe-Rolle nach Prüfung durch die Rechts-Rolle. Neue Dienste (Zahlung, Analyse, Einbettungen) vor Aktivierung in der Datenschutzerklärung ergänzen.

## License-Captain-Sprachregel

License Captain ist ein eigenes Produkt aus Server und Client für Plugin-Hersteller. Auf Seiten für Captain-Pro-Kunden (Pro, Preise, FAQ, Installation) wird License Captain **nicht** erwähnt – auch nicht als „inklusive“ oder „nicht enthalten“. Pro-Kunden aktivieren ihren Lizenzschlüssel im Pro-Add-on.
