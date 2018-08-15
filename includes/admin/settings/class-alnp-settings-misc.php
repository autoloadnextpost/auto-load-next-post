<?php
/**
 * Auto Load Next Post Settings - Misc
 *
 * @since    1.5.0
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
		 * @since  1.5.0
		 * @access public
		 */
		public function __construct() {
			$this->id    = 'misc';
			$this->label = esc_html__( 'Misc', 'auto-load-next-post' );

			parent::__construct();

			add_action( 'auto_load_next_post_sections_misc', array( __CLASS__, 'no_comment_selector_set' ), 10 );
			add_action( 'auto_load_next_post_sections_' . $this->id, array( __CLASS__, 'is_monsterinsights_active' ), 10 );
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
		 * Displays a notification if MonsterInsights is active
		 * but the pageviews are not being tracked.
		 *
		 * @access public
		 * @static
		 * @since  1.5.0
		 */
		public static function is_monsterinsights_active() {
			$ga_tracking_enabled = get_option( 'auto_load_next_post_google_analytics' );

			if ( alnp_check_monster_insights() == 'yes' && empty( $ga_tracking_enabled ) ) {
				include( dirname( AUTO_LOAD_NEXT_POST_FILE ) . '/includes/admin/views/html-notice-monsterinsights.php' );
			}
		} // END is_monsterinsights_active()

		/**
		 * Get settings array
		 *
		 * @since  1.5.0
		 * @access public
		 * @return array
		 */
		public function get_settings() {
			return apply_filters(
				'auto_load_next_post_misc_settings', array(

					array(
						'title' => $this->label,
						'type'  => 'title',
						'desc'  => sprintf( esc_html__( 'Here you set if you want to track pageviews, remove comments and load %s javascript in the footer.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
						'id'    => 'misc_options'
					),

					array(
						'title'   => esc_html__( 'Remove Comments', 'auto-load-next-post' ),
						'desc'    => esc_html__( 'Enable to remove comments when each post loads including the initial post.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_remove_comments',
						'default' => 'yes',
						'type'    => 'checkbox'
					),

					array(
						'title'   => esc_html__( 'Update Google Analytics', 'auto-load-next-post' ),
						'desc'    => esc_html__( 'Enable to track each post the visitor is reading. This will count as a pageview. You must already have Google Analytics setup.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_google_analytics',
						'default' => 'no',
						'type'    => 'checkbox'
					),

					array(
						'title'   => esc_html__( 'JavaScript in Footer?', 'auto-load-next-post' ),
						'desc'    => esc_html__( 'Enable to load Auto Load Next Post in the footer instead of the header. Can be useful to optimize your site.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_js_footer',
						'default' => 'no',
						'type'    => 'checkbox'
					),

					array(
						'title'   => esc_html__( 'Reset all data?', 'auto-load-next-post' ),
						'desc'    => esc_html__( 'Press the reset button to clear all settings for this plugin and re-install the default settings.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_reset_data',
						'default' => 'no',
						'type'    => 'reset_data'
					),

					array(
						'title'   => esc_html__( 'Remove all data on uninstall?', 'auto-load-next-post' ),
						'desc'    => esc_html__( 'If enabled, all settings for this plugin will all be deleted when uninstalling via Plugins > Delete.', 'auto-load-next-post' ),
						'id'      => 'auto_load_next_post_uninstall_data',
						'default' => 'no',
						'type'    => 'checkbox'
					),

					array(
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
