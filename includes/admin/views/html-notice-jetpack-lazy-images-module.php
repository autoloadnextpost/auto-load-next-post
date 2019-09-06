<?php
/**
 * Admin View: JetPack Lazy Images Module
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
?>
<div class="notice jetpack-info">
	<p><?php echo sprintf( esc_attr__( 'Lazy-loading for the Images module is enabled in %1$sJetPack%2$s. To trigger the lazy loading event apply %3$s to %4$s%5$s%6$s.', 'auto-load-next-post' ), '<a href="' . admin_url( 'admin.php?page=jetpack#/performance' ) . '">', '</a>', '<code>jetpack-lazy-images-load</code>', '<strong>', __( 'Entering a Post', 'auto-load-next-post'), '</strong>' ); ?></p>
</div>
