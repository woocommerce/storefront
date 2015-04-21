<?php
/**
 * Welcome screen add-ons template
 */
?>
<div id="add-ons" class="storefront-add-ons feature-section three-col col" style="padding-top: 1.618em; clear: both;">
	<h2><?php _e( 'Enhance your site', 'storefront' ); ?> <div class="dashicons dashicons-admin-plugins"></div></h2>

	<p>
		<?php _e( 'Below you will find a selection of hand-picked WooCommerce and Storefront extensions that could help improve your online store. Each WooCommerce extension integrates seamlessly with Storefront for enhanced performance.', 'storefront' ); ?>
	</p>

	<div class="col-1">
	 	<h5><?php _e( 'Commercial Storefront Extensions', 'storefront' ); ?></h5>

		<div class="add-on">
			<h4><?php _e( 'Storefront Designer', 'storefront' ); ?></h4>
			<div class="content">
				<p><?php _e( 'Adds a bunch of additional appearance settings allowing you to further tweak and perfect your Storefront design by changing the header layout, button styles, typographical schemes/scales and more.', 'storefront' ); ?></p>

				<?php if ( class_exists( 'Storefront_Designer' ) ) { ?>
					<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
				<?php } else { ?>
					<p><a href="https://www.woothemes.com/products/storefront-designer?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( __( 'Buy %sStorefront Designer%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
				<?php } ?>
			</div>
		</div>

		<div class="add-on">
			<h4><?php _e( 'Storefront WooCommerce Customiser', 'storefront' ); ?></h4>
			<div class="content">
				<p><?php _e( 'Gives you further control over the look and feel of your shop. Change the product archive and single layouts, toggle various shop components, enable a distraction free checkout design and more.', 'storefront' ); ?></p>

				<?php if ( class_exists( 'Storefront_WooCommerce_Customiser' ) ) { ?>
					<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
				<?php } else { ?>
					<p><a href="https://www.woothemes.com/products/storefront-woocommerce-customiser?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( __( 'Buy %sStorefront WooCommerce Customiser%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
				<?php } ?>
			</div>
		</div>

		<div class="add-on">
			<h4><?php _e( 'Storefront Product Hero', 'storefront' ); ?></h4>
			<div class="content">
				<p><?php _e( 'Adds a parallax hero component to your homepage highlighting a specific product at your store. Use the shortcode to add attractive hero components to posts, pages or widgets.', 'storefront' ); ?></p>

				<?php if ( class_exists( 'Storefront_Product_Hero' ) ) { ?>
					<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
				<?php } else { ?>
					<p><a href="https://www.woothemes.com/products/storefront-product-hero?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( __( 'Buy %sStorefront Product Hero%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
				<?php } ?>
			</div>
		</div>

		<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/product-category/storefront-extensions?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button"><?php _e( 'View all Storefront extensions &rarr;', 'storefront' ); ?></a></p>
	</div>

	<div class="col-2">
		<h5><?php _e( 'Commercial WooCommerce Extensions', 'storefront' ); ?></h5>

		<div class="add-on">
			<h4><?php _e( 'WooCommerce Bookings', 'storefront' ); ?></h4>
			<div class="content">
				<p><?php _e( 'Allows you to sell your time or date based bookings, adding a new product type to your WooCommerce site. Perfect for those wanting to offer appointments, services or rentals.', 'storefront' ); ?></p>

				<?php if ( class_exists( 'WC_Bookings' ) ) { ?>
					<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
				<?php } else { ?>
					<p><a href="http://www.woothemes.com/products/woocommerce-bookings?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( __( 'Buy %sWooCommerce Bookins%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
				<?php } ?>
			</div>
		</div>

		<div class="add-on">
			<h4><?php _e( 'WooCommerce Smart Coupons', 'storefront' ); ?></h4>
			<div class="content">
				<p><?php _e( 'Smart coupons provide the most comprehensive and powerful solution for discount coupons, gift certificates, store credits and vouchers. It also allows customers to buy credits for themselves or gift to others.', 'storefront' ); ?></p>

				<?php if ( class_exists( 'WC_Smart_Coupons' ) ) { ?>
					<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
				<?php } else { ?>
					<p><a href="http://www.woothemes.com/products/smart-coupons?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( __( 'Buy %sSmart Coupons%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
				<?php } ?>
			</div>
		</div>

		<div class="add-on">
			<h4><?php _e( 'WooCommerce Wishlists', 'storefront' ); ?></h4>
			<div class="content">
				<p><?php _e( 'Allows guests and customers to create and add products to an unlimited number of Wishlists. From birthdays to weddings and everything in between, WooCommerce Wishlists are a welcome addition to any WooCommerce store.', 'storefront' ); ?></p>

				<?php if ( class_exists( 'WC_Wishlists_Plugin' ) ) { ?>
					<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
				<?php } else { ?>
					<p><a href="http://www.woothemes.com/products/woocommerce-wishlists?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( __( 'Buy %sWooCommerce Wishlists%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
				<?php } ?>
			</div>
		</div>

		<p style="margin-bottom: 2.618em;"><a href="http://www.woothemes.com/product-category/woocommerce-extensions/?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button"><?php _e( 'View all WooCommerce extensions &rarr;', 'storefront' ); ?></a></p>
	</div>

	<div class="col-3 last-feature">
		<h5><?php _e( 'Free Storefront Extensions', 'storefront' ); ?></h5>

		<div class="add-on">
			<h4><?php _e( 'Storefront Product Pagination', 'storefront' ); ?></h4>
			<div class="content">
				<p><?php echo sprintf( __( 'Add unobstrusive links to next/previous products on your WooCommerce single product pages. %sMore info &rarr;%s', 'storefront' ), '<a href="https://wordpress.org/plugins/storefront-product-pagination/">', '</a>' );?></p>

				<?php if ( class_exists( 'Storefront_Product_Pagination' ) ) { ?>
					<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
				<?php } else { ?>
					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=storefront-product-pagination' ), 'install-plugin_storefront-product-pagination' ) ); ?>" class="button button-primary"><?php _e( 'Install Storefront Product Pagination', 'storefront' ); ?></a></p>
				<?php } ?>
			</div>
		</div>

		<div class="add-on">
			<h4><?php _e( 'Storefront Top Bar', 'storefront' ); ?></h4>
			<div class="content">
				<p><?php echo sprintf( __( 'Add a widgetised content area at the top of your site and customise it\'s appearance in the Customizer. %sMore info &rarr;%s', 'storefront' ), '<a href="https://wordpress.org/plugins/storefront-top-bar/">', '</a>' ); ?></p>

				<?php if ( class_exists( 'Storefront_Top_Bar' ) ) { ?>
					<p><span class="activated"><?php _e( 'Activated', 'storefront' ); ?></span></p>
				<?php } else { ?>
					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=storefront-top-bar' ), 'install-plugin_storefront-top-bar' ) ); ?>" class="button button-primary"><?php _e( 'Install Storefront Top Bar', 'storefront' ); ?></a></p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<hr />