<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothController;
use App\Http\Controllers\CartController;

//Route::get('/customer/home', function () {
//    return view('customer.home');
//})->middleware('auth')->name("customer.home");








//admin
Route::middleware('isAdmin')->group(function(){

    Route::get('/order/{type}', [\App\Http\Controllers\ClothController::class, 'orderIndex'])->name('order');
    Route::post('/orderUpdate/{id}', [\App\Http\Controllers\ClothController::class, 'orderUpdate'])->name('orderUpdate');
    Route::get('/', [\App\Http\Controllers\ClothController::class, 'index']
    )->name("admin.index");
    Route::resource('Cloths', \App\Http\Controllers\ClothController::class);
    Route::get('/admin/index', function () {
        return view('admin.index');
    })->middleware('auth')->name("admin.index");

    Route::get('/QuantityUpdate/{id}', [\App\Http\Controllers\ClothController::class, 'updateQuantity'])->name('update.quantity');
    Route::get('/statistic', [\App\Http\Controllers\ClothController::class, 'statistic'])->name('statistic');

});


//Route::get('admin/cloths/{id}', [\App\Http\Controllers\ClothController::class,'viewNewsById']);




//visitor
Route::get('/specific/{name}',[\App\Http\Controllers\ClothController::class,'manuf'])->name('specific');
Route::get('/register',[\App\Http\Controllers\LogController::class,'viewRegister']);
Route::post('/register',[\App\Http\Controllers\LogController::class,'registration']);
Route::get('/login',[\App\Http\Controllers\LogController::class,'viewLogin'])->name('login');
Route::post('/login',[\App\Http\Controllers\LogController::class,'login']);
Route::get('/', [\App\Http\Controllers\ClothController::class,'home']
)->name("customer.home");
Route::get('/customer/home', [\App\Http\Controllers\ClothController::class,'home']
)->name("customer.home");
Route::get('/showcus-detail/{id}',[\App\Http\Controllers\ClothController::class,'showcus'])->name('showcus');
Route::get('/profile/{id}',[\App\Http\Controllers\LogController::class,'profile'])->name('profile');
Route::get('/search',[\App\Http\Controllers\ClothController::class,'search'])->name('search');



Route::post('/logout',[\App\Http\Controllers\LogController::class,'logout'])->name('logout');

//customer
Route::group(['middleware' => 'auth'], function() {


    Route::get('/showcart/{id}', [\App\Http\Controllers\CartController::class,'showCartTable'])->name('showcart');

    Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::delete('remove-from-cart', [CartController::class, 'removeCartItem']);
    Route::get('clear-cart', [CartController::class, 'clearCart']);


    Route::post('/orderUpdate/{id}', [\App\Http\Controllers\ClothController::class, 'orderUpdate'])->name('orderUpdate');

    Route::get('customer/orderDetails/{id}', [ClothController::class, 'orderDetails'])->name('order.details');
    Route::get('customer/history/{id}', [ClothController::class, 'orderHistory'])->name('order.history');
//    Route::get('customer/history/{id}', [ClothController::class, 'orderHistory'])->name('order.history');
});


Route::group(['middleware' => ['web']], function () {
    Route::post('checkout', [CartController::class, 'checkOut'])->name('checkOut');
});









