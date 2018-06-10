<?php
/**
 * Auto Load Next Post Settings - Integrations
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Settings
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Auto_Load_Next_Post_Settings_Integrations' ) ) {

	class Auto_Load_Next_Post_Settings_Integrations extends Auto_Load_Next_Post_Settings_Page {

		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->id    = 'integration';
			$this->label = esc_html__( 'Integration', 'auto-load-next-post' );

			if ( isset( Auto_Load_Next_Post()->integrations ) && Auto_Load_Next_Post()->integrations->get_integrations() ) {
				parent::__construct();
			}
		}

		/**
		 * Get sections.
		 *
		 * @return array
		 */
		public function get_sections() {
			global $current_section;

			$sections = array();

			if ( ! defined( 'AUTO_LOAD_NEXT_POST_INSTALLING' ) ) {
				$integrations = Auto_Load_Next_Post()->integrations->get_integrations();

				if ( ! $current_section && ! empty( $integrations ) ) {
					$current_section = current( $integrations )->id;
				}

				if ( sizeof( $integrations ) > 1 ) {
					foreach ( $integrations as $integration ) {
						$title                                      = empty( $integration->method_title ) ? ucfirst( $integration->id ) : $integration->method_title;
						$sections[ strtolower( $integration->id ) ] = esc_html( $title );
					}
				}
			}

			return apply_filters( 'auto_load_next_post_get_sections_' . $this->id, $sections );
		}

		/**
		 * Output the settings.
		 */
		public function output() {
			global $current_section;

			$integrations = Auto_Load_Next_Post()->integrations->get_integrations();

			if ( isset( $integrations[ $current_section ] ) ) {
				$integrations[ $current_section ]->admin_options();
			}
		}
	}

endif;

return new Auto_Load_Next_Post_Settings_Integrations();
