<?php
/**
 * Runs on Uninstall of Auto Load Next Post
 *
 * @since    1.0.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();

global $wpdb;

// For a single site
if ( ! is_multisite() ) {
	$uninstall = $settings->get_option( 'auto_load_next_post_uninstall_data' );

	if ( ! empty( $uninstall ) ) {
		// Delete options
		$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'auto_load_next_post_%';");
	}
}

?>