<?php
/**
 * File:        images.php
 * Theme:       Shared Media Functions
 *
 * Unified Media Architecture. Handles native image blocks,
 * cover toggles, media-text toggles, site logo fallbacks, lightboxes, and legacy post loops.
 *
 * @package     NicheWP
 */

namespace NicheWP;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * TEST & OVERRIDE CONFIGURATION
 * Set to true to force default fallback images across posts or site logos for testing.
 * Set to false for normal production operation.
 */
if ( ! defined( 'FORCE_DEFAULT_IMAGE' ) ) {
	define( 'FORCE_DEFAULT_IMAGE', false ); // Set to false for production
}

if ( ! defined( 'FORCE_DEFAULT_SITE_LOGO' ) ) {
	define( 'FORCE_DEFAULT_SITE_LOGO', false ); // Set to false for production
}

/**
 * DEFAULT MEDIA ASSETS & DIMENSIONS CONFIGURATION
 * Fallback relative paths and default pixel dimensions for site logo and featured images.
 */
if ( ! defined( 'DEFAULT_SITE_LOGO' ) ) {
	define( 'DEFAULT_SITE_LOGO', 'assets/images/logo/site-logo.webp' );
}

if ( ! defined( 'DEFAULT_SITE_LOGO_WIDTH' ) ) {
	define( 'DEFAULT_SITE_LOGO_WIDTH', 56 );
}

if ( ! defined( 'DEFAULT_SITE_LOGO_HEIGHT' ) ) {
	define( 'DEFAULT_SITE_LOGO_HEIGHT', 56 );
}

if ( ! defined( 'DEFAULT_FEATURED_IMAGE' ) ) {
	define( 'DEFAULT_FEATURED_IMAGE', 'assets/images/pages/home-hero.webp' );
}

/**
 * 1A. THE FEATURED IMAGE ENGINE CORE
 * Dynamically scans Lumina's asset directory for fallback featured images.
 */
if ( ! function_exists( __NAMESPACE__ . '\get_featured_image_fallback_data' ) ) {
	function get_featured_image_fallback_data( $post_id = null ) {

		$pid = $post_id ? $post_id : get_the_ID();
		
		$base_path        = 'assets/images/';

		$exclude_dirs     = [
			'about',
			'pages',
			'screenshots',
			'team',
			'testimonials',
			'logo'
		]; 

		$exclude_prefixes = []; 
		
		$allowed_extensions = [ 'jpg', 'jpeg', 'png', 'gif', 'webp' ];

		$true_default       = defined( 'DEFAULT_FEATURED_IMAGE' ) ? DEFAULT_FEATURED_IMAGE : 'assets/images/pages/home-hero.webp';

		$global_settings = function_exists( 'wp_get_global_settings' ) ? wp_get_global_settings() : [];
		$custom_settings = $global_settings['custom'] ?? [];
		$theme_custom    = $custom_settings['color']['theme'] ?? [];

		$target_folders = [];

		foreach ( ['imageFolders', 'imageFolder' ] as $key ) {
			if ( ! empty( $theme_custom[ $key ] ) ) {
				$val = $theme_custom[ $key ];
				if ( is_array( $val ) ) {
					$target_folders = array_merge( $target_folders, $val );
				} elseif ( is_string( $val ) ) {
					$target_folders[] = $val;
				}
			}
		}

		foreach ( $theme_custom as $key => $val ) {
			if ( preg_match( '/^image[-_]?folder[-_]?\d+$/i', $key ) && ! empty( $val ) ) {
				if ( is_array( $val ) ) {
					$target_folders = array_merge( $target_folders, $val );
				} elseif ( is_string( $val ) ) {
					$target_folders[] = $val;
				}
			}
		}

		$target_folders = array_filter( array_unique( $target_folders ) );

		if ( empty( $target_folders ) && ! empty( $theme_custom['scheme'] ) ) {
			$target_folders[] = $theme_custom['scheme'];
		}

		$target_keywords = [];
		$keyword_keys    = [ 'imageKeywords', 'image-keywords', 'image_keywords', 'imageKeyword', 'image-keyword', 'keywords' ];
		
		$settings_sources = array_filter( [ $theme_custom, $custom_settings ] );

		foreach ( $settings_sources as $source ) {
			if ( ! is_array( $source ) ) {
				continue;
			}

			foreach ( $keyword_keys as $key ) {
				if ( ! empty( $source[ $key ] ) ) {
					$val = $source[ $key ];
					if ( is_array( $val ) ) {
						$target_keywords = array_merge( $target_keywords, $val );
					} elseif ( is_string( $val ) ) {
						$target_keywords[] = $val;
					}
				}
			}

			foreach ( $source as $key => $val ) {
				if ( preg_match( '/^image[-_]?keyword[s]?[-_]?\d+$/i', $key ) && ! empty( $val ) ) {
					if ( is_array( $val ) ) {
						$target_keywords = array_merge( $target_keywords, $val );
					} elseif ( is_string( $val ) ) {
						$target_keywords[] = $val;
					}
				}
			}
		}

		$target_keywords = array_filter( array_map( 'trim', array_unique( $target_keywords ) ) );

		$child_theme_root = wp_normalize_path( get_stylesheet_directory() );
		$full_base_path   = trailingslashit( $child_theme_root ) . $base_path;
		$paths_to_scan    = [];

		if ( ! empty( $target_folders ) ) {
			foreach ( $target_folders as $folder ) {
				$folder_path = trailingslashit( $full_base_path ) . trim( $folder, '/' ) . '/';
				if ( is_dir( $folder_path ) ) {
					$paths_to_scan[] = $folder_path;
				}
			}
		}

		if ( empty( $paths_to_scan ) && is_dir( $full_base_path ) ) {
			$subdirs = glob( trailingslashit( $full_base_path ) . '*', GLOB_ONLYDIR );
			if ( ! empty( $subdirs ) ) {
				foreach ( $subdirs as $subdir ) {
					$folder_name = basename( $subdir );
					if ( ! in_array( $folder_name, $exclude_dirs, true ) ) {
						$paths_to_scan[] = trailingslashit( $subdir );
					}
				}
			}
		}

		$images = [];

		$scan_extensions = array_unique( array_merge( $allowed_extensions, [ 'svg' ] ) );

		foreach ( $paths_to_scan as $scan_path ) {
			$matched_files = [];

			// Safe single-extension glob matching without GLOB_BRACE for WebAssembly/musl libc compatibility
			foreach ( $scan_extensions as $ext ) {
				$found = glob( trailingslashit( $scan_path ) . '*.' . ltrim( $ext, '.' ) );
				if ( is_array( $found ) ) {
					$matched_files = array_merge( $matched_files, $found );
				}
			}

			if ( ! empty( $matched_files ) ) {
				foreach ( $matched_files as $file ) {
					if ( is_file( $file ) ) {
						$filename       = basename( $file );
						$should_exclude = false;

						foreach ( $exclude_prefixes as $prefix ) {
							if ( ! empty( $prefix ) && strpos( $filename, $prefix ) === 0 ) {
								$should_exclude = true;
								break;
							}
						}

						if ( ! $should_exclude && ! empty( $target_keywords ) ) {
							$has_keyword_match = false;
							foreach ( $target_keywords as $kw ) {
								if ( ! empty( $kw ) && stripos( $filename, $kw ) !== false ) {
									$has_keyword_match = true;
									break;
								}
							}
							if ( ! $has_keyword_match ) {
								$should_exclude = true;
							}
						}

						if ( ! $should_exclude ) {
							$normalized_file = wp_normalize_path( $file );
							$images[]        = ltrim( str_replace( $child_theme_root, '', $normalized_file ), '/' );
						}
					}
				}
			}
		}

		$images = array_values( array_unique( $images ) );

		if ( ! empty( $images ) ) {
			$hash_seed            = 'lumina_' . $pid;
			$hashed_val           = abs( crc32( $hash_seed ) );
			$last_digit           = $hashed_val % count( $images );
			$target_relative_path = $images[ $last_digit ];
		} else {
			$target_relative_path = $true_default;
		}

		$default_url = get_stylesheet_directory_uri() . '/' . $target_relative_path;
		$default_url = apply_filters( 'lumina_default_image_url', $default_url, $pid );

		$image_alt = esc_attr( get_the_title( $pid ) );
		$image_alt = apply_filters( 'lumina_default_image_alt', $image_alt, $pid );

		return [
			'url' => $default_url,
			'alt' => $image_alt
		];
	}
}

/**
 * 1B. THE SITE LOGO ENGINE CORE
 * Resolves default site logo from theme.json (custom.color.theme.logoDefault)
 * with a fallback to DEFAULT_SITE_LOGO, verifying physical file existence on disk.
 */
if ( ! function_exists( __NAMESPACE__ . '\get_default_site_logo_url' ) ) {
	function get_default_site_logo_url() {
		$true_default = defined( 'DEFAULT_SITE_LOGO' ) ? DEFAULT_SITE_LOGO : 'assets/images/logo/site-logo.webp';

		$global_settings = function_exists( 'wp_get_global_settings' ) ? wp_get_global_settings() : [];
		$custom_settings = $global_settings['custom'] ?? [];
		$theme_custom    = $custom_settings['color']['theme'] ?? [];

		$logo_setting = $theme_custom['logoDefault'] ?? $theme_custom['logo_default'] ?? $theme_custom['logo'] ?? '';

		$resolved_path = '';

		// 1. Check custom theme.json setting path first
		if ( ! empty( $logo_setting ) && is_string( $logo_setting ) ) {
			$check_relative = ltrim( $logo_setting, '/' );
			if ( file_exists( get_theme_file_path( $check_relative ) ) ) {
				$resolved_path = $check_relative;
			}
		}

		// 2. Fall back to DEFAULT_SITE_LOGO constant if theme.json path is empty or invalid
		if ( empty( $resolved_path ) ) {
			$check_relative = ltrim( $true_default, '/' );
			if ( file_exists( get_theme_file_path( $check_relative ) ) ) {
				$resolved_path = $check_relative;
			}
		}

		// 3. If no physical file exists on disk, return empty string
		if ( empty( $resolved_path ) ) {
			return apply_filters( 'lumina_default_site_logo_url', '' );
		}

		$logo_url = get_theme_file_uri( $resolved_path );

		return apply_filters( 'lumina_default_site_logo_url', $logo_url );
	}
}

/**
 * 1C. LOGO DIMENSIONS RESOLVER
 * Resolves intrinsic or configured dimensions for the fallback site logo.
 */
if ( ! function_exists( __NAMESPACE__ . '\get_default_site_logo_dimensions' ) ) {
	function get_default_site_logo_dimensions( $target_width = 0 ) {
		$true_default_w = defined( 'DEFAULT_SITE_LOGO_WIDTH' ) ? (int) DEFAULT_SITE_LOGO_WIDTH : 56;
		$true_default_h = defined( 'DEFAULT_SITE_LOGO_HEIGHT' ) ? (int) DEFAULT_SITE_LOGO_HEIGHT : 56;

		$global_settings = function_exists( 'wp_get_global_settings' ) ? wp_get_global_settings() : [];
		$custom_settings = $global_settings['custom'] ?? [];
		$theme_custom    = $custom_settings['color']['theme'] ?? [];
		$logo_setting    = $theme_custom['logoDefault'] ?? $theme_custom['logo_default'] ?? $theme_custom['logo'] ?? '';
		
		$true_default  = defined( 'DEFAULT_SITE_LOGO' ) ? DEFAULT_SITE_LOGO : 'assets/images/logo/site-logo.webp';
		$relative_path = ! empty( $logo_setting ) && is_string( $logo_setting ) ? ltrim( $logo_setting, '/' ) : ltrim( $true_default, '/' );
		$file_path     = get_theme_file_path( $relative_path );

		$orig_w = 0;
		$orig_h = 0;

		if ( file_exists( $file_path ) && function_exists( 'wp_getimagesize' ) ) {
			$info = wp_getimagesize( $file_path );
			if ( $info ) {
				$orig_w = (int) $info[0];
				$orig_h = (int) $info[1];
			}
		}

		if ( ! $orig_w || ! $orig_h ) {
			$orig_w = $true_default_w;
			$orig_h = $true_default_h;
		}

		if ( $target_width > 0 ) {
			$width  = (int) $target_width;
			$height = (int) round( $target_width * ( $orig_h / $orig_w ) );
		} else {
			$width  = $orig_w;
			$height = $orig_h;
		}

		return [
			'width'  => $width,
			'height' => $height,
		];
	}
}

/**
 * 2A. THE COVER TOGGLE INTERCEPT
 * Swaps image src or inline background URL while stripping responsive srcset attributes.
 */
if ( ! function_exists( __NAMESPACE__ . '\filter_cover_block_fallback' ) ) {
	function filter_cover_block_fallback( $block_content, $block ) {
		$force_override = defined( 'FORCE_DEFAULT_IMAGE' ) && FORCE_DEFAULT_IMAGE;

		if ( ! empty( $block['attrs']['useFeaturedImage'] ) && ( $force_override || ! get_post_thumbnail_id( get_the_ID() ) ) ) {
			$fallback = get_featured_image_fallback_data( get_the_ID() );
			
			if ( preg_match( '/src=["\']([^"\']*)["\']/i', $block_content ) ) {
				$block_content = preg_replace( '/src=["\']([^"\']*)["\']/i', 'src="' . esc_url( $fallback['url'] ) . '"', $block_content );
				$block_content = preg_replace( '/\s+srcset=["\']([^"\']*)["\']/i', '', $block_content );
				$block_content = preg_replace( '/\s+sizes=["\']([^"\']*)["\']/i', '', $block_content );
			}
			if ( preg_match( '/url\([^)]*\)/i', $block_content ) ) {
				$block_content = preg_replace( '/url\([^)]*\)/', 'url(' . esc_url( $fallback['url'] ) . ')', $block_content );
			}
		}
		return $block_content;
	}
	add_filter( 'render_block_core/cover', __NAMESPACE__ . '\filter_cover_block_fallback', 10, 2 );
}

/**
 * 2B. THE MEDIA & TEXT TOGGLE INTERCEPT
 * Swaps src or background URL on existing markup while preserving block dimensions.
 */
if ( ! function_exists( __NAMESPACE__ . '\filter_media_text_block_fallback' ) ) {
	function filter_media_text_block_fallback( $block_content, $block ) {
		$force_override = defined( 'FORCE_DEFAULT_IMAGE' ) && FORCE_DEFAULT_IMAGE;

		if ( ! empty( $block['attrs']['useFeaturedImage'] ) && ( $force_override || ! get_post_thumbnail_id( get_the_ID() ) ) ) {
			$fallback = get_featured_image_fallback_data( get_the_ID() );

			// 1. Handle inline background images (if imageFill mode is enabled)
			if ( preg_match( '/url\([^)]*\)/i', $block_content ) ) {
				$block_content = preg_replace( '/url\([^)]*\)/', 'url(' . esc_url( $fallback['url'] ) . ')', $block_content );
			}

			// 2. If an <img> tag already exists inside the block, swap its src & strip srcset/sizes
			if ( preg_match( '/<img[^>]+>/i', $block_content ) ) {
				$block_content = preg_replace( '/src=["\']([^"\']*)["\']/i', 'src="' . esc_url( $fallback['url'] ) . '"', $block_content );
				$block_content = preg_replace( '/\s+srcset=["\']([^"\']*)["\']/i', '', $block_content );
				$block_content = preg_replace( '/\s+sizes=["\']([^"\']*)["\']/i', '', $block_content );
			} else {
				// 3. If core rendered an empty <figure> wrapper, inject the fallback <img> tag directly
				$img_tag = sprintf(
					'<img src="%s" alt="%s" class="wp-post-image" />',
					esc_url( $fallback['url'] ),
					esc_attr( $fallback['alt'] )
				);

				$block_content = preg_replace(
					'/(<figure[^>]*class=["\'][^"\']*wp-block-media-text__media[^"\']*["\'][^>]*>)([\s\S]*?)(<\/figure>)/i',
					'$1' . $img_tag . '$3',
					$block_content
				);
			}
		}
		return $block_content;
	}
	add_filter( 'render_block_core/media-text', __NAMESPACE__ . '\filter_media_text_block_fallback', 10, 2 );
}

/**
 * 2C. THE SITE LOGO BLOCK INTERCEPT
 * Governed strictly by FORCE_DEFAULT_SITE_LOGO or missing custom logo. Swaps src on existing markup
 * while ensuring width & height attributes are explicitly output to prevent CLS.
 */
if ( ! function_exists( __NAMESPACE__ . '\filter_site_logo_block_fallback' ) ) {
	function filter_site_logo_block_fallback( $block_content, $block ) {
		$force_override = defined( 'FORCE_DEFAULT_SITE_LOGO' ) && FORCE_DEFAULT_SITE_LOGO;

		if ( $force_override || ! has_custom_logo() ) {
			$logo_url = get_default_site_logo_url();

			if ( empty( $logo_url ) ) {
				return $block_content;
			}

			$target_width = ! empty( $block['attrs']['width'] ) ? (int) $block['attrs']['width'] : 0;
			$dims         = get_default_site_logo_dimensions( $target_width );
			$width        = $dims['width'];
			$height       = $dims['height'];

			if ( preg_match( '/<img[^>]+>/i', $block_content ) ) {
				$block_content = preg_replace( '/src=["\']([^"\']*)["\']/i', 'src="' . esc_url( $logo_url ) . '"', $block_content );
				$block_content = preg_replace( '/\s+srcset=["\']([^"\']*)["\']/i', '', $block_content );
				$block_content = preg_replace( '/\s+sizes=["\']([^"\']*)["\']/i', '', $block_content );

				if ( preg_match( '/width=["\']([^"\']*)["\']/i', $block_content ) ) {
					if ( $target_width > 0 ) {
						$block_content = preg_replace( '/width=["\']([^"\']*)["\']/i', 'width="' . $width . '"', $block_content );
					}
				} else {
					$block_content = preg_replace( '/<img\s+/i', '<img width="' . $width . '" ', $block_content );
				}

				if ( preg_match( '/height=["\']([^"\']*)["\']/i', $block_content ) ) {
					if ( $target_width > 0 ) {
						$block_content = preg_replace( '/height=["\']([^"\']*)["\']/i', 'height="' . $height . '"', $block_content );
					}
				} else {
					$block_content = preg_replace( '/<img\s+/i', '<img height="' . $height . '" ', $block_content );
				}
			} else {
				$site_name = esc_attr( get_bloginfo( 'name' ) );
				$home_url  = esc_url( home_url( '/' ) );

				$width_attr  = sprintf( 'width="%d"', $width );
				$height_attr = sprintf( 'height="%d"', $height );
				$style_attr  = $target_width ? sprintf( 'style="width:%dpx;"', $target_width ) : '';

				$img_html = sprintf(
					'<a href="%s" class="custom-logo-link" rel="home"><img src="%s" class="custom-logo" alt="%s" decoding="async" %s %s %s /></a>',
					$home_url,
					esc_url( $logo_url ),
					$site_name,
					$width_attr,
					$height_attr,
					$style_attr
				);

				if ( preg_match( '/(<(?:div|figure)[^>]*>)([\s\S]*?)(<\/(?:div|figure)>)/i', $block_content ) ) {
					$block_content = preg_replace(
						'/(<(?:div|figure)[^>]*>)([\s\S]*?)(<\/(?:div|figure)>)/i',
						'$1' . $img_html . '$3',
						$block_content
					);
				} else {
					$block_content = sprintf( '<div class="wp-block-site-logo">%s</div>', $img_html );
				}
			}
		}

		return $block_content;
	}
	add_filter( 'render_block_core/site-logo', __NAMESPACE__ . '\filter_site_logo_block_fallback', 10, 2 );
}

/**
 * 2D. THE LEGACY CUSTOM LOGO INTERCEPT
 * Governed strictly by FORCE_DEFAULT_SITE_LOGO or missing custom logo.
 */
if ( ! function_exists( __NAMESPACE__ . '\filter_get_custom_logo_fallback' ) ) {
	function filter_get_custom_logo_fallback( $html, $blog_id = null ) {
		$force_override = defined( 'FORCE_DEFAULT_SITE_LOGO' ) && FORCE_DEFAULT_SITE_LOGO;

		if ( $force_override || ! has_custom_logo() ) {
			$logo_url = get_default_site_logo_url();

			if ( empty( $logo_url ) ) {
				return $html;
			}

			$dims   = get_default_site_logo_dimensions();
			$width  = $dims['width'];
			$height = $dims['height'];

			if ( ! empty( $html ) && preg_match( '/<img[^>]+>/i', $html ) ) {
				$html = preg_replace( '/src=["\']([^"\']*)["\']/i', 'src="' . esc_url( $logo_url ) . '"', $html );
				$html = preg_replace( '/\s+srcset=["\']([^"\']*)["\']/i', '', $html );
				$html = preg_replace( '/\s+sizes=["\']([^"\']*)["\']/i', '', $html );

				if ( ! preg_match( '/width=["\']([^"\']*)["\']/i', $html ) ) {
					$html = preg_replace( '/<img\s+/i', '<img width="' . $width . '" ', $html );
				}
				if ( ! preg_match( '/height=["\']([^"\']*)["\']/i', $html ) ) {
					$html = preg_replace( '/<img\s+/i', '<img height="' . $height . '" ', $html );
				}
			} else {
				$site_name = esc_attr( get_bloginfo( 'name' ) );
				$home_url  = esc_url( home_url( '/' ) );

				$html = sprintf(
					'<a href="%s" class="custom-logo-link" rel="home" itemprop="url"><img src="%s" class="custom-logo" alt="%s" width="%d" height="%d" itemprop="logo" decoding="async" /></a>',
					$home_url,
					esc_url( $logo_url ),
					$site_name,
					$width,
					$height
				);
			}
		}

		return $html;
	}
	add_filter( 'get_custom_logo', __NAMESPACE__ . '\filter_get_custom_logo_fallback', 10, 2 );
}

/**
 * Helper: Dynamically resolves width and height for standard or custom registered image sizes.
 */
if ( ! function_exists( __NAMESPACE__ . '\get_registered_image_size_dimensions' ) ) {
	function get_registered_image_size_dimensions( $size ) {
		if ( is_array( $size ) ) {
			return [
				'width'  => isset( $size[0] ) ? (int) $size[0] : 0,
				'height' => isset( $size[1] ) ? (int) $size[1] : 0,
			];
		}

		// 1. Core default sizes stored in options
		if ( in_array( $size, [ 'thumbnail', 'medium', 'medium_large', 'large' ], true ) ) {
			return [
				'width'  => (int) get_option( "{$size}_size_w" ),
				'height' => (int) get_option( "{$size}_size_h" ),
			];
		}

		// 2. Custom registered theme sizes (add_image_size / set_post_thumbnail_size)
		$additional_sizes = function_exists( 'wp_get_additional_image_sizes' ) ? wp_get_additional_image_sizes() : [];
		if ( isset( $additional_sizes[ $size ] ) ) {
			return [
				'width'  => (int) $additional_sizes[ $size ]['width'],
				'height' => (int) $additional_sizes[ $size ]['height'],
			];
		}

		return [ 'width' => 0, 'height' => 0 ];
	}
}

/**
 * 3. THE POST THUMBNAIL / FEATURED IMAGE INTERCEPT
 */
if ( ! function_exists( __NAMESPACE__ . '\filter_legacy_post_thumbnail_html' ) ) {
	function filter_legacy_post_thumbnail_html( $html, $pid, $post_thumbnail_id, $size, $attr ) {
		$force_override = defined( 'FORCE_DEFAULT_IMAGE' ) && FORCE_DEFAULT_IMAGE;

		if ( $force_override || ! $post_thumbnail_id ) {
			$fallback = get_featured_image_fallback_data( $pid );

			// 1. If Core already generated an <img> tag, perform a surgical src/alt swap, preserving existing attributes
			if ( ! empty( $html ) && preg_match( '/<img[^>]+>/i', $html ) ) {
				$html = preg_replace( '/src=["\']([^"\']*)["\']/i', 'src="' . esc_url( $fallback['url'] ) . '"', $html );

				if ( preg_match( '/alt=["\']([^"\']*)["\']/i', $html ) ) {
					$html = preg_replace( '/alt=["\']([^"\']*)["\']/i', 'alt="' . esc_attr( $fallback['alt'] ) . '"', $html );
				}

				$html = preg_replace( '/\s+srcset=["\']([^"\']*)["\']/i', '', $html );
				$html = preg_replace( '/\s+sizes=["\']([^"\']*)["\']/i', '', $html );

				return $html;
			}

			// 2. Generate markup from scratch ONLY if no <img> exists (post missing featured image)
			$dims   = get_registered_image_size_dimensions( $size );
			$width  = $dims['width'];
			$height = $dims['height'];

			// Physical File Fallback: If size is unconstrained, read intrinsic dimensions of the fallback asset file on disk
			if ( ! $width || ! $height ) {
				$relative_path = str_replace( get_stylesheet_directory_uri() . '/', '', $fallback['url'] );
				$file_path     = get_theme_file_path( $relative_path );

				if ( file_exists( $file_path ) && function_exists( 'wp_getimagesize' ) ) {
					$image_info = wp_getimagesize( $file_path );
					if ( $image_info ) {
						$width  = $image_info[0];
						$height = $image_info[1];
					}
				}
			}

			// Format width/height attributes if resolved
			$dim_attrs = ( $width && $height ) ? sprintf( 'width="%d" height="%d"', $width, $height ) : '';

			// Assemble CSS classes
			$image_class = $size ? "attachment-{$size} size-{$size} wp-post-image" : 'wp-post-image';
			if ( is_array( $attr ) && ! empty( $attr['class'] ) ) {
				$image_class .= ' ' . $attr['class'];
			}

			// Assemble inline styles
			$image_style = ( is_array( $attr ) && ! empty( $attr['style'] ) ) ? sprintf( ' style="%s"', esc_attr( $attr['style'] ) ) : '';

			return sprintf(
				'<img loading="lazy" decoding="async" src="%s" alt="%s" class="%s" %s%s />',
				esc_url( $fallback['url'] ),
				esc_attr( $fallback['alt'] ),
				esc_attr( trim( $image_class ) ),
				$dim_attrs,
				$image_style
			);
		}

		return $html;
	}
	add_filter( 'post_thumbnail_html', __NAMESPACE__ . '\filter_legacy_post_thumbnail_html', 10, 5 );
}

/**
 * 4. FORCE TRUE FOR WRAPPERS CONSISTENCY
 */
if ( ! function_exists( __NAMESPACE__ . '\has_post_thumbnail_fallback' ) ) {
	function has_post_thumbnail_fallback( $has_thumbnail, $post, $thumbnail_id ) {
		return true;
	}
	add_filter( 'has_post_thumbnail', __NAMESPACE__ . '\has_post_thumbnail_fallback', 10, 3 );
}
