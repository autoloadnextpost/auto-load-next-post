<?php
/**
 * Admin View: Theme supported via a Plugin
 *
 * @since    1.5.10
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
	<p><?php echo sprintf( __( 'Your active theme %s, is supported via a plugin. Changes to set theme selectors are disabled.', 'auto-load-next-post' ), $active_theme->name ); ?></p>
</div>
