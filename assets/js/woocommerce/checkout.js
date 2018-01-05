document.addEventListener( 'DOMContentLoaded', function() {

	// Do sticky on scroll
	document.addEventListener( 'scroll', stickyPayment );
	// Do sticky on window resize
	window.addEventListener( 'resize', stickyPayment );

	/**
	 * Make the order review element stick to the top of the browser window.
	 */
	function stickyPayment() {
		if ( stickyPayment._tick ) {
			cancelAnimationFrame( stickyPayment._tick );
		}
		stickyPayment._tick = requestAnimationFrame( function() {
			stickyPayment._tick = null;

			var review = document.querySelector( '#order_review' );
			var heading = document.querySelector( '#order_review_heading' );
			var checkout = document.querySelector( 'form.woocommerce-checkout' );
			var details = document.querySelector( '#customer_details' );
			if ( !heading || !checkout || !details ) {
				return;
			}

			var tallestPaymentBox = -1;
			var currentPaymentBox = -1;
			document.querySelectorAll( '.payment_box' ).forEach( function( box ) {
				var boxHeight = box.offsetHeight;
				tallestPaymentBox = Math.max( tallestPaymentBox, boxHeight );
				if ( box.querySelector( 'input:checked' ) ) {
					currentPaymentBox = boxHeight;
				}
			} );

			var termsHeight = 0; // If terms aren't being displayed don't include their height in calculations
			if ( document.querySelector( '.wc-terms-and-conditions' ) ) {
				termsHeight = 216; // This is static and set by WooCommerce core + 16px margin added by Storefront
			}
			var expandedHeight = review.offsetHeight + termsHeight + ( tallestPaymentBox - currentPaymentBox + 30 );

			// If we're in desktop orientation and the order review column is taller than the customer details column and smaller than the window height
			if ( details.offsetHeight > expandedHeight && window.innerWidth > 768 && window.innerHeight > expandedHeight ) {
				if ( document.body.scrollTop > heading.getBoundingClientRect().top ) {
					var paymentWidth = review.offsetWidth;
					var paymentOffset = checkout.offsetWidth - paymentWidth;
					review.classList.add( 'payment-fixed' );
					review.style.width = paymentWidth + 'px';
					// Compute only once rtl.
					if ( review._isRTL === undefined ) {
						review._isRTL = getComputedStyle( review ).direction === 'rtl';
					}
					if ( review._isRTL ) {
						review.style.marginRight = paymentOffset + 'px';
					} else {
						review.style.marginLeft = paymentOffset + 'px';
					}
				} else {
					review.classList.remove( 'payment-fixed' );
					review.removeAttribute( 'style' );
				}
			}
		} );
	}
} );
