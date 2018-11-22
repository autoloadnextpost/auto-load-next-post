<?php
/**
 * Admin View: Welcome Notice.
 *
 * @since    1.5.0
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
<div class="notice notice-success auto-load-next-post-notice">
	<div class="auto-load-next-post-notice-inner">
		<div class="auto-load-next-post-notice-icon">
			<img src="https://ps.w.org/auto-load-next-post/assets/icon-256x256.png" alt="<?php echo esc_attr__( 'Auto Load Next Post WordPress Plugin', 'auto-load-next-post' ); ?>" />
		</div>

		<div class="auto-load-next-post-notice-content">
			<h3><?php echo esc_html__( 'Welcome!', 'auto-load-next-post' ); ?></h3>
			<p>
				<?php echo sprintf( __( 'Thank you for activating %1$s! If you\'re a first time user, welcome! You\'re well on your way to increasing your pageviews.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?>
				<?php
				// If the theme has not added support then encourage the user to see the documentation.
				if ( ! is_alnp_supported() ) {
					$query = array(
						'autofocus[panel]'   => 'alnp',
						'autofocus[section]' => 'auto_load_next_post_theme_selectors',
						'url'                => alnp_get_random_page_permalink(),
						'return'             => admin_url( 'options-general.php?page=auto-load-next-post-settings' ),
					);
					$customizer_link = add_query_arg( $query, admin_url( 'customize.php' ) );
					echo sprintf( __( 'I encourage you to check out the plugin documentation and getting started with %1$ssetting up your theme selectors%2$s.', 'auto-load-next-post' ), '<a href="' . esc_url( $customizer_link ) . '">', '</a>' );
				}
				?>
			</p>
		</div>

		<div class="auto-load-next-post-documentation">
			<?php
			// If the theme has not added support then display button to documentation.
			if ( ! is_alnp_supported() ) {
				printf( '<a href="%1$s" class="button button-primary auto-load-next-post-documentation-button" target="_blank">%2$s</a>', esc_url( AUTO_LOAD_NEXT_POST_STORE_URL . 'documentation/?utm_source=plugin&utm_medium=link&utm_campaign=welcome-notice' ), esc_html__( 'Documentation', 'auto-load-next-post' ) );
			}
			?>
			<a href="<?php echo esc_url( add_query_arg( 'hide_auto_load_next_post_welcome_notice', 'true' ) ); ?>" class="no-thanks"><?php echo esc_html__( 'Dismiss Notice', 'auto-load-next-post' ); ?></a>
		</div>
	</div>
</div>
