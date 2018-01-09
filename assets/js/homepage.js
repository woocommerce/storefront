/**
 * homepage.js
 *
 * Handles behaviour of the homepage featured image
 */
( function() {

	/**
	 * Set hero content dimensions / layout
	 * Run adaptive backgrounds and set colors
	 */
	document.addEventListener( 'DOMContentLoaded', function() {
		var homepageContent = document.querySelector( '.page-template-template-homepage .type-page.has-post-thumbnail' );
		if ( !homepageContent ) {
			// Only apply layout to the homepage content component if it exists on the page
			return;
		}
		var siteMain = document.querySelector( '.site-main' );
		var htmlDirValue = document.documentElement.getAttribute( 'dir' );
		var updateDimensions = function() {
			if ( updateDimensions._tick ) {
				cancelAnimationFrame( updateDimensions._tick );
			}
			updateDimensions._tick = requestAnimationFrame( function() {
				updateDimensions._tick = null;
				// Make the homepage content full width and centrally aligned.
				homepageContent.style.width = window.innerWidth + 'px';
				if ( htmlDirValue !== 'rtl' ) {
					homepageContent.style.marginLeft = -siteMain.getBoundingClientRect().left + 'px';
				} else {
					homepageContent.style.marginRight = -siteMain.getBoundingClientRect().left + 'px';
				}
			} );
		};
		// On window resize, set hero content dimensions / layout.
		window.addEventListener( 'resize', updateDimensions );
		updateDimensions();

		var img = homepageContent.getAttribute( 'data-featured-image' ).replace( /url\(\"(.*)\"\)/gi, '$1' );

		window.RGBaster.colors( img, {
			paletteSize: 1,
			success: function( payload ) {
				var rgb = payload.dominant;
				var colors = rgb.match( /^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/ );

				var r = colors[1];
				var g = colors[2];
				var b = colors[3];
				var brightness = 1;
				// Get the average rgb value.
				var overall = Math.round( ( ( parseInt( r, 10 ) * 299 ) + ( parseInt( g, 10 ) * 587 ) + ( parseInt( b, 10 ) * 114 ) ) / 1000 );
				if ( overall > 230 ) {
					brightness = 0; // Black.
				} else {
					brightness = 30; // White.
				}

				var newr = Math.floor( ( 255 - r ) * brightness );
				var newg = Math.floor( ( 255 - g ) * brightness );
				var newb = Math.floor( ( 255 - b ) * brightness );
				var color = 'rgb(' + newr + ', ' + newg + ', ' + newb + ')';

				homepageContent.style.color = color;
				homepageContent.querySelectorAll( 'h1' ).forEach( function( h1 ) {
					h1.style.color = color;
				} );
				homepageContent.querySelectorAll( '.entry-title, .entry-content' ).forEach( function( el ) {
					el.classList.add( 'loaded' );
					el.style.textShadow = brightness >= 30 ? '0 4px 30px rgba(0,0,0,.9)' : '';
				} );
			}
		} );
	} );

} )();
