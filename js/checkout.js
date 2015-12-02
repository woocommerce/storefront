jQuery( document ).ready( function( $ ) {
	var windowHeight	= $( window ).height();
	var paymentHeight	= $( '#order_review' ).height();

	/**
	 * Make the order review element stick to the top of the browser window.
	 */
	function stickyPayment() {
		var topDistance 		= $( document ).scrollTop();
		var paymentWidth		= $( '#order_review_heading' ).outerWidth();
		var	checkoutWidth		= $( 'form.woocommerce-checkout' ).outerWidth();
		var	addressWidth		= $( '#customer_details' ).outerWidth();
		var	gutter				= checkoutWidth - addressWidth - paymentWidth;
		var	paymentOffset		= addressWidth + gutter;
		var checkoutPosition 	= $( 'form.woocommerce-checkout' ).offset();

		// If we're in desktop orientation...
		if ( $( window ).width() > 768 ) {

			// When we reach the order review element during scroll...
		   	if ( topDistance > checkoutPosition.top ) {
				$( '#order_review' ).addClass( 'payment-fixed' );
				$( '#order_review' ).css({
					'margin-left':		paymentOffset,
					'width':			paymentWidth
				});
		   	} else {
				$( '#order_review' ).removeAttr( 'style' ).removeClass( 'payment-fixed' );
		   	}
		} else {
			$( '#order_review' ).removeAttr( 'style' ).removeClass( 'payment-fixed' );
		}
	}

	// Only execute the sticky function if the window is large enough to accomodate the order review element
	// Otherwise the 'place order' button could be off the bottom of the window and completely inaccessible.
	if ( windowHeight > paymentHeight ) {

		// Do sticky on scroll
	   	$( window ).scroll( function() {
			stickyPayment();
	   	});

	   	// Do sticky on window resize
		$( window ).resize( function() {
			stickyPayment();
	   	});
	}
});