<?php
/**
 * storefront Theme Customizer
 *
 * @package storefront
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since  1.0.0
 */
if ( ! function_exists( 'storefront_customize_register' ) ) {
	function storefront_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		$wp_customize->get_section( 'colors' )->description 		= __( 'Adjust the general Storefront color scheme.', 'storefront' );

		/**
		 * Accent Color
		 */
		$wp_customize->add_setting( 'storefront_accent_color', array(
	        'default'           => apply_filters( 'storefront_default_accent_color', '#a46497' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_accent_color', array(
	        'label'	   => 'Link / accent color',
	        'section'  => 'colors',
	        'settings' => 'storefront_accent_color',
	        'priority' => 20,
	    ) ) );

	    /**
	     * Text color
	     */
	    $wp_customize->add_setting( 'storefront_text_color', array(
	        'default'           => apply_filters( 'storefront_default_text_color', '#424a4c' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	        'transport'			=> 'postMessage',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_text_color', array(
	        'label'	   => 'Text color',
	        'section'  => 'colors',
	        'settings' => 'storefront_text_color',
	        'priority' => 30,
	    ) ) );

	    /**
	     * Heading color
	     */
	    $wp_customize->add_setting( 'storefront_heading_color', array(
	        'default'           => apply_filters( 'storefront_default_heading_color', '#2c2d33' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	        'transport'			=> 'postMessage',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_heading_color', array(
	        'label'	   => 'Heading color',
	        'section'  => 'colors',
	        'settings' => 'storefront_heading_color',
	        'priority' => 40,
	    ) ) );

	    /**
	     * Header section
	     */
	    $wp_customize->add_section( 'storefront_header' , array(
		    'title'      	=> __( 'Header', 'storefront' ),
		    'priority'   	=> 30,
		    'description' 	=> __( 'Customise the look & feel of your web site header.', 'storefront' ),
		) );

		/**
	     * Header text color
	     */
	    $wp_customize->add_setting( 'storefront_header_text_color', array(
	        'default'           => apply_filters( 'storefront_default_header_text_color', '#5a6567' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	        'transport'			=> 'postMessage',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_header_text_color', array(
	        'label'	   => 'Text color',
	        'section'  => 'storefront_header',
	        'settings' => 'storefront_header_text_color',
	    ) ) );

	    /**
	     * Header link color
	     */
	    $wp_customize->add_setting( 'storefront_header_link_color', array(
	        'default'           => apply_filters( 'storefront_default_header_link_color', '#ffffff' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	        'transport'			=> 'postMessage',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_header_link_color', array(
	        'label'	   => 'Link color',
	        'section'  => 'storefront_header',
	        'settings' => 'storefront_header_link_color',
	    ) ) );

	    /**
	     * Header Background
	     */
	    $wp_customize->add_setting( 'storefront_header_background_color', array(
	        'default'           => apply_filters( 'storefront_default_header_background_color', '#2c2d33' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	        'transport'			=> 'postMessage',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_header_background_color', array(
	        'label'	   => 'Background color',
	        'section'  => 'storefront_header',
	        'settings' => 'storefront_header_background_color',
	    ) ) );

	    /**
	     * Footer section
	     */
	    $wp_customize->add_section( 'storefront_footer' , array(
		    'title'      	=> __( 'Footer', 'storefront' ),
		    'priority'   	=> 40,
		    'description' 	=> __( 'Customise the look & feel of your web site footer.', 'storefront' ),
		) );

		/**
	     * Footer heading color
	     */
	    $wp_customize->add_setting( 'storefront_footer_heading_color', array(
	        'default'           => apply_filters( 'storefront_default_footer_heading_color', '#646c6e' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	        'transport' 		=> 'postMessage',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_footer_heading_color', array(
	        'label'	   	=> 'Heading color',
	        'section'  	=> 'storefront_footer',
	        'settings' 	=> 'storefront_footer_heading_color',
	    ) ) );

		/**
	     * Footer text color
	     */
	    $wp_customize->add_setting( 'storefront_footer_text_color', array(
	        'default'           => apply_filters( 'storefront_default_footer_text_color', '#a8b0b2' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	        'transport'			=> 'postMessage',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_footer_text_color', array(
	        'label'	   => 'Text color',
	        'section'  => 'storefront_footer',
	        'settings' => 'storefront_footer_text_color',
	    ) ) );

	    /**
	     * Footer link color
	     */
	    $wp_customize->add_setting( 'storefront_footer_link_color', array(
	        'default'           => apply_filters( 'storefront_default_footer_link_color', '#a46497' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	        'transport'			=> 'postMessage',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_footer_link_color', array(
	        'label'	   => 'Link color',
	        'section'  => 'storefront_footer',
	        'settings' => 'storefront_footer_link_color',
	    ) ) );

	    /**
	     * Footer Background
	     */
	    $wp_customize->add_setting( 'storefront_footer_background_color', array(
	        'default'           => apply_filters( 'storefront_default_footer_background_color', '#f3f3f3' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	        'transport'			=> 'postMessage',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_footer_background_color', array(
	        'label'	   => 'Background color',
	        'section'  => 'storefront_footer',
	        'settings' => 'storefront_footer_background_color',
	    ) ) );

	    /**
	     * Buttons section
	     */
	    $wp_customize->add_section( 'storefront_buttons' , array(
		    'title'      	=> __( 'Buttons', 'storefront' ),
		    'priority'   	=> 45,
		    'description' 	=> __( 'Customise the look & feel of your web site buttons.', 'storefront' ),
		) );

		/**
	     * Button background color
	     */
	    $wp_customize->add_setting( 'storefront_button_background_color', array(
	        'default'           => apply_filters( 'storefront_default_button_background_color', '#424a4c' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_button_background_color', array(
	        'label'	   => 'Background color',
	        'section'  => 'storefront_buttons',
	        'settings' => 'storefront_button_background_color',
	        'priority' => 10,
	    ) ) );

	    /**
	     * Button text color
	     */
	    $wp_customize->add_setting( 'storefront_button_text_color', array(
	        'default'           => apply_filters( 'storefront_default_button_text_color', '#ffffff' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_button_text_color', array(
	        'label'	   => 'Text color',
	        'section'  => 'storefront_buttons',
	        'settings' => 'storefront_button_text_color',
	        'priority' => 20,
	    ) ) );

	    /**
	     * Button alt background color
	     */
	    $wp_customize->add_setting( 'storefront_button_alt_background_color', array(
	        'default'           => apply_filters( 'storefront_default_button_alt_background_color', '#a46497' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_button_alt_background_color', array(
	        'label'	   => 'Alternate button background color',
	        'section'  => 'storefront_buttons',
	        'settings' => 'storefront_button_alt_background_color',
	        'priority' => 30,
	    ) ) );

	    /**
	     * Button alt text color
	     */
	    $wp_customize->add_setting( 'storefront_button_alt_text_color', array(
	        'default'           => apply_filters( 'storefront_default_button_alt_text_color', '#ffffff' ),
	        'sanitize_callback' => 'storefront_sanitize_hex_color',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'storefront_button_alt_text_color', array(
	        'label'	   => 'Alternate button text color',
	        'section'  => 'storefront_buttons',
	        'settings' => 'storefront_button_alt_text_color',
	        'priority' => 40,
	    ) ) );

	    /**
	     * Layout
	     */
	    $wp_customize->add_section( 'storefront_layout' , array(
		    'title'      	=> __( 'Layout', 'storefront' ),
		    'priority'   	=> 50,
		    'description' 	=> __( 'Customise the web site layout', 'storefront' ),
		) );
	    $wp_customize->add_setting( 'storefront_layout', array(
            'default'    => 'right',
        ) );
        $wp_customize->add_control( 'storefront_layout', array(
				'label'    => __( 'Sidebar position', 'mytheme' ),
				'section'  => 'storefront_layout',
				'settings' => 'storefront_layout',
				'type'     => 'radio',
				'choices'  => array(
					'right' => 'Right',
					'left'  => 'Left',
				),
			)
		);
	}
}
add_action( 'customize_register', 'storefront_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'storefront_customize_preview_js' ) ) {
	function storefront_customize_preview_js() {
		wp_enqueue_script( 'storefront_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.6', true );
	}
}
add_action( 'customize_preview_init', 'storefront_customize_preview_js' );

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
		if ( '' === $color )
			return '';

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
			return $color;

		return null;
	}
}

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'storefront_add_customizer_css' ) ) {
	function storefront_add_customizer_css() {

		$accent_color 					= storefront_sanitize_hex_color( get_theme_mod( 'storefront_accent_color' ) );
		$header_background_color 		= storefront_sanitize_hex_color( get_theme_mod( 'storefront_header_background_color' ) );
		$header_link_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_header_link_color' ) );
		$header_text_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_header_text_color' ) );

		$footer_background_color 		= storefront_sanitize_hex_color( get_theme_mod( 'storefront_footer_background_color' ) );
		$footer_link_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_footer_link_color' ) );
		$footer_heading_color 			= storefront_sanitize_hex_color( get_theme_mod( 'storefront_footer_heading_color' ) );
		$footer_text_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_footer_text_color' ) );

		$text_color 					= storefront_sanitize_hex_color( get_theme_mod( 'storefront_text_color' ) );
		$heading_color 					= storefront_sanitize_hex_color( get_theme_mod( 'storefront_heading_color' ) );
		$button_background_color 		= storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_background_color' ) );
		$button_text_color 				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_text_color' ) );
		$button_alt_background_color 	= storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_alt_background_color' ) );
		$button_alt_text_color 			= storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_alt_text_color' ) );

		$brighten_factor 			= apply_filters( 'storefront_brighten_factor', 25 );
		$darken_factor 				= apply_filters( 'storefront_darken_factor', -25 );
		?>
		<!-- storefront customizer CSS -->
		<style>

			<?php if ( isset( $$accent_color ) ) { ?>
			a:hover {
				color: <?php echo storefront_adjust_color_brightness( $accent_color, $brighten_factor ); ?>;
			}
			<?php } ?>

			.main-navigation ul li a,
			.site-title a,
			a.cart-contents,
			.site-header-cart .widget_shopping_cart a,
			ul.menu li a {
				color: <?php echo $header_link_color; ?>;
			}

			<?php if ( isset( $header_link_color ) ) { ?>

			.main-navigation ul li a:hover,
			.site-title a:hover,
			a.cart-contents:hover,
			.site-header-cart .widget_shopping_cart a:hover {
				color: <?php echo storefront_adjust_color_brightness( $header_link_color, $darken_factor ); ?>;
			}

			<?php } ?>

			.site-header,
			.main-navigation ul ul,
			.secondary-navigation ul ul,
			.main-navigation ul.menu > li.menu-item-has-children:after,
			.site-header-cart .widget_shopping_cart,
			.secondary-navigation ul.menu ul {
				background-color: <?php echo $header_background_color; ?>;
			}

			p.site-description,
			ul.menu li.current-menu-item > a {
				color: <?php echo $header_text_color; ?>;
			}

			h1, h2, h3, h4, h5, h6 {
				color: <?php echo $heading_color; ?>;
			}

			.hentry .entry-header {
				border-color: <?php echo $heading_color; ?>;
			}

			.widget h1 {
				border-bottom-color: <?php echo $heading_color; ?>;
			}

			body,
			.secondary-navigation a,
			.woocommerce-tabs ul.tabs li.active a,
			ul.products li.product .price,
			.widget-area .widget a {
				color: <?php echo $text_color; ?>;
			}

			a,
			.star-rating span:before,
			.widget-area .widget a:hover,
			.product_list_widget a:hover,
			.quantity .plus, .quantity .minus,
			p.stars a:hover:after {
				color: <?php echo $accent_color; ?>;
			}

			.widget_price_filter .ui-slider .ui-slider-range {
				background-color: <?php echo $accent_color; ?>;
			}

			#order_review_heading, #order_review {
				border-color: <?php echo $accent_color; ?>;
			}

			button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart, .widget-area .widget a.button, .site-header-cart .widget_shopping_cart a.button {
				background-color: <?php echo $button_background_color; ?>;
				color: <?php echo $button_text_color; ?>;
			}

			button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .widget-area .widget a.button:hover, .site-header-cart .widget_shopping_cart a.button:hover {
				background-color: <?php echo storefront_adjust_color_brightness( $button_background_color, $darken_factor ); ?>;
				color: <?php echo $button_text_color; ?>;
			}

			button.alt, input[type="button"].alt, input[type="reset"].alt, input[type="submit"].alt, .button.alt, .added_to_cart.alt, .widget-area .widget a.button.alt, .added_to_cart {
				background-color: <?php echo $button_alt_background_color; ?>;
				color: <?php echo $button_alt_text_color; ?>;
			}

			button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover, .widget-area .widget a.button.alt:hover, .added_to_cart:hover {
				background-color: <?php echo storefront_adjust_color_brightness( $button_alt_background_color, $darken_factor ); ?>;
				color: <?php echo $button_alt_text_color; ?>;
			}

			.site-footer {
				background-color: <?php echo $footer_background_color; ?>;
				color: <?php echo $footer_text_color; ?>;
			}

			.site-footer a:not(.button) {
				color: <?php echo $footer_link_color; ?>;
			}

			.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {
				color: <?php echo $footer_heading_color; ?>;
			}

			@media screen and ( min-width: 768px ) {
				.main-navigation ul.menu > li > ul {
					border-top-color: <?php echo $header_background_color; ?>
				}

				<?php if ( isset( $header_link_color ) ) { ?>

				.secondary-navigation ul.menu a:hover {
					color: <?php echo storefront_adjust_color_brightness( $header_text_color, $brighten_factor ); ?>;
				}

				<?php } ?>

				.main-navigation ul.menu ul {
					background-color: <?php echo $header_background_color; ?>;
				}

				.secondary-navigation ul.menu a,
				.site-header-cart .widget_shopping_cart,
				.site-header .product_list_widget li .quantity {
					color: <?php echo $header_text_color; ?>;
				}
			}
		</style>
	<?php }
}
add_action( 'wp_head', 'storefront_add_customizer_css' );

/**
 * Layout classes
 * Adds 'right-sidebar' and 'left-sidebar' classes to the body tag
 * @param  array $classes current body classes
 * @return array          modified body classes
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
add_action( 'body_class', 'storefront_layout_class' );

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
    $steps = max( -255, min( 255, $steps ) );

    // Format the hex color string
    $hex = str_replace( '#', '', $hex );
    if ( strlen( $hex ) == 3 ) {
        $hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
    }

    // Get decimal values
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );

    // Adjust number of steps and keep it inside 0 to 255
    $r = max( 0, min( 255, $r + $steps ) );
    $g = max( 0, min( 255, $g + $steps ) );
    $b = max( 0, min( 255, $b + $steps ) );

    $r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
    $g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
    $b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

    return '#' . $r_hex . $g_hex . $b_hex;
}