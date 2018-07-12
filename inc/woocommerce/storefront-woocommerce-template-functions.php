<?php
/**
 * WooCommerce Template Functions.
 *
 * @package storefront
 */

if ( ! function_exists( 'storefront_before_content' ) ) {
	/**
	 * Before Content
	 * Wraps all WooCommerce content in wrappers which match the theme markup
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function storefront_before_content() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
		<?php
	}
}

if ( ! function_exists( 'storefront_after_content' ) ) {
	/**
	 * After Content
	 * Closes the wrapping divs
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function storefront_after_content() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php do_action( 'storefront_sidebar' );
	}
}

if ( ! function_exists( 'storefront_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments
	 * Ensure cart contents update when products are added to the cart via AJAX
	 *
	 * @param  array $fragments Fragments to refresh via AJAX.
	 * @return array            Fragments to refresh via AJAX
	 */
	function storefront_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();
		storefront_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		ob_start();
		storefront_handheld_footer_bar_cart_link();
		$fragments['a.footer-cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

if ( ! function_exists( 'storefront_cart_link' ) ) {
	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function storefront_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>">
				<?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'storefront' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'storefront_product_search' ) ) {
	/**
	 * Display Product Search
	 *
	 * @since  1.0.0
	 * @uses  storefront_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function storefront_product_search() {
		if ( storefront_is_woocommerce_activated() ) { ?>
			<div class="site-search">
				<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
			</div>
		<?php
		}
	}
}

if ( ! function_exists( 'storefront_header_cart' ) ) {
	/**
	 * Display Header Cart
	 *
	 * @since  1.0.0
	 * @uses  storefront_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function storefront_header_cart() {
		if ( storefront_is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
		?>
		<ul id="site-header-cart" class="site-header-cart menu">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php storefront_cart_link(); ?>
			</li>
			<li>
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</li>
		</ul>
		<?php
		}
	}
}

if ( ! function_exists( 'storefront_upsell_display' ) ) {
	/**
	 * Upsells
	 * Replace the default upsell function with our own which displays the correct number product columns
	 *
	 * @since   1.0.0
	 * @return  void
	 * @uses    woocommerce_upsell_display()
	 */
	function storefront_upsell_display() {
		$columns = apply_filters( 'storefront_upsells_columns', 3 );
		woocommerce_upsell_display( -1, $columns );
	}
}

if ( ! function_exists( 'storefront_sorting_wrapper' ) ) {
	/**
	 * Sorting wrapper
	 *
	 * @since   1.4.3
	 * @return  void
	 */
	function storefront_sorting_wrapper() {
		echo '<div class="storefront-sorting">';
	}
}

if ( ! function_exists( 'storefront_sorting_wrapper_close' ) ) {
	/**
	 * Sorting wrapper close
	 *
	 * @since   1.4.3
	 * @return  void
	 */
	function storefront_sorting_wrapper_close() {
		echo '</div>';
	}
}

if ( ! function_exists( 'storefront_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper
	 *
	 * @since   2.2.0
	 * @return  void
	 */
	function storefront_product_columns_wrapper() {
		$columns = storefront_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}

if ( ! function_exists( 'storefront_loop_columns' ) ) {
	/**
	 * Default loop columns on product archives
	 *
	 * @return integer products per row
	 * @since  1.0.0
	 */
	function storefront_loop_columns() {
		$columns = 3; // 3 products per row

		if ( function_exists( 'wc_get_default_products_per_row' ) ) {
			$columns = wc_get_default_products_per_row();
		}

		return apply_filters( 'storefront_loop_columns', $columns );
	}
}

if ( ! function_exists( 'storefront_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close
	 *
	 * @since   2.2.0
	 * @return  void
	 */
	function storefront_product_columns_wrapper_close() {
		echo '</div>';
	}
}

if ( ! function_exists( 'storefront_shop_messages' ) ) {
	/**
	 * Storefront shop messages
	 *
	 * @since   1.4.4
	 * @uses    storefront_do_shortcode
	 */
	function storefront_shop_messages() {
		if ( ! is_checkout() ) {
			echo wp_kses_post( storefront_do_shortcode( 'woocommerce_messages' ) );
		}
	}
}

if ( ! function_exists( 'storefront_woocommerce_pagination' ) ) {
	/**
	 * Storefront WooCommerce Pagination
	 * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
	 * but since Storefront adds pagination before that function is excuted we need a separate function to
	 * determine whether or not to display the pagination.
	 *
	 * @since 1.4.4
	 */
	function storefront_woocommerce_pagination() {
		if ( woocommerce_products_will_display() ) {
			woocommerce_pagination();
		}
	}
}

if ( ! function_exists( 'storefront_promoted_products' ) ) {
	/**
	 * Featured and On-Sale Products
	 * Check for featured products then on-sale products and use the appropiate shortcode.
	 * If neither exist, it can fallback to show recently added products.
	 *
	 * @since  1.5.1
	 * @param integer $per_page total products to display.
	 * @param integer $columns columns to arrange products in to.
	 * @param boolean $recent_fallback Should the function display recent products as a fallback when there are no featured or on-sale products?.
	 * @uses  storefront_is_woocommerce_activated()
	 * @uses  wc_get_featured_product_ids()
	 * @uses  wc_get_product_ids_on_sale()
	 * @uses  storefront_do_shortcode()
	 * @return void
	 */
	function storefront_promoted_products( $per_page = '2', $columns = '2', $recent_fallback = true ) {
		if ( storefront_is_woocommerce_activated() ) {

			if ( wc_get_featured_product_ids() ) {

				echo '<h2>' . esc_html__( 'Featured Products', 'storefront' ) . '</h2>';

				echo storefront_do_shortcode( 'featured_products', array(
											'per_page' => $per_page,
											'columns'  => $columns,
				) );
			} elseif ( wc_get_product_ids_on_sale() ) {

				echo '<h2>' . esc_html__( 'On Sale Now', 'storefront' ) . '</h2>';

				echo storefront_do_shortcode( 'sale_products', array(
											'per_page' => $per_page,
											'columns'  => $columns,
				) );
			} elseif ( $recent_fallback ) {

				echo '<h2>' . esc_html__( 'New In Store', 'storefront' ) . '</h2>';

				echo storefront_do_shortcode( 'recent_products', array(
											'per_page' => $per_page,
											'columns'  => $columns,
				) );
			}
		}
	}
}

if ( ! function_exists( 'storefront_handheld_footer_bar' ) ) {
	/**
	 * Display a menu intended for use on handheld devices
	 *
	 * @since 2.0.0
	 */
	function storefront_handheld_footer_bar() {
		$links = array(
			'my-account' => array(
				'priority' => 10,
				'callback' => 'storefront_handheld_footer_bar_account_link',
			),
			'search'     => array(
				'priority' => 20,
				'callback' => 'storefront_handheld_footer_bar_search',
			),
			'cart'       => array(
				'priority' => 30,
				'callback' => 'storefront_handheld_footer_bar_cart_link',
			),
		);

		if ( wc_get_page_id( 'myaccount' ) === -1 ) {
			unset( $links['my-account'] );
		}

		if ( wc_get_page_id( 'cart' ) === -1 ) {
			unset( $links['cart'] );
		}

		$links = apply_filters( 'storefront_handheld_footer_bar_links', $links );
		?>
		<div class="storefront-handheld-footer-bar">
			<ul class="columns-<?php echo count( $links ); ?>">
				<?php foreach ( $links as $key => $link ) : ?>
					<li class="<?php echo esc_attr( $key ); ?>">
						<?php
						if ( $link['callback'] ) {
							call_user_func( $link['callback'], $key, $link );
						}
						?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
	}
}

if ( ! function_exists( 'storefront_handheld_footer_bar_search' ) ) {
	/**
	 * The search callback function for the handheld footer bar
	 *
	 * @since 2.0.0
	 */
	function storefront_handheld_footer_bar_search() {
		echo '<a href="">' . esc_attr__( 'Search', 'storefront' ) . '</a>';
		storefront_product_search();
	}
}

if ( ! function_exists( 'storefront_handheld_footer_bar_cart_link' ) ) {
	/**
	 * The cart callback function for the handheld footer bar
	 *
	 * @since 2.0.0
	 */
	function storefront_handheld_footer_bar_cart_link() {
		?>
			<a class="footer-cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>">
				<span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'storefront_handheld_footer_bar_account_link' ) ) {
	/**
	 * The account callback function for the handheld footer bar
	 *
	 * @since 2.0.0
	 */
	function storefront_handheld_footer_bar_account_link() {
		echo '<a href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '">' . esc_attr__( 'My Account', 'storefront' ) . '</a>';
	}
}

if ( ! function_exists( 'storefront_single_product_pagination' ) ) {
	/**
	 * Single Product Pagination
	 *
	 * @since 2.3.0
	 */
	function storefront_single_product_pagination() {
		if ( class_exists( 'Storefront_Product_Pagination' ) || true !== get_theme_mod( 'storefront_product_pagination' ) ) {
			return;
		}

		// Show only products in the same category?
		$in_same_term   = apply_filters( 'storefront_single_product_pagination_same_category', false );
		$excluded_terms = apply_filters( 'storefront_single_product_pagination_excluded_terms', '' );
		$taxonomy       = apply_filters( 'storefront_single_product_pagination_taxonomy', 'product_cat' );

		// Get previous and next products.
		$previous_product = get_previous_post( $in_same_term, $excluded_terms, $taxonomy );
		$next_product     = get_next_post( $in_same_term, $excluded_terms, $taxonomy );

		if ( ! $previous_product && ! $next_product ) {
			return;
		}

		if ( $previous_product ) {
			$previous_product = wc_get_product( $previous_product->ID );
		}

		if ( $next_product ) {
			$next_product = wc_get_product( $next_product->ID );
		}

		?>
		<nav class="storefront-product-pagination" aria-label="<?php esc_attr_e( 'More products', 'storefront' ); ?>">
			<?php if ( $previous_product && $previous_product->is_visible() ) : ?>
				<?php previous_post_link( '%link', wp_kses_post( $previous_product->get_image() ) . '<span class="storefront-product-pagination__title">%title</span>', $in_same_term, $excluded_terms, $taxonomy ); ?>
			<?php endif; ?>

			<?php if ( $next_product && $next_product->is_visible() ) : ?>
				<?php next_post_link( '%link', wp_kses_post( $next_product->get_image() ) . '<span class="storefront-product-pagination__title">%title</span>', $in_same_term, $excluded_terms, $taxonomy ); ?>
			<?php endif; ?>
		</nav><!-- .storefront-product-pagination -->
		<?php
	}
}

if ( ! function_exists( 'storefront_sticky_single_add_to_cart' ) ) {
	/**
	 * Sticky Add to Cart
	 *
	 * @since 2.3.0
	 */
	function storefront_sticky_single_add_to_cart() {
		global $product;

		if ( class_exists( 'Storefront_Sticky_Add_to_Cart' ) || true !== get_theme_mod( 'storefront_sticky_add_to_cart' ) ) {
			return;
		}

		if ( ! is_product() ) {
			return;
		}

		$params = apply_filters( 'storefront_sticky_add_to_cart_params', array(
			'trigger_class' => 'entry-summary'
		) );

		wp_localize_script( 'storefront-sticky-add-to-cart', 'storefront_sticky_add_to_cart_params', $params );

		wp_enqueue_script( 'storefront-sticky-add-to-cart' );
		?>
			<section class="storefront-sticky-add-to-cart">
				<div class="col-full">
					<div class="storefront-sticky-add-to-cart__content">
						<?php echo wp_kses_post( woocommerce_get_product_thumbnail() ); ?>
						<div class="storefront-sticky-add-to-cart__content-product-info">
							<span class="storefront-sticky-add-to-cart__content-title"><?php esc_attr_e( 'You\'re viewing:', 'storefront' ); ?> <strong><?php the_title(); ?></strong></span>
							<span class="storefront-sticky-add-to-cart__content-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
							<?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating() ) ); ?>
						</div>
						<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="storefront-sticky-add-to-cart__content-button button alt">
							<?php echo esc_attr( $product->add_to_cart_text() ); ?>
						</a>
					</div>
				</div>
			</section><!-- .storefront-sticky-add-to-cart -->
		<?php
	}
}

if ( ! function_exists( 'storefront_woocommerce_brands_homepage_section' ) ) {
	/**
	 * Display WooCommerce Brands
	 * Hooked into the `homepage` action in the homepage template.
	 * Requires WooCommerce Brands.
	 *
	 * @since  2.3.0
	 * @link   https://woocommerce.com/products/brands/
	 * @uses   apply_filters()
	 * @uses   storefront_do_shortcode()
	 * @uses   wp_kses_post()
	 * @uses   do_action()
	 * @return void
	 */
	function storefront_woocommerce_brands_homepage_section() {
		$args = apply_filters( 'storefront_woocommerce_brands_args', array(
			'number'     => 6,
			'columns'    => 4,
			'orderby'    => 'name',
			'show_empty' => false,
			'title'      => __( 'Shop by Brand', 'storefront' ),
		) );

		$shortcode_content = storefront_do_shortcode( 'product_brand_thumbnails', apply_filters( 'storefront_woocommerce_brands_shortcode_args', array(
			'number'     => absint( $args['number'] ),
			'columns'    => absint( $args['columns'] ),
			'orderby'    => esc_attr( $args['orderby'] ),
			'show_empty' => (bool) $args['show_empty'],
		) ) );

		echo '<section class="storefront-product-section storefront-woocommerce-brands" aria-label="' . esc_attr__( 'Product Brands', 'storefront' ) . '">';

		do_action( 'storefront_homepage_before_woocommerce_brands' );

		echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

		do_action( 'storefront_homepage_after_woocommerce_brands_title' );

		echo $shortcode_content;

		do_action( 'storefront_homepage_after_woocommerce_brands' );

		echo '</section>';
	}
}

if ( ! function_exists( 'storefront_woocommerce_brands_archive' ) ) {
	/**
	 * Display brand image on brand archives
	 * Requires WooCommerce Brands.
	 *
	 * @since  2.3.0
	 * @link   https://woocommerce.com/products/brands/
	 * @uses   is_tax()
	 * @uses   wp_kses_post()
	 * @uses   get_brand_thumbnail_image()
	 * @uses   get_queried_object()
	 * @return void
	 */
	function storefront_woocommerce_brands_archive() {
		if ( is_tax( 'product_brand' ) ) {
			echo wp_kses_post( get_brand_thumbnail_image( get_queried_object() ) );
		}
	}
}

if ( ! function_exists( 'storefront_woocommerce_brands_single' ) ) {
	/**
	 * Output product brand image for use on single product pages
	 * Requires WooCommerce Brands.
	 *
	 * @since  2.3.0
	 * @link   https://woocommerce.com/products/brands/
	 * @uses   storefront_do_shortcode()
	 * @uses   wp_kses_post()
	 * @return void
	 */
	function storefront_woocommerce_brands_single() {
		$brand = storefront_do_shortcode( 'product_brand', array(
			'class' => ''
		) );

		if ( empty( $brand ) ) {
			return;
		}

		?>
		<div class="storefront-wc-brands-single-product">
			<?php echo wp_kses_post( $brand ); ?>
		</div>
		<?php
	}
}
