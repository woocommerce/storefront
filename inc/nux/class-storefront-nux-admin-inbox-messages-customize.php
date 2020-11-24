<?php
/**
 * Storefront NUX Admin Inbox Messages.
 *
 * @package  storefront
 * @since    3.0.0
 */

use Automattic\WooCommerce\Admin\Notes\Note;
use Automattic\WooCommerce\Admin\Notes\NoteTraits;

defined( 'ABSPATH' ) || exit;

/**
 * The initial Storefron inbox Message.
 */
class Storefront_NUX_Admin_Inbox_Messages_Customize {

	use NoteTraits;

	/**
	 * Name of the note for use in the database.
	 */
	const NOTE_NAME = 'storefront-customize';

	/**
	 * Get the note.
	 *
	 * @return Note
	 */
	public static function get_note() {

		$action = '';
		if ( 'page' === get_option( 'show_on_front' ) ) {
			$action = __( 'Apply the Storefront homepage template', 'storefront' );
		} else {
			$action = __( 'Create a homepage using Storefront\'s homepage template', 'storefront' );
		}

		$note = new Note();
		$note->set_title( __( 'Design your store with Storefront🎨', 'storefront' ) );
		$note->set_content( __( 'You\'ve set up WooCommerce, now it\'s time to give it some style! Let\'s get started by entering the Customizer and adding your logo.', 'storefront' ) );
		$note->set_type( Note::E_WC_ADMIN_NOTE_INFORMATIONAL );
		$note->set_name( self::NOTE_NAME );
		$note->set_content_data( (object) array() );
		$note->set_source( 'storefront' );
		$note->add_action(
			'customize-store-with-storefront',
			__( 'Let\'s go!', 'storefront' ),
			self::get_customizer_url(),
			Note::E_WC_ADMIN_NOTE_ACTIONED,
			true
		);
		return $note;
	}


	/**
	 * Generate the url to the customizer.
	 *
	 * @return String customizer link.
	 */
	public static function get_customizer_url() {
		$args = array( 
			'sf_starter_content' => '1',
			'return'             => rawurlencode( admin_url( 'themes.php?page=storefront-welcome' ) )
		);
		return add_query_arg( $args, admin_url( 'customize.php' ) );
	}
}
