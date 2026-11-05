<?php
/**
 * File:        inc/icons.php
 * Theme:       Shared Icon Block Functions
 *
 * Auto-register theme SVG icons using the WP 7.1 Icon API.
 * Auto-discovers sub-folders while enforcing a single permanent 'lumina' collection handle.
 *
 * @package     NicheWP
 */

namespace NicheWP;

if ( ! defined( 'THEME_SLUG' ) ) {
	/**
	 * Static slug handle for theme SVG icon collection registration.
	 *
	 * @var string
	 */
	define( 'THEME_SLUG', 'lumina' );
}

if ( ! defined( 'ICON_REGISTRATION_DIR' ) ) {
	/**
	 * Relative path to theme SVG icon directory.
	 *
	 * @var string
	 */
	define( 'ICON_REGISTRATION_DIR', 'assets/icons' );
}

add_action( 'init', __NAMESPACE__ . '\register_theme_svg_icons' );

if ( ! function_exists( __NAMESPACE__ . '\register_theme_svg_icons' ) ) :
	/**
	 * Registers custom SVG icons using the WP 7.1 Icon API across sub-folder sets.
	 *
	 * @package NicheWP
	 * @return void
	 */
	function register_theme_svg_icons() {
	
		// Guard clause: check for official WP 7.1 Icon API functions
		if ( ! function_exists( 'wp_register_icon_collection' ) || ! function_exists( 'wp_register_icon' ) ) {
			return;
		}
	
		$base_dir = get_theme_file_path( ICON_REGISTRATION_DIR );
		if ( ! is_dir( $base_dir ) ) {
			return;
		}
	
		// 1. Static collection slug & label for all Lumina theme icons
		$collection_slug  = THEME_SLUG; // 'lumina'
		$collection_label = __( 'Lumina Theme', 'lumina' );
	
		// 2. Register the master collection once
		wp_register_icon_collection(
			$collection_slug,
			array(
				'label'       => $collection_label,
				'description' => __( 'Custom Lumina theme icon collection.', 'lumina' ),
			)
		);
	
		// 3. Discover all sub-directories (e.g. /theme, /patterns) inside base directory
		$set_dirs = glob( trailingslashit( $base_dir ) . '*', GLOB_ONLYDIR );
	
		// Fallback: If no sub-folders exist, scan the root icons directory
		if ( empty( $set_dirs ) ) {
			$set_dirs = array( $base_dir );
		}
	
		// Optional: Add folder names here to exclude them from registration (e.g. array( 'temp', 'drafts' ))
		$excluded_folders = array();
	
		foreach ( $set_dirs as $dir_path ) {
			$folder_name = basename( $dir_path );
	
			// Skip excluded folders
			if ( in_array( $folder_name, $excluded_folders, true ) ) {
				continue;
			}
	
			// Discover all SVG files in this specific sub-folder
			$files = glob( trailingslashit( $dir_path ) . '*.svg' );
			if ( empty( $files ) ) {
				continue;
			}
	
			// 4. Register each SVG icon under the static 'lumina/filename' handle
			foreach ( $files as $file_path ) {
				$filename  = basename( $file_path, '.svg' );
				$icon_name = $collection_slug . '/' . sanitize_key( $filename );
	
				wp_register_icon(
					$icon_name,
					array(
						'label'     => ucwords( str_replace( array( '-', '_' ), ' ', $filename ) ),
						'file_path' => $file_path,
					)
				);
			}
		}
	}
endif;
	