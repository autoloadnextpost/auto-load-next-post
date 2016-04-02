<?php
/**
 * Auto Load Next Post Admin.
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

if ( ! class_exists('Auto_Load_Next_Post_Admin')) {

/**
 * Class - Auto_Load_Next_Post_Admin
 *
 * @since 1.0.0
 */
class Auto_Load_Next_Post_Admin {

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {
		// Actions
		add_action('init', array($this, 'includes'), 10);
		add_action('admin_init', array($this, 'admin_scripts'), 100);

		// Filters
		add_filter('plugin_action_links_'.plugin_basename(AUTO_LOAD_NEXT_POST_FILE), array($this, 'action_links'));
		add_filter('plugin_row_meta', array($this, 'plugin_row_meta'), 10, 2);
		add_filter('admin_footer_text', array($this, 'admin_footer_text'));
		add_filter('update_footer', array($this, 'update_footer'), 15);
	} // END __construct()

	/**
	 * Plugin action links.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  mixed $links
	 * @return void
	 */
	public function action_links($links) {
		if (current_user_can('manage_options')) {
			$plugin_links = array(
				'<a href="https://autoloadnextpost.com/?utm_source=plugin&utm_medium=link&utm_campaign=plugins-page" target="_blank" style="color:green; font-weight:bold;">'.__('Upgrade to Premium', 'auto-load-next-post').'</a>',
				'<a href="'.admin_url('options-general.php?page=auto-load-next-post-settings').'">'.__('Settings', 'auto-load-next-post').'</a>',
				'<a href="'.admin_url('options-general.php?page=auto-load-next-post-settings&tab=support').'">'.__('Support', 'auto-load-next-post').'</a>',
			);

			return array_merge($plugin_links, $links);
		}

		return $links;
	} // END action_links()

	/**
	 * Plugin row meta links
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $input already defined meta links
	 * @param  string $file  plugin file path and name being processed
	 * @return array  $input
	 */
	public function plugin_row_meta($input, $file) {
		if (plugin_basename(AUTO_LOAD_NEXT_POST_FILE) !== $file) {
			return $input;
		}

		$links = array(
			'<a href="'.esc_url('https://github.com/seb86/Auto-Load-Next-Post/wiki/').'" target="_blank">'.__('Documentation', 'auto-load-next-post').'</a>',
			'<a href="'.esc_url('https://wordpress.org/support/plugin/auto-load-next-post').'" target="_blank">'.__('Community Support', 'auto-load-next-post').'</a>'
		);

		$input = array_merge($input, $links);

		return $input;
	} // END plugin_row_meta()

	/**
	 * Include any classes we need within admin.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function includes() {
		// Classes we only need if the ajax is not-ajax
		if ( ! auto_load_next_post_is_ajax()) {
			include('class-auto-load-next-post-install.php'); // Install Plugin
			include('class-auto-load-next-post-admin-menus.php'); // Plugin Menu
			include('class-auto-load-next-post-admin-notices.php'); // Plugin Notices
			include('class-auto-load-next-post-admin-help.php'); // Plugin Help Tab
		}
	} // END includes()

	/**
	 * Registers and enqueues stylesheets and javascripts
	 * for the administration panel.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function admin_scripts() {
		// Auto Load Next Post Main Javascript
		Auto_Load_Next_Post::load_file(AUTO_LOAD_NEXT_POST_SLUG.'_admin_script', '/assets/js/admin/auto-load-next-post'.AUTO_LOAD_NEXT_POST_SCRIPT_MODE.'.js', true, array('jquery'), AUTO_LOAD_NEXT_POST_VERSION);
		// Chosen
		Auto_Load_Next_Post::load_file('chosen', '/assets/js/libs/chosen/chosen.jquery'.AUTO_LOAD_NEXT_POST_SCRIPT_MODE.'.js', true, array('jquery'), AUTO_LOAD_NEXT_POST_VERSION);
		// TipTip
		Auto_Load_Next_Post::load_file('jquery-tiptip', '/assets/js/libs/jquery-tiptip/jquery.tipTip'.AUTO_LOAD_NEXT_POST_SCRIPT_MODE.'.js', true, array('jquery'), AUTO_LOAD_NEXT_POST_VERSION);
		// Variables for Admin JavaScripts
		wp_localize_script(AUTO_LOAD_NEXT_POST_SLUG.'_admin_script', 'auto_load_next_post_admin_params', array(
			'i18n_nav_warning' => __('The changes you made will be lost if you navigate away from this page.', 'auto-load-next-post'),
		));

		// Stylesheets
		Auto_Load_Next_Post::load_file(AUTO_LOAD_NEXT_POST_SLUG.'_admin_style', '/assets/css/admin/auto-load-next-post'.AUTO_LOAD_NEXT_POST_SCRIPT_MODE.'.css');
		Auto_Load_Next_Post::load_file(AUTO_LOAD_NEXT_POST_SLUG.'_chosen_style', '/assets/css/libs/chosen'.AUTO_LOAD_NEXT_POST_SCRIPT_MODE.'.css');
	} // END admin_scripts()

	/**
	 * Filters the admin footer text by placing links
	 * for the plugin including a simply thank you to
	 * review the plugin on WordPress.org.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $text
	 * @return string
	 */
	public function admin_footer_text($text) {
		$screen = get_current_screen();

		if ($screen->id == 'settings_page_auto-load-next-post-settings') {

			$links = array(
				'https://autoloadnextpost.com/?utm_source=wpadmin&utm_campaign=plugin-settings-footer' => __('Website', 'auto-load-next-post'),
				'https://github.com/seb86/Auto-Load-Next-Post/wiki/?utm_source=wpadmin&utm_campaign=plugin-settings-footer' => __('Documentation', 'auto-load-next-post'),
			);

			$text    = '';
			$counter = 0;

			foreach ($links as $key => $value) {
				$text .= '<a target="_blank" href="'.$key.'">'.$value.'</a>';

				if (count($links) > 1 && count($links) != $counter) {
					$text .= ' | ';
					$counter++;
				}
			}

			// Rating and Review
			$text .= sprintf(__('If you like <strong>%1$s</strong> please leave a <a href="%2$s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating on <a href="%2$s" target="_blank">WordPress.org</a>. A huge thank you in advance!', 'auto-load-next-post'), 'Auto Load Next Post', 'https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?filter=5#postform');

			return $text;
		}

		return $text;
	} // END admin_footer_text()

	/**
	 * Filters the update footer by placing details
	 * of the plugin and links to contribute or
	 * report issues with the plugin when viewing any
	 * of the plugin pages.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $text
	 * @return string $text
	 */
	public function update_footer($text) {
		$screen = get_current_screen();

		if ($screen->id == 'settings_page_auto-load-next-post-settings') {

			$text = '<span class="wrap">';

			$links = array(
				'https://github.com/seb86/Auto-Load-Next-Post/blob/master/CONTRIBUTING.md' => __('Contribute', 'auto-load-next-post'),
				'https://github.com/seb86/Auto-Load-Next-Post/issues/new' => __('Report an Issue', 'auto-load-next-post'),
			);

			foreach ($links as $key => $value) {
				$text .= '<a target="_blank" class="add-new-h2" href="'.$key.'">'.$value.'</a>';
			}

			$text .= '</span>'.'</p>'.
			'<p class="alignright">'.
			sprintf(__('%s Version', 'auto-load-next-post'), 'Auto Load Next Post').
			' : '.esc_attr(AUTO_LOAD_NEXT_POST_VERSION).'</p>';

			return $text;
		}

		return $text;
	} // END update_footer()

} // END class

} // END if class exists

return new Auto_Load_Next_Post_Admin();
