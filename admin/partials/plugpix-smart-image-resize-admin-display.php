<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://nabillemsieh.com
 * @since      1.0.0
 *
 * @package    Plugix_Smart_Image_Resize
 * @subpackage Plugix_Smart_Image_Resize/admin/partials
 */

/**
 * Context
 *
 * @var array $settings
 */

?>
<div class="wrap">
<h1><?php esc_html_e('Smart Image Resize for WooCommerce', 'plugpix-smart-image-resize'); ?></h1>

<h2 class="nav-tab-wrapper js-ppsir-tabs">
                <a href="admin.php?page=plugpix-smart-image-resize&action=general_settings" class="nav-tab nav-tab-active" data-tab="general_settings"> Settings </a><a href="admin.php?page=plugpix-smart-image-resize&action=faq_support" class="nav-tab" data-tab="faq_support"> FAQ & Support </a>
		            </h2>
<div class="tab-content general_settings woo-nav-tab-wrapper">
<form method="post">
<?php wp_nonce_field("ppsir_save_general_settings");?>
<table class="form-table">
<tr>
<th scope="row"><label ><?php _e('Enable/Disable', 'plugpix-smart-image-resize')?></label></th>
<td><label for=""><input name="ppsir_settings[enable]" type="checkbox" value="<?php echo $settings['enable'] ?>" <?php checked($settings['enable'], true)?>/><?php _e('Enable Smart Image Resize', 'plugpix-smart-image-resize')?></label>
</td>
</tr>
<tr>
<th scope="row"><label ><?php _e('Background color')?></label></th>
<td><input name="ppsir_settings[bg_color]" value="<?php echo $settings['bg_color'] ?>" type="text" class="js-ppsir-empty-space-color"/>
<p class="description">
Leave empty for transparent background (only for formats that support transparency including: .GIF, PNG, BMP, TIFF, and JPEG 200)</p>
</td>
</tr>
<tr>
<th scope="row"><label ><?php _e('Image Quality')?></label></th>
<td><input name="ppsir_settings[jpg_quality]" type="hidden" class="js-ppsir-img-quality" data-default="<?php echo Plugpix_Smart_Image_Resize_Helper::default_jpg_quality()?>" value="<?php echo $settings['jpg_quality'] ?>"/>
<div id="js-ppsir-img-quality-slider" style="width:300px">
<div id="js-ppsir-img-quality-slider-handle"  class="ui-slider-handle ppsir-slider-handle"></div>
</div>
<p class="description">Default value: <?php echo Plugpix_Smart_Image_Resize_Helper::default_jpg_quality() ?>%. <a href="#" id="js-ppsir-reset-img-quality">Reset to default</a></p>
</td>
</tr>
</table>
<p class="submit"><input type="submit" name="save_changes" id="submit" class="button button-primary" value="Save Changes" ></p>
</form>

</div>
<div class="tab-content faq_support hidden woo-nav-tab-wrapper" >
<h2>FAQ</h2>

<div class="js-ppsir-faq">
  <h3>How can I regenerate thumbnails I already added to the media library?</h3>
  <div>
  To regenerate thumbnails, please install <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> plugin. 
  <br>
  Then, use the following settings:
  <img src="<?php echo PPSIR_PLUGIN_URL . '/admin/img/regen_thumbs.jpg' ?>" class="ppsir-regen-settings">
  </div>

</div>
<h2>Support</h2>
<div class="support">
<p>If you noticed a bug or need a help, please post it on <a href="https://wordpress.org/support/plugin/smart-image-resize" target="_blank">the support forum</a>.</p>
</div>
</div>
</div>