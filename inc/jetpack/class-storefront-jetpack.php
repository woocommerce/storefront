<?php
/**
 * Storefront Jetpack Class
 *
 * @package  storefront
 * @author   WooThemes
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Storefront_Jetpack' ) ) :

	/**
	 * The Storefront Jetpack integration class
	 */
	class Storefront_Jetpack {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'after_setup_theme', 	      array( $this, 'jetpack_setup' ) );
			add_action( 'wp_enqueue_scripts', 	      array( $this, 'jetpack_scripts' ), 10 );
			add_filter( 'infinite_scroll_query_args', array( $this, 'fix_duplicate_products' ), 100 );
			add_action( 'init',                       array( $this, 'jetpack_infinite_scroll_wrapper_columns' ) );
		}

		/**
		 * Add theme support for Infinite Scroll.
		 * See: http://jetpack.me/support/infinite-scroll/
		 */
		public function jetpack_setup() {
			add_theme_support( 'infinite-scroll', apply_filters( 'storefront_jetpack_infinite_scroll_args', array(
				'container'      => 'main',
				'footer'         => 'page',
				'type'           => 'click',
				'posts_per_page' => '12',
				'render'         => array( $this, 'jetpack_infinite_scroll_loop' ),
				'footer_widgets' => array(
										'footer-1',
										'footer-2',
										'footer-3',
										'footer-4',
									),
			) ) );
		}

		/**
		 * A loop used to display content appended using Jetpack infinite scroll
		 * @return void
		 */
		public function jetpack_infinite_scroll_loop() {
			do_action( 'storefront_jetpack_infinite_scroll_before' );

			if ( storefront_is_product_archive() ) {
				do_action( 'storefront_jetpack_product_infinite_scroll_before' );
				woocommerce_product_loop_start();
			}

			while ( have_posts() ) : the_post();
				if ( storefront_is_product_archive() ) {
					wc_get_template_part( 'content', 'product' );
				} else {
					get_template_part( 'content', get_post_format() );
				}
			endwhile; // end of the loop.

			if ( storefront_is_product_archive() ) {
				woocommerce_product_loop_end();
				do_action( 'storefront_jetpack_product_infinite_scroll_after' );
			}

			do_action( 'storefront_jetpack_infinite_scroll_after' );
		}

		/**
		 * Adds columns wrapper to content appended by Jetpack infinite scroll
		 * @return void
		 */
		public function jetpack_infinite_scroll_wrapper_columns() {
			add_action( 'storefront_jetpack_product_infinite_scroll_before', 'storefront_product_columns_wrapper' );
			add_action( 'storefront_jetpack_product_infinite_scroll_after', 'storefront_product_columns_wrapper_close' );
		}

		/**
		 * Enqueue jetpack styles.
		 *
		 * @since  1.6.1
		 */
		public function jetpack_scripts() {
			global $storefront_version;

			wp_enqueue_style( 'storefront-jetpack-style', get_template_directory_uri() . '/assets/sass/jetpack/jetpack.css', '', $storefront_version );
			wp_style_add_data( 'storefront-jetpack-style', 'rtl', 'replace' );
		}

		/**
		 * Jetpack infinite scroll duplicates posts where orderby is anything other than modified or date
		 * This filter offsets the products returned by however many are displayed per page
		 *
		 * @link https://github.com/Automattic/jetpack/issues/1135
		 * @param  array $args infinite scroll args.
		 * @return array       infinite scroll args.
		 */
		public function fix_duplicate_products( $args ) {
			if ( 'product' === $args['post_type'] ) {
				$args['offset'] = $args['posts_per_page'] * $args['paged'];
			}

		 	return $args;
		}
	}

endif;

return new Storefront_Jetpack();
