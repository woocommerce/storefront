<?php
/**
 * Template for displaying pages with a sidebar.
 *
 * In Storefront 2.5.7 and earlier, the default page template included a
 * sidebar. In 2.5.8 the sidebar was removed from the default template.
 * This template was added so stores can opt-in to sidebar layout on a
 * per-page basis.
 *
 * Template Name: Page with sidebar
 *
 * @since 2.5.8
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();

				do_action( 'storefront_page_before' );

				get_template_part( 'content', 'page' );

				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
