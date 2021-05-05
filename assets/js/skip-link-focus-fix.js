( function () {
	const isWebkit =
			window.navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
		isOpera =
			window.navigator.userAgent.toLowerCase().indexOf( 'opera' ) > -1,
		isIe = window.navigator.userAgent.toLowerCase().indexOf( 'msie' ) > -1;

	if (
		( isWebkit || isOpera || isIe ) &&
		document.getElementById &&
		window.addEventListener
	) {
		// eslint-disable-next-line @wordpress/no-global-event-listener
		window.addEventListener(
			'hashchange',
			function () {
				const element = document.getElementById(
					window.location.hash.substring( 1 )
				);

				if ( element ) {
					if (
						! /^(?:a|select|input|button|textarea)$/i.test(
							element.tagName
						)
					) {
						element.tabIndex = -1;
					}

					element.focus();
				}
			},
			false
		);
	}
} )();
