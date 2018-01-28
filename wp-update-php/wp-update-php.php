<?php
/**
 * WordPress Update PHP Class
 *
 * @package   WP_Update_Php
 * @author    Coen Jacobs, Sébastien Dumont
 * @license   GPL-2.0+
 */

class WP_Update_Php {
	/**
	 * @access private
	 * @var    string
	 */
	private $plugin_name;

	/**
	 * @access private
	 * @var    string
	 */
	private $textdomain;

	/**
	 * @access private
	 * @var    string
	 */
	private $minimum_version;

	/**
	 * @access private
	 * @var    string
	 */
	private $recommended_version;

	/**
	 * @access private
	 * @var    string
	 */
	private $wpupdatephp_site = 'http://www.wpupdatephp.com/update/';

	/**
	 * Constructor
	 *
	 * @access public
	 * @param  array $plugin Plugin Name and Text Domain
	 * @param  array $requirements Minimum and Recommended version of PHP.
	 */
	public function __construct($plugin = array(), $requirements = array()) {
		if ( is_array($plugin) && !empty($plugin['name']) ) {
			$this->plugin_name = $plugin['name'];
		} else {
			$this->plugin_name = '';
		}

		if ( is_array($plugin) && !empty($plugin['textdomain']) ) {
			$this->textdomain = $plugin['textdomain'];
		} else {
			$this->textdomain = 'wpupdatephp';
		}

		if ( is_array($requirements) && !empty($requirements['recommended_version']) ) {
			$this->minimum_version = $requirements['minimum_version'];
		} else {
			$this->minimum_version = '5.3.0';
		}

		if ( is_array($requirements) && !empty($requirements['recommended_version']) ) {
			$this->recommended_version = $requirements['recommended_version'];
		} else {
			$this->recommended_version = null;
		}
	} // END __construct()

	/**
	 * Check given PHP version against minimum required version.
	 *
	 * @access public
	 * @param  string $version Optional. PHP version to check against.
	 *                        Default is the current PHP version as a string in
	 *                        "major.minor.release[extra]" notation.
	 * @return bool True if supplied PHP version meets minimum required version.
	 */
	public function does_it_meet_required_php_version($version = PHP_VERSION) {
		if ($this->version_passes_requirement($this->minimum_version, $version)) {
			return true;
		}

		$this->load_version_notice(array($this, 'minimum_admin_notice'));
		return false;
	} // END does_it_meet_required_php_version()

	/**
	 * Check given PHP version against recommended version.
	 *
	 * @access public
	 * @param  string $version Optional. PHP version to check against.
	 *                        Default is the current PHP version as a string in
	 *                        "major.minor.release[extra]" notation.
	 * @return bool True if supplied PHP version meets recommended version.
	 */
	public function does_it_meet_recommended_php_version($version = PHP_VERSION) {
		if ($this->version_passes_requirement($this->recommended_version, $version)) {
			return true;
		}

		$this->load_version_notice(array($this, 'recommended_admin_notice'));
		return false;
	} // END does_it_meet_recommended_php_version()

	/**
	 * Check that one PHP version is less than or equal to another.
	 *
	 * @access private
	 * @param  string $recommended The baseline version of PHP.
	 * @param  string $version     The given version of PHP.
	 * @return bool True if the requirement is less than or equal to given version.
	 */
	private function version_passes_requirement($recommended, $version) {
		return version_compare($recommended, $version, '<=');
	} // END version_passes_requirement()

	/**
	 * Conditionally hook in an admin notice.
	 *
	 * @access private
	 * @param  callable $callback Callable that displays admin notice.
	 */
	private function load_version_notice($callback) {
		if ( is_admin() && ! defined('DOING_AJAX')) {
			add_action('admin_notices', $callback);
			add_action('network_admin_notices', $callback);
		}
	} // END load_version_notice()

	/**
	 * Return the string to be shown in the admin notice.
	 *
	 * This is based on the level (`recommended` or default `minimum`) of the
	 * notice. This will also add the plugin name to the notice string, if set.
	 *
	 * @access public
	 * @param  string $level Optional. Admin notice level, `recommended` or `minimum`.
	 *                       Default is `minimum`.
	 * @return string
	 */
	public function get_admin_notice($level = 'minimum') {
		$notice = '<div class="error is-dismissible">';

		if ('recommended' === $level) {
			if ( ! empty($this->plugin_name)) {
				$notice .= '<p>'.sprintf(__('%s recommends a PHP version higher than %s. Read more information about <a href="%s" target="_blank">how you can update</a>.', $this->textdomain), $this->plugin_name, $this->recommended_version, $this->wpupdatephp_site).'</p>';
			} else {
				$notice .= '<p>'.sprintf(__('This plugin recommends a PHP version higher than %s. Read more information about <a href="%s" target="_blank">how you can update</a>.', $this->textdomain), $this->recommended_version, $this->wpupdatephp_site).'</p>';
			}
		}

		if ( ! empty($this->plugin_name)) {
			$notice .= '<p>'.sprintf(__('Unfortunately, %s cannot run on PHP versions older than %s. Read more information about <a href="%s" target="_blank">how you can update</a>.', $this->textdomain), $this->plugin_name, $this->minimum_version, $this->wpupdatephp_site).'</p>';
		} else {
			$notice .= '<p>'.sprintf(__('Unfortunately, this plugin cannot run on PHP versions older than %s. Read more information about <a href="%s" target="_blank">how you can update</a>.', $this->textdomain), $this->minimum_version, $this->wpupdatephp_site).'</p>';
		}

		$notice .= '</div>';

		return $notice;
	} // END get_admin_notice()

	/**
	 * Method hooked into admin_notices when minimum required PHP version is not
	 * available to show this in a notice.
	 *
	 * @access public
	 * @hook   admin_notices
	 */
	public function minimum_admin_notice() {
		echo $this->get_admin_notice('minimum');
	} // END minimum_admin_notice()

	/**
	 * Method hooked into admin_notices when recommended PHP version is not
	 * available to show this in a notice.
	 *
	 * @access public
	 * @hook   admin_notices
	 */
	public function recommended_admin_notice() {
		echo $this->get_admin_notice('recommended');
	} // END recommended_admin_notice()

} // END Class
