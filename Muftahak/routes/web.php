<?php

use App\Http\Controllers\AdminController;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('login');
});

Route::get('/images/{img1}/{img2}', function ( $img1, $img2) {
    
    $img1='storage/M/'.$img1;
    $img2='storage/N/'.$img2;
    return view('personal_images',['img1'=>$img1,'img2'=>$img2]);
})->name('images');


Route::post('/users', [App\Http\Controllers\AdminController::class, 'login'])->name('users');
Route::get('/requestRegister/{num}', function ($num) {
    if ($num == 1) {
      $p =UserAdmin::all();
        return view('requests',['collection'=>$p]);
    }
    if ($num == 2) {
       $p =UserAdmin::all();
        return view('users',['collection'=>$p]);
    }
})->name('requestRegister');
