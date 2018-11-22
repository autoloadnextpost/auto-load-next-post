<?php
/**
 * Admin View: Plugin Review Notice.
 *
 * @since    1.0.0
 * @version  1.5.5
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Views
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_user = wp_get_current_user();

$time = auto_load_next_post_seconds_to_words( time() - $install_date );
?>
<div class="notice notice-info auto-load-next-post-notice">
	<div class="auto-load-next-post-notice-inner">
		<div class="auto-load-next-post-notice-icon">
			<img src="https://ps.w.org/auto-load-next-post/assets/icon-256x256.png" alt="<?php echo esc_attr__( 'Auto Load Next Post WordPress Plugin', 'auto-load-next-post' ); ?>" />
		</div>

		<div class="auto-load-next-post-notice-content">
			<h3><?php echo esc_html__( 'Are you enjoying Auto Load Next Post?', 'auto-load-next-post' ); ?></h3>
			<p><?php printf( esc_html__( 'You have been using %1$s for %2$s now! Mind leaving a quick review and let me know know what you think of the plugin? I\'d really appreciate it!', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), esc_html( $time ) ); ?></p>
		</div>

		<div class="auto-load-next-post-review-now">
			<?php printf( '<a href="%1$s" class="button button-primary auto-load-next-post-review-button" target="_blank">%2$s</a>', esc_url( AUTO_LOAD_NEXT_POST_REVIEW_URL . '?rate=5#new-post' ), esc_html__( 'Leave a Review', 'auto-load-next-post' ) ); ?>
			<a href="<?php echo esc_url( add_query_arg( 'hide_auto_load_next_post_review_notice', 'true' ) ); ?>" class="no-thanks"><?php echo esc_html__( 'No thank you / I already have', 'auto-load-next-post' ); ?></a>
		</div>
	</div>
</div>
