<?php
/**
 * Auto Load Next Post - Admin.
 *
 * @since    1.0.0
 * @version  1.5.5
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Auto_Load_Next_Post_Admin' ) ) {

	class Auto_Load_Next_Post_Admin {

		/**
		 * Constructor
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.4.10
		 */
		public function __construct() {
			// Include classes.
			add_action( 'admin_init', array( $this, 'includes' ), 10 );

			// Register scripts and styles for settings page.
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ), 10 );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ), 10 );

			// Add a message in the WP Privacy Policy Guide page.
			add_action( 'admin_init', array( $this, 'add_privacy_policy_guide_content' ) );

			// Add settings page.
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );

			// Filters
			add_filter( 'plugin_action_links_' . plugin_basename( AUTO_LOAD_NEXT_POST_FILE ), array( $this, 'plugin_action_links' ) );
			add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta'), 10, 3 );
			add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );
			add_filter( 'update_footer', array( $this, 'update_footer'), 15 );
		} // END __construct()

		/**
		 * Include any classes we need within admin.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function includes() {
			// Classes we only need if the ajax is not-ajax
			if ( ! auto_load_next_post_is_ajax() ) {
				include( dirname( __FILE__ ) . '/class-alnp-admin-notices.php' ); // Plugin Notices
				include( dirname( __FILE__ ) . '/class-alnp-admin-help.php' ); // Plugin Help Tab
			}
		} // END includes()

		/**
		 * Register and enqueue stylesheets.
		 *
		 * @access public
		 * @since  1.5.0
		 * @global $wp_scripts
		 */
		public function admin_styles() {
			global $wp_scripts;

			$screen    = get_current_screen();
			$screen_id = $screen ? $screen->id : '';

			Auto_Load_Next_Post::load_file( AUTO_LOAD_NEXT_POST_SLUG . '_admin', '/assets/css/admin/auto-load-next-post' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.css' );

			if ( $screen->id == 'settings_page_auto-load-next-post-settings' ) {
				// Select2 - Make sure that we remove other registered Select2 to prevent styling issues.
				if ( wp_script_is( 'select2', 'registered' ) ) {
					wp_dequeue_style( 'select2' );
					wp_deregister_style( 'select2' );
				}

				Auto_Load_Next_Post::load_file( 'select2', '/assets/css/libs/select2' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.css' );
			}
		} // END admin_styles()

		/**
		 * Registers and enqueue javascripts.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.5.0
		 */
		public function admin_scripts() {
			$screen    = get_current_screen();
			$screen_id = $screen ? $screen->id : '';

			if ( $screen->id == 'settings_page_auto-load-next-post-settings' ) {
				// Select2 - Make sure that we remove other registered Select2 to prevent plugin conflict issues.
				if ( wp_script_is( 'select2', 'registered' ) ) {
					wp_dequeue_script( 'select2' );
					wp_deregister_script( 'select2' );
				}

				// Load Select2
				Auto_Load_Next_Post::load_file( 'select2', '/assets/js/libs/select2' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.js', true, array( 'jquery' ), '4.0.5', true );

				// Load plugin settings.
				Auto_Load_Next_Post::load_file( AUTO_LOAD_NEXT_POST_SLUG . '_admin', '/assets/js/admin/settings' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.js', true, array( 'jquery' ), AUTO_LOAD_NEXT_POST_VERSION, true );

				// Variables for Admin JavaScripts
				wp_localize_script( AUTO_LOAD_NEXT_POST_SLUG . '_admin', 'alnp_settings_params', array(
					'is_rtl'           => is_rtl() ? 'rtl' : 'ltr',
					'i18n_nav_warning' => esc_html__( 'The changes you made will be lost if you navigate away from this page.', 'auto-load-next-post' ),
				) );
			}
		} // END admin_scripts()

		/**
		 * Add a message in the WP Privacy Policy Guide page.
		 *
		 * @access public
		 * @since  1.5.0
		 * @static
		 */
		public static function add_privacy_policy_guide_content() {
			if ( function_exists( 'wp_add_privacy_policy_content' ) ) {
				wp_add_privacy_policy_content( esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), self::get_privacy_policy_guide_message() );
			}
		} // END add_privacy_policy_guide_content()

		/**
		 * Message to add in the WP Privacy Policy Guide page.
		 *
		 * @access protected
		 * @since  1.5.0
		 * @static
		 * @return string
		 */
		protected static function get_privacy_policy_guide_message() {
			$content = '
				<div contenteditable="false">' .
					'<p class="wp-policy-help">' .
						sprintf( __( '%s does not collect, store or share any personal data.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) .
					'</p>' .
				'</div>';

			return $content;
		} // END get_privacy_policy_guide_message()

		/**
		 * Add Auto Load Next Post to the settings menu.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.4.10
		 */
		public function admin_menu() {
			$settings_page = add_options_page(
				sprintf( __( '%s Settings', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
				esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ),
				'manage_options',
				'auto-load-next-post-settings',
				array( $this, 'settings_page' )
			);

			add_action( 'load-' . $settings_page, array( $this, 'settings_page_init' ) );
		} // END admin_menu()

		/**
		 * Loads settings.
		 *
		 * @access public
		 * @since  1.0.0
		 * @global string $current_tab
		 * @global string $current_section
		 */
		public function settings_page_init() {
			global $current_tab, $current_section;

			// Include settings pages.
			include_once( dirname( __FILE__ ) . '/class-alnp-admin-settings.php' );

			Auto_Load_Next_Post_Admin_Settings::get_settings_pages();

			// Get current tab/section.
			$current_tab     = empty( $_GET['tab'] ) ? 'theme-selectors' : sanitize_title( wp_unslash( $_GET['tab'] ) );
			$current_section = empty( $_REQUEST['section'] ) ? '' : sanitize_title( wp_unslash( $_REQUEST['section'] ) );

			// Save settings if data has been posted.
			if ( apply_filters( '' !== $current_section ? "auto_load_next_post_save_settings_{$current_tab}_{$current_section}" : "auto_load_next_post_save_settings_{$current_tab}", ! empty( $_POST ) ) ) {
				Auto_Load_Next_Post_Admin_Settings::save();
			}

			// Add any posted messages.
			if ( ! empty( $_GET['auto_load_next_post_error'] ) ) {
				Auto_Load_Next_Post_Admin_Settings::add_error( wp_kses_post( wp_unslash( $_GET['auto_load_next_post_error'] ) ) );
			}

			if ( ! empty( $_GET['auto_load_next_post_message'] ) ) {
				Auto_Load_Next_Post_Admin_Settings::add_message( wp_kses_post( wp_unslash( $_GET['auto_load_next_post_message'] ) ) );
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

			Auto_Load_Next_Post_Admin_Settings::output();
		} // END settings_page()

		/**
		 * Plugin action links.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.4.10
		 * @param   array $links
		 * @return  array $links
		 */
		public function plugin_action_links( $links ) {
			$plugin_action_links = array();

			if ( current_user_can( 'manage_options' ) ) {
				// Checks if Auto Load Next Post Pro has been installed.
				if ( ! is_alnp_pro_version_installed() ) {
					$plugin_action_links['go-pro'] = '<a href="' . esc_url( AUTO_LOAD_NEXT_POST_STORE_URL . 'pro/?utm_source=plugin&utm_medium=link&utm_campaign=plugins-page' ) . '" aria-label="' . esc_attr__( 'Sign up for Auto Load Next Post Pro', 'auto-load-next-post' ) . '" target="_blank" style="color:green; font-weight:bold;">' . __( 'Sign up for Pro', 'auto-load-next-post' ) . '</a>';
				}

				$plugin_action_links['settings'] = '<a href="' . admin_url( 'options-general.php?page=auto-load-next-post-settings' ) . '" aria-label="' . esc_attr__( 'View Auto Load Next Post settings', 'auto-load-next-post' ) . '">' . __( 'Settings', 'auto-load-next-post' ) . '</a>';

				return array_merge( $plugin_action_links, $links );
			}

			return $links;
		} // END plugin_action_links()

		/**
		 * Plugin row meta links
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.5.0
		 * @param   array  $links Plugin Row Meta
		 * @param   string $file  Plugin Base file
		 * @param   array  $data  Plugin Information
		 * @return  array  $links
		 */
		public function plugin_row_meta( $links, $file, $data ) {
			if ( $file == plugin_basename( AUTO_LOAD_NEXT_POST_FILE ) ) {
				$links[ 1 ] = sprintf( __( 'Developed By %s', 'auto-load-next-post' ), '<a href="' . $data[ 'AuthorURI' ] . '" aria-label="' . esc_attr__( 'View the developers site', 'auto-load-next-post' ) . '">' . $data[ 'Author' ] . '</a>' );

				$row_meta = array(
					'docs' => '<a href="' . esc_url( AUTO_LOAD_NEXT_POST_STORE_URL . 'documentation/?utm_source=plugin&utm_medium=link&utm_campaign=plugins-page' ) . '" aria-label="' . esc_attr__( 'View Auto Load Next Post documentation', 'auto-load-next-post' ) . '" target="_blank">' . esc_attr__( 'Documentation', 'auto-load-next-post' ) . '</a>',
					'community' => '<a href="' . esc_url( 'https://wordpress.org/support/plugin/auto-load-next-post' ) . '" aria-label="' . esc_attr__( 'Get support from the community', 'auto-load-next-post' ). '" target="_blank">' . esc_attr__( 'Community Support', 'auto-load-next-post' ) . '</a>',
					'theme-support' => '<a href="' . esc_url( AUTO_LOAD_NEXT_POST_STORE_URL . 'product/theme-support/?utm_source=plugin&utm_medium=link&utm_campaign=plugins-page' ) . '" attr-label="' . esc_attr__( 'Get theme support', 'auto-load-next-post' ) . '" target="_blank">' . esc_attr__( 'Theme Support', 'auto-load-next-post' ) . '</a>',
				);

				$links = array_merge( $links, $row_meta );
			}

			return $links;
		} // END plugin_row_meta()

		/**
		 * Filters the admin footer text by placing simply thank you to those who
		 * like and review the plugin on WordPress.org.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.4.10
		 * @param   string $text
		 * @return  string $text
		 */
		public function admin_footer_text( $text ) {
			$current_screen = get_current_screen();

			if ( isset( $current_screen->id ) && $current_screen->id == 'settings_page_auto-load-next-post-settings' ) {
				// Rating and Review
				return sprintf(
					/* translators: 1: Auto Load Next Post 2:: five stars */
					__( 'If you like %1$s, please leave a %2$s rating. A huge thank you in advance!', 'auto-load-next-post' ),
					sprintf( '<strong>%1$s</strong>', esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
					'<a href="' . AUTO_LOAD_NEXT_POST_REVIEW_URL . '?rate=5#new-post" target="_blank" data-rated="' . esc_attr__( 'Thanks :)', 'auto-load-next-post' ) . '">&#9733;&#9733;&#9733;&#9733;&#9733;</a>'
				);
			}

			return $text;
		} // END admin_footer_text()

		/**
		 * Filters the update footer by placing the version of the plugin
		 * when viewing any of the plugins pages.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.4.10
		 * @param   string $text
		 * @return  string $text
		 */
		public function update_footer( $text ) {
			$screen = get_current_screen();

			if ( $screen->id == 'settings_page_auto-load-next-post-settings' ) {
				return '<p class="alignright">' . sprintf( __( '%s Version', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . ' ' . esc_attr( AUTO_LOAD_NEXT_POST_VERSION ) . '</p>';
			}

			return $text;
		} // END update_footer()

	} // END class

} // END if class exists

return new Auto_Load_Next_Post_Admin();
