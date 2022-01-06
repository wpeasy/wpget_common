<?php

namespace MBW\lib;

class AdminSettingsHelper
{

    static function print_checkbox($conf)
    {
        $id = $conf[0];
        $setting_options = $conf[1];
        $saved_settings = $conf[2];
        $option_name = $conf[3];
        $class = $setting_options['class'];
        $name = $option_name. '[' . $id . ']';
        $value = esc_attr(@$saved_settings[$id]);
        $checked = checked(1, $value, false);

        echo "<input id='$id' name='$name' type='checkbox' value='1' class='$class' $checked/>";
        if ($setting_options['description']) {
            $desc = $setting_options['description'];
            echo "<p class='wpg-description'>$desc</p>";
        }
    }


}
