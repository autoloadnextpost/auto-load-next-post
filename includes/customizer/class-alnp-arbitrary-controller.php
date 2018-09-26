<?php
/**
 * Auto Load Next Post: Customizer Controller for custom arbitrary html control for dividers etc.
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Customizer
 * @package  Auto Load Next Post/Customizer/Controller
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Exit if WP_Customize_Control does not exsist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

if ( !class_exists( 'Auto_Load_Next_Post_Arbitrary_Control' ) ) {

	/**
	 * The 'alnp_arbitrary' for Auto Load Next Post Arbitrary control class.
	 */
	class Auto_Load_Next_Post_Arbitrary_Control extends WP_Customize_Control {

		/**
		 * Renter the control
		 *
		 * @return void
		 */
		public function render_content() {
			switch ( $this->type ) {
				default:
				case 'text':
					echo '<p class="description">' . wp_kses_post( $this->description ) . '</p>';
					break;

				case 'heading':
					echo '<span class="customize-control-title">' . $this->label . '</span>';
					break;

				case 'divider':
					echo '<hr style="margin: 1em 0;" />';
					break;
			}
		} // END render_content()

	} // END class

} // END if class
