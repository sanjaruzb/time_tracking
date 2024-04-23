<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('tt', \App\Http\Controllers\TtController::class);
Route::resource('employee', \App\Http\Controllers\EmployeeController::class);
Route::resource('department', \App\Http\Controllers\DepartmentController::class);
Route::resource('position', \App\Http\Controllers\PositionController::class);

Route::resource('roles', \App\Http\Controllers\RoleController::class);
Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
Route::resource('user', \App\Http\Controllers\UserController::class);

Route::resource('cadre', \App\Http\Controllers\CadreController::class);
