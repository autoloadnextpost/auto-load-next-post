<?php
/**
 * The repeater template for displaying a post when called for Twenty Nineteen.
 *
 * @author  Sébastien Dumont
 * @package Auto Load Next Post/Templates/Theme Support
 * @license GPL-2.0+
 * @version 1.5.5
 */

if ( have_posts() ) :

	// Load content before the loop.
	do_action( 'alnp_load_before_loop' );

	// Check that there are posts to load.
	while ( have_posts() ) : the_post();

		// Post Type e.g. single
		$post_type = alnp_get_post_type();

		// Load content before the post content.
		do_action( 'alnp_load_before_content' );

		// Load content before the post content for a specific post type.
		do_action( 'alnp_load_before_content_post_type_' . $post_type );

		// Get template for specific post type.
		include_once( 'content-' . $post_type . '.php' );

		// Load content after the post content for a specific post type.
		do_action( 'alnp_load_after_content_post_type_' . $post_type );

		// Load content after the post content.
		do_action( 'alnp_load_after_content' );

	// End the loop.
	endwhile;

	// Load content after the loop.
	do_action( 'alnp_load_after_loop' );

else :

	// Load content if there are no more posts.
	do_action( 'alnp_no_more_posts' );

endif; // END if have_posts()
