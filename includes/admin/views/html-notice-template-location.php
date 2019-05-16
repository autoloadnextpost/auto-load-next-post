<?php
/**
 * Admin View: Template Location
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

$locate_single = alnp_get_template_directory();

if ( empty( $locate_single ) ) {
	$response = sprintf( __( '%1$s was unable to detect your theme templates. Currently using fallback support.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) );
} else {
	$response = sprintf( __( 'Template location detected: %1$s%3$s%2$s If this is incorrect, please set the correct location for the template below.', 'auto-load-next-post' ), '<code>', '</code>', $locate_single );
}
?>
<div class="notice notice-info">
	<p><?php echo $response; ?>
</div>
