<?php
/**
 * Title: Cover Scroll Home Header
 * Description: Cover Scroll Home Header
 * Slug: lumina-nichewp/cover-scroll-home-header
 * Categories: lumina-nichewp, banner, media
 * Block Types: core/cover
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( "assets/images/pages/home-hero.webp" ) ); ?>","dimRatio":30,"isUserOverlayColor":true,"focalPoint":{"x":0.5,"y":0.5},"minHeight":100,"minHeightUnit":"vh","contentPosition":"center center","sizeSlug":"large","metadata":{"name":"Cover Scroll Home Header"},"align":"full","className":"is-dark is-style-pan-zoom","anchor":"cover-scroll-home-header"} -->
<div class="wp-block-cover alignfull is-dark is-style-pan-zoom" style="min-height:100vh" id="cover-scroll-home-header"><img class="wp-block-cover__image-background size-large" alt="" src="<?php echo esc_url( get_theme_file_uri( "assets/images/pages/home-hero.webp" ) ); ?>" style="object-position:50% 50%" data-object-fit="cover" data-object-position="50% 50%"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><div class="wp-block-cover__inner-container">

	<!-- wp:group {"className":"is-style-glass is-style-object-static"} -->
	<div class="wp-block-group is-style-glass is-style-object-static">
		<!-- wp:site-title {"isLink":false,"style":{"typography":{"textAlign":"center","lineHeight":"1.2"}},"fontSize":"huge"} /-->

		<!-- wp:site-tagline {"style":{"typography":{"textAlign":"center","lineHeight":"1.2"}},"fontSize":"x-large"} /-->

		<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.2","textAlign":"center"}},"fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size" style="line-height:1.2"><?php esc_html_e("Tailored visual storytelling and studio photography that transform moments into timeless imagery with intentional composition.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->

		<!-- wp:pattern {"slug":"lumina-nichewp/text-scroll-down"} /-->
	</div>
	<!-- /wp:group -->

</div></div>
<!-- /wp:cover -->

<!-- wp:pattern {"slug":"lumina-nichewp/hidden-content-start"} /-->