<?php
/**
 * WordPress shims.
 *
 * @package storefront
 */

if ( ! function_exists( 'wp_body_open' ) ) {
    /**
     * Adds backwards compatibility for wp_body_open() introduced with WordPress 5.2
     *
     * @since 2.5.4
     * @see https://developer.wordpress.org/reference/functions/wp_body_open/
     * @return void
     */
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}