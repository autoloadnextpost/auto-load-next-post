<?php
/**
 * Display notices in the WordPress admin.
 *
 * @since    1.3.2
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

if ( ! class_exists( 'Auto_Load_Next_Post_Admin_Notices' ) ) {

	class Auto_Load_Next_Post_Admin_Notices {

		/**
		 * Activation date.
		 *
		 * @access public
		 * @static
		 * @since  1.4.10
		 * @var    string
		 */
		public static $install_date;

		/**
		 * Constructor
		 *
		 * @access  public
		 * @since   1.3.2
		 * @version 1.4.10
		 */
		public function __construct() {
			self::$install_date = get_site_option( 'auto_load_next_post_install_date', time() );

			add_action( 'admin_init', array( $this, 'check_wp' ), 12 );
			add_action( 'admin_init', array( $this, 'dont_bug_me' ), 15 );

			add_action( 'admin_notices', array( $this, 'add_notices' ), 0 );
		} // END __construct()

		/**
		 * Checks that the WordPress version meets the plugin requirement.
		 *
		 * @access public
		 * @since  1.0.0
		 * @global string $wp_version
		 * @return bool
		 */
		public function check_wp() {
			global $wp_version;

			if ( ! version_compare( $wp_version, AUTO_LOAD_NEXT_POST_WP_VERSION_REQUIRE, '>=' ) ) {
				add_action( 'admin_notices', array( $this, 'requirement_wp_notice' ) );
				return false;
			}

			return true;
		} // END check_wp()

		/**
		 * Dont bug the user if they do not want any notices.
		 *
		 * @access public
		 * @since  1.4.10
		 * @global $current_user
		 */
		public function dont_bug_me() {
			global $current_user;

			// If the user is allowed to install plugins and requested to hide the notice then hide it for that user.
			if ( ! empty( $_GET['hide_auto_load_next_post_review_notice'] ) && current_user_can( 'install_plugins' ) ) {
				add_user_meta( $current_user->ID, 'auto_load_next_post_hide_review_notice', '1', true );
				// Redirect to the plugins page.
				wp_safe_redirect( admin_url( 'plugins.php' ) ); exit;
			}
		} // END dont_bug_me()

		/**
		 * Checks if the theme supports the plugin and display the plugin review
		 * notice after 7 days or more from the time the plugin was installed.
		 *
		 * @access  public
		 * @since   1.3.2
		 * @version 1.4.10
		 * @global  $current_user
		 */
		public function add_notices() {
			global $current_user;

			$template = get_option('template');

			if ( ! supports_alnp() ) {
				// If user hides theme support notice then set active theme.
				if ( ! empty( $_GET['hide_auto_load_next_post_theme_support_check'] ) ) {
					update_option( 'auto_load_next_post_theme_support_check', $template );
					return;
				}

				if ( get_option( 'auto_load_next_post_theme_support_check' ) !== $template ) {
					add_action( 'admin_notices', array( $this, 'theme_check_notice' ) );
				}
			}

			// Is admin notice hidden?
			$hide_notice = get_user_meta( $current_user->ID, 'auto_load_next_post_hide_review_notice', true );

			// Check if we need to display the review plugin notice.
			if ( current_user_can( 'install_plugins' ) && empty( $hide_notice ) ) {
				// If it has been a week or more since activating the plugin then display the review notice.
				if ( ( time() - self::$install_date ) > WEEK_IN_SECONDS ) {
					add_action( 'admin_notices', array( $this, 'plugin_review_notice' ) );
				}
			}

			// Upgrade Warning Notice that will disapear once the new release is installed.
			self::upgrade_warning();
		} // END add_notices()

		/**
		 * Shows an upgrade warning notice if the installed version is less
		 * than the new release coming soon.
		 *
		 * @access public
		 * @since  1.4.13
		 */
		public function upgrade_warning() {
			$upgrade_version = '1.5.0';

			if ( version_compare( AUTO_LOAD_NEXT_POST_VERSION, $upgrade_version, '<' ) ) {
				include_once( dirname( __FILE__ ) . '/views/html-notice-upgrade-warning.php' );
			}
		} // END upgrade_warning()

		/**
		 * Show the WordPress requirement notice.
		 *
		 * @access public
		 * @since  1.4.3
		 */
		public function requirement_wp_notice() {
			include( dirname( __FILE__ ) . '/views/html-notice-requirement-wp.php' );
		} // END requirement_wp_notice()

		/**
		 * Show the theme check notice.
		 *
		 * @access public
		 * @since  1.3.2
		 */
		public function theme_check_notice() {
			include( dirname( __FILE__ ) . '/views/html-notice-theme-support.php' );
		} // END theme_check_notice()

		/**
		 * Show the plugin review notice.
		 *
		 * @access  public
		 * @since   1.4.4
		 * @version 1.4.10
		 */
		public function plugin_review_notice() {
			$install_date = self::$install_date;

			include( dirname( __FILE__ ) . '/views/html-notice-please-review.php' );
		} // END plugin_review_notice()

	} // END class.

} // END if class exists.

return new Auto_Load_Next_Post_Admin_Notices();
