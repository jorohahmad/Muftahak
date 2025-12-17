<?php

use App\Http\Controllers\RentedController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RentedAuthenticated;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register',[UserAdminController::class,'register']);
// Route::post('register',[UserController::class,'register']);
// Route::post('login',[UserController::class,'login']);
Route::post('login',[UserAdminController::class,'login']);
Route::post('logout',[UserAdminController::class,'logout'])->middleware('auth:renteds-api,sanctum');
