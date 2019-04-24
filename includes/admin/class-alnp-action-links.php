<?php
/**
 * Auto Load Next Post - Action Links.
 *
 * Adds links to Auto Load Next Post on the plugins page.
 *
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Action_Links' ) ) {

	class ALNP_Action_Links {

		/**
		 * Constructor
		 *
		 * @access public
		 */
		public function __construct() {
			add_filter( 'plugin_action_links_' . plugin_basename( AUTO_LOAD_NEXT_POST_FILE ), array( $this, 'plugin_action_links' ) );
			add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta'), 10, 3 );
		} // END __construct()

		/**
		 * Plugin action links.
		 *
		 * @access public
		 * @param  array $links An array of plugin links.
		 * @return array $links
		 */
		public function plugin_action_links( $links ) {
			if ( current_user_can( 'manage_options' ) ) {
				$action_links = array(
					'getting-started' => '<a href="' . add_query_arg( array( 'page' => 'auto-load-next-post', 'view' => 'getting-started' ), admin_url( 'options-general.php' ) ) . '" aria-label="' . sprintf( esc_attr__( 'Getting Started with %s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '">' . esc_attr__( 'Getting Started', 'auto-load-next-post' ) . '</a>',
					'settings'        => '<a href="' . add_query_arg( array( 'page' => 'auto-load-next-post' ), admin_url( 'options-general.php' ) ) . '" aria-label="' . sprintf( esc_attr__( 'View %s settings', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '">' . esc_attr__( 'Settings', 'auto-load-next-post' ) . '</a>'
				);

				return array_merge( $action_links, $links );
			}

			return $links;
		} // END plugin_action_links()

		/**
		 * Plugin row meta links
		 *
		 * @access public
		 * @param  array  $metadata An array of the plugin's metadata.
		 * @param  string $file     Path to the plugin file.
		 * @param  array  $data     Plugin Information
		 * @return array  $metadata
		 */
		public function plugin_row_meta( $metadata, $file, $data ) {
			if ( $file == plugin_basename( AUTO_LOAD_NEXT_POST_FILE ) ) {
				$metadata[ 1 ] = sprintf( __( 'Developed By %s', 'auto-load-next-post' ), '<a href="' . $data[ 'AuthorURI' ] . '" aria-label="' . esc_attr__( 'View the developers site', 'auto-load-next-post' ) . '">' . $data[ 'Author' ] . '</a>' );

				$campaign_args = array(
					'utm_medium'   => 'auto-load-next-post-lite',
					'utm_source'   => 'plugins-page',
					'utm_campaign' => 'plugins-row',
					'utm_content'  => 'go-pro',
				);

				$theme_support = add_query_arg( $campaign_args, AUTO_LOAD_NEXT_POST_STORE_URL . 'product/theme-support/' );

				$row_meta = array(
					'docs' => '<a href="' . esc_url( 'https://github.com/autoloadnextpost/alnp-documentation/tree/master/en_US#the-manual' ) . '" aria-label="' . sprintf( esc_attr__( 'View %s documentation', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '" target="_blank">' . esc_attr__( 'Documentation', 'auto-load-next-post' ) . '</a>',
					'community' => '<a href="' . esc_url( 'https://wordpress.org/support/plugin/auto-load-next-post' ) . '" aria-label="' . esc_attr__( 'Get support from the community', 'auto-load-next-post' ). '" target="_blank">' . esc_attr__( 'Community Support', 'auto-load-next-post' ) . '</a>',
					'theme-support' => '<a href="' . esc_url( $theme_support ) . '" attr-label="' . esc_attr__( 'Get theme support', 'auto-load-next-post' ) . '" target="_blank">' . esc_attr__( 'Theme Support', 'auto-load-next-post' ) . '</a>',
					'review' => '<a href="' . esc_url( AUTO_LOAD_NEXT_POST_REVIEW_URL ) . '" aria-label="' . sprintf( esc_attr__( 'Review %s on WordPress.org', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '" target="_blank">' . esc_attr__( 'Leave a Review', 'auto-load-next-post' ) . '</a>',
				);

				// Checks if Auto Load Next Post Pro has been installed.
				if ( ! is_alnp_pro_version_installed() ) {
					$store_url = add_query_arg( $campaign_args, AUTO_LOAD_NEXT_POST_STORE_URL . 'pro/' );

					$row_meta['pro'] = sprintf( '<a href="%1$s" aria-label="' . sprintf( esc_attr__( 'Sign up for %s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post Pro', 'auto-load-next-post' ) ) . '" target="_blank" style="color: #39b54a; font-weight: 700;">%2$s</a>', esc_url( $store_url ), esc_attr__( 'Pro Coming Soon', 'auto-load-next-post' ) );
				}

				$metadata = array_merge( $metadata, $row_meta );
			}

			return $metadata;
		} // END plugin_row_meta()

	} // END class

} // END if class exists

return new ALNP_Action_Links();
