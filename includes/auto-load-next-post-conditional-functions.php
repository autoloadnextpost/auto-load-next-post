<?php
/**
 * Auto Load Next Post Conditional Functions
 *
 * Functions for determining the current query/page.
 *
 * @since    1.0.0
 * @version  1.4.10
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'auto_load_next_post_is_ajax' ) ) {
	/**
	 * Returns true when the page is loaded via ajax.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return bool
	 */
	function auto_load_next_post_is_ajax() {
		if ( defined( 'DOING_AJAX' ) ) {
			return true;
		}

		return( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) ? true : false;
	} // END auto_load_next_post_is_ajax
}

if ( ! function_exists( 'supports_alnp' ) ) {
	/**
	 * Returns true or false if Auto Load Next Post supports the theme.
	 *
	 * @access  public
	 * @since   1.4.3
	 * @version 1.4.10
	 * @return  boolen
	 */
	function supports_alnp() {
		/* WordPress core themes. */
		$core_themes = array(
			'twentyseventeen', 'twentysixteen', 'twentyfifteen', 'twentyfourteen', 'twentythirteen', 'twentytwelve', 'twentyten'
		);

		$other_themes = array(
			'storefront'
		);

		$supported_themes = array_merge( $core_themes, $other_themes );

		if ( in_array( get_option('template'), $supported_themes ) ) {
			return true;
		} else if ( current_theme_supports( 'auto-load-next-post' ) ) {
			return true;
		}

		return false;
	} // END supports_alnp()
}

if ( ! function_exists( 'alnp_template_location' ) ) {
	/**
	 * Filters the template location for get_template_part().
	 *
	 * @access  public
	 * @since   1.4.8
	 * @version 1.4.9
	 * @return  boolen
	 */
	function alnp_template_location() {
		$current_theme = get_option('template');

		switch( $current_theme ) {
			case 'twentyseventeen':
				$path = 'template-parts/post/';
				break;

			case 'twentysixteen':
				$path = 'template-parts/';
				break;

			default:
				$path = '';
				break;
		}

		return $path;
	} // END alnp_template_location()

	add_filter('alnp_template_location', 'alnp_template_location');
}

if ( ! function_exists( 'is_alnp_pro_version_installed' ) ) {
	/**
	 * Detects if Auto Load Next Post Pro is installed.
	 *
	 * @access public
	 * @since  1.4.10
	 * @return boolen
	 */
	function is_alnp_pro_version_installed() {
		$active_plugins = (array) get_option( 'active_plugins', array() );

		if ( is_multisite() ) {
			$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
		}

		return in_array( 'auto-load-next-post-pro/auto-load-next-post-pro.php', $active_plugins ) || array_key_exists( 'auto-load-next-post-pro/auto-load-next-post-pro.php', $active_plugins );
	}
}
