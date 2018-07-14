<?php
/**
 * Auto Load Next Post: Customizer Controller for Displaying a Video.
 *
 * @see https://developer.wordpress.org/reference/classes/wp_customize_control/
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

if ( !class_exists( 'Auto_Load_Next_Post_Display_Video_Controller' ) ) {

	/**
	 * This class is for the display video control in the Customizer.
	 */
	class Auto_Load_Next_Post_Display_Video_Controller extends WP_Customize_Control {

		/**
		 * The type of customize control.
		 *
		 * @access public
		 * @since  1.5.0
		 * @var    string
		 */
		public $type = 'alnp-display-video';

		/**
		 * Render the content on the theme customizer page via PHP.
		 *
		 * @access public
		 * @since  1.5.0
		 */
		public function render_content() {
			?>
			<span class="customize-control-title"><?php echo $this->label; ?></span>

			<p>
				<iframe width="320" height="180" src="https://www.youtube-nocookie.com/embed/<?php echo $this->value(); ?>?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</p>
			<?php
		} // END render_content()

	} // END class

} // END if class
