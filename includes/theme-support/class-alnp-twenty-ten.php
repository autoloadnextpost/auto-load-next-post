<?php
/**
 * Auto Load Next Post Theme Support: Twenty Ten
 *
 * Applies support for WordPress Twenty Ten Theme.
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ALNP_Twenty_Ten class.
 *
 * @extends ALNP_Theme_Support
 */
class ALNP_Twenty_Ten extends ALNP_Theme_Support {

	/**
	 * Initlize Theme.
	 *
	 * @access public
	 * @static
	 */
	public static function init() {
		// Filters the repeater template location.

		// Override theme selectors.
		add_theme_support( 'auto-load-next-post' array(
			'content_container'    => '#content',
			'title_selector'       => 'h1.entry-title',
			'navigation_container' => '#nav-below',
			'comments_container'   => 'div#comments',
		) );
	} // END init()

} // END class

ALNP_Twenty_Ten::init();
