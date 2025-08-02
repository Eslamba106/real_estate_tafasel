<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ThemeSettingController extends Controller
{
    public function theme_settings()
    {
        $theme_setting = ThemeSetting::pluck('value', 'key')->toArray();
        return view('admin-views.theme-settings.theme_settings', compact('theme_setting'));
    }
    public function update_theme_settings(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            ThemeSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        Toastr::success('theme_settings_updated');
        return back();
    }
}
