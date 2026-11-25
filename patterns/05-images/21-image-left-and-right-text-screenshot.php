<?php
/**
 * Title: Screenshot w/Left And Right Text
 * Description: Screenshot w/Left And Right Text
 * Slug: lumina-nichewp/image-left-and-right-text-screenshot
 * Categories: lumina-nichewp, image, media, text
 * Block Types: core/image, core/columns
 */
?>
<!-- wp:group {"metadata":{"categories":["lumina-nichewp","image"],"name":"Image with Left and Right Text"},"align":"full","className":"is-style-default","backgroundColor":"secondary-alt","layout":{"type":"constrained"},"anchor":"image-left-and-right-text"} -->
<div class="wp-block-group alignfull is-style-default has-secondary-alt-background-color has-background" id="image-left-and-right-text"><!-- wp:heading {"style":{"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e("Featured Spotlight", "lumina-nichewp"); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center","width":"25%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:25%"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Interactive Cards", "lumina-nichewp"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Container blocks carrying links or action buttons automatically respond with subtle lift and soft ambient shadows when hovered or tapped on mobile screens.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%","className":"is-style-first-on-mobile"} -->
<div class="wp-block-column is-style-first-on-mobile" style="flex-basis:50%"><!-- wp:image {"lightbox":{"enabled":true},"aspectRatio":"16/9","scale":"cover","sizeSlug":"large","linkDestination":"none","align":"center","className":"is-style-image-computer-screen"} -->
<figure class="wp-block-image aligncenter size-large is-style-image-computer-screen"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/screenshots/01.webp" ) ); ?>" alt="screenshot" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"25%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:25%"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Full Site Editing", "lumina-nichewp"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Swap or customize site headers, footers, post grids, and color schemes directly within the Site Editor. Easily keep your site modern and fresh without writing code.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->