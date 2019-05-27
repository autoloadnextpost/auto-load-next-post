<?php
/**
 * Admin View: Tabs
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
?>
<nav class="nav-tab-wrapper">
	<?php
	foreach ( $tabs as $slug => $label ) {
		$url = add_query_arg( array(
			'page' => 'auto-load-next-post',
			'view' => esc_attr( $slug ),
		), admin_url( 'options-general.php' ) );

		echo '<a href="' . apply_filters( 'alnp_settings_tab_url', esc_html( $url ), $slug ) . '" class="nav-tab ' . ( $current_view === $slug ? 'nav-tab-active' : '' ) . '" data-tab="' . $slug . '">' . esc_html( $label ) . '</a>';
	}

	do_action( 'auto_load_next_post_settings_tabs' );
	?>
</nav>
