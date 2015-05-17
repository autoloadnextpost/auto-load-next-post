<?php
/**
 * Auto Load Next Post Admin Functions
 *
 * @since    1.0.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Get all Auto Load Next Post screen ids
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function auto_load_next_post_get_screen_ids() {
	$auto_load_next_post_screen_id = AUTO_LOAD_NEXT_POST_SCREEN_ID;

	return apply_filters( 'auto_load_next_post_screen_ids', array(
		'settings_page_' . $auto_load_next_post_screen_id,
	) );
} // END auto_load_next_post_get_screen_ids()
