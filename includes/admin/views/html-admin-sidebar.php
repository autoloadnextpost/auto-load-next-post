<?php
/**
 * Admin View: Sidebar - Upgrade Details
 *
 * @since    1.5.0
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Views
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get Current User Details
$current_user = wp_get_current_user();
$user_email   = $current_user->user_email;
$first_name   = $current_user->first_name;
$last_name    = $current_user->last_name;
?>
<div class="alnp-upgrade-details">
	<h1><?php esc_html_e( 'Pro Coming Soon', 'auto-load-next-post' ); ?></h1>

	<ul>
		<li><?php echo esc_html__( 'Load the Next Post or Next Post with same Category or New Posts or Related Posts or by Custom Query', 'auto-load-next-post' ); ?></li>
		<li><?php echo esc_html__( 'Page and Media Attachment Support', 'auto-load-next-post' ); ?></li>
		<li><?php echo esc_html__( 'Custom Post Type Support', 'auto-load-next-post' ); ?></li>
		<li><?php echo esc_html__( 'Paginated Posts Supported', 'auto-load-next-post' ); ?></li>
		<li><?php echo esc_html__( 'Exclude Post Formats', 'auto-load-next-post' ); ?></li>
		<li><?php echo esc_html__( 'Limit Posts per Session', 'auto-load-next-post' ); ?></li>
		<li><?php echo esc_html__( 'Query Posts by Category and Tag', 'auto-load-next-post' ); ?></li>
		<li><?php echo esc_html__( 'Exclude User Roles and Specific Users', 'auto-load-next-post' ); ?></li>
		<li><?php echo esc_html__( 'Pre-Query Posts Ready to Load', 'auto-load-next-post' ); ?></li>
		<li><?php echo esc_html__( 'Hide Comments and Show by Toggle Button', 'auto-load-next-post' ); ?></li>
		<li><?php echo sprintf( esc_html__( 'Multilingual Support for %1$s and %2$s', 'auto-load-next-post' ), 'WPML', 'Polylang' ); ?></li>
		<li><?php echo esc_html__( 'Email Support', 'auto-load-next-post' ); ?></li>
	</ul>

	<p>
		<a href="<?php echo AUTO_LOAD_NEXT_POST_STORE_URL; ?>pro/?utm_source=plugin&utm_medium=link&utm_campaign=alnp-settings-page"><?php esc_html_e( 'Visit autoloadnextpost.com &rarr;', 'auto-load-next-post' ); ?></a>
	</p>

</div>

<form method="post" action="https://sebastiendumont.us1.list-manage.com/subscribe/post?u=48ead612ad85b23fe2239c6e3&amp;id=79e97b5275" name="mc-embedded-subscribe-form" target="_blank" class="subscribe block">
	<h2><?php esc_html_e( 'Sign up to pre-order first', 'auto-load-next-post' ); ?></h2>

	<p class="intro">
		<?php echo sprintf( __( 'Submit your name and email and be the first to know when you can pre-order %1$s and keep up to date with my developments plus a %2$s discount.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post Pro', 'auto-load-next-post' ), '10%' ); ?>
	</p>

	<div class="field">
		<input type="email" name="EMAIL" value="<?php echo $user_email; ?>" placeholder="<?php esc_html_e( 'Your Email Address', 'auto-load-next-post' ); ?>"/>
	</div>

	<div class="field">
		<input type="text" name="FNAME" value="<?php echo $first_name; ?>" placeholder="<?php esc_html_e( 'First Name', 'auto-load-next-post' ); ?>"/>
	</div>

	<div class="field">
		<input type="text" name="LNAME" value="<?php echo $last_name; ?>" placeholder="<?php esc_html_e( 'Last Name', 'auto-load-next-post' ); ?>"/>
	</div>

	<input type="hidden" name="group[35169][1]" value="1">

	<div class="field submit-button">
		<div style="position: absolute; left: -9999px;" aria-hidden="true"><input type="text" name="b_48ead612ad85b23fe2239c6e3_79e97b5275" tabindex="-1" value=""></div>
		<input type="submit" name="subscribe" id="mc-embedded-subscribe" class="button" value="<?php esc_html_e( 'Sign me up', 'auto-load-next-post' ); ?>"/>
	</div>

	<p class="promise">
		<?php esc_html_e( 'I promise I will not use your email for anything else and you can unsubscribe with 1-click anytime.', 'auto-load-next-post' ); ?>
	</p>
</form>