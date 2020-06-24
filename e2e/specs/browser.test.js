describe( 'Storefront', () => {
	beforeAll( async () => {
		await page.goto( STORE_URL );
	} );

	it( 'should have "built with Storefront" footer', async () => {
		await expect( page ).toMatch( 'Built with Storefront & WooCommerce.' );
	} );
});
