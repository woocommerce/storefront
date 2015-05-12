<?php
/**
 * Welcome screen add-ons template
 */
?>
<div id="add_ons" class="storefront-add-ons panel" style="padding-top: 1.618em; clear: both;">
	<h2><?php _e( 'Enhance your site', 'storefront' ); ?> <div class="dashicons dashicons-admin-plugins"></div></h2>

	<p>
		<?php _e( 'Below you will find a selection of free and commercial Storefront extensions that could help improve your online store.', 'storefront' ); ?>
	</p>

	<div class="add-on">
		<h4><?php _e( 'Make your site instantly recognisable by adding your logo', 'storefront' ); ?> <span class="free"><?php _e( 'Free (Third Party)', 'storefront' ); ?></span></h4>
		<div class="content">
			<p><?php echo sprintf( __( 'Jetpack is probably a plugin you\'re already familiar with. Storefront fully supports Jetpacks site logo feature making it easy to upload and display your logo via the Customizer. %sMore info &rarr;%s', 'storefront' ), '<a href="https://wordpress.org/plugins/jetpack/">', '</a>' );?></p>

			<?php if ( class_exists( 'Jetpack' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=jetpack' ), 'install-plugin_jetpack' ) ); ?>" class="button button-primary"><?php _e( 'Install Jetpack', 'storefront' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-vertical storefront-designer">
		<h4><?php _e( 'Further customise your store with the Storefront Designer', 'storefront' ); ?> <span class="premium"><?php _e( 'Premium', 'storefront' ); ?></span></h4>
		<div class="content">
			<p><?php _e( 'Storefront Designer adds a bunch of additional appearance settings allowing you to further tweak and perfect your Storefront design by changing the header layout, button styles, typographical schemes/scales and more.', 'storefront' ); ?></p>

			<?php if ( class_exists( 'Storefront_Designer' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://www.woothemes.com/products/storefront-designer?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( __( 'Buy %sStorefront Designer%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-vertical product-hero">
		<h4><?php _e( 'Highlight a product of your choosing with the Storefront Product Hero', 'storefront' ); ?> <span class="premium"><?php _e( 'Premium', 'storefront' ); ?></span></h4>
		<div class="content">
			<p><?php _e( 'The Storefront Product Hero extension adds a parallax hero component to your homepage highlighting a specific product at your store. Use the shortcode to add attractive hero components to posts, pages or widgets.', 'storefront' ); ?></p>

			<?php if ( class_exists( 'Storefront_Product_Hero' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://www.woothemes.com/products/storefront-product-hero?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( __( 'Buy %sStorefront Product Hero%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-vertical share">
		<h4><?php _e( 'Have your visitors market your store for you with Storefront Product Sharing', 'storefront' ); ?> <span class="free"><?php _e( 'Free', 'storefront' ); ?></span></h4>
		<div class="content">
			<p><?php echo sprintf( __( 'Storefront Product Sharing adds attractive social sharing icons for Facebook, Twitter, Pinterest and Email to your product pages. %sMore info &rarr;%s', 'storefront' ), '<a href="https://wordpress.org/plugins/storefront-product-sharing/">', '</a>' );?></p>

			<?php if ( class_exists( 'Storefront_Product_Sharing' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=storefront-product-sharing' ), 'install-plugin_storefront-product-sharing' ) ); ?>" class="button button-primary"><?php _e( 'Install Storefront Product Sharing', 'storefront' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-horizontal footer-bar">
		<h4><?php _e( 'Add a site-wide call out to your footer with Storefront Footer Bar', 'storefront' ); ?> <span class="free"><?php _e( 'Free', 'storefront' ); ?></span></h4>
		<div class="content">
			<p><?php echo sprintf( __( 'Storefront Footer Bar adds a full width widgetised region above the default Storefront footer widget area. %sMore info &rarr;%s', 'storefront' ), '<a href="https://wordpress.org/plugins/storefront-footer-bar/">', '</a>' );?></p>

			<?php if ( class_exists( 'Storefront_Footer_Bar' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=storefront-footer-bar' ), 'install-plugin_storefront-footer-bar' ) ); ?>" class="button button-primary"><?php _e( 'Install Storefront Footer Bar', 'storefront' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-horizontal product-pagination">
		<h4><?php _e( 'Storefront Product Pagination', 'storefront' ); ?> <span class="free"><?php _e( 'Free', 'storefront' ); ?></span></h4>
		<div class="content">
			<p><?php echo sprintf( __( 'Storefront Product Pagination adds unobtrusive links to next/previous products on your WooCommerce single product pages. %sMore info &rarr;%s', 'storefront' ), '<a href="https://wordpress.org/plugins/storefront-product-pagination/">', '</a>' );?></p>

			<?php if ( class_exists( 'Storefront_Product_Pagination' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=storefront-product-pagination' ), 'install-plugin_storefront-product-pagination' ) ); ?>" class="button button-primary"><?php _e( 'Install Storefront Product Pagination', 'storefront' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on image-vertical wc-customiser">
		<h4><?php _e( 'Refine your shop archives and product pages with the Storefront WooCommerce Customiser', 'storefront' ); ?> <span class="premium"><?php _e( 'Premium', 'storefront' ); ?></span></h4>
		<div class="content">
			<p><?php _e( 'The Storefront WooCommerce Customiser extension gives you further control over the look and feel of your shop. Change the product archive and single layouts, toggle various shop components and more.', 'storefront' ); ?></p>

			<?php if ( class_exists( 'Storefront_WooCommerce_Customiser' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://www.woothemes.com/products/storefront-woocommerce-customiser?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( __( 'Buy %sStorefront WooCommerce Customiser%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on">
		<h4><?php _e( 'Add practical information to your pages with Storefront Top Bar', 'storefront' ); ?> <span class="free"><?php _e( 'Free (Third Party)', 'storefront' ); ?></span></h4>
		<div class="content">
			<p><?php echo sprintf( __( 'Storefront Top Bar adds a widgetised content area at the top of your site and customise it\'s appearance in the Customizer. %sMore info &rarr;%s', 'storefront' ), '<a href="https://wordpress.org/plugins/storefront-top-bar/">', '</a>' ); ?></p>

			<?php if ( class_exists( 'Storefront_Top_Bar' ) ) { ?>
				<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=storefront-top-bar' ), 'install-plugin_storefront-top-bar' ) ); ?>" class="button button-primary"><?php _e( 'Install Storefront Top Bar', 'storefront' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<hr style="clear: both;" />

	<p style="font-size: 1.2em; margin: 2.618em 0;">
		<?php echo sprintf( esc_html__( 'There are literally hundreds of awesome extensions available for you to use. Looking for Table Rate Shipping? Subscriptions? Product Add-ons? You can find these and more in the WooCommerce extension shop. %sGo shopping%s.', 'storefront' ), '<a href="http://www.woothemes.com/product-category/woocommerce-extensions/">', '</a>' ); ?>
	</p>
</div>