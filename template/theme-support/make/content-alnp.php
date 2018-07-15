<?php
/**
 * The repeater template for displaying a post when called for Make.
 *
 * @author  Sébastien Dumont
 * @package Auto Load Next Post/Templates/Theme Support
 * @license GPL-2.0+
 * @version 1.5.0
 */

if ( have_posts() ) :

	// Load content before the loop.
	do_action( 'alnp_load_before_loop' );

	// Check that there are more posts to load.
	while ( have_posts() ) : the_post();

		$post_type = alnp_get_post_type(); // Post Type e.g. single

		// Load content before the post content.
		do_action( 'alnp_load_before_content' );

		// Load content before the post content for a specific post type.
		do_action( 'alnp_load_before_content_post_type_' . $post_type );

		// Load Make partial template for the correct post type.
		get_template_part( 'partials/content', $post_type );

		// Load content after the post content for a specific post type.
		do_action( 'alnp_load_after_content_post_type_' . $post_type );

		// Load content before the post content.
		do_action( 'alnp_load_after_content' );

	// End the loop.
	endwhile;

	// Load content after the loop.
	do_action( 'alnp_load_after_loop' );

	else :

		// Load content if there are no more posts.
		do_action( 'alnp_no_more_posts' );

	endif; // END if have_posts()
