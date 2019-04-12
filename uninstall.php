<?php
/**
 * Uninstall Auto Load Next Post.
 *
 * @since    1.0.0
 * @version  1.5.10
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */
if ( ! defined( 'ABSPATH' ) || ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit(); // Exit if accessed directly.
}

global $wpdb;

$uninstall = get_option( 'auto_load_next_post_uninstall_data' );

if ( ! empty( $uninstall ) ) {

	// Make sure it is only a single site we are uninstalling from.
	if ( ! is_multisite() ) {
		// Delete options
		$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'auto_load_next_post_%'");

		// Delete user interactions
		$wpdb->query("DELETE FROM $wpdb->usermeta WHERE meta_key LIKE 'auto_load_next_post_%'");

		// Delete Uninstall Data - Just to double check it has been removed.
		delete_option( 'auto_load_next_post_uninstall_data' );

		// Delete Install Date
		delete_option( 'auto_load_next_post_install_date' );
	}
	else {
		// Delete Uninstall Data
		delete_site_option( 'auto_load_next_post_uninstall_data' );

		// Delete Install Date
		delete_site_option( 'auto_load_next_post_install_date' );
	}
}

// Clear any cached data that has been removed.
wp_cache_flush();

// Refresh permalinks to remove our rewrite endpoint.
flush_rewrite_rules();
