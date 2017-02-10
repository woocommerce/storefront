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
					),
					'blog'
				),
				'attachments' => array(
					'happy-ninja-image' => array(
						'post_title' => 'Happy Ninja',
						'file'       => 'inc/nux/assets/images/products/happy-ninja.jpg',
					),
					'happy-ninja-2-image' => array(
						'post_title' => 'Happy Ninja 2',
						'file'       => 'inc/nux/assets/images/products/happy-ninja-2.jpg',
					),
					'ninja-silhouette-image' => array(
						'post_title' => 'Ninja Silhouette',
						'file'       => 'inc/nux/assets/images/products/ninja-silhouette.jpg',
					),
					'ninja-silhouette-2-image' => array(
						'post_title' => 'Ninja Silhouette 2',
						'file'       => 'inc/nux/assets/images/products/ninja-silhouette-2.jpg',
					),
					'patient-ninja-image' => array(
						'post_title' => 'Patient Ninja',
						'file'       => 'inc/nux/assets/images/products/patient-ninja.jpg',
					),
					'premium-quality-image' => array(
						'post_title' => 'Premium Quality',
						'file'       => 'inc/nux/assets/images/products/premium-quality.jpg',
					),
					'ship-your-idea-image' => array(
						'post_title' => 'Ship your idea',
						'file'       => 'inc/nux/assets/images/products/ship-your-idea.jpg',
					),
					'ship-your-idea-2-image' => array(
						'post_title' => 'Ship your idea',
						'file'       => 'inc/nux/assets/images/products/ship-your-idea-2.jpg',
					),
					'woo-ninja-image' => array(
						'post_title' => 'Woo Ninja',
						'file'       => 'inc/nux/assets/images/products/woo-ninja.jpg',
					),
					'woo-ninja-2-image' => array(
						'post_title' => 'Woo Ninja',
						'file'       => 'inc/nux/assets/images/products/woo-ninja-2.jpg',
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
					'category_tshirts' => '{{tshirts-image}}',
					'category_hoodies' => '{{hoodies-image}}',
				),
				'options' => array(
					'show_on_front'  => 'page',
					'page_on_front'  => '{{home}}',
					'page_for_posts' => '{{blog}}',
				),
				'widgets' => array(
					'sidebar-1' => array(
						'woocommerce_widget_cart' => array( 'woocommerce_widget_cart', array(
							'title' => __( 'Cart', 'storefront' ),
						) ),
						'woocommerce_price_filter' => array( 'woocommerce_price_filter', array(
							'title' => __( 'Filter by price', 'storefront' ),
						) ),
						'woocommerce_product_categories' => array( 'woocommerce_product_categories', array(
							'title' => __( 'Product categories', 'storefront' ),
						) ),
						'woocommerce_product_search' => array( 'woocommerce_product_search', array(
							'title' => __( 'Search', 'storefront' ),
						) ),
					),
					'footer-1' => array(
						'text_about'
					),
					'footer-2' => array(
						'woocommerce_products' => array( 'woocommerce_products', array(
							'title'  => __( 'Featured products', 'storefront' ),
							'show'   => 'featured',
							'number' => 5
						) ),
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
								'object_id' => '{{sf_shop}}'
							)
						),
					),
					'secondary' => array(
						'name' => __( 'Secondary Menu', 'storefront' ),
						'items' => array(
							'my_account' => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{sf_my-account}}'
							)
						),
					),
					'handheld' => array(
						'name' => __( 'Handheld Menu', 'storefront' ),
						'items' => array(
							'shop' => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{sf_shop}}'
							)
						),
					),
				),
			);

			// Add products
			$starter_content_wc_products = $this->_starter_content_products();

			if ( ! empty( $starter_content_wc_products ) ) {
				$starter_content['posts'] = array_merge( $starter_content['posts'], $starter_content_wc_products );
			}

			// Use symbols as post name for attachments
			foreach ( $starter_content['attachments'] as $symbol => $attachment ) {
				$starter_content['attachments'][ $symbol ]['post_name'] = $symbol;
			}

			// Add WooCommerce pages
			$starter_content_wc_pages = array();
			$woocommerce_pages        = Storefront_NUX_Admin::get_woocommerce_pages();

			foreach ( $woocommerce_pages as $option => $page_id ) {
				$page = get_post( $page_id );

				if ( null !== $page ) {
					$starter_content_wc_pages[ 'sf_' . $page->post_name ] = array(
						'post_title' => $page->post_title,
						'post_name'  => $page->post_name,
						'post_type'  => 'page'
					);
				}
			}

			if ( ! empty( $starter_content_wc_pages ) ) {
				$starter_content['posts'] = array_merge( $starter_content['posts'], $starter_content_wc_pages );
			}

			// Register support for starter content
			add_theme_support( 'starter-content', apply_filters( 'storefront_starter_content', $starter_content ) );
		}

		/**
		 * Filters starter content and remove some of the content if necessary.
		 *
		 * @since 2.2
		 * @param array $content
		 * @param array $config
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

			// Add custom fields to products
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
		 * @param object $query
		 * @return void
		 */
		public function wc_query( $query ) {
			if ( ! is_customize_preview() || true !== (bool) get_option( 'fresh_site' ) ) {
				return;
			}

			global $wp_customize;

			$data = $wp_customize->get_setting( 'nav_menus_created_posts' );

			if ( ! empty( $data->value() ) ) {

				// Add created products to query
				$query->set( 'post__in', (array) $data->value() );

				// Allow for multiple status
				$query->set( 'post_status', get_post_stati() );
			}
		}

		/**
		 * Filter shortcode products loop in WooCommerce.
		 *
		 * @since 2.2
		 * @param array $query_args
		 * @param array $atts
		 * @param string $loop_name
		 * @return array $args
		 */
		public function shortcode_loop_products( $query_args, $atts, $loop_name ) {
			if ( ! is_customize_preview() || true !== (bool) get_option( 'fresh_site' ) ) {
				return $query_args;
			}

			global $wp_customize;

			$data = $wp_customize->get_setting( 'nav_menus_created_posts' );

			if ( ! empty( $data->value() ) ) {

				// Add created products to query
				$query_args['post__in'] = $data->value();

				// Allow for multiple status
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
											'slug'        => $category['slug']
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
		 * @param array $args
		 * @return array $args
		 * @since 2.2
		 */
		public function filter_sf_categories( $args ) {
			// Get Categories
			$product_cats = get_terms( 'product_cat', array( 'fields' => 'ids', 'hide_empty' => false ) );

			if ( ! empty( $product_cats ) ) {

				// Needs to be set for categories to show up
				$args['hide_empty'] = false;

				// List of categories to display
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
			$products = array(
				'premium-quality' => array(
					'post_title'   => 'Premium Quality',
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility' => 'visible',
						'_price'      => '20'
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => 'T-shirts',
								'slug'        => 'tshirts',
								'description' => 'A short category description'
							)
						)
					),
					'thumbnail' => '{{premium-quality-image}}'
				),
				'ship-your-idea' => array(
					'post_title'   => 'Ship Your Idea',
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility' => 'visible',
						'_price'      => '20'
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => 'T-shirts',
								'slug'        => 'tshirts',
								'description' => 'A short category description'
							)
						)
					),
					'thumbnail' => '{{ship-your-idea-image}}'
				),
				'ninja-silhouette' => array(
					'post_title'   => 'Ninja Silhouette',
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility' => 'visible',
						'_price'      => '20'
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => 'T-shirts',
								'slug'        => 'tshirts',
								'description' => 'A short category description'
							)
						)
					),
					'thumbnail' => '{{ninja-silhouette-image}}'
				),
				'woo-ninja' => array(
					'post_title'   => 'Woo Ninja',
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility' => 'visible',
						'_price'      => '20'
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => 'T-shirts',
								'slug'        => 'tshirts',
								'description' => 'A short category description'
							)
						)
					),
					'thumbnail' => '{{woo-ninja-image}}'
				),
				'happy-ninja' => array(
					'post_title'   => 'Happy Ninja',
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility' => 'visible',
						'_price'      => '18'
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => 'T-shirts',
								'slug'        => 'tshirts',
								'description' => 'A short category description'
							)
						)
					),
					'thumbnail' => '{{happy-ninja-image}}'
				),
				'ship-your-idea-2' => array(
					'post_title'   => 'Ship Your Idea',
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility' => 'visible',
						'_price'      => '35'
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => 'Hoodies',
								'slug'        => 'hoodies',
								'description' => 'A short category description'
							)
						)
					),
					'thumbnail' => '{{ship-your-idea-2-image}}'
				),
				'woo-ninja-2' => array(
					'post_title'   => 'Woo Ninja',
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility' => 'visible',
						'_price'      => '35'
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => 'Hoodies',
								'slug'        => 'hoodies',
								'description' => 'A short category description'
							)
						)
					),
					'thumbnail' => '{{woo-ninja-2-image}}'
				),
				'patient-ninja' => array(
					'post_title'   => 'Patient Ninja',
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility' => 'visible',
						'_price'      => '35'
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => 'Hoodies',
								'slug'        => 'hoodies',
								'description' => 'A short category description'
							)
						)
					),
					'thumbnail' => '{{patient-ninja-image}}'
				),
				'happy-ninja-2' => array(
					'post_title'   => 'Happy Ninja',
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility' => 'visible',
						'_price'      => '35'
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => 'Hoodies',
								'slug'        => 'hoodies',
								'description' => 'A short category description'
							)
						)
					),
					'thumbnail' => '{{happy-ninja-2-image}}'
				),
				'ninja-silhouette-2' => array(
					'post_title'   => 'Ninja Silhouette',
					'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'    => 'product',
					'meta_input'   => array(
						'_visibility' => 'visible',
						'_price'      => '35'
					),
					'taxonomy' => array(
						'product_cat' => array(
							array(
								'term'        => 'Hoodies',
								'slug'        => 'hoodies',
								'description' => 'A short category description'
							)
						)
					),
					'thumbnail' => '{{ninja-silhouette-2-image}}'
				),
			);

			// Use symbols as post name
			foreach ( $products as $symbol => $product ) {
				$products[ $symbol ]['post_name'] = $symbol;
			}

			return apply_filters( 'storefront_starter_content_products', $products );
		}

		/**
		 * Given a category slug, find the related image attachment.
		 *
		 * @since 2.2
		 * @param string $category
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
				)
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
		 * @param string $tasks
		 * @return mixed false|array $validated_tasks if tasks list is not empty.
		 */
		private function _validate_tasks( $tasks ) {
			$valid_tasks = apply_filters( 'storefront_valid_tour_tasks', array( 'homepage', 'products' ) );

			$validated_tasks = array();

			foreach ( $tasks as $task ) {
				$task = sanitize_key( $task );

				if ( in_array( $task, $valid_tasks ) ) {
					$validated_tasks[] = $task;
				}
			}

			$validated_tasks = array_diff( $valid_tasks, $validated_tasks );

			return $validated_tasks;
		}
	}

endif;

return new Storefront_NUX_Starter_Content();