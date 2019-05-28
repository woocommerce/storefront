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
			add_action( 'woocommerce_product_query', array( $this, 'wc_query' ) );
			add_filter( 'woocommerce_shortcode_products_query', array( $this, 'shortcode_loop_products' ), 10, 3 );
			add_filter( 'woocommerce_shortcode_products_query', array( $this, 'filter_on_sale_products' ), 20, 3 );
			add_filter( 'woocommerce_product_categories', array( $this, 'filter_product_categories_shortcode' ) );
			add_action( 'customize_preview_init', array( $this, 'add_product_tax' ), 10 );
			add_action( 'customize_preview_init', array( $this, 'set_product_data' ), 10 );
			add_action( 'after_setup_theme', array( $this, 'remove_default_widgets' ) );
			add_action( 'transition_post_status', array( $this, 'transition_post_status' ), 10, 3 );
			add_filter( 'the_title', array( $this, 'filter_auto_draft_title' ), 10, 2 );

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
				'attachments' => array(
					'beanie-image'             => array(
						'post_title' => 'Beanie',
						'file'       => 'assets/images/customizer/starter-content/products/beanie.jpg',
					),
					'belt-image'               => array(
						'post_title' => 'Belt',
						'file'       => 'assets/images/customizer/starter-content/products/belt.jpg',
					),
					'cap-image'                => array(
						'post_title' => 'Cap',
						'file'       => 'assets/images/customizer/starter-content/products/cap.jpg',
					),
					'hoodie-with-logo-image'   => array(
						'post_title' => 'Hoodie with Logo',
						'file'       => 'assets/images/customizer/starter-content/products/hoodie-with-logo.jpg',
					),
					'hoodie-with-pocket-image' => array(
						'post_title' => 'Hoodie with Pocket',
						'file'       => 'assets/images/customizer/starter-content/products/hoodie-with-pocket.jpg',
					),
					'hoodie-with-zipper-image' => array(
						'post_title' => 'Hoodie with Zipper',
						'file'       => 'assets/images/customizer/starter-content/products/hoodie-with-zipper.jpg',
					),
					'hoodie-image'             => array(
						'post_title' => 'Hoodie',
						'file'       => 'assets/images/customizer/starter-content/products/hoodie.jpg',
					),
					'long-sleeve-tee-image'    => array(
						'post_title' => 'Long Sleeve Tee',
						'file'       => 'assets/images/customizer/starter-content/products/long-sleeve-tee.jpg',
					),
					'polo-image'               => array(
						'post_title' => 'Polo',
						'file'       => 'assets/images/customizer/starter-content/products/polo.jpg',
					),
					'sunglasses-image'         => array(
						'post_title' => 'Sunglasses',
						'file'       => 'assets/images/customizer/starter-content/products/sunglasses.jpg',
					),
					'tshirt-image'             => array(
						'post_title' => 'Tshirt',
						'file'       => 'assets/images/customizer/starter-content/products/tshirt.jpg',
					),
					'vneck-tee-image'          => array(
						'post_title' => 'Vneck Tshirt',
						'file'       => 'assets/images/customizer/starter-content/products/vneck-tee.jpg',
					),
					'hero-image'               => array(
						'post_title' => 'Hero',
						'file'       => 'assets/images/customizer/starter-content/hero.jpg',
					),
					'accessories-image'        => array(
						'post_title' => 'Accessories',
						'file'       => 'assets/images/customizer/starter-content/categories/accessories.jpg',
					),
					'tshirts-image'            => array(
						'post_title' => 'T-shirts',
						'file'       => 'assets/images/customizer/starter-content/categories/tshirts.jpg',
					),
					'hoodies-image'            => array(
						'post_title' => 'Hoodies',
						'file'       => 'assets/images/customizer/starter-content/categories/hoodies.jpg',
					),
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
		 * Filter WooCommerce main query to include starter content products.
		 *
		 * @since 2.2.0
		 * @param object $query The Query.
		 * @return void
		 */
		public function wc_query( $query ) {
			if ( ! is_customize_preview() || true !== (bool) get_option( 'fresh_site' ) ) {
				return;
			}

			$post__in = array();

			// Add existing products.
			$existing_products = $this->_get_existing_wc_products();

			if ( ! empty( $existing_products ) ) {
				$post__in = array_merge( $post__in, $existing_products );
			}

			// Add starter content.
			$created_products = $this->_get_created_starter_content_products();

			if ( false !== $created_products ) {

				// Merge starter content products.
				$post__in = array_merge( $post__in, $created_products );

				// Allow for multiple status.
				$query->set( 'post_status', get_post_stati() );
			}

			// Add products to query.
			$query->set( 'post__in', $post__in );
		}

		/**
		 * Filter shortcode products loop in WooCommerce.
		 *
		 * @since 2.2.0
		 * @param array  $query_args Query args.
		 * @param array  $atts Shortcode attributes.
		 * @param string $loop_name Loop name.
		 * @return array $args
		 */
		public function shortcode_loop_products( $query_args, $atts, $loop_name = null ) {
			if ( ! is_customize_preview() || true !== (bool) get_option( 'fresh_site' ) ) {
				return $query_args;
			}

			// When a list of ids is already present in the query, return.
			if ( array_key_exists( 'post__in', $query_args ) ) {
				$query_args['post_status'] = get_post_stati();
				return $query_args;
			}

			$query_args['post__in'] = array();

			// Add existing products to query.
			$existing_products = $this->_get_existing_wc_products();

			if ( ! empty( $existing_products ) ) {
				$query_args['post__in'] = array_merge( $query_args['post__in'], $existing_products );
			}

			// Add starter content to query.
			$created_products = $this->_get_created_starter_content_products();

			if ( false !== $created_products ) {

				// Add created products to query.
				$query_args['post__in'] = array_merge( $query_args['post__in'], $created_products );

				// Allow for multiple status.
				$query_args['post_status'] = get_post_stati();
			}

			return $query_args;
		}

		/**
		 * Filter shortcode products loop in WooCommerce.
		 *
		 * @since 2.5.0
		 * @param array  $query_args Query args.
		 * @param array  $atts Shortcode attributes.
		 * @param string $type Loop type.
		 * @return array $query_args
		 */
		public function filter_on_sale_products( $query_args, $atts, $type ) {
			if ( ! is_customize_preview() || true !== (bool) get_option( 'fresh_site' ) ) {
				return $query_args;
			}

			if ( 'sale_products' === $type ) {
				$onsale = array(
					'beanie',
					'belt',
					'cap',
					'hoodie-with-pocket',
				);

				$products = $this->_query_starter_content( 'product', $onsale, true );

				if ( ! empty( $products ) ) {
					$query_args['post__in'] = $products;
				}
			}

			return $query_args;
		}

		/**
		 * Override product categories when displaying starter content.
		 *
		 * @since 2.5.0
		 * @param array $categories Product categories.
		 * @return array $categories Modified product categories.
		 */
		public function filter_product_categories_shortcode( $categories ) {
			if ( ! is_customize_preview() || true !== (bool) get_option( 'fresh_site' ) ) {
				return $categories;
			}

			// Get empty categories.
			$categories = get_terms(
				'product_cat', array(
					'hide_empty' => false,
				)
			);

			foreach ( $categories as $key => $cat ) {

				// Fake number of products in category.
				$categories[ $key ]->count = 1;
			}

			return $categories;
		}

		/**
		 * Add product taxonomies to starter content.
		 *
		 * @since 2.2.0
		 */
		public function add_product_tax() {
			if ( ! is_customize_preview() || true !== (bool) get_option( 'fresh_site' ) ) {
				return;
			}

			$created_products = $this->_get_created_starter_content_products();

			if ( false === $created_products ) {
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
									// Check if the term already exists.
									$category_exists = term_exists( $category['term'], $taxonomy );

									if ( $category_exists ) {
										$category_ids[] = (int) $category_exists['term_id'];

										continue;
									}

									// Create new category.
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
		 * Add product data to starter products.
		 *
		 * @since 2.2.0
		 * @return void
		 */
		public function set_product_data() {
			if ( ! is_customize_preview() || true !== (bool) get_option( 'fresh_site' ) ) {
				return;
			}

			$created_products = $this->_get_created_starter_content_products();

			if ( false === $created_products ) {
				return;
			}

			$starter_products = $this->_starter_content_products();

			if ( is_array( $created_products ) ) {
				foreach ( $created_products as $product ) {
					$product = wc_get_product( $product );

					if ( ! $product ) {
						continue;
					}

					$post_name = get_post_meta( $product->get_id(), '_customize_draft_post_name', true );

					if ( ! $post_name || ! array_key_exists( $post_name, $starter_products ) ) {
						continue;
					}

					if ( ! array_key_exists( 'product_data', $starter_products[ $post_name ] ) ) {
						continue;
					}

					$product_data = $starter_products[ $post_name ]['product_data'];

					// Set visibility.
					$product->set_catalog_visibility( 'visible' );

					// Set regular price.
					if ( ! empty( $product_data['regular_price'] ) ) {
						$product->set_regular_price( floatval( $product_data['regular_price'] ) );
					}

					// Set price.
					if ( ! empty( $product_data['price'] ) ) {
						$product->set_price( floatval( $product_data['price'] ) );
					}

					// Set sale price.
					if ( ! empty( $product_data['sale_price'] ) ) {
						$product->set_sale_price( floatval( $product_data['sale_price'] ) );
					}

					// Set featured.
					if ( ! empty( $product_data['featured'] ) ) {
						$product->set_featured( true );
					} else {
						$product->set_featured( false );
					}

					// Save.
					$product->save();
				}
			}
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
				'product_cat', array(
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
		 * WooCommerce 3.0.0 changes the title of all auto-draft products to "AUTO-DRAFT".
		 * Here we change the title back when the post status changes.
		 *
		 * @since 2.2.0
		 * @param string  $new_status New status.
		 * @param string  $old_status Old status.
		 * @param WP_Post $post       Post data.
		 */
		public function transition_post_status( $new_status, $old_status, $post ) {
			if ( 'publish' === $new_status && 'auto-draft' === $old_status && in_array( $post->post_type, array( 'product' ), true ) ) {
				$post_name = get_post_meta( $post->ID, '_customize_draft_post_name', true );

				$starter_products = $this->_starter_content_products();

				if ( $post_name && array_key_exists( $post_name, $starter_products ) ) {
					$update_product = array(
						'ID'         => $post->ID,
						'post_title' => $starter_products[ $post_name ]['post_title'],
					);

					wp_update_post( $update_product );
				}
			}
		}

		/**
		 * WooCommerce 3.0.0 changes the title of all auto-draft products to "AUTO-DRAFT".
		 * Here we filter the title and display the correct one instead.
		 *
		 * @since 2.2.0
		 * @param string $title   Post title.
		 * @param int    $post_id Post id.
		 */
		public function filter_auto_draft_title( $title, $post_id = null ) {
			if ( ! $post_id ) {
				return $title;
			}

			$post = get_post( $post_id );

			if ( $post && 'auto-draft' === $post->post_status && in_array( $post->post_type, array( 'product' ), true ) && 'AUTO-DRAFT' === $post->post_title ) {
				$post_name = get_post_meta( $post->ID, '_customize_draft_post_name', true );

				$starter_products = $this->_starter_content_products();

				if ( $post_name && array_key_exists( $post_name, $starter_products ) ) {
					return $starter_products[ $post_name ]['post_title'];
				}
			}

			return $title;
		}

		/**
		 * Starter content products.
		 *
		 * @since 2.2.0
		 */
		private function _starter_content_products() {
			$accessories_name        = esc_attr__( 'Accessories', 'storefront' );
			$accessories_description = esc_attr__( 'A short category description', 'storefront' );

			$hoodies_name        = esc_attr__( 'Hoodies', 'storefront' );
			$hoodies_description = esc_attr__( 'A short category description', 'storefront' );

			$tshirts_name        = esc_attr__( 'Tshirts', 'storefront' );
			$tshirts_description = esc_attr__( 'A short category description', 'storefront' );

			$products = array(
				// Accessories.
				'beanie'             => array(
					'post_title'     => esc_attr__( 'Beanie', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{beanie-image}}',
					'product_data'   => array(
						'regular_price' => '20',
						'price'         => '18',
						'sale_price'    => '18',
						'featured'      => false,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $accessories_name,
								'slug'        => 'accessories',
								'description' => $accessories_description,
							),
						),
					),
				),
				'belt'               => array(
					'post_title'     => esc_attr__( 'Belt', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{belt-image}}',
					'product_data'   => array(
						'regular_price' => '65',
						'price'         => '55',
						'sale_price'    => '55',
						'featured'      => false,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $accessories_name,
								'slug'        => 'accessories',
								'description' => $accessories_description,
							),
						),
					),
				),
				'cap'                => array(
					'post_title'     => esc_attr__( 'Cap', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{cap-image}}',
					'product_data'   => array(
						'regular_price' => '18',
						'price'         => '16',
						'sale_price'    => '16',
						'featured'      => false,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $accessories_name,
								'slug'        => 'accessories',
								'description' => $accessories_description,
							),
						),
					),
				),
				'sunglasses'         => array(
					'post_title'     => esc_attr__( 'Sunglasses', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{sunglasses-image}}',
					'product_data'   => array(
						'regular_price' => '90',
						'price'         => '90',
						'featured'      => true,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $accessories_name,
								'slug'        => 'accessories',
								'description' => $accessories_description,
							),
						),
					),
				),
				'hoodie-with-logo'   => array(
					'post_title'     => esc_attr__( 'Hoodie with Logo', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{hoodie-with-logo-image}}',
					'product_data'   => array(
						'regular_price' => '45',
						'price'         => '45',
						'featured'      => false,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $hoodies_name,
								'slug'        => 'hoodies',
								'description' => $hoodies_description,
							),
						),
					),
				),
				'hoodie-with-pocket' => array(
					'post_title'     => esc_attr__( 'Hoodie with Pocket', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{hoodie-with-pocket-image}}',
					'product_data'   => array(
						'regular_price' => '45',
						'price'         => '35',
						'sale_price'    => '35',
						'featured'      => true,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $hoodies_name,
								'slug'        => 'hoodies',
								'description' => $hoodies_description,
							),
						),
					),
				),
				'hoodie-with-zipper' => array(
					'post_title'     => esc_attr__( 'Hoodie with Zipper', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{hoodie-with-zipper-image}}',
					'product_data'   => array(
						'regular_price' => '45',
						'price'         => '45',
						'featured'      => true,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $hoodies_name,
								'slug'        => 'hoodies',
								'description' => $hoodies_description,
							),
						),
					),
				),
				'hoodie'             => array(
					'post_title'     => esc_attr__( 'Hoodie', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{hoodie-image}}',
					'product_data'   => array(
						'regular_price' => '45',
						'price'         => '42',
						'sale_price'    => '42',
						'featured'      => true,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $hoodies_name,
								'slug'        => 'hoodies',
								'description' => $hoodies_description,
							),
						),
					),
				),
				'long-sleeve-tee'    => array(
					'post_title'     => esc_attr__( 'Long Sleeve Tee', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{long-sleeve-tee-image}}',
					'product_data'   => array(
						'regular_price' => '25',
						'price'         => '25',
						'featured'      => false,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $tshirts_name,
								'slug'        => 'tshirts',
								'description' => $tshirts_description,
							),
						),
					),
				),
				'polo'               => array(
					'post_title'     => esc_attr__( 'Polo', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{polo-image}}',
					'product_data'   => array(
						'regular_price' => '20',
						'price'         => '20',
						'featured'      => false,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $tshirts_name,
								'slug'        => 'tshirts',
								'description' => $tshirts_description,
							),
						),
					),
				),
				'tshirt'             => array(
					'post_title'     => esc_attr__( 'Tshirt', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{tshirt-image}}',
					'product_data'   => array(
						'regular_price' => '18',
						'price'         => '18',
						'featured'      => false,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $tshirts_name,
								'slug'        => 'tshirts',
								'description' => $tshirts_description,
							),
						),
					),
				),
				'vneck-tee'          => array(
					'post_title'     => esc_attr__( 'Vneck Tshirt', 'storefront' ),
					'post_content'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
					'post_type'      => 'product',
					'comment_status' => 'open',
					'thumbnail'      => '{{vneck-tee-image}}',
					'product_data'   => array(
						'regular_price' => '18',
						'price'         => '18',
						'featured'      => false,
					),
					'taxonomy'       => array(
						'product_cat' => array(
							array(
								'term'        => $tshirts_name,
								'slug'        => 'tshirts',
								'description' => $tshirts_description,
							),
						),
					),
				),
			);

			// Use symbols as post name.
			foreach ( $products as $symbol => $product ) {
				$products[ $symbol ]['post_name'] = $symbol;
			}

			return apply_filters( 'storefront_starter_content_products', $products );
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

				<!-- wp:woocommerce/product-new {"columns":4} -->
				<div class="wp-block-woocommerce-product-new">[products limit="4" columns="4" orderby="date" order="DESC"]</div>
				<!-- /wp:woocommerce/product-new -->

				{{handpicked-products}}

				<!-- wp:heading {"align":"center"} -->
				<h2 style="text-align:center">' . __( 'Fan Favorites', 'storefront' ) . '</h2>
				<!-- /wp:heading -->

				<!-- wp:woocommerce/product-top-rated {"columns":4} -->
				<div class="wp-block-woocommerce-product-top-rated">[products limit="4" columns="4" orderby="rating"]</div>
				<!-- /wp:woocommerce/product-top-rated -->

				<!-- wp:heading {"align":"center"} -->
				<h2 style="text-align:center">' . __( 'On Sale', 'storefront' ) . '</h2>
				<!-- /wp:heading -->

				<!-- wp:woocommerce/product-on-sale {"columns":4} -->
				<div class="wp-block-woocommerce-product-on-sale">[products limit="4" columns="4" orderby="date" order="DESC" on_sale="1"]</div>
				<!-- /wp:woocommerce/product-on-sale -->

				<!-- wp:heading {"align":"center"} -->
				<h2 style="text-align:center">' . __( 'Best Sellers', 'storefront' ) . '</h2>
				<!-- /wp:heading -->

				<!-- wp:woocommerce/product-best-sellers {"columns":4} -->
				<div class="wp-block-woocommerce-product-best-sellers">[products limit="4" columns="4" best_selling="1"]</div>
				<!-- /wp:woocommerce/product-best-sellers -->
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

					<!-- wp:woocommerce/handpicked-products {"columns":4,"editMode":false,"products":[{{handpicked-products}}]} -->
					<div class = "wp-block-woocommerce-handpicked-products">[products limit="4" columns="4" orderby="date" order="DESC" ids="{{handpicked-products}}"]</div>
					<!-- /wp:woocommerce/handpicked-products -->
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
		 * Given a category slug, find the related image attachment.
		 *
		 * @since 2.2.0
		 * @param string $category Category.
		 * @return mixed false|int $query first attachment found.
		 */
		private function _get_category_image_attachment_id( $category ) {
			$attachment = $this->_query_starter_content( 'attachment', $category . '-image', true );

			if ( ! empty( $attachment ) ) {
				return $attachment[0];
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
