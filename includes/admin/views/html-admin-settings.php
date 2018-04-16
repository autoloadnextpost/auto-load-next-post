<?php
/**
 * Admin View: Settings
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

$tab_exists        = isset( $tabs[ $current_tab ] ) || has_action( 'auto_load_next_post_sections_' . $current_tab ) || has_action( 'auto_load_next_post_settings_' . $current_tab ) || has_action( 'auto_load_next_post_settings_tabs_' . $current_tab );
$current_tab_label = isset( $tabs[ $current_tab ] ) ? $tabs[ $current_tab ] : '';

if ( ! $tab_exists ) {
	wp_safe_redirect( admin_url( 'options-general.php?page=auto-load-next-post-settings' ) );
	exit;
}
?>
<div class="wrap auto-load-next-post">
	<form method="post" id="mainform" action="" enctype="multipart/form-data">
		<h2 class="nav-tab-wrapper">
			<span>Auto Load Next Post v<?php echo AUTO_LOAD_NEXT_POST_VERSION; ?></span>
			<?php
				foreach ( $tabs as $slug => $label ) {
					echo '<a href="' . esc_html( admin_url( 'options-general.php?page=auto-load-next-post-settings&tab=' . esc_attr( $slug ) ) ) . '" class="nav-tab ' . ( $current_tab === $slug ? 'nav-tab-active' : '' ) . '">' . esc_html( $label ) . '</a>';
				}

				do_action( 'auto_load_next_post_settings_tabs' );
			?>
		</h2>
		<?php
		do_action( 'auto_load_next_post_sections_' . $current_tab );

		self::show_messages();

		do_action( 'auto_load_next_post_settings_' . $current_tab );
		?>
		<p class="submit">
			<input name="save" class="button-primary" type="submit" value="<?php esc_attr_e( 'Save Changes', 'auto-load-next-post' ); ?>" />
			<?php wp_nonce_field( 'auto-load-next-post-settings' ); ?>
		</p>
	</form>
</div>
