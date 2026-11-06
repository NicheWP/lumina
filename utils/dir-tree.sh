#!/usr/bin/env python3
import os
import sys
import fnmatch

target_dir = sys.argv[1] if len(sys.argv) > 1 else '.'
target_dir = target_dir.rstrip('/')

# Default exclusions for standard WP block theme development
DEFAULT_IGNORES = {
    'node_modules',
    'zz_unused',
    'docs',
    '.git',
    '.github',
    '.cache',
    '.phpdoc',
    'vendor',
    'build',
    '.DS_Store',
    'Thumbs.db',
    '*.zip',
    '*.log',
    '*.tar.gz'
}

def load_gitignore(root_dir):
    ignores = set(DEFAULT_IGNORES)
    gitignore_path = os.path.join(root_dir, '.gitignore')
    if os.path.exists(gitignore_path):
        with open(gitignore_path, 'r', encoding='utf-8', errors='ignore') as f:
            for line in f:
                line = line.strip()
                if not line or line.startswith('#'):
                    continue
                # Clean leading/trailing slashes and glob indicators
                clean_pattern = line.rstrip('/').lstrip('/')
                if clean_pattern:
                    ignores.add(clean_pattern)
    return ignores

# Load gitignore from theme root or current directory
THEME_ROOT = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))
IGNORE_PATTERNS = load_gitignore(THEME_ROOT)

def is_ignored(name, rel_path):
    if name.startswith('.'):
        return True
    for pattern in IGNORE_PATTERNS:
        if fnmatch.fnmatch(name, pattern) or fnmatch.fnmatch(rel_path, pattern):
            return True
        if pattern in rel_path.split(os.sep):
            return True
    return False

def tree(dir_path, prefix='', rel_base=''):
    if not os.path.exists(dir_path):
        print(f"Error: Directory '{dir_path}' not found.")
        return

    try:
        raw_items = os.listdir(dir_path)
    except PermissionError:
        return

    items = []
    for f in raw_items:
        rel_path = os.path.join(rel_base, f) if rel_base else f
        if not is_ignored(f, rel_path):
            items.append(f)

    items.sort()
    for i, item in enumerate(items):
        is_last = (i == len(items) - 1)
        connector = '└── ' if is_last else '├── '
        print(prefix + connector + item)
        path = os.path.join(dir_path, item)
        new_rel = os.path.join(rel_base, item) if rel_base else item
        if os.path.isdir(path):
            tree(path, prefix + ('    ' if is_last else '│   '), new_rel)

print(f"{target_dir}/")
tree(target_dir)
