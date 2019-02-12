<?php
/**
 * Auto Load Next Post Theme Support: Twenty Nineteen
 *
 * Applies support for WordPress Twenty Nineteen Theme.
 *
 * @since    1.5.5
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
 * ALNP_Twenty_Nineteen class.
 */
class ALNP_Twenty_Nineteen {

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
		add_filter( 'alnp_template_redirect', array( __CLASS__, 'alnp_make_template_redirect' ) );
	} // END init()

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
			'comments_container'   => 'section#comments',
			'load_js_in_footer'    => 'no',
			'lock_js_in_footer'    => 'no',
		) );
	} // END add_theme_support()

	/**
	 * Filters the location of the repeater template.
	 *
	 * @access public
	 * @static
	 * @return string
	 */
	public static function alnp_make_template_redirect() {
		return AUTO_LOAD_NEXT_POST_FILE_PATH . '/template/theme-support/twentynineteen/content-alnp.php';
	} // END alnp_make_template_redirect()

} // END class

ALNP_Twenty_Nineteen::init();
