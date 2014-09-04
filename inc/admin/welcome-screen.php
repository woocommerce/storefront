<?php
/**
 * Welcome Screen Class
 * Sets up the welcome screen page, hides the menu item
 * and contains the screen content.
 */
class storefront_welcome {

	/**
	 * Constructor
	 * Sets up the welcome screen
	 */
	function __construct() {

		add_action( 'admin_menu', array( $this,'storefront_welcome_register_menu' ) );
		add_action( 'load-themes.php', array( $this,'storefront_welcome_redirect' ) );

		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_intro' ), 				10 );
		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_getting_started' ), 	20 );
		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_addons' ), 				30 );
		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_who' ), 				40 );

	} // end constructor

	/**
	 * Redirects to the welcome screen after storefront has been activated
	 * @since 1.0.0
	 */
	function storefront_welcome_redirect() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			wp_redirect( admin_url( 'themes.php?page=storefront-welcome' ) );
		}
	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.0.0
	 */
	function storefront_welcome_register_menu() {
		add_theme_page( 'Storefront', 'Storefront', 'read', 'storefront-welcome', array( $this,'storefront_welcome_screen' ) );
	}

	/**
	 * The welcome screen
	 * @since 1.0.0
	 */
	function storefront_welcome_screen() {
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
	function storefront_welcome_intro() {
		$storefront = wp_get_theme();

		?>
		<div class="feature-section col two-col" style="margin-bottom: 1.618em; overflow: hidden;">
			<div class="col-1">
				<h1 style="margin-right: 0;"><?php echo '<strong>Storefront</strong> <sup style="font-weight: bold; font-size: 50%; padding: 5px 10px; color: #666; background: #fff;">' . $storefront['Version'] . '</sup>'; ?></h1>

				<p style="font-size: 1.2em;"><?php _e( 'Awesome! You\'ve decided to use Storefront to enrich your WooCommerce store design.', 'storefront' ); ?></p>
				<p><?php _e( 'Whether you\'re a store owner, WordPress developer, or both - we hope you enjoy Storefront\'s deep integration with WooCommerce core (including several popular WooCommerce extensions), plus the flexible design and extensible codebase that this theme provides.', 'storefront' ); ?>
			</div>

			<div class="col-2 last-feature">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" class="image-50" width="440" style="border: 2px solid #ccc;" />
			</div>
		</div>

		<hr />
		<?php
	}

	/**
	 * Welcome screen about section
	 * @since 1.0.0
	 */
	function storefront_welcome_who() {
		?>
		<div class="feature-section col three-col" style="margin-bottom: 1.618em; overflow: hidden;">
			<div class="col-1">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/woothemes.png'; ?>" class="image-50" style="border: 2px solid #ccc;" width="440" />
				<h4><?php _e( 'Who are WooThemes?', 'storefront' ); ?></h4>
				<p><?php _e( 'WooCommerce creators WooThemes is an international team of WordPress superstars building products for a passionate community of hundreds of thousands of users.', 'storefront' ); ?></p>
			</div>

			<div class="col-2">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/woocommerce.png'; ?>" class="image-50" style="border: 2px solid #ccc;" width="440" />
				<h4><?php _e( 'What is WooCommerce?', 'storefront' ); ?></h4>
				<p><?php _e( 'WooCommerce is the most popular WordPress eCommerce plugin. Packed full of intuitive features and surrounded by a thriving community - it\'s the perfect solution for building an online store with WordPress.', 'storefront' ); ?></p>
				<p><a href="<?php echo wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ); ?>" class="button button-primary"><?php _e( 'Download & Install WooCommerce', 'storefront' ); ?></a></p>
				<p><a href="http://docs.woothemes.com/documentation/plugins/woocommerce/" class="button"><?php _e( 'View WooCommerce Documentation', 'storefront' ); ?></a></p>
			</div>
		</div>

		<hr style="clear: both;">
		<?php
	}

	/**
	 * Welcome screen getting started section
	 * @since 1.0.0
	 */
	function storefront_welcome_getting_started() {
		// get theme customizer url
        $url = admin_url() . 'customize.php?';
        $url .= 'url=' . urlencode( site_url() . '?storefront-customizer=true' ) ;
        $url .= '&return=' . urlencode( admin_url() . 'index.php?page=storefront-welcome' );
        $url .= '&storefront-customizer=true';
		?>
		<div class="feature-section col two-col" style="margin-bottom: 1.618em; overflow: hidden;">

			<h2><?php _e ( 'Using Storefront', 'storefront' ); ?> <div class="dashicons dashicons-lightbulb"></div></h2>
			<p><?php _e( 'We\'ve purposely kept Storefront lean & mean so configuration is a breeze. Here are some common theme-setup tasks:', 'storefront' ); ?></p>

			<div class="col-1">
				<?php if ( ! class_exists( 'WooCommerce' ) ) { ?>
					<h4><?php _e( 'Install WooCommerce' ,'storefront' ); ?></h4>
					<p><?php _e( 'Although Storefront works fine as a standard WordPress theme, it really shines when used for an online store. Install WooCommerce and start selling now.', 'storefront' ); ?></p>

					<p><a href="<?php echo wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ); ?>" class="button"><?php _e( 'Install WooCommerce', 'storefront' ); ?></a></p>
				<?php } ?>

				<h4><?php _e( 'Configure menu locations' ,'storefront' ); ?></h4>
				<p><?php _e( 'Storefront includes two menu locations for primary and secondary navigation. The primary navigation is perfect for your key pages like the shop and product categories. The secondary navigation is better suited to lower traffic pages such as terms and conditions.', 'storefront' ); ?></p>
				<p><a href="<?php echo self_admin_url( 'nav-menus.php' ); ?>" target="_blank" class="button"><?php _e( 'Configure menus', 'storefront' ); ?></a></p>

				<h4><?php _e( 'Create a color scheme' ,'storefront' ); ?></h4>
				<p><?php _e( 'Using the WordPress Customizer you can tweak Storefront\'s appearance to match your brand.', 'storefront' ); ?></p>
				<p><a href="<?php echo $url; ?>" class="button"><?php _e( 'Open the Customizer', 'storefront' ); ?></a></p>
			</div>

			<div class="col-2 last-feature">
				<h4><?php _e( 'Configure homepage template', 'storefront' ); ?></h4>
				<p><?php _e( 'Storefront includes a homepage template that displays a selection of products from your store.', 'storefront' ); ?></p>
				<p><?php echo sprintf( __( 'To set this up you will need to create a new page and assign the "Homepage" template to it. You can then set that as a static homepage in the %sReading%s settings.', 'storefront' ), '<a href="' . self_admin_url( 'options-reading.php' ) . '">', '</a>' ); ?></p>
				<p><?php echo sprintf( __( 'Once set up you can toggle and re-order the homepage components using the %sHomepage Control%s plugin.', 'storefront' ), '<a href="https://wordpress.org/plugins/homepage-control/">', '</a>' ); ?></p>

				<h4><?php _e( 'Add your logo', 'storefront' ); ?></h4>
				<p><?php echo sprintf( __( 'Activate the %sSite Logo%s plugin to enable a custom logo option.', 'storefront' ), '<a href="https://github.com/Automattic/site-logo" target="_blank">', '</a>' ); ?></p>

				<h4><?php _e( 'View documentation', 'storefront' ); ?></h4>
				<p><?php _e( 'You can read detailed information on Storefronts features and how to develop on top of it in the documentation.', 'storefront' ); ?></p>
				<p><a href="#" class="button"><?php _e( 'View documentation', 'storefront' ); ?></a></p>
			</div>

		</div>

		<hr style="clear: both;">
		<?php
	}

	/**
	 * Welcome screen add ons
	 * @since 1.0.0
	 */
	function storefront_welcome_addons() {
		?>
		<div class="feature-section col three-col" style="clear: both;">
			<h2><?php _e( 'Enhance your site', 'storefront' ); ?> <div class="dashicons dashicons-admin-plugins"></div></h2>

			<p>
				<?php _e( 'Below you will find a selection of hand-picked WooCommerce and Storefront extensions that could help improve your online store. Each WooCommerce extension integrates seamlessly with Storefront for enhanced performance.', 'storefront' ); ?>
			</p>

			<div class="col-1">
				<h4><?php _e( 'WooCommerce Extensions', 'storefront' ); ?></h4>
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/bookings.png'; ?>" class="image-50" style="border: 2px solid #ccc;" width="440" />
				<h4><?php _e( 'WooCommerce Bookings', 'storefront' ); ?></h4>
				<p><?php _e( 'Allows you to sell your time or date based bookings, adding a new product type to your WooCommerce site. Perfect for those wanting to offer appointments, services or rentals.', 'storefront' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/products/woocommerce-bookings/" class="button"><?php _e( 'Buy now', 'storefront' ); ?></a></p>

				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/gallery-slider.png'; ?>" class="image-50" style="border: 2px solid #ccc;" width="440" />
				<h4><?php _e( 'WooCommerce Product Gallery Slider', 'storefront' ); ?></h4>
				<p><?php _e( 'The Product Gallery Slider is a nifty extension which transforms your product galleries into a fully responsive, jQuery powered slideshow.', 'storefront' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/products/product-gallery-slider/" class="button"><?php _e( 'Buy now', 'storefront' ); ?></a></p>

				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/wishlists.png'; ?>" class="image-50" style="border: 2px solid #ccc;" width="440" />
				<h4><?php _e( 'WooCommerce Wishlists', 'storefront' ); ?></h4>
				<p><?php _e( 'Allows you to sell your time or date based bookings, adding a new product type to your WooCommerce site. Perfect for those wanting to offer appointments, services or rentals.', 'storefront' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/products/woocommerce-wishlists/" class="button"><?php _e( 'Buy now', 'storefront' ); ?></a></p>

			</div>

			<div class="col-2">
				<h4><?php _e( 'Storefront Extensions', 'storefront' ); ?></h4>
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/hero.png'; ?>" class="image-50" style="border: 2px solid #ccc;" width="440" />
				<h4><?php _e( 'Storefront Parallax Hero', 'storefront' ); ?></h4>
				<p><?php _e( 'Adds a parallax hero component to your homepage. Easily change the colors / copy and give your visitors a warm welcome!', 'storefront' ); ?></p>

				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/designer.jpg'; ?>" class="image-50" style="border: 2px solid #ccc;" width="440" />
				<h4><?php _e( 'Storefront Designer', 'storefront' ); ?></h4>
				<p><?php _e( 'Adds a bunch of additional appearance settings allowing you to further tweak and perfect your Storefront design by changing button styles, typographical schemes/scales, the WooCommerce shop layout and more.', 'storefront' ); ?></p>

			</div>

		</div>

		<hr style="clear: both;" />

		<p style="font-size: 1.2em; margin: 2.618em 0;">
			<?php echo sprintf( __( 'There are literally hundreds of awesome extensions available for you to use. Looking for Table Rate Shipping? Subscriptions? Product Add-ons? You can find these and more in the WooCommerce extension shop. %sGo shopping%s.', 'storefront' ), '<a href="http://www.woothemes.com/products/woocommerce-bookings/">', '</a>'  ); ?>
		</p>

		<hr style="clear: both;" />
		<?php
	}
}

$GLOBALS['storefront_welcome'] = new storefront_welcome();