module.exports = {
	"preset": "jest-puppeteer",
	"setupFilesAfterEnv": [
		"expect-puppeteer"
	],
	"globals": {
		"STORE_URL": "http://localhost:8802"
	},
	// "users": {
	// 	"admin": {
	// 		"username": "admin",
	// 		"password": "password"
	// 	},
	// 	"customer": {
	// 		"username": "customer",
	// 		"password": "password"
	// 	}
	// }
}
