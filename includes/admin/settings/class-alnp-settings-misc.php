<?php
/**
 * Auto Load Next Post Settings - Misc
 *
 * @since    1.5.0
 * @version  1.5.5
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Settings
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
		 * @access  public
		 * @since   1.5.0
		 * @version 1.5.5
		 */
		public function __construct() {
			$this->id    = 'misc';
			$this->label = esc_html__( 'Misc', 'auto-load-next-post' );

			parent::__construct();

			add_filter( 'auto_load_next_post_mist_settings', array( __CLASS__, 'lock_js_in_footer' ), 0, 1 );
			add_action( 'auto_load_next_post_sections_misc', array( __CLASS__, 'no_comment_selector_set' ), 10 );
		} // END __construct()

		/**
		 * This notifies the user if the comment selector is NOT set.
		 *
		 * @access public
		 * @static
		 * @since  1.5.0
		 */
		public static function no_comment_selector_set() {
			$comments_container = get_option( 'auto_load_next_post_comments_container' );
			$remove_comments    = get_option( 'auto_load_next_post_remove_comments' );

			if ( empty( $comments_container ) && ! empty( $remove_comments ) ) {
				include( dirname( AUTO_LOAD_NEXT_POST_FILE ) . '/includes/admin/views/html-notice-no-comment-selector.php' );
			}
		} // END no_comment_selector_set()

		/**
		 * Checks if the theme locked the JavaScript to load in the footer 
		 * and filters the settings to remove the option so it can not 
		 * be unset by the user.
		 *
		 * @access  public
		 * @static
		 * @since   1.5.0
		 * @version 1.5.3
		 * @param   array $settings
		 * @return  array $settings
		 */
		public static function lock_js_in_footer( $settings ) {
			$js_locked_in_footer = get_option( 'auto_load_next_post_lock_js_in_footer' );

			if ( !empty( $js_locked_in_footer ) && $js_locked_in_footer == 'yes' ) {
				// Setting key to look for.
				$key = 'load_js_in_footer';

				// Find the setting.
				$find_setting = array_search( $key, $settings );

				// Does the setting exist?
				if ( is_bool( $find_setting ) === true ) {
					unset( $settings[$key] );
				}
			}

			return $settings;
		} // END lock_js_in_footer()
		
		/**
		 * Get settings array
		 *
		 * @access public
		 * @since  1.5.0
		 * @return array
		 */
		public function get_settings() {
			return apply_filters(
				'auto_load_next_post_misc_settings', array(

					'title' => array(
						'title' => $this->label,
						'type'  => 'title',
						'desc'  => sprintf( esc_html__( 'Here you set if you want to track pageviews, remove comments and load %s javascript in the footer.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
						'id'    => 'misc_options'
					),

					'remove_comments' => array(
						'title'   => esc_html__( 'Remove Comments', 'auto-load-next-post' ),
						'desc'    => esc_html__( 'Enable to remove comments when each post loads including the initial post.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_remove_comments',
						'default' => 'yes',
						'type'    => 'checkbox'
					),

					'google_analytics' => array(
						'title'   => esc_html__( 'Update Google Analytics', 'auto-load-next-post' ),
						'desc'    => esc_html__( 'Enable to track each post the visitor is reading. This will count as a pageview. You must already have Google Analytics setup.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_google_analytics',
						'default' => 'no',
						'type'    => 'checkbox'
					),

					'load_js_in_footer' => array(
						'title'   => esc_html__( 'JavaScript in Footer?', 'auto-load-next-post' ),
						'desc'    => esc_html__( 'Enable to load Auto Load Next Post in the footer instead of the header. Can be useful to optimize your site or if the current theme requires it.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_load_js_in_footer',
						'default' => 'no',
						'type'    => 'checkbox'
					),

					'reset_data' => array(
						'title'   => esc_html__( 'Reset all data?', 'auto-load-next-post' ),
						'desc'    => esc_html__( 'Press the reset button to clear all settings for this plugin and re-install the default settings.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_reset_data',
						'default' => 'no',
						'type'    => 'reset_data'
					),

					'uninstall' => array(
						'title'   => esc_html__( 'Remove all data on uninstall?', 'auto-load-next-post' ),
						'desc'    => esc_html__( 'If enabled, all settings for this plugin will all be deleted when uninstalling via Plugins > Delete.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_uninstall_data',
						'default' => 'no',
						'type'    => 'checkbox'
					),

					'section_end' => array(
						'type' => 'sectionend',
						'id'   => 'misc_options'
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
		 */
		public function save() {
			$settings = $this->get_settings();

			Auto_Load_Next_Post_Admin_Settings::save_fields( $settings );
		} // END save()

	} // END class

} // END if class exists

return new Auto_Load_Next_Post_Settings_Misc_Tab();
