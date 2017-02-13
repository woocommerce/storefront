<?php
/**
 * Storefront WooCommerce hooks
 *
 * @package storefront
 */

/**
 * Styles
 *
 * @see  storefront_woocommerce_scripts()
 */

/**
 * Layout
 *
 * @see  storefront_before_content()
 * @see  storefront_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  storefront_shop_messages()
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb',                   20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper',       10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end',   10 );
remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar',                  10 );
remove_action( 'woocommerce_after_shop_loop',     'woocommerce_pagination',                   10 );
remove_action( 'woocommerce_before_shop_loop',    'woocommerce_result_count',                 20 );
remove_action( 'woocommerce_before_shop_loop',    'woocommerce_catalog_ordering',             30 );
add_action( 'woocommerce_before_main_content',    'storefront_before_content',                10 );
add_action( 'woocommerce_after_main_content',     'storefront_after_content',                 10 );
add_action( 'storefront_content_top',             'storefront_shop_messages',                 15 );
add_action( 'storefront_content_top',             'woocommerce_breadcrumb',                   10 );

add_action( 'woocommerce_after_shop_loop',        'storefront_sorting_wrapper',               9 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_catalog_ordering',             10 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_result_count',                 20 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_pagination',                   30 );
add_action( 'woocommerce_after_shop_loop',        'storefront_sorting_wrapper_close',         31 );
add_action( 'woocommerce_after_shop_loop',        'storefront_product_columns_wrapper_close', 40 );

add_filter( 'loop_shop_columns',                  'storefront_loop_columns' );

add_action( 'woocommerce_before_shop_loop',       'storefront_sorting_wrapper',               9 );
add_action( 'woocommerce_before_shop_loop',       'woocommerce_catalog_ordering',             10 );
add_action( 'woocommerce_before_shop_loop',       'woocommerce_result_count',                 20 );
add_action( 'woocommerce_before_shop_loop',       'storefront_woocommerce_pagination',        30 );
add_action( 'woocommerce_before_shop_loop',       'storefront_sorting_wrapper_close',         31 );
add_action( 'woocommerce_before_shop_loop',       'storefront_product_columns_wrapper',       40 );

add_action( 'storefront_footer',                  'storefront_handheld_footer_bar',           999 );

/**
 * Products
 *
 * @see  storefront_upsell_display()
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display',               15 );
add_action( 'woocommerce_after_single_product_summary',    'storefront_upsell_display',                15 );
remove_action( 'woocommerce_before_shop_loop_item_title',  'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_after_shop_loop_item_title',      'woocommerce_show_product_loop_sale_flash', 6 );

/**
 * Header
 *
 * @see  storefront_product_search()
 * @see  storefront_header_cart()
 */
add_action( 'storefront_header', 'storefront_product_search', 40 );
add_action( 'storefront_header', 'storefront_header_cart',    60 );

/**
 * Structured Data
 *
 * @see storefront_woocommerce_init_structured_data()
 */
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
	add_action( 'woocommerce_before_shop_loop_item', 'storefront_woocommerce_init_structured_data' );
}

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'storefront_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'storefront_cart_link_fragment' );
}
