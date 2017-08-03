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
		 * @since 2.2.0
		 */
		public function __construct() {
			add_action( 'admin_init', array( $this, 'customizer' ) );
		}

		/**
		 * Customizer.
		 *
		 * @since 2.2.0
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
		 * @since 2.2.0
		 */
		public function customize_scripts() {
			global $storefront_version;

			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_style( 'sp-guided-tour', get_template_directory_uri() . '/assets/sass/admin/customizer/customizer.css', array(), $storefront_version, 'all' );

			wp_enqueue_script( 'sf-guided-tour', get_template_directory_uri() . '/assets/js/admin/customizer' . $suffix . '.js', array( 'jquery', 'wp-backbone' ), $storefront_version, true );

			wp_localize_script( 'sf-guided-tour', '_wpCustomizeSFGuidedTourSteps', $this->guided_tour_steps() );
		}

		/**
		 * Template for steps.
		 *
		 * @since 2.2.0
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
		 * @since 2.2.0
		 */
		public function guided_tour_steps() {
			$steps = array();

			$steps[] = array(
				'title'       => __( 'Welcome to the Customizer', 'storefront' ),
				'message'     => sprintf( __( 'Here you can control the overall look and feel of your store.%sTo get started, let\'s add your logo', 'storefront' ), PHP_EOL . PHP_EOL ),
				'button_text' => __( 'Let\'s go!', 'storefront' ),
				'section'     => '#customize-info',
			);

			$steps[] = array(
				'title'   => __( 'Add your logo', 'storefront' ),
				'message' => __( 'Open the Site Identity Panel, then click the \'Select Logo\' button to upload your logo.', 'storefront' ),
				'section' => 'title_tagline',
			);

			$steps[] = array(
				'title'   => __( 'Choose your accent color', 'storefront' ),
				'message' => __( 'In the typography panel you can specify an accent color which will be applied to things like links and star ratings. We recommend using your brand color for this setting.', 'storefront' ),
				'section' => 'storefront_typography',
			);

			$steps[] = array(
				'title'   => __( 'Color your buttons', 'storefront' ),
				'message' => __( 'Choose colors for your button backgrounds and text. Once again, brand colors are good choices here.', 'storefront' ),
				'section' => 'storefront_buttons',
			);

			$steps[] = array(
				'title'       =>  '',
				'message'     => sprintf( __( 'All set! Remember to %ssave & publish%s your changes when you\'re done.%sYou can return to your dashboard by clicking the X in the top left corner.', 'storefront' ), '<strong>', '</strong>', PHP_EOL . PHP_EOL ),
				'section'     => '#customize-header-actions .save',
				'button_text' => __( 'Done', 'storefront' ),
			);

			return $steps;
		}
	}

endif;

return new Storefront_NUX_Guided_Tour();
