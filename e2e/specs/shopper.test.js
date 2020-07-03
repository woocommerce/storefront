describe( 'Storefront front end', () => {
	beforeAll( async () => {
		await page.goto( process.env.WP_BASE_URL );
	} );

	it( 'should have "built with Storefront" footer', async () => {
		await expect( page ).toMatch( 'Built with Storefront & WooCommerce.' );
	} );
});
