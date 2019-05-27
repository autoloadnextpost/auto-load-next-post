<?php
/**
 * Admin View: Settings
 *
 * @since    1.0.0
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Views
 * @license  GPL-2.0+
 * @global   string $current_section
 * @global   string $current_view
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $current_section, $current_view;

$tab_exists    = isset( $tabs[ $current_view ] ) || has_action( 'auto_load_next_post_sections_' . $current_view ) || has_action( 'auto_load_next_post_settings_' . $current_view ) || has_action( 'auto_load_next_post_settings_tabs_' . $current_view );
$current_label = isset( $tabs[ $current_view ] ) ? $tabs[ $current_view ] : '';

if ( ! $tab_exists ) {
	wp_safe_redirect( admin_url( 'options-general.php?page=auto-load-next-post' ) );
	exit;
}
?>
<div class="wrap auto-load-next-post">
	<form method="post" id="mainform" action="" enctype="multipart/form-data">
		<?php
		// Include settings tabs.
		include_once( dirname( __FILE__ ) . '/html-admin-tabs.php' ); ?>

		<h1 class="screen-reader-text"><?php echo esc_html( $current_label ); ?></h1>

		<?php
		do_action( 'auto_load_next_post_sections_' . $current_view );

		self::show_messages();

		do_action( 'auto_load_next_post_settings_' . $current_view );
		?>
		<p class="submit">
			<?php submit_button( esc_attr__( 'Save Changes', 'auto-load-next-post' ), 'button-primary', esc_attr__( 'Save Changes', 'auto-load-next-post' ), false, array( 'id' => 'save' ) ); ?>
			<?php wp_nonce_field( 'auto-load-next-post-settings' ); ?>
		</p>
	</form>

	<div class="alnp-sidebar">
		<?php do_action( 'auto_load_next_post_sidebar', $current_view ); ?>
	</div>
</div>
