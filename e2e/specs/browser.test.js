describe( 'Storefront', () => {
	beforeAll( async () => {
		await page.goto( STORE_URL );
	} );

	it( 'should have "built with WooCommerce" footer', async () => {
		await expect( page ).toMatch( 'Built with WooCommerce.' );
	} );
} );
