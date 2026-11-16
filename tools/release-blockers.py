#!/usr/bin/env python3
"""List everything that must be filled in before the website can go live.

Run from the repository root: python3 tools/release-blockers.py
Writes docs/RELEASE-BLOCKER.md: missing link targets (download, checkout, support, …),
operator data ([[Betreiber: …]]), editorial reservations and media placeholders per page.
"""
from __future__ import annotations

import re
from collections import Counter, defaultdict
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
SOURCE = ROOT / "texte" / "homepage"
CHECKS = [
    ("Fehlendes Linkziel", re.compile(r"\[([^\]]+)\]\(\[([^\]]+)\]\)")),
    ("Fehlendes Linkziel", re.compile(r"\*\*\[((?:Checkout|Download|Support)[^\]]*)\]\*\*")),
    ("Betreiberangabe", re.compile(r"\[\[(?:Betreiber|offen|Platzhalter):?\s*([^\]]+)\]\]")),
    ("Redaktioneller Vorbehalt", re.compile(r"([^.\n]*\b(?:vor Veröffentlichung|vor Release|vor dem finalen Release|noch nicht festgelegt)\b[^.\n]*\.)", re.I)),
    ("Medienplatzhalter", re.compile(r"\[(Screenshot-Platzhalter|Demo|Kundenbeispiel|Diagramm)[^\]]*\]|\*\*Screenshot-Platzhalter[^*]*\*\*", re.I)),
]


def main() -> None:
    per_page: dict[str, list[tuple[str, str]]] = defaultdict(list)
    totals: Counter[str] = Counter()
    targets: Counter[str] = Counter()
    for file in sorted(SOURCE.rglob("*.md")):
        if file.name in ("README.md", "konzept.md", "medieninventar.md"):
            continue
        text = file.read_text(encoding="utf-8")
        url_match = re.search(r"^url:\s*(\S+)", text, re.M)
        if not url_match:
            continue
        body = re.sub(r"\A---.*?---", "", text, flags=re.S)
        for label, pattern in CHECKS:
            for match in pattern.finditer(body):
                if label == "Medienplatzhalter":
                    totals[label] += 1
                    continue
                if label == "Fehlendes Linkziel":
                    detail = f"„{match.group(1)}“ → {match.group(2) if match.lastindex and match.lastindex > 1 else 'Ziel fehlt'}"
                    targets[(match.group(2) if match.lastindex and match.lastindex > 1 else match.group(1)).strip()] += 1
                else:
                    detail = " ".join(match.group(1).split())[:180]
                per_page[url_match.group(1)].append((label, detail))
                totals[label] += 1
    lines = [
        "# Release-Blocker",
        "",
        "Automatisch erzeugt mit `python3 tools/release-blockers.py`. Alles hier muss vor dem Livegang ersetzt, entschieden oder bewusst ausgeblendet werden. Seiten mit Linkziel- oder Betreiber-Platzhaltern legt der Import als Entwurf an.",
        "",
        "## Übersicht",
        "",
        "| Art | Anzahl |",
        "|---|---:|",
    ]
    for label in ("Fehlendes Linkziel", "Betreiberangabe", "Redaktioneller Vorbehalt", "Medienplatzhalter"):
        lines.append(f"| {label} | {totals[label]} |")
    lines += ["", "Medienplatzhalter stehen einzeln im [Medieninventar](../texte/homepage/medieninventar.md).", "", "## Fehlende Linkziele nach Art", "", "| Ziel | Vorkommen |", "|---|---:|"]
    for target, count in targets.most_common():
        lines.append(f"| {target} | {count} |")
    lines += ["", "## Je Seite", ""]
    for url in sorted(per_page):
        lines += [f"### `{url}`", ""]
        for label, detail in per_page[url]:
            lines.append(f"- **{label}:** {detail}")
        lines.append("")
    out = ROOT / "docs" / "RELEASE-BLOCKER.md"
    out.write_text("\n".join(lines), encoding="utf-8")
    print(f"{sum(totals.values())} offene Punkte auf {len(per_page)} Seiten → {out.relative_to(ROOT)}")


if __name__ == "__main__":
    main()
