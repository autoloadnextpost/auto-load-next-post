<?php
/**
 * Admin View: Sidebar - Logo
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
<a class="alnp-banner" href="https://autoloadnextpost.com/?utm_source=plugin&utm_medium=alnp-banner&utm_campaign=alnp-settings-page">
	<img src="<?php echo AUTO_LOAD_NEXT_POST_URL_PATH . '/assets/images/banner.png'; ?>" alt="<?php _e( 'Auto Load Next Post', 'auto-load-next-post' ); ?>" width="100%" />
</a>
