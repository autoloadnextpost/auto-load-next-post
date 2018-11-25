<?php
/**
 * Admin View: MonsterInsights
 *
 * @since    1.6.0
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
<div class="notice notice-info is-dismissible">
	<p><?php echo sprintf( __( 'We noticed that you have MonsterInsights installed but are not tracking your pageviews and wanted to tell you that %s can track them simply by enabling "Update Google Analytics".', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
</div>
