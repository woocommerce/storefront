<?php
/**
 * Class to create a custom layout control
 */
class Layout_Picker_Storefront_Control extends WP_Customize_Control {

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() {
		$imageDirectory 		= '/customizer/controls/img/';
		$imageDirectoryInc 		= '/inc/customizer/controls/img/';
		$finalImageDirectory 	= '';

		if ( is_dir( get_stylesheet_directory() . $imageDirectory ) ) {
			$finalImageDirectory = get_stylesheet_directory_uri() . $imageDirectory;
		}

		if ( is_dir( get_stylesheet_directory() . $imageDirectoryInc ) ) {
			$finalImageDirectory = get_stylesheet_directory_uri() . $imageDirectoryInc;
		}

		?>
		<label style="overflow: hidden; zoom: 1;">
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

			<label style="width: 48%; float: left; margin-right: 3.8%; text-align: center;">
				<img src="<?php echo $finalImageDirectory; ?>2cl.png" alt="Left Sidebar" style="display: block; width: 100%;" />
				<input type="radio" value="left" style="margin: 5px 0 0 0;"name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); checked( $this->value(), 'left' ); ?> />
				<br/>
			</label>
			<label style="width: 48%; float: right; text-align: center;">
				<img src="<?php echo $finalImageDirectory; ?>2cr.png" alt="Right Sidebar" style="display: block; width: 100%;" />
				<input type="radio" value="right" style="margin: 5px 0 0 0;"name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); checked( $this->value(), 'right' ); ?> />
				<br/>
			</label>
		</label>
		<?php
	}
}