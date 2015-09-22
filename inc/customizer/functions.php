<?php
/**
 * storefront Theme Customizer functions
 *
 * @package storefront
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'storefront_customize_preview_js' ) ) {
	function storefront_customize_preview_js() {
		wp_enqueue_script( 'storefront_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.min.js', array( 'customize-preview' ), '1.15', true );
	}
}

/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'storefront_sanitize_hex_color' ) ) {
	function storefront_sanitize_hex_color( $color ) {
		if ( '' === $color ) {
			return '';
        }

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			return $color;
        }

		return null;
	}
}

/**
 * Sanitizes choices (selects / radios)
 * Checks that the input matches one of the available choices
 *
 * @since  1.3.0
 */
if ( ! function_exists( 'storefront_sanitize_choices' ) ) {
    function storefront_sanitize_choices( $input, $setting ) {
        // Ensure input is a slug.
        $input = sanitize_key( $input );

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
}

/**
 * Sanitizes the layout setting
 *
 * Ensures only array keys matching the original settings specified in add_control() are valid
 *
 * @since 1.0.3
 */
if ( ! function_exists( 'storefront_sanitize_layout' ) ) {
    function storefront_sanitize_layout( $input ) {
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
    return (bool) $checked;
}

/**
 * Layout classes
 * Adds 'right-sidebar' and 'left-sidebar' classes to the body tag
 * @param  array $classes current body classes
 * @return string[]          modified body classes
 * @since  1.0.0
 */
function storefront_layout_class( $classes ) {
	$left_or_right = get_theme_mod( 'storefront_layout', apply_filters( 'storefront_default_layout', $layout = is_rtl() ? 'left' : 'right' ) );

	$classes[] = $left_or_right . '-sidebar';

	return $classes;
}

/**
 * Adjust a hex color brightness
 * Allows us to create hover styles for custom link colors
 * @param  strong $hex   hex color e.g. #111111
 * @param  integer $steps factor by which to brighten/darken ranging from -255 (darken) to 255 (brighten)
 * @return string        brightened/darkened hex color
 * @since  1.0.0
 */
function storefront_adjust_color_brightness( $hex, $steps ) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps  = max( -255, min( 255, $steps ) );

    // Format the hex color string
    $hex    = str_replace( '#', '', $hex );

    if ( 3 == strlen( $hex ) ) {
        $hex    = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
    }

    // Get decimal values
    $r  = hexdec( substr( $hex, 0, 2 ) );
    $g  = hexdec( substr( $hex, 2, 2 ) );
    $b  = hexdec( substr( $hex, 4, 2 ) );

    // Adjust number of steps and keep it inside 0 to 255
    $r  = max( 0, min( 255, $r + $steps ) );
    $g  = max( 0, min( 255, $g + $steps ) );
    $b  = max( 0, min( 255, $b + $steps ) );

    $r_hex  = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
    $g_hex  = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
    $b_hex  = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

    return '#' . $r_hex . $g_hex . $b_hex;
}

/**
 * Add CSS for custom controls
 *
 * This function incorporates CSS from the Kirki Customizer Framework
 *
 * The Kirki Customizer Framework, Copyright Aristeides Stathopoulos (@aristath),
 * is licensed under the terms of the GNU GPL, Version 2 (or later)
 *
 * @link https://github.com/reduxframework/kirki/
 * @since  1.5.0
 */
function storefront_customizer_custom_control_css() {
    ?>
    <style>
    .customize-control-radio-image .image.ui-buttonset input[type=radio] {
        height: auto;
    }
    .customize-control-radio-image .image.ui-buttonset label {
        display: inline-block;
        width: 48%;
        padding: 1%;
        box-sizing: border-box;
    }
    .customize-control-radio-image .image.ui-buttonset label.ui-state-active {
        background: none;
    }
    .customize-control-radio-image .customize-control-radio-buttonset label {
        background: #f7f7f7;
        line-height: 35px;
    }
    .customize-control-radio-image label img {
        opacity: 0.5;
    }
    #customize-controls .customize-control-radio-image label img {
        height: auto;
    }
    .customize-control-radio-image label.ui-state-active img {
        background: #dedede;
        opacity: 1;
    }
    .customize-control-radio-image label.ui-state-hover img {
        opacity: 1;
        box-shadow: 0 0 0 3px #f6f6f6;
    }
    </style>
    <?php
}
