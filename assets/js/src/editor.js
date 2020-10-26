/**
 * Block editor enhancements.
 *
 * Contains functionality to dynamically update the block editor
 * configuration and styling.
 */

// First class for WP<=5.3 and second class for WP>=5.4.
const editorWrapperSelector = '.editor-writing-flow, .block-editor-writing-flow';

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
		const settings = wp.data.select( 'core/editor' ).getEditorSettings();

		if ( settings.hasOwnProperty( 'mainSidebarActive' ) && settings.mainSidebarActive ) {
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
	 * Update editor wide support.
	 *
	 * @param {boolean} alignWide Whether the editor supports
	 *                            alignWide support.
	 *
	 * @return {void}
	 */
	const updateWideSupport = ( alignWide ) => {
		wp.data.dispatch( 'core/block-editor' ).updateSettings( { 'alignWide': !! alignWide } );
	};

	/**
	 * Add custom class to editor wrapper if main sidebar is active.
	 *
	 * @param {boolean} hasSidebar Whether to add custom class.
	 *
	 * @return {void}
	 */
	const toggleCustomSidebarClass = ( hasSidebar ) => {
		const editorWrapper = document.querySelector( editorWrapperSelector );

		if ( ! editorWrapper ) {
			return;
		}

		if ( hasSidebar ) {
			editorWrapper.classList.add( 'storefront-has-sidebar' );
		} else {
			editorWrapper.classList.remove( 'storefront-has-sidebar' );
		}
	};

	/**
	 * Update editor and blocks when layout changes.
	 *
	 * @return {void}
	 */
	const maybeUpdateEditor = ( pageTemplate, sidebarActive ) => {
		const hasSidebar = 'template-fullwidth.php' !== pageTemplate && sidebarActive;
		updateWideSupport( ! hasSidebar );
		toggleCustomSidebarClass( hasSidebar );
	};

	wp.domReady( () => {
		const observer = new MutationObserver( ( mutationsList, observer ) => {
			if ( ! document.querySelector( editorWrapperSelector ) ) {
				return;
			}

			let pageTemplate = getCurrentPageTemplate();
			let sidebarActive = sidebarIsActive();
			maybeUpdateEditor( pageTemplate, sidebarActive );

			wp.data.subscribe( () => {
				const newPageTemplate = getCurrentPageTemplate();
				const newSidebarActive = sidebarIsActive();
				if ( newPageTemplate !== pageTemplate || newSidebarActive !== sidebarActive ) {
					pageTemplate = newPageTemplate;
					sidebarActive = newSidebarActive;

					maybeUpdateEditor( pageTemplate, sidebarActive );
				}
			} );

			observer.disconnect();
		} );

		const targetNode = document.querySelector( '.block-editor__container' );
		const config = { childList: true, subtree: true };
		observer.observe(targetNode, config);
	} );
} )();
