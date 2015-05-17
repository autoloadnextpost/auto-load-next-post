<?php
/**
 * Auto Load Next Post Conditional Functions
 *
 * Functions for determining the current query/page.
 *
 * @since    1.0.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'auto_load_next_post_is_ajax' ) ) {
	/**
	 * Returns true when the page is loaded via ajax.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool
	 */
	function auto_load_next_post_is_ajax() {
		if ( defined( 'DOING_AJAX' ) ) {
			return true;
		}
		return ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) ? true : false;
	} // END auto_load_next_post_is_ajax
}
