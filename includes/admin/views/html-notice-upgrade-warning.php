<?php
/**
 * Admin View: Upgrade Warning Notice.
 *
 * @since    1.4.13
 * @version  1.5.14
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
<div class="notice notice-warning auto-load-next-post-notice">
	<div class="auto-load-next-post-notice-inner">
		<div class="auto-load-next-post-notice-icon">
			<img src="<?php echo AUTO_LOAD_NEXT_POST_URL_PATH . '/assets/images/icon-256x256.png'; ?>" alt="<?php echo esc_attr__( 'Auto Load Next Post WordPress Plugin', 'auto-load-next-post' ); ?>" />
		</div>

		<div class="auto-load-next-post-notice-content">
			<h3><?php esc_html_e( 'Update Coming!', 'auto-load-next-post' ); ?></h3>
			<p><?php printf( __( 'Version %1$s1.6.0%2$s of %3$s is coming with new features and improvements. Before it is released I require your help to test with the themes you like to use and provide feedback. I do recommend you do so on a staging site. You will be helping me move the project forward. Thank you!', 'auto-load-next-post' ), '<strong>', '</strong>', esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
		</div>

		<div class="auto-load-next-post-send-feedback">
			<?php printf( '<a href="%1$s" class="button button-primary auto-load-next-post-feedback-button" target="_blank">%2$s</a>', esc_url( 'https://autoloadnextpost.com/2019/09/09/auto-load-next-post-v1-6-0-beta-1/' ), esc_html__( 'Learn More', 'auto-load-next-post' ) ); ?>
			<a href="<?php echo esc_url( add_query_arg( 'hide_auto_load_next_post_upgrade_notice', 'true' ) ); ?>" class="no-thanks"><?php echo esc_html__( 'Not interested / Already doing so?', 'auto-load-next-post' ); ?></a>
		</div>
	</div>
</div>
