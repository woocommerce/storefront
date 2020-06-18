describe( 'Storefront', () => {
	beforeAll( async () => {
		await page.goto( 'http://localhost:8889/' );
	} );

	it( 'should have "built with Storefront" footer', async () => {
		await expect( page ).toMatch( 'Built with Storefront & WooCommerce.' );
	} );
});
