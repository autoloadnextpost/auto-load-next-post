<?php
/**
 * Auto Load Next Post General Tab Settings
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

if ( ! class_exists('Auto_Load_Next_Post_Settings_General_Tab')) {

/**
 * Class - Auto_Load_Next_Post_Settings_General_Tab
 *
 * @extends Auto_Load_Next_Post_Settings_Page
 * @since   1.0.0
 */
class Auto_Load_Next_Post_Settings_General_Tab extends Auto_Load_Next_Post_Settings_Page {

	/**
	 * Constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {
		$this->id    = 'general';
		$this->label = __('General', 'auto-load-next-post');

		add_filter('auto_load_next_post_settings_submenu_array', array($this, 'add_menu_page'), 20);
		add_filter('auto_load_next_post_settings_tabs_array', array($this, 'add_settings_page'), 20);
		add_action('auto_load_next_post_settings_'.$this->id, array($this, 'output'));
		add_action('auto_load_next_post_settings_save_'.$this->id, array($this, 'save'));
	} // END __construct()

	/**
	 * Save settings
	 *
	 * @since  1.0.0
	 * @access public
	 * @global $current_tab
	 */
	public function save() {
		global $current_tab;

		$settings = $this->get_settings();

		Auto_Load_Next_Post_Admin_Settings::save_fields($settings, $current_tab);
	} // END save()

	/**
	 * Get post types
	 *
	 * This returns a list of public registered post types.
	 *
	 * @since  1.3.2
	 * @access public
	 * @return array
	 */
	public function get_post_types() {
		$post_types = get_post_types(array('public' => true), 'names');

		return $post_types;
	} // END get_post_types()

	/**
	 * Get settings array
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_settings() {
		return apply_filters('auto_load_next_post_'.$this->id.'_settings', array(

			array(
				'title' => __('General', 'auto-load-next-post'),
				'type'  => 'title',
				'desc'  => sprintf(__('Set variables below according to your active theme. All are required for %s to work.', 'auto-load-next-post'), 'Auto Load Next Post'),
				'id'    => $this->id.'_options'
			),

			array(
				'title'    => __('Content Container', 'auto-load-next-post'),
				'desc'     => __('Example: <code>main.site-main</code>', 'auto-load-next-post'),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_content_container',
				'default'  => 'main.site-main',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'    => __('Post Title Selector', 'auto-load-next-post'),
				'desc'     => __('Example: <code>h1.entry-title</code>', 'auto-load-next-post'),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_title_selector',
				'default'  => 'h1.entry-title',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'    => __('Post Navigation Container', 'auto-load-next-post'),
				'desc'     => __('Example: <code>nav.post-navigation</code>', 'auto-load-next-post'),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_navigation_container',
				'default'  => 'nav.post-navigation',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'    => __('Comments Container', 'auto-load-next-post'),
				'desc'     => __('Example: <code>div#comments</code>', 'auto-load-next-post'),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_comments_container',
				'default'  => 'div#comments',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'   => __('Remove Comments', 'auto-load-next-post'),
				'desc'    => __('Enable to remove comments when each post loads.', 'auto-load-next-post'),
				'id'      => 'auto_load_next_post_remove_comments',
				'default' => 'yes',
				'type'    => 'checkbox'
			),

			array(
				'title'   => __('Update Google Analytics', 'auto-load-next-post'),
				'desc'    => __('Each time a post is loaded it will count as a pageview. You must have a reference to your Google Analytics tracking code on the page.', 'auto-load-next-post'),
				'id'      => 'auto_load_next_post_google_analytics',
				'default' => 'no',
				'type'    => 'checkbox'
			),

			array(
				'title'   => __('Reset all data?', 'auto-load-next-post'),
				'desc'    => __('Press the reset button to clear all settings for this plugin and re-install the default settings.', 'auto-load-next-post'),
				'id'      => 'auto_load_next_post_uninstall_data',
				'default' => 'no',
				'type'    => 'reset_data'
			),

			array(
				'title'   => __('Remove all data on uninstall?', 'auto-load-next-post'),
				'desc'    => __('If enabled, all settings for this plugin will all be deleted when uninstalling via Plugins > Delete.', 'auto-load-next-post'),
				'id'      => 'auto_load_next_post_uninstall_data',
				'default' => 'no',
				'type'    => 'checkbox'
			),

			array('type' => 'sectionend', 'id' => $this->id.'_options'),
		)); // End general settings
	} // END get_settings()

}

} // END if class exists

return new Auto_Load_Next_Post_Settings_General_Tab();
