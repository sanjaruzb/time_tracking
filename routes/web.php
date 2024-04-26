<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'profile']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::resource('employee', \App\Http\Controllers\EmployeeController::class);
    Route::resource('department', \App\Http\Controllers\DepartmentController::class);
    Route::resource('position', \App\Http\Controllers\PositionController::class);
    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::resource('cadre', \App\Http\Controllers\CadreController::class);
    Route::resource('holiday', \App\Http\Controllers\HolidayController::class);
    Route::resource('bugalter', \App\Http\Controllers\BugalterController::class);
    Route::resource('tt', \App\Http\Controllers\TtController::class);
    Route::get('cadre/changestatus/{id}/{status}',[\App\Http\Controllers\CadreController::class,'changeStatus'])->name('ttChangeStatus');
});
