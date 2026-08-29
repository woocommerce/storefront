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
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

 // Add a new setting field for One-Click Checkout in WooCommerce settings
add_filter('woocommerce_general_settings', 'add_one_click_checkout_setting');
function add_one_click_checkout_setting($settings) {
    $settings[] = array(
        'name'     => __('One-Click Checkout', 'your-text-domain'),
        'type'     => 'title',
        'desc'     => __('Enable One-Click Checkout for returning customers.', 'your-text-domain'),
        'id'       => 'one_click_checkout_title'
    );

    $settings[] = array(
        'name'     => __('Enable One-Click Checkout', 'your-text-domain'),
        'id'       => 'enable_one_click_checkout',
        'type'     => 'checkbox',
        'desc'     => __('Enable the One-Click Checkout feature.', 'your-text-domain'),
        'default'  => 'no',
    );

    $settings[] = array('type' => 'sectionend', 'id' => 'one_click_checkout_title');

    return $settings;
}

// Redirect users to the checkout page if One-Click Checkout is enabled and they are logged in
add_filter('woocommerce_add_to_cart_redirect', 'one_click_checkout_redirect');
function one_click_checkout_redirect($url) {
    // Check if One-Click Checkout is enabled
    if ('yes' === get_option('enable_one_click_checkout') && is_user_logged_in()) {
        // Skip cart page and go directly to the checkout page
        $checkout_url = wc_get_checkout_url();
        return $checkout_url;
    }

    return $url;
}

// Pre-fill checkout form for returning customers if One-Click Checkout is enabled
add_filter('woocommerce_checkout_fields', 'prefill_checkout_fields_for_returning_customers');
function prefill_checkout_fields_for_returning_customers($fields) {
    if ('yes' === get_option('enable_one_click_checkout') && is_user_logged_in()) {
        $current_user = wp_get_current_user();
        
        // Pre-fill billing fields with user data
        $fields['billing']['billing_first_name']['default'] = $current_user->billing_first_name;
        $fields['billing']['billing_last_name']['default'] = $current_user->billing_last_name;
        $fields['billing']['billing_email']['default'] = $current_user->user_email;
        $fields['billing']['billing_phone']['default'] = $current_user->billing_phone;
        $fields['billing']['billing_address_1']['default'] = $current_user->billing_address_1;
        $fields['billing']['billing_city']['default'] = $current_user->billing_city;
        $fields['billing']['billing_postcode']['default'] = $current_user->billing_postcode;
        $fields['billing']['billing_country']['default'] = $current_user->billing_country;

        // Pre-fill shipping fields if needed (optional)
        // $fields['shipping']['shipping_first_name']['default'] = $current_user->shipping_first_name;
        // $fields['shipping']['shipping_last_name']['default'] = $current_user->shipping_last_name;
        // $fields['shipping']['shipping_address_1']['default'] = $current_user->shipping_address_1;
        // $fields['shipping']['shipping_city']['default'] = $current_user->shipping_city;
        // $fields['shipping']['shipping_postcode']['default'] = $current_user->shipping_postcode;
        // $fields['shipping']['shipping_country']['default'] = $current_user->shipping_country;
    }

    return $fields;
}