
// Launch chromium and run tests at slow speed so can see where things go wrong.
const launch = process.env.STOREFRONT_E2E_DEV ? {
	slowMo: 50,
	headless: false,
	devtools: true,
} : undefined;

module.exports = {
	launch: launch,
}
