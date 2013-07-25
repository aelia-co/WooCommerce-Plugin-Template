<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Implements a base class to store and handle the messages returned by the
 * plugin.
 */
class WC_Aelia_Messages {
	const DEFAULT_TEXTDOMAIN = 'woocommerce-aelia';

	// Result constants
	const RES_OK = 0;
	const ERR_FILE_NOT_FOUND = 100;

	// @var WP_Error Holds the error messages registered by the plugin
	protected $_wp_error;

	// @var string The text domain used by the class
	protected $_text_domain = self::DEFAULT_TEXTDOMAIN;

	public function __construct($text_domain = self::DEFAULT_TEXTDOMAIN) {
		$this->_text_domain = $text_domain;
		$this->_wp_error = new WP_Error();
		$this->load_error_messages();
	}

	/**
	 * Loads all the error message used by the plugin.
	 */
	public function load_error_messages() {
		$this->add_error_message(self::ERR_FILE_NOT_FOUND, __('File not found: "%s".', $this->_text_domain));
	}

	/**
	 * Registers an error message in the internal _wp_error object.
	 *
	 * @param mixed error_code The Error Code.
	 * @param string error_message The Error Message.
	 */
	public function add_error_message($error_code, $error_message) {
		$this->_wp_error->add($error_code, $error_message);
	}

	/**
	 * Retrieves an error message from the internal _wp_error object.
	 *
	 * @param mixed error_code The Error Code.
	 * @return string The Error Message corresponding to the specified Code.
	 */
	public function get_error_message($error_code) {
		return $this->_wp_error->get_error_message($error_code);
	}
}
