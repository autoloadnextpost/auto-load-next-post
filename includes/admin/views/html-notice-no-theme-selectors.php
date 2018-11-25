<?php
/**
 * Admin View: No Theme Selectors Set
 *
 * @since    1.5.0
 * @version  1.5.5
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Views
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="notice notice-error">
	<p><?php echo sprintf( __( 'It seems that not all of the required theme selectors have been set. These theme selectors are required in order for %1$s to work. %2$sHow to find my theme selectors?%3$s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="' . AUTO_LOAD_NEXT_POST_STORE_URL . 'documentation/find-theme-selectors/?utm_source=wpadmin&utm_campaign=plugin-settings-theme-selectors" target="_blank">', '</a>' ); ?></p>
</div>
