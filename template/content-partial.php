<?php
/**
	 * This file loads the content partially.
	 *
	 * @version 1.4.4
	 */

// Fetch plugin settings.
$remove_comments = get_option('auto_load_next_post_remove_comments');

// Load content before the loop.
do_action('alnp_load_before_loop');

// Check that there are more posts to load.
while (have_posts()) : the_post();

	$post_format = get_post_format(); // Post Format e.g. video
	if (false === $post_format) {
		$post_format = 'standard';
	}

	// Load content before the post content.
	do_action('alnp_load_before_content');

	// Load content before the post content for a specific post format.
	do_action('alnp_load_before_content_type_'.$post_format);

	if ($post_format == 'standard') {
		// Include the content.
		get_template_part('content');
	} else {
		// Include the post format content.
		if (locate_template('format-'.$post_format.'.php') != '') {
			get_template_part('format', $post_format);
		} else {
			// If no format-{post-format}.php file found then fallback to content-{post-format}.php
			get_template_part('content', $post_format);
		}
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if (comments_open() || get_comments_number()) :
		if ($remove_comments != 'yes') { comments_template(); }
	endif;

	// Load content after the post content for a specific post format.
	do_action('alnp_load_after_content_type_'.$post_format);

	// Load content after the post content.
	do_action('alnp_load_after_content');
	?>
	<nav class="navigation post-navigation" role="navigation">
		<span class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">'._x('&larr;', 'Previous post link', 'auto-load-next-post').'</span> %title'); ?></span>
	</nav>
	<?php

// End the loop.
endwhile;

// Load content after the loop.
do_action('alnp_load_after_loop');
