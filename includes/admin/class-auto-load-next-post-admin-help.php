<?php
/**
 * Help is provided for this plugin on the plugin pages.
 *
 * @since    1.0.0
 * @version  1.5.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Auto_Load_Next_Post_Admin_Help' ) ) {

	class Auto_Load_Next_Post_Admin_Help {

		/**
		 * Constructor
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {
			add_action( 'current_screen', array( $this, 'add_help_tabs' ), 50 );
		} // END __construct()

		/**
		 * Adds help tabs to the plugin pages.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.5.0
		 */
		public function add_help_tabs() {
			$screen = get_current_screen();

			if (	$screen->id != 'settings_page_auto-load-next-post-settings') {
				return;
			}

			$screen->add_help_tab( array(
				'id'      => 'auto_load_next_post_docs_tab',
				'title'   => __( 'General Settings', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . __( 'General Settings', 'auto-load-next-post' ) . '</h2>' .
					'<p>' . sprintf( __( '%s requires theme selectors to match the active theme in order to detect the elements and let the magic happen.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</p>' .
					'<p>' . sprintf( __( 'When the plugin was activated, the theme selectors by default are set to WordPress theme standard unless the active theme supports %s and has set theme selectors of its own. If not and you are experiencing a problem, it is most likely that at least one of these selectors need to be changed. However, it could also be related with the theme template structure. For more information see Help and Support.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</p>' .
					'<p>' . sprintf( __( 'These are the default theme selectors when %s is installed.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</p>' .
					'<h5>' . __( 'Default Theme Selectors', 'auto-load-next-post' ) . '</h5>' .
					'<ul>' .
					'<li><strong>' . __( 'Content Container', 'auto-load-next-post' ) . '</strong>' . '<br>main.site-main</li>' .
					'<li><strong>' . __( 'Post Title', 'auto-load-next-post' ) . '</strong>' . '<br>h1.entry-title</li>' .
					'<li><strong>' . __( 'Post Navigation', 'auto-load-next-post' ) . '</strong>' . '<br>nav.post-navigation</li>' .
					'<li><strong>' . __( 'Comments Container', 'auto-load-next-post' ) . '</strong>' . '<br>div#comments</li>' .
					'</ul>'
			) );

			$screen->add_help_tab( array(
				'id'      => 'auto_load_next_post_support_tab',
				'title'   => __( 'Help & Support', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . __( 'Help & Support', 'auto-load-next-post' ) . '</h2>' .
					'<p>' . sprintf( __( 'Should you need help understanding, using, or extending %1$s, please <a href="%2$s" target="_blank">read the documentation</a>. You will find snippets, tutorials and much more.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), 'https://autoloadnextpost.com/documentation/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab' ) . '</p>' .
					'<p>' . sprintf( __( 'For further assistance with %1$s you can use the <a href="%2$s" target="_blank">community forum</a>.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), 'https://wordpress.org/support/plugin/auto-load-next-post' ) . '</p> ' .
					'<p>' . sprintf( __( '%1$s is in need of translations. Is the plugin not translated in your language or do you spot errors with the current translations? Helping out is easy! Head over to the project on WordPress.org and click <a href="%2$s" target="_blank">Translate %1$s</a>.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), 'https://translate.wordpress.org/projects/wp-plugins/auto-load-next-post' ) . '</p>' .
					'<p><a href="https://autoloadnextpost.com/documentation/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" class="button button-primary" target="_blank">' . __( 'Documentation', 'auto-load-next-post' ) . '</a> <a href="https://wordpress.org/support/plugin/auto-load-next-post" class="button button-secondary" target="_blank">' . __( 'Community Forum', 'auto-load-next-post' ) . '</a> <a href="https://autoloadnextpost.com/f-a-q/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" class="button" target="_blank">' . __( 'Frequently Asked Questions', 'auto-load-next-post' ) . '</a></p>'
			) );

			$screen->add_help_tab( array(
				'id'      => 'auto_load_next_post_bugs_tab',
				'title'   => __( 'Found a bug?', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . __( 'Found a bug?', 'auto-load-next-post' ) . '</h2>' .
					'<p>' . sprintf( __( 'If you find a bug within %s, please <a href="%s" target="_blank">report the issue</a> by creating a ticket on the GitHub repository where I can deal with it more appropriately. Please ensure that you have read the <a href="%s" target="_blank">guidelines to contributing</a> prior to submitting your report. To help me solve the issue, please be as descriptive as possible.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), 'https://github.com/AutoLoadNextPost/Auto-Load-Next-Post/issues?state=open', 'https://github.com/AutoLoadNextPost/Auto-Load-Next-Post/blob/master/CONTRIBUTING.md') . '</p>' .
					'<p><a href="https://github.com/AutoLoadNextPost/Auto-Load-Next-Post/issues?state=open" class="button button-primary" target="_blank">' . __( 'Report an Issue', 'auto-load-next-post' ) . '</a></p>'
			) );

			$screen->add_help_tab(array(
				'id'      => 'auto_load_next_post_feedback_tab',
				'title'   => __( 'Feedback', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . __( 'Feedback', 'auto-load-next-post' ) . '</h2>' .
					'<p>' . __( 'Your feedback is very important to me. Please consider leaving a review on WordPress.org or complete a simple survey.', 'auto-load-next-post' ) . '</p>' .
					'<p>' . sprintf( __( 'If %1$s has worked out for you well and you like it, please consider <a href="%2$s" target="_blank">making a donation</a>.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), 'https://autoloadnextpost.com/donate/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab' ) . '</p>'.
					'<p><a href="https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?filter=5#postform" class="button button-primary" target="_blank">' . __( 'Submit a Review', 'auto-load-next-post' ) . '</a> <a href="https://docs.google.com/forms/d/e/1FAIpQLSdzxlvnXRBIw8gqI7Z2O-HzYtncpGjDkLjlaeZLVsfrR61FNA/viewform?usp=sf_link" class="button button-secondary" target="_blank">' . __( 'Complete a Simple Survey', 'auto-load-next-post' ) . '</a> <a href="https://autoloadnextpost.com/donate/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" class="button button-secondary" target="_blank">' . __( 'Make a Donation', 'auto-load-next-post' ) . '</a></p>'
			) );

			$screen->set_help_sidebar(
				'<p><strong>' . __( 'For more information:', 'auto-load-next-post' ) . '</strong></p>' .
				'<p><a href="https://autoloadnextpost.com/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" target="_blank">' . sprintf( __( 'About %s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</a></p>' .
				'<p><a href="https://wordpress.org/plugins/auto-load-next-post" target="_blank">' . __( 'WordPress.org Project', 'auto-load-next-post' ) . '</a></p>' .
				'<p><a href="https://github.com/AutoLoadNextPost/Auto-Load-Next-Post/" target="_blank">' . __( 'Github Project', 'auto-load-next-post' ) . '</a></p>'
			);

		} // END add_help_tabs()

	} // END Auto_Load_Next_Post_Admin_Help class.

} // END if class exists.

return new Auto_Load_Next_Post_Admin_Help();
