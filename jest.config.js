module.exports = {
	preset: "jest-puppeteer",
	setupFilesAfterEnv: [
		"expect-puppeteer"
	],
	globals: {
		STORE_URL: "http://localhost:8802"
	},
	testTimeout: 25000,
}
