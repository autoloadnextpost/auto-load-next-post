<?php
/**
 * Auto Load Next Post Integrations class
 *
 * Loads Integrations into Auto Load Next Post.
 *
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Classes
 * @package  Auto Load Next Post/Classes/Integrations
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Auto_Load_Next_Post_Integrations' ) ) {

	class Auto_Load_Next_Post_Integrations {

		/**
		 * Array of integrations.
		 *
		 * @access public
		 * @var   array
		 */
		public $integrations = array();

		/**
		 * Initialize integrations.
		 *
		 * @access public
		 */
		public function __construct() {
			do_action( 'auto_load_next_post_integrations_init' );

			$load_integrations = apply_filters( 'auto_load_next_post_integrations', array() );

			// Load integration classes.
			foreach ( $load_integrations as $integration ) {
				$load_integration = new $integration();

				$this->integrations[ $load_integration->id ] = $load_integration;
			}
		} // END __construct()

		/**
		 * Return loaded integrations.
		 *
		 * @access public
		 * @return array
		 */
		public function get_integrations() {
			return $this->integrations;
		} // END get_integrations()

	} // END class

} // END if class
