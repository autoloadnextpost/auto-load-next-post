<?php
/**
 * Auto Load Next Post Support Tab Settings
 *
 * @since    1.4.3
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if(! defined('ABSPATH')) exit; // Exit if accessed directly

if(! class_exists('Auto_Load_Next_Post_Settings_Support_Tab')){

/**
 * Auto_Load_Next_Post_Settings_Support_Tab
 */
class Auto_Load_Next_Post_Settings_Support_Tab extends Auto_Load_Next_Post_Settings_Page {

	/**
	 * Constructor.
	 *
	 * @since  1.4.3
	 * @access public
	 */
	public function __construct(){
		$this->id    = 'support';
		$this->label = __('Support', 'auto-load-next-post');

		add_filter('auto_load_next_post_settings_submenu_array', array($this, 'add_menu_page'),     20);
		add_filter('auto_load_next_post_settings_tabs_array',    array($this, 'add_settings_page'), 20);
		add_action('auto_load_next_post_settings_'.$this->id,    array($this, 'output'));
	} // END __construct()

	/**
	 * Output the settings
	 *
	 * @since  1.4.3
	 * @access public
	 */
	public function output(){
		$settings = $this->get_settings();

 		Auto_Load_Next_Post_Admin_Settings::output_fields($settings);
	} // END output()

	/**
	 * Callback
	 *
	 * @since  1.4.3
	 * @access public
	 * @return string
	 */
	public function callback(){
		return '<p>'.__('As this is a free plugin, I can not provide support.', 'auto-load-next-post').'</p>'.
				'<p>'.sprintf(__('You may ask the WordPress community for help by posting to the <a href="%s" target="_blank">WordPress.org support forum</a>. Response time can range from a few days to a few weeks and will likely be from a non-developer.', 'auto-load-next-post'), 'https://wordpress.org/support/plugin/auto-load-next-post').'</p>'.
				'<p>'.sprintf(__('If you want a <strong>timely response via email from me</strong>, <a href="%s" target="_blank">upgrade</a> and then send me an email.', 'auto-load-next-post'), 'http://autoloadnextpost.com/?utm_source=insideplugin&utm_medium=web&utm_content=support-tab&utm_campaign=freeplugin-alnp').'</p>'.
				'<p>'.sprintf(__('If you\'ve found a bug, please <a href="%s" target="_blank">submit an issue on GitHub</a>.', 'auto-load-next-post'), 'https://github.com/seb86/Auto-Load-Next-Post/issues').'</p>'.
				'<p>'.__('Thank you.', 'auto-load-next-post').'</p>';
	} // END callback()

	/**
	 * Get settings array
	 *
	 * @since  1.4.3
	 * @access public
	 * @param  $current_section
	 * @return array
	 */
	public function get_settings(){
		return array(

			array(
				'title' => __('Support', 'auto-load-next-post'),
				'type'  => 'title',
				'desc'  => $this->callback(),
				'id'    => 'auto_load_next_post_support_tab'
			),

			array(
				'type' => 'sectionend',
				'id'   => 'auto_load_next_post_support_tab'
			),

		);
	} // END get_settings()
}

} // END if class exists

return new Auto_Load_Next_Post_Settings_Support_Tab();
