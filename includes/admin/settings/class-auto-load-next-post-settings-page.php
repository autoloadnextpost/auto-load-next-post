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

if(! defined('ABSPATH')) exit; // Exit if accessed directly

if(! class_exists('Auto_Load_Next_Post_Settings_Page')){

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
	public function add_settings_page( $pages ) {
		$pages[ $this->id ] = $this->label;
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
	public function add_menu_page( $pages ) {
		$pages[ $this->id ] = $this->label;
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
	 * Get sections
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_sections() {
		return array();
	} // END get_section()

	/**
	 * Output sections
	 *
	 * @since  1.0.0
	 * @access public
	 * @global $current_section
	 */
	public function output_sections() {
		global $current_section;

		$sections = $this->get_sections();

		if(empty( $sections ) )
			return;

		$output = '<ul class="subsubsub">';

		$array_keys = array_keys( $sections );

		foreach ( $sections as $id => $label ) {
			$output .= '<li><a href="';
			$section_link = admin_url( 'options-general.php?page=auto-load-next-post-settings&tab='.$this->id.'&section='.sanitize_title( $id ) );

			// If this section is default then remove the variable from this link.
			if($id == '' ) {
				$section_link = remove_query_arg( 'section', $section_link );
			}

			$output .= $section_link;

			$output .= '" class="'.( $current_section == $id ? 'current' : '' ).'">'.$label.'</a> '.( end( $array_keys ) == $id ? '' : '|' ).' </li>';
		}

		$output .= '</ul><br class="clear" />';

		echo $output;
	} // END output_sections()

	/**
	 * Output the settings.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function output() {
		$settings = $this->get_settings();

		Auto_Load_Next_Post_Admin_Settings::output_fields( $settings );
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
		global $current_tab, $current_section;

		$settings = $this->get_settings();

		Auto_Load_Next_Post_Admin_Settings::save_fields( $settings, $current_tab, $current_section );

		if($current_section ) {
			do_action( 'auto_load_next_post_update_options_'.$this->id.'_'.$current_section );
		}

	} // END save()

} // END class

} // END if class exists.
