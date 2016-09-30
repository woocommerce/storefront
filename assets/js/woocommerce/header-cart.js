/**
 * Makes the header cart content scrollable if the height of the dropdown exceeds the window height.
 */
( function() {
	if ( document.body.classList.contains( 'woocommerce-cart' ) || document.body.classList.contains( 'woocommerce-checkout' ) || window.innerWidth < 768 ) {
		return;
	}

	window.addEventListener( 'load', function() {
		var cart = document.querySelector( '.site-header-cart' );

		cart.addEventListener( 'mouseover', function() {
			var windowHeight  = window.outerHeight,
				cartBottomPos = cart.querySelector( '.widget_shopping_cart_content' ).getBoundingClientRect().bottom + cart.offsetHeight,
				cartList      = cart.querySelector( '.cart_list' );

			if ( cartBottomPos > windowHeight ) {
				cartList.style.maxHeight = '15em';
				cartList.style.overflowY = 'auto';

				cart.addEventListener( 'mouseleave', function() {
					cartList.style.maxHeight = '';
					cartList.style.overflowY = '';
				} );
			}
		} );
	} );
} )();
