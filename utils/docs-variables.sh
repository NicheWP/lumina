#!/bin/zsh

# Scope paths
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
THEME_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"
DOCS_DIR="${THEME_ROOT}/docs"
MD_FILE="${DOCS_DIR}/variables.md"
HTML_FILE="${DOCS_DIR}/variables.html"

mkdir -p "$DOCS_DIR"

python3 - << 'EOF' "$THEME_ROOT" "$MD_FILE" "$HTML_FILE"
import os, json, re, sys, bisect

theme_root = sys.argv[1]
md_file = sys.argv[2]
html_file = sys.argv[3]

def camel_to_kebab(s):
    # Convert camelCase and snake_case to kebab-case
    s = s.replace('_', '-')
    return re.sub(r'(?<!^)(?=[A-Z])', '-', s).lower()

json_vars = {}
variation_vars = {}
file_refs = {}

def add_ref(var_name, file_path, line_num, fallback="None", ref_type="SCSS"):
    var_name = var_name.rstrip(';').strip()
    # Clean up trailing hyphens from dynamic SCSS interpolation stems
    var_name = re.sub(r'-+$', '', var_name)
    
    if not var_name.startswith('--wp--custom--') or var_name == '--wp--custom':
        return
    if var_name not in file_refs:
        file_refs[var_name] = []
    file_refs[var_name].append({
        "file": file_path,
        "line": line_num,
        "fallback": fallback,
        "type": ref_type
    })

var_custom_regex = re.compile(r'--wp--custom--[a-zA-Z0-9\-_]+')
var_slug_regex = re.compile(r'var:custom\|([a-zA-Z0-9\|_\-]+)')

# 1. Flatten settings.custom across theme.json and style variation files
def scan_json_file(fpath, rel_path):
    try:
        with open(fpath, 'r', encoding='utf-8') as f:
            content = f.read()

        line_breaks = [m.start() for m in re.finditer(r'\n', content)]
        def get_line_num(pos):
            return bisect.bisect_right(line_breaks, pos) + 1

        data = json.loads(content)
        custom_block = data.get("settings", {}).get("custom", {})

        def extract_custom_declarations(node, prefix="--wp--custom"):
            if isinstance(node, dict):
                for k, v in node.items():
                    kebab_k = camel_to_kebab(k)
                    new_prefix = f"{prefix}--{kebab_k}"
                    if isinstance(v, dict):
                        extract_custom_declarations(v, new_prefix)
                    else:
                        val_str = str(v)
                        if rel_path == "theme.json":
                            json_vars[new_prefix] = val_str
                        else:
                            if new_prefix not in variation_vars:
                                variation_vars[new_prefix] = f"{val_str} ({os.path.basename(rel_path)})"
                        add_ref(new_prefix, rel_path, 1, val_str, "JSON")

        extract_custom_declarations(custom_block)

        # Scan string token references: var:custom|... or --wp--custom--...
        for m in var_slug_regex.finditer(content):
            vname = "--wp--custom--" + m.group(1).replace("|", "--")
            add_ref(vname, rel_path, get_line_num(m.start()), "N/A", "JSON")

        for m in var_custom_regex.finditer(content):
            add_ref(m.group(0), rel_path, get_line_num(m.start()), "N/A", "JSON")

    except Exception as e:
        print(f"Warning reading JSON {rel_path}: {e}")

theme_json_path = os.path.join(theme_root, "theme.json")
if os.path.exists(theme_json_path):
    scan_json_file(theme_json_path, "theme.json")

styles_dir = os.path.join(theme_root, "styles")
if os.path.exists(styles_dir):
    for root, _, files in os.walk(styles_dir):
        for file in sorted(files):
            if file.endswith('.json'):
                fpath = os.path.join(root, file)
                rel_path = os.path.relpath(fpath, theme_root)
                scan_json_file(fpath, rel_path)

# 2. Parse SCSS Files
scss_dir = os.path.join(theme_root, "src", "scss")
if os.path.exists(scss_dir):
    for root, _, files in os.walk(scss_dir):
        for file in sorted(files):
            if file.endswith('.scss') and not ('-SAVE-' in file or '_SAVE_' in file):
                rel_path = os.path.relpath(os.path.join(root, file), theme_root)
                fpath = os.path.join(root, file)
                
                with open(fpath, 'r', encoding='utf-8', errors='ignore') as f:
                    content = f.read()

                line_breaks = [m.start() for m in re.finditer(r'\n', content)]
                def get_line_num(pos):
                    return bisect.bisect_right(line_breaks, pos) + 1

                for m in var_custom_regex.finditer(content):
                    var_name = m.group(0)
                    start_pos = m.start()
                    line_num = get_line_num(start_pos)

                    preceding_chunk = content[max(0, start_pos - 25):start_pos]
                    is_inside_var = re.search(r'var\s*\(\s*$', preceding_chunk)

                    fallback = "None"
                    if is_inside_var:
                        scan_idx = start_pos + len(var_name)
                        depth = 1
                        in_fallback = False
                        fallback_chars = []

                        while scan_idx < len(content) and depth > 0:
                            ch = content[scan_idx]
                            if ch == '(':
                                depth += 1
                                if in_fallback:
                                    fallback_chars.append(ch)
                            elif ch == ')':
                                depth -= 1
                                if depth > 0 and in_fallback:
                                    fallback_chars.append(ch)
                            elif ch == ',' and depth == 1 and not in_fallback:
                                in_fallback = True
                            else:
                                if in_fallback:
                                    fallback_chars.append(ch)
                            scan_idx += 1

                        if in_fallback:
                            raw_fb = "".join(fallback_chars).strip()
                            raw_fb = re.sub(r'\s+', ' ', raw_fb)
                            fallback = raw_fb if raw_fb else "None"

                    add_ref(var_name, rel_path, line_num, fallback, "SCSS")

# 3. Sweep PHP, HTML, and JS Files
ignored_dirs = {'.git', 'node_modules', 'vendor', 'docs', 'zz_unused', 'build', 'dist'}

# Key mappings for PHP image helper lookups -> canonical CSS variable names
php_canonical_keys = {
    'logo': 'logo-default',
    'logo_default': 'logo-default',
    'logodefault': 'logo-default',
    'imagefolder': 'image-folders',
    'imagefolders': 'image-folders',
    'imagedefault': 'image-default',
}

wp_settings_regex = re.compile(r'wp_get_global_settings\s*\(\s*(?:array\(|\[)\s*[\'"]custom[\'"]\s*((?:,\s*[\'"][^\'"]+[\'"])+)')
array_custom_regex = re.compile(r'[\'"]custom[\'"]\s*\[\s*[\'"]([^\'"]+)[\'"]\s*\]\s*\[\s*[\'"]([^\'"]+)[\'"]\s*\]\s*\[\s*[\'"]([^\'"]+)[\'"]\s*\]')
php_subaccess_regex = re.compile(r'\$theme_custom\s*\[\s*[\'"]([^\'"]+)[\'"]\s*\]')

for root, dirs, files in os.walk(theme_root):
    dirs[:] = [d for d in dirs if d not in ignored_dirs and not d.startswith('.')]

    for file in sorted(files):
        if '-SAVE-' in file or '_SAVE_' in file or '-not-used' in file:
            continue

        ext = os.path.splitext(file)[1].lower()
        if ext not in ('.php', '.html', '.js'):
            continue

        fpath = os.path.join(root, file)
        rel_path = os.path.relpath(fpath, theme_root)
        if rel_path.startswith("src/scss"):
            continue

        ref_type = "PHP" if ext == '.php' else ("HTML" if ext == '.html' else "JS")

        with open(fpath, 'r', encoding='utf-8', errors='ignore') as f:
            for line_num, line in enumerate(f, 1):
                # A. Gutenberg block comment references: var:custom|color|border
                for match in var_slug_regex.findall(line):
                    vname = "--wp--custom--" + match.replace("|", "--")
                    add_ref(vname, rel_path, line_num, "N/A", ref_type)

                # B. Direct CSS variable references: --wp--custom--*
                for match in var_custom_regex.findall(line):
                    add_ref(match, rel_path, line_num, "N/A", ref_type)

                # C. PHP Global Settings API calls (explicit 3+ level paths)
                if ext == '.php':
                    for match in wp_settings_regex.finditer(line):
                        keys = re.findall(r'[\'"]([^\'"]+)[\'"]', match.group(1))
                        if len(keys) >= 2:
                            vname = "--wp--custom--" + "--".join([camel_to_kebab(k) for k in keys])
                            add_ref(vname, rel_path, line_num, "N/A", "PHP")

                    for match in array_custom_regex.finditer(line):
                        keys = [k for k in match.groups() if k]
                        if len(keys) >= 2:
                            vname = "--wp--custom--" + "--".join([camel_to_kebab(k) for k in keys])
                            add_ref(vname, rel_path, line_num, "N/A", "PHP")

                    # Map PHP $theme_custom['key'] access to canonical CSS variable
                    for match in php_subaccess_regex.finditer(line):
                        key = match.group(1)
                        canonical = php_canonical_keys.get(key.lower(), camel_to_kebab(key))
                        vname = f"--wp--custom--color--theme--{canonical}"
                        add_ref(vname, rel_path, line_num, "N/A", "PHP")

# 4. Helper for Recursive Fallback Resolution
def resolve_ultimate_fallback(var_name, visited=None):
    if visited is None:
        visited = set()
    if var_name in visited:
        return "None"
    visited.add(var_name)

    occs = [o for o in file_refs.get(var_name, []) if o['type'] == 'SCSS']
    if not occs:
        return "None"

    for o in occs:
        fb = o['fallback']
        if fb == "None":
            continue

        nested_match = var_custom_regex.search(fb)
        if nested_match:
            nested_var = nested_match.group(0)
            resolved = resolve_ultimate_fallback(nested_var, visited.copy())
            if resolved != "None":
                return resolved
            else:
                lit_match = re.search(r',\s*([^()]+)\s*\)+$', fb)
                if lit_match:
                    return lit_match.group(1).strip()
        else:
            return fb
    return "None"

# 5. Consolidate and write documentation outputs
all_var_names = sorted(list(set(list(json_vars.keys()) + list(variation_vars.keys()) + list(file_refs.keys()))))

var_records = []
for var_name in all_var_names:
    if var_name in json_vars:
        json_val = json_vars[var_name]
    elif var_name in variation_vars:
        json_val = f"*(Style Variation)* {variation_vars[var_name]}"
    else:
        json_val = "*Not in theme.json*"

    occurrences = file_refs.get(var_name, [])
    scss_occs = [o for o in occurrences if o['type'] == 'SCSS']
    fallback_val = resolve_ultimate_fallback(var_name) if scss_occs else "N/A"

    ref_items = []
    seen = set()
    for o in occurrences:
        key = (o['file'], o['type'])
        if key not in seen:
            seen.add(key)
            ref_items.append(o)

    var_records.append({
        "name": var_name,
        "json_val": json_val,
        "fallback": fallback_val,
        "refs": ref_items
    })

# Write variables.md
with open(md_file, 'w', encoding='utf-8') as f:
    f.write("# Lumina Theme Architecture: Custom CSS Variables\n\n")
    f.write("| CSS Variable | `theme.json` Value | SCSS Fallback | File References |\n")
    f.write("| :--- | :--- | :--- | :--- |\n")
    for r in var_records:
        fb_disp = f"`{r['fallback']}`" if r['fallback'] not in ("None", "N/A") else r['fallback']
        if r['refs']:
            ref_str = "<br>".join([f"`[{o['type']}] {o['file']}`" for o in r['refs']])
        else:
            ref_str = "*Not directly referenced*"
        f.write(f"| `{r['name']}` | `{r['json_val']}` | {fb_disp} | {ref_str} |\n")

# Write variables.html
html_content = f"""<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lumina Custom CSS Variables Specification</title>
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
		th, td {{ padding: 1rem; text-align: left; border-bottom: 1px solid var(--border); vertical-align: top; word-wrap: break-word; }}
		th {{ background: #0f172a; color: var(--accent); font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }}
		th:nth-child(1) {{ width: 32%; }}
		th:nth-child(2) {{ width: 18%; }}
		th:nth-child(3) {{ width: 20%; }}
		th:nth-child(4) {{ width: 30%; }}
		tr:last-child td {{ border-bottom: none; }}
		code {{ background: #0f172a; color: var(--accent); padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.85rem; display: inline-block; word-break: break-all; }}
		.file-list {{ color: var(--text-sub); font-size: 0.85rem; line-height: 1.6; }}
		.file-list code {{ margin-bottom: 0.25rem; display: inline-block; color: #cbd5e1; }}
		.badge-type {{ display: inline-block; font-size: 0.7rem; font-weight: 700; padding: 0.1rem 0.35rem; border-radius: 3px; margin-right: 0.3rem; text-transform: uppercase; }}
		.badge-scss {{ background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.3); }}
		.badge-json {{ background: rgba(34, 197, 94, 0.15); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); }}
		.badge-php {{ background: rgba(168, 85, 247, 0.15); color: #c084fc; border: 1px solid rgba(168, 85, 247, 0.3); }}
		.badge-html {{ background: rgba(244, 63, 94, 0.15); color: #fb7185; border: 1px solid rgba(244, 63, 94, 0.3); }}
		.badge-js {{ background: rgba(251, 191, 36, 0.15); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3); }}
		.none-val {{ color: #64748b; font-style: italic; font-size: 0.85rem; }}
	</style>
</head>
<body>
	<div class="container">
		<header>
			<h1>Lumina Custom CSS Variables</h1>
			<a href="index.html">&larr; Back to Documentation Portal</a>
		</header>
		<table>
			<thead>
				<tr>
					<th>CSS Variable Name</th>
					<th><code>theme.json</code> Value</th>
					<th>SCSS Fallback Value</th>
					<th>File References</th>
				</tr>
			</thead>
			<tbody>
"""

for r in var_records:
    fb_html = f"<span class=\"none-val\">{r['fallback']}</span>" if r['fallback'] in ("None", "N/A") else f"<code>{r['fallback']}</code>"

    if r['refs']:
        ref_lines = []
        for o in r['refs']:
            tclass = f"badge-{o['type'].lower()}"
            ref_lines.append(f"<div><span class=\"badge-type {tclass}\">{o['type']}</span><code>{o['file']}</code></div>")
        files_html = "".join(ref_lines)
    else:
        files_html = "<span class=\"file-list\"><em>Not directly referenced</em></span>"

    html_content += f"""				<tr>
					<td><code>{r['name']}</code></td>
					<td><code>{r['json_val']}</code></td>
					<td>{fb_html}</td>
					<td class="file-list">{files_html}</td>
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
