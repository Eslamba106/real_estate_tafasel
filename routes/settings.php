<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ThemeSettingController;
use App\Http\Controllers\Setting\CustomRoleController;
use App\Http\Controllers\Setting\BusinessSettingsController;


Route::group(['prefix' => 'language', 'middleware' => ['module:system_settings','auth']], function () {
    Route::get('', [LanguageController::class , 'index'])->name('business-settings.language.index');
    Route::post('add-new', [LanguageController::class , 'store'])->name('business-settings.language.add-new');
    Route::get('update-status', [LanguageController::class , 'update_status'])->name('business-settings.language.update-status');
    Route::get('update-default-status', [LanguageController::class , 'update_default_status'])->name('business-settings.language.update-default-status');
    Route::post('update', [LanguageController::class , 'update'])->name('business-settings.language.update');
    Route::get('translate/{lang}', [LanguageController::class , 'translate'])->name('business-settings.language.translate');
    Route::get('translate-list/{lang}', [LanguageController::class , 'translate_list'])->name('business-settings.language.translate.list');
    Route::post('translate-submit/{lang}', [LanguageController::class , 'translate_submit'])->name('business-settings.language.translate-submit');
    Route::post('remove-key/{lang}', [LanguageController::class , 'translate_key_remove'])->name('business-settings.language.remove-key');
    Route::get('delete/{lang}', [LanguageController::class , 'delete'])->name('business-settings.language.delete');
    Route::any('auto-translate/{lang}', [LanguageController::class , 'auto_translate'])->name('business-settings.language.auto-translate');
});
Route::group(['prefix' => 'web-config', 'as' => 'web-config.', 'middleware' => ['module:system_settings','auth']], function () {
    Route::get('/', [BusinessSettingsController::class, 'companyInfo'])->name('index');
    Route::post('update-language', [BusinessSettingsController::class, 'update_language'])->name('update-language');
    Route::get('app-settings', [BusinessSettingsController::class, 'app_settings'])->name('app-settings');
    Route::post('app-settings/update', [BusinessSettingsController::class, 'app_settings_update'])->name('app-settings-update');
});
Route::group(['prefix' => 'theme_settings',   'middleware' => ['module:system_settings','auth']], function () {
    Route::get('/theme_settings', [ThemeSettingController::class, 'theme_settings'])->name('theme_settings');
    Route::post('theme_settings', [ThemeSettingController::class, 'update_theme_settings'])->name('theme_settings.update');
  });
Route::group(['middleware' => ['module:system_settings','auth']], function () {
    Route::get('general-settings', [BusinessSettingsController::class, 'index'])->name('general-settings')->middleware('actch');
    Route::get('update-language', [BusinessSettingsController::class, 'update_language'])->name('update-language');
    Route::get('about-us', [BusinessSettingsController::class, 'about_us'])->name('about-us');
    Route::post('about-us', [BusinessSettingsController::class, 'about_usUpdate'])->name('about-update');
    Route::post('update-info', [BusinessSettingsController::class, 'updateInfo'])->name('business-settings.update-info');
});

Route::group(['prefix' => 'custom-role'], function () {
    Route::get('role_list', [CustomRoleController::class, 'role_list'])->name('role_admin.role_list');
    Route::get('create', [CustomRoleController::class, 'create'])->name('role_admin.create');
    Route::post('create', [CustomRoleController::class, 'store'])->name('role_admin.store');
    Route::get('update/{id}', [CustomRoleController::class, 'edit'])->name('role_admin.update');
    Route::post('update/{id}', [CustomRoleController::class, 'update'])->name('role_admin.master_update');
    Route::post('employee-role-status', [CustomRoleController::class, 'employee_role_status_update'])->name('role_admin.employee-role-status');
    Route::get('export', [CustomRoleController::class, 'export'])->name('role_admin.export');
    Route::post('delete', [CustomRoleController::class, 'delete'])->name('role_admin.delete');
});

Route::get('language/{locale}', [LanguageController::class , 'lang'])->name('lang');
