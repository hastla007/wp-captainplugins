#!/usr/bin/env python3
"""List every screenshot, demo and customer-example placeholder per page.

Run from the repository root: python3 tools/media-inventory.py
Writes texte/homepage/medieninventar.md, grouped by product area.
"""
from __future__ import annotations

import re
from collections import defaultdict
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
SOURCE = ROOT / "texte" / "homepage"
PATTERN = re.compile(r"\[(Screenshot-Platzhalter|Demo|Kundenbeispiel|Diagramm)(?:\s*\d+)?(?:\s*[–-][^:\]]*)?:\s*([^\]]+)\]|\*\*(Screenshot-Platzhalter)\s*\d*\s*[–-]\s*([^:*]+):\*\*\s*([^\n]+)", re.I)


def area(url: str) -> str:
    first = url.strip("/").split("/")[0] if url.strip("/") else "startseite"
    if first in ("ratgeber", "dokumentation"):
        parts = url.strip("/").split("/")
        return f"{first}/{parts[1]}" if len(parts) > 1 else first
    return first


def main() -> None:
    groups: dict[str, list[tuple[str, str, str]]] = defaultdict(list)
    total = 0
    for file in sorted(SOURCE.rglob("*.md")):
        if file.name in ("README.md", "konzept.md", "medieninventar.md"):
            continue
        text = file.read_text(encoding="utf-8")
        url = (re.search(r"^url:\s*(\S+)", text, re.M) or [None, ""])[1]
        if not url:
            continue
        for match in PATTERN.finditer(text):
            if match.group(1):
                kind, brief = match.group(1), match.group(2)
            else:
                kind, brief = "Screenshot-Platzhalter", f"{match.group(4).strip()}: {match.group(5).strip()}"
            kind = "Screenshot" if kind.lower().startswith("screenshot") else kind.capitalize()
            groups[area(url)].append((url, kind, " ".join(brief.split())))
            total += 1
    lines = [
        "# Medieninventar",
        "",
        "Automatisch erzeugt mit `python3 tools/media-inventory.py`. Jede Zeile ist eine benötigte Aufnahme, Demo oder ein Kundenbeispiel aus den Website-Texten. Priorität: Startseite und Produkt-Startseiten zuerst, dann Features/Pro, danach Dokumentation und Ratgeber. Vor Veröffentlichung gilt: nur Testdaten, keine Lizenzschlüssel, Kundendaten, Bestellnummern oder echte Bankdaten.",
        "",
        f"**Gesamt:** {total} Einträge.",
        "",
    ]
    order = sorted(groups, key=lambda key: (0 if key == "startseite" else 1 if key.endswith("-captain") else 2 if "/" not in key else 3, key))
    for key in order:
        lines += [f"## {key}", "", "| Seite | Art | Briefing | Status |", "|---|---|---|---|"]
        for url, kind, brief in groups[key]:
            lines.append(f"| `{url}` | {kind} | {brief.replace('|', '/')} | offen |")
        lines.append("")
    (SOURCE / "medieninventar.md").write_text("\n".join(lines), encoding="utf-8")
    print(f"{total} Medienplatzhalter in {len(groups)} Bereichen nach texte/homepage/medieninventar.md geschrieben")


if __name__ == "__main__":
    main()
