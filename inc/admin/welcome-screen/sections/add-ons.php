<?php
/**
 * Welcome screen add-ons template
 */
?>
<div id="add_ons" class="storefront-add-ons panel" style="padding-top: 1.618em;">
	<h2><?php esc_html_e( 'Enhance your site', 'storefront' ); ?> <div class="dashicons dashicons-admin-plugins"></div></h2>

	<p>
		<?php esc_html_e( 'Below you will find a selection of Storefront extensions that could help improve your online store.', 'storefront' ); ?>
	</p>

	<hr />

	<div class="add-on storefront-designer">
		<h4><?php esc_html_e( 'Refine your shop archives and product pages with the Storefront WooCommerce Customiser', 'storefront' ); ?></h4>
		<div class="content">
			<p><?php esc_html_e( 'The Storefront WooCommerce Customiser extension gives you further control over the look and feel of your shop. Change the product archive and single layouts, toggle various shop components and more.', 'storefront' ); ?></p>

			<?php if ( class_exists( 'Storefront_WooCommerce_Customiser' ) ) { ?>
				<p><span class="activated"><?php esc_html_e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://www.woothemes.com/products/storefront-woocommerce-customiser?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( esc_html__( 'Buy %sStorefront WooCommerce Customiser%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on product-hero">
		<h4><?php esc_html_e( 'Highlight a product of your choosing with the Storefront Product Hero', 'storefront' ); ?></h4>
		<div class="content">
			<p><?php esc_html_e( 'The Storefront Product Hero extension adds a parallax hero component to your homepage highlighting a specific product at your store. Use the shortcode to add attractive hero components to posts, pages or widgets.', 'storefront' ); ?></p>

			<?php if ( class_exists( 'Storefront_Product_Hero' ) ) { ?>
				<p><span class="activated"><?php esc_html_e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://www.woothemes.com/products/storefront-product-hero?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( esc_html__( 'Buy %sStorefront Product Hero%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on wc-customiser">
		<h4><?php esc_html_e( 'Further customise your store with the Storefront Designer', 'storefront' ); ?></h4>
		<div class="content">
			<p><?php esc_html_e( 'Storefront Designer adds a bunch of additional appearance settings allowing you to further tweak and perfect your Storefront design by changing the header layout, button styles, typographical schemes/scales and more.', 'storefront' ); ?></p>

			<?php if ( class_exists( 'Storefront_Designer' ) ) { ?>
				<p><span class="activated"><?php esc_html_e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://www.woothemes.com/products/storefront-designer?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( esc_html__( 'Buy %sStorefront Designer%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on storefront-checkout-customiser">
		<h4><?php esc_html_e( 'Optimize the checkout page at your store with the Storefront Checkout Customiser', 'storefront' ); ?></h4>
		<div class="content">
			<p><?php esc_html_e( 'The checkout is arguably the most crucial page at your store to get right. The Storefront Checkout Customiser allows you to tweak the checkout by choosing a different layout and removing distractions to find out what works best at your store. Try different combinations of settings to A/B test and improve conversions.', 'storefront' ); ?></p>

			<?php if ( class_exists( 'Storefront_Checkout_Customiser' ) ) { ?>
				<p><span class="activated"><?php esc_html_e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://www.woothemes.com/products/storefront-checkout-customiser/?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( esc_html__( 'Buy %sStorefront Reviews%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

	<div class="add-on storefront-reviews">
		<h4><?php esc_html_e( 'Highlight favourable reviews throughout your store with Storefront Reviews', 'storefront' ); ?></h4>
		<div class="content">
			<p><?php esc_html_e( 'Reading a positive review can be what converts a visitor into a customer. The Storefront Reviews extension allows you to highlight positive reviews across your site to showcase your most popular products.', 'storefront' ); ?></p>

			<?php if ( class_exists( 'Storefront_Reviews' ) ) { ?>
				<p><span class="activated"><?php esc_html_e( 'Activated', 'storefront' ); ?></span></p>
			<?php } else { ?>
				<p><a href="https://www.woothemes.com/products/storefront-reviews?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( esc_html__( 'Buy %sStorefront Reviews%s now', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a></p>
			<?php } ?>
		</div>
	</div>

</div>