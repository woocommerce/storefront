<?php
/**
 * Storefront NUX Class
 *
 * @author   WooThemes
 * @package  storefront
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Storefront_NUX' ) ) :
	/**
	 * The Storefront admin class
	 */
	class Storefront_NUX {

		/**
		 * Setup class.
		 *
		 * @since 2.2
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts',                   array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_notices',                           array( $this, 'admin_notices' ), 99 );
			add_action( 'wp_ajax_storefront_dismiss_notice',       array( $this, 'dismiss_nux' ) );

			add_action( 'admin_init',                              array( $this, 'customizer' ) );

			add_action( 'after_setup_theme',                       array( $this, 'starter_content' ) );

			add_filter( 'get_theme_starter_content',               array( $this, 'filter_start_content' ), 10, 2 );

			add_action( 'admin_post_storefront_guided_tour',       array( $this, 'redirect_customizer' ) );
		}

		/**
		 * Enqueue scripts.
		 *
		 * @since 2.2
		 */
		public function enqueue_scripts() {
			global $wp_customize, $storefront_version;

			if ( isset( $wp_customize ) || true === (bool) get_option( 'storefront_nux_dismissed' ) ) {
				return;
			}

			wp_enqueue_style( 'storefront-admin-nux', get_template_directory_uri() . '/inc/nux/assets/css/admin.css', '', $storefront_version );

			wp_enqueue_script( 'storefront-admin-nux', get_template_directory_uri() . '/inc/nux/assets/js/admin.js', array( 'jquery' ), $storefront_version, 'all' );

			$storefront_nux = array(
				'nonce' => wp_create_nonce( 'storefront_notice_dismiss' )
			);

			wp_localize_script( 'storefront-admin-nux', 'storefrontNUX', $storefront_nux );
		}

		/**
		 * Output admin notices.
		 *
		 * @since 2.2
		 */
		public function admin_notices() {
			if ( true === (bool) get_option( 'storefront_nux_dismissed' ) ) {
				return;
			}
			?>

			<div class="notice notice-info sf-notice-nux is-dismissible">
			<?php
			if ( ! storefront_is_woocommerce_activated() && current_user_can( 'install_plugins' ) && current_user_can( 'activate_plugins' ) ) :
				if ( $url = $this->_is_woocommerce_installed() ) {
					$button = array(
						'message' => esc_attr__( 'Activate WooCommerce', 'storefront' ),
						'url'     => esc_url( $url ),
						'classes' => ' activate-now'
					);
				} else {
					$url = wp_nonce_url( add_query_arg( array(
						'action' => 'install-plugin',
						'plugin' => 'woocommerce',
						), self_admin_url( 'update.php' ) ), 'install-plugin_woocommerce' );

					$button = array(
						'message' => esc_attr__( 'Install WooCommerce', 'storefront' ),
						'url'     => esc_url( $url ),
						'classes' => ' install-now sf-install-woocommerce'
					);
				}
			?>
				<h2><?php esc_attr_e( 'Thanks for installing Storefront <3', 'storefront' ); ?></h2>
				<p><?php esc_attr_e( 'To add eCommerce features you need to install the WooCommerce plugin.', 'storefront' ); ?></p>
				<p><a href="<?php echo $button['url']; ?>" class="button button-primary<?php echo $button['classes']; ?>" data-originaltext="<?php echo $button['message']; ?>" aria-label="<?php echo $button['message']; ?>"><?php echo $button['message']; ?></a></p>
			<?php endif; ?>

			<?php if ( storefront_is_woocommerce_activated() ) : ?>
				<h2><?php printf( esc_html__( 'Getting started with  %sStorefront%s', 'storefront' ), '<strong>', '</strong>' ); ?></h2>
				<p><?php printf( esc_html__( 'Before you begin customizing Storefront we\'ll set it up to look more like a store by adding things like example products, WooCommerce widgets and links to shop pages in your navigation. We\'ll also set up the Storefront homepage template. %sChange setup tasks%s', 'storefront' ), '<button class="sf-setup-tasks">', '</button>' ); ?></p>

				<div class="sf-setup-tasks-options">
					<p><input type="checkbox" name="homepage" checked><?php esc_attr_e( 'Homepage Template', 'storefront' ); ?></p>
					<p><input type="checkbox" name="widgets" checked><?php esc_attr_e( 'WooCommerce widgets', 'storefront' ); ?></p>
					<?php if ( get_option( 'woocommerce_shop_page_id' ) && get_option( 'woocommerce_myaccount_page_id' ) ) : ?>
						<p><input type="checkbox" name="menu" checked><?php esc_attr_e( 'Add shop and user account links to menus', 'storefront' ); ?></p>
					<?php endif; ?>
					<p><input type="checkbox" name="products" checked><?php esc_attr_e( 'Add example products', 'storefront' ); ?></p>
				</div>

				<?php $url = wp_nonce_url( add_query_arg( 'action', 'storefront_guided_tour', admin_url( 'admin-post.php' ) ), 'storefront-nux' ); ?>

				<p><a href="<?php echo esc_url( $url ); ?>" data-tour-url="<?php echo esc_url( $url ); ?>" class="button button-primary"><?php esc_attr_e( 'Customize Storefront', 'storefront' ); ?></a></p>
			<?php endif; ?>
			</div>
		<?php }

		/**
		 * AJAX dismiss notice.
		 *
		 * @since 2.2
		 */
		public function dismiss_nux() {
			$nonce = ! empty( $_POST['nonce'] ) ? $_POST['nonce'] : false;

			if ( ! $nonce || ! wp_verify_nonce( $nonce, 'storefront_notice_dismiss' ) || ! current_user_can( 'manage_options' ) ) {
				die();
			}

			update_option( 'storefront_nux_dismissed', true );
		}

		/**
		 * Customizer.
		 *
		 * @since 2.2
		 */
		public function customizer() {
			global $pagenow;

			if ( 'customize.php' === $pagenow && isset( $_GET['sf_guided_tour'] ) && 1 === absint( $_GET['sf_guided_tour'] ) ) {
				add_action( 'customize_controls_enqueue_scripts',      array( $this, 'customize_scripts' ) );
				add_action( 'customize_controls_print_footer_scripts', array( $this, 'print_templates' ) );
			}
		}

		/**
		 * Customizer enqueues.
		 *
		 * @since 2.2
		 */
		public function customize_scripts() {
			global $storefront_version;

			wp_enqueue_style( 'sp-guided-tour', get_template_directory_uri() . '/inc/nux/assets/css/customizer.css', array(), $storefront_version, 'all' );

			wp_enqueue_script( 'sf-guided-tour', get_template_directory_uri() . '/inc/nux/assets/js/customizer.js', array( 'jquery', 'wp-backbone' ), $storefront_version, true );

			wp_localize_script( 'sf-guided-tour', '_wpCustomizeSFGuidedTourSteps', $this->_guided_tour_steps() );
		}

		/**
		 * Template for steps.
		 *
		 * @since 2.2
		 */
		public function print_templates() {
			?>
			<script type="text/html" id="tmpl-sf-guided-tour-step">
				<div class="sf-guided-tour-step">
					<# if ( data.title ) { #>
						<h2>{{ data.title }}</h2>
					<# } #>
					{{{ data.message }}}
					<a class="sf-guided-tour-button" href="#">
						<# if ( data.button_text ) { #>
							{{ data.button_text }}
						<# } else { #>
							<?php esc_attr_e( 'Next', 'storefront' ); ?>
						<# } #>
					</a>
					<# if ( data.first_step ) { #>
					<a class="sf-guided-tour-dismiss" href="#">
						<?php esc_attr_e( 'No thanks, skip the tour', 'storefront' ); ?>
					</a>
					<# } #>
				</div>
			</script>
			<?php
		}

		/**
		 * Redirects to the customizer with the correct variables.
		 *
		 * @since 2.2
		 */
		public function redirect_customizer() {
			check_admin_referer( 'storefront-nux' );

			update_option( 'fresh_site', true );

			update_option( 'storefront_nux_dismissed', true );

			$args = array( 'sf_guided_tour' => '1' );

			if ( ! empty( $_REQUEST['tasks'] ) && '' !== $_REQUEST['tasks'] ) {
				$args['sf_tasks'] = sanitize_text_field( $_REQUEST['tasks'] );
			}

			wp_safe_redirect( add_query_arg( $args, admin_url( 'customize.php' ) ) );

			die();
		}

		/**
		 * Starter content.
		 *
		 * @since 2.2
		 */
		public function starter_content() {
			add_theme_support( 'starter-content', apply_filters( 'storefront_starter_content', array(
				'posts' => array(
					'home',
					'blog',
					'post1' => array(
						'post_type'    => 'post',
						'post_title'   => 'Custom Post',
						'post_content' => 'My awesome content.',
					),
				),
				'options' => array(
					'show_on_front'  => 'page',
					'page_on_front'  => '{{home}}',
					'page_for_posts' => '{{blog}}',
				),
				'widgets' => array(
				    'sidebar-1' => array(
				        'woocommerce_product_search' => array( 'woocommerce_product_search', array(
				            'title' => 'Products!',
				        ) ),
				    ),
				),
			) ) );
		}

		/**
		 * Filters starter content and remove some of the content if necessary.
		 *
		 * @since 2.2
		 */
		public function filter_start_content( $content, $config ) {
			if ( ! isset( $_GET['sf_guided_tour'] ) || 1 !== absint( $_GET['sf_guided_tour'] ) ) {
				return $content;
			}

			if ( isset( $_GET['sf_tasks'] ) && '' !== sanitize_text_field( $_GET['sf_tasks'] ) ) {
				$tasks = $this->validate_tasks( sanitize_text_field( $_GET['sf_tasks'] ) );

				if ( ! empty( $tasks ) ) {
					foreach ( $tasks as $task ) {
						switch ( $task ) {
							case 'homepage':
								unset( $content['options'] );

								if ( isset( $content['posts'] ) ) {
									foreach ( $content['posts'] as $post_id => $post ) {
										if ( 'home' === $post_id ) {
											unset( $content['posts'][ $post_id ] );
										}

										if ( 'blog' === $post_id ) {
											unset( $content['posts'][ $post_id ] );
										}
									}
								}

								break;

							case 'widgets':
								unset( $content['widgets'] );

								break;

							case 'menu':
								unset( $content['nav_menus'] );

								break;

							case 'products':
								if ( isset( $content['posts'] ) ) {
									foreach ( $content['posts'] as $post_id => $post ) {
										if ( isset( $post['post_type'] ) && 'product' === $post['post_type'] ) {
											unset( $content['posts'][ $post_id ] );
										}
									}
								}

								break;
						}
					}
				}
			}

			return $content;
		}

		/**
		 * Validates and sanitizes a given tasks list.
		 *
		 * @since 2.2
		 */
		public function _validate_tasks( $tasks ) {
			$valid_tasks = apply_filters( 'storefront_valid_tour_tasks', array( 'homepage', 'widgets', 'menu', 'products' ) );

			$tasks = explode( ',', sanitize_text_field( $tasks ) );

			$validated_tasks = array();

			foreach ( $tasks as $task ) {
				$task = sanitize_key( $task );

				if ( in_array( $task, $valid_tasks ) ) {
					$validated_tasks[] = $task;
				}
			}

			$validated_tasks = array_diff( $valid_tasks, $validated_tasks );

			if ( ! empty( $validated_tasks ) ) {
				return $validated_tasks;
			}

			return false;
		}

		/**
		 * Check if WooCommerce is installed.
		 *
		 * @since 2.2
		 */
		public function _is_woocommerce_installed() {
			if ( file_exists( WP_PLUGIN_DIR . '/woocommerce' ) ) {
				$plugins = get_plugins( '/woocommerce' );

				if ( ! empty( $plugins ) ) {
					$keys        = array_keys( $plugins );
					$plugin_file = 'woocommerce/' . $keys[0];
					$url         = wp_nonce_url( add_query_arg( array(
						'action' => 'activate',
						'plugin' => $plugin_file
					), admin_url( 'plugins.php' ) ), 'activate-plugin_' . $plugin_file );

					return $url;
				}
			}

			return false;
		}

		/**
		 * Guided tour steps.
		 *
		 * @since 2.2
		 */
		public function _guided_tour_steps() {
			$steps = array();

			$steps[] = array(
				'title'       => __( 'Welcome to the Customizer', 'storefront' ),
				'message'     => sprintf( __( 'Here you can control the overall look and feel of Storefront.%sThere are a few options we recommend you configure to make Storefront your own. We\'ll guide you through changing your homepage layout, adding your logo and customising the header colors. It won\'t take a minute :)', 'storefront' ), PHP_EOL . PHP_EOL ),
				'button_text' => __( 'Let\'s go!', 'storefront' ),
				'section'     => '#customize-info'
			);

			$steps[] = array(
				'title'   => __( 'Add your logo', 'storefront' ),
				'message' => __( 'Open the Site Identity Panel, then click the \'Select Logo\' button to upload your logo.', 'storefront' ),
				'section' => 'title_tagline'
			);

			$steps[] = array(
				'title'   => __( 'Choose the header background', 'storefront' ),
				'message' => __( 'Open the Header Panel, then click the \'Background color\' swatch to update the background color of your site header.', 'storefront' ),
				'section' => 'header_image'
			);


			$steps[] = array(
				'title'       => '',
				'message'     => sprintf( __( 'That\'s as far as we go in our tour, but there\'s lots more to discover in the Customizer so be sure to explore. When you\'re done, remember to %ssave & publish%s your changes.', 'storefront' ), '<strong>', '</strong>' ),
				'section'     => '#customize-header-actions .save',
				'button_text' => __( 'Done', 'storefront' ),
			);

			return $steps;
		}
	}

endif;

return new Storefront_NUX();