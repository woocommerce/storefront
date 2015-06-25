<?php
/**
 * storefront customizer hooks
 *
 * @package storefront
 */

add_action( 'customize_preview_init', 			'storefront_customize_preview_js' );
add_action( 'customize_register', 				'storefront_customize_register' );
add_filter( 'body_class', 						'storefront_layout_class' );
add_action( 'wp_enqueue_scripts', 				'storefront_add_customizer_css', 130 );
add_action( 'after_setup_theme', 				'storefront_custom_header_setup' );
add_action( 'customize_controls_print_styles', 	'storefront_customizer_custom_control_css' );