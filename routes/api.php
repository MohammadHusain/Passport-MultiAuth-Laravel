<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/login', [LoginController::class, 'user_login']);
Route::post('/admin/login', [LoginController::class, 'admin_login']);
Route::post('/superadmin/login', [LoginController::class, 'superadmin_login']);

Route::group(['middleware' => 'auth:user-api'], function () {
    Route::get('/dashboard', function(){
        echo 'this is User Dashboard';
    });
});

Route::group(['middleware' => 'auth:admin-api'], function () {
    Route::get('/admin/dashboard', function(){
        echo 'this is admin Dashboard';
    });
});

Route::group(['middleware' => 'auth:superadmin-api'], function () {
    Route::get('/superadmin/dashboard', function(){
        echo 'this is Superadmin Dashboard';
    });
});