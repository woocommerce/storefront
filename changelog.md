# Storefront Changelog

### *2015.06.10* - 1.4.6
* **Fix** - `font-family` delcaration on `select`s.
* **Tweak** - Escaping function used on homepage section titles.
* **Tweak** - Remove all instances of `do_shortcode()` to improve performance.
* **Tweak** - Reduced link focus outline from 2px to 1px.
* **Dev** - `$storefront_version` global when using a child theme.

### *2015.05.14* - 1.4.5
* **Fix** - Use the correct escaping function in `storefront_product_categories()`.
* **Fix** - Pagination when only showing product categories / subcategories on archives.
* **Tweak** - Logo prompt in Header section in Customizer.
* **Tweak** - Only output description paragraph in header if one is set.
* **Tweak** - Updated header image dimension recommendation.
* **Tweak** - Dismissible notices.
* **Tweak** - Debug notices in WooCommerce message. Props @WPprodigy.
* **Dev** - Bump npm susy to 2.2.3.
* **Dev** - Made `Layout_Picker_Storefront_Control` class pluggable. Props @niravmehta
* **Dev** - Added order and orderby parameters to homepage featured products template tag.
* **Dev** - Added before/after hooks inside homepage product sections.

### *2015.04.23* - 1.4.4
* **Fix** - Post author styles applied to incorrect child comments. Props @ibndawood.
* **Fix** - Third level dropdowns (and beyond) are now revealed in the correct situation.
* **Fix** - Header margin on homepage template when WooCommerce isn't activated.
* **Fix** - Dropdowns on touch devices.
* **Fix** - Pagination hidden correctly when only displaying categories / subcategories.
* **Tweak** - Output WooCommerce messages on all appropriate pages.
* **Tweak** - Revamped 'Enhance' section of welcome screen.
* **Localisation** - Translation files are now included.

### *2015.04.08* - 1.4.3
* **Fix** - Star rating display in Safari.
* **Tweak** - Cart dropdown appears on focus.
* **Tweak** - Payment form layout/styling when paying from My Account.
* **Tweak** - Improvements to the product archive sorting / pagination layout and styling.
* **Tweak** - Layered nav list item styling.
* **Tweak** - Product meta styling.
* **Tweak** - Heading and Star Rating size on product loops.
* **Dev** - Updated node-sass and grunt-sass dependency versions.

### *2015.03.24* - 1.4.2
* **Fix** - Navigation not displaying if no menu is assigned to primary location.

### *2015.03.24* - 1.4.1
* **Fix** - Remove unnecessary `!important` declaration on star rating color.
* **Fix** - Star rating display in IE11.
* **Fix** - Site header margin when using shop page as homepage.
* **Fix** - Navigation on handheld devices when no menu is set.
* **Tweak** - Layout selector graphics.
* **Tweak** - Accessibility improvements in post meta.
* **Tweak** - Products widget styling.
* **Tweak** - Widget headings are now `h3`s.
* **Tweak** - Skip links are now a function (`storefront_skip_links()`) hooked into `storefront_header`.
* **Tweak** - Header widget region markup only displays when widgets are assigned.
* **Tweak** - `:focus` styles.
* **Dev** - Replaced `paginate_links()` with `the_posts_pagination()`.
* **Dev** - Replaced `previous_post_link()` and `next_post_link()` with `the_post_navigation()`.
* **Dev** - HTML5 widget support.
* **Dev** - Fixed typo in classname: `storefront-feautred-products` is now `storefront-featured-products`.
* **Dev** - Updated node-bourbon
* **Dev** - Replaced instances of `box-sizing` mixin with standard css.

### *2015.03.09* - 1.4.0
* **New** - Added a 'Handheld' menu location.
* **New** - Many accessibility improvements.
* **Fix** - Header margin when WooCommerce isn't activated.
* **Fix** - Subscription payment form layout.
* **Tweak** - Pagination now clears content.
* **Tweak** - Header cart now displays sub total.
* **Dev** - Removed npm-debug.log.

### *2015.02.20* - 1.3.1
* **Fix** - Header margin when using static page or latest posts for homepage.
* **Fix** - Related products total / columns.
* **Tweak** - Product Reviews Pro submission form.
* **Tweak** - Review form input alignment.
* **Tweak** - Improved integration with WooCommerce Photography extension.
* **Dev** - Added `storefront_related_products_args` filter.

### *2015.02.10* - 1.3.0
* **New** - Support for WooCommerce 2.3 features like responsive tables.
* **Fix** - Margin on site title / logo.
* **Fix** - Tweaked some css selectors in the checkout to improve compatiblity with Amazon Payments Advanced gateway.
* **Fix** - Layout selector in Firefox.
* **Fix** - `storefront_menu_toggle_text` filter. Props [jesinwp](https://github.com/jesinwp).
* **Tweak** - Product Reviews Pro integration.
* **Tweak** - Select width in WooCommerce forms.
* **Tweak** - Composite Products integration improvements.
* **Tweak** - Removed header widget region bottom margin.
* **Tweak** - Increased size of photos displayed in the WooCommerce Photography extension.
* **Tweak** - Page / term description width.
* **Tweak** - Hide 'What is WooCommerce' section on welcome screen when it's already installed.
* **Tweak** - Widget region order in dashboard.
* **Tweak** - Add the correct page content hook in the inline docs ( template-homepage.php ).
* **Tweak** - `mark` styling.
* **Dev** - Added `storefront_sanitize_choices()`.
* **Dev** - Tweaked the divider Customizer control to allow text/title.
* **Dev** - Updated FontAwesome to version 4.3.0.
* **Dev** - Libsass / node susy for faster compiling. Please do a fresh `npm install` when working with this version.

### *2015.01.22* - 1.2.5
* **Fix** - Review form input alignment.
* **Tweak** - Widget region order in dashboard.
* **Tweak** - Post archive pagination is now numbered.
* **Tweak** - Styling for current post / product category in widgets.
* **Tweak** - Added an informational section to the Customizer.
* **Tweak** - Link color in the sidebar.
* **Tweak** - Padding in the header.
* **Tweak** - Breadcrumb position.
* **Dev** - `storefront_header_cart()` is now pluggable.
* **Dev** - Make use of WordPress 4.1 functions `the_archive_title()` and `the_archive_description()`.

### *2015.01.15* - 1.2.4
* **Fix** - First level threaded comment layout.
* **Tweak** - Improved font size on handheld devices.
* **Tweak** - Wishlist table design.
* **Dev** - Reorganised sass files.
* **Dev** - Added some handy class names to homepage product sections.
* **Dev** - Added `storefront_menu_toggle_text` filter.
* **Dev** - Updated how WooCommerce styles are dequeued.

### *2015.01.07* - 1.2.3
* **Fix** - Button border in WooCommerce messages when using the Storefront Designer extension.
* **Tweak** - Stock icon.
* **Dev** - Grid system now powered by Susy.

### *2015.01.05* - 1.2.2
* **Fix** - Hidden publish date on single post.
* **Fix** - Order details color.
* **Tweak** - Header widget z-index for when used with Parallax Hero.
* **Tweak** - Nested `ul`s in widgets.
* **Tweak** - Product category widget styling.
* **Tweak** - Make use of WordPress 4.1's `title-tag` theme feature. (Requires WordPress 4.1).
* **Tweak** - Welcome screen tweaks for WordPress 4.1.
* **Tweak** - Slightly reduced button/input size.
* **Dev** - Made `storefront_product_search()` pluggable.

### *2014.12.09* - 1.2.1
* **Fix** - Blog post category and tag link output.
* **Fix** - Cart link in handheld orientation.
* **Tweak** - Improved payment form display when using a dark background colour.
* **Tweak** - Blog author rich snippet.
* **Dev** - Added `storefront_single_post_posted_on_html` filter.
* **Dev** - Replaced reset.css with normalize.css.

### *2014.12.02* - 1.2.0
* **New** - Integration with Product Reviews Pro extension.
* **New** - Integration with Smart Coupons extension.
* **Fix** - Layout picker images when using a child theme.
* **Fix** - Header link color now properly applied to site title.
* **Fix** - Included styling for `.form-row-wide`.
* **Dev** - Added `storefront_copyright_text` filter.
* **Dev** - Tweaked how Storefront determines whether Customizer logic should be loaded.
* **Dev** - Added `storefront_after_footer` action.
* **Dev** - Customizer CSS now correctly appended to appropriate stylesheets.
* **Tweak** - Improved star rating input display for handheld devices.
* **Tweak** - Several minor code optimisations (thanks https://scrutinizer-ci.com).

### *2014.11.24* - 1.1.1
* **Fix** - Title tag now displays correctly.
* **Localisation** - Tweaked how translation files are loaded.

### *2014.11.21* - 1.1.0
* **New** - Integration with AJAX Layered Navigation extension.
* **New** - Integration with Variation Swatches and Photos extension.
* **New** - Integration with Composite Products extension.
* **New** - Integration with WooCommerce Photography extension.
* **New** - Integration with Jetpacks `site-logo` feature.
* **Tweak** - Create account checkbox styling at checkout.
* **Tweak** - Added support for WordPress 4.1s `title-tag` theme feature.
* **Tweak** - Softened default text color slightly.
* **Tweak** - Styling for valid/invalid inputs.
* **Tweak** - Price filter slider styling.
* **Tweak** - Default settings for display options.
* **Tweak** - Added custom layout picker control.
* **Tweak** - Removed unused animation styles.
* **Tweak** - Default customizer settings added.

### *2014.10.15* - 1.0.3
* **Fix** - Comment date link color.
* **Fix** - Comment reply link color.
* **Tweak** - Sanitize layout setting.
* **Tweak** - No redirect to welcome screen on activation.

### *2014.10.12* - 1.0.2
* **Fix** - Upsell display on cart when using full width template.
* **Fix** - Smiley display.
* **Fix** - Date font size in post meta.
* **Fix** - Remove the breadcrumb separator to resolve markup errors.
* **Fix** - Returning to the welcome screen from the Customizer.
* **Tweak** - Clearfixed product galleries.
* **Tweak** - Adjusted the add to cart form design on product details pages.
* **Tweak** - Set a default border color on buttons for extensions to utilise.
* **Tweak** - Adjusted the max-height of images in the payment method list items.
* **Tweak** - Secondary navigation alignment in header.
* **Tweak** - Sale marker display is more universally friendly and customisable.
* **Tweak** - Moved the header controls in to the header image section.
* **Tweak** - Removed header widget border.
* **Tweak** - `.site-main` margin.
* **Dev** - Added `storefront_product_thumbnail_columns` filter.
* **Dev** - Added `Gruntfile.js` and `package.json`.

### *2014.09.14* - 1.0.1
* **Tweak** - Improved vertical spacing in the site header on mobile sized devices.
* **Tweak** - Updated some links & content in the welcome screen.
* **Tweak** - Improved comment/review respond form layout.
* **Fix** - Header text color live preview in cart dropdown.

### *2014.09.05* - 1.0.0
* Initial release