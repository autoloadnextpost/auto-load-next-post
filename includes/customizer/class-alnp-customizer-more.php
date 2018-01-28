<?php
/**
 * Class to add a more section for the Customizer to display information.
 *
 * @author  Sébastien Dumont
 * @package Auto Load Next Post
 * @since   1.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The 'more' Auto Load Next Post
 */
class Auto_Load_Next_Post_Customizer_More {

	public static function init() {
		add_filter('auto_load_next_post_get_customizer_sections', __CLASS__ . '::add_more_section');
		add_filter('auto_load_next_post_get_customizer_controls', __CLASS__ . '::add_more_controls');
		add_filter('auto_load_next_post_get_customizer_settings', __CLASS__ . '::add_more_settings');
	}

	public static function add_more_section($sections){
		$sections['section_auto_load_next_post_more'] = array(
			'capability'  => 'edit_theme_options',
			'title'       => __( 'More', 'auto-load-next-post' ),
			'priority'    => 999,
			'description' => null,
		);

		return $sections;
	}

	public static function add_more_settings($settings) {
		$settings['auto_load_next_post_more'] = array(
			'default'           => null,
			'sanitize_callback' => 'sanitize_text_field',
		);

		return $settings;
	}

	public static function add_more_controls($controls) {
		$controls['auto_load_next_post_more'] = array(
			'class'       => 'More_ALNP_Control',
			'description' => null,
			'label'       => __('Looking for more options?', 'auto-load-next-post'),
			'section'     => 'section_auto_load_next_post_more',
			'settings'    => 'auto_load_next_post_more',
			'priority'    => 1,
		);

		return $controls;
	}

}

Auto_Load_Next_Post_Customizer_More::init();
