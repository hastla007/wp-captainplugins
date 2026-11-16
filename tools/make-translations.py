#!/usr/bin/env python3
"""Build languages/en_US.po and en_US.mo from captain-plugins.pot and tools/translations_en_US.py.

Run from the repository root: python3 tools/make-translations.py
Fails if a string in the POT has no translation, so new UI strings cannot slip through untranslated.
"""
from __future__ import annotations

import re
import struct
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
sys.path.insert(0, str(ROOT / "tools"))
from translations_en_US import EN, EN_PLURAL  # noqa: E402

LANG = ROOT / "theme" / "captain-plugins" / "languages"
ENTRY = re.compile(r'((?:#[^\n]*\n)*)msgid "(.*)"\n(?:msgid_plural "(.*)"\n)?(?:msgstr(?:\[0\])? ""\n)(?:msgstr\[1\] ""\n)?')


def unquote(value: str) -> str:
    return value.replace('\\"', '"').replace("\\n", "\n").replace("\\\\", "\\")


def quote(value: str) -> str:
    return '"' + value.replace("\\", "\\\\").replace('"', '\\"').replace("\n", "\\n") + '"'


def write_mo(path: Path, messages: dict[str, str]) -> None:
    keys = sorted(messages)
    ids = b"".join(k.encode() + b"\0" for k in keys)
    strs = b"".join(messages[k].encode() + b"\0" for k in keys)
    count = len(keys)
    header = 7 * 4
    key_table = header
    value_table = key_table + count * 8
    ids_start = value_table + count * 8
    strs_start = ids_start + len(ids)
    offsets_k, offsets_v, pos_k, pos_v = [], [], 0, 0
    for k in keys:
        raw = k.encode()
        offsets_k.append((len(raw), ids_start + pos_k)); pos_k += len(raw) + 1
        raw = messages[k].encode()
        offsets_v.append((len(raw), strs_start + pos_v)); pos_v += len(raw) + 1
    data = struct.pack("<7I", 0x950412DE, 0, count, key_table, value_table, 0, 0)
    data += b"".join(struct.pack("<2I", *o) for o in offsets_k)
    data += b"".join(struct.pack("<2I", *o) for o in offsets_v)
    path.write_bytes(data + ids + strs)


def main() -> None:
    pot = (LANG / "captain-plugins.pot").read_text(encoding="utf-8")
    body = pot.split("\n\n", 1)[1]
    po = [
        "# English (US) translation of the Captain Plugins theme.",
        'msgid ""', 'msgstr ""',
        '"Project-Id-Version: Captain Plugins Theme\\n"', '"Language: en_US\\n"',
        '"MIME-Version: 1.0\\n"', '"Content-Type: text/plain; charset=UTF-8\\n"', '"Content-Transfer-Encoding: 8bit\\n"',
        '"Plural-Forms: nplurals=2; plural=(n != 1);\\n"', '"X-Domain: captain-plugins\\n"', "",
    ]
    messages = {"": "Language: en_US\nContent-Type: text/plain; charset=UTF-8\nPlural-Forms: nplurals=2; plural=(n != 1);\n"}
    missing = []
    for match in ENTRY.finditer(body + "\n"):
        comments, msgid, plural = match.group(1), unquote(match.group(2)), match.group(3)
        if plural is not None:
            plural = unquote(plural)
            if msgid not in EN_PLURAL:
                missing.append(msgid); continue
            one, other = EN_PLURAL[msgid]
            po += [comments.rstrip("\n"), f"msgid {quote(msgid)}", f"msgid_plural {quote(plural)}", f"msgstr[0] {quote(one)}", f"msgstr[1] {quote(other)}", ""]
            messages[msgid + "\0" + plural] = one + "\0" + other
        else:
            if msgid not in EN:
                missing.append(msgid); continue
            po += [comments.rstrip("\n"), f"msgid {quote(msgid)}", f"msgstr {quote(EN[msgid])}", ""]
            messages[msgid] = EN[msgid]
    if missing:
        print("Fehlende englische Übersetzungen:\n  " + "\n  ".join(missing))
        sys.exit(1)
    (LANG / "en_US.po").write_text("\n".join(line for line in po if line != "" or True), encoding="utf-8")
    write_mo(LANG / "en_US.mo", messages)
    print(f"{len(messages) - 1} Übersetzungen nach languages/en_US.po und en_US.mo geschrieben")


if __name__ == "__main__":
    main()
