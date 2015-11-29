<?php
/**
* Admin View: Admin WordPress Requirment Notice
*/

if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly
?>
<div id="message" class="error auto-load-next-post-message">
	<p><?php echo sprintf(__('Sorry, <strong>%s</strong> requires WordPress %s or higher. Please upgrade your WordPress setup.', 'auto-load-next-post'), 'Auto Load Next Post', AUTO_LOAD_NEXT_POST_WP_VERSION_REQUIRE); ?></p>
</div>
