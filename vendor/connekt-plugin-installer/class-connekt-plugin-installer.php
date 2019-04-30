<?php
/**
 * Connekt_Plugin_Installer
 *
 * This fork is cleaned up and improved of the original class.
 * Source: https://github.com/dcooney/wordpress-plugin-installer
 *
 * @author  Darren Cooney, Sébastien Dumont
 * @version 1.0.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Connekt_Plugin_Installer' ) ) {

	class Connekt_Plugin_Installer {

		public function start() {
			if ( ! defined( 'CNKT_INSTALLER_PATH' ) ) {
				// Update this constant to use outside the plugins directory
				define( 'CNKT_INSTALLER_PATH', plugins_url( '/', __FILE__ ) );
			}

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) ); // Enqueue scripts and Localize
			add_action( 'wp_ajax_cnkt_plugin_installer', array( $this, 'cnkt_plugin_installer' ) ); // Install plugin
			add_action( 'wp_ajax_cnkt_plugin_activation', array( $this, 'cnkt_plugin_activation' ) ); // Activate plugin
		} // END start()

		/**
		 * Initialize the display of the plugins.
		 *
		 * @access public
		 * @static
		 * @since  1.0
		 * @param  array $plugin Plugin data
		 */
		public static function init( $plugins ) {
			?>
			<div class="cnkt-plugin-installer">
			<?php
			require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );

			foreach( $plugins as $plugin ) {
				$button_classes = 'install button';
				$button_text = __( 'Install Now', 'framework' );

				$api = plugins_api( 'plugin_information', array(
					'slug' => sanitize_file_name( $plugin['slug'] ),
					'fields' => array(
						'short_description' => true,
						'sections' => false,
						'requires' => false,
						'downloaded' => true,
						'last_updated' => false,
						'added' => false,
						'tags' => false,
						'compatibility' => false,
						'homepage' => false,
						'donate_link' => false,
						'icons' => true,
						'banners' => true,
					),
				) );

				if ( ! is_wp_error( $api ) ) { // confirm error free
					$main_plugin_file = Connekt_Plugin_Installer::get_plugin_file( $plugin['slug'] ); // Get main plugin file

					if ( self::check_file_extension( $main_plugin_file ) ) { // check file extension
						if ( is_plugin_active( $main_plugin_file ) ) {
								// plugin activation, confirmed!
								$button_classes = 'button disabled';
								$button_text = __( 'Activated', 'framework' );
						} else {
							// It's installed, let's activate it
							$button_classes = 'activate button button-primary';
							$button_text = __( 'Activate', 'framework' );
						}
					}

					// Send plugin data to template
					self::render_template( $plugin, $api, $button_text, $button_classes );
				}
			}
			?>
			</div>
			<?php
		} // END init()

		/**
		 * Render display template for each plugin.
		 *
		 * @access  public
		 * @static
		 * @since   1.0
		 * @version 1.0.1
		 * @param   array  $plugin         Original data passed to init()
		 * @param   array  $api            Results from plugins_api
		 * @param   string $button_text    Text for the button
		 * @param   string $button_classes Class names for the button
		 */
		public static function render_template( $plugin, $api, $button_text, $button_classes ) {
			?>
			<div class="wp-list-table widefat plugin-install">
				<div id="the-list">
					<div class="plugin-card plugin-card-<?php echo $api->slug; ?>">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3>
									<a class="thickbox open-plugin-details-modal" href="<?php echo add_query_arg( array( 'tab' => 'plugin-information', 'plugin' => $api->slug, 'TB_iframe' => 'true', 'width' => '772', 'height' => '906' ), admin_url('plugin-install.php') ); ?>">
										<?php echo $api->name; ?>
										<img class="plugin-icon" src="<?php echo $api->icons['2x']; ?>" alt="<?php echo $api->name; ?>">
									</a>
								</h3>
							</div>

							<div class="desc column-description">
								<p><?php echo $api->short_description; ?></p>
								<p class="authors">
									<cite>
										<?php printf( __( 'By %s', 'framework' ), $api->author ); ?>
									</cite>
								</p>
							</div>
						</div>	

						<div class="plugin-card-bottom">
							<a class="<?php echo $button_classes; ?>" data-slug="<?php echo $api->slug; ?>" data-name="<?php echo $api->name; ?>" href="<?php echo add_query_arg( array( 'action' => 'install-plugin', 'plugin' => $api->slug, '_wpnonce' => wp_create_nonce( 'install-plugin_' . $api->slug ) ), admin_url( 'update.php' ) ); ?>" aria-label="<?php echo sprintf( esc_html__( 'Install %1$s %2$s now', 'framework' ), $api->name, $api->version ); ?>"><?php echo $button_text; ?></a>
							<a class="button thickbox open-plugin-details-modal" href="<?php echo add_query_arg( array( 'tab' => 'plugin-information', 'plugin' => $api->slug, 'TB_iframe' => 'true', 'width' => '772', 'height' => '906' ), admin_url('plugin-install.php') ); ?>" aria-label="<?php echo sprintf( esc_html__( 'More information about %s', 'framework' ), $api->name ); ?>" data-title="<?php echo $api->name; ?>"><?php _e( 'More Details', 'frameworks' ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		} // END render_template()

		/**
		 * An Ajax method for installing plugin.
		 *
		 * @access public
		 * @since  1.0
		 * @return $json
		 */
		public function cnkt_plugin_installer() {
			if ( ! current_user_can( 'install_plugins' ) ) {
				wp_die( __( 'Sorry, you are not allowed to install plugins on this site.', 'framework' ) );
			}

			$nonce  = $_POST["nonce"];
			$plugin = $_POST["plugin"];

			// Check our nonce, if they don't match then bounce!
			if ( ! wp_verify_nonce( $nonce, 'cnkt_installer_nonce' ) ) {
				wp_die( __( 'Error - unable to verify nonce, please try again.', 'framework' ) );
			}

			// Include required libs for installation
			require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
			require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
			require_once( ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php' );
			require_once( ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php' );

			// Get Plugin Info
			$api = plugins_api( 'plugin_information',
				array(
					'slug' => $plugin,
					'fields' => array(
						'short_description' => false,
						'sections' => false,
						'requires' => false,
						'rating' => false,
						'ratings' => false,
						'downloaded' => false,
						'last_updated' => false,
						'added' => false,
						'tags' => false,
						'compatibility' => false,
						'homepage' => false,
						'donate_link' => false,
					),
				)
			);

			$skin     = new WP_Ajax_Upgrader_Skin();
			$upgrader = new Plugin_Upgrader( $skin );
			$upgrader->install( $api->download_link );

			if ( $api->name ) {
				$status = 'success';
				$msg = sprintf( __( 'Successfully installed the plugin %s.', 'framework' ), '<strong>' . $api->name . '</strong>' );
			} else {
				$status = 'failed';
				$msg = sprintf( __( 'There was an error installing the plugin %s.', 'framework' ), '<strong>' . $api->name . '</strong>' );
			}

			$json = array(
				'status' => $status,
				'msg'    => $msg,
			);

			wp_send_json($json);
		} // END cnkt_plugin_installer()

		/**
		 * Activate plugin via Ajax.
		 *
		 * @access public
		 * @since  1.0
		 * @return $json
		 */
		public function cnkt_plugin_activation(){
			if ( ! current_user_can( 'install_plugins' ) ) {
				wp_die( __( 'Sorry, you are not allowed to activate plugins on this site.', 'framework' ) );
			}

			$nonce  = $_POST["nonce"];
			$plugin = $_POST["plugin"];

			// Check our nonce, if they don't match then bounce!
			if ( ! wp_verify_nonce( $nonce, 'cnkt_installer_nonce' ) ) {
				die( __( 'Error - unable to verify nonce, please try again.', 'framework' ) );
			}

			// Include required libs for activation
			require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
			require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
			require_once( ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php' );

			// Get Plugin Info
			$api = plugins_api( 'plugin_information',
				array(
					'slug' => $plugin,
					'fields' => array(
						'short_description' => false,
						'sections' => false,
						'requires' => false,
						'rating' => false,
						'ratings' => false,
						'downloaded' => false,
						'last_updated' => false,
						'added' => false,
						'tags' => false,
						'compatibility' => false,
						'homepage' => false,
						'donate_link' => false,
					),
				)
			);

			if ( $api->name ) {
				$main_plugin_file = Connekt_Plugin_Installer::get_plugin_file( $plugin );
				$status = 'success';

				if ( $main_plugin_file ) {
					activate_plugin( $main_plugin_file );
					$msg = sprintf( __( '%s successfully activated.', 'framework' ), $api->name );
				}
			} else {
				$status = 'failed';
				$msg    = sprintf( __( 'There was an error activating %s.', 'framework' ), $api->name );
			}

			$json = array(
				'status' => $status,
				'msg'    => $msg,
			);

			wp_send_json( $json );
		} // END cnkt_plugin_activation()

		/**
		 * A method to get the main plugin file.
		 *
		 * @access public
		 * @static
		 * @since  1.0
		 * @param  string $plugin_slug The slug of the plugin
		 * @return $plugin_file
		 */
		public static function get_plugin_file( $plugin_slug ) {
			require_once( ABSPATH . '/wp-admin/includes/plugin.php' ); // Load plugin lib

			$plugins = get_plugins();

			foreach( $plugins as $plugin_file => $plugin_info ) {
				// Get the basename of the plugin e.g. [askismet]/askismet.php
				$slug = dirname( plugin_basename( $plugin_file ) );

				if ( $slug ) {
					if ( $slug == $plugin_slug ) {
						return $plugin_file; // If $slug = $plugin_name
					}
				}
			}
			return null;
		} // END get_plugin_file()

		/**
		 * A helper to check file extension
		 *
		 * @access public
		 * @since  1.0
		 * @param  string $filename The filename of the plugin
		 * @return boolean
		 */
		public static function check_file_extension( $filename ) {
			if ( substr( strrchr( $filename, '.' ), 1 ) === 'php' ) {
				// has .php exension
				return true;
			} else {
				// ./wp-content/plugins
				return false;
			}
		} // END check_file_extension()

		/**
		 * Enqueue admin scripts and scripts localization.
		 *
		 * @access  public
		 * @since   1.0
		 * @version 1.0.1
		 */
		public function enqueue_scripts() {
			// Thickbox
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_style( 'thickbox' );

			wp_enqueue_script( 'plugin-installer', CNKT_INSTALLER_PATH. 'assets/installer.js', array( 'jquery' ));
			wp_localize_script( 'plugin-installer', 'cnkt_installer_localize', array(
				'ajax_url'      => admin_url( 'admin-ajax.php' ),
				'admin_nonce'   => wp_create_nonce( 'cnkt_installer_nonce' ),
				'install_now'   => __( 'Are you sure you want to install this plugin?', 'framework' ),
				'install_btn'   => __( 'Install Now', 'framework' ),
				'activate_btn'  => __( 'Activate', 'framework' ),
				'installed_btn' => __( 'Activated', 'framework' )
			) );
		}
	} // END enqueue_scripts()

	// Initialize
	$connekt_plugin_installer = new Connekt_Plugin_Installer();
	$connekt_plugin_installer->start();
}
