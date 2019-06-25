<?php
/**
 * Storefront WooCommerce functions.
 *
 * @package storefront
 */

/**
 * Checks if the current page is a product archive
 *
 * @return boolean
 */
function storefront_is_product_archive() {
	if ( is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag() ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Retrieves the previous product.
 *
 * @since 2.4.3
 *
 * @param bool         $in_same_term   Optional. Whether post should be in a same taxonomy term. Default false.
 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 */
function storefront_get_previous_product( $in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat' ) {
	$product = new Storefront_WooCommerce_Adjacent_Products( $in_same_term, $excluded_terms, $taxonomy, true );
	return $product->get_product();
}

/**
 * Retrieves the next product.
 *
 * @since 2.4.3
 *
 * @param bool         $in_same_term   Optional. Whether post should be in a same taxonomy term. Default false.
 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 */
function storefront_get_next_product( $in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat' ) {
	$product = new Storefront_WooCommerce_Adjacent_Products( $in_same_term, $excluded_terms, $taxonomy );
	return $product->get_product();
}

/**
 * Retrieves the homepage sections to diplay.
 *
 * @since 2.5.1
 *
 * @return array Array of homepage section to add.
 */
function storefront_get_homepage_sections() {

	$sections = array(
		20 => 'product_categories',
		30 => 'recent_products',
		40 => 'featured_products',
		50 => 'popular_products',
		60 => 'on_sale_products',
		70 => 'best_selling_products'

	);

	/**
	 * Filter homepage sections.
	 *
	 * @since 2.5.1
	 *
	 * @param array $sections
	 */
	return apply_filters( 'woocommerce_storefront_homepage_sections', $sections );
}
