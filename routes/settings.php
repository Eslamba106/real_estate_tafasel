<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Setting\CustomRoleController;
use App\Http\Controllers\Setting\BusinessSettingsController;


Route::group(['prefix' => 'language', 'as' => 'language.', 'middleware' => ['module:system_settings']], function () {
    Route::get('', 'LanguageController@index')->name('index');
    Route::post('add-new', 'LanguageController@store')->name('add-new');
    Route::get('update-status', 'LanguageController@update_status')->name('update-status');
    Route::get('update-default-status', 'LanguageController@update_default_status')->name('update-default-status');
    Route::post('update', 'LanguageController@update')->name('update');
    Route::get('translate/{lang}', 'LanguageController@translate')->name('translate');
    Route::get('translate-list/{lang}', 'LanguageController@translate_list')->name('translate.list');
    Route::post('translate-submit/{lang}', 'LanguageController@translate_submit')->name('translate-submit');
    Route::post('remove-key/{lang}', 'LanguageController@translate_key_remove')->name('remove-key');
    Route::get('delete/{lang}', 'LanguageController@delete')->name('delete');
    Route::any('auto-translate/{lang}', 'LanguageController@auto_translate')->name('auto-translate');
});
Route::group(['prefix' => 'web-config', 'as' => 'web-config.', 'middleware' => ['module:system_settings']], function () {
    Route::get('/', [BusinessSettingsController::class, 'companyInfo'])->name('index');
    Route::post('update-language', [BusinessSettingsController::class, 'update_language'])->name('update-language');
    Route::get('app-settings', [BusinessSettingsController::class, 'app_settings'])->name('app-settings');
    Route::post('app-settings/update', [BusinessSettingsController::class, 'app_settings_update'])->name('app-settings-update');
});
Route::group(['middleware' => ['module:system_settings']], function () {
    Route::get('general-settings', [BusinessSettingsController::class, 'index'])->name('general-settings')->middleware('actch');
    Route::get('update-language', [BusinessSettingsController::class, 'update_language'])->name('update-language');
    Route::get('about-us', [BusinessSettingsController::class, 'about_us'])->name('about-us');
    Route::post('about-us', [BusinessSettingsController::class, 'about_usUpdate'])->name('about-update');
    Route::post('update-info', [BusinessSettingsController::class, 'updateInfo'])->name('business-settings.update-info');
});

Route::group(['prefix' => 'custom-role'], function () {
    Route::get('create', [CustomRoleController::class, 'create'])->name('role_admin.create');
    Route::post('create', [CustomRoleController::class, 'store'])->name('role_admin.store');
    Route::get('update/{id}', [CustomRoleController::class, 'edit'])->name('role_admin.update');
    Route::post('update/{id}', [CustomRoleController::class, 'update'])->name('role_admin.master_update');
    Route::post('employee-role-status', [CustomRoleController::class, 'employee_role_status_update'])->name('role_admin.employee-role-status');
    Route::get('export', [CustomRoleController::class, 'export'])->name('role_admin.export');
    Route::post('delete', [CustomRoleController::class, 'delete'])->name('role_admin.delete');
});