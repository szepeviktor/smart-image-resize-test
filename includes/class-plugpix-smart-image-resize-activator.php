<?php

/**
 * Fired during plugin activation
 *
 * @link       http://nabillemsieh.com
 * @since      1.0.0
 *
 * @package    Plugpix_Smart_Image_Resize
 * @subpackage Plugpix_Smart_Image_Resize/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Plugpix_Smart_Image_Resize
 * @subpackage Plugpix_Smart_Image_Resize/includes
 * @author     Nabil Lemsieh <contact@nabillemsieh.com>
 */
class Plugpix_Smart_Image_Resize_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        // update plugin version
        update_option('ppsir_plugin_version', '1.0.0');
        // Maybe set default settings
        add_option('ppsir_settings', Plugpix_Smart_Image_Resize_Helper::default_settings());
    }

}
