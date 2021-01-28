<?php

namespace App\Helpers;

class ColorHelper
{

    public static function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    public static function random_color() {
        return ColorHelper::random_color_part() . ColorHelper::random_color_part() . ColorHelper::random_color_part();
    }
}
