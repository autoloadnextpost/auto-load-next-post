<?php
/**
 * Auto Load Next Post Customizer
 *
 * @since      1.5.0
 * @author     Sébastien Dumont
 * @subpackage Core
 * @package    Auto Load Next Post
 * @license    GPL-2.0+
 */
if ( ! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/**
 * Initialize the Customizer.
 *
 * @since 1.5.0
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function auto_load_next_post_init_customizer( $wp_customize ) {
	if ( ! auto_load_next_post_is_customizer() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		return;
	}

	$sections = auto_load_next_post_get_customizer_sections();
	foreach( $sections as $section_id => $args ) {
		$wp_customize->add_section( $section_id, $args );
	}

	$settings = auto_load_next_post_get_customizer_settings();
	foreach( $settings as $setting_id => $args ) {
		$wp_customize->add_setting( $setting_id, $args );
	}

	/**
	 * Let other plugins register extra customizer controls for Auto Load Next Post.
	 *
	 * @since 1.5.0
	 * @param WP_Customize_Manager $wp_customize The Customizer object.
	 */
	do_action('auto_load_next_post_customizer_register_sections', $wp_customize);

	$controls = auto_load_next_post_get_customizer_controls();
	foreach ( $controls as $control_id => $args ) {
		$wp_customize->add_control( new $args['class']( $wp_customize, $control_id, $args ) );
	}

	/*
	 * Hook actions/filters for further configuration.
	 *
	 * @since 1.5.0
	 */
	add_filter('customize_section_active', 'auto_load_next_post_customizer_hide_sections', 12, 2);

	if ( auto_load_next_post_is_customizer() ) {
		auto_load_next_post_customizer_remove_controls( $wp_customize ); // Remove controls from the customizer.
	}
}
add_action('customize_register', 'auto_load_next_post_init_customizer');

/**
 * Remove any unwanted default conrols.
 *
 * @param object $wp_customize
 * @since 1.5.0
 */
function auto_load_next_post_customizer_remove_controls( $wp_customize ) {
	global $wp_customize;

	$wp_customize->remove_panel('widgets');

	return true;
} // END remove_controls()

/**
 * Are we looking at the Auto Load Next Post customizer?
 *
 * @since 1.5.0
 * @return bool
 */
function auto_load_next_post_is_customizer() {
	return isset( $_GET['alnp-customizer'] ) && $_GET['alnp-customizer'] === 'yes';
}

/**
 * Only show the plugin sections in the Customizer.
 *
 * @since 1.5.0
 * @param $active Whether the Customizer section is active.
 * @param WP_Customize_Section $section {@see WP_Customize_Section} instance.
 * @return bool
 */
function auto_load_next_post_customizer_hide_sections( $active, $section ) {
	if ( ! auto_load_next_post_is_customizer() ) {
		return $active;
	}

	return in_array( $section->id, array_keys( auto_load_next_post_get_customizer_sections() ), true );
}

/**
 * Get Customizer sections for Auto Load Next Post.
 *
 * @since 1.5.0
 * @return array
 */
function auto_load_next_post_get_customizer_sections() {
	/**
	 * Filter Customizer sections for Auto Load Next Post.
	 *
	 * @since 1.5.0
	 * @param array $sections Customizer sections to add.
	 */
	return apply_filters('auto_load_next_post_get_customizer_sections', array(
		'section_auto_load_next_post_general' => array(
			'capability' => 'edit_theme_options',
			'title'      => __('General Settings', 'auto-load-next-post'),
			'description'       => sprintf(__('The variables below need to be set according to your active theme. This allows the plugin to identify the specific elements on the page. All are required in order for %s to work.', 'auto-load-next-post'), 'Auto Load Next Post'),
		),
	) );
}

/**
 * Get Customizer settings for plugin.
 *
 * @since 1.5.0
 * @return array
 */
function auto_load_next_post_get_customizer_settings() {
	$defaults = auto_load_next_post_get_default_settings();

	/**
	 * Filter Customizer settings for plugin.
	 *
	 * @since 1.5.0
	 * @param array $settings Customizer settings to add.
	 */
	return apply_filters( 'auto_load_next_post_get_customizer_settings', array(
		'auto_load_next_post_content_container' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['content_container'],
			'sanitize_callback' => 'wp_filter_post_kses',
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_title_selector' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['title_selector'],
			'sanitize_callback' => 'wp_filter_post_kses',
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_navigation_container' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['navigation_container'],
			'sanitize_callback' => 'wp_filter_post_kses',
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_previous_post_selector' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['previous_post_selector'],
			'sanitize_callback' => 'wp_filter_post_kses',
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_comments_container' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['comments_container'],
			'sanitize_callback' => 'wp_filter_post_kses',
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_remove_comments' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['remove_comments'],
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_google_analytics' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $defaults['google_analytics'],
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
	) );
}

/**
 * Get Customizer controls for the plugin.
 *
 * @since 1.5.0
 * @return array
 */
function auto_load_next_post_get_customizer_controls() {

	/**
	 * Filter Customizer controls for the plugin.
	 *
	 * @since 1.5.0
	 * @param array $controls Customizer controls to add.
	 */
	return apply_filters( 'auto_load_next_post_get_customizer_controls', array(
		'content_container' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __('Example: <code>main.site-main</code>', 'auto-load-next-post' ),
			'label'       => __('Content Container', 'auto-load-next-post'),
			'section'     => 'section_auto_load_next_post_general',
			'settings'    => 'auto_load_next_post_content_container',
			'type'        => 'text',
		),
		'title_selector' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __('Example: <code>h1.entry-title</code>', 'auto-load-next-post'),
			'label'       => __('Post Title Selector', 'auto-load-next-post'),
			'section'     => 'section_auto_load_next_post_general',
			'settings'    => 'auto_load_next_post_title_selector',
			'type'        => 'text',
		),
		'navigation_container' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __('Example: <code>nav.post-navigation</code>', 'auto-load-next-post'),
			'label'       => __('Post Navigation Container', 'auto-load-next-post'),
			'section'     => 'section_auto_load_next_post_general',
			'settings'    => 'auto_load_next_post_navigation_container',
			'type'        => 'text',
		),
		'previous_post_selector' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __('Should you need to also identify the previous post link in the navigation, fill in this field. Example: <code>.nav-previous</code>', 'auto-load-next-post'),
			'label'       => __('Previous Post Selector', 'auto-load-next-post'),
			'section'     => 'section_auto_load_next_post_general',
			'settings'    => 'auto_load_next_post_previous_post_selector',
			'type'        => 'text',
		),
		'comments_container' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __('Example: <code>div#comments</code>', 'auto-load-next-post'),
			'label'       => __('Comments Container', 'auto-load-next-post'),
			'section'     => 'section_auto_load_next_post_general',
			'settings'    => 'auto_load_next_post_comments_container',
			'type'        => 'text',
		),
		'remove_comments' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __('Enable to remove comments when each post loads.', 'auto-load-next-post'),
			'label'       => __('Remove Comments', 'auto-load-next-post'),
			'section'     => 'section_auto_load_next_post_general',
			'settings'    => 'auto_load_next_post_remove_comments',
			'type'        => 'checkbox',
		),
		'google_analytics' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __('Each time a post is loaded it will count as a pageview. You must have a reference to your Google Analytics tracking code on the page.', 'auto-load-next-post'),
			'label'       => __('Update Google Analytics', 'auto-load-next-post'),
			'section'     => 'section_auto_load_next_post_general',
			'settings'    => 'auto_load_next_post_google_analytics',
			'type'        => 'checkbox',
		),
	) );
}

/**
 * Return default plugin settings.
 *
 * @since 1.5.0
 * @return array
 */
function auto_load_next_post_get_default_settings() {
	$default_args = array(
		'content_container'      => get_option('auto_load_next_post_content_container'),
		'title_selector'         => get_option('auto_load_next_post_title_selector'),
		'navigation_container'   => get_option('auto_load_next_post_navigation_container'),
		'previous_post_selector' => get_option('auto_load_next_post_previous_post_selector'),
		'comments_container'     => get_option('auto_load_next_post_comments_container'),
		'remove_comments'        => get_option('auto_load_next_post_remove_comments'),
		'google_analytics'       => get_option('auto_load_next_post_google_analytics')
	);

	return $default_args;
}
