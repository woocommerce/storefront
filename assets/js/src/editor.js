/**
 * Block editor enhancements.
 *
 * Contains functionality to dynamically update the block editor
 * configuration and styling.
 */

( function() {

	/**
	 * Check if the main sidebar is active (has widgets).
	 *
	 * This uses a custom property `mainSidebarActive` added via the
	 * `block_editor_settings` filter.
	 *
	 * @return {boolean} Whether sidebar is active.
	 */
	const sidebarIsActive = () => {
		let settings = wp.data.select( 'core/editor' ).getEditorSettings();

		if ( settings.hasOwnProperty( 'mainSidebarActive' ) && !! settings.mainSidebarActive ) {
			return true;
		}

		return false;
	};

	/**
	 * Get current page template name.
	 *
	 * @return {string} The page template name.
	 */
	const getCurrentPageTemplate = () => {
		return wp.data.select( 'core/editor' ).getEditedPostAttribute( 'template' );
	};

	/**
	 * Check if the active theme supports a wide layout.
	 *
	 * @return {boolean} Whether the theme supports wide layout.
	 */
	const themeSupportsWide = () => {
		let settings = wp.data.select( 'core/editor' ).getEditorSettings();

		if ( settings.hasOwnProperty( 'alignWide' ) && !! settings.alignWide ) {
			return true;
		}

		return false;
	};

	/**
	 * Update editor wide support.
	 *
	 * @param {boolean} alignWide Whether to enable or disable
	 *                            alignWide support.
	 *
	 * @return {void}
	 */
	const updateWideSupport = ( alignWide ) => {
		wp.data.dispatch( 'core/editor' ).updateEditorSettings( { 'alignWide': !! alignWide } );
	};

	/**
	 * Update blocks to remove alignWide support.
	 *
	 * @return {void}
	 */
	const removeWideAlignFromBlocks = () => {
		let blocks = wp.data.select( 'core/editor' ).getBlocks();

		blocks.forEach( ( block ) => {
			let align = '';

			if ( block.attributes.hasOwnProperty( 'align' ) ) {
				align = block.attributes.align;
			}

			if ( 'full' === align || 'wide' === align ) {
				wp.data.dispatch( 'core/editor' ).updateBlockAttributes( block.clientId, { 'align': '' } );
			}
		} );
	};

	/**
	 * Add custom class to editor wrapper if main sidebar is active.
	 *
	 * @param {boolean} showSidebar Whether to add custom class.
	 *
	 * @return {void}
	 */
	const toggleCustomSidebarClass = ( showSidebar ) => {
		let editorWrapper = document.getElementsByClassName( 'editor-writing-flow' );

		if ( ! editorWrapper.length ) {
			return;
		}

		if ( !! showSidebar ) {
			editorWrapper[0].classList.add( 'storefront-has-sidebar' );
		} else {
			editorWrapper[0].classList.remove( 'storefront-has-sidebar' );
		}
	};

	/**
	 * Update editor and blocks when layout changes.
	 *
	 * @return {void}
	 */
	const maybeUpdateEditor = () => {
		if ( 'template-fullwidth.php' === getCurrentPageTemplate() ) {
			updateWideSupport( true );
			toggleCustomSidebarClass( false );
		} else if ( sidebarIsActive() ) {
			updateWideSupport( false );
			removeWideAlignFromBlocks();
			toggleCustomSidebarClass( true );
		} else {
			updateWideSupport( true );
			toggleCustomSidebarClass( false );
		}
	};

	wp.domReady( () => {

		// Don't do anything if the theme doesn't declare support for `align-wide`.
		if ( ! themeSupportsWide() ) {
			return;
		}

		maybeUpdateEditor();

		let pageTemplate = getCurrentPageTemplate();

		wp.data.subscribe( () => {
			if ( getCurrentPageTemplate() !== pageTemplate ) {
				pageTemplate = getCurrentPageTemplate();

				maybeUpdateEditor();
			}
		} );
	} );
} )();
