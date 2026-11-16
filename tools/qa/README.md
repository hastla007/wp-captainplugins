# Prüfwerkzeuge (QA)

Einmalig installieren (Node.js 20+). Playwright lädt Chromium mit `npx playwright install chromium`; ein vorhandener Chrome/Chromium lässt sich alternativ über `CHROMIUM_PATH=/pfad/zu/chrome` nutzen:

```bash
cd tools/qa && npm install
```

| Befehl | Prüft | Wann |
|---|---|---|
| `node validate-blocks.cjs` | Gutenberg-Blockvalidierung aller Templates, Template Parts, Patterns und generierten Seiten – dieselbe Prüfung wie der Block-Editor (verhindert „Dieser Block enthält unerwarteten Inhalt“) | nach jeder Änderung an Templates, Patterns oder `tools/build-theme-content.py` |
| `node site-check.cjs --base URL [--axe]` | Crawlt alle internen Seiten: tote Links, horizontaler Überlauf, genau eine H1, Überschriftenhierarchie, Bilder ohne Alt, unbenannte Links/Buttons, JS-Fehler; mit `--axe` WCAG-2.2-AA-Regeln. Ansichten: Desktop, Tablet, Mobil, Zoom 200 % | vor jedem Release auf Staging |
| `node smoke.cjs --base URL` | Kernseiten (HTTP 200, H1, Header/Footer, Theme-CSS, kein „critical error“), 404-Status, Suche | direkt nach Aktivierung oder Update in Produktion |

Alle Skripte beenden sich mit Exit-Code 1, wenn etwas gefunden wurde, und eignen sich damit für CI. Automatische Prüfungen ersetzen nicht die manuelle Abnahme mit Tastatur und Screenreader (siehe `theme/ROADMAP.md`, Phase 9).
