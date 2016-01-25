<?php
/**
 * Auto Load Next Post Integration Settings
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists('Auto_Load_Next_Post_Settings_Integrations') ) {

/**
 * Class - Auto_Load_Next_Post_Settings_Integrations
 *
 * @extends Auto_Load_Next_Post_Settings_Page
 * @since   1.5.0
 */
class Auto_Load_Next_Post_Settings_Integrations extends Auto_Load_Next_Post_Settings_Page {

	/**
	 * Constructor.
	 *
	 * @since  1.5.0
	 * @action auto_load_next_post_integrations_init
	 * @filter auto_load_next_post_integrations
	 * @access public
	 */
	public function __construct() {
		$this->id    = 'integration';
		$this->label = __('Integration', 'auto-load-next-post');

		if ( isset( ALNP()->integrations ) && ALNP()->integrations->get_integrations() ) {
			add_filter('auto_load_next_post_settings_tabs_array', array($this, 'add_settings_page'), 20);
			add_action('auto_load_next_post_sections_'.$this->id, array($this, 'output_sections'));
			add_action('auto_load_next_post_settings_'.$this->id, array($this, 'output'));
			add_action('auto_load_next_post_settings_save_'.$this->id, array($this, 'save'));
		}
	} // END __construct()

	/**
	 * Get sections
	 *
	 * @access public
	 * @global $current_section
	 * @return array
	 */
	public function get_sections() {
		global $current_section;

		$sections = array();

		$integrations = ALNP()->integrations->get_integrations();

		if ( ! $current_section && ! empty( $integrations ) ) {
			$current_section = current( $integrations )->id;
		}

		if ( sizeof( $integrations ) > 1 ) {
			foreach ( $integrations as $integration ) {
				$title = empty( $integration->method_title ) ? ucfirst( $integration->id ) : $integration->method_title;
				$sections[ strtolower( $integration->id ) ] = esc_html( $title );
			}
		}

		return apply_filters('auto_load_next_post_get_sections_'.$this->id, $sections);
	} // END get_sections()

	/**
	 * Output the settings
	 *
	 * @access public
	 * @global $current_section
	 */
	public function output() {
		global $current_section;

		$integrations = ALNP()->integrations->get_integrations();

		if ( isset( $integrations[ $current_section ] ) ) {
			$integrations[ $current_section ]->admin_options();
		}
	} // END output()

} // END class

} // END if class exists

return new Auto_Load_Next_Post_Settings_Integrations();
