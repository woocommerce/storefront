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

if ( ! class_exists( 'Storefront_NUX_Admin_Inbox_Messages_Customize' ) ) :
	/**
	 * The initial Storefront inbox Message.
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
			$note = new Note();
			$note->set_title( __( 'Design your store with Storefront 🎨', 'storefront' ) );
			$note->set_content( __( 'Visit the Storefront settings page to start setup and customization of your shop.', 'storefront' ) );
			$note->set_type( Note::E_WC_ADMIN_NOTE_INFORMATIONAL );
			$note->set_name( self::NOTE_NAME );
			$note->set_content_data( (object) array() );
			$note->set_source( 'storefront' );
			$note->add_action(
				'customize-store-with-storefront',
				__( 'Let\'s go!', 'storefront' ),
				admin_url( 'themes.php?page=storefront-welcome' ),
				Note::E_WC_ADMIN_NOTE_ACTIONED,
				true
			);
			return $note;
		}
	}
endif;
