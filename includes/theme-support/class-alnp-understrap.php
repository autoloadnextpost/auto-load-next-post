<?php
/**
 * Auto Load Next Post Theme Support: Understrap
 *
 * Applies support for Understrap Theme.
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Theme Support
 * @package  Auto Load Next Post/Theme Support
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ALNP_Understrap class.
 */
class ALNP_Understrap {

	/**
	 * Initlize Theme.
	 *
	 * @access public
	 * @static
	 */
	public static function init() {
		// Add theme support and preset the theme selectors.
		add_action( 'after_setup_theme', array( __CLASS__, 'add_theme_support' ) );

		// Filters the repeater template location.
		add_filter( 'alnp_template_location', array( __CLASS__, 'alnp_understrap_template_location' ) );
	} // END init()

	/**
	 * Filters the template location for get_template_part().
	 *
	 * @access public
	 * @static
	 */
	public static function alnp_understrap_template_location() {
		return 'loop-templates/';
	} // alnp_understrap_template_location()

	/**
	 * Add theme support by providing the theme selectors
	 * to be applied once the theme is activated.
	 *
	 * @access public
	 * @static
	 */
	public static function add_theme_support() {
		add_theme_support( 'auto-load-next-post', array(
			'content_container'    => 'main.site-main',
			'title_selector'       => 'h1.entry-title',
			'navigation_container' => 'nav.post-navigation',
			'comments_container'   => 'div#comments',
			'load_js_in_footer'    => 'no',
			'lock_js_in_footer'    => 'no',
		) );
	} // END add_theme_support()

} // END class

ALNP_Understrap::init();
