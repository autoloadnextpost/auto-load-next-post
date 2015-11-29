<?php
/**
 * Auto Load Next Post Admin Settings Class.
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

if ( ! class_exists('Auto_Load_Next_Post_Admin_Settings')) {

/**
 * Auto_Load_Next_Post_Admin_Settings
 *
 * @since 1.0.0
 */
class Auto_Load_Next_Post_Admin_Settings {

	private static $settings = array();
	private static $errors   = array();
	private static $messages = array();

	/**
	 * Include the settings page classes
	 *
	 * @since  1.0.0
	 * @access public static
	 * @return $settings
	 */
	public static function get_settings_pages() {
		if (empty(self::$settings)) {
			$settings = array();

			include_once('settings/class-auto-load-next-post-settings-page.php');
			$settings[] = include('settings/class-auto-load-next-post-settings-general.php');
			$settings[] = include('settings/class-auto-load-next-post-settings-support.php');
		}

		return self::$settings;
	} // END get_settings_page()

	/**
	 * Save the settings
	 *
	 * @since  1.0.0
	 * @access public static
	 * @global $current_tab
	 */
	public static function save() {
		global $current_tab;

		if (empty($_REQUEST['_wpnonce']) || ! wp_verify_nonce($_REQUEST['_wpnonce'], 'auto-load-next-post-settings')) {
			wp_die(__('Action failed. Please refresh the page and retry.', 'auto-load-next-post'));
		}

		// Trigger actions
		do_action('auto_load_next_post_settings_save_'.$current_tab);
		do_action('auto_load_next_post_update_options_'.$current_tab);
		do_action('auto_load_next_post_update_options');

		self::add_message(__('Your settings have been saved.', 'auto-load-next-post'));

		do_action('auto_load_next_post_settings_saved');
	} // END save()

	/**
	 * Add a message
	 *
	 * @since  1.0.0
	 * @access public static
	 * @param  string $text
	 */
	public static function add_message($text) {
		self::$messages[] = $text;
	} // END add_message()

	/**
	 * Add an error
	 *
	 * @since  1.0.0
	 * @access public static
	 * @param  string $text
	 */
	public static function add_error($text) {
		self::$errors[] = $text;
	} // END add_error()

	/**
	 * Output messages and errors.
	 *
	 * @since  1.0.0
	 * @access public static
	 * @return string
	 */
	public static function show_messages() {
		if (sizeof(self::$errors) > 0) {
			foreach (self::$errors as $error) {
				echo '<div id="message" class="error auto-load-next-post fade"><p><strong>'.esc_html($error).'</strong></p></div>';
			}
		} elseif (sizeof(self::$messages) > 0) {
			foreach (self::$messages as $message) {
				echo '<div id="message" class="updated auto-load-next-post fade"><p><strong>'.esc_html($message).'</strong></p></div>';
			}
		}
	} // END show_messages()

	/**
	 * Settings Page.
	 *
	 * Handles the display of the main settings page in admin.
	 *
	 * @since  1.0.0
	 * @access public static
	 * @filter auto_load_next_post_settings_tabs_array
	 * @global $current_tab
	 * @return void
	 */
	public static function output() {
		global $current_tab;

		// Get current tab
		$current_tab = empty($_GET['tab']) ? 'general' : sanitize_text_field(urldecode($_GET['tab']));

		wp_enqueue_script('auto_load_next_post_settings', AUTO_LOAD_NEXT_POST_URL_PATH.'/assets/js/admin/settings'.AUTO_LOAD_NEXT_POST_SCRIPT_MODE.'.js', array('jquery'), AUTO_LOAD_NEXT_POST_VERSION, true);

		wp_localize_script('auto_load_next_post_settings', 'auto_load_next_post_settings_params', array(
			'i18n_nav_warning' => __('The changes you made will be lost if you navigate away from this page.', 'auto-load-next-post'),
		));

		// Include settings pages
		self::get_settings_pages();

		// Save settings if data has been posted
		if ( ! empty($_POST)) {
			self::save();
		}

		// Add any posted messages
		if ( ! empty($_GET['auto_load_next_post_error'])) {
			self::add_error(urldecode(stripslashes($_GET['auto_load_next_post_error'])));
		}

		if ( ! empty($_GET['auto_load_next_post_message'])) {
			self::add_message(urldecode(stripslashes($_GET['auto_load_next_post_message'])));
		}

		self::show_messages();

		// Get tabs for the settings page
		$tabs = apply_filters('auto_load_next_post_settings_tabs_array', array());

		include('views/html-admin-settings.php');
	} // END output()

	/**
	 * Get a setting from the settings API.
	 *
	 * @since  1.0.0
	 * @access public static
	 * @param  mixed $option_name
	 * @return string
	 */
	public static function get_option($option_name, $default = '') {
		// Array value
		if (strstr($option_name, '[')) {
			parse_str($option_name, $option_array);

			// Option name is first key
			$option_name = current(array_keys($option_array));

			// Get value
			$option_values = get_option($option_name, '');

			$key = key($option_array[$option_name]);

			if (isset($option_values[$key])) {
				$option_value = $option_values[$key];
			} else {
				$option_value = null;
			}
		// Single value
		} else {
			$option_value = get_option($option_name, null);
		}

		if (is_array($option_value)) {
			$option_value = array_map('stripslashes', $option_value);
		} elseif ( ! is_null($option_value)) {
			$option_value = stripslashes($option_value);
		}

		return $option_value === null ? $default : $option_value;
	} // END get_option()

	/**
	 * Output admin fields.
	 *
	 * Loops though the plugin name options array and outputs each field.
	 *
	 * @since  1.0.0
	 * @access public static
	 * @param  array $options Opens array to output
	 */
	public static function output_fields($options) {
		foreach ($options as $value) {
			if ( ! isset($value['type'])) {
				continue;
			}
			if ( ! isset($value['id'])) {
				$value['id'] = '';
			}
			if ( ! isset($value['title'])) {
				$value['title'] = isset($value['name']) ? $value['name'] : '';
			}
			if ( ! isset($value['class'])) {
				$value['class'] = '';
			}
			if ( ! isset($value['css'])) {
				$value['css'] = '';
			}
			if ( ! isset($value['default'])) {
				$value['default'] = '';
			}
			if ( ! isset($value['desc'])) {
				$value['desc'] = '';
			}
			if ( ! isset($value['desc_tip'])) {
				$value['desc_tip'] = false;
			}

			// Custom attribute handling
			$custom_attributes = array();

			if ( ! empty($value['custom_attributes']) && is_array($value['custom_attributes'])) {
				foreach ($value['custom_attributes'] as $attribute => $attribute_value) {
					$custom_attributes[] = esc_attr($attribute).'="'.esc_attr($attribute_value).'"';
				}
			}

			// Description handling
			if ($value['desc_tip'] === true) {
				$description = '';
				$tip = $value['desc'];
			} else if ( ! empty($value['desc_tip'])) {
				$description = $value['desc'];
				$tip = $value['desc_tip'];
			} else if ( ! empty($value['desc'])) {
				$description = $value['desc'];
				$tip = '';
			} else {
				$description = $tip = '';
			}

			if ($description && in_array($value['type'], array('textarea', 'radio'))) {
				$description = '<p style="margin-top:0">'.wp_kses_post($description).'</p>';
			} else if ($description) {
				$description = '<span class="description">'.wp_kses_post($description).'</span>';
			}

			if ($tip && in_array($value['type'], array('checkbox'))) {
				$tip = '<p class="description">'.$tip.'</p>';
			} else if ($tip) {
				$tip = '<img class="help_tip" data-tip="'.esc_attr($tip).'" src="'.AUTO_LOAD_NEXT_POST_URL_PATH.'/assets/images/help.png" height="16" width="16" />';
			}

			// Switch based on type
			switch ($value['type']) {
				// Section Titles
				case 'title':
					if ( ! empty($value['title'])) {
						echo '<h3>'.esc_html($value['title']).'</h3>';
					}

					if ( ! empty($value['desc'])) {
						echo wpautop(wptexturize(wp_kses_post($value['desc'])));
					}

					echo '<table class="form-table">'."\n\n";

					if ( ! empty($value['id'])) {
						do_action('auto_load_next_post_settings_'.sanitize_title($value['id']));
					}

					break;

				// Section Ends
				case 'sectionend':

					if ( ! empty($value['id'])) {
						do_action('auto_load_next_post_settings_'.sanitize_title($value['id']).'_end');
					}

					echo '</table>';

					if ( ! empty($value['id'])) {
						do_action('auto_load_next_post_settings_'.sanitize_title($value['id']).'_after');
					}

					break;

				// Standard text inputs and subtypes like 'number'
				case 'text':
				case 'number':
					$type         = $value['type'];
					$class        = '';
					$option_value = self::get_option($value['id'], $value['default']);
					?><tr valign="top">
						<th scope="row" class="titledesc">
							<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_html($value['title']); ?></label>
							<?php echo $tip; ?>
						</th>
						<td class="forminp forminp-<?php echo sanitize_title($value['type']); ?>">
							<input
								name="<?php echo esc_attr($value['id']); ?>"
								id="<?php echo esc_attr($value['id']); ?>"
								type="<?php echo esc_attr($type); ?>"
								style="<?php echo esc_attr($value['css']); ?>"
								value="<?php echo esc_attr($option_value); ?>"
								class="<?php echo esc_attr($value['class']); ?>"
								<?php echo implode(' ', $custom_attributes); ?>
							/> <?php echo $description; ?>
						</td>
					</tr><?php

					break;

				// Textarea
				case 'textarea':
					$option_value = self::get_option($value['id'], $value['default']);
					?><tr valign="top">
						<th scope="row" class="titledesc">
							<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_html($value['title']); ?></label>
							<?php echo $tip; ?>
						</th>
						<td class="forminp forminp-<?php echo sanitize_title($value['type']); ?>">
						<?php echo $description; ?>
						<textarea
								name="<?php echo esc_attr($value['id']); ?>"
								id="<?php echo esc_attr($value['id']); ?>"
								style="<?php echo esc_attr($value['css']); ?>"
								class="<?php echo esc_attr($value['class']); ?>"
								<?php echo implode(' ', $custom_attributes); ?>
								><?php echo esc_textarea($option_value); ?></textarea>
						</td>
					</tr><?php

					break;

				// Select boxes
				case 'select':
				case 'multiselect':
					$option_value = self::get_option($value['id'], $value['default']);
					?><tr valign="top">
						<th scope="row" class="titledesc">
							<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_html($value['title']); ?></label>
							<?php echo $tip; ?>
						</th>
						<td class="forminp forminp-<?php echo sanitize_title($value['type']); ?>">
						<select
								name="<?php echo esc_attr($value['id']); ?><?php if ($value['type'] == 'multiselect') {
	echo '[]';
}
?>"
								id="<?php echo esc_attr($value['id']); ?>"
								style="<?php echo esc_attr($value['css']); ?>"
								class="<?php echo esc_attr($value['class']); ?>"
								<?php echo implode(' ', $custom_attributes); ?>
								<?php if ($value['type'] == 'multiselect') {
	echo 'multiple="multiple"';
}
?>>
								<?php foreach ($value['options'] as $key => $val) { ?>
										<option value="<?php echo esc_attr($key); ?>" <?php
											if (is_array($option_value)) {
												selected(in_array($key, $option_value), true);
											} else {
												selected($option_value, $key);
											}
										?>><?php echo $val ?></option>
										<?php
									}
								?>
							</select> <?php echo $description; ?>
						</td>
						</tr><?php

						break;

				// Radio inputs
				case 'radio':
					$option_value = self::get_option($value['id'], $value['default']);
					?><tr valign="top">
						<th scope="row" class="titledesc">
							<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_html($value['title']); ?></label>
							<?php echo $tip; ?>
						</th>
						<td class="forminp forminp-<?php echo sanitize_title($value['type']); ?>">
							<fieldset>
								<?php echo $description; ?>
							<ul>
							<?php foreach ($value['options'] as $key => $val) { ?>
								<li>
									<label><input
												name="<?php echo esc_attr($value['id']); ?>"
												value="<?php echo $key; ?>"
												type="radio"
												style="<?php echo esc_attr($value['css']); ?>"
												class="<?php echo esc_attr($value['class']); ?>"
												<?php echo implode(' ', $custom_attributes); ?>
												<?php checked($key, $option_value); ?>
												/> <?php echo $val ?></label>
								</li>
							<?php } ?>
							</ul>
							</fieldset>
						</td>
					</tr><?php

					break;

				// Checkbox input
				case 'checkbox':
					$option_value = self::get_option($value['id'], $value['default']);
					if ( ! isset($value['hide_if_checked'])) {
						$value['hide_if_checked'] = false;
					}
					if ( ! isset($value['show_if_checked'])) {
						$value['show_if_checked'] = false;
					}
					if ( ! isset($value['checkboxgroup']) || (isset($value['checkboxgroup']) && $value['checkboxgroup'] == 'start')) {
					?>
						<tr valign="top" class="<?php
							if ($value['hide_if_checked'] == 'yes' || $value['show_if_checked'] == 'yes') {
								echo 'hidden_option';
							}
							if ($value['hide_if_checked'] == 'option') {
								echo 'hide_options_if_checked';
							}
							if ($value['show_if_checked'] == 'option') {
								echo 'show_options_if_checked';
							}
						?>">
						<th scope="row" class="titledesc"><?php echo esc_html($value['title']); ?></th>
						<td class="forminp forminp-checkbox">
							<fieldset>
						<?php
					} else {
						?>
						<fieldset class="<?php
							if ($value['hide_if_checked'] == 'yes' || $value['show_if_checked'] == 'yes') {
								echo 'hidden_option';
							}
							if ($value['hide_if_checked'] == 'option') {
								echo 'hide_options_if_checked';
							}
							if ($value['show_if_checked'] == 'option') {
								echo 'show_options_if_checked';
							}
						?>">
					<?php
					}
					?>
						<legend class="screen-reader-text"><span><?php echo esc_html($value['title']); ?></span></legend>
						<label for="<?php echo $value['id'] ?>">
						<input
							name="<?php echo esc_attr($value['id']); ?>"
							id="<?php echo esc_attr($value['id']); ?>"
							type="checkbox"
							value="1"
							<?php checked($option_value, 'yes'); ?>
							<?php echo implode(' ', $custom_attributes); ?>
						/> <?php echo wp_kses_post($value['desc']) ?></label> <?php echo $tip; ?>
					<?php
					if ( ! isset($value['checkboxgroup']) || (isset($value['checkboxgroup']) && $value['checkboxgroup'] == 'end')) {
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
					do_action('auto_load_next_post_admin_field_'.$value['type'], $value);

					break;
			} // end switch

		}

	} // END output_fields()

	/**
	 * Save admin fields.
	 *
	 * Loops though the plugin name options array and outputs each field.
	 *
	 * @since  1.0.0
	 * @access public static
	 * @param  array $options Opens array to output
	 * @return bool
	 */
	public static function save_fields($options, $current_tab) {
		if (empty($_POST)) {
					return false;
		}

		// Options to update will be stored here
		$update_options = array();

		// Loop options and get values to save
		foreach ($options as $value) {

			if ( ! isset($value['id'])) {
							continue;
			}

			$type = isset($value['type']) ? sanitize_title($value['type']) : '';

			// Get the option name
			$option_value = null;

			switch ($type) {
				// Standard types
				case "checkbox" :
					if (isset($_POST[$value['id']])) {
						$option_value = 'yes';
					} else {
						$option_value = 'no';
					}

				break;

				case "textarea" :
					if (isset($_POST[$value['id']])) {
						$option_value = wp_kses_post(trim(stripslashes($_POST[$value['id']])));
					} else {
						$option_value = '';
					}

				break;

				case "text" :
				case "number":
				case "select" :
				case "single_select_page" :
				case "radio" :
					if (isset($_POST[$value['id']])) {
						$option_value = auto_load_next_post_clean(stripslashes($_POST[$value['id']]));
					} else {
						$option_value = '';
					}

				break;

				// Special types
				case "multiselect" :
					// Get array
					if (isset($_POST[$value['id']])) {
						$selected_values = array_map('auto_load_next_post_clean', array_map('stripslashes', (array) $_POST[$value['id']]));
					} else {
						$selected_values = array();
					}
					$option_value = $selected_values;

				break;

				// Custom handling
				default :
					do_action('auto_load_next_post_update_option_'.$type, $value);

				break;

			} // END switch()

			if ( ! is_null($option_value)) {

				// Check if option is an array
				if (strstr($value['id'], '[')) {
					parse_str($value['id'], $option_array);

					// Option name is first key
					$option_name = current(array_keys($option_array));

					// Get old option value
					if ( ! isset($update_options[$option_name])) {
						$update_options[$option_name] = get_option($option_name, array());
					}

					if ( ! is_array($update_options[$option_name])) {
						$update_options[$option_name] = array();
					}

					// Set keys and value
					$key = key($option_array[$option_name]);
					$update_options[$option_name][$key] = $option_value;

				// Single value
				} else {
					$update_options[$value['id']] = $option_value;
				}

			}

			// Custom handling
			do_action('auto_load_next_post_update_option', $value);
		}

		// Now save the options
		foreach ($update_options as $name => $value) {
			update_option($name, $value);
		}

		// Save all options as an array. Ready for export.
		update_option('auto_load_next_post_options_'.$current_tab, $update_options);

		return true;
	} // END save_fields()

} // END class.

} // end if class exists.
