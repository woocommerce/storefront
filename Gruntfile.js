/* jshint node:true */
module.exports = function( grunt ) {
	'use strict';

	grunt.initConfig({

		// JavaScript linting with JSHint.
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'assets/js/*.js',
				'!assets/js/*.min.js',
				'assets/js/customizer/*.js',
				'!assets/js/customizer/*.min.js',
				'assets/js/woocommerce/*.js',
				'!assets/js/woocommerce/*.min.js'
			]
		},

		// Minify .js files.
		uglify: {
			options: {
				preserveComments: 'some'
			},
			main: {
				files: [{
					expand: true,
					cwd: 'js/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: 'js/',
					ext: '.min.js'
				}]
			},
			customizer: {
				files: [{
					expand: true,
					cwd: 'assets/js/customizer/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: 'assets/js/customizer/',
					ext: '.min.js'
				}]
			},
			woocommerce: {
				files: [{
					expand: true,
					cwd: 'assets/js/woocommerce/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: 'assets/js/woocommerce/',
					ext: '.min.js'
				}]
			}
		},

		// Compile all .scss files.
		sass: {
			dist: {
				options: {
					require: 'susy',
					sourcemap: 'none',
					includePaths: require( 'node-bourbon' ).includePaths
				},
				files: [{
					'style.css': 'style.scss',
					'assets/css/admin/welcome-screen/welcome.css': 'assets/css/admin/welcome-screen/welcome.scss',
					'assets/css/woocommerce/bookings.css': 'assets/css/woocommerce/bookings.scss',
					'assets/css/woocommerce/brands.css': 'assets/css/woocommerce/brands.scss',
					'assets/css/woocommerce/wishlists.css': 'assets/css/woocommerce/wishlists.scss',
					'assets/css/woocommerce/ajax-layered-nav.css': 'assets/css/woocommerce/ajax-layered-nav.scss',
					'assets/css/woocommerce/variation-swatches.css': 'assets/css/woocommerce/variation-swatches.scss',
					'assets/css/woocommerce/composite-products.css': 'assets/css/woocommerce/composite-products.scss',
					'assets/css/woocommerce/photography.css': 'assets/css/woocommerce/photography.scss',
					'assets/css/woocommerce/product-reviews-pro.css': 'assets/css/woocommerce/product-reviews-pro.scss',
					'assets/css/woocommerce/smart-coupons.css': 'assets/css/woocommerce/smart-coupons.scss',
					'assets/css/woocommerce/deposits.css': 'assets/css/woocommerce/deposits.scss',
					'assets/css/woocommerce/bundles.css': 'assets/css/woocommerce/bundles.scss',
					'assets/css/woocommerce/ship-multiple-addresses.css': 'assets/css/woocommerce/ship-multiple-addresses.scss',
					'assets/css/woocommerce/woocommerce.css': 'assets/css/woocommerce/woocommerce.scss',
					'assets/css/jetpack.css': 'assets/css/jetpack.scss'
				}]
			}
		},

		// Minify all .css files.
		cssmin: {
			minify: {
				expand: true,
				cwd: 'assets/css/woocommerce/',
				src: ['*.css'],
				dest: 'assets/css/woocommerce/',
				ext: '.css'
			}
		},

		// Watch changes for assets.
		watch: {
			css: {
				files: [
					'style.scss',
					'assets/css/welcome-screen/*.scss',
					'assets/css/woocommerce/*.scss',
					'assets/css/jetpack/*.scss',
					'assets/sass/base/*.scss',
					'assets/sass/components/*.scss',
					'assets/sass/layout/*.scss',
					'assets/sass/utils/*.scss',
					'assets/sass/vendors/*.scss'
				],
				tasks: [
					'sass',
					'css'
				]
			},
			js: {
				files: [
					// main js
					'assets/js/*js',
					'!assets/js/*.min.js',

					// customizer js
					'assets/js/customizer/*js',
					'!assets/js/customizer/*.min.js',

					// WooCommerce js
					'assets/js/woocommerce/*js',
					'!assets/js/woocommerce/*.min.js'
				],
				tasks: ['jshint', 'uglify']
			}
		},

		// Generate POT files.
		makepot: {
			options: {
				type: 'wp-theme',
				domainPath: 'languages',
				potHeaders: {
					'report-msgid-bugs-to': 'https://github.com/woothemes/storefront/issues',
					'language-team': 'LANGUAGE <EMAIL@ADDRESS>'
				}
			},
			frontend: {
				options: {
					potFilename: 'storefront.pot',
					exclude: [
						'storefront/.*' // Exclude deploy directory
					]
				}
			}
		},

		// Check textdomain errors.
		checktextdomain: {
			options:{
				text_domain: 'storefront',
				keywords: [
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d'
				]
			},
			files: {
				src:  [
					'**/*.php', // Include all files
					'!node_modules/**' // Exclude node_modules/
				],
				expand: true
			}
		},

		// Creates deploy-able theme
		copy: {
			deploy: {
				src: [
					'**',
					'!.*',
					'!*.md',
					'!.*/**',
					'.htaccess',
					'!Gruntfile.js',
					'!package.json',
					'!node_modules/**',
					'!.DS_Store',
					'!npm-debug.log'
				],
				dest: 'storefront',
				expand: true,
				dot: true
			}
		},

		// RTLCSS
		rtlcss: {
			options: {
				config: {
					swapLeftRightInUrl: false,
					swapLtrRtlInUrl: false,
					autoRename: false,
					preserveDirectives: true
				},
				properties : [
					{
						name: 'swap-fontawesome-left-right-angles',
						expr: /content/im,
						action: function( prop, value ) {
							if ( value === '"\\f105"' ) { // fontawesome-angle-left
								value = '"\\f104"';
							}
							if ( value === '"\\f178"' ) { // fontawesome-long-arrow-right
								value = '"\\f177"';
							}
							return { prop: prop, value: value };
						}
					}
				]
			},
			main: {
				expand: true,
				ext: '-rtl.css',
				src: [
					'style.css',
					'assets/css/woocommerce/bookings.css',
					'assets/css/woocommerce/brands.css',
					'assets/css/woocommerce/wishlists.css',
					'assets/css/woocommerce/ajax-layered-nav.css',
					'assets/css/woocommerce/variation-swatches.css',
					'assets/css/woocommerce/composite-products.css',
					'assets/css/woocommerce/photography.css',
					'assets/css/woocommerce/product-reviews-pro.css',
					'assets/css/woocommerce/smart-coupons.css',
					'assets/css/woocommerce/deposits.css',
					'assets/css/woocommerce/bundles.css',
					'assets/css/woocommerce/ship-multiple-addresses.css',
					'assets/css/woocommerce/woocommerce.css',
					'assets/css/jetpack/jetpack.css'
				]
			}
		}
	});

	// Load NPM tasks to be used here
	grunt.loadNpmTasks( 'grunt-contrib-jshint' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-sass' );
	grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-checktextdomain' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-rtlcss' );

	// Register tasks
	grunt.registerTask( 'default', [
		'css',
		'jshint',
		'uglify'
	]);

	grunt.registerTask( 'css', [
		'sass',
		'cssmin',
		'rtlcss'
	]);

	grunt.registerTask( 'dev', [
		'default',
		'makepot'
	]);

	grunt.registerTask( 'deploy', [
		'dev',
		'copy'
	]);
};
