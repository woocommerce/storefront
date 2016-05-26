<?php
/**
 * Storefront hooks
 *
 * @package storefront
 */

/**
 * General
 *
 * @see  storefront_header_widget_region()
 * @see  storefront_get_sidebar()
 */
add_action( 'storefront_before_content', 'storefront_header_widget_region', 10 );
add_action( 'storefront_sidebar',        'storefront_get_sidebar',          10 );

/**
 * Header
 *
 * @see  storefront_skip_links()
 * @see  storefront_secondary_navigation()
 * @see  storefront_site_branding()
 * @see  storefront_primary_navigation()
 */
add_action( 'storefront_header', 'storefront_skip_links',                       0 );
add_action( 'storefront_header', 'storefront_site_branding',                    20 );
add_action( 'storefront_header', 'storefront_secondary_navigation',             30 );
add_action( 'storefront_header', 'storefront_primary_navigation_wrapper',       42 );
add_action( 'storefront_header', 'storefront_primary_navigation',               50 );
add_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68 );

/**
 * Footer
 *
 * @see  storefront_footer_widgets()
 * @see  storefront_credit()
 */
add_action( 'storefront_footer', 'storefront_footer_widgets', 10 );
add_action( 'storefront_footer', 'storefront_credit',         20 );

/**
 * Homepage
 *
 * @see  storefront_homepage_content()
 * @see  storefront_product_categories()
 * @see  storefront_recent_products()
 * @see  storefront_featured_products()
 * @see  storefront_popular_products()
 * @see  storefront_on_sale_products()
 * @see  storefront_best_selling_products()
 */
add_action( 'homepage', 'storefront_homepage_content',      10 );
add_action( 'homepage', 'storefront_product_categories',    20 );
add_action( 'homepage', 'storefront_recent_products',       30 );
add_action( 'homepage', 'storefront_featured_products',     40 );
add_action( 'homepage', 'storefront_popular_products',      50 );
add_action( 'homepage', 'storefront_on_sale_products',      60 );
add_action( 'homepage', 'storefront_best_selling_products', 70 );

/**
 * Posts
 *
 * @see  storefront_post_header()
 * @see  storefront_post_meta()
 * @see  storefront_post_content()
 * @see  storefront_init_structured_data()
 * @see  storefront_paging_nav()
 * @see  storefront_single_post_header()
 * @see  storefront_post_nav()
 * @see  storefront_display_comments()
 */
add_action( 'storefront_loop_post',         'storefront_post_header',          10 );
add_action( 'storefront_loop_post',         'storefront_post_meta',            20 );
add_action( 'storefront_loop_post',         'storefront_post_content',         30 );
add_action( 'storefront_loop_post',         'storefront_init_structured_data', 40 );
add_action( 'storefront_loop_after',        'storefront_paging_nav',           10 );
add_action( 'storefront_single_post',       'storefront_post_header',          10 );
add_action( 'storefront_single_post',       'storefront_post_meta',            20 );
add_action( 'storefront_single_post',       'storefront_post_content',         30 );
add_action( 'storefront_single_post',       'storefront_init_structured_data', 40 );
add_action( 'storefront_single_post_after', 'storefront_post_nav',             10 );
add_action( 'storefront_single_post_after', 'storefront_display_comments',     20 );

/**
 * Pages
 *
 * @see  storefront_page_header()
 * @see  storefront_page_content()
 * @see  storefront_init_structured_data()
 * @see  storefront_display_comments()
 */
add_action( 'storefront_page',       'storefront_page_header',          10 );
add_action( 'storefront_page',       'storefront_page_content',         20 );
add_action( 'storefront_page',       'storefront_init_structured_data', 30 );
add_action( 'storefront_page_after', 'storefront_display_comments',     10 );
