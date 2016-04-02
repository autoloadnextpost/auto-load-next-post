<?php
/**
	 * Help is provided for this plugin on the plugin pages.
	 *
	 * @since    1.0.0
	 * @author   Sébastien Dumont
	 * @category Admin
	 * @package  Auto Load Next Post
	 * @license  GPL-2.0+
	 */

if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly

if ( ! class_exists('Auto_Load_Next_Post_Admin_Help')) {

/**
 * Class - Auto_Load_Next_Post_Admin_Help
 *
 * @since 1.0.0
 */
class Auto_Load_Next_Post_Admin_Help {

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {
		add_action('current_screen', array($this, 'add_help_tabs'), 50);
	} // END __construct()

	/**
	 * Adds help tabs to the plugin pages.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function add_help_tabs() {
		$screen = get_current_screen();

		if ($screen->id != 'settings_page_auto-load-next-post-settings') {
			return;
		}

		$screen->add_help_tab(array(
			'id'      => 'auto_load_next_post_docs_tab',
			'title'   => __('Documentation', 'auto-load-next-post'),
			'content' =>
				'<p>'.sprintf(__('Thank you for using <strong>%1$s</strong> :) Should you need help using <strong>%1$s</strong> please read the documentation.', 'auto-load-next-post'), 'Auto Load Next Post').'</p>'.
				'<p><a href="https://github.com/seb86/Auto-Load-Next-Post/wiki/" class="button button-primary" target="_blank">'.sprintf(__('%s Documentation', 'auto-load-next-post'), 'Auto Load Next Post').'</a></p>'
		));

		$screen->add_help_tab(array(
			'id'      => 'auto_load_next_post_bugs_tab',
			'title'   => __('Found a bug?', 'auto-load-next-post'),
			'content' =>
				'<p>'.sprintf(__('If you find a bug within <strong>%s</strong>, please create a ticket on GitHub via the <a href="%s" target="_blank">Github issues</a>. Ensure that you read the <a href="%s" target="_blank">contribution guidelines</a> prior to submitting your report. Be as descriptive as possible. Thank you.', 'auto-load-next-post'), 'Auto Load Next Post', 'https://github.com/seb86/Auto-Load-Next-Post/issues?state=open', 'https://github.com/seb86/Auto-Load-Next-Post/blob/master/CONTRIBUTING.md').'</p>'.
				'<p><a href="https://github.com/seb86/Auto-Load-Next-Post/issues/new" class="button button-primary" target="_blank">'.__('Report an Issue', 'auto-load-next-post').'</a></p>'
		));

		$screen->add_help_tab(array(
			'id'      => 'auto_load_next_post_support_tab',
			'title'   => __('Support', 'auto-load-next-post'),
			'content' =>
				'<p>'.sprintf(__('If you need support with <strong>%s</strong>, you may ask the WordPress community for help by opening a thread on the <a href="%s" target="_blank">WordPress.org support forum</a>.', 'auto-load-next-post'), 'Auto Load Next Post', 'https://wordpress.org/support/plugin/auto-load-next-post').'</p>'.
				'<p><a href="https://wordpress.org/support/plugin/auto-load-next-post" class="button button-primary" target="_blank">'.__('Create a Ticket', 'auto-load-next-post').'</a></p>'
		));

		$screen->add_help_tab(array(
			'id'      => 'auto_load_next_post_feedback_tab',
			'title'   => __('Feedback', 'auto-load-next-post'),
			'content' =>
				'<p>'.sprintf(__('Your feedback is most important as it helps improve <strong>%s</strong> to support what you need. You can either submit a review on WordPress.org or complete a simple survey.', 'auto-load-next-post'), 'Auto Load Next Post').'</p>'.
				'<p><a href="https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?filter=5#postform" class="button button-primary" target="_blank">'.__('Submit a Review', 'auto-load-next-post').'</a> | <a href="https://sebd86.polldaddy.com/s/auto-load-next-post" class="button button-secondary" target="_blank">'.__('Complete Survey', 'auto-load-next-post').'</a></p>'
		));

		$screen->set_help_sidebar(
			'<p><strong>'.__('For more information:', 'auto-load-next-post').'</strong></p>'.
			'<p><a href="https://autoloadnextpost.com" target="_blank">'.sprintf(__('About %s', 'auto-load-next-post'), 'Auto Load Next Post').'</a></p>'.
			'<p><a href="https://wordpress.org/plugins/auto-load-next-post" target="_blank">'.__('Project on WordPress.org', 'auto-load-next-post').'</a></p>'.
			'<p><a href="https://github.com/seb86/Auto-Load-Next-Post/" target="_blank">'.__('Project on Github', 'auto-load-next-post').'</a></p>'
		);

	} // END add_help_tabs()

} // END Auto_Load_Next_Post_Admin_Help class.

} // END if class exists.

return new Auto_Load_Next_Post_Admin_Help();
