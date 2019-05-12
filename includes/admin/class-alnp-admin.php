<?php
/**
 * Auto Load Next Post - Admin.
 *
 * @since    1.0.0
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Admin' ) ) {

	class ALNP_Admin {

		/**
		 * Constructor
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.6.0
		 */
		public function __construct() {
			// Include classes.
			self::includes();

			// Add settings page.
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
		} // END __construct()

		/**
		 * Include any classes we need within admin.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.6.0
		 */
		public function includes() {
			include( dirname( __FILE__ ) . '/class-alnp-action-links.php' );              // Action Links
			include( dirname( __FILE__ ) . '/class-alnp-admin-assets.php' );              // Admin Assets
			include( dirname( __FILE__ ) . '/class-alnp-admin-notices.php' );             // Plugin Notices

			if ( apply_filters( 'alnp_enable_admin_help_tab', true ) ) {
				include( dirname( __FILE__ ) . '/class-alnp-admin-help.php' );            // Plugin Help Tab
			}

			include_once( dirname( __FILE__ ) . '/class-alnp-getting-started.php');       // Getting Started.
			include_once( dirname( __FILE__ ) . '/class-alnp-setup-wizard.php');          // Setup Wizard.
			include_once( dirname( __FILE__ ) . '/class-alnp-extensions.php');            // Extensions.

			if ( ! is_alnp_pro_version_installed() ) {
				include_once( dirname( __FILE__ ) . '/class-alnp-admin-pro-preview.php'); // Pro Preview.
			}

			include( dirname( __FILE__ ) . '/class-alnp-sidebar.php' );                   // Sidebar
			include( dirname( __FILE__ ) . '/class-alnp-admin-footer.php' );              // Admin Footer
			include( dirname( __FILE__ ) . '/class-alnp-privacy.php' );                   // Plugin Privacy
		} // END includes()

		/**
		 * Add Auto Load Next Post to the settings menu.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.6.0
		 */
		public function admin_menu() {
			$current_view = ! empty( $_GET['view'] ) ? sanitize_title( wp_unslash( $_GET['view'] ) ) : '';
			$title = '';

			switch( $current_view ) {
				case 'getting-started':
					$title = sprintf( esc_attr__( 'Getting Started with %s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) );
					break;
				case 'setup-wizard':
					$title = sprintf( esc_attr__( 'Setup Wizard for %s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) );
					break;
				case 'extensions':
					$title = sprintf( esc_attr__( '%s | Extensions', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) );
					break;
				default:
					$title = sprintf( esc_attr__( '%s Settings', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) );
					break;
			}

			$settings_page = add_options_page(
				$title,
				esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ),
				'manage_options',
				'auto-load-next-post',
				array( $this, 'settings_page' )
			);

			add_action( 'load-' . $settings_page, array( $this, 'settings_page_init' ) );
		} // END admin_menu()

		/**
		 * Loads settings.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.6.0
		 * @global  string $current_view
		 * @global  string $current_section
		 */
		public function settings_page_init() {
			global $current_view, $current_section;

			// Include settings pages.
			include_once( dirname( __FILE__ ) . '/class-alnp-admin-settings.php' );

			ALNP_Admin_Settings::get_settings_pages();

			// Get current view/section.
			$current_view    = empty( $_GET['view'] ) ? 'theme-selectors' : sanitize_title( wp_unslash( $_GET['view'] ) );
			$current_section = empty( $_REQUEST['section'] ) ? '' : sanitize_title( wp_unslash( $_REQUEST['section'] ) );

			// Save settings if data has been posted.
			if ( apply_filters( '' !== $current_section ? "alnp_save_settings_{$current_view}_{$current_section}" : "alnp_save_settings_{$current_view}", ! empty( $_POST ) ) ) {
				ALNP_Admin_Settings::save();
			}

			// Add any posted messages.
			if ( ! empty( $_GET['auto_load_next_post_error'] ) ) {
				ALNP_Admin_Settings::add_error( wp_kses_post( wp_unslash( $_GET['auto_load_next_post_error'] ) ) );
			}

			if ( ! empty( $_GET['auto_load_next_post_message'] ) ) {
				ALNP_Admin_Settings::add_message( wp_kses_post( wp_unslash( $_GET['auto_load_next_post_message'] ) ) );
			}

			do_action( 'auto_load_next_post_settings_page_init' );
		} // END settings_page_init()

		/**
		 * Initialize the Auto Load Next Post settings page.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function settings_page() {
			include_once( dirname( __FILE__ ) . '/class-alnp-admin-settings.php' );

			ALNP_Admin_Settings::output();
		} // END settings_page()

	} // END class

} // END if class exists

return new ALNP_Admin();
