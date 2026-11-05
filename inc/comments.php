<?php
/**
 * File:        inc/comments.php
 * Theme:       Shared Comments Engine
 *
 * Purge empty Comments Template Part from DOM when comments are closed and empty.
 *
 * @package     NicheWP
 */

declare(strict_types=1);

namespace NicheWP;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( __NAMESPACE__ . '\purge_empty_comments_template_part' ) ) :

	/**
	 * Removes the Comments template part from rendered output if it contains no functional HTML tags.
	 *
	 * @package NicheWP
	 * @param string               $block_content The block's rendered HTML.
	 * @param array<string, mixed> $block         The block instance data.
	 * @return string Filtered block markup or empty string when no comment content exists.
	 */
	function purge_empty_comments_template_part( string $block_content, array $block ): string {
		// Target strictly the comments template part wrapper[span_2](start_span)[span_2](end_span)
		if ( isset( $block['blockName'], $block['attrs']['slug'] ) 
			&& 'core/template-part' === $block['blockName'] 
			&& 'comments' === $block['attrs']['slug'] 
		) {
			// Strip structural wrapper divs to verify if real form or content elements exist
			$meaningful_content = trim( 
				strip_tags( 
					$block_content, 
					'<form><input><textarea><ol><ul><p><h1><h2><h3><h4><h5><h6><a><button>' 
				) 
			);
	
			// Return an empty string if no functional comment markup exists
			if ( empty( $meaningful_content ) ) {
				return '';
			}
		}
	
		return $block_content;
	}
endif;
	
add_filter( 'render_block', __NAMESPACE__ . '\purge_empty_comments_template_part', 10, 2 );
