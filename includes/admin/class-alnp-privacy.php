<?php
/**
 * Auto Load Next Post - Privacy Policy.
 *
 * Adds a message in the WP Privacy Policy Guide page.
 * 
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Privacy' ) ) {

	class ALNP_Privacy {

		/**
		 * Constructor
		 *
		 * @access  public
		 */
		public function __construct() {
			add_action( 'admin_init', array( $this, 'add_privacy_policy_guide_content' ) );
		} // END __construct()

		/**
		 * Add a message in the WP Privacy Policy Guide page.
		 *
		 * @access public
		 * @static
		 */
		public static function add_privacy_policy_guide_content() {
			if ( function_exists( 'wp_add_privacy_policy_content' ) ) {
				wp_add_privacy_policy_content( esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), self::get_privacy_policy_guide_message() );
			}
		} // END add_privacy_policy_guide_content()

		/**
		 * Message to add in the WP Privacy Policy Guide page.
		 *
		 * @access protected
		 * @static
		 * @return string
		 */
		protected static function get_privacy_policy_guide_message() {
			$content = '
				<div class="wp-suggested-text">' .
					'<p class="privacy-policy-tutorial">' .
						sprintf( __( '%s does not collect, store or share any personal data.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) .
					'</p>' .
				'</div>';

			return $content;
		} // END get_privacy_policy_guide_message()

	} // END class

} // END if class exists

return new ALNP_Privacy();
