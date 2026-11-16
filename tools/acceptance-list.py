#!/usr/bin/env python3
"""Prepare the editorial acceptance of all website pages (Roadmap Phase 9, redaktionelle Abnahme).

Run from the repository root: python3 tools/acceptance-list.py
Writes docs/ABNAHME.md: one row per page with what reviewers must look at (prices, product
promises, screenshots, open link targets, operator data) and empty sign-off columns for the
roles in docs/REDAKTION.md. Also checks two editorial rules automatically:
  - on pages for Captain Pro customers (Pro, prices, FAQ, installation) License Captain never appears as the
    way Captain Pro is licensed or activated (mentions as a separate product are fine)
  - every page has SEO title, meta description and focus keyphrase
Exit code 1 if a rule is broken.
"""
from __future__ import annotations

import importlib.util
import re
import sys
from collections import defaultdict
from pathlib import Path

sys.dont_write_bytecode = True
ROOT = Path(__file__).resolve().parents[1]
SOURCE = ROOT / "texte" / "homepage"
OUT = ROOT / "docs" / "ABNAHME.md"

spec = importlib.util.spec_from_file_location("release_blockers", ROOT / "tools" / "release-blockers.py")
blockers = importlib.util.module_from_spec(spec)
spec.loader.exec_module(blockers)

AREAS = [
    ("Startseite und Übersichten", lambda u: u in ("/", "/produkte/", "/vergleich/", "/captain-pro/", "/preise/")),
    ("Produkte", lambda u: re.match(r"^/[a-z]+-captain/", u) is not None),
    ("Lösungen und Integrationen", lambda u: u.startswith(("/loesungen/", "/integrationen/", "/kompatibilitaet/"))),
    ("Dokumentation", lambda u: u.startswith("/dokumentation/")),
    ("Ratgeber", lambda u: u.startswith("/ratgeber/")),
    ("Unternehmen, Support und Recht", lambda u: True),
]
# Pages for Captain Pro customers: License Captain must not appear (docs/REDAKTION.md, Sprachregel).
LICENSING_CONTEXT = re.compile(r"Lizenzschlüssel|aktivier|inklusive|enthalten|kostenlos dabei|Client|lizenziert|Lizenzierung|im Paket", re.I)
PRO_CUSTOMER_PAGE = re.compile(r"^/(captain-pro|preise|faq|dokumentation/installation)/$|^/(?!license-captain)[a-z]+-captain/(pro|faq|installation)/$")


def front_matter(text: str) -> dict[str, str]:
    match = re.match(r"\A---\n(.*?)\n---", text, re.S)
    data: dict[str, str] = {}
    if match:
        for line in match.group(1).splitlines():
            if ":" in line:
                key, value = line.split(":", 1)
                data[key.strip()] = value.strip().strip('"')
    return data


def main() -> int:
    rows: dict[str, list[str]] = defaultdict(list)
    problems: list[str] = []
    count = 0
    for file in sorted(SOURCE.rglob("*.md")):
        if file.name in ("README.md", "konzept.md", "medieninventar.md"):
            continue
        text = file.read_text(encoding="utf-8")
        meta = front_matter(text)
        url = meta.get("url")
        if not url:
            continue
        count += 1
        body = re.sub(r"\A---.*?---", "", text, flags=re.S)
        title = (re.search(r"^#\s+(.+)$", body, re.M) or re.search(r"(.*)", meta.get("title", url))).group(1).strip()
        found = defaultdict(int)
        for label, pattern in blockers.CHECKS:
            found[label] += len(pattern.findall(body))
        checks = []
        if re.search(r"\d\s*€", body):
            checks.append("Preise")
        if re.search(r"\b(garantiert|immer|nie|sofort|100\s*%|DSGVO-konform|rechtssicher)\b", body, re.I):
            checks.append("Zusagen")
        if found["Medienplatzhalter"]:
            checks.append(f"{found['Medienplatzhalter']} Medien")
        open_items = found["Fehlendes Linkziel"] + found["Betreiberangabe"]
        status = "blockiert" if open_items else ("Vorbehalt" if found["Redaktioneller Vorbehalt"] else "bereit")
        seo_missing = [k for k in ("seo_title", "meta_description", "focus_keyphrase") if not meta.get(k)]
        if seo_missing:
            problems.append(f"{url}: SEO-Feld fehlt ({', '.join(seo_missing)})")
        if PRO_CUSTOMER_PAGE.match(url):
            # Mentions as a separate product (product lists, integrations) are fine; License Captain as the
            # way Captain Pro is licensed or activated is not.
            for sentence in re.split(r"(?<=[.!?])\s+|\n", body):
                if "License Captain" in sentence and LICENSING_CONTEXT.search(sentence.replace("License Captain", "")):
                    problems.append(f"{url}: License Captain im Lizenzierungszusammenhang: „{sentence.strip()[:110]}“")
        area = next(name for name, test in AREAS if test(url))
        open_text = f"{open_items} offen" if open_items else "–"
        rows[area].append(f"| `{url}` | {title} | {status} | {open_text} | {', '.join(checks) or '–'} | ☐ | ☐ | ☐ |")

    lines = [
        "# Redaktionelle Abnahme",
        "",
        "Automatisch erzeugt mit `python3 tools/acceptance-list.py` aus `texte/homepage/`. Die Liste bereitet die Abnahme vor;",
        "abgehakt wird von den Rollen aus dem [Redaktionshandbuch](REDAKTION.md): **R** = Redaktion (Text, Links, Medien),",
        "**F** = Produktverantwortung (fachliche Richtigkeit), **G** = Freigabe durch die Inhaberin (Preise, Zusagen, Veröffentlichung).",
        "",
        "- **Status:** *blockiert* = fehlendes Linkziel oder Betreiberangabe (Details in [RELEASE-BLOCKER.md](RELEASE-BLOCKER.md)), *Vorbehalt* = Text enthält einen Prüfvermerk, *bereit* = inhaltlich abnahmefähig.",
        "- **Prüfen:** *Preise* = Eurobeträge (mit `python3 tools/price-check.py` gegen den Shop abgeglichen), *Zusagen* = absolute Formulierungen wie „garantiert“, „sofort“, „DSGVO-konform“, die belegt sein müssen, *Medien* = Screenshot-/Demo-Platzhalter.",
        f"- Automatisch geprüft: SEO-Felder vollständig, License Captain auf Seiten für Pro-Kunden nicht als Lizenzierungsweg. Ergebnis: {'keine Verstöße' if not problems else str(len(problems)) + ' Verstöße'}.",
        "",
    ]
    total = {"bereit": 0, "Vorbehalt": 0, "blockiert": 0}
    for area, _ in AREAS:
        if not rows[area]:
            continue
        lines += [f"## {area}", "", "| Seite | Titel | Status | Linkziele/Betreiber | Prüfen | R | F | G |", "|---|---|---|---|---|:-:|:-:|:-:|"]
        lines += rows[area]
        lines.append("")
        for row in rows[area]:
            for key in total:
                if f"| {key} |" in row:
                    total[key] += 1
    lines.insert(9, f"**{count} Seiten:** {total['bereit']} bereit, {total['Vorbehalt']} mit Vorbehalt, {total['blockiert']} blockiert.\n")
    OUT.write_text("\n".join(lines).rstrip() + "\n", encoding="utf-8")
    print(f"{OUT.relative_to(ROOT)} geschrieben: {count} Seiten, {total['bereit']} bereit, {total['Vorbehalt']} Vorbehalt, {total['blockiert']} blockiert.")
    for problem in problems:
        print("  " + problem)
    return 1 if problems else 0


if __name__ == "__main__":
    sys.exit(main())
