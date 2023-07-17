<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\authController;
use App\Http\Controllers\Api\userController;
use App\Http\Controllers\Api\guideController;

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
Route::post('prueba', [userController::class, 'vehiclesXDelivery']);

Route::resource('users', userController::class)
->only(['index', 'show', 'store', 'update', 'destroy']);
Route::post('assignGuide', [guideController::class, 'assignGuide']);
Route::post('deleteGuides', [guideController::class, 'deleteAllGuides']);
Route::post('logout', [authController::class, 'logout']);
Route::get('exportGuides', [guideController::class, 'createFile']);
Route::get('vehiculoMasUsado', [userController::class, 'mostUsedVehicle']);
Route::get('guiasTotales', [guideController::class, 'deliveryWithMostGuides']);

// Route::group(['middleware' => ['auth:sanctum']], function(){
//     Route::resource('users', userController::class)
//         ->only(['index', 'show', 'store', 'update', 'destroy']);
//     Route::post('assignGuide', [guideController::class, 'assignGuide']);
//     Route::post('deleteGuides', [guideController::class, 'deleteAllGuides']);
//     Route::post('logout', [authController::class, 'logout']);
//     Route::get('exportGuides', [guideController::class, 'createFile']);
//     Route::get('vehiculoMasUsado', [userController::class, 'mostUsedVehicle']);
//     Route::get('guiasTotales', [guideController::class, 'deliveryWithMostGuides']);
// });
