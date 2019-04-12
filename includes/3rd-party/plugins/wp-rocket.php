<?php
defined( 'ABSPATH' ) || die( 'Cheatin&#8217; uh?' );

if ( defined( 'WP_ROCKET_VERSION' ) ) :
	/**
	 * Excludes Auto Load Next Post scripts from JS minification.
	 *
	 * @since  1.5.10
	 * @param  Array $excluded_js An array of JS handles enqueued in WordPress.
	 * @return Array $excluded_js the updated array of handles.
	 */
	function rocket_exclude_js_alnp( $excluded_js ) {
		$excluded_js[] = str_replace( home_url(), '', plugins_url( '/auto-load-next-post/assets/js/frontend/auto-load-next-post.js' ) );
		$excluded_js[] = str_replace( home_url(), '', plugins_url( '/auto-load-next-post/assets/js/frontend/auto-load-next-post.min.js' ) );
		$excluded_js[] = str_replace( home_url(), '', plugins_url( '/auto-load-next-post/assets/js/frontend/auto-load-next-post.dev.js' ) );
		$excluded_js[] = str_replace( home_url(), '', plugins_url( '/auto-load-next-post/assets/js/libs/jquery.history.js' ) );
		$excluded_js[] = str_replace( home_url(), '', plugins_url( '/auto-load-next-post/assets/js/libs/scrollspy.min.js' ) );

		return $excluded_js;
	}
	add_filter( 'rocket_exclude_js', 'rocket_exclude_js_alnp' );

	/**
	 * Excludes Auto Load Next Post JS files from defer JS
	 *
	 * @since  1.5.11
	 * @param  Array $exclude_defer_js Array of JS filepaths to be excluded.
	 * @return Array $exclude_defer_js the updated array of defer JS
	 */
	function rocket_exclude_defer_js_alnp( $exclude_defer_js ) {
		$exclude_defer_js[] = rocket_clean_exclude_file( AUTO_LOAD_NEXT_POST_URL_PATH . '/assets/js/frontend/auto-load-next-post.js' );
		$exclude_defer_js[] = rocket_clean_exclude_file( AUTO_LOAD_NEXT_POST_URL_PATH . '/assets/js/frontend/auto-load-next-post.min.js' );
		$exclude_defer_js[] = rocket_clean_exclude_file( AUTO_LOAD_NEXT_POST_URL_PATH . '/assets/js/frontend/auto-load-next-post.dev.js' );

		return $exclude_defer_js;
	}
	add_filter( 'rocket_exclude_defer_js', 'rocket_exclude_defer_js_alnp' );

endif;
