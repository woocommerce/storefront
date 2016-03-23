jQuery( window ).load( function() {
	var windowHeight	= jQuery( window ).height();
	var paymentHeight	= jQuery( '#order_review' ).height();

	/**
	 * Make the order review element stick to the top of the browser window.
	 */
	function stickyPayment() {
		var topDistance 		= jQuery( document ).scrollTop();
		var paymentWidth		= jQuery( '#order_review_heading' ).outerWidth();
		var	checkoutWidth		= jQuery( 'form.woocommerce-checkout' ).outerWidth();
		var	addressWidth		= jQuery( '#customer_details' ).outerWidth();
		var	gutter				= checkoutWidth - addressWidth - paymentWidth;
		var	paymentOffset		= addressWidth + gutter;
		var checkoutPosition 	= jQuery( '#order_review_heading' ).offset();

		// If we're in desktop orientation...
		if ( jQuery( window ).width() > 768 ) {

			// When we reach the order review element during scroll...
		   	if ( topDistance > checkoutPosition.top ) {
				jQuery( '#order_review' ).addClass( 'payment-fixed' );
				jQuery( '#order_review' ).css({
					'margin-left':		paymentOffset,
					'width':			paymentWidth
				});
		   	} else {
				jQuery( '#order_review' ).removeAttr( 'style' ).removeClass( 'payment-fixed' );
		   	}
		} else {
			jQuery( '#order_review' ).removeAttr( 'style' ).removeClass( 'payment-fixed' );
		}
	}

	// Only execute the sticky function if the window is large enough to accomodate the order review element
	// Otherwise the 'place order' button could be off the bottom of the window and completely inaccessible.

	// Figure out which payment method has the largest payment box
	var tallestPaymentBox = -1;
	jQuery( '.payment_box' ).each( function() {
		tallestPaymentBox = tallestPaymentBox > jQuery( this ).outerHeight() ? tallestPaymentBox : jQuery( this ).outerHeight();
	});

	// Figure out the height of the current payment box
	var currentPaymentBox = jQuery( '.wc_payment_method input:checked' ).siblings( '.payment_box' ).outerHeight();

	if ( windowHeight > paymentHeight + ( tallestPaymentBox - currentPaymentBox + 30 ) ) {

		// Do sticky on scroll
	   	jQuery( window ).scroll( function() {
			stickyPayment();
	   	});

	   	// Do sticky on window resize
		jQuery( window ).resize( function() {
			stickyPayment();
	   	});
	}
});