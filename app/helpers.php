<?php
if (!function_exists('setting'))
{
    function setting($settingName) {
           if ($setting = App\Setting::where('name', $settingName)->first())
           {
               return $setting->value ? $setting->value : '[Value not set]';
           }
           return '[Setting not found]';
    }
}
