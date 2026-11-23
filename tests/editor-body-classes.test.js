const fs = require( 'fs' );
const path = require( 'path' );

const script = fs.readFileSync(
	path.join( __dirname, '../assets/js/editor-body-classes.js' ),
	'utf8'
);

function waitForStyles() {
	return new Promise( ( resolve ) => setTimeout( resolve, 50 ) );
}

function setThemeStyles( style, mode, scheme, background ) {
	style.textContent = `body {
		--wp--custom--color--theme--mode: is-${ mode }-theme;
		--wp--custom--color--theme--scheme: ${ scheme };
		background-color: ${ background };
	}`;
}

function createCanvas( trackBackground = false ) {
	const iframe = document.createElement( 'iframe' );
	document.body.appendChild( iframe );
	const canvas = iframe.contentWindow;
	const style = canvas.document.createElement( 'style' );
	canvas.document.head.appendChild( style );
	canvas.document.body.className = 'block-editor-iframe__body editor-styles-wrapper';
	canvas.luminaEditorBodyClasses = [
		'theme-light-mode',
		'color-scheme-elements',
	];
	if ( trackBackground ) {
		canvas.luminaEditorBodyClasses.push( 'is-light-background' );
	}
	setThemeStyles( style, 'light', 'elements', 'rgb(249, 247, 246)' );
	canvas.eval( script );
	return { iframe, canvas, style };
}

afterEach( () => {
	document.body.replaceChildren();
} );

test( 'updates mode and scheme without outputting background classes by default', async () => {
	const { canvas, style } = createCanvas();
	await waitForStyles();

	setThemeStyles( style, 'dark', 'low-tide', 'rgb(33, 45, 59)' );
	await waitForStyles();
	const classes = canvas.document.body.classList;
	expect( classes.contains( 'theme-dark-mode' ) ).toBe( true );
	expect( classes.contains( 'color-scheme-low-tide' ) ).toBe( true );
	expect( classes.contains( 'is-dark-background' ) ).toBe( false );
	expect( classes.contains( 'theme-light-mode' ) ).toBe( false );
	expect( classes.contains( 'color-scheme-elements' ) ).toBe( false );

	setThemeStyles( style, 'light', 'elements', 'rgb(249, 247, 246)' );
	await waitForStyles();
	expect( classes.contains( 'theme-light-mode' ) ).toBe( true );
	expect( classes.contains( 'color-scheme-elements' ) ).toBe( true );
	expect( classes.contains( 'is-light-background' ) ).toBe( false );
	expect( classes.contains( 'theme-dark-mode' ) ).toBe( false );
} );

test( 'updates background classes when enabled', async () => {
	const { canvas, style } = createCanvas( true );
	await waitForStyles();

	setThemeStyles( style, 'dark', 'low-tide', 'rgb(33, 45, 59)' );
	await waitForStyles();
	const classes = canvas.document.body.classList;
	expect( classes.contains( 'is-dark-background' ) ).toBe( true );
	expect( classes.contains( 'is-light-background' ) ).toBe( false );

	setThemeStyles( style, 'light', 'elements', 'rgb(249, 247, 246)' );
	await waitForStyles();
	expect( classes.contains( 'is-light-background' ) ).toBe( true );
	expect( classes.contains( 'is-dark-background' ) ).toBe( false );
} );

test( 'preserves WordPress dark-theme class and handles canvas body replacement', async () => {
	const { canvas } = createCanvas();
	await waitForStyles();
	canvas.document.body.classList.add( 'is-dark-theme' );
	await waitForStyles();
	expect( canvas.document.body.classList.contains( 'is-dark-theme' ) ).toBe( true );
	expect( canvas.document.body.classList.contains( 'theme-light-mode' ) ).toBe( true );

	const body = canvas.document.createElement( 'body' );
	body.className = 'block-editor-iframe__body editor-styles-wrapper';
	canvas.document.documentElement.replaceChild( body, canvas.document.body );
	await waitForStyles();
	expect( body.classList.contains( 'theme-light-mode' ) ).toBe( true );
	expect( body.classList.contains( 'color-scheme-elements' ) ).toBe( true );
} );
