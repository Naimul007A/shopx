<?php

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
    Route::get( '/cart', 'showCart' )->name( 'ShowCart' );
    Route::post( '/cart', 'addToCart' )->name( 'addToCart' );
    Route::post( '/removeCart/{id}', 'cartRemove' )->name( 'CartRemove' );
} );