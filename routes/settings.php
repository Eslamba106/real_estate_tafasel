<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
