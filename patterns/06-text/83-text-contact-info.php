<?php
/**
 * Title: Contact Info
 * Description: Contact Info with Site Title
 * Slug: lumina-nichewp/text-contact-info
 * Categories: lumina-nichewp, text
 * Block Types: core/paragraph
 */
?>
<!-- wp:group {"metadata":{"name":"Contact Info"},"className":"is-style-default","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-default">

<!-- wp:site-title {"level":3,"isLink":false} /-->

<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
<p class="is-style-link-no-underline"><?php esc_html_e("1234 US Highway 99", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline","style":{"spacing":{"margin":{"top":"0px"}}}} -->
<p class="is-style-link-no-underline" style="margin-top:0px"><?php esc_html_e("Anytown, USA 55555", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
<p class="is-style-link-no-underline" style="margin-top:var(--wp--preset--spacing--30)"><a href="#content-start">(555) 867-5309</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline","style":{"spacing":{"margin":{"top":"0px"}}}} -->
<p class="is-style-link-no-underline" style="margin-top:0px"><a href="#content-start"><?php esc_html_e("mail@example.com", "lumina-nichewp"); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:pattern {"slug":"lumina-nichewp/text-social-icons-neutral","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} /-->

</div>
<!-- /wp:group -->