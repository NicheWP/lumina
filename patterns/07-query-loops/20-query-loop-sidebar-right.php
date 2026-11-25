<?php
/**
 * Title: Query Loop Sidebar Right Wide Image
 * Description: Query Loop Sidebar Right Wide Image
 * Slug: lumina-nichewp/query-loop-sidebar-right-wide
 * Categories: lumina-nichewp, query
 * Block Types: core/query
 */
?>
<!-- wp:query {"query":{"perPage":12,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"excludeCurrent":null},"lock":{"move":true,"remove":true},"layout":{"type":"constrained"}} -->
<div class="wp-block-query"><!-- wp:columns {"lock":{"move":true,"remove":true},"align":"wide","className":"main-content is-style-thick-gap","layout":{"type":"constrained"}} -->
<div class="wp-block-columns alignwide main-content is-style-thick-gap"><!-- wp:column {"lock":{"move":true,"remove":true},"className":"content-column","style":{"spacing":{"margin":{"top":"0"}}}} -->
<div class="wp-block-column content-column" style="margin-top:0">
<!-- wp:post-template {"lock":{"move":true,"remove":true}} -->
<!-- wp:template-part {"slug":"content-article-wide","theme":"lumina-nichewp"} /-->
<!-- /wp:post-template -->

<!-- wp:group {"lock":{"move":true,"remove":true},"metadata":{"name":"Query Pagination"},"className":"is-style-no-padding","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group is-style-no-padding"><!-- wp:query-pagination {"lock":{"move":true,"remove":true},"className":"is-content-justification-center is-layout-flex"} -->
<!-- wp:query-pagination-previous {"lock":{"move":true,"remove":true}} /-->

<!-- wp:query-pagination-numbers {"lock":{"move":true,"remove":true}} /-->

<!-- wp:query-pagination-next {"lock":{"move":true,"remove":true}} /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:group -->

<!-- wp:query-no-results {"lock":{"move":false,"remove":true}} -->
<!-- wp:paragraph {"metadata":{"name":"Hidden No Results Content","description":"Display no results found","categories":["lumina-nichewp","text"]},"style":{"typography":{"textAlign":"center"}}} -->
<p class="has-text-align-center"><?php esc_html_e("Nothing to see here, folks!", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dsidebar\u002d\u002dwidth)","lock":{"move":true,"remove":true},"metadata":{"name":"Sidebar Column"},"className":"sidebar-column"} -->
<div class="wp-block-column sidebar-column"><!-- wp:template-part {"slug":"sidebar","theme":"lumina-nichewp","lock":{"move":true,"remove":true}} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:query -->