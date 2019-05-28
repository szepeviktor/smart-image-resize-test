<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              http://nabillemsieh.com
 * @since             1.0.0
 * @package           Plugpix_Smart_Image_Resize
 *
 * @wordpress-plugin
 * Plugin Name:       Smart Image Resize for WooCommerce
 * Plugin URI:        http://wordpress.org/plugins/smart-image-resize
 * Description:       Prevent an image from being cutt-off to perfecly fit your website layout while preserving the aspect-ratio.
 * Version:           1.0.8
 * Author:            Nabil Lemsieh
 * Author URI:        http://nabillemsieh.com
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl.html
 * Text Domain:       plugpix-smart-image-resize
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('PPSIR_VERSION', '1.0.8');
define('PPSIR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PPSIR_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugpix-smart-image-resize-activator.php
 */
function activate_plugpix_smart_image_resize()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-plugpix-smart-image-resize-activator.php';
    Plugpix_Smart_Image_Resize_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugpix-smart-image-resize-deactivator.php
 */
function deactivate_plugpix_smart_image_resize()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-plugpix-smart-image-resize-deactivator.php';
    Plugpix_Smart_Image_Resize_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_plugpix_smart_image_resize');
register_deactivation_hook(__FILE__, 'deactivate_plugpix_smart_image_resize');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-plugpix-smart-image-resize.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugpix_smart_image_resize()
{

    $plugin = new Plugpix_Smart_Image_Resize();
    $plugin->run();

}
run_plugpix_smart_image_resize();
