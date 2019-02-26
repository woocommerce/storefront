/* global storefrontScreenReaderText */

/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 * Also adds a focus class to parent li's for accessibility.
 */
( function() {

	// Wait for DOM to be ready.
	document.addEventListener( 'DOMContentLoaded', function() {
		var container = document.getElementById( 'site-navigation' );
		if ( ! container ) {
			return;
		}

		var button = container.querySelector( 'button' );

		if ( ! button ) {
			return;
		}

		var menu = container.querySelector( 'ul' );

		// Hide menu toggle button if menu is empty and return early.
		if ( ! menu ) {
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

		// Add dropdown toggle that displays child menu items.
		var handheld = document.getElementsByClassName( 'handheld-navigation' );

		if ( handheld.length > 0 ) {
			[].forEach.call( handheld[0].querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' ), function( anchor ) {

				// Add dropdown toggle that displays child menu items
				var btn = document.createElement( 'button' );
				btn.setAttribute( 'aria-expanded', 'false' );
				btn.classList.add( 'dropdown-toggle' );

				var btnSpan = document.createElement( 'span' );
				btnSpan.classList.add( 'screen-reader-text' );
				btnSpan.appendChild( document.createTextNode( storefrontScreenReaderText.expand ) );

				btn.appendChild( btnSpan );

				anchor.parentNode.insertBefore( btn, anchor.nextSibling );

				// Set the active submenu dropdown toggle button initial state
				if ( anchor.parentNode.classList.contains( 'current-menu-ancestor' ) ) {
					btn.setAttribute( 'aria-expanded', 'true' );
					btn.classList.add( 'toggled-on' );
					btn.nextElementSibling.classList.add( 'toggled-on' );
				}

				// Add event listener
				btn.addEventListener( 'click', function() {
					btn.classList.toggle( 'toggled-on' );

					// Remove text inside span
					while ( btnSpan.firstChild ) {
						btnSpan.removeChild( btnSpan.firstChild );
					}

					var expanded = btn.classList.contains( 'toggled-on' );

					btn.setAttribute( 'aria-expanded', expanded );
					btnSpan.appendChild( document.createTextNode( expanded ? storefrontScreenReaderText.collapse : storefrontScreenReaderText.expand ) );
					btn.nextElementSibling.classList.toggle( 'toggled-on' );
				} );
			} );
		}

		// Add focus class to parents of sub-menu anchors.
		[].forEach.call( document.querySelectorAll( '.site-header .menu-item > a, .site-header .page_item > a, .site-header-cart a' ), function( anchor ) {
			anchor.addEventListener( 'focus', function() {

				// Remove focus class from other sub-menus previously open.
				var elems = document.querySelectorAll( '.focus' );

				[].forEach.call( elems, function( el ) {
					if ( ! el.contains( anchor ) ) {
						el.classList.remove( 'focus' );

						// Remove blocked class, if it exists.
						if ( el.firstChild && el.firstChild.classList ) {
							el.firstChild.classList.remove( 'blocked' );
						}
					}
				} );

				// Add focus class.
				var li = anchor.parentNode;

				li.classList.add( 'focus' );
			} );
		} );

		// Add an identifying class to dropdowns when on a touch device
		// This is required to switch the dropdown hiding method from a negative `left` value to `display: none`.
		if ( ( 'ontouchstart' in window || navigator.maxTouchPoints ) && window.innerWidth > 767 ) {
			[].forEach.call( document.querySelectorAll( '.site-header ul ul, .site-header-cart .widget_shopping_cart' ), function( element ) {
				element.classList.add( 'sub-menu--is-touch-device' );
			} );

			// Add blocked class to links that open sub-menus, and prevent from navigating away on first touch.
			var acceptClick = false;

			[].forEach.call( document.querySelectorAll( '.site-header .menu-item > a, .site-header .page_item > a, .site-header-cart a' ), function( anchor ) {
				anchor.addEventListener( 'click', function( event ) {
					if ( anchor.classList.contains( 'blocked' ) && false === acceptClick ) {
						event.preventDefault();
					}

					acceptClick = false;
				} );

				anchor.addEventListener( 'pointerup', function( event ) {
					if ( anchor.classList.contains( 'blocked' ) || 'mouse' === event.pointerType ) {
						acceptClick = true;
					} else if ( ( 'cart-contents' === anchor.className && anchor.parentNode.nextElementSibling && '' !== anchor.parentNode.nextElementSibling.textContent.trim() ) || anchor.nextElementSibling ) {
						anchor.classList.add( 'blocked' );
					} else {
						acceptClick = true;
					}
				} );
			} );

			// Ensure the dropdowns close when user taps outside the site header
			[].forEach.call( document.querySelectorAll( 'body #page > :not( .site-header )' ), function( element ) {
				element.addEventListener( 'click', function() {
					[].forEach.call( document.querySelectorAll( '.focus, .blocked' ), function( el ) {
					 	el.classList.remove( 'focus' );
					 	el.classList.remove( 'blocked' );
					} );
				} );
			} );
		}
	} );
} )();
