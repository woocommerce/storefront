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
			<h2><?php esc_html_e( 'Enhance Storefront', 'storefront' ); ?></h2>
			<p>
				<?php esc_html_e( 'Take a look at our range of extensions that compliment and extend Storefronts functionality.', 'storefront' ); ?>
			</p>

			<ul class="extensions">
				<li><a href="https://www.woothemes.com/products/storefront-woocommerce-customiser?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons"><?php esc_html_e( 'WooCommerce Customiser', 'storefront' ); ?></a></li>
				<li><a href="https://www.woothemes.com/products/storefront-product-hero?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons"><?php esc_html_e( 'Product Hero', 'storefront' ); ?></a></li>
				<li><a href="https://www.woothemes.com/products/storefront-parallax-hero?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons"><?php esc_html_e( 'Parallax Hero', 'storefront' ); ?></a></li>
				<li><a href="https://www.woothemes.com/products/storefront-designer?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons"><?php esc_html_e( 'Designer', 'storefront' ); ?></a></li>
				<li><a href="https://www.woothemes.com/products/storefront-checkout-customiser/?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons"><?php esc_html_e( 'Checkout Customiser', 'storefront' ); ?></a></li>
				<li><a href="https://www.woothemes.com/products/storefront-reviews?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons"><?php esc_html_e( 'Reviews', 'storefront' ); ?></a></li>
				<li><a href="https://www.woothemes.com/products/storefront-pricing-tables?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons"><?php esc_html_e( 'Pricing Tables', 'storefront' ); ?></a></li>
				<li><a href="https://www.woothemes.com/products/storefront-blog-customiser?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons"><?php esc_html_e( 'Blog Customiser', 'storefront' ); ?></a></li>
			</ul>

			<a href="http://www.woothemes.com/product-category/storefront-extensions?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary">
				<?php esc_html_e( 'View all Storefront extensions &rarr;', 'storefront' ); ?>
			</a>

		</div>

		<div class="boxed free-plugins">
			<h2><?php esc_html_e( 'Install free plugins', 'storefront' ); ?></h2>
			<p>
				<?php echo sprintf( esc_html__( 'There are a number of free plugins available for Storefront on the WordPress.org %splugin repository%s. Here are just a few:', 'storefront' ), '<a href="https://wordpress.org/plugins/search.php?q=storefront">', '</a>' ); ?>
			</p>
			<ul class="extensions">
				<li><a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=storefront-product-pagination&TB_iframe=true&width=744&height=800' ), 'install-plugin_storefront-product-pagination' ) ); ?>"><?php esc_html_e( 'Product Pagination', 'storefront' ); ?></a></li>
				<li><a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=storefront-product-sharing&TB_iframe=true&width=744&height=800' ), 'install-plugin_storefront-product-sharing' ) ); ?>"><?php esc_html_e( 'Product Sharing', 'storefront' ); ?></a></li>
				<li><a class="thickbox" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=storefront-footer-bar&TB_iframe=true&width=744&height=800' ), 'install-plugin_storefront-footer-bar' ) ); ?>"><?php esc_html_e( 'Footer Bar', 'storefront' ); ?></a></li>
			</ul>
		</div>
	</div>

	<div class="col boxed child-themes">
		<h2><?php esc_html_e( 'Child themes', 'storefront' ); ?></h2>
		<p><?php esc_html_e( 'Take a look at our range of child themes for Storefront that allow you to easily change the look of your store to suit a specific industry.', 'storefront' ); ?></p>

		<div class="child-theme">
			<a href="http://www.woothemes.com/products/proshop?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/proshop.jpg'; ?>" alt="<?php esc_html_e( 'Proshop Child Theme', 'storefront' ); ?>" class="image-50" />
				<span class="child-theme-title"><?php esc_html_e( 'Proshop', 'storefront' ); ?></span>
			</a>
		</div>

		<div class="child-theme">
			<a href="http://www.woothemes.com/products/galleria?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/galleria.jpg'; ?>" alt="<?php esc_html_e( 'Galleria Child Theme', 'storefront' ); ?>" class="image-50" />
				<span class="child-theme-title"><?php esc_html_e( 'Galleria', 'storefront' ); ?></span>
			</a>
		</div>

		<div class="child-theme">
			<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=boutique' ), 'install-theme_boutique' ) ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/boutique.jpg'; ?>" alt="<?php esc_html_e( 'Boutique Child Theme', 'storefront' ); ?>" class="image-50" />
				<p class="free"><?php esc_html_e( 'Free!', 'storefront' ); ?></p>
				<span class="child-theme-title"><?php esc_html_e( 'Boutique', 'storefront' ); ?></span>
			</a>
		</div>

		<div class="child-theme">
			<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=deli' ), 'install-theme_deli' ) ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/deli.jpg'; ?>" alt="<?php esc_html_e( 'Deli Child Theme', 'storefront' ); ?>" class="image-50" />
				<p class="free"><?php esc_html_e( 'Free!', 'storefront' ); ?></p>
				<span class="child-theme-title"><?php esc_html_e( 'Deli', 'storefront' ); ?></span>
			</a>
		</div>

		<a href="http://www.woothemes.com/product-category/themes/storefront-child-theme-themes?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary">
			<?php esc_html_e( 'View all Storefront child themes &rarr;', 'storefront' ); ?>
		</a>
	</div>
</div>