import {
	switchUserToAdmin,
	visitAdminPage,
} from '@wordpress/e2e-test-utils';

describe( 'Storefront onboarding', () => {
	beforeAll( async () => {
		// Log in as admin, switch to dashboard.
		await switchUserToAdmin();
		await visitAdminPage( '' );
	} );

	// Work in progress!
	// These tests assume that the nux notice is not dismissed.
	// This test suite is slow – presumably because all the sample products are
	// being imported. If this test ends up being a problem we can remove or
	// improve it :)

	it( 'nux notice should launch customizer', async () => {
		// Click the onboarding notice "Let's go" link, wait for customizer.
		await Promise.all([
			page.click( '.sf-notice-nux .sf-nux-button' ),
			page.waitForNavigation(),
		]);
		await page.waitForSelector( '#customize-header-actions input#save' );

		await expect( page ).toMatch( 'You are customizing' );
	} );

	it( 'publishing customizer changes should succeed', async () => {
		// Click customizer `Publish`, wait for success.
		await page.click( '#customize-header-actions input#save' );
		await expect( page ).toMatch( 'Published' );
	} );

	// This test isn't working yet - the products aren't finished importing;
	// need to figure out how to wait for them.
	// Testing the onboarding + product import might not be a good fit for e2e tests.
	// it( 'sample products should exist after nux customizer', async () => {
	// 	await visitAdminPage( 'edit.php', 'post_type=product' );
	// 	await page.waitForNavigation();
	// 	await expect( page ).toMatch( 'WordPress Pennant' );
	// } );
});
