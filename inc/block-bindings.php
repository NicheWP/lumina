<?php
/**
 * File:	block-bindings.php
 * Theme:	Shared Block Binding Functions
 * 
 * @package NicheWP
 */

namespace NicheWP;

add_action( 'init', __NAMESPACE__ . '\register_block_bindings' );

if ( ! function_exists( __NAMESPACE__ . '\register_block_bindings' ) ) :
	/**
	 * Registers custom WordPress block binding source for Featured Image
	 * bound to the standard Image block. This is so we or users can add
	 * lightbox functionality to it. This is used in various Template Parts.
	 *
	 * @package NicheWP
	 * @return void
	 */
	function register_block_bindings() {
		register_block_bindings_source( 'lumina/featured-image', array(
			'label'              => __( 'Featured Image', 'lumina' ),
			'get_value_callback' => __NAMESPACE__ . '\featured_image_binding',
			'uses_context'       => array( 'postId' ),
		) );	
	}
endif;

if ( ! function_exists( __NAMESPACE__ . '\featured_image_binding' ) ) :
	 
	/**
	 * Callback handler for the 'lumina/featured-image' dynamic block binding.
	 * Performs a four-tier Post ID lookup to guarantee context inside template parts,
	 * falling back to default theme assets if no post thumbnail is set.
	 *
	 * @package NicheWP
	 * @param array<string, mixed> $source_args    Arguments passed from the block 
	 *		binding definition.
	 * @param \WP_Block            $block_instance The instance of the block being
	 * 		rendered.
	 * @param string               $attribute_name Target attribute being requested
	 * 		('url' or 'alt').
	 * @return string|null Resolved image URL, alt text string, or null if unresolvable.
	 */
	function featured_image_binding( $source_args, $block_instance, $attribute_name = 'url' ) {
	
		// 1. Four-tier Post ID lookup to guarantee context inside template parts
		$post_id = 0;
	
		if ( ! empty( $block_instance->context['postId'] ) ) {
			$post_id = (int) $block_instance->context['postId'];
		}
	
		if ( ! $post_id ) {
			$post_id = get_queried_object_id();
		}
	
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}
	
		if ( ! $post_id ) {
			global $post;
			if ( isset( $post->ID ) ) {
				$post_id = $post->ID;
			}
		}
	
		if ( ! $post_id ) {
			return null;
		}
	
		// Determine attribute name ('url' or 'alt')
		$target_attr = ! empty( $attribute_name ) ? $attribute_name : ( $source_args['attr'] ?? 'url' );
	
		// Check if testing override is active
		$force_override = defined( 'FORCE_DEFAULT_IMAGE' ) && FORCE_DEFAULT_IMAGE;
	
		// 2. Fetch REAL Featured Image (Skipped if testing override is set to true)
		if ( ! $force_override ) {
			$thumb_id = get_post_thumbnail_id( $post_id );
	
			if ( $thumb_id ) {
				if ( 'url' === $target_attr ) {
					$url = wp_get_attachment_image_url( $thumb_id, 'full' );
					if ( $url ) {
						return $url;
					}
				}
	
				if ( 'alt' === $target_attr ) {
					return get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ?: get_the_title( $post_id );
				}
			}
		}
	
		// 3. Fallback Engine: Triggered if no real image exists OR if FORCE_DEFAULT_IMAGE is true
		if ( function_exists( '\NicheWP\get_featured_image_fallback_data' ) ) {
			$fallback = \NicheWP\get_featured_image_fallback_data( $post_id );
			
			if ( 'url' === $target_attr ) {
				return $fallback['url'] ?? null;
			}
			
			if ( 'alt' === $target_attr ) {
				return $fallback['alt'] ?? get_the_title( $post_id );
			}
		}
	
		return null;
	}
endif;