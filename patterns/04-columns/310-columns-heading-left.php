<?php
/**
 * Title: Lumina NicheWP Split Section (Heading Left & Content Right)
 * Slug: lumina-nichewp/columns-heading-left
 * Categories: lumina-nichewp, column, text
 * Block Types: core/columns, core/heading
 * Description: 33/67 column layout with a styled heading on the left and body content on the right.
 */
?>
<!-- wp:columns {"align":"wide","metadata":{"name":"Split w/Heading Left"}} -->
<div class="wp-block-columns alignwide">
	
	<!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"}} -->
	<div class="wp-block-column" style="flex-basis:33.33%">
		<!-- wp:heading {"className":"is-style-separator"} -->
		<h2 class="wp-block-heading is-style-separator"><?php esc_html_e( 'Section Title', 'lumina-nichewp' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:paragraph {"fontSize":"medium"} -->
		<p class="has-medium-font-size"><?php esc_html_e( 'Start typing your main content, insert a list, or drop in feature cards here...', 'lumina-nichewp' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->

</div>
<!-- /wp:columns -->