/**
 * Makes the header cart content scrollable if the height of the dropdown exceeds the window height.
 * Apply the CSS on page load and mouseover. Mouseover is used as items can be added to the cart via ajax and we'll need to recheck.
 */
( function() {
	if ( document.body.classList.contains( 'woocommerce-cart' ) || document.body.classList.contains( 'woocommerce-checkout' ) || window.innerWidth < 768 || ! document.getElementById( 'site-header-cart' ) ) {
		return;
	}

	window.addEventListener( 'load', function() {
		var cart = document.querySelector( '.site-header-cart' );

		var windowHeight  = window.outerHeight,
			cartBottomPos = cart.querySelector( '.widget_shopping_cart_content' ).getBoundingClientRect().bottom + cart.offsetHeight,
			cartList      = cart.querySelector( '.cart_list' );

		if ( cartBottomPos > windowHeight ) {
			cartList.style.maxHeight = '15em';
			cartList.style.overflowY = 'auto';
		}

		cart.addEventListener( 'mouseover', function() {

			if ( cartBottomPos > windowHeight ) {
				cartList.style.maxHeight = '15em';
				cartList.style.overflowY = 'auto';
			}
		} );
	} );
} )();
