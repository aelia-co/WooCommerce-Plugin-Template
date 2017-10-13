<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: PLUGIN_NAME
Description: PLUGIN_DESCRIPTION
Plugin URI: PLUGIN_URI
Version: PLUGIN_VERSION
Author: PLUGIN_AUTHOR
Author URI: PLUGIN_AUTH_URI
Text Domain: PLUGIN_TEXT_DOMAIN
License: PLUGIN_LICENSE
WC requires at least: PLUGIN_WC_MIN_VERSION
WC tested up to: PLUGIN_WC_MAX_VERSION
*/

require_once(dirname(__FILE__) . '/src/lib/classes/install/plugin-requirementscheck.php');
// If requirements are not met, deactivate the plugin
if(PLUGIN_CLASS_NAME_RequirementsChecks::factory()->check_requirements()) {
	require_once dirname(__FILE__) . '/src/plugin-main.php';
}
