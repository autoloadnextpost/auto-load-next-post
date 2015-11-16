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

if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly

if ( ! class_exists('Auto_Load_Next_Post_Admin_Notices')) {

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
	 */
	public function __construct() {
		add_action('admin_init', array($this, 'check_wp'));
		add_action('admin_init', array($this, 'add_notices'));
	} // END __construct()

	/**
	 * Checks if the theme supports the plugin.
	 * If not, then a notice is displayed explaining what to do next.
	 *
	 * @since  1.3.2
	 * @access public
	 */
	public function add_notices() {
		$template = get_option('template');

		if ( ! supports_alnp()) {

			if ( ! empty($_GET['hide_auto_load_next_post_theme_support_check'])) {
				update_option('auto_load_next_post_theme_support_check', $template);
				return;
			}

			if (get_option('auto_load_next_post_theme_support_check') !== $template) {
				add_action('admin_notices', array($this, 'theme_check_notice'));
			}

		}
	} // END add_notices()

	/**
	 * Checks that the WordPress version meets the plugin requirement.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global string $wp_version
	 * @return bool
	 */
	public function check_wp() {
		global $wp_version;

		if ( ! version_compare($wp_version, AUTO_LOAD_NEXT_POST_WP_VERSION_REQUIRE, '>=')) {
			add_action('admin_notices', array($this, 'requirement_wp_notice'));
			return false;
		}

		return true;
	} // END check_requirements()

	/**
	 * Show the WordPress requirement notice.
	 *
	 * @since  1.4.3
	 * @access public
	 */
	public function requirement_wp_notice() {
		include('views/html-notice-requirement-wp.php');
	} // END requirement_wp_notice()

	/**
	 * Show the theme check notice.
	 *
	 * @since  1.3.2
	 * @access public
	 */
	public function theme_check_notice() {
		include('views/html-notice-theme-support.php');
	} // END theme_check_notice()

} // END Auto_Load_Next_Post_Admin_Notices class.

} // END if class exists.

return new Auto_Load_Next_Post_Admin_Notices();
