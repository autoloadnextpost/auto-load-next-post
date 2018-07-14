<?php
/**
 * Admin View: Theme Ready Notice.
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

$active_theme = wp_get_theme();
?>
<div class="notice notice-success auto-load-next-post-notice is-dismissible">
	<div class="auto-load-next-post-notice-inner">
		<div class="auto-load-next-post-notice-icon">
			<img src="https://ps.w.org/auto-load-next-post/assets/icon-256x256.png" alt="<?php echo esc_attr__( 'Auto Load Next Post WordPress Plugin', 'auto-load-next-post' ); ?>" />
		</div>

		<div class="auto-load-next-post-notice-content">
			<h3><?php echo esc_html__( 'Congratulations!', 'auto-load-next-post' ); ?></h3>
			<p><?php echo sprintf( __( 'Your current theme <strong>%1$s</strong> is supported. %2$s is ready to increase your pageviews. There is nothing else to setup so your good to go.', 'auto-load-next-post' ), $active_theme->name, esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
		</div>
	</div>
</div>
