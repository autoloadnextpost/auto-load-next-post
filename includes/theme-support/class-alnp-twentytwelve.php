<?php
/**
 * Auto Load Next Post Theme Support: Twenty Twelve
 *
 * Applies support for WordPress Twenty Twelve Theme.
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
 * ALNP_Twenty_Twelve class.
 */
class ALNP_Twenty_Twelve {

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
		add_action( 'alnp_load_after_content', array( __CLASS__, 'alnp_twentytwelve_post_navigation' ), 1, 10 );

		// Add theme support and preset the theme selectors.
		add_action( 'after_setup_theme', array( __CLASS__, 'add_theme_support' ) );
	} // END init()

	/**
	 * Adds a compaitable post navigation.
	 *
	 * @access public
	 * @static
	 */
	public static function alnp_twentytwelve_post_navigation() {
	?>
	<nav class="nav-single">
		<h3 class="assistive-text"><?php _e( 'Post navigation', 'auto-load-next-post' ); ?></h3>
		<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'auto-load-next-post' ) . '</span> %title' ); ?></span>
	</nav><!-- .nav-single -->
	<?php
	} // END alnp_twentytwelve_post_navigation()

	/**
	 * Add theme support by providing the theme selectors
	 * to be applied once the theme is activated.
	 *
	 * @access public
	 * @static
	 */
	public static function add_theme_support() {
		add_theme_support( 'auto-load-next-post', array(
			'content_container'    => '#content',
			'title_selector'       => 'h1.entry-title',
			'navigation_container' => '.nav-single',
			'comments_container'   => 'div#comments',
			'load_js_in_footer'    => 'no',
			'lock_js_in_footer'    => 'no',
		) );
	} // END add_theme_support()

} // END class

ALNP_Twenty_Twelve::init();
