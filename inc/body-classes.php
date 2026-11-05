<?php
/**
 * File:        body-classes.php
 * Theme:       Shared Body Class Functions
 *
 * Centralized Document Layout Engine.
 * Directly queries global styles background color and custom theme settings to apply:
 *   1. Canvas Luminance:   is-dark-background | is-light-background
 *   2. Theme Engine Mode:  is-dark-theme | is-light-theme
 *   3. Color Scheme Variant: color-scheme-{$slug}
 *
 * Transient keys are dynamically scoped per active theme/child-theme slug.
 *
 * @package    NicheWP
 */

namespace NicheWP;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Dynamic transient key prefix used for caching site-wide lightness metadata.
 *
 * @var string
 */
const TRANSIENT_PREFIX = 'xs_theme_meta_';

/**
 * Returns a transient key dynamically scoped to the current theme/child-theme slug.
 * 
 * @package NicheWP
 * @return string WordPress Transient Database Key (Prefix + Theme Slug)
 */
function get_transient_key() {
	return TRANSIENT_PREFIX . get_stylesheet();
}

// Hook 1: Document Class Append Matrix
add_filter( 'body_class', __NAMESPACE__ . '\add_body_classes', 10, 1 );

/**
 * Converts HSL/HSLA color channels down to baseline RGB values (0–255 range).
 *
 * @package NicheWP
 * @param float|int $h Hue value (0 to 360).
 * @param float|int $s Saturation value (0 to 100).
 * @param float|int $l Lightness value (0 to 100).
 * @return array{0: int, 1: int, 2: int} Array containing red, green, and blue integer
 * channels.
 */ 
function hsl_to_rgb( $h, $s, $l ) {
	$h /= 360;
	$s /= 100;
	$l /= 100;

	if ( 0 == $s ) {
		$r = $g = $b = $l; // Achromatic (gray)
	} else {
		$q = $l < 0.5 ? $l * ( 1 + $s ) : $l + $s - $l * $s;
		$p = 2 * $l - $q;

		$r = hue_to_rgb( $p, $q, $h + 1/3 );
		$g = hue_to_rgb( $p, $q, $h );
		$b = hue_to_rgb( $p, $q, $h - 1/3 );
	}

	return array(
		round( $r * 255 ),
		round( $g * 255 ),
		round( $b * 255 )
	);
}

/**
 * Helper function for HSL conversion steps.
 *
 * @package NicheWP
 * @param float|int $p First color helper value.
 * @param float|int $q Second color helper value.
 * @param float|int $t Channel tint/hue component value.
 * @return float|int Calculated RGB color component.
 */
function hue_to_rgb( $p, $q, $t ) {
	if ( $t < 0 ) { $t += 1; }
	if ( $t > 1 ) { $t -= 1; }
	if ( $t < 1/6 ) { return $p + ( $q - $p ) * 6 * $t; }
	if ( $t < 1/2 ) { return $q; }
	if ( $t < 2/3 ) { return $p + ( $q - $p ) * ( 2/3 - $t ) * 6; }
	return $p;
}

if ( ! function_exists( __NAMESPACE__ . '\add_body_classes' ) ) :

	/**
	 * Appends dynamic canvas luminance, theme mode, and color scheme variant classes to the body class array.
	 *
	 * @package NicheWP
	 * @param array $classes Array of existing body class names.
	 * @return array Array of modified body class names.
	 */
	function add_body_classes( $classes ) {
		// DEVELOPER SWITCH: Set to true during active styling tests to bypass transient cache
		$bypass_cache = false; 

		$transient_key = get_transient_key();
		$theme_meta    = $bypass_cache ? false : get_transient( $transient_key );

		if ( false === $theme_meta || ! is_array( $theme_meta ) ) {

			// -----------------------------------------------------------------
			// 1. QUERY BACKGROUND CANVAS & CALCULATE LUMINANCE
			// -----------------------------------------------------------------
			$bg_color = wp_get_global_styles( 
				array( 'color', 'background' ), 
				array( 'transforms' => array( 'resolve-variables' ) ) 
			);
		
			// Default to white if styles are completely unassigned
			if ( empty( $bg_color ) || ! is_string( $bg_color ) ) {
				$bg_color = '#ffffff';
			}

			$r = 255; $g = 255; $b = 255;
			$bg_color = trim( $bg_color );

			// PARSE COLOR FORMATS (Hex, RGB, HSL)
			if ( 0 === strpos( $bg_color, '#' ) ) {
				$hex = str_replace( '#', '', $bg_color );
				if ( strlen( $hex ) === 3 ) {
					$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
					$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
					$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
				} elseif ( strlen( $hex ) === 6 ) {
					$r = hexdec( substr( $hex, 0, 2 ) );
					$g = hexdec( substr( $hex, 2, 2 ) );
					$b = hexdec( substr( $hex, 4, 2 ) );
				}
			} elseif ( preg_match( '/rgba?\(\s*([\d.]+)\s*[\s,]\s*([\d.]+)\s*[\s,]\s*([\d.]+)/i', $bg_color, $matches ) ) {
				$r = intval( $matches[1] );
				$g = intval( $matches[2] );
				$b = intval( $matches[3] );
			} elseif ( preg_match( '/hsla?\(\s*([\d.]+)\s*[\s,]\s*([\d.]+)%\s*[\s,]\s*([\d.]+)%/i', $bg_color, $matches ) ) {
				list( $r, $g, $b ) = hsl_to_rgb( floatval( $matches[1] ), floatval( $matches[2] ), floatval( $matches[3] ) );
			}
		
			// LUMINANCE CALCULATOR
			$rc = $r / 255; $gc = $g / 255; $bc = $b / 255;
			$rc = ( $rc <= 0.03928 ) ? $rc / 12.92 : pow( ( $rc + 0.055 ) / 1.055, 2.4 );
			$gc = ( $gc <= 0.03928 ) ? $gc / 12.92 : pow( ( $gc + 0.055 ) / 1.055, 2.4 );
			$bc = ( $bc <= 0.03928 ) ? $bc / 12.92 : pow( ( $bc + 0.055 ) / 1.055, 2.4 );
			$lightness = 0.2126 * $rc + 0.7152 * $gc + 0.0722 * $bc;
		
			$bg_class = ( $lightness < 0.5 ) ? 'is-dark-background' : 'is-light-background';

			// -----------------------------------------------------------------
			// 2. QUERY THEME ENGINE MODE & SCHEME VARIANT
			// -----------------------------------------------------------------
			$mode_setting = wp_get_global_settings( array( 'custom', 'color', 'theme', 'mode' ) );
			$mode_class   = ( ! empty( $mode_setting ) && is_string( $mode_setting ) ) ? $mode_setting : 'is-light-theme';
			
			$scheme_setting = wp_get_global_settings( array( 'custom', 'color', 'theme', 'scheme' ) );
			$scheme_slug    = ( ! empty( $scheme_setting ) && is_string( $scheme_setting ) ) ? sanitize_html_class( $scheme_setting ) : 'default';
			$scheme_class   = 'color-scheme-' . $scheme_slug;

			// PACK METADATA MATRIX
			$theme_meta = array(
				'bg_class'     => $bg_class,
				'mode_class'   => $mode_class,
				'scheme_class' => $scheme_class,
			);

			if ( ! $bypass_cache ) {
				set_transient( $transient_key, $theme_meta, 12 * HOUR_IN_SECONDS );
			}
		}

		// APPEND CLASSES TO BODY ARRAY
		if ( ! empty( $theme_meta['bg_class'] ) ) {
			$classes[] = $theme_meta['bg_class'];
		}
		if ( ! empty( $theme_meta['mode_class'] ) ) {
			$classes[] = $theme_meta['mode_class'];
		}
		if ( ! empty( $theme_meta['scheme_class'] ) ) {
			$classes[] = $theme_meta['scheme_class'];
		}
	
		return $classes;
	}
	
endif;

// -------------------------------------------------------------------------
// 2. AUTOMATED TRANSIENT CACHE FLUSHING REGISTRY
// -------------------------------------------------------------------------
add_action( 'after_switch_theme', __NAMESPACE__ . '\clear_lightness_transient' );
add_action( 'clean_theme_cache', __NAMESPACE__ . '\clear_lightness_transient' );
add_action( 'save_post_wp_global_styles', __NAMESPACE__ . '\clear_lightness_transient' );

if ( ! function_exists( __NAMESPACE__ . '\clear_lightness_transient' ) ) :

	/**
	 * Clears the lightness transient metadata cache for the active theme.
	 *
	 * @package NicheWP
	 * @return void
	 */
	function clear_lightness_transient() {
		delete_transient( get_transient_key() );
	}
endif;
