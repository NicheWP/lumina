<?php
/**
 * Title: Query Loop 1 Column
 * Description: Query Loop 1 Column
 * Slug: lumina-nichewp/query-loop-1-column
 * Categories: lumina-nichewp, query
 * Block Types: core/query
 */
?>
<!-- wp:query {"query":{"perPage":"10","pages":0,"offset":0,"postType":"post","categoryIds":[],"tagIds":[],"order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"displayLayout":{"type":"flex","columns":1},"layout":{"type":"constrained"},"lock":{"move":true,"remove":true}} -->
<div class="wp-block-query">

	<!-- wp:post-template {"lock":{"move":true,"remove":true}} -->
		<!-- wp:template-part {"slug":"content-article","theme":"lumina-nichewp"} /-->
	<!-- /wp:post-template -->

<!-- wp:group {"lock":{"move":true,"remove":true},"metadata":{"name":"Query Pagination"},"className":"is-style-no-padding","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group is-style-no-padding">
		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"},"lock":{"move":true,"remove":true}} -->
			<!-- wp:query-pagination-previous {"lock":{"move":true,"remove":true}} /-->
			<!-- wp:query-pagination-numbers {"lock":{"move":true,"remove":true}} /-->
			<!-- wp:query-pagination-next {"lock":{"move":true,"remove":true}} /-->
		<!-- /wp:query-pagination -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query-no-results {"lock":{"move":false,"remove":true}} -->
		<!-- wp:pattern {"slug":"lumina-nichewp/hidden-no-results"} /-->
	<!-- /wp:query-no-results -->

</div>
<!-- /wp:query -->
