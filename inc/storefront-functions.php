<?php
/**
 * Storefront  functions.
 *
 * @package storefront
 */

/**
 * Query WooCommerce activation
 */
function is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Call a shortcode function by tag name.
 *
 * @since  1.4.6
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
function storefront_do_shortcode( $tag, array $atts = array(), $content = null ) {
	global $shortcode_tags;

	if ( ! isset( $shortcode_tags[ $tag ] ) ) {
		return false;
	}

	return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}

/**
 * Get the content background color
 * Accounts for the Storefront Designer's content background option.
 *
 * @since  1.6.0
 * @return string the background color
 */
function storefront_get_content_background_color() {
	// Set the bg color var based on whether the Storefront designer has set a content bg color or not.
	$content_bg_color = get_theme_mod( 'sd_content_background_color' );
	$content_frame    = get_theme_mod( 'sd_fixed_width' );

	// Set the bg color based on the default theme option.
	$bg_color = str_replace( '#', '', get_theme_mod( 'background_color' ) );

	// But if the Storefront Designer extension is active, and the content frame option is enabled we need that bg color instead.
	if ( $content_bg_color && 'true' == $content_frame && class_exists( 'Storefront_Designer' ) ) {
		$bg_color = str_replace( '#', '', $content_bg_color );
	}

	return '#' . $bg_color;
}

/**
 * Apply inline style to the Storefront header.
 *
 * @uses  get_header_image()
 * @since  2.0.0
 */
function storefront_header_styles() {
	$is_header_image = get_header_image();

	if ( $is_header_image ) {
		$header_bg_image = 'url(' . esc_url( $is_header_image ) . ')';
	} else {
		$header_bg_image = 'none';
	}

	$styles = apply_filters( 'storefront_header_styles', array(
		'background-image' => $header_bg_image,
	) );

	foreach ( $styles as $style => $value ) {
		echo esc_attr( $style . ': ' . $value . '; ' );
	}
}

/**
 * Adjust a hex color brightness
 * Allows us to create hover styles for custom link colors
 *
 * @param  strong  $hex   hex color e.g. #111111.
 * @param  integer $steps factor by which to brighten/darken ranging from -255 (darken) to 255 (brighten).
 * @return string        brightened/darkened hex color
 * @since  1.0.0
 */
function storefront_adjust_color_brightness( $hex, $steps ) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter.
	$steps  = max( -255, min( 255, $steps ) );

	// Format the hex color string.
	$hex    = str_replace( '#', '', $hex );

	if ( 3 == strlen( $hex ) ) {
		$hex    = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Get decimal values.
	$r  = hexdec( substr( $hex, 0, 2 ) );
	$g  = hexdec( substr( $hex, 2, 2 ) );
	$b  = hexdec( substr( $hex, 4, 2 ) );

	// Adjust number of steps and keep it inside 0 to 255.
	$r  = max( 0, min( 255, $r + $steps ) );
	$g  = max( 0, min( 255, $g + $steps ) );
	$b  = max( 0, min( 255, $b + $steps ) );

	$r_hex  = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
	$g_hex  = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
	$b_hex  = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

	return '#' . $r_hex . $g_hex . $b_hex;
}

/**
 * Sanitizes choices (selects / radios)
 * Checks that the input matches one of the available choices
 *
 * @param array $input the available choices.
 * @param array $setting the setting object.
 * @since  1.3.0
 */
function storefront_sanitize_choices( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Checkbox sanitization callback.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 * @since  1.5.0
 */
function storefront_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Schema type
 *
 * @return void
 */
function storefront_html_tag_schema() {
	_deprecated_function( 'storefront_html_tag_schema', '2.0.2' );

	$schema = 'http://schema.org/';
	$type   = 'WebPage';

	if ( is_singular( 'post' ) ) {
		$type = 'Article';
	} elseif ( is_author() ) {
		$type = 'ProfilePage';
	} elseif ( is_search() ) {
		$type 	= 'SearchResultsPage';
	}

	echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';
}

/**
 * Sanitizes the layout setting
 *
 * Ensures only array keys matching the original settings specified in add_control() are valid
 *
 * @param array $input the layout options.
 * @since 1.0.3
 */
function storefront_sanitize_layout( $input ) {
	_deprecated_function( 'storefront_sanitize_layout', '2.0', 'storefront_sanitize_choices' );

	$valid = array(
		'right' => 'Right',
		'left'  => 'Left',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Storefront Sanitize Hex Color
 *
 * @param string $color The color as a hex.
 * @todo remove in 2.1.
 */
function storefront_sanitize_hex_color( $color ) {
	_deprecated_function( 'storefront_sanitize_hex_color', '2.0', 'sanitize_hex_color' );

	if ( '' === $color ) {
		return '';
	}

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}

	return null;
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 * @todo remove in 2.1.
 */
function storefront_categorized_blog() {
	_deprecated_function( 'storefront_categorized_blog', '2.0' );

	if ( false === ( $all_the_cool_cats = get_transient( 'storefront_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );
		set_transient( 'storefront_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so storefront_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so storefront_categorized_blog should return false.
		return false;
	}
}
