<?php
/**
 * Storefront NUX Admin Inbox Noticess.
 *
 * @package  storefront
 * @since    3.0.0
 */


use Automattic\WooCommerce\Admin\Notes\Note;
use Automattic\WooCommerce\Admin\Notes\NoteTraits;

defined( 'ABSPATH' ) || exit;

class Storefront_NUX_Admin_Inbox_Messages_Customize_Example_Products {
		/**
	 * Note traits.
	 */
	use NoteTraits {
		possibly_add_note as trait_possibly_add_note;
	}

	/**
	 * Name of the note for use in the database.
	 */
	const NOTE_NAME = 'storefront-example-products';

	/**
	 * Get the note.
	 *
	 * @return Note
	 */
	public static function get_note() {

		$note = new Note();
		$note->set_title( __( 'Add example products', 'storefront' ) );
		$note->set_content( __( 'We can add some samples so you can see how a store with products looks like.'	, 'storefront' ) );
		$note->set_type( Note::E_WC_ADMIN_NOTE_INFORMATIONAL );
		$note->set_name( self::NOTE_NAME );
		$note->set_content_data( (object) array() );
		$note->set_source( 'storefront' );
		$note->add_action(
			'customize-store-with-storefront-add-products',
			__( 'Add Products 	', 'storefront' ),
			'https://woocommerce.com/posts/how-to-customize-your-online-store-with-woocommerce-blocks/?utm_source=inbox',
			Note::E_WC_ADMIN_NOTE_ACTIONED,
			true
		);
		return $note;
	}

	public static function possibly_add_note() {
		// if ( ! self::is_woocommerce_empty() ) {
		// 	return;
		// }
		self::trait_possibly_add_note();
	}

	public static function is_woocommerce_empty() {
		$products = wp_count_posts( 'product' );

		if ( 0 < $products->publish ) {
			return false;
		}

		return true;
	}


	/**
	 * Add the note if it passes predefined conditions.
	 */

	 ///WARNING delete after dev and use possibly_add_note.
	public static function force_note() {
		$note = self::get_note();

		$note->save();
	}
}
