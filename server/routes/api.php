<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
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
 */#

///AUTH

Route::post('/auth/signup', [AuthController::class, 'signup']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/forgetpassword', [AuthController::class, 'forgetpassword']);
Route::post('/auth/resetpassword/{token}', [AuthController::class, 'resetpassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::patch('/auth/updatemydata', [AuthController::class, 'updatemydata']);
    Route::get('/auth/getmydata', [AuthController::class, 'getmydata']);
    Route::delete('/auth/deleteme', [AuthController::class, 'deleteme']);
    Route::patch('/auth/updatepassword', [AuthController::class, 'updatepassword']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

////Restaurant

Route::group(['middleware' => ['auth:sanctum', 'RoleMiddleware:admin']], function () {
    Route::post('/restaurants', [RestaurantController::class, 'store']);
    Route::patch('/restaurants/{id}', [RestaurantController::class, 'update']);
    Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy']);
});

Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);
