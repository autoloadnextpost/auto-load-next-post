<?php
/**
 * Installation related functions and actions.
 *
 * @since    1.0.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if(! defined('ABSPATH')) exit; // Exit if accessed directly

if(! class_exists('Auto_Load_Next_Post_Install')){

/**
 * Class - Auto_Load_Next_Post_Install
 *
 * @since 1.0.0
 */
class Auto_Load_Next_Post_Install {

	/**
	 * Constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {
		register_deactivation_hook( AUTO_LOAD_NEXT_POST_FILE, array($this, 'deactivate' ) );
	} // END __construct()

	/**
	 * Install Auto Load Next Post
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function install() {
		$this->create_options();

		// Add plugin version
		update_option( 'auto_load_next_post_version', AUTO_LOAD_NEXT_POST_VERSION );
	} // END install()

	/**
	 * Refresh the permalinks on deactivating the plugin.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function deactivate() {
		flush_rewrite_rules();
	}

	/**
	 * Default Options
	 *
	 * Sets up the default options defined on the settings pages.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function create_options() {
		// Include settings so that we can run through defaults
		include_once('class-auto-load-next-post-admin-settings.php');

		$settings = Auto_Load_Next_Post_Admin_Settings::get_settings_pages();

		foreach ( $settings as $section ) {
			foreach ( $section->get_settings() as $value ) {
				if(isset( $value['default'] ) && isset( $value['id'])){
					$autoload = isset( $value['autoload'] ) ? (bool) $value['autoload'] : true;
					add_option( $value['id'], $value['default'], '', ( $autoload ? 'yes' : 'no' ) );
				}
			}
		}

	} // END create_options()

	/**
	 * Delete all plugin options.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global $wpdb
	 * @return void
	 */
	public function delete_options() {
		global $wpdb;

		// Delete options
		$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE 'auto_load_next_post_%';" );
	} // END delete_options()

} // END if class.

} // END if class exists.

return new Auto_Load_Next_Post_Install();
