<?php
/**
 * Integration logic for WooCommerce extensions
 *
 * @package storefront
 */

/**
 * Styles & Scripts
 * @return void
 */
function storefront_woocommerce_integrations_scripts() {
	/**
	 * Bookings
	 */
	if ( is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-bookings-style', get_template_directory_uri() . '/inc/woocommerce/css/bookings.css', 'storefront-woocommerce-style' );
		wp_style_add_data( 'storefront-woocommerce-bookings-style', 'rtl', 'replace' );
	}

	/**
	 * Brands
	 */
	if ( is_woocommerce_extension_activated( 'WC_Brands' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-brands-style', get_template_directory_uri() . '/inc/woocommerce/css/brands.css', 'storefront-woocommerce-style' );
		wp_style_add_data( 'storefront-woocommerce-brands-style', 'rtl', 'replace' );
	}

	/**
	 * Wishlists
	 */
	if ( is_woocommerce_extension_activated( 'WC_Wishlists_Wishlist' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-wishlists-style', get_template_directory_uri() . '/inc/woocommerce/css/wishlists.css', 'storefront-woocommerce-style' );
		wp_style_add_data( 'storefront-woocommerce-wishlists-style', 'rtl', 'replace' );
	}

	/**
	 * AJAX Layered Nav
	 */
	if ( is_woocommerce_extension_activated( 'SOD_Widget_Ajax_Layered_Nav' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-ajax-layered-nav-style', get_template_directory_uri() . '/inc/woocommerce/css/ajax-layered-nav.css', 'storefront-woocommerce-style' );
		wp_style_add_data( 'storefront-woocommerce-ajax-layered-nav-style', 'rtl', 'replace' );
	}

	/**
	 * Variation Swatches
	 */
	if ( is_woocommerce_extension_activated( 'WC_SwatchesPlugin' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-variation-swatches-style', get_template_directory_uri() . '/inc/woocommerce/css/variation-swatches.css', 'storefront-woocommerce-style' );
		wp_style_add_data( 'storefront-woocommerce-variation-swatches-style', 'rtl', 'replace' );
	}

	/**
	 * Composite Products
	 */
	if ( is_woocommerce_extension_activated( 'WC_Composite_Products' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-composite-products-style', get_template_directory_uri() . '/inc/woocommerce/css/composite-products.css', 'storefront-woocommerce-style' );
		wp_style_add_data( 'storefront-woocommerce-composite-products-style', 'rtl', 'replace' );
	}

	/**
	 * WooCommerce Photography
	 */
	if ( is_woocommerce_extension_activated( 'WC_Photography' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-photography-style', get_template_directory_uri() . '/inc/woocommerce/css/photography.css', 'storefront-woocommerce-style' );
		wp_style_add_data( 'storefront-woocommerce-photography-style', 'rtl', 'replace' );
	}

	/**
	 * Product Reviews Pro
	 */
	if ( is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-product-reviews-pro-style', get_template_directory_uri() . '/inc/woocommerce/css/product-reviews-pro.css', 'storefront-woocommerce-style' );
		wp_style_add_data( 'storefront-woocommerce-product-reviews-pro-style', 'rtl', 'replace' );
	}

	/**
	 * WooCommerce Smart Coupons
	 */
	if ( is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-smart-coupons-style', get_template_directory_uri() . '/inc/woocommerce/css/smart-coupons.css', 'storefront-woocommerce-style' );
		wp_style_add_data( 'storefront-woocommerce-smart-coupons-style', 'rtl', 'replace' );
	}

	/**
	 * WooCommerce Deposits
	 */
	if ( is_woocommerce_extension_activated( 'WC_Deposits' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-deposits-style', get_template_directory_uri() . '/inc/woocommerce/css/deposits.css', 'storefront-woocommerce-style' );
		wp_style_add_data( 'storefront-woocommerce-deposits-style', 'rtl', 'replace' );
	}

	/**
	 * WooCommerce Product Bundles
	 */
	if ( is_woocommerce_extension_activated( 'WC_Bundles' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-bundles-style', get_template_directory_uri() . '/inc/woocommerce/css/bundles.css', 'storefront-woocommerce-style' );
		wp_style_add_data( 'storefront-woocommerce-bundles-style', 'rtl', 'replace' );
	}
}

/**
 * Add CSS in <head> for integration styles handled by the theme customizer
 *
 * @since 1.0
 */
if ( ! function_exists( 'storefront_add_integrations_customizer_css' ) ) {
	function storefront_add_integrations_customizer_css() {

		if ( is_storefront_customizer_enabled() ) {
			$accent_color 					= storefront_sanitize_hex_color( get_theme_mod( 'storefront_accent_color', apply_filters( 'storefront_default_accent_color', '#96588a' ) ) );
			$header_text_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_header_text_color', apply_filters( 'storefront_default_header_text_color', '#9aa0a7' ) ) );
			$header_background_color 		= storefront_sanitize_hex_color( get_theme_mod( 'storefront_header_background_color', apply_filters( 'storefront_default_header_background_color', '#2c2d33' ) ) );
			$text_color 					= storefront_sanitize_hex_color( get_theme_mod( 'storefront_text_color', apply_filters( 'storefront_default_text_color', '#60646c' ) ) );
			$button_background_color 		= storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_background_color', apply_filters( 'storefront_default_button_background_color', '#60646c' ) ) );
			$button_text_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_text_color', apply_filters( 'storefront_default_button_text_color', '#ffffff' ) ) );

			$woocommerce_style 				= '';

			if ( is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
				$woocommerce_style 					.= '
				#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a,
				#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a:hover,
				#wc-bookings-booking-form .block-picker li a:hover,
				#wc-bookings-booking-form .block-picker li a.selected {
					background-color: ' . $accent_color . ' !important;
				}

				#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.ui-state-disabled .ui-state-default,
				#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker th {
					color:' . $text_color . ';
				}

				#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker-header {
					background-color: ' . $header_background_color . ';
					color: ' . $header_text_color . ';
				}';
			}

			if ( is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
				$woocommerce_style 					.= '
				.woocommerce #reviews .product-rating .product-rating-details table td.rating-graph .bar,
				.woocommerce-page #reviews .product-rating .product-rating-details table td.rating-graph .bar {
					background-color: ' . $text_color . ' !important;
				}

				.woocommerce #reviews .contribution-actions .feedback,
				.woocommerce-page #reviews .contribution-actions .feedback,
				.star-rating-selector:not(:checked) label.checkbox {
					color: ' . $text_color . ';
				}

				.woocommerce #reviews #comments ol.commentlist li .contribution-actions a,
				.woocommerce-page #reviews #comments ol.commentlist li .contribution-actions a,
				.star-rating-selector:not(:checked) input:checked ~ label.checkbox,
				.star-rating-selector:not(:checked) label.checkbox:hover ~ label.checkbox,
				.star-rating-selector:not(:checked) label.checkbox:hover,
				.woocommerce #reviews #comments ol.commentlist li .contribution-actions a,
				.woocommerce-page #reviews #comments ol.commentlist li .contribution-actions a,
				.woocommerce #reviews .form-contribution .attachment-type:not(:checked) label.checkbox:before,
				.woocommerce-page #reviews .form-contribution .attachment-type:not(:checked) label.checkbox:before {
					color: ' . $accent_color . ' !important;
				}';
			}

			if ( is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
				$woocommerce_style 					.= '
				.coupon-container {
					background-color: ' . $button_background_color . ' !important;
				}

				.coupon-content {
					border-color: ' . $button_text_color . ' !important;
					color: ' . $button_text_color . ';
				}

				.sd-buttons-transparent.woocommerce .coupon-content,
				.sd-buttons-transparent.woocommerce-page .coupon-content {
					border-color: ' . $button_background_color . ' !important;
				}';
			}

			wp_add_inline_style( 'storefront-style', $woocommerce_style );

		}
	}
}
