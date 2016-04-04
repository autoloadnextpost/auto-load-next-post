<?php
/*
 * Plugin Name:       Auto Load Next Post
 * Plugin URI:        https://autoloadnextpost.com
 * Description:       Auto loads the next post as you scroll down to the end of a post. Replaces the URL in the address bar and the page title when viewing the next post.
 * Version:           1.4.7
 * Author:            Sébastien Dumont
 * Author URI:        https://sebastiendumont.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       auto-load-next-post
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
if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly

if ( ! class_exists('Auto_Load_Next_Post')) {

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
	 * @access private
	 * @var    object
	 */
	private static $_instance = null;

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
		if (is_null(self::$_instance)) {
			self::$_instance = new Auto_Load_Next_Post;
			self::$_instance->setup_constants();
			self::$_instance->load_plugin_textdomain();
			self::$_instance->includes();
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
		_doing_it_wrong(__FUNCTION__, __('Cheatin’ huh?', 'auto-load-next-post'), AUTO_LOAD_NEXT_POST_VERSION);
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
		_doing_it_wrong(__FUNCTION__, __('Cheatin’ huh?', 'auto-load-next-post'), AUTO_LOAD_NEXT_POST_VERSION);
	} // END __wakeup()

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {
		// Auto-load classes on demand
		if (function_exists("__autoload")) {
			spl_autoload_register("__autoload");
		}

		spl_autoload_register(array($this, 'autoload'));

		// Hooks
		add_action('init', array($this, 'init_auto_load_next_post'), 0);
		add_action('wp_enqueue_scripts', array($this, 'front_scripts_and_styles'));
	} // END __construct()

	/**
	 * Auto-load Auto Load Next Post classes on demand to reduce memory consumption.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  mixed $class
	 * @return void
	 */
	public function autoload($class) {
		$path  = null;
		$file  = strtolower('class-'.str_replace('_', '-', $class)).'.php';

		if (strpos($class, 'auto_load_next_post_admin') === 0) {
			$path = AUTO_LOAD_NEXT_POST_FILE_PATH.'/includes/admin/';
		} else if (strpos($class, 'auto_load_next_post_') === 0) {
			$path = AUTO_LOAD_NEXT_POST_FILE_PATH.'/includes/';
		}

		if ($path !== null && is_readable($path.$file)) {
			include_once($path.$file);
			return true;
		}
	} // END autoload()

	/**
	 * Setup Constants
	 *
	 * @since  1.4.3
	 * @access private
	 */
	private function setup_constants() {
		$this->define('AUTO_LOAD_NEXT_POST_VERSION', '1.4.7');
		$this->define('AUTO_LOAD_NEXT_POST_FILE', __FILE__);
		$this->define('AUTO_LOAD_NEXT_POST_SLUG', 'auto-load-next-post');

		$this->define('AUTO_LOAD_NEXT_POST_URL_PATH', untrailingslashit(plugins_url('/', __FILE__)));
		$this->define('AUTO_LOAD_NEXT_POST_FILE_PATH', untrailingslashit(plugin_dir_path(__FILE__)));
		$this->define('AUTO_LOAD_NEXT_POST_TEMPLATE_PATH', 'auto-load-next-post/');

		$this->define('AUTO_LOAD_NEXT_POST_WP_VERSION_REQUIRE', '4.0');

		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		$this->define('AUTO_LOAD_NEXT_POST_SCRIPT_MODE', $suffix);
	} // END setup_constants()

	/**
	 * Define constant if not already set.
	 *
	 * @param  string $name
	 * @param  string|bool $value
	 * @access private
	 * @since  1.4.3
	 */
	private function define($name, $value) {
		if ( ! defined($name)) {
			define($name, $value);
		}
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function includes() {
		include_once('includes/auto-load-next-post-core-functions.php'); // Contains core functions for the front/back end.

		if (is_admin()) {
			include_once('includes/admin/class-auto-load-next-post-admin.php'); // Admin section
		}
	} // END includes()

	/**
	 * Runs when the plugin is initialized.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function init_auto_load_next_post() {
		add_rewrite_endpoint('partial', EP_PERMALINK);

		// Refresh permalinks
		flush_rewrite_rules();
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
		$lang_dir = dirname(plugin_basename(AUTO_LOAD_NEXT_POST_FILE)).'/languages/';
		$lang_dir = apply_filters('auto_load_next_post_languages_directory', $lang_dir);

		// Traditional WordPress plugin locale filter
		$locale = apply_filters('plugin_locale', get_locale(), 'auto-load-next-post');
		$mofile = sprintf('%1$s-%2$s.mo', 'auto-load-next-post', $locale);

		// Setup paths to current locale file
		$mofile_local  = $lang_dir.$mofile;
		$mofile_global = WP_LANG_DIR.'/auto-load-next-post/'.$mofile;

		if (file_exists($mofile_global)) {
			// Look in global /wp-content/languages/auto-load-next-post/ folder
			load_textdomain('auto-load-next-post', $mofile_global);
		} else if (file_exists($mofile_local)) {
			// Look in local /wp-content/plugins/auto-load-next-post/languages/ folder
			load_textdomain('auto-load-next-post', $mofile_local);
		} else {
			// Load the default language files
			load_plugin_textdomain('auto-load-next-post', false, $lang_dir);
		}
	} // END load_plugin_textdomain()

	/**
	 * Registers and enqueues stylesheets and javascripts for the front of the site.
	 *
	 * @since  1.3.2
	 * @access public
	 */
	public function front_scripts_and_styles() {
		/**
		 * Load the Javascript if found as a singluar post.
		 */
		if (supports_alnp() && is_singular() && get_post_type() == 'post') {
			$this->load_file('auto-load-next-post-scrollspy', '/assets/js/libs/scrollspy'.AUTO_LOAD_NEXT_POST_SCRIPT_MODE.'.js', true, array('jquery'), AUTO_LOAD_NEXT_POST_VERSION);
			$this->load_file('auto-load-next-post-history', '/assets/js/libs/jquery.history.js', true, array('jquery'), AUTO_LOAD_NEXT_POST_VERSION);
			$this->load_file('auto-load-next-post-script', '/assets/js/frontend/auto-load-next-post'.AUTO_LOAD_NEXT_POST_SCRIPT_MODE.'.js', true, array('auto-load-next-post-scrollspy'), AUTO_LOAD_NEXT_POST_VERSION);

			// Variables for JS scripts
			wp_localize_script('auto-load-next-post-script', 'auto_load_next_post_params', array(
				'alnp_content_container'    => get_option('auto_load_next_post_content_container'),
				'alnp_title_selector'       => get_option('auto_load_next_post_title_selector'),
				'alnp_navigation_container' => get_option('auto_load_next_post_navigation_container'),
				'alnp_comments_container'   => get_option('auto_load_next_post_comments_container'),
				'alnp_remove_comments'      => get_option('auto_load_next_post_remove_comments'),
				'alnp_google_analytics'     => get_option('auto_load_next_post_google_analytics'),
			));
		} // END if is_singular() && get_post_type()
	} // END register_scripts_and_styles()

	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @since  1.0.0
	 * @access public static
	 * @param  string  $name      The ID to register with WordPress.
	 * @param  string  $file_path The path to the actual file.
	 * @param  bool    $is_script Optional, argument for if the incoming file_path is a JavaScript source file.
	 * @param  array   $support   Optional, for requiring other javascripts for the source file you are calling.
	 * @param  string  $version   Optional, can match the version of the plugin or version of the source file.
	 * @global string  $wp_version
	 */
	public static function load_file($name, $file_path, $is_script = false, $support = array(), $version = '') {
		global $wp_version;

		$url = AUTO_LOAD_NEXT_POST_URL_PATH.$file_path; // URL to the file.

		if (file_exists(AUTO_LOAD_NEXT_POST_FILE_PATH.$file_path)) {
			if ($is_script) {
				wp_register_script($name, $url, $support, $version);
				wp_enqueue_script($name);
			} else {
				wp_register_style($name, $url);
				wp_enqueue_style($name);
			} // end if
		} // end if

	} // END load_file()

} // END Auto_Load_Next_Post()

} // END class exists 'Auto_Load_Next_Post'

/**
 * This runs the plugin if the required PHP version has been met.
 */
function run_auto_load_next_post() {
	return Auto_Load_Next_Post::instance();
} // END run_auto_load_next_post()

// Fetch the Php version checker.
if ( ! class_exists('WP_Update_Php')) {
	require_once('wp-update-php/wp-update-php.php');
}
$updatePhp = new WP_Update_Php(
	array(
		'name' => 'Auto Load Next Post',
		'textdomain' => 'auto-load-next-post'
	),
	array(
		'minimum_version' => '5.3.0',
		'recommended_version' => '5.4.7'
	)
);

// If the miniumum version of PHP required is available then run the plugin.
if ($updatePhp->does_it_meet_required_php_version()) {
	add_action('plugins_loaded', 'run_auto_load_next_post', 20);
}
