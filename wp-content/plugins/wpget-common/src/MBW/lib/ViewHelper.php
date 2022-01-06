<?php

namespace MBW\lib;

class ViewHelper
{

    static function getView($path, $vars_array = [], $echo = true ){
        extract($vars_array);
        $out = '';
        ob_start();
        $out = file_get_contents($path);
        ob_end_clean();

        if($echo){ echo $out; }

        return $out;
    }
}
