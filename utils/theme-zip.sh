#!/bin/sh
set -eu

SCRIPT_DIR=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
THEME_ROOT=$(CDPATH= cd -- "$SCRIPT_DIR/.." && pwd)
THEME_NAME=$(basename "$THEME_ROOT")
VERSION=$(awk -F ': *' '$1 == "Version" { print $2; exit }' "$THEME_ROOT/style.css")
VERSION=$(printf '%s' "$VERSION" | tr -s '[:space:]' '-')

case "$VERSION" in
	''|*[!A-Za-z0-9._-]*)
		printf 'Invalid or missing Version header in %s/style.css\n' "$THEME_ROOT" >&2
		exit 1
		;;
esac

ARCHIVE="$THEME_ROOT/$THEME_NAME-$VERSION.zip"

rm -f "$ARCHIVE"

(
	cd "$THEME_ROOT/.."
	zip -r "$ARCHIVE" \
		"$THEME_NAME/style.css" \
		"$THEME_NAME/functions.php" \
		"$THEME_NAME/front-page.php" \
		"$THEME_NAME/index.php" \
		"$THEME_NAME/theme.json" \
		"$THEME_NAME/readme.txt" \
		"$THEME_NAME/screenshot.png" \
		"$THEME_NAME/assets/css" \
		"$THEME_NAME/assets/fonts" \
		"$THEME_NAME/assets/icons" \
		"$THEME_NAME/assets/images" \
		"$THEME_NAME/assets/js" \
		"$THEME_NAME/inc" \
		"$THEME_NAME/parts" \
		"$THEME_NAME/patterns" \
		"$THEME_NAME/styles" \
		"$THEME_NAME/templates" \
		-x "*/.*" "*-SAVE*" "*-TEST*" "*.map" \
			"*/patterns/html/*" "*/patterns/converted/*"
)

unzip -t "$ARCHIVE"
