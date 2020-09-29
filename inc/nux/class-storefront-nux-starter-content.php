<?php
/**
 * Storefront NUX Starter Content Class
 *
 * @package  storefront
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Storefront_NUX_Starter_Content' ) ) :

	/**
	 * The Storefront NUX Starter Content class
	 */
	class Storefront_NUX_Starter_Content {
		/**
		 * Setup class.
		 *
		 * @since 2.2.0
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'starter_content' ) );
			add_filter( 'get_theme_starter_content', array( $this, 'filter_start_content' ), 10, 2 );
			add_action( 'after_setup_theme', array( $this, 'remove_default_widgets' ) );

			if ( version_compare( get_bloginfo( 'version' ), '5.2', '>=' ) &&
			( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.6.0', '>=' ) ) ) {
				add_action( 'customize_preview_init', array( $this, 'update_homepage_content' ), 10 );
			}

			if ( ! isset( $_GET['sf_starter_content'] ) || 1 !== absint( $_GET['sf_starter_content'] ) ) { // WPCS: input var ok.
				add_filter( 'storefront_starter_content', '__return_empty_array' );
			}
		}

		/**
		 * Remove default widgets on activation
		 * Set an option so that this is only done the first time the user activates Storefront.
		 *
		 * @since 2.2.0
		 * @return void
		 */
		public function remove_default_widgets() {
			if ( false === (bool) get_option( 'storefront_cleared_widgets' ) && true === (bool) get_option( 'storefront_nux_fresh_site' ) ) {
				update_option( 'sidebars_widgets', array( 'wp_inactive_widgets' => array() ) );
				update_option( 'storefront_cleared_widgets', true );
			}
		}

		/**
		 * Starter content.
		 *
		 * @since 2.2.0
		 */
		public function starter_content() {
			$starter_content = array(
				'posts'       => array(
					'about'   => array(
						'post_type'    => 'page',
						'post_title'   => __( 'About', 'storefront' ),
						'post_content' => __( 'You might be an artist who would like to introduce yourself and your work here or maybe you&rsquo;re a business with a mission to describe.', 'storefront' ),
					),
					'contact' => array(
						'post_type'    => 'page',
						'post_title'   => __( 'Contact', 'storefront' ),
						'post_content' => __( 'This is a page with some basic contact information, such as an address and phone number. You might also try a plugin to add a contact form.', 'storefront' ),
					),
					'blog',
				),
				'options'     => array(
					'show_on_front'  => 'page',
					'page_on_front'  => '{{home}}',
					'page_for_posts' => '{{blog}}',
				),
				'widgets'     => array(
					'footer-1' => array(
						'text_about',
					),
					'footer-2' => array(
						'text_business_info',
					),
				),
				'nav_menus'   => array(
					'primary'   => array(
						'name'  => __( 'Primary Menu', 'storefront' ),
						'items' => array(
							'shop'         => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{sf_shop}}',
							),
							'page_about'   => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{about}}',
							),
							'page_contact' => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{contact}}',
							),
						),
					),
					'secondary' => array(
						'name'  => __( 'Secondary Menu', 'storefront' ),
						'items' => array(
							'my_account' => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{sf_my-account}}',
							),
						),
					),
					'handheld'  => array(
						'name'  => __( 'Handheld Menu', 'storefront' ),
						'items' => array(
							'shop' => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{sf_shop}}',
							),
						),
					),
				),
			);

			// Add homepage.
			if ( version_compare( get_bloginfo( 'version' ), '5.2', '>=' ) &&
			   ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.6.0', '>=' ) ) ) {
				$homepage_content = array(
					'post_title' => esc_attr__( 'Homepage', 'storefront' ),
					'template'   => 'template-fullwidth.php',
				);
			} else {
				$homepage_content = array(
					'post_title'   => esc_attr__( 'Welcome', 'storefront' ),
					/* translators: %s: 'End Of Line' symbol */
					'post_content' => sprintf( esc_attr__( 'This is your homepage which is what most visitors will see when they first visit your shop.%sYou can change this text by editing the "Welcome" page via the "Pages" menu in your dashboard.', 'storefront' ), PHP_EOL . PHP_EOL ),
					'template'     => 'template-homepage.php',
					'thumbnail'    => '{{hero-image}}',
				);
			}

			$homepage = array(
				'home' => $homepage_content,
			);

			$starter_content['posts'] = array_merge( $starter_content['posts'], $homepage );

			// Use symbols as post name for attachments.
			foreach ( $starter_content['attachments'] as $symbol => $attachment ) {
				$starter_content['attachments'][ $symbol ]['post_name'] = $symbol;
			}

			// Add WooCommerce pages.
			$starter_content_wc_pages = array();
			$woocommerce_pages        = Storefront_NUX_Admin::get_woocommerce_pages();

			foreach ( $woocommerce_pages as $option => $page_id ) {
				$page = get_post( $page_id );

				if ( null !== $page ) {
					$starter_content_wc_pages[ 'sf_' . $page->post_name ] = array(
						'post_title' => $page->post_title,
						'post_name'  => $page->post_name,
						'post_type'  => 'page',
					);
				}
			}

			if ( ! empty( $starter_content_wc_pages ) ) {
				$starter_content['posts'] = array_merge( $starter_content['posts'], $starter_content_wc_pages );
			}

			// Register support for starter content.
			add_theme_support( 'starter-content', apply_filters( 'storefront_starter_content', $starter_content ) );
		}

		/**
		 * Filters starter content and remove some of the content if necessary.
		 *
		 * @since 2.2.0
		 * @param array $content Starter content.
		 * @param array $config Config.
		 * @return array $content
		 */
		public function filter_start_content( $content, $config ) {
			if ( ! isset( $_GET['sf_starter_content'] ) || 1 !== absint( $_GET['sf_starter_content'] ) ) { // WPCS: input var ok.
				return $content;
			}

			// Get hero image and save for later.
			$hero_image = false;

			if ( array_key_exists( 'attachments', $content ) && array_key_exists( 'hero-image', $content['attachments'] ) ) {
				$hero_image = $content['attachments']['hero-image'];
			}

			// Remove some of the content if necessary.
			$tasks = array();

			if ( isset( $_GET['sf_tasks'] ) && '' !== sanitize_text_field( wp_unslash( $_GET['sf_tasks'] ) ) ) { // WPCS: input var ok.
				$tasks = explode( ',', sanitize_text_field( wp_unslash( $_GET['sf_tasks'] ) ) ); // WPCS: input var ok.
			}

			$tasks = $this->_validate_tasks( $tasks );

			foreach ( $tasks as $task ) {
				switch ( $task ) {
					case 'homepage':
						unset( $content['options'] );
						unset( $content['posts']['home'] );
						unset( $content['posts']['blog'] );

						break;

					case 'products':
						if ( isset( $content['posts'] ) ) {
							foreach ( $content['posts'] as $post_id => $post ) {
								if ( isset( $post['post_type'] ) && 'product' === $post['post_type'] ) {
									unset( $content['posts'][ $post_id ] );
								}
							}
						}

						unset( $content['posts']['about'] );
						unset( $content['posts']['contact'] );
						unset( $content['attachments'] );
						unset( $content['nav_menus'] );
						unset( $content['widgets'] );

						break;
				}
			}

			// Existing site: remove custom pages, navigation menus and widgets from starter content.
			if ( true !== (bool) get_option( 'storefront_nux_fresh_site' ) ) {
				unset( $content['posts']['about'] );
				unset( $content['posts']['contact'] );
				unset( $content['nav_menus'] );
				unset( $content['widgets'] );
			}

			// Add homepage attachment image, if necessary for blocks.
			if ( $hero_image &&
				array_key_exists( 'posts', $content ) &&
				array_key_exists( 'home', $content['posts'] ) &&
				! array_key_exists( 'attachments', $content )
			) {
				$content['attachments'] = array(
					'hero-image' => $hero_image,
				);
			}

			return $content;
		}

		/**
		 * Filter Storefront Product Categories shortcode.
		 *
		 * @since 2.2.0
		 * @param array $args Shortcode args.
		 * @return array $args
		 */
		public function filter_sf_categories( $args ) {
			// Get Categories.
			$product_cats = get_terms(
				'product_cat',
				array(
					'fields'     => 'ids',
					'hide_empty' => false,
				)
			);

			if ( ! empty( $product_cats ) ) {

				// Needs to be set for categories to show up.
				$args['hide_empty'] = false;

				// List of categories to display.
				$args['ids'] = implode( $product_cats, ',' );
			}

			return $args;
		}

		/**
		 * Adds blocks to homepage content.
		 *
		 * @since 2.5.0
		 */
		public function update_homepage_content() {
			$homepage = $this->_query_starter_content( 'page', 'homepage', true );

			if ( empty( $homepage ) ) {
				return;
			}

			$homepage = $homepage[0];

			$content = $this->_replace_homepage_blocks_symbols();

			if ( ! empty( $content ) ) {

				// Update homepage content.
				$update_homepage = array(
					'ID'           => $homepage,
					'post_content' => $content,
				);

				wp_update_post( $update_homepage );
			}
		}

		/**
		 * Homepage blocks content.
		 *
		 * @since 2.5.0
		 * @return string $content Homepage content.
		 */
		private function _homepage_blocks_content() {
			$content = '
				{{cover}}

				<!-- wp:heading {"align":"center"} -->
				<h2 style="text-align:center">' . __( 'Shop by Category', 'storefront' ) . '</h2>
				<!-- /wp:heading -->

				<!-- wp:shortcode -->
				[product_categories limit="3" columns="3" orderby="menu_order"]
				<!-- /wp:shortcode -->

				<!-- wp:heading {"align":"center"} -->
				<h2 style="text-align:center">' . __( 'New In', 'storefront' ) . '</h2>
				<!-- /wp:heading -->

				<!-- wp:woocommerce/product-new {"columns":4} /-->

				{{handpicked-products}}

				<!-- wp:heading {"align":"center"} -->
				<h2 style="text-align:center">' . __( 'Fan Favorites', 'storefront' ) . '</h2>
				<!-- /wp:heading -->

				<!-- wp:woocommerce/product-top-rated {"columns":4} /-->

				<!-- wp:heading {"align":"center"} -->
				<h2 style="text-align:center">' . __( 'On Sale', 'storefront' ) . '</h2>
				<!-- /wp:heading -->

				<!-- wp:woocommerce/product-on-sale {"columns":4} /-->

				<!-- wp:heading {"align":"center"} -->
				<h2 style="text-align:center">' . __( 'Best Sellers', 'storefront' ) . '</h2>
				<!-- /wp:heading -->

				<!-- wp:woocommerce/product-best-sellers {"columns":4} /-->
			';

			return trim( $content );
		}

		/**
		 * Replaces placeholder symbols with content.
		 *
		 * @since 2.5.0
		 * @return string $content Homepage content.
		 */
		private function _replace_homepage_blocks_symbols() {
			$content = $this->_homepage_blocks_content();

			// Replace hero placeholders.
			$hero = $this->_query_starter_content( 'attachment', 'hero-image', true );

			if ( ! empty( $hero ) ) {
				$cover = '
					<!-- wp:cover {"url":"{{hero-image-url}}","id":{{hero-image-id}},"dimRatio":0,"customOverlayColor":"#ffffff","align":"full"} -->
					<div class="wp-block-cover alignfull" style="background-image:url({{hero-image-url}});background-color:#ffffff"><div class="wp-block-cover__inner-container"><!-- wp:heading {"level":1,"align":"center"} -->
					<h1 style="text-align:center">' . __( 'Welcome', 'storefront' ) . '</h1>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"center","customTextColor":"#000000"} -->
					<p style="color:#000000;text-align:center" class="has-text-color">' . __( 'This is your homepage which is what most visitors will see when they first visit your shop.', 'storefront' ) . '</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"align":"center","customTextColor":"#000000"} -->
					<p style="color:#000000;text-align:center" class="has-text-color">' . __( 'You can change this text by editing the "Welcome" page via the "Pages" menu in your dashboard.', 'storefront' ) . '</p>
					<!-- /wp:paragraph --></div></div>
					<!-- /wp:cover -->
				';

				$attachment = $hero[0];
				$cover      = str_replace( '{{hero-image-id}}', $attachment, $cover );
				$cover      = str_replace( '{{hero-image-url}}', wp_get_attachment_url( $attachment ), $cover );
				$content    = str_replace( '{{cover}}', $cover, $content );
			} else {
				$content = str_replace( '{{cover}}', '', $content );
			}

			// Replace handpicked products placeholders.
			$featured = array(
				'sunglasses',
				'hoodie-with-pocket',
				'hoodie-with-zipper',
				'hoodie',
			);

			$products = $this->_query_starter_content( 'product', $featured, true );

			if ( ! empty( $products ) ) {
				$handpicked = '
					<!-- wp:heading {"align":"center"} -->
					<h2 style="text-align:center">' . __( 'We Recommend', 'storefront' ) . '</h2>
					<!-- /wp:heading -->

					<!-- wp:woocommerce/handpicked-products {"columns":4,"editMode":false,"products":[{{handpicked-products}}]} /-->
				';

				$handpicked = str_replace( '{{handpicked-products}}', implode( ',', $products ), $handpicked );
				$content    = str_replace( '{{handpicked-products}}', $handpicked, $content );
			} else {
				$content = str_replace( '{{handpicked-products}}', '', $content );
			}

			return $content;
		}

		/**
		 * Get a list of posts created by starter content.
		 *
		 * @since 2.2.1
		 * @return mixed false|array $query Array of post ids.
		 */
		private function _get_created_starter_content_products() {
			global $wp_customize;

			$setting = $wp_customize->get_setting( 'nav_menus_created_posts' );

			if ( is_object( $setting ) ) {
				$created_products_ids = $setting->value();

				if ( ! empty( $created_products_ids ) ) {
					return (array) $created_products_ids;
				}
			}

			return false;
		}

		/**
		 * Get a list of existing products in the store.
		 *
		 * @since 2.2.0
		 * @return array $query Array of product ids.
		 */
		private function _get_existing_wc_products() {
			$query_args = array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'fields'         => 'ids',
				'posts_per_page' => -1,
			);

			$products = get_posts( $query_args );

			if ( $products && ! empty( $products ) ) {
				return $products;
			}

			return array();
		}

		/**
		 * Query start content imported by the Customizer.
		 *
		 * @since 2.5.0
		 * @param string             $post_type Post Type.
		 * @param mixed string|array $draft_slugs Slug or array of draft slugs.
		 * @param bool               $ids Whether to return just the ids or the whole post object.
		 * @return mixed false|int $query Query results.
		 */
		private function _query_starter_content( $post_type, $draft_slugs, $ids = false ) {
			$query_args = array(
				'post_type'      => $post_type,
				'post_status'    => 'auto-draft',
				'posts_per_page' => -1,
				'meta_query'     => array(
					array(
						'key'     => '_customize_draft_post_name',
						'value'   => $draft_slugs,
						'compare' => is_array( $draft_slugs ) ? 'IN' : '=',
					),
				),
			);

			$created_products = $this->_get_created_starter_content_products();

			if ( false !== $created_products ) {
				$query_args['post__in'] = $created_products;
			}

			if ( $ids ) {
				$query_args['fields'] = 'ids';
			}

			$query = get_posts( $query_args );

			if ( ! empty( $query ) ) {
				return $query;
			}

			return false;
		}

		/**
		 * Validates and sanitizes a given tasks list.
		 *
		 * @since 2.2.0
		 * @param string $tasks The tasks.
		 * @return mixed false|array $validated_tasks if tasks list is not empty.
		 */
		private function _validate_tasks( $tasks ) {
			$valid_tasks = apply_filters( 'storefront_valid_tour_tasks', array( 'homepage', 'products' ) );

			$validated_tasks = array();

			foreach ( $tasks as $task ) {
				$task = sanitize_key( $task );

				if ( in_array( $task, $valid_tasks, true ) ) {
					$validated_tasks[] = $task;
				}
			}

			$validated_tasks = array_diff( $valid_tasks, $validated_tasks );

			return $validated_tasks;
		}
	}

endif;

return new Storefront_NUX_Starter_Content();
