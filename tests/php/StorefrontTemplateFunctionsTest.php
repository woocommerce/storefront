<?php
/**
 * Tests for Storefront template functions.
 *
 * @package storefront
 */

class StorefrontTemplateFunctionsTest extends WP_UnitTestCase {

	/**
	 * Footer credit should preserve the WooCommerce credit covered by the browser smoke test.
	 */
	public function test_storefront_credit_displays_woocommerce_credit() {
		ob_start();
		storefront_credit();
		$output = ob_get_clean();

		$this->assertStringContainsString( 'Built with WooCommerce', wp_strip_all_tags( $output ) );
	}
}
