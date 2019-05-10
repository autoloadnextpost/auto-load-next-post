<?php
/**
 * Auto Load Next Post Settings - Theme Selectors
 *
 * @since    1.0.0
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Settings
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Settings_Theme_Selectors' ) ) {

	class ALNP_Settings_Theme_Selectors extends ALNP_Settings_Page {

		/**
		 * Constructor.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.6.0
		 */
		public function __construct() {
			$this->id    = 'theme-selectors';
			$this->label = esc_html__( 'Theme Selectors', 'auto-load-next-post' );

			parent::__construct();

			add_action( 'auto_load_next_post_settings_theme-selectors', array( __CLASS__, 'is_theme_supported' ), 0 );
			add_action( 'auto_load_next_post_settings_theme-selectors', array( __CLASS__, 'no_theme_selectors_set' ), 0 );
		} // END __construct()

		/**
		 * This notifies the user if the active theme supports Auto Load Next Post.
		 *
		 * @access public
		 * @static
		 * @since  1.5.10
		 */
		public static function is_theme_supported() {
			if ( is_alnp_supported() ) {
				$plugin_supported = alnp_get_theme_support( 'plugin_support' );

				// Is the theme supported by theme or plugin?
				if ( ! empty( $plugin_supported ) && $plugin_supported == 'yes' ) {
					include( dirname( AUTO_LOAD_NEXT_POST_FILE ) . '/includes/admin/views/html-notice-plugin-supported.php' );
				} else {
					include( dirname( AUTO_LOAD_NEXT_POST_FILE ) . '/includes/admin/views/html-notice-is-supported.php' );
				}
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
		 * @access  public
		 * @since   1.0.0
		 * @version 1.6.0
		 * @global  int $blog_id
		 * @return  array
		 */
		public function get_settings() {
			global $blog_id;

			$settings = array();

			$settings[] = array(
				'title' => esc_html__( 'Theme Selectors', 'auto-load-next-post' ),
				'type'  => 'title',
				'desc'  => sprintf( esc_html__( 'Here you set the theme selectors below according to your active theme. All are required for %s to work.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
				'id'    => 'theme_selectors_options'
			);

			// Provide the theme customizer option if theme is not already supported.
			if ( ! is_alnp_supported() ) {
				$query = array(
					'autofocus[panel]'   => 'alnp',
					'autofocus[section]' => 'auto_load_next_post_theme_selectors',
					'url'                => alnp_get_random_page_permalink(),
					'return'             => add_query_arg( array( 'page' => 'auto-load-next-post', 'view' => 'theme-selectors' ), admin_url( 'options-general.php' ) ),
				);
				$customizer_link = add_query_arg( $query, admin_url( 'customize.php' ) );

				$settings[] = array(
					'title'   => esc_html__( 'Theme Customizer', 'auto-load-next-post' ),
					'desc'    => esc_html__( 'Use the theme customizer to enter the theme selectors while you inspect the theme.', 'auto-load-next-post' ),
					'id'      => 'auto_load_next_post_customizer',
					'value'   => esc_html__( 'Open Theme Customizer', 'auto-load-next-post' ),
					'url'     => $customizer_link,
					'type'    => 'button'
				);
			}

			// Defines input field status
			$container_readonly = 'no';
			$post_title_readonly = 'no';
			$post_navigation_readonly = 'no';
			$comments_container_readonly = 'no';

			// Checks if the Content Container selector has been set by theme support.
			if ( ! empty( alnp_get_theme_support( 'content_container' ) ) ) {
				$container_readonly = 'yes';
			}

			$settings[] = array(
				'title'       => esc_html__( 'Content Container', 'auto-load-next-post' ),
				'desc'        => sprintf( __( 'The primary container where the post content is loaded in. Default: %s', 'auto-load-next-post' ), '<code>main.site-main</code>' ),
				'id'          => 'auto_load_next_post_content_container',
				'default'     => 'main.site-main',
				'placeholder' => sprintf( esc_html__( 'e.g. %s', 'auto-load-next-post' ), 'main.site-main' ),
				'readonly'    => $container_readonly,
				'type'        => 'text',
				'css'         => 'min-width:300px;',
				'autoload'    => false
			);

			// Checks if the Post Title selector has been set by theme support.
			if ( ! empty( alnp_get_theme_support( 'title_selector' ) ) ) {
				$post_title_readonly = 'yes';
			}

			$settings[] = array(
				'id'          => 'auto_load_next_post_title_selector',
				'default'     => 'h1.entry-title',
				'placeholder' => sprintf( esc_html__( 'e.g. %s', 'auto-load-next-post' ), 'h1.entry-title' ),
				'readonly'    => $post_title_readonly,
				'type'        => 'text',
			);

			// Checks if the Post Navigation selector has been set by theme support.
			if ( ! empty( alnp_get_theme_support( 'navigation_container' ) ) ) {
				$post_navigation_readonly = 'yes';
			}

			$settings[] = array(
				'id'          => 'auto_load_next_post_navigation_container',
				'default'     => 'nav.post-navigation',
				'placeholder' => sprintf( esc_html__( 'e.g. %s', 'auto-load-next-post' ), 'nav.post-navigation' ),
				'readonly'    => $post_navigation_readonly,
				'type'        => 'text',
			);

			// Checks if the Comments Container selector has been set by theme support.
			if ( ! empty( alnp_get_theme_support( 'comments_container' ) ) ) {
				$comments_container_readonly = 'yes';
			}

			$settings[] = array(
				'id'          => 'auto_load_next_post_comments_container',
				'default'     => 'div#comments',
				'placeholder' => sprintf( esc_html__( 'e.g. %s', 'auto-load-next-post' ), 'div#comments' ),
				'readonly'    => $comments_container_readonly,
				'type'        => 'text',
				'css'         => 'min-width:300px;',
				'autoload'    => false
			);

			$settings[] = array(
				'type' => 'sectionend',
				'id'   => 'theme_selectors_options'
			);

			return apply_filters( 'alnp_selectors_settings', $settings );
		} // END get_settings()

		/**
		 * Output the settings.
		 *
		 * @access public
		 * @since  1.4.10
		 */
		public function output() {
			$settings = $this->get_settings();

			ALNP_Admin_Settings::output_fields( $settings );
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

			ALNP_Admin_Settings::save_fields( $settings );
		} // END save()

	} // END class

} // END if class exists

return new ALNP_Settings_Theme_Selectors();
