<?php
/**
 * Storefront Admin Class
 *
 * @author   WooThemes
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
			add_action( 'admin_menu', 				array( $this, 'welcome_register_menu' ) );
			add_action( 'load-themes.php',			array( $this, 'activation_admin_notice' ) );
			add_action( 'admin_enqueue_scripts', 	array( $this, 'welcome_style' ) );
		}

		/**
		 * Adds an admin notice upon successful activation.
		 *
		 * @since 1.0.3
		 */
		public function activation_admin_notice() {
			global $pagenow;

			if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) { // Input var okay.
				add_action( 'admin_notices', array( $this, 'storefront_welcome_admin_notice' ), 99 );
			}
		}

		/**
		 * Display an admin notice linking to the welcome screen
		 *
		 * @since 1.0.3
		 */
		public function storefront_welcome_admin_notice() {
			?>
				<div class="updated notice is-dismissible">
					<p><?php echo sprintf( esc_html__( 'Thanks for choosing Storefront! You can read hints and tips on how get the most out of your new theme on the %swelcome screen%s.', 'storefront' ), '<a href="' . esc_url( admin_url( 'themes.php?page=storefront-welcome' ) ) . '">', '</a>' ); ?></p>
					<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=storefront-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php esc_attr_e( 'Get started with Storefront', 'storefront' ); ?></a></p>
				</div>
			<?php
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

			if ( 'appearance_page_storefront-welcome' == $hook_suffix ) {
				wp_enqueue_style( 'storefront-welcome-screen', get_template_directory_uri() . '/assets/sass/admin/welcome-screen/welcome.css', $storefront_version );
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
			require_once( ABSPATH . 'wp-load.php' );
			require_once( ABSPATH . 'wp-admin/admin.php' );
			require_once( ABSPATH . 'wp-admin/admin-header.php' );

			global $storefront_version;
			?>

			<div class="storefront-wrap">
				<section class="storefront-welcome-nav">
					<span class="storefront-welcome-nav__version">Storefront <?php echo $storefront_version; ?></span>
					<ul>
						<li><a href="https://support.woocommerce.com/"><?php _e( 'Support', 'storefront' ); ?></a></li>
						<li><a href="https://docs.woocommerce.com/documentation/themes/storefront/"><?php _e( 'Documentation', 'storefront' ); ?></a></li>
						<li><a href="https://storefront.wordpress.com"><?php _e( 'Development blog', 'storefront' ); ?></a></li>
					</ul>
				</section>

				<div class="storefront-logo">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/admin/welcome-screen/storefront.png" alt="Storefront" />
				</div>

				<div class="storefront-intro">
					<h1><?php echo sprintf( esc_attr__( 'Setup complete %sYour Storefront adventure begins now 🚀%s ', 'storefront' ), '<span>', '</span>' ); ?></h1>
					<p><?php esc_attr_e( 'One more thing... You might be interested in the following Storefront extensions and designs', 'storefront' ); ?></p>
				</div>

				<div class="automattic">
					<p>
					<?php printf( esc_html__( 'An %s project', 'storefront' ), '<a href="https://automattic.com/"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/admin/welcome-screen/automattic.png" alt="Automattic" /></a>' ); ?>
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
			require_once( get_template_directory() . '/inc/admin/welcome-screen/component-intro.php' );
		}


		/**
		 * Welcome screen enhance section
		 *
		 * @since 1.5.2
		 */
		public function welcome_enhance() {
			require_once( get_template_directory() . '/inc/admin/welcome-screen/component-enhance.php' );
		}

		/**
		 * Welcome screen contribute section
		 *
		 * @since 1.5.2
		 */
		public function welcome_contribute() {
			require_once( get_template_directory() . '/inc/admin/welcome-screen/component-contribute.php' );
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
