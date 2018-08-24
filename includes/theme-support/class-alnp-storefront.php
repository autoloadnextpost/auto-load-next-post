<?php
/**
 * Auto Load Next Post Theme Support: Storefront
 *
 * Applies support for WooCommerce Storefront Theme.
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
 * ALNP_Storefront class.
 */
class ALNP_Storefront {

	/**
	 * Initlize Theme.
	 *
	 * @access public
	 * @static
	 */
	public static function init() {
		// Add theme support and preset the theme selectors.
		add_action( 'after_setup_theme', array( __CLASS__, 'add_theme_support' ) );
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

} // END class

ALNP_Storefront::init();
