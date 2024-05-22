<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





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

Route::post('register',[RegisterController::class, 'register']);
Route::post("login",[LoginController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('create', [TaskController::class, 'create']);
    Route::post('update/{id}', [TaskController::class, 'update']);
    Route::delete('delete/{id}', [TaskController::class, 'delete']);
    Route::get('get',[TaskController::class, 'get']);
    //user module
    Route::get('all-user',[UserController::class, 'all_user_get']);
});
