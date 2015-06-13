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
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Auto_Load_Next_Post_Settings_General_Tab' ) ) {

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
		$this->label = __( 'General', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN );

		add_filter( 'auto_load_next_post_settings_submenu_array',           array( $this, 'add_menu_page' ),     20 );
		add_filter( 'auto_load_next_post_settings_tabs_array',              array( $this, 'add_settings_page' ), 20 );
		add_action( 'auto_load_next_post_settings_' . $this->id,            array( $this, 'output' ) );
		add_action( 'auto_load_next_post_settings_save_' . $this->id,       array( $this, 'save' ) );
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

		Auto_Load_Next_Post_Admin_Settings::save_fields( $settings, $current_tab );
	}

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
		$post_types = get_post_types( array( 'public' => true ), 'names' );

		return $post_types;
	}

	/**
	 * Get settings array
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_settings() {
		return apply_filters( 'auto_load_next_post_' . $this->id . '_settings', array(

			array(
				'title' => __( 'Information', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'type'  => 'title',
				'desc'  => __( 'For the plugin to work you need to set the variables below.', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'id'    => $this->id . '_options'
			),

			array(
				'title'    => __( 'Restrict Post Types', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc'     => __( 'Select which post types you wish to load automatically.', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_get_post_types',
				'class'    => 'chosen-select',
				'css'      => 'min-width:300px;',
				'default'  => array( 'post' ),
				'type'     => 'multiselect',
				'options'  => $this->get_post_types(),
				'autoload' => false
			),

			array(
				'title'    => __( 'Content Container', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc'     => __( 'Example: <code>div.single</code>', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_content_container',
				'default'  => 'div.single',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			/*array(
				'title'    => __( 'Post ID Selector', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc'     => __( 'Example: <code>article</code>', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_id_selector',
				'default'  => 'article',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),*/

			array(
				'title'    => __( 'Post Title Selector', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc'     => __( 'Example: <code>h1.entry-title</code>', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_title_selector',
				'default'  => 'h1.entry-title',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'    => __( 'Post Navigation Container', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc'     => __( 'Example: <code>nav.post-navigation</code>', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_navigation_container',
				'default'  => 'nav.post-navigation',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'    => __( 'Comments Container', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc'     => __( 'Example: <code>div#comments</code>', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_comments_container',
				'default'  => 'div#comments',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'   => __( 'Remove Comments', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc'    => __( 'Enable to remove comments when each post loads.', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'id'      => 'auto_load_next_post_remove_comments',
				'default' => 'yes',
				'type'    => 'checkbox'
			),

			array(
				'title'   => __( 'Update Google Analytics', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc'    => __( 'Enable to update your Google Analytics each time a post is automatically loaded.', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'id'      => 'auto_load_next_post_google_analytics',
				'default' => 'no',
				'type'    => 'checkbox'
			),

			array(
				'title'   => __( 'Remove all data on uninstall?', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'desc'    => __( 'If enabled, all settings for this plugin will all be deleted when uninstalling via Plugins > Delete.', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				'id'      => 'auto_load_next_post_uninstall_data',
				'default' => 'no',
				'type'    => 'checkbox'
			),

			array( 'type' => 'sectionend', 'id' => $this->id . '_options'),
		)); // End general settings
	}

}

} // end if class exists

return new Auto_Load_Next_Post_Settings_General_Tab();
