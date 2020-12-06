/* global ajaxurl, storefrontNUX */
( function( wp, $ ) {
	'use strict';

	if ( ! wp ) {
		return;
	}

	function dismiss_nux() {
		$.ajax({
			type:     'POST',
			url:      ajaxurl,
			data:     { nonce: storefrontNUX.nonce, action: 'storefront_dismiss_notice' },
			dataType: 'json'
		});
	}

	$( function() {
		// Dismiss notice
		$( document ).on( 'click', '.sf-notice-nux .notice-dismiss', function() {
			dismiss_nux();
		});

		// Dismiss notice inside theme page.
		$( document ).on( 'click', '.sf-nux-dismiss-button', function() {
			dismiss_nux();
			$( '.storefront-intro' ).hide( 500 );
		});
	});
})( window.wp, jQuery );