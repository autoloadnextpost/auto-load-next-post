<?php
/**
 * Auto Load Next Post Theme Support: Poseidon
 *
 * Applies support for Poseidon Theme.
 *
 * @since    1.5.9
 * @version  1.5.10
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
 * ALNP_Poseidon class.
 */
class ALNP_Poseidon {

	/**
	 * Initlize Theme.
	 *
	 * @access public
	 * @static
	 */
	public static function init() {
		// Add theme support and preset the theme selectors.
		add_action( 'after_setup_theme', array( __CLASS__, 'add_theme_support' ) );

		// Display the post thumbnail before the content.
		add_action( 'alnp_load_before_content', array( __CLASS__, 'the_post_thumbnail' ), 10 );

		// Filters the repeater template location.
		add_filter( 'alnp_template_location', array( __CLASS__, 'alnp_poseidon_template_location' ) );
	} // END init()

	/**
	 * Display the post thumbnail before the content if the 
	 * theme is set to display them only in the header.
	 *
	 * @access  public
	 * @static
	 * @since   1.5.9
	 * @version 1.5.10
	 */
	public static function the_post_thumbnail() {
		// Get theme options from database.
		$theme_options = poseidon_theme_options();

		if ( is_single() && has_post_thumbnail() && 'header' == $theme_options['post_layout_single'] ) {
			the_post_thumbnail();
		}
	} // END the_post_thumbnail()

	/**
	 * Filters the template location for get_template_part().
	 *
	 * @access public
	 * @static
	 */
	public static function alnp_poseidon_template_location() {
		return 'template-parts/';
	} // alnp_poseidon_template_location()

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

ALNP_Poseidon::init();
