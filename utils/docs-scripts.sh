#!/bin/zsh

# Scope paths to theme root
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
THEME_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"
DOCS_DIR="${THEME_ROOT}/docs"
MD_FILE="${DOCS_DIR}/scripts.md"
HTML_FILE="${DOCS_DIR}/scripts.html"

mkdir -p "$DOCS_DIR"

python3 - << 'EOF' "$THEME_ROOT" "$MD_FILE" "$HTML_FILE"
import os, sys, re

theme_root = sys.argv[1]
md_file = sys.argv[2]
html_file = sys.argv[3]

utils_dir = os.path.join(theme_root, "utils")

# Comprehensive structured metadata for core Lumina CLI utilities
script_knowledge_base = {
    "crop-images.py": {
        "title": "Image Cropper, Rescaler & EXIF Embedder",
        "description": "Recursively scans raw images, crops to a configured aspect ratio and positional anchor (center, top, or bottom), resizes using Lanczos resampling, embeds EXIF metadata (Title, Credit, License), and exports WebP files with macOS extended attribute preservation.",
        "params": [
            "<code>CROP=center|top|bottom|none</code> — Positional crop anchor strategy (default: center)",
            "<code>TARGET_W=1600 TARGET_H=900</code> — Output aspect ratio & pixel dimensions",
            "<code>QUALITY=85</code> — WebP compression quality percentage",
            "<code>SOURCE_DIR=path</code> — Input directory containing raw stock photos",
            "<code>OUTPUT_DIR=path</code> — Target destination directory for processed images"
        ],
        "usage": """# 1. Default Widescreen Run (1600x900 Center Crop):
python3 utils/crop-images.py

# 2. Portrait Headshots (1200x1600 Top-Anchored Crop):
CROP=top TARGET_W=1200 TARGET_H=1600 SOURCE_DIR="./zz_unused/raw-headshots" python3 utils/crop-images.py

# 3. Pass-through Mode (No cropping, EXIF embedding & WebP conversion only):
CROP=none SOURCE_DIR="./zz_unused/raw-photos" python3 utils/crop-images.py"""
    },

    "dir-tree.sh": {
        "title": "Directory Tree Visualizer",
        "description": "Generates a clean ASCII visual directory tree structure for specified theme folders, ignoring hidden system files and dotfiles.",
        "params": [
            "<code>[target_dir]</code> — Optional relative directory path to inspect (defaults to theme root <code>.</code>)"
        ],
        "usage": """# Inspect assets directory
./utils/dir-tree.sh assets/images

# Inspect block patterns directory
./utils/dir-tree.sh patterns"""
    },

    "docs-parts.sh": {
        "title": "Template Parts Documentation Generator",
        "description": "Parses <code>theme.json</code> templateParts metadata and scans the <code>/parts</code> directory to generate both <code>docs/parts.html</code> and <code>docs/parts.md</code>.",
        "params": [
            "No arguments required. Executed directly or via NPM scripts."
        ],
        "usage": """./utils/docs-parts.sh

# Or via NPM:
npm run docs:parts"""
    },

    "docs-patterns.sh": {
        "title": "Block Patterns Catalog Generator",
        "description": "Parses DocBlock metadata headers (Title, Slug, Categories, Description) across all PHP pattern files in <code>/patterns</code> to generate <code>docs/patterns.html</code> and <code>docs/patterns.md</code>.",
        "params": [
            "No arguments required. Executed directly or via NPM scripts."
        ],
        "usage": """./utils/docs-patterns.sh

# Or via NPM:
npm run docs:patterns"""
    },

    "docs-scripts.sh": {
        "title": "Build & Maintenance Scripts Catalog Generator",
        "description": "Parses header documentation, parameters, and usage blocks across all CLI utility scripts in <code>/utils</code> to compile <code>docs/scripts.html</code> and <code>docs/scripts.md</code>.",
        "params": [
            "No arguments required. Executed directly or via NPM scripts."
        ],
        "usage": """./utils/docs-scripts.sh

# Or via NPM:
npm run docs:scripts"""
    },

    "docs-templates.sh": {
        "title": "Page Templates Catalog Generator",
        "description": "Scans the <code>/templates</code> directory and cross-references <code>theme.json</code> customTemplates metadata to generate <code>docs/templates.html</code> and <code>docs/templates.md</code>.",
        "params": [
            "No arguments required. Executed directly or via NPM scripts."
        ],
        "usage": """./utils/docs-templates.sh

# Or via NPM:
npm run docs:templates"""
    },

    "docs-variables.sh": {
        "title": "Custom CSS Variables Specification Generator",
        "description": "Sweeps <code>theme.json</code>, style variation JSON files, SCSS partials, PHP functions, and JS scripts to generate <code>docs/variables.html</code> and <code>docs/variables.md</code> with multi-tier fallback resolution and file reference badges.",
        "params": [
            "No arguments required. Executed directly or via NPM scripts."
        ],
        "usage": """./utils/docs-variables.sh

# Or via NPM:
npm run docs:variables"""
    },

    "generate-test-pattern-page.sh": {
        "title": "Master Test Pattern Generator",
        "description": "Combines active PHP block pattern calls into a single master test layout (<code>patterns/99-page-all-patterns-TEST.php</code>) for rapid visual auditing in the Site Editor.",
        "params": [
            "<code>[subfolder]</code> — Optional pattern subfolder name to restrict test page generation (e.g., <code>01-heroes</code>)"
        ],
        "usage": """# 1. Sweep all active pattern directories:
./utils/generate-test-pattern-page.sh

# 2. Sweep a specific category subfolder:
./utils/generate-test-pattern-page.sh 01-heroes"""
    },

    "patterns2php.sh": {
        "title": "Lumina Theme Pattern Converter",
        "description": "Converts raw HTML block layouts from <code>/patterns/html</code> (or <code>/parts</code>) into production-ready WordPress PHP pattern files in <code>/patterns/converted</code> with <code>esc_html_e()</code> i18n translation functions, asset URI helpers, and clean Block Types comment manifests.",
        "params": [
            "<code>-f</code> or <code>--force</code> — Force overwrite existing PHP pattern files",
            "<code>[filter_keyword]</code> — Filter conversion to files matching a specific string (e.g., <code>hero</code>)",
            "<code>[custom_folder]</code> — Target custom relative source directory (e.g., <code>parts</code>)"
        ],
        "usage": """# 1. Default Run (Skip existing PHP patterns):
./utils/patterns2php.sh

# 2. Force Overwrite (-f / --force):
./utils/patterns2php.sh --force

# 3. Filter by Filename Keyword:
./utils/patterns2php.sh hero

# 4. Target Custom Directory (e.g., Template Parts) with Force Overwrite:
./utils/patterns2php.sh parts header -f"""
    }
}

script_records = []

if os.path.exists(utils_dir):
    for filename in sorted(os.listdir(utils_dir)):
        fpath = os.path.join(utils_dir, filename)
        if not os.path.isfile(fpath) or filename.startswith('.'):
            continue

        ext = os.path.splitext(filename)[1].lower()
        if ext not in ('.sh', '.py', '.js', '.zsh'):
            continue

        rel_path = f"utils/{filename}"
        stype = "Shell" if ext in ('.sh', '.zsh') else ("Python" if ext == '.py' else "JavaScript")

        # Fallback dynamic parsing if script isn't in static knowledge base
        if filename in script_knowledge_base:
            kb = script_knowledge_base[filename]
            title = kb["title"]
            description = kb["description"]
            params = kb["params"]
            usage = kb["usage"]
        else:
            title = filename.replace('-', ' ').replace('.sh', '').replace('.py', '').title()
            description = f"Build and maintenance utility script for {filename}."
            params = []
            usage = f"./utils/{filename}"

        script_records.append({
            "name": filename,
            "title": title,
            "path": rel_path,
            "type": stype,
            "description": description,
            "params": params,
            "usage": usage
        })

# Write scripts.md
with open(md_file, 'w', encoding='utf-8') as f:
    f.write("# Lumina Theme Architecture: Utilities & Build Scripts Catalog\n\n")
    f.write("| Script Name | Language | Description & Usage | File Location |\n")
    f.write("| :--- | :--- | :--- | :--- |\n")
    for s in script_records:
        param_str = "<br>".join([f"• {p}" for p in s['params']]) if s['params'] else ""
        desc_md = f"**{s['title']}**<br>{s['description']}"
        if param_str:
            desc_md += f"<br><br>**Options & Parameters:**<br>{param_str}"
        desc_md += f"<br><br>**Usage:**<br>```bash\n{s['usage']}\n```"
        f.write(f"| **`{s['name']}`** | `{s['type']}` | {desc_md} | `{s['path']}` |\n")

# Write scripts.html
html_content = f"""<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lumina Theme Utilities & Build Scripts Catalog</title>
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
		.container {{ max-width: 1400px; margin: 0 auto; }}
		header {{ margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem; }}
		header h1 {{ margin: 0 0 0.5rem 0; font-size: 2rem; }}
		header a {{ color: var(--accent); text-decoration: none; font-size: 0.9rem; }}
		table {{ width: 100%; border-collapse: collapse; background: var(--card); border-radius: 8px; overflow: hidden; table-layout: fixed; }}
		th, td {{ padding: 1.25rem; text-align: left; border-bottom: 1px solid var(--border); vertical-align: top; word-wrap: break-word; }}
		th {{ background: #0f172a; color: var(--accent); font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em; }}
		th:nth-child(1) {{ width: 20%; }}
		th:nth-child(2) {{ width: 10%; }}
		th:nth-child(3) {{ width: 52%; }}
		th:nth-child(4) {{ width: 18%; }}
		tr:last-child td {{ border-bottom: none; }}
		code {{ background: #0f172a; color: var(--accent); padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.85rem; display: inline-block; word-break: break-all; }}
		pre {{ background: #0f172a; color: #cbd5e1; padding: 0.85rem; border-radius: 6px; font-size: 0.825rem; line-height: 1.45; overflow-x: auto; border: 1px solid var(--border); white-space: pre-wrap; margin: 0.75rem 0 0 0; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; }}
		.badge {{ display: inline-block; padding: 0.25rem 0.55rem; border-radius: 4px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }}
		.badge-shell {{ background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.3); }}
		.badge-python {{ background: rgba(251, 191, 36, 0.15); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3); }}
		.badge-javascript {{ background: rgba(244, 63, 94, 0.15); color: #fb7185; border: 1px solid rgba(244, 63, 94, 0.3); }}
		.script-title {{ font-size: 1.05rem; font-weight: 600; color: #f8fafc; margin-bottom: 0.35rem; }}
		.desc-text {{ color: var(--text-sub); font-size: 0.9rem; line-height: 1.55; }}
		.params-header {{ font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: #94a3b8; margin-top: 0.85rem; margin-bottom: 0.35rem; letter-spacing: 0.03em; }}
		.params-list {{ list-style: none; padding-left: 0; margin: 0; color: #cbd5e1; font-size: 0.85rem; line-height: 1.6; }}
		.params-list li {{ margin-bottom: 0.2rem; position: relative; padding-left: 1rem; }}
		.params-list li::before {{ content: "•"; position: absolute; left: 0; color: var(--accent); }}
	</style>
</head>
<body>
	<div class="container">
		<header>
			<h1>Lumina Theme Utilities & Build Scripts Catalog</h1>
			<a href="index.html">&larr; Back to Documentation Portal</a>
		</header>
		<table>
			<thead>
				<tr>
					<th>Script Name</th>
					<th>Language</th>
					<th>Description, Parameters &amp; Usage</th>
					<th>File Location</th>
				</tr>
			</thead>
			<tbody>
"""

for s in script_records:
    tclass = f"badge-{s['type'].lower()}"
    
    params_html = ""
    if s['params']:
        items = "".join([f"<li>{p}</li>" for p in s['params']])
        params_html = f'<div class="params-header">Options &amp; Parameters:</div><ul class="params-list">{items}</ul>'

    usage_html = f'<div class="params-header">Usage Examples:</div><pre>{s["usage"]}</pre>'

    html_content += f"""				<tr>
					<td><strong><code>{s['name']}</code></strong></td>
					<td><span class="badge {tclass}">{s['type']}</span></td>
					<td>
						<div class="script-title">{s['title']}</div>
						<div class="desc-text">{s['description']}</div>
						{params_html}
						{usage_html}
					</td>
					<td><code>{s['path']}</code></td>
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

print(f"🎉 Successfully generated {md_file} and {html_file}")
EOF
