<?php
/**
 * Display notices in the WordPress admin.
 *
 * @since    1.3.2
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Auto_Load_Next_Post_Admin_Notices' ) ) {

/**
 * Class - Auto_Load_Next_Post_Admin_Notices
 *
 * @since 1.3.2
 */
class Auto_Load_Next_Post_Admin_Notices {

	/**
	 * Constructor
	 *
	 * @since  1.3.2
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_print_styles', array( $this, 'add_notices' ) );
	} // END __construct()

	/**
	 * Add admin notices and styles when needed.
	 *
	 * @since  1.3.2
	 * @access public
	 */
	public function add_notices() {
		$template = get_option( 'template' );

		if ( ! current_theme_supports( 'auto-load-next-post' ) ) {

			if ( ! empty( $_GET['hide_auto_load_next_post_theme_support_check'] ) ) {
				update_option( 'auto_load_next_post_theme_support_check', $template );
				return;
			}

			if ( get_option( 'auto_load_next_post_theme_support_check' ) !== $template ) {
				wp_enqueue_style( 'auto-load-next-post-activation', Auto_Load_Next_Post()->plugin_url() . '/assets/css/admin/activation.css' );
				add_action( 'admin_notices', array( $this, 'theme_check_notice' ) );
			}

		}
	} // END add_notices()

	/**
	 * Show the Theme Check notice.
	 *
	 * @since  1.3.2
	 * @access public
	 */
	public function theme_check_notice() {
		include( 'views/html-notice-theme-support.php' );
	} // END theme_check_notice()

} // END Auto_Load_Next_Post_Admin_Notices class.

} // END if class exists.

return new Auto_Load_Next_Post_Admin_Notices();
