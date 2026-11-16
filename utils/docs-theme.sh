#!/bin/zsh
# Title: Theme Design Tokens Reference Generator
# Description: Generates HTML and Markdown references for selected JSON sections in theme.json and color style variations.
# Usage: ./utils/docs-theme.sh

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
THEME_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"
DOCS_DIR="${THEME_ROOT}/docs"
MD_FILE="${DOCS_DIR}/theme.md"
HTML_FILE="${DOCS_DIR}/theme.html"

mkdir -p "$DOCS_DIR"

python3 - "$THEME_ROOT" "$MD_FILE" "$HTML_FILE" <<'PY'
import html
import json
import sys
from pathlib import Path

theme_root = Path(sys.argv[1])
md_file = Path(sys.argv[2])
html_file = Path(sys.argv[3])

# Add dotted JSON paths here to include more theme settings in the reference.
JSON_SECTIONS = [
    "settings.color.palette",
]

SECTION_LABELS = {
    "settings.color.palette": "Color palette",
}
ARCHIVE_MARKERS = ("-SAVE-", "_SAVE_", "-not-used")


def resolve_path(data, dotted_path):
    value = data
    for key in dotted_path.split("."):
        if not isinstance(value, dict) or key not in value:
            return None
        value = value[key]
    return value


def display_value(value):
    if isinstance(value, (dict, list)):
        return json.dumps(value, ensure_ascii=False, sort_keys=True)
    return str(value) if value is not None else ""


def flatten_object(value, prefix=""):
    rows = []
    if isinstance(value, dict):
        for key, child in value.items():
            child_prefix = f"{prefix}.{key}" if prefix else str(key)
            rows.extend(flatten_object(child, child_prefix))
    elif isinstance(value, list):
        for index, child in enumerate(value):
            child_prefix = f"{prefix}[{index}]"
            rows.extend(flatten_object(child, child_prefix))
    else:
        rows.append((prefix, value))
    return rows


def make_table(value, section_path):
    if isinstance(value, list) and all(isinstance(item, dict) for item in value):
        columns = []
        for item in value:
            for key in item:
                if key not in columns:
                    columns.append(key)
        if section_path == "settings.color.palette":
            preferred = ["name", "slug", "color"]
            columns = [key for key in preferred if key in columns] + [
                key for key in columns if key not in preferred
            ]
        return columns, [[item.get(key) for key in columns] for item in value]

    if isinstance(value, list):
        return ["Value"], [[item] for item in value]

    if isinstance(value, dict):
        return ["Setting", "Value"], flatten_object(value)

    return ["Value"], [[value]]


def markdown_cell(value):
    return display_value(value).replace("|", r"\|").replace("\n", " ")


def markdown_table(columns, rows):
    lines = [
        "| " + " | ".join(columns) + " |",
        "| " + " | ".join("---" for _ in columns) + " |",
    ]
    for row in rows:
        lines.append("| " + " | ".join(markdown_cell(value) for value in row) + " |")
    return "\n".join(lines)


def html_table(columns, rows):
    headers = "".join(f"<th>{html.escape(str(key).replace('_', ' ').title())}</th>" for key in columns)
    body = []
    for row in rows:
        cells = []
        for key, value in zip(columns, row):
            text = display_value(value)
            escaped = html.escape(text)
            if key == "color" and text:
                color_style = html.escape(text, quote=True)
                cell = (
                    f'<span class="swatch" style="background-color: {color_style}"></span>'
                    f"<code>{escaped}</code>"
                )
            elif key == "slug" and text:
                cell = f"<code>{escaped}</code>"
            else:
                cell = escaped or "&mdash;"
            cells.append(f"<td>{cell}</td>")
        body.append("<tr>" + "".join(cells) + "</tr>")
    return (
        "<div class=\"table-wrap\"><table><thead><tr>"
        + headers
        + "</tr></thead><tbody>"
        + "".join(body)
        + "</tbody></table></div>"
    )


source_files = [theme_root / "theme.json"]
styles_dir = theme_root / "styles" / "colors"
if styles_dir.is_dir():
    source_files.extend(
        path for path in sorted(styles_dir.rglob("*.json"))
        if not any(marker in path.name for marker in ARCHIVE_MARKERS)
    )

documents = []
for source in source_files:
    if not source.is_file():
        continue
    try:
        data = json.loads(source.read_text(encoding="utf-8"))
    except json.JSONDecodeError as error:
        raise SystemExit(f"Error parsing {source}: {error}") from error

    title = data.get("title") or source.stem
    source_name = source.relative_to(theme_root).as_posix()
    mode = resolve_path(data, "settings.custom.color.theme.mode")
    for section_path in JSON_SECTIONS:
        value = resolve_path(data, section_path)
        if value is not None:
            label = SECTION_LABELS.get(
                section_path, section_path.rsplit(".", 1)[-1].replace("-", " ").title()
            )
            columns, rows = make_table(value, section_path)
            documents.append({
                "title": title,
                "source": source_name,
                "mode": mode,
                "path": section_path,
                "label": label,
                "columns": columns,
                "rows": rows,
            })

if not documents:
    raise SystemExit("No configured JSON sections were found in theme.json or styles/colors/*.json")

md_lines = [
    "# Lumina Theme Design Tokens",
    "",
    "Generated from `theme.json` and the color style variations.",
    "",
]
html_sections = []
for document in documents:
    md_lines.extend([
        f"## {document['title']}",
        "",
        f"Source: `{document['source']}`",
        "",
        f"### {document['label']}",
        "",
        markdown_table(document["columns"], document["rows"]),
        "",
    ])

    mode_badge = (
        f'<span class="badge">{html.escape(str(document["mode"]))}</span>'
        if document["mode"] else ""
    )
    section_html = html_table(document["columns"], document["rows"])
    html_sections.append(f"""
        <section class="scheme">
            <div class="scheme-heading">
                <div>
                    <h2>{html.escape(str(document["title"]))}</h2>
                    <p class="source">Source: <code>{html.escape(document["source"])}</code></p>
                </div>
                {mode_badge}
            </div>
            <h3>{html.escape(document["label"])}</h3>
            {section_html}
        </section>""")

html_document = f"""<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumina Theme Design Tokens</title>
    <style>
        :root {{
            color-scheme: dark;
            --bg: #0f172a;
            --card: #1e293b;
            --border: #334155;
            --text: #f8fafc;
            --text-sub: #94a3b8;
            --accent: #38bdf8;
            --font: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }}
        * {{ box-sizing: border-box; }}
        body {{ margin: 0; padding: 2rem; background: var(--bg); color: var(--text); font-family: var(--font); line-height: 1.5; }}
        main {{ max-width: 1200px; margin: 0 auto; }}
        header {{ margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem; }}
        header a {{ color: var(--accent); text-decoration: none; }}
        h1 {{ margin-bottom: 0.4rem; }}
        .intro, .source {{ color: var(--text-sub); }}
        .scheme {{ margin: 1.5rem 0; padding: 1.5rem; border: 1px solid var(--border); border-radius: 0.75rem; background: var(--card); }}
        .scheme-heading {{ display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; }}
        .scheme-heading h2 {{ margin: 0; }}
        .scheme-heading p {{ margin: 0.35rem 0 0; }}
        .badge {{ border: 1px solid var(--border); border-radius: 999px; padding: 0.2rem 0.65rem; color: var(--accent); font-size: 0.8rem; white-space: nowrap; }}
        h3 {{ margin: 1.25rem 0 0.75rem; }}
        .table-wrap {{ overflow-x: auto; }}
        table {{ width: 100%; border-collapse: collapse; }}
        th, td {{ padding: 0.7rem 0.85rem; text-align: left; vertical-align: middle; border-bottom: 1px solid var(--border); }}
        th {{ color: var(--accent); background: rgba(15, 23, 42, 0.7); }}
        tr:last-child td {{ border-bottom: 0; }}
        code {{ overflow-wrap: anywhere; color: #bae6fd; }}
        .swatch {{ display: inline-block; width: 2rem; height: 1.5rem; margin-right: 0.65rem; vertical-align: middle; border: 1px solid rgba(255,255,255,0.3); border-radius: 0.25rem; }}
        @media (max-width: 600px) {{ body {{ padding: 1rem; }} .scheme {{ padding: 1rem; }} }}
    </style>
</head>
<body>
    <main>
        <header>
            <h1>Lumina Theme Design Tokens</h1>
            <p class="intro">Generated reference for selected JSON sections in the base theme and color style variations.</p>
            <a href="index.html">&larr; Back to Documentation Portal</a>
        </header>
        {''.join(html_sections)}
    </main>
</body>
</html>
"""

md_file.write_text("\n".join(md_lines), encoding="utf-8")
html_file.write_text(html_document, encoding="utf-8")
print(f"Generated {md_file.relative_to(theme_root)} and {html_file.relative_to(theme_root)}")
PY
