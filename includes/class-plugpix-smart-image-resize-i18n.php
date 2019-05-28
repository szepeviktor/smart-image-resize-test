<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://nabillemsieh.com
 * @since      1.0.0
 *
 * @package    Plugpix_Smart_Image_Resize
 * @subpackage Plugpix_Smart_Image_Resize/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Plugpix_Smart_Image_Resize
 * @subpackage Plugpix_Smart_Image_Resize/includes
 * @author     Nabil Lemsieh <contact@nabillemsieh.com>
 */
class Plugpix_Smart_Image_Resize_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'plugpix-smart-image-resize',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
