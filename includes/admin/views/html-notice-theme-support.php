<?php
/**
 * Admin View: Admin Theme Notice
 *
 * @since    1.0.0
 * @version  1.4.10
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if ( ! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>
<div class="notice notice-warning auto-load-next-post-message">
	<p><?php _e( sprintf( 'The theme you are using has not declared support for <b>%s</b> &#8211; please see the F.A.Q. to find out how.', 'Auto Load Next Post' ), 'auto-load-next-post' ); ?></p>
	<p><a href="<?php echo esc_url( 'https://autoloadnextpost.com/f-a-q/' ); ?>" class="button-primary"><?php _e( 'Frequently Asked Questions', 'auto-load-next-post' ); ?></a> <a class="skip button-primary" href="<?php echo esc_url( add_query_arg( 'hide_auto_load_next_post_theme_support_check', 'true' ) ); ?>"><?php _e( 'Hide this notice', 'auto-load-next-post' ); ?></a></p>
</div>
