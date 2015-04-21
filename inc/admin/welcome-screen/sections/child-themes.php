<?php
/**
 * Welcome screen child themes template
 */
?>
<div id="add-ons" class="storefront-add-ons feature-section three-col col" style="padding-top: 1.618em; clear: both;">
	<?php
		$theme = wp_get_theme();
	?>

	<h2><?php _e( 'Get a whole new look', 'storefront' ); ?> <div class="dashicons dashicons-admin-appearance"></div></h2>

	<p>
		<?php _e( 'Below you will find a selection of Storefront child themes that will transform the look and feel of your site while retaining the rock solid Storefront foundation.', 'storefront' ); ?>
	</p>

	<div class="col-1">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/welcome/boutique.jpg'; ?>" alt="<?php _e( 'Boutique Child Theme', 'storefront' ); ?>" class="image-50" width="440" />
		<h4><?php _e( 'Boutique', 'storefront' ); ?></h4>
		<p><?php _e( 'Boutique is a simple, traditionally designed Storefront child theme, ideal for small stores or boutiques. Add your logo, create a unique color scheme and start selling!', 'storefront' ); ?></p>
		<p style="margin-bottom: 2.618em;">
			<?php if ( 'Boutique' != $theme['Name'] ) { ?>
				<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=boutique' ), 'install-theme_boutique' ) ); ?>" class="button button-primary"><?php printf( __( 'Install %s now', 'storefront' ), '<span class="screen-reader-text">Boutique</span>' ); ?></a>
			<?php } ?>
			<a href="http://www.woothemes.com/products/boutique/" class="button"><?php printf( __( 'Read more %sabout Boutique%s &rarr;', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a>
		</p>
	</div>
</div>

<hr style="clear: both;" />

<p style="font-size: 1.2em; margin: 2.618em 0;">
	<?php echo sprintf( esc_html__( 'There are literally hundreds of awesome extensions available for you to use. Looking for Table Rate Shipping? Subscriptions? Product Add-ons? You can find these and more in the WooCommerce extension shop. %sGo shopping%s.', 'storefront' ), '<a href="http://www.woothemes.com/product-category/woocommerce-extensions/">', '</a>' ); ?>
</p>

<hr style="clear: both;" />