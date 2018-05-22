<?php
/**
 * Auto Load Next Post: Theme Customizer
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initialize the Customizer.
 *
 * @since 1.5.0
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function alnp_init_customizer( $wp_customize ) {
	if ( ! alnp_is_customizer() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		return;
	}

	$sections = alnp_get_customizer_sections();

	foreach( $sections as $section_id => $args ) {
		$wp_customize->add_section( $section_id, $args );
	}

	$settings = alnp_get_customizer_settings();

	foreach( $settings as $setting_id => $args ) {
		$wp_customize->add_setting( $setting_id, $args );
	}

	/**
	 * Let other plugins register extra customizer controls for Auto Load Next Post.
	 *
	 * @since 1.5.0
	 * @param WP_Customize_Manager $wp_customize The Customizer object.
	 */
	do_action( 'alnp_customizer_register_sections', $wp_customize );

	$controls = alnp_get_customizer_controls();

	foreach ( $controls as $control_id => $args ) {
		$wp_customize->add_control( new $args['class']( $wp_customize, $control_id, $args ) );
	}

	/*
	 * Hook actions/filters for further configuration.
	 *
	 * @since 1.5.0
	 */
	add_filter( 'customize_section_active', 'auto_load_next_post_customizer_hide_sections', 12, 2 );

	if ( alnp_is_customizer() ) {
		alnp_customizer_remove_controls( $wp_customize ); // Remove controls from the customizer.
	}
}
add_action( 'customize_register', 'auto_load_next_post_init_customizer' );

/**
 * Remove any unwanted default conrols.
 *
 * @since  1.5.0
 * @global $wp_cutomize
 * @param  object $wp_customize
 * @return boolean
 */
function alnp_customizer_remove_controls( $wp_customize ) {
	global $wp_customize;

	$wp_customize->remove_panel('widgets');

	return true;
} // END remove_controls()

/**
 * Are we looking at the Auto Load Next Post customizer?
 *
 * @since  1.5.0
 * @return boolean
 */
function alnp_is_customizer() {
	return isset( $_GET['alnp-customizer'] ) && $_GET['alnp-customizer'] === 'yes';
}

/**
 * Only show the plugin sections in the Customizer.
 *
 * @since  1.5.0
 * @param  $active Whether the Customizer section is active.
 * @param  WP_Customize_Section $section {@see WP_Customize_Section} instance.
 * @return boolean
 */
function alnp_customizer_hide_sections( $active, $section ) {
	if ( ! alnp_is_customizer() ) {
		return $active;
	}

	return in_array( $section->id, array_keys( alnp_get_customizer_sections() ), true );
}

/**
 * Get Customizer sections for Auto Load Next Post.
 *
 * @since  1.5.0
 * @return array
 */
function alnp_get_customizer_sections() {
	/**
	 * Filter Customizer sections for Auto Load Next Post.
	 *
	 * @param array $sections Customizer sections to add.
	 */
	return apply_filters( 'auto_load_next_post_get_customizer_sections', array(
		'section_auto_load_next_post_general' => array(
			'capability'  => 'edit_theme_options',
			'title'       => __( 'General Settings', 'auto-load-next-post' ),
			'description' => sprintf( __( 'Set the theme selectors below according to your active theme. All are required for %s to work. <a href="https://autoloadnextpost.com/documentation/find-theme-selectors/?utm_source=wpadmin&utm_campaign=plugin-settings-general" target="_blank">How to find my theme selectors?</a>', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
		),
		'section_auto_load_next_post_misc' => array(
			'capability'  => 'edit_theme_options',
			'title'       => __( 'Misc Settings', 'auto-load-next-post' ),
			'description' => sprintf( __( 'Here you set if you want to track pageviews, remove comments and load %s javascript in the footer.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
		),
	) );
}

/**
 * Get Customizer settings for plugin.
 *
 * @since  1.5.0
 * @return array
 */
function alnp_get_customizer_settings() {
	$settings = alnp_get_settings();

	/**
	 * Filter Customizer settings for plugin.
	 *
	 * @param array $settings Customizer settings to add.
	 */
	return apply_filters( 'auto_load_next_post_get_customizer_settings', array(
		'auto_load_next_post_content_container' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $settings['content_container'],
			'sanitize_callback' => 'wp_filter_post_kses',
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_title_selector' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $settings['title_selector'],
			'sanitize_callback' => 'wp_filter_post_kses',
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_navigation_container' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $settings['navigation_container'],
			'sanitize_callback' => 'wp_filter_post_kses',
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_previous_post_selector' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $settings['previous_post_selector'],
			'sanitize_callback' => 'wp_filter_post_kses',
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_comments_container' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $settings['comments_container'],
			'sanitize_callback' => 'wp_filter_post_kses',
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_remove_comments' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $settings['remove_comments'],
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_google_analytics' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $settings['google_analytics'],
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
		'auto_load_next_post_js_footer' => array(
			'capability'        => 'edit_theme_options',
			'default'           => $settings['js_footer'],
			'transport'         => 'postMessage',
			'type'              => 'option',
		),
	) );
}

/**
 * Get Customizer controls for the plugin.
 *
 * @since  1.5.0
 * @return array
 */
function alnp_get_customizer_controls() {

	/**
	 * Filter Customizer controls for the plugin.
	 *
	 * @param array $controls Customizer controls to add.
	 */
	return apply_filters( 'auto_load_next_post_get_customizer_controls', array(
		'content_container' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __( 'This is the primary container were the post content is loaded in. Example: <code>main.site-main</code>', 'auto-load-next-post' ),
			'label'       => __( 'Content Container', 'auto-load-next-post' ),
			'section'     => 'section_auto_load_next_post_general',
			'settings'    => 'auto_load_next_post_content_container',
			'type'        => 'text',
		),
		'title_selector' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __( 'This is used to identify which article the user is reading and track if Google Analytics is enabled. Example: <code>h1.entry-title</code>', 'auto-load-next-post' ),
			'label'       => __( 'Post Title Selector', 'auto-load-next-post' ),
			'section'     => 'section_auto_load_next_post_general',
			'settings'    => 'auto_load_next_post_title_selector',
			'type'        => 'text',
		),
		'navigation_container' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __( 'The post navigation needs to be indentified to find the next post. Example: <code>nav.post-navigation</code>', 'auto-load-next-post' ),
			'label'       => __( 'Post Navigation Container', 'auto-load-next-post' ),
			'section'     => 'section_auto_load_next_post_general',
			'settings'    => 'auto_load_next_post_navigation_container',
			'type'        => 'text',
		),
		'comments_container' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __( 'This is so comments can be removed if enabled below. Example: <code>div#comments</code>', 'auto-load-next-post' ),
			'label'       => __( 'Comments Container', 'auto-load-next-post' ),
			'section'     => 'section_auto_load_next_post_general',
			'settings'    => 'auto_load_next_post_comments_container',
			'type'        => 'text',
		),
		'remove_comments' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __( 'Enable to remove comments when each post loads including the initial post.', 'auto-load-next-post' ),
			'label'       => __( 'Remove Comments', 'auto-load-next-post' ),
			'section'     => 'section_auto_load_next_post_misc',
			'settings'    => 'auto_load_next_post_remove_comments',
			'type'        => 'checkbox',
		),
		'google_analytics' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __( 'Each time a post has loaded and is in view it will count as a pageview. Must have reference to Google Analytics tracking code on the site.', 'auto-load-next-post' ),
			'label'       => __( 'Update Google Analytics', 'auto-load-next-post' ),
			'section'     => 'section_auto_load_next_post_misc',
			'settings'    => 'auto_load_next_post_google_analytics',
			'type'        => 'checkbox',
		),
		'js_footer' => array(
			'class'       => 'WP_Customize_Control',
			'description' => __( 'Enable to load Auto Load Next Post in the footer instead of the header.', 'auto-load-next-post' ),
			'label'       => __( 'JavaScript in Footer?', 'auto-load-next-post' ),
			'section'     => 'section_auto_load_next_post_misc',
			'settings'    => 'auto_load_next_post_google_analytics',
			'type'        => 'checkbox',
		),
	) );
}

/**
 * Return plugin settings.
 *
 * @since  1.5.0
 * @return array $args
 */
function alnp_get_settings() {
	$args = array(
		'content_container'      => get_option( 'auto_load_next_post_content_container' ),
		'title_selector'         => get_option( 'auto_load_next_post_title_selector' ),
		'navigation_container'   => get_option( 'auto_load_next_post_navigation_container' ),
		'previous_post_selector' => get_option( 'auto_load_next_post_previous_post_selector' ),
		'comments_container'     => get_option( 'auto_load_next_post_comments_container' ),
		'remove_comments'        => get_option( 'auto_load_next_post_remove_comments' ),
		'google_analytics'       => get_option( 'auto_load_next_post_google_analytics' )
		'js_footer'              => get_option( 'auto_load_next_post_js_footer' )
	);

	return $args;
}
