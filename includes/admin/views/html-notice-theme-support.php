<?php
/**
 * Admin View: Theme Declartion Notice.
 *
 * @since    1.0.0
 * @version  1.4.10
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
<div class="notice notice-warning auto-load-next-post-message">
	<p><?php printf( esc_html__( 'The theme you are using has not declared support for %s &#8211; please see documentation or the F.A.Q. to find out how to support your theme.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
	<p><a href="<?php echo esc_url( 'https://autoloadnextpost.com/documentation/' ); ?>" target="_blank" class="button-primary"><?php esc_html_e( 'Documentation', 'auto-load-next-post' ); ?></a> <a href="<?php echo esc_url( 'https://autoloadnextpost.com/f-a-q/' ); ?>" target="_blank" class="button-secondary"><?php esc_html_e( 'Frequently Asked Questions', 'auto-load-next-post' ); ?></a> <a class="skip button-secondary" href="<?php echo esc_url( add_query_arg( 'hide_auto_load_next_post_theme_support_check', 'true' ) ); ?>"><?php esc_html_e( 'Hide this notice', 'auto-load-next-post' ); ?></a></p>
</div>
