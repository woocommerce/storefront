<?php
/**
 * Welcome screen child themes template
 */
?>
<div id="child_themes" class="storefront-add-ons panel" style="padding-top: 1.618em; ">
	<?php
		$theme = wp_get_theme();
	?>

	<h2><?php esc_html_e( 'Get a whole new look', 'storefront' ); ?> <div class="dashicons dashicons-admin-appearance"></div></h2>

	<p>
		<?php esc_html_e( 'Below you will find a selection of Storefront child themes that will instantly transform the look and feel of your Storefront shop.', 'storefront' ); ?>
	</p>

	<hr />

	<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/proshop.jpg'; ?>" alt="<?php esc_html_e( 'Proshop Child Theme', 'storefront' ); ?>" class="image-50" />
	<h4><?php esc_html_e( 'Proshop', 'storefront' ); ?></h4>
	<p><?php esc_html_e( 'Unlock the true potential of your sports clothing and equipment store with ProShop! It\'s metropolitan design provides an active aesthetic giving your store oodles of character.', 'storefront' ); ?></p>
	<p style="margin-bottom: 2.618em;">
		<?php if ( 'Proshop' != $theme['Name'] ) { ?>
			<a href="http://www.woothemes.com/products/proshop?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( esc_html__( 'Buy %s now', 'storefront' ), '<span class="screen-reader-text">Proshop</span>' ); ?></a>
		<?php } ?>
	</p>

	<hr />

	<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/galleria.jpg'; ?>" alt="<?php esc_html_e( 'Galleria Child Theme', 'storefront' ); ?>" class="image-50" />
	<h4><?php esc_html_e( 'Galleria', 'storefront' ); ?></h4>
	<p><?php esc_html_e( 'Galleria is a Storefront child theme perfect for fashion and design stores. Stylish and minimalist, it gives sites a high class look and keeps products centerstage.', 'storefront' ); ?></p>
	<p style="margin-bottom: 2.618em;">
		<?php if ( 'Galleria' != $theme['Name'] ) { ?>
			<a href="http://www.woothemes.com/products/galleria?utm_source=product&utm_medium=upsell&utm_campaign=storefrontaddons" class="button button-primary"><?php printf( esc_html__( 'Buy %s now', 'storefront' ), '<span class="screen-reader-text">Galleria</span>' ); ?></a>
		<?php } ?>
	</p>

	<hr />

	<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/boutique.jpg'; ?>" alt="<?php esc_html_e( 'Boutique Child Theme', 'storefront' ); ?>" class="image-50" />
	<p class="free"><?php esc_html_e( 'Free!', 'storefront' ); ?></p>
	<h4><?php esc_html_e( 'Boutique', 'storefront' ); ?></h4>
	<p><?php esc_html_e( 'Boutique is a simple, traditionally designed Storefront child theme, ideal for small stores or boutiques. Add your logo, create a unique color scheme and start selling!', 'storefront' ); ?></p>
	<p style="margin-bottom: 2.618em;">
		<?php if ( 'Boutique' != $theme['Name'] ) { ?>
			<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=boutique' ), 'install-theme_boutique' ) ); ?>" class="button button-primary"><?php printf( __( 'Install %s now', 'storefront' ), '<span class="screen-reader-text">Boutique</span>' ); ?></a>
		<?php } ?>
		<a href="http://www.woothemes.com/products/boutique/" class="button"><?php printf( esc_html__( 'Read more %sabout Boutique%s &rarr;', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a>
	</p>

	<hr />

	<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/deli.jpg'; ?>" alt="<?php esc_html_e( 'Deli Child Theme', 'storefront' ); ?>" class="image-50" />
	<p class="free"><?php esc_html_e( 'Free!', 'storefront' ); ?></p>
	<h4><?php esc_html_e( 'Deli', 'storefront' ); ?></h4>
	<p><?php esc_html_e( 'Deli features a texturised, earthy design, perfect for stores selling natural, organic or hand made goods.', 'storefront' ); ?></p>
	<p style="margin-bottom: 2.618em;">
		<?php if ( 'Deli' != $theme['Name'] ) { ?>
			<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=deli' ), 'install-theme_deli' ) ); ?>" class="button button-primary"><?php printf( __( 'Install %s now', 'storefront' ), '<span class="screen-reader-text">Deli</span>' ); ?></a>
		<?php } ?>
		<a href="http://www.woothemes.com/products/deli/" class="button"><?php printf( esc_html__( 'Read more %sabout Deli%s &rarr;', 'storefront' ), '<span class="screen-reader-text">', '</span>' ); ?></a>
	</p>

</div>