<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

Route::controller(AuthController::class)->name('auth.')->middleware('guest')->group(function () {
    Route::post('/login', 'logIn')->name('admin-login');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logOut'])->name('auth.logout');
    Route::controller(CartController::class)->name('cart.')->group(function () {
        Route::post('/addProductInCart/{product}', 'addProductInCart')->name('addProductInCart');
        Route::post('/removeProductFromCart/{product}', 'removeProductFromCart')->name('removeProductFromCart');
        Route::post('/setCartProductQuantity', 'setCartProductQuantity')->name('setCartProductQuantity');
        Route::get('/getUserCart', 'getUserCart')->name('getUserCart');
    });
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });