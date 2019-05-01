<?php
/**
 * Admin View: Getting Started for Auto Load Next Post.
 *
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
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
<p><strong><?php echo sprintf( __( '%s Coming Soon', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post Pro', 'auto-load-next-post' ) ); ?></strong></p>

<ul>
	<li><?php esc_html_e( 'Load the Next Post or Next Post with same Category or New Posts or Related Posts or by Custom Query', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'Page and Media Attachment Support', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'Custom Post Type Support', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'Paginated Posts Supported', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'Exclude Post Formats', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'Limit Posts per Session', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'Query Posts by Category, Tag, Related or Custom Query', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'Exclude User Roles and Specific Users', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'Pre-Query Posts Ready to Load', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'Toggle Comments to Hide or Show', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'Multilingual Support for WPML and Polylang', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'Email Support', 'auto-load-next-post' ); ?></li>
	<li><?php esc_html_e( 'and many more features and add-ons to follow.', 'auto-load-next-post' ); ?></li>
</ul>

<p><strong><?php esc_html_e( 'Sign up to pre-order first', 'auto-load-next-post' ); ?></strong></p>

<form method="post" action="https://sebastiendumont.us1.list-manage.com/subscribe/post?u=48ead612ad85b23fe2239c6e3&amp;id=79e97b5275" name="mc-embedded-subscribe-form" target="_blank" class="subscribe block">
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