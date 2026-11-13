/**
 * File:	smoothscroll.js
 * Theme: 	NicheWP Shared / Lumina Engine
 * 
 * Javascript for smooth scrolling internal links and updating dynamic 
 * CSS header offset variables.
 *
 * @package flat-blocks
 * @since	1.0
 */
 
( function( $ ) {
	
	$(document).ready(function() {

		// 1. Helper to read CSS duration tokens from :root into milliseconds
		function getCssDuration(varName, fallbackMs) {
			var val = getComputedStyle(document.documentElement).getPropertyValue(varName).trim();
			if (!val) return fallbackMs;
			if (val.indexOf('ms') !== -1) return parseFloat(val);
			if (val.indexOf('s') !== -1) return parseFloat(val) * 1000;
			return fallbackMs;
		}

		// 2. Sine ease-in-out: Immediate motion response on frame 1 + soft landing
		$.easing.luminaSmooth = function(p) {
			return 0.5 - Math.cos(p * Math.PI) / 2;
		};

		// 3. Intercept dummy/placeholder links to prevent jumps & 404 navigation
		$(document).on('click', 'a[href="http://Pages"], a[href="#"], a[href="#0"]', function(event) {
			event.preventDefault();
		});

		/*
		 * Calculate fixed & floating header heights & update CSS variables
		 */
		var topOffset = 0;

		function updateHeaderHeight() {
			const wrapper = $('.wp-site-blocks > :first-child');
			const headerEl = wrapper.find('.site-header').length ? wrapper.find('.site-header') : wrapper.filter('.site-header');
			const adminBar = $('#wpadminbar');

			var physicalHeight = 0;
			var headerOffsetForCover = 0;
			var adminBarHeight = adminBar.length > 0 ? adminBar.outerHeight() : 0;

			if (headerEl.length > 0) { 
				physicalHeight = headerEl.outerHeight();

				// STRICT CHECK: Only check if the actual INNER header card is full-width (.alignfull)
				const isFlushHeader = headerEl.hasClass('alignfull');

				if (isFlushHeader) {
					// Flush header sits above hero: Subtract height from Cover block
					headerOffsetForCover = physicalHeight;
					topOffset = physicalHeight + adminBarHeight;
				} else {
					// Floating header overlays hero: Cover starts at Y=0 and needs FULL 100vh
					headerOffsetForCover = 0;

					var computedTop = getComputedStyle(wrapper[0]).getPropertyValue('--header-top-offset').trim();
					var floatingOffset = parseFloat(computedTop) || 24;
					topOffset = physicalHeight + floatingOffset + adminBarHeight;
				}
			} else {
				topOffset = adminBarHeight;
			}

			// 1. Actual physical height of the header element itself
			document.body.style.setProperty('--wp--custom--header--height', physicalHeight + 'px');

			// 2. Space offset claimed in document flow (0px for floating overlays, actual px for flush headers)
			document.body.style.setProperty('--wp--custom--header--offset', headerOffsetForCover + 'px');
		}

		// Run once on load and update on window resize / orientation change
		updateHeaderHeight();
		$(window).on('resize orientationchange', updateHeaderHeight);
		
		// 4. Core Scroll Engine
		function scrollToTarget(target, animate) {
			if (!target || !target.length) return;

			var destination = Math.max(0, target.offset().top - topOffset);

			// Respect OS-level reduced motion preference (instant jump)
			if (!animate || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
				window.scrollTo(0, destination);
				return;
			}

			// Floor starts at duration--medium (~500ms), ceiling allowed up to 1800ms
			var minDuration = getCssDuration('--wp--custom--animation--duration--medium', 500);
			var maxDuration = 1800;

			var distance = Math.abs($(window).scrollTop() - destination);
			var calculated = minDuration + (distance * 0.45);
			var duration = Math.min(maxDuration, Math.max(minDuration, calculated));

			$('html, body').animate({
				scrollTop: destination
			}, duration, 'luminaSmooth');
		}

		// 5. Direct URL Hash Navigation (e.g., https://nichewp.com/about/#contact-form)
		if (window.location.hash && window.location.hash.length > 1) {
			var hashTarget = $(window.location.hash);
			if (hashTarget.length) {
				// Immediate re-align once header heights are calculated
				setTimeout(function() {
					scrollToTarget(hashTarget, false);
				}, 10);

				// Secondary adjustment after full asset load (catches image/font reflow shifts)
				$(window).on('load', function() {
					scrollToTarget(hashTarget, false);
				});
			}
		}

		// 6. In-Page Clicked Anchor Links
		const links = $('a[href*="#"]')
			.not('[href="#"]')
			.not('[href="#0"]')
			.not('[data-toggle="tab"]')
			.not('[data-toggle="collapse"]');

		links.click(function(event) {
			if (
				location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
				&& 
				location.hostname == this.hostname
			) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					event.preventDefault();
					scrollToTarget(target, true);
				}
			}
		});
					
	});
	
} )( jQuery );
