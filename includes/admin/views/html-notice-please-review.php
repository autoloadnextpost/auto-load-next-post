<?php
/**
 * Admin View: Plugin Review Notice.
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

$current_user = wp_get_current_user();

$time = auto_load_next_post_seconds_to_words( time() - $install_date );
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
.notice.auto-load-next-post-notice .auto-load-next-post-notice-inner .auto-load-next-post-notice-content,
.notice.auto-load-next-post-notice .auto-load-next-post-notice-inner .auto-load-next-post-review-now {
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
.notice.auto-load-next-post-notice .auto-load-next-post-review-now {
	text-align: center;
}
.notice.auto-load-next-post-notice .auto-load-next-post-review-now .auto-load-next-post-review-button {
	padding: 6px 50px;
	height: auto;
	line-height: 20px;
}
.notice.auto-load-next-post-notice a.no-thanks {
	display: block;
	margin-top: 10px;
	color: #72777c;
	text-decoration: none;
}
.notice.auto-load-next-post-notice a.no-thanks:hover {
	color: #444;
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
	.notice.auto-load-next-post-notice .auto-load-next-post-notice-inner .auto-load-next-post-review-now {
		margin-top: 20px;
		display: block;
		text-align: left;
	}
	.notice.auto-load-next-post-notice .auto-load-next-post-notice-inner .no-thanks {
		display: inline-block;
		margin-left: 15px;
	}
}
</style>
<div class="notice notice-info auto-load-next-post-notice">
	<div class="auto-load-next-post-notice-inner">
		<div class="auto-load-next-post-notice-icon">
			<img src="https://ps.w.org/auto-load-next-post/assets/icon-256x256.png" alt="<?php echo esc_attr__( 'Auto Load Next Post WordPress Plugin', 'auto-load-next-post' ); ?>" />
		</div>

		<div class="auto-load-next-post-notice-content">
			<h3><?php echo esc_html__( 'Are you enjoying Auto Load Next Post?', 'auto-load-next-post' ); ?></h3>
			<p><?php printf( esc_html__( 'You have been using %1$s for %2$s now! Mind leaving a quick review and let me know know what you think of the plugin? I\'d really appreciate it!', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), esc_html( $time ) ); ?></p>
		</div>

		<div class="auto-load-next-post-review-now">
			<?php printf( '<a href="%1$s" class="button button-primary auto-load-next-post-review-button" target="_blank">%2$s</a>', esc_url( 'https://wordpress.org/support/plugin/auto-load-next-post/reviews?rate=5#new-post' ), esc_html__( 'Leave a Review', 'auto-load-next-post' ) ); ?>
			<a href="<?php echo esc_url( add_query_arg( 'hide_auto_load_next_post_review_notice', 'true' ) ); ?>" class="no-thanks"><?php echo esc_html__( 'No thank you / I already have', 'auto-load-next-post' ); ?></a>
		</div>
	</div>
</div>
