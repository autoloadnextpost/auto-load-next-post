<?php
/**
   * Auto Load Next Post Formatting
   *
   * @since    1.0.0
   * @author   Sébastien Dumont
   * @category Core
   * @package  Auto Load Next Post/Functions
   * @license  GPL-2.0+
   */

if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly

/**
 * Clean variables
 *
 * @since  1.0.0
 * @access public
 * @param  string $var
 * @return string
 */
function auto_load_next_post_clean($var) {
	return sanitize_text_field($var);
} // END auto_load_next_post_clean()
