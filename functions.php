<?php
/**
 * storefront engine room
 *
 * @package storefront
 */

/**
 * Initialize all the things.
 */
include_once( 'inc/class-storefront.php' );
include_once( 'inc/class-storefront-customizer.php' );
include_once( 'inc/class-storefront-jetpack.php' );

include_once( 'inc/storefront-functions.php' );
include_once( 'inc/storefront-template-hooks.php' );
include_once( 'inc/storefront-template-functions.php' );

if ( is_woocommerce_activated() ) {
	include_once( 'inc/woocommerce/class-storefront-woocommerce.php' );
	include_once( 'inc/woocommerce/storefront-woocommerce-template-hooks.php' );
	include_once( 'inc/woocommerce/storefront-woocommerce-template-functions.php' );
}

if ( is_admin() ) {
	include_once( 'inc/admin/class-storefront-admin.php' );
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woothemes/theme-customisations
 */