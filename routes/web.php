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
    Route::get('/employee/additional-date/{id}', '\App\Http\Controllers\EmployeeController@additional_date');
    Route::post('/employee/additional-date-submit', '\App\Http\Controllers\EmployeeController@additional_date_submit')->name('employee.additional-date-submit');
    Route::get('/employee/download-file/{file}', '\App\Http\Controllers\EmployeeController@download_file')->name('employee.download-file');

    Route::resource('department', \App\Http\Controllers\DepartmentController::class);
    Route::resource('position', \App\Http\Controllers\PositionController::class);
    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::resource('holiday', \App\Http\Controllers\HolidayController::class);
    Route::resource('bugalter', \App\Http\Controllers\BugalterController::class);
    Route::resource('tt', \App\Http\Controllers\TtController::class);

    Route::get('cadre/report', '\App\Http\Controllers\CadreController@report')->name('cadre.report');
    Route::resource('cadre', \App\Http\Controllers\CadreController::class);

    Route::get('cadre/changestatus/{id}/{status}','\App\Http\Controllers\CadreController@changeStatus')->name('ttChangeStatus');

    Route::get('/change-hours/index', '\App\Http\Controllers\ChangeHoursController@index')->name('change_hours.index');
    Route::get('/change-hours/allow/{id}', '\App\Http\Controllers\ChangeHoursController@allow')->name('change_hours.allow');
    Route::get('/change-hours/cancel/{id}', '\App\Http\Controllers\ChangeHoursController@cancel')->name('change_hours.cancel');

    Route::get('/weekend/index', '\App\Http\Controllers\WeekendController@index')->name('weekend.index');
    Route::get('/weekend/allow/{id}', '\App\Http\Controllers\WeekendController@allow')->name('weekend.allow');
    Route::get('/weekend/cancel/{id}', '\App\Http\Controllers\WeekendController@cancel')->name('weekend.cancel');
});
