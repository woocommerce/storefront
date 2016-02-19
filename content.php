<?php
/**
 * Template used to display post content.
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php
	/**
	 * Functions hooked in to storefront_loop_post action.
	 *
	 * @hooked storefront_post_header  - 10
	 * @hooked storefront_post_meta    - 20
	 * @hooked storefront_post_content - 30
	 */
	do_action( 'storefront_loop_post' );
	?>

</article><!-- #post-## -->
