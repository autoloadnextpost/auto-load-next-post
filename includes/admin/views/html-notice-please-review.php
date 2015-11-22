<?php
/**
* Admin View: Admin Review Notice
*/

if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly
?>
<div id="message" class="updated auto-load-next-post-message">
	<p><?php _e(sprintf(__( 'You have been using <b>%s</b> for some time now, could you please give it a review at wordpress.org?', 'auto-load-next-post'), 'Auto Load Next Post')); ?></p>
	<p class="submit"><a href="https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?filter=5#postform" target="_blank" class="button-primary"><?php _e('Yes, take me there!', 'auto-load-next-post'); ?></a> - <a href="<?php echo esc_url(add_query_arg('hide_auto_load_next_post_review_notice', 'true')); ?>" class="skip button-primary"><?php _e('Already have :)', 'auto-load-next-post'); ?></a></p>
</div>
