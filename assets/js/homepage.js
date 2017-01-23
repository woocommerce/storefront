/**
 * homepage.js
 *
 * Handles behaviour of the homepage featured image
 */
( function() {

	var homepageContent = '.page-template-template-homepage .type-page.has-post-thumbnail';

	function homepageContentDimensions() {
		var windowWidth	    = jQuery( window ).width();
		var offset          = jQuery( '.site-main' ).offset();

		// Make the homepage content full width and centrally aligned.
		jQuery( homepageContent ).css( 'width', windowWidth ).css( 'margin-left', -offset.left );
	}

	jQuery( document ).ready( function() {
		homepageContentDimensions();

		jQuery.adaptiveBackground.run({
			success: function( $img, data ) {
				var rgb        = data.color;
				var colors     = rgb.match( /^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/ );
				var overall    = Math.round( ( ( parseInt( colors[1]) * 299 ) + ( parseInt( colors[2] ) * 587 ) + ( parseInt( colors[3] ) * 114 ) ) /1000 );
				var r          = colors[1];
				var g          = colors[2];
				var b          = colors[3];

				if ( overall > 125 ) {
					var brightness = .5;
				} else {
					var brightness = 2;
				}

				var newr = Math.floor( ( 255 - r ) * brightness );
				var newg = Math.floor( ( 255 - g ) * brightness );
				var newb = Math.floor( ( 255 - b ) * brightness );

				jQuery( homepageContent + ', .page-template-template-homepage .type-page.has-post-thumbnail h1' ).css( 'color', 'rgb(' + newr + ', ' + newg + ', ' + newb + ')' );
				jQuery( '.page-template-template-homepage .type-page.has-post-thumbnail .entry-title, .page-template-template-homepage .type-page.has-post-thumbnail .entry-content' ).addClass( 'loaded' );

				if ( brightness >= 2 ) {
					jQuery( '.page-template-template-homepage .type-page.has-post-thumbnail .entry-title, .page-template-template-homepage .type-page.has-post-thumbnail .entry-content' ).css( 'text-shadow', '0 4px 16px rgba(0,0,0,.3)' );
				}
			}
		});
	});

	jQuery( window ).resize( function() {
		homepageContentDimensions();
	});
} )();
