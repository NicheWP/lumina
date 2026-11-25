<?php
/**
 * Title: Image Gallery Card
 * Description: Image Gallery Card
 * Slug: lumina-nichewp/image-gallery-card
 * Categories: lumina-nichewp, media
 * Block Types: core/gallery
 */
?>
<!-- wp:heading {"style":{"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e("Recent Additions", "lumina-nichewp"); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"metadata":{"name":"Image Gallery"},"className":"is-style-rounded-border","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"secondary-subtle","layout":{"type":"constrained"},"anchor":"image-gallery-1"} -->
<div id="image-gallery-1" class="wp-block-group is-style-rounded-border has-secondary-subtle-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:gallery {"columns":3,"randomOrder":true,"linkTo":"none","sizeSlug":"cropped-thumbnail","align":"wide","className":"is-style-image-border","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"}}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped is-style-image-border"><!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/gallery-1/01.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/gallery-1/02.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/gallery-1/03.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/gallery-1/04.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/gallery-1/05.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/gallery-1/06.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></div>
<!-- /wp:group -->