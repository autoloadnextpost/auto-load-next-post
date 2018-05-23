<?php
/**
 * Admin View: Theme Ready Notice.
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$active_theme = wp_get_theme();
?>
<style type="text/css">
.notice.auto-load-next-post-notice {
	border-left-color: #008ec2 !important;
	padding: 20px;
}
.rtl .notice.auto-load-next-post-notice {
	border-right-color: #008ec2 !important;
}
.notice.notice.auto-load-next-post-notice .auto-load-next-post-notice-inner {
	display: table;
	width: 100%;
}
.notice.auto-load-next-post-notice .auto-load-next-post-notice-inner .auto-load-next-post-notice-icon,
.notice.auto-load-next-post-notice .auto-load-next-post-notice-inner .auto-load-next-post-notice-content {
	display: table-cell;
	vertical-align: middle;
}
.notice.auto-load-next-post-notice .auto-load-next-post-notice-icon {
	color: #509ed2;
	font-size: 50px;
	width: 60px;
}
.notice.auto-load-next-post-notice .auto-load-next-post-notice-icon img {
	width: 64px;
}
.notice.auto-load-next-post-notice .auto-load-next-post-notice-content {
	padding: 0 40px 0 20px;
}
.notice.auto-load-next-post-notice p {
	padding: 0;
	margin: 0;
}
.notice.auto-load-next-post-notice h3 {
	margin: 0 0 5px;
}
@media (max-width: 767px) {
	.notice.notice.auto-load-next-post-notice .auto-load-next-post-notice-inner {
		display: block;
	}
	.notice.auto-load-next-post-notice {
		padding: 20px !important;
	}
	.notice.auto-load-next-post-noticee .auto-load-next-post-notice-inner {
		display: block;
	}
	.notice.auto-load-next-post-notice .auto-load-next-post-notice-inner .auto-load-next-post-notice-content {
		display: block;
		padding: 0;
	}
	.notice.auto-load-next-post-notice .auto-load-next-post-notice-inner .auto-load-next-post-notice-icon {
		display: none;
	}
}
</style>
<div class="notice notice-info auto-load-next-post-message">
	<div class="auto-load-next-post-notice-inner">
		<div class="auto-load-next-post-notice-icon">
			<img src="https://ps.w.org/auto-load-next-post/assets/icon-256x256.png" alt="<?php echo esc_attr__( 'Auto Load Next Post WordPress Plugin', 'auto-load-next-post' ); ?>" />
		</div>

		<div class="auto-load-next-post-notice-content">
			<h3><?php echo esc_html__( 'Congratulations!', 'auto-load-next-post' ); ?></h3>
			<p><?php echo sprintf( __( '<strong>%1$s</strong> supports %2$s and is ready to increase your page views.', 'auto-load-next-post' ), $active_theme->name, esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
		</div>
	</div>
</div>
