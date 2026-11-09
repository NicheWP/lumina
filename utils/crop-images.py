#!/usr/bin/env python3
"""
==============================================================================
IMAGE CENTER/POSITIONAL CROPPER, RESCALER & EXIF METADATA EMBEDDER
==============================================================================

This script recursively scans a directory and its subdirectories for raw images, 
crops them to a configured aspect ratio and positional anchor (CROP=center|top|bottom), 
resizes them using Lanczos resampling (unless CROP=none or NO_CROP=1 is set), 
intelligently parses structured filenames into EXIF metadata, and exports WebP files:
  - Files starting with a number (e.g., 01_gold_sea_...) -> Keeps sequential number (01.webp)
  - Files starting with text (e.g., female-01_portrait_...) -> Retains prefix before '_' (female-01.webp)

PER-DIRECTORY DEFAULT CROP SIZES:
  - /team & /testimonials : 1200x1600 (3:4 Portrait Headshot)
  - All other folders     : 1600x900  (Standard Widescreen / Screenshots)

EXIF TAG MAP (WordPress Auto-Extraction Compatible):
  - Tag 270   (ImageDescription) : Title & Keywords -> Auto-populates WP Caption/Title
  - Tag 315   (Artist)           : Photo Source / Author -> Auto-populates WP Credit
  - Tag 33432 (Copyright)        : License Status -> Auto-populates WP Copyright
  - Tag 37510 (UserComment)      : Full Raw Original Filename -> Complete Audit Trail

Configured entirely via environment variables.

------------------------------------------------------------------------------
USAGE EXAMPLES (RUN FROM REPO ROOT OR SCRIPT FOLDER):
------------------------------------------------------------------------------

1. DEFAULT RUN (Recursive sweep with automatic per-directory default crop sizes):
   $ python3 utils/crop-images.py

2. CUSTOM QUALITY CONTROL:
   $ QUALITY=85 python3 utils/crop-images.py

3. TARGETED SUBFOLDER RUN WITH CUSTOM OVERRIDE (Only allowed when passing a specific subfolder):
   $ TARGET_W=1200 TARGET_H=1600 \
     SOURCE_DIR="./src/images/team" \
     python3 utils/crop-images.py

4. NO-CROP PASS-THROUGH (Preserve manual crops, embed EXIF & convert to WebP):
   $ CROP=none \
     python3 utils/crop-images.py


==============================================================================
"""

import os
import sys
import plistlib
import subprocess
from PIL import Image

# ==============================================================================
# PATH RESOLUTION & CONFIGURATION FROM ENVIRONMENT VARIABLES
# ==============================================================================

# Allow processing of ultra-high-res raw stock photos (up to 250 Megapixels)
Image.MAX_IMAGE_PIXELS = 250000000

SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))
DEFAULT_SOURCE = os.path.abspath(os.path.join(SCRIPT_DIR, "../src/images"))
DEFAULT_OUTPUT_BASE = os.path.abspath(os.path.join(SCRIPT_DIR, "../assets/images"))

QUALITY = int(os.environ.get("QUALITY", "85"))
OUTPUT_FORMAT = os.environ.get("OUTPUT_FORMAT", "webp").lower()

# Positional Crop Strategy: "center" (default), "top" (headroom priority), "bottom", or "none"/"passthrough"
CROP = os.environ.get("CROP", os.environ.get("GRAVITY", "center")).lower()
NO_CROP = os.environ.get("NO_CROP", "0").lower() in ("1", "true", "yes") or CROP in ("none", "passthrough", "false", "0")

SOURCE_DIR = os.path.abspath(os.environ.get("SOURCE_DIR", DEFAULT_SOURCE))
OUTPUT_DIR = os.path.abspath(os.environ.get("OUTPUT_DIR", DEFAULT_OUTPUT_BASE))

VALID_EXTS = (".jpg", ".jpeg", ".png", ".webp", ".bmp", ".tiff")


def get_target_dimensions(rel_path):
    """
    Determines target crop dimensions based on the folder path.
    - /team and /testimonials -> 1200x1600
    - Default (including /screenshots) -> 1600x900
    """
    # Check if custom TARGET_W or TARGET_H were explicitly requested via environment variables
    custom_w = os.environ.get("TARGET_W")
    custom_h = os.environ.get("TARGET_H")
    
    if custom_w or custom_h:
        # Restriction: Custom sizes are only permitted when targeting a specific subfolder (not root recursive sweep)
        if rel_path == "." or rel_path == "":
            print("❌ Error: Passing custom TARGET_W/TARGET_H via environment variables is only permitted")
            print("   when targeting a specific subfolder (e.g., SOURCE_DIR='./src/images/team').")
            sys.exit(1)
        
        # If running on a specific subfolder with custom overrides
        w = int(custom_w) if custom_w else 1600
        h = int(custom_h) if custom_h else 900
        return w, h

    # Automatic per-directory defaults
    if rel_path == "." or not rel_path:
        return 1600, 900
    
    top_folder = rel_path.split(os.sep)[0].lower()
    
    if top_folder in ("team", "testimonials"):
        return 1200, 1600
    else:
        return 1600, 900


def get_mac_where_from_url(filepath):
    """
    Extracts the 'Where from' download URL from macOS Extended Attributes using native xattr CLI.
    """
    try:
        result = subprocess.run(
            ["xattr", "-p", "com.apple.metadata:kMDItemWhereFroms", filepath],
            capture_output=True
        )
        if result.returncode == 0 and result.stdout:
            urls = plistlib.loads(result.stdout)
            if urls and isinstance(urls, list) and len(urls) > 0:
                return urls[0]
    except Exception:
        pass
    return None


def copy_mac_where_from_attr(src_path, dest_path):
    """
    Copies the macOS 'Where from' attribute to the target file using macOS native xattr CLI.
    """
    try:
        get_res = subprocess.run(
            ["xattr", "-p", "com.apple.metadata:kMDItemWhereFroms", src_path],
            capture_output=True
        )
        if get_res.returncode == 0 and get_res.stdout:
            raw_hex = get_res.stdout.hex()
            set_res = subprocess.run(
                ["xattr", "-wx", "com.apple.metadata:kMDItemWhereFroms", raw_hex, dest_path],
                capture_output=True, text=True
            )
            if set_res.returncode == 0:
                return True
    except Exception:
        pass
    return False


def parse_filename_metadata(filename, src_path):
    """
    Parses structured filenames and extracts source URLs into metadata fields.
    """
    base_name = os.path.splitext(filename)[0]
    parts = base_name.split('_')

    if len(parts) >= 5:
        color = parts[1].title()
        topic = parts[2].title()
        title = parts[3].replace('-', ' ').title()
        source = parts[4].title()
        description = f"{title} ({color} / {topic})"
    elif len(parts) == 4:
        topic = parts[1].title()
        title = parts[2].replace('-', ' ').title()
        source = parts[3].title()
        description = f"{title} ({topic})"
    else:
        title = base_name.replace('-', ' ').replace('_', ' ').title()
        source = "Pexels" if "pexels" in base_name.lower() else "Stock Source"
        description = title

    where_from_url = get_mac_where_from_url(src_path)
    
    if where_from_url:
        user_comment = f"Original File: {filename} | URL: {where_from_url}"
    else:
        user_comment = f"Original File: {filename}"

    copyright_notice = f"{source} License (GPL Compatible)"

    return {
        "title": description,
        "artist": source,
        "copyright": copyright_notice,
        "comment": user_comment,
        "url": where_from_url
    }


if not os.path.exists(SOURCE_DIR):
    print(f"❌ Error: Source folder '{SOURCE_DIR}' does not exist.")
    sys.exit(1)

crop_mode_str = "PASSTHROUGH (No Crop)" if NO_CROP else f"CROP [{CROP.upper()}] (Per-Directory Auto-Sizes)"
print(f"🚀 Sweeping subdirectories in '{SOURCE_DIR}' [{crop_mode_str}]")
print(f"   Target Base Output: '{OUTPUT_DIR}'\n")

total_processed = 0

# Walk recursively through all subdirectories
for current_root, dirs, files in os.walk(SOURCE_DIR):
    # Prevent infinite recursion/re-processing if OUTPUT_DIR sits inside SOURCE_DIR
    dirs[:] = [
        d for d in dirs 
        if not d.startswith(".") 
        and not d.startswith("cropped_") 
        and not d.startswith("converted_")
        and os.path.abspath(os.path.join(current_root, d)) != os.path.abspath(OUTPUT_DIR)
    ]

    # Filter and sort matching image files in the current folder
    source_files = sorted([
        f for f in files 
        if not f.startswith(".") and f.lower().endswith(VALID_EXTS)
    ])

    if not source_files:
        continue

    # Determine relative subfolder path and construct target output folder
    try:
        rel_path = os.path.relpath(current_root, DEFAULT_SOURCE)
        if rel_path.startswith(".."):
            rel_path = os.path.relpath(current_root, SOURCE_DIR)
    except Exception:
        rel_path = os.path.relpath(current_root, SOURCE_DIR)

    if rel_path == "." or rel_path == "":
        target_out_dir = OUTPUT_DIR
        display_folder = "/"
    else:
        target_out_dir = os.path.join(OUTPUT_DIR, rel_path)
        display_folder = f"/{rel_path}/"

    os.makedirs(target_out_dir, exist_ok=True)

    # Resolve target dimensions for this specific folder
    target_w, target_h = get_target_dimensions(rel_path)
    target_ratio = target_w / target_h

    print(f"📁 Folder: {display_folder} ({len(source_files)} image(s)) -> Target: {target_w}x{target_h}")

    for idx, filename in enumerate(source_files, start=1):
        src_path = os.path.join(current_root, filename)

        # OUTPUT FILENAME RESOLUTION:
        # - Starts with a number (e.g. 01_gold_sea...): keep the number prefix or format as numeric base
        # - Starts with text (e.g. female-01_portrait...): keep everything before the first '_' (female-01.webp)
        if filename[0].isdigit():
            base_part = os.path.splitext(filename)[0].split('_')[0]
            out_filename = f"{base_part}.{OUTPUT_FORMAT}"
        else:
            base_part = os.path.splitext(filename)[0].split('_')[0]
            out_filename = f"{base_part}.{OUTPUT_FORMAT}"

        out_path = os.path.join(target_out_dir, out_filename)

        try:
            with Image.open(src_path) as img:
                exif_data = img.getexif()

                meta = parse_filename_metadata(filename, src_path)

                exif_data[270] = meta["title"]
                exif_data[315] = meta["artist"]
                exif_data[33432] = meta["copyright"]
                exif_data[37510] = meta["comment"]

                if img.mode in ("RGBA", "LA") or (img.mode == "P" and "transparency" in img.info):
                    img = img.convert("RGBA")
                else:
                    img = img.convert("RGB")

                orig_w, orig_h = img.size

                if NO_CROP:
                    final_img = img
                    proc_status = f"Native ({orig_w}x{orig_h})"
                else:
                    orig_ratio = orig_w / orig_h

                    if orig_ratio > target_ratio:
                        crop_w = int(orig_h * target_ratio)
                        crop_h = orig_h
                        top = 0
                        
                        if CROP == "left":
                            left = 0
                        elif CROP == "right":
                            left = orig_w - crop_w
                        else:
                            left = (orig_w - crop_w) // 2
                    else:
                        crop_w = orig_w
                        crop_h = int(orig_w / target_ratio)
                        left = 0
                        
                        if CROP == "top":
                            top = 0
                        elif CROP == "bottom":
                            top = orig_h - crop_h
                        else:
                            top = (orig_h - crop_h) // 2

                    right = left + crop_w
                    bottom = top + crop_h

                    cropped = img.crop((left, top, right, bottom))

                    resample_filter = getattr(Image, "Resampling", Image).LANCZOS
                    final_img = cropped.resize((target_w, target_h), resample_filter)
                    proc_status = f"Cropped [{CROP.upper()}] ({target_w}x{target_h})"

                save_kwargs = {
                    "format": OUTPUT_FORMAT.upper(),
                    "quality": QUALITY,
                    "exif": exif_data.tobytes() if hasattr(exif_data, "tobytes") else exif_data
                }
                if OUTPUT_FORMAT == "webp":
                    save_kwargs["method"] = 6

                final_img.save(out_path, **save_kwargs)

                copy_mac_where_from_attr(src_path, out_path)

                url_status = "🔗 URL Preserved" if meta["url"] else "ℹ️ No URL xattr"
                print(f"  ✂️  [{idx:02d}] {filename} -> {out_filename} | {proc_status} | {meta['title']} [{url_status}]")
                total_processed += 1

        except Exception as e:
            print(f"  ⚠️  Skipped {filename}: {e}")
    print()

if total_processed == 0:
    print(f"⚠️  No matching images found in '{SOURCE_DIR}'.")
else:
    print(f"🎉 Success! Processed {total_processed} image(s) across all subdirectories into '{OUTPUT_DIR}/'.")
