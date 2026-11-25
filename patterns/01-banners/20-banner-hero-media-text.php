<?php
/**
 * Title: Banner Hero Media & Text
 * Description: Banner Hero Media & Text
 * Slug: lumina-nichewp/banner-hero-media-text
 * Categories: lumina-nichewp, banner, media, featured
 * Block Types: core/group, core/media-text
 */
?>

<!-- wp:group {"metadata":{"name":"Banner Hero Media \u0026 Text"},"align":"full","gradient":"secondary","layout":{"type":"constrained"},"anchor":"banner-hero-media-text"} -->
<div class="wp-block-group alignfull has-secondary-gradient-background has-background" id="banner-hero-media-text"><!-- wp:media-text {"align":"wide","mediaPosition":"right","linkDestination":"none","mediaType":"image","mediaWidth":45,"mediaSizeSlug":"cropped-large","imageFill":false,"className":"is-style-pan-zoom"} -->
<div class="wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile is-style-pan-zoom" style="grid-template-columns:auto 45%"><div class="wp-block-media-text__content">
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

</div><figure class="wp-block-media-text__media"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/pages/portfolio-hero.webp" ) ); ?>" alt="portfolio image"/></figure></div>
<!-- /wp:media-text --></div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina-nichewp/hidden-content-start"} /-->