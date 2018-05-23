<?php
/**
 * Admin View: No Comment Selector Set
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="notice notice-error auto-load-next-post-message">
	<p><?php _e( 'In order to remove comments we need to know what the comments container is. Please set the comments container under <strong>General</strong>. <a href="https://autoloadnextpost.com/documentation/find-theme-selectors/?utm_source=wpadmin&utm_campaign=plugin-settings-misc" target="_blank">How to find my theme selectors?</a>', 'auto-load-next-post' ); ?></p>
</div>
