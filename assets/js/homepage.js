/**
 * homepage.js
 *
 * Handles behaviour of the homepage featured image
 */
( function () {
	/**
	 * Set hero content dimensions / layout
	 * Run adaptive backgrounds and set colors
	 */
	document.addEventListener( 'DOMContentLoaded', function () {
		const homepageContent = document.querySelector(
			'.page-template-template-homepage .type-page.has-post-thumbnail'
		);

		if ( ! homepageContent ) {
			// Only apply layout to the homepage content component if it exists on the page
			return;
		}

		const entries = homepageContent.querySelectorAll(
			'.entry-title, .entry-content'
		);
		for ( let i = 0; i < entries.length; i++ ) {
			entries[ i ].classList.add( 'loaded' );
		}

		const siteMain = document.querySelector( '.site-main' );
		const htmlDirValue = document.documentElement.getAttribute( 'dir' );

		const updateDimensions = function () {
			if ( updateDimensions._tick ) {
				window.cancelAnimationFrame( updateDimensions._tick );
			}

			updateDimensions._tick = window.requestAnimationFrame( function () {
				updateDimensions._tick = null;

				// Make the homepage content full width and centrally aligned.
				homepageContent.style.width = window.innerWidth + 'px';

				if ( htmlDirValue !== 'rtl' ) {
					homepageContent.style.marginLeft =
						-siteMain.getBoundingClientRect().left + 'px';
				} else {
					homepageContent.style.marginRight =
						-siteMain.getBoundingClientRect().left + 'px';
				}
			} );
		};

		// On window resize, set hero content dimensions / layout.
		window.addEventListener( 'resize', updateDimensions );
		updateDimensions();
	} );
} )();
