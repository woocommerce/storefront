<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package storefront
 */

if ( ! function_exists( 'storefront_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function storefront_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'storefront' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'storefront' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'storefront' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'storefront_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function storefront_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'storefront' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'storefront' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'storefront' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'storefront_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function storefront_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s" itemprop="datePublished">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'storefront' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'storefront' ),
		'<span class="author vcard" itemprop="author" itemscope="" itemtype="http://schema.org/Person"><a class="url fn n" itemprop="name" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function storefront_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'storefront_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'storefront_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so storefront_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so storefront_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in storefront_categorized_blog.
 */
function storefront_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'storefront_categories' );
}
add_action( 'edit_category', 'storefront_category_transient_flusher' );
add_action( 'save_post',     'storefront_category_transient_flusher' );

/**
 * Display header widget region
 * @since  1.0.0
 */
function storefront_header_widget_region() {
	?>
	<div class="header-widget-region">
		<div class="col-full">
			<?php dynamic_sidebar( 'header-1' ); ?>
		</div>
	</div>
	<?php
}

/**
 * Display Site Branding
 * @since  1.0.0
 * @return void
 */
function storefront_site_branding() {
	if ( function_exists( 'has_site_logo' ) && has_site_logo() ) {
		the_site_logo();
	} else {
	?>
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>
	<?php }
}

/**
 * Display Primary Navigation
 * @since  1.0.0
 * @return void
 */
function storefront_primary_navigation() {
	?>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<button class="menu-toggle"><?php _e( 'Primary Menu', 'storefront' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav><!-- #site-navigation -->
	<?php
}

/**
 * Display Secondary Navigation
 * @since  1.0.0
 * @return void
 */
function storefront_secondary_navigation() {
	?>
	<nav class="secondary-navigation" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'fallback_cb' => '' ) ); ?>
	</nav><!-- #site-navigation -->
	<?php
}

/**
 * Display Product Categories
 * @since  1.0.0
 * @return void
 */
function storefront_product_categories( $defaults ) {

	$defaults = apply_filters( 'storefront_product_categories_args', array(
		'limit' 			=> 3,
		'columns' 			=> 3,
		'child_categories' 	=> 0,
		'orderby' 			=> 'name',
		'title'				=> __( 'Product Categories', 'storefront' ),
		) );

	echo '<section class="storefront-product-section">';

	echo '<h2 class="section-title">' . $defaults['title'] . '</h2>';
	echo do_shortcode( '[product_categories number="' . $defaults['limit'] . '" columns="' . $defaults['columns'] . '" orderby="' . $defaults['orderby'] . '" parent="' . $defaults['child_categories'] . '"]' );

	echo '</section>';
}

/**
 * Display Recent Products
 * @since  1.0.0
 * @return void
 */
function storefront_recent_products( $defaults ) {
	$defaults = apply_filters( 'storefront_recent_products_args', array(
		'limit' 			=> 4,
		'columns' 			=> 4,
		'title'				=> __( 'Recent Products', 'storefront' ),
		) );

	echo '<section class="storefront-product-section">';

	echo '<h2 class="section-title">' . $defaults['title'] . '</h2>';
	echo do_shortcode( '[recent_products per_page="' . $defaults['limit'] . '" columns="' . $defaults['columns'] . '"]' );

	echo '</section>';
}

/**
 * Display Featured Products
 * @since  1.0.0
 * @return void
 */
function storefront_featured_products( $defaults ) {
	$defaults = apply_filters( 'storefront_featured_products_args', array(
		'limit' 			=> 4,
		'columns' 			=> 4,
		'title'				=> __( 'Featured Products', 'storefront' ),
		) );

	echo '<section class="storefront-product-section">';

	echo '<h2 class="section-title">' . $defaults['title'] . '</h2>';
	echo do_shortcode( '[featured_products per_page="' . $defaults['limit'] . '" columns="' . $defaults['columns'] . '"]' );

	echo '</section>';
}

/**
 * Display Popular Products
 * @since  1.0.0
 * @return void
 */
function storefront_popular_products( $defaults ) {
	$defaults = apply_filters( 'storefront_popular_products_args', array(
		'limit' 			=> 4,
		'columns' 			=> 4,
		'title'				=> __( 'Top Rated Products', 'storefront' ),
		) );

	echo '<section class="storefront-product-section">';

	echo '<h2 class="section-title">' . $defaults['title'] . '</h2>';
	echo do_shortcode( '[top_rated_products per_page="' . $defaults['limit'] . '" columns="' . $defaults['columns'] . '"]' );

	echo '</section>';
}

/**
 * Display On Sale Products
 * @since  1.0.0
 * @return void
 */
function storefront_on_sale_products( $defaults ) {
	$defaults = apply_filters( 'storefront_on_sale_products_args', array(
		'limit' 			=> 4,
		'columns' 			=> 4,
		'title'				=> __( 'On Sale', 'storefront' ),
		) );

	echo '<section class="storefront-product-section">';

	echo '<h2 class="section-title">' . $defaults['title'] . '</h2>';
	echo do_shortcode( '[sale_products per_page="' . $defaults['limit'] . '" columns="' . $defaults['columns'] . '"]' );

	echo '</section>';
}

/**
 * Display page content
 * @since  1.0.0
 * @return  void
 */
function storefront_page_content() {
	while ( have_posts() ) : the_post();

		get_template_part( 'content', 'page' );

	endwhile; // end of the loop.
}

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

function storefront_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<div class="comment-body">
	<div class="comment-meta commentmetadata">
		<div class="comment-author vcard">
		<?php echo get_avatar( $comment, 128 ); ?>
		<?php printf( __( '<cite class="fn">%s</cite>', 'storefront' ), get_comment_author_link() ); ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
			<br />
		<?php endif; ?>

		<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-date">
			<?php echo '<time>' . get_comment_date() . '</time>'; ?>
		</a>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-content">
	<?php endif; ?>

	<?php comment_text(); ?>

	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	<?php edit_comment_link( __( 'Edit', 'storefront' ), '  ', '' ); ?>
	</div>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}