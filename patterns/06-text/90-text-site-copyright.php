<?php
/**
 * Title: Lumina NicheWP Text Site Copyright
 * Description: Text Site Copyright
 * Slug: lumina-nichewp/text-site-copyright
 * Categories: lumina-nichewp, text
 */
?>

<!-- wp:group {"metadata":{"name":"Site Copyright"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group">
<!-- wp:paragraph -->
<p>© </p>
<!-- /wp:paragraph -->

<?php
echo sprintf( 
	'<!-- wp:paragraph --><p>%s</p>
<!-- /wp:paragraph -->',
	date( 'Y' )
);
?>

<?php
$site_name = esc_html( get_bloginfo( 'name' ) );
$home_url  = esc_url( home_url( '/' ) );
echo sprintf( 
	'<!-- wp:paragraph --><p><a href="%s" rel="home">%s</a></p><!-- /wp:paragraph -->',
	$home_url,
	$site_name
);
?>

</div>
<!-- /wp:group -->
