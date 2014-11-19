<?php
/**
 * Class to create a custom divider control
 */
class Divider_Storefront_Control extends WP_Customize_Control {

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() {
		echo '<hr style="margin: 1em 0;" />';
	}
}