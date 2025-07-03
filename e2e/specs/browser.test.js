describe( 'Storefront', () => {
	beforeAll( async () => {
		await page.goto( STORE_URL );
	} );

	it( 'should have "built with WooCommerce" footer', async () => {
		const footerText = await page.evaluate( () => document.querySelector( 'body' ).innerText );
		expect( footerText ).toMatch( 'Built with WooCommerce.' );
	} );
} );
