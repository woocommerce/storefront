import {
	switchUserToAdmin,
	visitAdminPage,
} from '@wordpress/e2e-test-utils';

beforeAll( async () => {
	// Log in as admin, switch to dashboard.
	await switchUserToAdmin();
	await visitAdminPage( '' );

	// Click the onboarding notice "Let's go" link, wait for customizer.
	await page.click( '.sf-notice-nux .sf-nux-button' );
	await page.waitForSelector( '#customize-header-actions input#save' );
} );

describe( 'Storefront onboarding', () => {
	// Work in progress - testing!
	it( 'should launch customizer', async () => {
		await expect( page ).toMatch( 'You are customizing' );
	} );
});
