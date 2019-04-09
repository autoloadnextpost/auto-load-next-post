<?php
defined( 'ABSPATH' ) || die( 'Cheatin&#8217; uh?' );

if ( defined( SiteGround_Optimizer . '\VERSION' ) ) :

	/**
	 * Excludes Auto Load Next Post scripts from JS minification.
	 *
	 * @since  1.5.*
	 * @param  Array $exclude_list An array of JS handles enqueued in WordPress.
	 * @return Array $exclude_list the updated array of handles.
	 */
	function sg_optimize_exclude_js_minify_alnp( $exclude_list ) {
		$exclude_list[] = 'auto-load-next-post-scrollspy';
		$exclude_list[] = 'auto-load-next-post-history';
		$exclude_list[] = 'auto-load-next-post-script';

		return $exclude_list;
	}
	add_filter( 'sgo_js_minify_exclude', 'sg_optimize_exclude_js_minify_alnp' );

endif;