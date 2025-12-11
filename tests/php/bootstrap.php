<?php
/**
 * PHPUnit bootstrap file for wp-env integration tests.
 *
 * Relies on WP_TESTS_DIR provided by wp-env (tests container).
 *
 * @package storefront
 */

$wp_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( empty( $wp_tests_dir ) ) {
	fwrite( STDERR, "WP_TESTS_DIR is not set. Run phpunit inside wp-env tests container.\n" );
	exit( 1 );
}

// Provide PHPUnit Polyfills path if available (theme vendor preferred).
if ( ! defined( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH' ) ) {
	$polyfills = dirname( __DIR__, 2 ) . '/vendor/yoast/phpunit-polyfills';
	if ( file_exists( $polyfills . '/phpunitpolyfills-autoload.php' ) ) {
		define( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH', $polyfills );
	}
}

require_once $wp_tests_dir . '/includes/functions.php';

// Ensure WooCommerce is loaded before the test suite boots.
tests_add_filter(
	'muplugins_loaded',
	function () {
		require WP_PLUGIN_DIR . '/woocommerce/woocommerce.php';
	}
);

require_once $wp_tests_dir . '/includes/bootstrap.php';

// Load the class under test.
require dirname( __DIR__, 2 ) . '/inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';
