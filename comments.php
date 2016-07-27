<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package storefront
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<section id="comments" class="comments-area" aria-label="Post Comments">

	<?php
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'storefront' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation" aria-label="Comment Navigation Above">
			<span class="screen-reader-text"><?php _e( 'Comment navigation', 'storefront' ); ?></span>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'storefront' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'storefront' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      	=> 'ol',
					'short_ping' 	=> true,
					'callback'		=> 'storefront_comment',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation" aria-label="Comment Navigation Below">
			<span class="screen-reader-text"><?php _e( 'Comment navigation', 'storefront' ); ?></span>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'storefront' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'storefront' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation

	endif; // have_comments()

	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'storefront' ); ?></p>
	<?php endif;

  $args = apply_filters( 'storefront_comment_form_args', array(
    'title_reply_before' => '<span id="reply-title" class="h3 comment-reply-title">',
    'title_reply_after'  => '</span>'
  ) );

	comment_form( $args ); ?>

</section><!-- #comments -->
