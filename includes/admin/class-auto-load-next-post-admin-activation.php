<?php
/**
 * Activating the plugin.
 *
 * @since    1.4.3
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Auto_Load_Next_Post_Activation' ) ) {

	/**
	 * Auto_Load_Next_Post_Activation Class
	 */
	class Auto_Load_Next_Post_Activation {

		/**
		 * Constructor.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {
			// Fetch the Php version checker.
			require_once( 'wp-update-php/WPUpdatePhp.php' );
			$updatePhp = new WPUpdatePhp( '5.3.0' );

			// If the miniumum version of PHP required is available then install the plugin.
			if ( $updatePhp->does_it_meet_required_php_version( PHP_VERSION ) ) {
				add_action( 'plugins_loaded', array( $this, 'run_activation' ) );
			} else {
				// If the required PHP version is not avaialble then deactivate the plugin.
				deactivate_plugins( plugin_basename( AUTO_LOAD_NEXT_POST_FILE ) );
				return false;
			} // END if/else
		} // END __construct()

		/**
		 * Now we are ready so let's install the plugin.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function run_activation(){
			include_once( 'class-auto-load-next-post-install.php' );
			$install_plugin = new Auto_Load_Next_Post_Install;
			$install_plugin->install();
		}

	} // END if class.

} // END if class exists.

return new Auto_Load_Next_Post_Activation();
