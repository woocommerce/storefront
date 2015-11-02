<?php
/**
 * Template functions used for the site header.
 *
 * @package storefront
 */

if ( ! function_exists( 'storefront_header_widget_region' ) ) {
	/**
	 * Display header widget region
	 * @since  1.0.0
	 */
	function storefront_header_widget_region() {
		if ( is_active_sidebar( 'header-1' ) ) {
		?>
		<div class="header-widget-region" role="complementary">
			<div class="col-full">
				<?php dynamic_sidebar( 'header-1' ); ?>
			</div>
		</div>
		<?php
		}
	}
}

if ( ! function_exists( 'storefront_site_branding' ) ) {
	/**
	 * Display Site Branding
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_site_branding() {
		if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} else { ?>
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php if ( '' != get_bloginfo( 'description' ) ) { ?>
					<p class="site-description"><?php echo bloginfo( 'description' ); ?></p>
				<?php } ?>
			</div>
		<?php }
	}
}

if ( ! function_exists( 'storefront_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_primary_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
<!-- Only needed for Handheld ...
		<button class="menu-toggle" aria-controls="primary-navigation" aria-expanded="false"><?php /*echo esc_attr( apply_filters( 'storefront_menu_toggle_text', __( 'Navigation', 'storefront' ) ) ); */?></button>

-->			<?php
			wp_nav_menu(
				array(
					'theme_location'	=> 'primary',
					'container_class'	=> 'primary-navigation',
					)
			);
/*  Handheld Navigation -> enbale if needed -> add stylesheet as needed!
			wp_nav_menu(
				array(
					'theme_location'	=> 'handheld',
					'container_class'	=> 'handheld-navigation',
					)
			);
			*/?>
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'storefront_secondary_navigation' ) ) {
	/**
	 * Display Secondary Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_secondary_navigation() {
		?>
		<nav class="secondary-navigation" role="navigation" aria-label="<?php _e( 'Secondary Navigation', 'storefront' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location'	=> 'secondary',
						'fallback_cb'		=> '',
					)
				);
			?>
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'storefront_skip_links' ) ) {
	/**
	 * Skip links
	 * @since  1.4.1
	 * @return void
	 */
	function storefront_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#site-navigation"><?php _e( 'Skip to navigation', 'storefront' ); ?></a>
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'storefront' ); ?></a>
		<?php
	}

}if ( ! function_exists( 'storefront_genuss_slider' ) ) {
	/**
	 * Slider
	 * @since  1.5.1
	 * @return void
	 */
	function storefront_genuss_slider() {
		?>

		<div id="slider" class="slider">
			<div><a href="http://www.gronau.at" ><img src="/wp-content/themes/storefront/img/slider1.jpg" class=""/></a></div>
			<div><img src="/wp-content/themes/storefront/img/slider2.jpg" class=""/></div>
			<div><img src="/wp-content/themes/storefront/img/slider3.jpg" class=""/></div>
			<div><img src="/wp-content/themes/storefront/img/slider3.jpg" class=""/></div>
		</div>

		<script type="text/javascript">
			jQuery('.slider').slick({
				// centerMode: true,
				// centerPadding: '0px',
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				lazyLoad: 'progressive',
				easing:"linear",
				infinite: true,
				// variableWidth: true,
				autoplaySpeed: 5000,
				arrows: false,
				// dots: true,
				responsive: [
					{
						breakpoint: 768,
						settings: {
							arrows: false,
							// centerMode: true,
							// centerPadding: '40px',
							slidesToShow: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							arrows: false,
							// centerMode: true,
							// centerPadding: '40px',
							slidesToShow: 1
						}
					}
				]
			});
		</script>

		<?php
	}
}


