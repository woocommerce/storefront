<?php
/**
 * Storefront NUX Starter Content Class
 *
 * @author   WooThemes
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
		 * @since 2.2
		 */
		public function __construct() {
			add_action( 'after_setup_theme',                    array( $this, 'starter_content' ) );
			add_filter( 'get_theme_starter_content',            array( $this, 'filter_start_content' ), 10, 2 );
			add_action( 'woocommerce_product_query',            array( $this, 'wc_query' ) );
			add_filter( 'woocommerce_shortcode_products_query', array( $this, 'shortcode_loop_products' ), 10, 3 );
			add_action( 'customize_preview_init',               array( $this, 'add_product_tax' ), 10 );
		}

		/**
		 * Starter content.
		 *
		 * @since 2.2
		 */
		public function starter_content() {
			$starter_content = array(
				'posts' => array(
					'home' => array(
						'post_title' => sprintf( __( 'Welcome to %s', 'storefront' ), get_bloginfo() ),
						'template'   => 'template-homepage.php',
						'thumbnail'  => '',
					),
					'blog'
				),
				'attachments' => array(
					'beanie-image' => array(
						'post_title' => 'Beanie',
						'file'       => 'inc/nux/assets/images/products/beanie.jpg',
					),
					'belt-image' => array(
						'post_title' => 'Belt',
						'file'       => 'inc/nux/assets/images/products/belt.jpg',
					),
					'cap-image' => array(
						'post_title' => 'Cap',
						'file'       => 'inc/nux/assets/images/products/cap.jpg',
					),
					'hoodie-with-logo-image' => array(
						'post_title' => 'Hoodie with Logo',
						'file'       => 'inc/nux/assets/images/products/hoodie-with-logo.jpg',
					),
					'hoodie-with-pocket-image' => array(
						'post_title' => 'Hoodie with Pocket',
						'file'       => 'inc/nux/assets/images/products/hoodie-with-pocket.jpg',
					),
					'hoodie-with-zipper-image' => array(
						'post_title' => 'Hoodie with Zipper',
						'file'       => 'inc/nux/assets/images/products/hoodie-with-zipper.jpg',
					),
					'hoodie-image' => array(
						'post_title' => 'Hoodie',
						'file'       => 'inc/nux/assets/images/products/hoodie.jpg',
					),
					'long-sleeve-tee-image' => array(
						'post_title' => 'Long Sleeve Tee',
						'file'       => 'inc/nux/assets/images/products/long-sleeve-tee.jpg',
					),
					'polo-image' => array(
						'post_title' => 'Polo',
						'file'       => 'inc/nux/assets/images/products/polo.jpg',
					),
					'sunglasses-image' => array(
						'post_title' => 'Sunglasses',
						'file'       => 'inc/nux/assets/images/products/sunglasses.jpg',
					),
					'tshirt-image' => array(
						'post_title' => 'Tshirt',
						'file'       => 'inc/nux/assets/images/products/tshirt.jpg',
					),
					'vneck-tee-image' => array(
						'post_title' => 'Vneck Tshirt',
						'file'       => 'inc/nux/assets/images/products/vneck-tee.jpg',
					),
					'tshirts-image' => array(
						'post_title' => 'T-shirts',
						'file'       => 'inc/nux/assets/images/categories/tshirts.jpg',
					),
					'hoodies-image' => array(
						'post_title' => 'Hoodies',
						'file'       => 'inc/nux/assets/images/categories/hoodies.jpg',
					),
				),
				'theme_mods' => array(
					'category_tshirts'     => '{{tshirts-image}}',
					'category_hoodies'     => '{{hoodies-image}}',
					'category_accessories' => '{{accessories-image}}',
				),
				'options' => array(
					'show_on_front'  => 'page',
					'page_on_front'  => '{{home}}',
					'page_for_posts' => '{{blog}}',
				),
				'widgets' => array(
					'sidebar-1' => array(
						'woocommerce_widget_cart' => array(
							'woocommerce_widget_cart',
							array(
								'title' => __( 'Cart', 'storefront' ),
							),
						),
						'woocommerce_price_filter' => array(
							'woocommerce_price_filter',
							array(
								'title' => __( 'Filter by price', 'storefront' ),
							),
						),
						'woocommerce_product_categories' => array(
							'woocommerce_product_categories',
							array(
								'title' => __( 'Product categories', 'storefront' ),
							),
						),
						'woocommerce_product_search' => array(
							'woocommerce_product_search',
							array(
								'title' => __( 'Search', 'storefront' ),
							),
						),
					),
					'footer-1' => array(
						'text_about'
					),
					'footer-2' => array(
						'woocommerce_products' => array(
							'woocommerce_products',
							array(
								'title'  => __( 'Featured products', 'storefront' ),
								'show'   => 'featured',
								'number' => 5,
							),
						),
					),
					'footer-3' => array(
						'text_business_info'
					),
				),
				'nav_menus' => array(
					'primary' => array(
						'name' => __( 'Primary Menu', 'storefront' ),
						'items' => array(
							'shop' => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{sf_shop}}',
							),
						),
					),
					'secondary' => array(
						'name' => __( 'Secondary Menu', 'storefront' ),
						'items' => array(
							'my_account' => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{sf_my-account}}',
							),
						),
					),
					'handheld' => array(
						'name' => __( 'Handheld Menu', 'storefront' ),
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

			// Add products.
			$starter_content_wc_products = $this->_starter_content_products();

			if ( ! empty( $starter_content_wc_products ) ) {
				$starter_content['posts'] = array_merge( $starter_content['posts'], $starter_content_wc_products );
			}

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
		 * @since 2.2
		 * @param array $content Starter content.
		 * @param array $config Config.
		 * @return array $content
		 */
		public function filter_start_content( $content, $config ) {
			if ( ! isset( $_GET['sf_guided_tour'] ) || 1 !== absint( $_GET['sf_guided_tour'] ) ) {
				return $content;
			}

			$tasks = array();

			if ( isset( $_GET['sf_tasks'] ) && '' !== sanitize_text_field( $_GET['sf_tasks'] ) ) {
				$tasks = explode( ',', sanitize_text_field( $_GET['sf_tasks'] ) );
			}

			$tasks = $this->_validate_tasks( $tasks );

			foreach ( $tasks as $task ) {
				switch ( $task ) {
					case 'homepage':
						unset( $content['options'] );

						if ( isset( $content['posts'] ) ) {
							foreach ( $content['posts'] as $post_id => $post ) {
								if ( 'home' === $post_id ) {
									unset( $content['posts'][ $post_id ] );
								}

								if ( 'blog' === $post_id ) {
									unset( $content['posts'][ $post_id ] );
								}
							}
						}

						break;

					case 'products':
						if ( isset( $content['posts'] ) ) {
							foreach ( $content['posts'] as $post_id => $post ) {
								if ( isset( $post['post_type'] ) && 'product' === $post['post_type'] ) {
									unset( $content['posts'][ $post_id ] );
								}
							}
						}

						break;
				}
			}

			// Add custom fields to products.
			$starter_products = $this->_starter_content_products();

			foreach ( $content['posts'] as $post_id => $post ) {
				if ( array_key_exists( $post_id, $starter_products ) && array_key_exists( 'meta_input', $starter_products[ $post_id ] ) ) {
					$content['posts'][ $post_id ]['meta_input'] = $starter_products[ $post_id ]['meta_input'];
				}
			}

			return $content;
		}

		/**
		 * Filter WooCommerce main query to include starter content products.
		 *
		 * @since 2.2
		 * @param object $query The Query.
		 * @return void
		 */
		public function wc_query( $query ) {
			if ( ! is_customize_preview() || true !== (bool) get_option( 'fresh_site' ) ) {
				return;
			}

			global $wp_customize;

			$data = $wp_customize->get_setting( 'nav_menus_created_posts' );

			if ( ! empty( $data->value() ) ) {

				// Add created products to query.
				$query->set( 'post__in', (array) $data->value() );

				// Allow for multiple status.
				$query->set( 'post_status', get_post_stati() );
			}
		}

		/**
		 * Filter shortcode products loop in WooCommerce.
		 *
		 * @since 2.2
		 * @param array  $query_args Query args.
		 * @param array  $atts Shortcode attributes.
		 * @param string $loop_name Loop name.
		 * @return array $args
		 */
		public function shortcode_loop_products( $query_args, $atts, $loop_name ) {
			if ( ! is_customize_preview() || true !== (bool) get_option( 'fresh_site' ) ) {
				return $query_args;
			}

			global $wp_customize;

			$data = $wp_customize->get_setting( 'nav_menus_created_posts' );

			if ( ! empty( $data->value() ) ) {

				// Add created products to query.
				$query_args['post__in'] = $data->value();

				// Allow for multiple status.
				$query_args['post_status'] = get_post_stati();
			}

			return $query_args;
		}

		/**
		 * Add product taxonomies to starter content.
		 *
		 * @since 2.2
		 */
		public function add_product_tax() {
			if ( ! is_customize_preview() || true !== (bool) get_option( 'fresh_site' ) ) {
				return;
			}

			global $wp_customize;

			$data = $wp_customize->get_setting( 'nav_menus_created_posts' );

			$created_products = $data->value();

			if ( empty( $created_products ) ) {
				return;
			}

			$starter_products = $this->_starter_content_products();

			if ( is_array( $created_products ) ) {
				foreach ( $created_products as $product ) {
					$product = get_post( $product );

					if ( ! $product ) {
						continue;
					}

					$post_name = get_post_meta( $product->ID, '_customize_draft_post_name', true );

					if ( ! $post_name || ! array_key_exists( $post_name, $starter_products ) ) {
						continue;
					}

					$taxonomies = array( 'product_cat', 'product_tag' );

					foreach ( $taxonomies as $taxonomy ) {
						if ( array_key_exists( $taxonomy, $starter_products[ $post_name ]['taxonomy'] ) ) {
							$categories = $starter_products[ $post_name ]['taxonomy'][ $taxonomy ];

							if ( ! empty( $categories ) ) {
								$category_ids = array();

								foreach ( $categories as $category ) {
									$created_category = wp_insert_term(
										$category['term'],
										$taxonomy,
										array(
											'description' => $category['description'],
											'slug'        => $category['slug'],
										)
									);

									if ( ! is_wp_error( $created_category ) ) {
										$category_ids[] = $created_category['term_id'];

										$category_image = $this->_get_category_image_attachment_id( $category['slug'] );

										if ( $category_image ) {
											update_term_meta( (int) $created_category['term_id'], 'thumbnail_id', $category_image );
										}
									}
								}

								wp_set_object_terms( $product->ID, $category_ids, $taxonomy );
							}
						}
					}
				}
			}

			add_filter( 'storefront_product_categories_shortcode_args', array( $this, 'filter_sf_categories' ) );
		}

		/**
		 * Filter Storefront Product Categories shortcode.
		 *
		 * @param array $args Shortcode args.
		 * @return array $args
		 * @since 2.2
		 */
		public function filter_sf_categories( $args ) {
			// Get Categories.
			$product_cats = get_terms( 'product_cat', array( 'fields' => 'ids', 'hide_empty' => false ) );

			if ( ! empty( $product_cats ) ) {

				// Needs to be set for categories to show up.
				$args['hide_empty'] = false;

				// List of categories to display.
				$args['ids'] = implode( $product_cats, ',' );
			}

			return $args;
		}

		/**
		 * Starter content products.
		 *
		 * @since 2.2
		 */
		private function _starter_content_products() {
			$accessories_name        = esc_attr__( 'Accessories', 'storefront' );
			$accessories_description = esc_attr__( 'A short category description', 'storefront' );

			$hoodies_name            = esc_attr__( 'Hoodies', 'storefront' );
			$hoodies_description     = esc_attr__( 'A short category description', 'storefront' );

			$tshirts_name            = esc_attr__( 'Tshirts', 'storefront' );
			$tshirts_description     = esc_attr__( 'A short category description', 'storefront' );

			$products = array(
				// Accessories
				'beanie' => array(
					'post_title'   => esc_attr__( 'Beanie', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '20',
						'_price'             => '20',
						'_wc_average_rating' => '4',
						'total_sales'        => '5',
						'_featured'          => 'no',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $accessories_name,
								'slug'        => 'accessories',
								'description' => $accessories_description,
							),
						),
					),
					'thumbnail' => '{{beanie-image}}',
				),
				'belt' => array(
					'post_title'   => esc_attr__( 'Belt', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '65',
						'_price'             => '65',
						'_wc_average_rating' => '3.5',
						'total_sales'        => '5',
						'_featured'          => 'no',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $accessories_name,
								'slug'        => 'accessories',
								'description' => $accessories_description,
							),
						),
					),
					'thumbnail' => '{{belt-image}}',
				),
				'cap' => array(
					'post_title'   => esc_attr__( 'Cap', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '18',
						'_price'             => '16',
						'_sale_price'        => '16',
						'_wc_average_rating' => '4.5',
						'total_sales'        => '5',
						'_featured'          => 'no',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $accessories_name,
								'slug'        => 'accessories',
								'description' => $accessories_description,
							),
						),
					),
					'thumbnail' => '{{cap-image}}',
				),
				'sunglasses' => array(
					'post_title'   => esc_attr__( 'Sunglasses', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '90',
						'_price'             => '90',
						'_wc_average_rating' => '4',
						'total_sales'        => '5',
						'_featured'          => 'yes',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $accessories_name,
								'slug'        => 'accessories',
								'description' => $accessories_description,
							),
						),
					),
					'thumbnail' => '{{sunglasses-image}}',
				),
				'hoodie-with-logo' => array(
					'post_title'   => esc_attr__( 'Hoodie with Logo', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '45',
						'_price'             => '45',
						'_wc_average_rating' => '4',
						'total_sales'        => '5',
						'_featured'          => 'no',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $hoodies_name,
								'slug'        => 'hoodies',
								'description' => $hoodies_description,
							),
						),
					),
					'thumbnail' => '{{hoodie-with-logo-image}}',
				),
				'hoodie-with-pocket' => array(
					'post_title'   => esc_attr__( 'Hoodie with Pocket', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '45',
						'_price'             => '35',
						'_sale_price'        => '35',
						'_wc_average_rating' => '5',
						'total_sales'        => '5',
						'_featured'          => 'no',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $hoodies_name,
								'slug'        => 'hoodies',
								'description' => $hoodies_description,
							),
						),
					),
					'thumbnail' => '{{hoodie-with-pocket-image}}',
				),
				'hoodie-with-zipper' => array(
					'post_title'   => esc_attr__( 'Hoodie with Zipper', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '45',
						'_price'             => '35',
						'_sale_price'        => '35',
						'_wc_average_rating' => '3.5',
						'total_sales'        => '5',
						'_featured'          => 'yes',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $hoodies_name,
								'slug'        => 'hoodies',
								'description' => $hoodies_description,
							),
						),
					),
					'thumbnail' => '{{hoodie-with-zipper-image}}',
				),
				'hoodie' => array(
					'post_title'   => esc_attr__( 'Hoodie', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '45',
						'_price'             => '45',
						'_wc_average_rating' => '5',
						'total_sales'        => '5',
						'_featured'          => 'yes',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $hoodies_name,
								'slug'        => 'hoodies',
								'description' => $hoodies_description,
							),
						),
					),
					'thumbnail' => '{{hoodie-image}}',
				),
				'long-sleeve-tee' => array(
					'post_title'   => esc_attr__( 'Long Sleeve Tee', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '25',
						'_price'             => '25',
						'_wc_average_rating' => '4',
						'total_sales'        => '5',
						'_featured'          => 'no',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $tshirts_name,
								'slug'        => 'tshirts',
								'description' => $tshirts_description,
							),
						),
					),
					'thumbnail' => '{{long-sleeve-tee-image}}',
				),
				'polo' => array(
					'post_title'   => esc_attr__( 'Polo', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '20',
						'_price'             => '20',
						'_wc_average_rating' => '2.5',
						'total_sales'        => '5',
						'_featured'          => 'no',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $tshirts_name,
								'slug'        => 'tshirts',
								'description' => $tshirts_description,
							),
						),
					),
					'thumbnail' => '{{polo-image}}',
				),
				'tshirt' => array(
					'post_title'   => esc_attr__( 'Tshirt', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '18',
						'_price'             => '18',
						'_wc_average_rating' => '4.5',
						'total_sales'        => '5',
						'_featured'          => 'no',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $tshirts_name,
								'slug'        => 'tshirts',
								'description' => $tshirts_description,
							),
						),
					),
					'thumbnail' => '{{tshirt-image}}',
				),
				'vneck-tee' => array(
					'post_title'   => esc_attr__( 'Vneck Tshirt', 'storefront' ),
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility'        => 'visible',
						'_regular_price'     => '18',
						'_price'             => '16',
						'_sale_price'        => '16',
						'_wc_average_rating' => '3',
						'total_sales'        => '5',
						'_featured'          => 'yes',
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => $tshirts_name,
								'slug'        => 'tshirts',
								'description' => $tshirts_description,
							),
						),
					),
					'thumbnail' => '{{vneck-tee-image}}',
				),
			);

			// Use symbols as post name.
			foreach ( $products as $symbol => $product ) {
				$products[ $symbol ]['post_name'] = $symbol;
			}

			return apply_filters( 'storefront_starter_content_products', $products );
		}

		/**
		 * Given a category slug, find the related image attachment.
		 *
		 * @since 2.2
		 * @param string $category Category.
		 * @return mixed false|int $query first attachment found.
		 */
		private function _get_category_image_attachment_id( $category ) {
			$query_args = array(
				'post_type'      => 'attachment',
				'post_status'    => 'auto-draft',
				'fields'         => 'ids',
				'posts_per_page' => -1,
				'meta_query'     => array(
					array(
						'key'     => '_customize_draft_post_name',
						'value'   => $category . '-image',
						'compare' => '=',
					),
				),
			);

			$query = get_posts( $query_args );

			if ( $query && ! empty( $query ) ) {
				return $query[0];
			}

			return false;
		}

		/**
		 * Validates and sanitizes a given tasks list.
		 *
		 * @since 2.2
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
