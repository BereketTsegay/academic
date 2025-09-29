<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
|
routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->controller(AuthController::class)->group(function ($router) {

    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('register', 'register');
    Route::post('me', 'me');
    //--------------------------------other routes
})->middleware('api');

Route::prefix('admin/roles')->controller(RoleController::class)->group(function($router){
    Route::post('save','store');
    Route::get('get','index');
    Route::get('roles','roles');
    Route::get('show','show');
    Route::post('assign/{id}','syncRole');
    Route::delete('delete/{id}','delete');
})->middleware('auth:api');
Route::prefix('admin/permissions')->controller(PermissionController::class)->group(function($router){
    Route::post('save','store');
    Route::get('get','index');
    Route::post('delete/{id}','delete');
})->middleware('auth:api');
// Route::resource('admin/users', UserController::class)->middleware('auth:api');
Route::get('admin/users/search', [UserController::class,'search'])->middleware('auth:api');
Route::get('admin/users', [UserController::class,'index'])->middleware('auth:api');
Route::post('admin/users/store', [UserController::class,'store'])->middleware('auth:api');


