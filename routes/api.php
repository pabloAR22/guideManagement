<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\authController;
use App\Http\Controllers\Api\userController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [authController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::resource('users', userController::class)
        ->only(['index', 'show', 'store', 'update', 'destroy']);

    Route::post('logout', [authController::class, 'logout']);
});
