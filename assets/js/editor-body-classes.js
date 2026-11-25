( function() {
	if ( ! window.frameElement ) {
		return;
	}

	let canvasBody = null;
	let scheduled = false;
	let mode = window.luminaEditorBodyClasses.includes( 'theme-dark-mode' ) ? 'dark' : 'light';
	let scheme = window.luminaEditorBodyClasses.find( ( name ) => name.startsWith( 'color-scheme-' ) );
	let background = window.luminaEditorBodyClasses.find(
		( name ) => name === 'is-dark-background' || name === 'is-light-background'
	);
	const trackBackground = Boolean( background );
	let managedClasses = [];

	// WordPress controls is-dark-theme using canvas luminance, not Lumina's mode.
	function updateClasses() {
		const classes = [
			`theme-${ mode }-mode`,
			scheme,
			background,
		].filter( Boolean );

		if ( canvasBody ) {
			for ( const name of managedClasses ) {
				if ( ! classes.includes( name ) ) {
					canvasBody.classList.remove( name );
				}
			}
		}
		managedClasses = classes;
		applyClasses();
	}

	function applyClasses() {
		if ( ! canvasBody || ! canvasBody.classList.contains( 'block-editor-iframe__body' ) ) {
			return;
		}

		for ( const className of managedClasses ) {
			if ( ! canvasBody.classList.contains( className ) ) {
				canvasBody.classList.add( className );
			}
		}
	}

	function synchronize() {
		scheduled = false;
		if ( ! canvasBody || ! canvasBody.classList.contains( 'block-editor-iframe__body' ) ) {
			return;
		}

		const styles = window.getComputedStyle( canvasBody );
		const currentMode = styles.getPropertyValue( '--wp--custom--color--theme--mode' ).trim();
		const currentScheme = styles.getPropertyValue( '--wp--custom--color--theme--scheme' ).trim();

		if ( currentMode === 'light' || currentMode === 'dark' ) {
			mode = currentMode;
		} else if ( currentMode ) {
			console.error( 'Lumina: unrecognized editor theme mode:', currentMode );
		}

		if ( currentScheme ) {
			scheme = `color-scheme-${ currentScheme.replace( /%[a-f0-9]{2}|[^a-z0-9_-]/gi, '' ) }`;
		}

		if ( trackBackground ) {
			const color = styles.backgroundColor.match( /^rgba?\(\s*([\d.]+)[,\s]+([\d.]+)[,\s]+([\d.]+)/i );
			if ( color ) {
				const [ red, green, blue ] = color.slice( 1 ).map( ( value ) => {
					const channel = Number( value ) / 255;
					return channel <= 0.03928 ? channel / 12.92 : Math.pow( ( channel + 0.055 ) / 1.055, 2.4 );
				} );
				background = 0.2126 * red + 0.7152 * green + 0.0722 * blue < 0.5
					? 'is-dark-background'
					: 'is-light-background';
			} else {
				console.error( 'Lumina: unable to determine editor background color:', styles.backgroundColor );
			}
		}

		updateClasses();
	}

	function scheduleSync() {
		if ( ! scheduled ) {
			scheduled = true;
			window.requestAnimationFrame( synchronize );
		}
	}

	const bodyObserver = new MutationObserver( applyClasses );

	function updateBody() {
		const body = document.querySelector( 'body.block-editor-iframe__body' ) || document.body;
		if ( body !== canvasBody ) {
			bodyObserver.disconnect();
			canvasBody = body;
			if ( canvasBody ) {
				bodyObserver.observe( canvasBody, {
					attributes: true,
					attributeFilter: [ 'class' ],
				} );
			}
		}
		applyClasses();
		scheduleSync();
	}

	function containsStyle( node ) {
		return node.nodeType === Node.ELEMENT_NODE &&
			( node.tagName === 'STYLE' || node.querySelector( 'style' ) );
	}

	// Global style previews update the canvas styles asynchronously.
	new MutationObserver( ( mutations ) => {
		for ( const mutation of mutations ) {
			if ( mutation.target === document.documentElement ) {
				updateBody();
			}
			if (
				mutation.target.nodeName === 'STYLE' ||
				mutation.target.parentNode?.nodeName === 'STYLE' ||
				Array.from( mutation.addedNodes ).some( containsStyle ) ||
				Array.from( mutation.removedNodes ).some( containsStyle )
			) {
				scheduleSync();
			}
		}
	} ).observe( document.documentElement, { childList: true, characterData: true, subtree: true } );
	updateClasses();
	updateBody();
} )();
