<?php
/**
 * storefront Theme Customizer display functions
 *
 * @package storefront
 */

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'storefront_add_customizer_css' ) ) {
	function storefront_add_customizer_css() {

		$accent_color 					= storefront_sanitize_hex_color( get_theme_mod( 'storefront_accent_color' ) );
		$header_background_color 		= storefront_sanitize_hex_color( get_theme_mod( 'storefront_header_background_color' ) );
		$header_link_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_header_link_color' ) );
		$header_text_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_header_text_color' ) );

		$footer_background_color 		= storefront_sanitize_hex_color( get_theme_mod( 'storefront_footer_background_color' ) );
		$footer_link_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_footer_link_color' ) );
		$footer_heading_color 			= storefront_sanitize_hex_color( get_theme_mod( 'storefront_footer_heading_color' ) );
		$footer_text_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_footer_text_color' ) );

		$text_color 					= storefront_sanitize_hex_color( get_theme_mod( 'storefront_text_color' ) );
		$heading_color 					= storefront_sanitize_hex_color( get_theme_mod( 'storefront_heading_color' ) );
		$button_background_color 		= storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_background_color' ) );
		$button_text_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_text_color' ) );
		$button_alt_background_color 	= storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_alt_background_color' ) );
		$button_alt_text_color 			= storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_alt_text_color' ) );

		$brighten_factor 			= apply_filters( 'storefront_brighten_factor', 25 );
		$darken_factor 				= apply_filters( 'storefront_darken_factor', -25 );
		?>
		<!-- storefront customizer CSS -->
		<style>

			<?php if ( isset( $$accent_color ) ) { ?>
			a:hover {
				color: <?php echo storefront_adjust_color_brightness( $accent_color, $brighten_factor ); ?>;
			}
			<?php } ?>

			.main-navigation ul li a,
			.site-title a,
			a.cart-contents,
			.site-header-cart .widget_shopping_cart a,
			ul.menu li a {
				color: <?php echo $header_link_color; ?>;
			}

			<?php if ( isset( $header_link_color ) ) { ?>

			.main-navigation ul li a:hover,
			.site-title a:hover,
			a.cart-contents:hover,
			.site-header-cart .widget_shopping_cart a:hover {
				color: <?php echo storefront_adjust_color_brightness( $header_link_color, $darken_factor ); ?>;
			}

			<?php } ?>

			.site-header,
			.main-navigation ul ul,
			.secondary-navigation ul ul,
			.main-navigation ul.menu > li.menu-item-has-children:after,
			.site-header-cart .widget_shopping_cart,
			.secondary-navigation ul.menu ul {
				background-color: <?php echo $header_background_color; ?>;
			}

			p.site-description,
			ul.menu li.current-menu-item > a {
				color: <?php echo $header_text_color; ?>;
			}

			h1, h2, h3, h4, h5, h6 {
				color: <?php echo $heading_color; ?>;
			}

			.hentry .entry-header {
				border-color: <?php echo $heading_color; ?>;
			}

			.widget h1 {
				border-bottom-color: <?php echo $heading_color; ?>;
			}

			body,
			.secondary-navigation a,
			.woocommerce-tabs ul.tabs li.active a,
			ul.products li.product .price,
			.widget-area .widget a,
			.onsale {
				color: <?php echo $text_color; ?>;
			}

			.onsale {
				border-color: <?php echo $text_color; ?>;
			}

			a,
			.star-rating span:before,
			.widget-area .widget a:hover,
			.product_list_widget a:hover,
			.quantity .plus, .quantity .minus,
			p.stars a:hover:after {
				color: <?php echo $accent_color; ?>;
			}

			.widget_price_filter .ui-slider .ui-slider-range {
				background-color: <?php echo $accent_color; ?>;
			}

			#order_review_heading, #order_review {
				border-color: <?php echo $accent_color; ?>;
			}

			button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart, .widget-area .widget a.button, .site-header-cart .widget_shopping_cart a.button {
				background-color: <?php echo $button_background_color; ?>;
				border-color: <?php echo $button_background_color; ?>;
				color: <?php echo $button_text_color; ?>;
			}

			button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .widget-area .widget a.button:hover, .site-header-cart .widget_shopping_cart a.button:hover {
				background-color: <?php echo storefront_adjust_color_brightness( $button_background_color, $darken_factor ); ?>;
				border-color: <?php echo storefront_adjust_color_brightness( $button_background_color, $darken_factor ); ?>;
				color: <?php echo $button_text_color; ?>;
			}

			button.alt, input[type="button"].alt, input[type="reset"].alt, input[type="submit"].alt, .button.alt, .added_to_cart.alt, .widget-area .widget a.button.alt, .added_to_cart {
				background-color: <?php echo $button_alt_background_color; ?>;
				border-color: <?php echo $button_alt_background_color; ?>;
				color: <?php echo $button_alt_text_color; ?>;
			}

			button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover, .widget-area .widget a.button.alt:hover, .added_to_cart:hover {
				background-color: <?php echo storefront_adjust_color_brightness( $button_alt_background_color, $darken_factor ); ?>;
				border-color: <?php echo storefront_adjust_color_brightness( $button_alt_background_color, $darken_factor ); ?>;
				color: <?php echo $button_alt_text_color; ?>;
			}

			.site-footer {
				background-color: <?php echo $footer_background_color; ?>;
				color: <?php echo $footer_text_color; ?>;
			}

			.site-footer a:not(.button) {
				color: <?php echo $footer_link_color; ?>;
			}

			.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {
				color: <?php echo $footer_heading_color; ?>;
			}

			@media screen and ( min-width: 768px ) {
				.main-navigation ul.menu > li > ul {
					border-top-color: <?php echo $header_background_color; ?>
				}

				<?php if ( isset( $header_link_color ) ) { ?>

				.secondary-navigation ul.menu a:hover {
					color: <?php echo storefront_adjust_color_brightness( $header_text_color, $brighten_factor ); ?>;
				}

				<?php } ?>

				.main-navigation ul.menu ul {
					background-color: <?php echo $header_background_color; ?>;
				}

				.secondary-navigation ul.menu a,
				.site-header-cart .widget_shopping_cart,
				.site-header .product_list_widget li .quantity {
					color: <?php echo $header_text_color; ?>;
				}
			}
		</style>
	<?php }
}