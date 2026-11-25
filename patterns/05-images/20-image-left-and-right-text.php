<?php
/**
 * Title: Image w/Left And Right Text
 * Description: Image w/Left And Right Text
 * Slug: lumina-nichewp/image-left-and-right-text
 * Categories: lumina-nichewp, image, media, text
 * Block Types: core/image, core/columns
 */
?>
<!-- wp:group {"metadata":{"categories":["lumina-nichewp","image"],"name":"Image with Left and Right Text"},"align":"full","className":"is-style-default","backgroundColor":"secondary-alt","layout":{"type":"constrained"},"anchor":"image-left-and-right-text"} -->
<div class="wp-block-group alignfull is-style-default has-secondary-alt-background-color has-background" id="image-left-and-right-text">
<!-- wp:heading {"style":{"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e("Visual Storytelling", "lumina-nichewp"); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center","width":"25%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:25%"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Print & Media", "lumina-nichewp"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Tangible monographs, fine art prints, and archival press editions built with tactile depth and timeless color.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%","className":"is-style-first-on-mobile"} -->
<div class="wp-block-column is-style-first-on-mobile" style="flex-basis:50%">
<!-- wp:image {"lightbox":{"enabled":true},"aspectRatio":"16/9","scale":"cover","sizeSlug":"large","linkDestination":"none","align":"center","className":"is-style-image-border"} -->
<figure class="wp-block-image is-style-image-border aligncenter size-large">
<img src="<?php echo esc_url( get_theme_file_uri( "assets/images/pages/team-hero.webp" ) ); ?>" alt="Team Picture" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"25%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:25%"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Digital Canvas", "lumina-nichewp"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Fluid online galleries and responsive editorial layouts that present your narrative with spatial clarity and light.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->