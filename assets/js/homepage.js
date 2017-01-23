/**
 * homepage.js
 *
 * Handles behaviour of the homepage featured image
 */
( function() {
	var homepageContent = '.page-template-template-homepage .type-page.has-post-thumbnail';
	var windowWidth	    = jQuery( window ).width();
	var offset          = jQuery( '.site-main' ).offset();

	// Make the homepage content full width and centrally aligned.
	jQuery( homepageContent ).css( 'width', windowWidth ).css( 'margin-left', -offset.left );

	jQuery(document).ready(function(){
		jQuery.adaptiveBackground.run({
			success: function( $img, data ) {
				var rgb        = data.color;
				var colors     = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
				var brightness = 1;

				var r = colors[1];
				var g = colors[2];
				var b = colors[3];

				var ir = Math.floor( ( 255 - r ) * brightness );
				var ig = Math.floor( ( 255 - g ) * brightness );
				var ib = Math.floor( ( 255 - b ) * brightness );

				jQuery( homepageContent + ', .page-template-template-homepage .type-page.has-post-thumbnail h1' ).css( 'color', 'rgb(' + ir + ', ' + ig + ', ' + ib + ')' );
				jQuery( '.page-template-template-homepage .type-page.has-post-thumbnail .entry-title, .page-template-template-homepage .type-page.has-post-thumbnail .entry-content' ).addClass( 'loaded' );
			}
		});
	});
} )();
