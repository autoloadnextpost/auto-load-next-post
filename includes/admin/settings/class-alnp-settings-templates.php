<?php
/**
 * Auto Load Next Post Settings - Templates
 *
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Settings
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Settings_Templates' ) ) {

	class ALNP_Settings_Templates extends ALNP_Settings_Page {

		/**
		 * Constructor.
		 *
		 * @access public
		 */
		public function __construct() {
			$this->id    = 'templates';
			$this->label = esc_html__( 'Templates', 'auto-load-next-post' );

			parent::__construct();

			add_action( 'auto_load_next_post_settings_templates', array( __CLASS__, 'template_location' ), 0 );
		} // END __construct()

		/**
		 * Displays a notification to the user if the templates 
		 * location was found and where or if the templates was 
		 * not found.
		 *
		 * @access public
		 * @static
		 */
		public static function template_location() {
			include( dirname( AUTO_LOAD_NEXT_POST_FILE ) . '/includes/admin/views/html-notice-template-location.php' );
		} // END template_location()

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
				'desc'  => sprintf( __( 'This helps fine tune %1$s to locate your theme templates in order to display content in the same style as your theme. Set the template location for each post type if they are located in their own template folder. Otherwise just enter the template location for %2$sPosts%3$s.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<strong>', '</strong>' ),
				'id'    => 'templates_options'
			);

			$locate_single = alnp_get_template();

			// Only show fallback support option if template location was found. May be required should theme structure fail.
			if ( ! empty( $locate_single ) ) {
				$settings[] = array(
					'title'   => esc_html__( 'Use Fallback?', 'auto-load-next-post' ),
					'desc'    => sprintf( __( 'Enabling this will force the use of fallback support should your active theme not have a great structure. %1$sSee help for more information%2$s.', 'auto-load-next-post' ), '<strong class="red">', '</strong>' ),
					'id'      => 'auto_load_next_post_use_fallback',
					'default' => 'no',
					'type'    => 'checkbox'
				);
			}

			foreach( self::get_post_types() as $post_type ) {
				$readonly = 'no';

				// Checks if the filter has been used already and disable posts only if true.
				if ( has_filter( 'alnp_template_location' ) && strtolower( $post_type ) == 'post' ) {
					$readonly = 'yes';
				}

				$settings[] = array(
					'title'       => ucfirst( $post_type ),
					'desc'        => sprintf( __( 'Enter the folder location where the theme template for %s are stored.', 'auto-load-next-post' ), $post_type ),
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
		 * @global $current_view
		 */
		public function save() {
			global $current_view;

			$settings = $this->get_settings();

			ALNP_Admin_Settings::save_fields( $settings, $current_view );
		} // END save()

	} // END class

} // END if class exists

return new ALNP_Settings_Templates();
