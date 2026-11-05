<?php
/**
 * File:	front-page.php
 * Theme:	Lumina
 * 
 * The Front Page template file
 *
 * This template is written in PHP so it can conditionally handle the front page
 * of the website. It intentionally flips when index.html and home.html templates
 * get loaded.
 * 
 * If the user has the BLOG set as the front page, it loads the index.html 
 * template which includes the template part Home Page Content Top. This intentionally
 * bypasses home.html which we instead use to display the blog when a static home
 * page is set. Further, the Home Page Content Top only loads on the first page of 
 * the blog, not on subsequent pages.
 *
 * If the user has a STATIC PAGE set as the front page, then it loads that page,  
 * but also sets the blog page to use the home.html instead of the index.html 
 * template.
 *
 * @package lumina
 * @since 1.0
 */

// If blog on front page, then use index.html template. Note that this intentionally
// bypasses home.html which we use to display the blog when a static home page is set. 
// But only do this on the very first page.
if ( 'posts' == get_option( 'show_on_front' ) ) {

	// If not the first page, use the home.html template (which is the default behavior)
	if ( is_paged() ) {		
		include( get_query_template( 'home' ) );
	
	// If the very first page, use the index.html template
	} else {
		include( get_query_template( 'home', array('index') ) );
	}
    
// Otherwise, use the static front page's template as set by the user
} else {
    include( get_page_template() );
}