<?php

use App\Http\Controllers\AdminController;
use App\Models\Rented;
use App\Models\User;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('login');
});

Route::get('/images/{img1}/{img2}', function ($img1, $img2) {

    $img1 = 'storage/M/' . $img1;
    $img2 = 'storage/N/' . $img2;
    return view('personal_images', ['img1' => $img1, 'img2' => $img2]);
})->name('images');


Route::post('/users', [App\Http\Controllers\AdminController::class, 'login'])->name('users');

Route::post('/requestRegister/{num}', function ($num) {
    if ($num == 1) {
        $p = UserAdmin::all();
        
        return view('requests', ['collection' => $p]);
    }
    if ($num == 2) {
        $renteds = Rented::all();
        $users = User::all();

        $all = $users->concat($renteds);
        return view('users', ['collection' => $all]);
    }
})->name('requestRegister');

Route::delete('/deleterequest/{id}', [App\Http\Controllers\AdminController::class, 'deleteRequest'])->name('deleteRequest');
Route::delete('/deleteUser/{id}/{users}', [App\Http\Controllers\AdminController::class, 'deleteUsers'])->name('deleteUser');


Route::get('/getAllUsers', function () {

    $rented = Rented::all();
    $tenant = User::all();
    $allUsers = $tenant->concat($rented);

    return view('users', ['collection' => $allUsers]);
})->name('getAllUsers');

Route::post('/acceptRegister/{id}', [App\Http\Controllers\AdminController::class, 'acceptRegister'])->name('registerA');
