<?php
/**
 * Auto Load Next Post Template Hooks
 *
 * Action/filter hooks used for Auto Load Next Post functions/templates.
 *
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post/Hooks
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WordPress Header
 *
 * @see alnp_meta_version()
 */
add_action( 'wp_head', 'alnp_meta_version' );

/**
 * Repeater Template
 *
 * @see alnp_template_redirect()
 * @see alnp_load_fallback_content()
 * @see auto_load_next_post_comments()
 * @see auto_load_next_post_navigation()
 */
add_action( 'template_redirect', 'alnp_template_redirect' );
add_action( 'alnp_load_content', 'alnp_load_fallback_content', 1, 10 );
add_action( 'alnp_load_after_content', 'auto_load_next_post_comments', 1, 5 );
add_action( 'alnp_load_after_content', 'auto_load_next_post_navigation', 1, 10 );
