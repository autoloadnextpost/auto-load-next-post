<?php
/**
 * Auto Load Next Post Settings Page
 *
 * @since    1.0.0
 * @version  1.4.10
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Settings
 * @license  GPL-2.0+
 */

if ( ! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Auto_Load_Next_Post_Settings_Page' ) ) {

	abstract class Auto_Load_Next_Post_Settings_Page {

		/**
		 * Setting page id.
		 *
		 * @access protected
		 * @var    string $id
		 */
		protected $id    = '';

		/**
		 * Setting page label.
		 *
		 * @access protected
		 * @var    string $label
		 */
		protected $label = '';

		/**
		 * Constructor.
		 *
		 * @access public
		 * @since  1.4.10
		 */
		public function __construct() {
			add_filter( 'auto_load_next_post_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
			add_action( 'auto_load_next_post_settings_' . $this->id, array( $this, 'output' ) );
			add_action( 'auto_load_next_post_settings_save_' . $this->id, array( $this, 'save' ) );
		}

		/**
		 * Get settings page ID.
		 *
		 * @access public
		 * @since  1.4.10
		 * @return string
		 */
		public function get_id() {
			return $this->id;
		} // END get_id()

		/**
		 * Get settings page label.
		 *
		 * @access public
		 * @since  1.4.10
		 * @return string
		 */
		public function get_label() {
			return $this->label;
		} // END get_label()

		/**
		 * Add this page to settings.
		 *
		 * @access public
		 * @since  1.0.0
		 * @param  array $pages
		 * @return array $pages
		 */
		public function add_settings_page( $pages ) {
			$pages[$this->id] = $this->label;

			return $pages;
		} // END add_settings_page()

		/**
		 * Add this settings page to plugin menu.
		 *
		 * @access public
		 * @since  1.0.0
		 * @param  array $pages
		 * @return array $pages
		 */
		public function add_menu_page( $pages ) {
			$pages[$this->id] = $this->label;

			return $pages;
		} // END add_menu_page()

		/**
		 * Get settings array
		 *
		 * @access public
		 * @since  1.0.0
		 * @return array
		 */
		public function get_settings() {
			return array();
		} // END get_settings()

		/**
		 * Output the settings.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function output() {
			$settings = $this->get_settings();

			Auto_Load_Next_Post_Admin_Settings::output_fields( $settings );
		} // END output()

		/**
		 * Save settings.
		 *
		 * @access public
		 * @since  1.0.0
		 * @global $current_tab
		 */
		public function save() {
			global $current_tab;

			$settings = $this->get_settings();

			Auto_Load_Next_Post_Admin_Settings::save_fields( $settings, $current_tab );
		} // END save()

	} // END class

} // END if class exists.
