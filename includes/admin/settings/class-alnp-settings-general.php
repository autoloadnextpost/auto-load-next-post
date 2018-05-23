<?php
/**
 * Auto Load Next Post Settings - General
 *
 * @since    1.0.0
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

if ( ! class_exists( 'Auto_Load_Next_Post_Settings_General_Tab' ) ) {

	class Auto_Load_Next_Post_Settings_General_Tab extends Auto_Load_Next_Post_Settings_Page {

		/**
		 * Constructor.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.4.10
		 */
		public function __construct() {
			$this->id    = 'general';
			$this->label = __( 'General', 'auto-load-next-post' );

			parent::__construct();

			add_action( 'auto_load_next_post_sections_general', array( __CLASS__, 'is_theme_supported' ), 10 );
			add_action( 'auto_load_next_post_sections_general', array( __CLASS__, 'no_theme_selectors_set' ), 10 );
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
		 * @return array
		 */
		public function get_settings() {
			return apply_filters(
				'auto_load_next_post_general_settings', array(

					array(
						'title' => __( 'General', 'auto-load-next-post' ),
						'type'  => 'title',
						'desc'  => sprintf( __( 'Here you set the theme selectors below according to your active theme. All are required for %s to work.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
						'id'    => 'general_options'
					),

					array(
						'title'    => __( 'Content Container', 'auto-load-next-post' ),
						'desc'     => __( 'This is the primary container were the post content is loaded in. Example: <code>main.site-main</code>', 'auto-load-next-post' ),
						//'desc_tip' => true,
						'id'       => 'auto_load_next_post_content_container',
						'default'  => 'main.site-main',
						'type'     => 'text',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'title'    => __( 'Post Title', 'auto-load-next-post' ),
						'desc'     => __( 'This is used to identify which article the user is reading and track if Google Analytics is enabled. Example: <code>h1.entry-title</code>', 'auto-load-next-post' ),
						//'desc_tip' => true,
						'id'       => 'auto_load_next_post_title_selector',
						'default'  => 'h1.entry-title',
						'type'     => 'text',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'title'    => __( 'Post Navigation', 'auto-load-next-post' ),
						'desc'     => __( 'The post navigation needs to be indentified to find the next post. Example: <code>nav.post-navigation</code>', 'auto-load-next-post' ),
						//'desc_tip' => true,
						'id'       => 'auto_load_next_post_navigation_container',
						'default'  => 'nav.post-navigation',
						'type'     => 'text',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'title'    => __( 'Comments Container', 'auto-load-next-post' ),
						'desc'     => __( 'This is so comments can be removed if enabled below. Example: <code>div#comments</code>', 'auto-load-next-post' ),
						//'desc_tip' => true,
						'id'       => 'auto_load_next_post_comments_container',
						'default'  => 'div#comments',
						'type'     => 'text',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'type' => 'sectionend',
						'id'   => 'general_options'
					),
			) ); // End general settings
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
		 * @access public
		 * @since  1.0.0
		 * @global $current_tab
		 */
		public function save() {
			global $current_tab;

			$settings = $this->get_settings();

			Auto_Load_Next_Post_Admin_Settings::save_fields( $settings, $current_tab );
		} // END save()

		/**
		 * Get post types.
		 *
		 * This returns a list of public registered post types.
		 *
		 * @access public
		 * @since  1.3.2
		 * @return array
		 */
		public function get_post_types() {
			$post_types = get_post_types( array( 'public' => true ), 'names' );

			return $post_types;
		} // END get_post_types()

	} // END class

} // END if class exists

return new Auto_Load_Next_Post_Settings_General_Tab();
