<?php
/**
 * Auto Load Next Post Template Functions
 *
 * @since    1.5
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if ( ! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * When the 'partial' endpoint is used on a post, retrieve only the post content.
 *
 * @since   1.0.0
 * @version 1.4.8
 */
function auto_load_next_post_template_redirect() {
	global $wp_query;

	// If this is not a request for partial or a singular object then bail
	if ( ! isset($wp_query->query_vars['partial']) || ! is_singular()) {
		return;
	}

	/**
	 * Load the template file from the theme (child or main) if one exists.
	 * If theme does not have a template file for Auto Load Next Post,
	 * the plugin will load a default template.
	 */
	$child_path    = get_stylesheet_directory() . '/' . AUTO_LOAD_NEXT_POST_TEMPLATE_PATH;
	$template_path = get_template_directory() . '/' . AUTO_LOAD_NEXT_POST_TEMPLATE_PATH;
	$default_path  = AUTO_LOAD_NEXT_POST_FILE_PATH;

	if ( file_exists( $child_path . 'content-partial.php' ) ) {
		include( $child_path . 'content-partial.php' );
	}
	else if( file_exists( $template_path . 'content-partial.php') ) {
		include( $template_path . 'content-partial.php' );
	}
	else if( file_exists( $default_path . '/template/content-partial.php' ) ) {
		include( $default_path . '/template/content-partial.php' );
	}

	exit;
}
add_action('template_redirect', 'auto_load_next_post_template_redirect');

/**
 * Adds the comments template after the post content.
 *
 * @since 1.4.8
 */
function auto_load_next_post_comments() {
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
}
add_action('alnp_load_after_content', 'auto_load_next_post_comments', 1, 5);

/**
 * Adds the post navigation for the previous link only after the post content.
 *
 * @since 1.4.8
 */
function auto_load_next_post_navigation() {
	?>
	<nav class="navigation post-navigation" role="navigation">
		<span class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">'._x('&larr;', 'Previous post link', 'auto-load-next-post').'</span> %title'); ?></span>
	</nav>
	<?php
}
add_action('alnp_load_after_content', 'auto_load_next_post_navigation', 1, 10);
