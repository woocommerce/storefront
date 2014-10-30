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
	if ( class_exists( 'WC_Bookings' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-bookings-style', get_template_directory_uri() . '/inc/woocommerce/css/bookings.css' );
	}

	/**
	 * Brands
	 */
	if ( class_exists( 'WC_Brands' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-brands-style', get_template_directory_uri() . '/inc/woocommerce/css/brands.css' );
	}

	/**
	 * Wishlists
	 */
	if ( class_exists( 'WC_Wishlists_Wishlist' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-wishlists-style', get_template_directory_uri() . '/inc/woocommerce/css/wishlists.css' );
	}

	/**
	 * AJAX Layered Nav
	 */
	if ( class_exists( 'SOD_Widget_Ajax_Layered_Nav' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-ajax-layered-nav-style', get_template_directory_uri() . '/inc/woocommerce/css/ajax-layered-nav.css' );
	}

	/**
	 * Variation Swatches
	 */
	if ( class_exists( 'WC_SwatchesPlugin' ) ) {
		wp_enqueue_style( 'storefront-variation-swatches-style', get_template_directory_uri() . '/inc/woocommerce/css/variation-swatches.css' );
	}

	/**
	 * Composite Products
	 */
	if ( class_exists( 'WC_Composite_Products' ) ) {
		wp_enqueue_style( 'storefront-composite-products-style', get_template_directory_uri() . '/inc/woocommerce/css/composite-products.css' );
	}

	/**
	 * WooCommerce Photography
	 */
	if ( class_exists( 'WC_Photography' ) ) {
		wp_enqueue_style( 'storefront-woocommerce-photography-style', get_template_directory_uri() . '/inc/woocommerce/css/photography.css' );
	}
}

/**
 * Integrations layout tweaks
 * @return void
 */
function storefront_woocommerce_integrations_layout() {
	/**
	 * WooCommerce Photography
	 */
	if ( class_exists( 'WC_Photography' ) ) {
		remove_action( 'wc_photography_before_main_content', 'woocommerce_breadcrumb', 20 );
	}
}

/**
 * Add CSS in <head> for integration styles handled by the theme customizer
 *
 * @since 1.0
 */
if ( ! function_exists( 'storefront_add_bookings_customizer_css' ) ) {
	function storefront_add_bookings_customizer_css() {

		if ( current_theme_supports( 'storefront-customizer-settings' ) ) {
			$accent_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_accent_color' ) );
			$header_background_color 	= storefront_sanitize_hex_color( get_theme_mod( 'storefront_header_background_color' ) );
			$header_link_color 			= storefront_sanitize_hex_color( get_theme_mod( 'storefront_header_link_color' ) );
			$header_text_color 			= storefront_sanitize_hex_color( get_theme_mod( 'storefront_header_text_color' ) );
			$text_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_text_color' ) );
			$heading_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_heading_color' ) );
			?>
			<!-- column customizer CSS -->
			<style>
				<?php
				/**
				 * Bookings
				 */
				if ( class_exists( 'WC_Bookings' ) ) { ?>
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a,
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a:hover,
					#wc-bookings-booking-form .block-picker li a:hover,
					#wc-bookings-booking-form .block-picker li a.selected {
						background-color: <?php echo $accent_color; ?> !important;
					}

					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.ui-state-disabled .ui-state-default,
					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker th {
						color: <?php echo $text_color; ?>;
					}

					#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker-header {
						background-color: <?php echo $header_background_color; ?>;
						color: <?php echo $header_text_color; ?>;
					}
				<?php } ?>
			</style>
	<?php }
	}
}