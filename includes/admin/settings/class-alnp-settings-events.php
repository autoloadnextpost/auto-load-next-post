<?php
/**
 * Auto Load Next Post Settings - Events
 *
 * @since    1.5.0
 * @version  1.5.5
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Settings
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Auto_Load_Next_Post_Settings_Events_Tab' ) ) {

	class Auto_Load_Next_Post_Settings_Events_Tab extends Auto_Load_Next_Post_Settings_Page {

		/**
		 * Constructor.
		 *
		 * @access public
		 */
		public function __construct() {
			$this->id    = 'events';
			$this->label = esc_html__( 'Events', 'auto-load-next-post' );

			parent::__construct();

			add_action( 'auto_load_next_post_settings_events', array( __CLASS__, 'is_jetpack_lazy_images_active' ), 10 );
		} // END __construct()

		/**
		 * Displays a notification if JetPack is active and
		 * JetPack's Lazy Images module is enabled.
		 *
		 * @access public
		 * @static
		 */
		public static function is_jetpack_lazy_images_active() {
			if ( alnp_check_jetpack() == 'yes' ) {
				if ( Jetpack::is_module_active( 'lazy-images' ) ) {
					include( dirname( AUTO_LOAD_NEXT_POST_FILE ) . '/includes/admin/views/html-notice-jetpack-lazy-images-module.php' );
				}
			}
		} // END is_jetpack_lazy_images_active()

		/**
		 * Get settings array.
		 *
		 * @access public
		 * @return array
		 */
		public function get_settings() {
			return apply_filters(
				'auto_load_next_post_event_settings', array(

					array(
						'title' => $this->label,
						'type'  => 'title',
						'desc'  => sprintf( __( 'Below you can enter external JavaScript events to be triggered alongside %1$s native events. Separate each event like so: %2$s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<code>event1, event2,</code>' ),
						'id'    => 'events_options'
					),

					array(
						'title'    => esc_html__( 'Post loaded', 'auto-load-next-post' ),
						'desc'     => esc_html__( 'Events listed here will be triggered after a new post has loaded.', 'auto-load-next-post' ),
						'id'       => 'auto_load_next_post_on_load_event',
						'default'  => '',
						'type'     => 'textarea',
						'css'      => 'min-width: 50%; height: 75px;',
						'autoload' => false
					),

					array(
						'title'    => esc_html__( 'Entering a Post', 'auto-load-next-post' ),
						'desc'     => esc_html__( 'Events listed here will be triggered when entering a post.', 'auto-load-next-post' ),
						'id'       => 'auto_load_next_post_on_entering_event',
						'default'  => '',
						'type'     => 'textarea',
						'css'      => 'min-width: 50%; height: 75px;',
						'autoload' => false
					),

					array(
						'type' => 'sectionend',
						'id'   => 'events_options'
					),
			) ); // End event settings
		} // END get_settings()

		/**
		 * Output the settings.
		 *
		 * @access public
		 */
		public function output() {
			$settings = $this->get_settings();

			Auto_Load_Next_Post_Admin_Settings::output_fields( $settings );
		} // END output()

		/**
		 * Save settings.
		 *
		 * @access public
		 */
		public function save() {
			$settings = $this->get_settings();

			Auto_Load_Next_Post_Admin_Settings::save_fields( $settings );
		} // END save()

	} // END class

} // END if class exists

return new Auto_Load_Next_Post_Settings_Events_Tab();
