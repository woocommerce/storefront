/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and adds a focus class to parent li's for accessibility.
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Add focus class to li
	jQuery( '.main-navigation, .secondary-navigation' ).find( 'a' ).on( 'focus.storefront blur.storefront', function() {
		jQuery( this ).parents().toggleClass( 'focus' );
	});

	// Add focus to cart dropdown
	jQuery( window ).load( function() {
		jQuery( '.site-header-cart' ).find( 'a' ).on( 'focus.storefront blur.storefront', function() {
			jQuery( this ).parents().toggleClass( 'focus' );
		});
	});

} )();
