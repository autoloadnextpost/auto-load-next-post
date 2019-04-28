<?php
/**
 * Admin View: Theme supports Auto Load Next Post
 *
 * @since    1.5.0
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Views
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$active_theme = wp_get_theme();
?>
<div class="notice notice-info">
	<p><?php echo sprintf( __( 'Your active theme %1$s, supports %2$s. Changes to set theme selectors are disabled.', 'auto-load-next-post' ), $active_theme->name, esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
</div>
