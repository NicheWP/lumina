<?php
/**
 * Title: Page Lumina NicheWP
 * Description: Home Page with Lumina NicheWP Theme Content
 * Slug: lumina-nichewp/page-lumina-nichewp
 * Categories: lumina-nichewp, page
 * Block Types: core/post-content
 */
?>
<!-- wp:group {"metadata":{"name":"Home Banner Media \u0026 Text"},"align":"full","gradient":"primary","layout":{"type":"constrained"},"anchor":"banner-home-hero-media-text"} -->
<div class="wp-block-group alignfull has-primary-gradient-background has-background" id="banner-home-hero-media-text">
	<!-- wp:media-text {"align":"wide","mediaPosition":"right","linkDestination":"none","mediaType":"image","mediaWidth":45,"mediaSizeSlug":"cropped-large","imageFill":false,"className":"is-style-pan-zoom is-style-default"} -->
	<div class="wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile is-style-pan-zoom is-style-default" style="grid-template-columns:auto 45%">
		<div class="wp-block-media-text__content">
			<!-- wp:site-title {"isLink":false,"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"huge"} /-->

			<!-- wp:site-tagline {"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"x-large"} /-->

			<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"large"} -->
<p class="has-large-font-size" style="line-height:1.2"><?php esc_html_e("Lumina NicheWP is a refined modern theme inspired by the colors, light, depth and motion of the environment around us.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->

			<!-- wp:pattern {"slug":"lumina-nichewp/text-scroll-down"} /-->
		</div>
		<figure class="wp-block-media-text__media">
			<img src="<?php echo esc_url( get_theme_file_uri( "assets/images/pages/home-hero.webp" ) ); ?>" alt=""/>
		</figure>
	</div>
	<!-- /wp:media-text -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina-nichewp/hidden-content-start"} /-->

<!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"name":"Site Motto + Details"},"align":"full","layout":{"type":"constrained"},"anchor":"site-motto-details"} -->
<div class="wp-block-group alignfull" id="site-motto-details"><!-- wp:columns {"lock":{"move":false,"remove":false},"metadata":{"name":"Heading \u0026 Content"},"align":"wide","className":"is-style-default","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide is-style-default"><!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"},"className":"is-style-first-on-mobile"} -->
<div class="wp-block-column is-style-first-on-mobile" style="flex-basis:33.33%"><!-- wp:heading {"className":"is-style-separator"} -->
<h2 class="wp-block-heading is-style-separator"><?php esc_html_e("The Paradigm Shift", "lumina-nichewp"); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"metadata":{"name":"Site Motto Medium"},"fontSize":"medium"} -->
<div class="wp-block-group has-medium-font-size"><!-- wp:paragraph -->
<p><?php esc_html_e("We believe your website should feel balanced and organic—bringing the natural rhythms and structural patterns of the physical world straight onto your digital canvas.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:paragraph {"fontSize":"medium"} -->
<p class="has-medium-font-size"><?php esc_html_e("Lumina NicheWP bridges physical aesthetics with modern web architecture to make your website feel balanced, intuitive, and effortlessly premium.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Taking cues from modern mobile interfaces, Lumina NicheWP transforms static block layouts into interactive cards that invite clicks and guide user attention naturally across the page.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Combined with rich, nature-inspired color palettes and complete WordPress Full-Site Editing freedom, you get a theme that looks exceptional and stays completely out of your way.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"name":"Features 4 Columns","categories":["lumina-nichewp","column","featured"]},"align":"full","layout":{"type":"constrained"},"anchor":"features-4"} -->
<div class="wp-block-group alignfull" id="features-4"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"className":"is-style-rounded-border"} -->
<div class="wp-block-column is-style-rounded-border"><!-- wp:icon {"icon":"core/shadow","align":"center","className":"is-style-round","backgroundColor":"primary-subtle","ariaLabel":"Colors Icon"} /-->

<!-- wp:heading {"level":3,"style":{"typography":{"textAlign":"center"}}} -->
<h3 class="wp-block-heading has-text-align-center"><?php esc_html_e("Beautiful Colors", "lumina-nichewp"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-default","style":{"typography":{"textAlign":"center"}}} -->
<p class="has-text-align-center is-style-default"><?php esc_html_e("Colors drawn from nature rather than harsh monitors. Rich earthy mid-tones, subtle tints, and dark accents give you complete flexibility to direct visitor focus.", "lumina-nichewp"); ?> <a href="#feature-grid"><?php esc_html_e("Learn more", "lumina-nichewp"); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-rounded-border"} -->
<div class="wp-block-column is-style-rounded-border"><!-- wp:icon {"icon":"lumina-nichewp/depth","align":"center","className":"is-style-round","backgroundColor":"secondary-subtle","ariaLabel":"Arrow Icon"} /-->

<!-- wp:heading {"level":3,"style":{"typography":{"textAlign":"center"}}} -->
<h3 class="wp-block-heading has-text-align-center"><?php esc_html_e("Interactive Cards", "lumina-nichewp"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-default","style":{"typography":{"textAlign":"center"}}} -->
<p class="has-text-align-center is-style-default"><?php esc_html_e("Container blocks carrying links or action buttons automatically respond with subtle lift and soft ambient shadows when hovered or tapped on mobile screens.", "lumina-nichewp"); ?> <a href="#feature-grid"><?php esc_html_e("Learn more", "lumina-nichewp"); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-rounded-border"} -->
<div class="wp-block-column is-style-rounded-border"><!-- wp:icon {"icon":"core/image","align":"center","className":"is-style-round","backgroundColor":"tertiary-subtle","ariaLabel":"Computer Icon"} /-->

<!-- wp:heading {"level":3,"style":{"typography":{"textAlign":"center"}}} -->
<h3 class="wp-block-heading has-text-align-center"><?php esc_html_e("Engaging Images", "lumina-nichewp"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-default","style":{"typography":{"textAlign":"center"}}} -->
<p class="has-text-align-center is-style-default"><?php esc_html_e("Support for modern image aspect ratios,  Wide 16:9, Ultra-wide 21:9, and our unique \"Slim\" 16:4.5. Add a motion pan &amp; zoom effect with a single click.", "lumina-nichewp"); ?> <a href="#feature-grid"><?php esc_html_e("Learn more", "lumina-nichewp"); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-rounded-border"} -->
<div class="wp-block-column is-style-rounded-border"><!-- wp:icon {"icon":"core/desktop","align":"center","className":"is-style-round","backgroundColor":"primary-subtle","ariaLabel":"Computer Icon"} /-->

<!-- wp:heading {"level":3,"style":{"typography":{"textAlign":"center"}}} -->
<h3 class="wp-block-heading has-text-align-center"><?php esc_html_e("Full Site Editing", "lumina-nichewp"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-default","style":{"typography":{"textAlign":"center"}}} -->
<p class="has-text-align-center is-style-default"><?php esc_html_e("Swap or customize site headers, footers, post grids, and color schemes directly within the Site Editor. Easily keep your site modern and fresh without writing code.", "lumina-nichewp"); ?> <a href="#feature-grid"><?php esc_html_e("Learn more", "lumina-nichewp"); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Features 3x2 Columns"},"align":"full","layout":{"type":"constrained"},"anchor":"feature-grid"} -->
<div class="wp-block-group alignfull" id="feature-grid"><!-- wp:group {"metadata":{"name":"Heading \u0026 Intro"},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"metadata":{"name":"Heading"},"className":"is-style-separator"} -->
<h2 class="wp-block-heading is-style-separator"><?php esc_html_e("Feature Highlights", "lumina-nichewp"); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"metadata":{"name":"Intro"},"fontSize":"medium"} -->
<p class="has-medium-font-size"><?php esc_html_e("Discover a collection of welcoming features engineered to make building and navigating your website an absolute joy.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","className":"is-style-gutter-dividers"} -->
<div class="wp-block-columns alignwide is-style-gutter-dividers"><!-- wp:column {"className":"is-style-first-on-mobile"} -->
<div class="wp-block-column is-style-first-on-mobile"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:icon {"icon":"core/mobile","className":"is-style-default","style":{"layout":{"selfStretch":"fit","flexSize":null},"dimensions":{"width":"42px"}},"ariaLabel":"Mobile Device"} /-->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Mobile-Friendly", "lumina-nichewp"); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Interactive cards respond smoothly to touch gestures. The first tap reveals a small icon indicating the card is a link. A second tap follows the link.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-default"} -->
<div class="wp-block-column is-style-default"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:icon {"icon":"core/styles","className":"is-style-align-left","ariaLabel":"Color Contrast"} /-->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Automatic Contrast", "lumina-nichewp"); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Simply select a background color and Lumina NicheWP automatically applies WCAG AA-compliant text, headline, and link colors for flawless, zero-touch legibility.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-default"} -->
<div class="wp-block-column is-style-default"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:icon {"icon":"lumina-nichewp/fonts","className":"is-style-align-left","ariaLabel":"Fonts"} /-->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Beautiful Fonts", "lumina-nichewp"); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Modern fonts that are soft in weight, but crisp and legible, giving your site a premium vibe. Six (6) curated fonts are available that load locally for fast performance.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","className":"is-style-gutter-dividers"} -->
<div class="wp-block-columns alignwide is-style-gutter-dividers"><!-- wp:column {"className":"is-style-first-on-mobile"} -->
<div class="wp-block-column is-style-first-on-mobile"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:icon {"icon":"lumina-nichewp/dividers","className":"is-style-align-left is-style-default","ariaLabel":"Dividers"} /-->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Subtle Dividers", "lumina-nichewp"); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Add clean, subtle architectural divider lines to columns, lists, and navigation menus via custom block styles in the editor.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-default"} -->
<div class="wp-block-column is-style-default"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:icon {"icon":"lumina-nichewp/details","className":"is-style-align-left is-style-default","ariaLabel":"Collapsible"} /-->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Collapsible Panels", "lumina-nichewp"); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Accordions and disclosure panels remember whether visitors left them open or closed, preserving user display preferences across page views.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-default"} -->
<div class="wp-block-column is-style-default"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:icon {"icon":"core/settings","className":"is-style-align-left","ariaLabel":"Styles"} /-->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Global Styles", "lumina-nichewp"); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Instantly transform your site's physical personality, border radius, block spacing, and animation curves with a single click in the Site Editor.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"categories":["lumina-nichewp","media"],"name":"Image Computer Screen"},"align":"wide","style":{"spacing":{"padding":{"bottom":"0px"}}},"layout":{"type":"constrained"},"anchor":"computer-screen"} -->
<div class="wp-block-group alignwide" id="computer-screen" style="padding-bottom:0px"><!-- wp:heading {"placeholder":"Image Computer Screen with Title and Text Above","className":"is-style-separator","style":{"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center is-style-separator"><?php esc_html_e("Showcase Your Works", "lumina-nichewp"); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var|preset|spacing|40"}},"typography":{"textAlign":"center"}}} -->
<p class="has-text-align-center" style="margin-bottom:var|preset|spacing|40"><?php esc_html_e("With the click of a button you can add pan-zoom motion or a frame to simulate a computer or mobile device screen. No photo or video editing software required.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"lightbox":{"enabled":true},"aspectRatio":"16/9","scale":"cover","align":"center","className":"is-resized size-large is-style-image-computer-screen"} -->
<figure class="wp-block-image aligncenter is-resized size-large is-style-image-computer-screen"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/screenshots/01.webp" ) ); ?>" alt="screenshot" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Dividers Intro + 3 x 2 Columns"},"align":"wide","layout":{"type":"constrained"},"anchor":"dividers-intro-3x2"} -->
<div class="wp-block-group alignwide" id="dividers-intro-3x2"><!-- wp:columns {"metadata":{"name":"Outer Columns"},"align":"wide","className":"is-style-default","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}},"anchor":"metrics"} -->
<div class="wp-block-columns alignwide is-style-default" id="metrics"><!-- wp:column {"width":"33.33%","metadata":{"name":"Intro Column"}} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:heading {"align":"wide","className":"is-style-separator"} -->
<h2 class="wp-block-heading alignwide is-style-separator"><?php esc_html_e("By the Numbers", "lumina-nichewp"); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"medium"} -->
<p class="has-medium-font-size"><?php esc_html_e("With Full Site Editing and all the templates provided, there are", "lumina-nichewp"); ?> <strong><?php esc_html_e("thousands of unique theme layouts", "lumina-nichewp"); ?></strong> <?php esc_html_e("plus", "lumina-nichewp"); ?><strong> <?php esc_html_e("hundreds of block styles and patterns", "lumina-nichewp"); ?></strong> <?php esc_html_e("to easily make your content stand out.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%","metadata":{"name":"Columns 3 x 2"}} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:columns {"isStackedOnMobile":false,"className":"is-style-gutter-dividers","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns is-not-stacked-on-mobile is-style-gutter-dividers"><!-- wp:column {"className":"is-style-default"} -->
<div class="wp-block-column is-style-default"><!-- wp:paragraph {"style":{"typography":{"lineHeight":"1","fontWeight":"500","textAlign":"center","fontStyle":"normal"},"textColor":"highlight-accent-alt","fontSize":"huge"} -->
<p class="has-text-align-center has-text-color has-highlight-accent-alt-color has-huge-font-size" style="font-style:normal;font-weight:500;line-height:1">10</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"has-contrast-color has-text-color","style":{"typography":{"lineHeight":"1.4","textAlign":"center"}}} -->
<p class="has-text-align-center has-contrast-color has-text-color" style="line-height:1.4"><?php esc_html_e("Color Schemes", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-default"} -->
<div class="wp-block-column is-style-default"><!-- wp:paragraph {"style":{"typography":{"lineHeight":"1","fontWeight":"500","textAlign":"center","fontStyle":"normal"},"textColor":"highlight-accent-alt","fontSize":"huge"} -->
<p class="has-text-align-center has-text-color has-highlight-accent-alt-color has-huge-font-size" style="font-style:normal;font-weight:500;line-height:1">6</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"has-contrast-color has-text-color","style":{"typography":{"lineHeight":"1.4","textAlign":"center"}}} -->
<p class="has-text-align-center has-contrast-color has-text-color" style="line-height:1.4"><?php esc_html_e("Header Layouts", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-default"} -->
<div class="wp-block-column is-style-default"><!-- wp:paragraph {"style":{"typography":{"lineHeight":"1","fontWeight":"500","textAlign":"center","fontStyle":"normal"},"textColor":"highlight-accent-alt","fontSize":"huge"} -->
<p class="has-text-align-center has-text-color has-highlight-accent-alt-color has-huge-font-size" style="font-style:normal;font-weight:500;line-height:1">12+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"has-contrast-color has-text-color","style":{"typography":{"lineHeight":"1.4","textAlign":"center"}}} -->
<p class="has-text-align-center has-contrast-color has-text-color" style="line-height:1.4"><?php esc_html_e("Footer Layouts", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"isStackedOnMobile":false,"className":"is-style-gutter-dividers","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns is-not-stacked-on-mobile is-style-gutter-dividers"><!-- wp:column {"className":"is-style-default"} -->
<div class="wp-block-column is-style-default"><!-- wp:paragraph {"style":{"typography":{"lineHeight":"1","fontWeight":"500","textAlign":"center","fontStyle":"normal"},"textColor":"highlight-accent-alt","fontSize":"huge"} -->
<p class="has-text-align-center has-text-color has-highlight-accent-alt-color has-huge-font-size" style="font-style:normal;font-weight:500;line-height:1">5</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"has-contrast-color has-text-color","style":{"typography":{"lineHeight":"1.4","textAlign":"center"}}} -->
<p class="has-text-align-center has-contrast-color has-text-color" style="line-height:1.4"><?php esc_html_e("Curated Fonts", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-default"} -->
<div class="wp-block-column is-style-default"><!-- wp:paragraph {"style":{"typography":{"lineHeight":"1","fontWeight":"500","textAlign":"center","fontStyle":"normal"},"textColor":"highlight-accent-alt","fontSize":"huge"} -->
<p class="has-text-align-center has-text-color has-highlight-accent-alt-color has-huge-font-size" style="font-style:normal;font-weight:500;line-height:1">40+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"has-contrast-color has-text-color","style":{"typography":{"lineHeight":"1.4","textAlign":"center"}}} -->
<p class="has-text-align-center has-contrast-color has-text-color" style="line-height:1.4"><?php esc_html_e("Custom Block Styles", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-default"} -->
<div class="wp-block-column is-style-default"><!-- wp:paragraph {"style":{"typography":{"lineHeight":"1","fontWeight":"500","textAlign":"center","fontStyle":"normal"},"textColor":"highlight-accent-alt","fontSize":"huge"} -->
<p class="has-text-align-center has-text-color has-highlight-accent-alt-color has-huge-font-size" style="font-style:normal;font-weight:500;line-height:1">80+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"has-contrast-color has-text-color","style":{"typography":{"lineHeight":"1.4","textAlign":"center"}}} -->
<p class="has-text-align-center has-contrast-color has-text-color" style="line-height:1.4"><?php esc_html_e("Block Patterns", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Call-to-Action"},"align":"wide","className":"is-style-rounded-border","backgroundColor":"secondary","layout":{"type":"constrained"},"anchor":"call-to-action-2-column"} -->
<div class="wp-block-group alignwide is-style-rounded-border has-secondary-background-color has-background" id="call-to-action-2-column"><!-- wp:columns {"verticalAlignment":"center","align":"wide","className":"is-style-center-on-mobile"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center is-style-center-on-mobile"><!-- wp:column {"verticalAlignment":"center","width":"70%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:70%"><!-- wp:heading -->
<h2 class="wp-block-heading"><strong><?php esc_html_e("Illumina-nichewpte", "lumina-nichewp"); ?></strong> <?php esc_html_e("your Website Today", "lumina-nichewp"); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Craft rich, high-performance web experiences with fluid motion, modern block patterns, and complete layout control with the Lumina NicheWP theme.", "lumina-nichewp"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"30%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:30%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" href="#content-start" rel="noreferrer noopener"><?php esc_html_e("Get Started", "lumina-nichewp"); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->