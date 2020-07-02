module.exports = {
	preset: "jest-puppeteer",
	setupFilesAfterEnv: [
		"expect-puppeteer"
	],
	globals: {
		STORE_URL: "http://localhost:8802"
	},
	testTimeout: process.env.STOREFRONT_E2E_DEV ? 100000 : undefined,
}
