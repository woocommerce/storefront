<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package storefront
 */

if ( ! function_exists( 'storefront_product_categories' ) ) {
	/**
	 * Display Product Categories
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_product_categories( $defaults ) {

		$defaults = apply_filters( 'storefront_product_categories_args', array(
			'limit' 			=> 3,
			'columns' 			=> 3,
			'child_categories' 	=> 0,
			'orderby' 			=> 'name',
			'title'				=> __( 'Product Categories', 'storefront' ),
			) );

		echo '<section class="storefront-product-section">';

		echo '<h2 class="section-title">' . $defaults['title'] . '</h2>';
		echo do_shortcode( '[product_categories number="' . $defaults['limit'] . '" columns="' . $defaults['columns'] . '" orderby="' . $defaults['orderby'] . '" parent="' . $defaults['child_categories'] . '"]' );

		echo '</section>';
	}
}

if ( ! function_exists( 'storefront_recent_products' ) ) {
	/**
	 * Display Recent Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_recent_products( $defaults ) {
		$defaults = apply_filters( 'storefront_recent_products_args', array(
			'limit' 			=> 4,
			'columns' 			=> 4,
			'title'				=> __( 'Recent Products', 'storefront' ),
			) );

		echo '<section class="storefront-product-section">';

		echo '<h2 class="section-title">' . $defaults['title'] . '</h2>';
		echo do_shortcode( '[recent_products per_page="' . $defaults['limit'] . '" columns="' . $defaults['columns'] . '"]' );

		echo '</section>';
	}
}

if ( ! function_exists( 'storefront_featured_products' ) ) {
	/**
	 * Display Featured Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_featured_products( $defaults ) {
		$defaults = apply_filters( 'storefront_featured_products_args', array(
			'limit' 			=> 4,
			'columns' 			=> 4,
			'title'				=> __( 'Featured Products', 'storefront' ),
			) );

		echo '<section class="storefront-product-section">';

		echo '<h2 class="section-title">' . $defaults['title'] . '</h2>';
		echo do_shortcode( '[featured_products per_page="' . $defaults['limit'] . '" columns="' . $defaults['columns'] . '"]' );

		echo '</section>';
	}
}

if ( ! function_exists( 'storefront_popular_products' ) ) {
	/**
	 * Display Popular Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_popular_products( $defaults ) {
		$defaults = apply_filters( 'storefront_popular_products_args', array(
			'limit' 			=> 4,
			'columns' 			=> 4,
			'title'				=> __( 'Top Rated Products', 'storefront' ),
			) );

		echo '<section class="storefront-product-section">';

		echo '<h2 class="section-title">' . $defaults['title'] . '</h2>';
		echo do_shortcode( '[top_rated_products per_page="' . $defaults['limit'] . '" columns="' . $defaults['columns'] . '"]' );

		echo '</section>';
	}
}

if ( ! function_exists( 'storefront_on_sale_products' ) ) {
	/**
	 * Display On Sale Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_on_sale_products( $defaults ) {
		$defaults = apply_filters( 'storefront_on_sale_products_args', array(
			'limit' 			=> 4,
			'columns' 			=> 4,
			'title'				=> __( 'On Sale', 'storefront' ),
			) );

		echo '<section class="storefront-product-section">';

		echo '<h2 class="section-title">' . $defaults['title'] . '</h2>';
		echo do_shortcode( '[sale_products per_page="' . $defaults['limit'] . '" columns="' . $defaults['columns'] . '"]' );

		echo '</section>';
	}
}

if ( ! function_exists( 'storefront_page_content' ) ) {
	/**
	 * Display page content
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return  void
	 */
	function storefront_page_content() {
		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'page' );

		endwhile; // end of the loop.
	}
}