<?php
/**
 * Auto Load Next Post Core Functions
 *
 * General core functions available for both the front-end and admin.
 *
 * @since    1.0.0
 * @version  1.6.0
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
 * Returns the permalink of a random page
 *
 * @since  1.5.0
 * @param  string $post_type - Default is post.
 * @return int|boolean
 */
if ( ! function_exists( 'alnp_get_random_page_permalink' ) ) {
	function alnp_get_random_page_permalink( $post_type = 'post' ) {
		$args = array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'orderby'        => 'rand',
			'posts_per_page' => 1
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) : $query->the_post();
				$id = get_the_ID();

				return get_permalink( $id );
			endwhile;
		} else {
			return false;
		}
	} // END alnp_get_random_page_permalink()
}

/**
 * This helps the plugin decide to load the JavaScript in the footer or not.
 * 
 * @since  1.5.7
 * @return boolean
 */
if ( ! function_exists( 'alnp_load_js_in_footer' ) ) {
	function alnp_load_js_in_footer() {
		$load_in_footer = get_option( 'auto_load_next_post_load_js_in_footer', false );

		if ( isset( $load_in_footer ) && $load_in_footer == 'yes' ) {
			return true;
		}

		return false;
	} // END alnp_load_js_in_footer()
}

/**
 * These are the only screens Auto Load Next Post will focus 
 * on displaying notices or equeue scripts/styles.
 *
 * @since   1.5.11
 * @version 1.6.0
 * @return  array
 */
if ( ! function_exists( 'alnp_get_admin_screens' ) ) {
	function alnp_get_admin_screens() {
		return array(
			'dashboard',
			'plugins',
			'themes',
			'settings_page_auto-load-next-post'
		);
	} // END alnp_get_admin_screens()
}

/**
 * Adds the plugin version to the header.
 *
 * @since 1.6.0
 */
if ( ! function_exists( 'alnp_meta_version' ) ) {
	function alnp_meta_version() {
		echo '<meta name="generator" content="Auto Load Next Post ' . esc_attr( AUTO_LOAD_NEXT_POST_VERSION ) . '" />' . "\n";
	} // END alnp_meta_version()
}