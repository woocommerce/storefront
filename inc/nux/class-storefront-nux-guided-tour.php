<?php
/**
 * Storefront NUX Guided Tour Class
 *
 * @author   WooThemes
 * @package  storefront
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Storefront_NUX_Guided_Tour' ) ) :

	/**
	 * The Storefront NUX Guided Tour class
	 */
	class Storefront_NUX_Guided_Tour {
		/**
		 * Setup class.
		 *
		 * @since 2.2
		 */
		public function __construct() {
			add_action( 'admin_init', array( $this, 'customizer' ) );
		}

		/**
		 * Customizer.
		 *
		 * @since 2.2
		 */
		public function customizer() {
			global $pagenow;

			if ( 'customize.php' === $pagenow && isset( $_GET['sf_guided_tour'] ) && 1 === absint( $_GET['sf_guided_tour'] ) ) {
				add_action( 'customize_controls_enqueue_scripts',      array( $this, 'customize_scripts' ) );
				add_action( 'customize_controls_print_footer_scripts', array( $this, 'print_templates' ) );
			}
		}

		/**
		 * Customizer enqueues.
		 *
		 * @since 2.2
		 */
		public function customize_scripts() {
			global $storefront_version;

			wp_enqueue_style( 'sp-guided-tour', get_template_directory_uri() . '/inc/nux/assets/css/customizer.css', array(), $storefront_version, 'all' );

			wp_enqueue_script( 'sf-guided-tour', get_template_directory_uri() . '/inc/nux/assets/js/customizer.min.js', array( 'jquery', 'wp-backbone' ), $storefront_version, true );

			wp_localize_script( 'sf-guided-tour', '_wpCustomizeSFGuidedTourSteps', $this->guided_tour_steps() );
		}

		/**
		 * Template for steps.
		 *
		 * @since 2.2
		 */
		public function print_templates() {
			?>
			<script type="text/html" id="tmpl-sf-guided-tour-step">
				<div class="sf-guided-tour-step">
					<# if ( data.title ) { #>
						<h2>{{ data.title }}</h2>
					<# } #>
					{{{ data.message }}}
					<a class="sf-nux-button" href="#">
						<# if ( data.button_text ) { #>
							{{ data.button_text }}
						<# } else { #>
							<?php esc_attr_e( 'Next', 'storefront' ); ?>
						<# } #>
					</a>
					<# if ( ! data.last_step ) { #>
						<a class="sf-guided-tour-skip" href="#">
						<# if ( data.first_step ) { #>
							<?php esc_attr_e( 'No thanks, skip the tour', 'storefront' ); ?>
						<# } else { #>
							<?php esc_attr_e( 'Skip this step', 'storefront' ); ?>
						<# } #>
						</a>
					<# } #>
				</div>
			</script>
			<?php
		}

		/**
		 * Guided tour steps.
		 *
		 * @since 2.2
		 */
		public function guided_tour_steps() {
			$steps = array();

			$steps[] = array(
				'title'       => __( 'Welcome to the Customizer', 'storefront' ),
				'message'     => sprintf( __( 'Here you can control the overall look and feel of Storefront.%sThere are a few options we recommend you configure to make Storefront your own. We\'ll guide you through changing your homepage layout, adding your logo and customising the header colors. It won\'t take a minute :)', 'storefront' ), PHP_EOL . PHP_EOL ),
				'button_text' => __( 'Let\'s go!', 'storefront' ),
				'section'     => '#customize-info'
			);

			$steps[] = array(
				'title'   => __( 'Add your logo', 'storefront' ),
				'message' => __( 'Open the Site Identity Panel, then click the \'Select Logo\' button to upload your logo.', 'storefront' ),
				'section' => 'title_tagline'
			);

			$steps[] = array(
				'title'   => __( 'Design the site header', 'storefront' ),
				'message' => __( 'Inside the Header panel you\'ll find options for the header background, plus link and text colors. Choose colors that suit your brand or use a white header background to create a minimalist look.' ),
				'section' => 'header_image'
			);

			$steps[] = array(
				'title'   => __( 'Choose typography colors', 'storefront' ),
				'message' => __( 'In the typography panel you can specify colors for general text, for headings and an accent color for things like links.' ),
				'section' => 'storefront_typography'
			);

			$steps[] = array(
				'title'   => __( 'Configure the layout', 'storefront' ),
				'message' => __( 'Choose whether your sidebar should appear on the left or the right of your main content area.' ),
				'section' => 'storefront_layout'
			);

			$steps[] = array(
				'title'   => __( 'Color your buttons', 'storefront' ),
				'message' => __( 'Choose colors for your button backgrounds and text. You can see a secondary button on the cart page.' ),
				'section' => 'storefront_buttons'
			);

			$steps[] = array(
				'title'   => __( 'Design the site footer', 'storefront' ),
				'message' => __( 'Like the header you have control of the background color and link / text colors.' ),
				'section' => 'storefront_footer'
			);

			$steps[] = array(
				'title'       => '',
				'message'     => sprintf( __( 'That\'s as far as we go in our tour, but there\'s lots more to discover in the Customizer so be sure to explore. When you\'re done, remember to %ssave & publish%s your changes.', 'storefront' ), '<strong>', '</strong>' ),
				'section'     => '#customize-header-actions .save',
				'button_text' => __( 'Done', 'storefront' ),
			);

			return $steps;
		}
	}

endif;

return new Storefront_NUX_Guided_Tour();