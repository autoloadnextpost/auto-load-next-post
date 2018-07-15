<?php
/**
 * Auto Load Next Post Theme Support
 *
 * Configures theme support if supported.
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
 * ALNP_Theme_Support class.
 */
class ALNP_Theme_Support {

	/**
	 * Constructor.
	 *
	 * @access public
	 */
	public function __construct() {
		// Update theme selectors if the theme was switched and it has theme support.
		add_action( 'after_switch_theme', array( $this, 'update_alnp_theme_selectors' ), 15, 2 );
	} // END __construct()

	/**
	 * Updates the theme selectors if the theme had changed
	 * and Auto Load Next Post is supported within that theme.
	 *
	 * @access public
	 */
	public function update_alnp_theme_selectors( $stylesheet = '', $old_theme = false ) {
		// Check if Auto Load Next Post is supported before updating the theme selectors.
		if ( is_alnp_supported() ) {
			$theme_support = get_theme_support( 'auto-load-next-post' );

			if ( is_array( $theme_support ) ) {
				// Preferred implementation, where theme provides an array of options
				if ( isset( $theme_support[0] ) && is_array( $theme_support[0] ) ) {
					foreach( $theme_support[0] as $key => $value ) {
						if ( ! empty( $value ) ) update_option( 'auto_load_next_post_' . $key, $value );
					}
				}
			}
		}
	} // END update_alnp_theme_selectors()

} // END class

return new ALNP_Theme_Support();
