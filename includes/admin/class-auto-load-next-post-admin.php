<?php
/**
 * Auto Load Next Post - Admin.
 *
 * @since    1.0.0
 * @version  1.5.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
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
			// Actions
			add_action( 'admin_init', array( $this, 'includes' ), 10 );
			add_action( 'admin_init', array( $this, 'admin_scripts' ), 100 );

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
				include( dirname( __FILE__ ) . '/class-auto-load-next-post-admin-notices.php' ); // Plugin Notices
				include( dirname( __FILE__ ) . '/class-auto-load-next-post-admin-help.php' ); // Plugin Help Tab
			}
		} // END includes()

		/**
		 * Registers and enqueues stylesheets and javascripts
		 * for the administration panel.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.5.0
		 */
		public function admin_scripts() {
			// Chosen
			Auto_Load_Next_Post::load_file( 'chosen', '/assets/js/libs/chosen.jquery.min.js', true, array('jquery'), AUTO_LOAD_NEXT_POST_VERSION );

			// Variables for Admin JavaScripts
			wp_localize_script( AUTO_LOAD_NEXT_POST_SLUG . '_admin_script', 'auto_load_next_post_admin_params', array(
				'i18n_nav_warning' => __( 'The changes you made will be lost if you navigate away from this page.', 'auto-load-next-post' ),
			));

			// Stylesheets
			Auto_Load_Next_Post::load_file( AUTO_LOAD_NEXT_POST_SLUG . '_admin_style', '/assets/css/admin/auto-load-next-post' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.css' );
			Auto_Load_Next_Post::load_file( AUTO_LOAD_NEXT_POST_SLUG.'_chosen_style', '/assets/css/libs/chosen.min.css' );
		} // END admin_scripts()

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
			include_once( dirname( __FILE__ ) . '/class-auto-load-next-post-admin-settings.php' );

			Auto_Load_Next_Post_Admin_Settings::get_settings_pages();

			// Get current tab/section.
			$current_tab     = empty( $_GET['tab'] ) ? 'general' : sanitize_title( wp_unslash( $_GET['tab'] ) );
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
			include_once( dirname( __FILE__ ) . '/class-auto-load-next-post-admin-settings.php' );

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
					$plugin_action_links['go-pro'] = '<a href="' . esc_url( 'https://autoloadnextpost.com/pro/?utm_source=plugin&utm_medium=link&utm_campaign=plugins-page' ) . '" target="_blank" style="color:green; font-weight:bold;">' . __( 'Upgrade to Pro', 'auto-load-next-post' ) . '</a>';
				}

				$plugin_action_links['settings'] = '<a href="' . admin_url( 'options-general.php?page=auto-load-next-post-settings' ) . '">' . __( 'Settings', 'auto-load-next-post' ) . '</a>';

				return array_merge( $plugin_action_links, $links );
			}

			return $links;
		} // END plugin_action_links()

		/**
		 * Plugin row meta links
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.4.10
		 * @param   array  $links Plugin Row Meta
		 * @param   string $file  Plugin Base file
		 * @param   array  $data  Plugin Information
		 * @return  array  $links
		 */
		public function plugin_row_meta( $links, $file, $data ) {
			if ( $file == plugin_basename( AUTO_LOAD_NEXT_POST_FILE ) ) {
				$links[ 1 ] = sprintf( __( 'Developed By %s', 'auto-load-next-post' ), '<a href="' . $data[ 'AuthorURI' ] . '">' . $data[ 'Author' ] . '</a>' );

				$row_meta = array(
					'docs' => '<a href="' . esc_url( 'https://autoloadnextpost.com/documentation/' ) . '" target="_blank">' . __( 'Documentation', 'auto-load-next-post' ) . '</a>',
					'community' => '<a href="' . esc_url( 'https://wordpress.org/support/plugin/auto-load-next-post' ) . '" target="_blank">' . __( 'Community Support', 'auto-load-next-post' ) . '</a>',
					'theme-support' => '<a href="' . esc_url( 'https://autoloadnextpost.com/product/theme-support/?utm_source=plugin&utm_medium=link&utm_campaign=plugins-page' ) . '" target="_blank">' . __( 'Theme Support', 'auto-load-next-post' ) . '</a>',
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
					'<a href="https://wordpress.org/support/plugin/auto-load-next-post/reviews?rate=5#new-post" target="_blank" data-rated="' . esc_attr__( 'Thanks :)', 'auto-load-next-post' ) . '">&#9733;&#9733;&#9733;&#9733;&#9733;</a>'
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
