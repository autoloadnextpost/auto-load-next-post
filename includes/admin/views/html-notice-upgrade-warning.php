<?php
/**
 * Admin View: Upgrade Warning Notice.
 *
 * @since    1.4.13
 * @version  1.5.13
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
<div class="notice notice-warning auto-load-next-post-notice is-dismissible">
	<div class="auto-load-next-post-notice-inner">
		<div class="auto-load-next-post-notice-icon">
			<img src="https://ps.w.org/auto-load-next-post/assets/icon-256x256.png" alt="<?php echo esc_attr__( 'Auto Load Next Post WordPress Plugin', 'auto-load-next-post' ); ?>" />
		</div>

		<div class="auto-load-next-post-notice-content">
			<h3><?php esc_html_e( 'Upgrade Warning!', 'auto-load-next-post' ); ?></h3>
			<p><?php printf( __( 'Version %1$s1.6.0%2$s of %3$s is coming soon with new features and improvements. Before updating, please test the beta/pre-release on a staging site when it becomes available. Look forward to your feedback!', 'auto-load-next-post' ), '<strong>', '</strong>', esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
		</div>

		<div class="auto-load-next-post-send-feedback">
			<?php printf( '<a href="%1$s" class="button button-primary auto-load-next-post-feedback-button" target="_blank">%2$s</a>', esc_url( 'https://autoloadnextpost.com/2019/05/24/whats-coming-in-v1-6-0/' ), esc_html__( 'Learn More', 'auto-load-next-post' ) ); ?>
		</div>
	</div>
</div>
