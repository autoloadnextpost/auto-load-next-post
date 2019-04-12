<?php
/**
 * Auto Load Next Post Theme Support: OceanWP
 *
 * Applies support for OceanWP Theme.
 *
 * @since    1.5.8
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
 * ALNP_OceanWP class.
 */
class ALNP_OceanWP {

	/**
	 * Initlize Theme.
	 *
	 * @access public
	 * @static
	 */
	public static function init() {
		// Add theme support and preset the theme selectors.
		add_action( 'after_setup_theme', array( __CLASS__, 'add_theme_support' ) );

		// Filters the location of the repeater template.
		add_filter( 'alnp_template_redirect', array( __CLASS__, 'template_redirect' ) );

		// Filters the repeater template location.
		add_filter( 'alnp_template_location', array( __CLASS__, 'alnp_oceanwp_template_location' ) );

		// Remove Auto Load Next Post compatible post navigation.
		remove_action( 'alnp_load_after_content', 'auto_load_next_post_navigation', 1, 10 );
	} // END init()

	/**
	 * Filters the location of the repeater template to override the default repeater template.
	 *
	 * @access public
	 * @return string
	 */
	public static function template_redirect() {
		return AUTO_LOAD_NEXT_POST_FILE_PATH . '/template/theme-support/oceanwp/content-alnp.php';
	} // END template_redirect()

	/**
	 * Filters the template location for get_template_part().
	 *
	 * @access public
	 * @static
	 */
	public static function alnp_oceanwp_template_location() {
		return 'partials/single/';
	} // END alnp_oceanwp_template_location()

	/**
	 * Add theme support by providing the theme selectors
	 * to be applied once the theme is activated.
	 *
	 * @access public
	 * @static
	 */
	public static function add_theme_support() {
		add_theme_support( 'auto-load-next-post', array(
			'content_container'    => 'div.site-content',
			'title_selector'       => '.entry-title',
			'navigation_container' => 'nav.post-navigation',
			'comments_container'   => 'section#comments',
			'load_js_in_footer'    => 'no',
			'lock_js_in_footer'    => 'no',
		) );
	} // END add_theme_support()

} // END class

ALNP_OceanWP::init();
