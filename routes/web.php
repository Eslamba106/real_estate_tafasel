<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UnitManagementController;
use App\Http\Controllers\FloorManagementController;
use App\Http\Controllers\property_master\ViewController;
use App\Http\Controllers\property_master\FloorController;
use App\Http\Controllers\property_master\UnitTypeController;
use App\Http\Controllers\property_master\UnitParkingController;
use App\Http\Controllers\property_master\PropertyTypeController;
use App\Http\Controllers\property_master\UnitConditionController;
use App\Http\Controllers\property_master\UnitDescriptionController;

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

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');




// Unit Description
Route::group(['prefix' => 'unit_description', 'middleware' => ['module:unit_description', 'auth']], function () {
    Route::get('/', [UnitDescriptionController::class, 'index'])->name('unit_description.index');
    Route::post('store', [UnitDescriptionController::class, 'store'])->name('unit_description.store');
    Route::get('/edit/{id}', [UnitDescriptionController::class, 'edit'])->name('unit_description.edit');
    Route::patch('/update/{id}', [UnitDescriptionController::class, 'update'])->name('unit_description.update');
    Route::get('delete', [UnitDescriptionController::class, 'delete'])->name('unit_description.delete');
    Route::post('/status-update', [UnitDescriptionController::class, 'statusUpdate'])->name('unit_description.status-update');
});

// Unit Type
Route::group(['prefix' => 'unit_type'], function () {
    Route::get('/', [UnitTypeController::class, 'index'])->name('unit_type.index');
    Route::post('store', [UnitTypeController::class, 'store'])->name('unit_type.store');
    Route::get('/edit/{id}', [UnitTypeController::class, 'edit'])->name('unit_type.edit');
    Route::patch('/update/{id}', [UnitTypeController::class, 'update'])->name('unit_type.update');
    Route::get('delete', [UnitTypeController::class, 'delete'])->name('unit_type.delete');
    Route::post('/status-update', [UnitTypeController::class, 'statusUpdate'])->name('unit_type.status-update');
});

// Unit Condition
Route::group(['prefix' => 'unit_condition'], function () {
    Route::get('/', [UnitConditionController::class, 'index'])->name('unit_condition.index');
    Route::post('store', [UnitConditionController::class, 'store'])->name('unit_condition.store');
    Route::get('/edit/{id}', [UnitConditionController::class, 'edit'])->name('unit_condition.edit');
    Route::patch('/update/{id}', [UnitConditionController::class, 'update'])->name('unit_condition.update');
    Route::get('delete', [UnitConditionController::class, 'delete'])->name('unit_condition.delete');
    Route::post('/status-update', [UnitConditionController::class, 'statusUpdate'])->name('unit_condition.status-update');
});

// Unit Parking
Route::group(['prefix' => 'unit_parking'], function () {
    Route::get('/', [UnitParkingController::class, 'index'])->name('unit_parking.index');
    Route::post('store', [UnitParkingController::class, 'store'])->name('unit_parking.store');
    Route::get('/edit/{id}', [UnitParkingController::class, 'edit'])->name('unit_parking.edit');
    Route::patch('/update/{id}', [UnitParkingController::class, 'update'])->name('unit_parking.update');
    Route::get('delete', [UnitParkingController::class, 'delete'])->name('unit_parking.delete');
    Route::post('/status-update', [UnitParkingController::class, 'statusUpdate'])->name('unit_parking.status-update');
});

// View
Route::group(['prefix' => 'view'], function () {
    Route::get('/', [ViewController::class, 'index'])->name('view.index');
    Route::post('store', [ViewController::class, 'store'])->name('view.store');
    Route::get('/edit/{id}', [ViewController::class, 'edit'])->name('view.edit');
    Route::patch('/update/{id}', [ViewController::class, 'update'])->name('view.update');
    Route::get('delete', [ViewController::class, 'delete'])->name('view.delete');
    Route::post('/status-update', [ViewController::class, 'statusUpdate'])->name('view.status-update');
});
// property type
Route::group(['prefix' => 'property_type'], function () {
    Route::get('/', [PropertyTypeController::class, 'index'])->name('property_type.index');
    Route::post('store', [PropertyTypeController::class, 'store'])->name('property_type.store');
    Route::get('/edit/{id}', [PropertyTypeController::class, 'edit'])->name('property_type.edit');
    Route::patch('/update/{id}', [PropertyTypeController::class, 'update'])->name('property_type.update');
    Route::get('delete', [PropertyTypeController::class, 'delete'])->name('property_type.delete');
    Route::post('/status-update', [PropertyTypeController::class, 'statusUpdate'])->name('property_type.status-update');
});
// floors
Route::group(['prefix' => 'floor'], function () {
    Route::get('/', [FloorController::class, 'index'])->name('floor.index');
    Route::post('store', [FloorController::class, 'store'])->name('floor.store');
    Route::get('/edit/{id}', [FloorController::class, 'edit'])->name('floor.edit');
    Route::patch('/update/{id}', [FloorController::class, 'update'])->name('floor.update');
    Route::get('delete', [FloorController::class, 'delete'])->name('floor.delete');
    Route::post('/status-update', [FloorController::class, 'statusUpdate'])->name('floor.status-update');
});

// Project 
Route::group(['prefix' => 'project'], function () {
    Route::get('/', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('store', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::get('/show/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/view_image/{id}', [ProjectController::class, 'view_image'])->name('project.show');
    Route::patch('/update/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::get('delete', [ProjectController::class, 'delete'])->name('project.delete');
});

Route::group(['prefix' => 'floor_management'], function () {
    Route::get('/', [FloorManagementController::class, 'index'])->name('floor_management.index');
    Route::get('/create', [FloorManagementController::class, 'create'])->name('floor_management.create');
    Route::post('store', [FloorManagementController::class, 'store'])->name('floor_management.store');
    Route::get('/edit/{id}', [FloorManagementController::class, 'edit'])->name('floor_management.edit');
    Route::get('/show/{id}', [FloorManagementController::class, 'show'])->name('floor_management.show');
    Route::get('/view_image/{id}', [FloorManagementController::class, 'view_image'])->name('floor_management.show');
    Route::patch('/update/{id}', [FloorManagementController::class, 'update'])->name('floor_management.update');
    Route::get('delete', [FloorManagementController::class, 'delete'])->name('floor_management.delete');
    Route::post('status-update', [FloorManagementController::class, 'statusUpdate'])->name('floor_management.status-update');
});

// Units Management
Route::group(['prefix' => 'unit_management'], function () {
    Route::get('/', [UnitManagementController::class, 'index'])->name('unit_management.index');
    Route::get('/create', [UnitManagementController::class, 'create'])->name('unit_management.create');
    Route::post('store', [UnitManagementController::class, 'store'])->name('unit_management.store');
    Route::get('/edit/{id}', [UnitManagementController::class, 'edit'])->name('unit_management.edit');
    Route::get('/show/{id}', [UnitManagementController::class, 'show'])->name('unit_management.show');
    Route::get('/view_image/{id}', [UnitManagementController::class, 'view_image'])->name('unit_management.show');
    Route::patch('/update/{id}', [UnitManagementController::class, 'update'])->name('unit_management.update');
    Route::get('delete', [UnitManagementController::class, 'delete'])->name('unit_management.delete');
    Route::post('status-update', [UnitManagementController::class, 'statusUpdate'])->name('unit_management.status-update');

    Route::get('get_blocks_by_property_id/{id}', [UnitManagementController::class, 'get_blocks_by_property_id'])->name('unit_management.get_blocks_by_property_id');
    Route::get('get_floors_by_block_id/{id}', [UnitManagementController::class, 'get_floors_by_block_id'])->name('unit_management.get_floors_by_block_id');
    Route::get('get_units_by_floor_id/{floor_id}/{block_id}/{property_id}', [UnitManagementController::class, 'get_units_by_floor_id'])->name('unit_management.get_units_by_floor_id');
    Route::get('/get-floors-by-project', [UnitManagementController::class, 'getFloorsByProject'])->name('get.floors.by.project');
});
