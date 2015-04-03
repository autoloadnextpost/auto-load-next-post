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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Auto_Load_Next_Post_Admin_Help' ) ) {

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
	 * @return void
	 */
	public function __construct() {
		add_action( 'current_screen', array( $this, 'add_help_tabs' ), 50 );
	} // END __construct()

	/**
	 * Adds help tabs to the plugin pages.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function add_help_tabs() {
		$screen = get_current_screen();

		if ( ! in_array( $screen->id, auto_load_next_post_get_screen_ids() ) )
			return;

		$screen->add_help_tab( array(
			'id'      => 'auto_load_next_post_docs_tab',
			'title'   => __( 'Documentation', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
			'content' =>
				'<p>' . sprintf( __( 'Thank you for using <strong>%s</strong> :) Should you need help using or extending %s please read the documentation.', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ), Auto_Load_Next_Post()->name, Auto_Load_Next_Post()->name ) . '</p>' .
				'<p><a href="' . Auto_Load_Next_Post()->doc_url . '" class="button button-primary">' . sprintf( __( '%s Documentation', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ), Auto_Load_Next_Post()->name ) . '</a></p>'
		) );

		$screen->add_help_tab( array(
			'id'      => 'auto_load_next_post_support_tab',
			'title'   => __( 'Support', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
			'content' =>
				'<p>' . sprintf( __( 'After <a href="%s">reading the documentation</a>, for further assistance you can use the <a href="%s">community forum</a>.', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ), Auto_Load_Next_Post()->doc_url, Auto_Load_Next_Post()->wp_plugin_support_url ) . '</p>' .
				'<p><a href="' . Auto_Load_Next_Post()->wp_plugin_support_url . '" class="button button-primary">' . __( 'Community Support', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ) . '</a></p>'
		) );

		$screen->add_help_tab( array(
			'id'      => 'auto_load_next_post_bugs_tab',
			'title'   => __( 'Found a bug?', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
			'content' =>
				'<p>' . sprintf( __( 'If you find a bug within <strong>%s</strong> you can create a ticket via <a href="%s">Github issues</a>. Ensure you read the <a href="%s">contribution guide</a> prior to submitting your report. Be as descriptive as possible. Thank you.', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ), Auto_Load_Next_Post()->name, AUTO_LOAD_NEXT_POST_GITHUB_REPO_URI . 'issues?state=open', AUTO_LOAD_NEXT_POST_GITHUB_REPO_URI . 'blob/master/CONTRIBUTING.md' ) . '</p>' .
				'<p><a href="' . AUTO_LOAD_NEXT_POST_GITHUB_REPO_URI . 'issues?state=open" class="button button-primary">' . __( 'Report a bug', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ) . '</a></p>'
		) );

		if ( !empty( Auto_Load_Next_Post()->web_url ) || !empty( Auto_Load_Next_Post()->wp_plugin_url ) || defined( AUTO_LOAD_NEXT_POST_GITHUB_REPO_URI ) ) {
			$screen->set_help_sidebar(
				'<p><strong>' . __( 'For more information:', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ) . '</strong></p>' .
				'<p><a href="' . Auto_Load_Next_Post()->web_url . '" target="_blank">' . sprintf( __( 'About %s', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ), Auto_Load_Next_Post()->name ) . '</a></p>' .
				'<p><a href="' . Auto_Load_Next_Post()->wp_plugin_url . '" target="_blank">' . __( 'Project on WordPress.org', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ) . '</a></p>' .
				'<p><a href="' . AUTO_LOAD_NEXT_POST_GITHUB_REPO_URI . '" target="_blank">' . __( 'Project on Github', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ) . '</a></p>'
			);
		}

	} // END add_help_tabs()

} // END Auto_Load_Next_Post_Admin_Help class.

} // END if class exists.

return new Auto_Load_Next_Post_Admin_Help();
?>
