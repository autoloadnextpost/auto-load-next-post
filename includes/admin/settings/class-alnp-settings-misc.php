<?php
/**
 * Auto Load Next Post Settings - Misc
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Auto_Load_Next_Post_Settings_Misc_Tab' ) ) {

	class Auto_Load_Next_Post_Settings_Misc_Tab extends Auto_Load_Next_Post_Settings_Page {

		private $customizer_url;

		/**
		 * Constructor.
		 *
		 * @since  1.5.0
		 * @access public
		 */
		public function __construct() {
			$this->id    = 'misc';
			$this->label = __( 'Misc', 'auto-load-next-post' );

			parent::__construct();
		} // END __construct()

		/**
		 * Get settings array
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function get_settings() {
			return apply_filters(
				'auto_load_next_post_misc_settings', array(

					array(
						'title' => __( 'Misc', 'auto-load-next-post' ),
						'type'  => 'title',
						'desc'  => '',
						'id'    => 'misc_options'
					),

					array(
						'title'   => __( 'Remove Comments', 'auto-load-next-post' ),
						'desc'    => __( 'Enable to remove comments when each post loads including the initial post.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_remove_comments',
						'default' => 'yes',
						'type'    => 'checkbox'
					),

					array(
						'title'   => __( 'Update Google Analytics', 'auto-load-next-post' ),
						'desc'    => __( 'Each time a post has loaded and is in view it will count as a pageview. Must have reference to Google Analytics tracking code on the site.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_google_analytics',
						'default' => 'no',
						'type'    => 'checkbox'
					),

					array(
						'title'   => __( 'JavaScript in Footer?', 'auto-load-next-post' ),
						'desc'    => __( 'Enable to load Auto Load Next Post in the footer instead of the header.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_js_footer',
						'default' => 'no',
						'type'    => 'checkbox'
					),

					array(
						'title'   => __( 'Reset all data?', 'auto-load-next-post' ),
						'desc'    => __( 'Press the reset button to clear all settings for this plugin and re-install the default settings.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_reset_data',
						'default' => 'no',
						'type'    => 'reset_data'
					),

					array(
						'title'   => __( 'Remove all data on uninstall?', 'auto-load-next-post' ),
						'desc'    => __( 'If enabled, all settings for this plugin will all be deleted when uninstalling via Plugins > Delete.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_uninstall_data',
						'default' => 'no',
						'type'    => 'checkbox'
					),

					array(
						'type' => 'sectionend',
						'id' => 'misc_options'
					),
				)
			); // End misc settings
		} // END get_settings()

		/**
		 * Add button for setting type.
		 *
		 * @since 1.5.0
		 * @param mixed $settings
		 */
		public function customize_button( $settings ) {
			?>
			<tr valign="top">
				<th scope="row" class="titledesc"><?php echo $settings['title'];?></th>
				<td class="forminp forminp-<?php echo sanitize_title( $settings['type'] ) ?>">
					<a href="<?php echo $settings['link']; ?>" class="button-secondary <?php echo esc_attr( $settings['class'] ); ?>">
						<?php echo $settings['button_text']; ?>
					</a>
					<span class="description"><?php echo $settings['desc'];?></span>
				</td>
			</tr>
			<?php

			return true;
		} // END customizer_button()

		/**
		 * Output the settings.
		 *
		 * @access public
		 * @since  1.5.0
		 */
		public function output() {
			$settings = $this->get_settings();

			Auto_Load_Next_Post_Admin_Settings::output_fields( $settings );
		} // END output()

		/**
		 * Save settings.
		 *
		 * @access public
		 * @since  1.5.0
		 * @global $current_tab
		 */
		public function save() {
			global $current_tab;

			$settings = $this->get_settings();

			Auto_Load_Next_Post_Admin_Settings::save_fields( $settings, $current_tab );
		} // END save()

	} // END class

} // END if class exists

return new Auto_Load_Next_Post_Settings_Misc_Tab();
