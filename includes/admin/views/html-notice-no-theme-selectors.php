<?php
/**
 * Admin View: No Theme Selectors Set
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
	<p><?php echo sprintf( __( 'It seems that not all of the required theme selectors have been set. These theme selectors are required in order for %s to work. <a href="https://autoloadnextpost.com/documentation/find-theme-selectors/?utm_source=wpadmin&utm_campaign=plugin-settings-general" target="_blank">How to find my theme selectors?</a>', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
</div>
