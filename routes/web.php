<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('login_page');

    Route::post('login', [AuthController::class ,'login'])->name('login');
    Route::post('logout', [AuthController::class ,'logout'])->name('logout');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');