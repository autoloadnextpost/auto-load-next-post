<?php
/**
 * Auto Load Next Post - Installation related functions and actions.
 *
 * @since    1.0.0
 * @version  1.5.1
 * @author   Sébastien Dumont
 * @category Classes
 * @package  Auto Load Next Post/Classes/Install
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Auto_Load_Next_Post_Install' ) ) {

	class Auto_Load_Next_Post_Install {

		/**
		 * Plugin version.
		 *
		 * @access private
		 * @static
		 * @since 1.4.10
		 * @var string
		 */
		private static $current_version;

		/**
		 * Constructor.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function __construct() {
			add_action( 'init', array( __CLASS__, 'add_rewrite_endpoint' ), 0 );
			add_action( 'init', array( __CLASS__, 'check_version' ), 5 );

			// Get plugin version.
			self::$current_version = get_option( 'auto_load_next_post_version' );
		} // END __construct()

		/**
		 * Check plugin version and run the updater if necessary.
		 *
		 * This check is done on all requests and runs if the versions do not match.
		 *
		 * @access public
		 * @static
		 * @since  1.4.10
		 */
		public static function check_version() {
			if ( ! defined( 'IFRAME_REQUEST' ) && version_compare( self::$current_version, AUTO_LOAD_NEXT_POST_VERSION, '<' ) ) {
				self::install();
				do_action( 'auto_load_next_post_updated' );
			}
		} // END check_version()

		/**
		 * Install Auto Load Next Post.
		 *
		 * @access  public
		 * @static
		 * @since   1.0.0
		 * @version 1.5.0
		 */
		public static function install() {
			if ( ! is_blog_installed() ) {
				return;
			}

			// Check if we are not already running this routine.
			if ( 'yes' === get_transient( 'alnp_installing' ) ) {
				return;
			}

			// If we made it till here nothing is running yet, lets set the transient now for five minutes.
			set_transient( 'alnp_installing', 'yes', MINUTE_IN_SECONDS * 5 );
			if ( ! defined( 'AUTO_LOAD_NEXT_POST_INSTALLING' ) ) {
				define( 'AUTO_LOAD_NEXT_POST_INSTALLING', true );
			}

			// Add default options.
			self::create_options();

			// Set theme selectors if current active theme supports Auto Load Next Post.
			self::set_theme_selectors();

			// Sets ALNP to load in the footer if the current active theme requires it.
			self::set_js_in_footer();

			// Set activation date.
			self::set_install_date();

			// Update plugin version.
			self::update_version();

			// Refresh rewrite rules.
			self::flush_rewrite_rules();

			delete_transient( 'alnp_installing' );

			do_action( 'alnp_installed' );
		} // END install()

		/**
		 * Set theme selectors for the current active theme should it
		 * support Auto Load Next Post and have the theme selectors set.
		 *
		 * @access private
		 * @static
		 * @since  1.5.0
		 */
		private static function set_theme_selectors() {
			if ( is_alnp_supported() ) {
				$content_container    = alnp_get_theme_support( 'content_container' );
				$title_selector       = alnp_get_theme_support( 'title_selector' );
				$navigation_container = alnp_get_theme_support( 'navigation_container' );
				$comments_container   = alnp_get_theme_support( 'comments_container' );

				if ( ! empty( $content_container ) ) update_option( 'auto_load_next_post_content_container', $content_container );
				if ( ! empty( $title_selector ) ) update_option( 'auto_load_next_post_title_selector', $title_selector );
				if ( ! empty( $navigation_container ) ) update_option( 'auto_load_next_post_navigation_container', $navigation_container );
				if ( ! empty( $comments_container ) ) update_option( 'auto_load_next_post_comments_container', $comments_container );
			}
		} // END set_theme_selectors()

		/**
		 * Sets Auto Load Next Post to load in the footer if the 
		 * current active theme requires it and lock it so the 
		 * user can not disable it should the theme not work any other way.
		 *
		 * @access private
		 * @static
		 * @since   1.5.0
		 * @version 1.5.3
		 */
		private static function set_js_in_footer() {
			if ( is_alnp_supported() ) {
				$load_js_in_footer = alnp_get_theme_support( 'load_js_in_footer' );
				$lock_js_in_footer = alnp_get_theme_support( 'lock_js_in_footer' );

				if ( ! empty( $load_js_in_footer ) && $load_js_in_footer == 'yes' ) update_option( 'auto_load_next_post_load_js_in_footer', $load_js_in_footer );
				if ( ! empty( $lock_js_in_footer ) && $lock_js_in_footer == 'yes' ) update_option( 'auto_load_next_post_lock_js_in_footer', $lock_js_in_footer );
			}
		} // END set_js_in_footer()

		/**
		 * Update plugin version to current.
		 *
		 * @access private
		 * @static
		 */
		private static function update_version() {
			update_option( 'auto_load_next_post_version', AUTO_LOAD_NEXT_POST_VERSION );
		} // END update_version()

		/**
		 * Set the time the plugin was installed.
		 *
		 * @access  public
		 * @static
		 * @since   1.4.4
		 * @version 1.5.0
		 */
		public static function set_install_date() {
			$install_date = get_site_option( 'auto_load_next_post_install_date' );

			// If ALNP was installed before but the install date was not converted to time then convert it.
			if ( ! empty( $install_date ) && !intval( $install_date ) ) {
				update_site_option( 'auto_load_next_post_install_date', strtotime( $install_date ) );
			} else {
				add_site_option( 'auto_load_next_post_install_date', time() );
			}
		} // END set_install_date()

		/**
		 * Default Options
		 *
		 * Sets up the default options defined on the settings pages.
		 *
		 * @access  public
		 * @static
		 * @since   1.0.0
		 * @version 1.5.1
		 */
		public static function create_options() {
			// Include settings so that we can run through defaults
			include_once( dirname( __FILE__ ) . '/admin/class-alnp-admin-settings.php' );

			$settings = Auto_Load_Next_Post_Admin_Settings::get_settings_pages();

			foreach ( $settings as $section ) {
				foreach ( $section->get_settings() as $value ) {
					if ( isset( $value['default'] ) && isset( $value['id'] ) ) {
						$autoload = isset( $value['autoload'] ) ? (bool) $value['autoload'] : true;
						add_option( $value['id'], $value['default'], '', ( $autoload ? 'yes' : 'no' ) );
					}
				}
			}
		} // END create_options()

		/**
		 * Add rewrite endpoint for Auto Load Next Post.
		 *
		 * @access  public
		 * @static
		 * @since   1.0.0
		 * @version 1.5.0
		 */
		public static function add_rewrite_endpoint() {
			add_rewrite_endpoint( 'alnp', EP_PERMALINK | EP_PAGES | EP_ATTACHMENT );
		} // END add_rewrite_endpoint()

		/**
		 * Flush rewrite rules.
		 *
		 * @access public
		 * @static
		 * @since  1.5.0
		 */
		public static function flush_rewrite_rules() {
			flush_rewrite_rules();
		} // END flush_rewrite_rules()

	} // END class.

} // END if class exists.

return new Auto_Load_Next_Post_Install();
