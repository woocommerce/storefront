<?php
/**
 * Template functions used for the site footer.
 *
 * @package storefront
 */

/**
 * Display the footer widget regions
 * @since  1.0.0
 * @return  void
 */
function storefront_footer_widgets() {
	if ( is_active_sidebar( 'footer-4' ) ) {
		$widget_columns = apply_filters( 'storefront_footer_widget_regions', 4 );
	} elseif ( is_active_sidebar( 'footer-3' ) ) {
		$widget_columns = apply_filters( 'storefront_footer_widget_regions', 3 );
	} elseif ( is_active_sidebar( 'footer-2' ) ) {
		$widget_columns = apply_filters( 'storefront_footer_widget_regions', 2 );
	} elseif ( is_active_sidebar( 'footer-1' ) ) {
		$widget_columns = apply_filters( 'storefront_footer_widget_regions', 1 );
	} else {
		$widget_columns = apply_filters( 'storefront_footer_widget_regions', 0 );
	}

	if ( $widget_columns > 0 ) : ?>

		<section class="footer-widgets col-full col-<?php echo $widget_columns; ?> fix">

			<?php $i = 0; while ( $i < $widget_columns ) : $i++; ?>

				<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>

					<section class="block footer-widget-<?php echo $i; ?>">
			        	<?php dynamic_sidebar( 'footer-' . $i ); ?>
					</section>

		        <?php endif; ?>

			<?php endwhile; ?>

		</section><!-- /.footer-widgets  -->

	<?php endif;
}

/**
 * Display the theme credit
 * @since  1.0.0
 * @return void
 */
function storefront_credit() {
	?>
	<div class="site-info">
		<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'storefront' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'storefront' ), 'WordPress' ); ?></a>
		<span class="sep"> | </span>
		<?php printf( __( 'Theme: %1$s by %2$s.', 'storefront' ), 'storefront', '<a href="http://woothemes.com" rel="designer">woothemes</a>' ); ?>
	</div><!-- .site-info -->
	<?php
}