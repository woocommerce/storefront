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
} )();
