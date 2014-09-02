/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	wp.customize( 'storefront_footer_heading_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6' ).css( 'color', to );
		} );
	} );
	wp.customize( 'storefront_footer_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css( 'color', to );
		} );
	} );
	wp.customize( 'storefront_footer_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer a:not(.button)' ).css( 'color', to );
		} );
	} );
	wp.customize( 'storefront_footer_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css( 'background-color', to );
		} );
	} );
} )( jQuery );
