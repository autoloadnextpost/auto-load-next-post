<?php
/**
 * Auto Load Next Post General Tab Settings
 *
 * @since    1.0.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */
if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly

if ( ! class_exists('Auto_Load_Next_Post_Settings_General_Tab')) {

/**
 * Class - Auto_Load_Next_Post_Settings_General_Tab
 *
 * @extends Auto_Load_Next_Post_Settings_Page
 * @since   1.0.0
 */
class Auto_Load_Next_Post_Settings_General_Tab extends Auto_Load_Next_Post_Settings_Page {

	private $customizer_url;

	/**
	 * Constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {
		$this->id    = 'general';
		$this->label = __('General', 'auto-load-next-post');

		$this->set_customizer_url();

		add_filter('auto_load_next_post_settings_submenu_array', array($this, 'add_menu_page'), 20);
		add_filter('auto_load_next_post_settings_tabs_array', array($this, 'add_settings_page'), 20);
		add_action('auto_load_next_post_settings_'.$this->id, array($this, 'output'));
		add_action('auto_load_next_post_settings_save_'.$this->id, array($this, 'save'));

		add_action('auto_load_next_post_admin_field_customize_button', array($this, 'customize_button'));
	} // END __construct()

	/**
	 * Save settings
	 *
	 * @since  1.0.0
	 * @access public
	 * @global $current_tab
	 */
	public function save() {
		global $current_tab;

		$settings = $this->get_settings();

		Auto_Load_Next_Post_Admin_Settings::save_fields($settings, $current_tab);
	} // END save()

	/**
	 * Get post types
	 *
	 * This returns a list of public registered post types.
	 *
	 * @since  1.3.2
	 * @access public
	 * @return array
	 */
	public function get_post_types() {
		$post_types = get_post_types(array('public' => true), 'names');

		return $post_types;
	} // END get_post_types()

	/**
	 * Get settings array
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_settings() {
		return apply_filters('auto_load_next_post_'.$this->id.'_settings', array(

			array(
				'title' => __('General', 'auto-load-next-post'),
				'type'  => 'title',
				'desc'  => sprintf(__('The variables below need to be set according to your active theme. This allows the plugin to identify the specific elements on the page. All are required in order for %s to work.', 'auto-load-next-post'), 'Auto Load Next Post'),
				'id'    => $this->id.'_options'
			),

			array(
				'title'       => __('Use the Customizer', 'auto-load-next-post'),
				'type'        => 'customize_button',
				'desc'        => __('If it helps makes things easier for you. You can use the customizer instead as you set up the plugin with your active theme.', 'auto-load-next-post'),
				'id'          => 'auto_load_next_post_customizer',
				'link'        => $this->customizer_url,
				'button_text' => __('Open the Customizer', 'auto-load-next-post'),
			),

			array(
				'title'    => __('Content Container', 'auto-load-next-post'),
				'desc'     => __('Example: <code>main.site-main</code>', 'auto-load-next-post'),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_content_container',
				'default'  => 'main.site-main',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'    => __('Post Title Selector', 'auto-load-next-post'),
				'desc'     => __('Example: <code>h1.entry-title</code>', 'auto-load-next-post'),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_title_selector',
				'default'  => 'h1.entry-title',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'    => __('Post Navigation Container', 'auto-load-next-post'),
				'desc'     => __('Example: <code>nav.post-navigation</code>', 'auto-load-next-post'),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_navigation_container',
				'default'  => 'nav.post-navigation',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'    => __('Previous Post Selector', 'auto-load-next-post'),
				'desc'     => __('Should you need to also identify the previous post link in the navigation, fill in this field. Example: <code>.nav-previous</code>', 'auto-load-next-post'),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_previous_post_selector',
				'default'  => '',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'    => __('Comments Container', 'auto-load-next-post'),
				'desc'     => __('Example: <code>div#comments</code>', 'auto-load-next-post'),
				'desc_tip' => true,
				'id'       => 'auto_load_next_post_comments_container',
				'default'  => 'div#comments',
				'type'     => 'text',
				'css'      => 'min-width:300px;',
				'autoload' => false
			),

			array(
				'title'   => __('Remove Comments', 'auto-load-next-post'),
				'desc'    => __('Enable to remove comments when each post loads.', 'auto-load-next-post'),
				'id'      => 'auto_load_next_post_remove_comments',
				'default' => 'yes',
				'type'    => 'checkbox'
			),

			array(
				'title'   => __('Update Google Analytics', 'auto-load-next-post'),
				'desc'    => __('Each time a post is loaded it will count as a pageview. You must have a reference to your Google Analytics tracking code on the page.', 'auto-load-next-post'),
				'id'      => 'auto_load_next_post_google_analytics',
				'default' => 'no',
				'type'    => 'checkbox'
			),

			array(
				'title'   => __('Reset all data?', 'auto-load-next-post'),
				'desc'    => __('Press the reset button to clear all settings for this plugin and re-install the default settings.', 'auto-load-next-post'),
				'id'      => 'auto_load_next_post_uninstall_data',
				'default' => 'no',
				'type'    => 'reset_data'
			),

			array(
				'title'   => __('Remove all data on uninstall?', 'auto-load-next-post'),
				'desc'    => __('If enabled, all settings for this plugin will all be deleted when uninstalling via Plugins > Delete.', 'auto-load-next-post'),
				'id'      => 'auto_load_next_post_uninstall_data',
				'default' => 'no',
				'type'    => 'checkbox'
			),

			array('type' => 'sectionend', 'id' => $this->id.'_options'),
		)); // End general settings
	} // END get_settings()

	/**
	 * Set the customizer url
	 *
	 * @since  1.5.0
	 * @access private
	 * @return bool
	 */
	private function set_customizer_url() {
		$url = admin_url('customize.php');

		$url = add_query_arg('alnp-customizer', 'yes', $url);

		$url = add_query_arg('url', urlencode( wp_nonce_url( site_url() . '/?alnp-customizer=yes', 'config-plugin' ) ), $url);

		$url = add_query_arg('return', urlencode( add_query_arg( array( 'page' => 'auto-load-next-post-settings', 'tab' => 'general' ), admin_url( 'options-general.php' ) ) ), $url);

		$this->customizer_url = esc_url_raw($url);

		return true;
	} // END set_customizer_url()

	/**
	 * Add a custom setting type
	 *
	 * @param mixed $settings
	 * @since 1.5.0
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

} // END class

} // END if class exists

return new Auto_Load_Next_Post_Settings_General_Tab();
