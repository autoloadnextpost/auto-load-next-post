<?php
/**
 * Auto Load Next Post Theme Support
 *
 * Configures theme support if supported.
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
 * ALNP_Theme_Support class.
 */
class ALNP_Theme_Support {

	/**
	 * Theme Support init.
	 *
	 * @access public
	 * @static
	 */
	public static function init() {
		// Update theme selectors if the theme was switched and it has theme support.
		add_action( 'switch_theme', array( $this, 'update_alnp_theme_selectors' ) );
	} // END init()

	// Update the theme selectors if the theme switched and Auto Load Next Post is supported.
	public static function update_alnp_theme_selectors() {
		// Check if Auto Load Next Post is supported before updating the theme selectors.
		if ( is_alnp_supported() ) {
			$theme_support = get_theme_support( 'auto-load-next-post' );

			foreach( $theme_support as $key => $value ) {
				if ( ! empty( $key ) ) update_option( 'auto_load_next_post_' . $key, $value );
			}
		}
	} // END update_alnp_theme_selectors()

} // END class

ALNP_Theme_Support::init();
