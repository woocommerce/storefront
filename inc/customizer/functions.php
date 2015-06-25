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
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * HTML sanitization callback.
 *
 * - Sanitization: html
 * - Control: text, textarea
 *
 * Sanitization callback for 'html' type text inputs. This callback sanitizes `$html`
 * for HTML allowable in posts.
 *
 * NOTE: wp_filter_post_kses() can be passed directly as `$wp_customize->add_setting()`
 * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
 *
 * @see wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
 *
 * @param string $html HTML to sanitize.
 * @return string Sanitized HTML.
 * @since  1.5.0
 */
function storefront_sanitize_html( $html ) {
    return wp_filter_post_kses( $html );
}


/**
 * Image sanitization callback.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * - Sanitization: image file extension
 * - Control: text, WP_Customize_Image_Control
 *
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 * @since  1.5.0
 */
function storefront_sanitize_image( $image, $setting ) {
    /*
     * Array of valid image file types.
     *
     * The array includes image mime types that are included in wp_get_mime_types()
     */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
    // Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
    // If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}


/**
 * Number sanitization callback.
 *
 * - Sanitization: number_absint
 * - Control: number
 *
 * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
 * as an absolute integer (whole number, zero or greater).
 *
 * NOTE: absint() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
 * It is wrapped in a callback here merely for example purposes.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int Sanitized number; otherwise, the setting default.
 * @since  1.5.0
 */
function storefront_sanitize_number_absint( $number, $setting ) {
    // Ensure $number is an absolute integer (whole number, zero or greater).
    $number = absint( $number );

    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
}

/**
 * URL sanitization callback.
 *
 * - Sanitization: url
 * - Control: text, url
 *
 * Sanitization callback for 'url' type text inputs. This callback sanitizes `$url` as a valid URL.
 *
 * NOTE: esc_url_raw() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
 * It is wrapped in a callback here merely for example purposes.
 *
 * @see esc_url_raw() https://developer.wordpress.org/reference/functions/esc_url_raw/
 *
 * @param string $url URL to sanitize.
 * @return string Sanitized URL.
 * @since  1.5.0
 */
function storefront_sanitize_url( $url ) {
    return esc_url_raw( $url );
}

/**
 * Layout classes
 * Adds 'right-sidebar' and 'left-sidebar' classes to the body tag
 * @param  array $classes current body classes
 * @return string[]          modified body classes
 * @since  1.0.0
 */
function storefront_layout_class( $classes ) {
	$layout = get_theme_mod( 'storefront_layout' );

	if ( '' == $layout ) {
		$layout = 'right';
	}

	$classes[] = $layout . '-sidebar';

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