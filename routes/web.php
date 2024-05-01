<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'profile']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::resource('employee', \App\Http\Controllers\EmployeeController::class);

    Route::get('/employee/chane-template/{id}', '\App\Http\Controllers\EmployeeController@change_template');
    Route::post('/employee/chane-template-submit', '\App\Http\Controllers\EmployeeController@change_template_submit')->name('employee.chane-template-submit');

    Route::get('/employee/chane-individual/{id}', '\App\Http\Controllers\EmployeeController@change_individual');
    Route::post('/employee/chane-individual-submit', '\App\Http\Controllers\EmployeeController@change_individual_submit')->name('employee.chane-individual-submit');

    Route::resource('department', \App\Http\Controllers\DepartmentController::class);
    Route::resource('position', \App\Http\Controllers\PositionController::class);
    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::resource('cadre', \App\Http\Controllers\CadreController::class);
    Route::resource('holiday', \App\Http\Controllers\HolidayController::class);
    Route::resource('bugalter', \App\Http\Controllers\BugalterController::class);
    Route::resource('tt', \App\Http\Controllers\TtController::class);

    Route::get('/change-hours/index', '\App\Http\Controllers\ChangeHoursController@index')->name('change_hours.index');


//    Route::get('/cwh/change/{id}','\App\Http\Controllers\CwhController@change')->name('change-work-hours.change');


    Route::get('cadre/changestatus/{id}/{status}',[\App\Http\Controllers\CadreController::class,'changeStatus'])->name('ttChangeStatus');
});
