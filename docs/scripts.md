# Lumina Theme Architecture: Utilities & Build Scripts Catalog

| Script Name | Language | Description & Usage | File Location |
| :--- | :--- | :--- | :--- |
| **`crop-images.py`** | `Python` | **Image Cropper, Rescaler & EXIF Embedder**<br>Recursively scans raw images, crops to a configured aspect ratio and positional anchor (center, top, or bottom), resizes using Lanczos resampling, embeds EXIF metadata (Title, Credit, License), and exports WebP files with macOS extended attribute preservation.<br><br>**Options & Parameters:**<br>• <code>CROP=center|top|bottom|none</code> — Positional crop anchor strategy (default: center)<br>• <code>TARGET_W=1600 TARGET_H=900</code> — Output aspect ratio & pixel dimensions<br>• <code>QUALITY=85</code> — WebP compression quality percentage<br>• <code>SOURCE_DIR=path</code> — Input directory containing raw stock photos<br>• <code>OUTPUT_DIR=path</code> — Target destination directory for processed images<br><br>**Usage:**<br>```bash
# 1. Default Widescreen Run (1600x900 Center Crop):
python3 utils/crop-images.py

# 2. Portrait Headshots (1200x1600 Top-Anchored Crop):
CROP=top TARGET_W=1200 TARGET_H=1600 SOURCE_DIR="./zz_unused/raw-headshots" python3 utils/crop-images.py

# 3. Pass-through Mode (No cropping, EXIF embedding & WebP conversion only):
CROP=none SOURCE_DIR="./zz_unused/raw-photos" python3 utils/crop-images.py
``` | `utils/crop-images.py` |
| **`dir-tree.sh`** | `Shell` | **Directory Tree Visualizer**<br>Generates a clean ASCII visual directory tree structure for specified theme folders, ignoring hidden system files and dotfiles.<br><br>**Options & Parameters:**<br>• <code>[target_dir]</code> — Optional relative directory path to inspect (defaults to theme root <code>.</code>)<br><br>**Usage:**<br>```bash
# Inspect assets directory
./utils/dir-tree.sh assets/images

# Inspect block patterns directory
./utils/dir-tree.sh patterns
``` | `utils/dir-tree.sh` |
| **`docs-parts.sh`** | `Shell` | **Template Parts Documentation Generator**<br>Parses <code>theme.json</code> templateParts metadata and scans the <code>/parts</code> directory to generate both <code>docs/parts.html</code> and <code>docs/parts.md</code>.<br><br>**Options & Parameters:**<br>• No arguments required. Executed directly or via NPM scripts.<br><br>**Usage:**<br>```bash
./utils/docs-parts.sh

# Or via NPM:
npm run docs:parts
``` | `utils/docs-parts.sh` |
| **`docs-patterns.sh`** | `Shell` | **Block Patterns Catalog Generator**<br>Parses DocBlock metadata headers (Title, Slug, Categories, Description) across all PHP pattern files in <code>/patterns</code> to generate <code>docs/patterns.html</code> and <code>docs/patterns.md</code>.<br><br>**Options & Parameters:**<br>• No arguments required. Executed directly or via NPM scripts.<br><br>**Usage:**<br>```bash
./utils/docs-patterns.sh

# Or via NPM:
npm run docs:patterns
``` | `utils/docs-patterns.sh` |
| **`docs-scripts.sh`** | `Shell` | **Build & Maintenance Scripts Catalog Generator**<br>Parses header documentation, parameters, and usage blocks across all CLI utility scripts in <code>/utils</code> to compile <code>docs/scripts.html</code> and <code>docs/scripts.md</code>.<br><br>**Options & Parameters:**<br>• No arguments required. Executed directly or via NPM scripts.<br><br>**Usage:**<br>```bash
./utils/docs-scripts.sh

# Or via NPM:
npm run docs:scripts
``` | `utils/docs-scripts.sh` |
| **`docs-templates.sh`** | `Shell` | **Page Templates Catalog Generator**<br>Scans the <code>/templates</code> directory and cross-references <code>theme.json</code> customTemplates metadata to generate <code>docs/templates.html</code> and <code>docs/templates.md</code>.<br><br>**Options & Parameters:**<br>• No arguments required. Executed directly or via NPM scripts.<br><br>**Usage:**<br>```bash
./utils/docs-templates.sh

# Or via NPM:
npm run docs:templates
``` | `utils/docs-templates.sh` |
| **`docs-variables.sh`** | `Shell` | **Custom CSS Variables Specification Generator**<br>Sweeps <code>theme.json</code>, style variation JSON files, SCSS partials, PHP functions, and JS scripts to generate <code>docs/variables.html</code> and <code>docs/variables.md</code> with multi-tier fallback resolution and file reference badges.<br><br>**Options & Parameters:**<br>• No arguments required. Executed directly or via NPM scripts.<br><br>**Usage:**<br>```bash
./utils/docs-variables.sh

# Or via NPM:
npm run docs:variables
``` | `utils/docs-variables.sh` |
| **`generate-test-pattern-page.sh`** | `Shell` | **Master Test Pattern Generator**<br>Combines active PHP block pattern calls into a single master test layout (<code>patterns/99-page-all-patterns-TEST.php</code>) for rapid visual auditing in the Site Editor.<br><br>**Options & Parameters:**<br>• <code>[subfolder]</code> — Optional pattern subfolder name to restrict test page generation (e.g., <code>01-heroes</code>)<br><br>**Usage:**<br>```bash
# 1. Sweep all active pattern directories:
./utils/generate-test-pattern-page.sh

# 2. Sweep a specific category subfolder:
./utils/generate-test-pattern-page.sh 01-heroes
``` | `utils/generate-test-pattern-page.sh` |
| **`patterns2php.sh`** | `Shell` | **Lumina Theme Pattern Converter**<br>Converts raw HTML block layouts from <code>/patterns/html</code> (or <code>/parts</code>) into production-ready WordPress PHP pattern files in <code>/patterns/converted</code> with <code>esc_html_e()</code> i18n translation functions, asset URI helpers, and clean Block Types comment manifests.<br><br>**Options & Parameters:**<br>• <code>-f</code> or <code>--force</code> — Force overwrite existing PHP pattern files<br>• <code>[filter_keyword]</code> — Filter conversion to files matching a specific string (e.g., <code>hero</code>)<br>• <code>[custom_folder]</code> — Target custom relative source directory (e.g., <code>parts</code>)<br><br>**Usage:**<br>```bash
# 1. Default Run (Skip existing PHP patterns):
./utils/patterns2php.sh

# 2. Force Overwrite (-f / --force):
./utils/patterns2php.sh --force

# 3. Filter by Filename Keyword:
./utils/patterns2php.sh hero

# 4. Target Custom Directory (e.g., Template Parts) with Force Overwrite:
./utils/patterns2php.sh parts header -f
``` | `utils/patterns2php.sh` |
