<?php
/**
 * Auto Load Next Post - Installation related functions and actions.
 *
 * @since    1.0.0
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Classes
 * @package  Auto Load Next Post/Classes/Install
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Install' ) ) {

	class ALNP_Install {

		/**
		 * Constructor.
		 *
		 * @since   1.0.0
		 * @version 1.6.0
		 * @access  public
		 */
		public function __construct() {
			// Resets Auto Load Next Post settings when requested.
			add_action( 'init', array( __CLASS__, 'reset_alnp' ), 0 );

			// Checks version of Auto Load Next Post and install/update if needed.
			add_action( 'init', array( __CLASS__, 'check_version' ), 5 );

			// Adds rewrite endpoint.
			add_action( 'init', array( __CLASS__, 'add_rewrite_endpoint' ), 10 );

			// Redirect to Getting Started page once activated.
			add_action( 'activated_plugin', array( __CLASS__, 'redirect_getting_started') );
		} // END __construct()

		/**
		 * Check plugin version and run the updater if necessary.
		 *
		 * This check is done on all requests and runs if the versions do not match.
		 *
		 * @access  public
		 * @static
		 * @since   1.4.10
		 * @version 1.6.0
		 */
		public static function check_version() {
			// Check if we are not already running this routine.
			if ( 'yes' === get_transient( 'alnp_resetting' ) ) {
				return;
			}

			if ( ! defined( 'IFRAME_REQUEST' ) && version_compare( get_option( 'auto_load_next_post_version' ), AUTO_LOAD_NEXT_POST_VERSION, '<' ) && current_user_can( 'install_plugins' ) ) {
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
		 * @version 1.6.0
		 */
		public static function install() {
			if ( ! is_blog_installed() ) {
				return;
			}

			// Check if we are not already running this routine.
			if ( 'yes' === get_transient( 'alnp_installing' ) ) {
				return;
			}

			// If we made it till here nothing is running yet, lets set the transient now for two minutes.
			set_transient( 'alnp_installing', 'yes', MINUTE_IN_SECONDS * 2 );
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
			if ( ! empty( $install_date ) && ! intval( $install_date ) ) {
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

			$settings = ALNP_Admin_Settings::get_settings_pages();

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

		/**
		 * Resets all Auto Load Next Post settings.
		 *
		 * @access  public
		 * @static
		 * @since   1.5.11
		 * @version 1.6.0
		 * @global  object $wpdb 
		 */
		public static function reset_alnp() {
			if ( current_user_can( 'install_plugins' ) && isset( $_GET['reset-alnp'] ) && $_GET['reset-alnp'] == 'yes' ) {
				global $wpdb;

				// If we made it till here nothing is running yet, lets set the transient now for two minutes.
				set_transient( 'alnp_resetting', 'yes', MINUTE_IN_SECONDS * 2 );
	
				// Make sure it is only a single site we are resetting.
				if ( ! is_multisite() ) {
					// Delete options
					$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'auto_load_next_post_%'");

					// Delete user interactions
					$wpdb->query("DELETE FROM $wpdb->usermeta WHERE meta_key LIKE 'auto_load_next_post_%'");
				}
				else {
					// Delete Uninstall Data
					delete_site_option( 'auto_load_next_post_uninstall_data' );

					// Delete Install Date
					delete_site_option( 'auto_load_next_post_install_date' );
				}

				// Re-install Auto Load Next Post
				self::install();

				wp_safe_redirect( add_query_arg( array(
					'page'  => 'auto-load-next-post',
					'reset' => 'done'
				), admin_url( 'options-general.php' ) ) );
				exit;
			}
		} // END reset_alnp()

		/**
		 * Redirects to the Getting Started page upon plugin activation.
		 *
		 * @access public
		 * @static
		 * @since  1.6.0
		 * @param  string $plugin The activate plugin name.
		 */
		public static function redirect_getting_started( $plugin ) {
			// Prevent redirect if plugin name does not match.
			wp_die( $plugin );
			if ( $plugin !== AUTO_LOAD_NEXT_POST_FILE_PATH ) {
				return;
			}

			$getting_started = add_query_arg( array(
				'page' => 'auto-load-next-post',
				'view' => 'getting-started'
			), admin_url( 'options-general.php' ) );

			/**
			 * Should Auto Load Next Post be installed via WP-CLI,
			 * display a link to the Getting Started page.
			 */
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				WP_CLI::log(
					WP_CLI::colorize(
						'%y' . sprintf( '🎉 %1$s %2$s', __( 'Get started with %3$s here:', 'auto-load-next-post' ), $getting_started, esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '%n'
					)
				);
				return;
			}

			// If activated on a Multisite, don't redirect.
			if ( is_multisite() ) {
				return;
			}

			wp_safe_redirect( $getting_started );
			exit;
		} // END redirect_getting_started()
	} // END class.

} // END if class exists.

return new ALNP_Install();
