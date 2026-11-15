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
    "review-captain": "Review Captain",
    "form-captain": "Form Captain",
    "workflow-captain": "Workflow Captain",
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
        if re.fullmatch(r"\[[^\]]+\]", url):
            return (
                '<span class="cp-link-placeholder"><span>' + label + '</span>'
                '<small>' + html.escape("Linkziel vor Veröffentlichung ergänzen") + '</small></span>'
            )
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


def cta_buttons(markdown: str) -> str | None:
    pattern = re.compile(r"(?:\*\*)?\[([^\]]+)\]\(([^)]+)\)(?:\*\*)?")
    matches = list(pattern.finditer(markdown))
    if not matches:
        return None
    residue = pattern.sub("", markdown)
    if re.sub(r"[\s·|•]+", "", residue):
        return None
    buttons: list[str] = []
    for index, match in enumerate(matches):
        label, url = match.group(1).strip(), match.group(2).strip()
        if re.fullmatch(r"\[[^\]]+\]", url) or not re.match(r"^(https?://|mailto:|tel:|/|#)", url, re.I):
            return None
        style = " is-style-outline" if index else ""
        button_class = "wp-block-button" + style
        attrs = {"className": "is-style-outline"} if index else None
        buttons.append(block("button", f'<div class="{button_class}"><a class="wp-block-button__link wp-element-button" href="{html.escape(url, quote=True)}">{inline(label)}</a></div>', attrs))
    return block("buttons", '<div class="wp-block-buttons cp-actions">' + "\n".join(buttons) + "</div>", {"className": "cp-actions"})


def markdown_blocks(markdown: str, page_path: str = "") -> str:
    lines = markdown.splitlines()
    out: list[str] = []
    i = 0
    paragraph: list[str] = []

    def flush_paragraph() -> None:
        if paragraph:
            text = " ".join(x.strip() for x in paragraph)
            ctas = cta_buttons(text)
            if ctas:
                out.append(ctas)
                paragraph.clear()
                return
            editorial_pattern = re.compile(r"\[(Screenshot-Platzhalter|Demo|Kundenbeispiel):\s*([^\]]+)\]", re.I)
            editorial = list(editorial_pattern.finditer(text))
            if editorial and not editorial_pattern.sub("", text).strip():
                children = block("heading", '<h3 class="wp-block-heading">Medien für diese Seite</h3>', {"level": 3})
                for item in editorial:
                    label = "Screenshot" if item.group(1).lower().startswith("screenshot") else item.group(1).capitalize()
                    brief = inline(item.group(2))
                    children += "\n\n" + block("paragraph", f'<p class="cp-media-placeholder__brief"><strong>{html.escape(label)}:</strong> {brief}</p>')
                children += "\n\n" + block("paragraph", '<p class="cp-media-placeholder__note">Redaktioneller Platzhalter: vor Veröffentlichung durch freigegebene Medien bzw. einen belegten Kundenfall ersetzen.</p>')
                out.append(block("group", f'<div class="wp-block-group cp-media-placeholder">{children}</div>', {"className": "cp-media-placeholder", "layout": {"type": "constrained"}}))
            else:
                out.append(block("paragraph", "<p>" + inline(text) + "</p>"))
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
            head_html = "<thead><tr>" + "".join('<th scope="col">' + inline(c) + "</th>" for c in header) + "</tr></thead>"
            body_html = "<tbody>" + "".join("<tr>" + "".join("<td>" + inline(c) + "</td>" for c in row) + "</tr>" for row in rows) + "</tbody>"
            table_class = "cp-pricing-table" if page_path == "preise" or re.fullmatch(r"(voucher|pass|affiliate)-captain/pro", page_path) else ""
            table_attrs = {"className": table_class} if table_class else None
            table_figure_class = "wp-block-table" + (" " + table_class if table_class else "")
            out.append(block("table", f'<figure class="{table_figure_class}"><table>' + head_html + body_html + "</table></figure>", table_attrs))
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
    # Use native, keyboard-operable Details blocks for question/answer pages.
    if page_path == "faq" or page_path.endswith("/faq"):
        intro: list[str] = []
        details: list[str] = []
        trailing: list[str] = []
        question = ""
        answer: list[str] = []

        def flush_answer() -> None:
            if not question:
                return
            summary = '<summary>' + question + '</summary>'
            inside = "\n\n".join(answer)
            details.append(block("details", f'<details class="wp-block-details">{summary}{inside}</details>'))
            answer.clear()

        for item in out:
            question_match = re.match(r'<!-- wp:heading \{"level":2\} -->\s*<h2[^>]*>(.*?)</h2>', item, re.S)
            if question_match:
                flush_answer()
                question = question_match.group(1).strip()
            elif question and item.startswith('<!-- wp:buttons '):
                trailing.append(item)
            elif question:
                answer.append(item)
            else:
                intro.append(item)
        flush_answer()
        if details:
            children = "\n\n".join(details + trailing)
            faq_group = block("group", f'<div class="wp-block-group cp-faq">{children}</div>', {"className": "cp-faq", "layout": {"type": "constrained"}})
            out = intro + [faq_group]

    # Turn the Markdown hierarchy into wide section bands. The home intro becomes
    # the designed hero; other page intros and H2 sections get consistent spacing.
    groups: list[tuple[str, list[str]]] = []
    current: list[str] = []
    for item in out:
        heading = re.match(r'<!-- wp:heading \{"level":(\d+)', item)
        if heading and int(heading.group(1)) == 2 and current:
            has_h1 = any(re.match(r'<!-- wp:heading \{"level":1', child) for child in current)
            kind = "hero" if has_h1 else ("intro" if not groups else "section")
            groups.append((kind, current))
            current = []
        current.append(item)
    if current:
        has_h1 = any(re.match(r'<!-- wp:heading \{"level":1', item) for item in current)
        groups.append(("hero" if has_h1 else ("intro" if not groups else "section"), current))

    composed: list[str] = []
    section_index = 0
    for kind, children in groups:
        if kind == "hero":
            class_name = "cp-hero"
            inner = "\n\n".join(children)
            if not page_path:
                eyebrow = block("paragraph", '<p class="cp-eyebrow">WordPress-Plugins für Unternehmen</p>', {"className": "cp-eyebrow"})
                inner = eyebrow + "\n\n" + inner
                hero_image = block(
                    "image",
                    '<figure class="wp-block-image cp-hero__visual"><img src="__CAPTAIN_THEME_URI__/assets/images/captain-hero.jpg" alt="" /></figure>',
                )
                copy = block("group", f'<div class="wp-block-group cp-hero__copy">{inner}</div>', {"className": "cp-hero__copy", "layout": {"type": "constrained"}})
                layout = block("group", f'<div class="wp-block-group cp-hero__layout">{copy}{hero_image}</div>', {"className": "cp-hero__layout", "layout": {"type": "constrained"}})
                inner = layout
        elif kind == "intro":
            class_name = "cp-content-intro"
        else:
            class_name = "cp-content-section"
            if section_index % 2 == 1:
                class_name += " cp-content-section--soft"
            if not page_path and section_index == 0:
                split_at = next((i for i, item in enumerate(children) if re.match(r'<!-- wp:heading \{"level":3', item)), len(children))
                intro_items = children[:split_at]
                feature_items = children[split_at:]
                cards: list[str] = []
                current_card: list[str] = []
                for item in feature_items:
                    if re.match(r'<!-- wp:heading \{"level":3', item) and current_card:
                        card_content = "\n\n".join(current_card)
                        cards.append(block("group", f'<div class="wp-block-group cp-card">{card_content}</div>', {"className": "cp-card", "layout": {"type": "constrained"}}))
                        current_card = []
                    current_card.append(item)
                if current_card:
                    card_content = "\n\n".join(current_card)
                    cards.append(block("group", f'<div class="wp-block-group cp-card">{card_content}</div>', {"className": "cp-card", "layout": {"type": "constrained"}}))
                intro = block("group", '<div class="wp-block-group cp-section__intro">' + "\n\n".join(intro_items) + '</div>', {"className": "cp-section__intro", "layout": {"type": "constrained"}})
                grid = block("group", '<div class="wp-block-group cp-product-grid">' + "\n\n".join(cards) + '</div>', {"className": "cp-product-grid", "layout": {"type": "constrained"}})
                content_inner = block("group", '<div class="wp-block-group cp-section__inner">' + intro + grid + '</div>', {"className": "cp-section__inner", "layout": {"type": "constrained"}})
                inner = content_inner
                class_name += " cp-home-products"
                markup = f'<div class="wp-block-group alignfull {class_name}">{inner}</div>'
                composed.append(block("group", markup, {"align": "full", "className": class_name, "layout": {"type": "constrained"}}))
                section_index += 1
                continue
            section_index += 1
        if kind != "hero":
            inner = "\n\n".join(children)
        markup = f'<div class="wp-block-group alignfull {class_name}">{inner}</div>'
        composed.append(block("group", markup, {"align": "full", "className": class_name, "layout": {"type": "constrained"}}))
    return "\n\n".join(composed)


def title_from_path(path: str) -> str:
    parts = [part for part in path.split("/") if part]
    if not parts:
        return "Startseite"
    last = parts[-1]
    return PRODUCT_NAMES.get(last, last.replace("-", " ").capitalize())


def page_group(path: str) -> str:
    if path.startswith("ratgeber/"):
        return "guides"
    if path.startswith(("voucher-captain/", "pass-captain/", "affiliate-captain/", "license-captain/", "review-captain/", "form-captain/", "workflow-captain/", "dokumentation/installation/")):
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
        markup = markdown_blocks(body, path)
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
            "social_title": meta.get("social_title", ""),
            "social_description": meta.get("social_description", ""),
            "social_image": meta.get("social_image", ""),
            "has_placeholders": placeholder_present(source := file.read_text(encoding="utf-8")),
            "source_hash": hashlib.sha256((source + "\n" + markup).encode("utf-8")).hexdigest(),
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
