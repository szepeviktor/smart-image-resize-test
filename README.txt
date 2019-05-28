=== Smart Image Resize for WooCommerce ===
Contributors: nlemsieh
Donate link: https://paypal.me/nlemsieh
Tags: WooCommerce product image resize, fix image crop, resize, image, picture resize, image crop, image resize without cropping, image resize, resize thumbnails, resize images in WooCommerce
Requires at least: 4.0
Tested up to: 5.2
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Requires PHP: 5.4
Stable tag: 1.0.8

Resize WooCommerce images and preserve aspect-ratio without cropping.

== Description ==

Smart Image Resize prevents an image from being cutt-off to perfecly fit your website layout while preserving the aspect-ratio.

### Usage

The plugin will automatically resize your images after you upload an image to the media library. 

Optionally, you can change settings under "WooCommerce > Smart Image Resize" page to fit your needs. 

> Note, to regenerate exising thumbnails, install <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails plugin</a> and make sure to uncheck **Skip regenerating existing correctly sized thumbnails (faster)**

== Installation ==

1. Upload `plugpix-smart-image-resize.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
 
 == Frequently Asked Questions == 

= How can I regenerate thumbnails I already added to the media library? =

To regenerate thumbnails, please install [Regenerate Thumbnails plugin](https://wordpress.org/plugins/regenerate-thumbnails/). Make sure to uncheck **Skip regenerating existing correctly sized thumbnails (faster)**


= I get an error when I upload an image =

Make sure PHP extension `fileinfo` is enabled. 


== Screenshots ==

1. Before and after using the plugin.
2. Settings page.

== Changelog ==

= 1.0.8 =

* Skip woocommerce_single resize


= 1.0.7 =

* Stability improvement

= 1.0.6 =

* Bugfix


= 1.0.5 =

* Bugfix

= 1.0.4 =

* Removed deprecated option.

= 1.0.3 =

* Small images resize improvement.

= 1.0.2 =

Improve stability

= 1.0.1 =

- Add ability to add custom color in settings.
- Fixbug for some PHP versions.

= 1.0.0 =

* Public Release

 == Upgrade Notice ==
 
 = 1.0.0 =

* Public Release