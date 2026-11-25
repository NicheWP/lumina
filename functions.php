<?php
/**
 * File:	functions.php
 * Theme:	Lumina NicheWP 
 * 
 * Description: Lumina NicheWP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lumina-nichewp
 * @since	1.0
 */

// AFTER SETUP THEME
add_action( 'after_setup_theme', 'lumina_nichewp_theme_support' );

if ( ! function_exists( 'lumina_nichewp_theme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @package lumina-nichewp
	 * @return void
	 */
	function lumina_nichewp_theme_support() {

		// Theme widths from CSS and theme.json
		$full_size    = apply_filters( 'lumina_nichewp_full_size', 1600 );
		$wide_size    = apply_filters( 'lumina_nichewp_content_size', 1146 );
		$content_size = apply_filters( 'lumina_nichewp_content_size', 760 );

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

		$editor_styles = array(
			'assets/css/theme-styles.css',
			'assets/css/theme-light-mode.css',
			'assets/css/theme-dark-mode.css',
			'assets/css/theme-engine.css',
			'assets/css/theme-editor-styles.css',
		);

		// Allow child themes to override the list of editor styles to load
		$editor_styles = apply_filters( 'lumina_nichewp_editor_styles', $editor_styles );

		// Load the editor styles
		add_editor_style( $editor_styles ); 

		// Allow excerpts on pages
		if ( apply_filters( 'lumina_nichewp_allow_page_excerpts', true ) ) {
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
);

$includes = apply_filters( 'lumina_nichewp_load_includes', $includes );

foreach ( $includes as $include ) {
	$file_path = get_theme_file_path( $include );
	if ( file_exists( $file_path ) ) {
		include_once $file_path;
	}
}

// ENQUEUE EDITOR CANVAS SCRIPT
if ( function_exists( 'NicheWP\add_body_classes' ) ) {
	add_action( 'enqueue_block_assets', 'lumina_nichewp_enqueue_editor_body_classes' );
}

if ( ! function_exists( 'lumina_nichewp_enqueue_editor_body_classes' ) ) :

	/**
	 * Supplies the initial theme classes to the block editor canvas.
	 *
	 * @return void
	 */
	function lumina_nichewp_enqueue_editor_body_classes() {
		if ( ! is_admin() ) {
			return;
		}

		$script = 'assets/js/editor-body-classes.js';
		wp_enqueue_script(
			'lumina-nichewp-editor-body-classes',
			get_theme_file_uri( $script ),
			array(),
			lumina_nichewp_get_asset_version(),
			true
		);
		wp_add_inline_script(
			'lumina-nichewp-editor-body-classes',
			'window.lumina-nichewpEditorBodyClasses = ' . wp_json_encode( NicheWP\add_body_classes( array() ) ) . ';',
			'before'
		);
	}
endif;

if ( ! function_exists( 'lumina_nichewp_get_asset_version' ) ) :

	/**
	 * Returns the main theme stylesheet's build version, or the theme version.
	 *
	 * @return string
	 */
	function lumina_nichewp_get_asset_version() {
		$asset_path = get_theme_file_path( 'assets/css/theme-styles.asset.php' );
		return file_exists( $asset_path )
			? ( include $asset_path )['version'] ?? wp_get_theme()->get( 'Version' )
			: wp_get_theme()->get( 'Version' );
	}
endif;

// ENQUEUE SCRIPTS
add_action( 'wp_enqueue_scripts', 'lumina_nichewp_load_styles', 20 );

if ( ! function_exists( 'lumina_nichewp_load_styles' ) ) :

	/**
	 * Enqueues core styles, theme mode variations, interactive scripts, and versioned
	 * assets.
	 *
	 * @package lumina-nichewp
	 * @return void
	 */
	function lumina_nichewp_load_styles() {
	
		$deps = is_child_theme() ? array( get_template() ) : array();

		// 1. Core Theme CSS
		lumina_nichewp_enqueue_style( 'assets/css/theme-styles.css', $deps );

		// 2. Conditionally Enqueue Light or Dark Mode
		$active_mode = lumina_nichewp_get_active_theme_mode();
		$mode_file   = ( $active_mode === 'dark' ) ? 'theme-dark-mode.css' : 'theme-light-mode.css';

		lumina_nichewp_enqueue_style( 'assets/css/' . $mode_file, array( 'theme-styles' ) );

		// 3. Lumina NicheWP Engine Resting State CSS
		lumina_nichewp_enqueue_style( 'assets/css/theme-engine.css', array( 'theme-styles' ) );

		// 4. Lumina NicheWP Engine Interactive State CSS (Front-end only)
		if ( ! is_admin() ) {
			lumina_nichewp_enqueue_style( 'assets/css/theme-interactions.css', array( 'theme-engine' ) );
		}

		// 5. Versioning Asset
		$version = lumina_nichewp_get_asset_version();

		// 6. Lumina NicheWP Smooth Scroll JS (Front-end only)
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

		// 7. Lumina NicheWP Physics / Gravity JS (Front-end only)
		$physics_path = get_theme_file_path( 'assets/js/theme-physics.js' );
		if ( ! is_admin() && apply_filters( 'lumina_nichewp_physics_js', true ) && file_exists( $physics_path ) ) {
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

// INIT HOOK
add_action( 'init', 'lumina_nichewp_load_block_styles', 20 );

if ( ! function_exists( 'lumina_nichewp_load_block_styles' ) ) :

	/**
	 * Load INDIVIDUAL Block CSS styles on 'init' (Applies to Front-End and Editor)
	 *
	 * @package lumina-nichewp
	 * @return void
	 */
	function lumina_nichewp_load_block_styles() {

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
		$block_css_version = lumina_nichewp_get_asset_version();

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

// TEMPLATE PART AREAS
add_filter( 'default_wp_template_part_areas', 'lumina_nichewp_template_part_areas' );

if ( ! function_exists( 'lumina_nichewp_template_part_areas' ) ) :

	/**
	 * Custom Template Part Areas
	 *
	 * @package lumina-nichewp
	 * @param array $areas Existing template part areas.
	 * @return array Modified template part areas.
	 */
	function lumina_nichewp_template_part_areas( array $areas ) {

		$new_areas = array( 
			array(
				'area'        => 'title',
				'area_tag'    => 'section',
				'label'       => __( 'Title', 'lumina-nichewp' ),
				'description' => __( 'Page and post titles', 'lumina-nichewp' ),
				'icon'        => 'heading'
			),
			array(
				'area'        => 'content',
				'area_tag'    => 'section',
				'label'       => __( 'Content', 'lumina-nichewp' ),
				'description' => __( 'Content such as post format, sidebar, etc.', 'lumina-nichewp' ),
				'icon'        => 'layout'
			),
			array(
				'area'        => 'image',
				'area_tag'    => 'section',
				'label'       => __( 'Image', 'lumina-nichewp' ),
				'description' => __( 'Images', 'lumina-nichewp' ),
				'icon'        => 'format-image'
			)
		);
		return array_merge( $areas, $new_areas );
	}
endif;

// IMAGE SIZES
add_filter( 'image_size_names_choose', 'lumina_nichewp_image_sizes' );

if ( ! function_exists( 'lumina_nichewp_image_sizes' ) ) :

	/**
	 * Image Size Chooser Options
	 *
	 * @package lumina-nichewp
	 * @param array $sizes Existing image sizes.
	 * @return array Merged image sizes.
	 */
	function lumina_nichewp_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
			'medium-large'      => __( 'Medium Large', 'lumina-nichewp' ),
			'cropped-thumbnail' => __( 'Post Thumbnail Medium 16:9 (cropped)', 'lumina-nichewp' ),
			'cropped-full'     	=> __( 'Post Thumbnail Full 16:9 (cropped)', 'lumina-nichewp' ),
			'cropped-large'     => __( 'Post Thumbnail Large (cropped)', 'lumina-nichewp' ),
			'cropped-slim'      => __( 'Lumina NicheWP Slim Banner 16:4.5 (cropped)', 'lumina-nichewp' ),
			'cropped-ultrawide' => __( 'Lumina NicheWP Ultrawide 21:9 (cropped)', 'lumina-nichewp' ),
		) );
	}
endif;

// BODY TAGS
add_action( 'wp_body_open', 'lumina_nichewp_body_open' );

if ( ! function_exists( 'lumina_nichewp_body_open' ) && ! is_child_theme() ):

	/**
	 * Anchor Tags for Scroll-To-Top
	 *
	 * @package lumina-nichewp
	 * @return void
	 */
	function lumina_nichewp_body_open() { 
		echo '<a id="page"></a><a id="wrapper"></a>'; 
	}
endif;

/**
 * Override WordPress Core default block-template viewport meta tag for Lumina NicheWP
 */
add_action( 'wp_head', function() {
	// 1. Unhook core's private viewport callback before priority 0 executes
	remove_action( 'wp_head', '_block_template_viewport_meta_tag', 0 );

	// 2. Output custom viewport meta tag with safe-area support
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />' . "\n";
}, PHP_INT_MIN );

// HELPER FOR ENQUEUE STYLES
if ( ! function_exists( 'lumina_nichewp_enqueue_style' ) ) :

	/**
	 * Helper utility function to enqueue CSS styles with asset file versions
	 * Accepts a relative theme path (e.g. 'assets/css/theme-styles.css')
	 *
	 * @package lumina-nichewp
	 * @param string $relative_path Relative path to CSS file.
	 * @param array  $custom_deps   Optional custom dependencies.
	 * @return void
	 */
	function lumina_nichewp_enqueue_style( $relative_path, $custom_deps = array() ) {

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

// HELPER FOR GETTING JSON VARIABLES
if ( ! function_exists( 'lumina_nichewp_get_active_theme_mode' ) ) :

	/**
	 * Detect active theme canvas mode ('dark' vs 'light') from global settings or
	 * calculated lumina-nichewpnce.
	 *
	 * @package lumina-nichewp
	 * @return string Active theme mode ('dark' or 'light').
	 */
	function lumina_nichewp_get_active_theme_mode() {

		$mode_setting = wp_get_global_settings( array( 'custom', 'color', 'theme', 'mode' ) );
		if ( ! empty( $mode_setting ) && is_string( $mode_setting ) ) {
			return 'dark' === $mode_setting ? 'dark' : 'light';
		}

		if ( function_exists( 'NicheWP\get_transient_key' ) ) {
			$theme_meta = get_transient( NicheWP\get_transient_key() );

			if ( is_array( $theme_meta ) ) {
				if ( ! empty( $theme_meta['mode_class'] ) && 'dark' === $theme_meta['mode_class'] ) {
					return 'dark';
				}
				if ( ! empty( $theme_meta['bg_class'] ) && $theme_meta['bg_class'] === 'is-dark-background' ) {
					return 'dark';
				}
			}
		}

		return 'light';
	}
endif;
