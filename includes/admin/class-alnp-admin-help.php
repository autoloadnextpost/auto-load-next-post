<?php
/**
 * Auto Load Next Post: Help Tab.
 *
 * Adds a help tab to the settings page providing useful
 * and helpful information for the users.
 *
 * @since    1.0.0
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Help
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Admin_Help' ) ) {

	class ALNP_Admin_Help {

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
		 * @version 1.6.0
		 */
		public function add_help_tabs() {
			$screen    = get_current_screen();
			$screen_id = $screen ? $screen->id : '';

			if ( $screen_id != 'settings_page_auto-load-next-post' ) {
				return;
			}

			$screen->add_help_tab( array(
				'id'      => 'auto_load_next_post_support_tab',
				'title'   => esc_html__( 'Help & Support', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . esc_html__( 'Help & Support', 'auto-load-next-post' ) . '</h2>' .

					'<p>' . sprintf( __( 'Should you need help understanding, using, or extending %1$s, please %2$sread the documentation%3$s. You will find snippets, tutorials and much more.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="' . esc_url( AUTO_LOAD_NEXT_POST_DOCUMENTATION_URL ) . '" aria-label="' . esc_attr__( 'View Auto Load Next Post documentation', 'auto-load-next-post' ) . '" target="_blank">', '</a>' ) . '</p>' .

					'<p>' . sprintf( __( 'For further assistance with %1$s you can use the %2$scommunity forum%3$s.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="'. esc_url( AUTO_LOAD_NEXT_POST_SUPPORT_URL ) . '"aria-label="' . esc_attr__( 'Get support from the community', 'auto-load-next-post' ). '" target="_blank">', '</a>' ) . '</p> ' .

					'<p>' . sprintf( __( '%1$s is in need of translations. Is the plugin not translated in your language or do you spot errors with the current translations? Helping out is easy! Head over to the project on WordPress.org and click %2$sTranslate %1$s%3$s.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="https://translate.wordpress.org/projects/wp-plugins/auto-load-next-post" target="_blank">', '</a>' ) . '</p>' .

					'<p><a href="' . esc_url( AUTO_LOAD_NEXT_POST_DOCUMENTATION_URL ) . '" class="button button-primary" aria-label="' . esc_attr__( 'View Auto Load Next Post documentation', 'auto-load-next-post' ) . '" target="_blank">' . esc_html__( 'Documentation', 'auto-load-next-post' ) . '</a> <a href="'. esc_url( AUTO_LOAD_NEXT_POST_SUPPORT_URL ) . '" class="button button-secondary" aria-label="' . esc_attr__( 'Get support from the community', 'auto-load-next-post' ). '" target="_blank">' . esc_html__( 'Community Forum', 'auto-load-next-post' ) . '</a> <a href="' . esc_url( AUTO_LOAD_NEXT_POST_PLUGIN_URL . '#faq' ) . '" class="button button-secondary" target="_blank">' . esc_html__( 'Frequently Asked Questions', 'auto-load-next-post' ) . '</a> <a href="https://translate.wordpress.org/projects/wp-plugins/auto-load-next-post" class="button button-secondary" target="_blank">' . sprintf( esc_html__( 'Translate %s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</a></p>'
			) );

			$screen->add_help_tab( array(
				'id'      => 'auto_load_next_post_theme_selectors_tab',
				'title'   => __( 'Theme Selectors', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . __( 'Theme Selectors', 'auto-load-next-post' ) . '</h2>' .

					'<p>' . sprintf(
						__( 'Theme Selectors allows %s know where to load the content in, which post is being read, the next post to load and whether to show or hide comments per post.', 'auto-load-next-post' ),
						esc_html__( 'Auto Load Next Post', 'auto-load-next-post' )
					) . '</p>' .

					'<p>' . sprintf(
						__( 'Each theme is different so in order for %1$s to work, the theme selectors must be set according to the theme you currently have active for each section.', 'auto-load-next-post' ),
						esc_html__( 'Auto Load Next Post', 'auto-load-next-post' )
					) . '</p>' .

					'<p>' . sprintf(
						__( 'When %1$s is activated, default theme selectors are set for you. These theme selectors are the most commonly used in any WordPress theme. If they don’t work for your theme then you need to find the matching theme selectors.', 'auto-load-next-post' ),
						esc_html__( 'Auto Load Next Post', 'auto-load-next-post' )
					) . '</p>' .

					'<p>' . sprintf(
						__( 'If the theme you have active supports %s then it will set the theme selectors for you and display a notice on the theme selectors page.', 'auto-load-next-post' ),
						esc_html__( 'Auto Load Next Post', 'auto-load-next-post' )
					) . '</p>' .

					'<h3 class="alnp-default-theme-selectors">' . esc_html__( 'Default Theme Selectors', 'auto-load-next-post' ) . '</h3>' .

					'<ul class="alnp-default-theme-selectors">' .
						'<li><strong>' . esc_html__( 'Content Container', 'auto-load-next-post' ) . '</strong>' . ' <code>main.site-main</code></li>' .
						'<li><strong>' . esc_html__( 'Post Title', 'auto-load-next-post' ) . '</strong>' . ' <code>h1.entry-title</code></li>' .
						'<li><strong>' . esc_html__( 'Post Navigation', 'auto-load-next-post' ) . '</strong>' . ' <code>nav.post-navigation</code></li>' .
						'<li><strong>' . esc_html__( 'Comments Container', 'auto-load-next-post' ) . '</strong>' . ' <code>div#comments</code></li>' .
					'</ul>' .

					'<p><a href="https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/theme-selectors.md#how-to-find-your-theme-selectors" class="button button-primary" target="_blank">' . esc_html__( 'How to find your theme selectors', 'auto-load-next-post' ) . '</a></p>'
			) );

			$screen->add_help_tab( array(
				'id'      => 'auto_load_next_post_templates_tab',
				'title'   => __( 'Templates', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . __( 'Templates', 'auto-load-next-post' ) . '</h2>' .

					'<p>' . sprintf(
						__( 'Every WordPress theme manages there %1$sTemplate Hierarchy%2$s in there own way. This makes it a little difficult for Auto Load Next Post to auto detect the appropriate template location. If the appropriate template was not detected then %3$s will automatically use a fallback template in order to display your sites content while your viewers scroll.', 'auto-load-next-post' ), '<a href="https://developer.wordpress.org/themes/basics/template-hierarchy/" target="_blank">', '</a>',
						esc_html__( 'Auto Load Next Post', 'auto-load-next-post' )
					) . '</p>' .

					'<p>' . sprintf( __( 'By providing an accurate location to your theme\'s template, %1$s will then use your theme\'s template instead and will display your content matching the theme\'s design.' , 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' )
					) . '</p>' .

					'<p><a href="https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/content-and-structure.md" class="button button-primary" target="_blank">' . esc_html__( 'Content and Structure', 'auto-load-next-post' ) . '</a></p>'
			) );

			$screen->add_help_tab( array(
				'id'      => 'auto_load_next_post_bugs_tab',
				'title'   => esc_html__( 'Found a bug?', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . esc_html__( 'Found a bug?', 'auto-load-next-post' ) . '</h2>' .

					'<p>' . sprintf( __( 'If you find a bug within %1$s core you can create a ticket via %2$sGithub issues%4$s. Ensure you read the %3$scontribution guide%4$s prior to submitting your report. To help me solve your issue, please be as descriptive as possible.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="https://github.com/autoloadnextpost/auto-load-next-post/issues?state=open" target="_blank">', '<a href="https://github.com/autoloadnextpost/auto-load-next-post/blob/master/CONTRIBUTING.md" target="_blank">', '</a>' ) . '</p>' .

					'<p><a href="https://github.com/autoloadnextpost/auto-load-next-post/issues?state=open" class="button button-primary" target="_blank">' . esc_html__( 'Report a bug', 'auto-load-next-post' ) . '</a></p>'
			) );

			$screen->add_help_tab( array(
				'id'      => 'auto_load_next_post_feedback_tab',
				'title'   => esc_html__( 'Contribute', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . esc_html__( 'Contribute', 'auto-load-next-post' ) . '</h2>' .

					'<p>' . sprintf( __( 'If you or your company use %1$s, please consider supporting me directly so I can continue maintaining it and keep evolving the project.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</p>' .

					'<p>' . esc_html__( 'You\'ll be helping to ensure I can spend the time not just fixing bugs, adding features or releasing new versions but also keeping the project afloat. Any contribution you make is a big help and is greatly appreciated.', 'auto-load-next-post' ) . '</p>' .

					'<p>' . sprintf( __( 'Your review of the plugin is also important as it will help others decide to use %s so please consider leaving a review on WordPress.org', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</p>' .

					'<p><a href="' . esc_url( AUTO_LOAD_NEXT_POST_REVIEW_URL ) . '" class="button button-primary" target="_blank" aria-label="' . esc_attr( __( 'Review Auto Load Next Post on WordPress.org', 'auto-load-next-post' ) ) . '">' . esc_html__( 'Leave a Review', 'auto-load-next-post' ) . '</a> <a href="https://sebdumont.xyz/donate/" class="button button-secondary" target="_blank">' . esc_html__( 'Support the Developer', 'auto-load-next-post' ) . '</a></p>'
			) );

			$screen->set_help_sidebar(
				'<p><strong>' . esc_html__( 'For more information:', 'auto-load-next-post' ) . '</strong></p>' .

				'<p><a href="' . esc_url( AUTO_LOAD_NEXT_POST_STORE_URL ) . 'about/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" target="_blank">' . sprintf( esc_html__( 'About %s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</a></p>' .

				'<p><a href="' . esc_url( AUTO_LOAD_NEXT_POST_PLUGIN_URL ) . '" target="_blank">' . esc_html__( 'WordPress.org Project', 'auto-load-next-post' ) . '</a></p>' .

				'<p><a href="https://github.com/autoloadnextpost/auto-load-next-post/" target="_blank">' . esc_html__( 'GitHub Project', 'auto-load-next-post' ) . '</a></p>'
			);

		} // END add_help_tabs()

	} // END ALNP_Admin_Help class.

} // END if class exists.

return new ALNP_Admin_Help();
