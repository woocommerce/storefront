module.exports = {
	preset: "jest-puppeteer",
	setupFilesAfterEnv: [
		"expect-puppeteer"
	],
	testTimeout: 25000,
}
