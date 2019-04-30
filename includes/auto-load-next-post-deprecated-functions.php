<?php
/**
 * Auto Load Next Post Deprecated functions.
 *
 * Where functions come to die.
 *
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post/Functions
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Wrapper for deprecated functions so we can apply some extra logic.
 *
 * @param string $function    Function used.
 * @param string $version     Version when the function was deprecated.
 * @param string $replacement Replacement for the called function if any.
 */
function alnp_deprecated_function( $function, $version, $replacement = null ) {
	if ( is_ajax() ) {
		do_action( 'deprecated_function_run', $function, $replacement, $version );
		$log_string  = sprintf( esc_html__( 'The %1$s function is deprecated since version %2$s', 'auto-load-next-post' ), $function, $version );
		$log_string .= $replacement ? " " . sprintf( esc_html__( 'Replace with %s.', 'auto-load-next-post' ), $replacement ) : '';

		error_log( $log_string );
	} else {
		_deprecated_function( $function, $version, $replacement );
	}
} // END alnp_deprecated_function()

if ( ! function_exists( 'auto_load_next_post_is_ajax' ) ) {
	/**
	 * Returns true when the page is loaded via ajax.
	 *
	 * @since      1.0.0
	 * @deprecated 1.6.0
	 * @return bool
	 */
	function auto_load_next_post_is_ajax() {
		alnp_deprecated_function( 'auto_load_next_post_is_ajax', '1.6.0', null );

		if ( defined( 'DOING_AJAX' ) ) {
			return true;
		}

		return( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) ? true : false;
	} // END auto_load_next_post_is_ajax
}
