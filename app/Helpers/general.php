<?php
 
use App\Models\User; 
use Illuminate\Support\Str;
use Illuminate\Http\Request; 
use App\Models\BusinessSetting;
 

 

if (! function_exists('clean_html')) {
    function clean_html($text = null)
    {
        if ($text) {
            $text = strip_tags($text, '<h1><h2><h3><h4><h5><h6><p><br><ul><li><hr><a><abbr><address><b><blockquote><center><cite><code><del><i><ins><strong><sub><sup><time><u><img><iframe><link><nav><ol><table><caption><th><tr><td><thead><tbody><tfoot><col><colgroup><div><span>');

            $text = str_replace('javascript:', '', $text);
        }
        return $text;
    }
}

if (! function_exists('no_data')) {
    function no_data($title = '', $desc = '', $class = null)
    {
        $title       = $title ? $title : __('general.nothing_here');
        $desc        = $desc ? $desc : __('general.nothing_here_desc');
        $class       = $class ? $class : 'my-4 pb-4';
        $no_data_img = asset('images/no-data.svg');

        $output = " <div class='no-data-screen-wrap text-center {$class} '>
            <img src='{$no_data_img}' style='max-height: 250px; width: auto' />
            <h3 class='no-data-title'>{$title}</h3>
            <h5 class='no-data-subtitle'>{$desc}</h5>
        </div>";
        return $output;
    }
}

if (! function_exists('uploadImage')) {

    function uploadImage($request)
    {
        if (! $request->hasFile('image')) {
            return;
        } else {
            $file = $request->file('image');
            $path = $file->store('users', [
                'disk' => 'public',
            ]);
            return $path;
        }
    }
}
if (! function_exists('amount_in_words')) {  
   
    function amount_in_words($amount, $currency_id=0){
        $currency = currency($currency_id);
        // $amount = explode('.', cnv_Float($amount));
        $amount = number_format((float)$amount, $currency['decimal_places'], '.', '');
        $amount = explode('.', $amount);
        $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);

        $in_words = $currency['code'].'. ';
        $in_words .= str_replace('-', ' ', $formatter->format($amount[0]));
        // dd($amount);
        if(isset($amount[1]) && (float)$amount[1]){
            $decimal = str_replace('-', ' ', $formatter->format($amount[1]));
            $in_words .= ' and '.$decimal.' '.$currency['symbol_for_decimal'];
        }
        $in_words .= ' only';

        return ucwords($in_words); 
    }
}
if (! function_exists('currency')) {  
   
     function currency($curr_id = 0){
        // if($curr_id){
        //     $currency = find_one($curr_id, 'erp_currency');
        // } else {
            // $company = find_one(1, 'erp_company');
            $company = auth()->user() ?? User::first();
            $currency['code'] = $company['currency'];
            $currency['decimal_places'] = $company['decimals'];
            $currency['symbol_for_decimal'] = $company['denomination'];
        // }
        return $currency; 
    }
}
 

if (! function_exists('get_business_settings')) {  
    function get_business_settings($name)
    {
        $config = BusinessSetting::select('type' , 'value')->whereRaw("type LIKE ?", ["$name%"])->get();
        return $config;
    }
    
}
if (! function_exists('get_settings')) {

    function get_settings($object, $type)
    {
        $config = null;
        foreach ($object as $setting) {
            if ($setting['type'] == $type) {
                $config = $setting;
            }
        }
        return $config;
    }
}
if (! function_exists('main_path')) {
    function main_path()
    {
        return 'public/';
        // return 'assets/';
    }
}
 
  
 

if (! function_exists('selected')) {
    function selected($selected, $current = true, $echo = true)
    {
        return __checked_selected_helper($selected, $current, $echo, 'selected');
    }
}

if (! function_exists('__checked_selected_helper')) {
    function __checked_selected_helper($helper, $current, $echo, $type)
    {
        if ((string) $helper === (string) $current) {
            $result = " $type='$type'";
        } else {
            $result = '';
        }

        if ($echo) {
            echo $result;
        }

        return $result;
    }
}
 
 
if (!function_exists('uploadFile')) {
    function uploadFile(Request $request, $path)
    { 
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $extension = $file->getClientOriginalExtension(); 
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                $folder = 'image'; 
            } elseif ($extension === 'pdf') {
                $folder = 'pdf'; 
            } else {
                return null;  
            } 
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $extension; 
            $destinationPath = public_path($folder . '/' . $path); 
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            } 
            $file->move($destinationPath, $fileName);

            return [
                'path' => $folder . '/' . $path . '/' . $fileName,  
                'type' => $folder
            ];
        }
        return null;  
    }
}


 