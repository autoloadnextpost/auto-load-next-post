<?php
/**
 * Auto Load Next Post Extensions class
 *
 * Displays Extensions available for Auto Load Next Post hosted via WordPress.org
 *
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Classes
 * @package  Auto Load Next Post/Classes/Extensions
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Extensions' ) ) {

	class ALNP_Extensions {

		/**
		 * Extensions Var
		 * 
		 * @access public
		 * @static
		 */
		public static $extensions;

		/**
		 * Initialize Extensions.
		 *
		 * @access public
		 */
		public function __construct() {
			$this->id    = 'extensions';
			$this->label = esc_html__( 'Extensions', 'auto-load-next-post' );

			// Below are extensions hosted on WordPress.org
			self::$extensions = array(
				array(
					'slug' => 'alnp-facebook-pixel-tracking', // Facebook Pixel Tracking
				),
			);

			include_once( AUTO_LOAD_NEXT_POST_FILE_PATH . '/vendor/connekt-plugin-installer/class-connekt-plugin-installer.php'); // Plugin Installer

			add_filter( 'alnp_settings_tabs_array', array( $this, 'add_extensions_page' ), 99 );
			add_action( 'auto_load_next_post_settings_end', array( $this, 'output' ), 10, 2 );
		} // END __construct()

		/**
		 * Add the extensions page to the settings.
		 *
		 * @access public
		 * @param  array $pages
		 * @return array $pages
		 */
		public function add_extensions_page( $pages ) {
			$pages[$this->id] = $this->label;

			return $pages;
		} // END add_extensions_page()

		/**
		 * Output the extensions.
		 * 
		 * @access public
		 * @param string $current_tab
		 * @param array  $tabs
		 */
		public function output( $current_tab, $tabs ) {
			if ( $current_tab !== 'extensions' ) {
				return;
			}

			$tab_exists        = isset( $tabs[ $current_tab ] ) || has_action( 'auto_load_next_post_sections_' . $current_tab ) || has_action( 'auto_load_next_post_settings_' . $current_tab ) || has_action( 'auto_load_next_post_settings_tabs_' . $current_tab );
			$current_tab_label = isset( $tabs[ $current_tab ] ) ? $tabs[ $current_tab ] : '';
			?>
			<div class="wrap auto-load-next-post">
				<nav class="nav-tab-wrapper">
					<?php
					foreach ( $tabs as $slug => $label ) {
						echo '<a href="' . esc_html( admin_url( 'options-general.php?page=auto-load-next-post-settings&tab=' . esc_attr( $slug ) ) ) . '" class="nav-tab ' . ( $current_tab === $slug ? 'nav-tab-active' : '' ) . '">' . esc_html( $label ) . '</a>';
					}

					do_action( 'auto_load_next_post_settings_tabs' );
					?>
				</nav>
				<h1 class="screen-reader-text"><?php echo esc_html( $current_tab_label ); ?></h1>
			</div>

			<?php
			// Load the class if it exists and Airplane Mode is disabled.
			if ( class_exists( 'Connekt_Plugin_Installer' ) && ! alnp_airplane_mode_enabled() ) {
				Connekt_Plugin_Installer::init( self::$extensions );
			}
		} // END output()

	} // END class

} // END if class

return new ALNP_Extensions();