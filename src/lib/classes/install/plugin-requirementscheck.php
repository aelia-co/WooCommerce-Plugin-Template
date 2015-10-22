<?php
if(!defined('ABSPATH')) exit; // Exit if accessed directly

require_once('aelia-wc-requirementscheck.php');

/**
 * Checks that plugin's requirements are met.
 */
class PLUGIN_CLASS_NAME_RequirementsChecks extends Aelia_WC_RequirementsChecks {
	// @var string The namespace for the messages displayed by the class.
	protected $text_domain = 'PLUGIN_TEXT_DOMAIN';
	// @var string The plugin for which the requirements are being checked. Change it in descendant classes.
	protected $plugin_name = 'PLUGIN_NAME';

	// @var array An array of WordPress plugins (name => version) required by the plugin.
	protected $required_plugins = array(
		'WooCommerce' => '2.1',
		//'Aelia Foundation Classes for WooCommerce' => array(
		//	'version' => '1.0.10.140819',
		//	'extra_info' => 'You can get the plugin <a href="http://bit.ly/WC_AFC_S3">from our site</a>, free of charge.',
		//	'autoload' => true,
		//	'url' => 'http://bit.ly/WC_AFC_S3',
		//),
	);

	/**
	 * Factory method. It MUST be copied to every descendant class, as it has to
	 * be compatible with PHP 5.2 and earlier, so that the class can be instantiated
	 * in any case and and gracefully tell the user if PHP version is insufficient.
	 *
	 * @return Aelia_WC_AFC_RequirementsChecks
	 */
	public static function factory() {
		$instance = new self();
		return $instance;
	}
}
