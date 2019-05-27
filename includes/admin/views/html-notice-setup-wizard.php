<?php
/**
 * Admin View: Setup Wizard Notice.
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

$current_user = wp_get_current_user();
?>
<div class="notice notice-info auto-load-next-post-notice">
	<div class="auto-load-next-post-notice-inner">
		<div class="auto-load-next-post-notice-icon">
			<img src="https://ps.w.org/auto-load-next-post/assets/icon-256x256.png" alt="<?php echo esc_attr__( 'Auto Load Next Post WordPress Plugin', 'auto-load-next-post' ); ?>" />
		</div>

		<div class="auto-load-next-post-notice-content">
			<h3><?php printf( esc_html__( 'Hi %s.', 'auto-load-next-post' ), $current_user->display_name ); ?></h3>
			<p><?php printf( esc_html__( 'Try the Setup Wizard to help identify your theme selectors and template location. Once done %s will be ready!', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
		</div>

		<div class="auto-load-next-post-setup-wizard">
			<?php printf( '<a href="%1$s" class="button button-primary auto-load-next-post-setup-button">%2$s</a>', add_query_arg( array( 'page' => 'auto-load-next-post', 'view' => 'setup-wizard' ), admin_url( 'options-general.php' ) ), esc_html__( 'Run the Setup Wizard', 'auto-load-next-post' ) ); ?>
			<a href="<?php echo esc_url( add_query_arg( 'hide_auto_load_next_post_setup_notice', 'true' ) ); ?>" class="no-thanks"><?php echo esc_html__( 'No need / I already have', 'auto-load-next-post' ); ?></a>
		</div>
	</div>
</div>
