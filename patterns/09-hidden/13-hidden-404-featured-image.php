<?php
/**
 * Title: Lumina 404 Hero Banner
 * Slug: lumina/hidden-404-featured-image
 * Categories: lumina, image
 * Inserter: false
 * Description: 404 Slim Featured Image
 */
$theme_image_url = esc_url( get_theme_file_uri( 'assets/images/pages/404-hero.webp' ) );
?>
<!-- wp:image {"sizeSlug":"large","lightbox":{"enabled":true},"aspectRatio":"16/4.5","scale":"cover","className":"is-style-pan-zoom-hover"} -->
<figure class="wp-block-image size-large is-style-pan-zoom-hover"><img src="<?php echo $theme_image_url; ?>" alt=""  style="aspect-ratio:16/4.5;object-fit:cover"/></figure>
<!-- /wp:image -->
