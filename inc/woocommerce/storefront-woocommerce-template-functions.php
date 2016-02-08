<?php
/**
 * WooCommerce Template Functions.
 *
 * @package storefront
 */

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'storefront_before_content' ) ) {
	function storefront_before_content() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
	    	<?php
	}
}

/**
 * After Content
 * Closes the wrapping divs
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'storefront_after_content' ) ) {
	function storefront_after_content() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php do_action( 'storefront_sidebar' );
	}
}

/**
 * Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 * @param  array $fragments Fragments to refresh via AJAX
 * @return array            Fragments to refresh via AJAX
 */
if ( ! function_exists( 'storefront_cart_link_fragment' ) ) {
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

/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 * @param  array $settings Settings
 * @return array           Settings
 * @since  1.0.0
 */
if ( ! function_exists( 'storefront_cart_link' ) ) {
	function storefront_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'storefront' ); ?>">
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'storefront' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>
		<?php
	}
}

/**
 * Display Product Search
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'storefront_product_search' ) ) {
	function storefront_product_search() {
		if ( is_woocommerce_activated() ) { ?>
			<div class="site-search">
				<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
			</div>
		<?php
		}
	}
}

/**
 * Display Header Cart
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'storefront_header_cart' ) ) {
	function storefront_header_cart() {
		if ( is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
		?>
		<ul class="site-header-cart menu">
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

/**
 * Upsells
 * Replace the default upsell function with our own which displays the correct number product columns
 * @since   1.0.0
 * @return  void
 * @uses    woocommerce_upsell_display()
 */
if ( ! function_exists( 'storefront_upsell_display' ) ) {
	function storefront_upsell_display() {
		woocommerce_upsell_display( -1, 3 );
	}
}

/**
 * Sorting wrapper
 * @since   1.4.3
 * @return  void
 */
function storefront_sorting_wrapper() {
	echo '<div class="storefront-sorting">';
}

/**
 * Sorting wrapper close
 * @since   1.4.3
 * @return  void
 */
function storefront_sorting_wrapper_close() {
	echo '</div>';
}

/**
 * Storefront shop messages
 * @since   1.4.4
 * @uses    do_shortcode
 */
function storefront_shop_messages() {
	if ( ! is_checkout() ) {
		echo wp_kses_post( storefront_do_shortcode( 'woocommerce_messages' ) );
	}
}

/**
 * Storefront WooCommerce Pagination
 * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
 * but since Storefront adds pagination before that function is excuted we need a separate function to
 * determine whether or not to display the pagination.
 * @since 1.4.4
 */
if ( ! function_exists( 'storefront_woocommerce_pagination' ) ) {
	function storefront_woocommerce_pagination() {
		if ( woocommerce_products_will_display() ) {
			woocommerce_pagination();
		}
	}
}

/**
 * Featured and On-Sale Products
 * Check for featured products then on-sale products and use the appropiate shortcode.
 * If neither exist, it can fallback to show recently added products.
 * @since  1.5.1
 * @uses  is_woocommerce_activated()
 * @uses  wc_get_featured_product_ids()
 * @uses  wc_get_product_ids_on_sale()
 * @uses  storefront_do_shortcode()
 * @return void
 */
if ( ! function_exists( 'storefront_promoted_products' ) ) {
	function storefront_promoted_products( $per_page = '2', $columns = '2', $recent_fallback = true ) {
		if ( is_woocommerce_activated() ) {

			if ( wc_get_featured_product_ids() ) {

				echo '<h2>' . esc_html__( 'Featured Products', 'storefront' ) . '</h2>';

				echo storefront_do_shortcode( 'featured_products', array(
											'per_page' 	=> $per_page,
											'columns'	=> $columns,
										) );
			} elseif ( wc_get_product_ids_on_sale() ) {

				echo '<h2>' . esc_html__( 'On Sale Now', 'storefront' ) . '</h2>';

				echo storefront_do_shortcode( 'sale_products', array(
											'per_page' 	=> $per_page,
											'columns'	=> $columns,
										) );
			} elseif ( $recent_fallback ) {

				echo '<h2>' . esc_html__( 'New In Store', 'storefront' ) . '</h2>';

				echo storefront_do_shortcode( 'recent_products', array(
											'per_page' 	=> $per_page,
											'columns'	=> $columns,
										) );
			}
		}
	}
}

/**
 * Display a menu intended for use on handheld devices
 * @since 2.0.0
 */
function storefront_handheld_footer_bar() {
	$links = apply_filters( 'storefront_handheld_footer_bar_links', array(
		'my-account'	=> array(
			'priority' 	=> 10,
			'callback' 	=> 'storefront_handheld_footer_bar_account_link'
		),
		'search'	=> array(
			'priority' 	=> 20,
			'callback' 	=> 'storefront_handheld_footer_bar_search'
		),
		'cart'	=> array(
			'priority' 	=> 30,
			'callback' 	=> 'storefront_handheld_footer_bar_cart_link'
		),
	) );
	?>
	<section class="storefront-handheld-footer-bar">
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
	</section>
	<?php
}

/**
 * The search callback function for the handheld footer bar
 * @since 2.0.0
 */
function storefront_handheld_footer_bar_search() {
	echo '<a href="#">' . esc_attr__( 'Search', 'storefront' ) . '</a>';
	storefront_product_search();
}

/**
 * The cart callback function for the handheld footer bar
 * @since 2.0.0
 */
function storefront_handheld_footer_bar_cart_link() {
	?>
		<a class="footer-cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'storefront' ); ?>">
			<span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
		</a>
	<?php
}

/**
 * The account callback function for the handheld footer bar
 * @since 2.0.0
 */
function storefront_handheld_footer_bar_account_link() {
	echo '<a href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '">' . esc_attr__( 'My Account', 'storefront' ) . '</a>';
}