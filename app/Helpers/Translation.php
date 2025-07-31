<?php

use App\Helpers\Helpers;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

if (! function_exists('translate')) {
    function translate($key)
    {
        $local = Helpers::default_lang();
        App::setLocale($local);

        try {
            $lang_array    = include base_path('lang/' . $local . '/messages.php');
            $processed_key = ucfirst(str_replace('_', ' ', Helpers::remove_invalid_charcaters($key)));
            $key           = Helpers::remove_invalid_charcaters($key);
            if (! array_key_exists($key, $lang_array)) {
                $lang_array[$key] = $processed_key;
                $str              = "<?php return " . var_export($lang_array, true) . ";";
                $language         = BusinessSetting::where('type', 'language')->first();
                foreach (json_decode($language['value'], true) as $key => $data) {

                    file_put_contents(base_path('lang/' . $data['code'] . '/messages.php'), $str);
                }
                $result = $processed_key;
            } else {
                $result = __('messages.' . $key);
            }
        } catch (\Exception $exception) {
            $result = __('messages.' . $key);
        }
        return $result;
    }

}
 
