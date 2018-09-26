<?php
/**
 * Admin View: Theme supports Auto Load Next Post
 *
 * @since    1.5.0
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
<div class="notice notice-info">
	<p><?php echo sprintf( __( 'This theme supports %s. No need to change the theme selectors as they have already been set by the theme.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
</div>
