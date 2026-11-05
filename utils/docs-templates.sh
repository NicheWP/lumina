#!/bin/zsh

# Scope paths
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
THEME_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"
DOCS_DIR="${THEME_ROOT}/docs"
MD_FILE="${DOCS_DIR}/templates.md"
HTML_FILE="${DOCS_DIR}/templates.html"

mkdir -p "$DOCS_DIR"

python3 - << 'EOF' "$THEME_ROOT" "$MD_FILE" "$HTML_FILE"
import os, json, sys

theme_root = sys.argv[1]
md_file = sys.argv[2]
html_file = sys.argv[3]

theme_json_path = os.path.join(theme_root, "theme.json")
templates_dir = os.path.join(theme_root, "templates")

std_templates = {
    "index": ("Index / Main Fallback", "Main fallback template for all site views."),
    "home": ("Blog Home Index", "Blog posts index template."),
    "single": ("Single Post (Default)", "Standard single blog post layout."),
    "page": ("Page (Default)", "Standard page template layout."),
    "archive": ("Archive (Categories & Tags)", "Template for post category, tag, and date archives."),
    "search": ("Search Results", "Template displaying site search results."),
    "404": ("404 Error Page", "Template rendered when content is not found."),
    "author": ("Author Archive", "Template displaying author posts and bio.")
}

custom_templates = {}
if os.path.exists(theme_json_path):
    with open(theme_json_path, 'r', encoding='utf-8') as f:
        try:
            data = json.load(f)
            for item in data.get("customTemplates", []):
                name = item.get("name")
                if name:
                    custom_templates[name] = item
        except Exception:
            pass

templates_list = []
if os.path.exists(templates_dir):
    for f in sorted(os.listdir(templates_dir)):
        if f.endswith(".html"):
            name = f[:-5]
            if name in custom_templates:
                meta = custom_templates[name]
                title = meta.get("title", name.replace("-", " ").title())
                post_types = ", ".join(meta.get("postTypes", ["page", "single"]))
                ttype = f"Custom ({post_types})"
                desc = f"Custom layout template assigned to {post_types}."
            elif name in std_templates:
                title, desc = std_templates[name]
                ttype = "Core Hierarchy"
            else:
                title = name.replace("-", " ").title()
                ttype = "Layout Variation"
                desc = f"Specialized layout variation for {name}."
            
            templates_list.append({
                "name": name,
                "title": title,
                "type": ttype,
                "description": desc
            })

# Write TEMPLATES.md
with open(md_file, 'w', encoding='utf-8') as f:
    f.write("# Lumina Theme Architecture: Page Templates Catalog\n\n")
    f.write("| Title | Template Slug | Type | Description |\n")
    f.write("| :--- | :--- | :--- | :--- |\n")
    for t in templates_list:
        f.write(f"| **{t['title']}** | `{t['name']}` | `{t['type']}` | {t['description']} |\n")

# Write templates.html
html_content = f"""<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lumina Page Templates Catalog</title>
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
			<h1>Lumina Page Templates Catalog</h1>
			<a href="index.html">&larr; Back to Documentation Portal</a>
		</header>
		<table>
			<thead>
				<tr>
					<th>Title</th>
					<th>Template Slug</th>
					<th>Type</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
"""

for t in templates_list:
    html_content += f"""				<tr>
					<td><strong>{t['title']}</strong></td>
					<td><code>{t['name']}</code></td>
					<td><span class="badge">{t['type']}</span></td>
					<td class="desc">{t['description']}</td>
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
