<?php
/**
 * Admin View: JetPack Lazy Images Module
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
<div class="notice jetpack-info">
	<p><?php echo sprintf( __( 'You have enabled the Lazy-loading for Images module in JetPack. To trigger the lazy loading event apply %s to "Entering a Post".', 'auto-load-next-post' ), '<code>jetpack-lazy-images-load</code>' ); ?></p>
</div>
