<?php
/**
 * Storefront Admin Class
 *
 * @package  storefront
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Storefront_Admin' ) ) :
	/**
	 * The Storefront admin class
	 */
	class Storefront_Admin {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'welcome_register_menu' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'welcome_style' ) );
		}

		/**
		 * Load welcome screen css
		 *
		 * @param string $hook_suffix the current page hook suffix.
		 * @return void
		 * @since  1.4.4
		 */
		public function welcome_style( $hook_suffix ) {
			global $storefront_version;

			if ( 'appearance_page_storefront-welcome' === $hook_suffix ) {
				wp_enqueue_style( 'storefront-welcome-screen', get_template_directory_uri() . '/assets/css/admin/welcome-screen/welcome.css', $storefront_version );
				wp_style_add_data( 'storefront-welcome-screen', 'rtl', 'replace' );
			}
		}

		/**
		 * Creates the dashboard page
		 *
		 * @see  add_theme_page()
		 * @since 1.0.0
		 */
		public function welcome_register_menu() {
			add_theme_page( 'Storefront', 'Storefront', 'activate_plugins', 'storefront-welcome', array( $this, 'storefront_welcome_screen' ) );
		}

		/**
		 * The welcome screen
		 *
		 * @since 1.0.0
		 */
		public function storefront_welcome_screen() {
			require_once ABSPATH . 'wp-load.php';
			require_once ABSPATH . 'wp-admin/admin.php';
			require_once ABSPATH . 'wp-admin/admin-header.php';

			global $storefront_version;
			?>

			<div class="storefront-wrap">
				<section class="storefront-welcome-nav">
					<span class="storefront-welcome-nav__version">Storefront <?php echo esc_attr( $storefront_version ); ?></span>
					<ul>
						<li><a href="https://wordpress.org/support/theme/storefront" target="_blank"><?php esc_attr_e( 'Support', 'storefront' ); ?></a></li>
						<li><a href="https://docs.woocommerce.com/documentation/themes/storefront/" target="_blank"><?php esc_attr_e( 'Documentation', 'storefront' ); ?></a></li>
						<li><a href="https://woocommerce.wordpress.com/category/storefront/" target="_blank"><?php esc_attr_e( 'Development blog', 'storefront' ); ?></a></li>
					</ul>
				</section>

				<div class="storefront-logo">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/admin/storefront-icon.svg" alt="Storefront" />
				</div>

				<div class="storefront-intro">
					<?php
					/**
					 * Display a different message when the user visits this page when returning from the guided tour
					 */
					$referrer = wp_get_referer();

					if ( strpos( $referrer, 'sf_starter_content' ) !== false ) {
						/* translators: 1: HTML, 2: HTML */
						echo '<h1>' . sprintf( esc_attr__( 'Setup complete %1$sYour Storefront adventure begins now 🚀%2$s ', 'storefront' ), '<span>', '</span>' ) . '</h1>';
						echo '<p>' . esc_attr__( 'One more thing... You might be interested in the following Storefront extensions and designs.', 'storefront' ) . '</p>';
					} else {
						echo '<p>' . esc_attr__( 'Hello! You might be interested in the following Storefront extensions and designs.', 'storefront' ) . '</p>';
					}
					?>
				</div>

				<div class="storefront-enhance">
					<div class="storefront-enhance__column storefront-bundle">
						<h3><?php esc_attr_e( 'Storefront Extensions Bundle', 'storefront' ); ?></h3>
						<span class="bundle-image">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/admin/welcome-screen/storefront-bundle-hero.png" alt="Storefront Extensions Hero" />
						</span>

						<p>
							<?php esc_attr_e( 'All the tools you\'ll need to define your style and customize Storefront.', 'storefront' ); ?>
						</p>

						<p>
							<?php esc_attr_e( 'Make it yours without touching code with the Storefront Extensions bundle. Express yourself, optimize conversions, delight customers.', 'storefront' ); ?>
						</p>


						<p>
							<a href="https://woocommerce.com/products/storefront-extensions-bundle/?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="storefront-button" target="_blank"><?php esc_attr_e( 'Read more and purchase', 'storefront' ); ?></a>
						</p>
					</div>
					<div class="storefront-enhance__column storefront-child-themes">
						<h3><?php esc_attr_e( 'Alternate designs', 'storefront' ); ?></h3>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/admin/welcome-screen/child-themes.jpg" alt="Storefront Powerpack" />

						<p>
							<?php esc_attr_e( 'Quickly and easily transform your shops appearance with Storefront child themes.', 'storefront' ); ?>
						</p>

						<p>
							<?php esc_attr_e( 'Each has been designed to serve a different industry - from fashion to food.', 'storefront' ); ?>
						</p>

						<p>
							<?php esc_attr_e( 'Of course they are all fully compatible with each Storefront extension.', 'storefront' ); ?>
						</p>

						<p>
							<a href="https://woocommerce.com/product-category/themes/storefront-child-theme-themes/?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="storefront-button" target="_blank"><?php esc_attr_e( 'Check \'em out', 'storefront' ); ?></a>
						</p>
					</div>
				</div>

				<div class="automattic">
					<p>
					<?php
						/* translators: %s: Automattic branding */
						printf( esc_html__( 'An %s project', 'storefront' ), '<a href="https://automattic.com/"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/admin/welcome-screen/automattic.png" alt="Automattic" /></a>' );
					?>
					</p>
				</div>
			</div>
			<?php
		}

		/**
		 * Welcome screen intro
		 *
		 * @since 1.0.0
		 */
		public function welcome_intro() {
			require_once get_template_directory() . '/inc/admin/welcome-screen/component-intro.php';
		}

		/**
		 * Output a button that will install or activate a plugin if it doesn't exist, or display a disabled button if the
		 * plugin is already activated.
		 *
		 * @param string $plugin_slug The plugin slug.
		 * @param string $plugin_file The plugin file.
		 */
		public function install_plugin_button( $plugin_slug, $plugin_file ) {
			if ( current_user_can( 'install_plugins' ) && current_user_can( 'activate_plugins' ) ) {
				if ( is_plugin_active( $plugin_slug . '/' . $plugin_file ) ) {
					// The plugin is already active.
					$button = array(
						'message' => esc_attr__( 'Activated', 'storefront' ),
						'url'     => '#',
						'classes' => 'disabled',
					);
				} elseif ( $this->_is_plugin_installed( $plugin_slug ) ) {
					$url = $this->_is_plugin_installed( $plugin_slug );

					// The plugin exists but isn't activated yet.
					$button = array(
						'message' => esc_attr__( 'Activate', 'storefront' ),
						'url'     => $url,
						'classes' => 'activate-now',
					);
				} else {
					// The plugin doesn't exist.
					$url    = wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'install-plugin',
								'plugin' => $plugin_slug,
							), self_admin_url( 'update.php' )
						), 'install-plugin_' . $plugin_slug
					);
					$button = array(
						'message' => esc_attr__( 'Install now', 'storefront' ),
						'url'     => $url,
						'classes' => ' install-now install-' . $plugin_slug,
					);
				}
				?>
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="storefront-button <?php echo esc_attr( $button['classes'] ); ?>" data-originaltext="<?php echo esc_attr( $button['message'] ); ?>" data-slug="<?php echo esc_attr( $plugin_slug ); ?>" aria-label="<?php echo esc_attr( $button['message'] ); ?>"><?php echo esc_attr( $button['message'] ); ?></a>
				<a href="https://wordpress.org/plugins/<?php echo esc_attr( $plugin_slug ); ?>" target="_blank"><?php esc_attr_e( 'Learn more', 'storefront' ); ?></a>
				<?php
			}
		}

		/**
		 * Check if a plugin is installed and return the url to activate it if so.
		 *
		 * @param string $plugin_slug The plugin slug.
		 */
		public function _is_plugin_installed( $plugin_slug ) {
			if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin_slug ) ) {
				$plugins = get_plugins( '/' . $plugin_slug );
				if ( ! empty( $plugins ) ) {
					$keys        = array_keys( $plugins );
					$plugin_file = $plugin_slug . '/' . $keys[0];
					$url         = wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'activate',
								'plugin' => $plugin_file,
							), admin_url( 'plugins.php' )
						), 'activate-plugin_' . $plugin_file
					);
					return $url;
				}
			}
			return false;
		}
		/**
		 * Welcome screen enhance section
		 *
		 * @since 1.5.2
		 */
		public function welcome_enhance() {
			require_once get_template_directory() . '/inc/admin/welcome-screen/component-enhance.php';
		}

		/**
		 * Welcome screen contribute section
		 *
		 * @since 1.5.2
		 */
		public function welcome_contribute() {
			require_once get_template_directory() . '/inc/admin/welcome-screen/component-contribute.php';
		}

		/**
		 * Get product data from json
		 *
		 * @param  string $url       URL to the json file.
		 * @param  string $transient Name the transient.
		 * @return [type]            [description]
		 */
		public function get_storefront_product_data( $url, $transient ) {
			$raw_products = wp_safe_remote_get( $url );
			$products     = json_decode( wp_remote_retrieve_body( $raw_products ) );

			if ( ! empty( $products ) ) {
				set_transient( $transient, $products, DAY_IN_SECONDS );
			}

			return $products;
		}
	}

endif;

return new Storefront_Admin();
