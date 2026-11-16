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
    "form-captain": "Form Captain",
    "review-captain": "Review Captain",
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
        label, url = re.sub(r"^CTA:\s*", "", match.group(1)), html.unescape(match.group(2)).strip()
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
        label, url = re.sub(r"^CTA:\s*", "", match.group(1).strip()), match.group(2).strip()
        pending = bool(re.fullmatch(r"\[[^\]]+\]", url))
        if not pending and not re.match(r"^(https?://|mailto:|tel:|/|#)", url, re.I):
            return None
        classes = (["is-style-outline"] if index else []) + (["cp-button-pending"] if pending else [])
        button_class = " ".join(["wp-block-button"] + classes)
        attrs = {"className": " ".join(classes)} if classes else None
        # Missing download/checkout targets stay visible as non-interactive, clearly marked buttons.
        href = "" if pending else f' href="{html.escape(url, quote=True)}"'
        buttons.append(block("button", f'<div class="{button_class}"><a class="wp-block-button__link wp-element-button"{href}>{inline(label)}</a></div>', attrs))
    return block("buttons", '<div class="wp-block-buttons cp-actions">' + "\n".join(buttons) + "</div>", {"className": "cp-actions"})


def markdown_blocks(markdown: str, page_path: str = "") -> str:
    lines = markdown.splitlines()
    out: list[str] = []
    i = 0
    paragraph: list[str] = []

    def flush_paragraph() -> None:
        if not paragraph:
            return
        editorial_line = re.compile(r"^\s*(?:\[(?:Screenshot-Platzhalter|Demo|Kundenbeispiel):[^\]]+\][\s·|•]*)+$", re.I)
        runs: list[list[str]] = []
        for line in paragraph:
            kind = editorial_line.match(line) is not None
            if runs and (editorial_line.match(runs[-1][-1]) is not None) == kind:
                runs[-1].append(line)
            else:
                runs.append([line])
        paragraph.clear()
        for run in runs:
            paragraph.extend(run)
            emit_paragraph()

    def emit_paragraph() -> None:
        if paragraph:
            text = " ".join(x.strip() for x in paragraph)
            ctas = cta_buttons(text)
            if ctas:
                out.append(ctas)
                paragraph.clear()
                return
            editorial_pattern = re.compile(r"\[(Screenshot-Platzhalter|Demo|Kundenbeispiel):\s*([^\]]+)\]", re.I)
            editorial = list(editorial_pattern.finditer(text))
            if editorial and not re.sub(r"[\s·|•]+", "", editorial_pattern.sub("", text)):
                children = block("paragraph", '<p class="cp-media-placeholder__label">Produktansicht folgt</p>', {"className": "cp-media-placeholder__label"})
                for item in editorial:
                    label = "Screenshot" if item.group(1).lower().startswith("screenshot") else item.group(1).capitalize()
                    brief = inline(item.group(2))
                    children += "\n\n" + block("paragraph", f'<p class="cp-media-placeholder__brief"><strong>{html.escape(label)}:</strong> {brief}</p>')
                children += "\n\n" + block("paragraph", '<p class="cp-media-placeholder__note">Redaktioneller Platzhalter: vor Veröffentlichung durch freigegebene Medien bzw. einen belegten Kundenfall ersetzen.</p>')
                out.append(block("group", f'<div class="wp-block-group cp-media-placeholder">{children}</div>', {"className": "cp-media-placeholder", "layout": {"type": "default"}}))
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
            table_class = "cp-pricing-table" if page_path in ("preise", "captain-pro") or re.fullmatch(r"[a-z]+-captain/pro", page_path) else ""
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
            faq_group = block("group", f'<div class="wp-block-group cp-faq">{children}</div>', {"className": "cp-faq", "layout": {"type": "default"}})
            out = intro + [faq_group]

    return compose_sections(out, page_path)


PRODUCT_SLUGS = tuple(PRODUCT_NAMES)
PLAN_NAMES = ("Single", "Business", "Agency")
HEADING_RE = re.compile(r'<!-- wp:heading \{"level":(\d+)')


def group_block(class_name: str, children: list[str], align: str = "", tag: str = "") -> str:
    attrs: dict = {}
    if tag:
        attrs["tagName"] = tag
    if align:
        attrs["align"] = align
    attrs["className"] = class_name
    attrs["layout"] = {"type": "default"}
    element = tag or "div"
    classes = "wp-block-group" + (f" align{align}" if align else "") + f" {class_name}"
    inner = "\n\n".join(children)
    return block("group", f'<{element} class="{classes}">{inner}</{element}>', attrs)


def heading_level(item: str) -> int:
    match = HEADING_RE.match(item)
    return int(match.group(1)) if match else 0


def with_class(item: str, class_name: str) -> str:
    """Add a CSS class to a generated paragraph, heading or list block."""
    match = re.match(r"<!-- wp:(paragraph|heading|list)( \{.*?\})? -->\n<(p|h\d|ul|ol)( class=\"([^\"]*)\")?", item)
    if not match:
        return item
    attrs = json.loads(match.group(2)) if match.group(2) else {}
    attrs["className"] = (attrs.get("className", "") + " " + class_name).strip()
    tag = match.group(3)
    classes = ((match.group(5) or "") + " " + class_name).strip()
    name = match.group(1)
    head = f"<!-- wp:{name} {json.dumps(attrs, ensure_ascii=False, separators=(',', ':'))} -->\n<{tag} class=\"{classes}\""
    return head + item[match.end():]


def plain_text(item: str) -> str:
    return re.sub(r"\s+", " ", html.unescape(re.sub(r"<!--.*?-->|<[^>]+>", " ", item, flags=re.S))).strip()


def product_of(items: list[str]) -> str:
    text = "\n".join(items)
    for slug in PRODUCT_SLUGS:
        if f'href="/{slug}/"' in text:
            return slug.split("-")[0]
    heading = plain_text(items[0]) if items else ""
    for slug, name in PRODUCT_NAMES.items():
        if name in heading:
            return slug.split("-")[0]
    return ""


def link_line_to_text(item: str) -> str:
    """Inside cards, CTA rows become quiet text links instead of competing buttons."""
    if not item.startswith("<!-- wp:buttons "):
        return item
    links = re.findall(r'<a class="wp-block-button__link wp-element-button"(?: href="([^"]+)")?>(.*?)</a>', item, re.S)
    inner = "<br>".join(
        f'<a href="{href}">{label}</a>' if href else
        f'<span class="cp-link-placeholder"><span>{label}</span><small>Linkziel vor Veröffentlichung ergänzen</small></span>'
        for href, label in links
    )
    return block("paragraph", f'<p class="cp-card__links">{inner}</p>', {"className": "cp-card__links"})


def stack_links(item: str) -> str:
    """Put each link of a card link row on its own line instead of a dot-separated run."""
    return re.sub(r"(</a>|</span></span>)\s*·\s*", r"\1<br>", item)


def is_card_links(item: str) -> bool:
    if not item.startswith("<!-- wp:paragraph -->"):
        return False
    text = re.sub(r"<a [^>]+>.*?</a>|<span class=\"cp-link-placeholder\">.*?</small></span>|<strong>.*?</strong>", "", item, flags=re.S)
    return bool(re.search(r"<a |cp-link-placeholder", item)) and not plain_text(text).strip(" ·|")


def card_grid(children: list[str]) -> list[str] | None:
    """Turn an H2 section with several H3 subsections into an even card grid."""
    if sum(1 for c in children if heading_level(c) == 3) < 2:
        return None
    if any(heading_level(c) > 3 for c in children) or any(c.startswith(("<!-- wp:table", "<!-- wp:group")) for c in children):
        return None
    lead: list[str] = []
    cards: list[list[str]] = []
    trailing: list[str] = []
    for child in children:
        if heading_level(child) == 3:
            cards.append([child])
        elif cards:
            cards[-1].append(child)
        else:
            lead.append(child)
    # A closing button row after the last card belongs to the section, not the card.
    others_have_links = any(
        any(item.startswith("<!-- wp:buttons ") or is_card_links(item) for item in card[1:]) for card in cards[:-1]
    )
    if cards and len(cards[-1]) > 1 and cards[-1][-1].startswith("<!-- wp:buttons ") and not others_have_links:
        trailing.append(cards[-1].pop())
    rendered = []
    for card in cards:
        product = product_of(card)
        items = []
        for item in card:
            item = link_line_to_text(item)
            if is_card_links(item):
                item = stack_links(with_class(item, "cp-card__links"))
            items.append(item)
        class_name = "cp-card" + (f" cp-card--icon cp-card--{product}" if product else "")
        rendered.append(group_block(class_name, items))
    columns = " cp-card-grid--4" if len(cards) == 4 else ""
    return lead + [group_block("cp-card-grid" + columns, rendered)] + trailing


def table_rows(item: str) -> tuple[list[str], list[list[str]]]:
    head = [re.sub(r"\s+", " ", c).strip() for c in re.findall(r"<th[^>]*>(.*?)</th>", item, re.S)]
    rows = [re.findall(r"<td>(.*?)</td>", row, re.S) for row in re.findall(r"<tr>(.*?)</tr>", item.split("<tbody>", 1)[-1], re.S)]
    return head, rows


def plan_card(name: str, sites: str, price: str, extras: list[tuple[str, str]], support: str) -> str:
    children = [block("heading", f'<h3 class="wp-block-heading cp-plan-card__name">{name}</h3>', {"level": 3, "className": "cp-plan-card__name"})]
    if sites:
        children.append(block("paragraph", f'<p class="cp-plan-card__sites">{sites}</p>', {"className": "cp-plan-card__sites"}))
    if price:
        amount = re.sub(r"\s*/\s*Jahr\s*$", "", price).strip()
        children.append(block("paragraph", f'<p class="cp-plan-card__price"><strong>{amount}</strong> / Jahr</p>', {"className": "cp-plan-card__price"}))
    facts = [f"<strong>{label}:</strong> {value}" if label else value for label, value in extras]
    if support:
        facts.append(support)
    if facts:
        items = "".join(block("list-item", f"<li>{fact}</li>") for fact in facts)
        children.append(block("list", f'<ul class="wp-block-list cp-plan-card__facts">{items}</ul>', {"className": "cp-plan-card__facts"}))
    return group_block("cp-plan-card", children)


def plan_name(cell: str) -> tuple[str, str]:
    text = plain_text(cell)
    only_sites = re.match(r"^(\d+)\s+(?:Live-)?Websites?$", text)
    if only_sites:
        count = only_sites.group(1)
        return f"{count} {'Live-Website' if count == '1' else 'Live-Websites'}", ""
    match = re.match(r"^(Single|Business|Agency|Solo|Studio)\b(?:\s*·\s*(\d+)\s+Websites?)?", text)
    if not match:
        return "", ""
    count = match.group(2)
    sites = f"{count} {'Live-Website' if count == '1' else 'Live-Websites'}" if count else ""
    return match.group(1), sites


def support_for(plan: str, page_text: str) -> str:
    if not re.search(r"Agency enthält Priority-Support|Priority-Support für Agency", page_text):
        return ""
    return "Priority-Support" if plan == "Agency" else "Standard-Support"


def plan_cards(item: str, page_text: str) -> list[str] | None:
    """Mobile-friendly plan cards from the Markdown price tables; the source table stays the reference."""
    head, rows = table_rows(item)
    if len(head) < 2 or not rows:
        return None
    # Plans as rows: "Single · 1 Website | 129 €" or "Single | 1 | Einzelne Website".
    if all(plan_name(row[0])[0] for row in rows if row):
        cards = []
        for row in rows:
            name, sites = plan_name(row[0])
            price, extras = "", []
            for label, value in zip(head[1:], row[1:]):
                value = value.strip()
                if "€" in value:
                    price = value
                elif label.lower().startswith("live-website"):
                    sites = f"{value} {'Live-Website' if value == '1' else 'Live-Websites'}"
                else:
                    extras.append((plain_text(label), value))
            has_support = any(label.lower() == "support" for label, _ in extras)
            cards.append(plan_card(name, sites, price, extras, "" if has_support else support_for(name, page_text)))
        return [group_block("cp-plan-grid", cards)]
    # Plans as columns, one row per product (price overview).
    plans = [plan_name(cell) for cell in head[1:]]
    if all(name for name, _ in plans):
        groups = []
        for row in rows:
            product = plain_text(row[0])
            slug = next((s for s, n in PRODUCT_NAMES.items() if product.startswith(n)), "")
            tiers = ("Single", "Business", "Agency")
            cards = [
                plan_card(name, sites, price, [], support_for(tiers[min(index, 2)], page_text))
                for index, ((name, sites), price) in enumerate(zip(plans, row[1:]))
            ]
            title = block("heading", f'<h3 class="wp-block-heading cp-plan-group__title">{inline(product)}</h3>', {"level": 3, "className": "cp-plan-group__title"})
            parts = [title, group_block("cp-plan-grid", cards)]
            if slug:
                parts.append(block("paragraph", f'<p class="cp-card__links"><a href="/{slug}/pro/">{html.escape(product)}: Funktionen und Pläne</a></p>', {"className": "cp-card__links"}))
            groups.append(group_block("cp-plan-group" + (f" cp-plan-group--{slug.split('-')[0]}" if slug else ""), parts))
        return groups
    return None


def is_media(item: str) -> bool:
    return 'cp-media-placeholder"' in item.split("\n", 1)[0] or '"className":"cp-media-placeholder"' in item.split("\n", 1)[0]


def compose_sections(out: list[str], page_path: str) -> str:
    groups: list[tuple[str, list[str]]] = []
    current: list[str] = []
    for item in out:
        if heading_level(item) == 2 and current:
            kind = "hero" if any(heading_level(c) == 1 for c in current) else ("intro" if not groups else "section")
            groups.append((kind, current))
            current = []
        current.append(item)
    if current:
        kind = "hero" if any(heading_level(c) == 1 for c in current) else ("intro" if not groups else "section")
        groups.append((kind, current))

    page_text = plain_text("\n".join(out))
    is_product = page_path in PRODUCT_SLUGS
    hero_media: str | None = None
    if is_product:
        # The first product-view briefing becomes the hero media frame, as in the product mockups.
        for _, children in groups[1:]:
            for index, child in enumerate(children):
                if is_media(child):
                    hero_media = children.pop(index)
                    break
            if hero_media:
                break

    composed: list[str] = []
    section_index = 0
    pending_features: list[list[str]] = []

    def card_parts(children: list[str]) -> tuple[list[str], list[str]] | None:
        if heading_level(children[0]) != 2:
            return None
        body, spill = [], []
        for child in children[1:]:
            if spill or is_media(child):
                spill.append(child)
            elif child.startswith(("<!-- wp:paragraph", "<!-- wp:buttons")):
                body.append(child)
            else:
                return None
        paragraphs = [c for c in body if c.startswith("<!-- wp:paragraph") and not is_card_links(c)]
        if not paragraphs or len(body) > 3 or sum(len(plain_text(c)) for c in paragraphs) > 420:
            return None
        if any(not (c.startswith(("<!-- wp:buttons", "<!-- wp:paragraph")) or is_media(c)) for c in spill):
            return None
        return [children[0]] + body, spill

    def short_section(children: list[str]) -> bool:
        parts = card_parts(children)
        if parts is None:
            return False
        # Sections with their own call to action stay sections, except product teasers on overview pages.
        has_buttons = any(c.startswith("<!-- wp:buttons ") for c in parts[0])
        return not has_buttons or plain_text(children[0]) in PRODUCT_NAMES.values()

    def flush_features() -> None:
        nonlocal section_index
        if not pending_features:
            return
        if len(pending_features) >= 3:
            cards, spill = [], []
            for children in pending_features:
                body, extra = card_parts(children)
                spill.extend(extra)
                items = [with_class(body[0], "cp-feature-card__title")]
                for item in body[1:]:
                    item = link_line_to_text(item)
                    items.append(stack_links(with_class(item, "cp-card__links")) if is_card_links(item) else item)
                product = product_of(body)
                cards.append(group_block("cp-card cp-feature-card" + (f" cp-card--icon cp-card--{product}" if product else ""), items))
            grid = group_block("cp-card-grid cp-card-grid--features" + (" cp-card-grid--4" if len(cards) == 4 else ""), cards)
            composed.append(group_block("cp-content-section cp-content-section--features", [grid] + spill, "full"))
        else:
            for children in pending_features:
                emit_section(children)
        pending_features.clear()

    def emit_section(children: list[str], extra: str = "") -> None:
        nonlocal section_index
        class_name = "cp-content-section"
        if section_index % 2 == 1:
            class_name += " cp-content-section--soft"
        section_index += 1
        transformed = card_grid(children)
        if transformed is None:
            transformed = []
            for child in children:
                if child.startswith("<!-- wp:table ") and "cp-pricing-table" in child.split("\n", 1)[0]:
                    cards = plan_cards(child, page_text)
                    if cards:
                        transformed.extend(cards)
                        # Keep the full table as the comparison reference on the price overview only.
                        if page_path == "preise":
                            transformed.append(child)
                        continue
                transformed.append(child)
            media = [c for c in transformed if is_media(c)]
            if len(media) == 1 and len(transformed) > 2 and not any(c.startswith(("<!-- wp:table", "<!-- wp:group")) and not is_media(c) for c in transformed):
                text = [c for c in transformed if not is_media(c)]
                transformed = [group_block("cp-split", [group_block("cp-split__text", text), media[0]])]
        if extra:
            class_name += " " + extra
        composed.append(group_block(class_name, transformed, "full"))

    last_index = len(groups) - 1
    for index, (kind, children) in enumerate(groups):
        if kind == "hero":
            flush_features()
            if page_path == "":
                lead = [c for c in children if heading_level(c) != 1]
                h1 = [c for c in children if heading_level(c) == 1]
                text = group_block("cp-hero__text", h1 + [with_class(c, "cp-hero__lead") if c.startswith("<!-- wp:paragraph -->") else c for c in lead])
                composed.append(group_block("cp-hero cp-hero--home", [text], "full"))
            elif is_product:
                name = PRODUCT_NAMES[page_path]
                product = page_path.split("-")[0]
                eyebrow = block("paragraph", f'<p class="cp-product-badge cp-product-badge--{product}">{name}</p>', {"className": f"cp-product-badge cp-product-badge--{product}"})
                body = [with_class(c, "cp-hero__lead") if c.startswith("<!-- wp:paragraph -->") else c for c in children]
                parts = [group_block("cp-hero__text", [eyebrow] + body)]
                if hero_media:
                    parts.append(hero_media)
                composed.append(group_block("cp-hero cp-hero--product" + ("" if hero_media else " cp-hero--no-media"), parts, "full"))
            else:
                composed.append(group_block("cp-content-intro", children, "full"))
            continue
        if kind == "intro":
            flush_features()
            composed.append(group_block("cp-content-intro", children, "full"))
            continue
        if short_section(children):
            pending_features.append(children)
            continue
        flush_features()
        has_buttons = any(c.startswith("<!-- wp:buttons ") for c in children)
        simple = all(c.startswith(("<!-- wp:heading", "<!-- wp:paragraph", "<!-- wp:buttons")) for c in children)
        if index == last_index and has_buttons and simple:
            emit_section(children, "cp-content-section--cta")
        else:
            emit_section(children)
    flush_features()
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
    if path.startswith(tuple(f"{slug}/" for slug in PRODUCT_NAMES) + ("dokumentation/installation/",)):
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
        # Product start pages keep their H1 inside the designed product hero.
        if path and path not in PRODUCT_SLUGS:
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
            # Hash source and generated layout so layout improvements reach untouched imported pages.
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
        group = "guides" if path == "ratgeber" or path.startswith("ratgeber/") else "core"
        title = "Ratgeber" if path == "ratgeber" else ("Lösungen" if path == "loesungen" else title_from_path(path))
        children = sorted({item[len(path) + 1:].split("/")[0] for item in missing[path] if item.startswith(path + "/")})
        cards = []
        for child in children:
            child_path = f"{path}/{child}"
            child_entry = sources.get(child_path, {})
            child_title = child_entry.get("title") or title_from_path(child_path)
            product = child.split("-")[0] if child in PRODUCT_SLUGS else ""
            parts = [block("heading", f'<h2 class="wp-block-heading"><a href="/{child_path}/">{html.escape(child_title)}</a></h2>', {"level": 2})]
            description = child_entry.get("meta_description", "")
            if not description:
                articles = sum(1 for other in missing[path] if other.startswith(child_path + "/"))
                if articles:
                    description = f"{articles} {'Artikel' if articles != 1 else 'Artikel'} mit Anleitungen und Praxisbeispielen."
            if description:
                parts.append(block("paragraph", f'<p>{html.escape(description)}</p>'))
            cards.append(group_block("cp-card cp-resource-card" + (f" cp-card--icon cp-card--{product}" if product else ""), parts))
        intro = "Themen und Anleitungen aus dem Captain-Plugins-Umfeld." if group == "guides" else "Lösungen für wiederkehrende Geschäftsabläufe mit WordPress."
        markup = group_block("cp-content-intro", [block("paragraph", f"<p>{intro}</p>")], "full")
        if cards:
            markup += "\n\n" + group_block("cp-content-section", [group_block("cp-card-grid", cards)], "full")
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
