<?php
/**
 * General functions used to integrate this theme with WooCommerce.
 *
 * @package storefront
 */

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'storefront_before_content' ) ) {
	function storefront_before_content() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
	    	<?php
	}
}

/**
 * After Content
 * Closes the wrapping divs
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'storefront_after_content' ) ) {
	function storefront_after_content() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php do_action( 'storefront_sidebar' );
	}
}

/**
 * Default loop columns on product archives
 * @return integer products per row
 * @since  1.0.0
 */
function storefront_loop_columns() {
	return apply_filters( 'storefront_loop_columns', 3 ); // 3 products per row
}

/**
 * Add 'woocommerce-active' class to the body tag
 * @param  array $classes
 * @return array $classes modified to include 'woocommerce-active' class
 */
function storefront_woocommerce_body_class( $classes ) {
	if ( is_woocommerce_activated() ) {
		$classes[] = 'woocommerce-active';
	}

	return $classes;
}

/**
 * Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 * @param  array $fragments Fragments to refresh via AJAX
 * @return array            Fragments to refresh via AJAX
 */
if ( ! function_exists( 'storefront_cart_link_fragment' ) ) {
	function storefront_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		storefront_cart_link();

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

/**
 * WooCommerce specific scripts & stylesheets
 * @since 1.0.0
 */
function storefront_woocommerce_scripts() {
	global $storefront_version;

	wp_enqueue_style( 'storefront-woocommerce-style', get_template_directory_uri() . '/inc/woocommerce/css/woocommerce.css', $storefront_version );
	wp_style_add_data( 'storefront-woocommerce-style', 'rtl', 'replace' );
}

/**
 * Related Products Args
 * @param  array $args related products args
 * @since 1.0.0
 * @return  array $args related products args
 */
function storefront_related_products_args( $args ) {
	$args = apply_filters( 'storefront_related_products_args', array(
		'posts_per_page' => 3,
		'columns'        => 3,
	) );

	return $args;
}

/**
 * Product gallery thumnail columns
 * @return integer number of columns
 * @since  1.0.0
 */
function storefront_thumbnail_columns() {
	return intval( apply_filters( 'storefront_product_thumbnail_columns', 4 ) );
}

/**
 * Products per page
 * @return integer number of products
 * @since  1.0.0
 */
function storefront_products_per_page() {
	return intval( apply_filters( 'storefront_products_per_page', 12 ) );
}

/**
 * Query WooCommerce Extension Activation.
 * @var  $extension main extension class name
 * @return boolean
 */
function is_woocommerce_extension_activated( $extension = 'WC_Bookings' ) {
	return class_exists( $extension ) ? true : false;
}