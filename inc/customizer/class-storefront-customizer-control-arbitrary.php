<?php
/**
 * Class to create a custom arbitrary html control for dividers etc
 *
 * @author   WooThemes
 * @package  storefront
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The arbitrary control class
 */
class Arbitrary_Storefront_Control extends WP_Customize_Control {

	/**
	 * The settings var
	 *
	 * @var string $settings the blog name.
	 */
	public $settings 	= 'blogname';

	/**
	 * The description var
	 *
	 * @var string $description the control description.
	 */
	public $description = '';

	/**
	 * Renter the control
	 *
	 * @return void
	 */
	public function render_content() {
		switch ( $this->type ) {
			default:
			case 'text' :
				echo '<p class="description">' . wp_kses_post( $this->description ) . '</p>';
			break;

			case 'heading':
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
			break;

			case 'divider' :
				echo '<hr style="margin: 1em 0;" />';
			break;
		}
	}
}
