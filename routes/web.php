<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('Cloths', \App\Http\Controllers\ClothController::class);
Route::get('admin/cloths/{id}', [\App\Http\Controllers\ClothController::class,'viewNewsById']);

Route::get('/admin/index',function (){
    return view('admin.index');
})->middleware('auth')->name("admin.index");

Route::get('/customer/home', function () {
    return view('customer.home');
})->middleware('auth')->name("customer.home");

Route::get('/customer/home', [\App\Http\Controllers\ClothController::class,'home']
)->middleware('auth')->name("customer.home");

Route::get('/login',[\App\Http\Controllers\LogController::class,'viewLogin'])->name('login');

Route::post('/login',[\App\Http\Controllers\LogController::class,'login']);

Route::post('/logout',[\App\Http\Controllers\LogController::class,'logout'])->name('logout');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[\App\Http\Controllers\LogController::class,'viewRegister']);
Route::post('/register',[\App\Http\Controllers\LogController::class,'registration']);


