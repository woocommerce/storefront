<?php
/**
 * Welcome screen enhance template
 */
?>
<?php

?>
<div class="col two-col" style="overflow: hidden;">
	<div class="col">
		<div class="boxed enhance">
			<h2><?php printf( esc_html__( 'Enhance %s', 'storefront' ), 'Storefront' ); ?></h2>
			<p>
				<?php printf( esc_html__( 'Take a look at our range of extensions that compliment and extend %s functionality.', 'storefront' ), 'Storefront\'s' ); ?>
			</p>

			<ul class="extensions">
				<li><a href="https://www.woothemes.com/products/storefront-mega-menus?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">Mega Menus</a></li>
				<li><a href="https://www.woothemes.com/products/storefront-woocommerce-customiser?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">WooCommerce Customiser</a></li>
				<li><a href="https://www.woothemes.com/products/storefront-product-hero?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">Product Hero</a></li>
				<li><a href="https://www.woothemes.com/products/storefront-parallax-hero?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">Parallax Hero</a></li>
				<li><a href="https://www.woothemes.com/products/storefront-designer?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">Designer</a></li>
				<li><a href="https://www.woothemes.com/products/storefront-checkout-customiser/?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">Checkout Customiser</a></li>
				<li><a href="https://www.woothemes.com/products/storefront-reviews?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">Reviews</a></li>
				<li><a href="https://www.woothemes.com/products/storefront-pricing-tables?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">Pricing Tables</a></li>
				<li><a href="https://www.woothemes.com/products/storefront-blog-customiser?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">Blog Customiser</a></li>
			</ul>

			<a href="http://www.woothemes.com/product-category/storefront-extensions?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary">
				<?php printf( esc_html__( 'View all %s extensions &rarr;', 'storefront' ), 'Storefront' ); ?>
			</a>

		</div>

		<div class="boxed free-plugins">
			<h2><?php esc_html_e( 'Install free plugins', 'storefront' ); ?></h2>
			<p>
				<?php echo sprintf( esc_html__( 'There are a number of free plugins available for %s on the WordPress.org %splugin repository%s. Here are just a few:', 'storefront' ), 'Storefront', '<a href="https://wordpress.org/plugins/search.php?q=storefront">', '</a>' ); ?>
			</p>
			<ul class="extensions">
				<li><a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=storefront-product-pagination&TB_iframe=true&width=744&height=800' ), 'install-plugin_storefront-product-pagination' ) ); ?>">Product Pagination</a></li>
				<li><a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=storefront-product-sharing&TB_iframe=true&width=744&height=800' ), 'install-plugin_storefront-product-sharing' ) ); ?>">Product Sharing</a></li>
				<li><a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=storefront-footer-bar&TB_iframe=true&width=744&height=800' ), 'install-plugin_storefront-footer-bar' ) ); ?>">Footer Bar</a></li>
				<li><a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=storefront-sticky-add-to-cart&TB_iframe=true&width=744&height=800' ), 'install-plugin_storefront-sticky-add-to-cart' ) ); ?>">Sticky Add to Cart</a></li>
			</ul>
		</div>
	</div>

	<div class="col boxed child-themes">
		<h2><?php esc_html_e( 'Child themes', 'storefront' ); ?></h2>
		<p><?php printf( esc_html__( 'Take a look at our range of child themes for %s that allow you to easily change the look of your store to suit a specific industry.', 'storefront' ), 'Storefront' ); ?></p>

		<div class="child-theme">
			<a href="http://www.woothemes.com/products/outlet?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/outlet.jpg'; ?>" alt="<?php esc_html_e( 'Proshop Child Theme', 'storefront' ); ?>" class="image-50" />
				<span class="child-theme-title">Outlet</span>
			</a>
		</div>

		<div class="child-theme">
			<a href="http://www.woothemes.com/products/proshop?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/proshop.jpg'; ?>" alt="<?php esc_html_e( 'Proshop Child Theme', 'storefront' ); ?>" class="image-50" />
				<span class="child-theme-title">ProShop</span>
			</a>
		</div>

		<div class="child-theme">
			<a href="http://www.woothemes.com/products/galleria?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/galleria.jpg'; ?>" alt="<?php esc_html_e( 'Galleria Child Theme', 'storefront' ); ?>" class="image-50" />
				<span class="child-theme-title">Galleria</span>
			</a>
		</div>

		<div class="child-theme">
			<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=boutique' ), 'install-theme_boutique' ) ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/boutique.jpg'; ?>" alt="<?php esc_html_e( 'Boutique Child Theme', 'storefront' ); ?>" class="image-50" />
				<p class="free"><?php esc_html_e( 'Free!', 'storefront' ); ?></p>
				<span class="child-theme-title">Boutique</span>
			</a>
		</div>

		<a href="http://www.woothemes.com/product-category/themes/storefront-child-theme-themes?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary">
			<?php printf( esc_html__( 'View all %s child themes &rarr;', 'storefront' ), 'Storefront' ); ?>
		</a>
	</div>
</div>