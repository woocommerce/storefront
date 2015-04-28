<?php
/**
 * Welcome Screen Class
 * Sets up the welcome screen page, hides the menu item
 * and contains the screen content.
 */
class Storefront_Welcome {

	/**
	 * Constructor
	 * Sets up the welcome screen
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'storefront_welcome_register_menu' ) );
		add_action( 'load-themes.php', array( $this, 'storefront_activation_admin_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'storefront_welcome_style' ) );

		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_intro' ), 				10 );
		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_tabs' ), 				20 );
		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_getting_started' ), 	30 );
		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_addons' ), 				40 );
		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_child_themes' ), 		50 );
		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_who' ), 				60 );

	} // end constructor

	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.0.3
	 */
	public function storefront_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) { // input var okay
			add_action( 'admin_notices', array( $this, 'storefront_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 * @since 1.0.3
	 */
	public function storefront_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Thanks for choosing Storefront! You can read hints and tips on how get the most out of your new theme on the %swelcome screen%s.', 'storefront' ), '<a href="' . esc_url( admin_url( 'themes.php?page=storefront-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=storefront-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Storefront', 'storefront' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css
	 * @return void
	 * @since  1.4.4
	 */
	public function storefront_welcome_style() {
		global $storefront_version;

		wp_enqueue_style( 'storefront-welcome-screen', get_template_directory_uri() . '/inc/admin/css/welcome.css', $storefront_version );
	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.0.0
	 */
	public function storefront_welcome_register_menu() {
		add_theme_page( 'Storefront', 'Storefront', 'read', 'storefront-welcome', array( $this, 'storefront_welcome_screen' ) );
	}

	/**
	 * The welcome screen
	 * @since 1.0.0
	 */
	public function storefront_welcome_screen() {
		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>
		<div class="wrap about-wrap">

			<?php
			/**
			 * @hooked storefront_welcome_intro - 10
			 * @hooked storefront_welcome_getting_started - 20
			 * @hooked storefront_welcome_addons - 30
			 * @hooked storefront_welcome_who - 40
			 */
			do_action( 'storefront_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * Welcome screen intro
	 * @since 1.0.0
	 */
	public function storefront_welcome_intro() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/intro.php' );
	}

	/**
	 * Welcome screen intro
	 * @since 1.4.4
	 */
	public function storefront_welcome_tabs() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/tabs.php' );
	}

	/**
	 * Welcome screen about section
	 * @since 1.0.0
	 */
	public function storefront_welcome_who() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/who.php' );
	}

	/**
	 * Welcome screen getting started section
	 * @since 1.0.0
	 */
	public function storefront_welcome_getting_started() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/getting-started.php' );
	}

	/**
	 * Welcome screen add ons
	 * @since 1.0.0
	 */
	public function storefront_welcome_addons() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/add-ons.php' );
	}

	/**
	 * Welcome screen child themes
	 * @since 1.4.4
	 */
	public function storefront_welcome_child_themes() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/child-themes.php' );
	}
}

$GLOBALS['Storefront_Welcome'] = new Storefront_Welcome();
