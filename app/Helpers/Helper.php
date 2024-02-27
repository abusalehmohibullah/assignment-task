<?php

namespace App\Helpers;

class Helper {

    public static function is_rtl( $current_locale = '' ) {
        $current_locale = ( ! empty( $current_locale ) ) ? $current_locale :  app()->getLocale();
        $is_rtl         = config( 'languages.' . $current_locale . '.is_rtl' );

        return ! empty( $is_rtl );
    }

    public static function rlt_ext( $current_locale = '' ) {
        $current_locale = ( ! empty( $current_locale ) ) ? $current_locale :  app()->getLocale();

        return self::is_rtl( $current_locale ) ? '.rtl' : '';
    }

    public static function get_translation_url( $locale = '' ) {

        return null;

    }

    public static function get_public_storage_asset_url( $path ) {

        $path = preg_replace( '/^(public)[\/]/', '', $path ) ;

        return asset( 'storage/' . $path );


    }
    
}


if (! function_exists('static_asset')) {

    function static_asset($path = null, $secure = null)
    {
        if (strpos(php_sapi_name(), 'cli') !== false || defined('LARAVEL_START_FROM_PUBLIC')) {
            return app('url')->asset($path, $secure);
        } else {
            return app('url')->asset('public/'.$path, $secure);
        }
    }
}

