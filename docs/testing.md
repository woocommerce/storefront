# Testing Storefront

This document lists the features and flows supported in Storefront. This is not an exhaustive list.

## WooCommerce - core eCommerce features
- [ ] Explore product catalogue on shop page and category pages.
- [ ] Explore specific products on single product page.
- [ ] Search for products using keywords.
- [ ] Identify products which are currently on sale.
- [ ] Add products to cart, view cart, manage cart contents.
- [ ] Checkout and complete purchase.
- [ ] Use coupons in cart/checkout for a discount or free shipping.
- [ ] Sign up for a customer account.
- [ ] Log in as customer, view account info, manage account, change password.
- [ ] Customer can view previous orders.
- [ ] Visitors and customers can review and rate products.
- [ ] Visitors can view reviews & ratings of products.
- [ ] Merchant can customise eCommerce related features in pages and layout areas via WooCommerce widgets.

## WooCommerce - editing and publishing content
- [ ] Merchant can build pages and posts showing specific products.
- [ ] Merchant can build pages and posts for exploring / searching product catalogue.
- [ ] Merchant can use reviews on pages and posts.
- [ ] Merchants and build pages and posts showing a grid of products that the customer can filter/search.

### Testing tips 
- This category also covers traditional shortcodes.

## Storefront features
- [ ] Storefront shows an onboarding / welcome notice which guides user to set up Storefront and create a homepage.
- [ ] Homepage template showcases product catalogue.
- [ ] Merchant can author pages that use the full page width.
- [ ] Merchant can enable a sticky "add to cart" header on product pages so CTA button doesn't get lost when scrolling product page.
- [ ] Visitor can view and zoom product images on product pages, and use swipe gestures to walk through images on mobile devices.
- [ ] On smaller screens, a sticky footer provides easy access to important site functions (for example, shopping cart).

### Testing tips
- If you're not seeing the onboarding notice, delete the  `storefront_nux_dismissed` [option](https://codex.wordpress.org/Options_API) to bring it back. For example, with [WP CLI](https://developer.wordpress.org/cli/commands/option/): `wp option delete storefront_nux_dismissed`.

## Customization
- [ ] Merchant can use custom colors for site typography / text.
- [ ] Merchant can customize footer colors and widgets.
- [ ] Merchant can customize button colors.
- [ ] Merchant can choose a layout option (left/right sidebar).
- [ ] Merchant can customize menu locations - assign menus for and edit menu items.
- [ ] Merchant can customize WooCommerce store options (for example: store notice, shop page options, product image cropping).

## WordPress core - editing and publishing content
- [ ] Merchant can build pages and posts using WordPress core blocks.
- [ ] Merchant can customise page layout using core widgets and shortcodes.
- [ ] Block editor shows a realistic preview of the front end styling.
- [ ] Block editor styles respect customizer options where appropriate.
- [ ] Users can comment on posts and reply to previous comments.

### Testing tips
- Storefront includes support for adapting the editor to full/sidebar width as appropriate (see editor.js). For example, when editing a page with the full width template selected, the editor content area should be wider than normal.

## Storefront product family
- [ ] Storefront child themes work correctly to provide alternative store design / look and feel.
- [ ] Storefront extensions work correctly to provide additional flexibility and features.

