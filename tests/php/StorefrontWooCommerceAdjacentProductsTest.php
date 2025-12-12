<?php
/**
 * Tests for Storefront_WooCommerce_Adjacent_Products using WP_UnitTestCase.
 *
 * @package storefront
 */

class StorefrontWooCommerceAdjacentProductsTest extends WP_UnitTestCase {

	/**
	 * Next product should skip hidden products with identical publish dates.
	 */
	public function test_next_product_skips_hidden_with_same_date() {
		$date         = '2024-01-01 10:00:00';
		$current_post = $this->create_product( $date );
		$hidden_next  = $this->create_product( $date, true );
		$visible_next = $this->create_product( $date );

		$GLOBALS['post'] = $current_post;

		$adjacent = new Storefront_WooCommerce_Adjacent_Products( false, '', 'product_cat', false );
		$result   = $adjacent->get_product();

		$this->assertInstanceOf( WC_Product::class, $result );
		$this->assertSame( $visible_next->ID, $result->get_id(), 'Hidden adjacent product should be skipped.' );
		$this->assertNotSame( $hidden_next->ID, $result->get_id(), 'Hidden product must not be returned.' );
	}

	/**
	 * Previous product should skip hidden products with identical publish dates.
	 */
	public function test_previous_product_skips_hidden_with_same_date() {
		$date         = '2024-01-01 10:00:00';
		$visible_prev = $this->create_product( $date );
		$hidden_prev  = $this->create_product( $date, true );
		$current_post = $this->create_product( $date );

		$GLOBALS['post'] = $current_post;

		$adjacent = new Storefront_WooCommerce_Adjacent_Products( false, '', 'product_cat', true );
		$result   = $adjacent->get_product();

		$this->assertInstanceOf( WC_Product::class, $result );
		$this->assertSame( $visible_prev->ID, $result->get_id(), 'Hidden previous product should be skipped.' );
		$this->assertNotSame( $hidden_prev->ID, $result->get_id(), 'Hidden product must not be returned.' );
	}

	/**
	 * Create a product post with WooCommerce visibility set.
	 *
	 * @param string $date   Post date.
	 * @param bool   $hidden Whether the product should be hidden.
	 * @return WP_Post
	 */
	private function create_product( $date, $hidden = false ) {
		$post_id = self::factory()->post->create(
			array(
				'post_type'   => 'product',
				'post_status' => 'publish',
				'post_date'   => $date,
			)
		);

		wp_set_object_terms( $post_id, 'simple', 'product_type' );
		update_post_meta( $post_id, '_price', '10' );
		update_post_meta( $post_id, '_regular_price', '10' );

		if ( $hidden ) {
			wp_set_object_terms( $post_id, 'exclude-from-catalog', 'product_visibility', true );
			wp_set_object_terms( $post_id, 'exclude-from-search', 'product_visibility', true );
			update_post_meta( $post_id, '_visibility', 'hidden' ); // Legacy fallback.
		} else {
			wp_set_object_terms( $post_id, 'visible', 'product_visibility', true );
		}

		return get_post( $post_id );
	}
}
