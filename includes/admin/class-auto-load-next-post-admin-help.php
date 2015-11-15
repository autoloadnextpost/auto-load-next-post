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

if(! defined('ABSPATH')) exit; // Exit if accessed directly

if(! class_exists('Auto_Load_Next_Post_Admin_Help')){

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
	public function __construct(){
		add_action('current_screen', array($this, 'add_help_tabs'), 50);
	} // END __construct()

	/**
	 * Adds help tabs to the plugin pages.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function add_help_tabs(){
		$screen = get_current_screen();

		if($screen->id != 'settings_page_auto-load-next-post-settings')
			return;

		$screen->add_help_tab(array(
			'id'      => 'auto_load_next_post_docs_tab',
			'title'   => __('Documentation', 'auto-load-next-post'),
			'content' =>
				'<p>'.sprintf(__('Thank you for using <strong>%1$s</strong> :) Should you need help using <strong>%1$s</strong> please read the documentation.', 'auto-load-next-post'), 'Auto Load Next Post').'</p>' .
				'<p><a href="https://github.com/seb86/Auto-Load-Next-Post/wiki/" class="button button-primary" target="_blank">'.sprintf(__('%s Documentation', 'auto-load-next-post'), 'Auto Load Next Post').'</a></p>'
		));

		$screen->add_help_tab(array(
			'id'      => 'auto_load_next_post_bugs_tab',
			'title'   => __('Found a bug?', 'auto-load-next-post'),
			'content' =>
				'<p>'.sprintf(__('If you find a bug within <strong>%s</strong> you can create a ticket via <a href="%s" target="_blank">Github issues</a>. Ensure you read the <a href="%s" target="_blank">contribution guide</a> prior to submitting your report. Be as descriptive as possible. Thank you.', 'auto-load-next-post'), 'Auto Load Next Post', 'https://github.com/seb86/Auto-Load-Next-Post/issues?state=open', 'https://github.com/seb86/Auto-Load-Next-Post/blob/master/CONTRIBUTING.md' ).'</p>' .
				'<p><a href="https://github.com/seb86/Auto-Load-Next-Post/issues?state=open" class="button button-primary" target="_blank">'.__('Report a bug', 'auto-load-next-post').'</a></p>'
		));

		$screen->set_help_sidebar(
			'<p><strong>'.__('For more information:', 'auto-load-next-post').'</strong></p>' .
			'<p><a href="http://autoloadnextpost.com" target="_blank">'.sprintf(__('About %s', 'auto-load-next-post'), 'Auto Load Next Post').'</a></p>' .
			'<p><a href="https://wordpress.org/plugins/auto-load-next-post" target="_blank">'.__('Project on WordPress.org', 'auto-load-next-post').'</a></p>' .
			'<p><a href="https://github.com/seb86/Auto-Load-Next-Post/" target="_blank">'.__('Project on Github', 'auto-load-next-post').'</a></p>'
		);

	} // END add_help_tabs()

} // END Auto_Load_Next_Post_Admin_Help class.

} // END if class exists.

return new Auto_Load_Next_Post_Admin_Help();
