<?php
/**
 * Admin View: Theme Ready Notice.
 *
 * @since    1.5.0
 * @version  1.5.14
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
<div class="notice notice-success auto-load-next-post-notice is-dismissible">
	<div class="auto-load-next-post-notice-inner">
		<div class="auto-load-next-post-notice-icon">
			<img src="<?php echo AUTO_LOAD_NEXT_POST_URL_PATH . '/assets/images/icon-256x256.png'; ?>" alt="<?php echo esc_attr__( 'Auto Load Next Post WordPress Plugin', 'auto-load-next-post' ); ?>" />
		</div>

		<div class="auto-load-next-post-notice-content">
			<h3><?php echo sprintf( esc_html__( 'Thank you for installing %1$s!', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></h3>
			<p><?php echo sprintf( __( 'We detected your theme <strong>%1$s</strong> already supports %2$s. Everything is already setup for you and is ready to increase your pageviews.', 'auto-load-next-post' ), $active_theme->name, esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
		</div>
	</div>
</div>
