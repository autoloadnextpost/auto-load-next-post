<?php
/**
 * Auto Load Next Post - Autoloader.
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Classes
 * @package  Auto Load Next Post/Classes/AutoLoader
 * @license  GPL-2.0+
 *
 * @note This class was forked from WooCommerce and modified.
 */

 // Exit if accessed directly.
 if ( ! defined( 'ABSPATH' ) ) {
 	exit;
 }

if ( ! class_exists( 'Auto_Load_Next_Post_Autoloader' ) ) {

	class Auto_Load_Next_Post_Autoloader {

		/**
		 * Path to the includes directory.
		 *
		 * @access private
		 * @var    string
		 */
		private $include_path = '';

		/**
		 * The Constructor.
		 */
		public function __construct() {
			if ( function_exists( '__autoload' ) ) {
				spl_autoload_register( '__autoload' );
			}

			spl_autoload_register( array( $this, 'autoload' ) );

			$this->include_path = untrailingslashit( plugin_dir_path( AUTO_LOAD_NEXT_POST_FILE ) ) . '/includes/';
		}

		/**
		 * Take a class name and turn it into a file name.
		 *
		 * @access private
		 * @param  string $class Class name.
		 * @return string
		 */
		private function get_file_name_from_class( $class ) {
			return 'class-' . str_replace( '_', '-', $class ) . '.php';
		} // END get_file_name_from_class()

		/**
		 * Include a class file.
		 *
		 * @access private
		 * @param  string $path File path.
		 * @return bool Successful or not.
		 */
		private function load_file( $path ) {
			if ( $path && is_readable( $path ) ) {
				include_once $path;
				return true;
			}
			return false;
		} // END load_file()

		/**
		 * Auto-load ALNP classes on demand to reduce memory consumption.
		 *
		 * @access public
		 * @param  string $class Class name.
		 */
		public function autoload( $class ) {
			$class = strtolower( $class );

			if ( 0 !== strpos( $class, 'alnp_' ) ) {
				return;
			}

			$file = $this->get_file_name_from_class( $class );
			$path = '';

			if ( 0 === strpos( $class, 'alnp_admin' ) ) {
				$path = $this->include_path . 'admin/';
			}

			if ( empty( $path ) || ! $this->load_file( $path . $file ) ) {
				$this->load_file( $this->include_path . $file );
			}
		} // END autoload()

	} // END class.

} // END if class exists.

new Auto_Load_Next_Post_Autoloader();
