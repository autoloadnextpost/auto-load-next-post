<?php
/**
 * Auto Load Next Post Settings - General
 *
 * @since    1.0.0
 * @version  1.4.10
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Auto_Load_Next_Post_Settings_General_Tab' ) ) {

	class Auto_Load_Next_Post_Settings_General_Tab extends Auto_Load_Next_Post_Settings_Page {

		/**
		 * Constructor.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.4.10
		 */
		public function __construct() {
			$this->id    = 'general';
			$this->label = __( 'General', 'auto-load-next-post' );

			parent::__construct();
		} // END __construct()

		/**
		 * Get settings array.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return array
		 */
		public function get_settings() {
			return apply_filters(
				'auto_load_next_post_general_settings', array(

					array(
						'title' => __( 'General', 'auto-load-next-post' ),
						'type'  => 'title',
						'desc'  => sprintf( __( 'Set the theme selectors below according to your active theme. All are required for %s to work. <a href="https://autoloadnextpost.com/documentation/find-theme-selectors/?utm_source=wpadmin&utm_campaign=plugin-settings-general" target="_blank">How to find my theme selectors?</a>', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
						'id'    => 'general_options'
					),

					array(
						'title'    => __( 'Content Container', 'auto-load-next-post' ),
						'desc'     => __( 'This is the primary container were the post content is loaded in. Example: <code>main.site-main</code>', 'auto-load-next-post' ),
						//'desc_tip' => true,
						'id'       => 'auto_load_next_post_content_container',
						'default'  => 'main.site-main',
						'type'     => 'text',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'title'    => __( 'Post Title', 'auto-load-next-post' ),
						'desc'     => __( 'This is used to identify which article the user is reading and track if Google Analytics is enabled. Example: <code>h1.entry-title</code>', 'auto-load-next-post' ),
						//'desc_tip' => true,
						'id'       => 'auto_load_next_post_title_selector',
						'default'  => 'h1.entry-title',
						'type'     => 'text',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'title'    => __( 'Post Navigation', 'auto-load-next-post' ),
						'desc'     => __( 'The post navigation needs to be indentified to find the next post. Example: <code>nav.post-navigation</code>', 'auto-load-next-post' ),
						//'desc_tip' => true,
						'id'       => 'auto_load_next_post_navigation_container',
						'default'  => 'nav.post-navigation',
						'type'     => 'text',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'title'    => __( 'Comments Container', 'auto-load-next-post' ),
						'desc'     => __( 'This is so comments can be removed if enabled below. Example: <code>div#comments</code>', 'auto-load-next-post' ),
						//'desc_tip' => true,
						'id'       => 'auto_load_next_post_comments_container',
						'default'  => 'div#comments',
						'type'     => 'text',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					/*array(
						'title'   => __( 'Remove Comments', 'auto-load-next-post' ),
						'desc'    => __( 'Enable to remove comments when each post loads including the initial post.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_remove_comments',
						'default' => 'yes',
						'type'    => 'checkbox'
					),

					array(
						'title'   => __( 'Update Google Analytics', 'auto-load-next-post' ),
						'desc'    => __( 'Each time a post has loaded and is in view it will count as a pageview. Must have reference to Google Analytics tracking code on the site.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_google_analytics',
						'default' => 'no',
						'type'    => 'checkbox'
					),

					array(
						'title'   => __( 'JavaScript in Footer?', 'auto-load-next-post' ),
						'desc'    => __( 'Enable to load Auto Load Next Post in the footer instead of the header.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_js_footer',
						'default' => 'no',
						'type'    => 'checkbox'
					),

					array(
						'title'   => __( 'Reset all data?', 'auto-load-next-post' ),
						'desc'    => __( 'Press the reset button to clear all settings for this plugin and re-install the default settings.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_reset_data',
						'default' => 'no',
						'type'    => 'reset_data'
					),

					array(
						'title'   => __( 'Remove all data on uninstall?', 'auto-load-next-post' ),
						'desc'    => __( 'If enabled, all settings for this plugin will all be deleted when uninstalling via Plugins > Delete.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_uninstall_data',
						'default' => 'no',
						'type'    => 'checkbox'
					),*/

					array(
						'type' => 'sectionend',
						'id'   => 'general_options'
					),
			) ); // End general settings
		} // END get_settings()

		/**
		 * Output the settings.
		 *
		 * @access public
		 * @since  1.4.10
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

		/**
		 * Get post types.
		 *
		 * This returns a list of public registered post types.
		 *
		 * @access public
		 * @since  1.3.2
		 * @return array
		 */
		public function get_post_types() {
			$post_types = get_post_types( array( 'public' => true ), 'names' );

			return $post_types;
		} // END get_post_types()

	} // END class

} // END if class exists

return new Auto_Load_Next_Post_Settings_General_Tab();
