<?php
/**
 * Auto Load Next Post - Site Health.
 *
 * Adds Auto Load Next Post settings to WordPress Site Health.
 *
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Admin_Site_Health' ) ) {

	class ALNP_Admin_Site_Health {

		/**
		 * Constructor
		 *
		 * @access public
		 */
		public function __construct() {
			add_filter( 'debug_information', array( $this, 'add_debug_info' ) );
		} // END __construct()

		/**
		 * Adds Auto Load Next Post for debugging purposes.
		 *
		 * @access public
		 * @param  array $debug_info
		 * @return array $debug_info
		 */
		public function add_debug_info( $debug_info ) {
			$debug_info['auto-load-next-post'] = array(
				'label'    => esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ),
				'fields'   => array(
					// Theme Selectors
					'content_container' => array(
						'label'   => esc_html__( 'Content Container', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_content_container', 'main.site-main' ),
						'private' => false,
					),
					'post_title_selector' => array(
						'label'   => esc_html__( 'Post Title', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_title_selector', 'h1.entry-title' ),
						'private' => false,
					),
					'navigation_container' => array(
						'label'   => esc_html__( 'Post Navigation', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_navigation_container', 'nav.post-navigation' ),
						'private' => false,
					),
					'comments_container' => array(
						'label'   => esc_html__( 'Comments Container', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_comments_container', 'div#comments' ),
						'private' => false,
					),

					// Templates
					'use_fallback' => array(
						'label'   => esc_html__( 'Use Fallback?', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_use_fallback', 'no' ),
						'private' => false,
					),

					// Misc
					'remove_comments' => array(
						'label'   => esc_html__( 'Remove Comments', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_remove_comments', 'yes' ),
						'private' => false,
					),
					'google_analytics' => array(
						'label'   => esc_html__( 'Update Google Analytics', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_google_analytics', 'no' ),
						'private' => false,
					),
					'load_js_in_footer' => array(
						'label'   => esc_html__( 'JavaScript in Footer?', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_load_js_in_footer', 'no' ),
						'private' => false,
					),
					'disable_on_mobile' => array(
						'label'   => esc_html__( 'Disable for Mobile?', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_disable_on_mobile', 'no' ),
						'private' => false,
					),
					'uninstall' => array(
						'label'   => esc_html__( 'Remove all data on uninstall?', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_uninstall_data', 'no' ),
						'private' => false,
					),

					// Events
					'on_load_event' => array(
						'label'   => esc_html__( 'Post loaded', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_on_load_event', '' ),
						'private' => false,
					),
					'on_entering_event' => array(
						'label'   => esc_html__( 'Entering a Post', 'auto-load-next-post' ),
						'value'   => get_option( 'auto_load_next_post_on_entering_event', '' ),
						'private' => false,
					),
				),
			);

			return $debug_info;
		} // END add_debug_info()

	} // END class

} // END if class exists

return new ALNP_Admin_Site_Health();
