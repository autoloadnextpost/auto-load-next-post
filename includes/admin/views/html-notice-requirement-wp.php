<?php
/**
 * Admin View: Admin WordPress Requirment Notice
 *
 * @since    1.0.0
 * @version  1.4.8
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if ( ! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>
<div class="notice notice-error auto-load-next-post-message">
	<p><?php echo sprintf(__('Sorry, <strong>%s</strong> requires WordPress %s or higher. Please upgrade your WordPress setup.', 'auto-load-next-post'), 'Auto Load Next Post', AUTO_LOAD_NEXT_POST_WP_VERSION_REQUIRE); ?></p>
</div>
