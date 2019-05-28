<?php
class Plugpix_Smart_Image_Resize_Helper
{

    static function default_jpg_quality(){
        return 90;
    }
    public static function default_settings()
    {
        return [
            'enable' => true, 
            'force_resize' => true,
            'bg_color' => null,
            'jpg_quality' => static::default_jpg_quality(),
        ];
    }
    public static function array_overwrite(&$original, $overwrite)
    {
        // Not included in function signature so we can return silently if not an array
        if (!is_array($overwrite)) {
            return;
        }
        if (!is_array($original)) {
            $original = $overwrite;
        }
        foreach ($overwrite as $key => $value) {
            if (array_key_exists($key, $original) && is_array($value)) {
                self::array_overwrite($original[$key], $overwrite[$key]);
            } else {
                $original[$key] = $value;
            }
        }
    }


    static function  get_image_sizes() {
        global $_wp_additional_image_sizes;
    
        $sizes = array();
    
        foreach ( get_intermediate_image_sizes() as $_size ) {
            // if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
            //     $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
            //     $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
            //     $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
            // } else
            if ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
                $sizes[ $_size ] = array(
                    'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
                    'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                    'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
                );
            }
        }
    
        return $sizes;
    }
}
