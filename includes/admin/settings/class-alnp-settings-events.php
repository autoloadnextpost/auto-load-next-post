<?php
/**
 * Auto Load Next Post Settings - Events
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

if ( ! class_exists( 'Auto_Load_Next_Post_Settings_Events_Tab' ) ) {

	class Auto_Load_Next_Post_Settings_Events_Tab extends Auto_Load_Next_Post_Settings_Page {

		/**
		 * Constructor.
		 *
		 * @access  public
		 * @since   1.5.0
		 * @version 1.5.0
		 */
		public function __construct() {
			$this->id    = 'events';
			$this->label = __( 'Events', 'auto-load-next-post' );

			parent::__construct();
		} // END __construct()

		/**
		 * Get settings array.
		 *
		 * @access public
		 * @since  1.5.0
		 * @return array
		 */
		public function get_settings() {
			return apply_filters(
				'auto_load_next_post_general_settings', array(

					array(
						'title' => __( 'Events', 'auto-load-next-post' ),
						'type'  => 'title',
						'desc'  => sprintf( __( 'User defined events, below you can choose external JavaScript events to be triggered alongside Auto Load Next Post native events', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
						'id'    => 'events_options'
					),

					array(
						'title'    => __( 'Post loaded', 'auto-load-next-post' ),
						'desc'     => __( 'After the new post has loaded, comma separated events list: <code>event1,event2, ...</code>', 'auto-load-next-post' ),
						//'desc_tip' => true,
						'id'       => 'auto_load_next_post_on_load_event',
						'placeholder' => 'event1,event2, ...',
						'type'     => 'textarea',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'title'    => __( 'Entering a post', 'auto-load-next-post' ),
						'desc'     => __( 'Entering a post, comma separated events list: <code>event1,event2, ...</code>', 'auto-load-next-post' ),
						//'desc_tip' => true,
						'id'       => 'auto_load_next_post_on_entering_event',
						'placeholder' => 'event1,event2, ...',
						'type'     => 'textarea',
						'css'      => 'min-width:300px;',
						'autoload' => false
					),

					array(
						'type' => 'sectionend',
						'id'   => 'events_options'
					),
			) ); // End general settings
		} // END get_settings()

		/**
		 * Output the settings.
		 *
		 * @access public
		 * @since  1.5.0
		 */
		public function output() {
			$settings = $this->get_settings();

			Auto_Load_Next_Post_Admin_Settings::output_fields( $settings );
		} // END output()

		/**
		 * Save settings.
		 *
		 * @access public
		 * @since  1.5.0
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
		 * @since  1.5.0
		 * @return array
		 */
		public function get_post_types() {
			$post_types = get_post_types( array( 'public' => true ), 'names' );

			return $post_types;
		} // END get_post_types()

	} // END class

} // END if class exists

return new Auto_Load_Next_Post_Settings_Events_Tab();
