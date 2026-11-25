<?php
/**
 * Title: Cover Scroll Static Image
 * Description: Cover Scroll Static Image
 * Slug: lumina-nichewp/cover-scroll-static-image
 * Categories: lumina-nichewp, banner, media, featured
 * Block Types: core/cover
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( "assets/images/pages/portfolio-hero.webp" ) ); ?>","dimRatio":30,"isUserOverlayColor":true,"minHeight":480,"sizeSlug":"large","metadata":{"name":"Cover Scroll Static Image"},"align":"full","className":"is-dark is-style-pan-zoom","anchor":"cover-scroll-static-image"} -->
<div class="wp-block-cover alignfull is-dark is-style-pan-zoom" style="min-height:480px" id="cover-scroll-static-image"><img class="wp-block-cover__image-background size-large" alt="" src="<?php echo esc_url( get_theme_file_uri( "assets/images/pages/portfolio-hero.webp" ) ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><div class="wp-block-cover__inner-container">

	<!-- wp:group {"className":"is-style-glass is-style-object-static"} -->
	<div class="wp-block-group is-style-glass is-style-object-static">

		<!-- wp:heading {"placeholder":"Cover Image Title","fontSize":"huge","anchor":"title"} -->
<h2 id="title" class="wp-block-heading has-huge-font-size"><?php esc_html_e("Fine Art & Visual Studio", "lumina-nichewp"); ?></h2>
<!-- /wp:heading -->

		<!-- wp:paragraph {"metadata":{"name":"Subtitle"},"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"x-large","anchor":"subtitle"} -->
<p class="has-x-large-font-size" id="subtitle" style="line-height:1.2"><?php esc_html_e("Capturing light, depth, and story", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"large"} -->
<p class="has-large-font-size" style="line-height:1.2"><?php esc_html_e("Tailored visual storytelling and studio photography that transform moments into timeless imagery with intentional composition.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->

		<!-- wp:pattern {"slug":"lumina-nichewp/text-scroll-down"} /-->
	</div>
	<!-- /wp:group -->

</div></div>
<!-- /wp:cover -->

<!-- wp:pattern {"slug":"lumina-nichewp/hidden-content-start"} /-->