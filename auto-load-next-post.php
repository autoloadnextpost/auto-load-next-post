<?php
/*
 * Plugin Name:       Auto Load Next Post
 * Plugin URI:        https://github.com/seb86/Auto-Load-Next-Post
 * Description:       Auto loads the next post as you scroll down the post. Also replaces the URL address and the page title with the next post.
 * Version:           1.0.0
 * Author:            Sébastien Dumont
 * Author URI:        http://www.sebastiendumont.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-plugin-boilerplate-light
 * Domain Path:       languages
 * Network:           false
 * GitHub Plugin URI: https://github.com/seb86/Auto-Load-Next-Post
 *
 * Auto Load Next Post is distributed under the terms of the
 * GNU General Public License as published by the Free Software Foundation,
 * either version 2 of the License, or any later version.
 *
 * Auto Load Next Post is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Auto Load Next Post.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Auto_Load_Next_Post
 * @author  Sébastien Dumont
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Auto_Load_Next_Post' ) ) {

/**
 * Main Auto Load Next Post Class
 *
 * @since 1.0.0
 */
final class Auto_Load_Next_Post {

	/**
	 * The single instance of the class
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    object
	 */
	protected static $_instance = null;

	/**
	 * Slug
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $plugin_slug = 'auto-load-next-post';

	/**
	 * Text Domain
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $text_domain = 'auto-load-next-post';

	/**
	 * The Auto Load Next Post.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $name = "Auto Load Next Post";

	/**
	 * The Plugin Version.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $version = "1.0.0";

	/**
	 * The WordPress version the plugin requires minumum.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $wp_version_min = "4.0";

	/**
	 * The Plugin URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $web_url = "http://www.sebastiendumont.com/plugins/auto-load-next-post/";

	/**
	 * The Plugin documentation URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $doc_url = "https://github.com/seb86/Auto-Load-Next-Post/wiki/";

	/**
	 * The WordPress.org Plugin URI.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     string
	 */
	public $wp_plugin_url = "https://wordpress.org/plugins/auto-load-next-post";

	/**
	 * The WordPress.org Plugin Support URI.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     string
	 */
	public $wp_plugin_support_url = "https://wordpress.org/support/plugin/auto-load-next-post";
	/**
	 * The WordPress.org Plugin Review URI.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     string
	 */
	public $wp_plugin_review_url = 'https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?filter=5#postform';

	/**
	 * GitHub Repo URI
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $github_repo_url = "https://github.com/seb86/Auto-Load-Next-Post/";

	/**
	 * The Plugin menu name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $menu_name = "Auto Load Next Post";

	/**
	 * The Plugin title page name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $title_name = "Auto Load Next Post";

	/**
	 * Manage Plugin.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $manage_plugin = "manage_options";

	/**
	 * Main Auto Load Next Post Instance
	 *
	 * Ensures only one instance of Auto Load Next Post is loaded or can be loaded.
	 *
	 * @since  1.0.0
	 * @access public static
	 * @see    Auto_Load_Next_Post()
	 * @return Auto Load Next Post instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new Auto_Load_Next_Post;
		}
		return self::$_instance;
	} // END instance()

	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'auto-load-next-post' ), $this->version );
	} // END __clone()

	/**
	 * Disable unserializing of the class
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'auto-load-next-post' ), $this->version );
	} // END __wakeup()

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {
		// Auto-load classes on demand
		if ( function_exists( "__autoload" ) )
			spl_autoload_register( "__autoload" );

		spl_autoload_register( array( $this, 'autoload' ) );

		// Define constants
		$this->define_constants();

		// Check plugin requirements
		$this->check_requirements();

		// Include required files
		$this->includes();

		// Hooks
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
		add_filter( 'plugin_row_meta',                                    array( $this, 'plugin_row_meta' ), 10, 2 );
		add_action( 'init',                                               array( $this, 'init_auto_load_next_post' ), 0 );

		// Loaded action
		do_action( 'auto_load_next_post_loaded' );
	} // END __construct()

	/**
	 * Plugin action links.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  mixed $links
	 * @return void
	 */
	public function action_links( $links ) {
		if( current_user_can( $this->manage_plugin ) ) {
			$plugin_links = array(
				'<a href="' . admin_url( 'options-general.php?page=auto-load-next-post-settings' ) . '">' . __( 'Settings', 'auto-load-next-post' ) . '</a>',
				'<a href="' . $this->wp_plugin_support_url . '" target="_blank">' . __( 'Support', 'auto-load-next-post' ) . '</a>'
			);

			return array_merge( $plugin_links, $links );
		}
		return $links;
	} // END action_links()

	/**
	 * Plugin row meta links
	 *
	 * @filter auto_load_next_post_about_text_link
	 * @filter auto_load_next_post_documentation_url
	 * @since  1.0.0
	 * @access public
	 * @param  array  $input already defined meta links
	 * @param  string $file  plugin file path and name being processed
	 * @return array  $input
	 */
	public function plugin_row_meta( $input, $file ) {
		if ( plugin_basename( __FILE__ ) !== $file ) {
			return $input;
		}

		$links = array(
			'<a href="' . esc_url( apply_filters( 'auto_load_next_post_documentation_url', $this->doc_url ) ) . '">' . __( 'Documentation', 'auto-load-next-post' ) . '</a>',
		);

		$input = array_merge( $input, $links );

		return $input;
	} // END plugin_row_meta()

	/**
	 * Auto-load Auto Load Next Post classes on demand to reduce memory consumption.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  mixed $class
	 * @return void
	 */
	public function autoload( $class ) {
		$path  = null;
		$file  = strtolower( 'class-' . str_replace( '_', '-', $class ) ) . '.php';

		if ( strpos( $class, 'auto_load_next_post_admin' ) === 0 ) {
			$path = $this->plugin_path() . '/includes/admin/';
		}
		if ( $path && is_readable( $path . $file ) ) {
			include_once( $path . $file );
			return;
		}

		// Fallback
		if ( strpos( $class, 'auto_load_next_post_' ) === 0 ) {
			$path = $this->plugin_path() . '/includes/';
		}

		if ( $path && is_readable( $path . $file ) ) {
			include_once( $path . $file );
			return;
		}
	} // END autoload()

	/**
	 * Define Constants
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function define_constants() {
		if ( ! defined( 'AUTO_LOAD_NEXT_POST' ) )                       define( 'AUTO_LOAD_NEXT_POST', $this->name );
		if ( ! defined( 'AUTO_LOAD_NEXT_POST_FILE' ) )                  define( 'AUTO_LOAD_NEXT_POST_FILE', __FILE__ );
		if ( ! defined( 'AUTO_LOAD_NEXT_POST_VERSION' ) )               define( 'AUTO_LOAD_NEXT_POST_VERSION', $this->version );
		if ( ! defined( 'AUTO_LOAD_NEXT_POST_WP_VERSION_REQUIRE' ) )    define( 'AUTO_LOAD_NEXT_POST_WP_VERSION_REQUIRE', $this->wp_version_min );
		if ( ! defined( 'AUTO_LOAD_NEXT_POST_SCREEN_ID' ) )             define( 'AUTO_LOAD_NEXT_POST_SCREEN_ID', 'auto-load-next-post-settings' );
		if ( ! defined( 'AUTO_LOAD_NEXT_POST_SLUG' ) )                  define( 'AUTO_LOAD_NEXT_POST_SLUG', $this->plugin_slug );
		if ( ! defined( 'AUTO_LOAD_NEXT_POST_TEXT_DOMAIN' ) )           define( 'AUTO_LOAD_NEXT_POST_TEXT_DOMAIN', $this->text_domain );
		if ( ! defined( 'AUTO_LOAD_NEXT_POST_DEFAULT_SETTINGS_TAB' ) )  define( 'AUTO_LOAD_NEXT_POST_DEFAULT_SETTINGS_TAB', 'general');
		if ( ! defined( 'AUTO_LOAD_NEXT_POST_GITHUB_REPO_URI' ) )       define( 'AUTO_LOAD_NEXT_POST_GITHUB_REPO_URI', $this->github_repo_url );

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		if ( ! defined( 'AUTO_LOAD_NEXT_POST_SCRIPT_MODE' ) )           define( 'AUTO_LOAD_NEXT_POST_SCRIPT_MODE', $suffix );

	} // END define_constants()

	/**
	 * Checks that the WordPress setup meets the plugin requirements.
	 *
	 * @since  1.0.0
	 * @access private
	 * @global string $wp_version
	 * @return bool
	 */
	private function check_requirements() {
		global $wp_version;

		if ( ! version_compare( $wp_version, AUTO_LOAD_NEXT_POST_WP_VERSION_REQUIRE, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'display_req_notice' ) );
			return false;
		}

		return true;
	} // END check_requirements()

	/**
	 * Display the requirement notice.
	 *
	 * @since  1.0.0
	 * @access static
	 */
	static function display_req_notice() {
		echo '<div id="message" class="error"><p><strong>';
		echo sprintf( __('Sorry, %s requires WordPress ' . AUTO_LOAD_NEXT_POST_WP_VERSION_REQUIRE . ' or higher. Please upgrade your WordPress setup', 'auto-load-next-post'), AUTO_LOAD_NEXT_POST );
		echo '</strong></p></div>';
	} // END display_req_notice()

	/**
	 * Include required core files used in admin and on the frontend.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function includes() {
		include_once( 'includes/auto-load-next-post-core-functions.php' ); // Contains core functions for the front/back end.

		if ( is_admin() ) {
			$this->admin_includes();
		}
	} // END includes()

	/**
	 * Include required admin files.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_includes() {
		include_once( 'includes/admin/class-auto-load-next-post-install.php' ); // Install plugin
		include_once( 'includes/admin/class-auto-load-next-post-admin.php' );   // Admin section
	} // END admin_includes()

	/**
	 * Runs when the plugin is initialized.
	 *
	 * @since  1.0.0
	 * @access public
	 * @filter auto_load_next_post_force_ssl_filter
	 */
	public function init_auto_load_next_post() {
		add_rewrite_endpoint( 'partial', EP_PERMALINK );

		flush_rewrite_rules();

		// Set up localisation
		$this->load_plugin_textdomain();

		// Load JavaScript and stylesheets
		$this->register_scripts_and_styles();
	} // END init_auto_load_next_post()

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any
	 * following ones if the same translation is present.
	 *
	 * @since  1.0.0
	 * @access public
	 * @filter auto_load_next_post_languages_directory
	 * @filter plugin_locale
	 * @return void
	 */
	public function load_plugin_textdomain() {
		// Set filter for plugin's languages directory
		$lang_dir = dirname( plugin_basename( AUTO_LOAD_NEXT_POST_FILE ) ) . '/languages/';
		$lang_dir = apply_filters( 'auto_load_next_post_languages_directory', $lang_dir );

		// Traditional WordPress plugin locale filter
		$locale = apply_filters( 'plugin_locale',  get_locale(), $this->text_domain );
		$mofile = sprintf( '%1$s-%2$s.mo', $this->text_domain, $locale );

		// Setup paths to current locale file
		$mofile_local  = $lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/' . $this->text_domain . '/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/auto-load-next-post/ folder
			load_textdomain( $this->text_domain, $mofile_global );
		}
		else if ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/auto-load-next-post/languages/ folder
			load_textdomain( $this->text_domain, $mofile_local );
		}
		else {
			// Load the default language files
			load_plugin_textdomain( $this->text_domain, false, $lang_dir );
		}
	} // END load_plugin_textdomain()

	/** Helper functions ******************************************************/

	/**
	 * Get the plugin url.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	} // END plugin_url()

	/**
	 * Get the plugin path.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	} // END plugin_path()

	/**
	 * Registers and enqueues stylesheets and javascripts
	 * for the administration panel and the front of the site.
	 *
	 * @since  1.0.0
	 * @access private
	 * @filter auto_load_next_post_admin_params
	 * @filter auto_load_next_post_params
	 */
	private function register_scripts_and_styles() {
		if ( is_admin() ) {
			$this->load_file( $this->plugin_slug . '_admin_script', '/assets/js/admin/auto-load-next-post' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.js', true, array('jquery'), $this->version );

			// TipTip
			$this->load_file( 'jquery-tiptip', '/assets/js/jquery-tiptip/jquery.tipTip' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.js', true, array('jquery'), $this->version );

			// Variables for Admin JavaScripts
			wp_localize_script( $this->plugin_slug . '_admin_script', 'auto_load_next_post_admin_params', apply_filters( 'auto_load_next_post_admin_params', array(
				'plugin_url'       => $this->plugin_url(),
				'i18n_nav_warning' => __( 'The changes you made will be lost if you navigate away from this page.', 'auto-load-next-post' ),
				'plugin_screen_id' => AUTO_LOAD_NEXT_POST_SCREEN_ID,
			) ) );

			// Stylesheets
			$this->load_file( $this->plugin_slug . '_admin_style', '/assets/css/admin/auto-load-next-post' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.css' );
		}
		else {
			//if ( is_singular() ) {
				$this->load_file( $this->plugin_slug . '-scrollspy', '/assets/js/frontend/scrollspy' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.js', true, array('jquery'), $this->version );
				$this->load_file( $this->plugin_slug . '-history', '/assets/js/frontend/jquery.history.js', true, array('jquery'), $this->version );
				$this->load_file( $this->plugin_slug . '-script', '/assets/js/frontend/auto-load-next-post' . AUTO_LOAD_NEXT_POST_SCRIPT_MODE . '.js', true, array( $this->plugin_slug . '-scrollspy' ), $this->version );

				// Variables for JS scripts
				wp_localize_script( $this->plugin_slug . '-script', 'auto_load_next_post_params', apply_filters( 'auto_load_next_post_params', array(
					'alnp_content_container'      => get_option( 'auto_load_next_post_content_container' ),
					'alnp_title_selector'         => get_option( 'auto_load_next_post_title_selector' ),
					'alnp_navigation_container'   => get_option( 'auto_load_next_post_navigation_container' ),
					'alnp_comments_container'     => get_option( 'auto_load_next_post_comments_container' ),
					'alnp_google_analytics'       => get_option( 'auto_load_next_post_google_analytics' ),
				) ) );
			//} // END if is_singular()
		} // end if/else
	} // END register_scripts_and_styles()

	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @since  1.0.0
	 * @access private
	 * @param  string  $name      The ID to register with WordPress.
	 * @param  string  $file_path The path to the actual file.
	 * @param  bool    $is_script Optional, argument for if the incoming file_path is a JavaScript source file.
	 * @param  array   $support   Optional, for requiring other javascripts for the source file you are calling.
	 * @param  string  $version   Optional, can match the version of the plugin or version of the source file.
	 * @global string  $wp_version
	 */
	private function load_file( $name, $file_path, $is_script = false, $support = array(), $version = '' ) {
		global $wp_version;

		$url  = $this->plugin_url() . $file_path;
		$file = $this->plugin_path() . $file_path;

		if ( file_exists( $file ) ) {
			if ( $is_script ) {
				wp_register_script( $name, $url, $support, $version );
				wp_enqueue_script( $name );
			}
			else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
			} // end if
		} // end if

	} // END load_file()

} // END Auto_Load_Next_Post()

} // END class_exists('Auto_Load_Next_Post')

/**
 * Returns the instance of Auto_Load_Next_Post to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return Auto Load Next Post
 */
function Auto_Load_Next_Post() {
	return Auto_Load_Next_Post::instance();
}

// Global for backwards compatibility.
$GLOBALS["auto_load_next_post"] = Auto_Load_Next_Post();
?>
