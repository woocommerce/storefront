/* jshint node:true */
module.exports = function( grunt ) {
	'use strict';

	grunt.initConfig({

		// Autoprefixer.
		postcss: {
			options: {
				processors: [
					require( 'autoprefixer' )({
						browsers: [
							'> 0.1%',
							'ie 8',
							'ie 9'
						]
					})
				]
			},
			dist: {
				src: [
					'style.css',
					'assets/sass/admin/*.css',
					'assets/sass/admin/welcome-screen/welcome.css',
					'assets/sass/admin/customizer/customizer.css',
					'assets/sass/woocommerce/extensions/*.css',
					'assets/sass/woocommerce/woocommerce.css',
					'assets/sass/jetpack/jetpack.css',
					'assets/sass/base/*.css'
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
					require: 'susy',
					sourcemap: 'none',
					includePaths: require( 'node-bourbon' ).includePaths
				},
				files: [{
					'style.css': 'style.scss',
					'assets/sass/admin/admin.css': 'assets/sass/admin/admin.scss',
					'assets/sass/admin/plugin-install.css': 'assets/sass/admin/plugin-install.scss',
					'assets/sass/admin/welcome-screen/welcome.css': 'assets/sass/admin/welcome-screen/welcome.scss',
					'assets/sass/admin/customizer/customizer.css': 'assets/sass/admin/customizer/customizer.scss',
					'assets/sass/woocommerce/extensions/bookings.css': 'assets/sass/woocommerce/extensions/bookings.scss',
					'assets/sass/woocommerce/extensions/brands.css': 'assets/sass/woocommerce/extensions/brands.scss',
					'assets/sass/woocommerce/extensions/wishlists.css': 'assets/sass/woocommerce/extensions/wishlists.scss',
					'assets/sass/woocommerce/extensions/ajax-layered-nav.css': 'assets/sass/woocommerce/extensions/ajax-layered-nav.scss',
					'assets/sass/woocommerce/extensions/variation-swatches.css': 'assets/sass/woocommerce/extensions/variation-swatches.scss',
					'assets/sass/woocommerce/extensions/composite-products.css': 'assets/sass/woocommerce/extensions/composite-products.scss',
					'assets/sass/woocommerce/extensions/photography.css': 'assets/sass/woocommerce/extensions/photography.scss',
					'assets/sass/woocommerce/extensions/product-reviews-pro.css': 'assets/sass/woocommerce/extensions/product-reviews-pro.scss',
					'assets/sass/woocommerce/extensions/smart-coupons.css': 'assets/sass/woocommerce/extensions/smart-coupons.scss',
					'assets/sass/woocommerce/extensions/deposits.css': 'assets/sass/woocommerce/extensions/deposits.scss',
					'assets/sass/woocommerce/extensions/bundles.css': 'assets/sass/woocommerce/extensions/bundles.scss',
					'assets/sass/woocommerce/extensions/ship-multiple-addresses.css': 'assets/sass/woocommerce/extensions/ship-multiple-addresses.scss',
					'assets/sass/woocommerce/extensions/advanced-product-labels.css': 'assets/sass/woocommerce/extensions/advanced-product-labels.scss',
					'assets/sass/woocommerce/extensions/mix-and-match.css': 'assets/sass/woocommerce/extensions/mix-and-match.scss',
					'assets/sass/woocommerce/extensions/memberships.css': 'assets/sass/woocommerce/extensions/memberships.scss',
					'assets/sass/woocommerce/extensions/quick-view.css': 'assets/sass/woocommerce/extensions/quick-view.scss',
					'assets/sass/woocommerce/woocommerce.css': 'assets/sass/woocommerce/woocommerce.scss',
					'assets/sass/jetpack/jetpack.css': 'assets/sass/jetpack/jetpack.scss',
					'assets/sass/base/icons.css': 'assets/sass/base/icons.scss'
				}]
			}
		},

		// Minify all .css files.
		cssmin: {
			main: {
				files: {
					'style.css': ['style.css']
				}
			},
			admin: {
				expand: true,
				cwd: 'assets/sass/admin/',
				src: ['*.css'],
				dest: 'assets/sass/admin/',
				ext: '.css'
			},
			welcome: {
				expand: true,
				cwd: 'assets/sass/admin/welcome-screen/',
				src: ['*.css'],
				dest: 'assets/sass/admin/welcome-screen/',
				ext: '.css'
			},
			customizer: {
				expand: true,
				cwd: 'assets/sass/admin/customizer/',
				src: ['*.css'],
				dest: 'assets/sass/admin/customizer/',
				ext: '.css'
			},
			jetpack: {
				expand: true,
				cwd: 'assets/sass/jetpack/',
				src: ['*.css'],
				dest: 'assets/sass/jetpack/',
				ext: '.css'
			},
			woocommerce: {
				expand: true,
				cwd: 'assets/sass/woocommerce/',
				src: ['*.css'],
				dest: 'assets/sass/woocommerce/',
				ext: '.css'
			}
		},

		// Watch changes for assets.
		watch: {
			css: {
				files: [
					'style.scss',
					'assets/sass/admin/welcome-screen/*.scss',
					'assets/sass/woocommerce/*.scss',
					'assets/sass/jetpack/*.scss',
					'assets/sass/base/*.scss',
					'assets/sass/components/*.scss',
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
					'!assets/js/woocommerce/*.min.js',

					// Welcome screen js
					'assets/js/admin/welcome-screen/*js',
					'!assets/js/admin/welcome-screen/*.min.js'
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
					'assets/sass/woocommerce/extensions/bookings.css',
					'assets/sass/woocommerce/extensions/brands.css',
					'assets/sass/woocommerce/extensions/wishlists.css',
					'assets/sass/woocommerce/extensions/ajax-layered-nav.css',
					'assets/sass/woocommerce/extensions/variation-swatches.css',
					'assets/sass/woocommerce/extensions/composite-products.css',
					'assets/sass/woocommerce/extensions/photography.css',
					'assets/sass/woocommerce/extensions/product-reviews-pro.css',
					'assets/sass/woocommerce/extensions/smart-coupons.css',
					'assets/sass/woocommerce/extensions/deposits.css',
					'assets/sass/woocommerce/extensions/bundles.css',
					'assets/sass/woocommerce/extensions/ship-multiple-addresses.css',
					'assets/sass/woocommerce/extensions/advanced-product-labels.css',
					'assets/sass/woocommerce/extensions/mix-and-match.css',
					'assets/sass/woocommerce/extensions/memberships.css',
					'assets/sass/woocommerce/extensions/quick-view.css',
					'assets/sass/woocommerce/woocommerce.css',
					'assets/sass/admin/welcome-screen/welcome.css',
					'assets/sass/jetpack/jetpack.css',
					'assets/sass/base/icons.css'
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


	// Register tasks
	grunt.registerTask( 'default', [
		'css',
		'jshint',
		'uglify'
	]);

	grunt.registerTask( 'css', [
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
		'copy',
		'compress'
	]);
};
