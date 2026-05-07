module.exports = {
	extends: [ 'plugin:@woocommerce/eslint-plugin/recommended' ],
	globals: {
		jQuery: 'readonly',
	},
	settings: {
		jest: {
			version: 29,
		},
	},
	rules: {
		'woocommerce/feature-flag': 'off',
		'@wordpress/no-global-active-element': 'warn',
		camelcase: 'off',
		'@typescript-eslint/no-this-alias': 'off',
	},
	ignorePatterns: [ '**/*.min.js' ],
};
