/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 * Also adds a focus class to parent li's for accessibility.
 * Finally adds a class required to reveal the search in the handheld footer bar.
 */
( function() {
	// Wait for DOM to be ready.
	document.addEventListener( 'DOMContentLoaded', function() {
		var container = document.getElementById( 'site-navigation' );
		if ( !container ) {
			return;
		}

		var button = container.querySelector( 'button' );
		if ( !button ) {
			return;
		}

		var menu = container.querySelector( 'ul' );
		// Hide menu toggle button if menu is empty and return early.
		if ( !menu ) {
			button.style.display = 'none';
			return;
		}

		button.setAttribute( 'aria-expanded', 'false' );
		menu.setAttribute( 'aria-expanded', 'false' );
		menu.classList.add( 'nav-menu' );

		button.addEventListener( 'click', function() {
			container.classList.toggle( 'toggled' );
			var expanded = container.classList.contains( 'toggled' ) ? 'true' : 'false';
			button.setAttribute( 'aria-expanded', expanded );
			menu.setAttribute( 'aria-expanded', expanded );
		} );

		// Add class to footer search when clicked.
		document.querySelectorAll( '.storefront-handheld-footer-bar .search > a' ).forEach( function( anchor ) {
			anchor.addEventListener( 'click', function( event ) {
				anchor.parentElement.classList.toggle( 'active' );
				event.preventDefault();
			} );
		} );

		// Add focus class to parents of sub-menu anchors.
		document.querySelectorAll( '.site-header .menu-item > a, .site-header .page_item > a, .site-header-cart a' ).forEach( function( anchor ) {
			var li = anchor.parentNode;
			anchor.addEventListener( 'focus', function() {
				li.classList.add( 'focus' );
			} );
			anchor.addEventListener( 'blur', function() {
				li.classList.remove( 'focus' );
			} );
		} );

		// Add an identifying class to dropdowns when on a touch device
		// This is required to switch the dropdown hiding method from a negative `left` value to `display: none`.
		if ( ( 'ontouchstart' in window || navigator.maxTouchPoints ) && window.innerWidth > 767 ) {
			document.querySelectorAll( '.site-header ul ul, .site-header-cart .widget_shopping_cart' ).forEach( function( element ) {
				element.classList.add( 'sub-menu--is-touch-device' );
			} );
		}
	} );

} )();
