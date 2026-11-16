#!/usr/bin/env bash
# Build an installable theme ZIP (Design → Themes → Theme hochladen).
# Usage from the repository root: tools/build-theme-zip.sh
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
THEME="$ROOT/theme/captain-plugins"
VERSION="$(sed -n 's/^Version: *//p' "$THEME/style.css" | head -1)"
OUT="$ROOT/dist/captain-plugins-$VERSION.zip"
mkdir -p "$ROOT/dist"
rm -f "$OUT"
python3 "$ROOT/tools/build-theme-content.py" >/dev/null
python3 "$ROOT/tools/make-pot.py" >/dev/null
python3 "$ROOT/tools/make-translations.py" >/dev/null
for file in $(find "$THEME" -name '*.php'); do php -l "$file" >/dev/null; done
(cd "$ROOT/theme" && zip -qr "$OUT" captain-plugins -x '*/.DS_Store' '*/node_modules/*')
echo "$OUT ($(du -h "$OUT" | cut -f1))"
