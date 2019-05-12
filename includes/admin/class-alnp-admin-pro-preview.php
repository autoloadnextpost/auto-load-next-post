<?php
/**
 * Auto Load Next Post Pro Preview class
 *
 * Adds a preview of the options coming to the Pro release.
 *
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Classes
 * @package  Auto Load Next Post/Classes/Pro Preview
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Pro_Preview' ) ) {

	class ALNP_Pro_Preview {

		/**
		 * Initialize.
		 *
		 * @access public
		 */
		public function __construct() {
			add_filter( 'alnp_settings_tabs_array', array( $this, 'add_pro_tabs' ), 99 );
			add_filter( 'alnp_settings_tab_url', array( $this, 'hash'), 0, 2 );
		} // END __construct()

		/**
		 * Adds the settings tabs that will be available in Pro.
		 *
		 * @access public
		 * @param  array $pages
		 * @return array $pages
		 */
		public function add_pro_tabs( $pages ) {
			$pro_pages = array(
				'comments'        => __( 'Comments', 'auto-load-next-post' ),
				'load-and-scroll' => __( 'Load & Scroll', 'auto-load-next-post' ),
				'restrictions'    => __( 'Restrictions', 'auto-load-next-post' ),
				'query'           => __( 'Query', 'auto-load-next-post' ),
				'license'         => __( 'License', 'auto-load-next-post' ),
			);

			$pages = array_merge( $pages, $pro_pages );

			return $pages;
		} // END add_pro_tabs()

		/**
		 * Overrides the link used for the tab.
		 *
		 * @access public
		 * @param  string $url
		 * @param  string $slug
		 * @return string
		 */
		public function hash( $url, $slug ) {
			if ( ! in_array( $slug, array(
				'comments', 
				'load-and-scroll', 
				'restrictions', 
				'query', 
				'license'
			) ) ) {
				return $url;
			}

			return '#';
		} // END hash()

	} // END class

} // END if class

return new ALNP_Pro_Preview();