<?php
/**
 * Admin View: Theme supported via a Plugin
 *
 * @since    1.5.10
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
	<p><?php echo sprintf( __( '%s theme is supported via a plugin. Do <strong>NOT</strong> change the theme selectors.', 'auto-load-next-post' ), $active_theme->name ); ?></p>
</div>
