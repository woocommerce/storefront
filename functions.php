<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
* Here’s a basic implementation of One-Click Checkout for WooCommerce. 
* This code allows customers to instantly purchase a product with a single click, skipping the cart page, 
* and proceeding directly to the checkout page with the product already in their cart.
*/

// Redirect to the Checkout page after adding a product to the cart
add_filter('woocommerce_add_to_cart_redirect', 'one_click_checkout_redirect');

function one_click_checkout_redirect($url) {
    // Get the WooCommerce checkout page URL
    $checkout_url = wc_get_checkout_url();
    
    return $checkout_url;
}

// Add a 'Buy Now' button on product pages
add_action('woocommerce_after_add_to_cart_button', 'one_click_checkout_button');

function one_click_checkout_button() {
    global $product;
    
    // Create a custom 'Buy Now' button
    echo '<a href="' . esc_url(add_query_arg('buy_now', $product->get_id())) . '" class="button buy-now-button">Buy Now</a>';
}

// Process the 'Buy Now' action
add_action('template_redirect', 'one_click_checkout_process');

function one_click_checkout_process() {
    if (isset($_GET['buy_now'])) {
        // Clear the cart
        WC()->cart->empty_cart();

        // Get the product ID from the URL
        $product_id = intval($_GET['buy_now']);

        // Add the product to the cart
        WC()->cart->add_to_cart($product_id);

        // Redirect to the checkout page
        wp_safe_redirect(wc_get_checkout_url());
        exit;
    }
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */
