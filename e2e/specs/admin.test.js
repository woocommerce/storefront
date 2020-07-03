import {
	switchUserToAdmin,
	visitAdminPage,
} from '@wordpress/e2e-test-utils';

describe( 'Storefront onboarding', () => {
	// Enter the customizer via the "Let's go" onboarding link.
	// Note this assumes that the nux notice is displayed - this may be fragile.
	beforeAll( async () => {
		// Log in as admin, switch to dashboard.
		await switchUserToAdmin();
		await visitAdminPage( '' );

		// Click the onboarding notice "Let's go" link, wait for customizer.
		await page.click( '.sf-notice-nux .sf-nux-button' );
		await page.waitForSelector( '#customize-header-actions input#save' );
	} );

	// Work in progress!
	it( 'should launch customizer', async () => {
		await expect( page ).toMatch( 'You are customizing' );
	} );
});
