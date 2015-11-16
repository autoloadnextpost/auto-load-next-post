<?php
/**
	 * Auto Load Next Post Core Functions
	 *
	 * General core functions available on both the front-end and admin.
	 *
	 * @since    1.0.0
	 * @author   Sébastien Dumont
	 * @category Core
	 * @package  Auto Load Next Post
	 * @license  GPL-2.0+
	 */

if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly

// Include core functions
include('auto-load-next-post-conditional-functions.php');
include('auto-load-next-post-formatting-functions.php');

/**
 * When the 'partial' endpoint is used on a post, retrieve only the post content.
 **/
function auto_load_next_post_template_redirect() {
  global $wp_query;

  // if this is not a request for partial or a singular object then bail
  if ( ! isset($wp_query->query_vars['partial']) || ! is_singular()) {
	return;
  }

  /**
   * Load the template file from theme if one exists.
   * If theme does not have a template file, load default from the plugin.
   */
  $template_path = get_stylesheet_directory().'/'.AUTO_LOAD_NEXT_POST_TEMPLATE_PATH;
  $default_path = AUTO_LOAD_NEXT_POST_FILE_PATH;

  if (file_exists($template_path.'content-partial.php')) {
	include($template_path.'content-partial.php');
  } else if (file_exists($default_path.'/template/content-partial.php')) {
	include($default_path.'/template/content-partial.php');
  }

  exit;
}
add_action('template_redirect', 'auto_load_next_post_template_redirect');
