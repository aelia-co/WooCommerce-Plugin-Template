<?php
namespace PLUGIN_NSPACE;
if(!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Implements a class that will render the settings page.
 */
class Settings_Renderer extends \Aelia\WC\Settings_Renderer {
	// @var string The URL to the support portal.
	const SUPPORT_URL = 'PLUGIN_SUPPORT_URL';
	//const SUPPORT_URL = 'http://aelia.freshdesk.com/support/home';
	// @var string The URL to the contact form for general enquiries.
	const CONTACT_URL = 'PLUGIN_CONTACT_URL';
	//const CONTACT_URL = 'http://aelia.co/contact/';

	/*** Settings Tabs ***/
	const TAB_GENERAL = 'general';
	const TAB_SUPPORT = 'support';

	/*** Settings sections ***/
	const SECTION_GENERAL = 'general_section';
	const SECTION_SUPPORT = 'support_section';

	/**
	 * Sets the tabs to be used to render the Settings page.
	 */
	protected function add_settings_tabs() {
		// General settings
		$this->add_settings_tab($this->_settings_key,
														self::TAB_GENERAL,
														__('General', $this->_textdomain));
		// Support tab
		$this->add_settings_tab($this->_settings_key,
														self::TAB_SUPPORT,
														__('Support', $this->_textdomain));
	}

	/**
	 * Configures the plugin settings sections.
	 */
	protected function add_settings_sections() {
		// Add Blacklists section
		$this->add_settings_section(
				self::SECTION_GENERAL,
				__('General', $this->_textdomain),
				array($this, 'general_settings_section_callback'),
				$this->_settings_key,
				self::TAB_GENERAL
		);

		// Add Support section
		$this->add_settings_section(
				self::SECTION_SUPPORT,
				__('Support Information', $this->_textdomain),
				array($this, 'support_section_callback'),
				$this->_settings_key,
				self::TAB_SUPPORT
		);
	}

	/**
	 * Configures the plugin settings fields.
	 */
	protected function add_settings_fields() {
		// TODO Add settings field. Code below left as a reference.

		// SETTINGS FIELDS EXAMPLE
	//	// Load currently blacklisted email addresses
	//	$blacklisted_emails = $this->_settings_controller->get_blacklisted_emails();
	//
	//	// Add "Blacklisted emails" field
	//	$blacklisted_emails_field_id = Settings::FIELD_BLACKLISTED_EMAILS;
	//	// Prepare multi-select to allow choosing the Currencies to use
	//	add_settings_field(
	//		$blacklisted_emails_field_id,
	//		__('Blacklisted email addresses', $this->_textdomain) .
	//		'<p>' .
	//    __('Enter the email addresses that you would like to blacklist (one per line). ' .
	//			 'You can also enter regular expressions by wrapping it with slashes. ' .
	//			 '<br />' .
	//			 '<span class="label">Example</span>: ' .
	//			 '<em>/some_email.*@domain[x|y|z]\.com/</em>',
	//			 $this->_textdomain) .
	//		'</p>',
	//    array($this, 'render_textbox'),
	//    $this->_settings_key,
	//    self::SECTION_GENERAL,
	//    array(
	//			'settings_key' => $this->_settings_key,
	//			'id' => $blacklisted_emails_field_id,
	//			'label_for' => $blacklisted_emails_field_id,
	//			'value' => $blacklisted_emails,
	//			// Input field attributes
	//			'attributes' => array(
	//				'class' => 'blacklist ' . $blacklisted_emails_field_id,
	//				'multiline' => true,
	//				'rows' => 10,
	//				'cols' => 35,
	//			),
	//		)
	//	);
	}

	/**
	 * Returns the title for the menu item that will bring to the plugin's
	 * settings page.
	 *
	 * @return string
	 */
	protected function menu_title() {
		return __('PLUGIN_NAME', $this->_textdomain);
	}

	/**
	 * Returns the slug for the menu item that will bring to the plugin's
	 * settings page.
	 *
	 * @return string
	 */
	protected function menu_slug() {
		return Definitions::MENU_SLUG;
	}

	/**
	 * Returns the title for the settings page.
	 *
	 * @return string
	 */
	protected function page_title() {
		return __('Page description. Change it in <code>Settings_Renderer::page_title()</code>', $this->_textdomain) .
					 sprintf('&nbsp;(v. %s)', PLUGIN_CLASS_NAME::$version);
	}

	/**
	 * Returns the description for the settings page.
	 *
	 * @return string
	 */
	protected function page_description() {
		return __('Page description. Change it in <code>Settings_Renderer::page_description()</code>.',
							$this->_textdomain);
	}

	/*** Settings sections callbacks ***/
	public function general_settings_section_callback() {
		echo __('General settings.', $this->_textdomain);
	}

	/**
	 * Renders the content of the Support section on the settings page. Out of the
	 * box, the page includes basic instructions to contact Aelia Support Team.
	 * Modify the content as required.
	 */
	public function support_section_callback() {
		echo '<div class="support_information">';
		echo '<p>';
		echo __('We designed this plugin to be robust and effective, ' .
						'as well as intuitive and easy to use. However, we are aware that, despite ' .
						'all best efforts, issues can arise and that there is always room for ' .
						'improvement.',
						$this->_textdomain);
		echo '</p>';
		echo '<p>';
		echo __('Should you need assistance, or if you just would like to get in touch ' .
						'with us, please use one of the links below.',
						$this->_textdomain);
		echo '</p>';

		// Support links
		echo '<ul id="contact_links">';
		echo '<li>' . sprintf(__('<span class="label">To request support</span>, please use our <a href="%s">Support portal</a>. ' .
														 'The portal also contains a Knowledge Base, where you can find the ' .
														 'answers to the most common questions related to our products.',
														 $this->_textdomain),
													self::SUPPORT_URL) . '</li>';
		echo '<li>' . sprintf(__('<span class="label">To send us general feedback</span>, suggestions, or enquiries, please use ' .
														 'the <a href="%s">contact form on our website.</a>',
														 $this->_textdomain),
													self::CONTACT_URL) . '</li>';
		echo '</ul>';

		echo '</div>';
	}

	/*** Rendering methods ***/
}
