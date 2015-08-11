<?php
/**
 * Welcome screen getting started template
 */
?>
<?php
// get theme customizer url
$customizer_url 	= admin_url() . 'customize.php?url=' . urlencode( site_url() . '?storefront-customizer=true' ) . '&return=' . urlencode( admin_url() . 'themes.php?page=storefront-welcome' ) . '&storefront-customizer=true';
$menus_url 			= admin_url() . 'customize.php?autofocus%5Bsection%5D=nav&?url=' . urlencode( site_url() . '?storefront-customizer=true' ) . '&return=' . urlencode( admin_url() . 'themes.php?page=storefront-welcome' ) . '&storefront-customizer=true';

?>
<div id="getting_started" class="col panel" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">

	<h2><?php esc_html_e( 'Using Storefront', 'storefront' ); ?> <div class="dashicons dashicons-lightbulb"></div></h2>
	<p><?php esc_html_e( 'We\'ve purposely kept Storefront lean & mean so configuration is a breeze. Here are some optional theme-setup tasks:', 'storefront' ); ?></p>

	<hr />

	<h4><?php esc_html_e( 'Install WooCommerce' ,'storefront' ); ?></h4>
	<p><?php esc_html_e( 'Although Storefront works fine as a standard WordPress theme, it really shines when used for an online store. Install WooCommerce and start selling now.', 'storefront' ); ?></p>

	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
		<p><span class="activated"><?php esc_html_e( 'Activated', 'storefront' ); ?></span></p>
	<?php } else { ?>
		<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install WooCommerce', 'storefront' ); ?></a></p>
	<?php } ?>

	<hr />

	<h4><?php esc_html_e( 'Configure menu locations' ,'storefront' ); ?></h4>
	<p><?php esc_html_e( 'Storefront includes three menu locations for primary, secondary and handheld navigation. ', 'storefront' ); ?></p>
	<p><?php esc_html_e( 'The primary navigation is perfect for your key pages like the shop and product categories. ', 'storefront' ); ?></p>
	<p><?php esc_html_e( 'The secondary navigation is better suited to lower traffic pages such as terms and conditions.', 'storefront' ); ?></p>
	<p><?php esc_html_e( 'The handheld navigation gives you complete control over what menu items to serve to handheld devices.', 'storefront' ); ?></p>

	<p><a href="<?php echo esc_url( $menus_url ); ?>" class="button"><?php esc_html_e( 'Configure menus', 'storefront' ); ?></a></p>

	<hr />

	<h4><?php esc_html_e( 'Create a color scheme' ,'storefront' ); ?></h4>
	<p><?php esc_html_e( 'Using the WordPress Customizer you can tweak Storefront\'s appearance to match your brand.', 'storefront' ); ?></p>
	<p><a href="<?php echo esc_url( $customizer_url ); ?>" class="button"><?php esc_html_e( 'Open the Customizer', 'storefront' ); ?></a></p>

	<hr />

	<h4><?php esc_html_e( 'Add your logo', 'storefront' ); ?></h4>
	<p><?php echo sprintf( esc_html__( 'Install and activate %sJetpack%s to enable a custom logo option in the Customizer.', 'storefront' ), '<a class="thickbox" href="' . esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=jetpack&TB_iframe=true&width=744&height=800' ), 'install-plugin_jetpack' ) ) . '">', '</a>' ); ?></p>

	<?php if ( class_exists( 'Jetpack' ) ) { ?>
		<p><span class="activated"><?php esc_html_e( 'Activated', 'storefront' ); ?></span></p>
	<?php } else { ?>
		<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=jetpack' ), 'install-plugin_jetpack' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Jetpack', 'storefront' ); ?></a></p>
	<?php } ?>

	<hr />

	<h4><?php esc_html_e( 'Configure homepage template', 'storefront' ); ?></h4>
	<p><?php esc_html_e( 'Storefront includes a homepage template that displays a selection of products from your store.', 'storefront' ); ?></p>
	<p><?php echo sprintf( esc_html__( 'To set this up you will need to create a new page and assign the "Homepage" template to it. You can then set that as a static homepage in the %sReading%s settings.', 'storefront' ), '<a href="' . esc_url( self_admin_url( 'options-reading.php' ) ) . '">', '</a>' ); ?></p>
	<p><?php echo sprintf( esc_html__( 'Once set up you can toggle and re-order the homepage components using the %sHomepage Control%s plugin.', 'storefront' ), '<a class="thickbox" href="' . esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=homepage-control&TB_iframe=true&width=744&height=800' ), 'install-plugin_homepage-control' ) ) . '">', '</a>' ); ?></p>

	<?php if ( class_exists( 'Homepage_Control' ) ) { ?>
		<p><span class="activated"><?php esc_html_e( 'Activated', 'storefront' ); ?></span></p>
	<?php } else { ?>
		<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=homepage-control' ), 'install-plugin_homepage-control' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Homepage Control', 'storefront' ); ?></a></p>
	<?php } ?>

	<hr />

	<h4><?php esc_html_e( 'View documentation', 'storefront' ); ?></h4>
	<p><?php esc_html_e( 'You can read detailed information on Storefronts features and how to develop on top of it in the documentation.', 'storefront' ); ?></p>
	<p><a href="http://docs.woothemes.com/documentation/themes/storefront/" class="button"><?php esc_html_e( 'View documentation &rarr;', 'storefront' ); ?></a></p>

	<hr />

	<h4><?php esc_html_e( 'Install free plugins', 'storefront' ); ?></h4>
	<p><?php esc_html_e( 'There are a number of free plugins available for Storefront on the wordpress.org plugin repository.', 'storefront' ); ?></p>
	<ul class="free-plugins">
		<li>
			<a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=storefront-product-sharing&TB_iframe=true&width=744&height=800' ), 'install-plugin_storefront-product-sharing' ) ); ?>"><?php esc_html_e( 'Storefront Product Sharing', 'storefront' ); ?></a>
		</li>
		<li>
			<a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=storefront-product-pagination&TB_iframe=true&width=744&height=800' ), 'install-plugin_storefront-product-pagination' ) ); ?>"><?php esc_html_e( 'Storefront Product Pagination', 'storefront' ); ?></a>
		</li>
		<li>
			<a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=storefront-footer-bar&TB_iframe=true&width=744&height=800' ), 'install-plugin_storefront-footer-bar' ) ); ?>"><?php esc_html_e( 'Storefront Footer Bar', 'storefront' ); ?></a>
		</li>
	</ul>
</div>