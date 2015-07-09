<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package storefront
 */

get_header(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'storefront' ); ?></h1>
	</header><!-- .page-header -->

	<p><?php _e( 'Nothing was found at this location. Try searching, or check out the links below.', 'storefront' ); ?></p>

	<?php
	if ( is_woocommerce_activated() ) {
		the_widget( 'WC_Widget_Product_Search' );
	} else {
		get_search_form();
	}
	?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">

				<div class="page-content">

					<?php
					if ( is_woocommerce_activated() ) {
						echo '<h2>' . esc_attr( __( 'Popular Products', 'storefront' ) ) . '</h2>';

						echo storefront_do_shortcode( 'best_selling_products',
							array(
								'per_page' 	=> intval( '3' ),
								'columns'	=> intval( '3' ),
								) );
					}
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

	<div id="secondary" class="widget-area" role="complementary">
		<?php
		if ( is_woocommerce_activated() ) {
			the_widget( 'WC_Widget_Product_Categories', array(
													'count'		=> 1,
													'title'		=> __( 'Product Categories', 'storefront' ),
												) );
		}
		?>
	</div><!-- #secondary -->

<?php get_footer(); ?>
