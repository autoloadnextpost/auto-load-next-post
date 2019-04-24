<?php
/**
 * Auto Load Next Post Settings - Templates Tab
 *
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post: Templates/Admin/Settings
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Settings_Templates_Tab' ) ) {

	class ALNP_Settings_Templates_Tab extends ALNP_Settings_Page {

		/**
		 * Constructor.
		 *
		 * @access public
		 */
		public function __construct() {
			$this->id    = 'templates';
			$this->label = esc_html__( 'Templates', 'alnp-templates' );

			parent::__construct();
		} // END __construct()

		/**
		 * Get settings array
		 *
		 * @access public
		 * @return array $settings
		 */
		public function get_settings() {
			$settings = array();

			$settings[] = array(
				'title' => $this->label,
				'type'  => 'title',
				'desc'  => esc_html__( 'WordPress Themes manage templates in many different ways that is unknowable for Auto Load Next Post to detect. To help with that, this extension provides a compatible repeater template which will ignore your themes templates to allow the content to be displayed without any coding knowledge. Theme templates can be either found in the parent folder of the theme or in a template folder. Depending on how many post types the theme supports you may find that the theme has categorized the templates in their own folder.', 'alnp-templates' ),
				'id'    => 'templates_options'
			);

			$settings[] = array(
				'title' => esc_html__( 'Template Locations', 'alnp-templates' ),
				'type'  => 'title',
				'desc'  => sprintf( __( 'Set the template locations for each post type if they are located in their own template folder. Otherwise just enter the template location for %1$sPosts%2$s.', 'alnp-templates' ), '<strong>', '</strong>' ),
				'id'    => 'template_locations'
			);

			foreach( self::get_post_types() as $post_type ) {
				$readonly = 'no';

				// Checks if the filter has been used already and disable posts only if true.
				if ( has_filter( 'alnp_template_location' ) && strtolower( $post_type ) == 'post' ) {
					$readonly = 'yes';
				}

				$settings[] = array(
					'title'       => ucfirst( $post_type ),
					'desc'        => sprintf( __( 'Enter the folder location where the theme template for %s are stored.', 'alnp-templates' ), $post_type ),
					'id'          => 'auto_load_next_post_template_location_' . strtolower( $post_type ),
					'default'     => '',
					'placeholder' => 'template-parts/',
					'readonly'    => $readonly,
					'type'        => 'text',
					'css'         => 'min-width:300px;',
					'autoload'    => false
				);
			}

			$settings[] = array(
				'type' => 'sectionend',
				'id'   => 'template_locations'
			);

			return $settings;
		} // END get_settings()

		/**
		 * This returns a list of public registered post types.
		 *
		 * @access public
		 * @return array $post_types
		 */
		public function get_post_types() {
			$post_types = array(
				'post' => 'Post'
			);

			// If Auto Load Next Post Pro is installed then return all public post types.
			if ( is_alnp_pro_version_installed() ) {
				$post_types = get_post_types( array( 'public' => true ), 'names' );
			}

			// Un-supported post types are unset.
			$post_types = self::unset_unsupported_post_types( $post_types );

			return $post_types;
		} // END get_post_types()

		/**
		 * Unsets un-supported post types.
		 *
		 * @access public
		 * @return array $post_types
		 */
		public function unset_unsupported_post_types( $post_types ) {
			unset( $post_types['elementor_library'] );
			unset( $post_types['tdb_templates'] );

			$post_types = apply_filters( 'alnp_unset_unsupported_post_types', $post_types );

			return $post_types;
		} // END unset_unsupported_post_types()

		/**
		 * Output the settings.
		 *
		 * @access public
		 */
		public function output() {
			$settings = $this->get_settings();

			ALNP_Admin_Settings::output_fields( $settings );
		} // END output()

		/**
		 * Save settings.
		 *
		 * @access public
		 * @global $current_tab
		 */
		public function save() {
			global $current_tab;

			$settings = $this->get_settings();

			ALNP_Admin_Settings::save_fields( $settings, $current_tab );
		} // END save()

	} // END class

} // END if class exists

return new ALNP_Settings_Templates_Tab();
