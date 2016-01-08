<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package storefront
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function storefront_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}

/**
 * Enqueue jetpack styles.
 * @since  1.6.1
 */
function storefront_jetpack_scripts() {
	global $storefront_version;

	if ( class_exists( 'Jetpack' ) ) {
		wp_enqueue_style( 'storefront-jetpack-style', get_template_directory_uri() . '/inc/jetpack/css/jetpack.css', '', $storefront_version );
		wp_style_add_data( 'storefront-jetpack-style', 'rtl', 'replace' );
	}
}