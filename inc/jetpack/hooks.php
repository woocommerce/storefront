<?php
/**
 * storefront WooCommerce hooks
 *
 * @package storefront
 */

add_action( 'after_setup_theme', 	'storefront_jetpack_setup' );
add_action( 'wp_enqueue_scripts',	'storefront_jetpack_scripts', 10 );