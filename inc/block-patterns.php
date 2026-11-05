<?php
/**
 * File:        inc/block-patterns.php
 * Theme:       Shared Block Pattern Functions
 *
 * Handles pattern category registrations and core pattern overrides for block themes.
 *
 * @package     NicheWP
 */

namespace NicheWP;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( __NAMESPACE__ . '\register_additional_pattern_categories' ) ) :
	/**
	 * Registers additional block pattern categories for NicheWP products.
	 *
	 * @package NicheWP
	 * @return void
	 */
	function register_additional_pattern_categories() {

		$block_pattern_categories = array(
			'lumina' => array( 'label' => __( 'All Lumina', 'lumina' ) ),
			'column' => array( 'label' => __( 'Columns', 'lumina' ) ),
		);

		$block_pattern_categories = apply_filters( 'lumina_block_pattern_additional_categories', $block_pattern_categories );

		foreach ( $block_pattern_categories as $name => $properties ) {
			if ( ! \WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
				register_block_pattern_category( $name, $properties );
			}
		}	
	}
endif;
add_action( 'init', __NAMESPACE__ . '\register_additional_pattern_categories' );

/**
 * Disable remote pattern fetching from the WordPress.org pattern directory.
 */
add_filter( 'should_load_remote_block_patterns', '__return_false' );

if ( ! function_exists( __NAMESPACE__ . '\remove_core_block_patterns' ) ) :
	/**
	 * Removes core WordPress block patterns so they do not clutter the editor design tab.
	 *
	 * @package NicheWP
	 * @return void
	 */
	function remove_core_block_patterns() {
		
		// Remove core WordPress bundled patterns (wireframes, multi-column layouts)
		remove_theme_support( 'core-block-patterns' );

		// Retrieve all currently registered pattern instances
		$registry      = \WP_Block_Patterns_Registry::get_instance();
		$core_patterns = $registry->get_all_registered();

		foreach ( $core_patterns as $pattern ) {
			$name        = $pattern['name'] ?? '';
			$categories  = $pattern['categories'] ?? [];
			$block_types = $pattern['blockTypes'] ?? [];

			// CRITICAL GUARD: Only target patterns originating strictly from core ('core/...')
			if ( 0 === strpos( $name, 'core/' ) ) {

				$is_header = in_array( 'header', $categories, true ) || 
				             in_array( 'core/template-part/header', $block_types, true ) || 
				             false !== strpos( $name, 'header' );

				$is_footer = in_array( 'footer', $categories, true ) || 
				             in_array( 'core/template-part/footer', $block_types, true ) || 
				             false !== strpos( $name, 'footer' );

				$is_query  = in_array( 'query', $categories, true ) || 
				             in_array( 'core/query', $block_types, true ) || 
				             false !== strpos( $name, 'query' );

				$is_social = in_array( 'core/social-links', $block_types, true );

				if ( $is_header || $is_footer || $is_query || $is_social ) {
					unregister_block_pattern( $name );
				}
			}
		}			
	}
endif;
add_action( 'init', __NAMESPACE__ . '\remove_core_block_patterns', 99 );
