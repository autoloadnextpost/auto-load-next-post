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
		 * @param  string $current_view
		 * @param  array  $tabs
		 */
		public function output( $current_view, $tabs ) {
			if ( $current_view !== 'extensions' ) {
				return;
			}
			?>
			<div class="wrap auto-load-next-post">
				<?php
				// Include settings tabs.
				include_once( dirname( __FILE__ ) . '/views/html-admin-tabs.php' );
				?>
				<h1 class="screen-reader-text"><?php echo esc_html( $this->label ); ?></h1>

				<?php
				// Load the class if it exists and Airplane Mode is disabled.
				if ( class_exists( 'Connekt_Plugin_Installer' ) && ! alnp_airplane_mode_enabled() ) {
					Connekt_Plugin_Installer::init( self::$extensions );
				}
				?>
			</div>
			<?php
		} // END output()

	} // END class

} // END if class

return new ALNP_Extensions();