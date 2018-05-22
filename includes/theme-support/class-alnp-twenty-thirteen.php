<?php
/**
 * Auto Load Next Post Theme Support: Twenty Thirteen
 *
 * Applies support for WordPress Twenty Thirteen Theme.
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
 * ALNP_Twenty_Thirteen class.
 */
class ALNP_Twenty_Thirteen {

	/**
	 * Initlize Theme.
	 *
	 * @access public
	 * @static
	 */
	public static function init() {
		// This removes the default post navigation in the repeater template.
		remove_action( 'alnp_load_after_content', 'auto_load_next_post_navigation', 1, 10 );

		// Add a compaitable post navigation.
		add_action( 'alnp_load_after_content', 'alnp_twentythirteen_post_navigation', 1, 10 );

		// Override theme selectors.
		add_theme_support( 'auto-load-next-post' array(
			'content_container'    => '#content',
			'title_selector'       => 'h1.entry-title',
			'navigation_container' => 'nav.post-navigation',
			'comments_container'   => 'div#comments',
		) );
	} // END init()

	/**
	 * Adds a compaitable post navigation.
	 *
	 * @access public
	 * @static
	 */
	public static function alnp_twentythirteen_post_navigation() {
		twentythirteen_post_nav();
	} // END alnp_twentythirteen_post_navigation()

} // END class

ALNP_Twenty_Thirteen::init();
