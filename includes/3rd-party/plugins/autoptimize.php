<?php
defined( 'ABSPATH' ) || die( 'Cheatin&#8217; uh?' );

if ( defined( 'AUTOPTIMIZE_PLUGIN_VERSION' ) ) :

	/**
	 * Excludes Auto Load Next Post scripts from optimization.
	 *
	 * @since  1.5.*
	 * @param  Array $excluded_js An array of JS handles enqueued in WordPress.
	 * @param  $content
	 * @return Array the updated array of handles.
	 */
	function autoptimize_exclude_js_alnp( $excludeJS, $content ) {
		return $excludeJS;
	}
	add_filter( 'autoptimize_filter_js_exclude', 'autoptimize_exclude_js_alnp' );

	/**
	 * Excludes all Auto Load Next Post scripts from being moved.
	 *
	 * @since  1.5.*
	 * @param  Array $array_in An array of JS locations to exclude from moving.
	 * @return Array the updated array of locations.
	 */
	function autoptimize_js_dontmove_alnp( $array_in ) {
		$array_in[] = str_replace( home_url(), '', plugins_url( '/auto-load-next-post/' ) );

		return $array_in;
	}
	add_filter( 'autoptimize_filter_js_dontmove', 'autoptimize_js_dontmove_alnp' );

	/**
	 * Excludes Auto Load Next Post scripts from JS minification.
	 *
	 * @since  1.5.*
	 * @param  string $url The URL of the post being optimized.
	 * @return bool Returns true or false to exclude the scripts from minification.
	 */
	function autoptimize_js_minify_excluded( $status, $url ) {
		$exclude_js = array(
			str_replace( home_url(), '', plugins_url( '/auto-load-next-post/assets/js/frontend/auto-load-next-post.js' ) ),
			str_replace( home_url(), '', plugins_url( '/auto-load-next-post/assets/js/frontend/auto-load-next-post.dev.js' ) ),
			str_replace( home_url(), '', plugins_url( '/auto-load-next-post/assets/js/libs/jquery.history.js' ) ),
		);

		if ( in_array( $url ) ) {
			return false;
		}
		return $status;
	}
	add_filter( 'autoptimize_filter_js_minify_excluded', 'autoptimize_js_minify_excluded' );

endif;