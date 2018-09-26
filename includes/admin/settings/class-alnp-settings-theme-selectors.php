<?php
/**
 * Auto Load Next Post Settings - Theme Selectors
 *
 * @since    1.0.0
 * @version  1.5.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Settings
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Auto_Load_Next_Post_Settings_Theme_Selectors_Tab' ) ) {

	class Auto_Load_Next_Post_Settings_Theme_Selectors_Tab extends Auto_Load_Next_Post_Settings_Page {

		/**
		 * Constructor.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.4.10
		 */
		public function __construct() {
			$this->id    = 'theme-selectors';
			$this->label = esc_html__( 'Theme Selectors', 'auto-load-next-post' );

			parent::__construct();

			add_action( 'auto_load_next_post_sections_theme-selectors', array( __CLASS__, 'is_theme_supported' ), 10 );
			add_action( 'auto_load_next_post_sections_theme-selectors', array( __CLASS__, 'no_theme_selectors_set' ), 10 );
		} // END __construct()

		/**
		 * This notifies the user if the active theme supports Auto Load Next Post.
		 *
		 * @access public
		 * @static
		 * @since  1.5.0
		 */
		public static function is_theme_supported() {
			if ( is_alnp_supported() ) {
				include( dirname( AUTO_LOAD_NEXT_POST_FILE ) . '/includes/admin/views/html-notice-is-supported.php' );
			}
		} // END is_theme_supported()

		/**
		 * This notifies the user if none of the required theme selectors are set.
		 *
		 * @access public
		 * @static
		 * @since  1.5.0
		 */
		public static function no_theme_selectors_set() {
			$set_selectors = array();

			$content_container    = get_option( 'auto_load_next_post_content_container' );
			$title_selector       = get_option( 'auto_load_next_post_title_selector' );
			$navigation_container = get_option( 'auto_load_next_post_navigation_container' );

			if ( ! empty( $content_container ) ) {
				$set_selectors[] = $content_container;
			}

			if ( ! empty( $title_selector ) ) {
				$set_selectors[] = $title_selector;
			}

			if ( ! empty( $navigation_container ) ) {
				$set_selectors[] = $navigation_container;
			}

			if ( empty( $set_selectors ) || is_array( $set_selectors ) && count( $set_selectors ) < 3 ) {
				include( dirname( AUTO_LOAD_NEXT_POST_FILE ) . '/includes/admin/views/html-notice-no-theme-selectors.php' );
			}
		} // END no_theme_selectors_set()

		/**
		 * Get settings array.
		 *
		 * @access public
		 * @since  1.0.0
		 * @global int $blog_id
		 * @return array
		 */
		public function get_settings() {
			global $blog_id;

			return apply_filters(
				'auto_load_next_post_theme_selectors_settings', array(

					array(
						'title' => esc_html__( 'Theme Selectors', 'auto-load-next-post' ),
						'type'  => 'title',
						'desc'  => sprintf( esc_html__( 'Here you set the theme selectors below according to your active theme. All are required for %s to work.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
						'id'    => 'theme_selectors_options'
					),

					array(
						'title'       => esc_html__( 'Content Container', 'auto-load-next-post' ),
						'desc'        => sprintf( __( 'The primary container where the post content is loaded in. Default: %s', 'auto-load-next-post' ), '<code>main.site-main</code>' ),
						'id'          => 'auto_load_next_post_content_container',
						'default'     => 'main.site-main',
						'placeholder' => esc_html__( 'Required', 'auto-load-next-post' ),
						'type'        => 'text',
						'css'         => 'min-width:300px;',
						'autoload'    => false
					),

					array(
						'title'    => esc_html__( 'Post Title', 'auto-load-next-post' ),
						'desc'     => sprintf( __( 'Used to identify which article the user is reading and track should Google Analytics or other analytics be enabled. Default: %s', 'auto-load-next-post' ), '<code>h1.entry-title</code>' ),
						'id'       => 'auto_load_next_post_title_selector',
						'default'  => 'h1.entry-title',
						'type'     => 'text',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'title'    => esc_html__( 'Post Navigation', 'auto-load-next-post' ),
						'desc'     => sprintf( __( 'Used to identify which post to load next if any. Default: %s', 'auto-load-next-post' ), '<code>nav.post-navigation</code>' ),
						'id'       => 'auto_load_next_post_navigation_container',
						'default'  => 'nav.post-navigation',
						'type'     => 'text',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'title'    => esc_html__( 'Comments Container', 'auto-load-next-post' ),
						'desc'     => sprintf( __( 'Used to remove comments if enabled under %1$sMisc%2$s settings. Default: %3$s', 'auto-load-next-post' ), '<strong><a href="' . get_admin_url( $blog_id, 'options-general.php?page=auto-load-next-post-settings&tab=misc' ) . '">', '</a></strong>', '<code>div#comments</code>' ),
						'id'       => 'auto_load_next_post_comments_container',
						'default'  => 'div#comments',
						'type'     => 'text',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'type' => 'sectionend',
						'id'   => 'theme_selectors_options'
					),
			) ); // End theme selectors settings
		} // END get_settings()

		/**
		 * Output the settings.
		 *
		 * @access public
		 * @since  1.4.10
		 */
		public function output() {
			$settings = $this->get_settings();

			Auto_Load_Next_Post_Admin_Settings::output_fields( $settings );
		} // END output()

		/**
		 * Save settings.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.5.0
		 */
		public function save() {
			$settings = $this->get_settings();

			Auto_Load_Next_Post_Admin_Settings::save_fields( $settings );
		} // END save()

	} // END class

} // END if class exists

return new Auto_Load_Next_Post_Settings_Theme_Selectors_Tab();
