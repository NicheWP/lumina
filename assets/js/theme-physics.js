/**
 * File:        theme-physics.js
 * Theme:       Lumina NicheWP Blocks
 *
 * Javascript for turning cards with a single link or button into a click target
 * and managing interactive image state toggles.
 *
 * RESTORED FROM GITHUB theme-physics-8b9d665.js
 *
 * @package lumina-nichewp
 * @since   1.0
 */
 
( function( $ ) {
	
	$(document).ready(function() {

		/* ==========================================================================
		 * 01. DETAIL OPEN / CLOSE: Retains user setting
		 * ========================================================================== */
		$( 'details' ).each( function( index ) {
			const $details = $( this );
			
			// 1. Resolve a unique identifier for this element
			const elementIdentifier = $details.attr( 'id' ) || $details.closest( '[id]' ).attr( 'id' ) || 'global';
			
			// 2. Scope the storage key to the current page path so states don't bleed
			const pagePath   = window.location.pathname.replace( /[^a-zA-Z0-9]/g, '_' );
			const storageKey = 'details_state_' + pagePath + '_' + elementIdentifier + '_' + index;
		
			// 3. RESTORE STATE: Check if a saved preference exists on page load
			const savedState = localStorage.getItem( storageKey );
			if ( savedState !== null ) {
				$details.prop( 'open', savedState === 'open' );
			}
		
			// HASH DETECTOR OVERRIDE: Force open if URL targets an element inside
			if ( window.location.hash ) {
				try {
					const $targetElement = $details.find( window.location.hash );
					if ( $targetElement.length > 0 ) {
						$details.prop( 'open', true );
					}
				} catch (e) {
					console.warn("Invalid URL hash selector skipped", e);
				}
			}
		
			// 4. SAVE STATE: Listen for the native HTML toggle event
			$details.on( 'toggle', function() {
				localStorage.setItem( storageKey, this.open ? 'open' : 'closed' );
			} );
		} );

		/* ==========================================================================
		 * 02. ASPECT RATIO TOGGLE ENGINE
		 * ========================================================================== */
		const lumina-nichewpAspectConfig = {
			// 'global'    = Toggling 1 image sets visitor preference site-wide for all toggle headers
			// 'per-image' = Toggling an image saves state for that exact image on that specific page
			mode: 'global'
		};
		
		// --- GLOBAL MODE: Restore site-wide preference on page load ---
		if ( lumina-nichewpAspectConfig.mode === 'global' ) {
			if ( localStorage.getItem( 'lumina_nichewp_global_aspect' ) === 'expanded' ) {
				$( 'body' ).addClass( 'aspect-pref-full' );
			}
		}
		
		$( '.wp-block-image:is(.is-style-aspect-toggle, .is-style-toggle-aspect)' ).each( function( index ) {
			const $container = $( this );
			const $img       = $container.find( 'img' );
		
			if ( ! $img.length ) return;
		
			// 1. Inject Lumina NicheWP standard overlay badge if missing
			let $badge = $container.find( '> button.lumina-nichewp-aspect-toggle' );
			if ( ! $badge.length ) {
				$badge = $( `
					<button class="lumina-nichewp-card-arrow-overlay lumina-nichewp-aspect-toggle" 
							type="button" 
							aria-label="Toggle image aspect ratio" 
							aria-expanded="false">
					</button>
				` );
				
				if ( $container.css( 'position' ) === 'static' ) {
					$container.css( 'position', 'relative' );
				}
				$container.append( $badge );
			}
		
			// 2. Resolve scoped storage key (Used in 'per-image' mode)
			const elementIdentifier = $container.attr( 'id' ) || $img.attr( 'src' )?.split( '/' ).pop()?.split( '?' )[0] || 'toggle_img';
			const pagePath          = window.location.pathname.replace( /[^a-zA-Z0-9]/g, '_' );
			const localStorageKey   = 'lumina_nichewp_aspect_state_' + pagePath + '_' + elementIdentifier + '_' + index;
		
			// 3. Helper to update UI badge states
			function updateBadgeState( isExpanded ) {
				$badge.toggleClass( 'lumina-nichewp-action-aspect-collapse', isExpanded )
					  .toggleClass( 'lumina-nichewp-action-aspect-expand', ! isExpanded )
					  .attr( 'aria-expanded', isExpanded ? 'true' : 'false' );
			}
		
			// 4. RESTORE STATE
			if ( lumina-nichewpAspectConfig.mode === 'global' ) {
				const isGlobalFull = $( 'body' ).hasClass( 'aspect-pref-full' );
				updateBadgeState( isGlobalFull );
			} else {
				const savedLocalState = localStorage.getItem( localStorageKey );
				const isLocalExpanded = savedLocalState === 'expanded';
				$container.toggleClass( 'is-expanded', isLocalExpanded );
				updateBadgeState( isLocalExpanded );
			}
		
			// 5. TOUCHSTART HANDLER (Reveals badge on mobile touch without toggling aspect)
			$container.on( 'touchstart', function( e ) {
				if ( $( e.target ).is( 'a, figcaption' ) || $( e.target ).closest( 'figcaption, a' ).length ) {
					return;
				}

				if ( ! $container.hasClass( 'is-active' ) ) {
					$( '.wp-block-image:is(.is-style-aspect-toggle, .is-style-toggle-aspect)' ).removeClass( 'is-active' );
					$container.addClass( 'is-active' );
				}
			} );

			// 6. CLICK HANDLER
			$container.on( 'click', 'button.lumina-nichewp-aspect-toggle, img', function( e ) {
				if ( $( e.target ).is( 'a, figcaption' ) || $( e.target ).closest( 'figcaption, a' ).length ) {
					return;
				}
		
				const isBadgeClick = $( e.target ).closest( 'button.lumina-nichewp-aspect-toggle' ).length > 0;
				const hasLightbox   = isLightboxElement( $img[0] ) || $container.find( '.wp-lightbox-container' ).length > 0;
		
				// If clicking image directly and Lightbox is enabled, let WP Core Lightbox open
				if ( ! isBadgeClick && hasLightbox ) {
					return;
				}
		
				e.preventDefault();
				e.stopPropagation();
				e.stopImmediatePropagation();
		
				if ( lumina-nichewpAspectConfig.mode === 'global' ) {
					// --- GLOBAL MODE TOGGLE ---
					const isNowFull = $( 'body' ).toggleClass( 'aspect-pref-full' ).hasClass( 'aspect-pref-full' );
					localStorage.setItem( 'lumina_nichewp_global_aspect', isNowFull ? 'expanded' : 'slim' );
		
					// Sync all badges currently rendered on page
					$( '.lumina-nichewp-aspect-toggle' ).each( function() {
						const $b = $( this );
						$b.toggleClass( 'lumina-nichewp-action-aspect-collapse', isNowFull )
						  .toggleClass( 'lumina-nichewp-action-aspect-expand', ! isNowFull )
						  .attr( 'aria-expanded', isNowFull ? 'true' : 'false' );
					} );
				} else {
					// --- PER-IMAGE MODE TOGGLE ---
					const isNowExpanded = $container.toggleClass( 'is-expanded' ).hasClass( 'is-expanded' );
					updateBadgeState( isNowExpanded );
					localStorage.setItem( localStorageKey, isNowExpanded ? 'expanded' : 'slim' );
				}
			} );
		} );

		/* ==========================================================================
		 * 03. DYNAMIC CARD ENGINE: Turn single-link cards into unified click targets
		 * ========================================================================== */
	
		// Selector string matching any WP Core Lightbox trigger or container element
		const lightboxSelector = '.lightbox-trigger, .wp-block-image__lightbox-trigger, .wp-lightbox-container, [data-wp-interactive="core/image"], [aria-haspopup="dialog"]';

		// Helper to verify if an element or its parent is part of WP Core Lightbox
		function isLightboxElement(el) {
			var $el = $(el);
			if ($el.is(lightboxSelector)) {
				return true;
			}
			if (($el.attr('data-wp-on--click') || '').indexOf('showLightbox') !== -1) {
				return true;
			}
			if ($el.closest(lightboxSelector).length > 0) {
				return true;
			}
			return false;
		}

		// 1. INITIALIZATION: Target selector for candidate interactive cards (Excludes media text blocks and multi-column grid layouts)
// 		const $interactiveCards = $('[class*="wp-block-"]:not(.alignfull, .is-style-object-static .wp-block-media-text, .wp-block-columns, .wp-block-navigation, .wp-block-navigation *):is(.has-background, .is-style-rounded-border, .is-style-thick-rounded-border, .is-style-rounded-corners, .wp-block-cover)');
		const $interactiveCards = $('[class*="wp-block-"]:not(.alignfull, .wp-block-button, .is-style-object-static, .wp-block-navigation, .wp-block-navigation *):is(.has-background, .is-style-rounded-border, .is-style-glass, .is-style-glass-frosted, .is-style-thick-rounded-border, .is-style-rounded-corners, .wp-block-cover)');

		// 2. GET TARGET: Returns the target link/button if the card is "valid"
		function getValidTarget($card) {
			// Disqualify cards containing form controls
			if ($card.find('form, input:not([type="hidden"]), textarea, select').length > 0) {
				return null;
			}
		
			// Find candidate links/buttons (filtering out Lightbox AND Aspect Toggle controls)
			var $candidates = $card.find('a, button, .wp-element-button').filter(function() {
				var $el = $(this);
				if ($el.hasClass('lumina-nichewp-aspect-toggle') || $el.closest('.is-style-aspect-toggle, .is-style-toggle-aspect').length > 0) {
					return false;
				}
				return !isLightboxElement(this);
			});

			if ($candidates.length === 0) {
				return null;
			}

			var urls = [];
			var validCandidates = [];

			$candidates.each(function() {
				var $el = $(this);
				var href = $el.attr('href');

				if ($el.is('a') && href) {
					urls.push(href.trim().replace(/\/+$/, ''));
					validCandidates.push($el);
				} else if ($el.is('.wp-element-button') && href) {
					urls.push(href.trim().replace(/\/+$/, ''));
					validCandidates.push($el);
				}
			});

			if (urls.length === 0) {
				return null;
			}

			// Verify all non-lightbox links/buttons share the EXACT same target URL
			var firstUrl = urls[0];
			var allMatch = urls.every(function(url) {
				return url === firstUrl;
			});

			if (!allMatch) {
				return null; // Differing destinations -> disqualifies card
			}

			// Return preferred target (prefer explicit button over simple link)
			var $button = $(validCandidates).filter('.wp-element-button').first();
			return $button.length ? $button : validCandidates[0];
		}

		// 3. THREE-PASS CARD RESOLUTION (Outer card stays active, inner cards are vetoed)

		// Pass A: Identify all candidate interactive cards
		$interactiveCards.each(function() {
			var $card = $(this);
			var $target = getValidTarget($card);

			if ($target !== null) {
				$card.addClass('is-interactive-card');
			}
		});

		// Pass B: VETO INNER CHILD CARDS
		$('.is-interactive-card').each(function() {
			var $this = $(this);
			var $parentCard = $this.parents('.is-interactive-card').first();
			if ($parentCard.length) {
				$this.removeClass('is-interactive-card');
			}
		});

		// Pass C: Inject class-based overlays and set cursor on surviving (outer) cards
		$('.is-interactive-card').each(function() {
			var $card = $(this);
			var $target = getValidTarget($card);
		
			if ($target !== null) {
				$card.css('cursor', 'pointer');
		
				if ($card.find('> .lumina-nichewp-card-arrow-overlay').length === 0) {
					var href = $target.attr('href') || '';
					var isAnchor = href.indexOf('#') === 0 || (href.indexOf('#') > -1 && href.split('#')[0] === window.location.href.split('#')[0]);
					var isExternal = $target.get(0).hostname && $target.get(0).hostname !== window.location.hostname;
		
					// Default: Standard Internal Link
					var actionClass = 'lumina-nichewp-action-internal';
		
					if (isExternal) {
						// External Link
						actionClass = 'lumina-nichewp-action-external';
					} else if (isAnchor) {
						var hashIndex = href.indexOf('#');
						var hash = hashIndex !== -1 ? href.substring(hashIndex) : '';
		
						if (hash.length > 1) {
							try {
								var $anchorTarget = $(hash);
								if ($anchorTarget.length) {
									var cardTop = $card.offset().top;
									var targetTop = $anchorTarget.offset().top;
		
									if (targetTop < cardTop) {
										actionClass = 'lumina-nichewp-action-scroll-up';
									} else {
										actionClass = 'lumina-nichewp-action-scroll-down';
									}
								}
							} catch (err) {
								actionClass = 'lumina-nichewp-action-internal';
							}
						}
					}
		
					// Clean HTML node (Icons dynamically attached via SCSS mask engine)
					var $overlay = $('<span class="lumina-nichewp-card-arrow-overlay ' + actionClass + '" aria-hidden="true"></span>');
		
					if ($card.css('position') === 'static') {
						$card.css('position', 'relative');
					}
		
					$card.append($overlay);
				}
			}
		});

		/* ==========================================================================
		 * 04. MOBILE TOUCH HANDLER (Clean Card-Only Target)
		 * ========================================================================== */
		$(document).on('touchstart', '.is-interactive-card', function(e) {
			var $card = $(this);
		
			// Bypass card activation if touch lands directly on an aspect toggle or lightbox image
			if ($(e.target).closest('.lumina-nichewp-aspect-toggle, .is-style-aspect-toggle, .is-style-toggle-aspect, ' + lightboxSelector).length) {
				return;
			}

			if (!$card.hasClass('is-active')) {
				$('.is-interactive-card').not($card).removeClass('is-active');
				$card.addClass('is-active');
				$card.data('just-activated', true);
			} else {
				$card.data('just-activated', false);
			}
		});
		
		$(document).on('touchmove', function() {
			$('.is-interactive-card').data('just-activated', false);
		});
		
		$(document).on('touchstart click', function(e) {
			if (!$(e.target).closest('.is-interactive-card').length) {
				$('.is-interactive-card').removeClass('is-active');
			}
			if (!$(e.target).closest('.wp-block-image:is(.is-style-aspect-toggle, .is-style-toggle-aspect)').length) {
				$('.wp-block-image:is(.is-style-aspect-toggle, .is-style-toggle-aspect)').removeClass('is-active');
			}
		});		
	
		/* ==========================================================================
		 * 05. ACTION: Click / Navigation Handler
		 * ========================================================================== */
		$(document).on('click', '.is-interactive-card', function(e) {
			var $card = $(this);
			var $target = getValidTarget($card);

			if ($target === null) return;

			if ($card.data('just-activated')) {
				e.preventDefault();
				e.stopPropagation();
				$card.data('just-activated', false);
				return;
			}

			// Exclude clicks on native buttons, links, lightbox elements, AND aspect toggles
			if ($(e.target).closest('button, a, .wp-element-button, input, select, textarea, .lumina-nichewp-aspect-toggle, .is-style-aspect-toggle, .is-style-toggle-aspect, ' + lightboxSelector).length) {
				$card.removeClass('is-active');
				return;
			}

			e.preventDefault();
			e.stopPropagation();
			$card.removeClass('is-active');

			if ($target.is('a')) {
				var href = $target.attr('href');
				var targetAttr = $target.attr('target');

				if (href) {
					var isAnchor = href.indexOf('#') === 0 || (href.indexOf('#') > -1 && href.split('#')[0] === window.location.href.split('#')[0]);

					if (isAnchor) {
						$target.trigger('click');

						$('html, body').one('wheel mousewheel touchmove DOMMouseScroll mousedown', function() {
							$('html, body').stop();
						});
					} else if (targetAttr === '_blank') {
						window.open(href, '_blank');
					} else {
						window.location.href = href;
					}
				}
			} else {
				$target[0].click();
			}
		});

	});
	
} )( jQuery );