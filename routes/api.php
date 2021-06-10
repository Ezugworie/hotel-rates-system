<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('hotels', HotelController::class);
// Route::post('/hotels/{id}', [HotelController::class, 'search'])->name('search');



Route::apiResource('rates', RateController::class);

Route::post('/rates/search', [RateController::class, 'search'])->name('search');
Route::get('/rates/hotels', [RateController::class, 'show'])->name('hotels');

Route::post('/profiles', [ProfileController::class, 'store'])->name('profile');

//Blog api
Route::apiResource('blogs', BlogController::class);

// Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
// Route::post('/blogs', [BlogController::class, 'store'])->name('create blogs');

