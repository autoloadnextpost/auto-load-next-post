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
	<p><?php echo sprintf( esc_attr__( 'Lazy-loading for the Images module is enabled in %sJetPack%s. To trigger the lazy loading event apply %s to %s%s%s.', 'auto-load-next-post' ), '<a href="' . admin_url( 'admin.php?page=jetpack#/settings' ) . '">', '</a>', '<code>jetpack-lazy-images-load</code>', '<strong>', __( 'Entering a Post', 'auto-load-next-post'), '</strong>' ); ?></p>
</div>
