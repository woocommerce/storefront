<?php
/**
 * WC_PRL_Location_Shop class
 *
 * @author   SomewhereWarm <info@somewherewarm.gr>
 * @package  WooCommerce Product Recommendations
 * @since    2.5.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Locations that are used only in cart context.
 *
 * @class    WC_PRL_Location_Storefront_Homepage
 * @version  2.5.1
 */
class WC_PRL_Location_Storefront_Homepage extends WC_PRL_Location {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id       = 'storefront_homepage';
		$this->title    = __( 'Homepage', 'woocommerce-product-recommendations' );
		$this->defaults = array(
			'engine_type' => array( 'cart' ),
			'priority'    => 10,
			'args_number' => 0
		);

		parent::__construct();
	}

	/**
	 * Check if the current location page is active.
	 *
	 * @return boolean
	 */
	public function is_active() {
		return is_front_page();
	}

	/**
	 * Setup all supported hooks based on the location id.
	 *
	 * @return void
	 */
	protected function setup_hooks() {
		$this->hooks = array(
			'homepage' => array(
				'id'       => 'homepage',
				'label'    => __( 'Homepage', 'woocommerce-product-recommendations' ),
				'priority' => 15,
			)
		);
	}
}
