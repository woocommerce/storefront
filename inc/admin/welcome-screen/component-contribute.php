<?php
/**
 * Welcome screen contribute template
 *
 * @package storefront
 */

?>
	<div class="boxed contribute">
		<h2><?php esc_html_e( 'Contribute to Storefront', 'storefront' ); ?></h2>
		<p><?php printf( esc_html__( 'Found a bug? Want to contribute a patch or create a new feature? %sGitHub is the place to go!%s Or would you like to translate %s into your language? %sGet involved on WordPress.org%s.', 'storefront' ), '<a href="https://github.com/woothemes/storefront">', '</a>', 'Storefront', '<a href="https://translate.wordpress.org/projects/wp-themes/storefront">', '</a>' ); ?></p>
	</div>

	<div class="boxed suggest">
		<h2><?php esc_html_e( 'Suggest a feature', 'storefront' ); ?></h2>
		<p><?php printf( esc_html__( 'Please suggest and vote on ideas at the %s%s Ideas board%s. The most popular ideas will see prioritised development.', 'storefront' ), '<a href="http://ideas.woothemes.com/forums/275029-storefront">', 'Storefront', '</a>' ); ?></p>
	</div>
</div><!--/boxes-->

<div class="automattic">
	<p>
	<?php printf( esc_html__( 'An %s project', 'storefront' ), '<a href="https://automattic.com/"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/admin/welcome-screen/automattic.png" alt="Automattic" /></a>' ); ?>
	</p>
</div>
