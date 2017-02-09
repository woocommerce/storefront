/* global ajaxurl, storefrontNUX */
( function( wp, $ ) {
	'use strict';

	if ( ! wp ) {
		return;
	}

	var $document = $( document );

	// Set up our namespace.
	wp.storefront = wp.storefront || {};

	/**
	 * Sends an Ajax request to the server to install WooCommerce.
	 *
	 * @since 2.2
	 *
	 * @return {$.promise} A jQuery promise that represents the request,
	 *                     decorated with an abort() method.
	 */
	wp.storefront.installWooCommerce = function() {
		var $message = $( '.sf-notice-nux .sf-install-woocommerce' ), args;

		args = {
			slug:    'woocommerce',
			success: wp.storefront.installPluginSuccess,
			error:   wp.storefront.installPluginError
		};

		if ( $message.html() !== wp.updates.l10n.installing ) {
			$message.data( 'originaltext', $message.html() );
		}

		$message
			.addClass( 'updating-message' )
			.attr( 'aria-label', wp.updates.l10n.pluginInstallingLabel.replace( '%s', 'WooCommerce' ) )
			.text( wp.updates.l10n.installing );

		wp.a11y.speak( wp.updates.l10n.installingMsg, 'polite' );

		return wp.updates.ajax( 'install-plugin', args );
	};

	/**
	 * Updates the UI appropriately after a successful plugin install.
	 *
	 * @since 2.2
	 *
	 * @typedef {object} installPluginSuccess
	 * @param {object} response             Response from the server.
	 * @param {string} response.pluginName  Name of the installed plugin.
	 * @param {string} response.activateUrl URL to activate the just installed plugin.
	 */
	wp.storefront.installPluginSuccess = function( response ) {
		$( '.sf-notice-nux .sf-install-woocommerce' )
			.removeClass( 'install-now updating-message sf-install-woocommerce' )
			.addClass( 'activate-now' )
			.attr({
				'href':       response.activateUrl,
				'aria-label': wp.updates.l10n.activatePluginLabel.replace( '%s', response.pluginName )
			})
			.text( wp.updates.l10n.activatePlugin );

		wp.a11y.speak( wp.updates.l10n.installedMsg, 'polite' );
	};

	/**
	 * Updates the UI appropriately after a failed plugin install.
	 *
	 * @since 2.2
	 *
	 * @typedef {object} installPluginError
	 * @param {object}  response              Response from the server.
	 * @param {string}  response.errorCode    Error code for the error that occurred.
	 * @param {string}  response.errorMessage The error that occurred.
	 */
	wp.storefront.installPluginError = function( response ) {
		var errorMessage = wp.updates.l10n.installFailed.replace( '%s', response.errorMessage ),
			$installLink = $( '.sf-notice-nux .sf-install-woocommerce' );

		if ( ! wp.updates.isValidResponse( response, 'install' ) ) {
			return;
		}

		if ( wp.updates.maybeHandleCredentialError( response, 'install-plugin' ) ) {
			return;
		}

		wp.updates.addAdminNotice({
			id:        response.errorCode,
			className: 'notice-error is-dismissible',
			message:   errorMessage
		});

		$installLink
			.removeClass( 'updating-message' )
			.text( wp.updates.l10n.installNow )
			.attr( 'aria-label', wp.updates.l10n.installNowLabel.replace( '%s', 'WooCommerce' ) );

		wp.a11y.speak( errorMessage, 'assertive' );
	};

	$( function() {
		// Dismiss notice
		$document.on( 'click', '.sf-notice-nux .notice-dismiss', function() {
			$.ajax({
				type:     'POST',
				url:      ajaxurl,
				data:     { nonce: storefrontNUX.nonce, action: 'storefront_dismiss_notice' },
				dataType: 'json'
			});
		});

		// Install WooCommerce
		$document.on( 'click', '.sf-notice-nux .sf-install-woocommerce', function( event ) {
			event.preventDefault();

			wp.storefront.installWooCommerce();
		});
	});
})( window.wp, jQuery );