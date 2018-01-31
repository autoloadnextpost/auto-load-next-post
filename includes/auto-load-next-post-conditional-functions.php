<?php
/**
 * Auto Load Next Post Conditional Functions
 *
 * Functions for determining the current query/page.
 *
 * @since    1.0.0
 * @version  1.4.8
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if ( ! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists('auto_load_next_post_is_ajax')) {
	/**
	 * Returns true when the page is loaded via ajax.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool
	 */
	function auto_load_next_post_is_ajax() {
		if (defined('DOING_AJAX')) {
			return true;
		}

		return(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
	} // END auto_load_next_post_is_ajax
}

if ( ! function_exists('supports_alnp')) {
	/**
	 * Returns true or false if Auto Load Next Post supports the theme.
	 *
	 * @since   1.4.3
	 * @version 1.4.9
	 * @access  public
	 * @return  boolen
	 */
	function supports_alnp() {
		/* WordPress core themes. */
		$core_themes = array(
			'twentyseventeen', 'twentysixteen', 'twentyfifteen', 'twentyfourteen', 'twentythirteen', 'twentytwelve', 'twentyten'
		);

		if (in_array(get_option('template'), $core_themes)) {
			return true;
		} else if (current_theme_supports('auto-load-next-post')) {
			return true;
		}

		return false;
	} // END supports_alnp()
}

if ( ! function_exists('alnp_template_location')) {
	/**
	 * Filters the template location for get_template_part().
	 *
	 * @since   1.4.8
	 * @version 1.4.9
	 * @access  public
	 * @return  boolen
	 */
	function alnp_template_location() {
		$current_theme = get_option('template');

		switch( $current_theme ) {
			case 'twentyseventeen':
				$path = 'template-parts/post/';
				break;

			case 'twentysixteen':
				$path = 'template-parts/';
				break;

			default:
				$path = '';
				break;
		}

		return $path;
	} // END alnp_template_location()

	add_filter('alnp_template_location', 'alnp_template_location');
}
