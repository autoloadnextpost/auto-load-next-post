<?php
/**
 * Auto Load Next Post - Admin Settings Class.
 *
 * @since    1.0.0
 * @version  1.5.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Settings
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists('Auto_Load_Next_Post_Admin_Settings' ) ) {

	class Auto_Load_Next_Post_Admin_Settings {

		/**
		 * Setting pages.
		 *
		 * @access private
		 * @static
		 * @var array
		 */
		private static $settings = array();

		/**
		 * Error messages.
		 *
		 * @access private
		 * @static
		 * @var array
		 */
		private static $errors = array();

		/**
		 * Update messages.
		 *
		 * @access private
		 * @static
		 * @var array
		 */
		private static $messages = array();

		/**
		 * Include the settings page classes.
		 *
		 * @access  public
		 * @static
		 * @since   1.0.0
		 * @version 1.5.0
		 * @return  $settings
		 */
		public static function get_settings_pages() {
			if ( empty( self::$settings ) ) {
				$settings = array();

				include_once( dirname( __FILE__ ) . '/settings/class-alnp-settings-page.php' );

				$settings[] = include( dirname( __FILE__ ) . '/settings/class-alnp-settings-theme-selectors.php');
				$settings[] = include( dirname( __FILE__ ) . '/settings/class-alnp-settings-misc.php');
				$settings[] = include( dirname( __FILE__ ) . '/settings/class-alnp-settings-events.php');

				self::$settings = apply_filters( 'auto_load_next_post_get_settings_pages', $settings );
			}

			return self::$settings;
		} // END get_settings_page()

		/**
		 * Save the settings.
		 *
		 * @access  public
		 * @static
		 * @since   1.0.0
		 * @version 1.4.10
		 * @global  $current_tab
		 */
		public static function save() {
			global $current_tab;

			check_admin_referer( 'auto-load-next-post-settings' );

			// Trigger actions
			do_action( 'auto_load_next_post_settings_save_' . $current_tab );
			do_action( 'auto_load_next_post_update_options_' . $current_tab );
			do_action( 'auto_load_next_post_update_options' );

			self::add_message( __( 'Your settings have been saved.', 'auto-load-next-post' ) );

			do_action( 'auto_load_next_post_settings_saved' );
		} // END save()

		/**
		 * Add a message
		 *
		 * @access public
		 * @static
		 * @since  1.0.0
		 * @param  string $text Message
		 */
		public static function add_message( $text ) {
			self::$messages[] = $text;
		} // END add_message()

		/**
		 * Add an error
		 *
		 * @access public
		 * @static
		 * @since  1.0.0
		 * @param  string $text Error
		 */
		public static function add_error( $text ) {
			self::$errors[] = $text;
		} // END add_error()

		/**
		 * Output messages and errors.
		 *
		 * @access public
		 * @static
		 * @since  1.0.0
		 * @return string
		 */
		public static function show_messages() {
			if ( count( self::$errors ) > 0 ) {
				foreach ( self::$errors as $error ) {
					echo '<div id="message" class="error inline"><p><strong>' . esc_html( $error ) . '</strong></p></div>';
				}
			} elseif ( count( self::$messages ) > 0 ) {
				foreach ( self::$messages as $message ) {
					echo '<div id="message" class="updated inline"><p><strong>' . esc_html( $message ) . '</strong></p></div>';
				}
			}
		} // END show_messages()

		/**
		 * Settings Page.
		 *
		 * Handles the display of the main settings page in admin.
		 *
		 * @access  public
		 * @static
		 * @since   1.0.0
		 * @version 1.4.10
		 * @filter  auto_load_next_post_settings_tabs_array
		 * @global  string $current_section
		 * @global  string $current_tab
		 * @return  void
		 */
		public static function output() {
			global $current_section, $current_tab;

			do_action( 'auto_load_next_post_settings_start' );

			// Get tabs for the settings page
			$tabs = apply_filters( 'auto_load_next_post_settings_tabs_array', array() );

			include( dirname( __FILE__ ) . '/views/html-admin-settings.php' );
		} // END output()

		/**
		 * Get a setting from the settings API.
		 *
		 * @access public
		 * @static
		 * @since  1.0.0
		 * @param  mixed $option_name
		 * @return string
		 */
		public static function get_option( $option_name, $default = '' ) {
			// Array value
			if ( strstr( $option_name, '[' ) ) {
				parse_str( $option_name, $option_array );

				// Option name is first key
				$option_name = current( array_keys( $option_array ) );

				// Get value
				$option_values = get_option( $option_name, '' );

				$key = key( $option_array[$option_name] );

				if ( isset( $option_values[$key] ) ) {
					$option_value = $option_values[$key];
				} else {
					$option_value = null;
				}
			} else {
				// Single value
				$option_value = get_option( $option_name, null );
			}

			if ( is_array( $option_value ) ) {
				$option_value = array_map( 'stripslashes', $option_value );
			} elseif ( ! is_null( $option_value ) ) {
				$option_value = stripslashes( $option_value );
			}

			return $option_value === null ? $default : $option_value;
		} // END get_option()

		/**
		 * Output admin fields.
		 *
		 * Loops though the plugin options array and outputs each field.
		 *
		 * @access  public
		 * @static
		 * @since   1.0.0
		 * @version 1.5.0
		 * @param   array $options Opens array to output
		 */
		public static function output_fields( $options ) {
			foreach ( $options as $key => $value ) {

			if ( ! isset( $value['type'] ) ) {
					continue;
				}
				if ( ! isset( $value['id'] ) ) {
					$value['id'] = '';
				}
				if ( ! isset( $value['title'] ) ) {
					$value['title'] = isset( $value['name'] ) ? $value['name'] : '';
				}
				if ( ! isset( $value['class'] ) ) {
					$value['class'] = '';
				}
				if ( ! isset( $value['css'] ) ) {
					$value['css'] = '';
				}
				if ( ! isset( $value['default'] ) ) {
					$value['default'] = '';
				}
				if ( ! isset( $value['desc'] ) ) {
					$value['desc'] = '';
				}
				if ( ! isset( $value['placeholder'] ) ) {
					$value['placeholder'] = '';
				}

				// Custom attribute handling
				$custom_attributes = array();

				if ( ! empty( $value['custom_attributes'] ) && is_array( $value['custom_attributes'] ) ) {
					foreach ( $value['custom_attributes'] as $attribute => $attribute_value ) {
						$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
					}
				}

				// Description handling
				if ( ! empty( $value['desc'] ) ) {
					$description = $value['desc'];
				}

				if ( $description && in_array( $value['type'], array( 'textarea', 'radio' ), true ) ) {
					$description = '<p style="margin-top:0">' . wp_kses_post( $description ) . '</p>';
				} elseif ( $description && in_array( $value['type'], array( 'checkbox' ), true ) ) {
					$description = wp_kses_post( $description );
				} elseif ( $description ) {
					$description = '<p class="description">' . wp_kses_post( $description ) . '</p>';
				}

				// Switch based on type
				switch( $value['type'] ) {

					// Section Titles
					case 'title':
						if ( ! empty( $value['title'] ) ) {
							echo '<h2>' . esc_html( $value['title'] ) . '</h2>';
						}
						if ( ! empty( $value['desc'] ) ) {
							echo '<div id="' . esc_attr( sanitize_title( $value['id'] ) ) . '-description">';
							echo wp_kses_post( wpautop( wptexturize( $value['desc'] ) ) );
							echo '</div>';
						}
						echo '<table class="form-table">'."\n\n";
						if ( ! empty( $value['id'] ) ) {
							do_action( 'auto_load_next_post_settings_' . sanitize_title( $value['id'] ) );
						}

						break;

					// Section Ends
					case 'sectionend':
						if ( ! empty( $value['id'] ) ) {
							do_action( 'auto_load_next_post_settings_' . sanitize_title( $value['id'] ) . '_end' );
						}
						echo '</table>';
						if ( ! empty( $value['id'] ) ) {
							do_action( 'auto_load_next_post_settings_' . sanitize_title( $value['id'] ) . '_after' );
						}
						break;

					// Standard text inputs and subtypes like 'number'
					case 'text':
					case 'number':
					case 'password':
					case 'date':
					case 'month':
					case 'time':
					case 'week':
					case 'email':
						$option_value = self::get_option( $value['id'], $value['default'] );

						?><tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $value['type'] ) ); ?>">
								<input
									name="<?php echo esc_attr( $value['id'] ); ?>"
									id="<?php echo esc_attr( $value['id'] ); ?>"
									type="<?php echo esc_attr( $value['type'] ); ?>"
									style="<?php echo esc_attr( $value['css'] ); ?>"
									value="<?php echo esc_attr( $option_value ); ?>"
									class="<?php echo esc_attr( $value['class'] ); ?>"
									placeholder="<?php echo esc_attr( $value['placeholder'] ); ?>"
									<?php echo implode(' ', $custom_attributes ); ?>
								/><?php echo $description; ?>
							</td>
						</tr><?php
						break;

					// Textarea.
					case 'textarea':
						$option_value = self::get_option( $value['id'], $value['default'] );
						?>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $value['type'] ) ); ?>">
								<?php echo $description; ?>

								<textarea
									name="<?php echo esc_attr( $value['id'] ); ?>"
									id="<?php echo esc_attr( $value['id'] ); ?>"
									style="<?php echo esc_attr( $value['css'] ); ?>"
									class="<?php echo esc_attr( $value['class'] ); ?>"
									placeholder="<?php echo esc_attr( $value['placeholder'] ); ?>"
									<?php echo implode( ' ', $custom_attributes ); ?>
									><?php echo esc_textarea( $option_value ); ?></textarea>
							</td>
						</tr>
						<?php
						break;

					// Select boxes.
					case 'select':
					case 'multiselect':
						$option_value = self::get_option( $value['id'], $value['default'] );
						?>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $value['type'] ) ); ?>">
								<select
									name="<?php echo esc_attr( $value['id'] ); ?><?php echo ( 'multiselect' === $value['type'] ) ? '[]' : ''; ?>"
									id="<?php echo esc_attr( $value['id'] ); ?>"
									style="<?php echo esc_attr( $value['css'] ); ?>"
									class="<?php echo esc_attr( $value['class'] ); ?>"
									data-placeholder="<?php echo esc_attr( $value['placeholder'] ); ?>"
									<?php echo implode( ' ', $custom_attributes ); ?>
									<?php echo 'multiselect' === $value['type'] ? 'multiple="multiple"' : ''; ?>
									>
									<?php
									foreach ( $value['options'] as $key => $val ) {
										?>
										<option value="<?php echo esc_attr( $key ); ?>"
											<?php
											if ( is_array( $option_value ) ) {
												selected( in_array( (string) $key, $option_value, true ), true );
											} else {
												selected( $option_value, (string) $key );
											}
											?>
											>
											<?php echo esc_html( $val ); ?></option>
											<?php
									}
									?>
								</select> <?php echo $description; ?>
							</td>
						</tr>
						<?php
						break;

					// Radio inputs.
					case 'radio':
						$option_value = self::get_option( $value['id'], $value['default'] );
						?>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $value['type'] ) ); ?>">
								<fieldset>
									<?php echo $description; ?>
									<ul>
									<?php
									foreach ( $value['options'] as $key => $val ) {
										?>
										<li>
											<label><input
													name="<?php echo esc_attr( $value['id'] ); ?>"
													value="<?php echo esc_attr( $key ); ?>"
													type="radio"
													style="<?php echo esc_attr( $value['css'] ); ?>"
													class="<?php echo esc_attr( $value['class'] ); ?>"
													<?php echo implode( ' ', $custom_attributes ); // WPCS: XSS ok. ?>
													<?php checked( $key, $option_value ); ?>
													/> <?php echo esc_html( $val ); ?></label>
										</li>
										<?php
									}
									?>
									</ul>
								</fieldset>
							</td>
						</tr>
						<?php
						break;

					// Checkbox input.
					case 'checkbox':
						$option_value     = self::get_option( $value['id'], $value['default'] );
						$visibility_class = array();

						if ( ! isset( $value['hide_if_checked'] ) ) {
							$value['hide_if_checked'] = false;
						}
						if ( ! isset( $value['show_if_checked'] ) ) {
							$value['show_if_checked'] = false;
						}
						if ( 'yes' === $value['hide_if_checked'] || 'yes' === $value['show_if_checked'] ) {
							$visibility_class[] = 'hidden_option';
						}
						if ( 'option' === $value['hide_if_checked'] ) {
							$visibility_class[] = 'hide_options_if_checked';
						}
						if ( 'option' === $value['show_if_checked'] ) {
							$visibility_class[] = 'show_options_if_checked';
						}

						if ( ! isset( $value['checkboxgroup'] ) || 'start' === $value['checkboxgroup'] ) {
							?>
								<tr valign="top" class="<?php echo esc_attr( implode( ' ', $visibility_class ) ); ?>">
									<th scope="row" class="titledesc"><?php echo esc_html( $value['title'] ); ?></th>
									<td class="forminp forminp-checkbox">
										<fieldset>
							<?php
						} else {
							?>
								<fieldset class="<?php echo esc_attr( implode( ' ', $visibility_class ) ); ?>">
							<?php
						}

						if ( ! empty( $value['title'] ) ) {
							?>
								<legend class="screen-reader-text"><span><?php echo esc_html( $value['title'] ); ?></span></legend>
							<?php
						}
						?>
								<label for="<?php echo esc_attr( $value['id'] ); ?>">
									<input
										name="<?php echo esc_attr( $value['id'] ); ?>"
										id="<?php echo esc_attr( $value['id'] ); ?>"
										type="checkbox"
										class="<?php echo esc_attr( isset( $value['class'] ) ? $value['class'] : '' ); ?>"
										value="1"
										<?php checked( $option_value, 'yes' ); ?>
										<?php echo implode( ' ', $custom_attributes ); ?>
									/> <?php echo $description; ?>
								</label>
								<?php

								if ( ! isset( $value['checkboxgroup'] ) || 'end' === $value['checkboxgroup'] ) {
									?>
										</fieldset>
									</td>
								</tr>
							<?php
						} else {
							?>
								</fieldset>
							<?php
						}
						break;

					// Default: run an action
					default:
						do_action( 'auto_load_next_post_admin_field_' . $value['type'], $value );

						break;
				} // end switch()
			} // END foreach()
		} // END output_fields()

		/**
		 * Save admin fields.
		 *
		 * Loops though the plugin options array and outputs each field.
		 *
		 * @access  public
		 * @static
		 * @since   1.0.0
		 * @version 1.5.0
		 * @param   array $options Opens array to output
		 * @return  bool
		 */
		public static function save_fields( $options ) {
			if ( empty( $_POST ) ) {
				return false;
			}

			// Options to update will be stored here
			$update_options   = array();
			$autoload_options = array();

			// Loop options and get values to save
			foreach ( $options as $option ) {
				if ( ! isset( $option['id'] ) || ! isset( $option['type'] ) ) {
					continue;
				}

				// Get posted value.
				if ( strstr( $option['id'], '[' ) ) {
					parse_str( $option['id'], $option_name_array );
					$option_name  = current( array_keys( $option_name_array ) );
					$setting_name = key( $option_name_array[ $option_name ] );
					$raw_value    = isset( $_POST[ $option_name ][ $setting_name ] ) ? wp_unslash( $_POST[ $option_name ][ $setting_name ] ) : null;
				} else {
					$option_name  = $option['id'];
					$setting_name = '';
					$raw_value    = isset( $_POST[ $option['id'] ] ) ? wp_unslash( $_POST[ $option['id'] ] ) : null;
				}

				switch ( $option['type'] ) {
					case "checkbox" :
						$value = '1' === $raw_value || 'yes' === $raw_value ? 'yes' : 'no';
						break;

					case "textarea" :
						$value = wp_kses_post( trim( stripslashes( $_POST[$option['id']] ) ) );
						break;

					case "multiselect" :
						$value = array_filter( array_map( 'auto_load_next_post_clean', (array) $raw_value ) );
						break;

					case 'select' :
						$allowed_values = empty( $option['options'] ) ? array() : array_map( 'strval', array_keys( $option['options'] ) );
						if ( empty( $option['default'] ) && empty( $allowed_values ) ) {
							$value = null;
							break;
						}
						$default = ( empty( $option['default'] ) ? $allowed_values[0] : $option['default'] );
						$value   = in_array( $raw_value, $allowed_values, true ) ? $raw_value : $default;
						break;

					default :
						$value = auto_load_next_post_clean( $raw_value );
						break;
				} // END switch()

				/**
				 * Fire an action when a certain 'type' of field is being saved.
				 *
				 * @deprecated 1.5.0 - doesn't allow manipulation of values!
				 */
				if ( has_action( 'auto_load_next_post_update_option_' . sanitize_title( $option['type'] ) ) ) {
					if ( is_ajax() ) {
						error_log( 'auto_load_next_post_update_option_' . sanitize_title( $option['type'] ) . ' is deprecated since version 1.5.0' );
					} else {
						_deprecated_hook( 'auto_load_next_post_update_option_' . sanitize_title( $option['type'] ), '1.5.0' );
					}

					do_action( 'auto_load_next_post_update_option_' . sanitize_title( $option['type'] ), $option );
					continue;
				}

				if ( is_null( $value ) ) {
					continue;
				}

				// Check if option is an array and handle that differently to single values.
				if ( $option_name && $setting_name ) {
					if ( ! isset( $update_options[ $option_name ] ) ) {
						$update_options[ $option_name ] = get_option( $option_name, array() );
					}
					if ( ! is_array( $update_options[ $option_name ] ) ) {
						$update_options[ $option_name ] = array();
					}
					$update_options[ $option_name ][ $setting_name ] = $value;
				} else {
					$update_options[ $option_name ] = $value;
				}

				$autoload_options[ $option_name ] = isset( $option['autoload'] ) ? (bool) $option['autoload'] : true;

				/**
				 * Fire an action before saved.
				 *
				 * @deprecated 1.5.0 - doesn't allow manipulation of values!
				 */
				if ( has_action( 'auto_load_next_post_update_option' ) ) {
					if ( is_ajax() ) {
						error_log( 'auto_load_next_post_update_option is deprecated since version 1.5.0' );
					} else {
						_deprecated_hook( 'auto_load_next_post_update_option', '1.5.0' );
					}

					do_action( 'auto_load_next_post_update_option', $option );
				}
			}

			// Now save the options
			foreach ( $update_options as $name => $value ) {
				update_option( $name, $value, $autoload_options[ $name ] ? 'yes' : 'no' );
			}

			// Save all options as an array. Ready for export.
			update_option( 'auto_load_next_post_options', $update_options );

			return true;
		} // END save_fields()

	} // END class.

} // END if class exists.
