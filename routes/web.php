<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get( '/', [HomeController::class, 'showHome'] )->name( "Frontend.home" );

Route::name( 'Frontend.' )->controller( ProductController::class )->group( function () {
    Route::get( '/product-details/{slug}', 'showProduct' )->name( 'ShowProduct' );
    Route::get( '/cart', 'showCart' )->name( 'ShowCart' );
    Route::post( '/cart', 'addToCart' )->name( 'addToCart' );
    Route::post( '/removeCart/{id}', 'cartRemove' )->name( 'CartRemove' );
    Route::post( '/cartdecrease/{id}', 'cartdecrease' )->name( 'Cartdecrease' );
    Route::post( '/cartincrease/{id}', 'cartincrease' )->name( 'CartIncrease' );
    Route::get( '/checkout', 'checkout' )->name( 'Checkout' );
    Route::post( '/checkout', 'checkoutProccess' )->name( 'checkoutProccess' );

} );
Route::middleware( 'guest' )->controller( AuthController::class )->group( function () {
    Route::get( '/active/{token}', 'accountActivation' )->name( 'accountActivation' );
    Route::get( '/login', 'login' )->name( 'login' );
    Route::post( '/login', 'loginProccess' )->name( 'loginProccess' );
    Route::get( '/registration', 'registration' )->name( 'registration' );
    Route::post( '/registration', 'registrationProccess' )
        ->name( 'registrationProccess' );

} );

Route::middleware( 'auth' )->name( 'Frontend.' )->group( function () {
    Route::get( '/logout', [AuthController::class, 'logout'] )->name( 'logout' );
} );