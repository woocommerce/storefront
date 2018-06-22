<?php // @codingStandardsIgnoreLine.
/**
 * Class to create a Customizer control for displaying information
 *
 * @package  storefront
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The 'more' Storefront control class
 */
class More_Storefront_Control extends WP_Customize_Control {

	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		?>
		<label style="overflow: hidden; zoom: 1;">

			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

			<p>
				<?php
					/* translators: 1: Storefront, 2: start <a> tag, 3: Storefront, 4: end <a> tag */
					printf( esc_html__( 'There\'s a range of %1$s extensions available to put additional power in your hands. Check out the %2$s%3$s%4$s page in your dashboard for more information.', 'storefront' ), 'Storefront', '<a href="' . esc_url( admin_url() . 'themes.php?page=storefront-welcome' ) . '">', 'Storefront', '</a>' );
				?>
			</p>

			<span class="customize-control-title">
				<?php
					/* translators: %s: Storefront */
					printf( esc_html__( 'Enjoying %s?', 'storefront' ), 'Storefront' );
				?>
			</span>

			<p>
				<?php
					/* translators: 1: start <a> tag, 2: end <a> tag */
					printf( esc_html__( 'Why not leave us a review on %1$sWordPress.org%2$s?  We\'d really appreciate it!', 'storefront' ), '<a href="https://wordpress.org/themes/storefront">', '</a>' );
				?>
			</p>

		</label>
		<?php
	}
}
