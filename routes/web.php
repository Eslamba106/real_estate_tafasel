<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UnitManagementController;
use App\Http\Controllers\FloorManagementController;
use App\Http\Controllers\CustomerReminderController;
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
    Route::get('/', [FloorController::class, 'index'])->name('floor.index')->middleware('module:show_all_floor');
    Route::post('store', [FloorController::class, 'store'])->name('floor.store')->middleware('module:add_floor');
    Route::get('/edit/{id}', [FloorController::class, 'edit'])->name('floor.edit')->middleware('module:edit_floor');
    Route::patch('/update/{id}', [FloorController::class, 'update'])->name('floor.update')->middleware('module:edit_floor');
    Route::get('delete', [FloorController::class, 'delete'])->name('floor.delete')->middleware('module:delete_floor');
    Route::post('/status-update', [FloorController::class, 'statusUpdate'])->name('floor.status-update')->middleware('module:change_status_floor');
});

// Project 
Route::group(['prefix' => 'project'], function () {
    Route::get('/', [ProjectController::class, 'index'])->name('project.index')->middleware('module:show_all_project');
    Route::get('/create', [ProjectController::class, 'create'])->name('project.create')->middleware('module:add_project');
    Route::post('store', [ProjectController::class, 'store'])->name('project.store')->middleware('module:add_project');
    Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit')->middleware('module:edit_project');
    // Route::get('/show/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/view_image/{id}', [ProjectController::class, 'view_image'])->name('project.show')->middleware('module:show_project');
    Route::patch('/update/{id}', [ProjectController::class, 'update'])->name('project.update')->middleware('module:edit_project');
    Route::get('delete', [ProjectController::class, 'delete'])->name('project.delete')->middleware('module:delete_project');
});

Route::group(['prefix' => 'floor_management'], function () {
    Route::get('/', [FloorManagementController::class, 'index'])->name('floor_management.index')->middleware('module:show_all_floor_management');
    Route::get('/create', [FloorManagementController::class, 'create'])->name('floor_management.create')->middleware('module:add_floor_management');
    Route::post('store', [FloorManagementController::class, 'store'])->name('floor_management.store')->middleware('module:add_floor_management');
    Route::get('/edit/{id}', [FloorManagementController::class, 'edit'])->name('floor_management.edit')->middleware('module:edit_floor_management');
    // Route::get('/show/{id}', [FloorManagementController::class, 'show'])->name('floor_management.show');
    Route::get('/view_image/{id}', [FloorManagementController::class, 'view_image'])->name('floor_management.show')->middleware('module:edit_floor_management');
    Route::patch('/update/{id}', [FloorManagementController::class, 'update'])->name('floor_management.update')->middleware('module:edit_floor_management');
    Route::get('delete', [FloorManagementController::class, 'delete'])->name('floor_management.delete')->middleware('module:delete_floor_management');
    Route::post('status-update', [FloorManagementController::class, 'statusUpdate'])->name('floor_management.status-update')->middleware('module:change_status_floor_management');
});

// Units Management
Route::group(['prefix' => 'unit_management'], function () {
    Route::get('/', [UnitManagementController::class, 'index'])->name('unit_management.index')->middleware('module:show_all_unit_management');
    Route::get('/create', [UnitManagementController::class, 'create'])->name('unit_management.create')->middleware('module:add_unit_management');
    Route::post('store', [UnitManagementController::class, 'store'])->name('unit_management.store')->middleware('module:add_unit_management');
    Route::get('/edit/{id}', [UnitManagementController::class, 'edit'])->name('unit_management.edit')->middleware('module:edit_unit_management');
    // Route::get('/show/{id}', [UnitManagementController::class, 'show'])->name('unit_management.show');
    Route::get('/view_image/{id}', [UnitManagementController::class, 'view_image'])->name('unit_management.show')->middleware('module:edit_unit_management');
    Route::patch('/update/{id}', [UnitManagementController::class, 'update'])->name('unit_management.update')->middleware('module:edit_unit_management');
    Route::get('delete', [UnitManagementController::class, 'delete'])->name('unit_management.delete')->middleware('module:delete_unit_management');
    Route::post('status-update', [UnitManagementController::class, 'statusUpdate'])->name('unit_management.status-update')->middleware('module:change_status_unit_management');

    Route::get('get_blocks_by_property_id/{id}', [UnitManagementController::class, 'get_blocks_by_property_id'])->name('unit_management.get_blocks_by_property_id');
    Route::get('get_floors_by_block_id/{id}', [UnitManagementController::class, 'get_floors_by_block_id'])->name('unit_management.get_floors_by_block_id');
    Route::get('get_units_by_floor_id/{floor_id}/{block_id}/{property_id}', [UnitManagementController::class, 'get_units_by_floor_id'])->name('unit_management.get_units_by_floor_id');
    Route::get('/get-floors-by-project', [UnitManagementController::class, 'getFloorsByProject'])->name('get.floors.by.project');
});



// Teams
Route::group(['prefix' => 'team' ], function () {
    Route::get('/', [TeamController::class, 'index'])->name('team.index')->middleware('module:show_all_team');
    Route::post('store', [TeamController::class, 'store'])->name('team.store')->middleware('module:add_team');
    Route::get('/edit/{id}', [TeamController::class, 'edit'])->name('team.edit')->middleware('module:edit_team');
    Route::patch('/update/{id}', [TeamController::class, 'update'])->name('team.update')->middleware('module:edit_team');
    Route::get('delete', [TeamController::class, 'delete'])->name('team.delete')->middleware('module:delete_team');
    Route::post('/status-update', [TeamController::class, 'statusUpdate'])->name('team.status-update')->middleware('module:change_status_team');
});

 
// Employee
Route::group(['prefix' => 'employees'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employee.index')->middleware('module:show_all_employee');
    Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create')->middleware('module:add_employee');
    Route::post('store', [EmployeeController::class, 'store'])->name('employee.store')->middleware('module:add_employee');
    Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit')->middleware('module:edit_employee');
    Route::patch('/update/{id}', [EmployeeController::class, 'update'])->name('employee.update')->middleware('module:edit_employee');
    Route::get('delete', [EmployeeController::class, 'delete'])->name('employee.delete')->middleware('module:delete_employee');
    Route::post('/status-update', [EmployeeController::class, 'statusUpdate'])->name('employee.status-update')->middleware('module:change_status_employee');

});
 
// Customer
Route::group(['prefix' => 'customers'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customer.index')->middleware('module:customer');
    Route::get('/create', [CustomerController::class, 'create'])->name('customer.create')->middleware('module:add_customer');
    Route::post('store', [CustomerController::class, 'store'])->name('customer.store')->middleware('module:add_customer');
    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit')->middleware('module:edit_customer');
    Route::patch('/update/{id}', [CustomerController::class, 'update'])->name('customer.update')->middleware('module:edit_customer');
    Route::get('delete', [CustomerController::class, 'delete'])->name('customer.delete')->middleware('module:delete_customer');
    Route::post('/status-update', [CustomerController::class, 'statusUpdate'])->name('customer.status-update')->middleware('module:change_status_delete_customer');
    Route::post('/store_reminder', [CustomerReminderController::class, 'add_reminder'])->name('customer.store_reminder')->middleware('module:add_reminder');
    // Route::get('/add_reminder', [CustomerController::class, 'add_reminder'])->name('customer.add_reminder')->middleware('module:add_reminder');
    Route::get('get_floors_by_project/{id}', [CustomerController::class, 'get_floors_by_project'])->name('customer.get_floors_by_project') ;
    Route::get('get_unit_by_floor/{id}', [CustomerController::class, 'get_unit_by_floor'])->name('customer.get_unit_by_floor') ;

});
    Route::middleware(['auth'])->group(function () {
    Route::get('/reminders', [CustomerReminderController::class, 'index'])->name('reminders.index');
    Route::post('/reminder/{id}/done', [CustomerReminderController::class, 'markAsDone'])->name('reminders.done');
});