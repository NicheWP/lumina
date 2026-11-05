#!/bin/zsh

# Scope paths
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
THEME_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"
DOCS_DIR="${THEME_ROOT}/docs"
MD_FILE="${DOCS_DIR}/parts.md"
HTML_FILE="${DOCS_DIR}/parts.html"

mkdir -p "$DOCS_DIR"

python3 - << 'EOF' "$THEME_ROOT" "$MD_FILE" "$HTML_FILE"
import os, json, sys

theme_root = sys.argv[1]
md_file = sys.argv[2]
html_file = sys.argv[3]

theme_json_path = os.path.join(theme_root, "theme.json")
parts_dir = os.path.join(theme_root, "parts")

# Load theme.json templateParts metadata
parts_meta = {}
if os.path.exists(theme_json_path):
    with open(theme_json_path, 'r', encoding='utf-8') as f:
        try:
            data = json.load(f)
            for item in data.get("templateParts", []):
                name = item.get("name")
                if name:
                    parts_meta[name] = item
        except Exception:
            pass

# Scan /parts directory
parts_list = []
if os.path.exists(parts_dir):
    for f in sorted(os.listdir(parts_dir)):
        if f.endswith(".html"):
            name = f[:-5]
            meta = parts_meta.get(name, {})
            title = meta.get("title", name.replace("-", " ").title())
            area = meta.get("area", "uncategorized")
            desc = meta.get("description", "Structural template part component.")
            parts_list.append({
                "name": name,
                "title": title,
                "area": area,
                "description": desc
            })

# Write PARTS.md
with open(md_file, 'w', encoding='utf-8') as f:
    f.write("# Lumina Theme Architecture: Template Parts Catalog\n\n")
    f.write("| Title | Part Name | Area | Description |\n")
    f.write("| :--- | :--- | :--- | :--- |\n")
    for p in parts_list:
        f.write(f"| **{p['title']}** | `{p['name']}` | `{p['area']}` | {p['description']} |\n")

# Write parts.html
html_content = f"""<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lumina Template Parts Catalog</title>
	<style>
		:root {{
			--bg: #0f172a;
			--card: #1e293b;
			--border: #334155;
			--text: #f8fafc;
			--text-sub: #94a3b8;
			--accent: #38bdf8;
			--font: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
		}}
		body {{ background: var(--bg); color: var(--text); font-family: var(--font); padding: 2rem; margin: 0; }}
		.container {{ max-width: 1200px; margin: 0 auto; }}
		header {{ margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem; }}
		header h1 {{ margin: 0 0 0.5rem 0; font-size: 2rem; }}
		header a {{ color: var(--accent); text-decoration: none; font-size: 0.9rem; }}
		table {{ width: 100%; border-collapse: collapse; background: var(--card); border-radius: 8px; overflow: hidden; }}
		th, td {{ padding: 1rem; text-align: left; border-bottom: 1px solid var(--border); }}
		th {{ background: #0f172a; color: var(--accent); font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }}
		tr:last-child td {{ border-bottom: none; }}
		code {{ background: #0f172a; color: var(--accent); padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.875rem; }}
		.badge {{ display: inline-block; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; background: rgba(56,189,248,0.1); color: var(--accent); border: 1px solid rgba(56,189,248,0.2); }}
		.desc {{ color: var(--text-sub); font-size: 0.9rem; }}
	</style>
</head>
<body>
	<div class="container">
		<header>
			<h1>Lumina Template Parts Catalog</h1>
			<a href="index.html">&larr; Back to Documentation Portal</a>
		</header>
		<table>
			<thead>
				<tr>
					<th>Title</th>
					<th>Part Name</th>
					<th>Area</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
"""

for p in parts_list:
    html_content += f"""				<tr>
					<td><strong>{p['title']}</strong></td>
					<td><code>{p['name']}</code></td>
					<td><span class="badge">{p['area']}</span></td>
					<td class="desc">{p['description']}</td>
				</tr>
"""

html_content += """			</tbody>
		</table>
	</div>
</body>
</html>
"""

with open(html_file, 'w', encoding='utf-8') as f:
    f.write(html_content)

print(f"🎉 Generated both {md_file} and {html_file}")
EOF
