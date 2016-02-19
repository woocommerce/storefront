<?php
/**
 * Template used to display post content on single pages.
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php
	/**
	 * Functions hooked into storefront_single_post add_action
	 *
	 * @hooked storefront_post_header  - 10
	 * @hooked storefront_post_meta    - 20
	 * @hooked storefront_post_content - 30
	 */
	do_action( 'storefront_single_post' );
	?>

</article><!-- #post-## -->
