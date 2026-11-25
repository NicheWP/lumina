<?php
/**
 * Title: Columns Recent Posts 3 Columns
 * Description: Columns Recent Posts 3 Columns
 * Slug: lumina-nichewp/columns-recent-posts-3-columns
 * Categories: lumina-nichewp, column
 * Block Types: core/columns
 */
?>
<!-- wp:group {"metadata":{"name":"Columns 3 Recent Posts"},"align":"wide","layout":{"type":"constrained"},"anchor":"columns-3-recent-posts"} -->
<div class="wp-block-group alignwide" id="columns-3-recent-posts">
<!-- wp:heading {"align":"wide","className":"is-style-separator","style":{"typography":{"textAlign":"left"}},"anchor":"columns-3-recent-posts"} -->
<h2 class="wp-block-heading has-text-align-left alignwide is-style-separator" id="our-recent-posts"><?php esc_html_e("Journal & Studio Notes", "lumina-nichewp"); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"align":"wide","className":"is-style-default","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide is-style-default" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"style":{"typography":{"textAlign":"left"}}} -->
<p class="has-text-align-left"><?php esc_html_e("Reflections on art direction, light, composition, and visual storytelling...", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline","style":{"typography":{"textAlign":"right"}}} -->
<p class="has-text-align-right is-style-link-no-underline"><a href="/blog/"><?php esc_html_e("&gt; Read Journal", "lumina-nichewp"); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":19,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null,"parents":[],"format":[],"excludeCurrent":null},"align":"wide","className":"is-style-gutter-dividers"} -->
<div class="wp-block-query alignwide is-style-gutter-dividers"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"220px"}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/4.5","sizeSlug":"cropped-large","className":"is-style-default"} /-->

<!-- wp:post-title {"level":4,"isLink":true} /-->

<!-- wp:post-excerpt {"excerptLength":20,"className":"is-style-no-readmore"} /-->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p><?php esc_html_e("Explore our journal soon for ongoing studio notes and creative reflections...", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->