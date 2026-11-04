<?php
/**
 * File:	functions.php
 * Theme:	Lumina 
 * 
 * Lumina functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lumina
 * @since	1.0
 */

add_action( 'after_setup_theme', 'lumina_theme_support' );

if ( ! function_exists( 'lumina_theme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function lumina_theme_support() {

		// Theme widths from CSS and theme.json
		$full_size    = apply_filters( 'lumina_full_size', 1600 );
		$wide_size    = apply_filters( 'lumina_content_size', 1146 );
		$content_size = apply_filters( 'lumina_content_size', 760 );

		// Full width images: 16:9 and ultrawide 21:9
		add_image_size( 'cropped-full', $full_size, round( 9 / 16 * $full_size ), true );
		add_image_size( 'cropped-ultrawide', $full_size, round( 9 / 21 * $full_size ), true );

		// Wide images: 16:9 and slim 16:4.5
		add_image_size( 'cropped-large', $wide_size, round( 9 / 16 * $wide_size ), true );
		set_post_thumbnail_size( $wide_size, round( 9 / 16 * $wide_size ), true );
		add_image_size( 'cropped-slim', $wide_size, round( 4.5 / 16 * $wide_size ), true );

		// Narrow image: 16/9
		add_image_size( 'cropped-thumbnail', $content_size, round( 9 / 16 * $content_size ), true );
				
		// Enqueue global styles needed for the editor iframe.
		add_theme_support( 'editor-styles' );

		// Determine mode dynamically for the Site Editor canvas
		$mode_css = ( lumina_get_active_theme_mode() === 'dark' ) 
			? 'assets/css/theme-dark-mode.css' 
			: 'assets/css/theme-light-mode.css';
		
		$editor_styles = array(
			'assets/css/theme-styles.css',
			$mode_css,
			'assets/css/theme-engine.css',
			'assets/css/theme-editor-styles.css',
		);

		// Allow child themes to override the list of editor styles to load
		$editor_styles = apply_filters( 'lumina_editor_styles', $editor_styles );

		// Load the editor styles
		add_editor_style( $editor_styles ); 

		// Allow excerpts on pages
		if ( apply_filters( 'lumina_allow_page_excerpts', true ) ) {
			add_post_type_support( 'page', 'excerpt' );		
		}
	}
endif;

/**
 * Load the theme's PHP include files
 */
$includes = array (
	'/inc/block-bindings.php',
	'/inc/block-patterns.php',
	'/inc/body-classes.php',
	'/inc/comments.php',
	'/inc/icons.php',
	'/inc/images.php',
	'/inc/page-tags.php',
);

$includes = apply_filters( 'lumina_load_includes', $includes );

foreach ( $includes as $include ) {
	$file_path = get_theme_file_path( $include );
	if ( file_exists( $file_path ) ) {
		include_once $file_path;
	}
}

add_action( 'wp_enqueue_scripts', 'lumina_load_styles', 20 );

if ( ! function_exists( 'lumina_load_styles' ) ) :

	/**
	 * Enqueues core styles, theme mode variations, interactive scripts, and versioned
	 * assets.
	 *
	 * @return void
	 */
	function lumina_load_styles() {
	
		$deps = is_child_theme() ? array( get_template() ) : array();

		// 1. Core Theme CSS
		lumina_enqueue_style( 'assets/css/theme-styles.css', $deps );

		// 2. Conditionally Enqueue Light or Dark Mode
		$active_mode = lumina_get_active_theme_mode();
		$mode_file   = ( $active_mode === 'dark' ) ? 'theme-dark-mode.css' : 'theme-light-mode.css';

		lumina_enqueue_style( 'assets/css/' . $mode_file, array( 'theme-styles' ) );

		// 3. Lumina Engine Resting State CSS
		lumina_enqueue_style( 'assets/css/theme-engine.css', array( 'theme-styles' ) );

		// 4. Lumina Engine Interactive State CSS (Front-end only)
		if ( ! is_admin() ) {
			lumina_enqueue_style( 'assets/css/theme-interactions.css', array( 'theme-engine' ) );
		}

		// 5. Versioning Asset
		$asset_path = get_theme_file_path( 'assets/css/theme-styles.asset.php' );
		$version    = file_exists( $asset_path )
			? ( include $asset_path )['version'] ?? wp_get_theme()->get( 'Version' )
			: wp_get_theme()->get( 'Version' );

		// 6. Lumina Smooth Scroll JS (Front-end only)
		$smoothscroll_path = get_theme_file_path( 'assets/js/smoothscroll.js' );
		if ( ! is_admin() && file_exists( $smoothscroll_path ) ) {
			wp_enqueue_script( 
				'theme-smoothscroll', 
				get_theme_file_uri( 'assets/js/smoothscroll.js' ), 
				array( 'jquery' ), 
				$version, 
				true 
			);
		}

		// 7. Lumina Physics / Gravity JS (Front-end only)
		$physics_path = get_theme_file_path( 'assets/js/theme-physics.js' );
		if ( ! is_admin() && apply_filters( 'lumina_physics_js', true ) && file_exists( $physics_path ) ) {
			wp_enqueue_script( 
				'theme-physics', 
				get_theme_file_uri( 'assets/js/theme-physics.js' ), 
				array( 'jquery' ), 
				$version, 
				true 
			);
		}
	}
endif;

add_action( 'init', 'lumina_load_block_styles', 20 );

if ( ! function_exists( 'lumina_load_block_styles' ) ) :

	/**
	 * Load INDIVIDUAL Block CSS styles on 'init' (Applies to Front-End and Editor)
	 */
	function lumina_load_block_styles() {

		$relative_block_path = 'assets/css/blocks/';
		$block_dir           = get_theme_file_path( $relative_block_path );

		// Guard clause
		if ( ! is_dir( $block_dir ) ) {
			return;
		}

		$block_styles = glob( $block_dir . '*.css' ); 
		if ( empty( $block_styles ) ) {
			return;
		}

		// Get build version
		$asset_path        = get_theme_file_path( 'assets/css/theme-styles.asset.php' );
		$block_css_version = file_exists( $asset_path )
			? ( include $asset_path )['version'] ?? wp_get_theme()->get( 'Version' )
			: wp_get_theme()->get( 'Version' );

		// Register main handle early on 'init' so it exists as a valid dependency
		if ( ! wp_style_is( 'theme-styles', 'registered' ) ) {
			$main_css_path = get_theme_file_path( 'assets/css/theme-styles.css' );
			if ( file_exists( $main_css_path ) ) {
				wp_register_style(
					'theme-styles',
					get_theme_file_uri( 'assets/css/theme-styles.css' ),
					array(),
					$block_css_version
				);
			}
		}

		// Register block styles
		foreach ( $block_styles as $file_path ) {
			$file_slug = basename( $file_path, '.css' );

			if ( strpos( $file_slug, 'block-styles' ) !== false || strpos( $file_slug, '-rtl' ) !== false ) {
				continue;
			}

			$parts      = explode( '_', $file_slug );
			$block_name = $parts[0];
			$handle     = "theme-block-{$file_slug}";

			wp_enqueue_block_style( "core/{$block_name}", array(
				'handle' => $handle,
				'src'    => get_theme_file_uri( $relative_block_path . "{$file_slug}.css" ),
				'path'   => $file_path,
				'deps'   => array(),
				'ver'    => $block_css_version,
			) );

			wp_style_add_data( $handle, 'rtl', 'replace' );
		}
	}
endif;

add_filter( 'default_wp_template_part_areas', 'lumina_template_part_areas' );

if ( ! function_exists( 'lumina_template_part_areas' ) ) :

	/**
	 * Custom Template Part Areas
	 */
	function lumina_template_part_areas( array $areas ) {

		$new_areas = array( 
			array(
				'area'        => 'title',
				'area_tag'    => 'section',
				'label'       => __( 'Title', 'lumina' ),
				'description' => __( 'Page and post titles', 'lumina' ),
				'icon'        => 'heading'
			),
			array(
				'area'        => 'content',
				'area_tag'    => 'section',
				'label'       => __( 'Content', 'lumina' ),
				'description' => __( 'Content such as post format, sidebar, etc.', 'lumina' ),
				'icon'        => 'layout'
			),
			array(
				'area'        => 'image',
				'area_tag'    => 'section',
				'label'       => __( 'Image', 'lumina' ),
				'description' => __( 'Images', 'lumina' ),
				'icon'        => 'format-image'
			)
		);
		return array_merge( $areas, $new_areas );
	}
endif;

add_filter( 'image_size_names_choose', 'lumina_image_sizes' );

if ( ! function_exists( 'lumina_image_sizes' ) ) :

	/**
	 * Image Size Chooser Options
	 */
	function lumina_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
			'medium-large'      => __( 'Medium Large', 'lumina' ),
			'cropped-thumbnail' => __( 'Post Thumbnail Medium 16:9 (cropped)', 'lumina' ),
			'cropped-full'     	=> __( 'Post Thumbnail Full 16:9 (cropped)', 'lumina' ),
			'cropped-large'     => __( 'Post Thumbnail Large (cropped)', 'lumina' ),
			'cropped-slim'      => __( 'Lumina Slim Banner 16:4.5 (cropped)', 'lumina' ),
			'cropped-ultrawide' => __( 'Lumina Ultrawide 21:9 (cropped)', 'lumina' ),
		) );
	}
endif;

if ( ! function_exists( 'lumina_body_open' ) && ! is_child_theme() ):

	add_action( 'wp_body_open', 'lumina_body_open' );

	/**
	 * Anchor Tags for Scroll-To-Top
	 */
	function lumina_body_open() { 
		echo '<a id="page"></a><a id="wrapper"></a>'; 
	}
endif;

// add_action( 'admin_menu', 'lumina_adjust_admin_menu', 999 );
// 
// if ( ! function_exists( 'lumina_adjust_admin_menu' ) ) :
//
//	/**
//	 * Clean up legacy admin pages in Block Theme mode
//	 */
// 	function lumina_adjust_admin_menu() {
// 		remove_submenu_page( 'themes.php', 'nav-menus.php' );
// 		remove_submenu_page( 'themes.php', 'widgets.php' );
// 	}
// endif;

if ( ! function_exists( 'lumina_enqueue_style' ) ) :

	/**
	 * Helper utility function to enqueue CSS styles with asset file versions
	 * Accepts a relative theme path (e.g. 'assets/css/theme-styles.css')
	 */
	function lumina_enqueue_style( $relative_path, $custom_deps = array() ) {

		$file_path = get_theme_file_path( $relative_path );

		if ( ! file_exists( $file_path ) ) {
			return;
		}

		$version    = wp_get_theme()->get( 'Version' ) ?? false;
		$asset_path = str_replace( '.css', '.asset.php', $file_path );

		if ( file_exists( $asset_path ) ) {
			$asset_file = include $asset_path;
			if ( ! empty( $asset_file['version'] ) ) {
				$version = $asset_file['version'];
			}
		}

		$file_uri = get_theme_file_uri( $relative_path );
		$handle   = str_replace( array( 'assets/css/', 'blocks/', '.css' ), '', $relative_path );
		
		$deps = ! empty( $custom_deps ) 
			? $custom_deps 
			: ( $handle === 'theme-styles' ? array() : array( 'theme-styles' ) );

		wp_enqueue_style( $handle, $file_uri, $deps, $version );

		$rtl_relative = str_replace( '.css', '-rtl.css', $relative_path );
		if ( file_exists( get_theme_file_path( $rtl_relative ) ) ) {
			wp_style_add_data( $handle, 'rtl', 'replace' );
		}
	} 
endif;

if ( ! function_exists( 'lumina_get_active_theme_mode' ) ) :

	/**
	 * Detect active theme canvas mode ('dark' vs 'light') from global settings or
	 * calculated luminance.
	 */
	function lumina_get_active_theme_mode() {

		$mode_setting = wp_get_global_settings( array( 'custom', 'color', 'theme', 'mode' ) );
		if ( ! empty( $mode_setting ) && is_string( $mode_setting ) ) {
			return ( strpos( $mode_setting, 'dark' ) !== false ) ? 'dark' : 'light';
		}

		$transient_key = 'xs_theme_meta_' . get_stylesheet();
		$theme_meta    = get_transient( $transient_key );

		if ( is_array( $theme_meta ) ) {
			if ( ! empty( $theme_meta['mode_class'] ) && strpos( $theme_meta['mode_class'], 'dark' ) !== false ) {
				return 'dark';
			}
			if ( ! empty( $theme_meta['bg_class'] ) && $theme_meta['bg_class'] === 'is-dark-background' ) {
				return 'dark';
			}
		}

		return 'light';
	}
endif;