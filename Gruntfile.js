/* jshint node:true */
module.exports = function( grunt ) {
	'use strict';

	var sass = require( 'node-sass' );

	grunt.initConfig({

		// Autoprefixer.
		postcss: {
			options: {
				processors: [
					require( 'autoprefixer' )()
				]
			},
			dist: {
				src: [
					'style.css',
					'assets/css/admin/*.css',
					'assets/css/admin/welcome-screen/welcome.css',
					'assets/css/admin/customizer/customizer.css',
					'assets/css/woocommerce/extensions/*.css',
					'assets/css/woocommerce/woocommerce.css',
					'assets/css/woocommerce/woocommerce-legacy.css',
					'assets/css/jetpack/infinite-scroll.css',
					'assets/css/jetpack/widgets.css',
					'assets/css/base/*.css'
				]
			}
		},

		// JavaScript linting with JSHint.
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'assets/js/*.js',
				'!assets/js/*.min.js',
				'assets/js/admin/*.js',
				'!assets/js/admin/*.min.js',
				'assets/js/woocommerce/*.js',
				'!assets/js/woocommerce/*.min.js',
				'assets/js/woocommerce/extensions/*.js',
				'!assets/js/woocommerce/extensions/*.min.js'
			]
		},

		// Sass linting with Stylelint.
		stylelint: {
			options: {
				configFile: '.stylelintrc'
			},
			all: [
				'assets/css/**/*.scss',
				'!assets/css/sass/vendors/**/*.scss'
			]
		},

		// Minify .js files.
		uglify: {
			options: {
				output: {
					comments: 'some'
				}
			},
			main: {
				files: [{
					expand: true,
					cwd: 'assets/js/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: 'assets/js/',
					ext: '.min.js'
				}]
			},
			vendor: {
				files: [{
					expand: true,
					cwd: 'assets/js/vendor/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: 'assets/js/vendor/',
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
			},
			extensions: {
				files: [{
					expand: true,
					cwd: 'assets/js/woocommerce/extensions/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: 'assets/js/woocommerce/extensions/',
					ext: '.min.js'
				}]
			},
			admin: {
				files: [{
					expand: true,
					cwd: 'assets/js/admin/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: 'assets/js/admin/',
					ext: '.min.js'
				}]
			}
		},

		// Compile all .scss files.
		sass: {
			dist: {
				options: {
					implementation: sass,
					require: 'susy',
					sourceMap: false,
					includePaths: require( 'bourbon' ).includePaths
				},
				files: [{
					'style.css': 'style.scss',
					'assets/css/admin/admin.css': 'assets/css/admin/admin.scss',
					'assets/css/admin/plugin-install.css': 'assets/css/admin/plugin-install.scss',
					'assets/css/admin/welcome-screen/welcome.css': 'assets/css/admin/welcome-screen/welcome.scss',
					'assets/css/admin/customizer/customizer.css': 'assets/css/admin/customizer/customizer.scss',
					'assets/css/woocommerce/extensions/bookings.css': 'assets/css/woocommerce/extensions/bookings.scss',
					'assets/css/woocommerce/extensions/brands.css': 'assets/css/woocommerce/extensions/brands.scss',
					'assets/css/woocommerce/extensions/wishlists.css': 'assets/css/woocommerce/extensions/wishlists.scss',
					'assets/css/woocommerce/extensions/ajax-layered-nav.css': 'assets/css/woocommerce/extensions/ajax-layered-nav.scss',
					'assets/css/woocommerce/extensions/variation-swatches.css': 'assets/css/woocommerce/extensions/variation-swatches.scss',
					'assets/css/woocommerce/extensions/composite-products.css': 'assets/css/woocommerce/extensions/composite-products.scss',
					'assets/css/woocommerce/extensions/photography.css': 'assets/css/woocommerce/extensions/photography.scss',
					'assets/css/woocommerce/extensions/product-reviews-pro.css': 'assets/css/woocommerce/extensions/product-reviews-pro.scss',
					'assets/css/woocommerce/extensions/smart-coupons.css': 'assets/css/woocommerce/extensions/smart-coupons.scss',
					'assets/css/woocommerce/extensions/deposits.css': 'assets/css/woocommerce/extensions/deposits.scss',
					'assets/css/woocommerce/extensions/bundles.css': 'assets/css/woocommerce/extensions/bundles.scss',
					'assets/css/woocommerce/extensions/ship-multiple-addresses.css': 'assets/css/woocommerce/extensions/ship-multiple-addresses.scss',
					'assets/css/woocommerce/extensions/advanced-product-labels.css': 'assets/css/woocommerce/extensions/advanced-product-labels.scss',
					'assets/css/woocommerce/extensions/mix-and-match.css': 'assets/css/woocommerce/extensions/mix-and-match.scss',
					'assets/css/woocommerce/extensions/memberships.css': 'assets/css/woocommerce/extensions/memberships.scss',
					'assets/css/woocommerce/extensions/quick-view.css': 'assets/css/woocommerce/extensions/quick-view.scss',
					'assets/css/woocommerce/extensions/product-recommendations.css': 'assets/css/woocommerce/extensions/product-recommendations.scss',
					'assets/css/woocommerce/woocommerce.css': 'assets/css/woocommerce/woocommerce.scss',
					'assets/css/woocommerce/woocommerce-legacy.css': 'assets/css/woocommerce/woocommerce-legacy.scss',
					'assets/css/jetpack/infinite-scroll.css': 'assets/css/jetpack/infinite-scroll.scss',
					'assets/css/jetpack/widgets.css': 'assets/css/jetpack/widgets.scss',
					'assets/css/base/icons.css': 'assets/css/base/icons.scss',
					'assets/css/base/gutenberg-blocks.css': 'assets/css/base/gutenberg-blocks.scss',
					'assets/css/base/gutenberg-editor.css': 'assets/css/base/gutenberg-editor.scss'
				}]
			}
		},

		// Minify all .css files.
		cssmin: {
			admin: {
				expand: true,
				cwd: 'assets/css/admin/',
				src: ['*.css'],
				dest: 'assets/css/admin/',
				ext: '.css'
			},
			welcome: {
				expand: true,
				cwd: 'assets/css/admin/welcome-screen/',
				src: ['*.css'],
				dest: 'assets/css/admin/welcome-screen/',
				ext: '.css'
			},
			customizer: {
				expand: true,
				cwd: 'assets/css/admin/customizer/',
				src: ['*.css'],
				dest: 'assets/css/admin/customizer/',
				ext: '.css'
			}
		},

		// Watch changes for assets.
		watch: {
			css: {
				files: [
					'style.scss',
					'assets/css/admin/welcome-screen/*.scss',
					'assets/css/woocommerce/*.scss',
					'assets/css/woocommerce/extensions/*.scss',
					'assets/css/jetpack/*.scss',
					'assets/css/base/*.scss',
					'assets/css/components/*.scss',
					'assets/css/sass/utils/*.scss',
					'assets/css/sass/vendors/*.scss'
				],
				tasks: [
					'sass',
					'css'
				]
			},
			js: {
				files: [
					// main js
					'assets/js/**/*.js',
					'!assets/js/**/*.min.js',
					'!assets/js/editor.js',

					// customizer js
					'assets/js/customizer/**/*.js',
					'!assets/js/customizer/**/*..min.js',

					// WooCommerce js
					'assets/js/woocommerce/**/*.js',
					'!assets/js/woocommerce/**/*.min.js',

					// Extensions js
					'assets/js/woocommerce/extensions/**/*.js',
					'!assets/js/woocommerce/extensions/**/*.min.js',

					// Welcome screen js
					'assets/js/admin/welcome-screen/**/*.js',
					'!assets/js/admin/welcome-screen/**/*.min.js'
				],
				tasks: [
					'babel',
					'jshint',
					'uglify'
				]
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
					'.htaccess',
					'!.*',
					'!.*/**',
					'!*.md',
					'!*.scss',
					'!.DS_Store',
					'!assets/css/**/*.scss',
					'!assets/css/sass/**',
					'!assets/js/src/**',
					'!composer.json',
					'!composer.lock',
					'!Gruntfile.js',
					'!node_modules/**',
					'!npm-debug.log',
					'!package.json',
					'!package-lock.json',
					'!phpcs.xml',
					'!storefront/**',
					'!storefront.zip',
					'!vendor/**'
				],
				dest: 'storefront',
				expand: true,
				dot: true
			}
		},

		// RTLCSS
		rtlcss: {
			main: {
				options: {
					plugins: [
						{
							name: 'swap-fontawesome-directional-icons',
							priority: 10,
							directives: {
								control: {},
								value: []
							},
							processors: [
								{
									expr: /content/im,
									action: function( prop, value ) {
										if ( value === '"\\f190"' ) { // arrow-circle-o-left
											value = '"\\f18e"';
										} else if ( value === '"\\f18e"' ) { // arrow-circle-o-right
											value = '"\\f190"';
										} else if ( value === '"\\f191"' ) { // caret-square-o-left
											value = '"\\f152"';
										} else if ( value === '"\\f152"' ) { // caret-square-o-right
											value = '"\\f191"';
										} else if ( value === '"\\f100"' ) { // angle-double-left
											value = '"\\f101"';
										} else if ( value === '"\\f101"' ) { // angle-double-right
											value = '"\\f100"';
										} else if ( value === '"\\f104"' ) { // angle-left
											value = '"\\f105"';
										} else if ( value === '"\\f105"' ) { // angle-right
											value = '"\\f104"';
										} else if ( value === '"\\f0a8"' ) { // arrow-circle-left
											value = '"\\f0a9"';
										} else if ( value === '"\\f0a9"' ) { // arrow-circle-right
											value = '"\\f0a8"';
										} else if ( value === '"\\f060"' ) { // arrow-left
											value = '"\\f061"';
										} else if ( value === '"\\f061"' ) { // arrow-right
											value = '"\\f060"';
										} else if ( value === '"\\f0d9"' ) { // caret-left
											value = '"\\f0da"';
										} else if ( value === '"\\f0da"' ) { // caret-right
											value = '"\\f0d9"';
										} else if ( value === '"\\f137"' ) { // chevron-circle-left
											value = '"\\f138"';
										} else if ( value === '"\\f138"' ) { // chevron-circle-right
											value = '"\\f137"';
										} else if ( value === '"\\f053"' ) { // chevron-left
											value = '"\\f054"';
										} else if ( value === '"\\f054"' ) { // chevron-right
											value = '"\\f053"';
										} else if ( value === '"\\f0a5"' ) { // hand-o-left
											value = '"\\f0a4"';
										} else if ( value === '"\\f0a4"' ) { // hand-o-right
											value = '"\\f0a5"';
										} else if ( value === '"\\f177"' ) { // long-arrow-left
											value = '"\\f178"';
										} else if ( value === '"\\f178"' ) { // long-arrow-right
											value = '"\\f177"';
										} else if ( value === '"\\f191"' ) { // toggle-left
											value = '"\\f152"';
										} else if ( value === '"\\f152"' ) { // toggle-right
											value = '"\\f191"';
										} else if ( value === '"\\f30b"' ) { // long-arrow-alt-right
											value = '"\\f30a"';
										} else if ( value === '"\\f30a"' ) { // long-arrow-alt-left
											value = '"\\f30b"';
										}
										return { prop: prop, value: value };
									}
								}
							]
						}
					]
				},
				expand: true,
				ext: '-rtl.css',
				src: [
					'style.css',
					'assets/css/woocommerce/extensions/bookings.css',
					'assets/css/woocommerce/extensions/brands.css',
					'assets/css/woocommerce/extensions/wishlists.css',
					'assets/css/woocommerce/extensions/ajax-layered-nav.css',
					'assets/css/woocommerce/extensions/variation-swatches.css',
					'assets/css/woocommerce/extensions/composite-products.css',
					'assets/css/woocommerce/extensions/photography.css',
					'assets/css/woocommerce/extensions/product-reviews-pro.css',
					'assets/css/woocommerce/extensions/smart-coupons.css',
					'assets/css/woocommerce/extensions/deposits.css',
					'assets/css/woocommerce/extensions/bundles.css',
					'assets/css/woocommerce/extensions/ship-multiple-addresses.css',
					'assets/css/woocommerce/extensions/advanced-product-labels.css',
					'assets/css/woocommerce/extensions/mix-and-match.css',
					'assets/css/woocommerce/extensions/memberships.css',
					'assets/css/woocommerce/extensions/quick-view.css',
					'assets/css/woocommerce/extensions/product-recommendations.css',
					'assets/css/woocommerce/woocommerce.css',
					'assets/css/woocommerce/woocommerce-legacy.css',
					'assets/css/admin/admin.css',
					'assets/css/admin/welcome-screen/welcome.css',
					'assets/css/admin/customizer/customizer.css',
					'assets/css/jetpack/infinite-scroll.css',
					'assets/css/jetpack/widgets.css',
					'assets/css/base/icons.css',
					'assets/css/base/gutenberg-blocks.css',
					'assets/css/base/gutenberg-editor.css'
				]
			}
		},
		compress: {
			zip: {
				options: {
					archive: './storefront.zip',
					mode: 'zip'
				},
				files: [
					{ src: './storefront/**' }
				]
			}
		},
		babel: {
			options: {
				presets: ['@wordpress/babel-preset-default']
			},
			dist: {
				files: {
					'./assets/js/editor.js': './assets/js/src/editor.js'
				}
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
	grunt.loadNpmTasks( 'grunt-postcss' );
	grunt.loadNpmTasks( 'grunt-contrib-compress' );
	grunt.loadNpmTasks( 'grunt-stylelint' );
	grunt.loadNpmTasks( 'grunt-babel' );


	// Register tasks
	grunt.registerTask( 'default', [
		'css',
		'babel',
		'jshint',
		'uglify'
	]);

	grunt.registerTask( 'css', [
		'stylelint',
		'sass',
		'postcss',
		'cssmin',
		'rtlcss'
	]);

	grunt.registerTask( 'dev', [
		'default',
		'makepot'
	]);

	grunt.registerTask( 'deploy', [
		'dev',
		'copy',
		'compress'
	]);
};
