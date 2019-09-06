<?php
/**
 * Auto Load Next Post - Sidebar.
 *
 * Displays a sidebar on the settings page.
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

if ( ! class_exists( 'ALNP_Sidebar' ) ) {

	class ALNP_Sidebar {

		/**
		 * Constructor
		 *
		 * @access  public
		 */
		public function __construct() {
			add_action( 'auto_load_next_post_sidebar', array( $this, 'sidebar_top' ), 0 );
			add_action( 'auto_load_next_post_sidebar', array( $this, 'upgrade_details' ), 1 );
			add_action( 'auto_load_next_post_sidebar', array( $this, 'sidebar_bottom' ), 999 );
		} // END __construct()

		/**
		 * Displays the top of the sidebar.
		 * 
		 * @access public
		 */
		public function sidebar_top() {
			include_once( dirname( __FILE__ ) . '/views/html-admin-sidebar-logo.php' );

			do_action( 'auto_load_next_post_sidebar_top' );
		} // END sidebar_top()

		/**
		 * Checks if Auto Load Next Post Pro is installed before 
		 * displaying upgrade details in the sidebar.
		 *
		 * @access public
		 */
		public function upgrade_details() {
			if ( ! is_alnp_pro_version_installed() ) {
				include_once( dirname( __FILE__ ) . '/views/html-admin-sidebar.php' );
			}
		} // END upgrade_details()

		/**
		 * Displays plugin credits at the bottom of the sidebar.
		 * 
		 * @access public
		 */
		public function sidebar_bottom() {
			do_action( 'auto_load_next_post_sidebar_bottom' );

			include_once( dirname( __FILE__ ) . '/views/html-admin-sidebar-credits.php' );
		} // END sidebar_bottom()

	} // END class

} // END if class exists

return new ALNP_Sidebar();
