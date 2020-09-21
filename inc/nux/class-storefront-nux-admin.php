<?php
/**
 * Storefront NUX Admin Class
 *
 * @package  storefront
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Storefront_NUX_Admin' ) ) :

	/**
	 * The Storefront NUX Admin class
	 */
	class Storefront_NUX_Admin {
		/**
		 * Setup class.
		 *
		 * @since 2.2.0
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_notices', array( $this, 'admin_notices' ), 99 );
			add_action( 'wp_ajax_storefront_dismiss_notice', array( $this, 'dismiss_nux' ) );
			add_action( 'admin_post_storefront_starter_content', array( $this, 'redirect_customizer' ) );
			add_action( 'init', array( $this, 'log_fresh_site_state' ) );
			add_filter( 'admin_body_class', array( $this, 'admin_body_class' ) );
		}

		/**
		 * Enqueue scripts.
		 *
		 * @since 2.2.0
		 */
		public function enqueue_scripts() {
			global $wp_customize, $storefront_version;

			if ( isset( $wp_customize ) || true === (bool) get_option( 'storefront_nux_dismissed' ) ) {
				return;
			}

			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_style( 'storefront-admin-nux', get_template_directory_uri() . '/assets/css/admin/admin.css', '', $storefront_version );
			wp_style_add_data( 'storefront-admin-nux', 'rtl', 'replace' );

			wp_enqueue_script( 'storefront-admin-nux', get_template_directory_uri() . '/assets/js/admin/admin' . $suffix . '.js', array( 'jquery' ), $storefront_version, 'all' );

			$storefront_nux = array(
				'nonce' => wp_create_nonce( 'storefront_notice_dismiss' ),
			);

			wp_localize_script( 'storefront-admin-nux', 'storefrontNUX', $storefront_nux );
		}

		/**
		 * Output admin notices.
		 *
		 * @since 2.2.0
		 */
		public function admin_notices() {
			global $pagenow;

			if ( true === (bool) get_option( 'storefront_nux_dismissed' ) ) {
				return;
			}

			// Coming from the WooCommerce Wizard?
			if ( wp_get_referer() && 0 === strpos( basename( wp_get_referer() ), 'index.php?page=wc-setup' ) && 'post-new.php' === $pagenow ) {
				return;
			}
			?>

			<div class="notice notice-info sf-notice-nux is-dismissible">
				<span class="sf-icon">
					<?php echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/admin/storefront-icon.svg" alt="Storefront" width="250" />'; ?>
				</span>

				<div class="notice-content">
					<?php if ( ! storefront_is_woocommerce_activated() && current_user_can( 'install_plugins' ) && current_user_can( 'activate_plugins' ) ) : ?>
						<h2><?php esc_html_e( 'Thanks for installing Storefront, you rock! 🤘', 'storefront' ); ?></h2>
						<p><?php esc_html_e( 'To enable eCommerce features you need to install the WooCommerce plugin.', 'storefront' ); ?></p>
						<p><?php Storefront_Plugin_Install::install_plugin_button( 'woocommerce', 'woocommerce.php', 'WooCommerce', array(), __( 'WooCommerce activated', 'storefront' ), __( 'Activate WooCommerce', 'storefront' ), __( 'Install WooCommerce', 'storefront' ) ); ?></p>
					<?php endif; ?>

					<?php if ( storefront_is_woocommerce_activated() ) : ?>
						<h2><?php esc_html_e( 'Design your store 🎨', 'storefront' ); ?></h2>
						<p>
							<?php
							if ( true === (bool) get_option( 'storefront_nux_fresh_site' ) && 'post-new.php' === $pagenow ) {
								echo esc_html__( 'Before you add your first product let\'s design your store. We\'ll add some example products for you. When you\'re ready let\'s get started by adding your logo.', 'storefront' );
							} else {
								echo esc_html__( 'You\'ve set up WooCommerce, now it\'s time to give it some style! Let\'s get started by entering the Customizer and adding your logo.', 'storefront' );
							}
							?>
						</p>
						<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
							<input type="hidden" name="action" value="storefront_starter_content">
							<?php wp_nonce_field( 'storefront_starter_content' ); ?>

							<?php if ( true === (bool) get_option( 'storefront_nux_fresh_site' ) ) : ?>
								<input type="hidden" name="homepage" value="on">
							<?php endif; ?>

							<?php if ( true === (bool) get_option( 'storefront_nux_fresh_site' ) && true === $this->_is_woocommerce_empty() ) : ?>
								<input type="hidden" name="products" value="on">
							<?php endif; ?>

							<?php if ( false === (bool) get_option( 'storefront_nux_fresh_site' ) ) : ?>
								<label>
									<input type="checkbox" name="homepage" checked>
									<?php
									if ( 'page' === get_option( 'show_on_front' ) ) {
										esc_html_e( 'Apply the Storefront homepage template', 'storefront' );
									} else {
										esc_html_e( 'Create a homepage using Storefront\'s homepage template', 'storefront' );
									}
									?>
								</label>

								<?php if ( true === $this->_is_woocommerce_empty() ) : ?>
									<label>
										<input type="checkbox" name="products" checked>
										<?php esc_html_e( 'Add example products', 'storefront' ); ?>
									</label>
								<?php endif; ?>
							<?php endif; ?>

							<input type="submit" name="storefront-guided-tour" class="sf-nux-button" value="<?php esc_attr_e( 'Let\'s go!', 'storefront' ); ?>">
						</form>
					<?php endif; ?>
				</div>
			</div>
			<?php
		}

		/**
		 * AJAX dismiss notice.
		 *
		 * @since 2.2.0
		 */
		public function dismiss_nux() {
			if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['nonce'] ) ), 'storefront_notice_dismiss' ) || ! current_user_can( 'manage_options' ) ) { // WPCS: input var ok.
				die();
			}

			update_option( 'storefront_nux_dismissed', true );
		}

		/**
		 * Redirects to the customizer with the correct variables.
		 *
		 * @since 2.2.0
		 */
		public function redirect_customizer() {
			check_admin_referer( 'storefront_starter_content' );

			if ( current_user_can( 'manage_options' ) ) {

				// Dismiss notice.
				update_option( 'storefront_nux_dismissed', true );
			}

			$args = array( 'sf_starter_content' => '1' );

			$tasks = array();

			if ( ! empty( $_REQUEST['homepage'] ) && 'on' === sanitize_text_field( wp_unslash( $_REQUEST['homepage'] ) ) ) { // WPCS: input var ok.
				if ( current_user_can( 'edit_pages' ) && 'page' === get_option( 'show_on_front' ) ) {
					$this->_assign_page_template( get_option( 'page_on_front' ), 'template-homepage.php' );
				} else {
					$tasks[] = 'homepage';
				}
			}

			if ( ! empty( $_REQUEST['products'] ) && 'on' === sanitize_text_field( wp_unslash( $_REQUEST['products'] ) ) ) { // WPCS: input var ok.
				$tasks[] = 'products';
			}

			if ( ! empty( $tasks ) ) {
				$args['sf_tasks'] = implode( ',', $tasks );

				if ( current_user_can( 'manage_options' ) ) {

					// Make sure the fresh_site flag is set to true.
					update_option( 'fresh_site', true );

					if ( current_user_can( 'edit_pages' ) && true === (bool) get_option( 'storefront_nux_fresh_site' ) ) {
						$this->_set_woocommerce_pages_full_width();
					}
				}
			}

			// Redirect to the Storefront Welcome screen when exiting the Customizer.
			$args['return'] = rawurlencode( admin_url( 'themes.php?page=storefront-welcome' ) );

			wp_safe_redirect( add_query_arg( $args, admin_url( 'customize.php' ) ) );

			die();
		}

		/**
		 * Get WooCommerce page ids.
		 *
		 * @since 2.2.0
		 */
		public static function get_woocommerce_pages() {
			$woocommerce_pages = array();

			$wc_pages_options = apply_filters(
				'storefront_page_option_names', array(
					'woocommerce_cart_page_id',
					'woocommerce_checkout_page_id',
					'woocommerce_myaccount_page_id',
					'woocommerce_shop_page_id',
					'woocommerce_terms_page_id',
				)
			);

			foreach ( $wc_pages_options as $option ) {
				$page_id = get_option( $option );

				if ( ! empty( $page_id ) ) {
					$page_id = intval( $page_id );

					if ( null !== get_post( $page_id ) ) {
						$woocommerce_pages[ $option ] = $page_id;
					}
				}
			}

			return $woocommerce_pages;
		}

		/**
		 * Update Storefront fresh site flag.
		 *
		 * @since 2.2.0
		 */
		public function log_fresh_site_state() {
			if ( null === get_option( 'storefront_nux_fresh_site', null ) ) {
				update_option( 'storefront_nux_fresh_site', get_option( 'fresh_site' ) );
			}
		}

		/**
		 * Add custom classes to the list of admin body classes.
		 *
		 * @since 2.2.0
		 * @param string $classes Classes for the admin body element.
		 * @return string
		 */
		public function admin_body_class( $classes ) {
			if ( true === (bool) get_option( 'storefront_nux_dismissed' ) ) {
				return $classes;
			}

			$classes .= ' sf-nux ';

			return $classes;
		}

		/**
		 * Set WooCommerce pages to use the full width template.
		 *
		 * @since 2.2.0
		 */
		private function _set_woocommerce_pages_full_width() {
			$wc_pages = $this->get_woocommerce_pages();

			foreach ( $wc_pages as $option => $page_id ) {
				$this->_assign_page_template( $page_id, 'template-fullwidth.php' );
			}
		}

		/**
		 * Given a page id assign a given page template to it.
		 *
		 * @since 2.2.0
		 * @param int    $page_id  Page id.
		 * @param string $template Template file name.
		 * @return void|bool Returns false if $page_id or $template is empty.
		 */
		private function _assign_page_template( $page_id, $template ) {
			if ( empty( $page_id ) || empty( $template ) || '' === locate_template( $template ) ) {
				return false;
			}

			update_post_meta( $page_id, '_wp_page_template', $template );
		}

		/**
		 * Check if WooCommerce is empty.
		 *
		 * @since 2.2.0
		 * @return bool
		 */
		private function _is_woocommerce_empty() {
			$products = wp_count_posts( 'product' );

			if ( 0 < $products->publish ) {
				return false;
			}

			return true;
		}
	}

endif;

return new Storefront_NUX_Admin();
