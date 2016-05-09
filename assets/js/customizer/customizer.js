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
	wp.customize( 'storefront_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body, .widget-area .widget a, .onsale, .woocommerce-tabs ul.tabs li.active a, ul.products li.product .price, .widget-area .widget a, .pagination .page-numbers li .page-numbers:not(.current), .woocommerce-pagination .page-numbers li .page-numbers:not(.current)' ).css( 'color', to );
		} );
	} );
	wp.customize( 'storefront_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.onsale' ).css( 'border-color', to );
		} );
	} );
	wp.customize( 'storefront_heading_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-content h1, .site-content h2, .site-content h3, .site-content h4, .site-content h5, .site-content h6' ).css( 'color', to );
		} );
	} );
	wp.customize( 'storefront_header_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'p.site-description, .secondary-navigation ul.menu li a, .secondary-navigation ul.menu a, .site-header-cart .widget_shopping_cart, .site-header .product_list_widget li .quantity' ).css( 'color', to );
		} );
	} );
	wp.customize( 'storefront_header_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation ul li a, .site-title a, a.cart-contents, .site-header-cart .widget_shopping_cart a' ).css( 'color', to );
		} );
	} );
	wp.customize( 'storefront_header_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-header, .main-navigation ul ul, .secondary-navigation ul ul, .main-navigation ul.menu > li.menu-item-has-children:after, .site-header-cart .widget_shopping_cart, .secondary-navigation ul.menu ul, button.menu-toggle' ).css( 'background-color', to );
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
