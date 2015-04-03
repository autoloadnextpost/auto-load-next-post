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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Auto_Load_Next_Post_Admin' ) ) {

class Auto_Load_Next_Post_Admin {

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {
		// Actions
		add_action( 'init',              array( $this, 'includes' ) );

		// Filters
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );
		add_filter( 'update_footer',     array( $this, 'update_footer' ), 15 );
	} // END __construct()

	/**
	 * Include any classes we need within admin.
	 *
	 * @since  1.0.0
	 * @access public
	 * @filter auto_load_next_post_enable_admin_help_tab
	 */
	public function includes() {
		// Functions
		include( 'auto-load-next-post-admin-functions.php' );

		// Classes we only need if the ajax is not-ajax
		if ( ! is_ajax() ) {
			// Main Plugin
			include( 'class-auto-load-next-post-admin-menus.php' );

			// Plugin Help
			if ( apply_filters( 'auto_load_next_post_enable_admin_help_tab', true ) ) {
				include( 'class-auto-load-next-post-admin-help.php' );
			}
		}
	} // END includes()

	/**
	 * Filters the admin footer text by placing links
	 * for the plugin including a simply thank you to
	 * review the plugin on WordPress.org.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $text
	 * @filter auto_load_next_post_admin_footer_review_text
	 * @return string
	 */
	public function admin_footer_text( $text ) {
		$screen = get_current_screen();

		if ( in_array( $screen->id, auto_load_next_post_get_screen_ids() ) ) {

			$links = apply_filters( 'auto_load_next_post_admin_footer_text_links', array(
				Auto_Load_Next_Post()->web_url . '?utm_source=wpadmin&utm_campaign=footer' => __( 'Website', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				Auto_Load_Next_Post()->doc_url . '?utm_source=wpadmin&utm_campaign=footer' => __( 'Documentation', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
			) );

			$text    = '';
			$counter = 0;

			foreach ( $links as $key => $value ) {
				$text .= '<a target="_blank" href="' . $key . '">' . $value . '</a>';

				if( count( $links ) > 1 && count( $links ) != $counter ) {
					$text .= ' | ';
					$counter++;
				}
			}

			// Rating and Review added since 1.0.2
			if ( apply_filters( 'auto_load_next_post_admin_footer_review_text', true ) ) {
				$text .= sprintf( __( 'If you like <strong>%1$s</strong> please leave a <a href="%2$s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating on <a href="%2$s" target="_blank">WordPress.org</a>. A huge thank you in advance!', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ), Auto_Load_Next_Post()->name, Auto_Load_Next_Post()->wp_plugin_review_url );
			}

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
	 * @filter auto_load_next_post_update_footer_links
	 * @return string $text
	 */
	public function update_footer( $text ) {
		$screen = get_current_screen();

		if ( in_array( $screen->id, auto_load_next_post_get_screen_ids() ) ) {

			$text = '<span class="wrap">';

			$links = apply_filters( 'auto_load_next_post_update_footer_links', array(
				AUTO_LOAD_NEXT_POST_GITHUB_REPO_URI . 'blob/master/CONTRIBUTING.md?utm_source=wpadmin&utm_campaign=footer' => __( 'Contribute', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
				AUTO_LOAD_NEXT_POST_GITHUB_REPO_URI . 'issues?state=open&utm_source=wpadmin&utm_campaign=footer' => __( 'Report Bugs', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ),
			) );

			foreach( $links as $key => $value ) {
				$text .= '<a target="_blank" class="add-new-h2" href="' . $key . '">' . $value . '</a>';
			}

			$text .= '</span>' . '</p>'.
			'<p class="alignright">'.
			sprintf( __( '%s Version', AUTO_LOAD_NEXT_POST_TEXT_DOMAIN ), Auto_Load_Next_Post()->name ).
			' : ' . esc_attr( Auto_Load_Next_Post()->version ) . '</p>';

			return $text;
		}

		return $text;
	} // END update_footer()

} // END class

} // END if class exists

return new Auto_Load_Next_Post_Admin();
?>
