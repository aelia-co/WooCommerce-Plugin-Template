<?php
namespace PLUGIN_NSPACE;
if(!defined('ABSPATH')) exit; // Exit if accessed directly

//define('SCRIPT_DEBUG', 1);
//error_reporting(E_ALL);

require_once('lib/classes/definitions/definitions.php');

use Aelia\WC\Aelia_Plugin;
use Aelia\WC\Aelia_SessionManager;
use PLUGIN_NSPACE\Settings;
use PLUGIN_NSPACE\Settings_Renderer;
use PLUGIN_NSPACE\Messages;

/**
 * Main plugin class.
 **/
class PLUGIN_CLASS_NAME extends Aelia_Plugin {
	public static $version = 'PLUGIN_VERSION';

	public static $plugin_slug = Definitions::PLUGIN_SLUG;
	public static $text_domain = Definitions::TEXT_DOMAIN;
	public static $plugin_name = 'PLUGIN_DESCRIPTION';

	/**
	 * Factory method.
	 */
	public static function factory() {
		// Load Composer autoloader
		require_once(__DIR__ . '/vendor/autoload.php');

		$settings_key = self::$plugin_slug;

		// Settings and messages classes are loaded from the same namespace as the
		// plugin
		$settings_page_renderer = new Settings_Renderer();
		$settings_controller = new Settings(Settings::SETTINGS_KEY,
																				self::$text_domain,
																				$settings_page_renderer);
		$messages_controller = new Messages(self::$text_domain);

		$class = get_called_class();
		// Replace $settings_controller with NULL if the plugin doesn't have settings
		$plugin_instance = new $class($settings_controller, $messages_controller);
		return $plugin_instance;
	}

	/**
	 * Constructor.
	 *
	 * @param \Aelia\WC\Settings settings_controller The controller that will handle
	 * the plugin settings.
	 * @param \Aelia\WC\Messages messages_controller The controller that will handle
	 * the messages produced by the plugin.
	 */
	public function __construct($settings_controller = null,
															$messages_controller = null) {
		// Load Composer autoloader
		require_once(__DIR__ . '/vendor/autoload.php');
		parent::__construct($settings_controller, $messages_controller);
	}

	/**
	 * Sets the hooks required by the plugin.
	 */
	protected function set_hooks() {
		parent::set_hooks();

		// Add your own hooks here
	}

	/**
	 * Determines if one of plugin's admin pages is being rendered. Implement it
	 * if plugin implements pages in the Admin section.
	 *
	 * @return bool
	 */
	protected function rendering_plugin_admin_page() {
		// Uncomment this section if you implemented an Admin page that matches the
		// menu slug specified in the Definitions class

		//$screen = get_current_screen();
		//$page_id = $screen->id;
		//
		//return ($page_id == 'woocommerce_page_' . Definitions::MENU_SLUG);
	}

	/**
	 * Registers the script and style files needed by the admin pages of the
	 * plugin. Extend in descendant plugins.
	 */
	protected function register_plugin_admin_scripts() {
		// Scripts
		// Example - Register Chosen library
		//wp_register_script('chosen',
		//									 '//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js',
		//									 array('jquery'),
		//									 null,
		//									 true);

		// Styles
		//wp_register_style('chosen',
		//										'//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css',
		//										array(),
		//										null,
		//										'all');

		// WordPress already includes jQuery UI script, but no CSS for it. Therefore,
		// we need to load it from an external source
		//wp_register_style('jquery-ui',
		//									'//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css',
		//									array(),
		//									null,
		//									'all');

		//wp_enqueue_style('jquery-ui');
		//wp_enqueue_style('chosen');

		//wp_enqueue_script('jquery-ui-tabs');
		//wp_enqueue_script('jquery-ui-sortable');
		//wp_enqueue_script('chosen');

		parent::register_plugin_admin_scripts();
	}

	/**
	 * Registers the script and style files required in the backend (even outside
	 * of plugin's pages). Extend in descendant plugins.
	 */
	protected function register_common_admin_scripts() {
		parent::register_common_admin_scripts();

		// Admin styles - Enable if required
		//wp_register_style(static::$plugin_slug . '-admin',
		//									$this->url('plugin') . '/design/css/admin.css',
		//									array(),
		//									null,
		//									'all');
		//wp_enqueue_style(static::$plugin_slug . '-admin');
	}
}

$GLOBALS[PLUGIN_CLASS_NAME::$plugin_slug] = PLUGIN_CLASS_NAME::factory();
