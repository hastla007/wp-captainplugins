#!/usr/bin/env python3
"""Check the SEO head of every page on a running site (with or without Yoast SEO).

Usage: python3 tools/qa/seo-head.py --base https://staging.example.com
Reads the generated page manifest (theme/captain-plugins/content/pages.php is mirrored by the
markdown sources in texte/homepage) and checks for every page with a URL:
  - exactly one <title>, one canonical, one robots meta tag, at most one meta description
  - title and description equal the imported SEO title / meta description
  - indexable content pages: canonical points to the page itself, og:image present when Yoast is active
  - WooCommerce cart/checkout/account and search: noindex
Exit code 1 on any finding.
"""
import argparse
import html
import re
import sys
import urllib.request
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
SOURCE = ROOT / "texte" / "homepage"


def front_matter(text):
    match = re.match(r"\A---\n(.*?)\n---", text, re.S)
    data = {}
    if match:
        for line in match.group(1).splitlines():
            if ":" in line:
                key, value = line.split(":", 1)
                data[key.strip()] = value.strip().strip('"')
    return data


def fetch(url):
    try:
        with urllib.request.urlopen(url, timeout=60) as response:
            return response.status, response.read().decode("utf-8", "replace")
    except urllib.error.HTTPError as error:
        return error.code, error.read().decode("utf-8", "replace")


def head_of(page):
    return page.split("</head>", 1)[0]


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument("--base", default="http://localhost:8088")
    parser.add_argument("--noindex", default="/cart/,/checkout/,/my-account/,/?s=Gutschein",
                        help="comma-separated paths that must be noindex")
    args = parser.parse_args()
    base = args.base.rstrip("/")
    problems = []
    pages = []
    for file in sorted(SOURCE.rglob("*.md")):
        if file.name in ("README.md", "konzept.md", "medieninventar.md"):
            continue
        meta = front_matter(file.read_text(encoding="utf-8"))
        if meta.get("url"):
            pages.append(meta)

    yoast = None
    for meta in pages:
        url = meta["url"]
        status, page = fetch(base + url)
        if status != 200:
            problems.append(f"{url}: HTTP {status}")
            continue
        head = head_of(page)
        if yoast is None:
            yoast = "Yoast SEO plugin" in head
        titles = re.findall(r"<title>(.*?)</title>", head, re.S)
        descriptions = re.findall(r'<meta name="description" content="([^"]*)"', head)
        canonicals = re.findall(r'<link rel="canonical" href="([^"]*)"', head)
        robots = re.findall(r"<meta name=['\"]robots['\"] content=['\"]([^'\"]*)['\"]", head)
        if len(titles) != 1:
            problems.append(f"{url}: {len(titles)} <title>-Tags")
        elif meta.get("seo_title") and html.unescape(titles[0]).strip() != meta["seo_title"]:
            problems.append(f"{url}: Titel „{html.unescape(titles[0])[:60]}“ ≠ SEO-Titel „{meta['seo_title'][:60]}“")
        if len(descriptions) > 1:
            problems.append(f"{url}: {len(descriptions)} Meta-Beschreibungen")
        elif meta.get("meta_description") and (not descriptions or html.unescape(descriptions[0]) != meta["meta_description"]):
            problems.append(f"{url}: Meta-Beschreibung fehlt oder weicht ab")
        if len(canonicals) != 1:
            problems.append(f"{url}: {len(canonicals)} Canonical-Links")
        elif canonicals[0].rstrip("/") != (base + url).rstrip("/"):
            problems.append(f"{url}: Canonical zeigt auf {canonicals[0]}")
        if len(robots) != 1:
            problems.append(f"{url}: {len(robots)} robots-Meta-Tags")
        elif "noindex" in robots[0]:
            problems.append(f"{url}: Inhaltsseite steht auf noindex")
        if yoast and not re.search(r'<meta property="og:image"', head):
            problems.append(f"{url}: kein og:image")

    for path in [p for p in args.noindex.split(",") if p]:
        status, page = fetch(base + path)
        robots = re.findall(r"<meta name=['\"]robots['\"] content=['\"]([^'\"]*)['\"]", head_of(page))
        if status == 200 and not any("noindex" in r for r in robots):
            problems.append(f"{path}: sollte noindex sein")

    mode = "mit Yoast SEO" if yoast else "ohne Yoast (Theme-Rückfall)"
    if problems:
        print(f"{len(pages)} Seiten {mode} geprüft, {len(problems)} Befunde:")
        for problem in problems:
            print("  " + problem)
        return 1
    print(f"{len(pages)} Seiten {mode} geprüft: je ein Titel, Canonical und robots-Tag, Titel und Beschreibung wie importiert, Shop-Seiten und Suche noindex.")
    return 0


if __name__ == "__main__":
    sys.exit(main())
