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

		if ( ! homepageContent ) {

			// Only apply layout to the homepage content component if it exists on the page
			return;
		}

		for ( var i = 0; i < homepageContent.querySelectorAll( '.entry-title, .entry-content' ).length; i++ ) {
			homepageContent.querySelectorAll( '.entry-title, .entry-content' )[ i ].classList.add( 'loaded' );
		}

		var siteMain         = document.querySelector( '.site-main' );
		var htmlDirValue     = document.documentElement.getAttribute( 'dir' );
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
	} );

} )();
