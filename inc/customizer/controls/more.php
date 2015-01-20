<?php
/**
 * Class to create a Customizer control for displaying information
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
					printf( __( 'There\'s a range of Storefront extensions available to put additional power in your hands. Check out the %sStorefront%s page in your dashboard for more information.', 'storefront' ), '<a href="' . esc_url( admin_url() . 'themes.php?page=storefront-welcome#add-ons' ) .'">', '</a>' );
				?>
			</p>
		</label>
		<?php
	}
}