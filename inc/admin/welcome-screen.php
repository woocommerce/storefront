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

		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_intro' ), 				10 );
		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_getting_started' ), 	20 );
		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_addons' ), 				30 );
		add_action( 'storefront_welcome', array( $this, 'storefront_welcome_who' ), 				40 );

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
			<div class="updated fade">
				<p><?php echo sprintf( esc_html__( 'Thanks for choosing Storefront! You can read hints and tips on how get the most out of your new theme on the %swelcome screen%s.', 'storefront' ), '<a href="' . esc_url( admin_url( 'themes.php?page=storefront-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=storefront-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Storefront', 'storefront' ); ?></a></p>
			</div>
		<?php
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
		$storefront = wp_get_theme( 'storefront' );

		?>
		<div class="feature-section col two-col" style="margin-bottom: 1.618em; overflow: hidden;">
			<div class="col-1">
				<h1 style="margin-right: 0;"><?php echo '<strong>Storefront</strong> <sup style="font-weight: bold; font-size: 50%; padding: 5px 10px; color: #666; background: #fff;">' . esc_attr( $storefront['Version'] ) . '</sup>'; ?></h1>

				<p style="font-size: 1.2em;"><?php _e( 'Awesome! You\'ve decided to use Storefront to enrich your WooCommerce store design.', 'storefront' ); ?></p>
				<p><?php _e( 'Whether you\'re a store owner, WordPress developer, or both - we hope you enjoy Storefront\'s deep integration with WooCommerce core (including several popular WooCommerce extensions), plus the flexible design and extensible codebase that this theme provides.', 'storefront' ); ?>
			</div>

			<div class="col-2 last-feature">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" class="image-50" width="440" />
			</div>
		</div>

		<hr />
		<?php
	}

	/**
	 * Welcome screen about section
	 * @since 1.0.0
	 */
	public function storefront_welcome_who() {
		?>
		<div class="feature-section col three-col" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">
			<div class="col-1">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/woothemes.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'Who are WooThemes?', 'storefront' ); ?></h4>
				<p><?php _e( 'WooCommerce creators WooThemes is an international team of WordPress superstars building products for a passionate community of hundreds of thousands of users.', 'storefront' ); ?></p>
				<p><a href="http://woothemes.com" class="button"><?php _e( 'Visit WooThemes', 'storefront' ); ?></a></p>
			</div>

			<div class="col-2">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/woocommerce.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'What is WooCommerce?', 'storefront' ); ?></h4>
				<p><?php _e( 'WooCommerce is the most popular WordPress eCommerce plugin. Packed full of intuitive features and surrounded by a thriving community - it\'s the perfect solution for building an online store with WordPress.', 'storefront' ); ?></p>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php _e( 'Download & Install WooCommerce', 'storefront' ); ?></a></p>
				<p><a href="http://docs.woothemes.com/documentation/plugins/woocommerce/" class="button"><?php _e( 'View WooCommerce Documentation', 'storefront' ); ?></a></p>
			</div>

			<div class="col-3 last-feature">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/github.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'Can I Contribute?', 'storefront' ); ?></h4>
				<p><?php _e( 'Found a bug? Want to contribute a patch or create a new feature? GitHub is the place to go! Or would you like to translate Storefront in to your language? Get involved at Transifex.', 'storefront' ); ?></p>
				<p><a href="http://github.com/woothemes/storefront/" class="button"><?php _e( 'Storefront at GitHub', 'storefront' ); ?></a> <a href="https://www.transifex.com/projects/p/storefront-1/" class="button"><?php _e( 'Storefront at Transifex', 'storefront' ); ?></a></p>
			</div>
		</div>

		<hr style="clear: both;">
		<?php
	}

	/**
	 * Welcome screen getting started section
	 * @since 1.0.0
	 */
	public function storefront_welcome_getting_started() {
		// get theme customizer url
		$url 	= admin_url() . 'customize.php?';
		$url 	.= 'url=' . urlencode( site_url() . '?storefront-customizer=true' );
		$url 	.= '&return=' . urlencode( admin_url() . 'themes.php?page=storefront-welcome' );
		$url 	.= '&storefront-customizer=true';
		?>
		<div class="feature-section col two-col" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">

			<h2><?php _e( 'Using Storefront', 'storefront' ); ?> <div class="dashicons dashicons-lightbulb"></div></h2>
			<p><?php _e( 'We\'ve purposely kept Storefront lean & mean so configuration is a breeze. Here are some common theme-setup tasks:', 'storefront' ); ?></p>

			<div class="col-1">
				<?php if ( ! class_exists( 'WooCommerce' ) ) { ?>
					<h4><?php _e( 'Install WooCommerce' ,'storefront' ); ?></h4>
					<p><?php _e( 'Although Storefront works fine as a standard WordPress theme, it really shines when used for an online store. Install WooCommerce and start selling now.', 'storefront' ); ?></p>

					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button"><?php _e( 'Install WooCommerce', 'storefront' ); ?></a></p>
				<?php } ?>

				<h4><?php _e( 'Configure menu locations' ,'storefront' ); ?></h4>
				<p><?php _e( 'Storefront includes two menu locations for primary and secondary navigation. The primary navigation is perfect for your key pages like the shop and product categories. The secondary navigation is better suited to lower traffic pages such as terms and conditions.', 'storefront' ); ?></p>
				<p><a href="<?php echo esc_url( self_admin_url( 'nav-menus.php' ) ); ?>" class="button"><?php _e( 'Configure menus', 'storefront' ); ?></a></p>

				<h4><?php _e( 'Create a color scheme' ,'storefront' ); ?></h4>
				<p><?php _e( 'Using the WordPress Customizer you can tweak Storefront\'s appearance to match your brand.', 'storefront' ); ?></p>
				<p><a href="<?php echo esc_url( $url ); ?>" class="button"><?php _e( 'Open the Customizer', 'storefront' ); ?></a></p>
			</div>

			<div class="col-2 last-feature">
				<h4><?php _e( 'Configure homepage template', 'storefront' ); ?></h4>
				<p><?php _e( 'Storefront includes a homepage template that displays a selection of products from your store.', 'storefront' ); ?></p>
				<p><?php echo sprintf( esc_html__( 'To set this up you will need to create a new page and assign the "Homepage" template to it. You can then set that as a static homepage in the %sReading%s settings.', 'storefront' ), '<a href="' . esc_url( self_admin_url( 'options-reading.php' ) ) . '">', '</a>' ); ?></p>
				<p><?php echo sprintf( esc_html__( 'Once set up you can toggle and re-order the homepage components using the %sHomepage Control%s plugin.', 'storefront' ), '<a href="https://wordpress.org/plugins/homepage-control/">', '</a>' ); ?></p>

				<h4><?php _e( 'Add your logo', 'storefront' ); ?></h4>
				<p><?php echo sprintf( esc_html__( 'Activate %sJetpack%s to enable a custom logo option in the Customizer.', 'storefront' ), '<a href="https://wordpress.org/plugins/jetpack/">', '</a>' ); ?></p>

				<h4><?php _e( 'View documentation', 'storefront' ); ?></h4>
				<p><?php _e( 'You can read detailed information on Storefronts features and how to develop on top of it in the documentation.', 'storefront' ); ?></p>
				<p><a href="http://docs.woothemes.com/documentation/themes/storefront/" class="button"><?php _e( 'View documentation', 'storefront' ); ?></a></p>
			</div>

		</div>

		<hr style="clear: both;">
		<?php
	}

	/**
	 * Welcome screen add ons
	 * @since 1.0.0
	 */
	public function storefront_welcome_addons() {
		?>
		<div id="add-ons" class="feature-section col three-col" style="padding-top: 1.618em; clear: both;">
			<h2><?php _e( 'Enhance your site', 'storefront' ); ?> <div class="dashicons dashicons-admin-plugins"></div></h2>

			<p>
				<?php _e( 'Below you will find a selection of hand-picked WooCommerce and Storefront extensions that could help improve your online store. Each WooCommerce extension integrates seamlessly with Storefront for enhanced performance.', 'storefront' ); ?>
			</p>

			<div class="col-1">
				<h4><?php _e( 'Storefront Extensions', 'storefront' ); ?></h4>
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/designer.jpg'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'Storefront Designer', 'storefront' ); ?></h4>
				<p><?php _e( 'Adds a bunch of additional appearance settings allowing you to further tweak and perfect your Storefront design by changing the header layout, button styles, typographical schemes/scales and more.', 'storefront' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="https://www.woothemes.com/products/storefront-designer?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button"><?php _e( 'Buy now', 'storefront' ); ?></a></p>

				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/wc-customiser.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'Storefront WooCommerce Customiser', 'storefront' ); ?></h4>
				<p><?php _e( 'Gives you further control over the look and feel of your shop. Change the product archive and single layouts, toggle various shop components, enable a distraction free checkout design and more.', 'storefront' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="https://www.woothemes.com/products/storefront-woocommerce-customizer?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button"><?php _e( 'Buy now', 'storefront' ); ?></a></p>

				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/hero.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'Storefront Parallax Hero', 'storefront' ); ?></h4>
				<p><?php _e( 'Adds a parallax hero component to your homepage. Easily change the colors / copy and give your visitors a warm welcome!', 'storefront' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="https://www.woothemes.com/products/storefront-parallax-hero?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button"><?php _e( 'Buy now', 'storefront' ); ?></a></p>

				<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/product-category/storefront-extensions?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php _e( 'View all Storefront extensions &rarr;', 'storefront' ); ?></a></p>
			</div>

			<div class="col-2">
				<h4><?php _e( 'WooCommerce Extensions', 'storefront' ); ?></h4>
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/bookings.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'WooCommerce Bookings', 'storefront' ); ?></h4>
				<p><?php _e( 'Allows you to sell your time or date based bookings, adding a new product type to your WooCommerce site. Perfect for those wanting to offer appointments, services or rentals.', 'storefront' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/products/woocommerce-bookings?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button"><?php _e( 'Buy now', 'storefront' ); ?></a></p>

				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/smart-coupons.jpg'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'WooCommerce Smart Coupons', 'storefront' ); ?></h4>
				<p><?php _e( 'Smart coupons provide the most comprehensive and powerful solution for discount coupons, gift certificates, store credits and vouchers. It also allows customers to buy credits for themselves or gift to others.', 'storefront' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/products/smart-coupons?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button"><?php _e( 'Buy now', 'storefront' ); ?></a></p>

				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/wishlists.png'; ?>" class="image-50" width="440" />
				<h4><?php _e( 'WooCommerce Wishlists', 'storefront' ); ?></h4>
				<p><?php _e( 'Allows guests and customers to create and add products to an unlimited number of Wishlists. From birthdays to weddings and everything in between, WooCommerce Wishlists are a welcome addition to any WooCommerce store.', 'storefront' ); ?></p>
				<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/products/woocommerce-wishlists?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button"><?php _e( 'Buy now', 'storefront' ); ?></a></p>

				<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/product-category/woocommerce-extensions/?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php _e( 'View all WooCommerce extensions &rarr;', 'storefront' ); ?></a></p>
			</div>

			<div class="col-3 last-feature">
				<h4><?php _e( 'Can\'t find a feature?', 'storefront' ); ?></h4>
				<p><?php echo sprintf( esc_html__( 'Please suggest and vote on ideas / feature requests at the %sStorefront Ideasboard%s. The most popular ideas will see prioritised development.', 'storefront' ), '<a href="http://ideas.woothemes.com/forums/275029-storefront">', '</a>' ); ?></p>
			</div>

		</div>

		<hr style="clear: both;" />

		<p style="font-size: 1.2em; margin: 2.618em 0;">
			<?php echo sprintf( esc_html__( 'There are literally hundreds of awesome extensions available for you to use. Looking for Table Rate Shipping? Subscriptions? Product Add-ons? You can find these and more in the WooCommerce extension shop. %sGo shopping%s.', 'storefront' ), '<a href="http://www.woothemes.com/product-category/woocommerce-extensions/">', '</a>'  ); ?>
		</p>

		<hr style="clear: both;" />
		<?php
	}
}

$GLOBALS['Storefront_Welcome'] = new Storefront_Welcome();
