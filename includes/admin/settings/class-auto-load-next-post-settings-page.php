<?php
/**
 * Auto Load Next Post Settings Page
 *
 * @since    1.0.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly

if ( ! class_exists('Auto_Load_Next_Post_Settings_Page')) {

/**
 * Class - Auto_Load_Next_Post_Settings_Page
 *
 * @since 1.0.0
 */
class Auto_Load_Next_Post_Settings_Page {

	protected $id    = '';
	protected $label = '';

	/**
	 * Add this page to settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $pages
	 * @return array $pages
	 */
	public function add_settings_page($pages) {
		$pages[$this->id] = $this->label;
		return $pages;
	} // END add_settings_page()

	/**
	 * Add this settings page to plugin menu.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $pages
	 * @return array $pages
	 */
	public function add_menu_page($pages) {
		$pages[$this->id] = $this->label;
		return $pages;
	} // END add_menu_page()

	/**
	 * Get settings array
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_settings() {
		return array();
	} // END get_settings()

	/**
	 * Output the settings.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function output() {
		$settings = $this->get_settings();

		Auto_Load_Next_Post_Admin_Settings::output_fields($settings);
	} // END output()

	/**
	 * Save settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global $current_tab
	 * @global $current_section
	 */
	public function save() {
		global $current_tab;

		$settings = $this->get_settings();

		Auto_Load_Next_Post_Admin_Settings::save_fields($settings, $current_tab);
	} // END save()

} // END class

} // END if class exists.
