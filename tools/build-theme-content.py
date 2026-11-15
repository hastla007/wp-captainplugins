#!/usr/bin/env python3
"""Compile texte/homepage Markdown to editable Gutenberg blocks for the theme.

Run from the repository root:
    python3 tools/build-theme-content.py

The generated files are shipped with the theme. Python is only needed when source
copy changes; the active WordPress theme has no Python or Markdown dependency.
"""

from __future__ import annotations

import hashlib
import html
import json
import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
SOURCE = ROOT / "texte" / "homepage"
OUTPUT = ROOT / "theme" / "captain-plugins" / "content"
SKIP = {"README.md", "konzept.md"}
PRODUCT_NAMES = {
    "voucher-captain": "Voucher Captain",
    "pass-captain": "Pass Captain",
    "affiliate-captain": "Affiliate Captain",
    "license-captain": "License Captain",
}


def block(name: str, inner: str, attrs: dict | None = None) -> str:
    attr = " " + json.dumps(attrs, ensure_ascii=False, separators=(",", ":")) if attrs else ""
    return f"<!-- wp:{name}{attr} -->\n{inner}\n<!-- /wp:{name} -->"


def inline(text: str) -> str:
    code: list[str] = []

    def save_code(match: re.Match[str]) -> str:
        code.append("<code>" + html.escape(match.group(1)) + "</code>")
        return f"\x00CODE{len(code) - 1}\x00"

    text = re.sub(r"`([^`]+)`", save_code, text)
    text = html.escape(text, quote=False)

    def link(match: re.Match[str]) -> str:
        label, url = match.group(1), html.unescape(match.group(2)).strip()
        if not re.match(r"^(https?://|mailto:|tel:|/|#|\[)", url, re.I):
            return label
        return f'<a href="{html.escape(url, quote=True)}">{label}</a>'

    text = re.sub(r"\[([^\]]+)\]\(([^)\s]+)(?:\s+\"[^\"]*\")?\)", link, text)
    text = re.sub(r"\*\*(.+?)\*\*|__(.+?)__", lambda m: "<strong>" + (m.group(1) or m.group(2)) + "</strong>", text)
    text = re.sub(r"(?<!\*)\*(?!\s)(.+?)(?<!\s)\*(?!\*)|(?<!_)_(?!\s)(.+?)(?<!\s)_(?!_)", lambda m: "<em>" + (m.group(1) or m.group(2)) + "</em>", text)
    for i, value in enumerate(code):
        text = text.replace(f"\x00CODE{i}\x00", value)
    return text


def parse_markdown(source: str) -> tuple[str, str]:
    match = re.match(r"\A---\s*\n(.*?)\n---\s*\n(.*)\Z", source, re.S)
    if not match:
        return {}, source.strip()
    meta: dict[str, str] = {}
    for line in match.group(1).splitlines():
        field = re.match(r"^([a-zA-Z_][\w-]*):\s*(.*?)\s*$", line)
        if field:
            meta[field.group(1)] = field.group(2).strip().strip("\"'")
    return meta, match.group(2).strip()


def split_table_row(line: str) -> list[str]:
    cells = line.strip().strip("|").split("|")
    return [cell.strip() for cell in cells]


def is_table_separator(line: str) -> bool:
    return bool(re.fullmatch(r"\s*\|?\s*:?-{3,}:?\s*(\|\s*:?-{3,}:?\s*)+\|?\s*", line))


def markdown_blocks(markdown: str) -> str:
    lines = markdown.splitlines()
    out: list[str] = []
    i = 0
    paragraph: list[str] = []

    def flush_paragraph() -> None:
        if paragraph:
            out.append(block("paragraph", "<p>" + inline(" ".join(x.strip() for x in paragraph)) + "</p>"))
            paragraph.clear()

    while i < len(lines):
        line = lines[i]
        if not line.strip():
            flush_paragraph(); i += 1; continue
        heading = re.match(r"^(#{1,6})\s+(.+?)\s*#*\s*$", line)
        if heading:
            flush_paragraph()
            level = min(len(heading.group(1)), 6)
            body = inline(heading.group(2))
            out.append(block("heading", f'<h{level} class="wp-block-heading">{body}</h{level}>', {"level": level}))
            i += 1; continue
        if line.lstrip().startswith("|") and i + 1 < len(lines) and is_table_separator(lines[i + 1]):
            flush_paragraph()
            header = split_table_row(line)
            i += 2
            rows = []
            while i < len(lines) and lines[i].lstrip().startswith("|"):
                rows.append(split_table_row(lines[i])); i += 1
            head_html = "<thead><tr>" + "".join("<th>" + inline(c) + "</th>" for c in header) + "</tr></thead>"
            body_html = "<tbody>" + "".join("<tr>" + "".join("<td>" + inline(c) + "</td>" for c in row) + "</tr>" for row in rows) + "</tbody>"
            out.append(block("table", "<figure class=\"wp-block-table\"><table>" + head_html + body_html + "</table></figure>"))
            continue
        list_match = re.match(r"^\s*(?:([-+*])\s+|\d+[.)]\s+)(.*)$", line)
        if list_match:
            flush_paragraph()
            ordered = bool(re.match(r"^\s*\d+[.)]\s+", line))
            items = []
            while i < len(lines):
                current = re.match(r"^\s*(?:([-+*])\s+|\d+[.)]\s+)(.*)$", lines[i])
                if not current:
                    break
                items.append(current.group(2).strip())
                i += 1
            tag = "ol" if ordered else "ul"
            attrs = {"ordered": True} if ordered else None
            inner = f'<{tag} class="wp-block-list">' + "".join(block("list-item", "<li>" + inline(item) + "</li>") for item in items) + f"</{tag}>"
            out.append(block("list", inner, attrs))
            continue
        if re.match(r"^>\s?", line):
            flush_paragraph()
            quote = []
            while i < len(lines) and re.match(r"^>\s?", lines[i]):
                quote.append(re.sub(r"^>\s?", "", lines[i])); i += 1
            out.append(block("quote", "<blockquote class=\"wp-block-quote\"><p>" + inline(" ".join(quote)) + "</p></blockquote>"))
            continue
        if re.fullmatch(r"\s*(---|\*\*\*|___)\s*", line):
            flush_paragraph(); out.append(block("separator", '<hr class="wp-block-separator has-alpha-channel-opacity"/>')); i += 1; continue
        paragraph.append(line)
        i += 1
    flush_paragraph()
    return "\n\n".join(out)


def title_from_path(path: str) -> str:
    parts = [part for part in path.split("/") if part]
    if not parts:
        return "Startseite"
    last = parts[-1]
    return PRODUCT_NAMES.get(last, last.replace("-", " ").capitalize())


def page_group(path: str) -> str:
    if path.startswith("ratgeber/"):
        return "guides"
    if path.startswith(("voucher-captain/", "pass-captain/", "affiliate-captain/", "license-captain/", "dokumentation/installation/")):
        return "products"
    return "core"


def placeholder_present(text: str) -> bool:
    patterns = (
        r"\[(?:Download|Checkout|Support|Demo|Screenshot|Kundenbeispiel)[^\]]*\]",
        r"\[\[(?:Betreiber|offen|Platzhalter)[^\]]*\]\]",
        r"\b(?:Platzhalter|vor Veröffentlichung ergänzen|vor Veröffentlichung ersetzen|nach Freigabe einsetzen)\b",
    )
    return any(re.search(pattern, text, re.I) for pattern in patterns)


def entry_file(path: str) -> str:
    slug = path.split("/")[-1] if path else "startseite"
    key = hashlib.sha1(path.encode("utf-8")).hexdigest()[:8]
    safe = re.sub(r"[^a-z0-9-]+", "-", slug.lower()).strip("-") or "page"
    return f"{key}-{safe}.html"


def build() -> None:
    pages_dir = OUTPUT / "pages"
    pages_dir.mkdir(parents=True, exist_ok=True)
    sources: dict[str, dict] = {}
    for file in sorted(SOURCE.rglob("*.md")):
        if file.name in SKIP:
            continue
        meta, body = parse_markdown(file.read_text(encoding="utf-8"))
        url = meta.get("url", "").strip()
        if not url.startswith("/"):
            continue
        path = url.strip("/")
        title_match = re.search(r"^#\s+(.+?)\s*#*\s*$", body, re.M)
        title = title_match.group(1).strip() if title_match else title_from_path(path)
        if path:
            body = re.sub(r"^#\s+.+?(?:\n+|$)", "", body, count=1, flags=re.M)
        markup = markdown_blocks(body)
        file_name = entry_file(path)
        (pages_dir / file_name).write_text(markup + ("\n" if markup else ""), encoding="utf-8")
        sources[path] = {
            "path": path,
            "slug": path.split("/")[-1] if path else "startseite",
            "parent": "/".join(path.split("/")[:-1]) if "/" in path else "",
            "title": title,
            "group": page_group(path),
            "file": file_name,
            "seo_title": meta.get("seo_title", ""),
            "meta_description": meta.get("meta_description", ""),
            "focus_keyphrase": meta.get("focus_keyphrase", ""),
            "has_placeholders": placeholder_present(source := file.read_text(encoding="utf-8")),
            "source_hash": hashlib.sha256(source.encode("utf-8")).hexdigest(),
            "source_file": file.relative_to(ROOT).as_posix(),
        }

    # Add compact directory pages for URL ancestors that have no authored page.
    missing: dict[str, set[str]] = {}
    for path, entry in list(sources.items()):
        parts = path.split("/") if path else []
        for end in range(1, len(parts)):
            parent = "/".join(parts[:end])
            if parent not in sources:
                missing.setdefault(parent, set()).add(path)
    for path in sorted(missing, key=lambda value: (value.count("/"), value)):
        slug = path.split("/")[-1]
        group = "guides" if path.startswith("ratgeber/") else "core"
        title = "Ratgeber" if path == "ratgeber" else ("Lösungen" if path == "loesungen" else title_from_path(path))
        children = sorted({item[len(path) + 1:].split("/")[0] for item in missing[path] if item.startswith(path + "/")})
        items = []
        for child in children:
            child_path = f"{path}/{child}"
            child_title = sources.get(child_path, {}).get("title") or title_from_path(child_path)
            items.append(f'<li><a href="/{child_path}/">{html.escape(child_title)}</a></li>')
        intro = "Themen und Anleitungen aus dem Captain-Plugins-Umfeld." if group == "guides" else "Lösungen für wiederkehrende Geschäftsabläufe mit WordPress."
        markup = block("paragraph", f"<p>{intro}</p>")
        if items:
            markup += "\n\n" + block("list", '<ul class="wp-block-list">' + "".join(block("list-item", item) for item in items) + "</ul>")
        file_name = entry_file(path)
        (pages_dir / file_name).write_text(markup + "\n", encoding="utf-8")
        sources[path] = {
            "path": path, "slug": slug, "parent": "/".join(path.split("/")[:-1]), "title": title,
            "group": group, "file": file_name, "seo_title": "", "meta_description": "", "focus_keyphrase": "",
            "has_placeholders": False, "source_hash": hashlib.sha256(markup.encode("utf-8")).hexdigest(),
            "source_file": "generated directory page",
        }

    entries = sorted(sources.values(), key=lambda item: (item["path"].count("/"), item["path"]))
    manifest = "<?php\n/** Generated by tools/build-theme-content.py; edit texte/homepage/*.md and rebuild. */\n\nif ( ! defined( 'ABSPATH' ) ) { exit; }\n\nreturn " + "[\n"
    for item in entries:
        manifest += "\t" + "[\n"
        for key, value in item.items():
            manifest += f"\t\t{json.dumps(key)} => {json.dumps(value, ensure_ascii=False)},\n"
        manifest += "\t],\n"
    manifest += "];\n"
    (OUTPUT / "pages.php").write_text(manifest, encoding="utf-8")
    print(f"Generated {len(entries)} page records in {OUTPUT.relative_to(ROOT)}")


if __name__ == "__main__":
    build()
