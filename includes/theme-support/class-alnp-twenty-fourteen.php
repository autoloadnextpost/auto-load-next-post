<?php
/**
 * Auto Load Next Post Theme Support: Twenty Fourteen
 *
 * Applies support for WordPress Twenty Fourteen Theme.
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
 * ALNP_Twenty_Fourteen class.
 */
class ALNP_Twenty_Fourteen {

	/**
	 * Initlize Theme.
	 *
	 * @access public
	 * @static
	 */
	public static function init() {
		// Override theme selectors.
		add_theme_support( 'auto-load-next-post' array(
			'content_container'    => '.site-content',
			'title_selector'       => 'h1.entry-title',
			'navigation_container' => 'nav.post-navigation',
			'comments_container'   => 'div#comments',
		) );
	} // END init()

} // END class

ALNP_Twenty_Fourteen::init();
