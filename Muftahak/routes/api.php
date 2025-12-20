<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\RentedController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaitingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RentedAuthenticated;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register',[UserAdminController::class,'register']);
Route::post('login',[UserAdminController::class,'login']);
Route::post('logout',[UserAdminController::class,'logout'])->middleware('auth:renteds-api,sanctum');
Route::get('getInfoUser',[UserAdminController::class,'getInfoUser'])->middleware('auth:renteds-api,sanctum');

Route::get('filter',[ApartmentController::class,'filterApartments']);

Route::post('storeTemporary',[WaitingController::class,'storeTemporary'])->middleware('auth:sanctum');
Route::post('storeBookingFromUser',[WaitingController::class,'storeBookingFromUser'])->middleware('auth:sanctum');
// Route::delete('cancelBookingFromUser/{id}',[WaitingController::class,'cancelBookingFromUser'])->middleware('auth:sanctum');
Route::delete('cancelBookingFromUser',[WaitingController::class,'cancelBookingFromUser'])->middleware('auth:sanctum');