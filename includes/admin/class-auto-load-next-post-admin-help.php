<?php
/**
 * Help is provided for this plugin on the plugin pages.
 *
 * @since    1.0.0
 * @version  1.4.8
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

if ( ! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

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
			'title'   => __('General Settings', 'auto-load-next-post'),
			'content' =>
				'<h2>'.__('General Settings', 'auto-load-next-post').'</h2>'.
				'<p>'.sprintf(__('%s requires theme selectors to match the active theme in order for the plugin to work.', 'auto-load-next-post'), 'Auto Load Next Post').'</p>'.
				'<p>'.__('When the plugin was activated, the standard theme selectors a WordPress theme normally uses were set. If you are experiencing any problems, it is most likeley that at least one of these selectors need to be changed.', 'auto-load-next-post').'</p>'
		));

		$screen->add_help_tab(array(
			'id'      => 'auto_load_next_post_support_tab',
			'title'   => __('Help & Support', 'auto-load-next-post'),
			'content' =>
				'<h2>'.__('Help & Support', 'auto-load-next-post').'</h2>'.
				'<p>'.sprintf(__('Should you need help understanding, using, or extending Auto Load Next Post, please <a href="https://github.com/seb86/Auto-Load-Next-Post/wiki/" target="_blank">read the documentation</a>. You will find snippets, tutorials and much more.', 'auto-load-next-post'), 'Auto Load Next Post').'</p>'.
				'<p>'.sprintf(__('For further assistance with %s you can use the <a href="%s" target="_blank">community forum</a>.', 'auto-load-next-post'), 'Auto Load Next Post', 'https://wordpress.org/support/plugin/auto-load-next-post').'</p>'.
				'<p>'.sprintf(__('%1$s is in need of translations. Is the plugin not translated in your language or do you spot errors with the current translations? Helping out is easy! Head over to the project on WordPress.org and click <a href="https://translate.wordpress.org/projects/wp-plugins/auto-load-next-post" target="_blank">Translate %1$s</a>.', 'auto-load-next-post'), 'Auto Load Next Post').'</p>'.
				'<p><a href="https://wordpress.org/support/plugin/auto-load-next-post" class="button button-primary" target="_blank">'.__('Community Forum', 'auto-load-next-post').'</a> <a href="https://github.com/seb86/Auto-Load-Next-Post/wiki/" class="button button-secondary" target="_blank">'.__('Documentation', 'auto-load-next-post').'</a> <a href="https://autoloadnextpost.com/f-a-q/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" class="button" target="_blank">'.__('Frequently Asked Questions', 'auto-load-next-post').'</a></p>'
		));

		$screen->add_help_tab(array(
			'id'      => 'auto_load_next_post_bugs_tab',
			'title'   => __('Found a bug?', 'auto-load-next-post'),
			'content' =>
				'<h2>'.__('Found a bug?', 'auto-load-next-post').'</h2>'.
				'<p>'.sprintf(__('If you find a bug within %s, please <a href="%s" target="_blank">report the issue</a> by creating a ticket on the GitHub repository where we can deal with it more appropriately. Please ensure that you read the <a href="%s" target="_blank">contribution guidelines</a> prior to submitting your report. To help us solve the issue, please be as descriptive as possible.', 'auto-load-next-post'), 'Auto Load Next Post', 'https://github.com/seb86/Auto-Load-Next-Post/issues?state=open', 'https://github.com/seb86/Auto-Load-Next-Post/blob/master/CONTRIBUTING.md').'</p>'.
				'<p><a href="https://github.com/seb86/Auto-Load-Next-Post/issues?state=open" class="button button-primary" target="_blank">'.__('Report an Issue', 'auto-load-next-post').'</a></p>'
		));

		$screen->add_help_tab(array(
			'id'      => 'auto_load_next_post_feedback_tab',
			'title'   => __('Feedback', 'auto-load-next-post'),
			'content' =>
				'<h2>'.__('Feedback', 'auto-load-next-post').'</h2>'.
				'<p>'.__('Your feedback is very important to us. Please consider submitting a review on WordPress.org or complete a simple survey.', 'auto-load-next-post').'</p>'.
				'<p>'.sprintf(__('If %1$s has worked out for you well and you like it, please consider <a href="%2$s" target="_blank">making a donation</a>.', 'auto-load-next-post'), 'Auto Load Next Post', 'https://autoloadnextpost.com/donate/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab').'</p>'.
				'<p><a href="https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?filter=5#postform" class="button button-primary" target="_blank">'.__('Submit a Review', 'auto-load-next-post').'</a> <a href="https://sebd86.polldaddy.com/s/auto-load-next-post" class="button button-secondary" target="_blank">'.__('Complete a Survey', 'auto-load-next-post').'</a> <a href="https://autoloadnextpost.com/donate/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" class="button button-secondary" target="_blank">'.__('Make a Donation', 'auto-load-next-post').'</a></p>'
		));

		$screen->set_help_sidebar(
			'<p><strong>'.__('For more information:', 'auto-load-next-post').'</strong></p>'.
			'<p><a href="https://autoloadnextpost.com/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" target="_blank">'.sprintf(__('About %s', 'auto-load-next-post'), 'Auto Load Next Post').'</a></p>'.
			'<p><a href="https://wordpress.org/plugins/auto-load-next-post" target="_blank">'.__('WordPress.org Project', 'auto-load-next-post').'</a></p>'.
			'<p><a href="https://github.com/seb86/Auto-Load-Next-Post/" target="_blank">'.__('Github Project', 'auto-load-next-post').'</a></p>'
		);

	} // END add_help_tabs()

} // END Auto_Load_Next_Post_Admin_Help class.

} // END if class exists.

return new Auto_Load_Next_Post_Admin_Help();
