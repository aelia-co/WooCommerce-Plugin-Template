<?php
namespace PLUGIN_NSPACE;
if(!defined('ABSPATH')) exit; // Exit ifaccessed directly

/**
 * Handles the settings for the Shipping Pricing plugin and provides convenience
 * methods to read and write them.
 */
class Settings extends \Aelia\WC\Settings {
	/*** Settings Key ***/
	// @var string The key to identify plugin settings amongst WP options.
	const SETTINGS_KEY = 'PLUGIN_SETTINGS_KEY';

	/*** Settings fields ***/

	/**
	 * Returns the default settings for the plugin. Used mainly at first
	 * installation.
	 *
	 * @param string key If specified, method will return only the setting identified
	 * by the key.
	 * @param mixed default The default value to return if the setting requested
	 * via the "key" argument is not found.
	 * @return array|mixed The default settings, or the value of the specified
	 * setting.
	 *
	 * @see WC_Aelia_Settings:default_settings().
	 */
	public function default_settings($key = null, $default = null) {
		// TODO Add default options
		$default_options = array(
		);

		if(empty($key)) {
			return $default_options;
		}
		else {
			return get_value($key, $default_options, $default);
		}
	}

	/**
	 * Validates the settings specified via the Options page.
	 *
	 * @param array settings An array of settings.
	 */
	public function validate_settings($settings) {
		// Debug
		//var_dump($settings);die();
		$this->validation_errors = array();
		$processed_settings = $this->current_settings();

		// Validate the settings posted via the $settings variable

		// Save settings if they passed validation
		if(empty($this->validation_errors)) {
			$processed_settings = array_merge($processed_settings, $settings);
		}
		else {
			$this->show_validation_errors();
		}

		// Return the array processing any additional functions filtered by this action.
		return apply_filters('PLUGIN_FILTER_PREFIX_settings', $processed_settings, $settings);
	}

	/**
	 * Class constructor.
	 */
	public function __construct($settings_key = self::SETTINGS_KEY,
															$textdomain = '',
															\Aelia\WC\Settings_Renderer $renderer = null) {
		if(empty($renderer)) {
			// Instantiate the render to be used to generate the settings page
			$renderer = new \Aelia\WC\Settings_Renderer();
		}
		parent::__construct($settings_key, $textdomain, $renderer);

		add_action('admin_init', array($this, 'init_settings'));

		// If no settings are registered, save the default ones
		if($this->load() === null) {
			$this->save();
		}
	}

	/*** Validation methods ***/
}
