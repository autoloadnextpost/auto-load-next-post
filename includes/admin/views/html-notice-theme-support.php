<?php
/**
* Admin View: Admin Theme Notice
*/

if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly
?>
<div id="message" class="updated auto-load-next-post-message">
	<p><?php _e(sprintf('<strong>The theme you are using has not declared support for %s</strong> &#8211; please read the integration guide.', 'Auto Load Next Post'), 'auto-load-next-post'); ?></p>
	<p class="submit"><a href="<?php echo esc_url('https://github.com/seb86/Auto-Load-Next-Post/wiki/Supporting-your-theme'); ?>" class="button-primary"><?php _e('Supporting your theme', 'auto-load-next-post'); ?></a> <a class="skip button-primary" href="<?php echo esc_url(add_query_arg('hide_auto_load_next_post_theme_support_check', 'true')); ?>"><?php _e('Hide this notice', 'auto-load-next-post'); ?></a></p>
</div>
