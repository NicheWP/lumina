<?php
/**
 * Title: Text Testimonial
 * Description: Text Testimonial
 * Slug: lumina/text-testimonial
 * Categories: lumina, text
 * Block Types: core/paragraph
 */
?>
<!-- wp:columns {"metadata":{"name":"Testimonial w/Avatar"},"className":"is-style-rounded-border is-style-center-on-mobile","backgroundColor":"secondary-subtle","anchor":"testimonial-with-avatar"} -->
<div class="wp-block-columns is-style-rounded-border is-style-center-on-mobile has-secondary-subtle-background-color has-background" id="testimonial-with-avatar"><!-- wp:column {"width":"25%"} -->
<div class="wp-block-column" style="flex-basis:25%"><!-- wp:image {"width":"150px","aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center","className":"is-style-rounded","style":{"layout":{"selfStretch":"fixedNoShrink","flexSize":"150px"}}} -->
<figure class="wp-block-image aligncenter is-resized size-full is-style-rounded"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/testimonials/male-01.webp" ) ); ?>" alt="Marcus Hayes" style="aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"75%"} -->
<div class="wp-block-column" style="flex-basis:75%"><!-- wp:quote {"className":"is-style-plain"} -->
<blockquote class="wp-block-quote is-style-plain"><!-- wp:paragraph {"style":{"typography":{"textAlign":"left"}}} -->
<p class="has-text-align-left"><?php esc_html_e("Working with the studio was a seamless collaboration. Their mastery of natural light and intentional composition brought a refined, editorial depth to our entire visual presence.", "lumina"); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e("— Marcus Hayes, ", "lumina"); ?><em><?php esc_html_e("Customer, Design Director", "lumina"); ?></em></cite></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->