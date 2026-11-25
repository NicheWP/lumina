<?php
/**
 * Title: Banner Home Hero Media & Text
 * Description: Banner Home Hero Media & Text
 * Slug: lumina-nichewp/banner-home-hero-media-text
 * Categories: lumina-nichewp, banner, media
 * Block Types: core/group, core/media-text
 */
?>
<!-- wp:group {"metadata":{"name":"Home Banner Media \u0026 Text"},"align":"full","gradient":"primary","layout":{"type":"constrained"},"anchor":"banner-home-hero-media-text"} -->
<div class="wp-block-group alignfull has-primary-gradient-background has-background" id="banner-home-hero-media-text">
	<!-- wp:media-text {"align":"wide","mediaPosition":"right","linkDestination":"none","mediaType":"image","mediaWidth":45,"mediaSizeSlug":"cropped-large","imageFill":false,"className":"is-style-pan-zoom is-style-default"} -->
	<div class="wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile is-style-pan-zoom is-style-default" style="grid-template-columns:auto 45%">
		<div class="wp-block-media-text__content">
			<!-- wp:site-title {"isLink":false,"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"huge"} /-->

			<!-- wp:site-tagline {"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"x-large"} /-->

			<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"large"} -->
<p class="has-large-font-size" style="line-height:1.2"><?php esc_html_e("Tailored visual storytelling and studio photography that transform moments into timeless imagery with intentional composition.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->

			<!-- wp:pattern {"slug":"lumina-nichewp/text-scroll-down"} /-->
		</div>
		<figure class="wp-block-media-text__media">
			<img src="<?php echo esc_url( get_theme_file_uri( "assets/images/pages/home-hero.webp" ) ); ?>" alt=""/>
		</figure>
	</div>
	<!-- /wp:media-text -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina-nichewp/hidden-content-start"} /-->