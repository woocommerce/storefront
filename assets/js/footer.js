/**
 * footer.js
 *
 * Adds a class required to reveal the search in the handheld footer bar.
 * Also hides the handheld footer bar when an input is focused.
 */
( function () {
	// Wait for DOM to be ready.
	document.addEventListener( 'DOMContentLoaded', function () {
		if (
			document.getElementsByClassName( 'storefront-handheld-footer-bar' )
				.length === 0
		) {
			return;
		}

		// Add class to footer search when clicked.
		[].forEach.call(
			document.querySelectorAll(
				'.storefront-handheld-footer-bar .search > a'
			),
			function ( anchor ) {
				anchor.addEventListener( 'click', function ( event ) {
					anchor.parentElement.classList.toggle( 'active' );
					event.preventDefault();
				} );
			}
		);

		// Add focus class to body when an input field is focused.
		// This is used to hide the Handheld Footer Bar when an input is focused.
		const footerBar = document.getElementsByClassName(
			'storefront-handheld-footer-bar'
		);
		const forms = document.forms;
		const isFocused = function ( focused ) {
			return function ( event ) {
				if ( !! focused && event.target.tabIndex !== -1 ) {
					document.body.classList.add( 'sf-input-focused' );
				} else {
					document.body.classList.remove( 'sf-input-focused' );
				}
			};
		};

		if ( footerBar.length && forms.length ) {
			for ( let i = 0; i < forms.length; i++ ) {
				if ( footerBar[ 0 ].contains( forms[ i ] ) ) {
					continue;
				}

				forms[ i ].addEventListener( 'focus', isFocused( true ), true );
				forms[ i ].addEventListener( 'blur', isFocused( false ), true );
			}
		}
	} );
} )();
