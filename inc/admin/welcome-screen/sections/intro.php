<?php
/**
 * Welcome screen intro template
 */
?>
<?php
$storefront = wp_get_theme( 'storefront' );

?>
<div class="col two-col" style="margin-bottom: 1.618em; overflow: hidden;">
	<div class="col">
		<h1 style="margin-right: 0;"><?php echo '<strong>Storefront</strong> <sup style="font-weight: bold; font-size: 50%; padding: 5px 10px; color: #666; background: #fff;">' . esc_attr( $storefront['Version'] ) . '</sup>'; ?></h1>

		<p style="font-size: 1.2em;"><?php esc_html_e( 'Awesome! You\'ve decided to use Storefront to enrich your WooCommerce store design.', 'storefront' ); ?></p>
		<p><?php esc_html_e( 'Whether you\'re a store owner, WordPress developer, or both - we hope you enjoy Storefront\'s deep integration with WooCommerce core (including several popular WooCommerce extensions), plus the flexible design and extensible codebase that this theme provides.', 'storefront' ); ?>
	</div>

	<div class="col">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" alt="Storefront" class="image-50" />
	</div>
</div>