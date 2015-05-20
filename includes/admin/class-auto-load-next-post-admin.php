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
		add_action( 'init',              array( $this, 'includes' ), 0 );
		add_action( 'admin_init',        array( $this, 'register_scripts_and_styles' ), 10 );

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
		if ( ! auto_load_next_post_is_ajax() ) {
			// Main Plugin
			include( 'class-auto-load-next-post-admin-menus.php' );
			include( 'class-auto-load-next-post-admin-notices.php' );

			// Plugin Help
			if ( apply_filters( 'auto_load_next_post_enable_admin_help_tab', true ) ) {
				include( 'class-auto-load-next-post-admin-help.php' );
			}
		}
	} // END includes()

	/**
	 * Registers and enqueues stylesheets and javascripts
	 * for the administration panel.
	 *
	 * @since  1.0.0
	 * @access public
	 * @filter auto_load_next_post_admin_params
	 */
	public function register_scripts_and_styles() {
		Auto_Load_Next_Post()->load_file( Auto_Load_Next_Post()->plugin_slug . '_admin_script', '/assets/js/admin/auto-load-next-post' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.js', true, array('jquery'), Auto_Load_Next_Post()->version );

		// Chosen
		Auto_Load_Next_Post()->load_file( 'chosen', '/assets/js/chosen/chosen.jquery' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.js', true, array('jquery'), Auto_Load_Next_Post()->version );

		// TipTip
		Auto_Load_Next_Post()->load_file( 'jquery-tiptip', '/assets/js/jquery-tiptip/jquery.tipTip' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.js', true, array('jquery'), Auto_Load_Next_Post()->version );

		// Variables for Admin JavaScripts
		wp_localize_script( Auto_Load_Next_Post()->plugin_slug . '_admin_script', 'auto_load_next_post_admin_params', apply_filters( 'auto_load_next_post_admin_params', array(
			'plugin_url'       => Auto_Load_Next_Post()->plugin_url(),
			'i18n_nav_warning' => __( 'The changes you made will be lost if you navigate away from this page.', 'auto-load-next-post' ),
			'plugin_screen_id' => AUTO_LOAD_NEXT_POST_SCREEN_ID,
		) ) );

		// Stylesheets
		Auto_Load_Next_Post()->load_file( Auto_Load_Next_Post()->plugin_slug . '_admin_style', '/assets/css/admin/auto-load-next-post' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.css' );

		Auto_Load_Next_Post()->load_file( Auto_Load_Next_Post()->plugin_slug . '_chosen_style', '/assets/css/chosen' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.css' );

	} // END register_scripts_and_styles()

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

			// Rating and Review
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
