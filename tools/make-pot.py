#!/usr/bin/env python3
"""Create languages/captain-plugins.pot from the theme's PHP translation calls.

Run from the repository root: python3 tools/make-pot.py
Covers __(), _e(), esc_html__(), esc_html_e(), esc_attr__(), esc_attr_e(), _x() and _n()
with single-quoted literals and the "captain-plugins" text domain. Strings in block HTML
templates are not extractable by gettext; they are edited in the Site Editor instead.
"""
from __future__ import annotations

import re
from collections import OrderedDict
from datetime import datetime, timezone
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
THEME = ROOT / "theme" / "captain-plugins"
LIT = r"'((?:[^'\\]|\\.)*)'"
SIMPLE = re.compile(r"\b(?:__|_e|esc_html__|esc_html_e|esc_attr__|esc_attr_e)\(\s*" + LIT + r"\s*,\s*'captain-plugins'\s*\)")
CONTEXT = re.compile(r"\b_x\(\s*" + LIT + r"\s*,\s*" + LIT + r"\s*,\s*'captain-plugins'\s*\)")
PLURAL = re.compile(r"\b_n\(\s*" + LIT + r"\s*,\s*" + LIT + r"\s*,\s*[^,]+,\s*'captain-plugins'\s*\)")
COMMENT = re.compile(r"/\*\s*translators:(.*?)\*/", re.S)


def unescape(value: str) -> str:
    return value.replace("\\'", "'").replace("\\\\", "\\")


def po(value: str) -> str:
    return '"' + value.replace("\\", "\\\\").replace('"', '\\"').replace("\n", "\\n") + '"'


def main() -> None:
    entries: "OrderedDict[tuple, dict]" = OrderedDict()
    for file in sorted(THEME.rglob("*.php")):
        if "content" in file.relative_to(THEME).parts:
            continue
        text = file.read_text(encoding="utf-8")
        rel = file.relative_to(THEME).as_posix()
        for regex, kind in ((SIMPLE, "s"), (CONTEXT, "x"), (PLURAL, "n")):
            for match in regex.finditer(text):
                before = text[max(0, match.start() - 300):match.start()]
                note = COMMENT.findall(before)
                groups = [unescape(g) for g in match.groups()]
                key = (kind, *groups)
                entry = entries.setdefault(key, {"refs": [], "note": ""})
                # File only, no line number: shifted lines must not make the POT (and the CI check) stale.
                if rel not in entry["refs"]:
                    entry["refs"].append(rel)
                if note and not entry["note"]:
                    entry["note"] = " ".join(note[-1].split())
    now = datetime.now(timezone.utc).strftime("%Y-%m-%d %H:%M+0000")
    out = [
        "# Copyright (C) Captain Plugins",
        "# This file is distributed under the same license as the Captain Plugins theme.",
        'msgid ""', 'msgstr ""',
        '"Project-Id-Version: Captain Plugins Theme\\n"',
        f'"POT-Creation-Date: {now}\\n"',
        '"MIME-Version: 1.0\\n"', '"Content-Type: text/plain; charset=UTF-8\\n"', '"Content-Transfer-Encoding: 8bit\\n"',
        '"Language: de_DE\\n"', '"X-Domain: captain-plugins\\n"', "",
    ]
    for (kind, *strings), entry in entries.items():
        if entry["note"]:
            out.append(f"#. translators: {entry['note']}")
        out.append("#: " + " ".join(entry["refs"]))
        if kind == "x":
            out += [f"msgctxt {po(strings[1])}", f"msgid {po(strings[0])}", 'msgstr ""']
        elif kind == "n":
            out += [f"msgid {po(strings[0])}", f"msgid_plural {po(strings[1])}", 'msgstr[0] ""', 'msgstr[1] ""']
        else:
            out += [f"msgid {po(strings[0])}", 'msgstr ""']
        out.append("")
    target = THEME / "languages" / "captain-plugins.pot"
    target.parent.mkdir(exist_ok=True)
    content = "\n".join(out)
    strip_date = lambda text: re.sub(r'"POT-Creation-Date: [^"]*"\n', "", text)
    if target.exists() and strip_date(target.read_text(encoding="utf-8")) == strip_date(content):
        print(f"{len(entries)} Strings, keine Änderung an {target.relative_to(ROOT)}")
        return
    target.write_text(content, encoding="utf-8")
    print(f"{len(entries)} Strings nach {target.relative_to(ROOT)} geschrieben")


if __name__ == "__main__":
    main()
