<?php
/**
 * Admin View: Upgrade Warning Notice.
 *
 * @since    1.4.13
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="notice notice-error is-dismissible">
	<p><?php echo sprintf( __( 'Warning! Version 1.5.0 of %1$s is coming soon and is a major update. Before updating, please test on a staging site. %2$sLearn more about the changes in version 1.5.0 &raquo;%3$s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="https://autoloadnextpost.com/2018/05/28/whats-coming-in-v1-5-0-of-auto-load-next-post/" target="_blank">', '</a>' ); ?></p>
</div>
