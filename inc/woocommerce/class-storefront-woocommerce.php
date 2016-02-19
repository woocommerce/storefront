<?php
/**
 * Storefront WooCommerce Class
 *
 * @package  storefront
 * @author   WooThemes
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Storefront_WooCommerce' ) ) :

	/**
	 * The Storefront WooCommerce Integration class
	 */
	class Storefront_WooCommerce {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_filter( 'loop_shop_columns', 						array( $this, 'loop_columns' ) );
			add_filter( 'body_class', 								array( $this, 'woocommerce_body_class' ) );
			add_action( 'wp_enqueue_scripts', 						array( $this, 'woocommerce_scripts' ),	20 );
			add_filter( 'woocommerce_enqueue_styles', 				'__return_empty_array' );
			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
			add_filter( 'woocommerce_product_thumbnails_columns', 	array( $this, 'thumbnail_columns' ) );
			add_filter( 'loop_shop_per_page', 						array( $this, 'products_per_page' ) );

			if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.5', '<' ) ) {
				add_action( 'wp_footer', 							array( $this, 'star_rating_script' ) );
			}

			// Integrations.
			add_action( 'wp_enqueue_scripts', 						array( $this, 'woocommerce_integrations_scripts' ) );
			add_action( 'wp_enqueue_scripts', 						array( $this, 'add_integrations_customizer_css' ) );
		}

		/**
		 * Default loop columns on product archives
		 *
		 * @return integer products per row
		 * @since  1.0.0
		 */
		public function loop_columns() {
			return apply_filters( 'storefront_loop_columns', 3 ); // 3 products per row
		}

		/**
		 * Add 'woocommerce-active' class to the body tag
		 *
		 * @param  array $classes css classes applied to the body tag.
		 * @return array $classes modified to include 'woocommerce-active' class
		 */
		public function woocommerce_body_class( $classes ) {
			if ( is_woocommerce_activated() ) {
				$classes[] = 'woocommerce-active';
			}

			return $classes;
		}

		/**
		 * WooCommerce specific scripts & stylesheets
		 *
		 * @since 1.0.0
		 */
		public function woocommerce_scripts() {
			global $storefront_version;

			wp_enqueue_style( 'storefront-woocommerce-style', get_template_directory_uri() . '/assets/sass/woocommerce/woocommerce.css', $storefront_version );
			wp_style_add_data( 'storefront-woocommerce-style', 'rtl', 'replace' );

			wp_register_script( 'storefront-sticky-payment', get_template_directory_uri() . '/assets/js/woocommerce/checkout.min.js', 'jquery', $storefront_version, true );

			if ( is_checkout() ) {
				wp_enqueue_script( 'storefront-sticky-payment' );
			}
		}

		/**
		 * Star rating backwards compatibility script (WooCommerce <2.5).
		 *
		 * @since 1.6.0
		 */
		public function star_rating_script() {
			if ( wp_script_is( 'jquery', 'done' ) && is_product() ) {
		?>
			<script type="text/javascript">
				jQuery( function( $ ) {
					$( 'body' ).on( 'click', '#respond p.stars a', function() {
						var $container = $( this ).closest( '.stars' );
						$container.addClass( 'selected' );
					});
				});
			</script>
		<?php
			}
		}

		/**
		 * Related Products Args
		 *
		 * @param  array $args related products args.
		 * @since 1.0.0
		 * @return  array $args related products args
		 */
		public function related_products_args( $args ) {
			$args = apply_filters( 'storefront_related_products_args', array(
				'posts_per_page' => 3,
				'columns'        => 3,
			) );

			return $args;
		}

		/**
		 * Product gallery thumnail columns
		 *
		 * @return integer number of columns
		 * @since  1.0.0
		 */
		public function thumbnail_columns() {
			return intval( apply_filters( 'storefront_product_thumbnail_columns', 4 ) );
		}

		/**
		 * Products per page
		 *
		 * @return integer number of products
		 * @since  1.0.0
		 */
		public function products_per_page() {
			return intval( apply_filters( 'storefront_products_per_page', 12 ) );
		}

		/**
		 * Query WooCommerce Extension Activation.
		 *
		 * @param string $extension Extension class name.
		 * @return boolean
		 */
		public function is_woocommerce_extension_activated( $extension = 'WC_Bookings' ) {
			return class_exists( $extension ) ? true : false;
		}

		/**
		 * Integration Styles & Scripts
		 *
		 * @return void
		 */
		public function woocommerce_integrations_scripts() {
			/**
			 * Bookings
			 */
			if ( $this->is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-bookings-style', get_template_directory_uri() . '/assets/sass/woocommerce/bookings.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-bookings-style', 'rtl', 'replace' );
			}

			/**
			 * Brands
			 */
			if ( $this->is_woocommerce_extension_activated( 'WC_Brands' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-brands-style', get_template_directory_uri() . '/assets/sass/woocommerce/brands.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-brands-style', 'rtl', 'replace' );
			}

			/**
			 * Wishlists
			 */
			if ( $this->is_woocommerce_extension_activated( 'WC_Wishlists_Wishlist' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-wishlists-style', get_template_directory_uri() . '/assets/sass/woocommerce/wishlists.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-wishlists-style', 'rtl', 'replace' );
			}

			/**
			 * AJAX Layered Nav
			 */
			if ( $this->is_woocommerce_extension_activated( 'SOD_Widget_Ajax_Layered_Nav' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-ajax-layered-nav-style', get_template_directory_uri() . '/assets/sass/woocommerce/ajax-layered-nav.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-ajax-layered-nav-style', 'rtl', 'replace' );
			}

			/**
			 * Variation Swatches
			 */
			if ( $this->is_woocommerce_extension_activated( 'WC_SwatchesPlugin' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-variation-swatches-style', get_template_directory_uri() . '/assets/sass/woocommerce/variation-swatches.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-variation-swatches-style', 'rtl', 'replace' );
			}

			/**
			 * Composite Products
			 */
			if ( $this->is_woocommerce_extension_activated( 'WC_Composite_Products' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-composite-products-style', get_template_directory_uri() . '/assets/sass/woocommerce/composite-products.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-composite-products-style', 'rtl', 'replace' );
			}

			/**
			 * WooCommerce Photography
			 */
			if ( $this->is_woocommerce_extension_activated( 'WC_Photography' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-photography-style', get_template_directory_uri() . '/assets/sass/woocommerce/photography.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-photography-style', 'rtl', 'replace' );
			}

			/**
			 * Product Reviews Pro
			 */
			if ( $this->is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-product-reviews-pro-style', get_template_directory_uri() . '/assets/sass/woocommerce/product-reviews-pro.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-product-reviews-pro-style', 'rtl', 'replace' );
			}

			/**
			 * WooCommerce Smart Coupons
			 */
			if ( $this->is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-smart-coupons-style', get_template_directory_uri() . '/assets/sass/woocommerce/smart-coupons.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-smart-coupons-style', 'rtl', 'replace' );
			}

			/**
			 * WooCommerce Deposits
			 */
			if ( $this->is_woocommerce_extension_activated( 'WC_Deposits' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-deposits-style', get_template_directory_uri() . '/assets/sass/woocommerce/deposits.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-deposits-style', 'rtl', 'replace' );
			}

			/**
			 * WooCommerce Product Bundles
			 */
			if ( $this->is_woocommerce_extension_activated( 'WC_Bundles' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-bundles-style', get_template_directory_uri() . '/assets/sass/woocommerce/bundles.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-bundles-style', 'rtl', 'replace' );
			}

			/**
			 * WooCommerce Multiple Shipping Addresses
			 */
			if ( $this->is_woocommerce_extension_activated( 'WC_Ship_Multiple' ) ) {
				wp_enqueue_style( 'storefront-woocommerce-sma-style', get_template_directory_uri() . '/assets/sass/woocommerce/ship-multiple-addresses.css', 'storefront-woocommerce-style' );
				wp_style_add_data( 'storefront-woocommerce-sma-style', 'rtl', 'replace' );
			}
		}

		/**
		 * Add CSS in <head> for integration styles handled by the theme customizer
		 *
		 * @since 1.0
		 */
		public function add_integrations_customizer_css() {
			$accent_color 					= get_theme_mod( 'storefront_accent_color', apply_filters( 'storefront_default_accent_color', '#FFA107' ) );
			$header_text_color 				= get_theme_mod( 'storefront_header_text_color', apply_filters( 'storefront_default_header_text_color', '#9aa0a7' ) );
			$header_background_color 		= get_theme_mod( 'storefront_header_background_color', apply_filters( 'storefront_default_header_background_color', '#2c2d33' ) );
			$text_color 					= get_theme_mod( 'storefront_text_color', apply_filters( 'storefront_default_text_color', '#60646c' ) );
			$button_background_color 		= get_theme_mod( 'storefront_button_background_color', apply_filters( 'storefront_default_button_background_color', '#60646c' ) );
			$button_text_color 				= get_theme_mod( 'storefront_button_text_color', apply_filters( 'storefront_default_button_text_color', '#ffffff' ) );

			$woocommerce_style 				= '';

			if ( $this->is_woocommerce_extension_activated( 'WC_Bookings' ) ) {
				$woocommerce_style 					.= '
				#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a,
				#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.bookable a:hover,
				#wc-bookings-booking-form .block-picker li a:hover,
				#wc-bookings-booking-form .block-picker li a.selected {
					background-color: ' . $accent_color . ' !important;
				}

				#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker td.ui-state-disabled .ui-state-default,
				#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker th {
					color:' . $text_color . ';
				}

				#wc-bookings-booking-form .wc-bookings-date-picker .ui-datepicker-header {
					background-color: ' . $header_background_color . ';
					color: ' . $header_text_color . ';
				}';
			}

			if ( $this->is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' ) ) {
				$woocommerce_style 					.= '
				.woocommerce #reviews .product-rating .product-rating-details table td.rating-graph .bar,
				.woocommerce-page #reviews .product-rating .product-rating-details table td.rating-graph .bar {
					background-color: ' . $text_color . ' !important;
				}

				.woocommerce #reviews .contribution-actions .feedback,
				.woocommerce-page #reviews .contribution-actions .feedback,
				.star-rating-selector:not(:checked) label.checkbox {
					color: ' . $text_color . ';
				}

				.woocommerce #reviews #comments ol.commentlist li .contribution-actions a,
				.woocommerce-page #reviews #comments ol.commentlist li .contribution-actions a,
				.star-rating-selector:not(:checked) input:checked ~ label.checkbox,
				.star-rating-selector:not(:checked) label.checkbox:hover ~ label.checkbox,
				.star-rating-selector:not(:checked) label.checkbox:hover,
				.woocommerce #reviews #comments ol.commentlist li .contribution-actions a,
				.woocommerce-page #reviews #comments ol.commentlist li .contribution-actions a,
				.woocommerce #reviews .form-contribution .attachment-type:not(:checked) label.checkbox:before,
				.woocommerce-page #reviews .form-contribution .attachment-type:not(:checked) label.checkbox:before {
					color: ' . $accent_color . ' !important;
				}';
			}

			if ( $this->is_woocommerce_extension_activated( 'WC_Smart_Coupons' ) ) {
				$woocommerce_style 					.= '
				.coupon-container {
					background-color: ' . $button_background_color . ' !important;
				}

				.coupon-content {
					border-color: ' . $button_text_color . ' !important;
					color: ' . $button_text_color . ';
				}

				.sd-buttons-transparent.woocommerce .coupon-content,
				.sd-buttons-transparent.woocommerce-page .coupon-content {
					border-color: ' . $button_background_color . ' !important;
				}';
			}

			wp_add_inline_style( 'storefront-style', $woocommerce_style );
		}
	}

endif;

return new Storefront_WooCommerce();
