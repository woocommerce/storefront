<?php
/**
 * Storefront menu functions.
 *
 * @package storefront
 */

/**
 * Filters the arguments for a single nav menu item.
 *
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param WP_Post  $item  Menu item data object.
 * @param int      $depth Depth of menu item. Used for padding.
 *
 * @return stdClass
 */
function storefront_add_menu_description_args( $args, $item, $depth ) {
	$args->link_after = '';
	if ( 0 === $depth && isset( $item->description ) && $item->description ) {
		// The extra <span> element is here for styling purposes: Allows the description to not be underlined on hover.
		$args->link_after = '<p class="menu-item-description"><span>' . $item->description . '</span></p>';
	}
	return $args;
}
add_filter( 'nav_menu_item_args', 'storefront_add_menu_description_args', 10, 3 );
