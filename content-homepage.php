<?php
/**
 * The template used for displaying page content in template-homepage.php
 *
 * @package storefront
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="<?php storefront_homepage_content_styles(); ?>" data-adaptive-background data-ab-css-background>
	<div class="col-full">
		<?php
		/**
		 * Functions hooked in to storefront_page add_action
		 *
		 * @hooked storefront_homepage_header      - 10
		 * @hooked storefront_page_content         - 20
		 * @hooked storefront_init_structured_data - 30
		 */
		do_action( 'storefront_homepage' );
		?>
	</div>
</div><!-- #post-## -->
