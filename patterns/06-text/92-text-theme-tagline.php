<?php
/**
 * Title: Theme Tagline
 * Description: Theme Tagline
 * Slug: lumina-nichewp/text-theme-tagline
 * Categories: lumina-nichewp, text
 * Block Types: 
 */

// Get the theme attributes
$theme = wp_get_theme();
?>

<!-- wp:group {"metadata":{"name":"Theme Tagline"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group">

<?php // Display the theme name with link
echo sprintf( 
	'<!-- wp:paragraph --><p>
<a href="%s" target="_blank">%s</a></p>
<!-- /wp:paragraph -->',
	$theme->get( 'ThemeURI' ) ?? 'https://nichewp.com/wordpress/lumina-nichewp',
	$theme->get( 'Name' ) ?? 'Lumina NicheWP'
);
?>
<!-- wp:paragraph -->
<p>theme by</p>
<!-- /wp:paragraph -->

<?php // Display the theme author with link
echo sprintf( 
	'<!-- wp:paragraph --><p>
<a href="%s" target="_blank">%s</a></p>
<!-- /wp:paragraph -->',
	$theme->get( 'AuthorURI' ) ?? 'https://nichewp.com/',
	$theme->get( 'Author' ) ?? 'NicheWP'
);
?>

</div>
<!-- /wp:group -->