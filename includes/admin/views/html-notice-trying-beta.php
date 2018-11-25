<?php
/**
 * Admin View: Trying Beta Notice.
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
?>
<div class="notice notice-info auto-load-next-post-notice">
	<div class="auto-load-next-post-notice-inner">
		<div class="auto-load-next-post-notice-icon">
			<img src="https://ps.w.org/auto-load-next-post/assets/icon-256x256.png" alt="<?php echo esc_attr__( 'Auto Load Next Post WordPress Plugin', 'auto-load-next-post' ); ?>" />
		</div>

		<div class="auto-load-next-post-notice-content">
			<h3><?php echo esc_html__( 'Thanks for trying out this beta!', 'auto-load-next-post' ); ?></h3>
			<p><?php printf( esc_html__( 'If you have any questions about the beta or if you have any feedback at all, let me know. Any little bit you\'re willing to share helps. You can %1$sjoin the Slack channel%2$s to provide feedback, discuss features to be added and integrations to support. Or you can just give feedback the old fashion way pressing the big button on the side.', 'auto-load-next-post' ), '<a href="' . esc_url( 'https://launchpass.com/autoloadnextpost' ) . '" target="_blank">', '</a>' ); ?></p>
		</div>

		<div class="auto-load-next-post-send-feedback">
			<?php printf( '<a href="%1$s" class="button button-primary auto-load-next-post-feedback-button" target="_blank">%2$s</a>', esc_url( AUTO_LOAD_NEXT_POST_STORE_URL . 'contact/' ), esc_html__( 'Give Feedback', 'auto-load-next-post' ) ); ?>
			<a href="<?php echo esc_url( add_query_arg( 'hide_auto_load_next_post_beta_notice', 'true' ) ); ?>" class="no-thanks"><?php echo esc_html__( 'Ask me again in 7 days', 'auto-load-next-post' ); ?></a>
		</div>
	</div>
</div>
