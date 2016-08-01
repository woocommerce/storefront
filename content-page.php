<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package storefront
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to storefront_page add_action
	 *
	 * @hooked storefront_page_header          - 10
	 * @hooked storefront_page_content         - 20
	 * @hooked storefront_init_structured_data - 30
	 */
	do_action( 'storefront_page' );
	?>
</div><!-- #post-## -->
