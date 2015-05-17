<?php
/**
 * This file loads the content partially.
 */

$remove_comments = get_option( 'auto_load_next_post_remove_comments' );

// Check that there are more posts to load.
while ( have_posts() ) : the_post();

	// Include the content
	get_template_part( 'content', get_post_format() );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		if ( $remove_comments != 'yes' ) { comments_template(); }
	endif;

	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'auto-load-next-post' ); ?></h1>

		<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'auto-load-next-post' ) . '</span> %title' ); ?></span>
		<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'auto-load-next-post' ) . '</span>' ); ?></span>
	</nav><!-- .post-navigation -->
	<?php

// End the loop.
endwhile;

?>