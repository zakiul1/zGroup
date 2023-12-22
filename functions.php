<?php
/**
 * zgroup functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package zgroup
 */

require get_template_directory() . '/inc/lib/init.php';

/**
 * Enqueue scripts and styles.
 */

require get_template_directory() . '/inc/lib/sytleEnque.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/inc/lib/slider.php';




class Flowbite_Walker_Nav_Menu extends Walker_Nav_Menu
{

	// Start Level
	function start_lvl(&$output, $depth = 0, $args = null)
	{
		$classes = array('dropdown-menu', 'shadow-md', 'bg-white');
		$class_names = implode(' ', $classes);
		$output .= "<div class='$class_names' data-dropdown>";
	}

	// End Level
	function end_lvl(&$output, $depth = 0, $args = null)
	{
		$output .= '</div>';
	}

	// Start Element
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ($depth) ? str_repeat($t, $depth) : '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$args = apply_filters('nav_menu_item_args', $args, $item, $depth);

		// Add Tailwind CSS classes for dropdowns
		if ($depth === 0) {
			$classes[] = 'py-2 px-4 block text-sm text-gray-700 hover:bg-blue-500 hover:text-white';
		} else {
			$classes[] = 'block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white';
		}

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts = array();
		$atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
		$atts['target'] = !empty($item->target) ? $item->target : '';
		$atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
		$atts['href'] = !empty($item->url) ? $item->url : '';

		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (!empty($value)) {
				$value = ($attr === 'href') ? esc_url($value) : esc_attr($value);
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = isset($args['before']) ? $args['before'] : '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= isset($args['link_before']) ? $args['link_before'] : '';
		$item_output .= apply_filters('the_title', $item->title, $item->ID);
		$item_output .= isset($args['link_after']) ? $args['link_after'] : '';
		$item_output .= '</a>';
		$item_output .= isset($args['after']) ? $args['after'] : '';


		if (is_array($item->classes) && in_array('menu-item-has-children', $item->classes)) {
			$item_output .= '<button onclick="this.nextElementSibling.classList.toggle(\'hidden\')" class="dropdown-toggle" data-dropdown-toggle="navbarDropdown">' . '<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">' . '<path d="M19 9l-7 7-7-7"></path>' . '</svg>' . '</button>';
		}

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	// End Element
	function end_el(&$output, $item, $depth = 0, $args = array())
	{
		$output .= "</li>\n";
	}
}