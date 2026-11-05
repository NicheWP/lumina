#!/bin/zsh

# Scope paths
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
THEME_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"
DOCS_DIR="${THEME_ROOT}/docs"
MD_FILE="${DOCS_DIR}/patterns.md"
HTML_FILE="${DOCS_DIR}/patterns.html"

mkdir -p "$DOCS_DIR"

# -----------------------------------------------------------------------------
# 1. GENERATE PATTERNS.MD (FOR GITHUB REPO BROWSING)
# -----------------------------------------------------------------------------
cat << 'EOF' > "$MD_FILE"
# Lumina Theme Architecture: Block Patterns Catalog

| Title | Slug | Categories | Description |
| :--- | :--- | :--- | :--- |
EOF

# -----------------------------------------------------------------------------
# 2. GENERATE PATTERNS.HTML (FOR GITHUB PAGES PORTAL)
# -----------------------------------------------------------------------------
cat << 'EOF' > "$HTML_FILE"
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lumina Block Patterns & Template Parts Catalog</title>
	<style>
		:root {
			--bg: #0f172a;
			--card: #1e293b;
			--border: #334155;
			--text: #f8fafc;
			--text-sub: #94a3b8;
			--accent: #38bdf8;
			--font: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
		}
		body { background: var(--bg); color: var(--text); font-family: var(--font); padding: 2rem; margin: 0; }
		.container { max-width: 1200px; margin: 0 auto; }
		header { margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem; }
		header h1 { margin: 0 0 0.5rem 0; font-size: 2rem; }
		header a { color: var(--accent); text-decoration: none; font-size: 0.9rem; }
		table { width: 100%; border-collapse: collapse; background: var(--card); border-radius: 8px; overflow: hidden; }
		th, td { padding: 1rem; text-align: left; border-bottom: 1px solid var(--border); }
		th { background: #0f172a; color: var(--accent); font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }
		tr:last-child td { border-bottom: none; }
		code { background: #0f172a; color: var(--accent); padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.875rem; }
		.desc { color: var(--text-sub); font-size: 0.9rem; }
	</style>
</head>
<body>
	<div class="container">
		<header>
			<h1>Lumina Block Patterns Catalog</h1>
			<a href="index.html">&larr; Back to Documentation Portal</a>
		</header>
		<table>
			<thead>
				<tr>
					<th>Title</th>
					<th>Slug</th>
					<th>Categories</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
EOF

# -----------------------------------------------------------------------------
# 3. PARSE PHP PATTERN HEADERS
# -----------------------------------------------------------------------------
find "${THEME_ROOT}/patterns" -name "*.php" | sort | while read -r file; do
    title=$(grep -i "Title:" "$file" | sed -E 's/.*Title:[[:space:]]*//I' | tr -d '\r')
    slug=$(grep -i "Slug:" "$file" | sed -E 's/.*Slug:[[:space:]]*//I' | tr -d '\r')
    cats=$(grep -i "Categories:" "$file" | sed -E 's/.*Categories:[[:space:]]*//I' | tr -d '\r')
    desc=$(grep -i "Description:" "$file" | sed -E 's/.*Description:[[:space:]]*//I' | tr -d '\r')

    if [[ -n "$title" && -n "$slug" ]]; then
        # Append to Markdown
        echo "| **${title}** | \`${slug}\` | \`${cats}\` | ${desc} |" >> "$MD_FILE"

        # Append to HTML
        cat << EOF >> "$HTML_FILE"
				<tr>
					<td><strong>${title}</strong></td>
					<td><code>${slug}</code></td>
					<td><code>${cats}</code></td>
					<td class="desc">${desc}</td>
				</tr>
EOF
    fi
done

# Close HTML File
cat << 'EOF' >> "$HTML_FILE"
			</tbody>
		</table>
	</div>
</body>
</html>
EOF

echo "🎉 Generated both ${MD_FILE#$THEME_ROOT/} and ${HTML_FILE#$THEME_ROOT/}"
