=== Storefront ===
Contributors: automattic, tiagonoronha, jameskoster
Requires at least: 4.7
Tested up to: 5.2
Stable tag: 2.5.0
Version: 2.5.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: e-commerce, two-columns, left-sidebar, right-sidebar, custom-background, custom-colors, custom-header, custom-menu, featured-images, full-width-template, threaded-comments, accessibility-ready, rtl-language-support, footer-widgets, sticky-post, theme-options, editor-style

Storefront is the perfect theme for your next WooCommerce project.

== Description ==

Storefront is the perfect theme for your next WooCommerce project. Designed and developed by WooCommerce Core developers, it features a bespoke integration with WooCommerce itself plus many of the most popular customer facing WooCommerce extensions. There are several layout & color options to personalize your shop, multiple widget regions, a responsive design and much more. Developers will love its lean and extensible codebase making it a joy to customize and extend. Looking for a WooCommerce theme? Look no further!

For more information about Storefront please go to https://woocommerce.com/storefront/.

For even more customization, check out Storefront extensions https://woocommerce.com/product-category/storefront-extensions/ and Storefront child themes https://woocommerce.com/product-category/themes/storefront-child-theme-themes/.

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in Storefront in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.
4. Go to https://docs.woocommerce.com/documentation/themes/storefront/ guides on how to customize this theme.
5. Navigate to Appearance > Customize in your admin panel and customize to taste.

== Copyright ==

This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.

Storefront is based on Underscores https://underscores.me/, (C) 2012-2017 Automattic, Inc.

Resetting and rebuilding styles have been helped along thanks to the fine work of
Eric Meyer https://meyerweb.com/eric/tools/css/reset/
along with Nicolas Gallagher and Jonathan Neal http://necolas.github.io/normalize.css/

All sizing (typography, layout, padding/margins etc) are inspired by a modular scale that uses 1em as a base size with a 1.618 ratio.
You can read more about the calculator we use in our sass here: https://github.com/modularscale/modularscale-sass

FontAwesome License: SIL Open Font License - http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL
Images License: GNU General Public License v2 or later

Storefront serves fonts via the hosted Google Fonts service. Storefront does not share any data with Google directly.
To the best of our knowledge, Google doesn’t track nor share end user data.
Privacy Policy for the Google Fonts API: https://developers.google.com/fonts/faq#what_does_using_the_google_fonts_api_mean_for_the_privacy_of_my_users

== Changelog ==

= 2.5.0 - 2019-05-09 =
* Feature - Updated Starter Content to make use of WooCommerce 3.6 blocks, and also the new cover block introduced in WordPress 5.2, to create a custom editable homepage.
* Tweak - Added edit link to post, pages, and products.
* Fix - Prevent overlap of site title and handheld menu button when not using a logo image.
* Fix - Added error styling to T&C checkbox and Country select in the Checkout page.
* Fix - Ensure all inputs use accent color set in the Customizer.
* Fix - Don't show sticky add to cart if product cannot be purchased.
* Fix - Added margin to view cart link in the "Added to cart" notice.
* Fix - Replaced CSS calc with Sass math when calculating block gallery column widths for better compatibility with IE11.
* Fix - Change color and size of "remove" icon in the Cart page.
* Fix - Change product pagination z-index for compatibility with PhotoSwipe.
* Fix - Fix double scrollbar when original length of the mini cart surpasses the end of the page.
* Fix - Move all Gutenberg assets to Gutenberg hooks.
* Dev - Updated Composite Products integration for compatibility with version 4.0.
* Dev - Updated FontAwesome to 5.8.1.

= 2.4.6 - 2019-04-26 =
* Fix - Sort homepage template categories by `menu_order` instead of `name`.
* Fix - Remove menu transition when no menu is assigned to primary location.

= 2.4.5 - 2019-03-15 =
* Fix - Revert changes made to the navigation menus that in some cases could cause menus to be hidden on the page.

= 2.4.4 - 2019-03-14 =
* Tweak - Update UTM parameters on WooCommerce.com links.
* Tweak - Compress and minify `pep.min.js`.
* Tweak - Minify CSS files in the `base` folder.
* Fix - Underline links in post content, footer, and breadcrumbs for better accessibility.
* Fix - Bolder outline styles for better accessibility.
* Fix - Stop Handheld Navigation items from being read by screen readers when the menu is collapsed.
* Fix - Add styling for product columns on the header widget area.
* Fix - Hide bundle/composite child cart items below the desktop size threshold.
* Fix - Split Jetpack styles into separate files to fix a flash of content when using the infinite scroll option.
* Dev - Update node dependencies.
* Dev - Handheld Footer Bar JavaScript moved from `navigation.js` to `footer.js`.

= 2.4.3 - 2019-02-05 =
* Feature - Replicate Storefront's layout logic in the block editor. Wide and Full-width options are made available only if supported.
* Enhancement - Product pagination is now circular and skips hidden products.
* Tweak - Remove unused variables from `inc/customizer/class-storefront-customizer.php`.
* Tweak - Refactored "Posted on" section in `storefront_post_meta()`.
* Tweak - Standardize mixing of static/non static function calls in the `Storefront_Customizer` class.
* Tweak - Remove padding and transition styles from post navigation.
* Fix - Remove hard coded colors for Blocks from `gutenberg-blocks.css` and use colors set in the Customizer instead.
* Fix - Clear floats on alignwide and alignfull blocks.
* Fix - When outputting custom styling for extensions, check if the object `$storefront` is in the expected format and has right properties.
* Dev - Babel added as a dependency.
* Dev - New `assets/js/src/editor.js` file.
* Dev - Revert filter name. `storefront_woocommerce_customizer_css` reverted to `storefront_customizer_woocommerce_css`.
* Dev - New hooks added to post header section: `storefront_post_header_before`, `storefront_post_header_after`.

= 2.4.2 - 2018-12-11 =
* Fix - Load in `functions.php` missing `storefront-woocommerce-functions.php` file required for compatibility with Jetpack's Infinite Scroll feature.
* Dev - Update order of Sass import files in `gutenberg-blocks.scss` and `gutenberg-editor.scss` to ensure that these are compiled correctly.
* Dev - Update Grunt tasks.

= 2.4.1 - 2018-12-06 =
* Fix - Fatal error caused by a method incorrectly defined as static.
* Fix - Remove unnecessary trailing slash in the first `load_theme_textdomain()` call.

= 2.4.0 - 2018-12-06 =
* Feature - Add support for the new blocks introduced in WordPress 5.0.
* Feature - Gutenberg editor styles.
* Feature - Redesign blog post templates.
* Tweak - Remove legacy Jetpack logo feature.
* Tweak - Move all WooCommerce related code inside of the `inc/woocommerce` directory.
* Fix - Allow zooming and scaling for improved accessibility.
* Fix - Multiple code standards improvements.

= 2.3.5 - 2018-10-24 =
* Fix - Use Pointer Events API for consistency across touchscreen devices when interacting with menus.
* Fix - Removed CSS rule that was incorrectly changing the width of image logos to 100%.

= 2.3.4 - 2018-10-11 =
* Tweak - Introduced new styles for enhanced compatibility with Composite Products 3.14.0 and Product Bundles 5.8.0.
* Fix - Improved touch support for dropdowns.
* Fix - Added missing RTL support to the Guided Tour in the Customizer.
* Fix - Added a fix to prevent starter content from showing up if not entering the customizer through the NUX.
* Fix - Fixed clearing of cart item rows on handheld screens.
* Fix - Changed store notice `z-index` value to prevent overlap with the handheld footer bar.

= 2.3.3 - 2018-07-18 =
* Tweak - Removed `user-scalable=no` from the viewport meta tag to allow for zooming on mobile browsers.
* Tweak - Allow for a flexible height on the site logo.
* Tweak - Only try to add title from `data-title` to responsive table columns that have this attribute set.
* Fix - Prevent select box from overflowing its wrapping container.
* Fix - Fixed handheld sub navigation dropdown toggle color. It now uses the same color set for the links.
* Fix - Fixed price label direction when in RTL.
* Fix - Removed related products static number of columns. It will now use the value from the wrapper `ul.products`.
* Fix - Removed font weight from default link styles for better compatibility with design plugins.
* Fix - Fixed H3 scopping in WooCommerce Brands integration.
* Fix - Fixed bundle layout issues in Composite Products integration.

= 2.3.2 - 2018-05-30 =
* Tweak - Replaced `wp_kses_data()` with `wp_kses_post()` on price outputs in the Mini-Cart and Sticky Add-To-Cart.
* Tweak - Added support for `tel` type fields in forms.
* Tweak - Replaced legacy homepage shortcodes with the new `[products]` shortcode.
* Fix - WooCommerce Memberships mobile table styling.
* Fix - Moved margin from `.woocommerce-breadcrumb` to the new `.storefront-breadcrumb` wrapper.
* Fix - Fixed alignment of mobile menu toggle.
* Fix - Removed H1 from logo when the Homepage is not the Blog page.
* Dev - Removed legacy Sass mixins.

= 2.3.1 - 2018-05-10 =
* Feature - Add support for GDPR features soon to be introduced in WordPress 4.9.6.
* Tweak - Removed inline CSS cache; WordPress autoloads options by default, there's no advantage to caching the CSS.
* Fix - Made changes to `icons.scss` to address an issue where Font Awesome icons were not being displayed correctly on some sites.
* Fix - Apply clearfix to `.col-full` globally.

= 2.3.0 - 2018-05-08 =
* Feature - Sticky Add-To-Cart.
* Feature - Product Pagination.
* Feature - WooCommerce Brands integration.
* Tweak - Increased size of branding section if secondary navigation not used.
* Tweak - Added a screen reader label to post navigation links.
* Tweak - Removed RGBaster and added Customizer controls to change the color of text in the homepage Hero section.
* Tweak - Removed NUX notice if coming from the WooCommerce wizard.
* Tweak - Updated My Account layout.
* Tweak - Removed column wrappers, unnecessary as of WooCommerce 3.3.
* Tweak - Removed Jetpack Infinite Scroll hacks; they are no longer needed as of the latest version of Jetpack / WooCommerce.
* Tweak - Removed "Free Extensions" column from Welcome page.
* Fix - Reduce padding on cart table to prevent sidebar from overflowing container.
* Fix - Hide handheld footer bar when an input is focused.
* Fix - Prevent entry meta author styles from being applied to the author archives.
* Fix - All included JavaScript is now compatible with Internet Explorer 11.
* Fix - Added styling for other buttons in the header mini cart added by extensions.
* Fix - Improved semantic HTML for pages and single posts.
* Fix - Removed negative margins in the primary navigation and breadcrumb containers to fix an overflow issue in the Linux version of Chrome.
* Fix - Removed 1px pixel margin on the product images gallery.
* Fix - Added missing styles to Composite Products integration.
* Dev - Upgrade to Font Awesome 5.
* Dev - Remove `composer.json` from production version.
* Dev - Added CSS style linting.
* Dev - Renamed the `sass` folder to `css`. All `.scss` files are now excluded from the production version.

= 2.2.8 - 2018-02-13 =
* Fix - Image bleed from next image in the gallery.
* Fix - H1 site title tag on Front page instead of Posts page.
* Fix - Number of columns and rows can now be changed in the Customizer.
* Fix - Logo image size in Internet Explorer.
* Fix - Prevent sidebar from overflowing the content at small sizes on cart page.
* Fix - 404 page responsive layout.
* Tweak - Updated development blog links.
* Feature - WooCommerce Memberships integration.

= 2.2.7 - 2018-01-23 =
* Fix - Reverted Chromium overflow fix introduced in 2.2.6 due to incompatibility with other Storefront products.
* Fix - Jetpack Google Translate widget styling.
* Tweak - Improved Grouped products table styling.
* Dev - Added filters; `storefront_custom_logo_args`, `storefront_register_nav_menus`, `storefront_html5_args`, and `storefront_site_logo_args`.

= 2.2.6 - 2018-01-16 =
* Fix - Price slider widget styling.
* Fix - Apply styles to `a.woocommerce-store-notice__dismiss-link` instead of all links in the store notice.
* Fix - Fix hidden content when there are no reviews.
* Fix - Fixed typo in the `Storefront_WooCommerce` class, `thumbnail_columns` method description. Kudos [@cryptexvinci](https://github.com/cryptexvinci).
* Tweak - Added vcard markup to template.
* Tweak - Improved My Account Payment Methods styles.
* Tweak - Improved the Bookings calendar styles.
* Tweak - Removed jQuery dependency. Kudos [@valdrinkoshi](https://github.com/valdrinkoshi).
* Tweak - Added "Navigation menus" step to Guided tour.
* Tweak - Guided tour in the Customizer is now shown to all sites.
* Dev - Removed non-standard outdated CSS. Kudos [@ElectricFeet](https://github.com/ElectricFeet).
* Dev - Removed sticky cart. See [this issue](https://github.com/woocommerce/storefront/issues/637) for more information.
* Dev - [WooCommerce 3.3] - Support for new columns & rows option in the customizer.
* Dev - [WooCommerce 3.3] - Declare image sizes.
* Dev - [WooCommerce 3.3] - Hide search button.
* Dev - `composer.json` file. Kudos [@pmgarman](https://github.com/pmgarman).

= 2.2.5 - 2017-08-21 =
* Feature - Add access to submenus from touchscreen devices. Kudos [@mikeyarce](https://github.com/mikeyarce).
* Feature - Add styles for keyboard navigation on focus items. Kudos [@mikeyarce](https://github.com/mikeyarce).
* Fix - Fix hero image positioning when page has RTL direction.
* Tweak - Remove non-minified vendor script: `rgbaster.js`.
* Tweak - Enqueue non-minified versions of scripts when `SCRIPT_DEBUG` is defined.
* Dev - New hook to filter sidebar regions: `storefront_sidebar_args`.
* Dev - Adds `grunt-contrib-compress` to the build process.
* Fix - Remove 4th parameter being passed to `remove_action`, it only accepts 3. Kudos [@ashfame](https://github.com/ashfame).
* Fix - Limit product name cell to `300px` in the order review table.
* Fix - Check header cart contents length on `mouseover` to dynamically check if the height needs to be limited.
* Tweak - Removed Structured Data. See [this comment](https://github.com/woocommerce/storefront/issues/620#issuecomment-313629032).
* Fix - Header cart dropdown padding.
* Fix - Updated demo store notice `z-index` value to `9999` to prevent conflicts with other elements. Kudos [@iamdharmesh](https://github.com/iamdharmesh).
* Tweak - Replace WooThemes with WooCommerce.

= 2.2.4 - 2017-06-27 =
* Fix - Notice styling in the payment section of the checkout.
* Fix - Fix several typos in the theme description and customizer controls.
* Fix - Remove `:hover` and `:active` states on `.screen-reader-text`.
* Fix - Hide logo section from structured data if there's no image.
* Dev - New hook after body tag: `storefront_before_site`.
* Fix - Fix modular scale negative values not being compiled correctly.
* Tweak - Open documentation links in a new window.
* Fix - Translatable labels in the 404 template.
* Fix - Localize all aria labels.
* Dev - Remove `wp_kses_post()` from shortcodes output.
* Fix - Amend support link in admin header to link to the WordPress.org support forum.

= 2.2.3 - 2017-05-24 =
* Fix - Further improvements to prevent widgets from clearing after the update from 2.1.x.

= 2.2.2 - 2017-05-23 =
* Fix - Prevent starter content widgets, nav menus and pages from being added to existing sites unwontedly.
* Fix - Only set pages full width if fresh site.

= 2.2.1 - 2017-05-22 =
* Fix - Compatibility with PHP versions lower than 5.5.

= 2.2.0 - 2017-05-22 =
* Feature - Adding a featured image to the homepage template will now create a 'hero' component.
* Feature - Improved new user experience; WooCommerce installation prompted and added starter content to set up the homepage template, menus, widgets and add some demo products.
* Feature - Guided tour in the Customizer.
* Fix - Remove unnecessary button styling in WooCommerce Quick View extension.
* Fix - Only make the order review on checkout sticky of the address column is tall enough to make it worthwhile.
* Tweak - Improved the Bookings calendar styles.
* Tweak - :focus borders now dotted.
* Tweak - Default header background color is now white and header text color defaults updated accordingly.
* Tweak - Various typographical adjustments to match updated header design.
* Dev - Added actions; `storefront_jetpack_infinite_scroll_before`, `storefront_jetpack_infinite_scroll_after`, `storefront_jetpack_product_infinite_scroll_before` and `storefront_jetpack_product_infinite_scroll_after`.
* Dev - Added filters; `storefront_footer_widget_rows` and `storefront_footer_widget_columns` to easily control the number of widget rows / columns in the footer.
* Dev - FontAwesome and icon styles are now enqueued separately to make removing FontAwesome trivial.
* Dev - Updated FontAwesome to 4.7.0
* Dev - Upsells columns filterable via `storefront_upsells_columns`.
* Dev - Added a column wrapper to product loops. To adjust the layout you now only need to filter `storefront_loop_columns`.
* Dev - Homepage product sections only display if products are returned.
* Tweak - Escape background content color before output. Kudos [@pdewouters](https://github.com/pdewouters).
* Dev - Updated package versions. You'll need to `npm install` next time you try to build.
* Dev - Adds `grunt-postcss` + `autoprefixer` to the build process to reduce reliance on [Bourbon](https://www.bourbon.io/).
* Tweak - Doctype in lowercase. Kudos [@B-07](https://github.com/B-07).
* Fix - Only output `background-image` styles for the header and homepage content sections if an image exists.
* Fix - Translatable aria labels in the homepage sections. Kudos [@andreaskian](https://github.com/andreaskian).

= 2.1.8 - 2017-02-17 =
* Tweak - [WooCommerce 2.7] - Declare support for the new gallery.

= 2.1.7 - 2017-01-17 =
* Tweak - [WooCommerce 2.7] - Ensure all checkboxes function correctly with new markup.
* Tweak - [WooCommerce 2.7] - Order item meta styling.
* Tweak - [WooCommerce 2.7] - Don't display the stock icon when `.stock` is empty.
* Fix - Cross-sells layout

= 2.1.6 - 2016-11-15 =
* Fix - Close dropdowns in the nav when you tap away on touch devices.
* Fix - Ensure the header cart dropdown works properly on touch devices.
* Fix - 404 layout.
* Fix - Javascript error when `.site-header-cart` isn't present in the DOM.
* Fix - Consistent spacing in site title.
* Dev - Refactored `storefront_get_content_background_color()` to account for and give priority (over Storefront Designer) to Storefront Powerpack.
* Dev - Deprecated `is_woocommerce_activated()` and made it pluggable.
* Dev - Added `storefront_is_woocommerce_activated()`.

= 2.1.5 - 2016-10-24 =
* Tweak - Jetpack infinite scroll now works on product archives as well as posts.
* Tweak - Add styles for WooCommerce 2.7's new gallery.
* Tweak - Style the 'dismiss' link in WooCommerce 2.7's 'demo notice' feature.

= 2.1.4 - 2016-10-11 =
* Fix - Product/category title size in loops (WooCommerce 2.7 compatibility).
* Fix - Star rating selector when WooCommerce lightbox is disabled.
* Fix - Dropdowns can now be closed on iOS.
* Fix - PHP 5.2 compatibility.
* Tweak - Structured data sanitization and other minor adjustments.
* Tweak - Header cart dropdown now only scrolls if it renders beyond the current window height.
* Tweak - Star rating selector styling.
* Tweak - Widget region order. Addresses the issue of widgets being added to an unexpected region on default installs.
* Dev - `storefront_post_thumbnail()` is now hooked in to `storefront_post_content_before`.
* Dev - Added `storefront_post_content_before` and `storefront_post_content_after` actions.
* Dev - `storefront_post_thumbnail()` now provides a default size.
* Dev - Updated FontAwesome to 4.6.3.

= 2.1.3 - 2016-09-26 =
* Fix - Dropdowns in the main navigation when tabbing through links.
* Fix - Hide empty labels when using the Advanced Product Labels extension.
* Tweak - Updated MasterCard logo. Kudos [@nishitlangaliya](https://github.com/nishitlangaliya).

= 2.1.2 - 2016-09-08 =
* Fix - Fatal errors in the Customizer when using older versions of WordPress.
* Tweak - blockUI styling on checkout.
* Dev - Tweaked how Customizer defaults are set so that checkboxes will work.

= 2.1.1 - 2016-09-02 =
* Fix - Changed some customizer settings transport from postMessage to refresh for live preview of changes.
* Fix - Secondary navigation dropdown styling.
* Dev - Restructured the way objects are initiated. Objects are now initiated into an accessible global $storefront for access to hooks. Kudos [@jtsternberg](https://github.com/jtsternberg).

= 2.1.0 - 2016-08-24 =
* Feature - Lots of SEO enhancements. Kudos [@opportus](https://github.com/opportus).
* Feature - Selective refresh on site title, tag line, logo and widgets.
* Feature - Integration with [Advanced Product Labels](https://woocommerce.com/products/woocommerce-advanced-product-labels/) extension.
* Feature - Integration with [WooCommerce Mix and Match](https://woocommerce.com/products/woocommerce-mix-and-match-products/) extension.
* Feature - Integration with [WooCommerce Quick View](https://woocommerce.com/products/woocommerce-quick-view/) extension.
* Fix - Product thumbnail size on cart page.
* Fix - Sticky order review position on RTL stores. Kudos [@farookibrahim](https://github.com/farookibrahim)
* Dev - Restructured scss; removed components/typography and added main styles to `assets/sass/base/_base.scss`. Layout styles then added to `assets/sass/base/_layout.scss`. Moved WooCommerce extension integration styles to `assets/sass/woocommerce/extensions/`.

= 2.0.7 - 2016-07-26 =
* Fix - Compatibility with PHP 5.2.
* Fix - Further structured data sanitization.
* Dev - Added .editorconfig.

= 2.0.6 - 2016-07-22 =
* Fix - Added missing laser card icon.
* Fix - Additional menu displayed on handheld when a menu isn't assigned to the 'primary' location.
* Fix - Structured data sanitization.
* Fix - Photography extension layout on handheld devices.
* Tweak - Product Bundles integration tweaks.
* Tweak - Updated all docs links to point to docs.woocommerce.com.
* Dev - Made `storefront_primary_navigation_wrapper()` and `storefront_primary_navigation_wrapper_close()` pluggable.

= 2.0.5 - 2016-07-05 =
* Fix - Saved payment method styling.
* Fix - Card expiry date layout in checkout.
* Fix - Product loop links in widgets are no longer underlined.
* Tweak - Secondary nav wrapper no longer present is no menu is assigned. Kudos [@titanic-fanatic](https://github.com/titanic-fanatic).

= 2.0.4 - 2016-06-14 =
* Fix - Credit card input label styling.
* Fix - `$content_width` declaration.
* Fix - Mobile menu when using an empty menu in the primary menu location.
* Tweak - Minor style fixes / improvements for various WooCommerce extensions.
* Tweak - Account / Cart links in the handheld nav bar will only appear if the pages are set in WooCommerce.
* Tweak - Footer padding on handheld devices.
* Tweak - `pre` background color to ensure legibility when displayed in messages.
* Dev - Deprecate `storefront_html_tag_schema()`.

= 2.0.3 - 2016-06-02 =
* Fix - Fatal error when using Storefront without WooCommerce.

= 2.0.2 - 2016-06-01 =
* Fix - Correct CSS property applied to the header if no background image is present.
* Fix - Sticky order review + Checkout Add-ons compatibility.
* Fix - Active link color when using the Custom Menu widget in the sidebar.
* Fix - Store notice no longer hidden by the handheld nav bar.
* Fix - Some errors in structured data. Kudos [@opportus](https://github.com/opportus).
* Dev - Added `storefront_sticky_order_review` filter.
* Dev - Added `storefront_structured_data` filter for structured data customisation.

= 2.0.1 - 2016-05-12 =
* Fix - Horizontal scroll bar on Safari.
* Fix - Ensure the menu toggle background color updates correctly in the preview.
* Fix - Positioning of cart icon in header cart link.
* Fix - Missing Customizer settings after updating to 2.0.0.
* Tweak - Blog pagination hover effect.
* Tweak - Apply the 'alt' button style to the checkout button in the cart widget.
* Dev - Apply Customizer setting defaults on `customize_register` to account for child themes filtering `storefront_setting_default_values`.
* Dev - Fix typo in the `storefront_homepage_after_best_selling_products` action name.

= 2.0.0 - 2016-05-06 =
* Feature - Extensive improvements to the responsive design.
* Feature - Design refresh including full typography revamp.
* Feature - Refactored all underlying code and re-organised / minified assets.
* Feature - Added 'Best Sellers' product section to the Homepage.
* Feature - oEmbed styling to match Storefront aesthetic.
* Feature - The welcome screen now dynamically pulls in new products.
* Feature - Added `storefront_header_styles()` for the header image/styles along with the `storefront_header_styles` filter to customise the treatment of header styles.
* Feature - Support for the Custom Logo theme feature (requires WordPress 4.5).
* Feature - Styled 'Average Rating' widget.
* Feature - Styled WooCommerce 2.6 tabbed account section.
* Tweak - All template functions are now pluggable.
* Tweak - The 'menu' button is now styled automatically based on header settings in the Customizer.
* Tweak - Customizer settings are now all assigned to a single theme mod on theme switch and Customizer save to improve performance.
* Tweak - Humanised homepage product section titles.
* Tweak - Redesigned blog post meta section.
* Tweak - Comments / Reviews design.
* Fix - Inadequate left/right content margin at certain screen sizes.
* Fix - z-index on demo store notice.
* Fix - Checkout add-ons integration.
* Fix - Display of portrait logos on handheld devices.
* Dev - Deprecated `storefront_categorized_blog()`.
* Dev - Deprecated `storefront_sanitize_hex_color()`.
* Dev - Deprecated `storefront_sanitize_layout()`.

= 1.6.1 - 2016-01-18 =
* Tweak - Jetpack integration updates.
* Tweak - Styling for WooCommerce 2.5's terms positioning on the checkout.
* Tweak - Styling for WooCommerce 2.5's totals inc tax on the cart.
* Tweak - Removed the bottom border on the cart / checkout pages.
* Tweak - Renamed 'Header' widget region to 'Below Header'.
* Fix - WooCommerce active filters widget now styled.
* Fix - Image gallery layouts.
* Fix - Sticky order review feature now accounts for any size of payment box to avoid cutting off the Place Order button.

= 1.6.0 - 2016-01-05 =
* Feature - [Storefront Mega Menus](https://woocommerce.com/products/storefront-mega-menus/) integration.
* Feature - Integration with [Ship to Multiple Addresses](https://woocommerce.com/products/shipping-multiple-addresses/) extension.
* Feature - Sticky order review on checkout.
* Feature - Automatic credit card type detection in compatible payment gateways.
* Tweak - Styled the in stock/out of stock message. Props @nishitlangaliya.
* Tweak - Added new function `storefront_star_rating_script`. Outputs JavaScript for the new star rating input while we wait for WooCommerce 2.5 to be released.
* Tweak - Contrast on hovered links in the primary navigation.
* Tweak - If no widgets are present in the sidebar a full width layout will be applied to all pages.
* Tweak - Updated integration with the Variation Swatches extension.
* Tweak - Featured images on posts / pages are now centered.
* Fix - Table alignment on desktop.
* Dev - Added some new hooks to the homepage template tags; `storefront_homepage_after_product_categories_title`, `storefront_homepage_after_recent_products_title`, `storefront_homepage_after_featured_products_title`, `storefront_homepage_after_popular_products_title`, `storefront_homepage_after_on_sale_products_title`
* Dev - Styling for 6 column product layouts.
* Dev - Updates FontAwesome to version 4.5.0.

= 1.5.3 - 2015-11-13 =
* Fix - Storefront will now automatically load a child themes stylesheet.
* Fix - CSS Syntax error in Customizer output.
* Tweak - WooCommerce responsive table styles.

= 1.5.2 - 2015-10-30 =
* Fix - Duplicate menu display when not using a handheld menu and switching between desktop/handheld orientations.
* Tweak - Adjusts how CSS is enqueued for child theme compatibility with RTL.
* Tweak - Better display of prices in WooCommerce product widgets.
* Tweak - Improved caption display.
* Tweak - Re-organised welcome screen.
* Tweak - Adjusted Product Bundles integration to include support for the WooCommerce Product Bundles - Tabular Layout extension.
* Tweak - Styled the variation reset link.
* Tweak - Start rating input now more intuitive.
* Tweak - Added styles for WooCommerce password strength meter.
* Tweak - Arrange the login/registration forms on the account page into two columns.
* Tweak - Support for the most recent class applied to the site logo added by Jetpack.
* Dev - `storefront_display_comments` is now hooked into `storefront_single_post_after` with priority 20 (was 10).
* Localization - All translations are now managed on [WordPress.org](https://translate.wordpress.org/projects/wp-themes/storefront)
* Localization - Product names can no longer be translated.

= 1.5.1 - 2015-09-10 =
* Fix - Occasional text wrapping on product sorting dropdown.
* Fix - Double taps no longer required to click buttons in iOS browsers.
* Fix - Fixed the landing page layout in WordPress 4.3+
* Fix - Header cart now compatible with Currency Converter extension.
* Tweak - Embedded objects (videos etc) width will no longer exceed the width of their containing element.
* Tweak - Improved the ligibility of the active swatch when using the Variation Swatches extension.
* Dev - Improved how RTL stylesheets are enqueued.
* Dev - The default layout is now  filterable via `storefront_default_layout`.

= 1.5.0 - 2015-08-11 =
* Feature - rtl support.
* Feature - Integration with WooCommerce Deposits.
* Feature - Pages now display featured images above the page title.
* Feature - Revamped 404 page helpfulness to include product search, popular products and product ctegories.
* Feature - Integration with WooCommerce Bundles extension.
* Feature - Scrolling header cart.
* Fix - Welcome screen now only visible to admins.
* Fix - Horizontal scroll bar in Safari at small sizes.
* Fix - Pay for order screen layout when using full width page template on my account.
* Fix - Fixed display of disabled `option`s in Firefox.
* Dev - Added `storefront_sanitize_checkbox()` sanitization function.
* Dev - Added `Storefront_Custom_Radio_Image_Control` class for creating radio image controls in the Customizer.
* Dev - Added `storefront_post_thumbnail()`.
* Dev - Renamed `do_shortcode_func()` to `storefront_do_shortcode()`.
* Dev - Updated Composite Products integration for compatibility with 3.2.
* Dev - Updated normalize.css to 3.0.3.
* Tweak - Menu button spacing on handheld.
* Tweak - Button display in cart widgets.
* Tweak - The 'Configure Menus' button in the welcome screen now points to the Customizer.

= 1.4.6 - 2015-06-10 =
* Fix - `font-family` declaration on `select`s.
* Tweak - Escaping function used on homepage section titles.
* Tweak - Remove all instances of `do_shortcode()` to improve performance.
* Tweak - Reduced link focus outline from 2px to 1px.
* Dev - `$storefront_version` global when using a child theme.

= 1.4.5 - 2015-05-14 =
* Fix - Use the correct escaping function in `storefront_product_categories()`.
* Fix - Pagination when only showing product categories / subcategories on archives.
* Tweak - Logo prompt in Header section in Customizer.
* Tweak - Only output description paragraph in header if one is set.
* Tweak - Updated header image dimension recommendation.
* Tweak - Dismissible notices.
* Tweak - Debug notices in WooCommerce message. Props @WPprodigy.
* Dev - Bump npm susy to 2.2.3.
* Dev - Made `Layout_Picker_Storefront_Control` class pluggable. Props @niravmehta
* Dev - Added order and orderby parameters to homepage featured products template tag.
* Dev - Added before/after hooks inside homepage product sections.

= 1.4.4 - 2015-04-23 =
* Fix - Post author styles applied to incorrect child comments. Props @ibndawood.
* Fix - Third level dropdowns (and beyond) are now revealed in the correct situation.
* Fix - Header margin on homepage template when WooCommerce isn't activated.
* Fix - Dropdowns on touch devices.
* Fix - Pagination hidden correctly when only displaying categories / subcategories.
* Tweak - Output WooCommerce messages on all appropriate pages.
* Tweak - Revamped 'Enhance' section of welcome screen.
* Localization - Translation files are now included.

= 1.4.3 - 2015-04-08 =
* Fix - Star rating display in Safari.
* Tweak - Cart dropdown appears on focus.
* Tweak - Payment form layout/styling when paying from My Account.
* Tweak - Improvements to the product archive sorting / pagination layout and styling.
* Tweak - Layered nav list item styling.
* Tweak - Product meta styling.
* Tweak - Heading and Star Rating size on product loops.
* Dev - Updated node-sass and grunt-sass dependency versions.

= 1.4.2 - 2015-03-24 =
* Fix - Navigation not displaying if no menu is assigned to primary location.

= 1.4.1 - 2015-03-24 =
* Fix - Remove unnecessary `!important` declaration on star rating color.
* Fix - Star rating display in IE11.
* Fix - Site header margin when using shop page as homepage.
* Fix - Navigation on handheld devices when no menu is set.
* Tweak - Layout selector graphics.
* Tweak - Accessibility improvements in post meta.
* Tweak - Products widget styling.
* Tweak - Widget headings are now `h3`s.
* Tweak - Skip links are now a function (`storefront_skip_links()`) hooked into `storefront_header`.
* Tweak - Header widget region markup only displays when widgets are assigned.
* Tweak - `:focus` styles.
* Dev - Replaced `paginate_links()` with `the_posts_pagination()`.
* Dev - Replaced `previous_post_link()` and `next_post_link()` with `the_post_navigation()`.
* Dev - HTML5 widget support.
* Dev - Fixed typo in classname: `storefront-feautred-products` is now `storefront-featured-products`.
* Dev - Updated node-bourbon
* Dev - Replaced instances of `box-sizing` mixin with standard css.

= 1.4.0 - 2015-03-09 =
* Feature - Added a 'Handheld' menu location.
* Feature - Many accessibility improvements.
* Fix - Header margin when WooCommerce isn't activated.
* Fix - Subscription payment form layout.
* Tweak - Pagination now clears content.
* Tweak - Header cart now displays sub total.
* Dev - Removed npm-debug.log.

= 1.3.1 - 2015-02-20 =
* Fix - Header margin when using static page or latest posts for homepage.
* Fix - Related products total / columns.
* Tweak - Product Reviews Pro submission form.
* Tweak - Review form input alignment.
* Tweak - Improved integration with WooCommerce Photography extension.
* Dev - Added `storefront_related_products_args` filter.

= 1.3.0 - 2015-02-10 =
* Feature - Support for WooCommerce 2.3 features like responsive tables.
* Fix - Margin on site title / logo.
* Fix - Tweaked some css selectors in the checkout to improve compatiblity with Amazon Payments Advanced gateway.
* Fix - Layout selector in Firefox.
* Fix - `storefront_menu_toggle_text` filter. Props [jesinwp](https://github.com/jesinwp).
* Tweak - Product Reviews Pro integration.
* Tweak - Select width in WooCommerce forms.
* Tweak - Composite Products integration improvements.
* Tweak - Removed header widget region bottom margin.
* Tweak - Increased size of photos displayed in the WooCommerce Photography extension.
* Tweak - Page / term description width.
* Tweak - Hide 'What is WooCommerce' section on welcome screen when it's already installed.
* Tweak - Widget region order in dashboard.
* Tweak - Add the correct page content hook in the inline docs ( template-homepage.php ).
* Tweak - `mark` styling.
* Dev - Added `storefront_sanitize_choices()`.
* Dev - Tweaked the divider Customizer control to allow text/title.
* Dev - Updated FontAwesome to version 4.3.0.
* Dev - Libsass / node susy for faster compiling. Please do a fresh `npm install` when working with this version.

= 1.2.5 - 2015-01-22 =
* Fix - Review form input alignment.
* Tweak - Widget region order in dashboard.
* Tweak - Post archive pagination is now numbered.
* Tweak - Styling for current post / product category in widgets.
* Tweak - Added an informational section to the Customizer.
* Tweak - Link color in the sidebar.
* Tweak - Padding in the header.
* Tweak - Breadcrumb position.
* Dev - `storefront_header_cart()` is now pluggable.
* Dev - Make use of WordPress 4.1 functions `the_archive_title()` and `the_archive_description()`.

= 1.2.4 - 2015-01-15 =
* Fix - First level threaded comment layout.
* Tweak - Improved font size on handheld devices.
* Tweak - Wishlist table design.
* Dev - Reorganised sass files.
* Dev - Added some handy class names to homepage product sections.
* Dev - Added `storefront_menu_toggle_text` filter.
* Dev - Updated how WooCommerce styles are dequeued.

= 1.2.3 - 2015-01-07 =
* Fix - Button border in WooCommerce messages when using the Storefront Designer extension.
* Tweak - Stock icon.
* Dev - Grid system now powered by Susy.

= 1.2.2 - 2015-01-05 =
* Fix - Hidden publish date on single post.
* Fix - Order details color.
* Tweak - Header widget z-index for when used with Parallax Hero.
* Tweak - Nested `ul`s in widgets.
* Tweak - Product category widget styling.
* Tweak - Make use of WordPress 4.1's `title-tag` theme feature. (Requires WordPress 4.1).
* Tweak - Welcome screen tweaks for WordPress 4.1.
* Tweak - Slightly reduced button/input size.
* Dev - Made `storefront_product_search()` pluggable.

= 1.2.1 - 2014-12-09 =
* Fix - Blog post category and tag link output.
* Fix - Cart link in handheld orientation.
* Tweak - Improved payment form display when using a dark background colour.
* Tweak - Blog author rich snippet.
* Dev - Added `storefront_single_post_posted_on_html` filter.
* Dev - Replaced reset.css with normalize.css.

= 1.2.0 - 2014-12-02 =
* Feature - Integration with Product Reviews Pro extension.
* Feature - Integration with Smart Coupons extension.
* Fix - Layout picker images when using a child theme.
* Fix - Header link color now properly applied to site title.
* Fix - Included styling for `.form-row-wide`.
* Dev - Added `storefront_copyright_text` filter.
* Dev - Tweaked how Storefront determines whether Customizer logic should be loaded.
* Dev - Added `storefront_after_footer` action.
* Dev - Customizer CSS now correctly appended to appropriate stylesheets.
* Tweak - Improved star rating input display for handheld devices.
* Tweak - Several minor code optimisations (thanks https://scrutinizer-ci.com).

= 1.1.1 - 2014-11-24 =
* Fix - Title tag now displays correctly.
* Localization - Tweaked how translation files are loaded.

= 1.1.0 - 2014-11-21 =
* Feature - Integration with AJAX Layered Navigation extension.
* Feature - Integration with Variation Swatches and Photos extension.
* Feature - Integration with Composite Products extension.
* Feature - Integration with WooCommerce Photography extension.
* Feature - Integration with Jetpacks `site-logo` feature.
* Tweak - Create account checkbox styling at checkout.
* Tweak - Added support for WordPress 4.1s `title-tag` theme feature.
* Tweak - Softened default text color slightly.
* Tweak - Styling for valid/invalid inputs.
* Tweak - Price filter slider styling.
* Tweak - Default settings for display options.
* Tweak - Added custom layout picker control.
* Tweak - Removed unused animation styles.
* Tweak - Default customizer settings added.

= 1.0.3 - 2014-10-15 =
* Fix - Comment date link color.
* Fix - Comment reply link color.
* Tweak - Sanitize layout setting.
* Tweak - No redirect to welcome screen on activation.

= 1.0.2 - 2014-10-12 =
* Fix - Upsell display on cart when using full width template.
* Fix - Smiley display.
* Fix - Date font size in post meta.
* Fix - Remove the breadcrumb separator to resolve markup errors.
* Fix - Returning to the welcome screen from the Customizer.
* Tweak - Clearfixed product galleries.
* Tweak - Adjusted the add to cart form design on product details pages.
* Tweak - Set a default border color on buttons for extensions to utilise.
* Tweak - Adjusted the max-height of images in the payment method list items.
* Tweak - Secondary navigation alignment in header.
* Tweak - Sale marker display is more universally friendly and customisable.
* Tweak - Moved the header controls in to the header image section.
* Tweak - Removed header widget border.
* Tweak - `.site-main` margin.
* Dev - Added `storefront_product_thumbnail_columns` filter.
* Dev - Added `Gruntfile.js` and `package.json`.

= 1.0.1 - 2014-09-14 =
* Tweak - Improved vertical spacing in the site header on mobile sized devices.
* Tweak - Updated some links & content in the welcome screen.
* Tweak - Improved comment/review respond form layout.
* Fix - Header text color live preview in cart dropdown.

= 1.0.0 - 2014-09-05 =
* Initial release
