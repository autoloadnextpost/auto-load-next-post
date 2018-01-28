<?php
/**
 * Admin View: Admin Contribution Notice
 *
 * @since    1.0.0
 * @version  1.4.9
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if ( ! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$current_user = wp_get_current_user();
?>
<div class="notice notice-info auto-load-next-post-message">
	<p><?php _e(sprintf(__('Hi <b>%s</b>, you\'ve been using <b>%s</b> for some time now and I hope you\'re happy with it. I\'ve spent countless hours developing this free plugin for you and I would really appreciate it if you could give it a review or offer a contribution. Thank you!', 'auto-load-next-post'), $current_user->display_name, 'Auto Load Next Post')); ?></p>
	<p><a href="https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?filter=5#postform" target="_blank" class="button-primary"><?php _e('Write a Review', 'auto-load-next-post'); ?></a> <a href="https://autoloadnextpost.com/donate/?utm_source=wpadmin&utm_campaign=plugin-admin-contribution-notice" target="_blank" class="button"><?php _e('Make a Donation', 'auto-load-next-post'); ?></a> <a href="<?php echo esc_url(add_query_arg('hide_auto_load_next_post_review_notice', 'true')); ?>" class="skip button"><?php _e('Already have :)', 'auto-load-next-post'); ?></a></p>
</div>
