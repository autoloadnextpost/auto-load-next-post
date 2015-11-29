<?php
/**
* Admin View: Admin Review Notice
*/

if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly

$current_user = wp_get_current_user();
?>
<div id="message" class="updated auto-load-next-post-message">
	<p><?php _e(sprintf(__('Hi <b>%s</b>, you\'ve been using <b>%s</b> for some time now, and I hope you\'re happy with it. I\'ve spent countless hours developing this free plugin for you, and I would really appreciate it if you gave it a quick review!', 'auto-load-next-post'), $current_user->display_name, 'Auto Load Next Post')); ?></p>
	<p class="submit"><a href="https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?filter=5#postform" target="_blank" class="button-primary"><?php _e('Yes, take me there!', 'auto-load-next-post'); ?></a> - <a href="<?php echo esc_url(add_query_arg('hide_auto_load_next_post_review_notice', 'true')); ?>" class="skip button-primary"><?php _e('Already have :)', 'auto-load-next-post'); ?></a></p>
</div>
