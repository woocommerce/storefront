<?php
/**
 * storefront engine room
 *
 * @package storefront
 */

/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */
require get_template_directory() . '/inc/functions/setup.php';

/**
 * Structure.
 * Template functions used throughout the theme.
 */
require get_template_directory() . '/inc/structure/hooks.php';
require get_template_directory() . '/inc/structure/post.php';
require get_template_directory() . '/inc/structure/page.php';
require get_template_directory() . '/inc/structure/header.php';
require get_template_directory() . '/inc/structure/footer.php';
require get_template_directory() . '/inc/structure/comments.php';
require get_template_directory() . '/inc/structure/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/functions/extras.php';

/**
 * Customizer additions.
 */
if ( is_storefront_customizer_enabled() ) {
	require get_template_directory() . '/inc/customizer/hooks.php';
	require get_template_directory() . '/inc/customizer/controls.php';
	require get_template_directory() . '/inc/customizer/display.php';
	require get_template_directory() . '/inc/customizer/functions.php';
	require get_template_directory() . '/inc/customizer/custom-header.php';
}

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack/hooks.php';
require get_template_directory() . '/inc/jetpack/functions.php';

/**
 * Welcome screen
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
}

/**
 * Load WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
	require get_template_directory() . '/inc/woocommerce/integrations.php';
}