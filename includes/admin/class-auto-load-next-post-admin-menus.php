<?php
/**
 * Setup menus in the WordPress admin.
 *
 * @since    1.0.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Auto_Load_Next_Post_Admin_Menus' ) ) {

/**
 * Class - Auto_Load_Next_Post_Admin_Menus
 *
 * @since 1.0.0
 */
class Auto_Load_Next_Post_Admin_Menus {

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {
		// Add admin menus
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
	} // END __construct()

	/**
	 * Add menu items.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global $menu
	 * @global $auto_load_next_post
	 * @global $wp_version
	 */
	public function admin_menu() {
		global $menu, $auto_load_next_post, $wp_version;

		add_options_page( sprintf( __( '%s Settings', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ), Auto_Load_Next_Post()->title_name ), 'Auto Load Next Post', Auto_Load_Next_Post()->manage_plugin, 'auto-load-next-post-settings', array( $this, 'settings_page' ) );

		register_setting( 'auto_load_next_post_status_settings_fields', 'auto_load_next_post_status_options' );
	} // END admin_menu()

	/**
	 * Initialize the Auto Load Next Post settings page.
	 * @since  1.0.0
	 * @access public
	 */
	public function settings_page() {
		include_once( 'class-auto-load-next-post-admin-settings.php' );
		Auto_Load_Next_Post_Admin_Settings::output();
	}

} // END Auto_Load_Next_Post_Admin_Menus class.

} // END if class exists.

return new Auto_Load_Next_Post_Admin_Menus();
?>
