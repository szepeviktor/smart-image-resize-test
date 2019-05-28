<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://nabillemsieh.com
 * @since      1.0.0
 *
 * @package    Plugpix_Smart_Image_Resize
 * @subpackage Plugpix_Smart_Image_Resize/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugpix_Smart_Image_Resize
 * @subpackage Plugpix_Smart_Image_Resize/admin
 * @author     Nabil Lemsieh <contact@nabillemsieh.com>
 */
class Plugpix_Smart_Image_Resize_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function woocommerce_not_installed_notice()
    {
        if (!is_plugin_active('woocommerce/woocommerce.php') and current_user_can('activate_plugins')):
        ?>
    <div class="notice notice-error " style="color:red">
        <p><?php _e('Smart Image Resize requires WooCommerce to be activated.', 'plugpix-smart-image-resize');?></p>
    </div>
    <?php
endif;
    }
    public function add_admin_menu()
    {
        $page = add_submenu_page('woocommerce', 'Smart Image Resize', 'Smart Image Resize', 'manage_woocommerce', 'plugpix-smart-image-resize', [$this, 'settings_page']);
    }

    public function settings_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die(-1);
        }
        $settings = get_option('ppsir_settings');
        if (isset($_POST['save_changes'])) {
            check_admin_referer("ppsir_save_general_settings");
            if ($_POST['ppsir_settings']) {
                $_settings = $_POST['ppsir_settings'];
                $settings['enable'] = isset($_settings['enable']);
                $settings['force_resize'] = isset($_settings['force_resize']);
                $settings['bg_color'] = isset($_settings['bg_color']) ? sanitize_text_field($_settings['bg_color']) : null;

                if (isset($_settings['jpg_quality']) && !empty($_settings['jpg_quality']) && intval($_settings['jpg_quality']) >= 0 && intval($_settings['jpg_quality']) <= 100) {
                    $settings['jpg_quality'] = intval(sanitize_text_field($_settings['jpg_quality']));
                }
                update_option('ppsir_settings', $settings);
            }
            wp_safe_redirect(menu_page_url('plugpix-smart-image-resize'));
        }
        require_once PPSIR_PLUGIN_DIR . '/admin/partials/plugpix-smart-image-resize-admin-display.php';
    }

    public function resize_images($metadata)
    {
        $settings = get_option('ppsir_settings');

        if (!$settings['enable']) {
            return $metadata;
        }
        // Original image.
        $orig_image = $metadata['file'];

        // Original image path.
        $path = explode('/', $orig_image);

        // Remove basename from path.
        array_pop($path);

        // Original image directory.
        $attach_dir = implode('/', $path);

        // Upload directory.
        $upload_dir = wp_get_upload_dir()['basedir'];

        //
        $driver = $this->get_driver();
        $manager = new Intervention\Image\ImageManager(compact('driver'));
        $origin_width = $metadata['width'];
        $origin_height = $metadata['height'];
        $sizes = Plugpix_Smart_Image_Resize_Helper::get_image_sizes();

        $output = [];
        foreach ($sizes as $sizeId => $size) {

            $output_height = $size['height'];
            $output_width = $size['width'];

            $resize_height = null;
            $resize_width = null;

            if ($origin_width > $origin_height && $output_height >= $output_width) {
                $resize_width = $output_width;
            } else {
                $resize_height = $output_height;
            }

            $resizable = $resize_height === null && $resize_width > 0 
                        || $resize_width === null && $resize_height > 0;

            if(!$resizable){
                continue;
            }
            $image = $manager->make("{$upload_dir}/{$metadata['file']}");

            $image->resize($resize_width, $resize_height, function ($constraint) {
                $constraint->aspectRatio();
            });

            $bg_color = $settings['bg_color'] ?: null;

            $quality = intval($settings['jpg_quality']);

            $image->resizeCanvas($output_width, $output_height, 'center', false, $bg_color);

            $filename = pathinfo($metadata['file'], PATHINFO_FILENAME);
            $extension = pathinfo($metadata['file'], PATHINFO_EXTENSION);

            $basename = "{$filename}-{$output_width}x{$output_height}.{$extension}";
            $image->save("{$upload_dir}/$attach_dir/{$basename}", $quality);

            $output[$sizeId] = [
                'width' => $output_width,
                'height' => $output_height,
                'file' => $basename,
                'mime-type' => $image->mime(),
            ];
        }

        $metadata['sizes'] = array_merge($metadata['sizes'], $output);

        return $metadata;
    }

    /**
     * Returns image driver.
     */
    public function get_driver()
    {
        return extension_loaded('imagick') ? 'imagick' : 'Gd';
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style('wp-color-picker');
        $wp_scripts = wp_scripts();
        wp_enqueue_style(
            'jquery-ui-theme-smoothness',
            sprintf(
                '//ajax.googleapis.com/ajax/libs/jqueryui/%s/themes/smoothness/jquery-ui.css',
                $wp_scripts->registered['jquery-ui-core']->ver
            )
        );
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/plugpix-smart-image-resize-admin.css', array('wp-color-picker'), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script('jquery-ui-accordion');
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/plugpix-smart-image-resize-admin.js', array('jquery', 'wp-color-picker'), $this->version, true);

    }

}
