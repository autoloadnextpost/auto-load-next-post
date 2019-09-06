<?php
/**
 * Plugin Name: Auto Load Next Post
 * Plugin URI:  https://autoloadnextpost.com
 * Description: Increase your pageviews on your site as readers continue reading your posts scrolling down the page.
 * Author:      Sébastien Dumont
 * Author URI:  https://sebastiendumont.com
 * Version:     1.6.0-beta.1
 * Text Domain: auto-load-next-post
 * Domain Path: /languages/
 *
 * Copyright: © 2019 Sébastien Dumont, (mailme@sebastiendumont.com)
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package   Auto Load Next Post
 * @author    Sébastien Dumont
 * @copyright Copyright © 2019, Sébastien Dumont
 * @license   GNU General Public License v3.0 http://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * Main Auto Load Next Post Class
 *
 * The main instance of the plugin.
 */
if ( ! class_exists( 'Auto_Load_Next_Post' ) ) {

	class Auto_Load_Next_Post {

		/**
		 * @var Auto_Load_Next_Post - The single instance of the class
		 *
		 * @access protected
		 * @static
		 * @since  1.0.0
		 */
		protected static $_instance = null;

		/**
		 * Plugin Version
		 *
		 * @access public
		 * @static
		 * @since  1.5.0
		 */
		public static $version = '1.6.0-beta.1';

		/**
		 * Main Auto Load Next Post Instance
		 *
		 * Ensures only one instance of Auto Load Next Post is loaded or can be loaded.
		 *
		 * @access public
		 * @since  1.0.0
		 * @static
		 * @see    Auto_Load_Next_Post()
		 * @return Auto_Load_Next_Post Single instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		} // END instance()

		/**
		 * Cloning is forbidden.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, __( 'Cloning this object is forbidden.', 'auto-load-next-post' ), self::$version );
		} // END __clone()

		/**
		 * Unserializing instances of this class is forbidden.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is forbidden.', 'auto-load-next-post' ), self::$version );
		} // END __wakeup()

		/**
		 * Auto_Load_Next_Post Constructor
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.5.0
		 */
		public function __construct() {
			$this->setup_constants();
			$this->includes();
			$this->init_hooks();

			// Auto Load Next Post is fully loaded.
			do_action( 'auto_load_next_post_loaded' );
		} // END __construct()

		/**
		 * Hooks into action hooks.
		 *
		 * @access public
		 * @since  1.5.0
		 */
		public function init_hooks() {
			// Load translation files.
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

			// Load Auto Load Next Post scripts on the frontend.
			add_action( 'wp_enqueue_scripts', array( $this, 'alnp_enqueue_scripts' ) );
		} // END init_hooks()

		/**
		 * Setup Constants
		 *
		 * @access  private
		 * @since   1.4.3
		 * @version 1.5.12
		 */
		private function setup_constants() {
			$this->define('AUTO_LOAD_NEXT_POST_VERSION', self::$version);
			$this->define('AUTO_LOAD_NEXT_POST_FILE', __FILE__);
			$this->define('AUTO_LOAD_NEXT_POST_SLUG', 'auto-load-next-post');

			$this->define('AUTO_LOAD_NEXT_POST_URL_PATH', untrailingslashit( plugins_url( '/', __FILE__ ) ) );
			$this->define('AUTO_LOAD_NEXT_POST_FILE_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
			$this->define('AUTO_LOAD_NEXT_POST_TEMPLATE_PATH', 'auto-load-next-post/');
			$this->define('AUTO_LOAD_NEXT_POST_3RD_PARTY', AUTO_LOAD_NEXT_POST_FILE_PATH . '/includes/3rd-party/');

			$this->define('AUTO_LOAD_NEXT_POST_WP_VERSION_REQUIRE', '4.4');

			$suffix       = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
			$debug_suffix = defined('ALNP_DEV_DEBUG') && ALNP_DEV_DEBUG ? '.dev' : '';

			$this->define('AUTO_LOAD_NEXT_POST_SCRIPT_MODE', $suffix);
			$this->define('AUTO_LOAD_NEXT_POST_DEBUG_MODE', $debug_suffix);

			$this->define('AUTO_LOAD_NEXT_POST_STORE_URL', 'https://autoloadnextpost.com/');
			$this->define('AUTO_LOAD_NEXT_POST_PLUGIN_URL', 'https://wordpress.org/plugins/auto-load-next-post/');
			$this->define('AUTO_LOAD_NEXT_POST_SUPPORT_URL', 'https://wordpress.org/support/plugin/auto-load-next-post');
			$this->define('AUTO_LOAD_NEXT_POST_REVIEW_URL', 'https://wordpress.org/support/plugin/auto-load-next-post/reviews/');
			$this->define('AUTO_LOAD_NEXT_POST_DOCUMENTATION_URL', 'https://github.com/autoloadnextpost/alnp-documentation/tree/master/en_US#the-manual');
		} // END setup_constants()

		/**
		 * Define constant if not already set.
		 *
		 * @access private
		 * @since  1.4.3
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		} // END define()

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.6.0
		 * @return  void
		 */
		public function includes() {
			include_once( dirname( __FILE__ ) . '/includes/class-alnp-autoloader.php' ); // Autoloader.
			include_once( dirname( __FILE__ ) . '/includes/auto-load-next-post-deprecated-functions.php' ); // Deprecated functions.
			include_once( dirname( __FILE__ ) . '/includes/auto-load-next-post-conditional-functions.php' ); // Conditional functions.
			include_once( dirname( __FILE__ ) . '/includes/auto-load-next-post-formatting-functions.php' ); // Formatting functions.
			include_once( dirname( __FILE__ ) . '/includes/auto-load-next-post-themes-supported.php' ); // Handles all supported themes out of the box.
			include_once( dirname( __FILE__ ) . '/includes/auto-load-next-post-core-functions.php' ); // Contains core functions for the front/back end.
			include_once( dirname( __FILE__ ) . '/includes/auto-load-next-post-template-functions.php' ); // Template Functions
			include_once( dirname( __FILE__ ) . '/includes/auto-load-next-post-template-hooks.php' ); // Template Hooks

			// Include theme support.
			alnp_include_theme_support();

			// 3rd Party support.
			include_once( dirname( __FILE__ ) . '/includes/3rd-party/3rd-party.php' );

			// Customizer.
			include_once( dirname( __FILE__ ) . '/includes/customizer/class-alnp-customizer.php' );
			include_once( dirname( __FILE__ ) . '/includes/customizer/class-alnp-customizer-scripts.php' );

			// Ajax
			include_once( dirname( __FILE__ ) . '/includes/class-alnp-ajax.php' );

			// Include admin class to handle all back-end functions.
			if ( is_admin() ) {
				include_once( dirname( __FILE__ ) . '/includes/admin/class-alnp-admin.php' );
			}

			// Install.
			require_once( dirname( __FILE__ ) . '/includes/class-alnp-install.php' );
		} // END includes()

		/**
		 * Make the plugin translation ready.
		 *
		 * Translations should be added in the WordPress language directory:
		 *      - WP_LANG_DIR/plugins/auto-load-next-post-LOCALE.mo
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.4.10
		 * @return  void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'auto-load-next-post', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		} // END load_plugin_textdomain()

		/**
		 * Registers and enqueues stylesheets and javascripts for the front of the site.
		 *
		 * @access  public
		 * @since   1.3.2
		 * @version 1.6.0
		 */
		public function alnp_enqueue_scripts() {
			// Prevent enqueue scripts if feed, trackback or a preview of a post.
			if ( is_feed() || is_trackback() || is_preview() ) {
				return;
			}

			// Load the Javascript if found as a singluar post and the user is not a bot.
			if ( ! alnp_is_bot() && is_singular() && get_post_type() == 'post' ) {
				// This checks to see if the JavaScript should load in the footer or not.
				$load_in_footer = alnp_load_js_in_footer();

				// This checks to see if we should disable Auto Load Next Post from running on mobile devices.
				$disable_mobile = alnp_disable_on_mobile();

				$this->load_file( 'auto-load-next-post-scrollspy', '/assets/js/libs/scrollspy.min.js', true, array('jquery'), AUTO_LOAD_NEXT_POST_VERSION, $load_in_footer );

				// Only load History.js when not in the customizer.
				if ( ! is_customize_preview() ) {
					$this->load_file( 'auto-load-next-post-history', '/assets/js/libs/jquery.history.js', true, array('jquery'), AUTO_LOAD_NEXT_POST_VERSION, $load_in_footer );
				}

				$this->load_file( 'auto-load-next-post-script', '/assets/js/frontend/auto-load-next-post' . AUTO_LOAD_NEXT_POST_DEBUG_MODE.AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.js', true, array('auto-load-next-post-scrollspy'), AUTO_LOAD_NEXT_POST_VERSION, $load_in_footer );

				// Variables for the JavaScript
				wp_localize_script( 'auto-load-next-post-script', 'auto_load_next_post_params', array(
					'alnp_version'              => AUTO_LOAD_NEXT_POST_VERSION,
					'alnp_content_container'    => get_option( 'auto_load_next_post_content_container' ),
					'alnp_title_selector'       => get_option( 'auto_load_next_post_title_selector' ),
					'alnp_navigation_container' => get_option( 'auto_load_next_post_navigation_container' ),
					'alnp_comments_container'   => get_option( 'auto_load_next_post_comments_container' ),
					'alnp_remove_comments'      => get_option( 'auto_load_next_post_remove_comments' ),
					'alnp_google_analytics'     => get_option( 'auto_load_next_post_google_analytics' ),
					'alnp_event_on_load'        => get_option( 'auto_load_next_post_on_load_event' ),
					'alnp_event_on_entering'    => get_option( 'auto_load_next_post_on_entering_event' ),
					'alnp_is_customizer'        => $this->is_alnp_using_customizer(),
					'alnp_load_in_footer'       => $load_in_footer,
					'alnp_is_mobile'            => $this->is_mobile(),
					'alnp_disable_mobile'       => $disable_mobile
				) );
			} // END if is_singular() && get_post_type()
		} // END alnp_enqueue_scripts()

		/**
		 * Checks if we are using the theme customizer.
		 *
		 * @access public
		 * @since  1.5.0
		 * @static
		 * @return string|bool
		 */
		public static function is_alnp_using_customizer() {
			if ( is_customize_preview() ) {
				return "yes";
			}

			return false;
		} // END is_alnp_using_customizer()

		/**
		 * Check if the site is viewed on a mobile device.
		 *
		 * @access public
		 * @since  1.6.0
		 * @static
		 * @return string|bool
		 */
		public static function is_mobile() {
			if ( wp_is_mobile() ) {
				return "yes";
			}

			return false;
		} // END is_mobile()

		/**
		 * Helper function for registering and enqueueing scripts and styles.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.5.0
		 * @static
		 * @param   string  $name      The ID to register with WordPress.
		 * @param   string  $file_path The path to the actual file.
		 * @param   bool    $is_script Optional, argument for if the incoming file_path is a JavaScript source file.
		 * @param   array   $support   Optional, for requiring other javascripts for the source file you are calling.
		 * @param   string  $version   Optional, can match the version of the plugin or version of the source file.
		 * @param   bool    $footer Optional, can set the JavaScript to load in the footer instead.
		 */
		public static function load_file( $name, $file_path, $is_script = false, $support = array(), $version = '', $footer = false ) {
			$url = AUTO_LOAD_NEXT_POST_URL_PATH . $file_path; // URL to the file.

			if ( file_exists( AUTO_LOAD_NEXT_POST_FILE_PATH . $file_path ) ) {
				if ( $is_script ) {
					if ( !wp_script_is( $name, 'registered' ) ) {
						wp_register_script( $name, $url, $support, $version, $footer );
						wp_enqueue_script( $name );
					}
				} else {
					if ( !wp_style_is( $name, 'registered' ) ) {
						wp_register_style( $name, $url );
						wp_enqueue_style( $name );
					}
				} // end if
			} // end if

		} // END load_file()

	} // END Auto_Load_Next_Post()

} // END class exists 'Auto_Load_Next_Post'

return Auto_Load_Next_Post::instance();
